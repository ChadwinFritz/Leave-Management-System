<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaveRequests = [
            [
                'employee_id' => 1, // Employee: Peter Parker
                'leave_application_id' => 1, // Linked leave application
                'request_date' => '2024-01-01', // Date of request
                'start_date' => '2024-01-15', // Leave start date
                'end_date' => '2024-01-20', // Leave end date
                'reason' => 'Family vacation to spend quality time.',
                'status' => 'approved', // Request status
            ],
            [
                'employee_id' => 2, // Employee: Tony Stark
                'leave_application_id' => 2, // Linked leave application
                'request_date' => '2024-02-01',
                'start_date' => '2024-02-05',
                'end_date' => '2024-02-07',
                'reason' => 'Recovery from illness.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 3, // Employee: Steve Rogers
                'leave_application_id' => 3, // Linked leave application
                'request_date' => '2024-03-01',
                'start_date' => '2024-03-10',
                'end_date' => '2024-03-12',
                'reason' => 'Attending a funeral for a close friend.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 4, // Employee: Natasha Romanoff
                'leave_application_id' => 4, // Linked leave application
                'request_date' => '2024-03-15',
                'start_date' => '2024-03-20',
                'end_date' => '2024-03-20',
                'reason' => 'Personal errands and commitments.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 5, // Employee: Bruce Banner
                'leave_application_id' => 5, // Linked leave application
                'request_date' => '2024-03-20',
                'start_date' => '2024-04-01',
                'end_date' => '2024-04-10',
                'reason' => 'Attending a scientific conference.',
                'status' => 'pending',
            ],
            [
                'employee_id' => 1, // Employee: Peter Parker
                'leave_application_id' => 6, // Linked leave application
                'request_date' => '2024-04-20',
                'start_date' => '2024-05-01',
                'end_date' => '2024-05-01',
                'reason' => 'Observing May Day holiday.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 2, // Employee: Tony Stark
                'leave_application_id' => 7, // Linked leave application
                'request_date' => '2024-05-20',
                'start_date' => '2024-06-01',
                'end_date' => '2024-08-30',
                'reason' => 'Long-term rest and rejuvenation.',
                'status' => 'rejected',
            ],
            [
                'employee_id' => 4, // Employee: Natasha Romanoff
                'leave_application_id' => 8, // Linked leave application
                'request_date' => '2024-06-15',
                'start_date' => '2024-07-01',
                'end_date' => '2024-07-15',
                'reason' => 'Spending time with family.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 3, // Employee: Steve Rogers
                'leave_application_id' => 9, // Linked leave application
                'request_date' => '2024-12-01',
                'start_date' => '2025-01-01',
                'end_date' => '2025-12-31',
                'reason' => 'Extended mission leave.',
                'status' => 'pending',
            ],
            [
                'employee_id' => 5, // Employee: Bruce Banner
                'leave_application_id' => 10, // Linked leave application
                'request_date' => '2024-08-20',
                'start_date' => '2024-09-01',
                'end_date' => '2024-09-15',
                'reason' => 'Research leave for gamma experiments.',
                'status' => 'approved',
            ],
        ];

        // Insert leave requests into the database
        DB::table('leave_requests')->insert($leaveRequests);
    }
}
