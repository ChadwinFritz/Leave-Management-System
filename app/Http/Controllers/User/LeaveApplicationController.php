<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication; // Import the LeaveApplication model
use App\Models\Employee; // Import the Employee model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeaveApplicationController extends Controller
{
    // Show the leave application form
    public function create()
    {
        // Return the view with leave types and necessary data
        return view('user.user_leave_application');
    }

    // Store the leave application
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'leave_type' => 'required|exists:leave_types,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the authenticated user's employee record
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        // Calculate the number of days
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $numberOfDays = $startDate->diffInDays($endDate) + 1; // Adding 1 to include the start date

        // Create a new leave application
        LeaveApplication::create([
            'employee_id' => $employee->id,
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'contact_number' => $request->contact_number,
            'status' => 'pending', // Default status
            'number_of_days' => $numberOfDays, // Add the calculated number of days
        ]);

        // Redirect back with a success message
        return redirect()->route('user.leave.application')->with('success', 'Leave application submitted successfully!');
    }
}
