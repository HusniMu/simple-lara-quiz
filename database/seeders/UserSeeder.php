<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => bcrypt('secret'),
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@user',
            'password' => bcrypt('secret'),
        ]);
    }
}