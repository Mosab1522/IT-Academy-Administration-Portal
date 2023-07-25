<x-layout/>

<x-setting heading="Prihlásiť sa na kurz">
    <form action="/" method="post">
        @csrf
        <x-form.input name="name" />
        <x-form.input name="lastname" />
        <x-form.input name="email" />
        {{--
        <x-form.input name="thumbnail" type="file" /> --}}
        {{--
        <x-form.textarea name="excerpt" />
        <x-form.textarea name="body" /> --}}

        <select id="genre" onchange="setValue(this.value)">
            <option value="Metal">Metal</option>
            <option value="Rock">Rock</option>
          </select>
          <select id="subgenre">
            <option value="Metal" data-option="Metal">Thrash Metal</option>
            <option value="Metal" data-option="Metal">Death Metal</option>
            <option value="Metal" data-option="Metal">Black Metal</option>
            <option value="Rock" data-option="Rock">Classic Rock</option>
            <option value="Rock" data-option="Rock">Hard Rock</option>
          </select>

        <x-form.field>
            <div class="flex">
                <div>
                    <x-form.label name="akadémia" />
                    <!-- parent -->
                    <select name="academy_id" class="combo-a" data-nextcombo=".combo-b">
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
                    <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled>
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

           

                <x-form.field>
                    <div class="flex">
                        <div>
                            <x-form.label name="dni výučby" />
                            <select name="days" id="days">
                                <option value="" disabled selected hidden>Dni výučby</option>
                                <option value="1" {{old('days') == 1 ? 'selected' : ''}}>Týždeň</option>
                                <option value="2" {{old('days') == 2 ? 'selected' : ''}}>Víkend</option>
                                <option value="3" {{old('days') == 3 ? 'selected' : ''}}>Nezáleží</option>
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
                                <option value="1" {{old('time') == 1 ? 'selected' : ''}}>Ranný</option>
                                <option value="2" {{old('time') == 3 ? 'selected' : ''}}>Poobedný</option>
                                <option value="3" {{old('time') == 3 ? 'selected' : ''}}>Nezáleží</option>
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
        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
</x-setting>

<script>
 var oldInput = {!! json_encode(old()) !!};

</script>
