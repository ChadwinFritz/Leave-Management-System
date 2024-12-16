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
                'leave_type_id' => 1, // Annual Leave
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-20',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 5.0,
                'reason' => 'Family vacation.',
                'status' => 'approved',
                'total_leave' => 5.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 2, // Employee: Tony Stark
                'leave_type_id' => 2, // Sick Leave
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
                'leave_type_id' => 5, // Bereavement Leave
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
                'leave_type_id' => 6, // Compensatory Leave
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
                'leave_type_id' => 8, // Study Leave
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
                'employee_id' => 6, // Employee: Wanda Maximoff
                'leave_type_id' => 1, // Annual Leave
                'start_date' => '2024-05-15',
                'end_date' => '2024-05-20',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 5.0,
                'reason' => 'Family time.',
                'status' => 'approved',
                'total_leave' => 5.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 7, // Employee: Clint Barton
                'leave_type_id' => 4, // Paternity Leave
                'start_date' => '2024-06-01',
                'end_date' => '2024-06-15',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 15.0,
                'reason' => 'Family bonding time.',
                'status' => 'approved',
                'total_leave' => 15.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 8, // Employee: Sam Wilson
                'leave_type_id' => 7, // Unpaid Leave
                'start_date' => '2024-07-10',
                'end_date' => '2024-07-20',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 10.0,
                'reason' => 'Volunteer work.',
                'status' => 'approved',
                'total_leave' => 10.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 9, // Employee: Scott Lang
                'leave_type_id' => 3, // Parental Leave
                'start_date' => '2024-08-01',
                'end_date' => '2024-08-14',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 14.0,
                'reason' => 'Time with daughter.',
                'status' => 'approved',
                'total_leave' => 14.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 10, // Employee: Hope Van Dyne
                'leave_type_id' => 2, // Sick Leave
                'start_date' => '2024-09-05',
                'end_date' => '2024-09-08',
                'start_half' => false,
                'end_half' => true,
                'number_of_days' => 3.5,
                'reason' => 'Health recovery.',
                'status' => 'approved',
                'total_leave' => 3.5,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 11, // Employee: Stephen Strange
                'leave_type_id' => 8, // Leave Type: Study Leave
                'start_date' => '2024-10-01',
                'end_date' => '2024-10-10',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 10.0,
                'reason' => 'Advanced training in mystic arts.',
                'status' => 'approved',
                'total_leave' => 10.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 12, // Employee: T'Challa
                'leave_type_id' => 10, // Leave Type: Sabbatical Leave
                'start_date' => '2025-01-01',
                'end_date' => '2025-06-30',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 180.0,
                'reason' => 'Royal duties in Wakanda.',
                'status' => 'pending',
                'total_leave' => 180.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 13, // Employee: Carol Danvers
                'leave_type_id' => 4, // Leave Type: Paternity Leave (mocked for testing)
                'start_date' => '2024-11-01',
                'end_date' => '2024-11-15',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 15.0,
                'reason' => 'Mission recovery time.',
                'status' => 'approved',
                'total_leave' => 15.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 14, // Employee: Bucky Barnes
                'leave_type_id' => 9, // Leave Type: Public Holiday Leave
                'start_date' => '2024-12-25',
                'end_date' => '2024-12-25',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 1.0,
                'reason' => 'Christmas holiday.',
                'status' => 'approved',
                'total_leave' => 1.0,
                'rejection_reason' => null,
            ],
            [
                'employee_id' => 15, // Employee: Nick Fury
                'leave_type_id' => 1, // Leave Type: Annual Leave
                'start_date' => '2024-12-01',
                'end_date' => '2024-12-05',
                'start_half' => false,
                'end_half' => false,
                'number_of_days' => 5.0,
                'reason' => 'Strategic planning retreat.',
                'status' => 'approved',
                'total_leave' => 5.0,
                'rejection_reason' => null,
            ],
        ];

        // Insert leave applications into the database
        DB::table('leave_applications')->insert($leaveApplications);
    }
}
