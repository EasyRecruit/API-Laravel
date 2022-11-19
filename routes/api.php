<?php

use App\Helpers\Routes\RouteHelper;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('throttle:10|60,1')->group(function () {
    // max of 10 requests per min for guest users and 60 requests per min for auth users

    RouteHelper::includeRouteFiles(__DIR__ . '/api/v1');
    Route::fallback(function (){
        abort(404, 'API resource not found');
    });

});
