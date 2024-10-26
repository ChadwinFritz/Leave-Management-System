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
        // Fetch departments and duties
        $departments = Department::all();
        $duties = Duty::all();

        // Generate Employee Code
        $lastEmployee = Employee::latest()->first(); // Get the last employee record

        // Check if any employee exists
        if ($lastEmployee) {
            // Get the current highest number from the last employee code
            $lastCode = (int) substr($lastEmployee->employee_code, -3); // Extract the last 3 digits
            $employeeCode = $lastCode + 1; // Increment
        } else {
            // If no employees exist, start with 1
            $employeeCode = 1;
        }

        // Format the new employee code
        $formattedEmployeeCode = 'EMP' . str_pad($employeeCode, 3, '0', STR_PAD_LEFT); // Format as EMP001, EMP002, etc.

        // Check if the generated employee code already exists
        $existingEmployee = Employee::where('employee_code', $formattedEmployeeCode)->first();

        if ($existingEmployee) {
            // Handle the case where the employee code already exists (optional)
            // You might want to throw an error or increment the code until you find an unused one
            // For example, loop until you find an available code
            do {
                $employeeCode++;
                $formattedEmployeeCode = 'EMP' . str_pad($employeeCode, 3, '0', STR_PAD_LEFT);
                $existingEmployee = Employee::where('employee_code', $formattedEmployeeCode)->first();
            } while ($existingEmployee);
        }

        return view('auth.register', compact('departments', 'duties', 'formattedEmployeeCode'));
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Automatically set hire_date as the current date
        $hireDate = now();

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email, // Ensure this is included
            'password' => Hash::make($request->password),
        ]);

        // Create a new employee linked to the user
        Employee::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'user_id' => $user->id,
            'email' => $request->email, // Add email here
            'phone' => $request->phone,
            'address' => $request->address,
            'hire_date' => $hireDate,
            'employee_code' => $request->employee_code,
            'department_id' => $request->department_id,
            'duty_id' => $request->duty_id,
            'employment_status' => $request->employment_status,
        ]);

        // Fire the Registered event
        event(new Registered($user));

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    /**
     * Register a new user.
     */
    public function register(Request $request): RedirectResponse
    {
        return $this->store($request);
    }
}
