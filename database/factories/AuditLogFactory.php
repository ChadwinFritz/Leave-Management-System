<?php

namespace Database\Factories;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuditLog>
 */
class AuditLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AuditLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Automatically create a User for the log
            'action' => $this->faker->randomElement([
                'created',
                'updated',
                'deleted',
                'logged_in',
                'logged_out',
            ]), // Generate a random action
            'ip_address' => $this->faker->ipv4, // Generate a random IP address
            'description' => $this->faker->sentence, // Generate a random description
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * State for a specific action.
     *
     * @param string $action
     * @return static
     */
    public function withAction(string $action): static
    {
        return $this->state(fn (array $attributes) => [
            'action' => $action,
        ]);
    }

    /**
     * State for a specific user.
     *
     * @param int $userId
     * @return static
     */
    public function forUser(int $userId): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $userId,
        ]);
    }

    /**
     * State for a specific IP address.
     *
     * @param string $ipAddress
     * @return static
     */
    public function fromIp(string $ipAddress): static
    {
        return $this->state(fn (array $attributes) => [
            'ip_address' => $ipAddress,
        ]);
    }
}
