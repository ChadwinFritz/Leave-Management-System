<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('leave_types')->insert([
            [
                'code' => 'ANNUAL',
                'name' => 'Annual Leave',
                'has_limit' => true,
                'limit' => 20, // Example limit for annual leave
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'SICK',
                'name' => 'Sick Leave',
                'has_limit' => true,
                'limit' => 15, // Example limit for sick leave
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'CASUAL',
                'name' => 'Casual Leave',
                'has_limit' => true,
                'limit' => 10, // Example limit for casual leave
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'COMPENSATORY',
                'name' => 'Compensatory Leave',
                'has_limit' => false, // No limit for compensatory leave
                'limit' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'MATERNITY',
                'name' => 'Maternity Leave',
                'has_limit' => true,
                'limit' => 90, // Example limit for maternity leave
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'PATERNITY',
                'name' => 'Paternity Leave',
                'has_limit' => true,
                'limit' => 10, // Example limit for paternity leave
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'UNPAID',
                'name' => 'Unpaid Leave',
                'has_limit' => false, // No limit for unpaid leave
                'limit' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
