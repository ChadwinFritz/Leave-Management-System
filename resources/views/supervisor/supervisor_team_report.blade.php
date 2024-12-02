<x-app-layout>
    <!-- Navigation Bar -->
    <x-supervisor.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Team Performance Report</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-8">

                <!-- Report Filters -->
                <form method="GET" action="{{ route('supervisor.team_report') }}" class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="month" class="block text-sm font-medium text-gray-700">Month</label>
                            <select name="month" id="month" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach($months as $month)
                                    <option value="{{ $month }}" {{ $currentMonth == $month ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                            <select name="year" id="year" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow hover:bg-indigo-700">
                                Generate Report
                            </button>
                        </div>
                    </div>
                </form>
                <!-- End Report Filters -->

                <!-- Performance Report Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Completed Tasks</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Days</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Overtime Hours</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($teamReports as $report)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $report->employee->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $report->completed_tasks }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $report->leave_days }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $report->overtime_hours }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Performance Report Table -->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
