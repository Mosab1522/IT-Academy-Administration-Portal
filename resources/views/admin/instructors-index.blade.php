@if(session('instructor_id'))
@php
session()->forget('instructor_id');
@endphp
@endif

<x-layout />
<x-setting heading="Inštruktori" etitle="Existujúci inštruktori">
    <x-slot:create>
        <div class="flex flex-col">
            <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie inštruktora</h3>
        <form action="/admin/instructors/create" method="post" enctype="multipart/form-data">
            @csrf
            <x-form.required class="-mt-3"/>
            <div class="flex justify-between mt-6">
                <!-- Left side with input fields -->
                <div class="w-full ">
                    
                        <x-form.input name="name" type="text" title="Meno" placeholder="Meno" required="true"/>
                    
                    <x-form.field>
                        <x-form.input name="lastname" type="text" title="Priezvisko" placeholder="Priezvisko" required="true"/>
                    </x-form.field>
                    <div class="mt-6 hidden md:block">
                        <x-form.input name="email" type="email" title="Email" placeholder="Email" required="true"/>
                    </div>
                    <div class="mt-6 hidden lg:block">
                        <x-form.input name="sekemail" type="email" title="Sekundárny email" placeholder="Sekundárny email"/>
                    </div>
                    
                    <!-- Add other input fields here as needed -->
                </div>
            
                <!-- Right Column for Profile Image -->
                <div class="w-auto flex justify-center pl-6 md:px-6">
                    <div class="flex-shrink-0"> 
                        <x-form.label name="photo" title="Profilová fotka"/>
                        <div class="h-32 w-32 md:h-52 md:w-52 lg:h-80 lg:w-80 rounded-lg bg-gray-300 overflow-hidden relative mt-1 border">
                            <img class="shadow-xl rounded-lg w-full h-full object-cover" data-default-src="{{ asset('storage/photos/basic.jpg') }}" src="{{ asset('storage/photos/basic.jpg') }}" alt="profile_image">
                            <label for="photo-upload" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white opacity-0 hover:opacity-100 rounded-lg cursor-pointer">
                                <span class="text-center text-sm">Zmeniť fotku</span>
                            </label>
                            <input type="file" id="photo-upload" name="photo" class="hidden" onchange="handleFileUpload(event)">
                        </div>
                    </div>
                    
                      
                        <button id="photobutton-c" type="reset" class="hidden mt-6 ml-2 flex-none bg-gray-400 text-white text-xs uppercase py-1 px-3 md:px-1 rounded-md hover:bg-gray-500 transition-colors duration-200">
                            <span class="hidden md:inline">Vymazať</span>
                            <span  class="inline md:hidden">X</span>
                        </button>
                    
                </div>
            </div>
                
               
                    {{-- <x-form.field>
                    <input type="file" name="photo" id="photo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" accept="image/*">
                    </x-form.field> --}}
                    <div class="mt-6 md:hidden">
                        <x-form.input name="cemail" type="email" title="Email" placeholder="Email"/>
                   </div>
                    <div class="mt-6 lg:hidden">
                        <x-form.input name="csekemail" type="email" title="Sekundárny email" placeholder="Sekundárny email"/>
                    </div>
           
                   <div class="mt-6 lg:mt-0">
                        <x-form.input class="" name="telephone" type="tel" title="Telefonné číslo" placeholder="Telefonné číslo"/>
                      </div>  
            <x-form.field>
                <x-form.input name="ulicacislo" type="text" title="Ulica a popisné číslo" placeholder="Ulica a popisné číslo"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="mestoobec" type="text" title="Mesto / Obec" placeholder="Mesto / Obec"/></x-form.field>
                <x-form.field>

                <x-form.input name="psc" type="text" title="PSČ" placeholder="PSČ"/>
                </x-form.field>
    
    
            {{-- <x-form.field>
                <div class="flex">
                    <div>
                        <x-form.label name="akadémia" />
                        <!-- parent -->
                        <select name="academy_id[1]" class="combo-a1" data-nextcombo=".combo-b1">
                            <option value="" disabled selected hidden>Akadémia</option>
                            @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            @endphp
                            @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                {{old('academy_id')==$academ->id ? 'selected' : ''}}>{{
                                ucwords($academ->name)}}</option>
                            @endforeach
                            {{-- <option value="" disabled selected hidden>Akadémia</option>
                            <option value="1" data-id="1" data-option="-1">Cisco</option>
                            <option value="2" data-id="2" data-option="-1">Adobe</option>
                        </select>
                    </div>
                    <div class="ml-4">
                        <x-form.label name="typ kurzu" />
                        <!-- child -->
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c"
                            disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            <option value="1" data-id="1" data-option="1">Lahky</option>
                            <option value="2" data-id="2" data-option="1">Stredny</option>
                            <option value="3" data-id="3" data-option="2">Photoshop</option>
                            <option value="4" data-id="4" data-option="2">Illustrator</option>
                        </select>
                        <select name="coursetypes_id[1]" id="coursetypes_id[1]" class="combo-b1" disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            {{-- @php
                            $academy = \App\Models\CourseType::all();
                            @endphp
                            @foreach (\App\Models\CourseType::with(['academy', 'applications'])->get() as $type)
                            <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                                {{old('coursetype_id')==$type->id ? 'selected' : ''}}>{{
                                ucwords($type->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </x-form.field> --}}
            @php
            $academy = \App\Models\Academy::all();
        $coursetypes = \App\Models\CourseType::all();
        @endphp
            <x-form.field>
                <div id="selects-container">
                    <x-form.label name="academy_id" title="Pridať správu kurzov"/>
                    <div class="selects-pair flex items-center justify-between mb-4" data-pair-id="1">
                        <select name="academy_id[]" id="academy" class="academy-select mt-1 flex-1 block  w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6" data-pair-id="1"
                            >{{--setValue(this.value)--}}
                            <option value="" {{ old('academy_id') ? '' : 'selected' }}>Akadémia</option>
                            {{-- @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            @endphp --}}
                            @foreach ($academy as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{
                                old('academy_id.0')==$academ->id ? 'selected' : '' }}>{{ ucwords($academ->name) }}</option>
                            @endforeach
    
                        </select><select name="coursetypes_id[]" id="coursetype" class="coursetype-select mt-1 flex-1 block  w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6" data-pair-id="1" disabled>
                            <option value="" data-option="" {{ old('coursetype_id') ? '' : 'selected' }}>Typ kurzu
                            </option>
                            {{-- @php
                            $academy = \App\Models\CourseType::all();
                            @endphp --}}
                            @foreach ($coursetypes as $type)
                            <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                                {{ old('coursetype_id.0')==$type->id ? 'selected' : '' }}>{{ ucwords($type->name) }}</option>
                            @endforeach
                        </select>
                     {{-- <button class="remove-selects-btn text-white bg-red-500 hover:bg-red-700 p-2 rounded ml-4" data-pair-id="1">Remove</button>  --}} 
                     <button type="button" id="add-selects-btn" class="ml-2 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-200">
                        <span class="hidden lg:inline">
                            Pridať ďaľší pár
                        </span>
                        <span class="inline lg:hidden">
                            +
                        </span>
                    </button>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                   
                </div>
            </x-form.field>
    
            {{-- <select id="academy" onchange="setValue(this.value)">
                <option value="" {{ old('academy_id') ? '' : 'selected' }}>Akadémia</option> --}}
                {{-- @php
                $academy = \App\Models\Academy::with(['coursetypes','applications'])
                ->get();
                @endphp --}}
                {{-- @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{
                    old('academy_id')==$academ->id ? 'selected' : '' }}>{{ ucwords($academ->name) }}</option>
                @endforeach
            </select>
            <select id="coursetype">
                <option value="" data-option="" {{ old('coursetype_id') ? '' : 'selected' }}>Typ kurzu</option> --}}
                {{-- @php
                $academy = \App\Models\CourseType::all();
                @endphp --}}
    
                {{-- @foreach (\App\Models\CourseType::with(['academy', 'applications'])->get() as $type)
                <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}" {{
                    old('coursetype_id')==$type->id ? 'selected' : '' }}>
                    {{ ucwords($type->name) }}</option>
                @endforeach
            </select> --}}
    
            {{-- <x-form.field>
                <div class="flex">
                    <div>
                        <x-form.label name="akadémia" />
                        <!-- parent -->
                        <select name="academy_id[2]" class="combo-a2" data-nextcombo=".combo-b2">
                            <option value="" disabled selected hidden>Akadémia</option>
                            @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            @endphp
                            @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                {{old('academy_id')==$academ->id ? 'selected' : ''}}>{{
                                ucwords($academ->name)}}</option>
                            @endforeach
                            {{-- <option value="" disabled selected hidden>Akadémia</option>
                            <option value="1" data-id="1" data-option="-1">Cisco</option>
                            <option value="2" data-id="2" data-option="-1">Adobe</option>
                        </select>
                    </div>
                    <div class="ml-4">
                        <x-form.label name="typ kurzu" />
                        <!-- child -->
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c"
                            disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            <option value="1" data-id="1" data-option="1">Lahky</option>
                            <option value="2" data-id="2" data-option="1">Stredny</option>
                            <option value="3" data-id="3" data-option="2">Photoshop</option>
                            <option value="4" data-id="4" data-option="2">Illustrator</option>
                        </select>
                        <select name="coursetypes_id[2]" id="coursetypes_id[2]" class="combo-b2" disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            {{-- @php
                            $academy = \App\Models\CourseType::all();
                            @endphp
                            @foreach (\App\Models\CourseType::with(['academy', 'applications'])->get() as $type)
                            <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                                {{old('coursetype_id')==$type->id ? 'selected' : ''}}>{{
                                ucwords($type->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </x-form.field> --}}
    
            <x-form.button class="mt-2 md:w-auto w-full sm:w-auto">
                Odoslať
            </x-form.button>
        </form>
            </div>
        </div>
    </x-slot:create>
    <x-form.search action="{{ route('admin.instructors.index') }}" text="Filtrovať a zoradiť">
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
                    {{-- <div class="form-group">
                        <select class="form-control" id="filterBy" name="filterBy[]" multiple>
                            <option value="academy_id|1">Akadémia 1</option>
                            <option value="academy_id|2">Akadémia 2</option>
                            <option value="coursetype_id|1">Typ kurzu 1</option>
                            <option value="coursetype_id|2">Typ kurzu 2</option>
                        </select>
                    </div> --}}
                    <x-form.search-select name="academy_id" title="Akadémia" class=" combo-a4" data-nextcombo=".combo-b4">
                                
                        <!-- parent -->
                        {{-- <select name="academy_id" class="combo-a" data-nextcombo=".combo-b"> --}}
            
                            
                            <option value="" data-option="-1" selected>Všetky</option>
                            {{-- @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            @endphp --}}
                            @foreach ($academy as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{--
                                {{old('academy_id')==$academ->id ? 'selected' : ''}} --}}
                                >{{
                                ucwords($academ->name)}}</option>
                            @endforeach
                            {{-- <option value="" disabled selected hidden>Akadémia</option>
                            <option value="1" data-id="1" data-option="-1">Cisco</option>
                            <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                        </x-form.search-select>
                    
                        <x-form.search-select name="coursetype_id" title="Kurz" class="combo-b4" disabled>
                            <option value=""  data-id="-1">Všetky</option>
            
                            @foreach ($academy as $academ)
                        <option value="" data-option="{{$academ->id}}" {{request()->input('coursetype_id')==null
                            ? 'selected' : ''}}>Všetky</option>
                        @endforeach
                        <!-- child -->
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c"
                            disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            <option value="1" data-id="1" data-option="1">Lahky</option>
                            <option value="2" data-id="2" data-option="1">Stredny</option>
                            <option value="3" data-id="3" data-option="2">Photoshop</option>
                            <option value="4" data-id="4" data-option="2">Illustrator</option>
                        </select> --}}
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled> --}}
                            
                            {{-- @php
                            $academy = \App\Models\CourseType::all();
                            @endphp --}}
                            @foreach ($coursetypes as $type)
                            <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                data-option="{{ $type->academy_id }}" {{-- {{old('coursetype_id')==$type->id ?
                                'selected' : ''}} --}}
                                >{{
                                ucwords($type->name) }}</option>
                            @endforeach
                        </x-form.search-select>
               
                        <x-slot:search>
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
                </x-slot:search>
            </x-form.search>
        
            <x-single-table>
                <x-slot:head>
                                <th scope="col" class="py-3 px-6">Fotka</th>
                                <th scope="col" class="py-3 px-6">Meno</th>
                                <th scope="col" class="py-3 px-6">Kurzy v správe</th>
                                <th scope="col" class="py-3 px-6">Aktuálne triedy</th>
                                <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">Akcie</th>
                            </x-slot:head>
                            @foreach ($instructors as $instructor)
                            <tr
                            class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                <td class="py-4 px-6">
                                    <div class="flex-shrink-0">
                                        <div class="h-20 w-20 rounded-lg bg-gray-300 overflow-hidden relative">
                                            <img class="shadow-xl rounded-lg w-full h-full object-cover"  src="{{asset('storage/' . $instructor->photo)}}" alt="profile_image">
                                         
                                        </div>
                                    </div>
                               
                                </td>
                                <td class="py-4 px-6"><x-table.td url="instructors/{{ $instructor->id }}">{{$instructor->name}} {{$instructor->lastname}}</x-table.td></td>
                                <td class="py-4 px-6">
                                    @foreach($instructor->coursetypes as $coursetype) 
                                     <x-table.td url="coursetypes/{{ $coursetype->id }}">
                                    {{$coursetype->name}} - {{$coursetype->type == '0' ? 'študentský' :
                                    'inštruktorský'}}
                                    </x-table.td><br>
                                    @endforeach
                                </td>
                                <td class="py-4 px-6">
                                    @foreach($instructor->classes as $class)
                                    <x-table.td url="classes/{{ $class->id }}">
                                    {{$class->name}}
                                    </x-table.td>
                                    <br>
                                    @endforeach
                                </td>
                                <x-table.td-last url="instructors/{{ $instructor->id }}" edit=1 itemName="inštruktora {{$instructor->name}} {{$instructor->lastname}}? Spolu sním sa vymažú aj jeho triedy. Ak tomu chcete zabrániť, zmeňte inštruktora týmto triedam." />
                               
                            </tr>
                            @endforeach
                        </x-single-table>
    

</x-setting>

<script>
   
document.addEventListener('DOMContentLoaded', function() {
    const image = document.querySelector('img[alt="profile_image"]');
    const fileInput = document.getElementById("photo-upload");
    const buttonC = document.getElementById("photobutton-c");

    // Handle file upload
    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        if (file) {
            reader.onloadend = function () {
                image.src = reader.result;
                buttonC.style.display = "block";
            };
            reader.readAsDataURL(file);
        } else {
            // Optional: handle the case where no file is selected, if needed
        }
    });

    // Handle the clear action
    buttonC.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default form reset behavior

        fileInput.value = ""; // Clear the file input
        image.src = image.getAttribute('data-default-src'); // Reset the image preview
        buttonC.style.display = "none"; // Hide the button
    });
});


// document.getElementById("photobutton-c").addEventListener("click", function(event) {
//     // Prevent the default form reset behavior
//     event.preventDefault();

//     // Clear the file input
//     var fileInput = document.getElementById("photo-upload");
//     fileInput.value = "";

//     // Reset the image preview to the default image stored in `data-default-src`
//     var image = document.querySelector('img[alt="profile_image"]');
//     var defaultSrc = image.getAttribute('data-default-src'); // Get the default src
//     image.src = defaultSrc;

//     // Hide the buttons again
//     document.getElementById("photobutton").style.display = "none";
//     document.getElementById("photobutton-c").style.display = "none";

//     // Manually reset other fields as needed
// });
    </script>
 