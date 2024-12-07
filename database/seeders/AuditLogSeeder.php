<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuditLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auditLogs = [
            [
                'user_id' => 1, // Peter Parker (User ID 1)
                'action' => 'Created a new task',
                'ip_address' => '192.168.1.1',
                'description' => 'Peter created a task for web development.',
                'created_at' => Carbon::now()->subDays(3), // 3 days ago
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'user_id' => 2, // Tony Stark (User ID 2)
                'action' => 'Updated employee details',
                'ip_address' => '192.168.1.2',
                'description' => 'Tony updated employee records for new hire.',
                'created_at' => Carbon::now()->subDays(2), // 2 days ago
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => 3, // Steve Rogers (User ID 3)
                'action' => 'Approved a request',
                'ip_address' => '192.168.1.3',
                'description' => 'Steve approved an employee leave request.',
                'created_at' => Carbon::now()->subDay(), // 1 day ago
                'updated_at' => Carbon::now()->subDay(),
            ],
            [
                'user_id' => 4, // Natasha Romanoff (User ID 4)
                'action' => 'Escalated an issue',
                'ip_address' => '192.168.1.4',
                'description' => 'Natasha escalated a customer service issue.',
                'created_at' => Carbon::now()->subHours(12), // 12 hours ago
                'updated_at' => Carbon::now()->subHours(12),
            ],
            [
                'user_id' => 5, // Bruce Banner (User ID 5)
                'action' => 'Logged out',
                'ip_address' => '192.168.1.5',
                'description' => 'Bruce logged out from the system.',
                'created_at' => Carbon::now()->subHours(1), // 1 hour ago
                'updated_at' => Carbon::now()->subHours(1),
            ],
        ];

        // Insert audit logs into the database
        DB::table('audit_logs')->insert($auditLogs);
    }
}
