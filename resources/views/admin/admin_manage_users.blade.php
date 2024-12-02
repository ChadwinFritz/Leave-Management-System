<x-app-layout>
    <!-- Navigation Bar -->
    <x-admin.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6 flex justify-between items-center bg-gray-100 border-b border-gray-300 px-8">
        <h2 class="text-3xl font-bold text-gray-900">Manage Users</h2>
        <a href="{{ route('admin.employees.create') }}" 
           class="bg-green-600 text-white hover:bg-green-700 px-4 py-2 rounded-lg shadow-sm">
            + Add New User
        </a>
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
                            @forelse($employees as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">{{ $user->employee_code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->username }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->department->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <!-- Edit Employee Button -->
                                        <a href="{{ route('admin.employees.edit', $user->id) }}" 
                                           class="bg-yellow-500 text-white hover:bg-yellow-600 px-3 py-2 rounded-lg shadow-sm">
                                            Edit
                                        </a>

                                        <!-- Delete Employee Button -->
                                        <form action="{{ route('admin.employees.destroy', $user->id) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 text-white hover:bg-red-600 px-3 py-2 rounded-lg shadow-sm"
                                                    onclick="return confirm('Are you sure you want to delete this employee?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- End Users Management Table -->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
