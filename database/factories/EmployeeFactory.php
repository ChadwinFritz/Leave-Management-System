<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        // Generate a unique employee code
        static $codeCounter = 1;
        $employeeCode = 'EMP' . str_pad($codeCounter++, 5, '0', STR_PAD_LEFT);

        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'hire_date' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'user_id' => User::factory(), // Create a related User
            'department_id' => Department::factory(), // Create a related Department
            'employee_code' => $employeeCode, // Unique employee code
            'employment_status' => $this->faker->randomElement(['active', 'inactive']),
            'notes' => $this->faker->optional()->text(200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * State to set the employee as active.
     *
     * @return static
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'employment_status' => 'active',
        ]);
    }

    /**
     * State to set the employee as inactive.
     *
     * @return static
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'employment_status' => 'inactive',
        ]);
    }

    /**
     * State to assign an employee to a specific department.
     *
     * @param int $departmentId
     * @return static
     */
    public function inDepartment(int $departmentId): static
    {
        return $this->state(fn (array $attributes) => [
            'department_id' => $departmentId,
        ]);
    }

    /**
     * State to hire an employee on or after a specific date.
     *
     * @param string|\DateTime $date
     * @return static
     */
    public function hiredOnOrAfter($date): static
    {
        return $this->state(fn (array $attributes) => [
            'hire_date' => $this->faker->dateTimeBetween($date, 'now'),
        ]);
    }

    /**
     * State to hire an employee before a specific date.
     *
     * @param string|\DateTime $date
     * @return static
     */
    public function hiredBefore($date): static
    {
        return $this->state(fn (array $attributes) => [
            'hire_date' => $this->faker->dateTimeBetween('-10 years', $date),
        ]);
    }
}
