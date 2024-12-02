<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // Display the admin dashboard
    public function index()
    {
        // Get the count of each leave request status
        $pendingRequestsCount = LeaveApplication::where('status', 'pending')->count();
        $approvedLeavesCount = LeaveApplication::where('status', 'approved')->count();
        $rejectedLeavesCount = LeaveApplication::where('status', 'rejected')->count();

        // Fetch recent leave applications (you can change the limit if necessary)
        $recentLeaveApplications = LeaveApplication::with('employee', 'leaveType')
            ->orderBy('created_at', 'desc')
            ->limit(5) // Only get the 5 most recent leave applications
            ->get();

        // Return the view with the data
        return view('admin.admin_dashboard', compact(
            'pendingRequestsCount',
            'approvedLeavesCount',
            'rejectedLeavesCount',
            'recentLeaveApplications'
        ));
    }
}
