<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\APIBaseController;
use App\Http\Requests\V1\Employee\StoreRequest;
use App\Http\Requests\V1\Employee\UpdateRequest;
use App\Models\Employee;
use App\Services\EmployeeService;
use Symfony\Component\HttpFoundation\Response;


class EmployeeController extends APIBaseController
{
    private EmployeeService $service;

    public function __construct()
    {
        $this->service = new EmployeeService();
    }

    public function index()
    {
        $response['employees'] = $this->service->all();
        return $this->successResponse("employees found", $response);
    }


    public function store(StoreRequest $request)
    {
        $response['employee'] = $this->service->store($request);
        return $this->successResponse("employee created successfully", $response,Response::HTTP_CREATED);
    }


    public function show(Employee $worker)
    {
        $response['employee'] = $this->service->show($worker);
        return $this->successResponse("employee found", $response);
    }


    public function update(UpdateRequest $request, Employee $worker)
    {
        $response['employee'] = $this->service->update($worker, $request);
        return $this->successResponse("employee updated successfully", $response);
    }


    public function destroy(Employee $worker)
    {
        $this->service->delete($worker);
        return $this->successResponse("employee deleted successfully");
    }
}
