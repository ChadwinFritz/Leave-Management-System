<?php

namespace Database\Factories;

use App\Models\Leave;
use App\Models\Employee;
use App\Models\LeaveApplication;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Leave::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = (clone $startDate)->modify('+'.rand(1, 5).' days');

        return [
            'employee_id' => Employee::factory(), // Creates a related Employee
            'leave_application_id' => LeaveApplication::factory(), // Creates a related LeaveApplication
            'total_leave' => $this->faker->numberBetween(1, 10),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'start_half' => $this->faker->boolean(),
            'end_half' => $this->faker->boolean(),
            'on_date' => null, // For single-day leave, can be left null unless explicitly set
            'on_time' => null, // Optional datetime for specific leave
            'leave_type' => LeaveType::factory()->create()->code, // Related LeaveType with code
            'status' => Leave::STATUS_PENDING, // Default status is pending
        ];
    }

    /**
     * State for pending leave.
     *
     * @return static
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Leave::STATUS_PENDING,
        ]);
    }

    /**
     * State for approved leave.
     *
     * @return static
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Leave::STATUS_APPROVED,
        ]);
    }

    /**
     * State for rejected leave.
     *
     * @return static
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Leave::STATUS_REJECTED,
        ]);
    }

    /**
     * State to create a leave for a specific employee.
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
     * State to associate with a specific leave application.
     *
     * @param int $leaveApplicationId
     * @return static
     */
    public function forLeaveApplication(int $leaveApplicationId): static
    {
        return $this->state(fn (array $attributes) => [
            'leave_application_id' => $leaveApplicationId,
        ]);
    }

    /**
     * State to set a specific leave type.
     *
     * @param string $leaveTypeCode
     * @return static
     */
    public function ofType(string $leaveTypeCode): static
    {
        return $this->state(fn (array $attributes) => [
            'leave_type' => $leaveTypeCode,
        ]);
    }

    /**
     * State to define a specific date range for the leave.
     *
     * @param string $startDate
     * @param string $endDate
     * @return static
     */
    public function dateRange(string $startDate, string $endDate): static
    {
        return $this->state(fn (array $attributes) => [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }

    /**
     * State to define single-day leave.
     *
     * @param string $date
     * @return static
     */
    public function singleDay(string $date): static
    {
        return $this->state(fn (array $attributes) => [
            'on_date' => $date,
            'start_date' => null,
            'end_date' => null,
        ]);
    }
}
