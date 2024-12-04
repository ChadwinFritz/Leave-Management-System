<?php

namespace Database\Seeders;

use App\Models\Duty;
use Illuminate\Database\Seeder;

class DutySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 20 random duties
        Duty::factory()->count(20)->create();

        // Example: Create 5 specific active duties with specific names and codes
        foreach (range(1, 5) as $i) {
            Duty::factory()
                ->active()  // Set the duty to active
                ->withName("Duty Name $i")  // Set custom duty names
                ->withCode("DUTY-100$i")  // Set custom duty codes
                ->create();
        }

        // Example: Create 3 specific inactive duties with specific names
        foreach (range(1, 3) as $i) {
            Duty::factory()
                ->inactive()  // Set the duty to inactive
                ->withName("Inactive Duty $i")  // Set custom inactive duty names
                ->withCode("DUTY-200$i")  // Set custom duty codes
                ->create();
        }

        // Example: Create a duty with a custom description
        Duty::factory()->create([
            'name' => 'Admin Duty',
            'description' => 'This duty involves overseeing administrative tasks and managing systems.',
            'status' => 'active',
        ]);
    }
}
