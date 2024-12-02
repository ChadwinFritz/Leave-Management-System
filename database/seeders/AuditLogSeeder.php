<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Get some sample users to associate with the logs
        $users = User::all();

        // Sample actions and IP addresses
        $actions = [
            'Login',
            'Logout',
            'Password Change',
            'Data Update',
            'Record Created',
            'Record Deleted',
        ];

        $ipAddresses = [
            '192.168.1.1',
            '172.16.0.1',
            '10.0.0.1',
            '2001:0db8:85a3:0000:0000:8a2e:0370:7334', // Example of an IPv6 address
        ];

        // Sample descriptions for each action
        $descriptions = [
            'User logged into the system.',
            'User logged out successfully.',
            'User changed their password.',
            'User updated a record in the system.',
            'New record was created in the database.',
            'Record was deleted by the user.',
        ];

        // Create some sample audit logs
        foreach (range(1, 20) as $index) {
            AuditLog::create([
                'user_id' => $users->random()->id, // Randomly assign a user
                'action' => $actions[array_rand($actions)], // Random action from the actions array
                'ip_address' => $ipAddresses[array_rand($ipAddresses)], // Random IP address from the array
                'description' => $descriptions[array_rand($descriptions)], // Random description
            ]);
        }

        // Optionally, print a message to indicate successful seeding
        $this->command->info('Audit logs have been seeded!');
    }
}
