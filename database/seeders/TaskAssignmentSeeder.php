<?php

namespace Database\Seeders;

use App\Models\TaskAssignment;
use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use App\Models\Supervisor;
use Illuminate\Database\Seeder;

class TaskAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 random task assignments with default states
        TaskAssignment::factory()->count(5)->create();

        // Create 3 task assignments with a specific status (e.g., pending)
        TaskAssignment::factory()
            ->count(3)
            ->pending()  // Assign 'pending' status
            ->create();

        // Create 3 task assignments with a specific status (e.g., in progress)
        TaskAssignment::factory()
            ->count(3)
            ->inProgress()  // Assign 'in progress' status
            ->create();

        // Create 2 completed task assignments
        TaskAssignment::factory()
            ->count(2)
            ->completed()  // Assign 'completed' status
            ->create();

        // Create 2 archived task assignments
        TaskAssignment::factory()
            ->count(2)
            ->archived()  // Assign 'archived' status
            ->create();

        // Create 4 task assignments assigned to specific employees
        $employeeIds = Employee::pluck('id')->take(4);  // Get first 4 employee IDs
        foreach ($employeeIds as $employeeId) {
            TaskAssignment::factory()
                ->assignedToEmployee($employeeId)  // Assign to a specific employee
                ->count(1)
                ->create();
        }

        // Create 3 task assignments for specific tasks
        $taskIds = Task::pluck('id')->take(3);  // Get first 3 task IDs
        foreach ($taskIds as $taskId) {
            TaskAssignment::factory()
                ->forTask($taskId)  // Assign to a specific task
                ->count(1)
                ->create();
        }

        // Create 3 task assignments assigned by specific users
        $userIds = User::pluck('id')->take(3);  // Get first 3 user IDs
        foreach ($userIds as $userId) {
            TaskAssignment::factory()
                ->assignedByUser($userId)  // Assign by a specific user
                ->count(1)
                ->create();
        }

        // Create 2 task assignments assigned by specific supervisors
        $supervisorIds = Supervisor::pluck('id')->take(2);  // Get first 2 supervisor IDs
        foreach ($supervisorIds as $supervisorId) {
            TaskAssignment::factory()
                ->assignedBySupervisor($supervisorId)  // Assign by a specific supervisor
                ->count(1)
                ->create();
        }

        // Create 3 task assignments with specific due dates
        $dueDates = [
            now()->addDays(2),
            now()->addDays(5),
            now()->addDays(7),
        ];
        foreach ($dueDates as $dueDate) {
            TaskAssignment::factory()
                ->withDueDate($dueDate)  // Assign with a specific due date
                ->count(1)
                ->create();
        }
    }
}
