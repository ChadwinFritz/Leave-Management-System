<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [
            [
                'user_id' => 1, // Peter Parker (User ID 1)
                'type' => 'leave_approval',
                'message' => 'Your leave request for December 25th has been approved.',
                'is_read' => false,
            ],
            [
                'user_id' => 2, // Tony Stark (User ID 2)
                'type' => 'announcement',
                'message' => 'The company will be closed on January 1st for the New Year holiday.',
                'is_read' => false,
            ],
            [
                'user_id' => 3, // Steve Rogers (User ID 3)
                'type' => 'reminder',
                'message' => 'Please submit your weekly report by end of day today.',
                'is_read' => false,
            ],
            [
                'user_id' => 4, // Natasha Romanoff (User ID 4)
                'type' => 'alert',
                'message' => 'Security breach detected. Please check your devices for any suspicious activity.',
                'is_read' => false,
            ],
            [
                'user_id' => 5, // Bruce Banner (User ID 5)
                'type' => 'reminder',
                'message' => 'Reminder: Team meeting scheduled for 10:00 AM tomorrow.',
                'is_read' => false,
            ],
        ];

        // Insert notifications into the database
        DB::table('notifications')->insert($notifications);
    }
}
