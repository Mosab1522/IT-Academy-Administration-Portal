<x-flash />
<x-layout />
<x-setting heading="Úvod" etitle="Všetky prihlášky akadémie">
   
    {{-- <div class="flex flex-col">
        <div class="flex">

            <form class="flex-1" action="{{ route('admin.dashboard.index') }}" method="GET"> --}}
                <x-slot:create>
                 <x-form.search action="{{ route('admin.dashboard.index') }}" text="Filtrovať a zoradiť">
                @csrf
               
                    @if(request()->filled('search'))
                    <input type="hidden" name="search" value="{{request()->input('search')}}" />
                    @endif
                   
                    <x-form.search-select name="orderBy" title="Zoradiť podľa">
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
                    </x-form.search-select>
                    {{-- </div>
                    <div class="px-6">
                        <x-form.label name="Filtrovať podľa" />
                        <div class="flex">
                            <div> --}}
                                <x-form.search-select name="academy_id" title="Akadémia" class=" combo-a4" data-nextcombo=".combo-b4">
                                    @php
                                    $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                    ->get();
                                    $coursetype = \App\Models\CourseType::with(['academy','applications'])->get();
                                    @endphp

                                    <option value=""  data-id="-1">Všetky</option>

                                    @foreach ($academy as $academ)
                                    <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                        {{request()->input('academy_id')==$academ->id ? 'selected' : ''}}>{{
                                        ucwords($academ->name) }}</option>
                                    @endforeach
                                </x-form.search-select>
                                <x-form.search-select name="coursetype_id" title="Kurz" class="combo-b4" disabled>
                                    <option value=""  data-id="-1">Všetky</option>

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
                                </x-form.search-select>

                            {{-- </div>
                        </div>
                    </div>
                </div>
                <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
            </form>
            <div class="ml-auto">
                <form method="get" action="{{ route('admin.dashboard.index') }}"> --}}
                    <x-slot:search>
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
                </x-slot:search>
            </x-form.search>
                    {{-- <x-form.label name="Vyhľadávanie" />
                    <input type="text" name="search" value="{{request()->input('search')}}" />
                    <x-form.button>
                        Hľadať
                    </x-form.button>
                </form>
            </div>
        </div> --}}

</x-slot:create>



<div class="flex-auto">
    
    @php
    $cnt = 0;
    @endphp 
   
    @foreach ($coursetypes as $coursetype)
    @if ($coursetype->applications->count() > 0)
    @php
    $cnt = $cnt +1;
    @endphp 
    <div class=" mb-6">

        <div class="md:flex -mb-4">
        <h3 class="block md:flex-1 leading-6 w-full md:w-auto   text-gray-700 ">
            <a href="/admin/lessons/{{ $coursetype->id }}" class="inline hover:underline hover:text-gray-900">
                {{ $coursetype->name }} 
            </a>
            <span class=" font-light text-gray-500"> - {{$coursetype->type == 0 ? 'študentský' :
            'inštruktorský'}}</span>
        </h3>
        {{-- <p class="flex-1 font-light text-gray-500"> - {{$coursetype->type == 0 ? 'študentský' :
            'inštruktorský'}}</p> --}}
        <p class="flex-none font-light text-gray-500">Posledná prihláška vytvorená:
            {{$coursetype->applications->isNotEmpty() ?
            $coursetype->applications()->latest()->first()->created_at->diffForHumans() : 'zatiaľ
            žiadna'}}
            </div>

         <x-single-table>
                <x-slot:head>
                        <th scope="col" class="py-3 px-6">Meno študenta</th>
                        <th scope="col" class="py-3 px-6">Dni / čas</th>
                        <th scope="col" class="py-3 px-6">Potvrdená</th>
                        <th scope="col" class="py-3 px-6">Vytvorená</th>
                        <th scope="col" class="py-3 px-6 w-48"> <a href="/admin/coursetypes/{{ $coursetype->id }}"
                            class="text-blue-600 hover:text-blue-700 hover:underline">Pridať študenta</a></th>
                       </x-slot:head>
                    @foreach($coursetype->applications()->orderByDesc('created_at')->get() as $application)
                    <tr class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                        <td class="py-4 px-6">
                            <x-table.td url="students/{{ $application->student->id }}">
                                        {{$application->student->name }}
                                        {{$application->student->lastname}}
                            </x-table.td>
                               
                        </td>
                        <td class="py-4 px-6">
                            {{$application->days== 1 ? 'Týždeň' : ''}} {{$application->days== 2 ? 'Víkend' : ''}}
                            {{$application->days== 3 ? 'Nezáleží' : ''}} / {{$application->time== 1 ? 'Ranný' : ''}}
                            {{$application->time== 2 ? 'Poobedný' : ''}} {{$application->time== 3 ? 'Nezáleží' :
                            ''}}
                        </td>
                        <td class="py-4 px-6 {{$application->verified== 1 ? '' : 'text-red-800'}}">
                            {{$application->verified== 1 ? 'ÁNO' : 'NIE'}}
                        </td>
                        <td class="py-4 px-6">vytvorená
                                    {{ $application->created_at->diffForHumans()}}
                               
                        </td>

                        <x-table.td-last url="applications/{{ $application->id }}" edit=0 itemName="prihlášku {{$application->student->name}}" />

                       
                    </tr>
                    @endforeach
               </x-single-table>
    </div>
    @endif
    @endforeach
    @if ($cnt ==0)
    Zatiaľ žiadne prihlášky akadémie.
    @endif
    </div>


</x-setting>