resources/views/user/user_profile.blade.php

<x-app-layout>
    <!-- Navigation Bar -->
    <x-user.nav />

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg">
            <form method="post" action="{{ route('user.profile.update') }}">
                @csrf
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold"><strong>Update</strong> Profile</h3>
                </div>

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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Name</label>
                            <input type="text" name="name" class="form-input mt-1 block w-full" 
                                   value="{{ old('name', Auth::user()->employee->name) }}" required/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Username</label>
                            <input type="text" name="username" class="form-input mt-1 block w-full" 
                                   value="{{ old('username', Auth::user()->username) }}" required/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Email</label>
                            <input type="email" name="email" class="form-input mt-1 block w-full" 
                                   value="{{ old('email', Auth::user()->email) }}" required/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Contact Number</label>
                            <input type="text" name="phone" class="form-input mt-1 block w-full" 
                                   value="{{ old('phone', Auth::user()->employee->phone) }}" required/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Address</label>
                            <textarea class="form-textarea mt-1 block w-full" name="address" rows="4" 
                                      required>{{ old('address', Auth::user()->employee->address) }}</textarea>
                        </div>
                    </div>

                    <div>
                        <!-- Employment-related fields -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Department</label>
                            <input type="text" name="department" class="form-input mt-1 block w-full" 
                                   value="{{ Auth::user()->employee->department->name }}" readonly/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Duty</label>
                            <input type="text" name="duty" class="form-input mt-1 block w-full" 
                                   value="{{ Auth::user()->employee->duty->name }}" readonly/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Hire Date</label>
                            <input type="date" name="hire_date" class="form-input mt-1 block w-full" 
                                   value="{{ Auth::user()->employee->hire_date }}" readonly/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Employment Status</label>
                            <input type="text" name="employment_status" class="form-input mt-1 block w-full" 
                                   value="{{ Auth::user()->employee->employment_status }}" readonly/>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 border-t flex justify-between">
                    <button type="reset" class="bg-gray-500 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">Clear Form</button>
                    <button type="submit" class="bg-gray-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
