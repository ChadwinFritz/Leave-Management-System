<x-app-layout>
    <!-- Navigation Bar -->
    <x-superadmin.nav />

    <x-slot name="title">
        Audit Logs
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-900">Audit Logs</h1>
            <!-- Search or Filter Functionality (if needed in the future) -->
            <div class="relative">
                <input type="text" placeholder="Search..." class="px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
        </div>

        <!-- Audit Logs Table -->
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mt-6 p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($auditLogs as $log)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $log->user->username }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $log->action }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination Controls -->
            <div class="mt-4">
                {{ $auditLogs->links() }}
            </div>
        </div>
        <!-- End Audit Logs Table -->
    </div>
</x-app-layout>
