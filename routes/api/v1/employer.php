<?php


use App\Http\Controllers\V1\EmployerController;
use Illuminate\Support\Facades\Route;


Route::post('employer/register', [EmployerController::class, 'store']);


Route::prefix('employer')
    ->controller(EmployerController::class)
    ->middleware(['auth:sanctum', 'active'])
    ->group(function (){
        Route::get('/', 'index')->middleware(['admin']);
        Route::get('/{company:uuid}', 'show');
        Route::patch('/{company:uuid}', 'update')->middleware(['company']);
        Route::delete('/self', 'destroy')->middleware(['company']);
    });


