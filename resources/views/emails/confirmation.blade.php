<x-mail::message>
# Potvrdenie prihlášky na kurz - {{ $data['academyname'] }} Akadémia

Vážený/á {{ $data['name'] }} {{ $data['lastname'] }},

s radosťou Vám oznamujeme, že Vaša registrácia na kurz {{ $data['coursename'] }}, ktorý sa koná v rámci {{ $data['academyname'] }}  Akadémie, bola úspešne potvrdená. Tešíme sa, že sa môžeme stať súčasťou Vášho vzdelávacieho procesu a prispieť k rozvoju Vašich profesionálnych zručností.

#Detaily kurzu:

Dátum začiatku: upresníme pri naplnení počtu študentov [dátum]<br>
Dĺžka kurzu: 6 týždňov [počet týždňov/mesiacov]<br>
Forma vzdelávania: upresníme pri naplnení počtu študentov [online/na mieste]<br>
Adresa: online / Nám. J. Herdu 2
917 01 Trnava [adresa miesta konania, ak je to relevantné]<br>
Lektor: upresníme pri naplnení počtu študentov [meno lektora]

#Čo ďalej?
V najbližších dňoch obdržíte ďalšie informácie týkajúce sa prístupu do online systému, rozvrhu lekcií a materiálov potrebných pre kurz. Odporúčame Vám, aby ste si pred začiatkom kurzu pripravili potrebné technické vybavenie a zoznámili sa s platformou, ktorá bude použitá na výučbu.

#Platba školného:
Prosíme, nezabudnite na úhradu školného v sume [suma] EUR do [dátum splatnosti]. Platbu môžete realizovať prostredníctvom bankového prevodu na účet č. [číslo účtu] s variabilným symbolom [VS]. Po prijatí platby Vám bude zaslaný potvrdený doklad o zaplatení.

Ak máte akékoľvek otázky alebo potrebujete ďalšie informácie, neváhajte nás kontaktovať prostredníctvom e-mailu na adrese [emailová adresa] alebo telefonicky na čísle [telefónne číslo].

Tešíme sa na Vašu účasť na kurze a veríme, že to bude pre Vás obdobie plné nových poznatkov a zručností.

@component('mail::button', ['url' => route('application.verify', $data['verificationToken'])])
Potvrdiť prihlášku
@endcomponent

S pozdravom,<br>

Univerzita sv. Cyrila a Metoda v Trnave [inštitúcia]<br>
[telefónne číslo]<br>
[emailová adresa]<br>
http://fpv.ucm.sk/sk/ [webová stránka]
{{-- config('app.name') --}}
</x-mail::message>
