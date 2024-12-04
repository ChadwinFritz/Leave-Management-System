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
    public function run()
    {
        // Create 5 random tasks with default states
        Task::factory()->count(5)->create();

        // Create 3 tasks with a specific status (e.g., completed)
        Task::factory()
            ->count(3)
            ->completed()  // Set status to 'completed'
            ->create();

        // Create 3 tasks with a specific status (e.g., in-progress)
        Task::factory()
            ->count(3)
            ->inProgress()  // Set status to 'in-progress'
            ->create();

        // Create 2 pending tasks
        Task::factory()
            ->count(2)
            ->pending()  // Set status to 'pending'
            ->create();

        // Create 2 archived tasks
        Task::factory()
            ->count(2)
            ->archived()  // Set status to 'archived'
            ->create();

        // Create 4 tasks assigned to specific users
        $userIds = User::pluck('id')->take(4);  // Get first 4 user IDs
        foreach ($userIds as $userId) {
            Task::factory()
                ->assignedToUser($userId)  // Assign to a specific user
                ->count(1)
                ->create();
        }

        // Create 2 tasks with custom titles and descriptions
        Task::factory()
            ->count(2)
            ->withTitleAndDescription('Task 1', 'Description for Task 1')
            ->create();
        
        Task::factory()
            ->count(2)
            ->withTitleAndDescription('Task 2', 'Description for Task 2')
            ->create();
    }
}
