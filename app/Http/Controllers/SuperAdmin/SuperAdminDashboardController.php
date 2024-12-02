<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Cache;

class SuperAdminDashboardController extends Controller
{
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
     * Retrieve recent activities for the dashboard.
     *
     * @return array
     */
    private function getRecentActivities()
    {
        // Mock example of recent activities (replace with actual data if needed)
        return [
            'Employee John Doe was added to the IT department.',
            'Pending leave request from Jane Smith.',
            'New department Marketing created.',
        ];
    }
}
