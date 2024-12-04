<?php

namespace Database\Factories;

use App\Models\Supervisor;
use App\Models\User;
use App\Models\Department;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supervisor>
 */
class SupervisorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supervisor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),  // Associate with a random user using the User factory
            'department_id' => Department::factory(),  // Associate with a random department
            'team_id' => Team::factory(),  // Associate with a random team
        ];
    }

    /**
     * State for a supervisor without a department.
     *
     * @return static
     */
    public function withoutDepartment(): static
    {
        return $this->state(fn (array $attributes) => [
            'department_id' => null,  // Set department_id to null
        ]);
    }

    /**
     * State for a supervisor without a team.
     *
     * @return static
     */
    public function withoutTeam(): static
    {
        return $this->state(fn (array $attributes) => [
            'team_id' => null,  // Set team_id to null
        ]);
    }

    /**
     * State for a department head supervisor (has a department).
     *
     * @return static
     */
    public function departmentHead(): static
    {
        return $this->state(fn (array $attributes) => [
            'department_id' => Department::factory(),  // Associate with a random department
        ]);
    }

    /**
     * State for a team leader supervisor (has a team).
     *
     * @return static
     */
    public function teamLeader(): static
    {
        return $this->state(fn (array $attributes) => [
            'team_id' => Team::factory(),  // Associate with a random team
        ]);
    }

    /**
     * State for a senior supervisor (manages multiple teams).
     *
     * @return static
     */
    public function seniorSupervisor(): static
    {
        return $this->state(fn (array $attributes) => [
            'team_id' => Team::factory()->count(2),  // Associate with multiple teams
        ]);
    }

    /**
     * State for a supervisor in a specific department.
     *
     * @param int $departmentId
     * @return static
     */
    public function inDepartment(int $departmentId): static
    {
        return $this->state(fn (array $attributes) => [
            'department_id' => $departmentId,  // Set the department ID for the supervisor
        ]);
    }

    /**
     * State for a supervisor in a specific team.
     *
     * @param int $teamId
     * @return static
     */
    public function inTeam(int $teamId): static
    {
        return $this->state(fn (array $attributes) => [
            'team_id' => $teamId,  // Set the team ID for the supervisor
        ]);
    }
}
