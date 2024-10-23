<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // You can add specific authorization logic here. For now, we'll allow all.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $this->employee->id, // Ensure uniqueness except for the current employee
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'department_id' => 'required|exists:departments,id', // Ensure the department exists
            'duty_id' => 'required|exists:duties,id', // Ensure the duty exists
            'employee_code' => 'required|string|max:50|unique:employees,employee_code,' . $this->employee->id, // Ensure uniqueness except for the current employee
            'employment_status' => 'required|in:active,resigned', // Valid employment statuses
            'notes' => 'nullable|string|max:500', // Optional notes field
        ];
    }
}
