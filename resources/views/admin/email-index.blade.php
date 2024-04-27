<x-flash />
<x-layout />
<x-setting heading="Poslať email" etitle="Poslať email">

    {{-- <div class="flex flex-col">
        <div class="flex">

            <form class="flex-1" action="{{ route('admin.dashboard.index') }}" method="GET"> --}}


                <form method="POST" action="{{ route('admin.dashboard.send') }}" class="h-auto">
                    @csrf
                    <input type="hidden" name="recipients" id="itemsInput">
                    <div class="flex items-center -mt-6">
                        <x-form.input-check name="sender" title="Uviesť odosielateľa?" />
                    
                        <!-- Info Icon with Tooltip -->
                        <div class="relative mt-6 ml-2 flex items-center">
                            <span class="material-icons info text-gray-500 hover:text-gray-700 cursor-pointer">info</span>
                            <div  class="absolute hidden w-48 px-4 py-2 text-sm leading-tight text-white bg-black rounded-lg shadow-lg -left-12 top-6 z-10"
                                 style="min-width: 150px;">
                                 Ak nezaškrtnete túto možnosť. Ako odosielateľ bude uvedená UCM akadémia.
                            </div>
                        </div>
                    </div>
                    
                   
                    <div id="senderName" class="mt-2" style="display: none;">
                        <x-form.input type="text" name="sendername" value="{{ old('sendername') }}" title="Odosielateľ"
                            placeholder="Odosielateľ" />
                    </div>
                    <div class="mt-6">
                    <x-form.select name="who" title="Príjemcovia">
                        <option value="" disabled selected hidden>Vyberte kategóriu príjemcov</option>
                        <option value="6" {{old('who')==6 ? 'selected' : '' }}>Všetci</option>
                        <option value="1" {{old('who')==1 ? 'selected' : '' }}>Konkrétny študent / študenti</option>
                        <option value="2" {{old('who')==2 ? 'selected' : '' }}>Konkrétny inštruktor / inštruktori</option>
                        <option value="3" {{old('who')==3 ? 'selected' : '' }}>Všetci študenti akadémie</option>
                        <option value="4" {{old('who')==4 ? 'selected' : '' }}> Všetci študenti kurzu</option>
                        <option value="5" {{old('who')==5 ? 'selected' : '' }}>Všetci študenti triedy</option>

                    </x-form.select>
                </div>
                    <div id="academy" class="mt-6" style="display: none;">
                        <x-form.select name="academy_id" title="Akadémia">

                            <option class="text-gray-500" value="" disabled selected hidden>Akadémie</option>
                            @php
                            $academy = \App\Models\Academy::all();
                            @endphp
                            @foreach (\App\Models\Academy::all() as $academ)
                            <option value="{{ $academ->id }}" {{old('academy_id')==$academ->id ? 'selected' : '' }} >{{
                                ucwords($academ->name) }}</option>
                            @endforeach

                        </x-form.select>
                        <button type="button"  class=" add-item-button" data-target="academy_id">Pridať príjemcov</button>
                    </div>

                    <div id="class" class="mt-6" style="display: none;">
                        <x-form.select name="class_id" title="Trieda">

                            <option class="text-gray-500" value="" disabled selected hidden>Triedy</option>
                            @php
                            $class = \App\Models\CourseClass::all();
                            @endphp
                            @foreach (\App\Models\CourseClass::all() as $class)
                            <option value="{{ $class->id }}" {{old('class_id')==$class->id ? 'selected' : '' }} >{{
                                ucwords($class->name) }}</option>
                            @endforeach

                        </x-form.select>
                        
                    
                    <button type="button"  class=" add-item-button" data-target="class_id">Pridať príjemcov</button>
                    </div>

                    <div id="instructor" class="mt-6" style="display: none;">
                        <x-form.select name="instructor_id" title="Inštruktor">

                            <option class="text-gray-500" value="" disabled selected hidden>Inštruktor</option>
                            @php
                            $academy = \App\Models\Instructor::all();
                            @endphp
                            @foreach (\App\Models\Instructor::all() as $instrutor)
                            <option value="{{ $instrutor->id }}" {{old('instrutor_id')==$instrutor->id ? 'selected' : ''
                                }} >{{
                                ucwords($instrutor->name) }} {{
                                ucwords($instrutor->lastname) }} - {{
                                $instrutor->email }}</option>
                            @endforeach

                        </x-form.select>
                        <div>
                            <button type="button"  class=" add-item-button" data-target="instructor_id">Pridať príjemcov</button>
                        </div>
                        
                    </div>

                    <div id="student" class="mt-6" style="display: none;">
                        <x-form.live-search />
                        <button type="button"  class=" add-item-button" data-target="student_id">Pridať príjemcov</button>
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
                        {{-- <div class="items-center">
                            <x-form.label name="typ kurzu:" />

                            <input class="mr-0.5" type="radio" name="type" value="0" {{old('type')=='0' ? 'checked' : ''
                                }}>
                            <label for="0">Študentský</label>

                            <input class="ml-2 mr-0.5" type="radio" name="type" value="1" {{old('type')=='1' ? 'checked'
                                : '' }}>
                            <label for="1">Inštruktorský</label>

                        </div> --}}

                        <div class="mt-6 hidden  flex-col" id="inst">
                            <div class="flex">
                                <!-- First select for Academies -->
                                <div class="w-1/2 mr-2">
                                    <x-form.select name="academy_id" title="Akadémia" class="combo-a" data-nextcombo=".combo-b">
                                        <option value="" disabled selected hidden>Akadémia</option>
                                        @foreach (\App\Models\Academy::with(['coursetypes','applications'])->get() as $academ)
                                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">
                                                {{ ucwords($academ->name) }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                        
                                <!-- Second select for Course Types -->
                                <div class="w-1/2 ml-2">
                                    <x-form.select name="coursetype_id" title="Kurz" class="combo-b" disabled>
                                        <option value="" disabled selected hidden>Typ kurzu</option>
                                        @foreach(\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [1, 2])->get() as $type)
                                            <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}">
                                                {{ ucwords($type->name) }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                        
                            <!-- Button below the selects -->
                            <div class="">
                                <button type="button" class="add-item-button " data-target="coursetype_id">
                                    Pridať príjemcov
                                </button>
                            </div>
                        </div>
                        


                        <div class="mt-6 hidden flex-col" id="stud">
                            <div class="flex">
                            <div class="w-1/2 mr-2">
                                <x-form.select name="academy_id2" title="Akadémia" class=" combo-a3"
                                    data-nextcombo=".combo-b3">

                                    <!-- parent -->

                                    <option value="" disabled selected hidden>Akadémia</option>
                                    {{-- @php
                                    $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                    ->get();
                                    @endphp --}}
                                    @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                                    ->get() as $academ)
                                    <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{--
                                        {{old('academy_id')==$academ->id ? 'selected' : ''}} --}}
                                        >{{
                                        ucwords($academ->name)}}</option>
                                    @endforeach
                                    {{-- <option value="" disabled selected hidden>Akadémia</option>
                                    <option value="1" data-id="1" data-option="-1">Cisco</option>
                                    <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                                </x-form.select>
                            </div>
                            <div class="w-1/2 ml-2">
                                <x-form.select name="coursetype_id2" title="Kurz" class="combo-b3" disabled>
                                    <!-- child -->
                                    {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b"
                                        data-nextcombo=".combo-c" disabled>
                                        <option value="" disabled selected hidden>Typ kurzu</option>
                                        <option value="1" data-id="1" data-option="1">Lahky</option>
                                        <option value="2" data-id="2" data-option="1">Stredny</option>
                                        <option value="3" data-id="3" data-option="2">Photoshop</option>
                                        <option value="4" data-id="4" data-option="2">Illustrator</option>
                                    </select> --}}

                                    <option value="" disabled selected hidden>Typ kurzu</option>
                                    {{-- @php
                                    $academy = \App\Models\CourseType::all();
                                    @endphp --}}
                                    @foreach (\App\Models\CourseType::with(['academy','applications'])->whereIn('type',
                                    [0,
                                    2])->get() as $type2)
                                    <option value="{{ $type2->id }}" data-id="{{ $type2->id }}"
                                        data-option="{{ $type2->academy_id }}" {{-- {{old('coursetype_id')==$type->id ?
                                        'selected' : ''}} --}}
                                        >{{
                                        ucwords($type2->name) }}</option>
                                    @endforeach
                                </x-form.select>
                            </div>
                            </div>
                            <div>
                            <button type="button"  class=" add-item-button" data-target="coursetype_id2">Pridať príjemcov</button>
                        </div>
                        </div>
                    </div>
                    
                    <x-form.field>
                        <x-form.label name="itemList" title="Vybraný príjemcovia"/>
                         <ul id="itemsList" class="mt-4">
                        <li id="default">Zatiaľ žiadny vybraný príjemcovia</li>
                    </ul>
                    </x-form.field>
                   
                    <x-form.field>
                    <x-form.label name="emailText" title="Text emailu"/>

                    <textarea id="emailText" name="emailText" rows="3"
                        class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm resize-none overflow-hidden"
                        placeholder="Napíšte text emailu..." oninput="autoExpand(this)"></textarea>
                    </x-form.field>


                    <div class="flex-shrink-0">
                        <x-form.button class="md:mt-6 mt-2 sm:mt-6 w-full">Poslať</x-form.button>
                    </div>
                </form>




                {{-- <x-slot:create>
                    <x-form.search action="{{ route('admin.dashboard.sen') }}" text="Filtrovať a zoradiť">
                        @csrf

                        @if(request()->filled('search'))
                        <input type="hidden" name="search" value="{{request()->input('search')}}" />
                        @endif

                        <x-form.search-select name="orderBy" title="Zoradiť podľa">
                            <option value="latest" {{ request()->get('sort_by') == 'latest' ? 'selected' : ''
                                }}>Najnovšie
                            </option>
                            <option value="oldest" {{ request()->get('sort_by') == 'oldest' ? 'selected' : ''
                                }}>Najstaršie
                            </option>
                            <option value="most_applicants" {{ request('sort_by')=='most_applicants' ? 'selected' : ''
                                }}>
                                Najviac prihlásených</option>
                            <option value="less_applicants" {{ request('sort_by')=='less_applicants' ? 'selected' : ''
                                }}>
                                Najmenej prihlásených</option>
                        </x-form.search-select> --}}
                        {{--
        </div>
        <div class="px-6">
            <x-form.label name="Filtrovať podľa" />
            <div class="flex">
                <div> --}}
                    {{-- <x-form.search-select name="academy_id" title="Akadémia" class=" combo-a4"
                        data-nextcombo=".combo-b4">
                        @php
                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                        ->get();
                        $coursetype = \App\Models\CourseType::with(['academy','applications'])->get();
                        @endphp

                        <option value="" data-id="-1">Všetky</option>

                        @foreach ($academy as $academ)
                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{request()->
                            input('academy_id')==$academ->id ? 'selected' : ''}}>{{
                            ucwords($academ->name) }}</option>
                        @endforeach
                    </x-form.search-select>
                    <x-form.search-select name="coursetype_id" title="Kurz" class="combo-b4" disabled>
                        <option value="" data-id="-1">Všetky</option>

                        @foreach ($academy as $academ)
                        <option value="" data-option="{{$academ->id}}" {{request()->
                            input('coursetype_id')==null ? 'selected' : ''}}>Všetky</option>
                        @endforeach
                        @foreach ($coursetype as $type)
                        <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                            {{request()->
                            input('coursetype_id')==$type->id ? 'selected' : ''}}>{{ ucwords($type->name) }}
                        </option>
                        @endforeach
                    </x-form.search-select> --}}

                    {{--
                </div>
            </div>
        </div>
    </div>
    <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
    </form>
    <div class="ml-auto">
        <form method="get" action="{{ route('admin.dashboard.index') }}"> --}}
            {{-- <x-slot:search>
                @csrf
                @if(request()->filled('sort_by'))
                <input type="hidden" name="sort_by" value="{{request()->input('sort_by')}}" />
                @endif
                @if(request()->filled('academy_id')&&request()->filled('coursetype_id'))
                <input type="hidden" name="academy_id" value="{{request()->input('academy_id')}}" />
                <input type="hidden" name="coursetype_id" value="{{request()->input('coursetype_id')}}" />

                @elseif(request()->filled('academy_id'))
                <input type="hidden" name="academy_id" value="{{request()->input('academy_id')}}" />
                @endif
            </x-slot:search>
            </x-form.search> --}}
            {{--
            <x-form.label name="Vyhľadávanie" />
            <input type="text" name="search" value="{{request()->input('search')}}" />
            <x-form.button>
                Hľadať
            </x-form.button>
        </form>
    </div>
    </div> --}}

    {{-- </x-slot:create> --}}




