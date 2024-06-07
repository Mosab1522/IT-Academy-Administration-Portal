<x-layout />

<x-setting heading="{{ $class->name }}">

    <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
        <x-show-header name="{{ $class->name }}" title="Trieda" />
        <x-show-buttons calendarText="triedy {{ $class->name }}" calendarWho="class_id={{ $class->id }}"
            emailId="{{ $class->id }}" emailType="class_id" emailText="Študenti triedy {{ $class->name }}">
            <button title="Ukončenie hodiny" class="end-class-button text-gray-800 hover:text-gray-600">
                <span class="material-icons material-icons-header">task_alt</span>

            </button>
        </x-show-buttons>

        <div
            class="w-full max-w-full px-3 mx-auto mt-4 md:mt-0 lg:mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-7/12 lg:flex">

            <x-buttonsection>
                <li
                    class="flex-1 {{ session('success_d') || session('success_c') || $errors->default->any() || session('success_cc') || session('success_dd') || $errors->admin->any() ? 'hidden' : '' }}">
                    <button
                        class="edit-button {{ session('success_c') || session('success_cc') || session('success_dd') || session('success_d') || request()->has('pridat') || request()->has('vytvorit') || $errors->default->any() || $errors->admin->any() ? 'hidden' : '' }} "
                        data-target="profile">
                        <span style="display: inline;">Povoliť
                            úpravy</span>
                        <span style="display: none;">Zrušiť úpravy</span>
                    </button>
                </li>
                <li
                    class="flex-1 {{ session('success_c') || session('success_d') || request()->has('pridat') || $errors->default->any() ? '' : 'hidden' }}">
                    <button
                        class="add-button z-30 {{ session('success_c') || session('success_d') || request()->has('pridat') || $errors->default->any() ? '' : 'hidden' }} "
                        data-target="kurzyAdd">
                        <span class="{{ session('success_c') || session('success_d') ? '' : 'hidden' }}">Vytvoriť
                            hodinu</span>
                        <span class="{{ request()->has('pridat') || $errors->default->any() ? '' : 'hidden' }}">Zrušiť
                            vytvorenie
                            hodiny</span>
                    </button>
                </li>
                <li
                    class="flex-1 {{ session('success_cc') || session('success_dd') || request()->has('pridat') || $errors->admin->any() ? '' : 'hidden' }}">
                    <button
                        class="add-button z-30 {{ session('success_cc') || session('success_dd') || $errors->admin->any() || request()->has('vytvorit') ? '' : 'hidden' }}"
                        data-target="loginAdd">
                        <span class="{{ session('success_cc') || session('success_dd') ? '' : 'hidden' }}">Pridať
                            študenta</span>
                        <span class="{{ request()->has('vytvorit') || $errors->admin->any() ? '' : 'hidden' }}">Zrušiť
                            pridanie študenta</span>
                </li>
            </x-buttonsection>

            <x-buttonsection class="md:mt-3 lg:mt-0">
                <li class="flex-auto pr-0.5">
                    <button
                        class="section-button {{ session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') || $errors->default->any() || $errors->admin->any() ? '' : 'hidden' }} rounded-l-lg"
                        data-target="profile">Info</button>
                    <button
                        class="section-button {{ session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') || $errors->default->any() || $errors->admin->any() ? 'hidden' : '' }} rounded-l-lg"
                        data-target="kurzy">Hodiny</button>
                </li>
                <li class="flex-auto">

                    <button
                        class="section-button {{ request()->has('vytvorit') || session('success_cc') || session('success_dd') || $errors->admin->any() ? '' : 'hidden' }} rounded-r-lg"
                        data-target="kurzy">Hodiny</button>
                    <button
                        class="section-button {{ request()->has('vytvorit') || session('success_cc') || session('success_dd') || $errors->admin->any() ? 'hidden' : '' }} rounded-r-lg"
                        data-target="login">Študenti</button>
                </li>
            </x-buttonsection>
        </div>

    </div>

    <div id="profile" class="section flex-auto p-6"
        style="{{ session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') || $errors->default->any() || $errors->admin->any() ? 'display: none;' : '' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
        <form id="formm" action="/admin/classes/{{ $class->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('Patch')
            <x-form.required class=" hidden mt-1 " />
            <x-form.field>
                <x-form.input value="{{ $class->name }}" name="cname" type="text" title="Názov"
                    placeholder="Názov" errorBag="updateClass" disabled required="true" />
            </x-form.field>

            <div class="flex">
                <div class="mt-6 w-1/2 mr-2">

                    <x-form.select name="days" title="Dni" required="true" errorBag="updateClass" disabled>

                        <option value="" disabled hidden>Dni výučby</option>
                        <option value="1" {{ $class->days == 1 ? 'selected' : '' }}>Týždeň</option>
                        <option value="2" {{ $class->days == 2 ? 'selected' : '' }}>Víkend</option>
                        <option value="3" {{ $class->days == 3 ? 'selected' : '' }}>Nezáleží</option>

                    </x-form.select>
                </div>

                <div class="mt-6 w-1/2 ml-2">
                    <x-form.select name="time" title="Čas" required="true" errorBag="updateClass" disabled>

                        <option value="" disabled hidden>Čas výučby</option>
                        <option value="1" {{ $class->time == 1 ? 'selected' : '' }}>Ranný</option>
                        <option value="2" {{ $class->time == 3 ? 'selected' : '' }}>Poobedný</option>
                        <option value="3" {{ $class->time == 3 ? 'selected' : '' }}>Nezáleží</option>

                    </x-form.select>

                </div>
            </div>

            <x-form.field>
                <div class="flex justify-end space-x-4 mt-6">
                    <x-form.button class=" hidden  flex-1">
                        Upraviť
                    </x-form.button>

                    <button id="res" type="reset"
                        class="hidden flex-none bg-gray-400 text-white text-sm font-medium py-2 px-6 rounded-md hover:bg-gray-500 transition-colors duration-200 shadow-sm">
                        Reset
                    </button>
                </div>
            </x-form.field>

        </form>
    </div>

    <div class="add-section" id="kurzyAdd"
        style="{{ request()->has('pridat') || $errors->default->any() ? 'display:block;' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Vytvoriť hodinu</p>

        <form action="/admin/lessons/create" method="post">
            @csrf
            <x-form.required class="mt-1" />

            <input name="class_id" value="{{ $class->id }}" hidden />
            <x-form.field>
                <x-form.input name="title" type="text" title="Názov hodiny" placeholder="Názov hodiny"
                    required="true" />
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
                            required step="60" value="{{ old('duration', '00:45') }}">
                        <x-form.error name="duration" errorBag="default" />
                    </div>
                </div>

            </x-form.field>
            <x-form.input-check name="cemail" title="Poslať oznámenie o hodine študentom emailom"
                :checked="old('cemail')" />
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

    <div id="kurzy" class="section flex-auto p-6"
        style="{{ session('success_c') || session('success_d') || request()->has('pridat') || $errors->default->any() ? '' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Hodiny triedy</p>
        <x-single-table>
            <x-slot:head>
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Názov hodiny
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Inštruktor
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Dátum a trvanie
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Absencie
                    </th>
                    <th scope="col"
                        class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                        Akcie</th>
            </x-slot:head>

            @foreach ($class->lessons as $lesson)
                <tr
                    class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
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
                    <td class="py-4 px-6">
                        @if (\Carbon\Carbon::parse($lesson->lesson_date)->addMinutes($lesson->duration) < \Carbon\Carbon::now())
                            @foreach ($lesson->class->students as $student)
                                @if (!$lesson->students->contains('id', $student->id))
                                    {{ $student->name }} {{ $student->lastname }} <br>
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <x-table.td-last url="lessons/{{ $lesson->id }}" edit=1
                        itemName="hodinu {{ $lesson->title }} tejto triedy? Spolu s tým sa vymažú záznamy o absolvovaní tejto hodiny študentmi." />

                </tr>
            @endforeach
        </x-single-table>
    </div>
    <div class="add-section" id="loginAdd"
        style="{{ request()->has('vytvorit') || $errors->admin->any() ? 'display:block;' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Pridať študenta</p>

        <form action="/admin/class-student" method="post">
            @csrf
            <input type="hidden" name="class_id" value="{{ $class->id }}" />


            <x-form.field>
                <x-form.live-search />
            </x-form.field>

            <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                Odoslať
            </x-form.button>
        </form>
    </div>
    <div id="login" class="section flex-auto p-6 "
        style="{{ request()->has('vytvorit') || session('success_cc') || session('success_dd') || $errors->admin->any() ? '' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700 mb-6">Študenti v triede</p>
        <x-single-table>
            <x-slot:head>
                <th scope="col" class="py-3 px-6">Meno</th>
                <th scope="col" class="py-3 px-6">Email</th>
                <th scope="col" class="py-3 px-6">Absencie</th>
                <th scope="col"
                    class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                    Akcie</th>
            </x-slot:head>
            @foreach ($class->students as $student)
                <tr
                    class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                    <td class="py-4 px-6"> <x-table.td url="students/{{ $student->id }}">
                            {{ $student->name }} {{ $student->lastname }}
                        </x-table.td></td>
                    <td class="py-4 px-6">{{ $student->email }}</td>
                    <td class="py-4 px-6">
                        @foreach ($class->lessons as $les)
                            @if (\Carbon\Carbon::parse($les->lesson_date)->addMinutes($les->duration) < \Carbon\Carbon::now())
                                @if (!$les->students->contains('id', $student->id))
                                    {{ $les->title }} <br>
                                @endif
                            @endif
                        @endforeach
                    </td>

                    <x-table.td-last url="class-student/{{ $student->id }}/{{ $class->id }}" edit=1
                        itemName="študenta {{ $student->name }} {{ $student->lastname }} z tejto triedy? Ak mal študent vytvorenú prihlášku vráti sa medzi prihlásených študentov kurzu tejto triedy. Vymaže sa aj jeho evidenia absolvovaných hodín triedy." />

                </tr>
            @endforeach
        </x-single-table>
    </div>

