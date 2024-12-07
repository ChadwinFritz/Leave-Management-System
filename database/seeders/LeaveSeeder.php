<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaves = [
            [
                'employee_id' => 1, // Peter Parker
                'leave_application_id' => 1, // Corresponding to leave application ID
                'total_leave' => 5.0,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-20',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 1, // Annual Leave (ID for Annual Leave)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2, // Tony Stark
                'leave_application_id' => 2,
                'total_leave' => 2.5,
                'start_date' => '2024-02-05',
                'end_date' => '2024-02-07',
                'start_half' => true,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 2, // Sick Leave (ID for Sick Leave)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3, // Steve Rogers
                'leave_application_id' => 3,
                'total_leave' => 3.0,
                'start_date' => '2024-03-10',
                'end_date' => '2024-03-12',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 5, // Bereavement Leave (ID for Bereavement Leave)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4, // Natasha Romanoff
                'leave_application_id' => 4,
                'total_leave' => 0.5,
                'start_date' => '2024-03-20',
                'end_date' => '2024-03-20', // Added the same date for single-day leave
                'start_half' => false,
                'end_half' => true,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 6, // Compensatory Leave (ID for Compensatory Leave)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5, // Bruce Banner
                'leave_application_id' => 5,
                'total_leave' => 10.0,
                'start_date' => '2024-04-01',
                'end_date' => '2024-04-10',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 8, // Study Leave (ID for Study Leave)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1, // Peter Parker
                'leave_application_id' => 6,
                'total_leave' => 1.0,
                'start_date' => '2024-05-01',
                'end_date' => '2024-05-01',  // Added same end_date for Public Holiday Leave
                'start_half' => false,
                'end_half' => false,
                'on_date' => '2024-05-01',
                'on_time' => null,
                'leave_type_id' => 9, // Public Holiday Leave (ID for Public Holiday Leave)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2, // Tony Stark
                'leave_application_id' => 7,
                'total_leave' => 0.0,
                'start_date' => '2024-06-01',
                'end_date' => '2024-08-30',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 3, // Maternity Leave (mocked, rejected) (ID for Maternity Leave)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4, // Natasha Romanoff
                'leave_application_id' => 8,
                'total_leave' => 15.0,
                'start_date' => '2024-07-01',
                'end_date' => '2024-07-15',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 4, // Paternity Leave (mocked) (ID for Paternity Leave)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3, // Steve Rogers
                'leave_application_id' => 9,
                'total_leave' => 365.0,
                'start_date' => '2025-01-01',
                'end_date' => '2025-12-31',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 10, // Sabbatical Leave (ID for Sabbatical Leave)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5, // Bruce Banner
                'leave_application_id' => 10,
                'total_leave' => 15.0,
                'start_date' => '2024-09-01',
                'end_date' => '2024-09-15',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 7, // Unpaid Leave (ID for Unpaid Leave)
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert leaves into the database
        DB::table('leaves')->insert($leaves);
    }
}