</x-setting>

<script>
    function autoExpand(field) {
        // Reset field height
        field.style.height = 'inherit';
    
        // Get the computed styles for the element
        const computed = window.getComputedStyle(field);
    
        // Calculate the height
        const height = parseInt(computed.getPropertyValue('border-top-width'), 10)
                     + parseInt(computed.getPropertyValue('padding-top'), 10)
                     + field.scrollHeight
                     + parseInt(computed.getPropertyValue('padding-bottom'), 10)
                     + parseInt(computed.getPropertyValue('border-bottom-width'), 10);
    
        field.style.height = height + 'px';
    }

    document.getElementById('sender').addEventListener('change', function() {
    var senderNameDiv = document.getElementById('senderName');
    if (this.checked) {
        senderNameDiv.style.display = 'block';
    } else {
        senderNameDiv.style.display = 'none';
    }
});

document.getElementById('who').addEventListener('change', function() {
    // Hide all sections initially
    document.getElementById('academy').style.display = 'none';
    document.getElementById('class').style.display = 'none';
    document.getElementById('instructor').style.display = 'none';
    document.getElementById('student').style.display = 'none';
    document.getElementById('course').style.display = 'none';

    // Show the relevant section based on the selected value
    switch (this.value) {
        case '1': // Študent / Študenti
            document.getElementById('student').style.display = 'block';
            break;
        case '2': // Inštruktor / Inštruktori
            document.getElementById('instructor').style.display = 'block';
            break;
        case '3': // Akadémia / Akadémie
            document.getElementById('academy').style.display = 'block';
            break;
        case '4': // Kurz / Kurzy
            document.getElementById('course').style.display = 'block';
            break;
        case '5': // Trieda / Triedy
            document.getElementById('class').style.display = 'block';
            break;
    }
});

