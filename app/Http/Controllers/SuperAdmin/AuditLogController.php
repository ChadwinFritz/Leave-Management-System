<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog; // Assuming you have an AuditLog model
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    // Show the list of audit logs
    public function index()
    {
        // Fetch all audit logs along with the user information
        $auditLogs = AuditLog::with('user')->orderBy('created_at', 'desc')->get();

        // Return the view with audit logs data
        return view('superadmin.superadmin_audit_logs', compact('auditLogs'));
    }
}
