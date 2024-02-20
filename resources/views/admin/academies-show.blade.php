<x-layout />
<x-flash />
<x-setting heading="{{$academy->name}}">
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
                    class="flex relative flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">

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
                                <h5 class="text-lg font-semibold mb-1 ">{{$academy->name}}
                                </h5>
                                <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">Akadémia</p>
                            </div>
                        </div>

                        <div
                            class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
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
                                            <span
                                                class="{{ session('success_c') || session('success_dd') ? '' : 'hidden' }}">Vytvoriť
                                                kurz</span>
                                            <span class="{{request()->has('pridat') ? '' : 'hidden' }}">Zrušiť
                                                vytvorenie kurzu</span>
                                        </button>
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
                                                class="ml-2 {{session('success_c') || session('success_d') || request()->has('pridat') ? 'hidden' : '' }}">Kurzy</span>
                                            <span id="tlac2"
                                                class="{{session('success_c') || session('success_d') || request()->has('pridat')  ? '' : 'hidden' }} ml-2">Info</span>
                                        </a> --}}
                                        <button
                                            class="section-button {{session('success_c') || session('success_dd')|| session('success_d')  || request()->has('pridat')  ? '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="profile">Info</button>
                                        <button
                                            class="section-button {{session('success_c') || session('success_dd') || session('success_d')   || request()->has('pridat') ? 'hidden' : '' }} z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="kurzy">Kurzy</button>
                                    </li>
                                    <li class="z-30 flex-auto text-center">
                                        {{-- <a id="tr"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            nav-link href="javascript:;">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span id="lt" class="ml-2">Login</span>
                                            <span id="kt" class="hidden ml-2">Kurzy</span>
                                        </a> --}}
                                        <button
                                            class="section-button {{session('success_d')  ?  '' : 'hidden' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="kurzy">Kurzy</button>
                                        <button
                                            class="section-button  {{session('success_d') ? 'hidden' : '' }} z-30  items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            data-target="login">Prihlášky</button>

                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    <hr
                        class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                    <div id="profile" class="section flex-auto p-6"
                        style="{{session('success_c') || session('success_d') || session('success_dd') || request()->has('pridat') ? 'display: none;' : '' }} ">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Academy Information</p>
                        <form id="formm" action="/admin/academies/{{$academy->id}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Patch')
                            <div class="flex flex-wrap -mx-3">

                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="first name"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">
                                            Name</label>
                                        <input disabled type="text" name="name" value="{{$academy->name}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>

                            </div>

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
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Vytvoriť kurz</p>
                        <form action="/admin/coursetypes/create" method="POST">
                            @csrf
                            <input name="academy_id" value="{{$academy->id}}" hidden />

                            <x-form.input name="name" />
                            <div class="items-center my-4">
                                <x-form.label name="typ kurzu:" />

                                <input class="mr-0.5" type="radio" name="type" value="0" {{old('type')=='0' ? 'checked'
                                    : '' }}>
                                <label for="0">Študentský</label>

                                <input class="ml-2 mr-0.5" type="radio" name="type" value="1" {{old('type')=='1'
                                    ? 'checked' : '' }}>
                                <label for="1">Inštruktorský</label>

                                <input class="ml-2 mr-0.5" type="radio" name="type" value="2" {{old('type')=='2'
                                    ? 'checked' : '' }}>
                                <label for="2">Obidva</label>

                            </div>
                            <x-form.input name="min" type="number" />
                            <x-form.input name="max" type="number" />

                            <x-form.field>
                                <button id="pridbtn" type="submit"
                                    class=" flex-1 bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Vytvoriť
                                </button>
                            </x-form.field>
                        </form>
                    </div>
                    <div id="kurzy"
                        class="section {{session('success_c') || session('success_dd') || request()->has('pridat')  ? '' : 'hidden' }} shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="text-sm">
                                <tr>
                                    <td class="px-6 py-1">Názov typu kurzu</td>
                                    <td class="px-6 py-2">Min-Max</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($academy->coursetypes as $coursetype)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="/admin/coursetypes/{{ $coursetype->id }}"
                                                    title="Ukázať podrobnosti">

                                                    {{$coursetype->name }}

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
                                                {{ $coursetype->min}}
                                                {{ $coursetype->max}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $coursetype->created_at->diffForHumans()}}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/admin/coursetypes/{{ $coursetype->id }}"
                                            class="text-blue-500 hover:text-blue-600">Edit</a>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="/admin/coursetypes/{{ $coursetype->id }}">
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
                    <div id="login" class="section {{session('success_d')  ? '' : 'hidden' }}">
                        @php
                        $coursetypes = $academy->coursetypes()->orderByDesc(function ($query) {
                        $query->select('created_at')
                        ->from('applications')
                        ->whereColumn('coursetype_id', 'course_types.id')
                        ->latest()
                        ->limit(1);
                        })->get();
                        @endphp
                        @foreach ($coursetypes as $coursetype)
                        {{-- @if($coursetype->applications->isNotEmpty()) --}}
                        <div class="text-sm w-full flex mt-2 mb-2">

                            <p class="flex-none text-sm font-medium text-gray-900 w-32">Kurz: {{ $coursetype->name }}
                            </p>
                            <p class="flex-1 font-light text-gray-500">Typ: {{$coursetype->type == 0 ? 'študentský' :
                                'inštruktorský'}}</p>
                            <p class="flex-none font-light text-gray-500">Posledná prihláška vytvorená:
                                {{$coursetype->applications->isNotEmpty() ?
                                $coursetype->applications()->latest()->first()->created_at->diffForHumans() : 'zatiaľ
                                žiadna'}}

                        </div>
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <colgroup>
                                    <col style="width: 30%;">
                                    <col style="width: 45%;">
                                    <col style="width: 12.5%;">
                                    <col style="width: 12.5%;">
                                </colgroup>
                                <thead class="text-sm">
                                    <tr>
                                        <td class="px-6 py-1">
                                            Meno a priezvisko
                                        </td>

                                        <td class="px-6 py-2">Email</td>
                                        <td></td>
                                        <td>
                                            <a href="/admin/coursetypes/{{ $coursetype->id }}?vytvorit"
                                                class="text-blue-500 hover:text-blue-600">
                                                Pridať študenta
                                            </a>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" style="height: 3rem;">
                                    @foreach($coursetype->applications()->orderByDesc('created_at')->get() as $application)
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
                                                    {{$application->student->email }}
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
                        {{-- @endif --}}
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-setting>