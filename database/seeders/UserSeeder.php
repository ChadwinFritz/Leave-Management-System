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
        // Sample data for level 0 users with mixed approval statuses
        $users = [
            [
                'name' => 'Alice Brown',
                'email' => 'alice.brown@example.com',
                'username' => 'alicebrown',
                'password' => Hash::make('alicepass123'),
                'level' => 0,
                'status' => 'active',
                'is_approved' => true,
            ],
            [
                'name' => 'Charlie Thompson',
                'email' => 'charlie.thompson@example.com',
                'username' => 'charliethompson',
                'password' => Hash::make('charliepass123'),
                'level' => 0,
                'status' => 'pending',
                'is_approved' => false, // Not approved
            ],
            [
                'name' => 'Sophia Garcia',
                'email' => 'sophia.garcia@example.com',
                'username' => 'sophiagarcia',
                'password' => Hash::make('sophiapass123'),
                'level' => 0,
                'status' => 'active',
                'is_approved' => true,
            ],
            [
                'name' => 'Liam Lee',
                'email' => 'liam.lee@example.com',
                'username' => 'liamlee',
                'password' => Hash::make('liampass123'),
                'level' => 0,
                'status' => 'pending',
                'is_approved' => false, // Not approved
            ],
            [
                'name' => 'Olivia Martinez',
                'email' => 'olivia.martinez@example.com',
                'username' => 'oliviamartinez',
                'password' => Hash::make('oliviapass123'),
                'level' => 0,
                'status' => 'pending',
                'is_approved' => false, // Not approved
            ],
        ];

        // Insert users into the database
        DB::table('users')->insert($users);
    }
}
