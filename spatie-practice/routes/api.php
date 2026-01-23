<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login.store');
    Route::post('/signup', [SignupController::class, 'register'])->name('auth.register');
});

// Roles CRUD + assign/remove permissions
// Role routes
Route::apiResource('roles', RoleController::class);

// Permission routes
Route::apiResource('permissions', PermissionController::class);

Route::prefix('users')->group(function () {
    Route::post('/{id}/assign-role', [UserController::class, 'assignRole']);
    Route::post('/{id}/assign-permission', [UserController::class, 'assignPermission']);
    Route::get('/{id}/roles-permissions', [UserController::class, 'getRolesPermissions']);
});