</x-setting>


<div id="completeClassConfirmModal"
    class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow max-w-md mx-4 my-8 relative">
        <button type="button" class="absolute top-0 right-0 mt-3 mr-3 text-gray-800 hover:text-gray-600"
            id="XcloseCompleteClassModal">
            <span class="material-icons">close</span>
        </button>
        <h2 class="text-lg font-semibold text-gray-900">Potvrdiť ukončenie triedy</h2>
        <p class="text-gray-700">Ste si istý, že chcete ukončiť túto triedu {{ $class->name }}? Označte tých
            študentov, ktorí úspešne absolvovali tento kurz a bol im udelený certifikát.</p>
        <p class="my-2 text-sm font-semibold uppercase text-gray-700">Vyberte úspešných absolventov</p>
        <form id="completeClassForm" method="POST" action="/admin/class/end/{{ $class->id }}">
            @csrf
            @method('Patch')
            <input type="hidden" name="class_id" id="completeClassId" value="">
            <div class="overflow-y-auto" style="max-height: 400px;">
                @foreach ($class->students as $student)
                    <li
                        class="bg-white flex items-center px-4 py-1 border border-gray-300 rounded-md shadow-sm mb-0.5">
                        <input
                            class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                            type="checkbox" name="students[]" value="{{ $student->id }}">
                        <label for="students[]"
                            class="ml-2 block text-gray-700 text-sm leading-5.6">{{ $student->name }}
                            {{ $student->lastname }}</label>
                    </li>
                @endforeach
            </div>

            <div class="flex justify-end space-x-4 mt-4">
                <button type="button" id="closeCompleteClassModal"
                    class="flex-none bg-gray-400 text-white text-sm font-medium py-2 px-6 rounded-md hover:bg-gray-500 transition-colors duration-200">Zrušiť</button>
                <button type="submit" id="confirmCompleteButton"
                    class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-200 md:w-auto w-full sm:w-auto"
                    disabled>Dokončiť kurz</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCompleteClassModal(className, classId) {
        const modal = document.getElementById('completeClassConfirmModal');
        const itemToDeleteName = document.getElementById('itemToDeleteName');
        const confirmButton = document.getElementById('confirmCompleteButton');
        const closeButton = document.getElementById('closeCompleteClassModal');
        const XButton = document.getElementById('XcloseCompleteClassModal');

        itemToDeleteName.textContent = className;
        document.getElementById('completeClassId').value = classId;
        modal.style.display = 'flex';
        confirmButton.disabled = true;
        confirmButton.textContent = 'Dokončiť kurz (15s)';

        let timeLeft = 15;
        const countdown = setInterval(() => {
            timeLeft--;
            confirmButton.textContent = `Dokončiť kurz (${timeLeft}s)`;
            if (timeLeft <= 0) {
                clearInterval(countdown);
                confirmButton.disabled = false;
                confirmButton.textContent = 'Dokončiť kurz';
            }
        }, 1000);

        function closeModal() {
            clearInterval(countdown);
            modal.style.display = 'none';
        }

        closeButton.onclick = closeModal;
        XButton.onclick = closeModal;

        confirmButton.onclick = function() {
            clearInterval(countdown);

        };
    }

    document.querySelectorAll('.end-class-button').forEach(button => {
        button.addEventListener('click', function() {
            openCompleteClassModal('Class Name', 123); // Example values
        });
    });


    document.getElementById('cemail').addEventListener('change', function() {
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
