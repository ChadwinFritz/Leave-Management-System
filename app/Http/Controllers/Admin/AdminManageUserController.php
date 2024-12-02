<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class AdminManageUserController extends Controller
{
    // Display a listing of the employees
    public function index()
    {
        // Retrieve all employees with their related department information
        $employees = Employee::with('department')->get();
        
        // Return the view with the employees data
        return view('admin.admin_manage_users', compact('employees'));
    }

    // Show the form for editing an employee
    public function edit($id)
    {
        // Find the employee by their ID
        $employee = Employee::findOrFail($id);

        // Return the edit view with the employee data
        return view('admin.employees.edit', compact('employee'));
    }

    // Update the specified employee in the database
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'employee_code' => 'required|unique:employees,employee_code,' . $id,
            'username' => 'required',
            'email' => 'required|email|unique:employees,email,' . $id,
            'department_id' => 'required|exists:departments,id',
        ]);

        // Find the employee by ID
        $employee = Employee::findOrFail($id);

        // Update the employee data
        $employee->update([
            'employee_code' => $request->employee_code,
            'username' => $request->username,
            'email' => $request->email,
            'department_id' => $request->department_id,
        ]);

        // Redirect back to the user management page with a success message
        return redirect()->route('admin.manage.users')->with('message', 'Employee updated successfully!');
    }

    // Delete the specified employee
    public function destroy($id)
    {
        // Find the employee by ID
        $employee = Employee::findOrFail($id);

        // Delete the employee
        $employee->delete();

        // Redirect back to the user management page with a success message
        return redirect()->route('admin.manage.users')->with('message', 'Employee deleted successfully!');
    }
}
