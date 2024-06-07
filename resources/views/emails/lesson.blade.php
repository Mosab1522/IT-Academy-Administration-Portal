<x-email-layout>
    <h1>Nadchádzajúca hodina triedy - {{ $data['classname'] }}</h1>
    <p>Vážený/á {{ $data['name'] }} {{ $data['lastname'] }},</p>
    <p>dňa {{ $data['date'] }} sa uskutoční hodina vašej triedy {{ $data['classname'] }} vrámci kurzu
        {{ $data['coursename'] }}.</p>

    <h2>Detaily hodiny:</h2>
    <ul>
        <li>Názov hodiny: {{ $data['title'] }}</li>
        <li>Dátum začiatku: {{ $data['date'] }}</li>
        <li>Dĺžka hodiny: {{ $data['time'] }} minút</li>
        @if ($data['lessonType'])
            <li>Forma hodiny: {{ $data['lessonType'] == '1' ? 'prezenčne' : '' }}
                {{ $data['lessonType'] == '2' ? 'online' : '' }} </li>
        @endif

        @if ($data['lessonType'] == '1')
            @if ($data['where'])
                <li>Link na hodinu: {{ $data['where'] }}</li>
            @endif
        @elseif($data['lessonType'] == '2')
            @if ($data['where'])
                <li>Miestnosť: {{ $data['where'] }}</li>
            @endif
        @endif
        <li>Lektor: {{ $data['instructor_name'] }} {{ $data['instructor_lastname'] }}</li>
    </ul>

    <h2>V prípade nemožnej účasti informujte lektora.</h2>

    <x-slot:footer>

    </x-slot:footer>
</x-email-layout>
