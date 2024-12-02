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
    public function run(): void
    {
        // Get a list of all supervisors and departments to associate with the teams
        $supervisors = Supervisor::all();
        $departments = Department::all();

        // Define a few example team names
        $teamNames = ['Development', 'Marketing', 'Sales', 'HR', 'Operations'];

        // Loop through each department and assign a random supervisor
        foreach ($departments as $department) {
            foreach ($teamNames as $teamName) {
                // Select a random supervisor from the list
                $supervisor = $supervisors->random();

                // Create a team for the department
                Team::create([
                    'name' => $teamName . ' Team', // Assign a name based on the team type
                    'supervisor_id' => $supervisor->id, // Associate the supervisor
                    'department_id' => $department->id, // Associate the department
                ]);
            }
        }

        // Optionally, print a message to indicate successful seeding
        $this->command->info('Teams have been seeded successfully!');
    }
}
