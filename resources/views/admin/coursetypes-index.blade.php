<x-flash />
<x-layout />
<x-setting heading="Typy kurzov" etitle="Existujúce kurzy">
    <x-slot:create>
        <div class="flex flex-col">
            <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie kurzu</h3>
        <form action="/admin/coursetypes/create" method="post">
            @csrf
            <x-form.field>
            <x-form.input name="name" type="text" title="Názov" placeholder="Názov"/>
            </x-form.field>

            
                <div class="items-center mt-6">
                    <x-form.label name="type" title="Typ kurzu" />

                    <div class="flex items-center mt-1">
                        <x-form.input-radio name="type" for="type_student" value="0">
                            Študentský
                        </x-form.input-radio>
                        
                        <x-form.input-radio class="ml-6" name="type" for="type_instructor" value="1">
                            Inštruktorský
                        </x-form.input-radio>
                    
                        <x-form.input-radio class="ml-6" name="type" for="type_both" value="2">
                            Obidva
                        </x-form.input-radio>
                       
                    </div>
                    
                </div>
                <x-form.field>
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
            </x-form.field>
            <x-form.field>
            <x-form.input name="min" type="number" title="Minimum študentov" placeholder="Minimum"/>
            </x-form.field>
            <x-form.field>
            <x-form.input name="max" type="number" title="Maximum študentov" placeholder="Maximum"/>
            </x-form.field>
            <x-form.button class="mt-6">
                Odoslať
            </x-form.button>
        </form>
            </div>
        </div>
    </x-slot:create>
    <div class="bg-white p-6 rounded-lg shadow mb-4 flex justify-between items-end">
        <form method="get" action="{{ route('admin.coursetypes.index') }}" class="flex flex-wrap items-end">
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
                <x-form.search-select name="academy_id" title="Akadémia">
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
                            
                </x-form.search-select>
            <x-form.button class="ml-2">Filtrovať a zoradiť</x-form.button>
        </form>
        
            <form method="get" action="{{ route('admin.coursetypes.index') }}" class="flex flex-wrap items-end">
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
                            <th scope="col" class="py-3 px-6">Názov kurzu</th>
                            <th scope="col" class="py-3 px-6">Akadémia</th>
                            <th scope="col" class="py-3 px-6">Typ kurzu</th>
                            <th scope="col" class="py-3 px-6">Min/max študentov</th>
                            <th scope="col" class="py-3 px-6">Inštruktori</th>
                            <th scope="col" class="py-3 px-6">Triedy</th>
                            <th scope="col" class="py-3 px-6">Počet prihlášok</th>
                            <th scope="col" class="py-3 px-6 w-40">Akcie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coursetypes as $coursetype)
                        <tr class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                            <td class="py-4 px-6">{{$coursetype->name}}</td> 
                            <td class="py-4 px-6">{{$coursetype->academy->name}}</td>
                            <td class="py-4 px-6">
                                {{$coursetype->type=='0'? 'študentský' : 'inštruktorský'}}
                            </td>
                            <td class="py-4 px-6">{{$coursetype->min}} / {{$coursetype->max}}</td>
                            <td class="py-4 px-6">
                                @foreach($coursetype->instructors as $instructor)
                                    {{$instructor->name}} {{$instructor->lastname}} <br>
                                @endforeach
                            </td>
                            <td class="py-4 px-6">
                                @foreach($coursetype->classes as $class)
                                    {{$class->name}}<br>
                                @endforeach
                            </td>
                            <td class="py-4 px-6">{{$coursetype->applications->count()}}</td>
                            <td class="py-4 px-6 text-right">
                                <a href="/admin/coursetypes/{{ $coursetype->id }}" class="text-blue-600 hover:text-blue-700 hover:underline ">Upraviť</a>
                                &nbsp;
                                <form method="POST" action="/admin/coursetypes/{{ $coursetype->id }}" class="inline">
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