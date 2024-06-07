<x-layout />
@php
    session()->forget('student_id');
    session()->forget('coursetype_id');
    $coursetype = null;
    if (request()->coursetype_id) {
        $coursetype = \App\Models\CourseType::find(request()->coursetype_id);
    }
@endphp
@php
    $text = 'Prihlášky na vaše kurzy';

    if (auth()->user()->can('admin')) {
        $text = 'Existujúce prihlášky';
    }
@endphp
<x-setting heading="Prihlášky" etitle="{{ $text }}">
    <x-slot:create>
        <div class="flex flex-col">
            <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie prihlášky</h3>
                <form action="/" method="post">
                    @csrf
                    <x-form.required class="-mt-3 mb-6" />
                    <input type="hidden" name="typ" value="admin" />
                    @if (request()->student_id)
                        @php
                            session(['student_id' => request()->student_id]);

                        @endphp
                    @endif
                    @unless (session('student_id'))
                        <x-form.live-search />
                    @else
                        @php

                            $student = \App\Models\Student::find(session('student_id'));
                        @endphp
                        <x-form.input name="name" value="{{ $student->name }}" title="Meno" placeholder="Meno"
                            disabled />
                        <x-form.input name="lastname" value="{{ $student->lastname }}" title="Priezvisko"
                            placeholder="Priezvisko" disabled />
                        <x-form.input name="email" value="{{ $student->email }}" title="Email" placeholder="Email"
                            disabled />
                        <input name="name" value="{{ $student->name }}" hidden />
                        <input name="lastname" value="{{ $student->lastname }}" hidden />
                        <input name="email" value="{{ $student->email }}" hidden />
                    @endunless

                    @if ($coursetype)
                        <input name="academy_id" value="{{ $coursetype->academy->id }}" hidden />
                        <input name="coursetype_id" value="{{ $coursetype->id }}" hidden />
                    @endif

                    @php
                        if (auth()->user()->can('admin')) {
                            $academy = \App\Models\Academy::all();
                            $coursetypes = \App\Models\CourseType::all();
                        } else {
                            $authInstructorId = auth()->user()->user_id;
                            $academy = \App\Models\Academy::whereHas('coursetypes.instructors', function ($query) use (
                                $authInstructorId,
                            ) {
                                $query->where('instructors.id', $authInstructorId);
                            })
                                ->with([
                                    'coursetypes' => function ($query) use ($authInstructorId) {
                                        $query->whereHas('instructors', function ($q) use ($authInstructorId) {
                                            $q->where('instructors.id', $authInstructorId);
                                        });
                                    },
                                ])
                                ->get();
                            $coursetypes = \App\Models\CourseType::whereHas('instructors', function ($query) use (
                                $authInstructorId,
                            ) {
                                $query->where('instructors.id', $authInstructorId);
                            })->get();
                        }

                    @endphp
                    <x-form.field>

                        <div class="items-center mt-6">
                            <x-form.label name="type" title="Typ kurzu" required="true" />

                            <div class="flex items-center mt-1">
                                <x-form.input-radio name="type" for="type_student" value="0" required="true">
                                    Študentský
                                </x-form.input-radio>
                                <x-form.input-radio class="ml-6" name="type" for="type_instructor" value="1"
                                    required="true">
                                    Inštruktorský
                                </x-form.input-radio>
                            </div>
                            <x-form.error name="type" errorBag="admin" />
                        </div>

                        <div class="mt-6 {{ old('type') == '1' ? 'flex' : 'hidden' }}" id="inst">

                            <div class="w-1/2 mr-2">
                                <x-form.select name="academy_id" title="Akadémia" class=" combo-a"
                                    data-nextcombo=".combo-b" :disabled="old('type') != '1'" errorBag="admin" required="true">

                                    <option value="" disabled selected hidden>Akadémia</option>

                                    @foreach ($academy as $academ)
                                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}"
                                            data-option="-1">{{ ucwords($academ->name) }}
                                        </option>
                                    @endforeach

                                </x-form.select>
                            </div>
                            <div class="w-1/2 ml-2">
                                <x-form.select name="coursetype_id" title="Kurz" class="combo-b" disabled
                                    errorBag="admin" required="true">
                                    <option value="" disabled selected hidden>Typ kurzu</option>

                                    @foreach ($coursetypes->whereIn('type', [1]) as $type)
                                        <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                            data-option="{{ $type->academy_id }}">
                                            {{ ucwords($type->name) }}</option>
                                    @endforeach
                                </x-form.select>
                            </div>

                        </div>


                        <div class="mt-6 {{ old('type') == '0' ? 'flex' : 'hidden' }}" id="stud">

                            <div class="w-1/2 mr-2">
                                <x-form.select name="academy_id2" title="Akadémia" class=" combo-a3"
                                    data-nextcombo=".combo-b3" :disabled="old('type') != '0'" errorBag="admin" required="true">

                                    <option value="" disabled selected hidden>Akadémia</option>

                                    @foreach ($academy as $academ)
                                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}"
                                            data-option="-1">{{ ucwords($academ->name) }}
                                        </option>
                                    @endforeach

                                </x-form.select>
                            </div>
                            <div class="w-1/2 ml-2">
                                <x-form.select name="coursetype_id2" title="Kurz" class="combo-b3" disabled
                                    errorBag="admin" required="true">

                                    <option value="" disabled selected hidden>Typ kurzu</option>

                                    @foreach ($coursetypes->whereIn('type', [0]) as $type2)
                                        <option value="{{ $type2->id }}" data-id="{{ $type2->id }}"
                                            data-option="{{ $type2->academy_id }}">
                                            {{ ucwords($type2->name) }}</option>
                                    @endforeach
                                </x-form.select>
                            </div>
                        </div>
                    </x-form.field>

                    <x-form.field>

                        <x-form.select name="days" title="Dni" errorBag="admin" required="true">

                            <option value="" disabled selected hidden>Dni výučby</option>
                            <option value="1" {{ old('days') == 1 ? 'selected' : '' }}>Týždeň</option>
                            <option value="2" {{ old('days') == 2 ? 'selected' : '' }}>Víkend</option>
                            <option value="3" {{ old('days') == 3 ? 'selected' : '' }}>Nezáleží</option>

                        </x-form.select>
                    </x-form.field>
                    <x-form.field>
                        <x-form.select name="time" title="Čas" errorBag="admin" required="true">

                            <option value="" disabled selected hidden>Čas výučby</option>
                            <option value="1" {{ old('time') == 1 ? 'selected' : '' }}>Ranný</option>
                            <option value="2" {{ old('time') == 3 ? 'selected' : '' }}>Poobedný</option>
                            <option value="3" {{ old('time') == 3 ? 'selected' : '' }}>Nezáleží</option>

                        </x-form.select>

                    </x-form.field>

                    <div class="flex mt-6">
                        <div class="block flex-1">
                            <x-form.button class=" md:w-auto w-full sm:w-auto">
                                Odoslať
                            </x-form.button>
                        </div>
                        @if (request()->student_id)
                            <a href="/admin/students"
                                class='items-center  px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>Preskočiť</a>
                        @endif
                    </div>
                </form>
                @php
                    session()->forget('typ');
                @endphp
            </div>
        </div>
    </x-slot:create>
    <x-form.search action="{{ route('admin.applications.index') }}" text="Filtrovať a zoradiť">
        @csrf

        @if (request()->filled('search'))
            <input type="hidden" name="search" value="{{ request()->input('search') }}" />
        @endif

        <x-form.search-select name="orderBy" title="Zoradiť podľa">
            <option value="created_at" {{ request()->input('orderBy') == 'created_at' ? 'selected' : '' }}>Dátumu
                vytvorenia</option>
            <option value="updated_at" {{ request()->input('orderBy') == 'updated_at' ? 'selected' : '' }}>Dátumu
                poslednej úpravy</option>
        </x-form.search-select>
        <x-form.search-select name="orderDirection" title="Smer zoradenia">
            <option value="asc" {{ request()->input('orderDirection') == 'asc' ? 'selected' : '' }}>Vzostupne
            </option>
            <option value="desc" {{ request()->input('orderDirection') == 'asc' ? '' : 'selected' }}>Zostupne
            </option>
            </option>
        </x-form.search-select>

        <x-form.search-select name="academy_id" title="Akadémia" class=" combo-a4" data-nextcombo=".combo-b4">

            <option value="" data-option="-1" selected>Všetky</option>

            @foreach ($academy as $academ)
                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">
                    {{ ucwords($academ->name) }}</option>
            @endforeach

        </x-form.search-select>

        <x-form.search-select name="coursetype_id" title="Kurz" class="combo-b4" disabled>
            <option value="" data-id="-1">Všetky</option>

            @foreach ($academy as $academ)
                <option value="" data-option="{{ $academ->id }}"
                    {{ request()->input('coursetype_id') == null ? 'selected' : '' }}>Všetky
                </option>
            @endforeach

            @foreach ($coursetypes as $type)
                <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                    data-option="{{ $type->academy_id }}">{{ ucwords($type->name) }}</option>
            @endforeach
        </x-form.search-select>



        <x-slot:search>
            @csrf
            @if (request()->filled('orderBy'))
                <input type="hidden" name="orderBy" value="{{ request()->input('orderBy') }}" />
                <input type="hidden" name="orderDirection" value="{{ request()->input('orderDirection') }}" />
            @endif
            @if (request()->filled('academy_id') && request()->filled('coursetype_id'))
                <input type="hidden" name="academy_id" value="{{ request()->input('academy_id') }}" />
                <input type="hidden" name="coursetype_id" value="{{ request()->input('coursetype_id') }}" />
            @elseif(request()->filled('academy_id'))
                <input type="hidden" name="academy_id" value="{{ request()->input('academy_id') }}" />
            @endif
        </x-slot:search>
    </x-form.search>

    <x-single-table>
        <x-slot:head>
            <th scope="col" class="py-3 px-6">Meno študenta</th>
            <th scope="col" class="py-3 px-6">Kurz</th>
            <th scope="col" class="py-3 px-6">Dni/čas</th>
            <th scope="col" class="py-3 px-6">Potvrdená</th>
            <th scope="col" class="py-3 px-6">Vytvorená</th>
            <th scope="col"
                class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                Akcie</th>
        </x-slot:head>
        @foreach ($applications as $application)
            <tr class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                <td class="py-4 px-6"><x-table.td
                        url="students/{{ $application->student->id }}">{{ $application->student->name }}
                        {{ $application->student->lastname }} </x-table.td>
                </td>
                <td class="py-4 px-6">
                    <x-table.td url="coursetypes/{{ $application->coursetype->id }}">
                        {{ $application->coursetype->name }} -
                        {{ $application->coursetype->type == '0' ? 'študentský' : 'inštruktorský' }}
                        ({{ $application->academy->name }} akadémia)
                    </x-table.td>
                    <br>

                </td>
                <td class="py-4 px-6">
                    {{ $application->days == 1 ? 'Týždeň' : '' }} {{ $application->days == 2 ? 'Víkend' : '' }}
                    {{ $application->days == 3 ? 'Nezáleží' : '' }} / {{ $application->time == 1 ? 'Ranný' : '' }}
                    {{ $application->time == 2 ? 'Poobedný' : '' }}
                    {{ $application->time == 3 ? 'Nezáleží' : '' }}
                </td>
                <td class="py-4 px-6 {{ $application->verified == 1 ? '' : 'text-red-800' }}">
                    {{ $application->verified == 1 ? 'ÁNO' : 'NIE' }}
                </td>
                <td class="py-4 px-6">vytvorená
                    {{ $application->created_at->diffForHumans() }}

                </td>

                <x-table.td-last url="applications/{{ $application->id }}" edit=0
                    itemName="prihlášku študenta: {{ $application->student->name }} {{ $application->student->lastname }} na kurz: {{ $application->coursetype->name }} akadémie {{ $application->academy->name }}?" />

            </tr>
        @endforeach
    </x-single-table>
    {{ $applications->links() }}

</x-setting>
