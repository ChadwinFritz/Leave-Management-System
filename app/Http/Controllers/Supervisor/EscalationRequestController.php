<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\EscalationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EscalationRequestController extends Controller
{

    /**
     * Display the list of escalated leave requests.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch the escalated leave requests for the logged-in supervisor
        $escalatedRequests = EscalationRequest::where('user_id', Auth::id())
                                              ->where('status', 'pending')
                                              ->get();

        // Pass the data to the view
        return view('supervisor.supervisor_escalation_requests', [
            'escalatedRequests' => $escalatedRequests
        ]);
    }

    /**
     * Approve the escalated leave request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Request $request, $id)
    {
        // Find the escalation request by ID
        $escalationRequest = EscalationRequest::findOrFail($id);

        // Check if the current supervisor is assigned to the request
        if ($escalationRequest->user_id !== Auth::id()) {
            return redirect()->route('supervisor.dashboard')->with('error', 'Unauthorized action.');
        }

        // Update the status of the escalation request to 'approved'
        $escalationRequest->status = 'approved';
        $escalationRequest->save();

        // Redirect back with success message
        return redirect()->route('supervisor.escalation_requests')->with('success', 'Leave request approved.');
    }

    /**
     * Reject the escalated leave request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(Request $request, $id)
    {
        // Find the escalation request by ID
        $escalationRequest = EscalationRequest::findOrFail($id);

        // Check if the current supervisor is assigned to the request
        if ($escalationRequest->user_id !== Auth::id()) {
            return redirect()->route('supervisor.dashboard')->with('error', 'Unauthorized action.');
        }

        // Update the status of the escalation request to 'rejected'
        $escalationRequest->status = 'rejected';
        $escalationRequest->save();

        // Redirect back with success message
        return redirect()->route('supervisor.escalation_requests')->with('success', 'Leave request rejected.');
    }
}
