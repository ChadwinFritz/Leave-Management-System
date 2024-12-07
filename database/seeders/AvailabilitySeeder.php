<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $availabilities = [
            [
                'employee_id' => 1, // Peter Parker (ID 1)
                'available_from' => Carbon::now()->addDays(1)->setTime(9, 0), // Available starting tomorrow at 9 AM
                'available_to' => Carbon::now()->addDays(1)->setTime(17, 0), // Available until 5 PM
                'status' => 'available',
            ],
            [
                'employee_id' => 2, // Tony Stark (ID 2)
                'available_from' => Carbon::now()->addDays(2)->setTime(10, 0), // Available starting in two days at 10 AM
                'available_to' => Carbon::now()->addDays(2)->setTime(18, 0), // Available until 6 PM
                'status' => 'available',
            ],
            [
                'employee_id' => 3, // Steve Rogers (ID 3)
                'available_from' => Carbon::now()->addDays(3)->setTime(8, 0), // Available starting in three days at 8 AM
                'available_to' => Carbon::now()->addDays(3)->setTime(16, 0), // Available until 4 PM
                'status' => 'available',
            ],
            [
                'employee_id' => 4, // Natasha Romanoff (ID 4)
                'available_from' => Carbon::now()->addDays(5)->setTime(11, 0), // Available starting in five days at 11 AM
                'available_to' => Carbon::now()->addDays(5)->setTime(15, 0), // Available until 3 PM
                'status' => 'unavailable', // Natasha Romanoff is unavailable on this date
            ],
            [
                'employee_id' => 5, // Bruce Banner (ID 5)
                'available_from' => Carbon::now()->addDays(1)->setTime(9, 30), // Available starting tomorrow at 9:30 AM
                'available_to' => Carbon::now()->addDays(1)->setTime(17, 30), // Available until 5:30 PM
                'status' => 'available',
            ],
        ];

        // Insert availability data into the database
        DB::table('availabilities')->insert($availabilities);
    }
}
