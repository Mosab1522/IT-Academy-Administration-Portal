<x-flash />
<x-layout />
<x-setting heading="{{$coursetype->name}}">

    <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
        <x-show-header name="{{$coursetype->name}}" title="Kurz" src="{{ asset('storage/') }}"
            path="instructors/{{ $coursetype->id }}" />
        <x-buttonsection>
            <li class="flex-1 {{ session('success_c') || session('success_cc') || session('success_dd') || session('success_d') ||request()->has('vytvorit')   || request()->has('pridat') ||  $errors->admin->any()  ? 'hidden' : '' }}">

                <button
                    class="edit-button {{session('success_c') || session('success_cc') || session('success_dd')  || session('success_d')  || request()->has('pridat') ||request()->has('vytvorit') ||  $errors->admin->any() ? 'hidden' : '' }} "
                    data-target="profile">
                    <span style="display: inline;">Povoliť
                        úpravy</span>
                    <span style="display: none;">Zrušiť úpravy</span>
                </button>

            </li>
            <li
                class="flex-1 {{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}">
                <button
                    class="add-button {{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}  "
                    data-target="kurzyAdd">
                    <span class="{{session('success_cc') || session('success_dd')  ? '' : 'hidden' }}">Pridať
                        inštruktora</span>
                    <span class="{{request()->has('pridat') ? '' : 'hidden' }}">Zrušiť pridanie
                        inštruktora</span>
                </button>
            </li>
            <li
                class="flex-1 {{ session('success_c') || session('success_d') || request()->has('vytvorit') ||  $errors->admin->any()  ? '' : 'hidden' }}">

                <button
                    class="add-button {{ session('success_c') || session('success_d') || request()->has('vytvorit') ||  $errors->admin->any()  ? '' : 'hidden' }}  "
                    data-target="loginAdd">
                    <span class="{{ session('success_c') || session('success_d') ? '' : 'hidden' }}">Vytvoriť
                        prihlášku</span>
                    <span class="{{request()->has('vytvorit') ||  $errors->admin->any() ? '' : 'hidden' }}">Zrušiť
                        vytvorenie prihlášky</span>
                </button>
            </li>
        </x-buttonsection>
        {{-- <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">

                    <div
                        class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex-none w-auto max-w-full px-3">
                                <div
                                    class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                                    --}}
                                    {{-- <img src="{{asset('storage/' . $instructor->photo)}}" alt="profile_image"
                                        style="
                            width: 150px; 
                            height: 150px; 
                            object-fit: cover;
                            object-position: 25% 25%;" class=" shadow-2xl rounded-xl" /> --}}
                                    {{-- </div>
                            </div>
                            <div class="flex-none w-auto max-w-full px-3 my-auto">
                                <div class="h-full">
                                    <h5 class="text-lg font-semibold mb-1 ">{{$coursetype->name}}
                                    </h5>
                                    <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">
                                        {{$coursetype->academy->name}} akadémia</p>
                                    <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">
                                        {{$coursetype->type
                                        == 0 ? 'študentský' : 'inštruktorský'}} kurz</p>
                                </div>
                            </div>

                            <div
                                class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                                <div class="relative right-0">
                                    <ul id="upravy"
                                        class="  relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl" nav-pills
                                        role="tablist">
                                        <li class="z-30 flex-auto text-center"> --}}
                                            {{-- <a id="pp" href="javascript:;"
                                                class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white">
                                                <i class="ni ni-app"></i>
                                                <span id="jj"
                                                    class="ml-2 {{session('success_cc') || session('success_dd')  || request()->has('pridat') ? 'hidden' : '' }}">Povoliť
                                                    úpravy</span>
                                                <span style="display: none;" id="zz" class="ml-2">Zrušiť úpravy</span>
                                                <span id="kk"
                                                    class="ml-2 {{ session('success_cc') || session('success_dd') ? '' : 'hidden' }}">Pridať
                                                    inštruktora</span>
                                                <span style="{{request()->has('pridat') ? '' : 'display: none;' }}"
                                                    id="nkk" class="ml-2">Zrušiť pridanie
                                                    inštruktora</span>
                                            </a> --}}
                                            {{--
                                            <button
                                                class="edit-button {{session('success_c') || session('success_cc') || session('success_dd')  || session('success_d')  || request()->has('pridat') ||request()->has('vytvorit') ? 'hidden' : '' }} z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
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
                                                    inštruktora</span>
                                                <span class="{{request()->has('pridat') ? '' : 'hidden' }}">Zrušiť
                                                    pridanie
                                                    inštruktora</span>
                                            </button>
                                            <button
                                                class="add-button z-30 {{ session('success_c') || session('success_d') || request()->has('vytvorit')  ? '' : 'hidden' }}  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                                data-target="loginAdd">
                                                <span
                                                    class="{{ session('success_c') || session('success_d') ? '' : 'hidden' }}">Vytvoriť
                                                    prihlášku</span>
                                                <span class="{{request()->has('vytvorit') ? '' : 'hidden' }}">Zrušiť
                                                    vytvorenie prihlášky</span>
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
                                        <li class="z-30 flex-auto text-center "> --}}
                                            {{-- <a id="ku"
                                                class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                                href="javascript:;">
                                                <i class="ni ni-email-83"></i>
                                                <span id="tlac1"
                                                    class="ml-2  {{session('success_cc') || session('success_d')  || session('success_dd') || request()->has('pridat') ? 'hidden' : '' }}">Inštruktori</span>
                                                <span id="tlac2"
                                                    class="{{session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}  ml-2">Info</span>
                                            </a> --}}
                                            <x-buttonsection>
                                                {{-- <div
                                                    class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                                                    <div class="relative">
                                                        <ul class="flex justify-center items-center bg-gray-300 rounded-xl py-0.5 px-0.5 shadow"
                                                            role="tablist" nav-pills> --}}
                                                            <li class="flex-auto pr-0.5">
                                                                <button
                                                                    class="section-button {{session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ||  $errors->admin->any() ? '' : 'hidden' }} rounded-l-lg "
                                                                    data-target="profile">Info</button>
                                                                <button
                                                                    class="section-button {{session('success_c') || session('success_cc') || session('success_d')  || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ||  $errors->admin->any() ? 'hidden' : '' }} rounded-l-lg "
                                                                    data-target="kurzy">Inštruktori</button>
                                                            </li>
                                                            <li class="flex-auto">
                                                                <button
                                                                    class="section-button {{session('success_c') || session('success_d') || request()->has('vytvorit') ||  $errors->admin->any() ? '' : 'hidden' }} rounded-r-lg"
                                                                    data-target="kurzy">Inštruktori</button>
                                                                <button
                                                                    class="section-button {{session('success_c') || session('success_d') || request()->has('vytvorit') ||  $errors->admin->any() ? 'hidden' : '' }} rounded-r-lg"
                                                                    data-target="login">Prihlášky</button>
                                                            </li>
                                            </x-buttonsection>
                                            {{-- <button
                                                class="section-button {{session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                                data-target="profile">Info</button>
                                            <button
                                                class="section-button {{session('success_c') || session('success_cc') || session('success_d')  || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? 'hidden' : '' }} z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                                data-target="kurzy">Inštruktori</button>
                                        </li>
                                        <li class="z-30 flex-auto text-center"> --}}
                                            {{-- <a id="tr"
                                                class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                                nav-link href="javascript:;">
                                                <i class="ni ni-settings-gear-65"></i>
                                                <span id="lt"
                                                    class="ml-2 {{ session('success_d') ? 'hidden' : '' }}">Prihlášky</span>
                                                <span id="kt"
                                                    class="{{ session('success_d') ? '' : 'hidden' }} ml-2">Inštruktori</span>
                                            </a> --}}

                                            {{-- <button
                                                class="section-button {{session('success_c') || session('success_d') || request()->has('vytvorit') ? '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                                data-target="kurzy">Inštruktori</button>
                                            <button
                                                class="section-button {{session('success_c') || session('success_d') || request()->has('vytvorit') ? 'hidden' : '' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                                data-target="login">Prihlášky</button>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}





                        </div>
                        {{--
                        <hr
                            class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                        --}}
                        <div id="profile" class="section flex-auto p-6"
                            style="{{session('success_c') || session('success_cc') || session('success_d') || session('success_dd')  || request()->has('pridat') || request()->has('vytvorit') ||  $errors->admin->any() ? 'display: none;' : '' }}">
                            <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
                            <form id="formm" action="/admin/coursetypes/{{$coursetype->id}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('Patch')
                                <x-form.required class=" hidden mt-1 "/>
                                <x-form.field>
                                    <x-form.input value="{{$coursetype->name}}" name="cname" type="text" title="Názov"
                                        placeholder="Názov" disabled errorBag="updateCoursetype" required="true" />
                                       
                                </x-form.field>

                                <div class="items-center mt-6">
                                    <x-form.label name="type" title="Typ kurzu" required="true"/>

                                    <div class="flex items-center mt-1">
                                        <x-form.input-radio name="type" for="type_student" value="0"
                                            :checked="$coursetype->type == 0" :disabled="true" required="true">
                                            Študentský

                                        </x-form.input-radio>
                                        <x-form.input-radio class="ml-6" name="type" for="type_instructor" value="1"
                                            :checked="$coursetype->type == 1" :disabled="true" required="true">
                                            Inštruktorský
                                        </x-form.input-radio>
                                    </div>
                                    <x-form.error name="type" errorBag="updateCoursetype"/>
                                </div>

                                <x-form.field>
                                    <x-form.select name="academy_id" title="Akadémia" disabled errorBag="updateCoursetype" required="true">

                                        <option class="text-gray-500" value="" disabled selected hidden>Akadémie
                                        </option>

                                        @foreach (\App\Models\Academy::all() as $academ)
                                        <option value="{{ $academ->id }}" 
                                        {{old('academy_id')==$academ->id || $coursetype->academy->id == $academ->id ? 'selected'
                                            : '' }} >{{
                                            ucwords($academ->name) }}</option>
                                        @endforeach

                                    </x-form.select>
                                </x-form.field>

                                <x-form.field>
                                    <x-form.input name="min" type="number" title="Minimum študentov" value="{{ $coursetype->min }}"
                                        placeholder="Minimum" disabled errorBag="updateCoursetype" required="true"/>
                                </x-form.field>
                                <x-form.field>
                                    <x-form.input name="max" type="number" title="Maximum študentov" value="{{ $coursetype->max }}"
                                        placeholder="Maximum" disabled errorBag="updateCoursetype" required="true"/>
                                </x-form.field>
                                {{--
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Status</label>
                                        <input disabled type="text" name="status" value="{{$academy->status}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Škola</label>
                                        <input disabled type="text" name="skola" value="{{$academy->skola}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Štúdium</label>
                                        <input disabled type="text" name="studium" value="{{$academy->studium}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm textleading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Program</label>
                                        <input disabled type="text" name="program" value="{{$academy->program}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div> --}}

                                {{--
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />

                                <p class="leading-normal uppercase  dark:opacity-60 text-sm">Contact Information</p>
                                --}}
                                {{-- <div class="flex flex-wrap -mx-3">

                                    <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">

                                        <div class="mb-4">
                                            <label for="city"
                                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Ulica
                                                a
                                                číslo</label>
                                            <input disabled type="text" name="ulicacislo"
                                                value="{{$academy->ulicacislo}}"
                                                class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                        </div>
                                    </div>
                                    <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                        <div class="mb-4">
                                            <label for="country"
                                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Mesto/obec</label>
                                            <input disabled type="text" name="mestoobec" value="{{$academy->mestoobec}}"
                                                class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                        </div>
                                    </div>
                                    <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                        <div class="mb-4">
                                            <label for="postal code"
                                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">PSČ</label>
                                            <input disabled type="text" name="psc" value="{{$academy->psc}}"
                                                class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                        </div>
                                    </div>
                                </div> --}}
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
                            <p class="text-sm font-semibold uppercase text-gray-700">Pridať inštruktora</p>

                            <form action="/admin/coursetype_instructor" method="POST">
                                @csrf
                                <x-form.required class="mt-1"/>

                                <input name="coursetype_id" value="{{$coursetype->id}}" hidden />

                                <x-form.field>
                                    <x-form.select name="instructor_id" title="Inštruktor" required="true">

                                        <option class="text-gray-500" value="" disabled selected hidden>Inštruktori
                                        </option>
                                        {{-- @php
                                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                        ->get();
                                        @endphp --}}
                                        @php
                                        $assignedInstructors = $coursetype->instructors->pluck('id')->toArray();
                                        @endphp
                                        @foreach (\App\Models\Instructor::with(['coursetypes'])->get() as $instructor)

                                        @if(!in_array($instructor->id, $assignedInstructors))

                                        <option value="{{ $instructor->id }}" >Meno: {{
                                            ucwords($instructor->name)}} {{
                                            ucwords($instructor->lastname)}} Email: {{
                                            ucwords($instructor->email)}}</option>
                                        @endif
                                        @endforeach
                                        {{-- <option value="" disabled selected hidden>Akadémia</option>
                                        <option value="1" data-id="1" data-option="-1">Cisco</option>
                                        <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                                    </x-form.select>
                                </x-form.field>

                                <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                                    Odoslať
                                </x-form.button>
                            </form>
                        </div>


                        <div id="kurzy" class="section flex-auto p-6"
                            style="{{session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'display: none;' }}">
                            <p class="text-sm font-semibold uppercase text-gray-700">Inštruktori kurzu</p>
                            <x-single-table>
                                <x-slot:head>
                                    <th scope="col" class="py-3 px-6">Fotka</th>
                                    <th scope="col" class="py-3 px-6">Meno</th>
                                    <th scope="col" class="py-3 px-6">Aktuálne triedy tohto kurzu</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                                        Akcie</th>
                                </x-slot:head>
                                @foreach ($coursetype->instructors as $instructor)
                                <tr
                                    class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                    <td class="py-4 px-6">
                                        <div class="flex-shrink-0">
                                            <div class="h-20 w-20 rounded-lg bg-gray-300 overflow-hidden relative">
                                                <img class="shadow-xl rounded-lg w-full h-full object-cover"
                                                    src="{{asset('storage/' . $instructor->photo)}}"
                                                    alt="profile_image">

                                            </div>
                                        </div>

                                    </td>
                                    <td class="py-4 px-6">
                                        <x-table.td url="instructors/{{ $instructor->id }}">
                                            {{$instructor->name}} {{$instructor->lastname}}
                                        </x-table.td>
                                    </td>

                                    <td class="py-4 px-6">
                                        @foreach($instructor->classes->where('coursetype_id', $coursetype) as $class)
                                        <x-table.td url="classes/{{ $class->id }}">
                                            {{$class->name}}
                                        </x-table.td><br>
                                        @endforeach
                                    </td>
                                    <x-table.td-last url="coursetype_instructor/{{ $instructor->id }}/{{$coursetype->id}}" edit=1
                                        itemName="inštruktora {{$instructor->name}} {{$instructor->lastname}} ako správcu tohto kurzu? Spolu s ním budú vymazané aj jeho triedy. Ak tomu chcete zabrániť zmeňte inštruktora týchto tried." />

                                </tr>
                                @endforeach
                            </x-single-table>
                        </div>
                        <div class="add-section" id="loginAdd"
                            style="{{request()->has('vytvorit') ||  $errors->admin->any() ? 'display:block;' : 'display: none;' }}">
                            <p class="text-sm font-semibold uppercase text-gray-700">Pridať študenta</p>
                            <x-form.required class="mt-1"/>
                            <form action="/" method="post">
                                @csrf
                                <input type="hidden" name="typ" value="admin" />
                                @if(request()->student_id)
                                @php
                                session(['student_id' => request()->student_id]);
                                @endphp
                                @endif
                                @unless(session('student_id'))
                                
                                <x-form.field>
                                <x-form.live-search/>
                            </x-form.field>
                                @else
                                @php

                                $student = \App\Models\Student::find(session('student_id'));
                                @endphp
                                <x-form.input name="name" type="text" title="Meno" placeholder="Meno" disabled />
                                <x-form.input name="lastname" type="text" title="Priezvisko" placeholder="Priezvisko"
                                    disabled />

                                <x-form.input name="email" type="email" title="Email" placeholder="Email" disabled />
                                <input name="name" value="{{$student->name}}" hidden />
                                <input name="lastname" value="{{$student->lastname}}" hidden />
                                <input name="email" value="{{$student->email}}" hidden />
                                @endunless
                                {{--
                                <x-form.input name="thumbnail" type="file" /> --}}
                                {{--
                                <x-form.textarea name="excerpt" />
                                <x-form.textarea name="body" /> --}}


                                @if($coursetype)
                                <input name="typ" value="admin" hidden />
                                <input name="academy_id" value="{{$coursetype->academy->id}}" hidden />
                                <input name="coursetype_id" value="{{$coursetype->id}}" hidden />
                                <input name="type" value="{{$coursetype->type}}" hidden />
                                @endif



                                {{-- <div class="flex">
                                    <div>
                                        <x-form.label name="akadémia" />
                                        <!-- parent -->
                                        <select name="academy_id" class="combo-a" data-nextcombo=".combo-b"
                                            {{$coursetype ? 'disabled' : '' }}>
                                            <option value="" disabled selected hidden>Akadémia</option>
                                            @php
                                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                            ->get();
                                            @endphp
                                            @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                                            ->get() as $academ)
                                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}"
                                                data-option="-1" {{old('academy_id')==$academ->id ? 'selected' : ''}}
                                                @if($coursetype)
                                                {{
                                                $coursetype->academy->id == $academ->id ? 'selected' : ''}}
                                                @endif
                                                >{{
                                                ucwords($academ->name)}}</option>
                                            @endforeach
                                            {{-- <option value="" disabled selected hidden>Akadémia</option>
                                            <option value="1" data-id="1" data-option="-1">Cisco</option>
                                            <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                                            {{--
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
                                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled>
                                            <option value="" disabled selected hidden>Typ kurzu</option>
                                            {{-- @php
                                            $academy = \App\Models\CourseType::all();
                                            @endphp --}}
                                            {{--@foreach
                                            (\App\Models\CourseType::with(['academy','applications'])->get() as $type)
                                            <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                                data-option="{{ $type->academy_id }}" @if($coursetype) {{$coursetype->id
                                                == $type->id ? 'selected' : ''}}
                                                @endif
                                                {{old('coursetype_id')==$type->id ? 'selected' : ''}}>{{
                                                ucwords($type->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}



                                <x-form.field>

                                    <x-form.select name="days" title="Dni"  errorBag="admin" required="true">

                                        <option value="" disabled selected hidden>Dni výučby</option>
                                        <option value="1" {{old('days')==1 ? 'selected' : '' }}>Týždeň</option>
                                        <option value="2" {{old('days')==2 ? 'selected' : '' }}>Víkend</option>
                                        <option value="3" {{old('days')==3 ? 'selected' : '' }}>Nezáleží</option>
                                        {{-- <option value="1" data-id="1" data-option="2">Týždeň</option>
                                        <option value="1" data-id="1" data-option="3">Týždeň</option>
                                        <option value="2" data-id="2" data-option="3">Víkend</option>
                                        <option value="3" data-id="3" data-option="3">Nezáleží</option>
                                        <option value="1" data-id="1" data-option="4">Týždeň</option> --}}
                                    </x-form.select>
                                </x-form.field>
                                <x-form.field>
                                    <x-form.select name="time" title="Čas"  errorBag="admin" required="true">

                                        <option value="" disabled selected hidden>Čas výučby</option>
                                        <option value="1" {{old('time')==1 ? 'selected' : '' }}>Ranný</option>
                                        <option value="2" {{old('time')==3 ? 'selected' : '' }}>Poobedný</option>
                                        <option value="3" {{old('time')==3 ? 'selected' : '' }}>Nezáleží</option>
                                        {{-- <option value="1" data-id="1" data-option="2">Ranný</option>
                                        <option value="4" data-id="1" data-option="3">Ranný (Týždeň/Víkend)</option>
                                        <option value="5" data-id="2" data-option="3">Poobedný (Týždeň)</option>
                                        <option value="3" data-id="3" data-option="3">Nezáleží</option>
                                        <option value="1" data-id="1" data-option="4">Ranný</option> --}}
                                    </x-form.select>

                                </x-form.field>


                                {{-- <select name="category_id" id="category_id">
                                    @php
                                    $categories = \App\Models\Category::all();
                                    @endphp
                                    @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{old('category_id')==$category->id ? 'selected'
                                        : ''}}
                                        >{{ ucwords($category->name) }}</option>
                                    @endforeach

                                </select> --}}




                                <div class="flex mt-6">
                                    <div class="block flex-1">
                                        <x-form.button class=" md:w-auto w-full sm:w-auto">
                                            Odoslať
                                        </x-form.button>
                                    </div>
                                    @if(request()->student_id)
                                    <a href="/admin/students"
                                        class='items-center mt-6 px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>Preskočiť</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div id="login" class="section flex-auto p-6"
                            style="{{session('success_d') || session('success_c')  || request()->has('vytvorit') ||  $errors->admin->any() ? '' : 'display: none;' }}">
                            <p class="text-sm font-semibold uppercase text-gray-700 mb-6">Prihlášky študentov</p>
                            <x-single-table>
                                <x-slot:head>
                                            <th scope="col" class="py-3 px-6">Meno študenta</th>
                                            <th scope="col" class="py-3 px-6">Email</th>
                                            <th scope="col" class="py-3 px-6">Dni / čas</th>
                                            <th scope="col" class="py-3 px-6">Potvrdená</th>
                                            <th scope="col" class="py-3 px-6">Vytvorená</th>
                                            <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">Akcie</th>
                                        </x-slot:head>
                                        @foreach ($coursetype->applications as $application)
                                        <tr
                                        class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                            <td class="py-4 px-6"><x-table.td url="students/{{ $application->student->id }}">{{$application->student->name}}
                                                {{$application->student->lastname}}</x-table.td>
                                            </td>
                                            <td class="py-4 px-6">{{$application->student->email}}
                                              
                                            </td>

                                            <td class="py-4 px-6">
                                                {{$application->days== 1 ? 'Týždeň' : ''}} {{$application->days== 2 ?
                                                'Víkend' : ''}}
                                                {{$application->days== 3 ? 'Nezáleží' : ''}} / {{$application->time== 1
                                                ? 'Ranný' : ''}}
                                                {{$application->time== 2 ? 'Poobedný' : ''}} {{$application->time== 3 ?
                                                'Nezáleží' :
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

</x-setting>