document.querySelectorAll('.add-item-button').forEach(function(button) {
    button.addEventListener('click', function() {
        var targetId = button.getAttribute('data-target'); // Get the data-target attribute
        var select = document.getElementById(targetId); // Use the data-target value to get the select element
        var list = document.getElementById('itemsList');
        var selectedValue = select.value;
        var dataType = button.getAttribute('data-target'); // Get the data-type from the button's data-target
        var uniqueKey = `${selectedValue}-${dataType}`; // Create a unique key combining value and type
        var selectedText;

        // Get the appropriate text based on the data type
        if (dataType == 'student_id') {
            var name = document.getElementById('name').value;
            var lastName = document.getElementById('lastname').value;
            var email = document.getElementById('email').value;
            selectedText = `Študent: ${name} ${lastName} - ${email}`; 

            if (!name || !lastName || !email) {
                alert('Vyplnte meno, priezvisko a email pre študenta.');
                return; // Exit if name or lastname fields are empty
            }
        } else if (dataType  == 'instructor_id'){
            selectedText = 'Inštruktor: ' + select.options[select.selectedIndex].text;
        } else if (dataType  == 'academy_id'){
            selectedText = 'Všetci študenti akadémie: ' + select.options[select.selectedIndex].text;
        }else if (dataType  == 'coursetype_id'){
            selectedText = 'Všetci študenti inštruktorského kurzu: ' + select.options[select.selectedIndex].text;}
            else if (dataType  == 'coursetype_id2'){
            selectedText = 'Všetci študenti študentského kurzu: ' + select.options[select.selectedIndex].text;
        }else if (dataType  == 'class_id' ){
            selectedText = 'Všetci študenti triedy: ' + select.options[select.selectedIndex].text;
        }
        

        // Avoid adding duplicate entries
        if (addedItems.has(uniqueKey)) {
            alert('This item has already been added.');
            return;
        }

        var listItem = document.createElement('li');
        listItem.textContent = selectedText;
        listItem.setAttribute('data-id', selectedValue);
        listItem.setAttribute('data-type', 'academy');
        listItem.classList.add('bg-white', 'flex', 'justify-between', 'items-center', 'px-4', 'py-1', 'mt-2', 'border', 'border-gray-300', 'rounded-md', 'shadow-sm');
        var deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Delete';
        deleteBtn.setAttribute('type', 'button');
        deleteBtn.classList.add('ml-2',  'py-1', 'px-4', 'hover:bg-red-700', 'p-2', 'border' ,'border-transparent','shadow-sm','text-sm', 'font-medium', 'rounded-md' ,'text-white', 'bg-red-600' ,'hover:bg-red-700', 'focus:outline-none' ,'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-red-200');
        deleteBtn.onclick = function() {
            list.removeChild(listItem);
            addedItems.delete(uniqueKey);
            showOption(selectedValue, select, dataType);
             // Show the option again when deleted
        };

        listItem.appendChild(deleteBtn);
        list.appendChild(listItem);
        addedItems.add(uniqueKey);
        hideOption(selectedValue, select, dataType); // Hide the option when added

        var addedItemsArray = Array.from(addedItems);
        var addedItemsJson = JSON.stringify(addedItemsArray);
        document.getElementById('itemsInput').value = addedItemsJson;

        select.selectedIndex = 0; // Reset the selection if applicable
    });
});

