<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Peter Parker',
                'email' => 'spiderman@marvel.com',
                'level' => 0, // User
                'username' => 'spiderman',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'is_approved' => true,
            ],
            [
                'name' => 'Tony Stark',
                'email' => 'ironman@marvel.com',
                'level' => 2, // Super Admin
                'username' => 'ironman',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'is_approved' => true,
            ],
            [
                'name' => 'Steve Rogers',
                'email' => 'captainamerica@marvel.com',
                'level' => 1, // Admin
                'username' => 'cap',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'is_approved' => true,
            ],
            [
                'name' => 'Natasha Romanoff',
                'email' => 'blackwidow@marvel.com',
                'level' => 3, // Supervisor
                'username' => 'blackwidow',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'is_approved' => true,
            ],
            [
                'name' => 'Bruce Banner',
                'email' => 'hulk@marvel.com',
                'level' => 0, // User
                'username' => 'hulk',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'is_approved' => true,
            ],
        ];

        // Insert users into the database
        DB::table('users')->insert($users);
    }
}
