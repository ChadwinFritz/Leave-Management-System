<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for level 0 users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'username' => 'johndoe',
                'password' => Hash::make('password123'),
                'level' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'username' => 'janesmith',
                'password' => Hash::make('password123'),
                'level' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Robert Johnson',
                'email' => 'robert.johnson@example.com',
                'username' => 'robertjohnson',
                'password' => Hash::make('password123'),
                'level' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'username' => 'emilydavis',
                'password' => Hash::make('password123'),
                'level' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@example.com',
                'username' => 'michaelbrown',
                'password' => Hash::make('password123'),
                'level' => 0,
                'status' => 'active',
            ],
        ];

        // Insert users into the database
        DB::table('users')->insert($users);
    }
}
