<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\APIBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends APIBaseController
{

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        // $request->session()->regenerate();

        $user = \auth()->user();
        $response['token'] =  $user->createToken('WebApp')->plainTextToken;
        $response['user'] =  $user;
        $user->update([
            'last_login' => now(),
        ]);


        return $this->successResponse($response, "log in successful");
    }


    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
