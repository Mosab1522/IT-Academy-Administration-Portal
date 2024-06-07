<x-layout />
<x-setting heading="Certifikáty" etitle="Udelené certifikáty">
    @php
        if (auth()->user()->can('admin')) {
            $academy = \App\Models\Academy::all();
            $coursetypes = \App\Models\CourseType::all();
        } else {
            $authInstructorId = auth()->user()->user_id;
            $academy = \App\Models\Academy::whereHas('coursetypes.instructors', function ($query) use (
                $authInstructorId,
            ) {
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
            $coursetypes = \App\Models\CourseType::whereHas('instructors', function ($query) use ($authInstructorId) {
                $query->where('instructors.id', $authInstructorId);
            })->get();
        }

    @endphp
    <x-form.search action="{{ route('admin.certificates.index') }}" text="Filtrovať a zoradiť">
        @csrf

        @if (request()->filled('search'))
            <input type="hidden" name="search" value="{{ request()->input('search') }}" />
        @endif
        <x-form.search-select name="orderBy" title="Zoradiť podľa">
            <option value="created_at" {{ request()->input('orderBy') == 'created_at' ? 'selected' : '' }}>Dátumu
                vytvorenia</option>
            <option value="updated_at" {{ request()->input('orderBy') == 'created_at' ? '' : 'selected' }}>Dátumu
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
                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1">
                    {{ ucwords($academ->name) }}</option>
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

            <th scope="col" class="py-3 px-6">Názov kurzu</th>
            <th scope="col" class="py-3 px-6">Študent</th>
            <th scope="col" class="py-3 px-6">Čas udelenia v IT systéme</th>

        </x-slot:head>
        @foreach ($classstudents as $class)
            <tr class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">

                <td class="py-4 px-6">
                    <x-table.td url="coursetypes/{{ $class->class->coursetype_id }}">
                        {{ $class->class->coursetype_name }} -
                        {{ $class->class->coursetype_type == 0 ? 'študentský' : 'inštruktorský' }}
                        ({{ $class->class->academy_name }} akadémia)
                    </x-table.td>
                </td>

                <td class="py-4 px-6"> <x-table.td url="students/{{ $class->student->id }}">
                        {{ $class->student->name }} {{ $class->student->lastname }}

                    </x-table.td></td>
                <td class="py-4 px-6">{{ $class->student->pivot_updated_at }} </td>

            </tr>
        @endforeach
    </x-single-table>

</x-setting>
