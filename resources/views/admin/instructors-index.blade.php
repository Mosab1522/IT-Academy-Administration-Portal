@if(session('instructor_id'))
@php
session()->forget('instructor_id');
@endphp
@endif
<x-layout />
<x-setting heading="Akadémie">
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="text-sm">
                            <tr>
                                <td class="px-6 py-1">Meno a priezvisko</td>
                                <td class="px-6 py-2">Email</td>
                                <td class="px-6 py-2">Počet typov kurzov</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($instructors as $instructor)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="/admin/academies/{{ $instructor->id }}">
                                                {{$instructor->name }}{{$instructor->lastname}}
                                            </a>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $instructor->email}}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $instructor->coursetypes->count()}}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {!! $instructor->login ? '<a href="">Zmeniť login</a>' : '<a
                                                href="'.route('register', ['instructor_id' =>$instructor->id]).'"
                                                class="text-red-600">Vytvoriť login</a>'!!}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/admin/academies/{{ $instructor->id }}/edit"
                                        class="text-blue-500 hover:text-blue-600">Edit</a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form method="POST" action="/admin/academies/{{ $instructor->id }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-xs text-gray-400">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-setting>