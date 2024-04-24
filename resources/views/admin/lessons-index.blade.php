<x-flash />
<x-layout />
<x-setting heading="Hodiny" etitle="Existujúce hodiny">
    <x-slot:create>
        <div class="flex flex-col">
            <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie hodiny</h3>
                <form action="/admin/lessons/create" method="post">
                    @csrf
                    {{--
                    <x-form.label name="Zapísať všetkých ktorý majú prihlášku na kurz?" />
                    <input type="checkbox" name="students"> --}}
                    <x-form.field>
                        <x-form.input name="title" type="text" title="Názov hodiny" placeholder="Názov hodiny" />
                    </x-form.field>
                    <x-form.field>

                        <div>

                            {{-- <input name="coursetype_id" value="{{$coursetype->id}}" hidden /> --}}


                            <!-- parent -->
                            <x-form.select name="class_id" title="Triedy">
                                <option style="color: gray;" value="" disabled selected hidden>Triedy</option>
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
                            </x-form.select>
                        </div>
                    </x-form.field>
                    <x-form.field>
                        <div class="flex">
                            <x-form.label name="datetime-local" title="Dátum a trvanie hodiny" />

                        </div>
                        <div class="flex">
                            <input type="datetime-local" name="lesson_date" value="{{ old('lesson_date')}}"
                                class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <input type="time" name="duration"
                                class="mt-1 ml-4 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                step="60" value="{{ old('duration', '00:45') }}">

                        </div>

                    </x-form.field>

                    <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                        Odoslať
                    </x-form.button>
                </form>
            </div>
        </div>
    </x-slot:create>

    <x-form.search action="{{ route('admin.lessons.index') }}" text="Filtrovať a zoradiť">
            @csrf
            @if(request()->filled('search'))
            <input type="hidden" name="search" value="{{request()->input('search')}}" />
            @endif
            <x-form.search-select name="orderBy" title="Zoradiť podľa">
                <option value="created_at" {{request()->input('orderBy')=='created_at' ? 'selected' : ''}}>Dátumu
                    vytvorenia</option>
                <option value="updated_at" {{request()->input('orderBy')=='updated_at' ? 'selected' : ''}}>Dátumu
                    poslednej úpravy</option>
            </x-form.search-select>
            <x-form.search-select name="orderDirection" title="Smer zoradenia">
                <option value="desc" {{request()->input('orderDirection')=='desc' ? 'selected' : ''}}>Od najnovšej
                </option>
                <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Od najstaršej
                </option>
            </x-form.search-select>

            <x-form.search-select name="class_id" title="Trieda">
                @php
                $classes = \App\Models\CourseClass::with(['instructor','students'])->get();
                @endphp

                <option value="" data-option="-1">Všetky</option>

                @foreach ($classes as $class)
                <option value="{{ $class->id }}" data-id="{{ $class->id }}" data-option="-1" {{request()->
                    input('class_id')==$class->id ? 'selected' : ''}}>{{
                    ucwords($class->name) }}</option>
                @endforeach
            </x-form.search-select>



            <x-slot:search>
            @csrf
            @if(request()->filled('orderBy'))
            <input type="hidden" name="orderBy" value="{{request()->input('orderBy')}}" />
            <input type="hidden" name="orderDirection" value="{{request()->input('orderDirection')}}" />
            @endif
            @if(request()->filled('class_id'))
            <input type="hidden" name="class_id" value="{{request()->input('class_id')}}" />

            @endif
        </x-slot:search>
    </x-form.search>




    <div class="flex-auto mt-6">

        <!-- Iterate over classes -->
        @foreach ($lessons->groupBy('class.name') as $className => $lessonsInClass)
        @php
        // Assuming you can access the first lesson to get the class ID
        $firstLesson = $lessonsInClass->first();
        $classId = $firstLesson->class->id;
        @endphp
        <div class=" mb-6">
           
                <h3 class="-mb-4 leading-6  text-gray-700">Hodiny triedy - 
                    <a href="/admin/lessons/{{ $classId }}" class="hover:underline underline-offset-2 hover:text-gray-900">
                        {{ $className }}
                    </a>
                </h3>


                <x-single-table>
                    <x-slot:head>
                                <th scope="col" class="py-3 px-6">
                                    Názov hodiny
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Inštruktor
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Dátum a trvanie
                                </th>
                                <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                                    Akcie
                                </th>
                            </x-slot:head>
                            <!-- Iterate over lessons in this class -->
                            @foreach ($lessonsInClass as $lesson)
                            <tr class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                <td class="py-4 px-6">
                                    <x-table.td url="lessons/{{ $lesson->id }}">
                                    {{ $lesson->title }}
                                    </x-table.td>
                                </td>
                                <td class="py-4 px-6">
                                    <x-table.td url="instructors/{{ $lesson->instructor->id }}">
                                    {{ $lesson->instructor->name }} {{ $lesson->instructor->lastname }}
                                    </x-table.td>
                                </td>
                                <td class="py-4 px-6">
                                    {{ $lesson->lesson_date }} - {{ $lesson->duration }} minút
                                </td>
                                <x-table.td-last url="lessons/{{ $lesson->id }}" edit=1 itemName="hodinu {{$lesson->title}}" />
                               
                            </tr>
                            @endforeach
                        </x-single-table>
        </div>
            @endforeach

        </div>


</x-setting>