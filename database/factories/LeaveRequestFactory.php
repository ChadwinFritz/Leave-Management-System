<?php

namespace Database\Factories;

use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\LeaveApplication;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeaveRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(), // Creates a related Employee
            'leave_application_id' => LeaveApplication::factory(), // Creates a related LeaveApplication
            'request_date' => $this->faker->date(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'reason' => $this->faker->sentence(),
            'status' => LeaveRequest::STATUS_PENDING, // Default status is pending
        ];
    }

    /**
     * State for pending leave requests.
     *
     * @return static
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LeaveRequest::STATUS_PENDING,
        ]);
    }

    /**
     * State for approved leave requests.
     *
     * @return static
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LeaveRequest::STATUS_APPROVED,
        ]);
    }

    /**
     * State for rejected leave requests.
     *
     * @return static
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LeaveRequest::STATUS_REJECTED,
        ]);
    }

    /**
     * State for assigning a supervisor to the leave request.
     *
     * @param int $supervisorId
     * @return static
     */
    public function withSupervisor(int $supervisorId): static
    {
        return $this->state(fn (array $attributes) => [
            'supervisor_id' => $supervisorId,
        ]);
    }

    /**
     * State for leave requests with specific dates.
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
}
