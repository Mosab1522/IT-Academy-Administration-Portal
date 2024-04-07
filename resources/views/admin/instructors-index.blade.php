@if(session('instructor_id'))
@php
session()->forget('instructor_id');
@endphp
@endif
<x-flash />
<x-layout />
<x-setting heading="Inštruktori" ctitle="inštruktora" etitle="i inštruktori">
    <x-slot:create>
        <form action="/admin/instructors/create" method="post" enctype="multipart/form-data">
            @csrf
            <x-form.input name="name" type="text"/>
            <x-form.input name="lastname" type="text"/>
            <x-form.input name="email" type="email"/>
            <x-form.input name="sekemail" type="email"/>
    
            <input type="file" name="photo">
           
            <x-form.input name="telephone" type="tel"/>
    
    
            <x-form.input name="ulicacislo" type="text"/>
            <x-form.input name="mestoobec" type="text"/>
            <x-form.input name="psc" type="text"/>
    
    
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
                    <div class="selects-pair" data-pair-id="1">
                        <select name="academy_id[]" id="academy" class="academy-select" data-pair-id="1"
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
    
                        </select><select name="coursetypes_id[]" id="coursetype" class="coursetype-select" data-pair-id="1">
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
                        {{-- <button class="remove-selects-btn" data-pair-id="1">Remove</button> --}}
                    </div>
                </div>
                <button type="button" id="add-selects-btn">Add selects pair</button>
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
            </x-slot:create>
            <div class="flex mt-3">
            <form method="get" action="{{ route('admin.instructors.index') }}">
                @csrf

                @if(request()->filled('search'))
                <input type="hidden" name="search" value="{{request()->input('search')}}" />
                @endif
                <div class="flex">
                    <div class="">
                        <x-form.label name="Zoradiť podľa" />
                        <select class="form-control" id="orderBy" name="orderBy">
                            <option value="created_at" {{request()->input('orderBy')=='created_at' ? 'selected' :
                                ''}}>Dátumu vytvorenia</option>
                            <option value="updated_at" {{request()->input('orderBy')=='updated_at' ? 'selected' :
                                ''}}>Dátumu poslednej úpravy</option>
                        </select>
                    </div>
                    <div class="px-6">
                        <x-form.label name="Smer zoradenia" /> <select class="form-control" id="orderDirection"
                            name="orderDirection">
                            <option value="desc" {{request()->input('orderDirection')=='desc' ? 'selected' : ''}}>Od
                                najnovšej
                            </option>
                            <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Od
                                najstaršej
                            </option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <select class="form-control" id="filterBy" name="filterBy[]" multiple>
                            <option value="academy_id|1">Akadémia 1</option>
                            <option value="academy_id|2">Akadémia 2</option>
                            <option value="coursetype_id|1">Typ kurzu 1</option>
                            <option value="coursetype_id|2">Typ kurzu 2</option>
                        </select>
                    </div> --}}
                    <div>
                        <x-form.label name="Filtrovať podľa" />
                        <div class="flex">
                            <div>
                                <select name="academy_id" class="combo-a" data-nextcombo=".combo-b">
                                    <option value="" disabled selected hidden>Akadémia</option>
                                    @php
                                    $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                    ->get();
                                    $coursetype = \App\Models\CourseType::with(['academy','applications'])->get();
                                    @endphp

                                    <option value="" data-option="-1">Všetky</option>

                                    @foreach ($academy as $academ)
                                    <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                        {{request()->input('academy_id')==$academ->id ? 'selected' : ''}}>{{
                                        ucwords($academ->name) }}</option>
                                    @endforeach
                                </select>
                                <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled>
                                    <option value="" disabled selected hidden>Typ kurzu</option>

                                    @foreach ($academy as $academ)
                                    <option value="" data-option="{{$academ->id}}" {{request()->
                                        input('coursetype_id')==null ? 'selected' : ''}}>Všetky</option>
                                    @endforeach
                                    @foreach ($coursetype as $type)
                                    <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                        data-option="{{ $type->academy_id }}" {{request()->
                                        input('coursetype_id')==$type->id ? 'selected' : ''}}>{{ ucwords($type->name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
            </form>
            <div class="ml-auto">
                <form method="get" action="{{ route('admin.instructors.index') }}">
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
                    <x-form.label name="Vyhľadávanie" />
                    <input type="text" name="search" value="{{request()->input('search')}}" />
                    <x-form.button>
                        Hľadať
                    </x-form.button>
                </form>
            </div>
        </div>
        
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-6 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto relative ">
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