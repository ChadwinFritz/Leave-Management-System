<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_types')->insert([
            [
                'code' => 'SICK',
                'name' => 'Sick Leave',
                'has_limit' => true,
                'limit' => 12, // 12 days limit per year
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'VAC',
                'name' => 'Vacation',
                'has_limit' => true,
                'limit' => 15, // 15 days limit per year
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'BEREAVEMENT',
                'name' => 'Bereavement Leave',
                'has_limit' => false, // No limit on bereavement leave
                'limit' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PERSONAL',
                'name' => 'Personal Leave',
                'has_limit' => true,
                'limit' => 5, // 5 days limit per year
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'MATERNITY',
                'name' => 'Maternity Leave',
                'has_limit' => true,
                'limit' => 90, // 90 days limit for maternity leave
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
