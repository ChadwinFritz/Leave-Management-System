<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\LeaveApplication;
use Illuminate\Http\Request;

class AdminDepartmentReportController extends Controller
{
    // Display the department leave report
    public function index()
    {
        // Fetch all departments
        $departments = Department::all();

        // Loop through departments and calculate total leave taken and pending leave requests
        foreach ($departments as $department) {
            // Calculate total leave taken for each department
            $totalLeaveTaken = LeaveApplication::whereHas('employee', function ($query) use ($department) {
                $query->where('department_id', $department->id);
            })->where('status', 'approved')->sum('total_leave_days'); // Assuming 'total_leave_days' exists in LeaveApplication

            // Calculate pending leave requests for each department
            $pendingRequests = LeaveApplication::whereHas('employee', function ($query) use ($department) {
                $query->where('department_id', $department->id);
            })->where('status', 'pending')->count();

            // Add the calculated values to the department object
            $department->total_leave_taken = $totalLeaveTaken;
            $department->pending_requests = $pendingRequests;
        }

        // Return the view with the department data
        return view('admin.admin_department_report', compact('departments'));
    }
}
