<x-layout />
<x-flash />
<x-setting heading="{{$class->name}}">
    {{-- <a href="{{ url()->previous() }}"
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
                            <div
                                class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                                --}}
                                {{-- <img src="{{asset('storage/' . $instructor->photo)}}" alt="profile_image" style="
                            width: 150px; 
                            height: 150px; 
                            object-fit: cover;
                            object-position: 25% 25%;" class=" shadow-2xl rounded-xl" /> --}}
                                {{-- </div>
                        </div>
                        <div class="flex-none w-auto max-w-full px-3 my-auto">
                            <div class="h-full">
                                <h5 class="text-lg font-semibold mb-1 ">{{$class->name}}
                                </h5>
                                <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">
                                    {{$class->coursetype->name}} - {{$class->academy->name}} akadémia</p>
                                <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">
                                    {{$class->coursetype->type
                                    == 0 ? 'študentský' : 'inštruktorský'}} kurz</p>
                                <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">
                                    {{$class->coursetype->min}} - {{$class->coursetype->max}} študentov</p>

                            </div>
                        </div> --}}
                        <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
                            <x-show-header name="{{$class->name}}" title="Trieda" />
                            <x-buttonsection>
                                <li class="flex-1 {{ session('success_d') || session('success_c') ||  $errors->default->any() || session('success_cc') || session('success_dd') ||  $errors->admin->any()  ? 'hidden' : '' }}">
                                    <button
                                        class="edit-button {{session('success_c') || session('success_cc') || session('success_dd')  || session('success_d')  || request()->has('pridat') ||request()->has('vytvorit') ||  $errors->default->any() ||  $errors->admin->any()  ? 'hidden' : '' }} "
                                        data-target="profile">
                                        <span style="display: inline;">Povoliť
                                            úpravy</span>
                                        <span style="display: none;">Zrušiť úpravy</span>
                                    </button>
                                </li>
                                <li
                                    class="flex-1 {{ session('success_c') || session('success_d') || request()->has('pridat') ||  $errors->default->any()  ? '' : 'hidden' }}">
                                    <button
                                        class="add-button z-30 {{ session('success_c') || session('success_d') || request()->has('pridat') ||  $errors->default->any() ? '' : 'hidden' }} "
                                        data-target="kurzyAdd">
                                        <span
                                            class="{{ session('success_c') || session('success_d') ? '' : 'hidden' }}">Vytvoriť hodinu</span>
                                        <span class="{{request()->has('pridat') ||  $errors->default->any()  ? '' : 'hidden' }}">Zrušiť vytvorenie
                                            hodiny</span>
                                    </button>
                                </li>
                                <li
                                    class="flex-1 {{ session('success_cc') || session('success_dd') || request()->has('pridat') ||  $errors->admin->any() ? '' : 'hidden' }}">
                                    <button
                                        class="add-button z-30 {{  session('success_cc') || session('success_dd') ||  $errors->admin->any() || request()->has('vytvorit')  ? '' : 'hidden' }}"
                                        data-target="loginAdd">
                                        <span
                                            class="{{ session('success_cc') || session('success_dd') ? '' : 'hidden' }}">Pridať
                                            študenta</span>
                                        <span class="{{request()->has('vytvorit') ||  $errors->admin->any() ? '' : 'hidden' }}">Zrušiť
                                            pridanie študenta</span>
                                </li>
                            </x-buttonsection>
                            {{-- <div
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

                                            {{-- <button
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
                                                    class="{{ session('success_c') || session('success_d') ? '' : 'hidden' }}">Pridať
                                                    študenta</span>
                                                <span class="{{request()->has('vytvorit') ? '' : 'hidden' }}">Zrušiť
                                                    pridanie študenta</span>
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
                                            <x-buttonsection>
                                        <li class="flex-auto pr-0.5">
                                            <button
                                                class="section-button {{session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ||  $errors->default->any() ||  $errors->admin->any() ? '' : 'hidden' }} rounded-l-lg"
                                                data-target="profile">Info</button>
                                            <button
                                                class="section-button {{session('success_c') || session('success_cc') || session('success_d')  || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ||  $errors->default->any() ||  $errors->admin->any() ? 'hidden' : '' }} rounded-l-lg"
                                                data-target="kurzy">Hodiny</button>
                                        </li>
                                        <li class="flex-auto">

                                            <button
                                                class="section-button {{  request()->has('vytvorit') || session('success_cc') || session('success_dd') ||  $errors->admin->any()  ? '' : 'hidden' }} rounded-r-lg"
                                                data-target="kurzy">Hodiny</button>
                                            <button
                                                class="section-button {{  request()->has('vytvorit') || session('success_cc') || session('success_dd') ||  $errors->admin->any()  ? 'hidden' : '' }} rounded-r-lg"
                                                data-target="login">Študenti</button>
                                        </li>
                                        </x-buttonsection>
                                        {{-- <a id="ku"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            href="javascript:;">
                                            <i class="ni ni-email-83"></i>
                                            <span id="tlac1"
                                                class="ml-2  {{session('success_cc') || session('success_d')  || session('success_dd') || request()->has('pridat') ? 'hidden' : '' }}">Inštruktori</span>
                                            <span id="tlac2"
                                                class="{{session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}  ml-2">Info</span>
                                        </a> --}}

                                        {{-- <button
                                            class="section-button {{session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? '' : 'hidden' }} rounded-l-lg"
                                            data-target="profile">Info</button>
                                        <button
                                            class="section-button {{session('success_c') || session('success_cc') || session('success_d')  || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? 'hidden' : '' }} rounded-l-lg"
                                            data-target="kurzy">Inštruktori</button>
                                        </li>
                                        <li class="flex-auto"> --}}
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
                                                class="section-button {{session('success_c') || session('success_d') || request()->has('vytvorit') ? '' : 'hidden' }} rounded-r-lg"
                                                data-target="kurzy">Inštruktori</button>
                                            <button
                                                class="section-button {{session('success_c') || session('success_d') || request()->has('vytvorit') ? 'hidden' : '' }} rounded-r-lg"
                                                data-target="login">Študenti</button>
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
                            style="{{session('success_c') || session('success_cc') || session('success_d') || session('success_dd')  || request()->has('pridat') || request()->has('vytvorit') ||  $errors->default->any() ||  $errors->admin->any()  ? 'display: none;' : '' }}">
                            <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
                            <form id="formm" action="/admin/classes/{{$class->id}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('Patch')
                                <x-form.required class=" hidden mt-1 "/>
                                <x-form.field>
                                    <x-form.input value="{{$class->name}}" name="cname" type="text" title="Názov"
                                        placeholder="Názov" errorBag="updateClass" disabled required="true"/>
                                </x-form.field>
                                {{-- <div class="w-full max-w-full px-3 shrink-0">
                                    <div class="mb-4">
                                        <x-form.label name="typ kurzu:" />

                                        <input disabled class="mr-0.5" type="radio" name="type" value="0"
                                            {{$class->coursetype->type=='0'
                                        ? 'checked' : '' }}>
                                        <label for="0">Študentský</label>

                                        <input disabled class="ml-2 mr-0.5" type="radio" name="type" value="1"
                                            {{$class->coursetype->type=='1' ? 'checked' : '' }}>
                                        <label for="1">Inštruktorský</label>
                                    </div>
                                </div> --}}
                                <div class="flex">
                                    <div class="mt-6 w-1/2 mr-2">

                                        <x-form.select name="days" title="Dni" required="true" errorBag="updateClass"  disabled>

                                            <option value="" disabled hidden>Dni výučby</option>
                                            <option value="1" {{$class->days==1 ? 'selected' : '' }}>Týždeň</option>
                                            <option value="2" {{$class->days==2 ? 'selected' : '' }}>Víkend</option>
                                            <option value="3" {{$class->days==3 ? 'selected' : '' }}>Nezáleží</option>
                                            {{-- <option value="1" data-id="1" data-option="2">Týždeň</option>
                                            <option value="1" data-id="1" data-option="3">Týždeň</option>
                                            <option value="2" data-id="2" data-option="3">Víkend</option>
                                            <option value="3" data-id="3" data-option="3">Nezáleží</option>
                                            <option value="1" data-id="1" data-option="4">Týždeň</option> --}}
                                        </x-form.select>
                                    </div>

                                    <div class="mt-6 w-1/2 ml-2">
                                        <x-form.select name="time" title="Čas" required="true" errorBag="updateClass"  disabled>

                                            <option value="" disabled hidden>Čas výučby</option>
                                            <option value="1" {{$class->time == 1 ? 'selected' : '' }}>Ranný</option>
                                            <option value="2" {{$class->time == 3 ? 'selected' : '' }}>Poobedný</option>
                                            <option value="3" {{$class->time == 3 ? 'selected' : '' }}>Nezáleží</option>
                                            {{-- <option value="1" data-id="1" data-option="2">Ranný</option>
                                            <option value="4" data-id="1" data-option="3">Ranný (Týždeň/Víkend)</option>
                                            <option value="5" data-id="2" data-option="3">Poobedný (Týždeň)</option>
                                            <option value="3" data-id="3" data-option="3">Nezáleží</option>
                                            <option value="1" data-id="1" data-option="4">Ranný</option> --}}
                                        </x-form.select>

                                    </div>
                                </div>
                                {{-- <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Min</label>
                                        <input disabled type="min" name="min" value="{{$class->coursetype->min}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="username"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Max</label>
                                        <input disabled type="text" name="max" value="{{$class->coursetype->max}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div> --}}
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

                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Contact Information</p> --}}
                        {{-- <div class="flex flex-wrap -mx-3">

                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">

                                <div class="mb-4">
                                    <label for="city"
                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Ulica a
                                        číslo</label>
                                    <input disabled type="text" name="ulicacislo" value="{{$academy->ulicacislo}}"
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
                        style="{{request()->has('pridat') ||  $errors->default->any()  ? 'display:block;' : 'display: none;' }}">
                        <p class="text-sm font-semibold uppercase text-gray-700">Vytvoriť hodinu</p>

                        <form action="/admin/lessons/create" method="post">
                            @csrf
                            <x-form.required class="mt-1"/>

                            <input name="class_id" value="{{$class->id}}" hidden />
                            <x-form.field>
                                <x-form.input name="title" type="text" title="Názov hodiny"
                                    placeholder="Názov hodiny" required="true"/>
                            </x-form.field>

                            <x-form.field>
                                <div class="flex">
                                    <x-form.label name="datetime-local" title="Dátum a trvanie hodiny" required="true"/>

                                </div>
                                <div class="flex">
                                    <div class="w-1/2 mr-2">
                                    <input type="datetime-local" name="lesson_date" value="{{ old('lesson_date')}}"
                                        class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        <x-form.error name="lesson_date" errorBag="default"/>
                                    </div>
                                    <div class="w-1/2 ml-2">
                                    <input type="time" name="duration"
                                        class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required
                                        step="60" value="{{ old('duration', '00:45') }}">
                                        <x-form.error name="duration" errorBag="default"/>
                                    </div>
                                </div>

                            </x-form.field>

                            <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                                Odoslať
                            </x-form.button>
                        </form>
                    </div>

                    <div id="kurzy" class="section flex-auto p-6"
                        style="{{session('success_c') || session('success_d') || request()->has('pridat') ||  $errors->default->any()  ? '' : 'display: none;' }}">
                        <p class="text-sm font-semibold uppercase text-gray-700">Hodiny triedy</p>
                        <x-single-table>
                            <x-slot:head>
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            Názov hodiny
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Inštruktor
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Dátum a trvanie
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">Akcie</th>
                    </x-slot:head>
                                    <!-- Iterate over lessons in this class -->
                                    @foreach ($class->lessons as $lesson)
                                    <tr
                                        class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                        <td class="py-4 px-6">
                                            <x-table.td url="lessons/{{ $lesson->id }}">
                                            {{ $lesson->title }}
                                            </x-table.td>
                                        </td>
                                        <td class="py-4 px-6">
                                            <x-table.td url="instructors/{{ $lesson->instructor->id }}">
                                            {{ $lesson->instructor->name }} {{ $lesson->instructor->lastname }}
                                            </x-table.td>
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $lesson->lesson_date }} - {{ $lesson->duration }} minút
                                        </td>
                                        <x-table.td-last url="lessons/{{ $lesson->id }}" edit=1 itemName="hodinu {{$lesson->title}}" />
                                      
                                    </tr>
                                    @endforeach
                                </x-single-table>
                    </div>
                    <div class="add-section" id="loginAdd"
                        style="{{request()->has('vytvorit') ||  $errors->admin->any() ? 'display:block;' : 'display: none;' }}">
                        <p class="text-sm font-semibold uppercase text-gray-700">Pridať študenta</p>

                        <form action="/admin/class-student" method="post">
                            @csrf
                            <input type="hidden" name="class_id" value="{{$class->id}}" />


                            <x-form.field>
                            <x-form.live-search/>
                        </x-form.field>

                            {{--
                            <x-form.input name="thumbnail" type="file" /> --}}
                            {{--
                            <x-form.textarea name="excerpt" />
                            <x-form.textarea name="body" /> --}}


                            <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                                Odoslať
                            </x-form.button>
                        </form>
                    </div>
                    <div id="login" class="section flex-auto p-6 "
                        style="{{ request()->has('vytvorit') || session('success_cc') || session('success_dd') ||  $errors->admin->any() ? '' : 'display: none;' }}">
                        <p class="text-sm font-semibold uppercase text-gray-700 mb-6">Študenti v triede</p>
                        <x-single-table>
                            <x-slot:head>
                                        <th scope="col" class="py-3 px-6">Meno</th>
                                        <th scope="col" class="py-3 px-6">Email</th>
                                        <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">Akcie</th>
                                    </x-slot:head>
                                    @foreach ($class->students as $student)
                                    <tr
                                        class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                        <td class="py-4 px-6">  <x-table.td url="students/{{ $student->id }}">
                                            {{$student->name}} {{$student->lastname}}
                                            </x-table.td></td>
                                        <td class="py-4 px-6">{{$student->email}}</td>

                                        <x-table.td-last url="class-student/{{ $student->id }}/{{$class->id}}" edit=1 itemName="študenta {{$student->name}}" />
                                       
                                    </tr>
                                    @endforeach
                                </x-single-table>
                    </div>

</x-setting>