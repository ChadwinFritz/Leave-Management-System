<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Leave;

class LeaveHistoryController extends Controller
{
    /**
     * Display the user's leave history.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch leave history for the logged-in user, ordered by most recent, with pagination
        $leaveHistory = Leave::with('leaveType')
            ->where('user_id', $user->id)
            ->orderBy('start_date', 'desc')
            ->paginate(10);  // Paginate the results (10 items per page)

        return view('user.user_leave_history', compact('leaveHistory'));
    }
}
