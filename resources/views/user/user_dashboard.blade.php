<x-app-layout>
    <!-- Navigation Bar -->
    <x-user.nav />

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Welcome, {{ Auth::user()->name }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Total Leaves Taken -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold">Total Leaves Taken</h2>
                <p class="text-gray-600 mt-2">{{ $totalLeavesTaken ?? 'Loading...' }} days</p>
            </div>

            <!-- Remaining Leave Balance -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold">Remaining Leave Balance</h2>
                <p class="text-gray-600 mt-2">{{ $remainingLeave ?? 'Loading...' }} days</p>
            </div>
        </div>

        <!-- Leave Type Graph -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-6">
            <h2 class="text-xl font-bold">Leave Types Overview</h2>
            <canvas id="leaveTypesChart"></canvas>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center space-x-6 mt-6">
            <a href="{{ route('user.leave.application') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 transition">
                Apply for Leave
            </a>
            <a href="{{ route('user.leave.history') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600 transition">
                View Leave History
            </a>
            <a href="{{ route('user.profile') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md shadow hover:bg-yellow-600 transition">
                Update Profile
            </a>
        </div>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for the chart
        const leaveTypes = @json($leaveTypes); // Array of leave types from the server
        const takenDays = @json($takenDays); // Days taken for each leave type
        const remainingDays = @json($remainingDays); // Remaining days for each leave type

        const ctx = document.getElementById('leaveTypesChart').getContext('2d');
        const leaveTypesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: leaveTypes.map(type => type.name), // Leave type names
                datasets: [
                    {
                        label: 'Days Taken',
                        data: takenDays, // Data for days taken
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Days Remaining',
                        data: remainingDays, // Data for remaining days
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                    }
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
</x-app-layout>
