<?php

namespace Database\Factories;

use App\Models\TaskAssignment;
use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskAssignment>
 */
class TaskAssignmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaskAssignment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),  // Create and assign a random employee
            'task_id' => Task::factory(),  // Create and assign a random task
            'assigned_by' => User::factory(),  // Create and assign a random user who assigns the task
            'status' => $this->faker->randomElement(TaskAssignment::getStatuses()),  // Random status
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),  // Random due date within 1 month
        ];
    }

    /**
     * State to create a task assignment with a specific status.
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
     * State to create a task assignment with a specific employee.
     *
     * @param int $employeeId
     * @return static
     */
    public function assignedToEmployee(int $employeeId): static
    {
        return $this->state(fn (array $attributes) => [
            'employee_id' => $employeeId,  // Assign the task to the specific employee
        ]);
    }

    /**
     * State to create a task assignment with a specific task.
     *
     * @param int $taskId
     * @return static
     */
    public function forTask(int $taskId): static
    {
        return $this->state(fn (array $attributes) => [
            'task_id' => $taskId,  // Assign the task to the specific task
        ]);
    }

    /**
     * State to create a task assignment created by a specific user.
     *
     * @param int $userId
     * @return static
     */
    public function assignedByUser(int $userId): static
    {
        return $this->state(fn (array $attributes) => [
            'assigned_by' => $userId,  // Set the user who assigned the task
        ]);
    }

    /**
     * State to create a task assignment created by a specific supervisor.
     *
     * @param int $supervisorId
     * @return static
     */
    public function assignedBySupervisor(int $supervisorId): static
    {
        return $this->state(fn (array $attributes) => [
            'supervisor_id' => $supervisorId,  // Assign the task to the specific supervisor
        ]);
    }

    /**
     * State to create a task assignment with a specific due date.
     *
     * @param \DateTime $dueDate
     * @return static
     */
    public function withDueDate(\DateTime $dueDate): static
    {
        return $this->state(fn (array $attributes) => [
            'due_date' => $dueDate,  // Set the due date
        ]);
    }

    /**
     * State to create a pending task assignment.
     *
     * @return static
     */
    public function pending(): static
    {
        return $this->withStatus(TaskAssignment::STATUS_PENDING);  // Set the status to 'pending'
    }

    /**
     * State to create an in-progress task assignment.
     *
     * @return static
     */
    public function inProgress(): static
    {
        return $this->withStatus(TaskAssignment::STATUS_IN_PROGRESS);  // Set the status to 'in_progress'
    }

    /**
     * State to create a completed task assignment.
     *
     * @return static
     */
    public function completed(): static
    {
        return $this->withStatus(TaskAssignment::STATUS_COMPLETED);  // Set the status to 'completed'
    }

    /**
     * State to create an archived task assignment.
     *
     * @return static
     */
    public function archived(): static
    {
        return $this->withStatus(TaskAssignment::STATUS_ARCHIVED);  // Set the status to 'archived'
    }
}
