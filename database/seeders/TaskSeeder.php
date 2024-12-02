<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Get all users (assuming tasks are created by users)
        $users = User::all();

        // Example task data
        $taskData = [
            ['title' => 'Complete project report', 'description' => 'Finish the annual project report and submit it by the end of the week.', 'status' => 'pending'],
            ['title' => 'Fix bug in login page', 'description' => 'Resolve the issue with the login page where users are unable to log in.', 'status' => 'in_progress'],
            ['title' => 'Prepare presentation for client', 'description' => 'Prepare a PowerPoint presentation for the upcoming client meeting.', 'status' => 'completed'],
            ['title' => 'Update website content', 'description' => 'Update the content on the homepage and blog section with the latest posts.', 'status' => 'pending'],
            ['title' => 'Conduct team meeting', 'description' => 'Schedule and lead a meeting with the team to discuss the project progress.', 'status' => 'in_progress']
        ];

        // Loop through each task data and create tasks for random users
        foreach ($taskData as $task) {
            // Randomly assign a user to the task (if there are users available)
            $assignedUser = $users->random();

            // Create the task
            Task::create([
                'title' => $task['title'],
                'description' => $task['description'],
                'status' => $task['status'],
                'user_id' => $assignedUser->id,
            ]);
        }

        // Optionally, print a message to indicate successful seeding
        $this->command->info('Tasks have been seeded successfully!');
    }
}
