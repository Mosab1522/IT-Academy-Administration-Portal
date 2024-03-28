<x-flash />
<x-layout/>
<x-setting heading="Vytvoriť typ kurzu">
    <form action="/admin/classes/create" method="post">
        @csrf
        <x-form.label name="Zapísať všetkých ktorý majú prihlášku na kurz?" />
        <input type="checkbox" name="students">
        <x-form.input name="name" />
        <x-form.field>
       
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
    </x-form.field>
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
       
        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
</x-setting>