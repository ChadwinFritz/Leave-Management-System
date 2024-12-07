<x-app-layout>
    <x-user.nav />

    <!-- Header Section -->
    <header class="bg-gradient-to-r from-blue-500 to-indigo-600 text-black py-8">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-extrabold">Leave History</h1>
            <p class="mt-4 text-xl font-medium">View all your leave requests and their statuses</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white shadow-lg rounded-lg mt-6 overflow-hidden">
            <!-- Table Section -->
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th> <!-- New Column for Reason -->
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $leave->reason ?? 'No reason provided' }} <!-- Displaying Reason for Leave -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        <div class="mt-6">
            {{ $leaveHistory->links() }}
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p>&copy; {{ date('Y') }} Leave Management System. All rights reserved.</p>
    </footer>
</x-app-layout>
