<x-app-layout>
    <!-- Navigation Bar -->
    <x-admin.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6 flex justify-between items-center bg-gray-100 border-b border-gray-300 px-8">
        <h2 class="text-3xl font-bold text-gray-900">Manage Users</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">

                <!-- Users Management Section -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Employee Directory</h3>
                    <p class="text-sm text-gray-500">Below is a list of all employees and their associated information. You can edit or delete their records as necessary.</p>
                </div>

                <!-- Users Management Table -->
                <div class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Employee Code</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Username</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($employees as $employee)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">{{ $employee->employee_code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->username }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->department->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <!-- Edit Employee Button -->
                                    <a href="{{ route('admin.update.employee.edit', $employee->id) }}" 
                                       class="bg-yellow-500 text-black hover:bg-yellow-600 px-3 py-2 rounded-lg shadow-sm">
                                        Edit
                                    </a>

                                    <!-- Delete Employee Button -->
                                    <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 text-black hover:bg-red-600 px-3 py-2 rounded-lg shadow-sm"
                                                onclick="return confirm('Are you sure you want to delete this employee?');">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Users Management Table -->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
