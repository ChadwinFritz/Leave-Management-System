<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Leave; // Import the Leave model
use App\Models\Employee; // Import the Employee model
use App\Models\User; // Import the User model
use App\Models\LeaveType; // Ensure LeaveType is imported
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show the user dashboard
    public function indexDashboard()
    {
        // Get the authenticated user's employee record
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        // Calculate total approved leaves taken by the user
        $totalLeavesTaken = Leave::where('employee_id', $employee->id)
            ->where('status', 'approved') // Only approved leaves
            ->sum('number_of_days'); // Sum of number_of_days taken for approved leaves

        // Calculate the total leave limit and remaining leave balance
        $totalLeaveLimit = $employee->leaveTypes()->sum('limit'); // Assuming 'limit' is the total days allowed for leave
        $remainingLeave = $totalLeaveLimit - $totalLeavesTaken;

        // Prepare leave type data
        $leaveTypes = LeaveType::all(); // Fetch all leave types
        $takenDays = [];
        $remainingDays = [];

        foreach ($leaveTypes as $leaveType) {
            // Calculate approved days taken for each leave type
            $daysTakenForType = Leave::where('employee_id', $employee->id)
                ->where('leave_type_id', $leaveType->id)
                ->where('status', 'approved') // Only approved leaves for this type
                ->sum('number_of_days'); // Sum of days taken for this specific type

            // Append days taken and remaining days for each leave type
            $takenDays[] = $daysTakenForType;
            $remainingDays[] = max(0, $leaveType->limit - $daysTakenForType); // Ensure no negative values
        }

        // Return the view with the required data
        return view('user.user_dashboard', [
            'totalLeavesTaken' => $totalLeavesTaken,
            'remainingLeave' => $remainingLeave,
            'leaveTypes' => $leaveTypes,
            'takenDays' => $takenDays,
            'remainingDays' => $remainingDays,
        ]);
    }

    // Show the user profile
    public function profile()
    {
        // Get the authenticated user's employee record
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        // Return the profile view with employee data
        return view('user.user_profile', compact('employee'));
    }

    // Show the profile edit form
    public function editProfile()
    {
        // Get the authenticated user's employee record
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        // Return the profile edit view with employee data
        return view('user.edit_profile', compact('employee'));
    }

    // Update the user's profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Ensure username is unique except for the current user
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Ensure email is unique except for the current user
            ],
            'contact_number' => 'required|string|max:15', // Adjust max length as needed
            'address' => 'nullable|string|max:500', // Allow nullable address with max length
        ]);

        // Update the user's profile
        $user->update($request->only('name', 'username', 'email', 'contact_number', 'address'));

        // Redirect back with success message
        return redirect()->route('user.profile.update')->with('success', 'Profile updated successfully.');
    }

    // Method to apply for leave
    public function applyForLeave()
    {
        // Get the authenticated user's employee record
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        // Pass the employee data to the view
        return view('user.user_leave_application', compact('employee')); // Ensure 'employee' is passed
    }
    
    // Method to view leave history
    public function leaveHistory()
    {
        // Get the authenticated user's employee record
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        // Retrieve the leave history for the user
        $leaveHistory = Leave::where('employee_id', $employee->id)->get();

        // Return the leave history view with the retrieved data
        return view('user.leave_history', compact('leaveHistory'));
    }
}
