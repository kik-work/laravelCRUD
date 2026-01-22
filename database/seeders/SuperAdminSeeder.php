<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get superadmin role
        $role = Role::where('role_name', 'superadmin')->first();

        // Create or get the super admin user
        $user = User::firstOrCreate(
            ['email' => 'sa@email.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('12345678'),
            ]
        );

        // Attach role (safe to run multiple times)
        $user->roles()->syncWithoutDetaching([$role->id]);
    }
}
