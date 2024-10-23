<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApproveLeaveController extends Controller
{
    // Display the list of leave applications for approval
    public function index()
    {
        // Fetch leave applications with employee details
        $leaveApplications = LeaveApplication::with('employee')->where('status', 'pending')->get();
        
        return view('admin.admin_approve_leave', compact('leaveApplications'));
    }

    // Approve a leave application
    public function approve($id)
    {
        // Find the leave application
        $leaveApplication = LeaveApplication::findOrFail($id);

        // Update the leave application status
        $leaveApplication->status = 'approved';
        $leaveApplication->save();

        // Create a new leave record
        Leave::create([
            'employee_id' => $leaveApplication->employee_id,
            'leave_application_id' => $leaveApplication->id,
            'total_leave' => $leaveApplication->number_of_days, // Assuming this is the total leave
            'start_date' => $leaveApplication->start_date,
            'end_date' => $leaveApplication->end_date,
            'start_half' => $leaveApplication->start_half,
            'end_half' => $leaveApplication->end_half,
            'on_date' => $leaveApplication->on_date,
            'on_time' => $leaveApplication->on_time,
            'leave_type' => $leaveApplication->leave_type,
        ]);

        // Redirect back with a success message
        return redirect()->route('leave.approve.index')->with('success', 'Leave application approved successfully.');
    }

    // Reject a leave application
    public function reject($id)
    {
        // Find the leave application
        $leaveApplication = LeaveApplication::findOrFail($id);

        // Update the leave application status
        $leaveApplication->status = 'rejected';
        $leaveApplication->save();

        // Redirect back with a success message
        return redirect()->route('leave.approve.index')->with('success', 'Leave application rejected successfully.');
    }
}
