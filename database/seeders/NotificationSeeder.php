<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Get all users to assign notifications
        $users = User::all();

        // Define possible types for notifications
        $types = ['leave_approval', 'reminder', 'alert', 'announcement'];

        // Define some example messages for each type of notification
        $messages = [
            'leave_approval' => 'Your leave request has been approved.',
            'reminder' => 'Reminder: You have an upcoming meeting tomorrow.',
            'alert' => 'Alert: Your password will expire soon. Please update it.',
            'announcement' => 'Announcement: The office will be closed on Friday.',
        ];

        // Loop through users to generate random notifications
        foreach ($users as $user) {
            foreach (range(1, 5) as $index) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => $types[array_rand($types)], // Randomly assign a notification type
                    'message' => $messages[$types[array_rand($types)]], // Assign a corresponding message
                    'is_read' => false, // Initially unread
                ]);
            }
        }

        // Optionally, print a message to indicate successful seeding
        $this->command->info('Notification data has been seeded!');
    }
}
