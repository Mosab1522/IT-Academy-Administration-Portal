@if(session('instructor_id'))
@php
session()->forget('instructor_id');
@endphp
@endif
<x-flash />
<x-layout />
<x-setting heading="Inštruktori" etitle="Existujúci inštruktori">
    <x-slot:create>
        <div class="flex flex-col">
            <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie inštruktora</h3>
        <form action="/admin/instructors/create" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex justify-between">
                <!-- Left side with input fields -->
                <div class="w-1/2 ">
                    
                        <x-form.input name="name" type="text" title="Meno" placeholder="Meno"/>
                    
                    <x-form.field>
                        <x-form.input name="lastname" type="text" title="Priezvisko" placeholder="Priezvisko"/>
                    </x-form.field>
                    <x-form.field>
                        <x-form.input name="email" type="email" title="Email" placeholder="Email"/>
                    </x-form.field>
                    <x-form.field>
                        <x-form.input name="sekemail" type="email" title="Sekundárny email" placeholder="Sekundárny email"/>
                        </x-form.field>
                    <!-- Add other input fields here as needed -->
                </div>
            
                <!-- Right Column for Profile Image -->
                <div class="w-1/2 flex justify-center items-center">
                    <div class="relative">
                        <div class="mb-2">
                            <x-form.label name="photo-upload" title="Profilová fotka"/>
                        </div>
                        <div class="relative flex justify-center items-center w-72 h-72">
                            <img src="{{ asset('storage/photos/basic.jpg') }}" alt="profile_image" id="image-preview" class="shadow-2xl rounded-xl w-full h-full object-cover" data-default-src="{{ asset('storage/photos/basic.jpg') }}" />
                            <label for="photo-upload" class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 text-white opacity-0 hover:opacity-100 cursor-pointer rounded-xl">
                                Zmeniť fotku
                            </label>
                            <input type="file" id="photo-upload" name="photo" class="hidden" accept="image/*" onchange="handleFileUpload(event)"/>
                        </div>
                    </div>
                </div>
            </div>
                
               
                    {{-- <x-form.field>
                    <input type="file" name="photo" id="photo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" accept="image/*">
                    </x-form.field> --}}
            <x-form.field>
            <x-form.input name="telephone" type="tel" title="Telefonné číslo" placeholder="Telefonné číslo"/>
            </x-form.field>
    
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
    
            <x-form.field>
                <div id="selects-container">
                    <x-form.label name="academy_id" title="Pridať správu kurzov"/>
                    <div class="selects-pair flex items-center justify-between mb-6" data-pair-id="1">
                        <select name="academy_id[]" id="academy" class="academy-select bg-white border border-gray-300 rounded-md text-gray-700 p-2 flex-1 mr-2" data-pair-id="1"
                            >{{--setValue(this.value)--}}
                            <option value="" {{ old('academy_id') ? '' : 'selected' }}>Akadémia</option>
                            {{-- @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            @endphp --}}
                            @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{
                                old('academy_id.0')==$academ->id ? 'selected' : '' }}>{{ ucwords($academ->name) }}</option>
                            @endforeach
    
                        </select><select name="coursetypes_id[]" id="coursetype" class="coursetype-select bg-white border border-gray-300 rounded-md text-gray-700 p-2 flex-1 mx-2" data-pair-id="1">
                            <option value="" data-option="" {{ old('coursetype_id') ? '' : 'selected' }}>Typ kurzu
                            </option>
                            {{-- @php
                            $academy = \App\Models\CourseType::all();
                            @endphp --}}
                            @foreach (\App\Models\CourseType::with(['academy', 'applications'])->get() as $type)
                            <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                                {{ old('coursetype_id.0')==$type->id ? 'selected' : '' }}>{{ ucwords($type->name) }}</option>
                            @endforeach
                        </select>
                     {{-- <button class="remove-selects-btn text-white bg-red-500 hover:bg-red-700 p-2 rounded ml-4" data-pair-id="1">Remove</button>  --}} 
                     <button type="button" id="add-selects-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add selects pair
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
    
            <x-form.button>
                Odoslať
            </x-form.button>
        </form>
            </div>
        </div>
            </x-slot:create>
            <div class="bg-white p-6 rounded-lg shadow mb-4 flex justify-between items-end">
                <form method="get" action="{{ route('admin.instructors.index') }}" class="flex flex-wrap items-end">
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
                        {{-- <select name="academy_id" class="combo-a" data-nextcombo=".combo-b"> --}}@php
            $academy = \App\Models\Academy::with(['coursetypes','applications'])
            ->get();
            $coursetype = \App\Models\CourseType::with(['academy','applications'])->get();
            @endphp
                            
                            <option value="" data-option="-1" selected>Všetky</option>
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
                            @foreach (\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [1,
                            2])->get() as $type)
                            <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                data-option="{{ $type->academy_id }}" {{-- {{old('coursetype_id')==$type->id ?
                                'selected' : ''}} --}}
                                >{{
                                ucwords($type->name) }}</option>
                            @endforeach
                        </x-form.search-select>
               
                    <x-form.button class="ml-2">Filtrovať a zoradiť</x-form.button>
