<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TeamReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Get all teams from the database
        $teams = Team::all();

        // Define some example report dates, you can expand this as needed
        $reportDates = [
            Carbon::now()->subMonths(1), // 1 month ago
            Carbon::now()->subWeeks(2),  // 2 weeks ago
            Carbon::now(),               // Today
        ];

        // Loop through each team and assign a random report for each date
        foreach ($teams as $team) {
            foreach ($reportDates as $reportDate) {
                // Generate random performance, attendance, and leave percentages
                $performanceScore = rand(80, 100) / 20; // Random performance between 4.00 and 5.00
                $attendancePercentage = rand(80, 100); // Random attendance between 80% and 100%
                $leavePercentage = rand(0, 30); // Random leave percentage between 0% and 30%

                // Create a report for the team
                $team->reports()->create([
                    'report_date' => $reportDate->toDateString(),
                    'performance_score' => $performanceScore,
                    'attendance_percentage' => $attendancePercentage,
                    'leave_percentage' => $leavePercentage,
                ]);
            }
        }

        // Optionally, print a message to indicate successful seeding
        $this->command->info('Team reports have been seeded successfully!');
    }
}
