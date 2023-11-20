<x-flash />
<x-layout />
<x-setting heading="Vytvoriť inštruktora">
    <form action="/admin/instructors/create" method="post" enctype="multipart/form-data">
        @csrf
        <x-form.input name="name" />
        <x-form.input name="lastname" />
        <x-form.input name="email" type="email"/>
        <x-form.input name="sekemail" type="email"/>

        <input type="file" name="photo">
       
        <x-form.input name="telephone" type="tel"/>


        <x-form.input name="ulicacislo" />
        <x-form.input name="mestoobec" />
        <x-form.input name="psc" />


        {{-- <x-form.field>
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
                        @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                            {{old('academy_id')==$academ->id ? 'selected' : ''}}>{{
                            ucwords($academ->name)}}</option>
                        @endforeach
                        {{-- <option value="" disabled selected hidden>Akadémia</option>
                        <option value="1" data-id="1" data-option="-1">Cisco</option>
                        <option value="2" data-id="2" data-option="-1">Adobe</option>
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
                    </select>
                    <select name="coursetypes_id[1]" id="coursetypes_id[1]" class="combo-b1" disabled>
                        <option value="" disabled selected hidden>Typ kurzu</option>
                        {{-- @php
                        $academy = \App\Models\CourseType::all();
                        @endphp
                        @foreach (\App\Models\CourseType::with(['academy', 'applications'])->get() as $type)
                        <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                            {{old('coursetype_id')==$type->id ? 'selected' : ''}}>{{
                            ucwords($type->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-form.field> --}}

        <x-form.field>
            <div id="selects-container">
                <div class="selects-pair" data-pair-id="1">
                    <select name="academy_id[]" id="academy" class="academy-select" data-pair-id="1"
                        >{{--setValue(this.value)--}}
                        <option value="" {{ old('academy_id') ? '' : 'selected' }}>Akadémia</option>
                        {{-- @php
                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                        ->get();
                        @endphp --}}
                        @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{
                            old('academy_id.0')==$academ->id ? 'selected' : '' }}>{{ ucwords($academ->name) }}</option>
                        @endforeach

                    </select><select name="coursetypes_id[]" id="coursetype" class="coursetype-select" data-pair-id="1">
                        <option value="" data-option="" {{ old('coursetype_id') ? '' : 'selected' }}>Typ kurzu
                        </option>
                        {{-- @php
                        $academy = \App\Models\CourseType::all();
                        @endphp --}}
                        @foreach (\App\Models\CourseType::with(['academy', 'applications'])->get() as $type)
                        <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                            {{ old('coursetype_id.0')==$type->id ? 'selected' : '' }}>{{ ucwords($type->name) }}</option>
                        @endforeach
                    </select>
                    {{-- <button class="remove-selects-btn" data-pair-id="1">Remove</button> --}}
                </div>
            </div>
            <button type="button" id="add-selects-btn">Add selects pair</button>
        </x-form.field>

        {{-- <select id="academy" onchange="setValue(this.value)">
            <option value="" {{ old('academy_id') ? '' : 'selected' }}>Akadémia</option> --}}
            {{-- @php
            $academy = \App\Models\Academy::with(['coursetypes','applications'])
            ->get();
            @endphp --}}
            {{-- @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{
                old('academy_id')==$academ->id ? 'selected' : '' }}>{{ ucwords($academ->name) }}</option>
            @endforeach
        </select>
        <select id="coursetype">
            <option value="" data-option="" {{ old('coursetype_id') ? '' : 'selected' }}>Typ kurzu</option> --}}
            {{-- @php
            $academy = \App\Models\CourseType::all();
            @endphp --}}

            {{-- @foreach (\App\Models\CourseType::with(['academy', 'applications'])->get() as $type)
            <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}" {{
                old('coursetype_id')==$type->id ? 'selected' : '' }}>
                {{ ucwords($type->name) }}</option>
            @endforeach
        </select> --}}

        {{-- <x-form.field>
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
                        @foreach (\App\Models\Academy::with(['coursetypes', 'applications'])->get() as $academ)
                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                            {{old('academy_id')==$academ->id ? 'selected' : ''}}>{{
                            ucwords($academ->name)}}</option>
                        @endforeach
                        {{-- <option value="" disabled selected hidden>Akadémia</option>
                        <option value="1" data-id="1" data-option="-1">Cisco</option>
                        <option value="2" data-id="2" data-option="-1">Adobe</option>
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
                    </select>
                    <select name="coursetypes_id[2]" id="coursetypes_id[2]" class="combo-b2" disabled>
                        <option value="" disabled selected hidden>Typ kurzu</option>
                        {{-- @php
                        $academy = \App\Models\CourseType::all();
                        @endphp
                        @foreach (\App\Models\CourseType::with(['academy', 'applications'])->get() as $type)
                        <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                            {{old('coursetype_id')==$type->id ? 'selected' : ''}}>{{
                            ucwords($type->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-form.field> --}}

        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
</x-setting>

<script >
//     const academy = document.querySelector("#academy");
// const coursetype = document.querySelector("#coursetype");
// const subOptions = coursetype.querySelectorAll("option");

// const setValue = (newValue) => {
//     coursetype.innerText = null;
//     for (let i = 0; i < subOptions.length; i++)
//         subOptions[i].dataset.option === newValue &&
//         coursetype.appendChild(subOptions[i]);
// };

// setValue(academy.value);

// coursetype = document.querySelector("#coursetype");
// const coursetypeOptions = coursetype.querySelectorAll("option");
// $('#selects-container').on('change', '.academy-select', function (event) {
//         const pairId = event.target.getAttribute('data-pair-id');
//         const academySelect = document.querySelector(`.academy-select[data-pair-id="${pairId}"]`);
//         const coursetypeSelect = document.querySelector(`.coursetype-select[data-pair-id="${pairId}"]`);
//         // const coursetypeOptions = coursetypeSelect.querySelectorAll("option");
        
//         console.log(coursetypeSelect);
//         const setValue = function (newValue) {
//             coursetypeSelect.innerHTML = null;
//             for (let i = 0; i < coursetypeOptions.length; i++) {
//                 coursetypeOptions[i].dataset.option === newValue && coursetypeSelect.appendChild(coursetypeOptions[i]);
//             }
//         };

//          setValue(academySelect.value);
//     });

</script>

