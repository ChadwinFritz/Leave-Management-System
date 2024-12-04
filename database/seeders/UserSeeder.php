<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 random users with default attributes
        User::factory()->count(10)->create();

        // Create 5 approved users with unique emails and levels
        User::factory()
            ->count(5)
            ->approved()  // Use the approved state
            ->create([
                'email' => 'approved_' . Str::random(10) . '@example.com'  // Use Str::random for a unique email
            ]);

        // Create 3 pending users with unique emails
        User::factory()
            ->count(3)
            ->pending()  // Use the pending state
            ->create([
                'email' => 'pending_' . Str::random(10) . '@example.com'  // Use Str::random for a unique email
            ]);

        // Create 2 inactive users with unique emails
        User::factory()
            ->count(2)
            ->inactive()  // Use the inactive state
            ->create([
                'email' => 'inactive_' . Str::random(10) . '@example.com'  // Use Str::random for a unique email
            ]);

        // Create 2 users with specific levels (User, Admin, Super Admin, Supervisor)
        User::factory()
            ->count(2)
            ->withLevel(User::LEVEL_USER)  // Set user level to regular user
            ->create([
                'email' => 'user_' . Str::random(10) . '@example.com'  // Use Str::random for a unique email
            ]);

        User::factory()
            ->count(2)
            ->withLevel(User::LEVEL_ADMIN)  // Set user level to admin
            ->create([
                'email' => 'admin_' . Str::random(10) . '@example.com'  // Use Str::random for a unique email
            ]);

        User::factory()
            ->count(2)
            ->withLevel(User::LEVEL_SUPER_ADMIN)  // Set user level to super admin
            ->create([
                'email' => 'super_admin_' . Str::random(10) . '@example.com'  // Use Str::random for a unique email
            ]);

        User::factory()
            ->count(2)
            ->withLevel(User::LEVEL_SUPERVISOR)  // Set user level to supervisor
            ->create([
                'email' => 'supervisor_' . Str::random(10) . '@example.com'  // Use Str::random for a unique email
            ]);

        // Create 3 users with a specific name and unique email
        User::factory()
            ->count(3)
            ->withName('Custom User')  // Set a custom name for the users
            ->withEmail('customuser_' . Str::random(10) . '@example.com')  // Use Str::random for a unique email
            ->create();

        // Create 2 users with specific passwords and unique emails
        User::factory()
            ->count(2)
            ->withPassword('Custompassword@123')  // Set a custom password for the users
            ->create([
                'email' => 'password_user_' . Str::random(10) . '@example.com'  // Use Str::random for a unique email
            ]);

        // Create 3 users with specific usernames and unique emails
        User::factory()
            ->count(3)
            ->withUsername('customuser123')  // Set a custom username for the users
            ->create([
                'email' => 'username_user_' . Str::random(10) . '@example.com'  // Use Str::random for a unique email
            ]);
    }
}
