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
                'employee_id' => 6, // Employee: Wanda Maximoff
                'leave_application_id' => 6, // Linked leave application
                'request_date' => '2024-05-01',
                'start_date' => '2024-05-15',
                'end_date' => '2024-05-20',
                'reason' => 'Spending quality time with family.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 7, // Employee: Clint Barton
                'leave_application_id' => 7, // Linked leave application
                'request_date' => '2024-05-20',
                'start_date' => '2024-06-01',
                'end_date' => '2024-06-15',
                'reason' => 'Family bonding and caregiving.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 8, // Employee: Sam Wilson
                'leave_application_id' => 8, // Linked leave application
                'request_date' => '2024-06-10',
                'start_date' => '2024-07-10',
                'end_date' => '2024-07-20',
                'reason' => 'Volunteering at a community event.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 9, // Employee: Scott Lang
                'leave_application_id' => 9, // Linked leave application
                'request_date' => '2024-07-25',
                'start_date' => '2024-08-01',
                'end_date' => '2024-08-14',
                'reason' => 'Spending time with daughter during her summer break.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 10, // Employee: Hope Van Dyne
                'leave_application_id' => 10, // Linked leave application
                'request_date' => '2024-09-01',
                'start_date' => '2024-09-05',
                'end_date' => '2024-09-08',
                'reason' => 'Health recovery and rest.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 11, // Employee: Stephen Strange
                'leave_application_id' => 11, // Linked leave application
                'request_date' => '2024-09-15',
                'start_date' => '2024-10-01',
                'end_date' => '2024-10-10',
                'reason' => 'Attending a mystical arts training session.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 12, // Employee: T’Challa
                'leave_application_id' => 12, // Linked leave application
                'request_date' => '2024-12-15',
                'start_date' => '2025-01-01',
                'end_date' => '2025-06-30',
                'reason' => 'Royal duties and leadership in Wakanda.',
                'status' => 'pending',
            ],
            [
                'employee_id' => 13, // Employee: Carol Danvers
                'leave_application_id' => 13, // Linked leave application
                'request_date' => '2024-10-20',
                'start_date' => '2024-11-01',
                'end_date' => '2024-11-15',
                'reason' => 'Rest and recuperation from mission.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 14, // Employee: Bucky Barnes
                'leave_application_id' => 14, // Linked leave application
                'request_date' => '2024-12-01',
                'start_date' => '2024-12-25',
                'end_date' => '2024-12-25',
                'reason' => 'Observing the Christmas holiday.',
                'status' => 'approved',
            ],
            [
                'employee_id' => 15, // Employee: Nick Fury
                'leave_application_id' => 15, // Linked leave application
                'request_date' => '2024-11-20',
                'start_date' => '2024-12-01',
                'end_date' => '2024-12-05',
                'reason' => 'Strategic retreat and planning session.',
                'status' => 'approved',
            ],
        ];

        // Insert leave requests into the database
        DB::table('leave_requests')->insert($leaveRequests);
    }
}
