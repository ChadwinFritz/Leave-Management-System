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
    public function run(): void
    {
        // Retrieve some existing employees and leave applications to link with the leaves
        $employee = Employee::first(); // Assuming at least one employee exists in the employees table
        $leaveApplication = LeaveApplication::first(); // Assuming at least one leave application exists
        $leaveType = LeaveType::first(); // Assuming at least one leave type exists

        // Creating a sample leave entry for an employee
        Leave::create([
            'employee_id' => $employee->id, // Linking to the first employee
            'leave_application_id' => $leaveApplication->id, // Linking to the first leave application
            'total_leave' => 5.00, // Total leave days
            'start_date' => '2024-12-01', // Start date of the leave
            'end_date' => '2024-12-05', // End date of the leave
            'start_half' => false, // Full day off on start date
            'end_half' => false, // Full day off on end date
            'on_date' => null, // Not a one-day leave
            'on_time' => null, // Not a time-specific leave
            'leave_type' => $leaveType->code, // Linking to the leave type (e.g., 'Sick')
        ]);

        // Creating another sample leave entry for the same employee but with half-day options
        Leave::create([
            'employee_id' => $employee->id, // Linking to the first employee
            'leave_application_id' => $leaveApplication->id, // Linking to the first leave application
            'total_leave' => 0.5, // Half-day leave
            'start_date' => '2024-12-10', // Start date of the leave
            'end_date' => '2024-12-10', // Same day leave
            'start_half' => true, // Half day on start date
            'end_half' => false, // Full day on end date
            'on_date' => '2024-12-10', // One-day leave
            'on_time' => null, // No specific time for the leave
            'leave_type' => $leaveType->code, // Linking to the leave type
        ]);

        // Example of time-specific leave (e.g., leave for a specific time period)
        Leave::create([
            'employee_id' => $employee->id, // Linking to the first employee
            'leave_application_id' => $leaveApplication->id, // Linking to the first leave application
            'total_leave' => 1.00, // Full day leave
            'start_date' => '2024-12-15', // Start date of the leave
            'end_date' => '2024-12-15', // Same day leave
            'start_half' => false, // Full day on start date
            'end_half' => false, // Full day on end date
            'on_date' => null, // Not a one-day leave
            'on_time' => '2024-12-15 09:00:00', // Specific time for the leave
            'leave_type' => $leaveType->code, // Linking to the leave type
        ]);
    }
}
