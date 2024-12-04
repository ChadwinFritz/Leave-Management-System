<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'username' => $this->faker->unique()->userName(),
            'password' => 'password',  // Default password, will be hashed automatically
            'status' => $this->faker->randomElement([User::STATUS_PENDING, User::STATUS_APPROVED, User::STATUS_INACTIVE]),
            'is_approved' => $this->faker->boolean(),
            'level' => $this->faker->randomElement([
                User::LEVEL_USER,
                User::LEVEL_ADMIN,
                User::LEVEL_SUPER_ADMIN,
                User::LEVEL_SUPERVISOR,
            ]),
        ];
    }

    /**
     * State to create a user with a specific level.
     *
     * @param int $level
     * @return static
     */
    public function withLevel(int $level): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => $level,
        ]);
    }

    /**
     * State to create a user with a specific status.
     *
     * @param string $status
     * @return static
     */
    public function withStatus(string $status): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => $status,
        ]);
    }

    /**
     * State to create a user with a specific approval status.
     *
     * @param bool $isApproved
     * @return static
     */
    public function withApproval(bool $isApproved): static
    {
        return $this->state(fn (array $attributes) => [
            'is_approved' => $isApproved,
        ]);
    }

    /**
     * State to create an approved user.
     *
     * @return static
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => User::STATUS_APPROVED,
            'is_approved' => true,
        ]);
    }

    /**
     * State to create a pending user.
     *
     * @return static
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => User::STATUS_PENDING,
            'is_approved' => false,
        ]);
    }

    /**
     * State to create an inactive user.
     *
     * @return static
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => User::STATUS_INACTIVE,
            'is_approved' => false,
        ]);
    }

    /**
     * State to create a user with a specific password.
     *
     * @param string $password
     * @return static
     */
    public function withPassword(string $password): static
    {
        return $this->state(fn (array $attributes) => [
            'password' => $password,  // The password will be hashed by the model's mutator
        ]);
    }

    /**
     * Create a user with a custom name.
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

    /**
     * Create a user with a custom email.
     *
     * @param string $email
     * @return static
     */
    public function withEmail(string $email): static
    {
        return $this->state(fn (array $attributes) => [
            'email' => $email,
        ]);
    }

    /**
     * Create a user with a specific username.
     *
     * @param string $username
     * @return static
     */
    public function withUsername(string $username): static
    {
        return $this->state(fn (array $attributes) => [
            'username' => $username,
        ]);
    }
}
