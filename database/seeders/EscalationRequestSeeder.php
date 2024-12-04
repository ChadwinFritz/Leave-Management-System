<?php

namespace Database\Seeders;

use App\Models\EscalationRequest;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EscalationRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 random escalation requests
        EscalationRequest::factory()->count(50)->create();

        // Example: Create 10 pending escalation requests
        EscalationRequest::factory()
            ->count(10)
            ->pending() // Status: Pending
            ->create();

        // Example: Create 5 approved escalation requests
        EscalationRequest::factory()
            ->count(5)
            ->approved() // Status: Approved
            ->create();

        // Example: Create 5 rejected escalation requests
        EscalationRequest::factory()
            ->count(5)
            ->rejected() // Status: Rejected
            ->create();

        // Example: Create 3 escalation requests for specific employees and supervisors
        $employees = Employee::all();
        foreach ($employees as $employee) {
            // Randomly assign an employee and a supervisor to the escalation request
            $supervisor = $employees->random(); // Assign a random supervisor
            EscalationRequest::factory()
                ->forEmployee($employee->id) // Assign a specific employee
                ->forSupervisor($supervisor->id) // Assign a specific supervisor
                ->create();
        }

        // Example: Create 5 escalation requests with specific requested dates
        EscalationRequest::factory()
            ->count(5)
            ->requestedOn('2023-01-01')  // Set a specific date for the escalation request
            ->create();

        // Example: Create 3 escalation requests for specific dates within the last 6 months
        EscalationRequest::factory()
            ->count(3)
            ->requestedOn(now()->subMonths(6)->format('Y-m-d'))  // Set date within the last 6 months
            ->create();
    }
}
