<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 random departments with random managers and supervisors
        Department::factory()->count(50)->create();

        // Example: Create a specific active department with a specific manager and supervisor
        $manager = Employee::factory()->create();  // Create a manager
        $supervisor = Employee::factory()->create();  // Create a supervisor

        Department::factory()
            ->withManager($manager->id)  // Assign the created manager
            ->withSupervisor($supervisor->id)  // Assign the created supervisor
            ->active()  // Set the department to active
            ->create();

        // Example: Create inactive departments
        foreach (range(1, 5) as $i) {
            $manager = Employee::factory()->create();
            $supervisor = Employee::factory()->create();

            Department::factory()
                ->withManager($manager->id)
                ->withSupervisor($supervisor->id)
                ->inactive()  // Set the department to inactive
                ->create();
        }

        // Example: Create a specific department with a specific name
        Department::factory()->create([
            'name' => 'HR Department',  // Set a custom name
            'description' => 'Human resources and employee management.',  // Custom description
            'status' => 'active',  // Set to active status
        ]);
    }
}
