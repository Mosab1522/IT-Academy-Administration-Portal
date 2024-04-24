<x-flash />
<x-layout />
<x-setting heading="Triedy" etitle="Existujúce triedy">
    <x-slot:create>
        <div class="flex flex-col">
            <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie triedy</h3>
                <form action="/admin/classes/create" method="post">
                    @csrf
                    <x-form.input-check name="students" title="Zapísať všetkých študentov ktorí majú
                    prihlášku na kurz"/>
                    <x-form.field>
                        <x-form.input name="name" type="text" title="Názov" placeholder="Názov" />
                    </x-form.field>
                    <x-form.field>

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

                        <div class="mt-6 hidden" id="inst">

                            <div class="w-1/2 mr-2">
                                <x-form.select name="academy_id" title="Akadémia" class=" combo-a"
                                    data-nextcombo=".combo-b">
                                    <!-- parent -->
                                    {{-- <select name="academy_id" class="combo-a" data-nextcombo=".combo-b"> --}}
                                        <option value="" disabled selected hidden>Akadémia</option>
                                        {{-- @php
                                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                        ->get();
                                        @endphp --}}
                                        @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                                        ->get() as $academ)
                                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                            {{-- {{old('academy_id')==$academ->id ? 'selected' : ''}} --}}
                                            >{{
                                            ucwords($academ->name)}}</option>
                                        @endforeach
                                        {{-- <option value="" disabled selected hidden>Akadémia</option>
                                        <option value="1" data-id="1" data-option="-1">Cisco</option>
                                        <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                                </x-form.select>
                            </div>
                            <div class="w-1/2 ml-2">
                                <x-form.select name="coursetype_id" title="Kurz" class="combo-b" disabled>

                                    <!-- child -->
                                    {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b"
                                        data-nextcombo=".combo-c" disabled>
                                        <option value="" disabled selected hidden>Typ kurzu</option>
                                        <option value="1" data-id="1" data-option="1">Lahky</option>
                                        <option value="2" data-id="2" data-option="1">Stredny</option>
                                        <option value="3" data-id="3" data-option="2">Photoshop</option>
                                        <option value="4" data-id="4" data-option="2">Illustrator</option>
                                    </select> --}}
                                    {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled> --}}
                                        <option value="" disabled selected hidden>Typ kurzu</option>
                                        {{-- @php
                                        $academy = \App\Models\CourseType::all();
                                        @endphp --}}
                                        @foreach(\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [1,2])->get() as $type)
                                        <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                            data-option="{{ $type->academy_id }}" {{-- {{old('coursetype_id')==$type->id
                                            ?
                                            'selected' : ''}} --}}
                                            >{{
                                            ucwords($type->name) }}</option>
                                        @endforeach
                                </x-form.select>
                            </div>

                        </div>


                        <div class="mt-6 hidden" id="stud">

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
                    </x-form.field>
                    <x-form.field>

                        <x-form.select name="days" title="Dni">

                            <option value="" disabled selected hidden>Dni výučby</option>
                            <option value="1" {{old('days')==1 ? 'selected' : '' }}>Týždeň</option>
                            <option value="2" {{old('days')==2 ? 'selected' : '' }}>Víkend</option>
                            <option value="3" {{old('days')==3 ? 'selected' : '' }}>Nezáleží</option>
                            {{-- <option value="1" data-id="1" data-option="2">Týždeň</option>
                            <option value="1" data-id="1" data-option="3">Týždeň</option>
                            <option value="2" data-id="2" data-option="3">Víkend</option>
                            <option value="3" data-id="3" data-option="3">Nezáleží</option>
                            <option value="1" data-id="1" data-option="4">Týždeň</option> --}}
                        </x-form.select>
                    </x-form.field>
                    <x-form.field>
                        <x-form.select name="time" title="Čas">

                            <option value="" disabled selected hidden>Čas výučby</option>
                            <option value="1" {{old('time')==1 ? 'selected' : '' }}>Ranný</option>
                            <option value="2" {{old('time')==3 ? 'selected' : '' }}>Poobedný</option>
                            <option value="3" {{old('time')==3 ? 'selected' : '' }}>Nezáleží</option>
                            {{-- <option value="1" data-id="1" data-option="2">Ranný</option>
                            <option value="4" data-id="1" data-option="3">Ranný (Týždeň/Víkend)</option>
                            <option value="5" data-id="2" data-option="3">Poobedný (Týždeň)</option>
                            <option value="3" data-id="3" data-option="3">Nezáleží</option>
                            <option value="1" data-id="1" data-option="4">Ranný</option> --}}
                        </x-form.select>

                    </x-form.field>

                    <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                        Odoslať
                    </x-form.button>
                </form>
            </div>
        </div>
    </x-slot:create>
    <x-form.search action="{{ route('admin.coursetypes.index') }}" text="Filtrovať a zoradiť">
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
        <x-form.search-select name="academy_id" title="Akadémia">
            <option value="" disabled selected hidden>Akadémia</option>
            @php
            $academy = \App\Models\Academy::with(['coursetypes','applications'])
            ->get();
            $coursetype = \App\Models\CourseType::with(['academy','applications'])->get();
            @endphp

            <option value="" data-option="-1">Všetky</option>

            @foreach ($academy as $academ)
            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{request()->
                input('academy_id')==$academ->id ? 'selected' : ''}}>{{
                ucwords($academ->name) }}</option>
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
                        
                            <th scope="col" class="py-3 px-6">Názov triedy</th>
                            <th scope="col" class="py-3 px-6">Kurz</th>
                            <th scope="col" class="py-3 px-6">Inštruktor</th>
                            <th scope="col" class="py-3 px-6">Dni / čas</th>
                            <th scope="col" class="py-3 px-6">Počet študentov</th>
                            <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">Akcie</th>
                        </x-slot:head>
                        @foreach ($classes as $class)
                        <tr
                            class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                            <td class="py-4 px-6"><x-table.td url="classes/{{ $class->id }}">{{$class->name}}</x-table.td></td>
                            <td class="py-4 px-6">
                                <x-table.td url="coursetypes/{{ $class->coursetype->id }}">
                                {{$class->coursetype->name}} - {{$class->coursetype->type==0 ? 'študentský' :
                                'inštruktorský'}} ({{$class->academy->name}} akadémia)
                                </x-table.td>
                            </td>
                            <td class="py-4 px-6"><x-table.td url="instructors/{{ $class->instructor->id }}">
                                {{$class->instructor->name}} {{$class->instructor->lastname}}
                                </x-table.td></td>
                            <td class="py-4 px-6">
                                {{$class->days== 1 ? 'Týždeň' : ''}} {{$class->days== 2 ? 'Víkend' : ''}}
                                {{$class->days== 3 ? 'Nezáleží' : ''}} / {{$class->time== 1 ? 'Ranný' : ''}}
                                {{$class->time== 2 ? 'Poobedný' : ''}} {{$class->time== 3 ? 'Nezáleží' : ''}}
                            </td>
                            <td class="py-4 px-6">{{$class->students->count()}}</td>
                            <x-table.td-last url="classes/{{ $class->id }}" delete=1 itemName="triedu {{$class->name}}" />
                            
                        </tr>
                        @endforeach
                    </x-single-table>

</x-setting>