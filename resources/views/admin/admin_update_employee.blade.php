resources/views/admin/admin_update_employee.blade.php

<x-app-layout>
    <x-admin.nav />

    <!-- Page Title -->
    <div class="page-title py-6">
        <h2 class="text-3xl font-bold text-black text-center">Update Employee</h2>
    </div>

    <!-- Page Content Wrapper -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <!-- Form to update employee -->
                <form action="{{ route('admin.employees.update', ['employee' => $employee->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Employee Fields -->
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Surname -->
                        <div>
                            <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                            <input type="text" name="surname" id="surname" value="{{ old('surname', $employee->surname) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $employee->address) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Hire Date -->
                        <div>
                            <label for="hire_date" class="block text-sm font-medium text-gray-700">Hire Date</label>
                            <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Department -->
                        <div>
                            <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                            <select name="department_id" id="department_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ $department->id == old('department_id', $employee->department_id) ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Duty -->
                        <div>
                            <label for="duty_id" class="block text-sm font-medium text-gray-700">Duty</label>
                            <select name="duty_id" id="duty_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Duty</option>
                                @foreach($duties as $duty)
                                    <option value="{{ $duty->id }}" {{ $duty->id == old('duty_id', $employee->duty_id) ? 'selected' : '' }}>{{ $duty->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Employee Code -->
                        <div>
                            <label for="employee_code" class="block text-sm font-medium text-gray-700">Employee Code</label>
                            <input type="text" name="employee_code" id="employee_code" value="{{ old('employee_code', $employee->employee_code) }}" readonly class="mt-1 block w-full border border-gray-300 rounded-md bg-gray-100 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Employment Status -->
                        <div>
                            <label for="employment_status" class="block text-sm font-medium text-gray-700">Employment Status</label>
                            <select name="employment_status" id="employment_status" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="active" {{ old('employment_status', $employee->employment_status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="resigned" {{ old('employment_status', $employee->employment_status) == 'resigned' ? 'selected' : '' }}>Resigned</option>
                            </select>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('notes', $employee->notes) }}</textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded">Update Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