function hideOption(value, select, type) {
    if (type !== 'student_id') {
        var option = select.querySelector('option[value="' + value + '"]');
        if (option) option.style.display = 'none';
    }
    if(document.getElementById('default').style.display != 'none') {
        document.getElementById('default').style.display = 'none'
    }
}

// Function to show an option based on type
function showOption(value, select, type) {
    if (type !== 'student_id') {
        var option = select.querySelector('option[value="' + value + '"]');
        if (option) option.style.display = 'block';
    }
    if(addedItems.size == 0) {
        document.getElementById('default').style.display = 'block'
    }
}

var addedItems = new Set(); // Initialize a new Set to track added items uniquely
document.addEventListener('DOMContentLoaded', function () {
    const infoIcons = document.querySelectorAll('.info');

    infoIcons.forEach(function(infoIcon) {
        const tooltip = infoIcon.nextElementSibling;
        let isTooltipVisible = false;

        const showTooltip = () => {
            tooltip.style.display = 'block';
            isTooltipVisible = true;
        };

        const hideTooltip = () => {
            tooltip.style.display = 'none';
            isTooltipVisible = false;
        };

        // Handle mouse hover for non-touch devices
        infoIcon.addEventListener('mouseenter', showTooltip);
        infoIcon.addEventListener('mouseleave', hideTooltip);

        // Handle touch for touch devices
        infoIcon.addEventListener('touchend', function (e) {
            e.preventDefault(); // Prevent the mouse events from firing after touch
            if (isTooltipVisible) {
                hideTooltip();
            } else {
                showTooltip();
            }
            e.stopPropagation(); // Stop the event from bubbling up to other elements
        });

        // Hide tooltip when clicking outside
        document.addEventListener('click', function (e) {
            if (!infoIcon.contains(e.target) && !tooltip.contains(e.target) && isTooltipVisible) {
                hideTooltip();
            }
        });

        // For touch screens, to ensure taps outside also hide the tooltip
        document.addEventListener('touchend', function (e) {
            if (!infoIcon.contains(e.target) && !tooltip.contains(e.target) && isTooltipVisible) {
                e.preventDefault(); // Prevent additional mouse events
                hideTooltip();
            }
        });
    });
});

document.getElementById('myForm').addEventListener('submit', function(event) {
    var addedItemsArray = Array.from(addedItems);  // Convert Set to Array
    var addedItemsJson = JSON.stringify(addedItemsArray);  // Convert Array to JSON String
    document.getElementById('itemsInput').value = addedItemsJson;  // Set the value of the hidden input
});





</script>