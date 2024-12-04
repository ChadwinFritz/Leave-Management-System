<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use App\Models\User;
use App\Models\Department;
use App\Models\Team;
use Illuminate\Database\Seeder;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 random supervisors with default states
        Supervisor::factory()->count(5)->create();

        // Create 3 department head supervisors
        Supervisor::factory()
            ->count(3)
            ->departmentHead()  // Set as department head (with a department)
            ->create();

        // Create 3 team leader supervisors
        Supervisor::factory()
            ->count(3)
            ->teamLeader()  // Set as team leader (with a team)
            ->create();

        // Create 2 senior supervisors (manages multiple teams)
        Supervisor::factory()
            ->count(2)
            ->seniorSupervisor()  // Set as senior supervisor (with multiple teams)
            ->create();

        // Create 4 supervisors without a department or team
        Supervisor::factory()
            ->count(4)
            ->withoutDepartment()  // Set without department
            ->withoutTeam()  // Set without team
            ->create();

        // Create 3 supervisors in a specific department (using an existing department)
        $departmentId = Department::first()->id;  // Assuming at least one department exists
        Supervisor::factory()
            ->count(3)
            ->inDepartment($departmentId)  // Assign to a specific department
            ->create();

        // Create 3 supervisors in a specific team (using an existing team)
        $teamId = Team::first()->id;  // Assuming at least one team exists
        Supervisor::factory()
            ->count(3)
            ->inTeam($teamId)  // Assign to a specific team
            ->create();
    }
}
