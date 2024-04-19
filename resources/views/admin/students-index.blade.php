<x-flash />
<x-layout/>
    <x-setting heading="Študenti" etitle="Existujúci študenti">
        <x-slot:create>
            <div class="flex flex-col">
                <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie študenta</h3>
            <form action="/admin/students/create" method="post" enctype="multipart/form-data">
                @csrf
                {{-- <h3 class="block mt-2 mb-3 uppercase font-bold text-sm text-gray-700">Povinný údaj</h3>
                <x-form.input name="email" type="email"/>
                <h3 class="block mt-6 mb-3 uppercase font-bold text-sm text-gray-700">Voliteľné údaje</h3> --}}
                <div class="items-center mt-6">
                    <x-form.label name="status" title="Status" />

                    <div class="flex items-center mt-1">
                        <x-form.input-radio name="status" for="type_student" value="student">
                            Študent
                        </x-form.input-radio>
                        
                        <x-form.input-radio class="ml-6" name="status" for="type_nostudent" value="nestudent">
                            Neštudent
                        </x-form.input-radio>
                       
                    </div>
                    
                </div>

                {{-- <div class="items-center mt-4">
                    <x-form.label name="je:" />
        
                    <input class="mr-0.5" type="radio" id="student" name="status" value="student">
                    <label for="student">Študent</label>
        
                    <input class="ml-2 mr-0.5" type="radio" id="nestudent" name="status" value="nestudent">
                    <label for="nestudent">Neštudent</label>
                    
                    <input class="ml-2 mr-0.5" type="radio" id="neviem" name="status" value=NULL>
                    <label for="nestudent">Neviem</label>
        
                </div> --}}
        
                <div class="space-y-4">
                    <!-- University selection -->
                    <div class="flex flex-col mt-3" id="ucm" style="display: none;">
                        <x-form.label name="skola" title="Škola"/>
                        <div class="flex mt-1">
                            <div class="flex items-center mr-6">
                                <input type="radio" id="ucmka" name="skola" value="ucm" class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <label for="ucmka" class="ml-2  text-gray-700">UCM</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="inam" name="skola" value="ina" class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <label for="inam" class="ml-2  text-gray-700">Iná</label>
                            </div>
                        </div>
                        <div id="ina" class="mt-3" style="display: none;">
                            <input type="text" class="t-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-500" name="ina" id="nu" placeholder="Názov školy" disabled>
                        </div>
                    </div>
                
                    <!-- Study type selection -->
                    <div class="flex flex-col mt-3" id="ucmkari" style="display: none;">
                        <x-form.label name="studium" title="Druh štúdia"/>
                        <div class="flex mt-1">
                            <div class="flex items-center mr-6">
                                <input type="radio" id="option3" name="studium" value="interne" class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <label for="option3" class="ml-2  text-gray-700">Interné</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="option4" name="studium" value="externe" class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <label for="option4" class="ml-2  text-gray-700">Externé</label>
                            </div>
                        </div>
                    </div>
                
                    <!-- Program selection -->
                    <div class="flex flex-col mt-3" id="ucmkari2" style="display: none;">
                        <x-form.label name="program" title="Program"/>
                        <div class="flex mt-1">
                            <div class="flex items-center mr-6">
                                <input type="radio" id="option5" name="program" value="apin" class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <label for="option5" class="ml-2  text-gray-700">Aplikovaná informatika</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="option6" name="program" value="iny" class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <label for="option6" class="ml-2  text-gray-700">Iný</label>
                            </div>
                        </div>
                        <div id="iny" class="mt-3" style="display: none;">
                            <input type="text" class="t-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-500" name="iny" id="ny" placeholder="Názov programu" disabled>
                        </div>
                    </div>
                </div>
                
                
                <x-form.field>
                <x-form.input name="name" type="text" title="Meno" placeholder="Meno"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="lastname" type="text" title="Priezvisko" placeholder="Priezvisko"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="email" type="email" title="Email" placeholder="Email"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="sekemail" type="email" title="Sekundárny email" placeholder="Sekundárny email"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="ulicacislo" type="text" title="Ulica a popisné číslo" placeholder="Ulica a popisné číslo"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="mestoobec" type="text" title="Mesto / Obec" placeholder="Mesto / Obec"/></x-form.field>
                <x-form.field>

                <x-form.input name="psc" type="text" title="PSČ" placeholder="PSČ"/>
                </x-form.field>
        
                <x-form.button class="mt-6">
                    Odoslať
                </x-form.button>
            </form>
                </div>
            </div>
            </x-slot:create>

            <div class="bg-white p-6 rounded-lg shadow mb-4 flex justify-between items-end">
                <form method="get" action="{{ route('admin.students.index') }}" class="flex flex-wrap items-end">
                    @csrf
                    
                    @if(request()->filled('search'))
                        <input type="hidden" name="search" value="{{request()->input('search')}}"/>
                    @endif
                    <x-form.search-select name="orderBy" title="Zoradiť podľa">
                        <option value="created_at" {{request()->input('orderBy')=='created_at' ? 'selected' : ''}}>Dátumu
                            vytvorenia</option>
                        <option value="updated_at" {{request()->input('orderBy')=='updated_at' ? 'selected' : ''}}>Dátumu
                            poslednej úpravy</option>
            </x-form.search-select>
            <x-form.search-select name="orderDirection" title="Smer zoradenia">
                <option value="desc" {{request()->input('orderDirection')=='desc' ? 'selected' : ''}}>Od najnovšej
                </option>
                <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Od najstaršej
                </option>
        </x-form.search-select>
                        {{-- <div class="form-group">
                            <select class="form-control" id="filterBy" name="filterBy[]" multiple>
                                <option value="academy_id|1">Akadémia 1</option>
                                <option value="academy_id|2">Akadémia 2</option>
                                <option value="coursetype_id|1">Typ kurzu 1</option>
                                <option value="coursetype_id|2">Typ kurzu 2</option>
                            </select>
                        </div> --}}
                        
                    
                        <x-form.button class="ml-2">Zoradiť</x-form.button>
                </form>
               
                <form method="get" action="{{ route('admin.students.index') }}" class="flex flex-wrap items-end">
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
                        <div class="w-full md:w-auto md:mr-4 mt-4 md:mt-0">

                            <input type="text" name="search" value="{{old('search')}}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"
                                placeholder="Vyhľadávanie">
                        </div>
                        <x-form.button class="ml-2">Hľadať</x-form.button>
                    </form>
            </div>
            <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                <div class="py-6 align-middle inline-block min-w-full sm:px-6 lg:px-8 ">
                    <div class="overflow-x-auto relative rounded-lg shadow">
                        <table class="w-full text-sm text-left text-gray-800 dark:text-gray-800 shadow-md">
                            <thead class="text-xs uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="py-3 px-6">Meno</th>
                                    <th scope="col" class="py-3 px-6">Email</th>
                                    <th scope="col" class="py-3 px-6">Prihlášky</th>
                                    <th scope="col" class="py-3 px-6">Aktuálne triedy</th>
                                    <th scope="col" class="py-3 px-6 w-40">Akcie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr
                                    class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                    <td class="py-4 px-6">{{$student->name}} {{$student->lastname}}</td>
                                    <td class="py-4 px-6">{{$student->email}}</td>
                                    <td class="py-4 px-6">
                                        @foreach($student->applications as $application)
                                        {{$application->coursetype->name}} - {{$application->coursetype->type == '0' ? 'študentský' :
                                        'inštruktorský'}} ({{$application->academy->name}} akadémia)<br>
                                        @endforeach
                                    </td>
                                    <td class="py-4 px-6">
                                        @foreach($student->classes as $class)
                                        {{$class->name}} ({{$class->coursetype->name}} - {{$class->coursetype->type == '0' ? 'študentský' :
                                        'inštruktorský'}})<br>
                                        @endforeach
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <a href="/admin/students/{{ $student->id }}"
                                            class="text-blue-600 hover:text-blue-700 hover:underline ">Upraviť</a>
                                            &nbsp;
                                        <form method="POST" action="/admin/students/{{ $student->id }}" class="inline">
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
