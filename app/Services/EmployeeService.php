<?php


namespace App\Services;


use App\Http\Requests\V1\Employee\StoreRequest;
use App\Http\Requests\V1\Employee\UpdateRequest;
use App\Http\Resources\V1\EmployeeResource;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    public function all(){
        $employee = EmployeeResource::collection(Employee::all());
        return $employee;
    }

    public function store(StoreRequest $request){
        try {
            $validatedRequest = $request->validated();
            DB::beginTransaction();

            // create worker
            $employee = Employee::create([
                'first_name' => $validatedRequest['first_name'],
                'last_name' => $validatedRequest['last_name'],
                'other_names' => $validatedRequest['other_names'] ?? null,
                'position' => $validatedRequest['position'],
                'qualification' => $validatedRequest['qualification'],
                'skills' => json_encode($validatedRequest['skills']),
            ]);

            // store certificates (pdf)
            (new MediaService())->storePdf($employee, $validatedRequest['cv']);
            DB::commit();
            return new EmployeeResource($employee);
        } catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception("An error occurred, employee could not be created");
        }
    }

    public function show(Employee $worker){
        return new EmployeeResource($worker);
    }

    public function update(Employee $employee, UpdateRequest $request){
        $validatedRequest = $request->validated();
        $employee->update([
            'first_name' => $validatedRequest['first_name'],
            'last_name' => $validatedRequest['last_name'],
            'other_names' => $validatedRequest['other_names'] ?? null,
            'position' => $validatedRequest['position'],
            'qualification' => $validatedRequest['qualification'],
            'skills' => json_encode($validatedRequest['skills']),
        ]);
        if (isset($validatedRequest['cv'])){
            $employee->clearMediaCollection('cv');
            (new MediaService())->storePdf($employee, $validatedRequest['cv']);
        }
        return new EmployeeResource($employee);
    }

    public function delete(Employee $employee){
        try {
            $employee->delete();
        } catch (\Exception $exception){
            throw new \Exception("An error occurred, employee could not be deleted");
        }
    }
}
