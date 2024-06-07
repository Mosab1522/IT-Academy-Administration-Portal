<x-layout />
@php
    $hours = floor($lesson->duration / 60);
    $minutes = $lesson->duration % 60;

    $formattedHours = str_pad($hours, 2, '0', STR_PAD_LEFT);
    $formattedMinutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);

    $timeValue = $formattedHours . ':' . $formattedMinutes;
@endphp
<x-setting heading="{{ $lesson->title }}">

    <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
        <x-show-header name="{{ $lesson->title }}" title="Hodina" />

        <div
            class="w-full max-w-full px-3 mx-auto mt-4 md:mt-0 lg:mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-7/12 lg:flex">
            <x-buttonsection>
                <li
                    class="flex-1 {{ session('success_c') || session('success_cc') || session('success_dd') || session('success_d') || request()->has('pridat') || request()->has('vytvorit') ? 'hidden' : '' }}">
                    <button
                        class="edit-button {{ session('success_c') || session('success_cc') || session('success_dd') || session('success_d') || request()->has('pridat') || request()->has('vytvorit') ? 'hidden' : '' }}"
                        data-target="profile">
                        <span style="display: inline;">Povoliť
                            úpravy</span>
                        <span style="display: none;">Zrušiť úpravy</span>
                    </button>
                </li>
                <li
                    class="flex-1 {{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}">
                    <button
                        class="add-button {{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}"
                        data-target="kurzyAdd">
                        <span class="{{ session('success_cc') || session('success_dd') ? '' : 'hidden' }}">Pridať
                            zúčastnených študentov</span>
                        <span class="{{ request()->has('pridat') ? '' : 'hidden' }}">Zrušiť
                            pridanie zúčastnených študentov</span>
                    </button>
                </li>

            </x-buttonsection>

            <x-buttonsection class="md:mt-3 lg:mt-0">
                <li class="flex-auto pr-0.5">
                    <button
                        class="section-button {{ session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? '' : 'hidden' }} rounded-lg "
                        data-target="profile">Info</button>
                    <button
                        class="section-button {{ session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? 'hidden' : '' }} rounded-lg"
                        data-target="kurzy">Zúčastnený študenti</button>
                </li>
        </div>

        </x-buttonsection>

    </div>

    <div id="profile" class="section flex-auto p-6"
        style="{{ session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? 'display: none;' : '' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
        <form id="formm" action="/admin/lessons/{{ $lesson->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('Patch')
            <x-form.required class=" hidden mt-1 " />
            <input type="hidden" name="class_id" value="{{ $lesson->class->id }}">
            <x-form.field>
                <x-form.input value="{{ $lesson->title }}" name="title" type="text" title="Názov"
                    placeholder="Názov" disabled errorBag="updateLesson" required="true" />
            </x-form.field>
            <x-form.field>
                <div class="flex">
                    <x-form.label name="datetime-local" title="Dátum a trvanie hodiny" required="true" />

                </div>

                <div class="flex">
                    <div class="w-1/2 mr-2">
                        <input type="datetime-local" name="lesson_date" value="{{ $lesson->lesson_date }}"
                            class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-gray-100 disabled:text-gray-500"
                            disabled required>
                        <x-form.error name="lesson_date" errorBag="updateLesson" />
                    </div>
                    <div class="w-1/2 ml-2">
                        <input type="time" name="duration"
                            class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-gray-100 disabled:text-gray-500"
                            step="60" value="{{ $timeValue }}" disabled required>
                        <x-form.error name="duration" errorBag="updateLesson" />
                    </div>
                </div>

            </x-form.field>

            <x-form.field>
                <x-form.select name="instructor_id" title="Inštruktor" disabled errorBag="updateLesson" required="true">
                    <option style="color: gray;" value="" disabled selected hidden>Inštruktori</option>
                    @foreach (\App\Models\Instructor::orderBy('name')->get() as $instructor)
                        <option value="{{ $instructor->id }}"
                            {{ $lesson->instructor->id == $instructor->id ? 'selected' : '' }}>
                            {{ ucwords($instructor->name) }} {{ ucwords($instructor->lastname) }}</option>
                    @endforeach
                </x-form.select>
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
    @php
        $counter = 0;
    @endphp
    @foreach ($lesson->class->students as $student)
        @if (!$lesson->students->contains('id', $student->id))
            @php
                $counter++;
            @endphp
        @endif
    @endforeach
    <div class="add-section" id="kurzyAdd"
        style="{{ request()->has('pridat') ? 'display:block;' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Pridať študenta</p>

        <form action="/admin/lesson-students" method="post">
            @csrf
            <x-form.required class="mt-1" />
            <input type="hidden" name="lesson_id" value="{{ $lesson->id }}" />
            <x-form.field>
                @if ($counter != 0)
                    <x-form.select name="who" title="Príjemcovia" required="true">

                        <option value="0" disabled selected hidden>Výber zúčastnených študentov</option>

                        <option value="1">Všetci študenti triedy okrem už pridaných</option>

                        <option value="2">Konkrétny študenti</option>

                    </x-form.select>
                @else
                    <p
                        class="bg-white flex items-center px-4 py-1 border border-gray-300 rounded-md shadow-sm text-sm leading-5.6">
                        Všetci študenti triedy sú už zapísaný ako zúčastnení.
                    </p>
                @endif

                <div class="mt-6 hidden" id="students">
                    <x-form.label name="students" title="Zúčastnený študenti" required="true" />
                    <ul id="itemsList" class="mt-1">

                        @foreach ($lesson->class->students as $student)
                            @if (!$lesson->students->contains('id', $student->id))
                                <li
                                    class="bg-white flex items-center px-4 py-1 border border-gray-300 rounded-md shadow-sm">

                                    <input
                                        class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                        type="checkbox" name="students[]" value="{{ $student->id }}" checked>
                                    <label for="students[]"
                                        class="ml-2 block text-gray-700 text-sm leading-5.6">{{ $student->name }}
                                        {{ $student->lastname }}</label>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

            </x-form.field>
       
            <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                Odoslať
            </x-form.button>
        </form>
    </div>

    <div id="kurzy" class="section  flex-auto p-6"
        style="{{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'display: none;' }}">
        <x-single-table>
            <x-slot:head>
                <th scope="col" class="py-3 px-6">Meno</th>
                <th scope="col" class="py-3 px-6">Email</th>

                <th scope="col"
                    class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                    Akcie</th>
            </x-slot:head>
            @foreach ($lesson->students as $student)
                <tr
                    class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                    <td class="py-4 px-6">
                        <x-table.td url="students/{{ $student->id }}">{{ $student->name }} {{ $student->lastname }}
                        </x-table.td>
                    </td>
                    <td class="py-4 px-6">{{ $student->email }}</td>

                    <x-table.td-last url="lesson-students/{{ $student->id }}/{{ $lesson->id }}" edit=1
                        itemName="študenta {{ $student->name }} {{ $student->lastname }} zo zoznamu zúčastnených študentov tejto hodiny?" />
                </tr>
            @endforeach
        </x-single-table>
    </div>
  
</x-setting>

<script>
    document.getElementById('who').addEventListener('change', function() {
  
        document.getElementById('students').style.display = 'none';

        switch (this.value) {
            case '1':
                document.getElementById('students').style.display = 'none';
                break;
            case '2':
                document.getElementById('students').style.display = 'block';
                break;
        }
    });
</script>
