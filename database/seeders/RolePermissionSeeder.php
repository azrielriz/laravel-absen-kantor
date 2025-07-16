<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $admin = Role::create(['name' => 'admin']);
    $user = Role::create(['name' => 'user']);

// Tambah Permission
    $manageAbsensi = Permission::create(['name' => 'manage absensi']);

// Assign permission ke role
    $admin->givePermissionTo($manageAbsensi);

// Assign role ke user
    $user = User::find(1); // ID 1
    $user->assignRole('admin');

    $user2 = User::find(2); // ID 2
    $user2->assignRole('user');
    }
}
