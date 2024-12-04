<?php

namespace Database\Seeders;

use App\Models\Leave;
use App\Models\Employee;
use App\Models\LeaveApplication;
use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 random leave entries
        Leave::factory()->count(50)->create();

        // Create 10 pending leave entries
        Leave::factory()
            ->count(10)
            ->pending()
            ->create();

        // Create 5 approved leave entries
        Leave::factory()
            ->count(5)
            ->approved()
            ->create();

        // Create 5 rejected leave entries
        Leave::factory()
            ->count(5)
            ->rejected()
            ->create();

        // Create leave for specific employees with a random leave application
        $employees = Employee::all();
        $leaveApplications = LeaveApplication::all();
        $leaveTypes = LeaveType::all();

        foreach ($employees as $employee) {
            Leave::factory()
                ->forEmployee($employee->id)
                ->forLeaveApplication($leaveApplications->random()->id)
                ->ofType($leaveTypes->random()->code) // Assign random leave type
                ->create();
        }

        // Create 5 single-day leave entries
        Leave::factory()
            ->count(5)
            ->singleDay('2023-05-15') // Specific single day leave
            ->create();

        // Create 3 leave entries with a specific date range
        Leave::factory()
            ->count(3)
            ->dateRange('2023-06-01', '2023-06-05') // Specific date range
            ->create();
    }
}
