<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ApproveLeaveController extends Controller
{
    // Middleware to ensure only supervisors have access
    public function __construct()
    {
        $this->middleware('role:supervisor');
    }

    /**
     * Display a listing of pending leave requests for the supervisor.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get leave applications that are pending and belong to the supervisor's team
        $leaveApplications = LeaveApplication::where('status', 'pending')
            ->whereHas('employee', function ($query) {
                // Ensure we only get the leave applications of the supervisor's team members
                $query->where('supervisor_id', auth()->user()->id);
            })
            ->with('employee', 'leaveType')  // Eager load related models
            ->get();

        return view('supervisor.approve_leave', compact('leaveApplications'));
    }

    /**
     * Approve the specified leave application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $applicationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Request $request, $applicationId)
    {
        // Find the leave application by its ID
        $leaveApplication = LeaveApplication::findOrFail($applicationId);

        // Ensure the leave application is pending
        if ($leaveApplication->status !== 'pending') {
            return Redirect::route('supervisor.approve.leave')
                ->with('error', 'This leave request cannot be approved.');
        }

        // Approve the leave application
        $leaveApplication->status = 'approved';
        $leaveApplication->save();

        return Redirect::route('supervisor.approve.leave')
            ->with('success', 'Leave application approved successfully.');
    }

    /**
     * Reject the specified leave application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $applicationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(Request $request, $applicationId)
    {
        // Find the leave application by its ID
        $leaveApplication = LeaveApplication::findOrFail($applicationId);

        // Ensure the leave application is pending
        if ($leaveApplication->status !== 'pending') {
            return Redirect::route('supervisor.approve.leave')
                ->with('error', 'This leave request cannot be rejected.');
        }

        // Reject the leave application
        $leaveApplication->status = 'rejected';
        $leaveApplication->save();

        return Redirect::route('supervisor.approve.leave')
            ->with('success', 'Leave application rejected successfully.');
    }
}
