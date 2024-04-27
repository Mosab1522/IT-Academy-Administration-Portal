<x-email-layout>
        <h1>Potvrdenie prihlášky na kurz - {{ $data['academyname'] }} Akadémia</h1>
        <p>Vážený/á {{ $data['name'] }} {{ $data['lastname'] }},</p>
        <p>s radosťou Vám oznamujeme, že Vaša registrácia na kurz {{ $data['coursename'] }}, ktorý sa koná v rámci {{ $data['academyname'] }} Akadémie, bola úspešne potvrdená.</p>

        <h2>Detaily kurzu:</h2>
        <ul>
            <li>Dátum začiatku: upresníme pri naplnení počtu študentov [dátum]</li>
            <li>Dĺžka kurzu: [počet] týždňov</li>
            <li>Forma vzdelávania: [online/na mieste]</li>
            <li>Adresa: Nám. J. Herdu 2, 917 01 Trnava</li>
            <li>Lektor: upresníme pri naplnení počtu študentov[meno lektora]</li>
        </ul>

        <h2>Čo ďalej?</h2>
        <p>Pri naplnení počtu študentov Vám bude odoslaný email s bližšími informáciami o dátume začiatku, čase hodín aj forme vzdelávania.</p>

        <h2>Platba školného:</h2>
        <p>Prosíme, nezabudnite na úhradu školného v sume [suma] EUR do: dátum bude upresnený pri naplnení počtu študentov. Platbu môžete realizovať prostredníctvom bankového prevodu na účet č. [číslo účtu] s variabilným symbolom [VS]. Po prijatí platby Vám bude zaslaný doklad o zaplatení.</p>
        <div class="button-container">
        <a href="{{ route('application.verify', $data['verificationToken']) }}" class="button">Potvrdiť prihlášku</a>
        </div>
        <x-slot:footer>
             <p>Tešíme sa na Vašu účasť na kurze.</p>
        </x-slot:footer>
</x-email-layout>
    
           
           

