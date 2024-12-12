<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run seeders in a logical order to maintain dependencies
        $this->call([

            // Seed Users first, as they are referenced by many other tables
            UserSeeder::class,

            // Seed departments (necessary for employees and teams)
            DepartmentSeeder::class,

            // Seed duties for employees to reference
            DutySeeder::class,

            // Employees depend on users, departments, and duties
            EmployeeSeeder::class,

            // Employee duties should come after employees are seeded
            EmployeeDutySeeder::class,

            // Teams depend on departments and supervisors
            TeamSeeder::class,

            // Tasks and task assignments depend on teams and employees
            TaskSeeder::class,
            TaskAssignmentSeeder::class,

            // Leave-related data comes after employees
            LeaveTypeSeeder::class, // Defines leave types (e.g., sick, vacation)
            LeaveApplicationSeeder::class, // Employees apply for leave
            LeaveSeeder::class, // Actual leave records after approval

            // Notifications and escalation requests may come after the core data
            NotificationSeeder::class,
            EscalationRequestSeeder::class,

            // Team reports depend on teams
            TeamReportSeeder::class,

            // Availability data depends on employees being seeded
            AvailabilitySeeder::class,

            // Audit logs should come last since they track actions from all modules
            AuditLogSeeder::class,
        ]);

        // Notify when seeding is complete
        $this->command->info('Database seeding completed successfully!');
    }
}
