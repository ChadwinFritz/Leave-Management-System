<?php

namespace Database\Seeders;

use App\Models\Availability;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Get all employees from the database
        $employees = Employee::all();

        // Define sample status for availability
        $statuses = ['available', 'unavailable'];

        // Create sample availability records for each employee
        foreach ($employees as $employee) {
            // Generate random availability periods for each employee
            foreach (range(1, 5) as $index) {
                $start = Carbon::now()->addDays(rand(1, 30)); // Start date is in the next 1-30 days
                $end = $start->copy()->addHours(rand(4, 8)); // End date is 4 to 8 hours after the start

                Availability::create([
                    'employee_id' => $employee->id,
                    'available_from' => $start,
                    'available_to' => $end,
                    'status' => $statuses[array_rand($statuses)], // Randomly assign available/unavailable status
                ]);
            }
        }

        // Optionally, print a message to indicate successful seeding
        $this->command->info('Availability data has been seeded!');
    }
}
