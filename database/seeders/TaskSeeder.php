<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Fix Web Application Bugs',
                'description' => 'Fix the bugs found in the latest web application release.',
                'status' => 'in_progress',
                'user_id' => 1, // Assigned to Peter Parker (User ID 1)
            ],
            [
                'title' => 'Prepare Annual Financial Report',
                'description' => 'Prepare the financial report for the year.',
                'status' => 'pending',
                'user_id' => 2, // Assigned to Tony Stark (User ID 2)
            ],
            [
                'title' => 'User Interface Redesign',
                'description' => 'Redesign the UI for the user dashboard for a better user experience.',
                'status' => 'in_progress',
                'user_id' => 3, // Assigned to Steve Rogers (User ID 3)
            ],
            [
                'title' => 'Conduct Employee Interviews',
                'description' => 'Conduct interviews for new candidates in the Human Resources department.',
                'status' => 'completed',
                'user_id' => 4, // Assigned to Natasha Romanoff (User ID 4)
            ],
            [
                'title' => 'Test New Features',
                'description' => 'Test the new features added to the web application.',
                'status' => 'pending',
                'user_id' => 5, // Assigned to Bruce Banner (User ID 5)
            ],
        ];

        // Insert tasks into the database
        DB::table('tasks')->insert($tasks);
    }
}
