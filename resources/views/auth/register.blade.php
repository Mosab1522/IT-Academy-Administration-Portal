@if (session('instructor_id') || $instructor)
    @unless ($instructor)
        @php
            $instructor = \App\Models\Instructor::find(session('instructor_id'));
            session()->forget('instructor_id');
        @endphp
    @endif

    <x-layout />
    <x-setting heading="Login" etitle="Nastavenie loginu inštruktora {{ $instructor->name }} {{ $instructor->lastname }}">

        <form method="POST" action="/admin/login/{{ $instructor->login ? 'update' : 'create' }}">
            @csrf
            @if ($instructor->login)
                @method('Patch')
                <input name="user_id" value="{{ $instructor->login->id }}" hidden />
            @else
                <input name="instructor_id" value="{{ $instructor->id }}" hidden />
            @endif

            <label for="nickname" class="block text-sm font-medium text-gray-700">Prihlasovacie meno</label>
            <input type="text" name="nickname" value="{{ $instructor->login->nickname ?? '' }}" required autofocus
                autocomplete="name"
                class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6" />

            <div class="flex mt-6">
                <div class="w-1/2 mr-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Heslo</label>
                    <input type="password" name="password" autocomplete="new-password"
                        class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6" />
                </div>

                <div class="w-1/2 ml-2">

                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Potvrdiť
                        heslo</label>
                    <input type="password" name="password_confirmation" autocomplete="new-password"
                        class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6" />
                </div>
            </div>

            <x-form.field>
                <div class="flex justify-end space-x-4 mt-6">
                    <x-form.button class=" flex-1">{{ $instructor->login ? 'Zmeniť' : 'Vytvoriť' }}
                    </x-form.button>
                    <a href="/admin/instructors" id="res1"
                        class="flex-none bg-gray-400 text-white text-sm font-medium py-2 px-6 rounded-md hover:bg-gray-500 transition-colors duration-200 shadow-sm">Preskočiť</a>

                </div>
            </x-form.field>

        </form>
    </x-setting>
@else
    <script>
        window.location = "/admin/instructors"
    </script>
    @endif
