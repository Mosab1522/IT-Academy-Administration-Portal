<x-layout />
<x-setting heading="Prihlásiť sa na kurz">

    <a class="inline-block w-1/2 font-bold text-base {{old('typ')!=" stary" ? 'text-blue-500' : 'text-gray-700'
        }} " href=" #" id="switch-form">Úplné prihlásenie na kurz</a>


    <a class="inline font-bold text-smm {{old('typ')==" stary" ? 'text-blue-500' : 'text-gray-700' }}" href="#"
        id="switch-form2">Zjednodušené prihlásenie na kurz</a>

    <form id="novy" action="/" method="post" class="{{old('typ')!=" stary" ? '' :'hidden'}}">
        @csrf
        <input type="hidden" name="typ" value="novy" />
        <x-form.field>
            <p class="block my-3 font-light text-xs border border-gray200 p-3 rounded-xl"><span
                    class="font-medium">&#9432</span> Úplné prihlásenie je určené pre nových študentov, <span
                    class="font-normal">ktorý si vytvárajú svoju prvú prihlášku v našom systéme.</span> V prípade, že
                ste si už vytvárali úplnú prihlášku využite možnosť <span class=" font-normal">Zjednodušené prihlásenie
                    na kurz.</span></p>
            <h3 class="block mt-5 mb-3 uppercase font-bold text-sm text-gray-700">Kurzy</h3>

            <div class="items-center">
                <x-form.label name="typ kurzu:" />
    
                <input class="mr-0.5" type="radio"  name="type" value="0" {{old('type')=='0'
                    ? 'checked' : '' }}>
                <label for="0">Študentský</label>
    
                <input class="ml-2 mr-0.5" type="radio"  name="type" value="1"
                    {{old('type')=='1' ? 'checked' : '' }}>
                <label for="1">Inštruktorský</label>
    
            </div>

            <div class="mt-4 hidden" id="inst" >

                <div>




                    <x-form.label name="akadémia" />
                    <!-- parent -->
                    <select name="academy_id" class="combo-a" data-nextcombo=".combo-b">
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
                        @foreach (\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [1, 2])->get() as $type)
                        <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                            {{-- {{old('coursetype_id')==$type->id ? 'selected' : ''}} --}}
                            >{{
                            ucwords($type->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            

            <div class="mt-4 hidden" id="stud">

                <div>




                    <x-form.label name="akadémia" />
                    <!-- parent -->
                    <select name="academy_id2" class="combo-a3" data-nextcombo=".combo-b3">
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
                    <select name="coursetype_id2" id="coursetype_id" class="combo-b3" disabled>
                        <option value="" disabled selected hidden>Typ kurzu</option>
                        {{-- @php
                        $academy = \App\Models\CourseType::all();
                        @endphp --}}
                        @foreach (\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [0, 2])->get() as $type2)
                        <option value="{{ $type2->id }}" data-id="{{ $type2->id }}" data-option="{{ $type2->academy_id }}"
                            {{-- {{old('coursetype_id')==$type->id ? 'selected' : ''}} --}}
                            >{{
                            ucwords($type2->name) }}</option>
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


        </x-form.field>

        <h3 class="block mt-5 mb-3 uppercase font-bold text-sm text-gray-700">Osobné údaje</h3>


        <div class="items-center">
            <x-form.label name="som:" />

            <input class="mr-0.5" type="radio" id="student" name="status" value="student" {{old('status')=='student'
                ? 'checked' : '' }}>
            <label for="student">Študent</label>

            <input class="ml-2 mr-0.5" type="radio" id="nestudent" name="status" value="nestudent"
                {{old('status')=='nestudent' ? 'checked' : '' }}>
            <label for="nestudent">Neštudent</label>

        </div>

        <div class="flex pb-1">
            <div class="h-20 mt-3 {{old('skola') ? '' : 'hidden' }}" id="ucm">
                <x-form.label name="univerzita:" />
                <div class=" flex">
                    <div>

                        <input type="radio" id="ucmka" name="skola" value="ucm" {{old('skola')=='ucm' ? 'checked' : ''
                            }}>
                        <label for="option1">UCM</label><br>
                        <div class="mt-1">
                            <input type="radio" id="inam" name="skola" value="ina" {{old('skola')=='ina' ? 'checked'
                                : '' }}>
                            <label for="option2">Iná</label><br>
                        </div>
                    </div>

                    <div id="ina" class="{{old('skola')=='ina' ? '' : 'hidden' }}"><input
                            class=" border border-gray-200 mt-6 ml-2 p-2 w-80 rounded h-7" name="ina" id="nu" required
                            value="{{old('ina') }}" {{old('skola')=='ina' ? '' : 'disabled' }}></div>
                </div>
            </div>

            <div class="ml-4 mt-3 {{old('skola')=='ucm' ? '' : 'hidden' }}" id="ucmkari">

                <x-form.label name="studium:" />

                <input type="radio" id="option3" name="studium" value="interne" {{old('studium')=='interne' ? 'checked'
                : '' }}>
                <label for="option1">Interné</label><br>
                <div class="mt-1">
                    <input type="radio" id="option4" name="studium" value="externe" {{old('studium')=='externe' ? 'checked'
                    : '' }}>
                    <label for="option2">Externé</label><br>
                </div>
            </div>




            <div class="ml-4 mt-3 {{old('skola')=='ucm' ? '' : 'hidden' }}" id="ucmkari2">
                <x-form.label name="program:" />
                <div>
                    <input type="radio" id="option5" name="program" value="apin" {{old('program')=='apin' ? 'checked'
                    : '' }}>
                    <label for="option1">Aplikovaná informatika</label><br>
                    <div class="mt-1">
                        <input type="radio" id="option6" name="program" value="iny" {{old('program')=='iny' ? 'checked'
                        : '' }}>
                        <label for="option2">Iný</label><br>
                    </div>
                </div>
            </div>
            <div class="mt-16 -ml-32 {{old('program')=='iny' ? ''
            : 'hidden' }}" id="iny"><input
                    class=" border border-gray-200 ml-2 p-2 w-80 rounded h-7" name="iny" id="ny" value="{{old('iny')}}" required {{old('program')=='iny' ? ''
                    : 'disabled' }}>
            </div>


        </div>
        <x-form.input name="name" />
        <x-form.input name="lastname" />
        <x-form.input name="email" type="email" />
        <x-form.input name="sekemail" type="email" />
        <x-form.input name="ulicacislo" />
        <x-form.input name="mestoobec" />
        <x-form.input name="psc" />

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


        <x-form.error name="category" />

        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
    <form id="stary" action="/" method="post" class="{{old('typ')==" stary" ? '' :'hidden'}}">



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
            <p class="block my-3 font-light text-xs border border-gray200 p-3 rounded-xl"><span
                    class="font-medium">&#9432</span> Zjednodušené prihlásenie je určené pre študentov, <span
                    class="font-normal">ktorý si už vytvorili úplnú prihlášku a sú evidovaný v našom systéme. </span> V
                prípade, že ste si ešte nevytvárali úplnú prihlášku využite možnosť <span class=" font-normal">Úplné
                    prihlásenie na kurz.</span></p>
            @csrf
            <input type="hidden" name="typ" value="stary" />
            <h3 class="block mt-5 mb-3 uppercase font-bold text-sm text-gray-700">Kurzy</h3>
            <div class="items-center">
                <x-form.label name="typ kurzu:" />
    
                <input class="mr-0.5" type="radio"  name="type2" value="0" {{old('type')=='0'
                    ? 'checked' : '' }}>
                <label for="0">Študentský</label>
    
                <input class="ml-2 mr-0.5" type="radio"  name="type2" value="1"
                    {{old('type')=='1' ? 'checked' : '' }}>
                <label for="1">Inštruktorský</label>
    
            </div>

            <div class="mt-4 hidden" id="inst2">
                <div>
                    <x-form.label name="akadémia" />
                    <!-- parent -->
                    <select name="academy_id" class="combo-a2" data-nextcombo=".combo-b2">
                        <option value="" disabled selected hidden>Akadémia</option>
                        @php
                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                        ->get();
                        @endphp
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
                    <select name="coursetype_id" id="coursetype_id2" class="combo-b2" disabled>
                        <option value="" disabled selected hidden>Typ kurzu</option>
                        {{-- @php
                        $academy = \App\Models\CourseType::all();
                        @endphp --}}
                        @foreach (\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [1, 2])->get() as $type)
                        <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                            {{-- {{old('coursetype_id')==$type->id ? 'selected' : ''}} --}}
                            >{{
                            ucwords($type->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4 hidden" id="stud2">
                <div>
                    <x-form.label name="akadémia" />
                    <!-- parent -->
                    <select name="academy_id2" class="combo-a4" data-nextcombo=".combo-b4">
                        <option value="" disabled selected hidden>Akadémia</option>
                        @php
                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                        ->get();
                        @endphp
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
                    <select name="coursetype_id2" id="coursetype_id2" class="combo-b4" disabled>
                        <option value="" disabled selected hidden>Typ kurzu</option>
                        {{-- @php
                        $academy = \App\Models\CourseType::all();
                        @endphp --}}
                        @foreach (\App\Models\CourseType::with(['academy','applications'])->whereIn('type', [0, 2])->get() as $type2)
                        <option value="{{ $type2->id }}" data-id="{{ $type2->id }}" data-option="{{ $type2->academy_id }}"
                            {{-- {{old('coursetype_id')==$type->id ? 'selected' : ''}} --}}
                            >{{
                            ucwords($type2->name) }}</option>
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


        </x-form.field>

        <h3 class="block mt-5 mb-3 uppercase font-bold text-sm text-gray-700">Osobné údaje</h3>

        <x-form.input name="email" type="email" />



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

        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
    {{-- @php
    old()->forget('typ');
    @endphp --}}
</x-setting>

<script>
    var oldInput = {!! json_encode(old()) !!};

</script>