<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Employee; // Assuming you have an Employee model
use App\Models\Department; // Assuming you have a Department model
use App\Models\LeaveApplication; // Assuming you have a LeaveApplication model
use App\Models\AuditLog; // Assuming you have an AuditLog model
use App\Models\User; // Assuming User model exists for managing users
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    // Show the Super Admin dashboard
    public function indexDashboard()
    {
        // Get counts for total employees, departments, and pending leave requests
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();
        $pendingLeaveRequests = LeaveApplication::where('status', 'pending')->count();

        // Get recent activities from the audit logs
        $recentActivities = AuditLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5) // Get the last 5 activities
            ->get()
            ->map(function ($log) {
                return $log->created_at . ' - ' . $log->user->username . ' performed ' . $log->action;
            });

        // Return the view with the collected data
        return view('superadmin.superadmin_dashboard', compact('totalEmployees', 'totalDepartments', 'pendingLeaveRequests', 'recentActivities'));
    }

    // Display the list of admins
    public function indexListOfAdmin()
    {
        // Fetch all admins (level 1 users)
        $admins = User::where('level', 1)->get();

        // Return the view with the list of admins
        return view('superadmin.superadmin_manage_admins', compact('admins'));
    }

    // Show the form for creating a new admin
    public function createAdmin()
    {
        return view('superadmin.superadmin_create_admin');
    }

    // Store a newly created admin
    public function storeAdmin(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new admin user
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 1, // Set the level for admin
            'status' => 'active', // Default status
        ]);

        // Redirect back with success message
        return redirect()->route('superadmin.manage.admins')->with('success', 'Admin created successfully.');
    }

    // Show the form for editing the specified admin
    public function editAdmin($id)
    {
        // Find the admin user by ID
        $admin = User::findOrFail($id);

        // Return the view with the admin details
        return view('superadmin.superadmin_edit_admin', compact('admin'));
    }

    // Update the specified admin
    public function updateAdmin(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the admin user by ID
        $admin = User::findOrFail($id);

        // Update the admin user details
        $admin->username = $request->username;
        $admin->email = $request->email;

        // Only update the password if provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Save the changes to the database
        $admin->save();

        // Redirect back with success message
        return redirect()->route('superadmin.manage.admins')->with('success', 'Admin updated successfully.');
    }

    // Remove the specified admin
    public function destroyAdmin($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        // Redirect back with success message
        return redirect()->route('superadmin.manage.admins')->with('success', 'Admin deleted successfully.');
    }
}
