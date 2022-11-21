<?php


namespace App\Services;


use App\Http\Requests\V1\Worker\StoreRequest;
use App\Http\Resources\V1\WorkerResource;
use App\Models\Worker;
use Illuminate\Support\Facades\DB;

class WorkerService
{
    public function all(){
        $workers = WorkerResource::collection(Worker::all());
        return $workers;
    }

    public function store(StoreRequest $request){
        try {
            $validatedRequest = $request->validated();
            DB::beginTransaction();

            // create worker
            $worker = Worker::create([
                'first_name' => $validatedRequest['first_name'],
                'last_name' => $validatedRequest['last_name'],
                'other_names' => $validatedRequest['other_names'] ?? null,
                'position' => $validatedRequest['position'],
                'qualification' => $validatedRequest['qualification'],
                'skills' => json_encode($validatedRequest['skills']),
            ]);

            // store certificates (pdf)

            DB::commit();
            (new MediaService())->storePdf($worker, $validatedRequest['cv']);
            return $worker;
        } catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception("An error occurred, worker could not be created");
        }
    }

    public function delete(Worker $worker){
        try {
            $worker->delete();
        } catch (\Exception $exception){
            throw new \Exception("An error occurred, worker could not be deleted");
        }
    }
}
