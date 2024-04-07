<x-flash />
<x-layout />
<x-setting heading="Hodiny" ctitle="hodiny" etitle="e hodiny">
    <x-slot:create>
        <form action="/admin/lessons/create" method="post">
            @csrf
            {{--
            <x-form.label name="Zapísať všetkých ktorý majú prihlášku na kurz?" />
            <input type="checkbox" name="students"> --}}
            <x-form.input name="title" type="text"/>
            <x-form.field>

                <div>

                    {{-- <input name="coursetype_id" value="{{$coursetype->id}}" hidden /> --}}

                    <x-form.label name="Triedy" />
                    <!-- parent -->
                    <select name="class_id" class="w-full">
                        <option value="" disabled selected hidden>Triedy</option>
                        {{-- @php
                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                        ->get();
                        @endphp --}}
                        {{-- @php
                        $assignedInstructors = $coursetype->instructors->pluck('id')->toArray();
                        @endphp --}}
                        @foreach (\App\Models\CourseClass::with(['instructor'])->get() as $class)



                        <option value="{{ $class->id }}" data-id="{{ $class->id }}" data-option="-1"
                            {{old('instructor_id')==$class->id ? 'selected' :
                            ''}}>Meno: {{
                            ucwords($class->name)}} {{
                            ucwords($class->coursetype->name)}}</option>

                        @endforeach
                        {{-- <option value="" disabled selected hidden>Akadémia</option>
                        <option value="1" data-id="1" data-option="-1">Cisco</option>
                        <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                    </select>
                </div>
            </x-form.field>
            <x-form.field>
                <x-form.label name="Dátum" />
                <input type="datetime-local" name="lesson_date" class="border">
                <input type="time" id="duration" name="duration" step="60" value="00:45">
            </x-form.field>

            <x-form.button>
                Odoslať
            </x-form.button>
        </form>
    </x-slot:create>
    <div class="flex mt-3">
        <form method="get" action="{{ route('admin.lessons.index') }}">
            @csrf

            @if(request()->filled('search'))
            <input type="hidden" name="search" value="{{request()->input('search')}}" />
            @endif
            <div class="flex">
                <div class="">
                    <x-form.label name="Zoradiť podľa" />
                    <select class="form-control" id="orderBy" name="orderBy">
                        <option value="created_at" {{request()->input('orderBy')=='created_at' ? 'selected' :
                            ''}}>Dátumu vytvorenia</option>
                        <option value="updated_at" {{request()->input('orderBy')=='updated_at' ? 'selected' :
                            ''}}>Dátumu poslednej úpravy</option>
                    </select>
                </div>
                <div class="px-6">
                    <x-form.label name="Smer zoradenia" /> <select class="form-control" id="orderDirection"
                        name="orderDirection">
                        <option value="desc" {{request()->input('orderDirection')=='desc' ? 'selected' : ''}}>Od
                            najnovšej
                        </option>
                        <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Od
                            najstaršej
                        </option>
                    </select>
                </div>
                {{-- <div class="form-group">
                    <select class="form-control" id="filterBy" name="filterBy[]" multiple>
                        <option value="academy_id|1">Akadémia 1</option>
                        <option value="academy_id|2">Akadémia 2</option>
                        <option value="coursetype_id|1">Typ kurzu 1</option>
                        <option value="coursetype_id|2">Typ kurzu 2</option>
                    </select>
                </div> --}}
                <div>
                    <x-form.label name="Filtrovať podľa" />
                    <div class="flex">
                        <div>
                            <select name="class_id" class="combo-a" data-nextcombo=".combo-b">
                                <option value="" disabled selected hidden>Trieda</option>
                                @php
                                $classes = \App\Models\CourseClass::with(['instructor','students'])->get();
                                @endphp

                                <option value="" data-option="-1">Všetky</option>

                                @foreach ($classes as $class)
                                <option value="{{ $class->id }}" data-id="{{ $class->id }}" data-option="-1"
                                    {{request()->input('academy_id')==$class->id ? 'selected' : ''}}>{{
                                    ucwords($class->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
        </form>
        <div class="ml-auto">
            <form method="get" action="{{ route('admin.classes.index') }}">
                @csrf
                @if(request()->filled('orderBy'))
                <input type="hidden" name="orderBy" value="{{request()->input('orderBy')}}" />
                <input type="hidden" name="orderDirection" value="{{request()->input('orderDirection')}}" />
                @endif
                @if(request()->filled('academy_id')&&request()->filled('coursetype_id'))
                <input type="hidden" name="academy_id" value="{{request()->input('academy_id')}}" />
                <input type="hidden" name="coursetype_id" value="{{request()->input('coursetype_id')}}" />
                @elseif(request()->filled('academy_id'))
                <input type="hidden" name="academy_id" value="{{request()->input('academy_id')}}" />
                @endif
                <x-form.label name="Vyhľadávanie" />
                <input type="text" name="search" value="{{request()->input('search')}}" />
                <x-form.button>
                    Hľadať
                </x-form.button>
            </form>
        </div>
    </div>
    <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-6 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-x-auto relative ">
                <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <!-- Iterate over classes -->
                    @foreach ($lessons->groupBy('class.name') as $className => $lessonsInClass)
                    @php
                    // Assuming you can access the first lesson to get the class ID
                    $firstLesson = $lessonsInClass->first();
                    $classId = $firstLesson->class->id;
                    @endphp
                    <div class="mb-10">
                        <h3 class="text-lg leading-6 font-medium text-gray-800 mb-2">
                            <a href="/admin/lessons/{{ $classId }}" class="hover:underline hover:text-gray-900">
                                Trieda: {{ $className }}
                            </a>
                        </h3>
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th scope="col"
                                            class="py-3 px-6 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                            Názov hodiny
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                            Inštruktor
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">
                                            Dátum a trvanie
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium text-gray-800 uppercase tracking-wider w-64">
                                            Akcie
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Iterate over lessons in this class -->
                                    @foreach ($lessonsInClass as $lesson)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4 px-6">
                                            {{ $lesson->title }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $lesson->instructor->name }} {{ $lesson->instructor->lastname }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $lesson->lesson_date }} - {{ $lesson->duration }} minút
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <a href="/admin/lessons/{{ $lesson->id }}"
                                                class="text-blue-600 hover:text-blue-700 hover:underline">Upraviť</a>
                                            &nbsp;
                                            <form method="POST" action="/admin/lessons/{{ $lesson->id }}"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-700 hover:underline">Vymazať</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>



        </div>
    </div>


</x-setting>