<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'Admin']);
        $publicRole = Role::create(['name' => 'Public User']);

        $userAccess = Permission::create(['name' => 'user_access']);

        $adminRole->givePermissionTo($userAccess);

        $publicUser = User::firstOrCreate([
            'email' => 'user@example.com'
        ], [
            'name' => 'Public User',
            'password' => Hash::make('password')  
        ]);

        $adminUser = User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password')  
        ]);

        $publicUser->assignRole('Public User');
        $adminUser->assignRole('Admin');
    }
}
