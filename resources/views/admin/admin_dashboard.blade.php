<x-app-layout>
    <!-- Navigation Bar -->
    <x-admin.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Admin Dashboard</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-8">

                <!-- Panel Header -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold text-gray-900">Quick Overview</h3>
                </div>

                <!-- Stats Section -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-blue-500 text-black p-6 rounded-lg shadow">
                        <h4 class="text-xl font-semibold">Pending Leave Requests</h4>
                        <p class="text-2xl mt-4">{{ $pendingRequestsCount }}</p>
                    </div>
                    <div class="bg-green-500 text-black p-6 rounded-lg shadow">
                        <h4 class="text-xl font-semibold">Approved Leaves</h4>
                        <p class="text-2xl mt-4">{{ $approvedLeavesCount }}</p>
                    </div>
                    <div class="bg-red-500 text-black p-6 rounded-lg shadow">
                        <h4 class="text-xl font-semibold">Rejected Leaves</h4>
                        <p class="text-2xl mt-4">{{ $rejectedLeavesCount }}</p>
                    </div>
                </div>
                <!-- End Stats Section -->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
