<?php


use App\Http\Controllers\V1\CompanyController;
use Illuminate\Support\Facades\Route;


Route::prefix('company')
    ->controller(CompanyController::class)
    ->group(function (){
        Route::post('register', 'store');
    });
