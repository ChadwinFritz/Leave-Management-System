<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Create 10 regular users (level 0)
        $level0Users = [
            ['name' => 'John Doe', 'email' => 'john.doe@example.com', 'username' => 'john_doe', 'password' => 'password123'],
            ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'username' => 'jane_smith', 'password' => 'password123'],
            ['name' => 'Michael Johnson', 'email' => 'michael.johnson@example.com', 'username' => 'michael_johnson', 'password' => 'password123'],
            ['name' => 'Sarah Brown', 'email' => 'sarah.brown@example.com', 'username' => 'sarah_brown', 'password' => 'password123'],
            ['name' => 'David Lee', 'email' => 'david.lee@example.com', 'username' => 'david_lee', 'password' => 'password123'],
            ['name' => 'Emily Davis', 'email' => 'emily.davis@example.com', 'username' => 'emily_davis', 'password' => 'password123'],
            ['name' => 'James Wilson', 'email' => 'james.wilson@example.com', 'username' => 'james_wilson', 'password' => 'password123'],
            ['name' => 'Sophia Martinez', 'email' => 'sophia.martinez@example.com', 'username' => 'sophia_martinez', 'password' => 'password123'],
            ['name' => 'Daniel Anderson', 'email' => 'daniel.anderson@example.com', 'username' => 'daniel_anderson', 'password' => 'password123'],
            ['name' => 'Olivia Thomas', 'email' => 'olivia.thomas@example.com', 'username' => 'olivia_thomas', 'password' => 'password123'],
        ];

        // Create 2 admin users (level 1)
        $level1Users = [
            ['name' => 'Alice Green', 'email' => 'alice.green@example.com', 'username' => 'alice_green', 'password' => 'adminpassword123'],
            ['name' => 'Robert White', 'email' => 'robert.white@example.com', 'username' => 'robert_white', 'password' => 'adminpassword123'],
        ];

        // Create 2 super admin users (level 2)
        $level2Users = [
            ['name' => 'Paul King', 'email' => 'paul.king@example.com', 'username' => 'paul_king', 'password' => 'superadminpassword123'],
            ['name' => 'Mary Scott', 'email' => 'mary.scott@example.com', 'username' => 'mary_scott', 'password' => 'superadminpassword123'],
        ];

        // Create 4 supervisor users (level 3)
        $level3Users = [
            ['name' => 'William Adams', 'email' => 'william.adams@example.com', 'username' => 'william_adams', 'password' => 'supervisorpassword123'],
            ['name' => 'Linda Clark', 'email' => 'linda.clark@example.com', 'username' => 'linda_clark', 'password' => 'supervisorpassword123'],
            ['name' => 'Joseph Lewis', 'email' => 'joseph.lewis@example.com', 'username' => 'joseph_lewis', 'password' => 'supervisorpassword123'],
            ['name' => 'Barbara Harris', 'email' => 'barbara.harris@example.com', 'username' => 'barbara_harris', 'password' => 'supervisorpassword123'],
        ];

        // Helper function to create users with common fields
        $this->createUsers($level0Users, 0);
        $this->createUsers($level1Users, 1);
        $this->createUsers($level2Users, 2);
        $this->createUsers($level3Users, 3);

        $this->command->info('Users have been seeded successfully!');
    }

    /**
     * Helper function to create users with level and common fields
     *
     * @param array $users
     * @param int $level
     * @return void
     */
    private function createUsers(array $users, int $level): void
    {
        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'level' => $level,
                'username' => $userData['username'],
                'password' => Hash::make($userData['password']),
                'status' => 'approved',
                'is_approved' => true,
            ]);
        }
    }
}
