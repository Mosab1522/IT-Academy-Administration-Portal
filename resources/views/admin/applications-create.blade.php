<x-layout />
@php
session()->forget('student_id');
session()->forget('coursetype_id');
$coursetype = null;
if(request()->coursetype_id)
{
    $coursetype = \App\Models\CourseType::find(request()->coursetype_id);
}
@endphp
<x-setting heading="Prihlásiť sa na kurz">
    <form action="/" method="post">
        @csrf
        @if(request()->student_id)
        @php
        session(['student_id' => request()->student_id]);
        @endphp
        @endif
        @unless(session('student_id'))
        <div class="flex">
            <div class="w-1/3">
                <x-form.input name="name" />
                <x-form.input name="lastname" />
                <x-form.input name="email" />
            </div>
            {{-- <label for="name">Meno:</label>
            <input type="text" name="name" id="name">

            <label for="lastname">Priezvisko:</label>
            <input type="text" name="lastname" id="lastname">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email">--}}

            <div class="ml-8">
                <x-form.field>      
                    <h2 class="mt-6 mb-2 uppercase font-bold text-base">Návrhy</h2>
                    <p  class="block mb-2 uppercase font-bold text-sm cursor-pointer text-gray-700" id="search-results"></p>
                </x-form.field>
            </div>
        </div>
        @else
        @php

        $student = \App\Models\Student::find(session('student_id'));
        @endphp
        <x-form.input name="name" value="{{$student->name}}" disabled />
        <x-form.input name="lastname" value="{{$student->lastname}}" disabled />
        <x-form.input name="email" value="{{$student->email}}" disabled />
        <input name="name" value="{{$student->name}}" hidden />
        <input name="lastname" value="{{$student->lastname}}" hidden />
        <input name="email" value="{{$student->email}}" hidden />
        @endunless
        {{--
        <x-form.input name="thumbnail" type="file" /> --}}
        {{--
        <x-form.textarea name="excerpt" />
        <x-form.textarea name="body" /> --}}

        <x-form.field>
            @if($coursetype)
            <input name="academy_id" value="{{$coursetype->academy->id}}" hidden />
            <input name="coursetype_id" value="{{$coursetype->id}}" hidden />
            @endif
            <div class="flex">
                <div>
                    <x-form.label name="akadémia" />
                    <!-- parent -->
                    <select name="academy_id" class="combo-a" data-nextcombo=".combo-b" {{$coursetype ? 'disabled' : ''}}>
                        <option value="" disabled  selected hidden>Akadémia</option>
                        @php
                        $academy = \App\Models\Academy::with(['coursetypes','applications'])
                        ->get();
                        @endphp
                        @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                        ->get() as $academ)
                        <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                            {{old('academy_id')==$academ->id ? 'selected' : ''}}
                            @if($coursetype)
                            {{
                            $coursetype->academy->id == $academ->id ? 'selected' : ''}}
                            @endif
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
                        <option value="" disabled  selected hidden>Typ kurzu</option>
                        {{-- @php
                        $academy = \App\Models\CourseType::all();
                        @endphp --}}
                        @foreach (\App\Models\CourseType::with(['academy','applications'])->get() as $type)
                        <option value="{{ $type->id }}" data-id="{{ $type->id }}" data-option="{{ $type->academy_id }}"
                            @if($coursetype)
                            {{$coursetype->id == $type->id ? 'selected' : ''}}
                            @endif
                            {{old('coursetype_id')==$type->id ? 'selected' : ''}}>{{
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