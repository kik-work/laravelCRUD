<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    // Assign role(s) to user
    public function assignRole(Request $request, $id)
    {
        $request->validate([
            'roles' => 'required|array'
        ]);

        $user = User::findOrFail($id);
        $user->syncRoles($request->roles); 

        return response()->json([
            'message' => 'Roles assigned successfully',
            'roles' => $user->roles
        ]);
    }

    // Assign permission(s) directly to user
    public function assignPermission(Request $request, $id)
    {
        $request->validate([
            'permissions' => 'required|array'
        ]);

        $user = User::findOrFail($id);
        $user->syncPermissions($request->permissions); // replaces existing permissions

        return response()->json([
            'message' => 'Permissions assigned successfully',
            'permissions' => $user->permissions
        ]);
    }

    // Optional: Get user roles and permissions
    public function getRolesPermissions($id)
    {
        $user = User::with('roles', 'permissions')->findOrFail($id);

        return response()->json([
            'user' => $user->name,
            'roles' => $user->roles,
            'permissions' => $user->permissions
        ]);
    }
}
