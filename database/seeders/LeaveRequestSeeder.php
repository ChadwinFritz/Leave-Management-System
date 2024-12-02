<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\LeaveApplication;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Get all employees and leave applications from the database
        $employees = Employee::all();
        $leaveApplications = LeaveApplication::all();

        // Example leave reasons
        $leaveReasons = [
            'Personal time off',
            'Sick leave',
            'Vacation',
            'Family emergency',
            'Medical treatment',
            'Wedding'
        ];

        // Loop through each employee and assign random leave requests
        foreach ($employees as $employee) {
            // Choose a random leave application for the employee
            $leaveApplication = $leaveApplications->random();

            // Generate random leave dates within the next 30 days
            $startDate = Carbon::now()->addDays(rand(1, 30))->toDateString();
            $endDate = Carbon::parse($startDate)->addDays(rand(1, 5))->toDateString(); // Leave duration from 1 to 5 days

            // Generate a random leave reason
            $reason = $leaveReasons[array_rand($leaveReasons)];

            // Random leave request status
            $status = ['pending', 'approved', 'rejected'][rand(0, 2)];

            // Create the leave request
            $employee->leaveRequests()->create([
                'leave_application_id' => $leaveApplication->id,
                'request_date' => Carbon::now()->toDateString(),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'reason' => $reason,
                'status' => $status,
            ]);
        }

        // Optionally, print a message to indicate successful seeding
        $this->command->info('Leave requests have been seeded successfully!');
    }
}
