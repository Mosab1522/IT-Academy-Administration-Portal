<x-flash />
@php
session()->forget('success_d');
@endphp
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
    @if($applications->count() > 0)
    <div id="dashboard-container" class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full
            sm:px-6 lg:px-8">

            @foreach ($types as $id => $name)
            @php

            $format = 'Y-m-d H:i:s';
            $input = $lastApplications[$id];
            // $date = strtotime($input);
            \Carbon\Carbon::setLocale('sk');
            $result = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $input)->diffForHumans();


            @endphp

            @foreach ($applications[$name] as $academy => $apps) <div class="text-sm w-full flex mt-2 mb-2">

                <p class="flex-none text-sm font-medium text-gray-900 w-32">Kurz: {{ $name }}</p>
                <p class="flex-1 font-light text-gray-500">Akadémia: {{$academy}}</p>
                <p class="flex-none font-light text-gray-500">Posledná prihláška vytvorená: {{$result}}</p>
            </div>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">


                <table class="min-w-full divide-y divide-gray-200" style="table-layout: fixed;">
                    <colgroup>
                        <col style=" width: 30%;">
                        <col style="width: 45%;">
                        <col style="width: 12.5%;">
                        <col style="width: 12.5%;">
                    </colgroup>
                    <thead class="text-sm">
                        <tr>
                            <td class="px-6 py-1">
                                Meno a priezvisko
                                <a href="{{ route('admin.dashboard.index', ['sort_by' => 'name_asc']) }}">▲</a>
                                <a href="{{ route('admin.dashboard.index', ['sort_by' => 'name_desc']) }}">▼</a>
                            </td>

                            <td class="px-6 py-2">Email</td>
                            <td></td>
                            <td>
                                <a href={{route('applications', ['coursetype_id'=>$id])}}"
                                    >Pridať študenta</a>
                            </td>
                        </tr>
                    </thead>
                    @foreach ($apps as $application)
                    <tbody class="bg-white divide-y divide-gray-200" style="height: 3rem;">
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
                                        {{$application->student->email}}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-xs font-light text-gray-900">vytvorená
                                        {{ $application->created_at->diffForHumans()}}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                               
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium ">
                                <form method="POST" action="/admin/applications/{{ $application->id }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-xs text-gray-400">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>

            </div>@endforeach
            @endforeach
        </div>
    </div>
    @endif
    </div>


</x-setting>