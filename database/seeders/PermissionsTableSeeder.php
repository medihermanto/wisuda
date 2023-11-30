<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permission for role
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);
        // permission for permission
        Permission::create(['name' => 'permissions.index']);
        // permission for user
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);
        // permission for registration
        Permission::create(['name' => 'registrations.index']);
        Permission::create(['name' => 'registrations.create']);
        Permission::create(['name' => 'registrations.edit']);
        Permission::create(['name' => 'registrations.delete']);
        Permission::create(['name' => 'registrations.show']);
        // permission for faculty
        Permission::create(['name' => 'faculties.index']);
        Permission::create(['name' => 'faculties.create']);
        Permission::create(['name' => 'faculties.edit']);
        Permission::create(['name' => 'faculties.delete']);
        // permission for departement
        Permission::create(['name' => 'departements.index']);
        Permission::create(['name' => 'departements.create']);
        Permission::create(['name' => 'departements.edit']);
        Permission::create(['name' => 'departements.delete']);
    }
}
