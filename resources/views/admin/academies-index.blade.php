<x-flash />
<x-layout/>
    <x-setting heading="Akadémie">
        <div class="flex flex-col">
            <div class="flex">
                <form method="get" action="{{ route('admin.academies.index') }}">
                    @csrf
                    
                    @if(request()->filled('search'))
                        <input type="hidden" name="search" value="{{request()->input('search')}}"/>
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
                                <option value="desc" {{request()->input('orderDirection')=='desc' ? 'selected' : ''}}>Od najnovšej
                                </option>
                                <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Od najstaršej
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
                        <input type="hidden" name="orderBy" value="{{request()->input('orderBy')}}"/>
                        <input type="hidden" name="orderDirection" value="{{request()->input('orderDirection')}}"/>
                        @endif
                        <x-form.label name="Vyhľadávanie"/>
                        <input type="text" name="search" value="{{request()->input('search')}}"/>
                        <x-form.button>
                            Hľadať
                        </x-form.button>
                    </form>
                </div>
            </div>
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="text-sm">
                                <tr>
                                    <td class="px-6 py-1">Názov</td>
                                    <td class="px-6 py-2">Počet typov kurzov</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($academies as $academy)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="/admin/academies/{{ $academy->id }}"> 
                                                         {{$academy->name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $academy->coursetypes->count()}}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="/admin/academies/{{ $academy->id }}?pridat" class="text-blue-500 hover:text-blue-600">
                                                Pridať typ kurzu
                                            </a>
                                        </td>
                                        

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="/admin/academies/{{ $academy->id }}" class="text-blue-500 hover:text-blue-600">Edit</a>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/admin/academies/{{ $academy->id }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-xs text-gray-400">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                 @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </x-setting>
