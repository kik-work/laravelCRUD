<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();

        return response()->json([
            'success' => true,
            'message' => 'Role data fetched!',
            'data'    => $roles
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate(
            ['role_name' => 'required|string|max:255']
        );
        $role = Role::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Role data created!',
            'data'    => $role
        ]);
    }
    public function show($id)
    {

        $role = Role::with('permissions')->find($id);
        if (!$role) {
            return response()->json([
                'error' => true,
                'message' => "Unable to find out Role id:{$id}"
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => "Role with permission data fetched",
            'data' => $role
        ]);
    }
}
