<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeDutySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming there are employees with ids 1, 2, 3, and duties with ids 1, 2, 3
        DB::table('employee_duties')->insert([
            [
                'employee_id' => 1, // Replace with actual employee id
                'duty_id' => 1, // Replace with actual duty id
                'assigned_at' => Carbon::now()->subDays(10), // 10 days ago
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2, // Replace with actual employee id
                'duty_id' => 2, // Replace with actual duty id
                'assigned_at' => Carbon::now()->subDays(5), // 5 days ago
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 3, // Replace with actual employee id
                'duty_id' => 3, // Replace with actual duty id
                'assigned_at' => Carbon::now()->subDays(2), // 2 days ago
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 1, // Replace with actual employee id
                'duty_id' => 2, // Replace with actual duty id
                'assigned_at' => Carbon::now()->subDays(7), // 7 days ago
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2, // Replace with actual employee id
                'duty_id' => 3, // Replace with actual duty id
                'assigned_at' => Carbon::now()->subDays(3), // 3 days ago
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
