<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Peter',
                'surname' => 'Parker',
                'email' => 'spiderman.employee@marvel.com',
                'phone' => '555-1234',
                'address' => '20 Ingram Street, Forest Hills, Queens, NY',
                'hire_date' => '2015-06-15 09:00:00',
                'user_id' => 1, // Assuming this matches the user with ID 1
                'department_id' => 1, // Replace with an actual department ID
                'duty_id' => 1, // Duty ID matching the duties inserted in DutySeeder
                'employee_code' => 'EMP001',
                'employment_status' => 'active',
                'notes' => 'Excellent web developer and team player.',
            ],
            [
                'name' => 'Tony',
                'surname' => 'Stark',
                'email' => 'ironman.employee@marvel.com',
                'phone' => '555-5678',
                'address' => '10880 Malibu Point, Malibu, CA',
                'hire_date' => '2010-03-10 09:00:00',
                'user_id' => 2, // Assuming this matches the user with ID 2
                'department_id' => 2, // Replace with an actual department ID
                'duty_id' => 4, // Duty ID for "Software Development"
                'employee_code' => 'EMP002',
                'employment_status' => 'active',
                'notes' => 'Engineering genius and leader of innovation.',
            ],
            [
                'name' => 'Steve',
                'surname' => 'Rogers',
                'email' => 'captain.employee@marvel.com',
                'phone' => '555-9876',
                'address' => '569 Leaman Place, Brooklyn, NY',
                'hire_date' => '1945-01-01 09:00:00',
                'user_id' => 3, // Assuming this matches the user with ID 3
                'department_id' => 3, // Replace with an actual department ID
                'duty_id' => 7, // Duty ID for "Team Training"
                'employee_code' => 'EMP003',
                'employment_status' => 'active',
                'notes' => 'Natural leader with an unwavering moral compass.',
            ],
            [
                'name' => 'Natasha',
                'surname' => 'Romanoff',
                'email' => 'blackwidow.employee@marvel.com',
                'phone' => '555-3456',
                'address' => 'Unknown, Classified',
                'hire_date' => '2012-05-01 09:00:00',
                'user_id' => 4, // Assuming this matches the user with ID 4
                'department_id' => 4, // Replace with an actual department ID
                'duty_id' => 3, // Duty ID for "Customer Support"
                'employee_code' => 'EMP004',
                'employment_status' => 'active',
                'notes' => 'Expert in espionage and close combat.',
            ],
            [
                'name' => 'Bruce',
                'surname' => 'Banner',
                'email' => 'hulk.employee@marvel.com',
                'phone' => '555-6789',
                'address' => 'Culver University, Virginia',
                'hire_date' => '2008-08-10 09:00:00',
                'user_id' => 5, // Assuming this matches the user with ID 5
                'department_id' => 5, // Replace with an actual department ID
                'duty_id' => 2, // Duty ID for "Data Analysis"
                'employee_code' => 'EMP005',
                'employment_status' => 'active',
                'notes' => 'Brilliant scientist with expertise in gamma radiation.',
            ],
        ];

        // Insert employees into the database
        DB::table('employees')->insert($employees);
    }
}
