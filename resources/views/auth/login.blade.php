<x-guest-layout>
    <!-- Login Form -->
    <div class="max-w-sm mx-auto p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">{{ __('Login to Your Account') }}</h2>
        
        <form method="POST" action="{{ route('auth.login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input 
                    id="email" 
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="email" 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input 
                    id="password" 
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password" 
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mb-4">
                <label for="remember_me" class="flex items-center text-sm text-gray-600">
                    <input 
                        id="remember_me" 
                        type="checkbox" 
                        name="remember" 
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                    />
                    <span class="ml-2">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Forgot Password and Register Links -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                @if (Route::has('password.request'))
                    <a 
                        href="{{ route('password.request') }}" 
                        class="text-sm text-indigo-600 hover:text-indigo-800 underline"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                @if (Route::has('auth.register'))
                    <a 
                        href="{{ route('auth.register') }}" 
                        class="text-sm text-indigo-600 hover:text-indigo-800 underline"
                    >
                        {{ __('Don\'t have an account? Register') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="mt-6">
                <x-primary-button class="w-full py-2 px-4 text-lg bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 rounded-md">
                    {{ __('Login') }}
                </x-primary-button>
            </div>

            <!-- Additional Links -->
            <div class="mt-4 flex flex-col items-center space-y-2">
                @if (Route::has('auth.confirm-password'))
                    <a 
                        href="{{ route('auth.confirm-password') }}" 
                        class="text-sm text-indigo-600 hover:text-indigo-800 underline"
                    >
                        {{ __('Confirm your password') }}
                    </a>
                @endif

                @if (Route::has('auth.reset-password'))
                    <a 
                        href="{{ route('auth.reset-password') }}" 
                        class="text-sm text-indigo-600 hover:text-indigo-800 underline"
                    >
                        {{ __('Reset your password') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>
