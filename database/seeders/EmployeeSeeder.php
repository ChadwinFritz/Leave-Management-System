<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Get existing departments and users to link employees to
        $departments = Department::all();
        $users = User::all();

        // Define a set of sample employee data
        $employees = [
            [
                'name' => 'John',
                'surname' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '123-456-7890',
                'address' => '123 Main St, Anytown, USA',
                'hire_date' => now(),
                'user_id' => $users->random()->id, // Randomly assign a user
                'department_id' => $departments->random()->id, // Randomly assign a department
                'employee_code' => 'EMP1001',
                'employment_status' => 'active',
                'notes' => 'Experienced in software development',
            ],
            [
                'name' => 'Jane',
                'surname' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '987-654-3210',
                'address' => '456 Elm St, Othertown, USA',
                'hire_date' => now()->subYear(),
                'user_id' => $users->random()->id,
                'department_id' => $departments->random()->id,
                'employee_code' => 'EMP1002',
                'employment_status' => 'active',
                'notes' => 'Handles HR and admin tasks',
            ],
            [
                'name' => 'Michael',
                'surname' => 'Johnson',
                'email' => 'michael.johnson@example.com',
                'phone' => '321-654-9870',
                'address' => '789 Oak St, Sometown, USA',
                'hire_date' => now()->subMonths(6),
                'user_id' => $users->random()->id,
                'department_id' => $departments->random()->id,
                'employee_code' => 'EMP1003',
                'employment_status' => 'inactive',
                'notes' => 'Former employee, no longer with the company',
            ],
            [
                'name' => 'Emily',
                'surname' => 'Davis',
                'email' => 'emily.davis@example.com',
                'phone' => '654-321-9870',
                'address' => '101 Pine St, Anycity, USA',
                'hire_date' => now()->subMonths(2),
                'user_id' => $users->random()->id,
                'department_id' => $departments->random()->id,
                'employee_code' => 'EMP1004',
                'employment_status' => 'active',
                'notes' => 'Working in marketing and communications',
            ],
            [
                'name' => 'Daniel',
                'surname' => 'Williams',
                'email' => 'daniel.williams@example.com',
                'phone' => '555-111-2222',
                'address' => '202 Birch St, Thistown, USA',
                'hire_date' => now()->subMonths(3),
                'user_id' => $users->random()->id,
                'department_id' => $departments->random()->id,
                'employee_code' => 'EMP1005',
                'employment_status' => 'active',
                'notes' => 'Experienced in sales and customer service',
            ],
        ];

        // Loop through each employee and insert them into the employees table
        foreach ($employees as $employee) {
            Employee::create([
                'name' => $employee['name'],
                'surname' => $employee['surname'],
                'email' => $employee['email'],
                'phone' => $employee['phone'],
                'address' => $employee['address'],
                'hire_date' => $employee['hire_date'],
                'user_id' => $employee['user_id'],
                'department_id' => $employee['department_id'],
                'employee_code' => $employee['employee_code'],
                'employment_status' => $employee['employment_status'],
                'notes' => $employee['notes'],
            ]);
        }
    }
}
