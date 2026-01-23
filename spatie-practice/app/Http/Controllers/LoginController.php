<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
        /** @var \App\Models\User $user */

        $user = Auth::user(); 
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        // Role-based redirect (or response)
        if ($user->hasRole('admin')) {
            return response()->json([
                'message' => 'Admin login successful',
                'redirect' => '/admin/dashboard',
                'token_type' => 'Bearer',
                'token' => $token,
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => 'User login successful',
            'redirect' => '/user/dashboard',

            'token_type' => 'Bearer',
            'token' => $token,
            'user' => $user,

        ]);
    }
}
