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
    public function run(): void
    {
        // Fetch all users, departments, and teams
        $users = User::all();
        $departments = Department::all();
        $teams = Team::all();

        // Assign supervisors to users
        foreach ($users as $user) {
            // Randomly assign a department and a team (optional)
            $department = $departments->random();
            $team = $teams->random();

            // Create supervisor record
            Supervisor::create([
                'user_id' => $user->id,
                'department_id' => $department->id,
                'team_id' => $team->id,
            ]);
        }

        // Optionally, print a message to indicate successful seeding
        $this->command->info('Supervisors have been seeded successfully!');
    }
}
