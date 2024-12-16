<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Employee;
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
        // Fetch the team members for the logged-in supervisor by user_id (from teams table)
        // Assuming Employee model has a relationship with LeaveApplication
        $employees = Employee::whereHas('teams', function ($query) {
            $query->where('user_id', Auth::id()); // Use 'user_id' to find the supervisor's team
        })
        ->with(['leaveApplications' => function ($query) {
            $query->orderBy('start_date', 'desc'); // Order leave applications by start date
        }])  // Eager load the leave applications data
        ->get();

        // Pass the employees' data to the view
        return view('supervisor.supervisor_team_leave', [
            'employees' => $employees
        ]);
    }
}
