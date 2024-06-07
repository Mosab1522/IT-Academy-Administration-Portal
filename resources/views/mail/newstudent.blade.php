<x-email-layout>
    <h1>Nová registrácia študenta - {{ $coursename }} kurz</h1>

    <h2>Notifikácia z UCM akadémie:</h2>
    <p>Registrácia nového študenta na Váš kurz:</p>

    <p>Kurz: {{ $coursename }} - {{ $coursetype == 0 ? 'študentský' : 'inštruktorský' }}</p>
    <p>Akadémia: {{ $academyname }}</p>

    @if ($minimum)
        <h2>Touto registráciou študenta sa naplnil minimálny počet študentov na otvorenie triedy tohto kurzu.</h2>
    @endif
    <h3>Nižšie nájdete základné informácie o študentovi:</h3>

    <p>Meno: {{ $name }} {{ $lastname }}</p>
    <p>E-mail: {{ $email }}</p>

    <p>Dátum registrácie: {{ $date }}</p>


    <x-slot:footer>
        <p>Notifikačný systém UCM akadémie</p>
    </x-slot:footer>

    </x-mail::message>
