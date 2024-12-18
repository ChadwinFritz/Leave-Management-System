<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Duty;
use App\Models\Employee;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view with departments and duties.
     */
    public function create(): View
    {
        // Fetch all departments and duties
        $departments = Department::all();
        $duties = Duty::all();

        // Generate Employee Code
        $lastEmployee = Employee::latest()->first();

        if ($lastEmployee) {
            $lastCode = (int) substr($lastEmployee->employee_code, -3);
            $employeeCode = $lastCode + 1;
        } else {
            $employeeCode = 1;
        }

        $formattedEmployeeCode = 'EMP' . str_pad($employeeCode, 3, '0', STR_PAD_LEFT);
        $existingEmployee = Employee::where('employee_code', $formattedEmployeeCode)->first();

        if ($existingEmployee) {
            do {
                $employeeCode++;
                $formattedEmployeeCode = 'EMP' . str_pad($employeeCode, 3, '0', STR_PAD_LEFT);
                $existingEmployee = Employee::where('employee_code', $formattedEmployeeCode)->first();
            } while ($existingEmployee);
        }

        // Pass the departments, duties, and employee code to the view
        return view('auth.register', compact('departments', 'duties', 'formattedEmployeeCode'));
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:15'],
            'address' => ['nullable', 'string', 'max:255'],
            'employee_code' => ['required', 'string', 'unique:employees,employee_code'],
            'department_id' => ['required', 'exists:departments,id'],
            'duty_id' => ['required', 'exists:duties,id'],
            'employment_status' => ['required', 'string'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[!@#$%^&*()_+]/',
                'confirmed',
            ],
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one number, and one special character (!@#$%^&*()_+).',
        ]);

        $hireDate = now();

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create a new employee linked to the user
        Employee::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'user_id' => $user->id,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'hire_date' => $hireDate,
            'employee_code' => $request->employee_code,
            'department_id' => $request->department_id,
            'duty_id' => $request->duty_id,
            'employment_status' => $request->employment_status,
            'status' => 'pending',
        ]);

        event(new Registered($user));

        return redirect()->route('auth.login')->with('success', 'Registration successful. Please wait for admin approval to log in.');
    }
}
