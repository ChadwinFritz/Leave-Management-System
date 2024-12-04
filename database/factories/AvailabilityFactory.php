<?php

namespace Database\Factories;

use App\Models\Availability;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Availability>
 */
class AvailabilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Availability::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        // Generate random availability times
        $from = $this->faker->dateTimeBetween('now', '+1 week');
        $to = (clone $from)->modify('+4 hours'); // Availability lasts for 4 hours

        return [
            'employee_id' => Employee::factory(), // Generate an associated employee
            'available_from' => $from,
            'available_to' => $to,
            'status' => $this->faker->randomElement(['available', 'unavailable']), // Random status
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * State to set the availability as active.
     *
     * @return static
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'available',
        ]);
    }

    /**
     * State to set the availability as inactive.
     *
     * @return static
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'unavailable',
        ]);
    }

    /**
     * State to set custom availability times.
     *
     * @param string $from
     * @param string $to
     * @return static
     */
    public function withTimeRange(string $from, string $to): static
    {
        return $this->state(fn (array $attributes) => [
            'available_from' => Carbon::parse($from),
            'available_to' => Carbon::parse($to),
        ]);
    }

    /**
     * State to assign availability to a specific employee.
     *
     * @param int $employeeId
     * @return static
     */
    public function forEmployee(int $employeeId): static
    {
        return $this->state(fn (array $attributes) => [
            'employee_id' => $employeeId,
        ]);
    }
}
