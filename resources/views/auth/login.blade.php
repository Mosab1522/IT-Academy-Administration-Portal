<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mt-4">

            <label for="nickname" class="block text-sm font-medium text-gray-700">Prihlasovacie meno</label>
            <x-text-input id="nickname"
                class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6"
                type="text" name="nickname" :value="old('nickname')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Heslo</label>

            <x-text-input id="password"
                class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6"
                type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-form.button class="mt-4 md:w-auto w-full sm:w-auto">
                Odoslať
            </x-form.button>
        </div>
    </form>
</x-guest-layout>
