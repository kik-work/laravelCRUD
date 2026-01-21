<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Message;

class UserController extends Controller
{
    public function index()
    {
        $user = User::get();
        return response()->json([
            'success' => true,
            'message' => 'User data retrieved successfully',
            'data' => $user,
        ], 200);
    }
    public function show($user_id)
    {
        $user = User::with('roles', 'smartphone')->findOrFail($user_id);
        return response()->json([
            'success' => true,
            'message' => 'User data retrieved successfully',
            'data' => $user,
        ], 200);
    }
    public function attachStoreRoles($user_id, $role_id)
    {
        $user = User::findOrFail($user_id);
        $user->roles()->attach([$role_id]);

        return response()->json([
            'success' => true,
            'message' => 'Roles attached successfully',

        ], 200);
    }
    public function detachStoreRoles($user_id, $role_id)
    {
        $user = User::findOrFail($user_id);
        $user->roles()->detach([$role_id]);

        return response()->json([
            'success' => true,
            'message' => 'Roles detached successfully',

        ], 200);
    }
    public function syncStoreRoles(Request $request, $user_id)
    {
        $validated = $request->validate(
            ['role_id' => 'required|integer|exists:roles,id']
        );
        $user = User::findOrFail($user_id);
        $user->roles()->sync($validated['role_id']);
        return response()->json([
            'message' => 'User role synced successfully'
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => "Logged out Successfully"]);
    }
}
