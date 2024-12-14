<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamLeaveController extends Controller
{

    /**
     * Display the list of team members and their leave information.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch the team members for the logged-in supervisor
        // Assuming Employee model has a relationship with LeaveApplication
        $teamMembers = Employee::where('supervisor_id', Auth::id())
                               ->with(['leaveApplications' => function($query) {
                                   $query->orderBy('start_date', 'desc'); // Order leave applications by start date
                               }])  // Eager load the leave applications data
                               ->get();

        // Pass the team members' data to the view
        return view('supervisor.supervisor_team_leave', [
            'teamMembers' => $teamMembers
        ]);
    }
}
