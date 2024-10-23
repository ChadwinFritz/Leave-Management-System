<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication; // Import the LeaveApplication model
use App\Models\Employee; // Import the Employee model
use Illuminate\Support\Facades\Auth;

class LeaveHistoryController extends Controller
{
    // Show the leave history for the authenticated user
    public function index()
    {
        // Get the authenticated user's employee record
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        // Retrieve the leave history for the employee
        $leaveHistory = LeaveApplication::where('employee_id', $employee->id)
            ->with('leaveType') // Eager load the leave type relationship
            ->orderBy('start_date', 'desc') // Order by start date descending
            ->get();

        // Return the view with the leave history data
        return view('user.user_leave_history', compact('leaveHistory'));
    }
}
