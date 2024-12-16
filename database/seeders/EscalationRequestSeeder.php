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
                'employee_id' => 1, // Employee: Peter Parker
                'user_id' => 4, // User: Natasha Romanoff
                'reason' => 'Requesting escalation for delayed project approval.',
                'status' => 'pending',
                'date_requested' => Carbon::now()->subDays(2),
            ],
            [
                'employee_id' => 2, // Employee: Tony Stark
                'user_id' => 5, // User: Bruce Banner
                'reason' => 'Escalating due to issues with resource allocation for current project.',
                'status' => 'approved',
                'date_requested' => Carbon::now()->subWeek(),
            ],
            [
                'employee_id' => 3, // Employee: Steve Rogers
                'user_id' => 4, // User: Natasha Romanoff
                'reason' => 'Requesting immediate escalation due to urgent budget approval.',
                'status' => 'pending',
                'date_requested' => Carbon::now()->subDays(1),
            ],
            [
                'employee_id' => 4, // Employee: Natasha Romanoff
                'user_id' => 4, // User: Natasha Romanoff
                'reason' => 'Escalation for delayed response from HR regarding a personnel issue.',
                'status' => 'rejected',
                'date_requested' => Carbon::now()->subMonth(),
            ],
            [
                'employee_id' => 5, // Employee: Bruce Banner
                'user_id' => 4, // User: Natasha Romanoff
                'reason' => 'Escalation request for the urgent need to resolve team conflict.',
                'status' => 'approved',
                'date_requested' => Carbon::now()->subDays(3),
            ],
            [
                'employee_id' => 6, // Employee: Wanda Maximoff
                'user_id' => 7, // User: Clint Barton
                'reason' => 'Escalating due to delays in critical project feedback.',
                'status' => 'approved',
                'date_requested' => Carbon::now()->subDays(5),
            ],
            [
                'employee_id' => 7, // Employee: Clint Barton
                'user_id' => 8, // User: Sam Wilson
                'reason' => 'Escalation for missed deadlines and lack of coordination.',
                'status' => 'pending',
                'date_requested' => Carbon::now()->subDays(4),
            ],
            [
                'employee_id' => 8, // Employee: Sam Wilson
                'user_id' => 9, // User: Scott Lang
                'reason' => 'Escalation due to lack of communication regarding project status.',
                'status' => 'rejected',
                'date_requested' => Carbon::now()->subDays(10),
            ],
            [
                'employee_id' => 9, // Employee: Scott Lang
                'user_id' => 10, // User: Hope Van Dyne
                'reason' => 'Requesting escalation for urgent product review.',
                'status' => 'approved',
                'date_requested' => Carbon::now()->subWeek(),
            ],
            [
                'employee_id' => 10, // Employee: Hope Van Dyne
                'user_id' => 11, // User: Stephen Strange
                'reason' => 'Escalation for urgent resolution of technical issues.',
                'status' => 'pending',
                'date_requested' => Carbon::now()->subDays(6),
            ],
            [
                'employee_id' => 11, // Employee: Stephen Strange
                'user_id' => 12, // User: T'Challa
                'reason' => 'Escalation request for immediate response on project funding.',
                'status' => 'approved',
                'date_requested' => Carbon::now()->subDays(2),
            ],
            [
                'employee_id' => 12, // Employee: T'Challa
                'user_id' => 13, // User: Carol Danvers
                'reason' => 'Escalating issue of budget delay affecting multiple teams.',
                'status' => 'rejected',
                'date_requested' => Carbon::now()->subMonth(),
            ],
            [
                'employee_id' => 13, // Employee: Carol Danvers
                'user_id' => 14, // User: Bucky Barnes
                'reason' => 'Escalation due to lack of resources to meet project deadlines.',
                'status' => 'approved',
                'date_requested' => Carbon::now()->subDays(7),
            ],
            [
                'employee_id' => 14, // Employee: Bucky Barnes
                'user_id' => 15, // User: Nick Fury
                'reason' => 'Escalating due to delayed strategic decisions impacting timeline.',
                'status' => 'pending',
                'date_requested' => Carbon::now()->subDays(3),
            ],
            [
                'employee_id' => 15, // Employee: Nick Fury
                'user_id' => 1, // User: Peter Parker
                'reason' => 'Escalation request for immediate action on urgent project requirements.',
                'status' => 'approved',
                'date_requested' => Carbon::now()->subDays(5),
            ]
        ];

        // Insert escalation requests into the database
        DB::table('escalation_requests')->insert($escalationRequests);
    }
}
