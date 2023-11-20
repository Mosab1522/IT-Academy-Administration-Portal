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
                                <ul class="relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl" nav-pills
                                    role="tablist">
                                    <li class="z-30 flex-auto text-center">
                                        <a id="pp" href="javascript:;"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white">
                                            <i class="ni ni-app"></i>
                                            <span id="jj"
                                                class="ml-2 {{session('success_c') || session('success_d') ? 'hidden' : '' }}">Povoliť
                                                úpravy</span>
                                            <span style="display: none;" id="zz" class="ml-2">Zrušiť úpravy</span>
                                            <span id="kk" class="ml-2 {{ session('success_c') || session('success_d') ? '' : 'hidden' }}
                                            ">Vytvoriť kurz</span>
                                            <span style="display: none;" id="nkk" class="ml-2">Zrušiť vytvorenie
                                                kurzu</span>
                                        </a>
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
                                        <a id="ku"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            href="javascript:;">
                                            <i class="ni ni-email-83"></i>
                                            <span id="tlac1" class="ml-2 {{session('success_c') || session('success_d') ? 'hidden' : '' }}">Kurzy</span>
                                            <span id="tlac2" class="{{session('success_c') || session('success_d') ? '' : 'hidden' }} ml-2">Info</span>
                                        </a>
                                    </li>
                                    {{-- <li class="z-30 flex-auto text-center">
                                        <a id="tr"
                                            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700 hover:bg-white"
                                            nav-link href="javascript:;">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span id="lt" class="ml-2">Login</span>
                                            <span id="kt" class="hidden ml-2">Kurzy</span>
                                        </a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>





                    </div>
                    <hr
                        class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                    <div id="profile" class="flex-auto p-6" style="{{session('success_c') || session('success_d') ? 'display: none;' : '' }}">
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
                                {{-- <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="last name"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Last
                                            name</label>
                                        <input disabled type="text" name="lastname" value="{{$academy->lastname}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>

                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Email
                                            address</label>
                                        <input disabled type="email" name="email" value="{{$academy->email}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="username"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Sekemail</label>
                                        <input disabled type="text" name="sekemail" value="{{$academy->sekemail}}"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
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
                    <div class="hidden p-6" id="pridat">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Vytvoriť kurz</p>
                        <form action="/admin/coursetypes/create" method="POST">
                            @csrf
                            <input name="academy_id" value="{{$academy->id}}" hidden />

                            <x-form.input name="name" />
                            <x-form.input name="min" type="number" />
                            <x-form.input name="max" type="number" />

                            <x-form.field>
                                <button id="pridbtn" type="submit"
                                    class=" flex-1 bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Vytvoriť
                                </button>
                            </x-form.field>
                        </form>
                    </div>
                    <div id="kurzy" class="{{session('success_c') || session('success_d') ? '' : 'hidden' }} shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                    {{-- <div id="login" class="hidden flex-auto p-6">
                        <p class="leading-normal uppercase  dark:opacity-60 text-sm">Login</p>
                        <form id="formm2" action="/admin/academys/{{$academy->id}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @if($academy->has('login'))
                            @method('Patch')
                            @endif
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                    <div class="mb-4">
                                        <label for="username"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Username</label>
                                        <input disabled type="text" name="username"
                                            value="{{$academy->login->nickname ?? ''}}" required autofocus
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
                                        <input disabled type="password" name="password_confirmation" required
                                            autocomplete="new-password"
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
                                        $academy->login ? 'Update' : 'Create' }}
                                    </button>
                                    <button id="res1" type="reset"
                                        class="hidden flex-none bg-gray-400 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">Reset</button>
                                </div>

                            </x-form.field>

                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</x-setting>
@php
session()->forget('success_c');
session()->forget('success_u');
session()->forget('success_d');
@endphp