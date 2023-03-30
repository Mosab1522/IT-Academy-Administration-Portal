<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<x-setting heading="Vytvoriť akadémiu">
    <form action="/admin/academy" method="post">
        @csrf
        <x-form.input name="name" />
       
        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
</x-setting>