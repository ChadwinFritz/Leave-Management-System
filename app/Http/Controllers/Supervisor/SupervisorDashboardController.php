<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorDashboardController extends Controller
{

    /**
     * Display the Supervisor Dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch the count of pending leave approvals for the logged-in supervisor
        $pendingApprovalsCount = LeaveApplication::where('user_id', Auth::id())
                                                  ->where('status', 'pending')
                                                  ->count();

        // Fetch the count of available team members (excluding those on leave)
        $availableMembersCount = Employee::where('user_id', Auth::id())
                                         ->where('status', 'active')
                                         ->whereNotIn('id', function ($query) {
                                             $query->select('employee_id')
                                                   ->from('leave_applications')
                                                   ->where('status', 'approved');
                                         })
                                         ->count();

        // Fetch the count of tasks assigned in the current month
        $tasksAssignedCount = Task::where('user_id', Auth::id())
                                  ->whereMonth('created_at', now()->month)
                                  ->count();

        // Pass the data to the view
        return view('supervisor.supervisor_dashboard', [
            'pendingApprovalsCount' => $pendingApprovalsCount,
            'availableMembersCount' => $availableMembersCount,
            'tasksAssignedCount' => $tasksAssignedCount
        ]);
    }
}
