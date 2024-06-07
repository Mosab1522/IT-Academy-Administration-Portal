<x-layout />
@php
    $delete = false;
    if (auth()->user()->can('admin')) {
        $delete = true;
    }
@endphp
<x-setting heading="{{ $instructor->name }}">

    <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
        <x-show-header name="{{ $instructor->name }}" title="Inštruktor" src="{{ asset('storage/' . $instructor->photo) }}"
            path="instructors/{{ $instructor->id }}" />
        <x-show-buttons calendarText="inštruktora {{ $instructor->name }} {{ $instructor->lastname }}"
            calendarWho="instructor_id={{ $instructor->id }}" emailId="{{ $instructor->id }}" emailType="instructor_id"
            emailText="Inštruktor: {{ $instructor->name }} {{ $instructor->lastname }}" :email="$delete">
            <a href="/admin/login/{{ $instructor->id }}" title="Login"
                class="end-class-button inline-block mt-4 pt-0.5 text-gray-800 hover:text-gray-600">
                <span class="material-icons material-icons-header">login</span>
            </a>

        </x-show-buttons>
        <div
            class="w-full max-w-full px-3 mx-auto mt-4 md:mt-0 lg:mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-7/12 lg:flex">
            <x-buttonsection>
                <li
                    class="flex-1 {{ session('success_dd') || session('success_cc') || $errors->createCI->any() || session('success_c') || session('success_d') || $errors->default->any() ? 'hidden' : '' }}">
                    <button
                        class="edit-button {{ session('success_cc') || session('success_dd') || request()->has('pridat') || request()->has('zmenit') || request()->has('vytvorit') || $errors->createCI->any() || session('success_c') || session('success_d') || $errors->default->any() ? 'hidden' : '' }} "
                        data-target="profile">
                        <span class="p-auto" style="display: inline;">Povoliť
                            úpravy</span>
                        <span style="display: none;">Zrušiť úpravy</span>
                    </button>
                </li>
                @admin
                    <li
                        class="flex-1 {{ session('success_cc') || $errors->createCI->any() || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}">
                        <button
                            class="add-button z-30 {{ session('success_cc') || session('success_dd') || request()->has('pridat') || $errors->createCI->any() ? '' : 'hidden' }}  "
                            data-target="kurzyAdd">
                            <span class="{{ session('success_cc') || session('success_dd') ? '' : 'hidden' }}">Pridať
                                kurz</span>
                            <span class="{{ request()->has('pridat') || $errors->createCI->any() ? '' : 'hidden' }}">Zrušiť
                                pridanie kurzu</span>
                        </button>
                    </li>
                @endadmin
                <li
                    class="flex-1 {{ session('success_c') || session('success_d') || $errors->default->any() ? '' : 'hidden' }}">
                    <button
                        class="add-button {{ session('success_c') || session('success_d') || $errors->default->any() ? '' : 'hidden' }} "
                        data-target="loginAdd">
                        <span id="vytvaranie"
                            style="{{ session('success_c') || session('success_d') ? 'display: inline;' : 'display: none;' }}">Vytvoriť
                            hodinu triede</span>
                        <span style="{{ $errors->default->any() ? 'display: inline;' : 'display: none;' }}">Zrušiť
                            vytvorenie hodiny</span>
                    </button>
                </li>
            </x-buttonsection>

            <x-buttonsection class="md:mt-3 lg:mt-0">

                <li class="flex-auto pr-0.5">
                    <button
                        class="section-button {{ session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') || $errors->createCI->any() ? '' : 'hidden' }}  rounded-l-lg"
                        data-target="profile">Profil</button>
                    <button
                        class="section-button {{ session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') || $errors->createCI->any() ? 'hidden' : '' }} rounded-l-lg"
                        data-target="kurzy">Kurzy</button>
                </li>
                <li class="flex-auto">
                    <button
                        class="section-button {{ session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} rounded-r-lg"
                        data-target="kurzy">Kurzy</button>
                    <button
                        class="section-button {{ session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }} rounded-r-lg"
                        data-target="login">Triedy</button>
                </li>
            </x-buttonsection>
        </div>

    </div>

    <div id="profile" class="section flex-auto p-6"
        style="{{ session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || session('success_d') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') || $errors->createCI->any() || $errors->default->any() ? 'display: none;' : '' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
        <form id="formm" action="/admin/instructors/{{ $instructor->id }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('Patch')
            <x-form.required class=" hidden mt-1 " />
            <div class="flex mt-6">
                <div class="w-1/2 mr-2">
                    <x-form.input value="{{ $instructor->name }}" name="name" type="text" title="Meno"
                        placeholder="Meno" disabled required="true" errorBag="updateInstructor" />
                </div>

                <div class="w-1/2 ml-2">
                    <x-form.input value="{{ $instructor->lastname }}" name="lastname" type="text" title="Priezvisko"
                        placeholder="Priezvisko" disabled required="true" errorBag="updateInstructor" />
                </div>
            </div>

            <div class="flex mt-6">
                <div class="w-1/2 mr-2">
                    <x-form.input value="{{ $instructor->email }}" name="email" type="email" title="Email"
                        placeholder="Email" disabled required="true" errorBag="updateInstructor" />
                </div>

                <div class="w-1/2 ml-2">
                    <x-form.input value="{{ $instructor->sekemail }}" name="sekemail" type="email"
                        title="Sekundárny email" placeholder="Sekundárny email" disabled errorBag="updateInstructor" />
                </div>
            </div>
            <p class="text-sm font-semibold uppercase text-gray-700 mt-6">Osobné informácie</p>
            <x-form.field>
                <x-form.input value="{{ $instructor->telephone }}" name="telephone" type="tel"
                    title="Telefonné číslo" placeholder="Telefonné číslo" errorBag="updateInstructor" disabled />
            </x-form.field>

            <x-form.field>
                <x-form.input value="{{ $instructor->ulicacislo }}" name="ulicacislo" type="text"
                    title="Ulica a popisné číslo" errorBag="updateInstructor" placeholder="Ulica a popisné číslo"
                    disabled />
            </x-form.field>

            <div class="flex mt-6">
                <div class="w-1/2 mr-2">
                    <x-form.input value="{{ $instructor->mestoobec }}" name="mestoobec" type="text"
                        title="Mesto / Obec" errorBag="updateInstructor" placeholder="Mesto / Obec" disabled />
                </div>

                <div class="w-1/2 ml-2">

                    <x-form.input value="{{ $instructor->psc }}" name="psc" type="text" title="PSČ"
                        placeholder="PSČ" errorBag="updateInstructor" disabled />
                </div>
            </div>

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
            style="{{ request()->has('pridat') || $errors->createCI->any() ? 'display:block;' : 'display: none;' }}">
            <p class="text-sm font-semibold uppercase text-gray-700">Pridať kurz do správy</p>
            <form action="/admin/coursetype_instructor" method="POST">
                @csrf

                <input name="instructor_id" value="{{ $instructor->id }}" hidden />

                <x-form.field>

                    <div class="items-center mt-6 ">
                        <x-form.label name="type" title="Typ kurzu" required="true" />

                        <div class="flex items-center mt-1">
                            <x-form.input-radio name="type" for="type_student" value="0">
                                Študentský
                            </x-form.input-radio>

                            <x-form.input-radio class="ml-6" name="type" for="type_instructor" value="1">
                                Inštruktorský
                            </x-form.input-radio>

                        </div>
                        <x-form.error name="type" errorBag="createCI" />

                    </div>

                    <div class="mt-6  {{ old('type') == '1' ? 'flex' : 'hidden' }} " id="inst">

                        <div class="w-1/2 mr-2">
                            <x-form.select name="academy_id" title="Akadémia" class=" combo-a" required="true"
                                data-nextcombo=".combo-b" :disabled="old('type') != '1'" errorBag="createCI">

                                <option value="" disabled selected hidden>Akadémia</option>

                                @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
                                    <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">
                                        {{ ucwords($academ->name) }}</option>
                                @endforeach

                            </x-form.select>
                        </div>
                        <div class="w-1/2 ml-2">
                            <x-form.select name="coursetype_id" title="Kurz" class="combo-b" disabled required="true"
                                errorBag="createCI">

                                <option value="" disabled selected hidden>Typ kurzu</option>

                                @foreach (\App\Models\CourseType::with(['academy', 'applications', 'instructors'])->whereIn('type', [1])->get() as $type)
                                    @if (!$instructor->coursetypes->contains('id', $type->id))
                                        <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                            data-option="{{ $type->academy_id }}">
                                            {{ ucwords($type->name) }}</option>
                                    @endif
                                @endforeach
                            </x-form.select>
                        </div>

                    </div>

                    <div class="mt-6  {{ old('type') == '0' ? 'flex' : 'hidden' }} " id="stud">

                        <div class="w-1/2 mr-2">
                            <x-form.select name="academy_id2" title="Akadémia" class=" combo-a3" errorBag="createCI"
                                data-nextcombo=".combo-b3" required="true" :disabled="old('type') != '0'">

                                <option value="" disabled selected hidden>Akadémia</option>

                                @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
                                    <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">
                                        {{ ucwords($academ->name) }}</option>
                                @endforeach

                            </x-form.select>
                        </div>
                        <div class="w-1/2 ml-2">
                            <x-form.select name="coursetype_id2" title="Kurz" class="combo-b3" required="true"
                                disabled errorBag="createCI">

                                <option value="" disabled selected hidden>Typ kurzu</option>

                                @foreach (\App\Models\CourseType::with(['academy', 'applications', 'instructors'])->whereIn('type', [0])->get() as $type2)
                                    @if (!$instructor->coursetypes->contains('id', $type2->id))
                                        <option value="{{ $type2->id }}" data-id="{{ $type2->id }}"
                                            data-option="{{ $type2->academy_id }}">
                                            {{ ucwords($type2->name) }}</option>
                                    @endif
                                @endforeach
                            </x-form.select>

                        </div>
                    </div>
                </x-form.field>
                <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                    Odoslať
                </x-form.button>

            </form>
        </div>
    @endadmin
    <div id="kurzy" class="section flex-auto p-6"
        style="{{ session('success_cc') || session('success_dd') || request()->has('pridat') || $errors->createCI->any() ? '' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Kurzy v správe</p>
        <x-single-table>
            <x-slot:head>
                <th scope="col" class="py-3 px-6">Názov kurzu</th>
                <th scope="col" class="py-3 px-6">Akadémia</th>
                <th scope="col" class="py-3 px-6">Typ kurzu</th>
                <th scope="col" class="py-3 px-6">Min/max študentov</th>
                <th scope="col" class="py-3 px-6">Inštruktori</th>
                @if (auth()->user()->can('admin'))
                    <th scope="col" class="py-3 px-6">Triedy</th>
                @else
                    <th scope="col" class="py-3 px-6">Vaše triedy</th>
                    <th scope="col" class="py-3 px-6">Ostatné triedy kurzu</th>
                @endif
                <th scope="col" class="py-3 px-6">Počet prihlášok</th>
                <th scope="col"
                    class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                    Akcie</th>
            </x-slot:head>
            @foreach ($instructor->coursetypes as $coursetype)
                <tr
                    class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                    <td class="py-4 px-6"><x-table.td
                            url="coursetypes/{{ $coursetype->id }}">{{ $coursetype->name }}</x-table.td></td>
                    <td class="py-4 px-6">
                        @if (auth()->user()->can('admin'))
                            <x-table.td
                                url="academies/{{ $coursetype->academy->id }}">{{ $coursetype->academy->name }}</x-table.td>
                        @else
                            {{ $coursetype->academy->name }}
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        {{ $coursetype->type == '0' ? 'študentský' : 'inštruktorský' }}
                    </td>
                    <td class="py-4 px-6">{{ $coursetype->min }} / {{ $coursetype->max }}</td>
                    <td class="py-4 px-6">
                        @if ($coursetype->instructors->count() > 0)
                            @foreach ($coursetype->instructors as $instructor)
                                @if (auth()->user()->can('admin'))
                                    <x-table.td url="instructors/{{ $instructor->id }}">
                                        {{ $instructor->name }} {{ $instructor->lastname }}
                                    </x-table.td>
                                @else
                                    {{ $instructor->name }} {{ $instructor->lastname }}
                                @endif
                                <br>
                            @endforeach
                        @else
                            <a href="/admin/coursetypes/{{ $coursetype->id }}?pridat"
                                class="text-blue-600 hover:text-blue-700 hover:underline">Pridať inštruktora</a>
                        @endif
                    </td>
                    @if (auth()->user()->can('admin'))
                        <td class="py-4 px-6">
                            @foreach ($coursetype->classes as $class)
                                @if ($class->ended == false)
                                    <x-table.td url="classes/{{ $class->id }}">
                                        {{ $class->name }}
                                    </x-table.td>
                                    <br>
                                @endif
                            @endforeach
                        </td>
                    @else
                        <td class="py-4 px-6">
                            @foreach ($coursetype->classes as $class)
                                @if ($class->ended == false)
                                    @if ($class->instructor_id == auth()->user()->user_id)
                                        <x-table.td url="classes/{{ $class->id }}">
                                            {{ $class->name }}
                                        </x-table.td>
                                        <br>
                                    @endif
                                @endif
                            @endforeach
                        </td>
                        <td class="py-4 px-6">
                            @foreach ($coursetype->classes as $class)
                                @if ($class->ended == false)
                                    @if ($class->instructor_id != auth()->user()->user_id)
                                        {{ $class->name }}
                                        <br>
                                    @endif
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td class="py-4 px-6">{{ $coursetype->applications->count() }}</td>
                    <x-table.td-last url="coursetype_instructor/{{ $instructor->id }}/{{ $coursetype->id }}" edit=1
                        :delete="$delete"
                        itemName="kurz  {{ $coursetype->name }} zo správy tohto inštruktora? Spolu s tým sa vymažú aj jeho triedy. Ak tomu chcete zabrániť, zmeňte inštruktora týmto triedam."
                        edit=0 />

                </tr>
            @endforeach
        </x-single-table>
    </div>

    <div class="add-section" id="loginAdd"
        style="{{ $errors->default->any() ? 'display:block;' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Vytvoriť hodinu</p>

        <form action="/admin/lessons/create" method="post">
            @csrf
            <x-form.required class="mt-1" />

            <x-form.field>
                <x-form.input name="title" type="text" title="Názov hodiny" placeholder="Názov hodiny"
                    required="true" />
            </x-form.field>
            <x-form.field>
                <x-form.select name="class_id" title="Triedy" required="true">
                    <option style="color: gray;" value="" disabled selected hidden>Triedy</option>

                    @foreach ($instructor->classes as $class)
                        @if ($class->ended == false)
                            <option value="{{ $class->id }}" data-id="{{ $class->id }}" data-option="-1"
                                {{ old('instructor_id') == $class->id ? 'selected' : '' }}>
                                {{ ucwords($class->name) }} - {{ ucwords($class->coursetype->name) }}
                                {{ $class->coursetype->type == '0' ? 'študentský' : 'inštruktorský' }} </option>
                        @endif
                    @endforeach

                </x-form.select>
            </x-form.field>
            <x-form.field>
                <div class="flex">
                    <x-form.label name="datetime-local" title="Dátum a trvanie hodiny" required="true" />

                </div>
                <div class="flex">
                    <div class="w-1/2 mr-2">
                        <input type="datetime-local" name="lesson_date" value="{{ old('lesson_date') }}"
                            class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required>
                        <x-form.error name="lesson_date" errorBag="default" />
                    </div>
                    <div class="w-1/2 ml-2">
                        <input type="time" name="duration"
                            class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            step="60" value="{{ old('duration', '00:45') }}" required>
                        <x-form.error name="duration" errorBag="default" />
                    </div>
                </div>

            </x-form.field>
            <x-form.input-check name="email" title="Poslať oznámenie o hodine študentom emailom"
                :checked="old('email')" />
            <div id="emailDiv" class="mt-6 {{ old('email') ? '' : 'hidden' }}">
                <x-form.select name="lessonType" title="Forma hodiny">
                    <option value="0" disabled selected hidden>Vyberte formu hodiny</option>
                    <option {{ old('lessonType') == '1' ? 'selected' : '' }} value="1">Online</option>
                    <option {{ old('lessonType') == '2' ? 'selected' : '' }} value="2">Prezenčne</option>
                </x-form.select>
                <div id="onsiteDiv" class="{{ old('onsite') ? '' : 'hidden' }} mt-6"><x-form.input name="onsite"
                        type="text" title="Miestnosť" placeholder="Uveďte miestnosť vyučovania" /></div>
                <div id="onlineDiv" class="{{ old('online') ? '' : 'hidden' }} mt-6">
                    <x-form.input name="online" type="text" title="Link"
                        placeholder="Uveďte link na hodinu" />
                </div>
            </div>

            <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                Odoslať
            </x-form.button>
        </form>
    </div>

    <div id="login" class="section flex-auto p-6"
        style="{{ session('success_c') || session('success_d') || $errors->default->any() ? '' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Triedy inštruktora</p>
        <x-single-table>
            <x-slot:head>
                <tr>
                    <th scope="col" class="py-3 px-6">Názov triedy</th>
                    <th scope="col" class="py-3 px-6">Kurz</th>
                    <th scope="col" class="py-3 px-6">Dni / čas</th>
                    <th scope="col" class="py-3 px-6">Počet študentov</th>
                    <th scope="col"
                        class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                        Akcie</th>
            </x-slot:head>

            @foreach ($instructor->classes as $class)
                @if ($class->ended == false)
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

                        <td class="py-4 px-6">
                            {{ $class->days == 1 ? 'Týždeň' : '' }} {{ $class->days == 2 ? 'Víkend' : '' }}
                            {{ $class->days == 3 ? 'Nezáleží' : '' }} / {{ $class->time == 1 ? 'Ranný' : '' }}
                            {{ $class->time == 2 ? 'Poobedný' : '' }} {{ $class->time == 3 ? 'Nezáleží' : '' }}
                        </td>
                        <td class="py-4 px-6">{{ $class->students->count() }}</td>
                        <x-table.td-last url="classes/{{ $class->id }}" edit=1
                            itemName="triedu {{ $class->name }}? Spolu s triedou sa vymažú aj jej hodiny. Študenti v triede sa naspäť vrátia medzi prihlásených študentov na kurz tejto triedy. V prípade ukončenia vyučovania využite možnosť Ukončenčiť triedu." />

                    </tr>
                @endif
            @endforeach
        </x-single-table>
    </div>

