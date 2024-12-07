<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taskAssignments = [
            [
                'employee_id' => 1, // Assigned to Peter Parker (Employee ID 1)
                'task_id' => 1, // Assuming Task ID 1 exists (e.g., "Fix Web Application Bugs")
                'assigned_by' => 2, // Assigned by Tony Stark (User ID 2)
                'status' => 'in_progress',
                'due_date' => '2024-12-15 17:00:00',
            ],
            [
                'employee_id' => 2, // Assigned to Tony Stark (Employee ID 2)
                'task_id' => 2, // Assuming Task ID 2 exists (e.g., "Prepare Annual Financial Report")
                'assigned_by' => 3, // Assigned by Steve Rogers (User ID 3)
                'status' => 'pending',
                'due_date' => '2024-12-20 09:00:00',
            ],
            [
                'employee_id' => 3, // Assigned to Steve Rogers (Employee ID 3)
                'task_id' => 3, // Assuming Task ID 3 exists (e.g., "User Interface Redesign")
                'assigned_by' => 4, // Assigned by Natasha Romanoff (User ID 4)
                'status' => 'in_progress',
                'due_date' => '2024-12-25 17:00:00',
            ],
            [
                'employee_id' => 4, // Assigned to Natasha Romanoff (Employee ID 4)
                'task_id' => 4, // Assuming Task ID 4 exists (e.g., "Conduct Employee Interviews")
                'assigned_by' => 5, // Assigned by Bruce Banner (User ID 5)
                'status' => 'completed',
                'due_date' => '2024-12-05 12:00:00',
            ],
            [
                'employee_id' => 5, // Assigned to Bruce Banner (Employee ID 5)
                'task_id' => 5, // Assuming Task ID 5 exists (e.g., "Test New Features")
                'assigned_by' => 1, // Assigned by Peter Parker (User ID 1)
                'status' => 'pending',
                'due_date' => '2024-12-18 14:00:00',
            ],
        ];

        // Insert task assignments into the database
        DB::table('task_assignments')->insert($taskAssignments);
    }
}
