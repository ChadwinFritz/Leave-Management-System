<?php

namespace Database\Seeders;

use App\Models\LeaveApplication;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LeaveApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Retrieve employees and leave types to associate with applications
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();

        // Loop through each employee and create sample leave applications
        foreach ($employees as $employee) {
            // Select a random leave type
            $leaveType = $leaveTypes->random();

            // Generate a random start and end date for the leave
            $startDate = Carbon::now()->addDays(rand(1, 30));  // Random start date within the next 30 days
            $endDate = $startDate->addDays(rand(1, 5));  // Random end date within 1-5 days after the start date

            // Determine if the leave is half-day or full-day
            $startHalf = rand(0, 1) == 1;
            $endHalf = rand(0, 1) == 1;

            // Calculate the total number of leave days
            $numberOfDays = $startDate->diffInDays($endDate) + ($startHalf ? 0.5 : 0) + ($endHalf ? 0.5 : 0);

            // Create the leave application
            LeaveApplication::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveType->id,
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'start_half' => $startHalf,
                'end_half' => $endHalf,
                'number_of_days' => $numberOfDays,
                'status' => 'pending',  // Default status set to 'pending'
                'reason' => 'Personal reasons',  // Example reason
                'total_leave' => $numberOfDays,
            ]);

            // Optionally, create some rejected applications
            if (rand(0, 1) == 1) {
                LeaveApplication::create([
                    'employee_id' => $employee->id,
                    'leave_type_id' => $leaveType->id,
                    'start_date' => $startDate->toDateString(),
                    'end_date' => $endDate->toDateString(),
                    'start_half' => $startHalf,
                    'end_half' => $endHalf,
                    'number_of_days' => $numberOfDays,
                    'status' => 'rejected',  // Set to 'rejected'
                    'reason' => 'Personal reasons',
                    'rejection_reason' => 'Insufficient leave balance',  // Rejection reason
                    'total_leave' => 0,
                ]);
            }
        }
    }
}
