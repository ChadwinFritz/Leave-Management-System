<x-app-layout>
    <!-- Navigation Bar -->
    <x-supervisor.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Assign Tasks to Team Members</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-8">

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-6 bg-green-100 text-green-700 p-4 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 text-red-700 p-4 rounded-md">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Assign Task Form -->
                <form method="POST" action="{{ route('supervisor.assign_tasks') }}">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Employee Selection -->
                        <div>
                            <label for="employee" class="block text-sm font-medium text-gray-700">Select Employee</label>
                            <select 
                                name="employee_id" 
                                id="employee" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                required>
                                <option value="" disabled selected>Select an employee</option>
                                @foreach($teamMembers as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->employee_code }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Task Description -->
                        <div>
                            <label for="task_description" class="block text-sm font-medium text-gray-700">Task Description</label>
                            <textarea 
                                name="task_description" 
                                id="task_description" 
                                rows="4" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                placeholder="Describe the task..." 
                                required></textarea>
                        </div>

                        <!-- Deadline -->
                        <div>
                            <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                            <input 
                                type="date" 
                                name="deadline" 
                                id="deadline" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                required>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-right">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-black font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Assign Task
                            </button>
                        </div>
                    </div>
                </form>
                <!-- End Assign Task Form -->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
