<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supervisors = [
            [
                'user_id' => 4, // Natasha Romanoff (blackwidow@marvel.com)
                'department_id' => 1, // Research and Development
                'team_id' => 1, // Innovation Team
            ],
            [
                'user_id' => 5, // Bruce Banner (hulk@marvel.com)
                'department_id' => 2, // Human Resources
                'team_id' => 2, // Recruitment Team
            ],
            [
                'user_id' => 6, // Steve Rogers (captainamerica@marvel.com)
                'department_id' => 3, // Finance
                'team_id' => 3, // Budget Planning Team
            ],
            [
                'user_id' => 7, // Tony Stark (ironman@marvel.com)
                'department_id' => 4, // Marketing
                'team_id' => 4, // Brand Management Team
            ],
            [
                'user_id' => 8, // Natasha Romanoff (blackwidow@marvel.com) - duplicated here for the example
                'department_id' => 5, // Operations
                'team_id' => 5, // Logistics Team
            ],
            [
                'user_id' => 9, // Bruce Banner (hulk@marvel.com) - example for IT and Support
                'department_id' => 6, // IT and Support
                'team_id' => 6, // Tech Support Team
            ],
            [
                'user_id' => 10, // Steve Rogers (captainamerica@marvel.com)
                'department_id' => 7, // Sales
                'team_id' => 7, // Client Acquisition Team
            ],
            [
                'user_id' => 11, // Tony Stark (ironman@marvel.com)
                'department_id' => 8, // Legal
                'team_id' => 8, // Compliance Team
            ],
            [
                'user_id' => 12, // Natasha Romanoff (blackwidow@marvel.com)
                'department_id' => 9, // Customer Service
                'team_id' => 9, // Customer Care Team
            ],
            [
                'user_id' => 13, // Steve Rogers (captainamerica@marvel.com)
                'department_id' => 10, // Quality Assurance
                'team_id' => 10, // Product Testing Team
            ],
        ];

        // Insert supervisors into the database
        DB::table('supervisors')->insert($supervisors);
    }
}
