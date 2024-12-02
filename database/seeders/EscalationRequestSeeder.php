<?php

namespace Database\Seeders;

use App\Models\EscalationRequest;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EscalationRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Get all employees to assign as employees and supervisors
        $employees = Employee::all();

        // Define possible statuses for escalation requests
        $statuses = ['pending', 'approved', 'rejected'];

        // Loop to generate random escalation requests
        foreach ($employees as $employee) {
            // Skip if no other employees are available for supervisor assignment
            $supervisor = $employees->where('id', '!=', $employee->id)->random();

            // Generate a random number of escalation requests for the employee
            foreach (range(1, 3) as $index) {
                EscalationRequest::create([
                    'employee_id' => $employee->id,
                    'supervisor_id' => $supervisor->id,
                    'reason' => 'Request to escalate an issue regarding ' . $employee->name,
                    'status' => $statuses[array_rand($statuses)], // Randomly assign a status
                    'date_requested' => Carbon::now()->subDays(rand(1, 15)), // Request date within the last 15 days
                ]);
            }
        }

        // Optionally, print a message to indicate successful seeding
        $this->command->info('Escalation request data has been seeded!');
    }
}
