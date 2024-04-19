<x-flash />
<x-layout />
<x-setting heading="{{$coursetype->name}}">
   päť
    
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">

                <div
                    class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
                    <div class="flex flex-wrap -mx-3">
                        <div class="flex-none w-auto max-w-full px-3">
                            <div
                                class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                                {{-- <img src="{{asset('storage/' . $instructor->photo)}}" alt="profile_image" style="
                            width: 150px; 
                            height: 150px; 
                            object-fit: cover;
                            object-position: 25% 25%;" class=" shadow-2xl rounded-xl" /> --}}
                            </div>
                        </div>
                        <div class="flex-none w-auto max-w-full px-3 my-auto">
                            <div class="h-full">
                                <h5 class="text-lg font-semibold mb-1 ">{{$coursetype->name}}
                                </h5>
                                <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">
                                    {{$coursetype->academy->name}} akadémia</p>
                                <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">{{$coursetype->type
                                    == 0 ? 'študentský' : 'inštruktorský'}} kurz</p>
                            </div>
                        </div>

                        <div
                            class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                            <div class="relative right-0">
                                <ul id="upravy" class="  relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl"
                                    nav-pills role="tablist">
                                    <li class="z-30 flex-auto text-center">
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
                                            <span style="{{request()->has('pridat') ? '' : 'display: none;' }}" id="nkk"
                                                class="ml-2">Zrušiť pridanie
                                                inštruktora</span>
                                        </a> --}}

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
                                            <span class="{{request()->has('pridat') ? '' : 'hidden' }}">Zrušiť pridanie
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
                                    <li class="z-30 flex-auto text-center ">
                                        {{-- <a id="ku"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            href="javascript:;">
                                            <i class="ni ni-email-83"></i>
                                            <span id="tlac1"
                                                class="ml-2  {{session('success_cc') || session('success_d')  || session('success_dd') || request()->has('pridat') ? 'hidden' : '' }}">Inštruktori</span>
                                            <span id="tlac2"
                                                class="{{session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}  ml-2">Info</span>
                                        </a> --}}

                                        <button
                                            class="section-button {{session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="profile">Info</button>
                                        <button
                                            class="section-button {{session('success_c') || session('success_cc') || session('success_d')  || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? 'hidden' : '' }} z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="kurzy">Inštruktori</button>
                                    </li>
                                    <li class="z-30 flex-auto text-center">
                                        {{-- <a id="tr"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            nav-link href="javascript:;">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span id="lt"
                                                class="ml-2 {{ session('success_d') ? 'hidden' : '' }}">Prihlášky</span>
                                            <span id="kt"
                                                class="{{ session('success_d') ? '' : 'hidden' }} ml-2">Inštruktori</span>
                                        </a> --}}

                                        <button 
                                        class="section-button {{session('success_c') || session('success_d') || request()->has('vytvorit') ? '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                        data-target="kurzy">Inštruktori</button>
                                    <button
                                        class="section-button {{session('success_c') || session('success_d') || request()->has('vytvorit') ? 'hidden' : '' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                        data-target="login">Prihlášky</button>
                                    </li>
                                </ul>
                            </div>
                        </div>





                    </div>
                    <hr
                        class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                    <div id="profile" class="section flex-auto p-6"
                        style="{{session('success_c') || session('success_cc') || session('success_d') || session('success_dd')  || request()->has('pridat') || request()->has('vytvorit') ? 'display: none;' : '' }}">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Coursetype Information</p>
                        <form id="formm" action="/admin/coursetypes/{{$coursetype->id}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Patch')
                            <div class="flex flex-wrap -mx-3">

                                <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                                    <div class="mb-4">
                                        <label for="first name"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">
                                            Name</label>
                                        <input disabled type="text" name="cname" value="{{$coursetype->name}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0">
                                    <div class="mb-4">
                                        <x-form.label name="typ kurzu:" />

                                        <input disabled class="mr-0.5" type="radio" name="type" value="0"
                                            {{$coursetype->type=='0'
                                        ? 'checked' : '' }}>
                                        <label for="0">Študentský</label>

                                        <input disabled class="ml-2 mr-0.5" type="radio" name="type" value="1"
                                            {{$coursetype->type=='1' ? 'checked' : '' }}>
                                        <label for="1">Inštruktorský</label>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div class="w-full mb-4 px-3 shrink-0">
                                        <label for="first name"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">
                                            Academy</label>
                                        <select disabled name="academy_id" id="academy_id" class="w-full">
                                            <option value="" disabled selected hidden>Akadémie</option>

                                            @foreach (\App\Models\Academy::orderBy('name')->get() as $academ)
                                            <option value="{{ $academ->id }}" {{$coursetype->academy->id == $academ->id
                                                ?
                                                'selected' : '' }} >{{ ucwords($academ->name) }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Min</label>
                                        <input disabled type="min" name="min" value="{{$coursetype->min}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="username"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Max</label>
                                        <input disabled type="text" name="max" value="{{$coursetype->max}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
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
                            </div>
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
                                <div class="flex">
                                    <button id="upd" type="submit"
                                        class="hidden flex-1 bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Update</button>
                                    <button id="res" type="reset"
                                        class="hidden flex-none bg-gray-400 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">Reset</button>
                                </div>

                            </x-form.field>

                        </form>
                    </div>

                    <div class="add-section p-6" id="kurzyAdd"
                        style="{{request()->has('pridat') ? 'display:block;' : 'display: none;' }}">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Pridať inštruktora</p>

                        <form action="/admin/coursetype_instructor" method="POST">
                            @csrf
                            <div>

                                <input name="coursetype_id" value="{{$coursetype->id}}" hidden />

                                <x-form.label name="inštruktor" />
                                <!-- parent -->
                                <select name="instructor_id" class="w-full">
                                    <option value="" disabled selected hidden>Inštruktori</option>
                                    {{-- @php
                                    $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                    ->get();
                                    @endphp --}}
                                    @php
                                    $assignedInstructors = $coursetype->instructors->pluck('id')->toArray();
                                    @endphp
                                    @foreach (\App\Models\Instructor::with(['coursetypes'])->get() as $instructor)

                                    @if(!in_array($instructor->id, $assignedInstructors))

                                    <option value="{{ $instructor->id }}" data-id="{{ $instructor->id }}"
                                        data-option="-1" {{old('instructor_id')==$instructor->id ? 'selected' :
                                        ''}}>Meno: {{
                                        ucwords($instructor->name)}} {{
                                        ucwords($instructor->lastname)}} Email: {{
                                        ucwords($instructor->email)}}</option>
                                    @endif
                                    @endforeach
                                    {{-- <option value="" disabled selected hidden>Akadémia</option>
                                    <option value="1" data-id="1" data-option="-1">Cisco</option>
                                    <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                                </select>
                            </div>

                            <x-form.field>
                                <button id="pridbtn" type="submit"
                                    class=" flex-1 bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Pridať
                                </button>
                            </x-form.field>
                        </form>
                    </div>

                    <div id="kurzy" class="section shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                        style="{{session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'display: none;' }}">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="text-sm">
                                <tr>
                                    <td class="px-6 py-1">Meno a priezvisko</td>
                                    <td class="px-6 py-2"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($coursetype->instructors as $instructor)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="/admin/instructors/{{ $instructor->id }}"
                                                    title="Ukázať podrobnosti">

                                                    {{$instructor->name }}
                                                    {{$instructor->lastname }}

                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$instructor->email }}

                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $instructor->created_at->diffForHumans()}}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/admin/instructors/{{ $instructor->id }}"
                                            class="text-blue-500 hover:text-blue-600">Edit</a>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST"
                                            action="{{ route('your.route.name', ['instructor' => $instructor, 'coursetype' => $coursetype]) }}">

                                            @csrf
                                            @method('DELETE')
                                            <input name="coursetype_id" value="{{$coursetype->id}}" hidden />

                                            <button class="text-xs text-gray-400">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="add-section p-6" id="loginAdd"
                        style="{{request()->has('vytvorit') ? 'display:block;' : 'display: none;' }}">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Vytvoriť prihlášku</p>

                        <form action="/" method="post">
                            @csrf
                            <input type="hidden" name="typ" value="admin" />
                            @if(request()->student_id)
                            @php
                            session(['student_id' => request()->student_id]);
                            @endphp
                            @endif
                            @unless(session('student_id'))

                            <div class="flex min-w-full">

                                <div class="w-1/3 h-">
                                    <x-form.input name="name" />
                                    <x-form.input name="lastname" />
                                    <x-form.input name="email" />
                                </div>
                                {{-- <label for="name">Meno:</label>
                                <input type="text" name="name" id="name">

                                <label for="lastname">Priezvisko:</label>
                                <input type="text" name="lastname" id="lastname">

                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email">--}}

                                <div class="ml-8 w-2/3">
                                    <x-form.field>
                                        <h2 class="mt-6 mb-2 uppercase font-bold text-base">Návrhy</h2>
                                        {{-- <p
                                            class="block mb-2 uppercase font-bold text-sm cursor-pointer text-gray-700"
                                            id="search-results"></p> --}}

                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                            <table id=""
                                                class="bg-white min-w-full divide-y divide-gray-200 text-sm font-medium text-gray-900">
                                                <tr>
                                                    <th class="py-2 w-20">Meno</th>
                                                    <th class="w-1/12">Priezvisko</th>
                                                    <th class="w-1/4">Email</th>
                                                    <th>Doplňujúce informácie</th>
                                                </tr>

                                            </table>
                                            <table id="search-results"
                                                class="bg-white min-w-full divide-y  divide-gray-200 text-sm font-medium text-gray-900">


                                            </table>
                                        </div>
                                    </x-form.field>
                                </div>
                            </div>
                            @else
                            @php

                            $student = \App\Models\Student::find(session('student_id'));
                            @endphp
                            <x-form.input name="name" value="{{$student->name}}" disabled />
                            <x-form.input name="lastname" value="{{$student->lastname}}" disabled />
                            <x-form.input name="email" value="{{$student->email}}" disabled />
                            <input name="name" value="{{$student->name}}" hidden />
                            <input name="lastname" value="{{$student->lastname}}" hidden />
                            <input name="email" value="{{$student->email}}" hidden />
                            @endunless
                            {{--
                            <x-form.input name="thumbnail" type="file" /> --}}
                            {{--
                            <x-form.textarea name="excerpt" />
                            <x-form.textarea name="body" /> --}}

                            <x-form.field>
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
                                    <div class="flex">
                                        <div>
                                            <x-form.label name="dni výučby" />
                                            <select name="days" id="days">
                                                <option value="" disabled selected hidden>Dni výučby</option>
                                                <option value="1" {{old('days')==1 ? 'selected' : '' }}>Týždeň</option>
                                                <option value="2" {{old('days')==2 ? 'selected' : '' }}>Víkend</option>
                                                <option value="3" {{old('days')==3 ? 'selected' : '' }}>Nezáleží
                                                </option>
                                                {{-- <option value="1" data-id="1" data-option="2">Týždeň</option>
                                                <option value="1" data-id="1" data-option="3">Týždeň</option>
                                                <option value="2" data-id="2" data-option="3">Víkend</option>
                                                <option value="3" data-id="3" data-option="3">Nezáleží</option>
                                                <option value="1" data-id="1" data-option="4">Týždeň</option> --}}
                                            </select>
                                        </div>
                                        <div class="ml-4">
                                            <x-form.label name="čas výučby" />
                                            <select name="time" id="time">
                                                <option value="" disabled selected hidden>Čas výučby</option>
                                                <option value="1" {{old('time')==1 ? 'selected' : '' }}>Ranný</option>
                                                <option value="2" {{old('time')==3 ? 'selected' : '' }}>Poobedný
                                                </option>
                                                <option value="3" {{old('time')==3 ? 'selected' : '' }}>Nezáleží
                                                </option>
                                                {{-- <option value="1" data-id="1" data-option="2">Ranný</option>
                                                <option value="4" data-id="1" data-option="3">Ranný (Týždeň/Víkend)
                                                </option>
                                                <option value="5" data-id="2" data-option="3">Poobedný (Týždeň)</option>
                                                <option value="3" data-id="3" data-option="3">Nezáleží</option>
                                                <option value="1" data-id="1" data-option="4">Ranný</option> --}}
                                            </select>
                                        </div>
                                    </div>
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


                                <x-form.error name="category" />
                            </x-form.field>

                            <div class="flex">
                                <div class="block flex-1">
                                    <x-form.button>
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
                    <div id="login" class="section shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                        style="{{session('success_d') || session('success_c')  || request()->has('vytvorit')? '' : 'display: none;' }}">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="text-sm">
                                <tr>
                                    <td class="px-6 py-1">Názov typu kurzu</td>
                                    <td class="px-6 py-2">Days - Time</td>
                                    <td class="px-6 py-2">Vytvorená</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($coursetype->applications as $application)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="/admin/students/{{ $application->student->id }}"
                                                    title="Ukázať podrobnosti">

                                                    {{$application->student->name }}
                                                    {{$application->student->lastname }}

                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $application->days}}
                                                {{ $application->time}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
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
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-setting>