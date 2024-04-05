<x-flash />
<x-layout />
<x-setting heading="Akadémie" ctitle="akadémie" etitle="akadémie">



    {{-- <div class="flex flex-col">
        <div class="bg-white p-8 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie akadémie</h3> --}}
            <x-slot:create>
            <form action="/admin/academies/create" method="post">
                @csrf
                <div class="mb-4">
                    <x-form.input name="name" type="text"  />
                </div>

                <div class="mt-6">
                    <x-form.button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Odoslať
                    </x-form.button>
                </div>
            </form>
            </x-slot:create>
        {{-- </div>
        <!-- The rest of your content -->
    </div> --}}
            <div class="flex mt-3">
                <form method="get" action="{{ route('admin.academies.index') }}">
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

                    </div>
                    <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
                </form>
                <div class="ml-auto">
                    <form method="get" action="{{ route('admin.academies.index') }}">
                        @csrf
                        @if(request()->filled('orderBy'))
                        <input type="hidden" name="orderBy" value="{{request()->input('orderBy')}}" />
                        <input type="hidden" name="orderDirection" value="{{request()->input('orderDirection')}}" />
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
                                    <th scope="col" class="py-3 px-6">Názov akadémie</th>
                                    <th scope="col" class="py-3 px-6">Kurzy</th>
                                    <th scope="col" class="py-3 px-6 text-right">Akcie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($academies as $academy)
                                <tr class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                    <td class="py-4 px-6">{{$academy->name}}</td>
                                    <td class="py-4 px-6">
                                        @foreach($academy->coursetypes as $coursetype)
                                            {{$coursetype->name}} - {{$coursetype->type == '0' ? 'študentský' : 'inštruktorský'}}<br>
                                        @endforeach
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <a href="/admin/academies/{{ $academy->id }}" class="text-blue-600 hover:text-blue-700">Edit</a>
                                        <form method="POST" action="/admin/academies/{{ $academy->id }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
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