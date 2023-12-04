<?php

namespace App\Http\Controllers\Api\UserPanel\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPanel\Auth\LoginRequest;
use App\Http\Requests\UserPanel\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful.',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid login credentials.',
        ], 401);
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create($request->validated());

            return response()->json([
                'message' => 'Login successful.',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            info($e);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
