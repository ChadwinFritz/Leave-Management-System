<?php

namespace Database\Seeders;

use App\Models\Duty;
use Illuminate\Database\Seeder;

class DutySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Define an array of sample duties
        $duties = [
            [
                'code' => 'D001',
                'name' => 'Software Development',
                'description' => 'Responsible for coding and developing software applications.',
                'status' => 'active',
            ],
            [
                'code' => 'D002',
                'name' => 'System Maintenance',
                'description' => 'Responsible for maintaining and upgrading system infrastructure.',
                'status' => 'active',
            ],
            [
                'code' => 'D003',
                'name' => 'User Support',
                'description' => 'Provides assistance to users with technical issues.',
                'status' => 'active',
            ],
            [
                'code' => 'D004',
                'name' => 'Quality Assurance',
                'description' => 'Ensures the quality of software through testing and bug tracking.',
                'status' => 'inactive',
            ],
            [
                'code' => 'D005',
                'name' => 'Project Management',
                'description' => 'Coordinates projects, manages timelines, and oversees project progress.',
                'status' => 'active',
            ],
        ];

        // Loop through each duty and insert it into the duties table
        foreach ($duties as $duty) {
            Duty::create([
                'code' => $duty['code'],
                'name' => $duty['name'],
                'description' => $duty['description'],
                'status' => $duty['status'],
            ]);
        }
    }
}
