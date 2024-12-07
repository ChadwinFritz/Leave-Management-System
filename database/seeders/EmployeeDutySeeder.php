<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeDutySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeDuties = [
            [
                'employee_id' => 1, // Assigned to Peter Parker (Employee ID 1)
                'duty_id' => 1, // Assigned "Project Management" (Duty ID 1)
                'assigned_at' => '2024-12-01 08:00:00',
            ],
            [
                'employee_id' => 2, // Assigned to Tony Stark (Employee ID 2)
                'duty_id' => 4, // Assigned "Software Development" (Duty ID 4)
                'assigned_at' => '2024-12-01 09:00:00',
            ],
            [
                'employee_id' => 3, // Assigned to Steve Rogers (Employee ID 3)
                'duty_id' => 2, // Assigned "Data Analysis" (Duty ID 2)
                'assigned_at' => '2024-12-01 10:00:00',
            ],
            [
                'employee_id' => 4, // Assigned to Natasha Romanoff (Employee ID 4)
                'duty_id' => 3, // Assigned "Customer Support" (Duty ID 3)
                'assigned_at' => '2024-12-01 11:00:00',
            ],
            [
                'employee_id' => 5, // Assigned to Bruce Banner (Employee ID 5)
                'duty_id' => 5, // Assigned "Quality Assurance Testing" (Duty ID 5)
                'assigned_at' => '2024-12-01 12:00:00',
            ],
        ];

        // Insert employee duties into the database
        DB::table('employee_duties')->insert($employeeDuties);
    }
}
