<?php


namespace App\Services;


use App\Http\Requests\V1\Worker\StoreRequest;
use App\Http\Requests\V1\Worker\UpdateRequest;
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
            (new MediaService())->storePdf($worker, $validatedRequest['cv']);
            DB::commit();
            return new WorkerResource($worker);
        } catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception("An error occurred, worker could not be created");
        }
    }

    public function show(Worker $worker){
        return new WorkerResource($worker);
    }

    public function update(Worker $worker, UpdateRequest $request){
        $validatedRequest = $request->validated();
        $worker->update([
            'first_name' => $validatedRequest['first_name'],
            'last_name' => $validatedRequest['last_name'],
            'other_names' => $validatedRequest['other_names'] ?? null,
            'position' => $validatedRequest['position'],
            'qualification' => $validatedRequest['qualification'],
            'skills' => json_encode($validatedRequest['skills']),
        ]);
        if (isset($validatedRequest['cv'])){
            $worker->clearMediaCollection('cv');
            (new MediaService())->storePdf($worker, $validatedRequest['cv']);
        }
        return new WorkerResource($worker);
    }

    public function delete(Worker $worker){
        try {
            $worker->delete();
        } catch (\Exception $exception){
            throw new \Exception("An error occurred, worker could not be deleted");
        }
    }
}
