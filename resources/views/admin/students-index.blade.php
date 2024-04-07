<x-flash />
<x-layout/>
    <x-setting heading="Študenti" ctitle="študenta" etitle="i študenti">
        <x-slot:create>
            <form action="/admin/students/create" method="post" enctype="multipart/form-data">
                @csrf
                {{-- <h3 class="block mt-2 mb-3 uppercase font-bold text-sm text-gray-700">Povinný údaj</h3>
                <x-form.input name="email" type="email"/>
                <h3 class="block mt-6 mb-3 uppercase font-bold text-sm text-gray-700">Voliteľné údaje</h3> --}}
                <div class="items-center mt-4">
                    <x-form.label name="je:" />
        
                    <input class="mr-0.5" type="radio" id="student" name="status" value="student">
                    <label for="student">Študent</label>
        
                    <input class="ml-2 mr-0.5" type="radio" id="nestudent" name="status" value="nestudent">
                    <label for="nestudent">Neštudent</label>
                    
                    <input class="ml-2 mr-0.5" type="radio" id="neviem" name="status" value=NULL>
                    <label for="nestudent">Neviem</label>
        
                </div>
        
                <div class="flex pb-1">
                    <div class="h-20 mt-3" id="ucm" style="display: none;">
                        <x-form.label name="univerzita:" />
                        <div class=" flex">
                            <div>
        
                                <input type="radio" id="ucmka" name="skola" value="ucm">
                                <label for="option1">UCM</label><br>
                                <div class="mt-1">
                                    <input  type="radio" id="inam" name="skola" value="ina">
                                    <label for="option2">Iná</label><br>
                                </div>
                                
                            </div>
        
                            <div id="ina" style="display: none"><input
                                    class=" border border-gray-200 mt-6 ml-2 p-2 w-80 rounded h-7" name="ina" id="nu"
                                    required disabled></div>
                        </div>
                    </div>
        
                    <div class="ml-4 mt-3" id="ucmkari" style="display: none;">
        
                        <x-form.label name="studium:" />
                     
                        <input type="radio" id="option3" name="studium" value="interne">
                        <label for="option1">Interné</label><br>
                           <div class="mt-1">
                        <input type="radio" id="option4" name="studium" value="externe">
                        <label for="option2">Externé</label><br></div>
                    </div>
        
        
        
        
                    <div class=" flex ml-4 mt-3" id="ucmkari2" style="display: none;">
                        <x-form.label name="program:" />
                        <div>
                            <input type="radio" id="option5" name="program" value="apin">
                            <label for="option1">Aplikovaná informatika</label><br>
                            <div class="mt-1">
                            <input type="radio" id="option6" name="program" value="iny">
                            <label for="option2">Iný</label><br>
                            </div>
                        </div> 
                    </div>
                        <div class="mt-16 -ml-32" id="iny" style="display: none"><input
                                class=" border border-gray-200 ml-2 p-2 w-80 rounded h-7" name="iny" id="ny" required
                                disabled></div>
        
        
                </div>
        
                <x-form.input name="name" type="text"/>
                <x-form.input name="lastname" type="text"/>
                <x-form.input name="email" type="email"/>
                <x-form.input name="sekemail" type="email"/>
                <x-form.input name="ulicacislo" type="text"/>
                <x-form.input name="mestoobec" type="text"/>
                <x-form.input name="psc" type="text"/>
        
        
                <x-form.button>
                    Odoslať
                </x-form.button>
            </form>
            </x-slot:create>

            <div class="flex mt-3">
                <form method="get" action="{{ route('admin.students.index') }}">
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
                        
                    </div>
                    <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
                </form>
                <div class="ml-auto">
                    <form method="get" action="{{ route('admin.students.index') }}">
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
                                        {{$application->coursetype->name}} - {{$$application->coursetype->type == '0' ? 'študentský' :
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