</form>
           
        <form method="get" action="{{ route('admin.instructors.index') }}" class="flex flex-wrap items-end">
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
                    <div class="w-full md:w-auto md:mr-4 mt-4 md:mt-0">

                        <input type="text" name="search" value="{{old('search')}}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                            placeholder="Vyhľadávanie">
                    </div>
                    <x-form.button class="ml-2">Hľadať</x-form.button>
        
                </form>
            </div>
        
            <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                <div class="py-6 align-middle inline-block min-w-full sm:px-6 lg:px-8 ">
                    <div class="overflow-x-auto relative rounded-lg shadow">
                        <table class="w-full text-sm text-left text-gray-800 dark:text-gray-800 shadow-md">
                            <thead class="text-xs uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="py-3 px-6">Fotka</th>
                                <th scope="col" class="py-3 px-6">Meno</th>
                                <th scope="col" class="py-3 px-6">Kurzy v správe</th>
                                <th scope="col" class="py-3 px-6">Aktuálne triedy</th>
                                <th scope="col" class="py-3 px-6 w-40">Akcie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instructors as $instructor)
                            <tr
                                class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                <td class="py-4 px-6">
                                <img style="
                                            width: 100px; 
                                            height: 100px; 
                                            object-fit: cover;
                                            object-position: 25% 25%;" class="rounded-xl "
                                                src="{{asset('storage/' . $instructor->photo)}}" alt="">
                                </td>
                                <td class="py-4 px-6">{{$instructor->name}} {{$instructor->lastname}}</td>
                                <td class="py-4 px-6">
                                    @foreach($instructor->coursetypes as $coursetype)
                                    {{$coursetype->name}} - {{$coursetype->type == '0' ? 'študentský' :
                                    'inštruktorský'}}<br>
                                    @endforeach
                                </td>
                                <td class="py-4 px-6">
                                    @foreach($instructor->classes as $class)
                                    {{$class->name}}<br>
                                    @endforeach
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="/admin/instructors/{{ $instructor->id }}"
                                        class="text-blue-600 hover:text-blue-700 hover:underline ">Upraviť</a>
                                        &nbsp;
                                    <form method="POST" action="/admin/instructors/{{ $instructor->id }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 hover:underline ">Vymazať</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
    
    
            </div>
        </div>
    

</x-setting>

<script>
    function handleFileUpload(event) {
    var image = document.querySelector('img[alt="profile_image"]');
    var file = event.target.files[0];
    const button = document.getElementById("photobutton");
    const button_c = document.getElementById("photobutton-c");
    var reader = new FileReader();

    if (file) {
        reader.onloadend = function () {
            image.src = reader.result;
        };
        reader.readAsDataURL(file);
        button.style.display = "block";
        button_c.style.display = "block";
    }
    // If no file is selected, do nothing
}
document.getElementById("photobutton-c").addEventListener("click", function(event) {
    // Prevent the default form reset behavior
    event.preventDefault();

    // Clear the file input
    var fileInput = document.getElementById("photo-upload");
    fileInput.value = "";

    // Reset the image preview to the default image stored in `data-default-src`
    var image = document.querySelector('img[alt="profile_image"]');
    var defaultSrc = image.getAttribute('data-default-src'); // Get the default src
    image.src = defaultSrc;

    // Hide the buttons again
    document.getElementById("photobutton").style.display = "none";
    document.getElementById("photobutton-c").style.display = "none";

    // Manually reset other fields as needed
});
    </script>
 