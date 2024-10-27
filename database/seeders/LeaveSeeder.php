<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Sample data for leaves
        $leaves = [
            [
                'employee_id' => 1,
                'leave_application_id' => 1,
                'total_leave' => 5,
                'start_date' => Carbon::create(2024, 10, 20),
                'end_date' => Carbon::create(2024, 10, 25),
                'start_half' => null,
                'end_half' => null,
                'on_date' => null,
                'on_time' => null,
                'leave_type' => 'sick_leave', // Ensure this code exists in leave_types
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'leave_application_id' => 2,
                'total_leave' => 3,
                'start_date' => Carbon::create(2024, 11, 1),
                'end_date' => Carbon::create(2024, 11, 3),
                'start_half' => null,
                'end_half' => null,
                'on_date' => null,
                'on_time' => null,
                'leave_type' => 'vacation', // Ensure this code exists in leave_types
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'leave_application_id' => 3,
                'total_leave' => 2,
                'start_date' => Carbon::create(2024, 11, 10),
                'end_date' => Carbon::create(2024, 11, 12),
                'start_half' => null,
                'end_half' => null,
                'on_date' => null,
                'on_time' => null,
                'leave_type' => 'personal_leave', // Ensure this code exists in leave_types
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'leave_application_id' => 4,
                'total_leave' => 1,
                'start_date' => Carbon::create(2024, 11, 15),
                'end_date' => Carbon::create(2024, 11, 15),
                'start_half' => null,
                'end_half' => null,
                'on_date' => null,
                'on_time' => null,
                'leave_type' => 'sick_leave', // Ensure this code exists in leave_types
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'leave_application_id' => 5,
                'total_leave' => 4,
                'start_date' => Carbon::create(2024, 12, 5),
                'end_date' => Carbon::create(2024, 12, 8),
                'start_half' => null,
                'end_half' => null,
                'on_date' => null,
                'on_time' => null,
                'leave_type' => 'vacation', // Ensure this code exists in leave_types
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'leave_application_id' => 6,
                'total_leave' => 1,
                'start_date' => Carbon::create(2024, 12, 10),
                'end_date' => Carbon::create(2024, 12, 10),
                'start_half' => null,
                'end_half' => null,
                'on_date' => null,
                'on_time' => null,
                'leave_type' => 'sick_leave', // Ensure this code exists in leave_types
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4,
                'leave_application_id' => 7,
                'total_leave' => 2,
                'start_date' => Carbon::create(2024, 12, 15),
                'end_date' => Carbon::create(2024, 12, 16),
                'start_half' => null,
                'end_half' => null,
                'on_date' => null,
                'on_time' => null,
                'leave_type' => 'personal_leave', // Ensure this code exists in leave_types
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4,
                'leave_application_id' => 8,
                'total_leave' => 3,
                'start_date' => Carbon::create(2024, 12, 20),
                'end_date' => Carbon::create(2024, 12, 23),
                'start_half' => null,
                'end_half' => null,
                'on_date' => null,
                'on_time' => null,
                'leave_type' => 'vacation', // Ensure this code exists in leave_types
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5,
                'leave_application_id' => 9,
                'total_leave' => 1,
                'start_date' => Carbon::create(2024, 12, 30),
                'end_date' => Carbon::create(2024, 12, 30),
                'start_half' => null,
                'end_half' => null,
                'on_date' => null,
                'on_time' => null,
                'leave_type' => 'sick_leave', // Ensure this code exists in leave_types
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5,
                'leave_application_id' => 10,
                'total_leave' => 5,
                'start_date' => Carbon::create(2025, 1, 1),
                'end_date' => Carbon::create(2025, 1, 5),
                'start_half' => null,
                'end_half' => null,
                'on_date' => null,
                'on_time' => null,
                'leave_type' => 'vacation', // Ensure this code exists in leave_types
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Ensure the leave types exist before seeding leaves
        $validLeaveTypes = DB::table('leave_types')->pluck('code')->toArray();

        foreach ($leaves as $leave) {
            // Check if the leave type exists in leave_types
            if (in_array($leave['leave_type'], $validLeaveTypes)) {
                DB::table('leaves')->insert($leave);
            } else {
                // Handle the error or log a message
                \Log::warning("Leave type {$leave['leave_type']} does not exist in leave_types.");
            }
        }
    }
}
