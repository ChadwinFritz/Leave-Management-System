<x-app-layout>
    <!-- Navigation Bar -->
    <x-user.nav />

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg">
            <form method="post" action="{{ route('user.profile.update') }}">
                @csrf
                <div class="px-6 py-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-800">Update Profile</h3>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success mt-4 bg-green-100 border-t-4 border-green-500 text-green-700 p-4 rounded-lg shadow">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="alert alert-danger mt-4 bg-red-100 border-t-4 border-red-500 text-red-700 p-4 rounded-lg shadow">
                        <strong>Oh snap!</strong>
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <div>
                        <!-- Name Field -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Name</label>
                            <input type="text" name="name" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm" 
                                   value="{{ old('name', Auth::user()->employee->name) }}" required />
                        </div>

                        <!-- Username Field -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Username</label>
                            <input type="text" name="username" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm" 
                                   value="{{ old('username', Auth::user()->username) }}" required />
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Email</label>
                            <input type="email" name="email" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm" 
                                   value="{{ old('email', Auth::user()->email) }}" required />
                        </div>

                        <!-- Phone Field -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Contact Number</label>
                            <input type="text" name="phone" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm" 
                                   value="{{ old('phone', Auth::user()->employee->phone) }}" required />
                        </div>

                        <!-- Address Field -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Address</label>
                            <textarea class="form-textarea mt-1 block w-full border border-gray-300 rounded-md shadow-sm" name="address" rows="4" 
                                      required>{{ old('address', Auth::user()->employee->address) }}</textarea>
                        </div>
                    </div>

                    <div>
                        <!-- Department (Readonly) -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Department</label>
                            <input type="text" name="department" class="form-input mt-1 block w-full bg-gray-100 text-gray-500 border border-gray-300 rounded-md" 
                                   value="{{ Auth::user()->employee->department->name }}" readonly />
                        </div>

                        <!-- Duty (Readonly) -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Duty</label>
                            <input type="text" name="duty" class="form-input mt-1 block w-full bg-gray-100 text-gray-500 border border-gray-300 rounded-md" 
                                   value="{{ Auth::user()->employee->duty->name }}" readonly />
                        </div>

                        <!-- Hire Date (Readonly) -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Hire Date</label>
                            <input type="date" name="hire_date" class="form-input mt-1 block w-full bg-gray-100 text-gray-500 border border-gray-300 rounded-md" 
                                   value="{{ Auth::user()->employee->hire_date }}" readonly />
                        </div>

                        <!-- Employment Status (Readonly) -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Employment Status</label>
                            <input type="text" name="employment_status" class="form-input mt-1 block w-full bg-gray-100 text-gray-500 border border-gray-300 rounded-md" 
                                   value="{{ Auth::user()->employee->employment_status }}" readonly />
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="px-6 py-4 border-t flex justify-between">
                    <button type="reset" class="bg-gray-500 hover:bg-gray-400 text-white font-semibold py-2 px-4 rounded-md">Clear Form</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
