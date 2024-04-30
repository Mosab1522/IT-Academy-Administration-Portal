
<x-layout/>
<x-setting heading="Vytvoriť typ kurzu">
    <form action="/admin/coursetypes/create" method="post">
        @csrf
        <x-form.input name="name" />
        
        <x-form.field>
            <div class="items-center mb-4">
                <x-form.label name="typ kurzu:" />
    
                <input class="mr-0.5" type="radio"  name="type" value="0" {{old('type')=='0'
                    ? 'checked' : '' }}>
                <label for="0">Študentský</label>
    
                <input class="ml-2 mr-0.5" type="radio"  name="type" value="1"
                    {{old('type')=='1' ? 'checked' : '' }}>
                <label for="1">Inštruktorský</label>

                <input class="ml-2 mr-0.5" type="radio"  name="type" value="2"
                    {{old('type')=='2' ? 'checked' : '' }}>
                <label for="2">Obidva</label>
    
            </div>
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