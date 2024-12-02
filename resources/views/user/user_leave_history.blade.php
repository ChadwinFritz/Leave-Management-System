<x-app-layout>
    <!-- Navigation Bar -->
    <x-user.nav />

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800">Leave History</h1>

        <div class="bg-white shadow-lg rounded-lg mt-6 overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($leaveHistory as $leave)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $leave->leaveType->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $leave->start_date->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $leave->end_date->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($leave->status === 'approved')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Approved</span>
                                @elseif($leave->status === 'pending')
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">Pending</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Rejected</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination (if needed) -->
        <div class="mt-6">
            {{ $leaveHistory->links() }}
        </div>
    </div>
</x-app-layout>
