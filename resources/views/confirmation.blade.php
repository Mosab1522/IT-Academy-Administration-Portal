<x-layout />
<x-form heading="Potvrdenie prihlášky">
   <p> {{session()->has('success') ? 'Potvrdenie prihlášky prebehlo úspešne!' : ''}}{{session()->has('already') ? 'Prihláška už bola potvrdená predtým!' : ''}}</p>
   </x-form>
@php
session()->forget('success');
session()->forget('already');
@endphp

