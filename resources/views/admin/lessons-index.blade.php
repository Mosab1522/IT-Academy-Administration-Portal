<x-flash />
<x-layout/>
    <x-setting heading="Typy kurzov">
        <div class="flex flex-col">
            <div class="flex">
                <form method="get" action="{{ route('admin.lessons.index') }}">
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
                                    <select name="class_id" class="combo-a" data-nextcombo=".combo-b">
                                        <option value="" disabled selected hidden>Trieda</option>
                                        @php
                                        $classes = \App\Models\CourseClass::with(['instructors','students'])->get();
                                        @endphp
                
                                         <option value="" data-option="-1">Všetky</option>
                
                                        @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" data-id="{{ $class->id }}" data-option="-1"
                                            {{request()->input('academy_id')==$class->id ? 'selected' : ''}}>{{
                                            ucwords($class->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
                </form>
                <div class="ml-auto">
                    <form method="get" action="{{ route('admin.classes.index') }}">
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
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="text-sm">
                                <tr>
                                    <td class="px-6 py-1">Názov</td>
                                    <td class="px-6 py-2">Akadémia</td>
                                    <td class="px-6 py-2">Kurz</td>
                                    <td class="px-6 py-2">Days - Time</td>
                                    <td class="px-6 py-2">Počet študentov</td>
                                    <td class="px-6 py-2">Inštruktor</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($lessons as $lesson)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="/admin/lessons/{{ $lesson->id }}"> 
                                                         {{$lesson->title }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{$lesson->class->name}}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $lesson->lesson_date}}
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $lesson->days}} -  {{ $lesson->time}}
                                                </div>
                                            </div>
                                        </td>  --}}
                                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $lesson->students->count()}}
                                                </div>
                                            </div>
                                        </td>  --}}
                                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a
                                                    href={{route('instructors', ['coursetype_id' =>$class->id])}}"
                                                    >Pridať inštruktora</a>
                                                </div>
                                            </div>
                                        </td>  --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">

                                                    <span class="text-xs">
                                                    
                                                    {{$lesson->instructor->name}} {{$lesson->instructor->lastname}} <br>
                                                    
                                                    </span>
                                                   
                                                </div>
                                            </div>
                                        </td> 

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="/admin/lessons/{{ $lesson->id }}" class="text-blue-500 hover:text-blue-600">Edit</a>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/admin/lessons/{{ $lesson->id }}">
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

    </x-setting>
