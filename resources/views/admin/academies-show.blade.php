<x-layout />

<x-setting heading="{{$academy->name}}">


    <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
        <x-show-header name="{{$academy->name}}" title="Akadémia" src="{{ asset('storage/') }}" path="instructors/{{ $academy->id }}"/>
        {{-- <div class="flex items-center space-x-4">
            <!-- Image Placeholder or Icon -->
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z">
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- Text Description -->
                <div class="flex-grow">
                    <h5 class="text-lg font-semibold text-gray-900">{{$academy->name}}</h5>
                    <p class="text-sm text-gray-500">Akadémia</p>
                </div>
            </div>
        </div> --}}


        {{-- <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
            <div class="relative right-0">
                <ul class="" nav-pills role="tablist">
                    <li
                        class=" {{ session('success_d') ? 'hidden' : '' }} z-30 flex-auto text-center relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl">
                        <button
                            class="edit-button {{session('success_c') || session('success_d') || session('success_dd') || request()->has('pridat') ? 'hidden' : '' }} z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                            data-target="profile">
                            <span style="display: inline;">Povoliť
                                úpravy</span>
                            <span style="display: none;">Zrušiť úpravy</span>
                        </button>
                        <button
                            class="add-button z-30 {{ session('success_c') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                            data-target="kurzyAdd">
                            <span class="{{ session('success_c') || session('success_dd') ? '' : 'hidden' }}">Vytvoriť
                                kurz</span>
                            <span class="{{request()->has('pridat') ? '' : 'hidden' }}">Zrušiť
                                vytvorenie kurzu</span>
                        </button> --}}
                        {{-- <a id="pp" href="javascript:;"
                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white">
                            <i class="ni ni-app"></i>

                            <span id="jj"
                                class="ml-2 {{session('success_c') || session('success_d') || request()->has('pridat') ? 'hidden' : '' }}">Povoliť
                                úpravy</span>
                            <span style="display: none;" id="zz" class="ml-2">Zrušiť úpravy</span>
                            <span id="kk" class="ml-2 {{ session('success_c') || session('success_d') ? '' : 'hidden' }} 
                                            ">Vytvoriť kurz</span>
                            <span id="nkk" class="ml-2 "
                                style="{{request()->has('pridat') ? '' : 'display: none;' }}">Zrušiť
                                vytvorenie
                                kurzu</span>
                        </a> --}}
                        {{--
                    </li>
                </ul>
            </div>
        </div> --}}
        {{-- <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
            <div class="relative">
                <ul class="flex justify-center items-center bg-gray-300 rounded-xl py-0.5 px-0.5" role="tablist"
                    nav-pills> --}}
                <x-buttonsection class="{{ session('success_d')  ? 'hidden' : ''}}">
                    <li class="flex-1 {{ session('success_dd') || session('success_c')  ||  $errors->default->any() ? 'hidden' : '' }}">
                        <button
                            class="edit-button  {{ session('success_c') || session('success_d') || session('success_dd') || request()->has('pridat')  ||  $errors->default->any() ? 'hidden' : '' }} "
                            data-target="profile">
                            <span
                                class="{{ session('success_c') || session('success_d') || session('success_dd') || request()->has('pridat')  ||  $errors->default->any() ? 'hidden' : 'block' }}">Povoliť
                                úpravy</span>
                            <span
                                class="{{ session('success_c') || session('success_d') || session('success_dd') || request()->has('pridat') ? 'block' : 'hidden' }}">Zrušiť
                                úpravy</span>
                        </button>
                    </li>
                    <li
                        class="flex-1 {{ session('success_c') || session('success_dd') || request()->has('pridat')  ||  $errors->default->any() ? '' : 'hidden' }}">
                        <button
                            class="add-button "
                            data-target="kurzyAdd">
                            <span class="{{ session('success_c') || session('success_dd') ? '' : 'hidden' }}">Vytvoriť
                                kurz</span>
                            <span class="{{request()->has('pridat')  ||  $errors->default->any() ? '' : 'hidden' }}">Zrušiť
                                vytvorenie kurzu</span>
                        </button>
                    </li>
            </x-buttonsection>
                {{-- </ul>
            </div>
        </div> --}}

        <x-buttonsection>
        {{-- <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
            <div class="relative">
                <ul class="flex justify-center items-center bg-gray-300 rounded-xl py-0.5 px-0.5 shadow" role="tablist" nav-pills> --}}
                    <li class="flex-auto pr-0.5">
                        <button
                            class="section-button {{ session('success_c') || session('success_dd') || session('success_d') || request()->has('pridat')  ||  $errors->default->any() ? '' : 'hidden' }}  rounded-l-lg"
                            data-target="profile">
                            Info
                        </button>
                        <button
                            class="section-button {{ session('success_c') || session('success_dd') || session('success_d') || request()->has('pridat')  ||  $errors->default->any() ? 'hidden' : '' }}  rounded-l-lg"
                            data-target="kurzy">
                            Kurzy
                        </button>
                    </li>
                    <li class="flex-auto">
                        <button
                            class="section-button {{ session('success_d') ? '' : 'hidden' }}  rounded-r-lg"
                            data-target="kurzy">
                            Kurzy
                        </button>
                        <button
                            class="section-button {{ session('success_d') ? 'hidden' : '' }}  rounded-r-lg"
                            data-target="login">
                            Prihlášky
                        </button>
                    </li>
                </x-buttonsection>
                {{-- </ul>
            </div>
        </div> --}}




        {{-- <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
            <div class="relative right-0">
                <ul class="relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl" nav-pills role="tablist">
                    <li class="z-30 flex-auto text-center "> --}}
                        {{-- <a id="ku"
                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                            href="javascript:;">
                            <i class="ni ni-email-83"></i>
                            <span id="tlac1"
                                class="ml-2 {{session('success_c') || session('success_d') || request()->has('pridat') ? 'hidden' : '' }}">Kurzy</span>
                            <span id="tlac2"
                                class="{{session('success_c') || session('success_d') || request()->has('pridat')  ? '' : 'hidden' }} ml-2">Info</span>
                        </a> --}}
                        {{-- <button
                            class="section-button {{session('success_c') || session('success_dd')|| session('success_d')  || request()->has('pridat')  ? '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                            data-target="profile">Info</button>
                        <button
                            class="section-button {{session('success_c') || session('success_dd') || session('success_d')   || request()->has('pridat') ? 'hidden' : '' }} z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                            data-target="kurzy">Kurzy</button>
                    </li>
                    <li class="z-30 flex-auto text-center"> --}}
                        {{-- <a id="tr"
                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                            nav-link href="javascript:;">
                            <i class="ni ni-settings-gear-65"></i>
                            <span id="lt" class="ml-2">Login</span>
                            <span id="kt" class="hidden ml-2">Kurzy</span>
                        </a> --}}
                        {{-- <button
                            class="section-button {{session('success_d')  ?  '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                            data-target="kurzy">Kurzy</button>
                        <button
                            class="section-button  {{session('success_d') ? 'hidden' : '' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                            data-target="login">Prihlášky</button>

                    </li>
                </ul>
            </div>
        </div> --}}


    </div>


    <div id="profile"
        class="section flex-auto p-6 {{ session('success_c') || session('success_d') || session('success_dd') || request()->has('pridat') ||  $errors->default->any() ? 'hidden' : '' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
        <form id="formm" action="/admin/academies/{{$academy->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('Patch')
            
            <x-form.required class="hidden mt-1"/>
            <x-form.field>
                <x-form.input
                    value="{{$academy->name}}" name="name" type="text" title="Názov" placeholder="Názov" errorBag="updateAcademy" required="true" disabled />
            </x-form.field>
            {{-- <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 md:w-1/2">
                <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Name</label>
                        <input disabled type="text" name="name" id="name" value="{{ $academy->name }}"
                            class=" block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                </div>
            </div> --}}

            <x-form.field>
                <div class="flex justify-end space-x-4 mt-6">
                    <x-form.button class=" hidden  flex-1">
                        Upraviť
                    </x-form.button>
                    <!-- Update Button -->


                    <!-- Reset Button -->
                    <button id="res" type="reset"
                        class="hidden flex-none bg-gray-400 text-white text-sm font-bold py-2 px-6 rounded-lg hover:bg-gray-500 transition-colors duration-200">
                        Reset
                    </button>
                </div>
            </x-form.field>


        </form>
    </div>
    <div class="add-section" id="kurzyAdd"
        style="{{request()->has('pridat')  ||  $errors->default->any() ? 'display:block;' : 'display: none;' }}">
        <p class="text-sm font-semibold uppercase text-gray-700">Vytvoriť kurz</p>
        <form action="/admin/coursetypes/create" method="POST">
            @csrf
            <input name="academy_id" value="{{$academy->id}}" hidden />
            <x-form.required class="mt-1"/>
            <x-form.field>
                <x-form.input name="name" type="text" title="Názov" placeholder="Názov" required="true"/>
                </x-form.field>
    
                
                <div class="items-center mt-6">
                    <x-form.label name="type" title="Typ kurzu" required="true" />
                
                    <div class="flex flex-wrap items-center mt-1">
                        <x-form.input-radio name="type" for="type_student" value="0" class="mb-2 sm:mb-0" required="true">
                            Študentský
                        </x-form.input-radio>
                        
                        <x-form.input-radio class="ml-6 mb-2 sm:mb-0" name="type" for="type_instructor" value="1" required="true">
                            Inštruktorský
                        </x-form.input-radio>
                        
                        <x-form.input-radio class="w-full sm:w-auto sm:ml-6" name="type" for="type_both" value="2" required="true">
                            Obidva
                        </x-form.input-radio>
                    </div>
                    <x-form.error name="type" errorBag="default"/>
                </div>
                
                    <x-form.field>
                        <x-form.input name="min" type="number" title="Minimum študentov" placeholder="Minimum" required="true"/>
                        </x-form.field>
                        <x-form.field>
                        <x-form.input name="max" type="number" title="Maximum študentov" placeholder="Maximum" required="true"/>
                        </x-form.field>

                        <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                            Odoslať
                        </x-form.button>
        </form>
    </div>
    <div id="kurzy"
        class="section {{session('success_c') || session('success_dd') || request()->has('pridat')  ||  $errors->default->any()  ? '' : 'hidden' }} flex-auto p-6 ">
        <p class="text-sm font-semibold uppercase text-gray-700">Kurzy pod touto akadémiou</p>
        <x-single-table>
            <x-slot:head>
                        <th scope="col" class="py-3 px-6">Fotka</th>
                        <th scope="col" class="py-3 px-6">Názov kurzu</th>
                        <th scope="col" class="py-3 px-6">Typ kurzu</th>
                        <th scope="col" class="py-3 px-6">Min/max študentov</th>
                        <th scope="col" class="py-3 px-6">Inštruktori</th>
                        <th scope="col" class="py-3 px-6">Triedy</th>
                        <th scope="col" class="py-3 px-6">Počet prihlášok</th>
                        <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">Akcie</th>
                    </x-slot:head>
                    @foreach ($academy->coursetypes as $coursetype)
                    <tr
                        class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                        <td class="py-4 px-6">

                            <td class="py-4 px-6"><x-table.td url="coursetypes/{{ $coursetype->id }}">{{$coursetype->name}}</x-table.td></td>

                        </td>
                        <td class="py-4 px-6">
                            {{$coursetype->type=='0'? 'študentský' : 'inštruktorský'}}
                        </td>

                        <td class="py-4 px-6">

                            {{ $coursetype->min}} / 
                            {{ $coursetype->max}}

                        </td>
                        <td class="py-4 px-6">
                            @foreach($coursetype->instructors as $instructor)
                            <x-table.td url="instructors/{{ $instructor->id }}">
                            {{$instructor->name}} {{$instructor->lastname}}
                            </x-table.td>
                            <br>
                            @endforeach
                        </td>
                        <td class="py-4 px-6">
                            @foreach($coursetype->classes as $class)
                                <x-table.td url="classes/{{ $class->id }}">
                                {{$class->name}}
                                </x-table.td><br>
                                @endforeach
                        </td>
                        <td class="py-4 px-6">{{$coursetype->applications->count()}}</td>
                        <x-table.td-last url="coursetypes/{{ $coursetype->id }}" edit=1 itemName="kurz {{$coursetype->name}}? Spolu s kurzom sa vymažú aj prihlášky a triedy kurzu." />
                        
                    </tr>
                    @endforeach
                </x-single-table>
    </div>
    <div id="login" class="section {{session('success_d')  ? '' : 'hidden' }} flex-auto p-6">
        @php
        $coursetypes = $academy->coursetypes()->orderByDesc(function ($query) {
        $query->select('created_at')
        ->from('applications')
        ->whereColumn('coursetype_id', 'course_types.id')
        ->latest()
        ->limit(1);
        })->get();
        @endphp 
        <p class="text-sm font-semibold uppercase text-gray-700 mb-6">Prihlášky jednotlivých kurzov akadémie</p>
        @foreach ($coursetypes as $coursetype)
        {{-- @if($coursetype->applications->isNotEmpty()) --}}
       

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
                            <th scope="col" class="py-3 px-6 w-48"> <a href="/admin/coursetypes/{{ $coursetype->id }}?vytvorit"
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

                            <x-table.td-last url="applications/{{ $application->id }}" edit=0 itemName="prihlášku študenta: {{$application->student->name}} {{$application->student->lastname}} na kurz: {{$application->coursetype->name}} tejto akadémie?" />

                           
                        </tr>
                        @endforeach
                   </x-single-table>
        </div>
        {{-- @endif --}}
        @endforeach

    </div>


</x-setting>