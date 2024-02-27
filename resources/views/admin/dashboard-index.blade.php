<x-flash />
<x-layout />
<x-setting heading="Dashboard">
    <div class="flex flex-col">
        <div class="flex">

            <form class="flex-1" action="{{ route('admin.dashboard.index') }}" method="GET">
                @csrf
                <div class="flex">
                    @if(request()->filled('search'))
                    <input type="hidden" name="search" value="{{request()->input('search')}}" />
                    @endif
                    <div>
                        <x-form.label name="Zoradiť od:" />
                        <select name="sort_by" id="sort_by">
                            <option value="latest" {{ request()->get('sort_by') == 'latest' ? 'selected' : ''
                                }}>Najnovšie
                            </option>
                            <option value="oldest" {{ request()->get('sort_by') == 'oldest' ? 'selected' : ''
                                }}>Najstaršie
                            </option>
                            <option value="most_applicants" {{ request('sort_by')=='most_applicants' ? 'selected' : ''
                                }}>
                                Najviac prihlásených</option>
                            <option value="less_applicants" {{ request('sort_by')=='less_applicants' ? 'selected' : ''
                                }}>
                                Najmenej prihlásených</option>
                        </select>
                    </div>
                    <div class="px-6">
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
                                <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled>
                                    <option value="" disabled selected hidden>Typ kurzu</option>

                                    @foreach ($academy as $academ)
                                    <option value="" data-option="{{$academ->id}}" {{request()->
                                        input('coursetype_id')==null ? 'selected' : ''}}>Všetky</option>
                                    @endforeach
                                    @foreach ($coursetype as $type)
                                    <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                        data-option="{{ $type->academy_id }}" {{request()->
                                        input('coursetype_id')==$type->id ? 'selected' : ''}}>{{ ucwords($type->name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
            </form>
            <div class="ml-auto">
                <form method="get" action="{{ route('admin.dashboard.index') }}">
                    @csrf
                    @if(request()->filled('sort_by'))
                    <input type="hidden" name="sort_by" value="{{request()->input('sort_by')}}" />
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





    </div>
    @if($groupedApplications->count() > 0)
    <div id="dashboard-container" class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            @foreach ($groupedApplications as $coursetypeName => $academyGroup)
    @foreach ($academyGroup as $academyName => $apps)
        {{-- Assume all applications in $apps belong to the same coursetype --}}
        @php
            $coursetype = $apps->first()->coursetype; // Get the coursetype from the first application
        @endphp
        <div class="text-sm w-full flex mt-2 mb-2">
            <p class="flex-none text-sm font-medium text-gray-900 w-32">Kurz: {{ $coursetypeName }} - {{ $coursetype->type == 0 ? 'študentský' : 'inštruktorský' }}</p>
            <p class="flex-1 font-light text-gray-500">Akadémia: {{ $academyName }}</p>
        </div>
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200" style="table-layout: fixed;">
                            <thead class="text-sm">
                                <tr>
                                    <th class="px-6 py-1">Meno a priezvisko</th>
                                    <th class="px-6 py-2">Email</th>
                                    <th></th>
                                    <th>
                                        <a class="text-blue-500 hover:text-blue-600" href="{{ route('applications', ['coursetype_id' => $coursetype->id]) }}">Pridať študenta</a>
                                        <a href="/admin/coursetypes/{{ $coursetype->id }}?vytvorit"
                                            class="text-blue-500 hover:text-blue-600">
                                            Pridať študenta
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($apps as $application)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="/admin/students/{{ $application->student->id }}">
                                                        {{$application->student->name }}
                                                        {{$application->student->lastname}}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $application->student->email }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs font-light text-gray-900">
                                                    vytvorená {{ $application->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                             <form method="POST" action="/admin/applications/{{ $application->id }}">
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
                @endforeach
            @endforeach
        </div>
    </div>
@else
    <p>No applications found.</p>
@endif

    </div>


</x-setting>