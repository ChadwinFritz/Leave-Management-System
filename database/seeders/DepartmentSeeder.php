<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Research and Development',
                'description' => 'Focuses on innovation and creating new products and technologies.',
                'user_id' => 4, // Reference to a user (supervisor) from the users table
                'status' => 'active',
            ],
            [
                'name' => 'Human Resources',
                'description' => 'Responsible for employee relations, payroll, benefits, and recruitment.',
                'user_id' => 4, // Reference to a user (supervisor) from the users table
                'status' => 'active',
            ],
            [
                'name' => 'Finance',
                'description' => 'Handles budgeting, financial planning, and management of company resources.',
                'user_id' => 4, // Reference to a user (supervisor) from the users table
                'status' => 'active',
            ],
            [
                'name' => 'Marketing',
                'description' => 'Drives brand awareness, advertising, and market research.',
                'user_id' => 4, // Reference to a user (supervisor) from the users table
                'status' => 'active',
            ],
            [
                'name' => 'Operations',
                'description' => 'Oversees day-to-day business operations and logistics.',
                'user_id' => 4, // Reference to a user (supervisor) from the users table
                'status' => 'active',
            ],
            [
                'name' => 'IT and Support',
                'description' => 'Maintains and supports technology infrastructure and systems.',
                'user_id' => 4, // Reference to a user (supervisor) from the users table
                'status' => 'active',
            ],
            [
                'name' => 'Sales',
                'description' => 'Drives revenue by managing client relationships and closing deals.',
                'user_id' => 4, // Reference to a user (supervisor) from the users table
                'status' => 'active',
            ],
            [
                'name' => 'Legal',
                'description' => 'Handles contracts, compliance, and legal matters for the company.',
                'user_id' => 4, // Reference to a user (supervisor) from the users table
                'status' => 'active',
            ],
            [
                'name' => 'Customer Service',
                'description' => 'Provides support and solutions to customer inquiries and complaints.',
                'user_id' => 4, // Reference to a user (supervisor) from the users table
                'status' => 'active',
            ],
            [
                'name' => 'Quality Assurance',
                'description' => 'Ensures products and services meet quality standards.',
                'user_id' => 4, // Reference to a user (supervisor) from the users table
                'status' => 'active',
            ],
        ];

        // Insert departments into the database
        DB::table('departments')->insert($departments);
    }
}
