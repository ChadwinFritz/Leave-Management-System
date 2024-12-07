<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EscalationRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $escalationRequests = [
            [
                'employee_id' => 1, // Peter Parker (User ID 1)
                'user_id' => 4, // Natasha Romanoff (User ID 4)
                'reason' => 'Requesting escalation for delayed project approval.',
                'status' => 'pending',
                'date_requested' => Carbon::now()->subDays(2),
            ],
            [
                'employee_id' => 4, // Tony Stark (User ID 2)
                'user_id' => 5, // Natasha Romanoff (User ID 4)
                'reason' => 'Escalating due to issues with resource allocation for current project.',
                'status' => 'approved',
                'date_requested' => Carbon::now()->subWeek(),
            ],
            [
                'employee_id' => 3, // Steve Rogers (User ID 3)
                'user_id' => 4, // Natasha Romanoff (User ID 4)
                'reason' => 'Requesting immediate escalation due to urgent budget approval.',
                'status' => 'pending',
                'date_requested' => Carbon::now()->subDays(1),
            ],
            [
                'employee_id' => 4, // Natasha Romanoff (User ID 4)
                'user_id' => 4, // Natasha Romanoff (User ID 4)
                'reason' => 'Escalation for delayed response from HR regarding a personnel issue.',
                'status' => 'rejected',
                'date_requested' => Carbon::now()->subMonth(),
            ],
            [
                'employee_id' => 5, // Bruce Banner (User ID 5)
                'user_id' => 4, // Natasha Romanoff (User ID 4)
                'reason' => 'Escalation request for the urgent need to resolve team conflict.',
                'status' => 'approved',
                'date_requested' => Carbon::now()->subDays(3),
            ],
        ];

        // Insert escalation requests into the database
        DB::table('escalation_requests')->insert($escalationRequests);
    }
}
