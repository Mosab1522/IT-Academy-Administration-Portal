<x-email-layout>

    <h1>Správa {{ $data['sender'] }}</h1>

    <div style="margin-bottom: 20px; font-size: 16px;">

        {!! $data['emailText'] !!}
    </div>

</x-email-layout>
