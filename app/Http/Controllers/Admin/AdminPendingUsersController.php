<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPendingUsersController extends Controller
{
    // Display a list of pending user registrations
    public function index()
    {
        // Retrieve all pending users, eager load their department relationships
        $pendingUsers = User::where('status', 'pending')->with('department')->get();

        // Return the view with the pending users data
        return view('admin.admin_pending_users', compact('pendingUsers'));
    }

    // Approve a pending user
    public function approve($id)
    {
        // Find the user by their ID
        $user = User::findOrFail($id);

        // Update both the status and approval fields
        $user->update([
            'status' => 'approved',
            'is_approved' => true,
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.users.pending')->with('success', 'User approved successfully.');
    }

    // Reject a pending user
    public function reject($id)
    {
        // Find the user by their ID
        $user = User::findOrFail($id);

        // Change the user's status to rejected and set is_approved to false
        $user->update([
            'status' => 'rejected',
            'is_approved' => false,
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.users.pending')->with('success', 'User rejected successfully.');
    }
}
