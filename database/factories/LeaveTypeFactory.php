<?php

namespace Database\Factories;

use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveType>
 */
class LeaveTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeaveType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->word(),  // Generates a unique leave type code
            'name' => $this->faker->word(),  // Random name for the leave type
            'has_limit' => $this->faker->boolean(),  // Random boolean to determine if it has a limit
            'limit' => $this->faker->boolean() ? $this->faker->numberBetween(5, 30) : null,  // Random limit if applicable
        ];
    }

    /**
     * State for leave types that have a limit.
     *
     * @return static
     */
    public function withLimit(): static
    {
        return $this->state(fn (array $attributes) => [
            'has_limit' => true,
            'limit' => $this->faker->numberBetween(5, 30),  // Random limit between 5 and 30
        ]);
    }

    /**
     * State for leave types that don't have a limit.
     *
     * @return static
     */
    public function withoutLimit(): static
    {
        return $this->state(fn (array $attributes) => [
            'has_limit' => false,
            'limit' => null,  // No limit for unlimited leave type
        ]);
    }

    /**
     * State for leave types with a specific code.
     *
     * @param string $code
     * @return static
     */
    public function withCode(string $code): static
    {
        return $this->state(fn (array $attributes) => [
            'code' => $code,  // Set a specific leave type code
        ]);
    }

    /**
     * State for leave types with a specific name.
     *
     * @param string $name
     * @return static
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,  // Set a specific name for the leave type
        ]);
    }
}
