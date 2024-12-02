<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Retrieve a collection of employees who can act as supervisors
        $supervisors = Employee::where('employment_status', 'active')->get();

        // If no supervisors are available, provide a fallback or skip supervisor assignment
        if ($supervisors->isEmpty()) {
            $this->command->warn("No active employees found to assign as supervisors. Departments will be seeded without supervisors.");
        }

        // Define an array of sample departments
        $departments = [
            [
                'name' => 'Software Development',
                'description' => 'Responsible for developing software solutions.',
                'manager_id' => null,
                'supervisor_id' => $supervisors->isNotEmpty() ? $supervisors->random()->id : null, // Assign if available
                'status' => 'active',
            ],
            [
                'name' => 'Human Resources',
                'description' => 'Manages employee relations, payroll, and benefits.',
                'manager_id' => null,
                'supervisor_id' => $supervisors->isNotEmpty() ? $supervisors->random()->id : null,
                'status' => 'active',
            ],
            [
                'name' => 'Marketing',
                'description' => 'Handles marketing strategies and campaigns.',
                'manager_id' => null,
                'supervisor_id' => $supervisors->isNotEmpty() ? $supervisors->random()->id : null,
                'status' => 'active',
            ],
            [
                'name' => 'Finance',
                'description' => 'Responsible for managing financial operations.',
                'manager_id' => null,
                'supervisor_id' => $supervisors->isNotEmpty() ? $supervisors->random()->id : null,
                'status' => 'inactive',
            ],
            [
                'name' => 'Customer Support',
                'description' => 'Supports customers with inquiries and technical issues.',
                'manager_id' => null,
                'supervisor_id' => $supervisors->isNotEmpty() ? $supervisors->random()->id : null,
                'status' => 'active',
            ],
        ];

        // Loop through each department and insert it into the departments table
        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
