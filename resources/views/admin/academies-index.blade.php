<x-flash />
<x-layout />
<x-setting heading="Akadémie" etitle="Existujúce akadémie">



    {{-- <div class="flex flex-col">
        <div class="bg-white p-8 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie akadémie</h3> --}}
            <x-slot:create>
                <div class="flex flex-col">
                    <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie akadémie</h3>
                <form action="/admin/academies/create" method="post">
                    @csrf
                    <x-form.field>
                        <x-form.input name="name" type="text" title="Názov" placeholder="Názov" />
                   </x-form.field>

                   
                        <x-form.button class="mt-6">
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
    <div class="bg-white p-6 rounded-lg shadow mb-4 flex justify-between items-end">
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
            
<x-form.button class="ml-2">Zoradiť</x-form.button>
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
                                    <button type="submit" class="delete-button text-red-600 hover:text-red-700 hover:underline ">Vymazať</button>
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