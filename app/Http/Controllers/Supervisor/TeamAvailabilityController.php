<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamAvailabilityController extends Controller
{

    /**
     * Display the list of team members and their availability.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch the team members for the logged-in supervisor
        // Assuming Employee model has a relationship with Availability model
        $teamMembers = Employee::where('supervisor_id', Auth::id())
                               ->with('availability')  // Eager load the availability data
                               ->get();

        // Pass the team members' data to the view
        return view('supervisor.team_availability', [
            'teamMembers' => $teamMembers
        ]);
    }
}
