<x-layout />
<x-setting heading="Poslať email" etitle="Poslať email">

    <form method="POST" action="{{ route('admin.dashboard.send') }}" class="h-auto">
        @csrf
        <input type="hidden" name="recipients" id="itemsInput">
        <div class="flex items-center -mt-6">
            <x-form.input-check name="sender" title="Uviesť odosielateľa?" />

            <div class="relative mt-6 ml-2 flex items-center">
                <span class="material-icons info text-gray-500 hover:text-gray-700 cursor-pointer">info</span>
                <div class="absolute hidden w-48 px-4 py-2 text-sm leading-tight text-white bg-gray-800 rounded-lg shadow-lg -left-12 top-6 z-10"
                    style="min-width: 150px;">
                    Ak nezaškrtnete túto možnosť, ako odosielateľ bude uvedená UCM akadémia.
                </div>
            </div>
        </div>

        <div id="senderName" class="mt-2" style="display: none;">
            <x-form.input type="text" name="sendername" value="{{ old('sendername') }}" title="Odosielateľ"
                required="true" disabled placeholder="Odosielateľ" />
        </div>
        <div id="pick" class="mt-6">
            <x-form.select name="who" title="Príjemcovia">
                <option value="0" disabled selected hidden>Vyberte kategóriu príjemcov</option>
                <option value="1">Konkrétny študent / študenti</option>
                <option value="2">Konkrétny inštruktor / inštruktori</option>
                <option value="6">Všetci</option>
                <option value="3">Všetci aktuálny študenti konkrétnej akadémie</option>
                <option value="7">Všetci prihlásený študenti konkrétnej akadémie</option>
                <option value="4"> Všetci aktuálny študenti konkrétneho kurzu</option>
                <option value="8"> Všetci prihlásený študenti konkrétneho kurzu</option>
                <option value="5">Všetci študenti konkrétnej triedy</option>

            </x-form.select>
        </div>
        <div id="all" class="mt-6" style="display: none;">
            <x-form.select name="all_id" title="Všetci">

                <option value="1">Všetci aktuálny aj prihlásený študenti IT akadémie</option>
                <option value="2">Všetci inštruktori IT akadémie</option>
                <option value="3">Všetci aktuálny aj prihlásený študenti + inštruktori akadémie</option>

            </x-form.select>
            <button type="button" class=" add-item-button" data-target="all_id">Pridať príjemcov</button>
        </div>
        <div id="academy" class="mt-6" style="display: none;">
            <x-form.select name="academy_id" title="Akadémia">

                <option class="text-gray-500" value="" disabled selected hidden>Akadémie</option>
                @php
                    $academy = \App\Models\Academy::all();
                @endphp
                @foreach ($academy as $academ)
                    <option value="{{ $academ->id }}">{{ ucwords($academ->name) }}</option>
                @endforeach

            </x-form.select>
            <button type="button" class=" add-item-button" data-target="academy_id">Pridať
                príjemcov</button>
        </div>

        <div id="app_academy" class="mt-6" style="display: none;">
            <x-form.select name="academy_id2" title="Akadémia">

                <option class="text-gray-500" value="" disabled selected hidden>Akadémie</option>

                @foreach ($academy as $academ)
                    <option value="{{ $academ->id }}">{{ ucwords($academ->name) }}</option>
                @endforeach

            </x-form.select>
            <button type="button" class=" add-item-button" data-target="academy_id2">Pridať
                príjemcov</button>
        </div>

        <div id="class" class="mt-6" style="display: none;">
            <x-form.select name="class_id" title="Trieda">

                <option class="text-gray-500" value="" disabled selected hidden>Triedy</option>

                @foreach (\App\Models\CourseClass::all() as $class)
                    <option value="{{ $class->id }}">{{ ucwords($class->name) }}</option>
                @endforeach

            </x-form.select>


            <button type="button" class=" add-item-button" data-target="class_id">Pridať príjemcov</button>
        </div>

        <div id="instructor" class="mt-6" style="display: none;">
            <x-form.select name="instructor_id" title="Inštruktor">

                <option class="text-gray-500" value="" disabled selected hidden>Inštruktor</option>

                @foreach (\App\Models\Instructor::all() as $instrutor)
                    <option value="{{ $instrutor->id }}">{{ ucwords($instrutor->name) }}
                        {{ ucwords($instrutor->lastname) }} - {{ $instrutor->email }}</option>
                @endforeach

            </x-form.select>
            <div>
                <button type="button" class=" add-item-button" data-target="instructor_id">Pridať
                    príjemcu</button>
            </div>

        </div>

        <div id="student" class="mt-6" style="display: none;">
            <input type="hidden" name="student_id" id="student_id">
            <x-form.live-search :required="false" />
            <div class="flex items-center">
                <button type="button" class=" add-item-button" data-target="student_id">Pridať
                    príjemcu</button>
                <div class="relative mt-6 ml-2 flex items-center">
                    <span class="material-icons info text-gray-500 hover:text-gray-700 cursor-pointer">info</span>
                    <div class="absolute hidden w-48 px-4 py-2 text-sm leading-tight text-white bg-gray-800 rounded-lg shadow-lg -left-12 top-6 z-10"
                        style="min-width: 150px;">
                        Na pridanie študenta je zapotreby kliknúť na požadovaného študenta v tabulke "Návrhy".
                    </div>
                </div>
            </div>
        </div>

        <div id="course" class="mt-6" style="display: none;">

            <div class="items-center mt-6 ">
                <x-form.label name="type" title="Typ kurzu" />

                <div class="flex items-center mt-1">
                    <x-form.input-radio name="type" for="type_student" value="0">
                        Študentský
                    </x-form.input-radio>

                    <x-form.input-radio class="ml-6" name="type" for="type_instructor" value="1">
                        Inštruktorský
                    </x-form.input-radio>


                </div>

            </div>

            @php
                $coursetypes = \App\Models\CourseType::all();
            @endphp
            <div class="mt-6 hidden  flex-col" id="inst">
                <div class="flex">

                    <div class="w-1/2 mr-2">
                        <x-form.select name="academy_id3" title="Akadémia" class="combo-a"
                            data-nextcombo=".combo-b">
                            <option value="" disabled selected hidden>Akadémia</option>
                            @foreach ($academy as $academ)
                                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">
                                    {{ ucwords($academ->name) }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>

                    <div class="w-1/2 ml-2">
                        <x-form.select name="coursetype_id" title="Kurz" class="combo-b" disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            @foreach ($coursetypes->where('type', 1) as $type)
                                <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                    data-option="{{ $type->academy_id }}">
                                    {{ ucwords($type->name) }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>

                <div class="">
                    <button type="button" class="add-item-button " data-target="coursetype_id">
                        Pridať príjemcov
                    </button>
                </div>
            </div>

            <div class="mt-6 hidden flex-col" id="stud">
                <div class="flex">
                    <div class="w-1/2 mr-2">
                        <x-form.select name="academy_id4" title="Akadémia" class=" combo-a2"
                            data-nextcombo=".combo-b2">

                            <option value="" disabled selected hidden>Akadémia</option>

                            @foreach ($academy as $academ)
                                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">
                                    {{ ucwords($academ->name) }}</option>
                            @endforeach

                        </x-form.select>
                    </div>
                    <div class="w-1/2 ml-2">
                        <x-form.select name="coursetype_id2" title="Kurz" class="combo-b2" disabled>

                            <option value="" disabled selected hidden>Typ kurzu</option>

                            @foreach ($coursetypes->where('type', 0) as $type2)
                                <option value="{{ $type2->id }}" data-id="{{ $type2->id }}"
                                    data-option="{{ $type2->academy_id }}">
                                    {{ ucwords($type2->name) }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
                <div>
                    <button type="button" class=" add-item-button" data-target="coursetype_id2">Pridať
                        príjemcov</button>
                </div>
            </div>
        </div>

        <div id="app_course" class="mt-6" style="display: none;">

            <div class="items-center mt-6 ">
                <x-form.label name="type" title="Typ kurzu" />

                <div class="flex items-center mt-1">
                    <x-form.input-radio name="type2" for="type_student" value="0">
                        Študentský
                    </x-form.input-radio>

                    <x-form.input-radio class="ml-6" name="type2" for="type_instructor" value="1">
                        Inštruktorský
                    </x-form.input-radio>

                </div>

            </div>

            <div class="mt-6 hidden  flex-col" id="inst2">
                <div class="flex">

                    <div class="w-1/2 mr-2">
                        <x-form.select name="academy_id5" title="Akadémia" class="combo-a3"
                            data-nextcombo=".combo-b3">
                            <option value="" disabled selected hidden>Akadémia</option>
                            @foreach ($academy as $academ)
                                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">
                                    {{ ucwords($academ->name) }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>

                    <div class="w-1/2 ml-2">
                        <x-form.select name="coursetype_id3" title="Kurz" class="combo-b3" disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            @foreach ($coursetypes->where('type', 1) as $type)
                                <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                    data-option="{{ $type->academy_id }}">
                                    {{ ucwords($type->name) }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>

                <div class="">
                    <button type="button" class="add-item-button " data-target="coursetype_id3">
                        Pridať príjemcov
                    </button>
                </div>
            </div>

            <div class="mt-6 hidden flex-col" id="stud2">
                <div class="flex">
                    <div class="w-1/2 mr-2">
                        <x-form.select name="academy_id6" title="Akadémia" class=" combo-a4"
                            data-nextcombo=".combo-b4">

                            <option value="" disabled selected hidden>Akadémia</option>

                            @foreach ($academy as $academ)
                                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">
                                    {{ ucwords($academ->name) }}</option>
                            @endforeach

                        </x-form.select>
                    </div>
                    <div class="w-1/2 ml-2">
                        <x-form.select name="coursetype_id4" title="Kurz" class="combo-b4" disabled>

                            <option value="" disabled selected hidden>Typ kurzu</option>

                            @foreach ($coursetypes->where('type', 0) as $type2)
                                <option value="{{ $type2->id }}" data-id="{{ $type2->id }}"
                                    data-option="{{ $type2->academy_id }}">
                                    {{ ucwords($type2->name) }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
                <div>
                    <button type="button" class=" add-item-button" data-target="coursetype_id4">Pridať
                        príjemcov</button>
                </div>
            </div>
        </div>

        <x-form.field>
            <x-form.label name="itemList" title="Vybraný príjemcovia" />
            <ul id="itemsList" class="mt-4">
                <li id="default">Zatiaľ žiadny vybraný príjemcovia</ô>
            </ul>
        </x-form.field>
        <x-form.error name="recipients" errorBag="default" />

        <x-form.field>

            <x-form.textarea name="emailText" title="Text emailu" placeholder="Napíšte text emailu..."
                errorBag="default" :required="true" />

        </x-form.field>

        <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
            Odoslať
        </x-form.button>
    </form>

</x-setting>

<script>
    function autoExpand(field) {
        field.style.height = 'inherit';

        const computed = window.getComputedStyle(field);

        const height = parseInt(computed.getPropertyValue('border-top-width'), 10) +
            parseInt(computed.getPropertyValue('padding-top'), 10) +
            field.scrollHeight +
            parseInt(computed.getPropertyValue('padding-bottom'), 10) +
            parseInt(computed.getPropertyValue('border-bottom-width'), 10);

        field.style.height = height + 'px';
    }

    document.getElementById('sender').addEventListener('change', function() {
        var senderNameDiv = document.getElementById('senderName');
        if (this.checked) {
            senderNameDiv.style.display = 'block';
            document.getElementById('sendername').disabled = false;
        } else {
            senderNameDiv.style.display = 'none';
            document.getElementById('sendername').disabled = true;
        }
    });

    document.getElementById('who').addEventListener('change', function() {
        document.getElementById('academy').style.display = 'none';
        document.getElementById('class').style.display = 'none';
        document.getElementById('instructor').style.display = 'none';
        document.getElementById('student').style.display = 'none';
        document.getElementById('course').style.display = 'none';
        document.getElementById('all').style.display = 'none';
        document.getElementById('app_academy').style.display = 'none';
        document.getElementById('app_course').style.display = 'none';

        switch (this.value) {
            case '1':
                document.getElementById('student').style.display = 'block';
                break;
            case '2':
                document.getElementById('instructor').style.display = 'block';
                break;
            case '3':
                document.getElementById('academy').style.display = 'block';
                break;
            case '4':
                document.getElementById('course').style.display = 'block';
                break;
            case '5':
                document.getElementById('class').style.display = 'block';
                break;
            case '6':
                document.getElementById('all').style.display = 'block';
                break;
            case '7':
                document.getElementById('app_academy').style.display = 'block';
                break;
            case '8':
                document.getElementById('app_course').style.display = 'block';
                break;
        }
    });

    document.querySelectorAll('.add-item-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var targetId = button.getAttribute('data-target');
            var select = document.getElementById(
            targetId); 
            var list = document.getElementById('itemsList');
            var selectedValue = select.value;
            var dataType = button.getAttribute(
            'data-target');
            var uniqueKey =
            `${selectedValue}-${dataType}`;
            var selectedText;

            if (dataType == 'student_id') {

                var name = document.getElementById('name').value;
                var lastName = document.getElementById('lastname').value;
                var email = document.getElementById('email').value;

                if (!name || !lastName || !email) {
                    alert('Vyplnte meno, priezvisko a email pre študenta.');
                    return;
                }
                if (!document.getElementById('student_id').value) {
                    alert(
                        'Na pridanie študenta je zapotreby kliknúť na požadovaného študenta v tabulke "Návrhy".');
                    return;
                }

                selectedText = `Študent: ${name} ${lastName} - ${email}`;
            } else if (dataType == 'instructor_id') {
                selectedText = 'Inštruktor: ' + select.options[select.selectedIndex].text;
            } else if (dataType == 'academy_id') {
                selectedText = 'Všetci aktuálny študenti akadémie: ' + select.options[select
                    .selectedIndex].text;
            } else if (dataType == 'academy_id2') {
                selectedText = 'Všetci prihlásený študenti do akadémie: ' + select.options[select
                    .selectedIndex].text;
            } else if (dataType == 'coursetype_id') {
                selectedText = 'Všetci aktuálny študenti inštruktorského kurzu: ' + select.options[
                    select.selectedIndex].text;
            } else if (dataType == 'coursetype_id2') {
                selectedText = 'Všetci aktuálny študenti študentského kurzu: ' + select.options[select
                    .selectedIndex].text;
            } else if (dataType == 'coursetype_id3') {
                selectedText = 'Všetci prihlásený študenti do inštruktorského kurzu: ' + select.options[
                    select.selectedIndex].text;
            } else if (dataType == 'coursetype_id4') {
                selectedText = 'Všetci prihlásený študenti do študentského kurzu: ' + select.options[
                    select.selectedIndex].text;
            } else if (dataType == 'class_id') {
                selectedText = 'Všetci študenti triedy: ' + select.options[select.selectedIndex].text;
            } else {
                selectedText = select.options[select.selectedIndex].text;
            }

            if (addedItems.has(uniqueKey)) {
                alert('This item has already been added.');
                return;
            }

            var listItem = document.createElement('li');
            listItem.textContent = selectedText;
            listItem.setAttribute('data-id', selectedValue);
            listItem.setAttribute('data-type', 'academy');
            listItem.classList.add('bg-white', 'flex', 'justify-between', 'items-center', 'px-4',
                'py-1', 'mt-2', 'border', 'border-gray-300', 'rounded-md', 'shadow-sm');
            var deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'Odstrániť';
            deleteBtn.setAttribute('type', 'button');
            deleteBtn.classList.add('ml-2', 'py-1', 'px-4', 'hover:bg-red-700', 'p-2', 'border',
                'border-transparent', 'shadow-sm', 'text-sm', 'font-medium', 'rounded-md',
                'text-white', 'bg-red-600', 'hover:bg-red-700', 'focus:outline-none',
                'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-red-200');
            deleteBtn.onclick = function() {
                list.removeChild(listItem);
                addedItems.delete(uniqueKey);
                showOption(selectedValue, select, dataType);
            };

            listItem.appendChild(deleteBtn);
            list.appendChild(listItem);
            addedItems.add(uniqueKey);
            hideOption(selectedValue, select, dataType);

            var addedItemsArray = Array.from(addedItems);
            var addedItemsJson = JSON.stringify(addedItemsArray);
            document.getElementById('itemsInput').value = addedItemsJson;

            select.selectedIndex = 0;
        });
    });

    function hideOption(value, select, type) {
        if (type !== 'student_id') {
            var option = select.querySelector('option[value="' + value + '"]');
            if (option) option.style.display = 'none';
        }
        if (document.getElementById('default').style.display != 'none') {
            document.getElementById('default').style.display = 'none'
        }
        if (type == 'all_id') {
            var option = document.getElementById('all').style.display = 'none';
            if (value == 3) {
                var option = document.getElementById('pick').style.display = 'none';
            } else if (value == 1) {
                const valuesToHide = ["1", "3", "4", "5", "6", "7", "8"];
                valuesToHide.forEach(value => {
                    const option = document.getElementById('who').querySelector(`option[value="${value}"]`);
                    if (option) option.style.display = 'none';
                });
                var optionToSelect = document.getElementById('who').querySelector('option[value="0"]');

                if (optionToSelect) {
                    optionToSelect.selected = true;
                }
            } else if (value == 2) {
                const valuesToHide = ["2", "6"];
                valuesToHide.forEach(value => {
                    const option = document.getElementById('who').querySelector(`option[value="${value}"]`);
                    if (option) option.style.display = 'none';
                });

                var optionToSelect = document.getElementById('who').querySelector('option[value="0"]');

                if (optionToSelect) {
                    optionToSelect.selected = true;
                }
            }
        }
    }

    function showOption(value, select, type) {
        if (type !== 'student_id') {
            var option = select.querySelector('option[value="' + value + '"]');
            if (option) option.style.display = 'block';
        }
        if (addedItems.size == 0) {
            document.getElementById('default').style.display = 'block'
        }
        if (type == 'all_id') {
            if (value == 3) {
                var option = document.getElementById('pick').style.display = 'block';
                var optionToSelect = document.getElementById('who').querySelector('option[value="0"]');

                if (optionToSelect) {
                    optionToSelect.selected = true;
                }
            } else if (value == 1) {
                const valuestoShow = ["1", "3", "4", "5", "6", "7", "8"];
                valuestoShow.forEach(value => {
                    const option = document.getElementById('who').querySelector(`option[value="${value}"]`);
                    if (option) option.style.display = 'block';
                });

            } else if (value == 2) {
                const valuestoShow = ["2", "6"];
                valuestoShow.forEach(value => {
                    const option = document.getElementById('who').querySelector(`option[value="${value}"]`);
                    if (option) option.style.display = 'block';
                });
            }
        }
    }

    var addedItems = new Set();
</script>
