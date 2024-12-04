<?php

namespace Database\Factories;

use App\Models\EmployeeDuty;
use App\Models\Employee;
use App\Models\Duty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeDuty>
 */
class EmployeeDutyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeDuty::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(), // Creates a related Employee
            'duty_id' => Duty::factory(),         // Creates a related Duty
            'assigned_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
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
     * State to assign a specific duty.
     *
     * @param int $dutyId
     * @return static
     */
    public function forDuty(int $dutyId): static
    {
        return $this->state(fn (array $attributes) => [
            'duty_id' => $dutyId,
        ]);
    }

    /**
     * State to assign a duty on a specific date.
     *
     * @param string|\DateTime $date
     * @return static
     */
    public function assignedOn($date): static
    {
        return $this->state(fn (array $attributes) => [
            'assigned_at' => $date,
        ]);
    }
}
