<x-flash />
<x-layout />
<x-setting heading="{{ $instructor->name }}">
    <a href="{{ url()->previous() }}"
        class="inline-flex items-center px-4 py-1 -ml-2 -mt-6 bg-blue-500 border border-transparent rounded-md font-light text-white hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-800">
        <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        Naspäť
    </a>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div
                    class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
                    <div class="flex flex-wrap -mx-3">
                        <div class="flex-none w-auto max-w-full px-3">
                            <form id="form" action="/admin/instructors/{{ $instructor->id }}" method="post"
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
                            </form>

                        </div>
                        <div class="flex-none w-auto max-w-full px-3 my-auto">
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
                                    <li class="z-30 flex-auto text-center">
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
                                        <button
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
                        </div>
                        <div
                            class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                            <div class="relative right-0">
                                <ul class="relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl" nav-pills
                                    role="tablist">
                                    <li class="z-30 flex-auto text-center ">
                                        {{-- <a id="ku"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            href="javascript:;">
                                            <i class="ni ni-email-83"></i>
                                            <span id="tlac1"
                                                class="ml-2 {{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }}">Kurzy</span>
                                            <span id="tlac2"
                                                class="{{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} ml-2">Profil</span>
                                        </a> --}}

                                        <button
                                            class="section-button {{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }}  z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="profile">Profil</button>
                                        <button
                                            class="section-button {{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }} z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="kurzy">Kurzy</button>
                                    </li>
                                    <li class="z-30 flex-auto text-center">
                                        {{-- <a id="tr"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            nav-link href="javascript:;">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span id="lt"
                                                class="ml-2 {{session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }}">Login</span>
                                            <span id="kt"
                                                class="{{session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} ml-2">Kurzy</span>
                                        </a> --}}

                                        <button
                                            class="section-button {{session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="kurzy">Kurzy</button>
                                        <button
                                            class="section-button {{session('success_c') || session('success_uu') || request()->has('vytvorit') || request()->has('zmenit') ? 'hidden' : '' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="login">Login</button>
                                    </li>
                                </ul>
                            </div>
                        </div>





                    </div>
                    <hr
                        class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                    <div id="profile" class="section flex-auto p-6"
                        style="{{session('success_cc') || session('success_dd') || session('success_uu') || session('success_c') || request()->has('pridat')  || request()->has('vytvorit') || request()->has('zmenit') ? 'display: none;' : '' }}">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">User Information</p>
                        <form id="formm" action="/admin/instructors/{{ $instructor->id }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Patch')
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="first name"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">First
                                            name</label>
                                        <input disabled type="text" name="name" value="{{ $instructor->name }}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="last name"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Last
                                            name</label>
                                        <input disabled type="text" name="lastname" value="{{ $instructor->lastname }}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>

                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Email
                                            address</label>
                                        <input disabled type="email" name="email" value="{{ $instructor->email }}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="username"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Sekemail</label>
                                        <input disabled type="text" name="sekemail" value="{{ $instructor->sekemail }}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Telephone</label>
                                        <input disabled type="" name="telephone" value="{{ $instructor->telephone }}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                            </div>
                            <hr
                                class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />

                            <p class="leading-normal uppercase  dark:opacity-60 text-sm">Contact Information</p>
                            <div class="flex flex-wrap -mx-3">

                                <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">

                                    <div class="mb-4">
                                        <label for="city"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Ulica a
                                            číslo</label>
                                        <input disabled type="text" name="ulicacislo"
                                            value="{{ $instructor->ulicacislo }}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="country"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Mesto/obec</label>
                                        <input disabled type="text" name="mestoobec"
                                            value="{{ $instructor->mestoobec }}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="postal code"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">PSČ</label>
                                        <input disabled type="text" name="psc" value="{{ $instructor->psc }}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
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
                                <div class="flex">
                                    <button id="upd" type="submit"
                                        class="hidden flex-1 bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Update</button>
                                    <button id="res" type="reset"
                                        class="hidden flex-none bg-gray-400 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">Reset</button>
                                </div>

                            </x-form.field>

                        </form>
                        <div id='calendar'></div>
                    </div>
                    <div class="add-section p-6" id="kurzyAdd"
                        style="{{request()->has('pridat') ? 'display:block;' : 'display: none;' }}">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Pridať správu kurzu</p>
                        <form action="/admin/coursetype_instructor" method="POST">
                            @csrf
                            <div class="flex">

                                <div>


                                    <input name="instructor_id" value="{{ $instructor->id }}" hidden />

                                    <x-form.label name="akadémia" />
                                    <!-- parent -->
                                    <select {{request()->has('pridat') ? '' : 'disabled' }} id="academy_id"
                                        name="academy_id" class="combo-a"
                                        data-nextcombo=".combo-b">
                                        <option value="" disabled selected hidden>Akadémia</option>
                                        {{-- @php
                                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                        ->get();
                                        @endphp --}} @php
                                        $assignedCourses = $instructor->coursetypes->pluck('id')->toArray();
                                        @endphp

                                        @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
                                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                            {{ old('academy_id')==$academ->id ? 'selected' : '' }}>
                                            {{ ucwords($academ->name) }}</option>
                                        @endforeach
                                        {{-- <option value="" disabled selected hidden>Akadémia</option>
                                        <option value="1" data-id="1" data-option="-1">Cisco</option>
                                        <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                                    </select>
                                </div>
                                <div class="ml-4">
                                    <x-form.label name="typ kurzu" />
                                    <!-- child -->
                                    {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b"
                                        data-nextcombo=".combo-c" disabled>
                                        <option value="" disabled selected hidden>Typ kurzu</option>
                                        <option value="1" data-id="1" data-option="1">Lahky</option>
                                        <option value="2" data-id="2" data-option="1">Stredny</option>
                                        <option value="3" data-id="3" data-option="2">Photoshop</option>
                                        <option value="4" data-id="4" data-option="2">Illustrator</option>
                                    </select> --}}
                                    <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled>
                                        <option value="" selected hidden>Typ kurzu</option>
                                        {{-- @php
                                        $academy = \App\Models\CourseType::all();
                                        @endphp --}}
                                        @foreach (\App\Models\CourseType::with(['academy','applications'])->get() as $type)
                                        @if (!in_array($type->id, $assignedCourses))
                                        <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                            data-option="{{ $type->academy_id }}" {{ old('coursetype_id')==$type->id ?
                                            'selected' : '' }}>
                                            {{ ucwords($type->name) }} - {{$type->type=='0'? 'študentský' :
                                            'inštruktorský'}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <x-form.field>
                                <button id="pridbtn" type="submit"
                                    class=" flex-1 bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Pridať
                                </button>
                            </x-form.field>
                            {{-- <button type="button" id="setDefaults">Nastaviť predvolené hodnoty</button> --}}
                        </form>
                    </div>
                    <div id="kurzy" class="section flex-auto p-6"
                        style="{{session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'display: none;' }}">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Kurzy</p>
                        <div class="flex flex-wrap -mx-3 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="text-sm">
                                    <tr>
                                        <td class="px-6 py-1">Názov kurzu</td>
                                        <td class="px-6 py-2">Typ</td>
                                        <td class="px-6 py-2">Akadémia</td>
                                        <td class="px-6 py-2">Počet prihlášok</td>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($instructor->coursetypes as $coursetype)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="/admin/coursetypes/{{ $coursetype->id }}"
                                                        title="Ukázať podrobnosti">
                                                        {{ $coursetype->name }}
                                                        {{ $coursetype->academy->name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{$coursetype->type=='0'? 'študentský' : 'inštruktorský'}}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $coursetype->academy->name }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $coursetype->applications->count() }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="/admin/coursetypes/{{ $coursetype->id }}"
                                                class="text-blue-500 hover:text-blue-600">Edit</a>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST"
                                                action="{{ route('your.route.name', ['instructor' => $instructor, 'coursetype' => $coursetype]) }}">

                                                @csrf
                                                @method('DELETE')
                                                <input name="instructor_id" value="{{ $instructor->id }}" hidden />

                                                <button class="text-xs text-gray-400">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="login" class="section flex-auto p-6"
                        style="{{ session('success_uu') || session('success_c') || request()->has('vytvorit') || request()->has('zmenit') ? '' : 'display: none;' }}">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Login</p>
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
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                    <div class="mb-4">
                                        <label for="nickname"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Username</label>
                                        <input {{request()->has('vytvorit') || request()->has('zmenit') ? '' :
                                        'disabled' }} type="text" name="nickname"
                                        value="{{ $instructor->login->nickname ?? '' }}" required autofocus
                                        autocomplete="name"
                                        class="focus:shadow-primary-outline dark:bg-slate-850 text-sm leading-5.6 ease
                                        block w-full appearance-none rounded-lg border border-solid border-gray-300
                                        bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none
                                        transition-all placeholder:text-gray-500 focus:border-blue-500
                                        focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="password"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Password</label>
                                        <input {{request()->has('vytvorit') || request()->has('zmenit') ? '' :
                                        'disabled' }} type="password" name="password" autocomplete="new-password"
                                        class="focus:shadow-primary-outline dark:bg-slate-850 text-sm leading-5.6 ease
                                        block w-full appearance-none rounded-lg border border-solid border-gray-300
                                        bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none
                                        transition-all placeholder:text-gray-500 focus:border-blue-500
                                        focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="password_confirmation"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Password
                                            confirmation</label>
                                        <input {{request()->has('vytvorit') || request()->has('zmenit') ? '' :
                                        'disabled' }} type="password" name="password_confirmation"
                                        autocomplete="new-password"
                                        class="focus:shadow-primary-outline dark:bg-slate-850 text-sm leading-5.6 ease
                                        block w-full appearance-none rounded-lg border border-solid border-gray-300
                                        bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none
                                        transition-all placeholder:text-gray-500 focus:border-blue-500
                                        focus:outline-none" />
                                    </div>
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

                                <div class="flex">
                                    <button id="upd1" type="submit"
                                        class="{{request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} flex-1 bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">{{
                                        $instructor->login ? 'Update' : 'Create' }}
                                    </button>
                                    <button id="res1" type="reset"
                                        class="{{request()->has('vytvorit') || request()->has('zmenit') ? '' : 'hidden' }} flex-none bg-gray-400 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">Reset</button>
                                </div>

                            </x-form.field>

                        </form>
                    </div>
                </div>
            </div>
        </div>
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
        // Add more locales as needed
    };

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        slotDuration: '00:15:00',
        slotLabelInterval: '01:00',
        slotMinTime: '00:00:00',
        slotMaxTime: '24:00:00',
        scrollTime: '00:00:00',
        locale: 'locale',
        buttonText: localeButtonText['sk'],
        firstDay: 1,
        slotLabelFormat: { // Use 24-hour format
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        eventTimeFormat: { // Use 24-hour format for events
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        events: [
            {
                title: 'Sample Event',
                start: '2024-04-03T00:22:00+02:00',
                end: '2024-04-03T01:07:00+02:00'
            }
        ],
        // other options...
    });
    calendar.render();

    const prevButton = calendarEl.querySelector('.fc-prev-button');
    const nextButton = calendarEl.querySelector('.fc-next-button');
    const todayButton = calendarEl.querySelector('.fc-today-button');

    if (prevButton) prevButton.title = 'Predchádzajúci mesiac'; // Update this text based on the selected locale
    if (nextButton) nextButton.title = 'Ďaľší mesiac'; // Update this text based on the selected locale
    if (todayButton) todayButton.title = 'Tento mesiac'; // Update this text based on the selected locale

});

</script>