<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),  // Associate with a random user using the User factory
            'message' => $this->faker->sentence(),  // Random message for the notification
            'type' => $this->faker->randomElement(['leave_approval', 'reminder', 'alert', 'announcement']),  // Random type of notification
            'is_read' => $this->faker->boolean(),  // Random read status
        ];
    }

    /**
     * State for unread notifications.
     *
     * @return static
     */
    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => false,  // Mark as unread
        ]);
    }

    /**
     * State for read notifications.
     *
     * @return static
     */
    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => true,  // Mark as read
        ]);
    }

    /**
     * State for notifications of a specific type.
     *
     * @param string $type
     * @return static
     */
    public function withType(string $type): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => $type,  // Set a specific notification type
        ]);
    }

    /**
     * State for notifications for a specific user.
     *
     * @param int $userId
     * @return static
     */
    public function forUser(int $userId): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $userId,  // Set the user ID for the notification
        ]);
    }

    /**
     * State for notifications with a specific message.
     *
     * @param string $message
     * @return static
     */
    public function withMessage(string $message): static
    {
        return $this->state(fn (array $attributes) => [
            'message' => $message,  // Set a specific message for the notification
        ]);
    }
}
