<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class AuthController extends Controller
{

    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout');
    }

    public function login(LoginRequest $request)
    {

        $validateData = $request->validated();
        if (!Auth::attempt($validateData, true)) {
            // Authentication not passed...
            return baseJsonResponse(null, 401, false, 'Invalid login credentials');
        }

        $user = $request->user();
        $token = $user->createToken($user->name . ' Token')->plainTextToken;

        return baseJsonResponse([
            'token' => $token,
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}
