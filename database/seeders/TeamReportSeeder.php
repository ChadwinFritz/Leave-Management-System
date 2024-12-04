<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\TeamReport;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TeamReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 random team reports
        TeamReport::factory()->count(5)->create();

        // Create 3 team reports for specific teams with custom performance scores
        $teamIds = Team::pluck('id')->take(3);  // Get first 3 team IDs
        foreach ($teamIds as $teamId) {
            TeamReport::factory()
                ->forTeam($teamId)  // Assign to specific team
                ->withPerformanceScore(rand(60, 90))  // Random performance score between 60 and 90
                ->count(1)
                ->create();
        }

        // Create 2 reports with specific attendance percentages
        TeamReport::factory()
            ->count(2)
            ->withAttendancePercentage(rand(75, 95))  // Random attendance percentage between 75 and 95
            ->create();

        // Create 2 reports with specific leave percentages
        TeamReport::factory()
            ->count(2)
            ->withLeavePercentage(rand(5, 15))  // Random leave percentage between 5 and 15
            ->create();

        // Create 3 reports with a specific date range (e.g., last month)
        $startDate = Carbon::now()->subMonth()->startOfMonth();
        $endDate = Carbon::now()->subMonth()->endOfMonth();
        TeamReport::factory()
            ->count(3)
            ->withinDateRange($startDate, $endDate)  // Generate reports within the last month
            ->create();

        // Create 2 reports with specific dates (e.g., this week)
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        TeamReport::factory()
            ->count(2)
            ->withinDateRange($startDate, $endDate)  // Generate reports within this week
            ->create();
    }
}
