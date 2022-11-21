<?php


use App\Http\Controllers\V1\CompanyController;
use Illuminate\Support\Facades\Route;


Route::post('company/register', [CompanyController::class, 'store']);


Route::prefix('company')
    ->controller(CompanyController::class)
    ->middleware(['auth:sanctum', 'active'])
    ->group(function (){
        Route::get('/', 'index')->middleware(['admin']);
        Route::get('/{company:uuid}', 'show');
        Route::patch('/{company:uuid}', 'update')->middleware(['company']);
        Route::delete('/self', 'destroy')->middleware(['company']);
    });


