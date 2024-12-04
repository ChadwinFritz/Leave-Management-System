<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class AuditLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 audit log entries with random data
        AuditLog::factory()->count(50)->create();

        // Example: Create specific audit logs with custom user and actions
        AuditLog::factory()->forUser(1)  // For a specific user with ID 1
            ->withAction('created')      // Set a custom action
            ->create();

        AuditLog::factory()->forUser(2)  // For a specific user with ID 2
            ->withAction('updated')      // Set a custom action
            ->fromIp('192.168.1.1')      // Set a specific IP address
            ->create();

        // You can continue to create additional logs with specific actions or data
        AuditLog::factory()->forUser(3)
            ->withAction('logged_in')
            ->fromIp('10.0.0.5')
            ->create();

        // Example: Create 10 audit logs with random user actions
        foreach (range(1, 10) as $i) {
            AuditLog::factory()->forUser(rand(1, 5))  // Random user ID between 1 and 5
                ->withAction($this->getRandomAction())  // Random action
                ->fromIp($this->getRandomIp())           // Random IP address
                ->create();
        }
    }

    /**
     * Helper method to get a random action.
     *
     * @return string
     */
    private function getRandomAction(): string
    {
        $actions = ['created', 'updated', 'deleted', 'logged_in', 'logged_out'];
        return $actions[array_rand($actions)];
    }

    /**
     * Helper method to get a random IP address.
     *
     * @return string
     */
    private function getRandomIp(): string
    {
        return long2ip(rand(0, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(0, 255));
    }
}
