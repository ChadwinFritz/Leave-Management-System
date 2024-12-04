<?php

namespace Database\Seeders;

use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\LeaveApplication;
use App\Models\Supervisor;
use Illuminate\Database\Seeder;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 random leave requests
        LeaveRequest::factory()->count(50)->create();

        // Create 10 pending leave requests
        LeaveRequest::factory()
            ->count(10)
            ->pending()
            ->create();

        // Create 5 approved leave requests
        LeaveRequest::factory()
            ->count(5)
            ->approved()
            ->create();

        // Create 5 rejected leave requests
        LeaveRequest::factory()
            ->count(5)
            ->rejected()
            ->create();

        // Create leave requests with assigned supervisors
        $employees = Employee::all();
        $supervisors = Supervisor::all();  // Ensure you have some supervisor records in the DB

        foreach ($employees as $employee) {
            LeaveRequest::factory()
                ->withSupervisor($supervisors->random()->id)  // Assign a random supervisor
                ->forEmployee($employee->id)  // Assign the employee
                ->forLeaveApplication(LeaveApplication::inRandomOrder()->first()->id)  // Random leave application
                ->create();
        }

        // Create leave requests with specific date ranges
        LeaveRequest::factory()
            ->count(3)
            ->dateRange('2024-01-01', '2024-01-10')  // Specific date range
            ->create();

        LeaveRequest::factory()
            ->count(2)
            ->dateRange('2024-06-01', '2024-06-05')  // Another specific date range
            ->create();
    }
}
