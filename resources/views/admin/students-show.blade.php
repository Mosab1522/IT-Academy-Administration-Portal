<x-layout />
<x-setting heading="{{ $student->name }}">

    <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
        <x-show-header name="{{ $student->name }} {{ $student->lastname }}" title="Študent" />
        <x-show-buttons calendarText="študenta {{ $student->name }} {{ $student->lastname }}"
            calendarWho="student_id={{ $student->id }}" emailId="{{ $student->id }}" emailType="student_id"
            emailText="Študent: {{ $student->name }} {{ $student->lastname }}">

        </x-show-buttons>

        <div
            class="w-full max-w-full px-3 mx-auto mt-4 md:mt-0 lg:mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-7/12 lg:flex">
            <x-buttonsection class="{{ session('success_dd') ? 'hidden' : '' }}">
                <li
                    class="flex-1 {{ session('success_c') || session('success_d') || request()->has('pridat') || $errors->admin->any() ? 'hidden' : '' }}">
                    <button
                        class="edit-button {{ session('success_c') || session('success_d') || request()->has('pridat') || $errors->admin->any() ? 'hidden' : '' }} "
                        data-target="profile">
                        <span id="resetbutton" style="display: inline;">Povoliť
                            úpravy</span>
                        <span style="display: none;">Zrušiť úpravy</span>
                    </button>
                </li>
                <li
                    class="flex-1 {{ session('success_c') || session('success_d') || request()->has('pridat') || $errors->admin->any() ? '' : 'hidden' }}">
                    <button
                        class="add-button  {{ session('success_c') || session('success_d') || request()->has('pridat') || $errors->admin->any() ? '' : 'hidden' }}  "
                        data-target="kurzyAdd">
                        <span class="{{ session('success_c') || session('success_d') ? '' : 'hidden' }}">Vytvoriť
                            prihlášku</span>
                        <span class="{{ request()->has('pridat') || $errors->admin->any() ? '' : 'hidden' }}">Zrušiť
                            vytvorenie prihlášky</span>
                    </button>
                </li>
            </x-buttonsection>

            <x-buttonsection class="md:mt-3 lg:mt-0">
                <li class="flex-auto pr-0.5">
                    <button
                        class="section-button {{ session('success_c') || session('success_d') || request()->has('pridat') || $errors->admin->any() || session('success_dd') ? '' : 'hidden' }} rounded-l-lg"
                        data-target="profile">Profil</button>
                    <button
                        class="section-button {{ session('success_c') || session('success_d') || request()->has('pridat') || $errors->admin->any() || session('success_dd') ? 'hidden' : '' }} rounded-l-lg"
                        data-target="kurzy">Prihlasky</button>
                </li>
                <li class="flex-auto">
                    <button class="section-button {{ session('success_dd') ? '' : 'hidden' }}  rounded-r-lg"
                        data-target="kurzy">
                        Prihlášky
                    </button>
                    <button class="section-button {{ session('success_dd') ? 'hidden' : '' }}  rounded-r-lg"
                        data-target="login">
                        Triedy
                    </button>
                </li>
            </x-buttonsection>
        </div>

    </div>

    <div id="profile" class="section flex-auto p-6"
        style="{{ session('success_c') || session('success_d') || session('success_dd') || request()->has('pridat') || $errors->admin->any() ? 'display: none;' : '' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
        <form id="formm" action="/admin/students/{{ $student->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('Patch')
            <x-form.required class=" hidden mt-1 " />
            <x-form.field>
                <x-form.input value="{{ $student->name }}" name="name" type="text" title="Meno"
                    placeholder="Meno" disabled required="true" />
            </x-form.field>
            <x-form.field>
                <x-form.input value="{{ $student->lastname }}" name="lastname" type="text" title="Priezvisko"
                    placeholder="Priezvisko" disabled required="true" />
            </x-form.field>
            <x-form.field>
                <x-form.input value="{{ $student->email }}" name="email" type="email" title="Email"
                    placeholder="Email" disabled required="true" />
            </x-form.field>
            <x-form.field>
                <x-form.input value="{{ $student->sekemail }}" name="sekemail" type="email" title="Sekunarny email"
                    placeholder="Sekunarny email" disabled />
            </x-form.field>

            <p class="text-sm font-semibold uppercase text-gray-700 mt-6">Osobné informácie
            </p>
            <div class="flex flex-col  md:grid md:grid-cols-2 lg:flex lg:flex-row  gap-6">
                <div class=" mt-6">
                    <x-form.label name="status" title="Status" required="true" />

                    <div class="flex items-center mt-1">
                        <x-form.input-radio name="status" for="type_student" value="student" :checked="$student->status == 'student'" disabled
                            required="true">
                            Študent
                        </x-form.input-radio>

                        <x-form.input-radio class="ml-4" name="status" for="type_nostudent" value="nestudent"
                            :checked="$student->status == 'nestudent'" disabled required="true">
                            Neštudent
                        </x-form.input-radio>

                    </div>
                    <x-form.error name="status" errorBag="default" />
                </div>

                <div class="flex flex-col mt-0 md:mt-6 {{ $student->skola ? '' : 'hidden' }}" id="ucm">
                    <x-form.label name="skola" title="Škola" required="true" />
                    <div class="flex mt-1">
                        <div class="flex items-center mr-4">
                            <x-form.input-radio :hidden="$student->status != 'student'" name="skola" for="ucmka" value="ucm"
                                :checked="$student->skola == 'ucm'" disabled required="true">
                                UCM
                            </x-form.input-radio>

                        </div>
                        <div class="flex items-center">
                            <x-form.input-radio name="skola" for="inam" value="ina" :hidden="$student->status != 'student'"
                                :checked="$student->skola !== 'ucm' && $student->skola !== null" disabled required="true">
                                Iná
                            </x-form.input-radio>

                        </div>
                    </div>
                    <x-form.error name="skola" errorBag="default" />

                </div>

                <div class="flex flex-col mt-0 lg:mt-6 {{ $student->skola == 'ucm' ? '' : 'hidden' }}"
                    id="ucmkari">
                    <x-form.label name="studium" title="Druh štúdia" required="true" />
                    <div class="flex mt-1">
                        <div class="flex items-center mr-4">
                            <x-form.input-radio name="studium" for="option3" value="interne" :hidden="$student->skola != 'ucm'"
                                :checked="$student->studium == 'interne'" disabled required="true">
                                Interné
                            </x-form.input-radio>

                        </div>
                        <div class="flex items-center">
                            <x-form.input-radio name="studium" for="option4" value="externe" :hidden="$student->skola != 'ucm'"
                                :checked="$student->studium == 'externe'" disabled required="true">
                                Externé
                            </x-form.input-radio>

                        </div>
                    </div>
                    <x-form.error name="studium" errorBag="default" />
                </div>

                <div class="flex flex-col mt-0 lg:mt-6 {{ $student->skola == 'ucm' ? '' : 'hidden' }}"
                    id="ucmkari2">
                    <x-form.label name="program" title="Program" required="true" />
                    <div class="flex lg:mt-1">
                        <div class="flex items-center lg:items-baseline mr-4">

                            <input type="radio" id="option5" name="program" value="apin"
                                class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 disabled:text-gray-500 {{ $student->skola == 'ucm' ? '' : 'hidden' }}"
                                {{ $student->program == 'apin' ? 'checked' : '' }} disabled required>
                            <label for="option5" class="ml-2 lg:-mt-2  text-gray-700">Aplikovaná
                                informatika</label>
                        </div>
                        <div class="flex items-center lg:items-baseline">
                            <input type="radio" id="option6" name="program" value="iny"
                                class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 disabled:text-gray-500 {{ $student->skola == 'ucm' ? '' : 'hidden' }}"
                                {{ $student->program == 'apin' || $student->program == null ? '' : ' checked' }}
                                disabled required>
                            <label for="option6" class="ml-2 lg:-mt-2  text-gray-700">Iný</label>
                        </div>
                    </div>
                    <x-form.error name="program" errorBag="default" />
                </div>
            </div>
            <div id="ina"
                class="mt-4 {{ $student->skola == 'ucm' || $student->skola == null ? 'hidden' : '' }}">
                <input type="text" disabled
                    class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6 {{ $student->skola == 'ucm' || $student->skola == null ? 'hidden' : '' }}"
                    name="ina" id="nu" placeholder="Názov školy"
                    value="{{ $student->skola == 'ucm' ? '' : $student->skola }}">
                <x-form.error name="ina" errorBag="default" />
            </div>
            <div id="iny"
                class="mt-4 {{ $student->program == 'apin' || $student->program == null ? 'hidden' : '' }}">
                <input type="text" disabled
                    class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6 {{ $student->program == 'apin' || $student->program == null ? 'hidden' : '' }}"
                    name="iny" id="ny" placeholder="Názov programu"
                    value="{{ $student->program == 'apin' ? '' : $student->program }}">
                <x-form.error name="iny" errorBag="default" />
            </div>

            <x-form.field>
                <x-form.input value="{{ $student->ulicacislo }}" name="ulicacislo" type="text"
                    title="Ulica a popisné číslo" placeholder="Ulica a popisné číslo" disabled required="true" />
            </x-form.field>
            <x-form.field>
                <x-form.input value="{{ $student->mestoobec }}" name="mestoobec" type="text"
                    title="Mesto / Obec" placeholder="Mesto / Obec" disabled required="true" />
            </x-form.field>
            <x-form.field>

                <x-form.input value="{{ $student->psc }}" name="psc" type="text" title="PSČ"
                    placeholder="PSČ" disabled required="true" />
            </x-form.field>

            <x-form.field>
                <div class="flex justify-end space-x-4 mt-6">
                    <x-form.button class=" hidden  flex-1">
                        Upraviť
                    </x-form.button>

                    <button id="res" type="reset"
                        class="hidden flex-none bg-gray-400 text-white text-sm font-medium py-2 px-6 rounded-md shadow-sm hover:bg-gray-500 transition-colors duration-200">
                        Reset
                    </button>
                </div>
            </x-form.field>

        </form>
    </div>

    <div class="add-section" id="kurzyAdd"
        style="{{ request()->has('pridat') || $errors->admin->any() ? 'display:block;' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Vytvoriť prihlášku</p>
        <form action="/" method="POST">
            @csrf
            <input name="student_id" value="{{ $student->id }}" hidden />
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

                <div class="mt-6 {{ old('type') == '1' ? 'flex' : 'hidden' }}" id="inst">

                    <div class="w-1/2 mr-2">
                        <x-form.select name="academy_id" title="Akadémia" class=" combo-a" data-nextcombo=".combo-b"
                            :disabled="old('type') != '1'" errorBag="admin" required="true">
                            <!-- parent -->
                            {{-- <select name="academy_id" class="combo-a"
                                                            data-nextcombo=".combo-b"> --}}
                            <option value="" disabled selected hidden>Akadémia
                            </option>
                            {{-- @php
                                                            $academy =
                                                            \App\Models\Academy::with(['coursetypes','applications'])
                                                            ->get();
                                                            @endphp --}}
                            @foreach ($academy as $academ)
                                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                    {{--
                                                                {{old('academy_id')==$academ->id ? 'selected' : ''}}
                                                                --}}>{{ ucwords($academ->name) }}</option>
                            @endforeach
                            {{-- <option value="" disabled selected hidden>Akadémia
                                                            </option>
                                                            <option value="1" data-id="1" data-option="-1">Cisco
                                                            </option>
                                                            <option value="2" data-id="2" data-option="-1">Adobe
                                                            </option> --}}
                        </x-form.select>
                    </div>
                    <div class="w-1/2 ml-2">
                        <x-form.select name="coursetype_id" title="Kurz" class="combo-b" disabled errorBag="admin"
                            required="true">

                            <!-- child -->
                            {{-- <select name="coursetype_id" id="coursetype_id"
                                                            class="combo-b" data-nextcombo=".combo-c" disabled>
                                                            <option value="" disabled selected hidden>Typ kurzu
                                                            </option>
                                                            <option value="1" data-id="1" data-option="1">Lahky
                                                            </option>
                                                            <option value="2" data-id="2" data-option="1">Stredny
                                                            </option>
                                                            <option value="3" data-id="3" data-option="2">Photoshop
                                                            </option>
                                                            <option value="4" data-id="4" data-option="2">
                                                                Illustrator</option>
                                                        </select> --}}
                            {{-- <select name="coursetype_id" id="coursetype_id"
                                                            class="combo-b" disabled> --}}
                            <option value="" disabled selected hidden>Typ kurzu
                            </option>
                            {{-- @php
                                                            $academy = \App\Models\CourseType::all();
                                                            @endphp --}}

                            @foreach ($coursetypes->whereIn('type', [1]) as $type)
                                <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                    data-option="{{ $type->academy_id }}" {{--
                                                                {{old('coursetype_id')==$type->id ?
                                                                'selected' : ''}} --}}>
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
                                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">
                                    {{ ucwords($academ->name) }}</option>
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
                    <option value="1" {{ old('days') == 1 ? 'selected' : '' }}>Týždeň
                    </option>
                    <option value="2" {{ old('days') == 2 ? 'selected' : '' }}>Víkend
                    </option>
                    <option value="3" {{ old('days') == 3 ? 'selected' : '' }}>Nezáleží
                    </option>

                </x-form.select>
            </x-form.field>
            <x-form.field>
                <x-form.select name="time" title="Čas" errorBag="admin" required="true">

                    <option value="" disabled selected hidden>Čas výučby</option>
                    <option value="1" {{ old('time') == 1 ? 'selected' : '' }}>Ranný
                    </option>
                    <option value="2" {{ old('time') == 3 ? 'selected' : '' }}>Poobedný
                    </option>
                    <option value="3" {{ old('time') == 3 ? 'selected' : '' }}>Nezáleží
                    </option>

                </x-form.select>

            </x-form.field>
            <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                Odoslať
            </x-form.button>
        </form>
    </div>
    <div id="kurzy"
        class="section {{ session('success_c') || session('success_d') || request()->has('pridat') || $errors->admin->any() ? '' : 'hidden' }} flex-auto p-6">
        <p class="text-sm font-semibold uppercase text-gray-700">
            @if (auth()->user()->can('admin'))
                Prihlášky tohto študenta
            @else
                Prihlášky tohto študenta na spravované kurzy
            @endif

        </p>
        <x-single-table>
            <x-slot:head>

                <th scope="col" class="py-3 px-6">Kurz</th>
                <th scope="col" class="py-3 px-6">Dni/čas</th>
                <th scope="col" class="py-3 px-6">Potvrdená</th>
                <th scope="col" class="py-3 px-6">Vytvorená</th>
                <th scope="col"
                    class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                    Akcie</th>
            </x-slot:head>
            @foreach ($student->applications as $application)
                @if ($application->coursetype->instructors->contains('id', auth()->user()->user_id) || auth()->user()->can('admin'))
                    <tr
                        class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">

                        <td class="py-4 px-6">
                            <x-table.td url="coursetypes/{{ $application->coursetype->id }}">
                                {{ $application->coursetype->name }} -
                                {{ $application->coursetype->type == '0' ? 'študentský' : 'inštruktorský' }}
                                ({{ $application->academy->name }} akadémia)
                            </x-table.td>
                            <br>

                        </td>
                        <td class="py-4 px-6">
                            {{ $application->days == 1 ? 'Týždeň' : '' }}
                            {{ $application->days == 2 ? 'Víkend' : '' }}
                            {{ $application->days == 3 ? 'Nezáleží' : '' }} /
                            {{ $application->time == 1 ? 'Ranný' : '' }}
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
                            itemName="prihlášku študenta tohto študenta na kurz: {{ $application->coursetype->name }} akadémie {{ $application->academy->name }}?" />

                    </tr>
                @endif
            @endforeach
        </x-single-table>
    </div>
    <div id="login" class="section flex-auto p-6" style="{{ session('success_dd') ? '' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700 mb-6">
            @if (auth()->user()->can('admin'))
                Študentove triedy
            @else
                Študentove vaše triedy
            @endif
        </p>
        <x-single-table>
            <x-slot:head>

                <th scope="col" class="py-3 px-6">Názov triedy</th>
                <th scope="col" class="py-3 px-6">Kurz</th>
                <th scope="col" class="py-3 px-6">Inštruktor</th>
                <th scope="col" class="py-3 px-6">Dni / čas</th>

                <th scope="col"
                    class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                    Akcie</th>
            </x-slot:head>
            @foreach ($student->classes as $class)
                @if ($class->ended == false)
                    @if (auth()->user()->user_id == $class->instructor_id || auth()->user()->can('admin'))
                        <tr
                            class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                            <td class="py-4 px-6"><x-table.td
                                    url="classes/{{ $class->id }}">{{ $class->name }}</x-table.td></td>
                            <td class="py-4 px-6">
                                <x-table.td url="coursetypes/{{ $class->coursetype->id }}">
                                    {{ $class->coursetype->name }} -
                                    {{ $class->coursetype->type == 0 ? 'študentský' : 'inštruktorský' }}
                                    ({{ $class->academy->name }} akadémia)
                                </x-table.td>
                            </td>
                            <td class="py-4 px-6"><x-table.td url="instructors/{{ $class->instructor->id }}">
                                    {{ $class->instructor->name }} {{ $class->instructor->lastname }}
                                </x-table.td></td>
                            <td class="py-4 px-6">
                                {{ $class->days == 1 ? 'Týždeň' : '' }} {{ $class->days == 2 ? 'Víkend' : '' }}
                                {{ $class->days == 3 ? 'Nezáleží' : '' }} / {{ $class->time == 1 ? 'Ranný' : '' }}
                                {{ $class->time == 2 ? 'Poobedný' : '' }} {{ $class->time == 3 ? 'Nezáleží' : '' }}
                            </td>

                            <x-table.td-last url="class-student/{{ $student->id }}/{{ $class->id }}" edit=1
                                itemName="tohto študenta z  triedy {{ $class->name }}? Ak mal študent vytvorenú prihlášku vráti sa medzi prihlásených študentov kurzu tejto triedy. Vymaže sa aj jeho evidenia absolvovaných hodín triedy." />

                        </tr>
                    @endif
                @endif
            @endforeach
        </x-single-table>
    </div>

    @php
        $student_s = null;
        $student_p = null;
        if ($student->skola) {
            $student_s = $student->skola == 'ucm' ? 'ucm' : 'ina';
        }
        if ($student->program) {
            $student_p = $student->program == 'apin' ? 'apin' : 'iny';
        }
    @endphp
</x-setting>

<script>
    const studentData = {!! json_encode([
        'status' => $student->status ?? null,
        'skola' => $student_s,
        'program' => $student_p,
        'skola_r' => $student->skola ?? null,
        'program_r' => $student->program ?? null,
    ]) !!};
</script>
