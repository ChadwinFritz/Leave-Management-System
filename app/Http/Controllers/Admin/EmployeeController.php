<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest; // Create a form request for validation
use App\Models\Employee;
use App\Models\Department;
use App\Models\Duty;

class EmployeeController extends Controller
{
    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        $departments = Department::all();
        $duties = Duty::all();
        return view('admin.admin_create_employee', compact('departments', 'duties'));
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = null; // Set to null since these are level 0 users
        $validatedData['employee_code'] = 'EMP' . time(); // Generate unique employee code

        Employee::create($validatedData);
        return redirect()->route('admin.manage.users')->with('success', 'Employee created successfully.');
    }

    /**
     * Show the list of employees.
     */
    public function index()
    {
        $employees = Employee::all(); // Fetch all employees from the database
        return view('admin.admin_manage_users', compact('employees')); // Update with the correct view name
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $duties = Duty::all();
        return view('admin.admin_update_employee', compact('employee', 'departments', 'duties'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        // Validate the incoming request using EmployeeRequest
        $validatedData = $request->validated();

        try {
            // Update the employee's basic information
            $employee->update([
                'name' => $validatedData['name'],
                'surname' => $validatedData['surname'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'] ?? null, // Optional field
                'address' => $validatedData['address'] ?? null, // Optional field
                'hire_date' => $validatedData['hire_date'],
                'employee_code' => $validatedData['employee_code'],
                'employment_status' => $validatedData['employment_status'],
                'notes' => $validatedData['notes'] ?? null, // Optional field
            ]);

            // Update related department and duty if they are selected
            if (isset($validatedData['department_id'])) {
                $employee->department_id = $validatedData['department_id'];
            }

            if (isset($validatedData['duty_id'])) {
                $employee->duty_id = $validatedData['duty_id'];
            }

            // Save the changes
            $employee->save();

            // Redirect back to the employee listing page with success message
            return redirect()->route('admin.manage.users')->with('success', 'Employee updated successfully.');

        } catch (\Exception $e) {
            // If an error occurs, redirect back with an error message
            return redirect()->back()->with('error', 'Failed to update employee: ' . $e->getMessage());
        }
    }
}
