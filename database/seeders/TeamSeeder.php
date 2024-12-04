<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Supervisor;
use App\Models\Department;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 random teams with default state (random supervisor and department)
        Team::factory()->count(5)->create();

        // Create 3 teams for a specific department (using department ID)
        $departmentIds = Department::pluck('id')->take(3);  // Get first 3 department IDs
        foreach ($departmentIds as $departmentId) {
            Team::factory()
                ->inDepartment($departmentId)  // Assign to a specific department
                ->count(1)
                ->create();
        }

        // Create 3 teams led by a specific supervisor (using supervisor ID)
        $supervisorIds = Supervisor::pluck('id')->take(3);  // Get first 3 supervisor IDs
        foreach ($supervisorIds as $supervisorId) {
            Team::factory()
                ->ledBySupervisor($supervisorId)  // Assign to a specific supervisor
                ->count(1)
                ->create();
        }

        // Create 2 teams with custom names
        Team::factory()
            ->count(2)
            ->withName('Development Team')  // Set custom team name
            ->create();

        Team::factory()
            ->count(2)
            ->withName('Marketing Team')  // Set custom team name
            ->create();

        // Create 2 teams with a specific supervisor and department
        $departmentIds = Department::pluck('id')->take(2);  // Get first 2 department IDs
        $supervisorIds = Supervisor::pluck('id')->take(2);  // Get first 2 supervisor IDs
        for ($i = 0; $i < 2; $i++) {
            Team::factory()
                ->withSupervisorAndDepartment($supervisorIds[$i], $departmentIds[$i])  // Assign specific supervisor and department
                ->count(1)
                ->create();
        }
    }
}
