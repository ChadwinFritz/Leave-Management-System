<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use Illuminate\Http\Request;

class ApproveLeaveController extends Controller
{
    // Constructor to apply middleware for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of leave applications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all leave applications with related employee and leave type info
        $leaveApplications = LeaveApplication::with(['employee', 'leaveType'])
            ->where('status', 'pending') // Only show pending leave applications
            ->paginate(10); // Pagination

        // Return view with leave applications
        return view('admin.leave.index', compact('leaveApplications'));
    }

    /**
     * Approve a leave application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id)
    {
        // Find the leave application by ID
        $application = LeaveApplication::findOrFail($id);

        // Check if the status is pending before approving
        if ($application->status === 'pending') {
            $application->status = 'approved';
            $application->save();

            // Flash message for success
            return redirect()->route('leave.approve.index')
                ->with('message', 'Leave application approved successfully.');
        }

        // Flash message for failure (if not pending)
        return redirect()->route('leave.approve.index')
            ->with('message', 'Leave application cannot be approved. It might have already been processed.');
    }

    /**
     * Reject a leave application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $id)
    {
        // Find the leave application by ID
        $application = LeaveApplication::findOrFail($id);

        // Check if the status is pending before rejecting
        if ($application->status === 'pending') {
            $application->status = 'rejected';
            $application->save();

            // Flash message for success
            return redirect()->route('leave.approve.index')
                ->with('message', 'Leave application rejected successfully.');
        }

        // Flash message for failure (if not pending)
        return redirect()->route('leave.approve.index')
            ->with('message', 'Leave application cannot be rejected. It might have already been processed.');
    }
}
