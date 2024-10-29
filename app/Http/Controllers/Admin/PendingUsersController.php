<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PendingUsersController extends Controller
{
    /**
     * Display a listing of pending users.
     */
    public function index()
    {
        // Retrieve users with 'pending' status
        $pendingUsers = User::where('status', 'pending')->get();

        // Return the view with the list of pending users
        return view('admin.admin_pending_users', compact('pendingUsers'));
    }

    /**
     * Approve a user registration.
     */
    public function approve($id)
    {
        // Retrieve the user by ID
        $user = User::findOrFail($id);
        
        // Update the user's status and approval flag
        $user->status = 'approved';
        $user->is_approved = true;
        $user->save();

        // Redirect back with a success message
        return redirect()->route('users.pending')->with('success', 'User approved successfully.');
    }

    /**
     * Reject a user registration.
     */
    public function reject($id)
    {
        // Retrieve the user by ID
        $user = User::findOrFail($id);
        
        // Either delete the user or set status to 'rejected'
        $user->status = 'rejected';
        $user->is_approved = false;
        $user->save();

        // Redirect back with a success message
        return redirect()->route('users.pending')->with('success', 'User rejected successfully.');
    }
}
