<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Duty;
use App\Models\Employee;
use Illuminate\Http\Request;

class AdminUpdateEmployeeController extends Controller
{
    // Show the form for editing the specified employee
    public function edit($id)
    {
        // Retrieve the employee by ID, including related department and duty data
        $employee = Employee::findOrFail($id);
        
        // Get all departments and duties for the dropdown lists
        $departments = Department::all();
        $duties = Duty::all();

        // Return the view with the employee, departments, and duties data
        return view('admin.admin_update_employee', compact('employee', 'departments', 'duties'));
    }

    // Update the specified employee in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'department_id' => 'required|exists:departments,id',
            'duty_id' => 'required|exists:duties,id',
            'employee_code' => 'required|string|max:20',
            'employment_status' => 'required|in:active,resigned',
            'notes' => 'nullable|string',
        ]);

        // Find the employee by ID
        $employee = Employee::findOrFail($id);

        // Update the employee with the validated data
        $employee->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'hire_date' => $request->input('hire_date'),
            'department_id' => $request->input('department_id'),
            'duty_id' => $request->input('duty_id'),
            'employee_code' => $request->input('employee_code'),
            'employment_status' => $request->input('employment_status'),
            'notes' => $request->input('notes'),
        ]);

        // Redirect back to the employee management page with a success message
        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully.');
    }
}
