<?php

namespace Database\Factories;

use App\Models\EscalationRequest;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EscalationRequest>
 */
class EscalationRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EscalationRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),  // Creates a related Employee
            'supervisor_id' => Employee::factory(), // Creates a related Supervisor
            'reason' => $this->faker->sentence(),
            'status' => EscalationRequest::STATUS_PENDING, // Default status
            'date_requested' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * State for a pending escalation request.
     *
     * @return static
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => EscalationRequest::STATUS_PENDING,
        ]);
    }

    /**
     * State for an approved escalation request.
     *
     * @return static
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => EscalationRequest::STATUS_APPROVED,
        ]);
    }

    /**
     * State for a rejected escalation request.
     *
     * @return static
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => EscalationRequest::STATUS_REJECTED,
        ]);
    }

    /**
     * State to assign a specific employee.
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
     * State to assign a specific supervisor.
     *
     * @param int $supervisorId
     * @return static
     */
    public function forSupervisor(int $supervisorId): static
    {
        return $this->state(fn (array $attributes) => [
            'supervisor_id' => $supervisorId,
        ]);
    }

    /**
     * State to set a specific date requested.
     *
     * @param string|\DateTime $date
     * @return static
     */
    public function requestedOn($date): static
    {
        return $this->state(fn (array $attributes) => [
            'date_requested' => $date,
        ]);
    }
}
