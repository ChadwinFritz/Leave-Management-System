<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminApproveLeaveController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDepartmentReportController;
use App\Http\Controllers\Admin\AdminManageUserController;
use App\Http\Controllers\Admin\AdminPendingUsersController;
use App\Http\Controllers\Admin\AdminUpdateEmployeeController;
use App\Http\Controllers\SuperAdmin\SuperAdminAuditLogController;
use App\Http\Controllers\SuperAdmin\SuperAdminCreateAdminController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\SuperAdminEditAdminController;
use App\Http\Controllers\SuperAdmin\SuperAdminManageAdminController;
use App\Http\Controllers\SuperAdmin\SuperAdminSystemSettingsController;
use App\Http\Controllers\Supervisor\ApproveLeaveController;
use App\Http\Controllers\Supervisor\EscalationRequestController;
use App\Http\Controllers\Supervisor\SupervisorDashboardController;
use App\Http\Controllers\Supervisor\TaskController;
use App\Http\Controllers\Supervisor\TeamAvailabilityController;
use App\Http\Controllers\Supervisor\TeamLeaveController;
use App\Http\Controllers\Supervisor\TeamReportController;
use App\Http\Controllers\User\LeaveHistoryController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserLeaveApplicationController;
use App\Http\Controllers\User\UserProfileController;

// Welcome Page Route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes (Guest middleware to prevent access for authenticated users)
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', function () {
        return view('auth.login');
    })->name('auth.login');

    Route::post('/login', [LoginController::class, 'login'])->name('auth.login.post');

    // Registration Routes
    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register');

    Route::post('/register', [RegisteredUserController::class, 'store'])->name('auth.register.post');
});

// Authentication session routes (for logout)
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout');

// Routes for Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/leave', [AdminApproveLeaveController::class, 'index'])->name('leave.index');
    Route::post('/leave/{id}/approve', [AdminApproveLeaveController::class, 'approve'])->name('leave.approve');
    Route::post('/leave/{id}/reject', [AdminApproveLeaveController::class, 'reject'])->name('leave.reject');
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/department-report', [AdminDepartmentReportController::class, 'index'])->name('department.report');
    
    Route::get('/manage-users', [AdminManageUserController::class, 'index'])->name('manage.users');
    Route::get('/manage-users/{id}/edit', [AdminManageUserController::class, 'edit'])->name('manage.users.edit');
    Route::put('/manage-users/{id}', [AdminManageUserController::class, 'update'])->name('manage.users.update');
    Route::delete('/manage-users/{id}', [AdminManageUserController::class, 'destroy'])->name('manage.users.destroy');
    
    Route::get('/pending-users', [AdminPendingUsersController::class, 'index'])->name('users.pending');
    Route::post('/pending-users/{id}/approve', [AdminPendingUsersController::class, 'approve'])->name('users.pending.approve');
    Route::post('/pending-users/{id}/reject', [AdminPendingUsersController::class, 'reject'])->name('users.pending.reject');
    
    Route::get('/employees/{id}/edit', [AdminUpdateEmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [AdminUpdateEmployeeController::class, 'update'])->name('employees.update');

    Route::post('user/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

// Routes for Super Admin
Route::middleware(['auth'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('audit-logs', [SuperAdminAuditLogController::class, 'index'])->name('auditLogs');
    
    Route::get('create-admin', [SuperAdminCreateAdminController::class, 'create'])->name('admin.create');
    Route::post('create-admin', [SuperAdminCreateAdminController::class, 'store'])->name('admin.store');
    
    Route::get('dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('admin/edit/{id}', [SuperAdminEditAdminController::class, 'edit'])->name('admin.edit');
    Route::put('admin/update/{id}', [SuperAdminEditAdminController::class, 'update'])->name('admin.update');
    
    Route::get('manage/admins', [SuperAdminManageAdminController::class, 'index'])->name('manage.admins');
    Route::delete('manage/admins/{id}', [SuperAdminManageAdminController::class, 'destroy'])->name('manage.admins.destroy');
    
    Route::get('system/settings', [SuperAdminSystemSettingsController::class, 'index'])->name('system.settings');
    Route::post('system/settings', [SuperAdminSystemSettingsController::class, 'update'])->name('system.settings.update');

    Route::post('user/logout', [LoginController::class, 'logout'])->name('superadmin.logout');
});

// Routes for Supervisor
Route::middleware(['auth'])->prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('approve/leave', [ApproveLeaveController::class, 'index'])->name('approve.leave');
    Route::post('approve/leave/{applicationId}/approve', [ApproveLeaveController::class, 'approve'])->name('approve.leave.approve');
    Route::post('approve/leave/{applicationId}/reject', [ApproveLeaveController::class, 'reject'])->name('approve.leave.reject');
    
    Route::get('escalation/requests', [EscalationRequestController::class, 'index'])->name('escalation_requests');
    Route::post('escalation/requests/{id}/approve', [EscalationRequestController::class, 'approve'])->name('escalation_requests.approve');
    Route::post('escalation/requests/{id}/reject', [EscalationRequestController::class, 'reject'])->name('escalation_requests.reject');
    
    Route::get('dashboard', [SupervisorDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('tasks/create', [TaskController::class, 'create'])->name('assign_task');
    Route::post('tasks', [TaskController::class, 'store'])->name('store_task');
    
    Route::get('team/availability', [TeamAvailabilityController::class, 'index'])->name('team_availability');
    Route::get('team/leave', [TeamLeaveController::class, 'index'])->name('team_leave');
    Route::get('team/report', [TeamReportController::class, 'index'])->name('team_report');

    Route::post('user/logout', [LoginController::class, 'logout'])->name('supervisor.logout');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // Existing routes
    Route::get('user/leave/history', [LeaveHistoryController::class, 'index'])->name('user.leave.history');
    Route::get('user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('user/leave/application', [UserLeaveApplicationController::class, 'create'])->name('user.leave.application');
    Route::post('user/leave/application', [UserLeaveApplicationController::class, 'store'])->name('user.leave.application.submit');
    
    // Add this route definition for leave request (if it was missing)
    Route::post('user/leave/request', [UserLeaveApplicationController::class, 'store'])->name('user.leave.request'); 
    
    Route::get('user/profile', [UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('user/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::post('user/logout', [LoginController::class, 'logout'])->name('user.logout');
});


// Common Logout Route (for all roles)
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout');