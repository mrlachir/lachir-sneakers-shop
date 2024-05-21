<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required  autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-center mt-4">
            <x-primary-button class="mt-4 mb-2 bg-black hover:bg-gray-900 text-white text-base">
                {{ __('Log in') }}
            </x-primary-button>
            <hr class="w-full mt-2 mb-4 border-t border-gray-300">
            <a class="border border-black text-black hover:text-gray-900 px-3 py-1 rounded-md text-base" href="{{ route('register') }}">
                CREATE ACCOUNT NOW
            </a>
        </div>
        
        
    </form>
</x-guest-layout>
<style></style>