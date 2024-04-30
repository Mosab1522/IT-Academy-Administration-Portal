
<x-layout/>
<x-setting heading="Vytvoriť typ kurzu">
    <form action="/admin/lessons/create" method="post">
        @csrf
        {{-- <x-form.label name="Zapísať všetkých ktorý majú prihlášku na kurz?" />
        <input type="checkbox" name="students"> --}}
        <x-form.input name="title" />
        <x-form.field>

            <div>

                {{-- <input name="coursetype_id" value="{{$coursetype->id}}" hidden /> --}}

                <x-form.label name="Triedy" />
                <!-- parent -->
                <select name="class_id" class="w-full">
                    <option value="" disabled selected hidden>Triedy</option>
                    {{-- @php
                    $academy = \App\Models\Academy::with(['coursetypes','applications'])
                    ->get();
                    @endphp --}}
                    {{-- @php
                    $assignedInstructors = $coursetype->instructors->pluck('id')->toArray();
                    @endphp --}}
                    @foreach (\App\Models\CourseClass::with(['instructor'])->get() as $class)

                   

                    <option value="{{ $class->id }}" data-id="{{ $class->id }}"
                        data-option="-1" {{old('instructor_id')==$class->id ? 'selected' :
                        ''}}>Meno: {{
                        ucwords($class->name)}} {{
                        ucwords($class->coursetype->name)}}</option>
                    
                    @endforeach
                    {{-- <option value="" disabled selected hidden>Akadémia</option>
                    <option value="1" data-id="1" data-option="-1">Cisco</option>
                    <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                </select>
            </div>
    </x-form.field>
        <x-form.field>
            <x-form.label name="Dátum" />
            <input type="datetime-local" name="lesson_date" class="border">
            <input type="time" id="duration" name="duration" step="60" value="00:45">
        </x-form.field>
       
        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
</x-setting>