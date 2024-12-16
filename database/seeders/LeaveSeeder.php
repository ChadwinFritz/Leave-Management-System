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
                'leave_application_id' => 1,
                'total_leave' => 5.0,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-20',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 1, // Annual Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2, // Tony Stark
                'leave_application_id' => 2,
                'total_leave' => 2.0,
                'start_date' => '2024-02-05',
                'end_date' => '2024-02-06',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 2, // Sick Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3, // Steve Rogers
                'leave_application_id' => 3,
                'total_leave' => 7.0,
                'start_date' => '2024-03-01',
                'end_date' => '2024-03-07',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 3, // Bereavement Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4, // Natasha Romanoff
                'leave_application_id' => 4,
                'total_leave' => 3.0,
                'start_date' => '2024-04-10',
                'end_date' => '2024-04-12',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 4, // Personal Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5, // Bruce Banner
                'leave_application_id' => 5,
                'total_leave' => 10.0,
                'start_date' => '2024-05-01',
                'end_date' => '2024-05-10',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 5, // Study Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 6, // Wanda Maximoff
                'leave_application_id' => 6,
                'total_leave' => 1.0,
                'start_date' => '2024-06-15',
                'end_date' => '2024-06-15',
                'start_half' => false,
                'end_half' => true,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 6, // Compensatory Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 7, // Clint Barton
                'leave_application_id' => 7,
                'total_leave' => 3.0,
                'start_date' => '2024-07-10',
                'end_date' => '2024-07-12',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 7, // Unpaid Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 8, // Sam Wilson
                'leave_application_id' => 8,
                'total_leave' => 5.0,
                'start_date' => '2024-08-01',
                'end_date' => '2024-08-05',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 1, // Annual Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 9, // Scott Lang
                'leave_application_id' => 9,
                'total_leave' => 2.5,
                'start_date' => '2024-09-01',
                'end_date' => '2024-09-02',
                'start_half' => true,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 2, // Sick Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 10, // Hope Van Dyne
                'leave_application_id' => 10,
                'total_leave' => 7.0,
                'start_date' => '2024-10-01',
                'end_date' => '2024-10-07',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 3, // Parental Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Additional entries for remaining employees
            [
                'employee_id' => 11, // Stephen Strange
                'leave_application_id' => 11,
                'total_leave' => 4.0,
                'start_date' => '2024-11-01',
                'end_date' => '2024-11-04',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 12, // T'Challa
                'leave_application_id' => 12,
                'total_leave' => 1.0,
                'start_date' => '2024-12-25',
                'end_date' => '2024-12-25',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 9, // Public Holiday Leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 13, // Carol Danvers
                'leave_application_id' => 13,
                'total_leave' => 5.0,
                'start_date' => '2024-12-20',
                'end_date' => '2024-12-24',
                'start_half' => false,
                'end_half' => false,
                'on_date' => null,
                'on_time' => null,
                'leave_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert leaves into the database
        DB::table('leaves')->insert($leaves);
    }
}
