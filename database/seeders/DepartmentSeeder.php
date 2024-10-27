<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                'code' => 'HR',
                'name' => 'Human Resources',
                'description' => 'Responsible for managing employee relations and benefits.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'DEV',
                'name' => 'Development',
                'description' => 'Focuses on developing and maintaining software applications.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'QA',
                'name' => 'Quality Assurance',
                'description' => 'Ensures that products meet quality standards before release.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PM',
                'name' => 'Project Management',
                'description' => 'Oversees project planning, execution, and delivery.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'FIN',
                'name' => 'Finance',
                'description' => 'Manages the financial aspects of the company.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'MKT',
                'name' => 'Marketing',
                'description' => 'Responsible for promoting products and managing brand awareness.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SAL',
                'name' => 'Sales',
                'description' => 'Handles customer relationships and drives revenue through sales strategies.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'IT',
                'name' => 'Information Technology',
                'description' => 'Manages technology infrastructure and supports IT operations.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'R&D',
                'name' => 'Research and Development',
                'description' => 'Focuses on innovating and improving products and services.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CSR',
                'name' => 'Corporate Social Responsibility',
                'description' => 'Develops and manages sustainability initiatives and community outreach programs.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
