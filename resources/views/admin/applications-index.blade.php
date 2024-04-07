<x-flash />
<x-layout />
@php
session()->forget('student_id');
session()->forget('coursetype_id');
$coursetype = null;
if(request()->coursetype_id)
{
$coursetype = \App\Models\CourseType::find(request()->coursetype_id);
}
@endphp
<x-setting heading="Prihlášky" ctitle="prihlášky" etitle="e prihlášky">
    <x-slot:create>
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
                    <x-form.input name="name" type="text"/>
                    <x-form.input name="lastname" type="text"/>
                    <x-form.input name="email" type="text"/>
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
                        {{-- <p class="block mb-2 uppercase font-bold text-sm cursor-pointer text-gray-700"
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
                <input name="academy_id" value="{{$coursetype->academy->id}}" hidden />
                <input name="coursetype_id" value="{{$coursetype->id}}" hidden />
                @endif
    
    
    
                <div class="flex">
                    <div>
                        <x-form.label name="akadémia" />
                        <!-- parent -->
                        <select name="academy_id" class="combo-a" data-nextcombo=".combo-b" {{$coursetype ? 'disabled' : ''
                            }}>
                            <option value="" disabled selected hidden>Akadémia</option>
                            @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            @endphp
                            @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                            ->get() as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                {{old('academy_id')==$academ->id ? 'selected' : ''}}
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
                        </select>
                    </div>
                    <div class="ml-4">
                        <x-form.label name="typ kurzu" />
                        <!-- child -->
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c"
                            disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            <option value="1" data-id="1" data-option="1">Lahky</option>
                            <option value="2" data-id="2" data-option="1">Stredny</option>
                            <option value="3" data-id="3" data-option="2">Photoshop</option>
                            <option value="4" data-id="4" data-option="2">Illustrator</option>
                        </select> --}}
                        <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            {{-- @php
                            $academy = \App\Models\CourseType::all();
                            @endphp --}}
                            @foreach (\App\Models\CourseType::with(['academy','applications'])->get() as $type)
                            <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                                @if($coursetype) {{$coursetype->id == $type->id ? 'selected' : ''}}
                                @endif
                                {{old('coursetype_id')==$type->id ? 'selected' : ''}}>{{
                                ucwords($type->name) }} - {{$type->type == '0' ? 'študentský' : 'inštruktorský'}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
    
    
    
                <x-form.field>
                    <div class="flex">
                        <div>
                            <x-form.label name="dni výučby" />
                            <select name="days" id="days">
                                <option value="" disabled selected hidden>Dni výučby</option>
                                <option value="1" {{old('days')==1 ? 'selected' : '' }}>Týždeň</option>
                                <option value="2" {{old('days')==2 ? 'selected' : '' }}>Víkend</option>
                                <option value="3" {{old('days')==3 ? 'selected' : '' }}>Nezáleží</option>
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
                                <option value="2" {{old('time')==3 ? 'selected' : '' }}>Poobedný</option>
                                <option value="3" {{old('time')==3 ? 'selected' : '' }}>Nezáleží</option>
                                {{-- <option value="1" data-id="1" data-option="2">Ranný</option>
                                <option value="4" data-id="1" data-option="3">Ranný (Týždeň/Víkend)</option>
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
                    <option value="{{ $category->id }}" {{old('category_id')==$category->id ? 'selected' : ''}}
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
                <a href="/admin/students" class ='items-center mt-6 px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>Preskočiť</a>
                @endif
            </div>
        </form>
        @php
    session()->forget('typ');
    @endphp
            </x-slot:create>
            <div class="flex mt-3">
            <form method="get" action="{{ route('admin.applications.index') }}">
                @csrf
                
                @if(request()->filled('search'))
                    <input type="hidden" name="search" value="{{request()->input('search')}}"/>
                @endif
                
                <div class="flex">
                    <div class="">
                        <x-form.label name="Zoradiť podľa" />
                        <select class="form-control" id="orderBy" name="orderBy">
                            <option value="created_at" {{request()->input('orderBy')=='created_at' ? 'selected' :
                                ''}}>Dátumu vytvorenia</option>
                            <option value="updated_at" {{request()->input('orderBy')=='updated_at' ? 'selected' :
                                ''}}>Dátumu poslednej úpravy</option>
                        </select>
                    </div>
                    <div class="px-6">
                        <x-form.label name="Smer zoradenia" /> <select class="form-control" id="orderDirection"
                            name="orderDirection">
                            <option value="desc" {{request()->input('orderDirection')=='desc' ? 'selected' : ''}}>Od najnovšej
                            </option>
                            <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Od najstaršej
                            </option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <select class="form-control" id="filterBy" name="filterBy[]" multiple>
                            <option value="academy_id|1">Akadémia 1</option>
                            <option value="academy_id|2">Akadémia 2</option>
                            <option value="coursetype_id|1">Typ kurzu 1</option>
                            <option value="coursetype_id|2">Typ kurzu 2</option>
                        </select>
                    </div> --}}
                    <div>
                        <x-form.label name="Filtrovať podľa" />
                        <div class="flex">
                            <div>
                                <select name="academy_id" class="combo-a" data-nextcombo=".combo-b">
                                    <option value="" disabled selected hidden>Akadémia</option>
                                    @php
                                    $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                    ->get();
                                    $coursetype = \App\Models\CourseType::with(['academy','applications'])->get();
                                    @endphp
            
                                     <option value="" data-option="-1">Všetky</option>
            
                                    @foreach ($academy as $academ)
                                    <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                        {{request()->input('academy_id')==$academ->id ? 'selected' : ''}}>{{
                                        ucwords($academ->name) }}</option>
                                    @endforeach
                                </select>
                                <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled>
                                    <option value="" disabled selected hidden>Typ kurzu</option>
            
                                    @foreach ($academy as $academ)
                                    <option value="" data-option="{{$academ->id}}"  {{request()->input('coursetype_id')==null ? 'selected' : ''}}>Všetky</option>
                                    @endforeach
                                    @foreach ($coursetype as $type)
                                    <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                        data-option="{{ $type->academy_id }}"  {{request()->input('coursetype_id')==$type->id ? 'selected' : ''}}>{{ ucwords($type->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
            </form>
            <div class="ml-auto">
                <form method="get" action="{{ route('admin.applications.index') }}">
                    @csrf
                    @if(request()->filled('orderBy'))
                    <input type="hidden" name="orderBy" value="{{request()->input('orderBy')}}"/>
                    <input type="hidden" name="orderDirection" value="{{request()->input('orderDirection')}}"/>
                    @endif
                    @if(request()->filled('academy_id')&&request()->filled('coursetype_id'))
                    <input type="hidden" name="academy_id" value="{{request()->input('academy_id')}}"/>
                    <input type="hidden" name="coursetype_id" value="{{request()->input('coursetype_id')}}"/>
                    @elseif(request()->filled('academy_id'))
                    <input type="hidden" name="academy_id" value="{{request()->input('academy_id')}}"/>
                    @endif
                    <x-form.label name="Vyhľadávanie"/>
                    <input type="text" name="search" value="{{request()->input('search')}}"/>
                    <x-form.button>
                        Hľadať
                    </x-form.button>
                </form>
            </div>
        </div>
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-6 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto relative ">
                    <table class="w-full text-sm text-left text-gray-800 dark:text-gray-800 shadow-md">
                        <thead class="text-xs uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="py-3 px-6">Meno študenta</th>
                                <th scope="col" class="py-3 px-6">Kurz</th>
                                <th scope="col" class="py-3 px-6">Dni / čas</th>
                                <th scope="col" class="py-3 px-6">Potvrdená</th>
                                <th scope="col" class="py-3 px-6 w-20">Akcie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                            <tr
                                class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                <td class="py-4 px-6">{{$application->student->name}} {{$application->student->lastname}}</td>
                                <td class="py-4 px-6">
                                    
                                    {{$application->coursetype->name}} - {{$application->coursetype->type == '0' ? 'študentský' :
                                    'inštruktorský'}} ({{$application->academy->name}} akadémia)<br>
                                    
                                </td>
                                <td class="py-4 px-6">
                                {{$application->days== 1 ? 'Týždeň' : ''}} {{$application->days== 2 ? 'Víkend' : ''}} {{$application->days== 3 ? 'Nezáleží' : ''}} / {{$application->time== 1 ? 'Ranný' : ''}} {{$application->time== 2 ? 'Poobedný' : ''}} {{$application->time== 3 ? 'Nezáleží' : ''}}
                                </td>
                                <td class="py-4 px-6 {{$application->verified== 1 ? '' : 'text-red-800'}}">
                                    {{$application->verified== 1 ? 'ÁNO' : 'NIE'}}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    
                                    <form method="POST" action="/admin/applications/{{ $application->id }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 hover:underline ">Vymazať</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
    
    
            </div>
        </div>
    
</x-setting>