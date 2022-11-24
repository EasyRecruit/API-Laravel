<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Employer\StoreRequest;
use App\Http\Requests\V1\Employer\UpdateRequest;
use App\Models\Employer;
use App\Services\EmployerService;


class EmployerController extends Controller
{
    private EmployerService $service;


    public function __construct()
    {
        $this->service = new EmployerService();
    }

    public function index(){

    }

    public function store(StoreRequest $request){

    }

    public function update(UpdateRequest $request, Employer $company){

    }

    public function show(Employer $company){

    }

    public function destroy(Employer $company){

    }
}
