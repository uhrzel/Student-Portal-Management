<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="lg:w-[28rem] mx-auto my-auto flex flex-row justify-center items-center space-x-4 pt-8 md:justify-start md:px-6 md:pt-0">
                <x-application-logo class="block h-12 w-auto" />
                <p class="text-left text-3xl font-bold">{{ config('app.name') }}</p>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="my-4 text-center">
                <p class="uppercase font-bold font-sans text-3xl">login</p>
            </div>
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            <div class="mt-4 relative">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required autocomplete="current-password" />
                <!-- Eye icon to toggle password visibility -->
                <span id="togglePassword" class="absolute right-6 top-2/3 transform -translate-y-1/2 cursor-pointer text-gray-500">
                    <i class="fas fa-eye"></i>
                </span>
            </div>


            <div class="flex flex-row justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="w-full text-center">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>