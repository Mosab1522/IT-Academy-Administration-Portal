<x-layout />
<x-form heading="Prihlásiť sa na kurz UCM akadémie">

    
    
    
        <div class="flex mt-6 lg:mt-0 pt-6 border-t border-gray-200">
            <a href="" 
               class="flex-1 text-center py-2 border-b-2 font-bold text-base cursor-pointer
                      {{ session('success_c') ? 'hidden' : '' }}
                      {{ old('typ') == 'stary' ? 'border-transparent text-gray-500 hover:text-indigo-500 hover:border-indigo-500' : 'border-indigo-500 text-indigo-500  hover:text-indigo-500 hover:border-indigo-500' }}"
               id="switch-form">Úplné prihlásenie na kurz</a>
        
            <a href=""
               class="flex-1 text-center py-2 border-b-2 font-bold text-base cursor-pointer
                      {{ session('success_c') ? 'hidden' : '' }}
                      {{ old('typ') == 'stary' ? 'border-indigo-500 text-indigo-500  hover:text-indigo-500 hover:border-indigo-500'   : 'border-transparent text-gray-500 hover:text-indigo-500 hover:border-indigo-500' }}"
               id="switch-form2">Zjednodušené prihlásenie na kurz</a>
        </div>

        

    <form id="novy" action="/" method="post" class="{{old('typ') == "stary" || session('success_c')  ? 'hidden' :''}}">
        @csrf
        <input type="hidden" name="typ" value="novy" />
        <x-form.field>
            <div class="flex items-center space-x-2 p-3 border border-gray-200 rounded-xl">
                <span class="material-icons info text-gray-500 hover:text-gray-700 cursor-pointer flex-none mt-1">info</span>
                <div class="flex-grow text-xs font-light">
                    Úplné prihlásenie je určené pre nových študentov, <span
                    class="font-normal">ktorý si vytvárajú svoju prvú prihlášku v našom systéme.</span> V prípade, že
                ste si už vytvárali úplnú prihlášku využite možnosť <span class=" font-normal">Zjednodušené prihlásenie
                    na kurz.</span></p>
                </div>
            </div>
            <p class="text-sm font-semibold uppercase text-gray-700 mt-6">Kurzy</p>
            <x-form.required class="mt-1"/>
        </x-form.field>
            <x-form.field>
                

                <div class="items-center mt-6">
                <x-form.label name="type" title="Typ kurzu" required="true"/>

                <div class="flex items-center mt-1">
                    <x-form.input-radio name="type" for="type_student" value="0" required="true">
                        Študentský
                    </x-form.input-radio>
                    <x-form.input-radio class="ml-6" name="type" for="type_instructor" value="1" required="true">
                        Inštruktorský
                    </x-form.input-radio>
                </div>
                <x-form.error name="type" errorBag="novy"/>
                </div>
                {{-- <div class="items-center">
                    <x-form.label name="typ kurzu:" />

                    <input class="mr-0.5" type="radio" name="type" value="0" {{old('type')=='0' ? 'checked' : '' }}>
                    <label for="0">Študentský</label>

                    <input class="ml-2 mr-0.5" type="radio" name="type" value="1" {{old('type')=='1' ? 'checked' : ''
                        }}>
                    <label for="1">Inštruktorský</label>

                </div> --}}

                <div class="mt-6 {{old('type') == '1' && $errors->novy->any() ? 'flex' : 'hidden'}}" id="inst">

                    <div class="w-1/2 mr-2">
                        <x-form.select name="academy_id" title="Akadémia" class=" combo-a" data-nextcombo=".combo-b" errorBag="novy" :disabled="old('type') != '1' || !$errors->novy->any()" required="true">
                        <!-- parent -->
                        {{-- <select name="academy_id" class="combo-a" data-nextcombo=".combo-b"> --}}
                            <option value="" disabled selected hidden>Akadémia</option>
                            {{-- @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            @endphp --}}
                            @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                            ->get() as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{--
                                {{old('academy_id')==$academ->id ? 'selected' : ''}} --}}
                                >{{
                                ucwords($academ->name)}}</option>
                            @endforeach
                            {{-- <option value="" disabled selected hidden>Akadémia</option>
                            <option value="1" data-id="1" data-option="-1">Cisco</option>
                            <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                        </x-form.select>
                    </div>
                    <div class="w-1/2 ml-2">
                        <x-form.select name="coursetype_id" title="Kurz" class="combo-b" disabled  errorBag="novy" required="true">
                        
                        <!-- child -->
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c"
                            disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            <option value="1" data-id="1" data-option="1">Lahky</option>
                            <option value="2" data-id="2" data-option="1">Stredny</option>
                            <option value="3" data-id="3" data-option="2">Photoshop</option>
                            <option value="4" data-id="4" data-option="2">Illustrator</option>
                        </select> --}}
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled> --}}
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            {{-- @php
                            $academy = \App\Models\CourseType::all();
                            @endphp --}}
                            @foreach (\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [1,
                            2])->get() as $type)
                            <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                data-option="{{ $type->academy_id }}" {{-- {{old('coursetype_id')==$type->id ?
                                'selected' : ''}} --}}
                                >{{
                                ucwords($type->name) }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                    
                </div>


                <div class="mt-6 {{old('type') == '0' && $errors->novy->any() ? 'flex' : 'hidden'}}" id="stud">

                    <div class="w-1/2 mr-2">
                        <x-form.select name="academy_id2" title="Akadémia" class=" combo-a2" data-nextcombo=".combo-b2" :disabled="old('type') != '0'  || !$errors->novy->any() "  errorBag="novy" required="true">

                        <!-- parent -->
                        
                            <option value="" disabled selected hidden>Akadémia</option>
                            {{-- @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            @endphp --}}
                            @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                            ->get() as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{--
                                {{old('academy_id')==$academ->id ? 'selected' : ''}} --}}
                                >{{
                                ucwords($academ->name)}}</option>
                            @endforeach
                            {{-- <option value="" disabled selected hidden>Akadémia</option>
                            <option value="1" data-id="1" data-option="-1">Cisco</option>
                            <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                        </x-form.select>
                    </div>
                    <div class="w-1/2 ml-2">
                        <x-form.select name="coursetype_id2" title="Kurz" class="combo-b2" disabled  errorBag="novy" required="true">
                        <!-- child -->
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c"
                            disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            <option value="1" data-id="1" data-option="1">Lahky</option>
                            <option value="2" data-id="2" data-option="1">Stredny</option>
                            <option value="3" data-id="3" data-option="2">Photoshop</option>
                            <option value="4" data-id="4" data-option="2">Illustrator</option>
                        </select> --}}
                        
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            {{-- @php
                            $academy = \App\Models\CourseType::all();
                            @endphp --}}
                            @foreach (\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [0,
                            2])->get() as $type2)
                            <option value="{{ $type2->id }}" data-id="{{ $type2->id }}"
                                data-option="{{ $type2->academy_id }}" {{-- {{old('coursetype_id')==$type->id ?
                                'selected' : ''}} --}}
                                >{{
                                ucwords($type2->name) }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            </x-form.field>



            <x-form.field>
               
                <x-form.select name="days" title="Dni"  errorBag="novy" required="true">
                    
                        <option value="" disabled selected hidden>Dni výučby</option>
                        <option value="1" {{old('days')==1 ? 'selected' : '' }}>Týždeň</option>
                        <option value="2" {{old('days')==2 ? 'selected' : '' }}>Víkend</option>
                        <option value="3" {{old('days')==3 ? 'selected' : '' }}>Nezáleží</option>
                        {{-- <option value="1" data-id="1" data-option="2">Týždeň</option>
                        <option value="1" data-id="1" data-option="3">Týždeň</option>
                        <option value="2" data-id="2" data-option="3">Víkend</option>
                        <option value="3" data-id="3" data-option="3">Nezáleží</option>
                        <option value="1" data-id="1" data-option="4">Týždeň</option> --}}
                </x-form.select>
                    </x-form.field>
                <x-form.field>
                    <x-form.select name="time" title="Čas" errorBag="novy" required="true">
                    
                        <option value="" disabled selected hidden>Čas výučby</option>
                        <option value="1" {{old('time')==1 ? 'selected' : '' }}>Ranný</option>
                        <option value="2" {{old('time')==3 ? 'selected' : '' }}>Poobedný</option>
                        <option value="3" {{old('time')==3 ? 'selected' : '' }}>Nezáleží</option>
                        {{-- <option value="1" data-id="1" data-option="2">Ranný</option>
                        <option value="4" data-id="1" data-option="3">Ranný (Týždeň/Víkend)</option>
                        <option value="5" data-id="2" data-option="3">Poobedný (Týždeň)</option>
                        <option value="3" data-id="3" data-option="3">Nezáleží</option>
                        <option value="1" data-id="1" data-option="4">Ranný</option> --}}
                    </x-form.select>
                 </x-form.field>
       
            {{-- <label>
                <input id="checkbox" type="checkbox" name="status" value="student" class="status-checkbox">
                Student
            </label>
            <label>
                <input id="checkbox2" type="checkbox" name="status" value="nestudent" class="status-checkbox">
                Nestudent
            </label>

            <div id="additional-checkboxes" style="display: none;">
                <label>
                    <input type="checkbox" name="option1" value="option1">
                    Option 1
                </label>
                <label>
                    <input type="checkbox" name="option2" value="option2">
                    Option 2
                </label>
            </div> --}}


       

            <p class="text-sm font-semibold uppercase text-gray-700 mt-6">Osobné informácie</p>


            <div class="flex flex-col  md:grid md:grid-cols-2 lg:flex lg:flex-row  gap-6">
                <div class=" mt-6">
                    <x-form.label name="status" title="Status" required="true"/>

                    <div class="flex items-center mt-1">
                        <x-form.input-radio name="status" for="type_student" value="student"   :checked="old('status') == 'student' && $errors->novy->any()" required="true">
                            Študent
                        </x-form.input-radio>

                        <x-form.input-radio class="ml-4" name="status" for="type_nostudent"
                                value="nestudent" :checked="old('status') == 'nestudent' && $errors->novy->any()"  required="true">
                                Neštudent
                            </x-form.input-radio>

                    </div>
                    <x-form.error name="status" errorBag="novy"/>
                </div>
        
                    <!-- University selection -->
                    <div class="flex flex-col mt-0 md:mt-6 {{ old('status') == 'student' && $errors->novy->any() ? '' : 'hidden' }}" id="ucm" >
                        <x-form.label name="skola" title="Škola" required="true"/>
                        <div class="flex mt-1">
                            <div class="flex items-center mr-4">
                                <x-form.input-radio name="skola" for="ucmka" value="ucm" :checked="old('skola') == 'ucm' && $errors->novy->any()" :disabled="old('status') != 'student'  || !$errors->novy->any()" required="true">
                                    UCM
                                </x-form.input-radio>
                            </div>
                            <div class="flex items-center">
                                <x-form.input-radio name="skola" for="inam" value="ina" :checked="old('skola') == 'ina' && $errors->novy->any()" :disabled="old('status') != 'student'  || !$errors->novy->any()" required="true">
                                    Iná
                                </x-form.input-radio>
                            </div>
                        </div>
                        <x-form.error name="skola" errorBag="novy"/>
                    </div>

                    <!-- Study type selection -->
                    <div class="flex flex-col mt-0 lg:mt-6 {{ old('skola') == 'ucm'  && $errors->novy->any() ? '' : 'hidden' }}" id="ucmkari" >
                        <x-form.label name="studium" title="Druh štúdia" required="true"/>
                        <div class="flex mt-1">
                            <div class="flex items-center mr-4">
                                <x-form.input-radio name="studium" for="option3" value="interne" :checked=" old('studium') == 'interne' && $errors->novy->any()" :disabled=" old('skola') != 'ucm'" required="true">
                                    Interné
                                </x-form.input-radio>
                            </div>
                            <div class="flex items-center">
                                <x-form.input-radio name="studium" for="option4" value="externe" :checked=" old('studium') == 'externe' && $errors->novy->any()" :disabled=" old('skola') != 'ucm' || !$errors->novy->any()" required="true">
                                    Externé
                                </x-form.input-radio>
                            </div>
                        </div>
                        <x-form.error name="studium" errorBag="novy"/>
                    </div>

                    <!-- Program selection -->
                    <div class="flex flex-col mt-0 lg:mt-6 {{ old('skola') == 'ucm'  && $errors->novy->any() ? '' : 'hidden' }}" id="ucmkari2" >
                        <x-form.label name="program" title="Program"  required="true"/>
                        <div class="flex lg:mt-1">
                            <div class="flex items-center lg:items-baseline mr-4">
                                <input type="radio" id="option5" name="program" value="apin"
                                    class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 mt-1" {{ old('skola') == 'ucm' && $errors->novy->any() ? '' : 'disabled' }}  {{
                                        old('program') == 'apin' && $errors->novy->any() ? 'checked' : '' }} required>
                                <label for="option5" class="ml-2 block  text-gray-700 text-sm leading-5.6">Aplikovaná
                                    informatika</label>
                            </div>
                            <div class="flex items-center lg:items-baseline">
                                <input type="radio" id="option6" name="program" value="iny"
                                    class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500  lg:mt-1" {{
                                        old('program') == 'iny' && $errors->novy->any() ? 'checked' : '' }} {{ old('skola') == 'ucm' && $errors->novy->any() ? '' : 'disabled' }} required>
                                <label for="option6" class="ml-2  text-gray-700 text-sm leading-5.6 mt-0 lg:-mt-1">Iný</label>
                            </div>
                        </div>
                        <x-form.error name="program" errorBag="novy"/>
                    </div>
                </div>
                <div id="ina" class="mt-3 {{ old('skola') == 'ina'  && $errors->novy->any()  ? '' : 'hidden' }}" >
                    <input type="text"
                        class="t-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-500" value="{{ $errors->novy->any() ? old('ina') :''}}"
                        name="ina" id="nu" placeholder="Názov školy" {{ old('skola') == 'ina'  && $errors->novy->any()  ? '' : 'disabled' }} required>
                        <x-form.error name="ina" errorBag="novy"/>
                </div>
                <div id="iny" class="mt-3 {{ old('program') == 'iny'  && $errors->novy->any()  ? '' : 'hidden' }}" >
                    
                            <input type="text"
                                class="t-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-500" value="{{$errors->novy->any() ? old('iny') : ''}}"
                                name="iny" id="ny" placeholder="Názov programu" {{ old('program') == 'iny'  && $errors->novy->any()  ? '' : 'disabled' }}  required>
                                <x-form.error name="iny" errorBag="novy"/>
                        </div>


     
                        <x-form.field>
                            <x-form.input name="name" type="text" title="Meno" placeholder="Meno" errorBag="novy" required="true"/>
                            </x-form.field>
                            <x-form.field>
                            <x-form.input name="lastname" type="text" title="Priezvisko" placeholder="Priezvisko" errorBag="novy" required="true"/>
                            </x-form.field>
                            <x-form.field>
                            <x-form.input name="email" type="email" title="Email" placeholder="Email" errorBag="novy" required="true"/>
                            </x-form.field>
                            <x-form.field>
                            <x-form.input name="sekemail" type="email" title="Sekundárny email" placeholder="Sekundárny email" errorBag="novy"/>
                            </x-form.field>
                            <x-form.field>
                            <x-form.input name="ulicacislo" type="text" title="Ulica a popisné číslo" placeholder="Ulica a popisné číslo" errorBag="novy" required="true"/>
                            </x-form.field>
                            <x-form.field>
                            <x-form.input name="mestoobec" type="text" title="Mesto / Obec" placeholder="Mesto / Obec" errorBag="novy" required="true"/></x-form.field>
                            <x-form.field>
            
                            <x-form.input name="psc" type="text" title="PSČ" placeholder="PSČ" errorBag="novy" required="true"/>
                            </x-form.field>
                    
                            <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                                Odoslať
                            </x-form.button>

        {{--
        <x-form.input name="thumbnail" type="file" /> --}}
        {{--
        <x-form.textarea name="excerpt" />
        <x-form.textarea name="body" /> --}}

        {{-- <select id="genre" onchange="setValue(this.value)">
            <option value="Metal">Metal</option>
            <option value="Rock">Rock</option>
        </select>
        <select id="subgenre">
            <option value="Metal" data-option="Metal">Thrash Metal</option>
            <option value="Metal" data-option="Metal">Death Metal</option>
            <option value="Metal" data-option="Metal">Black Metal</option>
            <option value="Rock" data-option="Rock">Classic Rock</option>
            <option value="Rock" data-option="Rock">Hard Rock</option>
        </select> --}}







        {{-- <select name="category_id" id="category_id">
            @php
            $categories = \App\Models\Category::all();
            @endphp
            @foreach (\App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" {{old('category_id')==$category->id ? 'selected' : ''}}
                >{{ ucwords($category->name) }}</option>
            @endforeach

        </select> --}}


        

    </form>
    <form id="stary" action="/" method="post" class="{{old('typ') == "stary" ? '' :'hidden'}}">



        {{--
        <x-form.input name="thumbnail" type="file" /> --}}
        {{--
        <x-form.textarea name="excerpt" />
        <x-form.textarea name="body" /> --}}

        {{-- <select id="genre" onchange="setValue(this.value)">
            <option value="Metal">Metal</option>
            <option value="Rock">Rock</option>
        </select>
        <select id="subgenre">
            <option value="Metal" data-option="Metal">Thrash Metal</option>
            <option value="Metal" data-option="Metal">Death Metal</option>
            <option value="Metal" data-option="Metal">Black Metal</option>
            <option value="Rock" data-option="Rock">Classic Rock</option>
            <option value="Rock" data-option="Rock">Hard Rock</option>
        </select> --}}

        <x-form.field>
            <div class="flex items-center space-x-2 p-3 border border-gray-200 rounded-xl">
                <span class="material-icons info text-gray-500 hover:text-gray-700 cursor-pointer flex-none mt-1">info</span>
                <div class="flex-grow text-xs font-light"> Zjednodušené prihlásenie je určené pre študentov, <span
                    class="font-normal">ktorý si už vytvorili úplnú prihlášku a sú evidovaný v našom systéme. </span> V
                prípade, že ste si ešte nevytvárali úplnú prihlášku využite možnosť <span class=" font-normal">Úplné
                    prihlásenie na kurz.</span></p>
                </div>
            </div>
            <p class="text-sm font-semibold uppercase text-gray-700 mt-6">Kurzy</p>
            <x-form.required class="mt-1"/>
        </x-form.field>

      
    


            @csrf
            <input type="hidden" name="typ" value="stary" />
           
            <x-form.field>
                

                <div class="items-center mt-6">
                <x-form.label name="type2" title="Typ kurzu" required="true"/>

                <div class="flex items-center mt-1">
                    <x-form.input-radio name="type2" for="type_student" value="0" required="true" >
                        Študentský
                    </x-form.input-radio>
                    <x-form.input-radio class="ml-6" name="type2" for="type_instructor" value="1" required="true">
                        Inštruktorský
                    </x-form.input-radio>
                </div>
                <x-form.error name="type" errorBag="stary"/>
                </div>
                {{-- <div class="items-center">
                    <x-form.label name="typ kurzu:" />

                    <input class="mr-0.5" type="radio" name="type" value="0" {{old('type')=='0' ? 'checked' : '' }}>
                    <label for="0">Študentský</label>

                    <input class="ml-2 mr-0.5" type="radio" name="type" value="1" {{old('type')=='1' ? 'checked' : ''
                        }}>
                    <label for="1">Inštruktorský</label>

                </div> --}}

                <div class="mt-6 {{old('type2') == '1' && $errors->stary->any() ? 'flex' : 'hidden'}}" id="inst2">

                    <div class="w-1/2 mr-2">
                        <x-form.select name="academy_id" title="Akadémia" class=" combo-a3" data-nextcombo=".combo-b3" errorBag="stary" :disabled="old('type2') != '1' || !$errors->stary->any()" required="true">
                        <!-- parent -->
                        {{-- <select name="academy_id" class="combo-a" data-nextcombo=".combo-b"> --}}
                            <option value="" disabled selected hidden>Akadémia</option>
                            {{-- @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            @endphp --}}
                            @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                            ->get() as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{--
                                {{old('academy_id')==$academ->id ? 'selected' : ''}} --}}
                                >{{
                                ucwords($academ->name)}}</option>
                            @endforeach
                            {{-- <option value="" disabled selected hidden>Akadémia</option>
                            <option value="1" data-id="1" data-option="-1">Cisco</option>
                            <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                        </x-form.select>
                    </div>
                    <div class="w-1/2 ml-2">
                        <x-form.select name="coursetype_id" title="Kurz" class="combo-b3" disabled  errorBag="stary" required="true">
                        
                        <!-- child -->
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c"
                            disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            <option value="1" data-id="1" data-option="1">Lahky</option>
                            <option value="2" data-id="2" data-option="1">Stredny</option>
                            <option value="3" data-id="3" data-option="2">Photoshop</option>
                            <option value="4" data-id="4" data-option="2">Illustrator</option>
                        </select> --}}
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled> --}}
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            {{-- @php
                            $academy = \App\Models\CourseType::all();
                            @endphp --}}
                            @foreach (\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [1])->get() as $type)
                            <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                data-option="{{ $type->academy_id }}" {{-- {{old('coursetype_id')==$type->id ?
                                'selected' : ''}} --}}
                                >{{
                                ucwords($type->name) }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                    
                </div>


                <div class="mt-6 {{old('type2') == '0' && $errors->stary->any() ? 'flex' : 'hidden'}}" id="stud2">

                    <div class="w-1/2 mr-2">
                        <x-form.select name="academy_id2" title="Akadémia" class=" combo-a4" data-nextcombo=".combo-b4" :disabled="old('type2') != '0'  || !$errors->stary->any() "  errorBag="stary" required="true">

                        <!-- parent -->
                        
                            <option value="" disabled selected hidden>Akadémia</option>
                            {{-- @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            @endphp --}}
                            @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                            ->get() as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{--
                                {{old('academy_id')==$academ->id ? 'selected' : ''}} --}}
                                >{{
                                ucwords($academ->name)}}</option>
                            @endforeach
                            {{-- <option value="" disabled selected hidden>Akadémia</option>
                            <option value="1" data-id="1" data-option="-1">Cisco</option>
                            <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                        </x-form.select>
                    </div>
                    <div class="w-1/2 ml-2">
                        <x-form.select name="coursetype_id2" title="Kurz" class="combo-b4" disabled  errorBag="stary" required="true">
                        <!-- child -->
                        {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c"
                            disabled>
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            <option value="1" data-id="1" data-option="1">Lahky</option>
                            <option value="2" data-id="2" data-option="1">Stredny</option>
                            <option value="3" data-id="3" data-option="2">Photoshop</option>
                            <option value="4" data-id="4" data-option="2">Illustrator</option>
                        </select> --}}
                        
                            <option value="" disabled selected hidden>Typ kurzu</option>
                            {{-- @php
                            $academy = \App\Models\CourseType::all();
                            @endphp --}}
                            @foreach (\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [0])->get() as $type2)
                            <option value="{{ $type2->id }}" data-id="{{ $type2->id }}"
                                data-option="{{ $type2->academy_id }}" {{-- {{old('coursetype_id')==$type->id ?
                                'selected' : ''}} --}}
                                >{{
                                ucwords($type2->name) }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            </x-form.field>




            <x-form.field>
               
                <x-form.select name="days" title="Dni" errorBag="stary" required="true">
                    
                        <option value="" disabled selected hidden>Dni výučby</option>
                        <option value="1" {{old('days')==1 ? 'selected' : '' }}>Týždeň</option>
                        <option value="2" {{old('days')==2 ? 'selected' : '' }}>Víkend</option>
                        <option value="3" {{old('days')==3 ? 'selected' : '' }}>Nezáleží</option>
                        {{-- <option value="1" data-id="1" data-option="2">Týždeň</option>
                        <option value="1" data-id="1" data-option="3">Týždeň</option>
                        <option value="2" data-id="2" data-option="3">Víkend</option>
                        <option value="3" data-id="3" data-option="3">Nezáleží</option>
                        <option value="1" data-id="1" data-option="4">Týždeň</option> --}}
                </x-form.select>
                    </x-form.field>
                <x-form.field>
                    <x-form.select name="time" title="Čas" errorBag="stary" required="true">
                    
                        <option value="" disabled selected hidden>Čas výučby</option>
                        <option value="1" {{old('time')==1 ? 'selected' : '' }}>Ranný</option>
                        <option value="2" {{old('time')==3 ? 'selected' : '' }}>Poobedný</option>
                        <option value="3" {{old('time')==3 ? 'selected' : '' }}>Nezáleží</option>
                        {{-- <option value="1" data-id="1" data-option="2">Ranný</option>
                        <option value="4" data-id="1" data-option="3">Ranný (Týždeň/Víkend)</option>
                        <option value="5" data-id="2" data-option="3">Poobedný (Týždeň)</option>
                        <option value="3" data-id="3" data-option="3">Nezáleží</option>
                        <option value="1" data-id="1" data-option="4">Ranný</option> --}}
                    </x-form.select>
                
        </x-form.field>
            {{-- <label>
                <input id="checkbox" type="checkbox" name="status" value="student" class="status-checkbox">
                Student
            </label>
            <label>
                <input id="checkbox2" type="checkbox" name="status" value="nestudent" class="status-checkbox">
                Nestudent
            </label>

            <div id="additional-checkboxes" style="display: none;">
                <label>
                    <input type="checkbox" name="option1" value="option1">
                    Option 1
                </label>
                <label>
                    <input type="checkbox" name="option2" value="option2">
                    Option 2
                </label>
            </div> --}}



            <p class="text-sm font-semibold uppercase text-gray-700 mt-6">Osobné informácie</p>

            <x-form.field>
                <x-form.input name="email" type="email" title="Email" placeholder="Email" errorBag="stary" required="true"/>
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


     

        <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
            Odoslať
        </x-form.button>
    </form>
    <p  class="{{session('success_c') ? '' : 'hidden'}} block text-center my-3 font-light text-base border border-gray200 p-3 rounded-xl  text-gray-700 leading-5.6"> Ďakujeme za prihlásenie na kurz. <br> Potvrdenie Vám bolo odoslané na Vami zadanú e-mailovú adresu: <span
        class="font-normal">{{session('success_c')}}<br> Prosíme aby ste si po skontrolovaní údajov v e-maili potvrdili prihlášku kliknutím na potvrdzovací LINK v danom e-maili, ďakujeme.</span>  <br> V prípade, že
    ste zadali zlý email, alebo iné údaje kontaktujte nás e-mailom na: <span class=" font-normal">blabla@ucm.sk</span>
    <a href="/"
    class = 'mt-6 md:w-40 items-center m-auto w-full sm:w-auto block py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-200'
        >Naspäť</a>
    </p>
    
    {{-- @php
    old()->forget('typ');
    @endphp --}}
</x-form>

<script>
    var oldInput = {!! json_encode(old()) !!};

</script>