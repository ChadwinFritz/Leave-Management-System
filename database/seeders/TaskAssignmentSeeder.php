<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Employee;
use App\Models\User;
use App\Models\TaskAssignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Get a list of all employees, tasks, and users to assign tasks
        $employees = Employee::all();
        $tasks = Task::all();
        $users = User::all();

        // Define possible statuses for task assignments
        $statuses = ['pending', 'in_progress', 'completed'];

        // Assign random tasks to employees with a random user as the assignee
        foreach ($employees as $employee) {
            foreach (range(1, 3) as $index) {
                // Ensure there are tasks to assign
                if ($tasks->isNotEmpty()) {
                    $task = $tasks->random(); // Pick a random task from the tasks list
                    $assignedBy = $users->random(); // Assign the task by a random user

                    TaskAssignment::create([
                        'employee_id' => $employee->id,
                        'task_id' => $task->id,
                        'assigned_by' => $assignedBy->id,
                        'status' => $statuses[array_rand($statuses)], // Random status for the task assignment
                        'due_date' => now()->addDays(rand(1, 10)), // Set a random due date within the next 1-10 days
                    ]);
                }
            }
        }

        // Optionally, print a message to indicate successful seeding
        $this->command->info('Task assignments have been seeded!');
    }
}
