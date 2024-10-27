<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                'password' => Hash::make('Alice@123'),
                'level' => 0,
                'status' => 'active',
                'is_approved' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Charlie Thompson',
                'email' => 'charlie.thompson@example.com',
                'username' => 'charliethompson',
                'password' => Hash::make('Charlie@123'),
                'level' => 0,
                'status' => 'pending',
                'is_approved' => false, // Not approved
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sophia Garcia',
                'email' => 'sophia.garcia@example.com',
                'username' => 'sophiagarcia',
                'password' => Hash::make('Sophia@123'),
                'level' => 0,
                'status' => 'active',
                'is_approved' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Liam Lee',
                'email' => 'liam.lee@example.com',
                'username' => 'liamlee',
                'password' => Hash::make('Liam@123'),
                'level' => 0,
                'status' => 'pending',
                'is_approved' => false, // Not approved
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Olivia Martinez',
                'email' => 'olivia.martinez@example.com',
                'username' => 'oliviamartinez',
                'password' => Hash::make('Olivia@123'),
                'level' => 0,
                'status' => 'pending',
                'is_approved' => false, // Not approved
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert users into the database using updateOrInsert to avoid duplicates
        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']], // Unique identifier to check for duplicates
                $user
            );
        }
    }
}
