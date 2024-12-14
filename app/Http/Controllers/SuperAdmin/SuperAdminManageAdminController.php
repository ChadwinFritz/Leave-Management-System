<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminManageAdminController extends Controller
{
    /**
     * Display a listing of the admins.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all users with the 'admin' role
        $admins = User::where('role', 'admin')->get();

        return view('superadmin.superadmin_manage_admins', compact('admins'));
    }

    /**
     * Remove the specified admin from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Find the admin user by ID
        $admin = User::where('role', 'admin')->findOrFail($id);

        // Prevent the SuperAdmin from deleting themselves
        if (auth()->id() === $admin->id) {
            return redirect()
                ->route('superadmin.manage.admins')
                ->withErrors(['error' => 'You cannot delete your own account.']);
        }

        // Delete the admin
        $admin->delete();

        return redirect()
            ->route('superadmin.manage.admins')
            ->with('success', 'Admin deleted successfully.');
    }
}
