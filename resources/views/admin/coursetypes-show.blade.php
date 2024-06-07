<x-layout />
<x-setting heading="{{ $coursetype->name }}" :pick="true">
    @php
        $deleteedit = false;
        if (auth()->user()->can('admin')) {
            $deleteedit = true;
        }
    @endphp
    @if ($coursetype->type == '1')
        @php
            $type = '- inštruktorský';
        @endphp
    @else
        @php
            $type = '- študentský';
        @endphp
    @endif
    <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
        <x-show-header name="{{ $coursetype->name }}" title="Kurz {{ $type }}" />
        <x-show-buttons calendarText="kurzu {{ $coursetype->name }} {{ $type }}"
            calendarWho="coursetype_id={{ $coursetype->id }}" emailId="{{ $coursetype->id }}" emailType="coursetype_id"
            emailText="kurzu" :pick="true">
        </x-show-buttons>
        <div
            class="w-full max-w-full px-3 mx-auto mt-4 md:mt-0 lg:mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-7/12 lg:flex">
            <x-buttonsection>
                <li
                    class="flex-1 {{ session('success_c') || session('success_cc') || session('success_dd') || session('success_d') || request()->has('vytvorit') || request()->has('pridat') || $errors->admin->any() ? 'hidden' : '' }}">

                    <button
                        class="edit-button {{ session('success_c') || session('success_cc') || session('success_dd') || session('success_d') || request()->has('pridat') || request()->has('vytvorit') || $errors->admin->any() ? 'hidden' : '' }} "
                        data-target="profile">
                        <span style="display: inline;">Povoliť
                            úpravy</span>
                        <span style="display: none;">Zrušiť úpravy</span>
                    </button>

                </li>
                @admin
                    <li
                        class="flex-1 {{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}">
                        <button
                            class="add-button {{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}  "
                            data-target="kurzyAdd">
                            <span class="{{ session('success_cc') || session('success_dd') ? '' : 'hidden' }}">Pridať
                                inštruktora</span>
                            <span class="{{ request()->has('pridat') ? '' : 'hidden' }}">Zrušiť pridanie
                                inštruktora</span>
                        </button>
                    </li>
                @endadmin
                <li
                    class="flex-1 {{ session('success_c') || session('success_d') || request()->has('vytvorit') || $errors->admin->any() ? '' : 'hidden' }}">

                    <button
                        class="add-button {{ session('success_c') || session('success_d') || request()->has('vytvorit') || $errors->admin->any() ? '' : 'hidden' }}  "
                        data-target="loginAdd">
                        <span class="{{ session('success_c') || session('success_d') ? '' : 'hidden' }}">Vytvoriť
                            prihlášku</span>
                        <span class="{{ request()->has('vytvorit') || $errors->admin->any() ? '' : 'hidden' }}">Zrušiť
                            vytvorenie prihlášky</span>
                    </button>
                </li>
            </x-buttonsection>

            <x-buttonsection class="md:mt-3 lg:mt-0">
                <li class="flex-auto pr-0.5">
                    <button
                        class="section-button {{ session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') || $errors->admin->any() ? '' : 'hidden' }} rounded-l-lg "
                        data-target="profile">Info</button>
                    <button
                        class="section-button {{ session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') || $errors->admin->any() ? 'hidden' : '' }} rounded-l-lg "
                        data-target="kurzy">Inštruktori</button>
                </li>
                <li class="flex-auto">
                    <button
                        class="section-button {{ session('success_c') || session('success_d') || request()->has('vytvorit') || $errors->admin->any() ? '' : 'hidden' }} rounded-r-lg"
                        data-target="kurzy">Inštruktori</button>
                    <button
                        class="section-button {{ session('success_c') || session('success_d') || request()->has('vytvorit') || $errors->admin->any() ? 'hidden' : '' }} rounded-r-lg"
                        data-target="login">Prihlášky</button>
                </li>
            </x-buttonsection>
        </div>

    </div>

    <div id="profile" class="section flex-auto p-6"
        style="{{ session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') || $errors->admin->any() ? 'display: none;' : '' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
        <form id="formm" action="/admin/coursetypes/{{ $coursetype->id }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('Patch')
            <x-form.required class=" hidden mt-1 " />
            <x-form.field>
                <x-form.input value="{{ $coursetype->name }}" name="cname" type="text" title="Názov"
                    placeholder="Názov" disabled errorBag="updateCoursetype" required="true" />

            </x-form.field>

            <div class="items-center mt-6">
                <x-form.label name="type" title="Typ kurzu" required="true" />

                <div class="flex items-center mt-1">
                    <x-form.input-radio name="type" for="type_student" value="0" :checked="$coursetype->type == 0"
                        :disabled="true" required="true">
                        Študentský
                    </x-form.input-radio>
                    <x-form.input-radio class="ml-6" name="type" for="type_instructor" value="1"
                        :checked="$coursetype->type == 1" :disabled="true" required="true">
                        Inštruktorský
                    </x-form.input-radio>
                </div>
                <x-form.error name="type" errorBag="updateCoursetype" />
            </div>

            <x-form.field>
                <x-form.select name="academy_id" title="Akadémia" disabled errorBag="updateCoursetype" required="true">

                    <option class="text-gray-500" value="" disabled selected hidden>Akadémie
                    </option>

                    @foreach (\App\Models\Academy::all() as $academ)
                        <option value="{{ $academ->id }}"
                            {{ old('academy_id') == $academ->id || $coursetype->academy->id == $academ->id ? 'selected' : '' }}>
                            {{ ucwords($academ->name) }}</option>
                    @endforeach

                </x-form.select>
            </x-form.field>

            <x-form.field>
                <x-form.input name="min" type="number" title="Minimum študentov" value="{{ $coursetype->min }}"
                    placeholder="Minimum" disabled errorBag="updateCoursetype" required="true" />
            </x-form.field>
            <x-form.field>
                <x-form.input name="max" type="number" title="Maximum študentov" value="{{ $coursetype->max }}"
                    placeholder="Maximum" disabled errorBag="updateCoursetype" required="true" />
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
    @admin
        <div class="add-section" id="kurzyAdd"
            style="{{ request()->has('pridat') ? 'display:block;' : 'display: none;' }}">
            <p class="text-sm font-semibold uppercase text-gray-700">Pridať inštruktora</p>

            <form action="/admin/coursetype_instructor" method="POST">
                @csrf
                <x-form.required class="mt-1" />
                <input name="type" value="1" hidden />
                <input name="coursetype_id" value="{{ $coursetype->id }}" hidden />
                <input name="academy_id" value="{{ $coursetype->academy->id }}" hidden />
                <x-form.field>
                    <x-form.select name="instructor_id" title="Inštruktor" required="true" errorBag="createCI">

                        <option class="text-gray-500" value="" disabled selected hidden>Inštruktori
                        </option>
                    
                        @php
                            $assignedInstructors = $coursetype->instructors->pluck('id')->toArray();
                        @endphp
                        @foreach (\App\Models\Instructor::with(['coursetypes'])->get() as $instructor)
                            @if (!in_array($instructor->id, $assignedInstructors))
                                <option value="{{ $instructor->id }}">Meno: {{ ucwords($instructor->name) }}
                                    {{ ucwords($instructor->lastname) }} Email: {{ ucwords($instructor->email) }}</option>
                            @endif
                        @endforeach
                       
                    </x-form.select>
                </x-form.field>

                <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                    Odoslať
                </x-form.button>
            </form>
        </div>
    @endadmin


    <div id="kurzy" class="section flex-auto p-6"
        style="{{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Inštruktori kurzu</p>
        <x-single-table>
            <x-slot:head>
                <th scope="col" class="py-3 px-6">Fotka</th>
                <th scope="col" class="py-3 px-6">Meno</th>
                <th scope="col" class="py-3 px-6">Aktuálne triedy tohto kurzu</th>
                <th scope="col"
                    class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                    Akcie</th>
            </x-slot:head>
            @foreach ($coursetype->instructors as $instructor)
                <tr
                    class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                    <td class="py-4 px-6">
                        <div class="flex-shrink-0">
                            <div class="h-20 w-20 rounded-lg bg-gray-300 overflow-hidden relative">
                                <img class="shadow-xl rounded-lg w-full h-full object-cover"
                                    src="{{ asset('storage/' . $instructor->photo) }}" alt="profile_image">
                            </div>
                        </div>

                    </td>
                    <td class="py-4 px-6">
                        <x-table.td url="instructors/{{ $instructor->id }}">
                            {{ $instructor->name }} {{ $instructor->lastname }}
                        </x-table.td>
                    </td>

                    <td class="py-4 px-6">
                        @foreach ($instructor->classes->where('coursetype_id', $coursetype) as $class)
                            <x-table.td url="classes/{{ $class->id }}">
                                {{ $class->name }}
                            </x-table.td><br>
                        @endforeach
                    </td>
                    <x-table.td-last url="coursetype_instructor/{{ $instructor->id }}/{{ $coursetype->id }}"
                        edit={{ $deleteedit }} :delete="$deleteedit"
                        itemName="inštruktora {{ $instructor->name }} {{ $instructor->lastname }} ako správcu tohto kurzu? Spolu s ním budú vymazané aj jeho triedy. Ak tomu chcete zabrániť zmeňte inštruktora týchto tried." />

                </tr>
            @endforeach
        </x-single-table>
    </div>
    <div class="add-section" id="loginAdd"
        style="{{ request()->has('vytvorit') || $errors->admin->any() ? 'display:block;' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Pridať študenta</p>
        <x-form.required class="mt-1" />
        <form action="/" method="post">
            @csrf
            <input type="hidden" name="typ" value="admin" />
            @if (request()->student_id)
                @php
                    session(['student_id' => request()->student_id]);
                @endphp
            @endif
            @unless (session('student_id'))
                <x-form.field>
                    <x-form.live-search />
                </x-form.field>
            @else
                @php
                    $student = \App\Models\Student::find(session('student_id'));
                @endphp
                <x-form.input name="name" type="text" title="Meno" placeholder="Meno" disabled />
                <x-form.input name="lastname" type="text" title="Priezvisko" placeholder="Priezvisko" disabled />

                <x-form.input name="email" type="email" title="Email" placeholder="Email" disabled />
                <input name="name" value="{{ $student->name }}" hidden />
                <input name="lastname" value="{{ $student->lastname }}" hidden />
                <input name="email" value="{{ $student->email }}" hidden />
            @endunless

            @if ($coursetype)
                <input name="typ" value="admin" hidden />
                <input name="academy_id" value="{{ $coursetype->academy->id }}" hidden />
                <input name="coursetype_id" value="{{ $coursetype->id }}" hidden />
                <input name="type" value="{{ $coursetype->type }}" hidden />
            @endif

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
                        class='items-center mt-6 px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>Preskočiť</a>
                @endif
            </div>
        </form>
    </div>
    <div id="login" class="section flex-auto p-6"
        style="{{ session('success_d') || session('success_c') || request()->has('vytvorit') || $errors->admin->any() ? '' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700 mb-6">Prihlášky študentov</p>
        <x-single-table>
            <x-slot:head>
                <th scope="col" class="py-3 px-6">Meno študenta</th>
                <th scope="col" class="py-3 px-6">Email</th>
                <th scope="col" class="py-3 px-6">Dni / čas</th>
                <th scope="col" class="py-3 px-6">Potvrdená</th>
                <th scope="col" class="py-3 px-6">Vytvorená</th>
                <th scope="col"
                    class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                    Akcie</th>
            </x-slot:head>
            @foreach ($coursetype->applications as $application)
                <tr
                    class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                    <td class="py-4 px-6"><x-table.td
                            url="students/{{ $application->student->id }}">{{ $application->student->name }}
                            {{ $application->student->lastname }}</x-table.td>
                    </td>
                    <td class="py-4 px-6">{{ $application->student->email }}

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
                        itemName="prihlášku študenta: {{ $application->student->name }} {{ $application->student->lastname }} na tento kurz?" />

                </tr>
            @endforeach
        </x-single-table>
    </div>

</x-setting>
