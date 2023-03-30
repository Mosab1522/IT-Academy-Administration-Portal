<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<x-setting heading="Vytvoriť akadémiu">
    <form action="/admin/coursetype" method="post">
        @csrf
        <x-form.input name="name" />
        
        <x-form.field>
        <x-form.label name="academy" />
         <select name="academy_id" id="academy_id">
                @php
                $academy = \App\Models\Academy::all();
                @endphp
                @foreach (\App\Models\Academy::all() as $academ)
                <option value="{{ $academ->id }}" >{{ ucwords($academ->name) }}</option>
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