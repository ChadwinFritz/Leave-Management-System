<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence, // Random task title
            'description' => $this->faker->paragraph, // Random task description
            'status' => $this->faker->randomElement(Task::getStatuses()), // Random status
            'user_id' => User::factory(), // Create and assign a random user
        ];
    }

    /**
     * State to create a task with a specific status.
     *
     * @param string $status
     * @return static
     */
    public function withStatus(string $status): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => $status,  // Set the specific status
        ]);
    }

    /**
     * State to create a task with a specific user.
     *
     * @param int $userId
     * @return static
     */
    public function assignedToUser(int $userId): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $userId, // Assign the task to the specific user
        ]);
    }

    /**
     * State to create a task with a completed status.
     *
     * @return static
     */
    public function completed(): static
    {
        return $this->withStatus(Task::STATUS_COMPLETED);  // Set the status to 'completed'
    }

    /**
     * State to create a task with an in-progress status.
     *
     * @return static
     */
    public function inProgress(): static
    {
        return $this->withStatus(Task::STATUS_IN_PROGRESS);  // Set the status to 'in_progress'
    }

    /**
     * State to create a task with a pending status.
     *
     * @return static
     */
    public function pending(): static
    {
        return $this->withStatus(Task::STATUS_PENDING);  // Set the status to 'pending'
    }

    /**
     * State to create a task with an archived status.
     *
     * @return static
     */
    public function archived(): static
    {
        return $this->withStatus(Task::STATUS_ARCHIVED);  // Set the status to 'archived'
    }

    /**
     * State to create a task with a specific title and description.
     *
     * @param string $title
     * @param string $description
     * @return static
     */
    public function withTitleAndDescription(string $title, string $description): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => $title,  // Set the title
            'description' => $description,  // Set the description
        ]);
    }
}
