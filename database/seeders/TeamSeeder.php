<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'Innovation Team',
                'user_id' => 4, // Assuming this matches a valid supervisor ID
                'department_id' => 1, // Research and Development
            ],
            [
                'name' => 'Recruitment Team',
                'user_id' => 4,
                'department_id' => 2, // Human Resources
            ],
            [
                'name' => 'Budget Planning Team',
                'user_id' => 4,
                'department_id' => 3, // Finance
            ],
            [
                'name' => 'Brand Management Team',
                'user_id' => 4,
                'department_id' => 4, // Marketing
            ],
            [
                'name' => 'Logistics Team',
                'user_id' => 4,
                'department_id' => 5, // Operations
            ],
            [
                'name' => 'Tech Support Team',
                'user_id' => 4,
                'department_id' => 6, // IT and Support
            ],
            [
                'name' => 'Client Acquisition Team',
                'user_id' => 4,
                'department_id' => 7, // Sales
            ],
            [
                'name' => 'Compliance Team',
                'user_id' => 4,
                'department_id' => 8, // Legal
            ],
            [
                'name' => 'Customer Care Team',
                'supervisor_id' => 4,
                'department_id' => 9, // Customer Service
            ],
            [
                'name' => 'Product Testing Team',
                'user_id' => 4,
                'department_id' => 10, // Quality Assurance
            ],
        ];

        // Insert teams into the database
        DB::table('teams')->insert($teams);
    }
}
