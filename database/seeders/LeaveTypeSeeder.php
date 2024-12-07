<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaveTypes = [
            [
                'code' => 'LT001',
                'name' => 'Annual Leave',
                'has_limit' => true,
                'limit' => 20, // Typical annual leave days
            ],
            [
                'code' => 'LT002',
                'name' => 'Sick Leave',
                'has_limit' => true,
                'limit' => 10, // Typical sick leave days per year
            ],
            [
                'code' => 'LT003',
                'name' => 'Maternity Leave',
                'has_limit' => true,
                'limit' => 90, // Maternity leave in days
            ],
            [
                'code' => 'LT004',
                'name' => 'Paternity Leave',
                'has_limit' => true,
                'limit' => 15, // Paternity leave in days
            ],
            [
                'code' => 'LT005',
                'name' => 'Bereavement Leave',
                'has_limit' => true,
                'limit' => 5, // Bereavement leave in days
            ],
            [
                'code' => 'LT006',
                'name' => 'Compensatory Leave',
                'has_limit' => false, // No predefined limit; depends on accrued compensatory hours
                'limit' => null,
            ],
            [
                'code' => 'LT007',
                'name' => 'Unpaid Leave',
                'has_limit' => false, // No predefined limit as it is unpaid
                'limit' => null,
            ],
            [
                'code' => 'LT008',
                'name' => 'Study Leave',
                'has_limit' => true,
                'limit' => 10, // Days allowed for study or exams
            ],
            [
                'code' => 'LT009',
                'name' => 'Public Holiday Leave',
                'has_limit' => true,
                'limit' => 12, // Standard public holidays per year
            ],
            [
                'code' => 'LT010',
                'name' => 'Sabbatical Leave',
                'has_limit' => true,
                'limit' => 365, // A year for sabbatical
            ],
        ];

        // Insert leave types into the database
        DB::table('leave_types')->insert($leaveTypes);
    }
}
