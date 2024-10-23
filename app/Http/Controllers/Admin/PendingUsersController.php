<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PendingUsersController extends Controller
{
    // Show the pending user registrations
    public function index()
    {
        // Fetch users that are pending approval
        $pendingUsers = User::where('status', 'pending')->get();

        // Return the view with pending users data
        return view('admin.admin_pending_users', compact('pendingUsers'));
    }

    // Approve a pending user
    public function approve($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
        
        // Update the user's status to 'active'
        $user->status = 'active';
        $user->save();

        // Redirect back with a success message
        return redirect()->route('users.pending')->with('success', 'User approved successfully.');
    }

    // Reject a pending user
    public function reject($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
        
        // Optionally, you can delete the user or update their status
        $user->delete(); // or you could set a status to 'rejected'

        // Redirect back with a success message
        return redirect()->route('users.pending')->with('success', 'User rejected successfully.');
    }
}
