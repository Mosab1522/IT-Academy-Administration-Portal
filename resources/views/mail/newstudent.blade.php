<x-email-layout>
 <h1>Nová registrácia študenta - {{$coursename}} kurz</h1>

<h2>Notifikácia z UCM akadémie:</h2>
<p>Registrácia nového študenta na Váš kurz:</p>
 
<p>Kurz: {{$coursename}} - {{$coursetype == 0 ? 'študentský' : 'inštruktorský'}}</p>
<p>Akadémia: {{$academyname}}</p>

<h3>Nižšie nájdete základné informácie o študentovi:</h3>

<p>Meno: {{$name}} {{$lastname}}</p>
<p>E-mail: {{$email}}</p>

<p>Dátum registrácie: {{$date}}</p>


<x-slot:footer>
             <p>Notifikačný systém UCM akadémie</p>
</x-slot:footer>

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} --}}
</x-mail::message>
