<x-mail::message>
# Nová registrácia študenta - {{$coursename}} kurz

Notifikácia z UCM akadémie:<br>
Registrácia nového študenta na Váš kurz:
 
Kurz: {{$coursename}} - {{$coursetype == 0 ? 'študentský' : 'inštruktorský'}} <br>
Akadémia: {{$academyname}}

Nižšie nájdete základné informácie o študentovi:

Meno: {{$name}} {{$lastname}}<br>
E-mail: {{$email}}

Dátum registrácie: {{$date}}

Notifikačný systém UCM akadémie

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} --}}
</x-mail::message>
