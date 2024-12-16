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
            [
                'name' => 'Wanda Maximoff',
                'email' => 'scarletwitch@marvel.com',
                'level' => 0,
                'username' => 'scarletwitch',
                'password' => Hash::make('password123'),
                'status' => 'pending',
                'is_approved' => false,
            ],
            [
                'name' => 'Clint Barton',
                'email' => 'hawkeye@marvel.com',
                'level' => 0,
                'username' => 'hawkeye',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'is_approved' => true,
            ],
            [
                'name' => 'Sam Wilson',
                'email' => 'falcon@marvel.com',
                'level' => 0,
                'username' => 'falcon',
                'password' => Hash::make('password123'),
                'status' => 'pending',
                'is_approved' => false,
            ],
            [
                'name' => 'Scott Lang',
                'email' => 'antman@marvel.com',
                'level' => 0,
                'username' => 'antman',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'is_approved' => true,
            ],
            [
                'name' => 'Hope Van Dyne',
                'email' => 'wasp@marvel.com',
                'level' => 0,
                'username' => 'wasp',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'is_approved' => true,
            ],
            [
                'name' => 'Stephen Strange',
                'email' => 'doctorstrange@marvel.com',
                'level' => 0,
                'username' => 'doctorstrange',
                'password' => Hash::make('password123'),
                'status' => 'pending',
                'is_approved' => false,
            ],
            [
                'name' => 'T\'Challa',
                'email' => 'blackpanther@marvel.com',
                'level' => 0,
                'username' => 'blackpanther',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'is_approved' => true,
            ],
            [
                'name' => 'Carol Danvers',
                'email' => 'captainmarvel@marvel.com',
                'level' => 0,
                'username' => 'captainmarvel',
                'password' => Hash::make('password123'),
                'status' => 'pending',
                'is_approved' => false,
            ],
            [
                'name' => 'Bucky Barnes',
                'email' => 'wintersoldier@marvel.com',
                'level' => 0,
                'username' => 'wintersoldier',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'is_approved' => true,
            ],
            [
                'name' => 'Nick Fury',
                'email' => 'nickfury@shield.com',
                'level' => 0,
                'username' => 'nickfury',
                'password' => Hash::make('password123'),
                'status' => 'pending',
                'is_approved' => false,
            ],
        ];

        // Insert users into the database
        DB::table('users')->insert($users);
    }
}
