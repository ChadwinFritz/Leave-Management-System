<?php

namespace Database\Factories;

use App\Models\Duty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Duty>
 */
class DutyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Duty::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->bothify('DUTY-###??')), // Generate unique duty codes
            'name' => $this->faker->jobTitle, // Generate a duty name using job titles
            'description' => $this->faker->paragraph, // Generate a detailed description
            'status' => $this->faker->randomElement(['active', 'inactive']), // Randomly set status
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * State to set the duty as active.
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
     * State to set the duty as inactive.
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
     * State to use a specific code for the duty.
     *
     * @param string $code
     * @return static
     */
    public function withCode(string $code): static
    {
        return $this->state(fn (array $attributes) => [
            'code' => $code,
        ]);
    }

    /**
     * State to set a specific name for the duty.
     *
     * @param string $name
     * @return static
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
        ]);
    }
}
