<?php

use App\Http\Controllers\V1\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::controller(EmployeeController::class)
    ->middleware(['auth:sanctum', 'active'])
    ->prefix('workers')
    ->group(function (){
        Route::get('/', 'index');
        Route::post('/', 'store')->middleware(['admin']);
        Route::get('/{worker:uuid}', 'show')->middleware(['admin']);
        Route::patch('/{worker:uuid}', 'update')->middleware(['admin']);
        Route::delete('/{worker:uuid}', 'destroy')->middleware(['admin']);
    });
