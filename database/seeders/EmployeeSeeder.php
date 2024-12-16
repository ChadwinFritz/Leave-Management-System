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
            // Adding the new users
            [
                'name' => 'Wanda',
                'surname' => 'Maximoff',
                'email' => 'scarletwitch.employee@marvel.com',
                'phone' => '555-1122',
                'address' => 'Westview, New Jersey',
                'hire_date' => '2015-10-01 09:00:00',
                'user_id' => 6, // Matches with the user ID for Wanda Maximoff
                'department_id' => 6, // Replace with the actual department ID
                'duty_id' => 1, // Example duty ID
                'employee_code' => 'EMP006',
                'employment_status' => 'active',
                'notes' => 'Powerful telekinetic and reality manipulator.',
            ],
            [
                'name' => 'Clint',
                'surname' => 'Barton',
                'email' => 'hawkeye.employee@marvel.com',
                'phone' => '555-2233',
                'address' => 'Avengers Compound, NY',
                'hire_date' => '2012-09-15 09:00:00',
                'user_id' => 7,
                'department_id' => 7,
                'duty_id' => 2,
                'employee_code' => 'EMP007',
                'employment_status' => 'active',
                'notes' => 'Skilled archer with expertise in tactical planning.',
            ],
            [
                'name' => 'Sam',
                'surname' => 'Wilson',
                'email' => 'falcon.employee@marvel.com',
                'phone' => '555-3344',
                'address' => 'Baton Rouge, LA',
                'hire_date' => '2014-01-30 09:00:00',
                'user_id' => 8,
                'department_id' => 8,
                'duty_id' => 3,
                'employee_code' => 'EMP008',
                'employment_status' => 'active',
                'notes' => 'Veteran soldier and skilled aerial combatant.',
            ],
            [
                'name' => 'Scott',
                'surname' => 'Lang',
                'email' => 'antman.employee@marvel.com',
                'phone' => '555-4455',
                'address' => 'San Francisco, CA',
                'hire_date' => '2015-07-05 09:00:00',
                'user_id' => 9,
                'department_id' => 9,
                'duty_id' => 4,
                'employee_code' => 'EMP009',
                'employment_status' => 'active',
                'notes' => 'Size-shifting superhero with a big heart.',
            ],
            [
                'name' => 'Hope',
                'surname' => 'Van Dyne',
                'email' => 'wasp.employee@marvel.com',
                'phone' => '555-5566',
                'address' => 'Pym Technologies, CA',
                'hire_date' => '2016-08-15 09:00:00',
                'user_id' => 10,
                'department_id' => 10,
                'duty_id' => 5,
                'employee_code' => 'EMP010',
                'employment_status' => 'active',
                'notes' => 'Inventor and member of the Avengers.',
            ],
            [
                'name' => 'Stephen',
                'surname' => 'Strange',
                'email' => 'doctorstrange.employee@marvel.com',
                'phone' => '555-6677',
                'address' => 'Kamar-Taj, Nepal',
                'hire_date' => '2016-10-15 09:00:00',
                'user_id' => 11,
                'department_id' => 2,
                'duty_id' => 6,
                'employee_code' => 'EMP011',
                'employment_status' => 'active',
                'notes' => 'Master of the mystic arts.',
            ],
            [
                'name' => 'T\'Challa',
                'surname' => 'Boseman',
                'email' => 'blackpanther.employee@marvel.com',
                'phone' => '555-7788',
                'address' => 'Wakanda',
                'hire_date' => '2016-04-30 09:00:00',
                'user_id' => 12,
                'department_id' => 3,
                'duty_id' => 7,
                'employee_code' => 'EMP012',
                'employment_status' => 'active',
                'notes' => 'King of Wakanda and superhero.',
            ],
            [
                'name' => 'Carol',
                'surname' => 'Danvers',
                'email' => 'captainmarvel.employee@marvel.com',
                'phone' => '555-8899',
                'address' => 'Space, near Earth',
                'hire_date' => '2017-05-10 09:00:00',
                'user_id' => 13,
                'department_id' => 4,
                'duty_id' => 8,
                'employee_code' => 'EMP013',
                'employment_status' => 'active',
                'notes' => 'Former US Air Force pilot and Avenger.',
            ],
            [
                'name' => 'Bucky',
                'surname' => 'Barnes',
                'email' => 'wintersoldier.employee@marvel.com',
                'phone' => '555-9900',
                'address' => 'Brooklyn, NY',
                'hire_date' => '2014-12-15 09:00:00',
                'user_id' => 14,
                'department_id' => 5,
                'duty_id' => 9,
                'employee_code' => 'EMP014',
                'employment_status' => 'active',
                'notes' => 'Former soldier and Avenger.',
            ],
            [
                'name' => 'Nick',
                'surname' => 'Fury',
                'email' => 'nickfury.employee@marvel.com',
                'phone' => '555-1111',
                'address' => 'Avengers Tower, NY',
                'hire_date' => '2007-03-11 09:00:00',
                'user_id' => 15,
                'department_id' => 6,
                'duty_id' => 10,
                'employee_code' => 'EMP015',
                'employment_status' => 'active',
                'notes' => 'S.H.I.E.L.D. Director and strategic mastermind.',
            ]
        ];

        // Insert employees into the database
        DB::table('employees')->insert($employees);
    }
}
