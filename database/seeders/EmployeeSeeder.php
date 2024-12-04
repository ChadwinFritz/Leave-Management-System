<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 random employees
        Employee::factory()->count(50)->create();

        // Example: Create 5 active employees
        Employee::factory()->count(5)->active()->create();

        // Example: Create 5 inactive employees
        Employee::factory()->count(5)->inactive()->create();

        // Example: Assign employees to specific departments
        $departments = Department::all(); // Fetch all departments from the database
        foreach ($departments as $department) {
            Employee::factory()
                ->inDepartment($department->id)  // Assign to specific department
                ->count(5)  // Create 5 employees for each department
                ->create();
        }

        // Example: Hire employees after a specific date
        Employee::factory()
            ->count(3)
            ->hiredOnOrAfter('2020-01-01')  // Hire after January 1st, 2020
            ->create();

        // Example: Hire employees before a specific date
        Employee::factory()
            ->count(3)
            ->hiredBefore('2015-01-01')  // Hire before January 1st, 2015
            ->create();

        // Example: Assign employees with specific hire dates
        Employee::factory()
            ->count(10)
            ->hiredOnOrAfter('2018-01-01')  // Hire after January 1st, 2018
            ->hiredBefore('2023-12-31')  // Hire before December 31st, 2023
            ->create();

        // Example: Create 10 employees with custom attributes
        Employee::factory()
            ->count(10)
            ->forUser(User::factory())  // Assign a specific user (could be an existing user)
            ->create();
    }
}
