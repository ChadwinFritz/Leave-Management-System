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
    public function run()
    {
        // Create 10 random notifications
        Notification::factory()->count(10)->create();

        // Create 5 unread notifications
        Notification::factory()
            ->count(5)
            ->unread()  // Mark as unread
            ->create();

        // Create 5 read notifications
        Notification::factory()
            ->count(5)
            ->read()  // Mark as read
            ->create();

        // Create 3 leave approval notifications for specific users
        Notification::factory()
            ->count(3)
            ->withType('leave_approval')  // Set the type to 'leave_approval'
            ->forUser(User::factory()->create()->id)  // Assign a specific user
            ->create();

        // Create 3 reminder notifications for specific users
        Notification::factory()
            ->count(3)
            ->withType('reminder')  // Set the type to 'reminder'
            ->forUser(User::factory()->create()->id)  // Assign a specific user
            ->create();

        // Create 2 alert notifications with a custom message
        Notification::factory()
            ->count(2)
            ->withType('alert')  // Set the type to 'alert'
            ->withMessage('This is a custom alert message.')  // Set a specific message
            ->create();

        // Create 2 announcement notifications with a custom message
        Notification::factory()
            ->count(2)
            ->withType('announcement')  // Set the type to 'announcement'
            ->withMessage('Important announcement: System maintenance scheduled.')  // Custom announcement
            ->create();
    }
}
