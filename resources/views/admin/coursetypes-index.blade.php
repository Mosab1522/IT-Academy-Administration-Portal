<x-flash />
<x-layout />
<x-setting heading="Typy kurzov" ctitle="kurzu" etitle="kurzy">
    <x-slot:create>
        <form action="/admin/coursetypes/create" method="post">
            @csrf
            <x-form.input name="name" type="text"/>

            <x-form.field>
                <div class="items-center mb-4">
                    <x-form.label name="typ kurzu:" />

                    <input class="mr-0.5" type="radio" name="type" value="0" {{old('type')=='0' ? 'checked' : '' }}>
                    <label for="0">Študentský</label>

                    <input class="ml-2 mr-0.5" type="radio" name="type" value="1" {{old('type')=='1' ? 'checked' : ''
                        }}>
                    <label for="1">Inštruktorský</label>

                    <input class="ml-2 mr-0.5" type="radio" name="type" value="2" {{old('type')=='2' ? 'checked' : ''
                        }}>
                    <label for="2">Obidva</label>

                </div>
                <x-form.label name="academy" />
                <select name="academy_id" id="academy_id">
                    <option value="" disabled selected hidden>Akadémie</option>
                    @php
                    $academy = \App\Models\Academy::all();
                    @endphp
                    @foreach (\App\Models\Academy::all() as $academ)
                    <option value="{{ $academ->id }}" {{old('academy_id')==$academ->id ? 'selected' : '' }} >{{
                        ucwords($academ->name) }}</option>
                    @endforeach

                </select>
            </x-form.field>
            <x-form.input name="min" type="number" />
            <x-form.input name="max" type="number" />

            <x-form.button>
                Odoslať
            </x-form.button>
        </form>
    </x-slot:create>
    <div class="flex mt-3">
        <form method="get" action="{{ route('admin.coursetypes.index') }}">
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
                        </div>
                    </div>
                </div>
            </div>
            <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
        </form>
        <div class="ml-auto">
            <form method="get" action="{{ route('admin.coursetypes.index') }}">
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
                            <th scope="col" class="py-3 px-6">Názov kurzu</th>
                            <th scope="col" class="py-3 px-6">Akadémia</th>
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