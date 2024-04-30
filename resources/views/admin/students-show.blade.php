<x-layout />
<x-setting heading="{{ $student->name }}">


    <div class="flex flex-wrap px-6 pb-10 border-b border-gray-200">
        <x-show-header name="{{$student->name}} {{$student->lastname}}" title="Študent" />
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
                                    <h5 class="text-lg font-semibold mb-1 ">{{ $student->name }} {{ $student->lastname
                                        }}
                                    </h5>
                                    <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">Študent</p>
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
                                                    class="ml-2  {{session('success_c') || session('success_d') || request()->has('pridat') ? 'hidden' : '' }}">Povoliť
                                                    úpravy</span>--}}
                                                {{-- <a style="display: none;" id="kk" class="ml-2"
                                                    href="{{route('applications', ['student_id' =>$student->id])}}">Vytvoriť
                                                    prihláśku</a> --}}
                                                {{-- <span style="display: none;" id="zz" class="ml-2">Zrušiť
                                                    úpravy</span>
                                                <span id="kk"
                                                    class="ml-2 {{ session('success_c') || session('success_d') ? '' : 'hidden' }}">Vytvoriť
                                                    prihlášku</span>
                                                <span style="{{request()->has('pridat') ? '' : 'display: none;' }}"
                                                    id="nkk" class="ml-2">Zrušiť vytvorenie prihlášky</span>
                                            </a> --}}
                                            <x-buttonsection>
                                        <li class="flex-1 {{session('success_c')|| session('success_d')|| request()->has('pridat') ||  $errors->admin->any() ? 'hidden' : '' }}">
                                            <button
                                                class="edit-button {{ session('success_c') || session('success_d') || request()->has('pridat') ||  $errors->admin->any() ? 'hidden' : '' }} "
                                                data-target="profile">
                                                <span id="resetbutton" style="display: inline;">Povoliť
                                                    úpravy</span>
                                                <span style="display: none;">Zrušiť úpravy</span>
                                            </button>
                                        </li>
                                        <li
                                            class="flex-1 {{ session('success_c') || session('success_d') || request()->has('pridat') ||  $errors->admin->any() ? '' : 'hidden' }}">
                                            <button
                                                class="add-button  {{ session('success_c') || session('success_d') || request()->has('pridat') ||  $errors->admin->any() ? '' : 'hidden' }}  "
                                                data-target="kurzyAdd">
                                                <span
                                                    class="{{ session('success_c') || session('success_d') ? '' : 'hidden' }}">Vytvoriť
                                                    prihlášku</span>
                                                <span class="{{ request()->has('pridat') ||  $errors->admin->any() ? '' : 'hidden' }}">Zrušiť
                                                    vytvorenie prihlášky</span>
                                            </button>
                                        </li>
                                        </x-buttonsection>


                                        {{--
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
                                                    class="ml-2 {{session('success_c') || session('success_d') || request()->has('pridat') ? 'hidden' : '' }}">Prihlášky</span>
                                                <span id="tlac2"
                                                    class="{{session('success_c') || session('success_d')|| request()->has('pridat') ? '' : 'hidden' }}  ml-2">Profil</span>
                                            </a> --}}
                                            <x-buttonsection>
                                        <li class="flex-auto pr-0.5">
                                            <button
                                                class="section-button {{ session('success_c') || session('success_d') || request()->has('pridat') ||  $errors->admin->any() ? '' : 'hidden' }} rounded-lg"
                                                data-target="profile">Profil</button>
                                            <button
                                                class="section-button {{ session('success_c') || session('success_d') || request()->has('pridat') ||  $errors->admin->any() ? 'hidden' : '' }} rounded-lg"
                                                data-target="kurzy">Prihlasky</button>
                                        </li>
                                        </x-buttonsection>

                                        {{-- <li class="hidden" class="z-30 flex-auto text-center">
                                            <a id="tr"
                                                class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                                nav-link href="javascript:;">
                                                <i class="ni ni-settings-gear-65"></i>
                                                <span id="lt"
                                                    class="ml-2 {{session('success_c') || session('success_d') ? 'hidden' : '' }}">Login</span>
                                                <span id="kt"
                                                    class="{{session('success_c') || session('success_d') ? '' : 'hidden' }} ml-2">Kurzy</span>
                                            </a>
                                        </li> --}}




                                </div>

                                <div id="profile" class="section flex-auto p-6"
                                    style="{{ session('success_c') || session('success_d') || request()->has('pridat') ||  $errors->admin->any() ? 'display: none;' : '' }}">
                                    <p class="text-sm font-semibold uppercase text-gray-700">Všeobecné informácie</p>
                                    <form id="formm" action="/admin/students/{{ $student->id }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('Patch')
                                        <x-form.required class=" hidden mt-1 " />
                                        <x-form.field>
                                            <x-form.input value="{{$student->name}}" name="name" type="text"
                                                title="Meno" placeholder="Meno" disabled required="true"/>
                                        </x-form.field>
                                        <x-form.field>
                                            <x-form.input value="{{$student->lastname}}" name="lastname" type="text"
                                                title="Priezvisko" placeholder="Priezvisko" disabled required="true"/>
                                        </x-form.field>
                                        <x-form.field>
                                            <x-form.input value="{{$student->email}}" name="email" type="email"
                                                title="Email" placeholder="Email" disabled required="true"/>
                                        </x-form.field>
                                        <x-form.field>
                                            <x-form.input value="{{$student->sekemail}}" name="sekemail" type="email"
                                                title="Sekunarny email" placeholder="Sekunarny email" disabled/>
                                        </x-form.field>
                                        {{-- <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                            <div class="mb-4">
                                                <label for="email"
                                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Status</label>
                                                <input disabled type="text" name="status" value="{{$student->status}}"
                                                    class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                            </div>
                                        </div>
                                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                            <div class="mb-4">
                                                <label for="email"
                                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Škola</label>
                                                <input disabled type="text" name="skola" value="{{$student->skola}}"
                                                    class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                            </div>
                                        </div>
                                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                            <div class="mb-4">
                                                <label for="email"
                                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Štúdium</label>
                                                <input disabled type="text" name="studium" value="{{$student->studium}}"
                                                    class="focus:shadow-primary-outline dark:bg-slate-850  text-sm textleading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                            </div>
                                        </div>
                                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                            <div class="mb-4">
                                                <label for="email"
                                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Program</label>
                                                <input disabled type="text" name="program" value="{{$student->program}}"
                                                    class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                            </div>
                                        </div> --}}
                                        <p class="text-sm font-semibold uppercase text-gray-700 mt-6">Osobné informácie
                                        </p>
                                        <div class="flex flex-col  md:grid md:grid-cols-2 lg:flex lg:flex-row  gap-6">
                                            <div class=" mt-6">
                                                <x-form.label name="status" title="Status" required="true"/>

                                                <div class="flex items-center mt-1">
                                                    <x-form.input-radio name="status" for="type_student" value="student"
                                                        :checked="$student->status == 'student'" disabled required="true">
                                                        Študent
                                                    </x-form.input-radio>

                                                    <x-form.input-radio class="ml-4" name="status" for="type_nostudent"
                                                        value="nestudent" :checked="$student->status == 'nestudent'"
                                                        disabled required="true">
                                                        Neštudent
                                                    </x-form.input-radio>

                                                </div>
                                                <x-form.error name="status" errorBag="default"/>
                                            </div>

                                            <!-- University selection -->
                                            <div class="flex flex-col mt-0 md:mt-6 {{ $student->skola ? '' : 'hidden' }}"
                                                id="ucm">
                                                <x-form.label name="skola" title="Škola" required="true"/>
                                                <div class="flex mt-1">
                                                    <div class="flex items-center mr-4">
                                                        <x-form.input-radio name="skola" for="ucmka" value="ucm"
                                                            :checked="$student->skola == 'ucm'" disabled required="true">
                                                            UCM
                                                        </x-form.input-radio>

                                                        {{-- <input type="radio" id="ucmka" name="skola" value="ucm"
                                                            class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                            {{ $student->skola == 'ucm' ? 'checked' : '' }} disabled>
                                                        <label for="ucmka" class="ml-2  text-gray-700">UCM</label> --}}
                                                    </div>
                                                    <div class="flex items-center">
                                                        <x-form.input-radio name="skola" for="inam" value="ina"
                                                            :checked="$student->skola !== 'ucm' && $student->skola !== null"
                                                            disabled required="true">
                                                            Iná
                                                        </x-form.input-radio>

                                                        {{-- <input type="radio" id="inam" name="skola" value="ina"
                                                            class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                            {{ $student->skola == 'ucm' || $student->skola == null ? ''
                                                        :
                                                        ' checked' }} disabled>
                                                        <label for="inam" class="ml-2  text-gray-700">Iná</label> --}}
                                                    </div>
                                                </div>
                                                <x-form.error name="skola" errorBag="default"/>

                                            </div>

                                            <!-- Study type selection -->
                                            <div class="flex flex-col mt-0 lg:mt-6 {{ $student->skola == 'ucm' ? '' : 'hidden' }}"
                                                id="ucmkari">
                                                <x-form.label name="studium" title="Druh štúdia" required="true" />
                                                <div class="flex mt-1">
                                                    <div class="flex items-center mr-4">
                                                        <x-form.input-radio name="studium" for="option3" value="interne"
                                                            :checked=" $student->studium == 'interne'" disabled required="true">
                                                            Interné
                                                        </x-form.input-radio>

                                                        {{-- <input type="radio" id="option3" name="studium"
                                                            value="interne"
                                                            class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                            {{ $student->studium == 'interne' ? 'checked' : '' }}
                                                        disabled>
                                                        <label for="option3" class="ml-2  text-gray-700">Interné</label>
                                                        --}}
                                                    </div>
                                                    <div class="flex items-center">
                                                        <x-form.input-radio name="studium" for="option4" value="externe"
                                                            :checked=" $student->studium == 'externe'" disabled required="true">
                                                            Externé
                                                        </x-form.input-radio>
                                                        {{-- <input type="radio" id="option4" name="studium"
                                                            value="externe"
                                                            class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                            {{ $student->studium == 'externe' ? 'checked' : '' }}
                                                        disabled>
                                                        <label for="option4" class="ml-2  text-gray-700">Externé</label>
                                                        --}}
                                                    </div>
                                                </div>
                                                <x-form.error name="studium" errorBag="default"/>
                                            </div>

                                            <!-- Program selection -->
                                            <div class="flex flex-col mt-0 lg:mt-6 {{ $student->skola == 'ucm' ? '' : 'hidden' }}"
                                                id="ucmkari2">
                                                <x-form.label name="program" title="Program" required="true"/>
                                                <div class="flex lg:mt-1">
                                                    <div class="flex items-center lg:items-baseline mr-4">

                                                        <input type="radio" id="option5" name="program" value="apin"
                                                            class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 disabled:text-gray-500"
                                                            {{ $student->program == 'apin' ? 'checked' : '' }} disabled required>
                                                        <label for="option5"
                                                            class="ml-2 lg:-mt-2  text-gray-700">Aplikovaná
                                                            informatika</label>
                                                    </div>
                                                    <div class="flex items-center lg:items-baseline">
                                                        <input type="radio" id="option6" name="program" value="iny"
                                                            class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 disabled:text-gray-500"
                                                            {{ $student->program == 'apin' || $student->program == null
                                                        ? ''
                                                        :
                                                        ' checked' }} disabled required>
                                                        <label for="option6"
                                                            class="ml-2 lg:-mt-2  text-gray-700">Iný</label>
                                                    </div>
                                                </div>
                                                <x-form.error name="program" errorBag="default"/>
                                            </div>
                                        </div>
                                        <div id="ina"
                                            class="mt-4 {{ $student->skola == 'ucm' || $student->skola == null ? 'hidden' : '' }}">
                                            <input type="text" disabled
                                                class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6 {{ $student->skola == 'ucm' || $student->skola == null ? 'hidden' : '' }}"
                                                name="ina" id="nu" placeholder="Názov školy"
                                                value="{{ $student->skola == 'ucm' ? '' : $student->skola }}">
                                                <x-form.error name="ina" errorBag="default"/>
                                        </div>
                                        <div id="iny"
                                            class="mt-4 {{ $student->program == 'apin' || $student->program == null ? 'hidden' : '' }}">
                                            <input type="text" disabled
                                                class="mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6 {{ $student->program == 'apin' || $student->program == null ? 'hidden' : '' }}"
                                                name="iny" id="ny" placeholder="Názov programu"
                                                value="{{ $student->program == 'apin' ? '' : $student->program }}">
                                                <x-form.error name="iny" errorBag="default"/>
                                        </div>

                                        {{--

                                        <div class="items-center">
                                            <x-form.label name="JE:" />
                                            <input disabled class="mr-0.5" type="radio" id="student" name="status"
                                                value="student" {{ $student->status == 'student' ? 'checked' : '' }}>
                                            <label for="student">Študent</label>
                                            <input disabled class="ml-2 mr-0.5" type="radio" id="nestudent"
                                                name="status" value="nestudent" {{ $student->status == 'nestudent' ?
                                            'checked' : '' }}>
                                            <label for="nestudent">Neštudent</label>
                                        </div>
                                        <div class="flex pb-1">

                                            <div class="h-20 mt-3 {{ $student->skola ? '' : 'hidden' }}" id="ucm">
                                                <x-form.label name="univerzita:" />
                                                <div class=" flex">
                                                    <div>
                                                        <input disabled type="radio" id="ucmka" name="skola" value="ucm"
                                                            {{ $student->skola == 'ucm' ? 'checked' : '' }}>
                                                        <label for="option1">UCM</label><br>
                                                        <div class="mt-1">
                                                            <input disabled type="radio" id="inam" name="skola"
                                                                value="ina" {{ $student->skola == 'ucm' ||
                                                            $student->skola == null ? ''
                                                            :
                                                            ' checked' }}>
                                                            <label for="option2">Iná</label><br>
                                                        </div>
                                                    </div>
                                                    <div id="ina"
                                                        class="{{ $student->skola == 'ucm' || $student->skola == null ? 'hidden' : '' }}">
                                                        <input disabled
                                                            class="{{ $student->skola == 'ucm' || $student->skola == null ? 'hidden' : '' }} border border-gray-200 mt-6 ml-2 p-2 w-80 rounded h-7"
                                                            name="ina" id="nu" required
                                                            value="{{ $student->skola == 'ucm' ? '' : $student->skola }}"
                                                            --}} {{-- $student->skola=='ina' ? '' : 'disabled' --}}
                                                        {{--
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ml-4 mt-3 {{ $student->skola == 'ucm' ? '' : 'hidden' }}"
                                                id="ucmkari">
                                                <x-form.label name="studium:" />
                                                <input disabled type="radio" id="option3" name="studium" value="interne"
                                                    {{ $student->studium == 'interne' ? 'checked' : '' }}>
                                                <label for="option1">Interné</label><br>
                                                <div class="mt-1">
                                                    <input disabled type="radio" id="option4" name="studium"
                                                        value="externe" {{ $student->studium == 'externe' ? 'checked' :
                                                    '' }}>
                                                    <label for="option2">Externé</label><br>
                                                </div>
                                            </div>
                                            <div class="ml-4 mt-3 {{ $student->skola == 'ucm' ? '' : 'hidden' }}"
                                                id="ucmkari2">
                                                <x-form.label name="program:" />
                                                <div>
                                                    <input disabled type="radio" id="option5" name="program"
                                                        value="apin" {{ $student->program == 'apin' ? 'checked' : '' }}>
                                                    <label for="option1">Aplikovaná informatika</label><br>
                                                    <div class="mt-1">
                                                        <input disabled type="radio" id="option6" name="program"
                                                            value="iny" {{ $student->program == 'apin' ||
                                                        $student->program == null ? ''
                                                        :
                                                        ' checked' }}>
                                                        <label for="option2">Iný</label><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-16 -ml-32 {{ $student->program == 'apin' || $student->program == null ? 'hidden' : '' }}"
                                                id="iny"><input disabled
                                                    class="{{ $student->program == 'apin' || $student->program == null ? 'hidden' : '' }} border border-gray-200 ml-2 p-2 w-80 rounded h-7"
                                                    name="iny" id="ny"
                                                    value="{{ $student->program == 'apin' ? '' : $student->program }}"
                                                    required --}}{{-- $student->program=='iny' ? '' --}}

                                                {{--</div>

                                        </div> --}}





                                        <x-form.field>
                                            <x-form.input value="{{$student->ulicacislo}}" name="ulicacislo" type="text"
                                                title="Ulica a popisné číslo" placeholder="Ulica a popisné číslo"
                                                disabled required="true"/>
                                        </x-form.field>
                                        <x-form.field>
                                            <x-form.input value="{{$student->mestoobec}}" name="mestoobec" type="text"
                                                title="Mesto / Obec" placeholder="Mesto / Obec" disabled required="true"/>
                                        </x-form.field>
                                        <x-form.field>

                                            <x-form.input value="{{$student->psc}}" name="psc" type="text" title="PSČ"
                                                placeholder="PSČ" disabled required="true"/>
                                        </x-form.field>
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
                                    style="{{ request()->has('pridat') ||  $errors->admin->any() ? 'display:block;' : 'display: none;' }}">
                                    <p class="text-sm font-semibold uppercase text-gray-700">Vytvoriť prihlášku</p>
                                    <form action="/" method="POST">
                                        @csrf
                                        <input name="student_id" value="{{ $student->id }}" hidden />
                                        <x-form.field>

                                            <div class="items-center mt-6">
                                                <x-form.label name="type" title="Typ kurzu" required="true"/>

                                                <div class="flex items-center mt-1">
                                                    <x-form.input-radio name="type" for="type_student" value="0" required="true">
                                                        Študentský
                                                    </x-form.input-radio>
                                                    <x-form.input-radio class="ml-6" name="type" for="type_instructor"
                                                        value="1" required="true">
                                                        Inštruktorský
                                                    </x-form.input-radio>
                                                </div>
                                                <x-form.error name="type" errorBag="admin"/>
                                            </div>
                                            {{-- <div class="items-center">
                                                <x-form.label name="typ kurzu:" />

                                                <input class="mr-0.5" type="radio" name="type" value="0"
                                                    {{old('type')=='0' ? 'checked' : '' }}>
                                                <label for="0">Študentský</label>

                                                <input class="ml-2 mr-0.5" type="radio" name="type" value="1"
                                                    {{old('type')=='1' ? 'checked' : '' }}>
                                                <label for="1">Inštruktorský</label>

                                            </div> --}}

                                            <div class="mt-6 {{old('type') == '1' ? 'flex' : 'hidden'}}" id="inst">

                                                <div class="w-1/2 mr-2">
                                                    <x-form.select name="academy_id" title="Akadémia" class=" combo-a"
                                                        data-nextcombo=".combo-b" :disabled="old('type') != '1'" errorBag="admin" required="true">
                                                        <!-- parent -->
                                                        {{-- <select name="academy_id" class="combo-a"
                                                            data-nextcombo=".combo-b"> --}}
                                                            <option value="" disabled selected hidden>Akadémia
                                                            </option>
                                                            {{-- @php
                                                            $academy =
                                                            \App\Models\Academy::with(['coursetypes','applications'])
                                                            ->get();
                                                            @endphp --}}
                                                            @foreach(\App\Models\Academy::with(['coursetypes','applications'])->get() as $academ)
                                                            <option value="{{ $academ->id }}"
                                                                data-id="{{ $academ->id }}" data-option="-1" {{--
                                                                {{old('academy_id')==$academ->id ? 'selected' : ''}}
                                                                --}}
                                                                >{{
                                                                ucwords($academ->name)}}</option>
                                                            @endforeach
                                                            {{-- <option value="" disabled selected hidden>Akadémia
                                                            </option>
                                                            <option value="1" data-id="1" data-option="-1">Cisco
                                                            </option>
                                                            <option value="2" data-id="2" data-option="-1">Adobe
                                                            </option> --}}
                                                    </x-form.select>
                                                </div>
                                                <div class="w-1/2 ml-2">
                                                    <x-form.select name="coursetype_id" title="Kurz" class="combo-b"
                                                        disabled errorBag="admin" required="true">

                                                        <!-- child -->
                                                        {{-- <select name="coursetype_id" id="coursetype_id"
                                                            class="combo-b" data-nextcombo=".combo-c" disabled>
                                                            <option value="" disabled selected hidden>Typ kurzu
                                                            </option>
                                                            <option value="1" data-id="1" data-option="1">Lahky
                                                            </option>
                                                            <option value="2" data-id="2" data-option="1">Stredny
                                                            </option>
                                                            <option value="3" data-id="3" data-option="2">Photoshop
                                                            </option>
                                                            <option value="4" data-id="4" data-option="2">
                                                                Illustrator</option>
                                                        </select> --}}
                                                        {{-- <select name="coursetype_id" id="coursetype_id"
                                                            class="combo-b" disabled> --}}
                                                            <option value="" disabled selected hidden>Typ kurzu
                                                            </option>
                                                            {{-- @php
                                                            $academy = \App\Models\CourseType::all();
                                                            @endphp --}}
                                                           
                                                            @foreach(\App\Models\CourseType::with(['academy','applications'])->whereIn('type',
                                                            [1,
                                                            2])->get() as $type)
                                                            <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                                                data-option="{{ $type->academy_id }}" {{--
                                                                {{old('coursetype_id')==$type->id ?
                                                                'selected' : ''}} --}}
                                                                >{{
                                                                ucwords($type->name) }}</option>
                                                            @endforeach
                                                    </x-form.select>
                                                </div>

                                            </div>


                                            <div class="mt-6 {{old('type') == '0' ? 'flex' : 'hidden'}}" id="stud">

                                                <div class="w-1/2 mr-2">
                                                    <x-form.select name="academy_id2" title="Akadémia" class=" combo-a3"
                                                        data-nextcombo=".combo-b3" :disabled="old('type') != '0'" errorBag="admin" required="true">

                                                        <!-- parent -->

                                                        <option value="" disabled selected hidden>Akadémia</option>
                                                        {{-- @php
                                                        $academy =
                                                        \App\Models\Academy::with(['coursetypes','applications'])
                                                        ->get();
                                                        @endphp --}}
                                                        
                                                        @foreach(\App\Models\Academy::with(['coursetypes','applications'])
                                                        ->get() as $academ)
                                                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}"
                                                            data-option="-1" {{-- {{old('academy_id')==$academ->id ?
                                                            'selected' : ''}}
                                                            --}}
                                                            >{{
                                                            ucwords($academ->name)}}</option>
                                                        @endforeach
                                                        {{-- <option value="" disabled selected hidden>Akadémia
                                                        </option>
                                                        <option value="1" data-id="1" data-option="-1">Cisco
                                                        </option>
                                                        <option value="2" data-id="2" data-option="-1">Adobe
                                                        </option> --}}
                                                    </x-form.select>
                                                </div>
                                                <div class="w-1/2 ml-2">
                                                    <x-form.select name="coursetype_id2" title="Kurz" class="combo-b3"
                                                        disabled errorBag="admin" required="true">
                                                        <!-- child -->
                                                        {{-- <select name="coursetype_id" id="coursetype_id"
                                                            class="combo-b" data-nextcombo=".combo-c" disabled>
                                                            <option value="" disabled selected hidden>Typ kurzu
                                                            </option>
                                                            <option value="1" data-id="1" data-option="1">Lahky
                                                            </option>
                                                            <option value="2" data-id="2" data-option="1">Stredny
                                                            </option>
                                                            <option value="3" data-id="3" data-option="2">Photoshop
                                                            </option>
                                                            <option value="4" data-id="4" data-option="2">
                                                                Illustrator</option>
                                                        </select> --}}

                                                        <option value="" disabled selected hidden>Typ kurzu</option>
                                                        {{-- @php
                                                        $academy = \App\Models\CourseType::all();
                                                        @endphp --}}
                                                       
                                                         @foreach(\App\Models\CourseType::with(['academy','applications'])->whereIn('type',
                                                        [0,
                                                        2])->get() as $type2)
                                                        <option value="{{ $type2->id }}" data-id="{{ $type2->id }}"
                                                            data-option="{{ $type2->academy_id }}" {{--
                                                            {{old('coursetype_id')==$type->id ?
                                                            'selected' : ''}} --}}
                                                            >{{
                                                            ucwords($type2->name) }}</option>
                                                        @endforeach
                                                    </x-form.select>
                                                </div>
                                            </div>
                                        </x-form.field>



                                        <x-form.field>

                                            <x-form.select name="days" title="Dni" errorBag="admin" required="true">

                                                <option value="" disabled selected hidden>Dni výučby</option>
                                                <option value="1" {{old('days')==1 ? 'selected' : '' }}>Týždeň
                                                </option>
                                                <option value="2" {{old('days')==2 ? 'selected' : '' }}>Víkend
                                                </option>
                                                <option value="3" {{old('days')==3 ? 'selected' : '' }}>Nezáleží
                                                </option>
                                                {{-- <option value="1" data-id="1" data-option="2">Týždeň</option>
                                                <option value="1" data-id="1" data-option="3">Týždeň</option>
                                                <option value="2" data-id="2" data-option="3">Víkend</option>
                                                <option value="3" data-id="3" data-option="3">Nezáleží</option>
                                                <option value="1" data-id="1" data-option="4">Týždeň</option> --}}
                                            </x-form.select>
                                        </x-form.field>
                                        <x-form.field>
                                            <x-form.select name="time" title="Čas" errorBag="admin" required="true">

                                                <option value="" disabled selected hidden>Čas výučby</option>
                                                <option value="1" {{old('time')==1 ? 'selected' : '' }}>Ranný
                                                </option>
                                                <option value="2" {{old('time')==3 ? 'selected' : '' }}>Poobedný
                                                </option>
                                                <option value="3" {{old('time')==3 ? 'selected' : '' }}>Nezáleží
                                                </option>
                                                {{-- <option value="1" data-id="1" data-option="2">Ranný</option>
                                                <option value="4" data-id="1" data-option="3">Ranný (Týždeň/Víkend)
                                                </option>
                                                <option value="5" data-id="2" data-option="3">Poobedný (Týždeň)
                                                </option>
                                                <option value="3" data-id="3" data-option="3">Nezáleží</option>
                                                <option value="1" data-id="1" data-option="4">Ranný</option> --}}
                                            </x-form.select>

                                        </x-form.field>
                                        <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                                            Odoslať
                                        </x-form.button>
                                    </form>
                                </div>
                                <div id="kurzy"
                                    class="section {{ session('success_c') || session('success_d') || request()->has('pridat') ||  $errors->admin->any() ? '' : 'hidden' }} flex-auto p-6">
                                    <p class="text-sm font-semibold uppercase text-gray-700">Prihlášky tohto študenta
                                    </p>
                                    <x-single-table>
                                        <x-slot:head>

                                            <th scope="col" class="py-3 px-6">Kurz</th>
                                            <th scope="col" class="py-3 px-6">Dni/čas</th>
                                            <th scope="col" class="py-3 px-6">Potvrdená</th>
                                            <th scope="col" class="py-3 px-6">Vytvorená</th>
                                            <th scope="col"
                                                class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                                                Akcie</th>
                                        </x-slot:head>
                                        @foreach ($student->applications as $application)
                                        <tr
                                            class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">

                                            <td class="py-4 px-6">
                                                <x-table.td url="coursetypes/{{ $application->coursetype->id }}">
                                                    {{$application->coursetype->name}} -
                                                    {{$application->coursetype->type == '0' ?
                                                    'študentský' :
                                                    'inštruktorský'}} ({{$application->academy->name}} akadémia)
                                                </x-table.td>
                                                <br>

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

                                            <x-table.td-last url="applications/{{ $application->id }}" edit=0
                                                itemName="prihlášku {{$application->student->name}}" />


                                        </tr>
                                        @endforeach
                                    </x-single-table>
                                </div>
                                {{-- <div id="login" class="hidden flex-auto p-6">
                                    <p class="leading-normal uppercase  dark:opacity-60 text-sm">Login</p>
                                    <form id="formm2" action="/admin/students/{{$student->id}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @if ($student->has('login'))
                                        @method('Patch')
                                        @endif
                                        <div class="flex flex-wrap -mx-3">
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                                <div class="mb-4">
                                                    <label for="username"
                                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Username</label>
                                                    <input disabled type="text" name="username"
                                                        value="{{$student->login->nickname ?? ''}}" required autofocus
                                                        autocomplete="name"
                                                        class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                                </div>
                                            </div>
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="password"
                                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Password</label>
                                                    <input disabled type="password" name="password" required
                                                        autocomplete="new-password"
                                                        class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                                </div>
                                            </div>
                                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                                <div class="mb-4">
                                                    <label for="password_confirmation"
                                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Password
                                                        confirmation</label>
                                                    <input disabled type="password" name="password_confirmation"
                                                        required autocomplete="new-password"
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
                                        {{-- <x-form.field>

                                            <div class="flex">
                                                <button id="upd1" type="submit"
                                                    class="hidden flex-1 bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">{{
                                                    $student->login ? 'Update' : 'Create' }}
                                                </button>
                                                <button id="res1" type="reset"
                                                    class="hidden flex-none bg-gray-400 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">Reset</button>
                                            </div>

                                        </x-form.field>

                                    </form>
                                </div> --}}

                                @php
                                $student_s = null;
                                $student_p = null;
                                if ($student->skola) {
                                $student_s = $student->skola == 'ucm' ? 'ucm' : 'ina';
                                }
                                if ($student->program) {
                                $student_p = $student->program == 'apin' ? 'apin' : 'iny';
                                }
                                @endphp
</x-setting>
<x-flash />

<script>
    const studentData = {!! json_encode([
        'status' => $student->status ?? null,
        'skola' => $student_s,
        'program' => $student_p,
        'skola_r' => $student->skola ?? null,
        'program_r' => $student->program ?? null,
    ]) !!};
</script>