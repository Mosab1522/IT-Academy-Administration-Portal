
<x-layout/>
    <x-setting heading="Študenti" etitle="Existujúci študenti">
        <x-slot:create>
            <div class="flex flex-col">
                <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie študenta</h3>
            <form action="/admin/students/create" method="post" enctype="multipart/form-data">
                @csrf
                <x-form.required class="-mt-3"/>
                {{-- <h3 class="block mt-2 mb-3 uppercase font-bold text-sm text-gray-700">Povinný údaj</h3>
                <x-form.input name="email" type="email"/>
                <h3 class="block mt-6 mb-3 uppercase font-bold text-sm text-gray-700">Voliteľné údaje</h3> --}}
                <p class="text-sm font-semibold uppercase text-gray-700 mt-6">Osobné informácie</p>
                <div class="flex flex-col  md:grid md:grid-cols-2 lg:flex lg:flex-row  gap-6">
                    <div class=" mt-6">
                        <x-form.label name="status" title="Status"  required="true"/>

                        <div class="flex items-center mt-1">
                            <x-form.input-radio name="status" for="type_student" value="student"   :checked="old('status') == 'student'" required="true">
                                Študent
                            </x-form.input-radio>

                            <x-form.input-radio class="ml-4" name="status" for="type_nostudent"
                                value="nestudent" :checked="old('status') == 'nestudent'"  required="true">
                                Neštudent
                            </x-form.input-radio>

                        </div>
                        <x-form.error name="status" errorBag="default"/>
                    </div>
            
                        <!-- University selection -->
                        <div class="flex flex-col mt-0 md:mt-6 {{ old('skola') ? '' : 'hidden' }}" id="ucm">
                            <x-form.label name="skola" title="Škola"  required="true"/>
                            <div class="flex mt-1">
                                <div class="flex items-center mr-4">
                                    {{-- <input type="radio" id="ucmka" name="skola" value="ucm"
                                        class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" disabled required>
                                    <label for="ucmka" class="ml-2  text-gray-700">UCM</label> --}}

                                    <x-form.input-radio name="skola" for="ucmka" value="ucm" :checked="old('skola') == 'ucm'" :disabled="old('status') != 'student'" required="true">
                                        UCM
                                    </x-form.input-radio>

                                </div>
                                <div class="flex items-center">
                                    <x-form.input-radio name="skola" for="inam" value="ina" :checked="old('skola') == 'ina'" :disabled="old('status') != 'student'" required="true">
                                        Iná
                                    </x-form.input-radio>

                                    {{-- <input type="radio" id="inam" name="skola" value="ina"
                                        class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" disabled required>
                                    <label for="inam" class="ml-2  text-gray-700">Iná</label> --}}
                                </div>
                            </div>
                            <x-form.error name="skola" errorBag="default"/>
                        </div>

                        <!-- Study type selection -->
                        <div class="flex flex-col mt-0 lg:mt-6 {{ old('skola') == 'ucm' ? '' : 'hidden' }}" id="ucmkari">
                            <x-form.label name="studium" title="Druh štúdia"  required="true"/>
                            <div class="flex mt-1">
                                <div class="flex items-center mr-4">
                                    <x-form.input-radio name="studium" for="option3" value="interne" :checked=" old('studium') == 'interne'" required="true" :disabled=" old('skola') != 'ucm'">
                                        Interné
                                    </x-form.input-radio>

                                    {{-- <input type="radio" id="option3" name="studium" value="interne"
                                        class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" disabled required> 
                                    <label for="option3" class="ml-2  text-gray-700">Interné</label> --}}
                                </div>
                                <div class="flex items-center">
                                    <x-form.input-radio name="studium" for="option4" value="externe" :checked=" old('studium') == 'externe'" required="true" :disabled=" old('skola') != 'ucm'">
                                        Externé
                                    </x-form.input-radio>

                                    {{-- <input type="radio" id="option4" name="studium" value="externe"
                                        class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" disabled required>
                                    <label for="option4" class="ml-2  text-gray-700">Externé</label> --}}
                                </div>
                            </div>
                            <x-form.error name="studium" errorBag="default"/>
                        </div>

                        <!-- Program selection -->
                        <div class="flex flex-col mt-0 lg:mt-6 {{ old('skola') == 'ucm' ? '' : 'hidden' }}" id="ucmkari2" >
                            <x-form.label name="program" title="Program"  required="true"/>
                            <div class="flex ">
                                <div class="flex items-center lg:items-baseline mr-4">
                                    <input type="radio" id="option5" name="program" value="apin"
                                        class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 mt-1" {{ old('skola') == 'ucm' ? '' : 'disabled' }} required {{
                                            old('program') == 'apin' ? 'checked' : '' }}>
                                    <label for="option5" class="ml-2 block  text-gray-700 text-sm leading-5.6">Aplikovaná
                                        informatika</label>
                                </div>
                                <div class="flex items-center lg:items-baseline">
                                    <input type="radio" id="option6" name="program" value="iny"
                                        class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500  lg:mt-1" {{
                                            old('program') == 'iny' ? 'checked' : '' }} {{ old('skola') == 'ucm' ? '' : 'disabled' }} required>
                                    <label for="option6" class="ml-2  text-gray-700 text-sm leading-5.6 mt-0 lg:-mt-1">Iný</label>
                                  
                                </div>
                            </div>
                            <x-form.error name="program" errorBag="default"/>
                        </div>
                    </div>
                    <div id="ina" class="mt-3 {{ old('skola') == 'ina'  ? '' : 'hidden' }}" >
                        <input type="text"
                            class="t-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-500" value="{{old('ina')}}"
                            name="ina" id="nu" placeholder="Názov školy" {{ old('skola') == 'ina'  ? '' : 'disabled' }} required>
                            <x-form.error name="ina" errorBag="default"/>
                    </div>
                    <div id="iny" class="mt-3 {{ old('program') == 'iny'  ? '' : 'hidden' }}" >
                        
                                <input type="text"
                                    class="t-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-500" value="{{old('iny')}}"
                                    name="iny" id="ny" placeholder="Názov programu" {{ old('program') == 'iny'  ? '' : 'disabled' }}  required>
                                    <x-form.error name="iny" errorBag="default"/>
                            </div>
                
                
                <x-form.field>
                <x-form.input name="name" type="text" title="Meno" placeholder="Meno" required="true"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="lastname" type="text" title="Priezvisko" placeholder="Priezvisko" required="true"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="email" type="email" title="Email" placeholder="Email" required="true"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="sekemail" type="email" title="Sekundárny email" placeholder="Sekundárny email"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="ulicacislo" type="text" title="Ulica a popisné číslo" placeholder="Ulica a popisné číslo" required="true"/>
                </x-form.field>
                <x-form.field>
                <x-form.input name="mestoobec" type="text" title="Mesto / Obec" placeholder="Mesto / Obec" required="true"/></x-form.field>
                <x-form.field>

                <x-form.input name="psc" type="text" title="PSČ" placeholder="PSČ" required="true"/>
                </x-form.field>
        
                <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                    Odoslať
                </x-form.button>
            </form>
                </div>
            </div>
            </x-slot:create>

            <x-form.search action="{{ route('admin.students.index') }}" text="Zoradiť">
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
                        
                    
                        <x-slot:search>
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
                    </x-slot:search>
                </x-form.search>
                <x-single-table>
                    <x-slot:head>
                                    <th scope="col" class="py-3 px-6">Meno</th>
                                    <th scope="col" class="py-3 px-6">Email</th>
                                    <th scope="col" class="py-3 px-6">Prihlášky</th>
                                    <th scope="col" class="py-3 px-6">Aktuálne triedy</th>
                                    <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">Akcie</th>
                                </x-slot:head>
                                @foreach ($students as $student)
                                <tr
                            class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                    <td class="py-4 px-6">
                                        <x-table.td url="students/{{ $student->id }}">{{$student->name}} {{$student->lastname}}
                                        </x-table.td></td>
                                    <td class="py-4 px-6">{{$student->email}}</td>
                                    <td class="py-4 px-6">
                                        @foreach($student->applications as $application)
                                        {{$application->coursetype->name}} - {{$application->coursetype->type == '0' ? 'študentský' :
                                        'inštruktorský'}} ({{$application->academy->name}} akadémia)<br>
                                        @endforeach
                                    </td>
                                    <td class="py-4 px-6">
                                        @foreach($student->classes as $class)
                                        <x-table.td url="classes/{{ $class->id }}">
                                        {{$class->name}} ({{$class->coursetype->name}} - {{$class->coursetype->type == '0' ? 'študentský' :
                                        'inštruktorský'}})</x-table.td><br>
                                        @endforeach
                                    </td>
                                    <x-table.td-last url="students/{{ $student->id }}" edit=1 itemName="študenta {{$student->name}} {{$student->lastname}}? Spolu sním sa vymažú všetky jeho prihlášky aj absolvované kurzy. Takisto sa odstráni z aktuálnych tried." />
                                    
                                </tr>
                                @endforeach
                            </x-single-table>

    </x-setting>
