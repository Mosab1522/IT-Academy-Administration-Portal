<x-flash />
<x-layout />
<x-setting heading="{{ $instructor->name }}">

    <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
        <x-show-header name="{{$instructor->name}}" title="Inštruktor" src="{{ asset('storage/' . $instructor->photo) }}" path="instructors/{{ $instructor->id }}"/>
                            {{-- <form id="form" action="/admin/instructors/{{ $instructor->id }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('Patch')
                                <!-- Other input fields -->

                                <div class="relative inline-flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $instructor->photo) }}" alt="profile_image"
                                        class="shadow-2xl rounded-xl"
                                        data-default-src="{{ asset('storage/' . $instructor->photo) }}"
                                        style="width: 150px; height: 150px; object-fit: cover; object-position: 25% 25%;" />

                                    <label for="photo-upload"
                                        class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white opacity-0 hover:opacity-100"
                                        style="background-color: rgba(0,0,0,0.5)">Change Photo</label>
                                    <input type="file" id="photo-upload" name="photo" style="display: none;"
                                        onchange="handleFileUpload(event)">
                                </div>

                                <!-- Other form elements -->

                                <div class="flex">
                                    <button id="photobutton" type="submit"
                                        class="hidden w-full bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Update</button>
                                </div>
                                <div class="flex">
                                    <button id="photobutton-c" type="reset"
                                        class="hidden w-full flex-none bg-gray-400 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">Reset</button>
                                </div>
                            </form> --}}
                    
                            
                             <x-buttonsection class="lg:w-3/12">
                    <li class="flex-1 {{ session('success_d') ? 'hidden' : '' }}">
                        <button
                        class="edit-button {{session('success_cc') || session('success_dd') || request()->has('pridat')  || request()->has('zmenit') || request()->has('vytvorit') ? 'hidden' : '' }} "
                        data-target="profile">
                        <span class="p-auto" style="display: inline;">Povoliť
                            úpravy</span>
                        <span style="display: none;">Zrušiť úpravy</span>
                    </button>
                    </li>
                    <li
                        class="flex-1 {{ session('success_c') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}">
                        <button
                                            class="add-button z-30 {{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}  "
                                            data-target="kurzyAdd">
                                            <span
                                                class="{{ session('success_cc') || session('success_dd') ? '' : 'hidden' }}">Pridať
                                                kurz</span>
                                            <span class="{{request()->has('pridat') ? '' : 'hidden' }}">Zrušiť
                                                pridanie kurzu</span>
                                        </button>
                    </li>
                    <li class="flex-1 {{request()->has('zmenit') || request()->has('vytvorit') ? '' : 'hidden' }}">
                    <button
                    class="edit-button {{request()->has('zmenit') || request()->has('vytvorit') ? '' : 'hidden' }} "
                    data-target="login">
                    <span id="vytvaranie"
                        style="{{request()->has('zmenit') || request()->has('vytvorit') ? 'display: none;' : 'display: inline;' }}">Povoliť
                        úpravy</span>
                    <span
                        style="{{request()->has('zmenit') || request()->has('vytvorit') ? 'display: inline;' : 'display: none;' }}">Zrušiť
                        úpravy</span>
                </button>
            </li>
            </x-buttonsection>
            <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-3/12">
                <div class="relative">
                    <ul class="flex justify-center items-center bg-gray-300 rounded-xl py-0.5 px-0.5" role="tablist" nav-pills>
                       
                        <button 
                            class="section w-full hidden text-center py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-gray-700 bg-gray-100  shadow-sm rounded-lg" id="calendars">
                            <span class="material-icons material-icons-custom" style="vertical-align: middle; font-size: 1.25rem;">calendar_today</span>
                            <span style="vertical-align: middle;">Kalendár</span>
                        </button>
                        <button 
                            class="section-button text-center py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-gray-700 bg-white hover:bg-gray-100 focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 shadow-sm rounded-lg" data-target="calendars">
                            <span class="material-icons material-icons-custom" style="vertical-align: middle; font-size: 1.25rem;">calendar_today</span>
                            <span style="vertical-align: middle;">Kalendár</span>
                        </button>
                    </ul>
                </div>
            </div>
            
                        
                        {{-- <div class="flex-none w-auto max-w-full px-3 my-auto">
                            <div class="h-full">
                                <h5 class="text-lg font-semibold mb-1 ">{{ $instructor->name }}
                                    {{ $instructor->lastname }}
                                </h5>
                                <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">Inštruktor</p>
                            </div>
                        </div>

                        <div
                            class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                            <div class="relative right-0">
                                <ul class="relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl" nav-pills
                                    role="tablist">
                                    <li class="z-30 flex-auto text-center"> --}}
                                        {{-- <a id="pp" href="javascript:;"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white">
                                            <i class="ni ni-app"></i>
                                            <span id="jj"
                                                class="ml-2  {{session('success_cc') || session('success_dd') || request()->has('pridat') || request()->has('zmenit') || request()->has('vytvorit') ? 'hidden' : '' }}">Povoliť
                                                úpravy</span>
                                            <span
                                                style="{{request()->has('vytvorit') || request()->has('zmenit') ? '' : 'display: none;' }}"
                                                id="zz" class="ml-2">Zrušiť
                                                úpravy</span>
                                            <span id="kk"
                                                class="ml-2 {{ session('success_cc') || session('success_dd') ? '' : 'hidden' }}">Pridať
                                                kurz</span>
                                            <span style="{{request()->has('pridat') ? '' : 'display: none;' }}" id="nkk"
                                                class="ml-2">Zrušiť pridanie
                                                kurzu</span>
                                        </a> --}}
                                        {{-- <button
                                            class="edit-button {{session('success_cc') || session('success_dd') || request()->has('pridat')  || request()->has('zmenit') || request()->has('vytvorit') ? 'hidden' : '' }} z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="profile">
                                            <span style="display: inline;">Povoliť
                                                úpravy</span>
                                            <span style="display: none;">Zrušiť úpravy</span>
                                        </button>
                                        <button
                                            class="add-button z-30 {{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="kurzyAdd">
                                            <span
                                                class="{{ session('success_cc') || session('success_dd') ? '' : 'hidden' }}">Pridať
                                                kurz</span>
                                            <span class="{{request()->has('pridat') ? '' : 'hidden' }}">Zrušiť
                                                pridanie kurzu</span>
                                        </button>
                                        <button
                                            class="edit-button {{request()->has('zmenit') || request()->has('vytvorit') ? '' : 'hidden' }} z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="login">
                                            <span id="vytvaranie"
                                                style="{{request()->has('zmenit') || request()->has('vytvorit') ? 'display: none;' : 'display: inline;' }}">Povoliť
                                                úpravy</span>
                                            <span
                                                style="{{request()->has('zmenit') || request()->has('vytvorit') ? 'display: inline;' : 'display: none;' }}">Zrušiť
                                                úpravy</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                        {{-- <div
                            class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                            <div class="relative right-0">
                                <ul class="relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl" nav-pills
                                    role="tablist">
                                    <li class="z-30 flex-auto text-center "> --}}
                                        {{-- <a id="ku"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            href="javascript:;">
                                            <i class="ni ni-email-83"></i>
                                            <span id="tlac1"
                                                class="ml-2 {{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }}">Kurzy</span>
                                            <span id="tlac2"
                                                class="{{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} ml-2">Profil</span>
                                        </a> --}}
                                        <x-buttonsection  class="lg:w-3/12">
                                            {{-- <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                                                <div class="relative">
                                                    <ul class="flex justify-center items-center bg-gray-300 rounded-xl py-0.5 px-0.5 shadow" role="tablist" nav-pills> --}}
                                                        <li class="flex-auto pr-0.5">
                                                            <button
                                                            class="section-button {{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }}  rounded-l-lg"
                                                            data-target="profile">Profil</button>
                                                        <button
                                                            class="section-button {{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }} rounded-l-lg"
                                                            data-target="kurzy">Kurzy</button>
                                                        </li>
                                                        <li class="flex-auto">
                                                            <button
                                            class="section-button {{session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} rounded-r-lg"
                                            data-target="kurzy">Kurzy</button>
                                        <button
                                            class="section-button {{session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }} rounded-r-lg"
                                            data-target="login">Login</button>
                                                        </li>
                                                    </x-buttonsection>
                                                
                                        {{-- <button
                                            class="section-button {{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }}  z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="profile">Profil</button>
                                        <button
                                            class="section-button {{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }} z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="kurzy">Kurzy</button>
                                    </li>
                                    <li class="z-30 flex-auto text-center"> --}}
                                        {{-- <a id="tr"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            nav-link href="javascript:;">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span id="lt"
                                                class="ml-2 {{session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }}">Login</span>
                                            <span id="kt"
                                                class="{{session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} ml-2">Kurzy</span>
                                        </a> --}}
{{-- 
                                        <button
                                            class="section-button {{session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="kurzy">Kurzy</button>
                                        <button
                                            class="section-button {{session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="login">Login</button>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}





                    </div>
                 
                    <div id="profile" class="section flex-auto p-6"
                        style="{{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat')  || request()->has('vytvorit') || request()->has('zmenit') ? 'display: none;' : '' }}">
                        <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
                        <form id="formm" action="/admin/instructors/{{ $instructor->id }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Patch')
                            <div class="flex mt-6">
                                <div class="w-1/2 mr-2">
                                    <x-form.input
                                        value="{{$instructor->name}}" name="name" type="text" title="Meno" placeholder="Meno" disabled />
                               </div>
                                  
                                                   <div  class="w-1/2 ml-2">
                                                        <x-form.input value="{{$instructor->lastname}}" name="lastname" type="text" title="Priezvisko" placeholder="Priezvisko"  disabled/>
                                                   </div>
                            </div>

                            <div class="flex mt-6">
                                <div class="w-1/2 mr-2">
                        <x-form.input  value="{{$instructor->email}}" name="email" type="email" title="Email" placeholder="Email"  disabled/>
                        </div>
                                  
                        <div  class="w-1/2 ml-2">
                        <x-form.input value="{{$instructor->sekemail}}" name="sekemail" type="email" title="Sekundárny email" placeholder="Sekundárny email" disabled/>
                        </div>
                    </div>
                        <p class="text-sm font-semibold uppercase text-gray-700 mt-6">Osobné informácie</p>
                        <x-form.field>
                            <x-form.input  value="{{$instructor->telephone}}" name="telephone" type="tel" title="Telefonné číslo" placeholder="Telefonné číslo" disabled/>
                            </x-form.field>
                    
                            <x-form.field>
                                <x-form.input  value="{{$instructor->ulicaacislo}}" name="ulicacislo" type="text" title="Ulica a popisné číslo" placeholder="Ulica a popisné číslo" disabled/>
                                </x-form.field>

                                <div class="flex mt-6">
                                    <div class="w-1/2 mr-2">
                                <x-form.input value="{{$instructor->mestoobec}}" name="mestoobec" type="text" title="Mesto / Obec" placeholder="Mesto / Obec" disabled/>
                                </div>
                                  
                                <div  class="w-1/2 ml-2">
                
                                <x-form.input value="{{$instructor->psc}}" name="psc" type="text" title="PSČ" placeholder="PSČ" disabled/>
                                </div>
                            </div>
                            {{-- <x-form.field>
                                <button type="submit"
                                    class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Update</button>
                            </x-form.field> --}}
                            {{-- <x-form.button>
                                Update
                            </x-form.button> --}}
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
                        style="{{request()->has('pridat') ? 'display:block;' : 'display: none;' }}">
                        <p class="text-sm font-semibold uppercase text-gray-700">Pridať kurz do správy</p>
                        <form action="/admin/coursetype_instructor" method="POST">
                            @csrf
                           

                                    <input name="instructor_id" value="{{ $instructor->id }}" hidden />

                                    <div class="mt-6 flex" id="inst">

                                        <div class="w-1/2 mr-2">
                                            <x-form.select name="academy_id" title="Akadémia" class=" combo-a"
                                                data-nextcombo=".combo-b">
                                                <!-- parent -->
                                                {{-- <select name="academy_id" class="combo-a" data-nextcombo=".combo-b"> --}}
                                                    <option value="" disabled selected hidden>Akadémia</option>
                                                    {{-- @php
                                                    $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                                    ->get();
                                                    @endphp --}}
                                                    @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                                                    ->get() as $academ)
                                                    <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                                        {{-- {{old('academy_id')==$academ->id ? 'selected' : ''}} --}}
                                                        >{{
                                                        ucwords($academ->name)}}</option>
                                                    @endforeach
                                                    {{-- <option value="" disabled selected hidden>Akadémia</option>
                                                    <option value="1" data-id="1" data-option="-1">Cisco</option>
                                                    <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                                            </x-form.select>
                                        </div>
                                        <div class="w-1/2 ml-2">
                                            <x-form.select name="coursetype_id" title="Kurz" class="combo-b" disabled>
            
                                                <!-- child -->
                                                {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b"
                                                    data-nextcombo=".combo-c" disabled>
                                                    <option value="" disabled selected hidden>Typ kurzu</option>
                                                    <option value="1" data-id="1" data-option="1">Lahky</option>
                                                    <option value="2" data-id="2" data-option="1">Stredny</option>
                                                    <option value="3" data-id="3" data-option="2">Photoshop</option>
                                                    <option value="4" data-id="4" data-option="2">Illustrator</option>
                                                </select> --}}
                                                {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled> --}}
                                                    <option value="" disabled selected hidden>Typ kurzu</option>
                                                    {{-- @php
                                                    $academy = \App\Models\CourseType::all();
                                                    @endphp --}}
                                                    @foreach(\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [1,2])->get() as $type)
                                                    <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                                        data-option="{{ $type->academy_id }}" {{-- {{old('coursetype_id')==$type->id
                                                        ?
                                                        'selected' : ''}} --}}
                                                        >{{
                                                        ucwords($type->name) }}</option>
                                                    @endforeach
                                            </x-form.select>
                                        </div>
            
                                    </div>
                                    <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                                        Odoslať
                                    </x-form.button>
                            {{-- <button type="button" id="setDefaults">Nastaviť predvolené hodnoty</button> --}}
                        </form>
                    </div>
                    <div id="kurzy" class="section flex-auto p-6"
                        style="{{session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'display: none;' }}">
                        <p class="text-sm font-semibold uppercase text-gray-700">Kurzy v správe</p>
                        <x-single-table>
                            <x-slot:head>
                                        <th scope="col" class="py-3 px-6">Názov kurzu</th>
                                        <th scope="col" class="py-3 px-6">Akadémia</th>
                                        <th scope="col" class="py-3 px-6">Typ kurzu</th>
                                        <th scope="col" class="py-3 px-6">Min/max študentov</th>
                                        <th scope="col" class="py-3 px-6">Inštruktori</th>
                                        <th scope="col" class="py-3 px-6">Triedy</th>
                                        <th scope="col" class="py-3 px-6">Počet prihlášok</th>
                                        <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">Akcie</th>
                                    </x-slot:head>
                                    @foreach ($instructor->coursetypes as $coursetype)
                                    <tr
                                                        class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                        <td class="py-4 px-6"><x-table.td url="coursetypes/{{ $coursetype->id }}">{{$coursetype->name}}</x-table.td></td> 
                                        <td class="py-4 px-6"><x-table.td url="academies/{{ $coursetype->academy->id }}">{{$coursetype->academy->name}}</x-table.td></td>
                                        <td class="py-4 px-6">
                                            {{$coursetype->type=='0'? 'študentský' : 'inštruktorský'}}
                                        </td>
                                        <td class="py-4 px-6">{{$coursetype->min}} / {{$coursetype->max}}</td>
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
                                            </x-table.td>
                                                <br>
                                            @endforeach
                                        </td>
                                        <td class="py-4 px-6">{{$coursetype->applications->count()}}</td>
                                        <x-table.td-last url="coursetypes/{{ $coursetype->id }}" edit=1 itemName="kurz  {{$coursetype->name}}" />

                                      
                                    </tr>
                                    @endforeach
                                </x-single-table>
                    </div>
            
                    <div id="login" class="section flex-auto p-6"
                        style="{{ session('success_uu') || session('success_c') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'display: none;' }}">
                        <p class="text-sm font-semibold uppercase text-gray-700 mb-6">Prihlasovacie údaje</p>
                        <input name="instructor_id" value="{{ $instructor->id }}" hidden />

                        <form id="formm2" action="/admin/login/{{ $instructor->login ? 'update' : 'create' }}"
                            method="post">
                            @csrf
                            @if ($instructor->login)
                            @method('Patch')
                            <input name="user_id" value="{{ $instructor->login->id }}" hidden />
                            @else
                            <input name="instructor_id" value="{{ $instructor->id }}" hidden />
                            @endif
                           

                                
                                        <label for="nickname"
                                            class="block text-sm font-medium text-gray-700">Username</label>
                                        <input {{request()->has('vytvorit') || request()->has('zmenit') ? '' :
                                        'disabled' }} type="text" name="nickname"
                                        value="{{ $instructor->login->nickname ?? '' }}" required autofocus
                                        autocomplete="name"
                                        class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6" />
                                    
                                <div class="flex mt-6">
                                    <div class="w-1/2 mr-2">
                                        <label for="password"
                                            class="block text-sm font-medium text-gray-700">Password</label>
                                        <input {{request()->has('vytvorit') || request()->has('zmenit') ? '' :
                                        'disabled' }} type="password" name="password" autocomplete="new-password" class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6"
                                         />
                                        </div>
                                  
                                        <div  class="w-1/2 ml-2">
                            
                                        <label for="password_confirmation"
                                            class="block text-sm font-medium text-gray-700">Password
                                            confirmation</label>
                                        <input {{request()->has('vytvorit') || request()->has('zmenit') ? '' :
                                        'disabled' }} type="password" name="password_confirmation"
                                        autocomplete="new-password"
                                        class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6" />
                                    </div>
                                </div>

                            

                            {{-- <x-form.field>
                                <button type="submit"
                                    class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Update</button>
                            </x-form.field> --}}
                            {{-- <x-form.button>
                                Update
                            </x-form.button> --}}
                            {{-- <x-form.field>

                                <div class="flex">
                                    <button id="upd1" type="submit"
                                        class="{{request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} flex-1 bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">{{
                                        $instructor->login ? 'Update' : 'Create' }}
                                    </button>
                                    <button id="res1" type="reset"
                                        class="{{request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} flex-none bg-gray-400 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">Reset</button>
                                </div>

                            </x-form.field> --}}

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
                    <div id="calendars" class="section flex-auto p-6"
                        style="hidden">
                        <p class="text-sm font-semibold uppercase text-gray-700">Kalendár inštruktora</p>
                    <div id='calendar'></div>
                    </div>

</x-setting>

<script>
    function handleFileUpload(event) {
    var image = document.querySelector('img[alt="profile_image"]');
    var file = event.target.files[0];
    const button = document.getElementById("photobutton");
    const button_c = document.getElementById("photobutton-c");
    var reader = new FileReader();

    reader.onloadend = function() {
        image.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
        button.style.display = "block";
        button_c.style.display = "block";
    } else {
        image.src = ""; // Fallback image or placeholder
        button.style.display = "none";
        button_c.style.display = "none";
    }
}
document.getElementById("photobutton-c").addEventListener("click", function(event) {
    // Prevent the default form reset behavior
    event.preventDefault();

    // Clear the file input
    var fileInput = document.getElementById("photo-upload");
    fileInput.value = "";

    // Reset the image preview to the default image stored in `data-default-src`
    var image = document.querySelector('img[alt="profile_image"]');
    var defaultSrc = image.getAttribute('data-default-src'); // Get the default src
    image.src = defaultSrc;

    // Hide the buttons again
    document.getElementById("photobutton").style.display = "none";
    document.getElementById("photobutton-c").style.display = "none";

    // Manually reset other fields as needed
});

document.addEventListener('DOMContentLoaded', function() {
            const localeButtonText = {
                'en-US': {
                    today: 'Today',
                    year: 'Year',
                    month: 'Month',
                    week: 'Week',
                    day: 'Day',
                    list: 'List'
                },
                'sk': {
                    today: 'Dnes',
                    year: 'Rok',
                    month: 'Mesiac',
                    week: 'Týždeň',
                    day: 'Deň',
                    list: 'Zoznam'
                },
            };

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'sk',
                buttonText: localeButtonText['sk'],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                slotDuration: '00:15:00',
                slotLabelInterval: '01:00',
                slotMinTime: '00:00:00',
                slotMaxTime: '24:00:00',
                scrollTime: '00:00:00',
                firstDay: 1,
                height: 'auto',  // Adjust height based on the events
                contentHeight: 'auto',
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                events: "{{ url('/instructors/' . $instructor->id . '/lessons') }}",
                windowResize: function(view) {
                    if (window.innerWidth < 576) {
                        calendar.changeView('listWeek');
                    } else if (window.innerWidth < 768) {
                        calendar.changeView('timeGridWeek');
                    } else {
                        calendar.changeView('dayGridMonth');
                    }
                }
            });
            calendar.render();

            
            // Set titles for accessibility and internationalization
            const prevButton = calendarEl.querySelector('.fc-prev-button');
            const nextButton = calendarEl.querySelector('.fc-next-button');
            const todayButton = calendarEl.querySelector('.fc-today-button');

            if (prevButton) prevButton.title = 'Predchádzajúci';
            if (nextButton) nextButton.title = 'Ďalší';
            if (todayButton) todayButton.title = 'Dnes';

            // Initial check to set up the correct view on load based on current window size
            if (window.innerWidth < 576) {
                calendar.changeView('listWeek');
            } else if (window.innerWidth < 768) {
                calendar.changeView('timeGridWeek');
            } else {
                calendar.changeView('dayGridMonth');
            }
        });

     

</script>