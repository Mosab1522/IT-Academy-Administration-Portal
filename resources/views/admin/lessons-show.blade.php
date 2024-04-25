<x-flash />
<x-layout />
@php
// Assuming $lesson->duration contains the duration in minutes
$hours = floor($lesson->duration / 60);
$minutes = $lesson->duration % 60;

// Format the hours and minutes to ensure they are always two digits
$formattedHours = str_pad($hours, 2, '0', STR_PAD_LEFT);
$formattedMinutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);

// Concatenate the formatted hours and minutes with a colon
$timeValue = $formattedHours . ':' . $formattedMinutes;
@endphp
<x-setting heading="{{$lesson->title}}">

    <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
        <x-show-header name="{{$lesson->title}}" title="Hodina" />
{{--   
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">

                <div
                    class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
                    <div class="flex flex-wrap -mx-3">
                        <div class="flex-none w-auto max-w-full px-3">
                            <div
                                class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl"> --}}
                                {{-- <img src="{{asset('storage/' . $instructor->photo)}}" alt="profile_image" style="
                            width: 150px; 
                            height: 150px; 
                            object-fit: cover;
                            object-position: 25% 25%;" class=" shadow-2xl rounded-xl" /> --}}
                            {{-- </div>
                        </div>
                        <div class="flex-none w-auto max-w-full px-3 my-auto">
                            <div class="h-full">
                                <h5 class="text-lg font-semibold mb-1 ">{{$lesson->title}}
                                </h5>
                                <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">
                                    {{$lesson->class->name}} - {{$lesson->class->coursetype->name}}  {{$lesson->class->coursetype->type
                                        == 0 ? 'študentský' : 'inštruktorský'}}</p>
                                <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">{{$lesson->class->academy->name}} akadémia</p>
                            </div>
                        </div>

                        <div
                            class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                            <div class="relative right-0">
                                <ul id="upravy" class="  relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl"
                                    nav-pills role="tablist">
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
                                            <span style="{{request()->has('pridat') ? '' : 'display: none;' }}" id="nkk"
                                                class="ml-2">Zrušiť pridanie
                                                inštruktora</span>
                                        </a> --}}
                                        <x-buttonsection>
                                            <li class="flex-1 {{session('success_c') || session('success_cc') || session('success_dd')  || session('success_d')  || request()->has('pridat') ||request()->has('vytvorit') ? 'hidden' : '' }}">
                                        <button
                                            class="edit-button {{session('success_c') || session('success_cc') || session('success_dd')  || session('success_d')  || request()->has('pridat') ||request()->has('vytvorit') ? 'hidden' : '' }}"
                                            data-target="profile">
                                            <span style="display: inline;">Povoliť
                                                úpravy</span>
                                            <span style="display: none;">Zrušiť úpravy</span>
                                        </button>
                                            </li>
                                            <li
                        class="flex-1 {{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}">
                                        <button
                                            class="add-button {{ session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}"
                                            data-target="kurzyAdd">
                                            <span
                                                class="{{ session('success_cc') || session('success_dd') ? '' : 'hidden' }}">Pridať
                                                inštruktora</span>
                                            <span class="{{request()->has('pridat') ? '' : 'hidden' }}">Zrušiť pridanie
                                                inštruktora</span>
                                        </button>
                                            </li>
                                            <li
                                            class="flex-1 {{ session('success_c') || session('success_d') || request()->has('vytvorit')  ? '' : 'hidden' }}">
                                        <button
                                            class="add-button {{ session('success_c') || session('success_d') || request()->has('vytvorit')  ? '' : 'hidden' }} "
                                            data-target="loginAdd">
                                            <span
                                                class="{{ session('success_c') || session('success_d') ? '' : 'hidden' }}">Pridať študenta</span>
                                            <span class="{{request()->has('vytvorit') ? '' : 'hidden' }}">Zrušiť
                                                pridanie študenta</span>
                                        </button>
                                    </li>
                                </x-buttonsection>
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
                                                class="ml-2  {{session('success_cc') || session('success_d')  || session('success_dd') || request()->has('pridat') ? 'hidden' : '' }}">Inštruktori</span>
                                            <span id="tlac2"
                                                class="{{session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') ? '' : 'hidden' }}  ml-2">Info</span>
                                        </a> --}}
                                        <x-buttonsection>
                                            <li class="flex-auto pr-0.5">
                                        <button
                                            class="section-button {{session('success_c') || session('success_cc') || session('success_d') || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? '' : 'hidden' }} rounded-lg "
                                            data-target="profile">Info</button>
                                        <button
                                            class="section-button {{session('success_c') || session('success_cc') || session('success_d')  || session('success_dd') || request()->has('pridat') || request()->has('vytvorit') ? 'hidden' : '' }} rounded-lg"
                                            data-target="kurzy">Študenti</button>
                                    </li>
                                    {{-- <li class="z-30 flex-auto text-center">
                                        {{-- <a id="tr"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            nav-link href="javascript:;">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span id="lt"
                                                class="ml-2 {{ session('success_d') ? 'hidden' : '' }}">Prihlášky</span>
                                            <span id="kt"
                                                class="{{ session('success_d') ? '' : 'hidden' }} ml-2">Inštruktori</span>
                                        </a> --}}

                                        {{--<button 
                                        class="section-button {{session('success_c') || session('success_d') || request()->has('vytvorit') ? '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                        data-target="kurzy">Inštruktori</button>
                                    <button
                                        class="section-button {{session('success_c') || session('success_d') || request()->has('vytvorit') ? 'hidden' : '' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                        data-target="login">Študenti</button>
                                    </li> --}}
                                </x-buttonsection>





                    </div>
                    
                    <div id="profile" class="section flex-auto p-6"
                        style="{{session('success_c') || session('success_cc') || session('success_d') || session('success_dd')  || request()->has('pridat') || request()->has('vytvorit') ? 'display: none;' : '' }}">
                        <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
                        <form id="formm" action="/admin/lessons/{{$lesson->id}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Patch')
                            <input type="hidden" name="class_id" value="{{$lesson->class->id}}">
                            <x-form.field>
                                <x-form.input
                                    value="{{$lesson->title}}" name="title" type="text" title="Názov" placeholder="Názov" disabled />
                            </x-form.field>
                            <x-form.field>
                                <div class="flex">
                                    <x-form.label name="datetime-local" title="Dátum a trvanie hodiny" />
        
                                </div>
                                <div class="flex">
                                    <input type="datetime-local" name="lesson_date" value="{{$lesson->lesson_date}}"
                                        class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-gray-100 disabled:text-gray-500" disabled>
                                    <input type="time" name="duration"
                                        class="mt-1 ml-4 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-gray-100 disabled:text-gray-500"
                                        step="60" value="{{$timeValue}}" disabled>
        
                                </div>
        
                            </x-form.field> 
                               
                            
                            <x-form.field>
                                <x-form.select name="instructor_id" title="Inštruktor" disabled>
                                                <option style="color: gray;" value="" disabled selected hidden>Inštruktori</option>
                                                @foreach (\App\Models\Instructor::orderBy('name')->get() as $instructor)
                                                <option value="{{ $instructor->id }}" {{$lesson->instructor->id == $instructor->id
                                                    ?
                                                    'selected' : '' }} >{{ ucwords($instructor->name) }} {{ ucwords($instructor->lastname) }}</option>
                                                @endforeach
                                            </x-form.select>
                            </x-form.field>

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

                    <div class="add-section"  id="kurzyAdd"
                        style="{{request()->has('pridat') ? 'display:block;' : 'display: none;' }}">
                        <p class="text-sm font-semibold uppercase text-gray-700">Pridať študenta</p>

                        <form action="/admin/class-student" method="post">
                            @csrf
                            <input type="hidden" name="lesson_id" value="{{$lesson->id}}" />
                            <x-form.field>
                            <x-form.live-search/>
                        </x-form.field>
                                    {{-- @php
                                    $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                    ->get();
                                    @endphp --}}
                                    {{-- @php
                                    $assignedInstructors = $class->instructors->pluck('id')->toArray();
                                    @endphp --}}
                                    {{-- @foreach (\App\Models\Instructor::with(['coursetypes'])->get() as $instructor)

                                    @if(!in_array($instructor->id, $assignedInstructors))

                                    <option value="{{ $instructor->id }}" data-id="{{ $instructor->id }}"
                                        data-option="-1" {{old('instructor_id')==$instructor->id ? 'selected' :
                                        ''}}>Meno: {{
                                        ucwords($instructor->name)}} {{
                                        ucwords($instructor->lastname)}} Email: {{
                                        ucwords($instructor->email)}}</option>
                                    @endif
                                    @endforeach --}}
                                    {{-- <option value="" disabled selected hidden>Akadémia</option>
                                    <option value="1" data-id="1" data-option="-1">Cisco</option>
                                    <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                                {{-- </select>
                            </div> --}}

                            <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                                Odoslať
                            </x-form.button>
                        </form>
                    </div>

                    <div id="kurzy" class="section  flex-auto p-6"
                        style="{{session('success_cc') || session('success_dd') || request()->has('pridat') ? '' : 'display: none;' }}">
                        <x-single-table>
                            <x-slot:head>
                                            <th scope="col" class="py-3 px-6">Meno</th>
                                            <th scope="col" class="py-3 px-6">Email</th>
                                           
                                            <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">Akcie</th>
                                        </x-slot:head>
                                        @foreach ($lesson->students as $student)
                                        <tr
                                    class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                            <td class="py-4 px-6">
                                                <x-table.td url="students/{{ $student->id }}">{{$student->name}} {{$student->lastname}}
                                                </x-table.td></td>
                                            <td class="py-4 px-6">{{$student->email}}</td>
                                           
                                            <x-table.td-last url="students/{{ $student->id }}" edit=1 itemName="študenta {{$student->name}}" />
                                            
                                        </tr>
                                        @endforeach
                                    </x-single-table>
                    </div>
                    {{-- <div class="add-section p-6" id="loginAdd"
                        style="{{request()->has('vytvorit') ? 'display:block;' : 'display: none;' }}">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Pridať študenta</p>

                        <form action="/admin/class-student" method="post">
                            @csrf
                            <input type="hidden" name="lesson_id" value="{{$lesson->id}}" />
                    
                            

                            <div class="flex min-w-full">

                                <div class="w-1/3 h-">
                                    <x-form.input name="name" />
                                    <x-form.input name="lastname" />
                                    <x-form.input name="email" />
                                </div> --}}
                                {{-- <label for="name">Meno:</label>
                                <input type="text" name="name" id="name">

                                <label for="lastname">Priezvisko:</label>
                                <input type="text" name="lastname" id="lastname">

                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email">--}}

                                {{-- <div class="ml-8 w-2/3">
                                    <x-form.field>
                                        <h2 class="mt-6 mb-2 uppercase font-bold text-base">Návrhy</h2> --}}
                                        {{-- <p
                                            class="block mb-2 uppercase font-bold text-sm cursor-pointer text-gray-700"
                                            id="search-results"></p> --}}

                                        {{-- <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                            </div> --}}
                            
                            {{--
                            <x-form.input name="thumbnail" type="file" /> --}}
                            {{--
                            <x-form.textarea name="excerpt" />
                            <x-form.textarea name="body" /> --}}


                            {{-- <div class="flex">
                                <div class="block flex-1">
                                    <x-form.button>
                                        Odoslať
                                    </x-form.button>
                                </div>
                                
                            </div>
                        </form>
                    </div> --}}
                    {{-- <div id="login" class="section shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
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
                            <tbody class="bg-white divide-y divide-gray-200"> --}}
                                {{-- @foreach ($less->students as $student)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="/admin/students/{{ $student->id }}"
                                                    title="Ukázať podrobnosti">

                                                    {{$student->name }}
                                                    {{$student->lastname }}

                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $student->days}}
                                                {{ $student->time}}
                                            </div>
                                        </div>
                                    </td> --}}
                                    {{-- <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $student->created_at->diffForHumans()}}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium ">
                                        <form method="POST" action="/admin/class-student/{{ $student->id }}/{{$class->id}}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="text-xs text-gray-400">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach  --}}
                            {{-- </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}

</x-setting>