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
use App\Http\Controllers\User\UserUpdateProfileController;

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
    Route::get('register', [RegisteredUserController::class, 'create'])->name('auth.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

});

// Authentication session routes (for logout)
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout');

// Routes for Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Route
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Department Report Route
    Route::get('/department-report', [AdminDepartmentReportController::class, 'index'])->name('department.report');

    // Manage Users Routes
    Route::get('/manage-users', [AdminManageUserController::class, 'index'])->name('manage.users');
    Route::get('/manage-users/{id}/edit', [AdminManageUserController::class, 'edit'])->name('manage.users.edit');
    Route::put('/manage-users/{id}', [AdminManageUserController::class, 'update'])->name('manage.users.update');
    Route::delete('/manage-users/{id}', [AdminManageUserController::class, 'destroy'])->name('manage.users.destroy');

    // Pending Users Routes
    Route::get('/pending-users', [AdminPendingUsersController::class, 'index'])->name('pending.users');
    Route::post('/pending-users/{id}/approve', [AdminPendingUsersController::class, 'approve'])->name('pending.users.approve');
    Route::post('/pending-users/{id}/reject', [AdminPendingUsersController::class, 'reject'])->name('pending.users.reject');

    // Employee Update Route
    Route::get('/employees/{id}/edit', [AdminUpdateEmployeeController::class, 'edit'])->name('update.employee.edit');
    Route::put('/employees/{id}', [AdminUpdateEmployeeController::class, 'update'])->name('update.employee');

    // Delete Employee Route (alternative route)
    Route::delete('/employees/{id}', [AdminManageUserController::class, 'destroy'])->name('employees.destroy');

    Route::get('/users/pending', [AdminPendingUsersController::class, 'index'])->name('users.pending');
    Route::post('/users/{id}/approve', [AdminPendingUsersController::class, 'approve'])->name('users.approve');
    Route::post('/users/{id}/reject', [AdminPendingUsersController::class, 'reject'])->name('users.reject');

    // Logout Route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
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
    // Approve Leave
    Route::get('approve/leave', [ApproveLeaveController::class, 'index'])->name('approve_leave');
    Route::post('approve/leave/{applicationId}/approve', [ApproveLeaveController::class, 'approve'])->name('approve_leave_approve');
    Route::post('approve/leave/{applicationId}/reject', [ApproveLeaveController::class, 'reject'])->name('approve_leave_reject');

    // Escalation Requests
    Route::get('escalation/requests', [EscalationRequestController::class, 'index'])->name('escalation_requests');
    Route::post('escalation/requests/{id}/approve', [EscalationRequestController::class, 'approve'])->name('escalation_requests_approve');
    Route::post('escalation/requests/{id}/reject', [EscalationRequestController::class, 'reject'])->name('escalation_requests_reject');

    // Dashboard
    Route::get('dashboard', [SupervisorDashboardController::class, 'index'])->name('dashboard');

    // Assign Tasks
    Route::get('tasks/create', [TaskController::class, 'create'])->name('assign_tasks');
    Route::post('tasks', [TaskController::class, 'store'])->name('store_tasks');

    // Team Availability
    Route::get('team/availability', [TeamAvailabilityController::class, 'index'])->name('team_availability');

    // Team Leave
    Route::get('team/leave', [TeamLeaveController::class, 'index'])->name('team_leave');

    // Team Report
    Route::get('team/report', [TeamReportController::class, 'index'])->name('team_report');

    // Logout
    Route::post('user/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Leave Application Routes
    Route::get('/leave/application', [UserLeaveApplicationController::class, 'create'])->name('leave.application');
    Route::post('/leave/application', [UserLeaveApplicationController::class, 'store'])->name('leave.application.submit');
    Route::post('/leave/request', [UserLeaveApplicationController::class, 'store'])->name('leave.request'); 

    // Leave History Route
    Route::get('/leave/history', [LeaveHistoryController::class, 'index'])->name('leave.history');

    // Route for viewing user profile
    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('profile');

    // Route for editing user profile
    Route::get('/user/{user}/edit', [UserProfileController::class, 'edit'])->name('update.profile');

    // Route for updating the profile after editing
    Route::post('/user/profile/update', [UserProfileController::class, 'update'])->name('profile.update');

    // Logout Route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Common Logout Route (for all roles)
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout');