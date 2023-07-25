@props(['heading'])
<div class="flex">

    
        <div class="w-48 pl-6 pt-4 ">

        {{-- <h4 class="mb-4 font-semibold " title="pre študentov, kurzy ,akadémie a inštruktorov.">Dorobiť hlavičku tabuľkám</h4> --}}
        {{-- <h4 class="my-4 font-semibold " title="pre prihlášky, študentov, kurzy ,akadémie a inštruktorov.">Vyhľadávanie</h4>
        <h4 class="my-4 font-semibold " title="pre študentov, kurzy ,akadémie a inštruktorov.">Filtrovanie dokončiť</h4> --}}
        {{-- <h4 class="my-4 font-semibold " title="- musí to vedieť že či existuje už daný študent a keď nie tak vytvoriť nového inak priradiť.">Vytváranie prihlášky</h4><h4 class="my-4 font-semibold " title="Do prehľadu / typu kurzu">Pridať študenta - tlačidlo</h4>
        <h4 class="my-4 font-semibold " title="Študentovi">Pridať prihlášku - tlačidlo</h4> --}}

            <h4 class="my-4 font-semibold " title="-dorobiť views pre jednotlivých študentov, inštruktorov, prihlášku,typ kurzu, akadémie, .">Urobiť zobrazenia show</h4>
        <h4 class="my-4 font-semibold " title=" .">Urobiť pridanie inštruktora kurzu</h4>
        <h4 class="my-4 font-semibold " title=" .">Urobiť pridanie kurzu inštruktorovi</h4>

        {{-- <h4 class="my-4 font-semibold " title="- Niejak vymyslieť že buď vytvoríme meno heslo a pošleme mu alebo že ho musí zmeniť prípadne že by on mohol vytvoriť heslo po emaile.">Vytváranie inštruktorov</h4>
        <h4 class="my-4 font-semibold " title="">Spravovanie inštruktorov</h4> --}}


       
        <h4 class="my-4 font-semibold " title="-asi notifikácia / email adminovi a ten mu to musí potvrdiť.">Reset hesla inštruktorovi</h4>
        <h4 class="my-4 font-semibold " title="">Urobiť edit a delete</h4>
        <h4 class="my-4 font-semibold " title="- vytváranie, spravovanie, trigger,  ">Začať riešiť už normálne kurzy</h4>
        <h4 class="my-4 font-semibold " title="- treba že či tak ako vo videu to rozlíšil že admin alebo úplne iné pohľady. ">Pohľad pre inštruktora</h4>
        <h4 class="relative bottom-0 font-semibold " title="-php basics ten 7 hodinovy na laracaste, - eloquent relations na laracaste, niečo na validáciu">Kuknúť videá</h4>

    </div>
    <section class="py-8 w-full px-14 mx-auto">
        <h1 class="text-lg font-bold mb-8 pb-2 border-b">
            {{$heading}}
        </h1>
        <div class="flex">
            <aside class="w-48 flex-shrink-0">
                <h4 class="font-semibold mb-4"><a href="/" class="{{request()->is('/') ? 'text-blue-500' : ''}}">Nová
                        prihláška</a></h4>
    
                <h4 class="font-semibold mb-4"><a href="/admin/dashboard"
                    class="{{request()->is('admin/dashboard') ? 'text-blue-500' : ''}}">Prehľad</a></h4>
                <ul>
    
                    <li>
                        <a href="/admin/academies"
                            class="{{request()->is('admin/academies')||request()->is('admin/coursetypes')||request()->is('admin/students')||request()->is('admin/applications') ? 'font-bold' : ''}}">Spravovanie</a>
                        <ul class="ml-4 text-sm">
                            <li>
                                <a href="/admin/academies"
                                    class="{{request()->is('admin/academies') ? 'text-blue-500' : ''}}">- Akadémie</a>
                            </li>
                            <li>
                                <a href="/admin/coursetypes"
                                    class="{{request()->is('admin/coursetypes') ? 'text-blue-500' : ''}}">- Typy kurzov</a>
                            </li>
                            <li>
                                <a href="/admin/students"
                                    class="{{request()->is('admin/students') ? 'text-blue-500' : ''}}">- Študenti</a>
                            </li>
                            <li>
                                <a href="/admin/applications"
                                    class="{{request()->is('admin/applications') ? 'text-blue-500' : ''}}">- Prihlášky</a>
                            </li>
                            <li>
                                <a href="/admin/instructors"
                                    class="{{request()->is('admin/instructors') ? 'text-blue-500' : ''}}">- Inštruktori</a>
                            </li>
                        </ul>
                    </li>
                    <ul>
                        <li>
                            <a href="/admin/academies/create"
                                class="{{request()->is('admin/*/create') ? 'font-bold' : ''}}">Vytvorenie</a>
                            <ul class="ml-4 text-sm">
                                <li>
                                    <a href="/admin/academies/create"
                                        class="{{request()->is('admin/academies/create') ? 'text-blue-500' : ''}}">- Nová
                                        akadémia</a>
                                </li>
                                <li>
                                    <a href="/admin/coursetypes/create"
                                        class="{{request()->is('admin/coursetypes/create') ? 'text-blue-500' : ''}}">- Nový
                                        kurz</a>
                                </li>
                                <li>
                                    <a href="/admin/instructors/create"
                                        class="{{request()->is('admin/instructors/create') ? 'text-blue-500' : ''}}">- Nový
                                        inštruktor</a>
                                </li>
                                <li>
                                    <a href="/admin/applications/create"
                                        class="{{request()->is('admin/applications/create') ? 'text-blue-500' : ''}}">- Nová
                                        prihláška</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
    
            </aside>
            <main class="flex-1">
                <x-panel>
                    {{$slot}}
                </x-panel>
            </main>
        </div>
    </section>
</div>