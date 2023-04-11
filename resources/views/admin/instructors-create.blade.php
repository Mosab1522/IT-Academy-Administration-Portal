<x-layout/>

<x-setting heading="Vytvoriť akadémiu">
    <form action="/admin/instructors/create" method="post">
        @csrf
        <x-form.input name="name" />
        <x-form.input name="lastname" />
        <x-form.input name="email" />

        
        <x-form.field>
            <div class="flex">
                <div>
                    <x-form.label name="akadémia" />
                    <!-- parent -->
                    <select name="academy_id[1]" class="combo-a1" data-nextcombo=".combo-b1">
                        <option value="" disabled selected hidden>Akadémia</option>
                        @php
                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                ->get();
                        @endphp
                        @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                        ->get() as $academ)
                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{old('academy_id') == $academ->id ? 'selected' : ''}}>{{
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
                    {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c" disabled>
                        <option value="" disabled selected hidden>Typ kurzu</option>
                        <option value="1" data-id="1" data-option="1">Lahky</option>
                        <option value="2" data-id="2" data-option="1">Stredny</option>
                        <option value="3" data-id="3" data-option="2">Photoshop</option>
                        <option value="4" data-id="4" data-option="2">Illustrator</option>
                    </select> --}}
                    <select name="coursetypes_id[1]" id="coursetypes_id[1]" class="combo-b1" disabled>
                        <option value="" disabled selected hidden>Typ kurzu</option>
                        {{-- @php
                        $academy = \App\Models\CourseType::all();
                        @endphp --}}
                        @foreach (\App\Models\CourseType::with(['academy','applications'])->get() as $type)
                        <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}" {{old('coursetype_id') == $type->id ? 'selected' : ''}}>{{
                            ucwords($type->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-form.field>
        <x-form.field>
            <div class="flex">
                <div>
                    <x-form.label name="akadémia" />
                    <!-- parent -->
                    <select name="academy_id[2]" class="combo-a2" data-nextcombo=".combo-b2">
                        <option value="" disabled selected hidden>Akadémia</option>
                        @php
                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                ->get();
                        @endphp
                        @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                        ->get() as $academ)
                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{old('academy_id') == $academ->id ? 'selected' : ''}}>{{
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
                    {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c" disabled>
                        <option value="" disabled selected hidden>Typ kurzu</option>
                        <option value="1" data-id="1" data-option="1">Lahky</option>
                        <option value="2" data-id="2" data-option="1">Stredny</option>
                        <option value="3" data-id="3" data-option="2">Photoshop</option>
                        <option value="4" data-id="4" data-option="2">Illustrator</option>
                    </select> --}}
                    <select name="coursetypes_id[2]" id="coursetypes_id[2]" class="combo-b2" disabled>
                        <option value="" disabled selected hidden>Typ kurzu</option>
                        {{-- @php
                        $academy = \App\Models\CourseType::all();
                        @endphp --}}
                        @foreach (\App\Models\CourseType::with(['academy','applications'])->get() as $type)
                        <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}" {{old('coursetype_id') == $type->id ? 'selected' : ''}}>{{
                            ucwords($type->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-form.field>
       
        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
</x-setting>