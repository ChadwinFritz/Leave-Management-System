<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentReportController extends Controller
{
    // Show the department leave report
    public function index()
    {
        // Fetch all departments with leave report data
        $departments = Department::with('employees.leaveApplications')->get()->map(function ($department) {
            // Calculate total leave taken and pending requests for each department
            $totalLeaveTaken = $department->employees->flatMap(function ($employee) {
                return $employee->leaveApplications->filter(function ($application) {
                    return $application->status === 'approved';
                });
            })->count();

            $pendingRequests = $department->employees->flatMap(function ($employee) {
                return $employee->leaveApplications->filter(function ($application) {
                    return $application->status === 'pending';
                });
            })->count();

            return (object)[
                'name' => $department->name,
                'total_leave_taken' => $totalLeaveTaken,
                'pending_requests' => $pendingRequests,
            ];
        });

        // Pass the department leave report data to the view
        return view('admin.admin_department_report', compact('departments'));
    }
}
