<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\LeaveTypeSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\DutySeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\LeaveSeeder;
use Database\Seeders\LeaveApplicationSeeder;
use Database\Seeders\SystemSettingsSeeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call individual seeders in the correct order
        $this->call([
            LeaveTypeSeeder::class,       // 1. Leave Types
            DepartmentSeeder::class,      // 2. Departments
            DutySeeder::class,            // 3. Duties
            UserSeeder::class,            // 4. Users
            EmployeeSeeder::class,        // 5. Employees
            LeaveSeeder::class,           // 6. Leaves
            LeaveApplicationSeeder::class, // 7. Leave Applications
            SystemSettingsSeeder::class,  // 8. System Settings
            AdminSeeder::class            // 9. Admins
        ]);
    }
}
