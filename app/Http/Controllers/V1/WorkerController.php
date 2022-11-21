<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\APIBaseController;
use App\Http\Requests\V1\Worker\StoreRequest;
use App\Http\Requests\V1\Worker\UpdateRequest;
use App\Models\Worker;
use App\Services\WorkerService;
use Symfony\Component\HttpFoundation\Response;


class WorkerController extends APIBaseController
{
    private WorkerService $service;

    public function __construct()
    {
        $this->service = new WorkerService();
    }

    public function index()
    {
        $response['workers'] = $this->service->all();
        return $this->successResponse("workers found", $response);
    }


    public function store(StoreRequest $request)
    {
        $response['worker'] = $this->service->store($request);
        return $this->successResponse("worker created successfully", $response,Response::HTTP_CREATED);
    }


    public function show(Worker $worker)
    {
        $response['worker'] = $this->service->show($worker);
        return $this->successResponse("worker found", $response);
    }


    public function update(UpdateRequest $request, Worker $worker)
    {
        $response['worker'] = $this->service->update($worker, $request);
        return $this->successResponse("worker updated successfully", $response);
    }


    public function destroy(Worker $worker)
    {
        $this->service->delete($worker);
        return $this->successResponse("worker deleted successfully");
    }
}
