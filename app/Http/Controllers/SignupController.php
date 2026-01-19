<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index(){
        $user = User::with('smartphone')->find(1);
        return response()->json([
            'success' => true,
            'message' => 'User data retrieved successfully',
            'data' => $user,
        ], 200);
    }
    public function register(RegisterUserRequest $request){
         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request-> password), // Always hash passwords
        ]);


        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }
}
