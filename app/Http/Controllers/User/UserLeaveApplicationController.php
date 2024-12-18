<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Leave;
use App\Models\LeaveType;

class UserLeaveApplicationController extends Controller
{
    /**
     * Show the leave application form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();

        // Fetch employee data
        $employee = $user->employee; // Assuming `employee` is a relation on the User model

        // If employee data is not available, handle the error gracefully
        if (!$employee) {
            // You can either redirect the user or show an error message
            return redirect()->route('user.dashboard')->with('error', 'Employee data not found.');
        }

        // Fetch available leave types
        $leaveTypes = LeaveType::all();

        return view('user.user_leave_application', compact('employee', 'leaveTypes'));
    }

    /**
     * Handle the leave application submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        // Fetch employee data for validation and use
        $employee = $user->employee;

        if (!$employee) {
            return back()->withErrors(['error' => 'Employee data not found.']);
        }

        // Calculate the number of days for the leave
        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);
        $days = $startDate->diff($endDate)->days + 1;

        // Check leave balance for the selected leave type
        $leaveType = LeaveType::findOrFail($request->leave_type_id);
        $takenDays = Leave::where('employee_id', $employee->id)
            ->where('leave_type_id', $leaveType->id)
            ->where('status', 'approved')
            ->sum('days');
        $remainingDays = max(0, $leaveType->default_days - $takenDays);

        if ($days > $remainingDays) {
            return back()->withErrors(['Insufficient leave balance for the selected leave type.']);
        }

        // Calculate the total leave value (use $days unless there is a specific rule)
        $totalLeave = $days; // Adjust calculation if needed (e.g., include half-days)

        // Create a new leave application with the employee_id
        Leave::create([
            'employee_id' => $employee->id,
            'user_id' => $user->id,
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'days' => $days,
            'reason' => $request->reason,
            'status' => 'pending',
            'total_leave' => $totalLeave, // Include the total_leave value
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Leave application submitted successfully.');
    }
}
