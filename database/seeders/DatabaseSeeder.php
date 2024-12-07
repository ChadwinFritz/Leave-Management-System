<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run seeders in a logical order to maintain dependencies
        $this->call([
            // Users must be seeded first as many entities depend on them
            UserSeeder::class,

            // Departments, supervisors, and employees are foundational data
            DepartmentSeeder::class,
            EmployeeSeeder::class,

            // Teams depend on departments and supervisors
            TeamSeeder::class,

            // Tasks and task assignments depend on teams and employees
            TaskSeeder::class,
            TaskAssignmentSeeder::class,

            // Leave-related data must follow employees
            LeaveTypeSeeder::class, // Defines leave types (e.g., sick, vacation)
            LeaveApplicationSeeder::class, // Employees apply for leave
            LeaveSeeder::class, // Actual leave records after approval

            // Other modules like notifications, escalation requests, and audit logs
            NotificationSeeder::class,
            EscalationRequestSeeder::class,

            // Team reports depend on teams
            TeamReportSeeder::class,

            // Availability data for employees
            AvailabilitySeeder::class,

            // Audit logs can seed last since they can log actions from all above seeders
            AuditLogSeeder::class,
        ]);

        $this->command->info('Database seeding completed successfully!');
    }
}
