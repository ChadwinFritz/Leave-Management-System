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
        // Get a sample employee ID to act as a supervisor for each department
        $supervisors = Employee::all();

        // Define an array of sample departments
        $departments = [
            [
                'name' => 'Software Development',
                'description' => 'Responsible for developing software solutions.',
                'manager_id' => null, // No manager assigned for now
                'supervisor_id' => $supervisors->random()->id, // Randomly assign a supervisor from existing employees
                'status' => 'active',
            ],
            [
                'name' => 'Human Resources',
                'description' => 'Manages employee relations, payroll, and benefits.',
                'manager_id' => null,
                'supervisor_id' => $supervisors->random()->id, // Randomly assign a supervisor from existing employees
                'status' => 'active',
            ],
            [
                'name' => 'Marketing',
                'description' => 'Handles marketing strategies and campaigns.',
                'manager_id' => null,
                'supervisor_id' => $supervisors->random()->id, // Randomly assign a supervisor from existing employees
                'status' => 'active',
            ],
            [
                'name' => 'Finance',
                'description' => 'Responsible for managing financial operations.',
                'manager_id' => null,
                'supervisor_id' => $supervisors->random()->id, // Randomly assign a supervisor from existing employees
                'status' => 'inactive', // Set to inactive for testing purposes
            ],
            [
                'name' => 'Customer Support',
                'description' => 'Supports customers with inquiries and technical issues.',
                'manager_id' => null,
                'supervisor_id' => $supervisors->random()->id, // Randomly assign a supervisor from existing employees
                'status' => 'active',
            ],
        ];

        // Loop through each department and insert it into the departments table
        foreach ($departments as $department) {
            Department::create([
                'name' => $department['name'],
                'description' => $department['description'],
                'manager_id' => $department['manager_id'],
                'supervisor_id' => $department['supervisor_id'],
                'status' => $department['status'],
            ]);
        }
    }
}
