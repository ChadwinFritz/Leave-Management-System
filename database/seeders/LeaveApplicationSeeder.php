<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaveApplications = [
            [
                'employee_id' => 1, // Employee: Peter Parker
                'leave_type_id' => 1, // Leave Type: Annual Leave
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-20',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 5.0,
                'reason' => 'Family vacation.',
                'status' => 'approved',
                'total_leave' => 5.0,
                'rejection_reason' => null, // Ensure this field exists
            ],
            [
                'employee_id' => 2, // Employee: Tony Stark
                'leave_type_id' => 2, // Leave Type: Sick Leave
                'start_date' => '2024-02-05',
                'end_date' => '2024-02-07',
                'start_half' => true,
                'end_half' => false,
                'number_of_days' => 2.5,
                'reason' => 'Medical recovery.',
                'status' => 'approved',
                'total_leave' => 2.5,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 3, // Employee: Steve Rogers
                'leave_type_id' => 5, // Leave Type: Bereavement Leave
                'start_date' => '2024-03-10',
                'end_date' => '2024-03-12',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 3.0,
                'reason' => 'Attending a funeral.',
                'status' => 'approved',
                'total_leave' => 3.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 4, // Employee: Natasha Romanoff
                'leave_type_id' => 6, // Leave Type: Compensatory Leave
                'start_date' => '2024-03-20',
                'end_date' => '2024-03-20',
                'start_half' => false,
                'end_half' => true,
                'number_of_days' => 0.5,
                'reason' => 'Personal errands.',
                'status' => 'approved',
                'total_leave' => 0.5,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 5, // Employee: Bruce Banner
                'leave_type_id' => 8, // Leave Type: Study Leave
                'start_date' => '2024-04-01',
                'end_date' => '2024-04-10',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 10.0,
                'reason' => 'Attending a scientific conference.',
                'status' => 'pending',
                'total_leave' => 10.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 1, // Employee: Peter Parker
                'leave_type_id' => 9, // Leave Type: Public Holiday Leave
                'start_date' => '2024-05-01',
                'end_date' => '2024-05-01',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 1.0,
                'reason' => 'May Day holiday.',
                'status' => 'approved',
                'total_leave' => 1.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 2, // Employee: Tony Stark
                'leave_type_id' => 3, // Leave Type: Maternity Leave (mocked for testing)
                'start_date' => '2024-06-01',
                'end_date' => '2024-08-30',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 90.0,
                'reason' => 'Long-term rest (mocked).',
                'status' => 'rejected',
                'rejection_reason' => 'Inapplicable leave type.',
                'total_leave' => 0.0,
            ],
            [
                'employee_id' => 4, // Employee: Natasha Romanoff
                'leave_type_id' => 4, // Leave Type: Paternity Leave (mocked for testing)
                'start_date' => '2024-07-01',
                'end_date' => '2024-07-15',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 15.0,
                'reason' => 'Family bonding time.',
                'status' => 'approved',
                'total_leave' => 15.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 3, // Employee: Steve Rogers
                'leave_type_id' => 10, // Leave Type: Sabbatical Leave
                'start_date' => '2025-01-01',
                'end_date' => '2025-12-31',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 365.0,
                'reason' => 'Extended mission leave.',
                'status' => 'pending',
                'total_leave' => 365.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 5, // Employee: Bruce Banner
                'leave_type_id' => 7, // Leave Type: Unpaid Leave
                'start_date' => '2024-09-01',
                'end_date' => '2024-09-15',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 15.0,
                'reason' => 'Research leave.',
                'status' => 'approved',
                'total_leave' => 15.0,
                'rejection_reason' => null,
            ],
        ];

        // Insert leave applications into the database
        DB::table('leave_applications')->insert($leaveApplications);
    }
}
