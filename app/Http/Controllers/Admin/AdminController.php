<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show the admin dashboard
    public function indexDashboard()
    {
        // Get counts for leave application statuses
        $pendingRequestsCount = LeaveApplication::where('status', 'pending')->count();
        $approvedLeavesCount = LeaveApplication::where('status', 'approved')->count();
        $rejectedLeavesCount = LeaveApplication::where('status', 'rejected')->count();

        // Pass the counts to the view
        return view('admin.admin_dashboard', compact('pendingRequestsCount', 'approvedLeavesCount', 'rejectedLeavesCount'));
    }

    // Show the user management dashboard
    public function indexManageUsers()
    {
        // Fetch all users
        $employees = User::all(); // Fetch users and assign them to $employees to match the Blade file

        // Return the view with the users data
        return view('admin.admin_manage_users', compact('employees')); // Pass $employees to the view
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Perform any necessary checks before deletion
        if ($user->level === 2) {
            // Optional: Prevent deletion of Super Admin
            return redirect()->back()->with('error', 'Cannot delete Super Admin.');
        }

        // Delete the user
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('admin.manage.users')->with('success', 'User deleted successfully.');
    }

    // Helper method to get role name based on user level
    private function getRoleName($level)
    {
        switch ($level) {
            case 0:
                return 'User';
            case 1:
                return 'Admin';
            case 2:
                return 'Super Admin';
            default:
                return 'Unknown';
        }
    }
}
