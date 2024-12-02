<x-app-layout>
    <!-- Navigation Bar -->
    <x-user.nav />

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <form method="POST" action="{{ route('user.leave.request') }}" enctype="multipart/form-data">
                @csrf
                <div class="px-6 py-4 border-b">
                    <h3 class="text-xl font-semibold"><strong>Apply</strong> for Leave</h3>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mt-4 bg-green-100 text-green-700 p-4 rounded-md shadow-md" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger mt-4 bg-red-100 text-red-700 p-4 rounded-md shadow-md" role="alert">
                        <strong>Oh snap!</strong> Please check the form for errors.
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <div>
                        <!-- Leave Type Dropdown -->
                        <div class="mt-4">
                            <x-input-label for="leave_type_id" :value="__('Leave Type')" />
                            <select id="leave_type_id" name="leave_type_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">{{ __('Select Leave Type') }}</option>
                                @foreach($leaveTypes as $leaveType)
                                    <option value="{{ $leaveType->id }}" {{ old('leave_type_id') == $leaveType->id ? 'selected' : '' }}>
                                        {{ $leaveType->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('leave_type_id')" class="mt-2" />
                        </div>

                        <!-- Start and End Dates -->
                        <div class="mb-4">
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <input type="date" name="start_date" id="start_date" class="form-input mt-1 block w-full" required onchange="calculateDays()">
                        </div>

                        <div class="mb-4">
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <input type="date" name="end_date" id="end_date" class="form-input mt-1 block w-full" required onchange="calculateDays()">
                        </div>

                        <div class="mb-4" id="days_count" style="display: none;">
                            <x-input-label for="days" :value="__('Number of Days')" />
                            <input type="text" id="days" class="form-input mt-1 block w-full" readonly>
                        </div>

                        <!-- Employee Data -->
                        <div class="mb-4">
                            <x-input-label for="employee_code" :value="__('Employee Code')" />
                            <input type="text" name="employee_code" class="form-input mt-1 block w-full" value="{{ $employee->employee_code }}" readonly />
                            <p class="text-gray-500 text-sm">Employee unique code</p>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Employee Name')" />
                            <input type="text" name="name" class="form-input mt-1 block w-full" value="{{ $employee->name }}" required />
                            <p class="text-gray-500 text-sm">Name of employee</p>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="username" :value="__('Username')" />
                            <input type="text" name="username" class="form-input mt-1 block w-full" value="{{ Auth::user()->username }}" required />
                            <p class="text-gray-500 text-sm">Username of employee</p>
                        </div>

                        <!-- Reason for Leave -->
                        <div class="mb-4">
                            <x-input-label for="reason" :value="__('Leave Reason')" />
                            <textarea class="form-textarea mt-1 block w-full" name="reason" rows="5" required></textarea>
                            <p class="text-gray-500 text-sm">Reason and additional notes on leave</p>
                        </div>
                    </div>

                    <div>
                        <!-- Contact Number -->
                        <div class="mb-4">
                            <x-input-label for="contact_number" :value="__('Contact Number')" />
                            <input type="text" class="form-input mt-1 block w-full" name="contact_number" value="{{ $employee->phone }}" readonly placeholder="Mobile number" required />
                            <p class="text-gray-500 text-sm">Employee contact number</p>
                        </div>

                        <div class="flex justify-between">
                            <button type="reset" class="bg-gray-500 hover:bg-gray-400 text-white font-semibold py-2 px-4 rounded">
                                Clear Form
                            </button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                                Apply Leave
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function calculateDays() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const daysCountDiv = document.getElementById('days_count');
            const daysInput = document.getElementById('days');

            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (startDate && endDate && startDate <= endDate) {
                const timeDiff = endDate - startDate;
                const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Convert milliseconds to days

                daysCountDiv.style.display = 'block'; // Show the days count div
                daysInput.value = dayDiff; // Set the value in the input
            } else {
                daysCountDiv.style.display = 'none'; // Hide the days count div if invalid
                daysInput.value = ''; // Clear the value
            }
        }
    </script>
</x-app-layout>
