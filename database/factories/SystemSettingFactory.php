<?php

namespace Database\Factories;

use App\Models\SystemSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SystemSetting>
 */
class SystemSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SystemSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->word, // Generates a unique setting key
            'value' => $this->faker->word, // Random value for the setting
        ];
    }

    /**
     * State to create a setting with a specific key.
     *
     * @param string $key
     * @return static
     */
    public function withKey(string $key): static
    {
        return $this->state(fn (array $attributes) => [
            'key' => $key, // Set a custom key for the setting
        ]);
    }

    /**
     * State to create a setting with a specific value.
     *
     * @param string $value
     * @return static
     */
    public function withValue(string $value): static
    {
        return $this->state(fn (array $attributes) => [
            'value' => $value, // Set a custom value for the setting
        ]);
    }

    /**
     * State to create a setting with a specific key-value pair.
     *
     * @param string $key
     * @param string $value
     * @return static
     */
    public function withKeyValue(string $key, string $value): static
    {
        return $this->state(fn (array $attributes) => [
            'key' => $key,  // Set the key
            'value' => $value,  // Set the value
        ]);
    }

    /**
     * State to create a setting with a random key and a value.
     *
     * @return static
     */
    public function randomSetting(): static
    {
        return $this->state(fn (array $attributes) => [
            'key' => $this->faker->unique()->word, // Random unique key
            'value' => $this->faker->word,  // Random value
        ]);
    }
}