</x-setting>

<script>
    function handleFileUpload(event) {
        var image = document.querySelector('img[alt="profile_image"]');
        var file = event.target.files[0];
        const button = document.getElementById("photobutton");
        const button_c = document.getElementById("photobutton-c");
        var reader = new FileReader();

        reader.onloadend = function() {
            image.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
            button.style.display = "block";
            button_c.style.display = "block";
        } else {
            image.src = "";
            button.style.display = "none";
            button_c.style.display = "none";
        }
    }
    document.getElementById("photobutton-c").addEventListener("click", function(event) {
        event.preventDefault();

        var fileInput = document.getElementById("photo-upload");
        fileInput.value = "";

        var image = document.querySelector('img[alt="profile_image"]');
        var defaultSrc = image.getAttribute('data-default-src');
        image.src = defaultSrc;

        document.getElementById("photobutton").style.display = "none";
        document.getElementById("photobutton-c").style.display = "none";

    });

    var loginAddContainer = document.getElementById('loginAdd');
    var emailInput = loginAddContainer.querySelector('#email');

    emailInput.addEventListener('change', function() {
        var emailDiv = document.getElementById('emailDiv');
        if (this.checked) {
            emailDiv.style.display = 'block';
        } else {
            emailDiv.style.display = 'none';
        }
    });

    document.getElementById('lessonType').addEventListener('change', function() {

        document.getElementById('onsiteDiv').style.display = 'none';
        document.getElementById('onlineDiv').style.display = 'none';

        switch (this.value) {
            case '1':
                document.getElementById('onlineDiv').style.display = 'block';
                break;
            case '2':
                document.getElementById('onsiteDiv').style.display = 'block';
                break;

        }
    });
</script>
