<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Supervisor;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,  // Random company name for the team
            'supervisor_id' => Supervisor::factory(),  // Assign a random supervisor
            'department_id' => Department::factory(),  // Assign a random department
        ];
    }

    /**
     * State to create a team for a specific department.
     *
     * @param int $departmentId
     * @return static
     */
    public function inDepartment(int $departmentId): static
    {
        return $this->state(fn (array $attributes) => [
            'department_id' => $departmentId,  // Set the specific department ID
        ]);
    }

    /**
     * State to create a team led by a specific supervisor.
     *
     * @param int $supervisorId
     * @return static
     */
    public function ledBySupervisor(int $supervisorId): static
    {
        return $this->state(fn (array $attributes) => [
            'supervisor_id' => $supervisorId,  // Set the supervisor ID
        ]);
    }

    /**
     * State to create a team with a specific name.
     *
     * @param string $name
     * @return static
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,  // Set a custom name for the team
        ]);
    }

    /**
     * State to create a team with a specific supervisor and department.
     *
     * @param int $supervisorId
     * @param int $departmentId
     * @return static
     */
    public function withSupervisorAndDepartment(int $supervisorId, int $departmentId): static
    {
        return $this->state(fn (array $attributes) => [
            'supervisor_id' => $supervisorId,  // Set the supervisor ID
            'department_id' => $departmentId,  // Set the department ID
        ]);
    }
}
