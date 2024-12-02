<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Step 1: Seed users first, as many entities depend on them
        $this->call(UserSeeder::class);
        
        // Step 2: Seed employees before departments, as departments need supervisors
        $this->call(EmployeeSeeder::class);
        
        // Step 3: Seed departments after employees (for supervisor assignment)
        $this->call(DepartmentSeeder::class);
        
        // Step 4: Seed duties, as they are prerequisites for employee duties
        $this->call(DutySeeder::class);
        
        // Step 5: Seed employee duties after employees and duties
        $this->call(EmployeeDutySeeder::class);
        
        // Step 6: Seed teams after departments
        $this->call(TeamSeeder::class);
        
        // Step 7: Seed supervisors after teams (to link with departments and employees)
        $this->call(SupervisorSeeder::class);
        
        // Step 8: Seed team reports after teams
        $this->call(TeamReportSeeder::class);
        
        // Step 9: Seed leave types, as leave applications depend on these
        $this->call(LeaveTypeSeeder::class);
        
        // Step 10: Seed leave applications after leave types
        $this->call(LeaveApplicationSeeder::class);
        
        // Step 11: Seed leave requests after leave applications
        $this->call(LeaveRequestSeeder::class);
        
        // Step 12: Seed leave records (leaves) after leave requests
        $this->call(LeaveSeeder::class);
        
        // Step 13: Seed tasks
        $this->call(TaskSeeder::class);
        
        // Step 14: Seed task assignments after tasks and employees
        $this->call(TaskAssignmentSeeder::class);
        
        // Step 15: Seed escalation requests after employees and supervisors
        $this->call(EscalationRequestSeeder::class);
        
        // Step 16: Seed notifications after users
        $this->call(NotificationSeeder::class);
        
        // Step 17: Seed availabilities after employees
        $this->call(AvailabilitySeeder::class);
        
        // Step 18: Seed audit logs last
        $this->call(AuditLogSeeder::class);
    }
}
