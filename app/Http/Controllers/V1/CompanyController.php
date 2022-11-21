<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Company\StoreRequest;
use App\Http\Requests\V1\Company\UpdateRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyService $service;


    public function __construct()
    {
        $this->service = new CompanyService();
    }

    public function index(){

    }

    public function store(StoreRequest $request){

    }

    public function update(UpdateRequest $request, Company $company){

    }

    public function show(Company $company){

    }

    public function destroy(Company $company){

    }
}
