<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Department', // Generate a department-like name
            'description' => $this->faker->paragraph, // Random description
            'manager_id' => Employee::factory(), // Generate a manager using the Employee factory
            'supervisor_id' => Employee::factory(), // Generate a supervisor using the Employee factory
            'status' => $this->faker->randomElement(['active', 'inactive']), // Randomly assign active or inactive status
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * State to set the department as active.
     *
     * @return static
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * State to set the department as inactive.
     *
     * @return static
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inactive',
        ]);
    }

    /**
     * State to assign a specific manager to the department.
     *
     * @param int $managerId
     * @return static
     */
    public function withManager(int $managerId): static
    {
        return $this->state(fn (array $attributes) => [
            'manager_id' => $managerId,
        ]);
    }

    /**
     * State to assign a specific supervisor to the department.
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
}
