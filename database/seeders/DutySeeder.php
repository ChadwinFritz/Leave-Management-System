<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DutySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('duties')->insert([
            [
                'code' => 'DEV',
                'name' => 'Developer',
                'description' => 'Responsible for writing and maintaining code.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'QA',
                'name' => 'Quality Assurance',
                'description' => 'Ensures that the product is bug-free and meets the requirements.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PM',
                'name' => 'Project Manager',
                'description' => 'Oversees project development and manages the team.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'HR',
                'name' => 'Human Resources',
                'description' => 'Manages employee relations and recruitment.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'ADMIN',
                'name' => 'Administrator',
                'description' => 'Responsible for managing the company’s administrative tasks.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'DESIGN',
                'name' => 'Designer',
                'description' => 'Creates visuals and design elements for products.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'DEVOPS',
                'name' => 'DevOps Engineer',
                'description' => 'Responsible for deploying and managing applications.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SALES',
                'name' => 'Sales Representative',
                'description' => 'Handles sales and customer relations.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'MARKETING',
                'name' => 'Marketing Specialist',
                'description' => 'Develops marketing strategies to promote products.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SUPPORT',
                'name' => 'Support Specialist',
                'description' => 'Provides assistance and support to customers.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
