<x-layout />
<x-setting heading="Triedy" etitle="Existujúce triedy">
    <x-slot:create>
        <div class="flex flex-col">
            <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie triedy</h3>
                <form action="/admin/classes/create" method="post">
                    @csrf
                    <x-form.required class="-mt-3" />
                    @if (auth()->user()->can('admin'))
                    @else
                        <input type="hidden" name="instructor_id" value="{{ auth()->user()->user_id }}" required />
                    @endif
                    <x-form.input-check name="students"
                        title="Zapísať všetkých študentov ktorí majúprihlášku na kurz" />
                    <x-form.field>
                        <x-form.input name="name" type="text" title="Názov" placeholder="Názov"
                            required="true" />
                    </x-form.field>
                    <x-form.field>

                        <div class="items-center mt-6 ">
                            <x-form.label name="type" title="Typ kurzu" required="true" />

                            <div class="flex items-center mt-1">
                                <x-form.input-radio name="type" for="type_student" value="0" required="true">
                                    Študentský
                                </x-form.input-radio>

                                <x-form.input-radio class="ml-6" name="type" for="type_instructor" value="1"
                                    required="true">
                                    Inštruktorský
                                </x-form.input-radio>

                                <div class="relative ml-4 flex items-center">
                                    <span
                                        class="material-icons info text-gray-500 hover:text-gray-700 cursor-pointer">info</span>
                                    <div class="absolute hidden w-48 px-4 py-2 text-sm leading-tight text-white bg-gray-800 rounded-lg shadow-lg -left-12 top-6 z-10"
                                        style="min-width: 150px;">
                                        Ak nevidíte Vami požadovaný kurz, je to preto, že kurz musí mať aspoň jedného
                                        priradeného inštruktora na vytvorenie triedy.
                                    </div>
                                </div>

                            </div>
                            <x-form.error name="type" errorBag="default" />

                        </div>

                        @php
                            if (auth()->user()->can('admin')) {
                                $academy = \App\Models\Academy::all();
                                $coursetypes = \App\Models\CourseType::all();
                            } else {
                                $authInstructorId = auth()->user()->user_id;
                                $academy = \App\Models\Academy::whereHas('coursetypes.instructors', function (
                                    $query,
                                ) use ($authInstructorId) {
                                    $query->where('instructors.id', $authInstructorId);
                                })
                                    ->with([
                                        'coursetypes' => function ($query) use ($authInstructorId) {
                                            $query->whereHas('instructors', function ($q) use ($authInstructorId) {
                                                $q->where('instructors.id', $authInstructorId);
                                            });
                                        },
                                    ])
                                    ->get();
                                $coursetypes = \App\Models\CourseType::whereHas('instructors', function ($query) use (
                                    $authInstructorId,
                                ) {
                                    $query->where('instructors.id', $authInstructorId);
                                })->get();
                            }
                        @endphp
                        <div class="mt-6  {{ old('type') == '1' ? 'flex' : 'hidden' }} " id="inst">

                            <div class="w-1/2 mr-2">
                                <x-form.select name="academy_id" title="Akadémia" class=" combo-a"
                                    data-nextcombo=".combo-b" :disabled="old('type') != '1'" required="true">

                                    <option value="" disabled selected hidden>Akadémia</option>

                                    @foreach ($academy as $academ)
                                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}"
                                            data-option="-1">{{ ucwords($academ->name) }}</option>
                                    @endforeach

                                </x-form.select>
                            </div>
                            <div class="w-1/2 ml-2">
                                <x-form.select name="coursetype_id" title="Kurz" class="combo-b" disabled
                                    required="true">

                                    <option value="" disabled selected hidden>Typ kurzu</option>

                                    @foreach ($coursetypes->whereIn('type', [1]) as $type)
                                        @if ($type->instructors->count() > 0)
                                            <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                                data-option="{{ $type->academy_id }}">
                                                {{ ucwords($type->name) }}</option>
                                        @endif
                                    @endforeach
                                </x-form.select>
                            </div>

                        </div>

                        <div class="mt-6  {{ old('type') == '0' ? 'flex' : 'hidden' }} " id="stud">

                            <div class="w-1/2 mr-2">
                                <x-form.select name="academy_id2" title="Akadémia" class=" combo-a3"
                                    data-nextcombo=".combo-b3" :disabled="old('type') != '0'" required="true">

                                    <option value="" disabled selected hidden>Akadémia</option>

                                    @foreach ($academy as $academ)
                                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}"
                                            data-option="-1">{{ ucwords($academ->name) }}
                                        </option>
                                    @endforeach

                                </x-form.select>
                            </div>
                            <div class="w-1/2 ml-2">
                                <x-form.select name="coursetype_id2" title="Kurz" class="combo-b3" disabled
                                    required="true">

                                    <option value="" disabled selected hidden>Typ kurzu</option>

                                    @foreach ($coursetypes->whereIn('type', [0]) as $type2)
                                        @if ($type2->instructors->count() > 0)
                                            <option value="{{ $type2->id }}" data-id="{{ $type2->id }}"
                                                data-option="{{ $type2->academy_id }}">
                                                {{ ucwords($type2->name) }}</option>
                                        @endif
                                    @endforeach
                                </x-form.select>

                            </div>
                        </div>
                    </x-form.field>
                    <x-form.field>

                        <x-form.select name="days" title="Dni" required="true">

                            <option value="" disabled selected hidden>Dni výučby</option>
                            <option value="1" {{ old('days') == 1 ? 'selected' : '' }}>Týždeň</option>
                            <option value="2" {{ old('days') == 2 ? 'selected' : '' }}>Víkend</option>
                            <option value="3" {{ old('days') == 3 ? 'selected' : '' }}>Nezáleží</option>

                        </x-form.select>
                    </x-form.field>
                    <x-form.field>
                        <x-form.select name="time" title="Čas" required="true">

                            <option value="" disabled selected hidden>Čas výučby</option>
                            <option value="1" {{ old('time') == 1 ? 'selected' : '' }}>Ranný</option>
                            <option value="2" {{ old('time') == 3 ? 'selected' : '' }}>Poobedný</option>
                            <option value="3" {{ old('time') == 3 ? 'selected' : '' }}>Nezáleží</option>

                        </x-form.select>

                    </x-form.field>

                    <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                        Odoslať
                    </x-form.button>
                </form>
            </div>
        </div>
    </x-slot:create>
    <x-form.search action="{{ route('admin.classes.index') }}" text="Filtrovať a zoradiť">
        @csrf

        @if (request()->filled('search'))
            <input type="hidden" name="search" value="{{ request()->input('search') }}" />
        @endif
        <x-form.search-select name="orderBy" title="Zoradiť podľa">
            <option value="created_at" {{ request()->input('orderBy') == 'created_at' ? 'selected' : '' }}>Dátumu
                vytvorenia</option>
            <option value="updated_at" {{ request()->input('orderBy') == 'updated_at' ? 'selected' : '' }}>Dátumu
                poslednej úpravy</option>
        </x-form.search-select>
        <x-form.search-select name="orderDirection" title="Smer zoradenia">
            <option value="asc" {{ request()->input('orderDirection') == 'asc' ? 'selected' : '' }}>Vzostupne
            </option>
            <option value="desc" {{ request()->input('orderDirection') == 'asc' ? '' : 'selected' }}>Zostupne
            </option>
        </x-form.search-select>
        <x-form.search-select name="academy_id" title="Akadémia" class=" combo-a4" data-nextcombo=".combo-b4">

            <option value="" data-option="-1" selected>Všetky</option>
           
            @foreach ($academy as $academ)
                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">{{ ucwords($academ->name) }}</option>
            @endforeach
          
        </x-form.search-select>

        <x-form.search-select name="coursetype_id" title="Kurz" class="combo-b4" disabled>
            <option value="" data-id="-1">Všetky</option>

            @foreach ($academy as $academ)
                <option value="" data-option="{{ $academ->id }}"
                    {{ request()->input('coursetype_id') == null ? 'selected' : '' }}>Všetky</option>
            @endforeach
          
            @foreach ($coursetypes as $type)
                <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                    data-option="{{ $type->academy_id }}">{{ ucwords($type->name) }}</option>
            @endforeach
        </x-form.search-select>

        <x-slot:search>
            @csrf
            @if (request()->filled('orderBy'))
                <input type="hidden" name="orderBy" value="{{ request()->input('orderBy') }}" />
                <input type="hidden" name="orderDirection" value="{{ request()->input('orderDirection') }}" />
            @endif
            @if (request()->filled('academy_id') && request()->filled('coursetype_id'))
                <input type="hidden" name="academy_id" value="{{ request()->input('academy_id') }}" />
                <input type="hidden" name="coursetype_id" value="{{ request()->input('coursetype_id') }}" />
            @elseif(request()->filled('academy_id'))
                <input type="hidden" name="academy_id" value="{{ request()->input('academy_id') }}" />
            @endif
        </x-slot:search>
    </x-form.search>
    <x-single-table>
        <x-slot:head>

            <th scope="col" class="py-3 px-6">Názov triedy</th>
            <th scope="col" class="py-3 px-6">Kurz</th>
            @admin
                <th scope="col" class="py-3 px-6">Inštruktor</th>
            @endadmin
            <th scope="col" class="py-3 px-6">Dni / čas</th>
            <th scope="col" class="py-3 px-6">Počet študentov</th>
            <th scope="col"
                class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                Akcie</th>
        </x-slot:head>
        @foreach ($classes as $class)
            <tr class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                <td class="py-4 px-6"><x-table.td url="classes/{{ $class->id }}">{{ $class->name }}</x-table.td>
                </td>
                <td class="py-4 px-6">
                    <x-table.td url="coursetypes/{{ $class->coursetype->id }}">
                        {{ $class->coursetype->name }} -
                        {{ $class->coursetype->type == 0 ? 'študentský' : 'inštruktorský' }}
                        ({{ $class->academy->name }} akadémia)
                    </x-table.td>
                </td>
                @admin
                    <td class="py-4 px-6"><x-table.td url="instructors/{{ $class->instructor->id }}">
                            {{ $class->instructor->name }} {{ $class->instructor->lastname }}
                        </x-table.td></td>
                @endadmin
                <td class="py-4 px-6">
                    {{ $class->days == 1 ? 'Týždeň' : '' }} {{ $class->days == 2 ? 'Víkend' : '' }}
                    {{ $class->days == 3 ? 'Nezáleží' : '' }} / {{ $class->time == 1 ? 'Ranný' : '' }}
                    {{ $class->time == 2 ? 'Poobedný' : '' }} {{ $class->time == 3 ? 'Nezáleží' : '' }}
                </td>
                <td class="py-4 px-6">{{ $class->students->count() }}</td>
                <x-table.td-last url="classes/{{ $class->id }}" edit=1
                    itemName="triedu {{ $class->name }}? Spolu s triedou sa vymažú aj jej hodiny. Študenti v triede sa  vrátia naspäť medzi prihlásených študentov na kurz tejto triedy. V prípade ukončenia vyučovania využite možnosť Ukončenčiť triedu." />
            </tr>
        @endforeach
    </x-single-table>

</x-setting>
