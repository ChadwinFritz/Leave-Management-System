<x-app-layout>
    <x-user.nav />

    <!-- Header Section -->
    <header class="bg-gradient-to-r from-blue-500 to-indigo-600 text-black py-8">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-extrabold">Update Your Profile</h1>
            <p class="mt-4 text-xl font-medium">Make changes to your personal and employment details</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Profile Information Section -->
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold"><strong>Update</strong> Profile</h3>
            </div>

            <!-- Display Success or Error messages -->
            @if(session('success'))
                <div class="alert alert-success mt-4" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mt-4" role="alert">
                    <strong>Oh snap!</strong>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Profile Form -->
            <form method="post" action="{{ route('user.profile.update') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <!-- Personal Information -->
                    <div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Name</label>
                            <input type="text" name="name" class="form-input mt-1 block w-full" 
                                   value="{{ old('name', Auth::user()->name) }}" required />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Username</label>
                            <input type="text" name="username" class="form-input mt-1 block w-full" 
                                   value="{{ old('username', Auth::user()->username) }}" required />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Email</label>
                            <input type="email" name="email" class="form-input mt-1 block w-full" 
                                   value="{{ old('email', Auth::user()->email) }}" required />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Contact Number</label>
                            <input type="text" name="phone" class="form-input mt-1 block w-full" 
                                   value="{{ old('phone', Auth::user()->employee ? Auth::user()->employee->phone : '') }}" required />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Address</label>
                            <textarea class="form-textarea mt-1 block w-full" name="address" rows="4" required>{{ old('address', Auth::user()->employee ? Auth::user()->employee->address : '') }}</textarea>
                        </div>
                    </div>

                    <!-- Employment Information -->
                    <div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Department</label>
                            <input type="text" class="form-input mt-1 block w-full" 
                                   value="{{ Auth::user()->employee && Auth::user()->employee->department ? Auth::user()->employee->department->name : '' }}" readonly />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Duties</label>
                            <ul class="mt-1 block w-full bg-gray-50 p-2 rounded">
                                @if(Auth::user()->employee && Auth::user()->employee->duties->isNotEmpty())
                                    @foreach(Auth::user()->employee->duties as $duty)
                                        <li class="text-gray-900">
                                            <strong>{{ $duty->name }}</strong> 
                                            <span class="text-gray-600">{{ $duty->description }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-gray-500">No duties assigned</li>
                                @endif
                            </ul>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Hire Date</label>
                            <input type="date" class="form-input mt-1 block w-full" 
                                   value="{{ Auth::user()->employee ? Auth::user()->employee->hire_date->format('Y-m-d') : '' }}" readonly />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Employment Status</label>
                            <input type="text" class="form-input mt-1 block w-full" 
                                   value="{{ Auth::user()->employee ? Auth::user()->employee->employment_status : '' }}" readonly />
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 py-4 border-t flex justify-between">
                    <button type="reset" class="bg-gray-500 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">Clear Form</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Update Profile</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p>&copy; {{ date('Y') }} Leave Management System. All rights reserved.</p>
    </footer>
</x-app-layout>
