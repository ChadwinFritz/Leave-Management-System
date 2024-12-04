<?php

namespace Database\Factories;

use App\Models\LeaveApplication;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveApplication>
 */
class LeaveApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeaveApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = (clone $startDate)->modify('+' . rand(1, 5) . ' days');

        $startHalf = $this->faker->boolean();
        $endHalf = $this->faker->boolean();

        return [
            'employee_id' => Employee::factory(), // Creates a related Employee
            'leave_type_id' => LeaveType::factory(), // Creates a related LeaveType
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'start_half' => $startHalf,
            'end_half' => $endHalf,
            'number_of_days' => $this->calculateLeaveDays($startDate, $endDate, $startHalf, $endHalf),
            'on_date' => null, // For single-day leave, can be left null unless explicitly set
            'on_time' => null, // Optional datetime for specific leave
            'reason' => $this->faker->sentence(),
            'rejection_reason' => null,
            'total_leave' => rand(1, 10), // Random total leave days
            'status' => LeaveApplication::STATUS_PENDING, // Default status is pending
        ];
    }

    /**
     * Calculate the number of leave days.
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param bool $startHalf
     * @param bool $endHalf
     * @return int
     */
    private function calculateLeaveDays($startDate, $endDate, $startHalf, $endHalf): int
    {
        $start = Carbon::instance($startDate);
        $end = Carbon::instance($endDate);

        $days = $start->diffInDays($end) + 1; // Include the start date

        if ($startHalf) {
            $days -= 0.5;
        }

        if ($endHalf) {
            $days -= 0.5;
        }

        return max(1, $days); // Ensure at least 1 day is calculated
    }

    /**
     * State for pending leave applications.
     *
     * @return static
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LeaveApplication::STATUS_PENDING,
        ]);
    }

    /**
     * State for approved leave applications.
     *
     * @return static
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LeaveApplication::STATUS_APPROVED,
        ]);
    }

    /**
     * State for rejected leave applications.
     *
     * @return static
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LeaveApplication::STATUS_REJECTED,
        ]);
    }

    /**
     * State for a specific employee.
     *
     * @param int $employeeId
     * @return static
     */
    public function forEmployee(int $employeeId): static
    {
        return $this->state(fn (array $attributes) => [
            'employee_id' => $employeeId,
        ]);
    }

    /**
     * State for a specific leave type.
     *
     * @param int $leaveTypeId
     * @return static
     */
    public function ofType(int $leaveTypeId): static
    {
        return $this->state(fn (array $attributes) => [
            'leave_type_id' => $leaveTypeId,
        ]);
    }

    /**
     * State for single-day leave applications.
     *
     * @param string $date
     * @return static
     */
    public function singleDay(string $date): static
    {
        return $this->state(fn (array $attributes) => [
            'start_date' => $date,
            'end_date' => $date,
            'number_of_days' => 1,
            'on_date' => $date,
            'on_time' => null,
        ]);
    }

    /**
     * State for leave applications with a specific date range.
     *
     * @param string $startDate
     * @param string $endDate
     * @return static
     */
    public function dateRange(string $startDate, string $endDate): static
    {
        $startHalf = false;
        $endHalf = false;

        return $this->state(fn (array $attributes) => [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'start_half' => $startHalf,
            'end_half' => $endHalf,
            'number_of_days' => $this->calculateLeaveDays(
                Carbon::parse($startDate),
                Carbon::parse($endDate),
                $startHalf,
                $endHalf
            ),
        ]);
    }
}
