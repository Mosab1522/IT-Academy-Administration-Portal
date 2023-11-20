<x-flash />
<x-layout/>
<x-setting heading="Vytvoriť akadémiu">
    <form action="/admin/academies/create" method="post">
        @csrf
        <x-form.input name="name" />
       
        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
</x-setting>