<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'username' => 'admin', // Ensure this is unique
            'password' => Hash::make('password'), // Replace with a secure password
            'level' => 1, // Setting the level to 1 for Admin role
        ]);

        // Optionally, create a Super Admin user
        User::create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@example.com',
            'username' => 'superadmin', // Ensure this is unique
            'password' => Hash::make('superpassword'), // Replace with a secure password
            'level' => 2, // Setting the level to 2 for Super Admin role
        ]);
    }
}
