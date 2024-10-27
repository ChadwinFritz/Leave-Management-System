<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for employees
        $employees = [
            [
                'name' => 'Alice',
                'surname' => 'Brown',
                'email' => 'alice.brown@example.com',
                'phone' => '555-1234',
                'address' => '123 Main St, Anytown, USA',
                'hire_date' => '2023-01-15',
                'user_id' => 1, // Assuming a user with ID 1 exists
                'department_id' => 1, // Assuming a department with ID 1 exists
                'duty_id' => 1, // Assuming a duty with ID 1 exists
                'employee_code' => 'EMP001',
                'employment_status' => 'active',
                'notes' => 'Top performer in the sales department.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Charlie',
                'surname' => 'Thompson',
                'email' => 'charlie.thompson@example.com',
                'phone' => '555-5678',
                'address' => '456 Oak St, Anytown, USA',
                'hire_date' => '2022-05-22',
                'user_id' => 2,
                'department_id' => 2,
                'duty_id' => 2,
                'employee_code' => 'EMP002',
                'employment_status' => 'active',
                'notes' => 'Excellent in project management.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sophia',
                'surname' => 'Garcia',
                'email' => 'sophia.garcia@example.com',
                'phone' => '555-8765',
                'address' => '789 Pine St, Anytown, USA',
                'hire_date' => '2021-11-30',
                'user_id' => 3,
                'department_id' => 1,
                'duty_id' => 3,
                'employee_code' => 'EMP003',
                'employment_status' => 'active',
                'notes' => 'Great team player and communicator.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Liam',
                'surname' => 'Lee',
                'email' => 'liam.lee@example.com',
                'phone' => '555-4321',
                'address' => '321 Maple St, Anytown, USA',
                'hire_date' => '2020-08-15',
                'user_id' => 4,
                'department_id' => 3,
                'duty_id' => 1,
                'employee_code' => 'EMP004',
                'employment_status' => 'active',
                'notes' => 'Promoted to senior developer.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Olivia',
                'surname' => 'Martinez',
                'email' => 'olivia.martinez@example.com',
                'phone' => '555-5670',
                'address' => '654 Cedar St, Anytown, USA',
                'hire_date' => '2019-06-25',
                'user_id' => 5,
                'department_id' => 2,
                'duty_id' => 2,
                'employee_code' => 'EMP005',
                'employment_status' => 'active',
                'notes' => 'Has shown leadership potential.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ethan',
                'surname' => 'Johnson',
                'email' => 'ethan.johnson@example.com',
                'phone' => '555-6543',
                'address' => '987 Elm St, Anytown, USA',
                'hire_date' => '2022-11-15',
                'user_id' => 6,
                'department_id' => 1,
                'duty_id' => 1,
                'employee_code' => 'EMP006',
                'employment_status' => 'active',
                'notes' => 'Focused on client relationships.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mia',
                'surname' => 'Wilson',
                'email' => 'mia.wilson@example.com',
                'phone' => '555-9999',
                'address' => '321 Birch St, Anytown, USA',
                'hire_date' => '2020-02-10',
                'user_id' => 7,
                'department_id' => 3,
                'duty_id' => 3,
                'employee_code' => 'EMP007',
                'employment_status' => 'active',
                'notes' => 'Creative and innovative thinker.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ava',
                'surname' => 'Smith',
                'email' => 'ava.smith@example.com',
                'phone' => '555-3456',
                'address' => '654 Oak St, Anytown, USA',
                'hire_date' => '2018-03-12',
                'user_id' => 8,
                'department_id' => 2,
                'duty_id' => 2,
                'employee_code' => 'EMP008',
                'employment_status' => 'active',
                'notes' => 'Skilled in digital marketing.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Noah',
                'surname' => 'Taylor',
                'email' => 'noah.taylor@example.com',
                'phone' => '555-8888',
                'address' => '789 Fir St, Anytown, USA',
                'hire_date' => '2019-04-20',
                'user_id' => 9,
                'department_id' => 1,
                'duty_id' => 1,
                'employee_code' => 'EMP009',
                'employment_status' => 'active',
                'notes' => 'Expert in data analysis.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Isabella',
                'surname' => 'Davis',
                'email' => 'isabella.davis@example.com',
                'phone' => '555-2468',
                'address' => '321 Cedar St, Anytown, USA',
                'hire_date' => '2022-07-30',
                'user_id' => 10,
                'department_id' => 3,
                'duty_id' => 2,
                'employee_code' => 'EMP010',
                'employment_status' => 'active',
                'notes' => 'Outstanding performance in Q2.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert or update employees in the database using updateOrInsert to avoid duplicates
        foreach ($employees as $employee) {
            DB::table('employees')->updateOrInsert(
                ['email' => $employee['email']], // Unique identifier to check for duplicates
                $employee
            );
        }
    }
}
