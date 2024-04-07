<x-flash />
<x-layout />
<x-setting heading="Akadémie" ctitle="akadémie" etitle="eakadémie">



    {{-- <div class="flex flex-col">
        <div class="bg-white p-8 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie akadémie</h3> --}}
            <x-slot:create>
                <form action="/admin/academies/create" method="post">
                    @csrf
                    <div class="mb-4">
                        <x-form.input name="name" type="text" />
                    </div>

                    <div class="mt-6">
                        <x-form.button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Odoslať
                        </x-form.button>
                    </div>
                </form>
            </x-slot:create>
            {{--
        </div>
        <!-- The rest of your content -->
    </div> --}}
    <div class="bg-white p-6 rounded-lg shadow mb-4 flex justify-between items-end">
        <form method="get" action="{{ route('admin.academies.index') }}" class="flex flex-wrap items-end">
            @csrf
            @if(request()->filled('search'))
            <input type="hidden" name="search" value="{{request()->input('search')}}" />
            @endif
    
            <div class="w-full md:w-auto md:flex-1 md:mr-4">
                <label for="orderBy" class="block text-sm font-medium text-gray-700">Zoradiť podľa</label>
                <select name="orderBy" id="orderBy" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm truncate">
                    <option value="created_at" {{request()->input('orderBy')=='created_at' ? 'selected' : ''}}>Dátumu vytvorenia</option>
                    <option value="updated_at" {{request()->input('orderBy')=='updated_at' ? 'selected' : ''}}>Dátumu poslednej úpravy</option>
                </select>
            </div>
    
            <div class="w-full md:w-auto md:flex-1 md:mr-4 mt-4 md:mt-0">
                <label for="orderDirection" class="block text-sm font-medium text-gray-700">Smer zoradenia</label>
                <select name="orderDirection" id="orderDirection" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm truncate">
                    <option value="desc" {{request()->input('orderDirection')=='desc' ? 'selected' : ''}}>Od najnovšej</option>
                    <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Od najstaršej</option>
                </select>
            </div>
            
            <button type="submit" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Zoradiť
            </button>
        </form>
    
        <!-- Search Form -->
        <form method="get" action="{{ route('admin.academies.index') }}" class="flex flex-wrap items-end">
            @csrf
            <div class="flex">
                <input type="text" name="search" value="{{request()->input('search')}}" class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Vyhľadávanie">
                <button type="submit" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Hľadať
                 </button>
            </div>
        </form>
    </div>
    
    
    <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 ">
        <div class="py-6 align-middle inline-block min-w-full sm:px-6 lg:px-8 ">
            <div class="overflow-x-auto relative rounded-lg shadow">
                <table class="w-full text-sm text-left text-gray-800 dark:text-gray-800 shadow-md">
                    <thead class="text-xs uppercase bg-gray-200">
                        <tr>
                            <th scope="col" class="py-3 px-6">Názov akadémie</th>
                            <th scope="col" class="py-3 px-6">Kurzy</th>
                            <th scope="col" class="py-3 px-6 w-40">Akcie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($academies as $academy)
                        <tr
                            class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                            <td class="py-4 px-6">{{$academy->name}}</td>
                            <td class="py-4 px-6">
                                @foreach($academy->coursetypes as $coursetype)
                                {{$coursetype->name}} - {{$coursetype->type == '0' ? 'študentský' :
                                'inštruktorský'}}<br>
                                @endforeach
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="/admin/academies/{{ $academy->id }}"
                                    class="text-blue-600 hover:text-blue-700 hover:underline ">Upraviť</a>
                                    &nbsp;
                                <form method="POST" action="/admin/academies/{{ $academy->id }}" class="inline">
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