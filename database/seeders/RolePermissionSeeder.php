<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::find(1)->givePermissionTo(Permission::all());
        Role::find(2)->givePermissionTo(Permission::whereNotIn('id', [2])->get());
        Role::find(3)->givePermissionTo(Permission::whereNotIn('id', [1, 2, 3])->get());
    }
}
