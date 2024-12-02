<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Leave;
use App\Models\LeaveType;

class UserDashboardController extends Controller
{
    /**
     * Display the user's dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // Calculate the total leaves taken by the user
        $totalLeavesTaken = Leave::where('user_id', $user->id)
            ->where('status', 'approved')
            ->sum('days');

        // Calculate remaining leave balance
        $totalLeaveAllocated = LeaveType::sum('default_days'); // Example for all leave types
        $remainingLeave = $totalLeaveAllocated - $totalLeavesTaken;

        // Fetch leave types and calculate taken/remaining days for each
        $leaveTypes = LeaveType::all();
        $takenDays = [];
        $remainingDays = [];

        foreach ($leaveTypes as $type) {
            $taken = Leave::where('user_id', $user->id)
                ->where('leave_type_id', $type->id)
                ->where('status', 'approved')
                ->sum('days');
            $remaining = $type->default_days - $taken;

            $takenDays[] = $taken;
            $remainingDays[] = max(0, $remaining);
        }

        // Pass data to the dashboard view
        return view('user.user_dashboard', compact(
            'totalLeavesTaken',
            'remainingLeave',
            'leaveTypes',
            'takenDays',
            'remainingDays'
        ));
    }
}
