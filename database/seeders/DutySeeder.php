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
        ]);
    }
}
