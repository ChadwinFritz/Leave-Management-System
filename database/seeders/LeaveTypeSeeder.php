<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 random leave types
        LeaveType::factory()->count(10)->create();

        // Create 5 leave types with limits
        LeaveType::factory()
            ->count(5)
            ->withLimit()
            ->create();

        // Create 5 leave types without limits
        LeaveType::factory()
            ->count(5)
            ->withoutLimit()
            ->create();

        // Create 3 leave types with specific codes
        LeaveType::factory()
            ->count(3)
            ->withCode('SICK_LEAVE')
            ->create();

        LeaveType::factory()
            ->count(3)
            ->withCode('VACATION_LEAVE')
            ->create();

        // Create 2 leave types with specific names
        LeaveType::factory()
            ->count(2)
            ->withName('Parental Leave')
            ->create();

        LeaveType::factory()
            ->count(2)
            ->withName('Emergency Leave')
            ->create();
    }
}
