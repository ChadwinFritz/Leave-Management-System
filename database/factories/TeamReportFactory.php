<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\TeamReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamReport>
 */
class TeamReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),  // Create a random team for the report
            'report_date' => $this->faker->date(),  // Random date for the report
            'performance_score' => $this->faker->randomFloat(2, 50, 100),  // Random performance score between 50 and 100
            'attendance_percentage' => $this->faker->randomFloat(2, 70, 100),  // Random attendance percentage between 70 and 100
            'leave_percentage' => $this->faker->randomFloat(2, 0, 20),  // Random leave percentage between 0 and 20
        ];
    }

    /**
     * State to create a report for a specific team.
     *
     * @param int $teamId
     * @return static
     */
    public function forTeam(int $teamId): static
    {
        return $this->state(fn (array $attributes) => [
            'team_id' => $teamId,  // Set the specific team ID
        ]);
    }

    /**
     * State to create a report with a specific performance score.
     *
     * @param float $performanceScore
     * @return static
     */
    public function withPerformanceScore(float $performanceScore): static
    {
        return $this->state(fn (array $attributes) => [
            'performance_score' => $performanceScore,  // Set the performance score
        ]);
    }

    /**
     * State to create a report with a specific attendance percentage.
     *
     * @param float $attendancePercentage
     * @return static
     */
    public function withAttendancePercentage(float $attendancePercentage): static
    {
        return $this->state(fn (array $attributes) => [
            'attendance_percentage' => $attendancePercentage,  // Set the attendance percentage
        ]);
    }

    /**
     * State to create a report with a specific leave percentage.
     *
     * @param float $leavePercentage
     * @return static
     */
    public function withLeavePercentage(float $leavePercentage): static
    {
        return $this->state(fn (array $attributes) => [
            'leave_percentage' => $leavePercentage,  // Set the leave percentage
        ]);
    }

    /**
     * State to create a report for a specific date range.
     *
     * @param \Carbon\Carbon $startDate
     * @param \Carbon\Carbon $endDate
     * @return static
     */
    public function withinDateRange($startDate, $endDate): static
    {
        return $this->state(fn (array $attributes) => [
            'report_date' => $this->faker->dateBetween($startDate, $endDate),  // Generate a date within the range
        ]);
    }
}
