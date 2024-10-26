<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApproveLeaveController;
use App\Http\Controllers\Admin\DepartmentReportController;
use App\Http\Controllers\Admin\PendingUsersController;
use App\Http\Controllers\SuperAdmin\AuditLogController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\SystemSettingsController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\LeaveHistoryController;
use App\Http\Controllers\User\LeaveApplicationController;
use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Support\Facades\Route;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('auth.register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('auth.register');
});

// Logout Routes
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');
Route::post('/superadmin/logout', [LoginController::class, 'logout'])->name('superadmin.logout')->middleware('auth:superadmin');
Route::post('/user/logout', [LoginController::class, 'logout'])->name('user.logout')->middleware('auth');

// Admin Employee Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Employee Management Routes
    Route::get('/admin/employees', [EmployeeController::class, 'index'])->name('admin.employees.index'); // List Employees
    Route::get('/admin/employees/create', [EmployeeController::class, 'create'])->name('admin.employees.create'); // Create Employee
    Route::post('/admin/employees', [EmployeeController::class, 'store'])->name('admin.employees.store'); // Store Employee
    Route::get('/admin/employees/{employee}', [EmployeeController::class, 'show'])->name('admin.employees.details'); // Show Employee Details
    Route::get('/admin/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('admin.employees.edit'); // Edit Employee
    Route::put('/admin/employees/{employee}', [EmployeeController::class, 'update'])->name('admin.employees.update'); // Update Employee
    Route::delete('/admin/employees/{employee}', [EmployeeController::class, 'destroy'])->name('admin.employees.delete'); // Delete Employee

    // Leave Approval Routes
    Route::get('/admin/leave-approvals', [ApproveLeaveController::class, 'index'])->name('leave.approve.index'); // List Leave Approvals
    Route::post('/admin/leave-approvals/{id}/approve', [ApproveLeaveController::class, 'approve'])->name('leave.approve'); // Approve Leave
    Route::post('/admin/leave-approvals/{id}/reject', [ApproveLeaveController::class, 'reject'])->name('leave.reject'); // Reject Leave

    // Department Report Route
    Route::get('/admin/department-report', [DepartmentReportController::class, 'index'])->name('admin.department.report'); // View Department Report

    // Pending Users Routes
    Route::get('/admin/pending-users', [PendingUsersController::class, 'index'])->name('users.pending'); // List Pending Users
    Route::post('/admin/pending-users/{id}/approve', [PendingUsersController::class, 'approve'])->name('users.approve'); // Approve Pending User
    Route::post('/admin/pending-users/{id}/reject', [PendingUsersController::class, 'reject'])->name('users.reject'); // Reject Pending User

    // Dashboard and User Management Routes
    Route::get('/admin/dashboard', [AdminController::class, 'indexDashboard'])->name('admin.dashboard'); // Admin Dashboard
    Route::get('/admin/manage-users', [AdminController::class, 'indexManageUsers'])->name('users.index'); // List Users
    Route::delete('/admin/manage-users/{id}', [AdminController::class, 'destroy'])->name('users.destroy'); // Delete User
});

// Super Admin Routes
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    // Dashboard
    Route::get('superadmin/dashboard', [SuperAdminController::class, 'indexDashboard'])->name('superadmin.dashboard');

    // Audit Logs
    Route::get('superadmin/audit-logs', [AuditLogController::class, 'index'])->name('superadmin.audit.logs');

    // Manage Admins
    Route::get('superadmin/manage-admins', [SuperAdminController::class, 'indexListOfAdmin'])->name('superadmin.manage.admins');

    // Create New Admin
    Route::get('superadmin/admins/create', [SuperAdminController::class, 'createAdmin'])->name('superadmin.create.admin'); // Create Admin Form
    Route::post('superadmin/admins', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.admin.store'); // Store New Admin

    // Edit Existing Admin
    Route::get('superadmin/admins/{id}/edit', [SuperAdminController::class, 'editAdmin'])->name('superadmin.edit.admin'); // Edit Admin Form
    Route::put('superadmin/admins/{id}', [SuperAdminController::class, 'updateAdmin'])->name('superadmin.admin.update'); // Update Admin

    // Delete Admin
    Route::delete('superadmin/admins/{id}', [SuperAdminController::class, 'destroyAdmin'])->name('superadmin.delete.admin'); // Delete Admin

    // System Settings
    Route::get('superadmin/system-settings', [SystemSettingsController::class, 'edit'])->name('superadmin.system.settings');
    Route::post('superadmin/system-settings/update', [SystemSettingsController::class, 'update'])->name('superadmin.system.settings.update');

    Route::get('superadmin/admins/create', [SuperAdminController::class, 'createAdmin'])->name('superadmin.create.admin');

});


// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'indexDashboard'])->name('user.dashboard');
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('user/leave/application', [LeaveApplicationController::class, 'create'])->name('user.leave.application');
    Route::post('user/leave/request', [LeaveApplicationController::class, 'store'])->name('user.leave.request');
    Route::get('user/leave/history', [LeaveHistoryController::class, 'index'])->name('user.leave.history');
    Route::get('user/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::post('user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/user/leave/application', [UserController::class, 'applyForLeave'])->name('user.leave.application');
});
