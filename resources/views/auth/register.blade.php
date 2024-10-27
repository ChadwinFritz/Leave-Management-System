<x-guest-layout>
    <form method="POST" action="{{ route('auth.register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('Surname')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" autocomplete="street-address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Hire Date -->
        <div class="mt-4">
            <x-input-label for="hire_date" :value="__('Hire Date')" />
            <x-text-input id="hire_date" class="block mt-1 w-full" type="date" name="hire_date" :value="old('hire_date')" autocomplete="hire-date" />
            <x-input-error :messages="$errors->get('hire_date')" class="mt-2" />
        </div>

        <!-- Department -->
        <div class="mt-4">
            <x-input-label for="department_id" :value="__('Department')" />
            <select id="department_id" name="department_id" class="block mt-1 w-full" required>
                <option value="">{{ __('Select Department') }}</option>
                @foreach($departments ?? [] as $department) <!-- Default to empty array -->
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
        </div>

        <!-- Duty -->
        <div class="mt-4">
            <x-input-label for="duty_id" :value="__('Duty')" />
            <select id="duty_id" name="duty_id" class="block mt-1 w-full" required>
                <option value="">{{ __('Select Duty') }}</option>
                @foreach($duties ?? [] as $duty) <!-- Default to empty array to avoid undefined variable error -->
                    <option value="{{ $duty->id }}" {{ old('duty_id') == $duty->id ? 'selected' : '' }}>
                        {{ $duty->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('duty_id')" class="mt-2" />
        </div>

        <!-- Employee Code -->
        <div class="mt-4">
            <x-input-label for="employee_code" :value="__('Employee Code')" />
            <x-text-input id="employee_code" class="block mt-1 w-full" type="text" name="employee_code" :value="$formattedEmployeeCode" required readonly />
            <x-input-error :messages="$errors->get('employee_code')" class="mt-2" />
        </div>

        <!-- Employment Status -->
        <div class="mt-4">
            <x-input-label for="employment_status" :value="__('Employment Status')" />
            <select id="employment_status" name="employment_status" class="block mt-1 w-full">
                <option value="active" {{ old('employment_status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('employment_status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <x-input-error :messages="$errors->get('employment_status')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" oninput="validatePassword()" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Password validation messages -->
            <div id="passwordRequirements" class="mt-2 text-sm text-gray-600">
                <p id="uppercase" class="text-gray-600">• At least one uppercase letter</p>
                <p id="number" class="text-gray-600">• At least one number</p>
                <p id="special" class="text-gray-600">• At least one special character (!@#$%^&*()_+)</p>
            </div>
        </div>

        <script>
            function validatePassword() {
                const password = document.getElementById('password').value;
                
                // Select each requirement element
                const uppercase = document.getElementById('uppercase');
                const number = document.getElementById('number');
                const special = document.getElementById('special');

                // Test password for each condition
                const hasUppercase = /[A-Z]/.test(password);
                const hasNumber = /[0-9]/.test(password);
                const hasSpecial = /[!@#$%^&*()_+]/.test(password);

                // Update styling based on validation status
                uppercase.classList.toggle('text-green-500', hasUppercase);
                uppercase.classList.toggle('text-gray-600', !hasUppercase);

                number.classList.toggle('text-green-500', hasNumber);
                number.classList.toggle('text-gray-600', !hasNumber);

                special.classList.toggle('text-green-500', hasSpecial);
                special.classList.toggle('text-gray-600', !hasSpecial);
            }
        </script>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
