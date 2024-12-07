<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamReports = [
            [
                'team_id' => 1, // Innovation Team
                'report_date' => '2024-11-30',
                'performance_score' => 4.5,
                'attendance_percentage' => 95.0,
                'leave_percentage' => 2.0,
            ],
            [
                'team_id' => 2, // Recruitment Team
                'report_date' => '2024-11-30',
                'performance_score' => 4.2,
                'attendance_percentage' => 97.0,
                'leave_percentage' => 1.5,
            ],
            [
                'team_id' => 3, // Budget Planning Team
                'report_date' => '2024-11-30',
                'performance_score' => 4.3,
                'attendance_percentage' => 98.0,
                'leave_percentage' => 1.0,
            ],
            [
                'team_id' => 4, // Brand Management Team
                'report_date' => '2024-11-30',
                'performance_score' => 4.0,
                'attendance_percentage' => 94.0,
                'leave_percentage' => 3.0,
            ],
            [
                'team_id' => 5, // Logistics Team
                'report_date' => '2024-11-30',
                'performance_score' => 4.6,
                'attendance_percentage' => 99.0,
                'leave_percentage' => 0.5,
            ],
            [
                'team_id' => 6, // Tech Support Team
                'report_date' => '2024-11-30',
                'performance_score' => 4.1,
                'attendance_percentage' => 96.0,
                'leave_percentage' => 2.5,
            ],
            [
                'team_id' => 7, // Client Acquisition Team
                'report_date' => '2024-11-30',
                'performance_score' => 4.3,
                'attendance_percentage' => 97.5,
                'leave_percentage' => 1.8,
            ],
            [
                'team_id' => 8, // Compliance Team
                'report_date' => '2024-11-30',
                'performance_score' => 4.4,
                'attendance_percentage' => 98.5,
                'leave_percentage' => 1.2,
            ],
            [
                'team_id' => 9, // Customer Care Team
                'report_date' => '2024-11-30',
                'performance_score' => 4.0,
                'attendance_percentage' => 95.0,
                'leave_percentage' => 2.2,
            ],
            [
                'team_id' => 10, // Product Testing Team
                'report_date' => '2024-11-30',
                'performance_score' => 4.2,
                'attendance_percentage' => 96.5,
                'leave_percentage' => 1.8,
            ],
        ];

        // Insert team reports into the database
        DB::table('team_reports')->insert($teamReports);
    }
}
