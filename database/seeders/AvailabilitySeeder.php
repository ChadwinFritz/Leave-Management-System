<?php

namespace Database\Seeders;

use App\Models\Availability;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 random availability records for employees
        Availability::factory()->count(50)->create();

        // Example: Create specific availability for a given employee
        Availability::factory()->forEmployee(1)  // For employee with ID 1
            ->withTimeRange('2024-12-10 09:00', '2024-12-10 13:00')  // Custom time range
            ->active()  // Set the status to active
            ->create();

        Availability::factory()->forEmployee(2)  // For employee with ID 2
            ->withTimeRange('2024-12-11 14:00', '2024-12-11 18:00')  // Custom time range
            ->inactive()  // Set the status to inactive
            ->create();

        // Example: Create availability with random times for employees
        foreach (range(1, 10) as $i) {
            $from = now()->addDays(rand(1, 10));  // Random start date within the next 10 days
            $to = (clone $from)->addHours(rand(1, 6));  // Random end time within 1-6 hours after start

            Availability::factory()->forEmployee(rand(1, 5))  // Random employee between ID 1 and 5
                ->withTimeRange($from->format('Y-m-d H:i'), $to->format('Y-m-d H:i'))
                ->create();
        }
    }
}
