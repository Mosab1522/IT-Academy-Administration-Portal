<x-flash />
<x-layout />
<x-setting heading="Akadémie" etitle="Existujúce akadémie">



    {{-- <div class="flex flex-col">
        <div class="bg-white p-8 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie akadémie</h3> --}}
            <x-slot:create>
                <div class="flex flex-col">
                    <div class="bg-white p-8 rounded-lg shadow mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie akadémie</h3>
                <form action="/admin/academies/create" method="post" class=" ">
                    @csrf
                    <x-form.field>
                        <x-form.input name="name" type="text" title="Názov" placeholder="Názov" />
                   </x-form.field>

                  
                        <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                            Odoslať
                        </x-form.button>
                   
                   
                </form>
                    </div>
                </div>
            </x-slot:create>
            {{--
        </div>
        <!-- The rest of your content -->
    </div> --}}
    {{-- <div class="bg-white p-6 rounded-lg shadow mb-4 flex justify-between items-end">
        <form method="get" action="{{ route('admin.academies.index') }}" class="flex flex-wrap items-end">
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
            
<x-form.button class="ml-2 sm:mt-2">Zoradiť</x-form.button>
        </form>
    
        <!-- Search Form -->
        <form method="get" action="{{ route('admin.academies.index') }}" class="flex flex-wrap items-end">
            @csrf
            @if(request()->filled('orderBy'))
                <input type="hidden" name="orderBy" value="{{request()->input('orderBy')}}" />
                <input type="hidden" name="orderDirection" value="{{request()->input('orderDirection')}}" />
                @endif
                <div class="w-full md:w-auto md:mr-4 mt-4 md:mt-0">

                    <input type="text" name="search" value="{{old('search')}}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                        placeholder="Vyhľadávanie">
                </div>
                
                <x-form.button class="ml-2">Hľadať</x-form.button>
                
        </form>
    </div> --}}
    <x-form.search action="{{ route('admin.academies.index') }}" text="Zoradiť">
        @csrf
        @if(request()->filled('search'))
            <input type="hidden" name="search" value="{{request()->input('search')}}" />
        @endif
        <x-form.search-select name="orderBy" title="Zoradiť podľa">
            <option value="created_at" {{ request()->input('orderBy') == 'created_at' ? 'selected' : '' }}>Dátumu vytvorenia</option>
               <option value="updated_at" {{ request()->input('orderBy') == 'updated_at' ? 'selected' : '' }}>Dátumu poslednej úpravy</option>
       </x-form.search-select>

        <x-form.search-select name="orderDirection" title="Smer zoradenia">
       <option value="desc" {{request()->input('orderDirection')=='desc' ? 'selected' : ''}}>Od najnovšej
       </option>
       <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Od najstaršej
       </option>
</x-form.search-select>

        <x-slot:search>
            @csrf
            @if(request()->filled('orderBy'))
                <input type="hidden" name="orderBy" value="{{request()->input('orderBy')}}" />
                <input type="hidden" name="orderDirection" value="{{request()->input('orderDirection')}}" />
            @endif
        </x-slot:search>
    </x-form.search>


    {{-- <div class="bg-white p-6 rounded-lg shadow mb-4 lg:flex lg:items-end lg:justify-between gap-6">
    <form method="GET" action="{{ route('admin.academies.index') }}" class="flex flex-col sm:flex-row gap-2">
        @csrf
        @if(request()->filled('search'))
            <input type="hidden" name="search" value="{{request()->input('search')}}" />
        @endif --}}

        {{-- <div class="flex-grow">
            <x-form.label name="orderBy" title="Zoradiť podľa" />
            <select name="orderBy" id="orderBy" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm leading-5.6">
                <option value="created_at" {{ request()->input('orderBy') == 'created_at' ? 'selected' : '' }}>Dátumu vytvorenia</option>
                <option value="updated_at" {{ request()->input('orderBy') == 'updated_at' ? 'selected' : '' }}>Dátumu poslednej úpravy</option>
            </select>
        </div> --}}
        {{-- <x-form.search-select name="orderBy" title="Zoradiť podľa">
             <option value="created_at" {{ request()->input('orderBy') == 'created_at' ? 'selected' : '' }}>Dátumu vytvorenia</option>
                <option value="updated_at" {{ request()->input('orderBy') == 'updated_at' ? 'selected' : '' }}>Dátumu poslednej úpravy</option>
        </x-form.search-select>

         <x-form.search-select name="orderDirection" title="Smer zoradenia">
        <option value="desc" {{request()->input('orderDirection')=='desc' ? 'selected' : ''}}>Od najnovšej
        </option>
        <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Od najstaršej
        </option>
</x-form.search-select> --}}
        {{-- <div class="flex-grow">
            <x-form.label name="orderDirection" title="Smer zoradenia" />
            <select name="orderDirection" id="orderDirection" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm leading-5.6">
                <option value="desc" {{ request()->input('orderDirection') == 'desc' ? 'selected' : '' }}>Od najnovšej</option>
                <option value="asc" {{ request()->input('orderDirection') == 'asc' ? 'selected' : '' }}>Od najstaršej</option>
            </select>
        </div> --}}
        {{-- <div class="flex-shrink-0">
        <x-form.button class="md:mt-6 mt-2 sm:mt-6 w-full">Zoradiť</x-form.button>
        </div> --}}
        {{-- <div class="flex-shrink-0">
            <button type="submit" class=" w-full mt-6 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-150 ease-in-out">Zoradiť</button>
        </div> --}}
    {{-- </form>
    <form method="GET" action="{{ route('admin.academies.index') }}" class="flex flex-col  sm:flex-row gap-2 lg:mt-0 mt-2 ">
        @csrf
        @if(request()->filled('orderBy'))
            <input type="hidden" name="orderBy" value="{{request()->input('orderBy')}}" />
            <input type="hidden" name="orderDirection" value="{{request()->input('orderDirection')}}" />
        @endif
        <div class="flex-grow"> --}}
            
            {{-- <input type="text" name="search" value="{{request()->input('search') ?: old('search')}}"
                   class="mt-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm leading-5.6"
                   placeholder="Vyhľadávanie"> --}}
                   {{-- <x-form.input name="search" type="text" title="Vyhľadávanie" placeholder="Vyhľadávanie" class="mt-2"/>
            
        </div>
        <div class="flex-shrink-0">
            <x-form.button class="md:mt-7 mt-2 sm:mt-7 w-full">Hľadať</x-form.button> --}}
            {{-- <button type="submit" class="w-full mt-6  px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-150 ease-in-out">Hľadať</button> --}}
        {{-- </div>
    </form>
</div> --}}

    

<x-index-table>
<x-slot:head>
                            <th scope="col" class="py-3 px-6">Názov akadémie</th>
                            <th scope="col" class="py-3 px-6">Kurzy</th>
                            <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                                Akcie
                            </th>
</x-slot:head>                       

                        @foreach ($academies as $academy)
                        <tr class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                            <td class="py-4 px-6">{{$academy->name}}</td>
                            <td class="py-4 px-6">
                                @foreach($academy->coursetypes as $coursetype)
                                {{$coursetype->name}} - {{$coursetype->type == '0' ? 'študentský' : 'inštruktorský'}}<br>
                                @endforeach
                            </td>
                            <x-table.td-last url="academies/{{ $academy->id }}" delete=1 itemName="akadémiu {{$academy->name}}" />
                            {{-- <td class="px-3 py-4 text-right text-sm font-medium lg:px-6 lg:py-4">
                                <a href="/admin/academies/{{ $academy->id }}" class="text-blue-600 hover:text-blue-700 hover:underline">Upraviť</a>
                                &nbsp;
                                <form method="POST" action="/admin/academies/{{ $academy->id }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button text-red-600 hover:text-red-700 hover:underline">Vymazať</button>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
         
</x-index-table>



    
</x-setting>