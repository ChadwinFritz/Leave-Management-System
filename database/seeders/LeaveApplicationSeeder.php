<?php

namespace Database\Seeders;

use App\Models\LeaveApplication;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 random leave applications
        LeaveApplication::factory()->count(50)->create();

        // Create 10 pending leave applications
        LeaveApplication::factory()
            ->count(10)
            ->pending()
            ->create();

        // Create 5 approved leave applications
        LeaveApplication::factory()
            ->count(5)
            ->approved()
            ->create();

        // Create 5 rejected leave applications
        LeaveApplication::factory()
            ->count(5)
            ->rejected()
            ->create();

        // Create 3 leave applications for specific employees and leave types
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();

        foreach ($employees as $employee) {
            LeaveApplication::factory()
                ->forEmployee($employee->id)
                ->ofType($leaveTypes->random()->id) // Assign random leave type
                ->create();
        }

        // Create 5 single-day leave applications
        LeaveApplication::factory()
            ->count(5)
            ->singleDay('2023-05-15') // Specific date
            ->create();

        // Create 3 leave applications with a specific date range
        LeaveApplication::factory()
            ->count(3)
            ->dateRange('2023-06-01', '2023-06-05') // Date range example
            ->create();
    }
}
