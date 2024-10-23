<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'name' => 'John',
                'surname' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '555-1234',
                'address' => '123 Main St, Anytown, USA',
                'hire_date' => '2023-01-15',
                'user_id' => 1, // Assuming a user with ID 1 exists
                'department_id' => 1, // Assuming a department with ID 1 exists
                'duty_id' => 1, // Assuming a duty with ID 1 exists
                'employee_code' => 'EMP001',
                'employment_status' => 'active',
                'notes' => 'Top performer in the sales department.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane',
                'surname' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '555-5678',
                'address' => '456 Oak St, Anytown, USA',
                'hire_date' => '2022-05-22',
                'user_id' => 2,
                'department_id' => 2,
                'duty_id' => 2,
                'employee_code' => 'EMP002',
                'employment_status' => 'active',
                'notes' => 'Excellent in project management.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emily',
                'surname' => 'Johnson',
                'email' => 'emily.johnson@example.com',
                'phone' => '555-8765',
                'address' => '789 Pine St, Anytown, USA',
                'hire_date' => '2021-11-30',
                'user_id' => 3,
                'department_id' => 1,
                'duty_id' => 3,
                'employee_code' => 'EMP003',
                'employment_status' => 'active',
                'notes' => 'Great team player and communicator.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael',
                'surname' => 'Brown',
                'email' => 'michael.brown@example.com',
                'phone' => '555-4321',
                'address' => '321 Maple St, Anytown, USA',
                'hire_date' => '2020-08-15',
                'user_id' => 4,
                'department_id' => 3,
                'duty_id' => 1,
                'employee_code' => 'EMP004',
                'employment_status' => 'active',
                'notes' => 'Promoted to senior developer.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sarah',
                'surname' => 'Davis',
                'email' => 'sarah.davis@example.com',
                'phone' => '555-5670',
                'address' => '654 Cedar St, Anytown, USA',
                'hire_date' => '2019-06-25',
                'user_id' => 5,
                'department_id' => 2,
                'duty_id' => 2,
                'employee_code' => 'EMP005',
                'employment_status' => 'active',
                'notes' => 'Has shown leadership potential.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
