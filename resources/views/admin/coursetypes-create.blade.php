<x-flash />
@php
session()->forget('success_c');
@endphp
<x-layout/>
<x-setting heading="Vytvoriť typ kurzu">
    <form action="/admin/coursetypes/create" method="post">
        @csrf
        <x-form.input name="name" />
        
        <x-form.field>
        <x-form.label name="academy" />
         <select name="academy_id" id="academy_id">
              <option value="" disabled selected hidden>Akadémie</option>
                @php
                $academy = \App\Models\Academy::all();
                @endphp
                @foreach (\App\Models\Academy::all() as $academ)
                <option value="{{ $academ->id }}" {{old('academy_id')==$academ->id ? 'selected' : '' }} >{{ ucwords($academ->name) }}</option>
                @endforeach

            </select>
        </x-form.field>
        <x-form.input name="min" type="number" />
        <x-form.input name="max" type="number" />
       
        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
</x-setting>