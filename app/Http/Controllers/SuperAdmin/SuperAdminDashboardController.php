<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SuperAdminDashboardController extends Controller
{
    use AuthorizesRequests; // Include this trait for authorization

    /**
     * Display the Super Admin Dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ensure only SuperAdmins can access this page
        $this->authorize('viewDashboard', auth()->user());

        // Cache dashboard stats to reduce database load
        $dashboardData = Cache::remember('superadmin_dashboard_stats', 60, function () {
            return [
                'totalEmployees' => Employee::count(),
                'pendingLeaveRequests' => LeaveRequest::where('status', 'pending')->count(),
                'totalDepartments' => Department::count(),
                'recentActivities' => $this->getRecentActivities(),
            ];
        });

        return view('superadmin.superadmin_dashboard', $dashboardData);
    }

    /**
     * Retrieve recent task activities for the dashboard from the database.
     *
     * @return array
     */
    private function getRecentActivities()
    {
        // Fetch the most recent 10 tasks and their statuses
        $tasks = \DB::table('tasks')
            ->join('users', 'tasks.user_id', '=', 'users.id') // Assuming a `users` table exists
            ->select('tasks.title', 'tasks.status', 'users.name as assigned_user')
            ->orderBy('tasks.created_at', 'desc') // Sort by the most recently created tasks
            ->take(10) // Limit to the 10 most recent tasks
            ->get();

        // Map tasks to human-readable activity descriptions
        $activities = $tasks->map(function ($task) {
            $statusLabels = [
                'pending' => 'Pending Approval',
                'in_progress' => 'In Progress',
                'completed' => 'Completed',
            ];
            $statusText = $statusLabels[$task->status] ?? $task->status;
            return "{$task->assigned_user} is working on '{$task->title}' with status '{$statusText}'.";
        });

        return $activities->isEmpty()
            ? ['No recent activities to display.']
            : $activities->toArray();
    }
}
