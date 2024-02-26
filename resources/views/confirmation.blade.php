<x-layout />
<x-setting heading="Potvrdenie prihlášky">
   <p> {{session('success') ? 'Potvrdenie prihlášky prebehlo úspešne!' : ''}}{{session('already') ? 'Prihláška už bola potvrdená predtým!' : ''}}</p>
    
</x-setting>

