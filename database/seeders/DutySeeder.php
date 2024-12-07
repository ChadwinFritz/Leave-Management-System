<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DutySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $duties = [
            [
                'code' => 'DUTY001',
                'name' => 'Project Management',
                'description' => 'Oversee project timelines, deliverables, and team coordination.',
                'status' => 'active',
            ],
            [
                'code' => 'DUTY002',
                'name' => 'Data Analysis',
                'description' => 'Analyze data trends to provide actionable insights.',
                'status' => 'active',
            ],
            [
                'code' => 'DUTY003',
                'name' => 'Customer Support',
                'description' => 'Handle customer inquiries and resolve issues effectively.',
                'status' => 'active',
            ],
            [
                'code' => 'DUTY004',
                'name' => 'Software Development',
                'description' => 'Design, develop, and maintain software applications.',
                'status' => 'active',
            ],
            [
                'code' => 'DUTY005',
                'name' => 'Quality Assurance Testing',
                'description' => 'Test and validate product quality before release.',
                'status' => 'active',
            ],
            [
                'code' => 'DUTY006',
                'name' => 'Marketing Strategy',
                'description' => 'Plan and execute marketing campaigns to drive growth.',
                'status' => 'active',
            ],
            [
                'code' => 'DUTY007',
                'name' => 'Team Training',
                'description' => 'Provide training and mentorship to team members.',
                'status' => 'active',
            ],
            [
                'code' => 'DUTY008',
                'name' => 'Financial Reporting',
                'description' => 'Prepare and review financial reports for stakeholders.',
                'status' => 'active',
            ],
            [
                'code' => 'DUTY009',
                'name' => 'Inventory Management',
                'description' => 'Monitor and manage stock levels and logistics.',
                'status' => 'active',
            ],
            [
                'code' => 'DUTY010',
                'name' => 'Content Creation',
                'description' => 'Develop engaging content for various platforms.',
                'status' => 'active',
            ],
        ];

        // Insert duties into the database
        DB::table('duties')->insert($duties);
    }
}
