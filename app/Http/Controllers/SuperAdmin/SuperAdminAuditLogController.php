<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class SuperAdminAuditLogController extends Controller
{
    /**
     * Display a listing of the audit logs.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ensure only SuperAdmin has access
        $this->authorize('viewAuditLogs', AuditLog::class);

        // Retrieve audit logs with pagination, eager load associated user
        $auditLogs = AuditLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return view with logs
        return view('superadmin.superadmin_audit_logs', compact('auditLogs'));
    }
}
