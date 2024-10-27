<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaveApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_applications')->insert([
            [
                'employee_id' => 1, // Assuming employee with ID 1
                'leave_type_id' => 1, // Assuming sick leave has ID 1
                'start_date' => Carbon::now()->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'start_half' => null,
                'end_half' => null,
                'number_of_days' => 3,
                'on_date' => null,
                'on_time' => null,
                'reason' => 'Flu symptoms.',
                'rejection_reason' => null,
                'total_leave' => 10,
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2, // Assuming employee with ID 2
                'leave_type_id' => 2, // Assuming vacation has ID 2
                'start_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(14)->format('Y-m-d'),
                'start_half' => null,
                'end_half' => null,
                'number_of_days' => 7,
                'on_date' => null,
                'on_time' => null,
                'reason' => 'Family vacation.',
                'rejection_reason' => null,
                'total_leave' => 12,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3, // Assuming employee with ID 3
                'leave_type_id' => 3, // Assuming personal leave has ID 3
                'start_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'start_half' => 'morning',
                'end_half' => 'afternoon',
                'number_of_days' => 3,
                'on_date' => null,
                'on_time' => null,
                'reason' => 'Attending a personal event.',
                'rejection_reason' => null,
                'total_leave' => 5,
                'status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4, // Assuming employee with ID 4
                'leave_type_id' => 4, // Assuming bereavement has ID 4
                'start_date' => Carbon::now()->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'start_half' => null,
                'end_half' => null,
                'number_of_days' => 2,
                'on_date' => null,
                'on_time' => null,
                'reason' => 'Family bereavement.',
                'rejection_reason' => null,
                'total_leave' => 7,
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5, // Assuming employee with ID 5
                'leave_type_id' => 1, // Assuming sick leave has ID 1
                'start_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'start_half' => 'afternoon',
                'end_half' => null,
                'number_of_days' => 1,
                'on_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'on_time' => '14:00:00',
                'reason' => 'Doctor appointment.',
                'rejection_reason' => null,
                'total_leave' => 5,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 6, // Assuming employee with ID 6
                'leave_type_id' => 2, // Assuming vacation has ID 2
                'start_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(12)->format('Y-m-d'),
                'start_half' => null,
                'end_half' => null,
                'number_of_days' => 3,
                'on_date' => null,
                'on_time' => null,
                'reason' => 'Traveling abroad.',
                'rejection_reason' => null,
                'total_leave' => 8,
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 7, // Assuming employee with ID 7
                'leave_type_id' => 3, // Assuming personal leave has ID 3
                'start_date' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'start_half' => 'morning',
                'end_half' => null,
                'number_of_days' => 0.5,
                'on_date' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'on_time' => '09:00:00',
                'reason' => 'Half-day personal leave.',
                'rejection_reason' => null,
                'total_leave' => 5,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 8, // Assuming employee with ID 8
                'leave_type_id' => 4, // Assuming bereavement has ID 4
                'start_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'start_half' => null,
                'end_half' => null,
                'number_of_days' => 3,
                'on_date' => null,
                'on_time' => null,
                'reason' => 'Loss of a family member.',
                'rejection_reason' => null,
                'total_leave' => 6,
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 9, // Assuming employee with ID 9
                'leave_type_id' => 1, // Assuming sick leave has ID 1
                'start_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'start_half' => 'afternoon',
                'end_half' => 'morning',
                'number_of_days' => 1,
                'on_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'on_time' => '13:00:00',
                'reason' => 'Migraine attack.',
                'rejection_reason' => null,
                'total_leave' => 4,
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 10, // Assuming employee with ID 10
                'leave_type_id' => 2, // Assuming vacation has ID 2
                'start_date' => Carbon::now()->addDays(20)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(25)->format('Y-m-d'),
                'start_half' => null,
                'end_half' => null,
                'number_of_days' => 5,
                'on_date' => null,
                'on_time' => null,
                'reason' => 'Annual family trip.',
                'rejection_reason' => null,
                'total_leave' => 12,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
