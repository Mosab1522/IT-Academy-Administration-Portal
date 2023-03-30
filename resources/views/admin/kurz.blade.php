<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<x-setting heading="Vytvoriť akadémiu">
    <form action="/admin/kurz/create" method="post">
        @csrf
        <x-form.input name="nazov" />
        
        <x-form.field>
        <x-form.label name="akademia" />
         <select name="akademies_id" id="akademia_id">
                @php
                $akademie = \App\Models\Akademie::all();
                @endphp
                @foreach (\App\Models\Akademie::all() as $akademia)
                <option value="{{ $akademia->id }}" >{{ ucwords($akademia->nazov) }}</option>
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