<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'View Backend'
        ]);
        Permission::create([
            'name' => 'Manage Users'
        ]);
        Permission::create([
            'name' => 'Reports'
        ]);
        Permission::create([
            'name' => 'Create'
        ]);
        Permission::create([
            'name' => 'Read'
        ]);
        Permission::create([
            'name' => 'Update'
        ]);
        Permission::create([
            'name' => 'Delete'
        ]);
    }
}