<x-app-layout>
    <!-- Navigation Bar -->
    <x-admin.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6 bg-gray-50 border-b border-gray-300 px-8">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Pending User Registrations</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Pending Users Table -->
                <div class="overflow-x-auto rounded-lg shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Username</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pendingUsers as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">{{ $user->username }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->department->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex gap-4 items-center">
                                        <!-- Approve Button -->
                                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white hover:bg-green-600 px-3 py-2 rounded-lg shadow-sm"
                                                    onclick="return confirm('Are you sure you want to approve this user?');">
                                                Approve
                                            </button>
                                        </form>

                                        <!-- Reject Button -->
                                        <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white hover:bg-red-600 px-3 py-2 rounded-lg shadow-sm"
                                                    onclick="return confirm('Are you sure you want to reject this user?');">
                                                Reject
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        No pending user registrations.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- End Pending Users Table -->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
