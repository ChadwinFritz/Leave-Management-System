<?php

namespace Database\Seeders;

use App\Models\EmployeeDuty;
use App\Models\Employee;
use App\Models\Duty;
use Illuminate\Database\Seeder;

class EmployeeDutySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 20 random employee-duties
        EmployeeDuty::factory()->count(20)->create();

        // Example: Create 5 specific employee-duties for specific employees and duties
        foreach (range(1, 5) as $i) {
            // Assign a duty to a specific employee on a specific date
            EmployeeDuty::factory()
                ->forEmployee($i)  // Assign a specific employee by ID
                ->forDuty($i)  // Assign a specific duty by ID
                ->assignedOn(now()->subDays($i))  // Assign the duty on a specific date
                ->create();
        }

        // Example: Assign specific duties to employees with a custom assignment date
        $employees = Employee::all();  // Get all employees
        $duties = Duty::all();  // Get all duties

        foreach ($employees as $employee) {
            foreach ($duties as $duty) {
                // Randomly assign each employee to a duty on a random date
                EmployeeDuty::factory()
                    ->forEmployee($employee->id)  // Assign a specific employee
                    ->forDuty($duty->id)  // Assign a specific duty
                    ->assignedOn(now()->subDays(rand(1, 365)))  // Assign on a random date within the last year
                    ->create();
            }
        }

        // Example: Assign duties for employees with custom dates
        foreach (range(1, 3) as $i) {
            EmployeeDuty::factory()
                ->forEmployee($i)  // Assign a specific employee by ID
                ->forDuty($i)  // Assign a specific duty by ID
                ->assignedOn(now()->subMonths(2))  // Assign a duty two months ago
                ->create();
        }
    }
}
