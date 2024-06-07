<x-layout />
<x-setting heading="Akadémie" etitle="Existujúce akadémie">
    <x-slot:create>
        <div class="flex flex-col">
            <div class="bg-white p-8 rounded-lg shadow mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie akadémie</h3>
                <form action="/admin/academies/create" method="post" class="">
                    @csrf
                    <x-form.required class="-mt-3" />
                    <x-form.field>
                        <x-form.input name="name" type="text" title="Názov" placeholder="Názov" required="true" />
                    </x-form.field>

                    <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                        Odoslať
                    </x-form.button>
                </form>
            </div>
        </div>
    </x-slot:create>

    <x-form.search action="{{ route('admin.academies.index') }}" text="Zoradiť">
        @csrf
        @if (request()->filled('search'))
            <input type="hidden" name="search" value="{{ request()->input('search') }}" />
        @endif
        <x-form.search-select name="orderBy" title="Zoradiť podľa">
            <option value="name" {{ request()->input('orderBy') == 'name' ? 'selected' : '' }}>Názvu</option>
            <option value="created_at" {{ request()->input('orderBy') == 'created_at' ? 'selected' : '' }}>Dátumu
                vytvorenia</option>
            <option value="updated_at" {{ request()->input('orderBy') == 'updated_at' ? 'selected' : '' }}>Dátumu
                poslednej úpravy</option>
        </x-form.search-select>

        <x-form.search-select name="orderDirection" title="Smer zoradenia">
            <option value="asc" {{ request()->input('orderDirection') == 'asc' ? 'selected' : '' }}>Vzostupne
            </option>
            <option value="desc" {{ request()->input('orderDirection') == 'desc' ? 'selected' : '' }}>Zostupne
            </option>
        </x-form.search-select>

        <x-slot:search>
            @csrf
            @if (request()->filled('orderBy'))
                <input type="hidden" name="orderBy" value="{{ request()->input('orderBy') }}" />
                <input type="hidden" name="orderDirection" value="{{ request()->input('orderDirection') }}" />
            @endif
        </x-slot:search>
    </x-form.search>

    <x-single-table>
        <x-slot:head>
            <th scope="col" class="py-3 px-6">Názov akadémie</th>
            <th scope="col" class="py-3 px-6">Kurzy</th>
            <th scope="col"
                class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                Akcie
            </th>
        </x-slot:head>

        @foreach ($academies as $academy)
            <tr
                class="bg-white border-b  dark:border-b dark:bg-white border-gray-700  dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">

                <td class="py-4 px-6">
                    <x-table.td url="academies/{{ $academy->id }}">
                        {{ $academy->name }}
                    </x-table.td>
                </td>
                <td class="py-4 px-6">
                    @foreach ($academy->coursetypes as $coursetype)
                        <x-table.td url="coursetypes/{{ $coursetype->id }}">
                            {{ $coursetype->name }} - {{ $coursetype->type == '0' ? 'študentský' : 'inštruktorský' }}
                        </x-table.td>
                        <br>
                    @endforeach
                </td>
                <x-table.td-last url="academies/{{ $academy->id }}" edit=1
                    itemName="akadémiu {{ $academy->name }}? Spolu s akadémiou sa vymažú aj všetky kurzy akadémie spolu s prihláškami aj triedami týchto kurzov." />
            </tr>
        @endforeach
    </x-single-table>

</x-setting>
