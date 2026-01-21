<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = Permission::get();

        return response()->json([
            'success' => true,
            'message' => 'Permissions data fetched',
            'data' => $permission
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'permission_name' => 'required|string|max:255',
        ]);

        $permission = Permission::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'New permission created',
            'data' => $permission,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'permission_name' => 'required|string|max:255',
        ]);

        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json([
                'error' => true,
                'message' => "Permission Id : {$id} not found."
            ]);
        }

        $permission->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Permission updated',
            'data' => $permission,
        ]);
    }
    public function syncwithoutdetach(Request $request, $role_id)
    {
        $validation = $request->validate([
            'permission_id' => 'required|array',
            'permission_id.*' => 'exists:permissions,id'
        ]);

        $role = Role::find($role_id);
        if (!$role) {
            return response()->json(
                [
                    'error' => true,
                    'message' => "Role ID {$role} not found"

                ]
            );
        }
        $role->permissions()->syncWithoutDetaching($validation['permission_id']);
        return response()->json([
            'success' => true,
            "message" => "Role ID {$role_id} has been added with permission Ids: " . implode(',', $validation['permission_id']),
        ]);
    }
      public function detach(Request $request, $role_id)
    {
        $validation = $request->validate([
            'permission_id' => 'required|array',
            'permission_id.*' => 'exists:permissions,id'
        ]);

        $role = Role::find($role_id);
        if (!$role) {
            return response()->json(
                [
                    'error' => true,
                    'message' => "Role ID {$role} not found"

                ]
            );
        }
        $role->permissions()->detach($validation['permission_id']);
        return response()->json([
            'success' => true,
            "message" => "Role ID {$role_id} has been detached with permission Ids: " . implode(',', $validation['permission_id']),
        ]);
    }
}
