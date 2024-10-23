<x-app-layout>

    <!-- Navigation Bar -->
    <x-superadmin.nav />

    <x-slot name="title">
        Audit Logs
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-900">Audit Logs</h1>
        </div>

        <!-- Audit Logs Table -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6 p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($auditLogs as $log)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->created_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->user->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->action }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End Audit Logs Table -->
    </div>
</x-app-layout>
