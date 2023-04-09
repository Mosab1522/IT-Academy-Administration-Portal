@props(['heading'])
<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{$heading}}
    </h1>
    <div class="flex">
         <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4"><a href="/" class="{{request()->is('/') ? 'text-blue-500' : ''}}">Links</a></h4>
            <ul>
                <li>
                    <a href="/admin/dashboard" class="{{request()->is('admin/dashboard') ? 'text-blue-500' : ''}}">Dashboard</a>
                        <ul class="ml-4 text-sm">
                            <li>
                                <a href="/admin/academies" class="{{request()->is('admin/academies') ? 'text-blue-500' : ''}}">- Akadémie</a>
                            </li>
                            <li>
                                <a href="/admin/coursetypes" class="{{request()->is('admin/coursetypes') ? 'text-blue-500' : ''}}">- Typy kurzov</a>
                            </li>
                            <li>
                                <a href="/admin/students" class="{{request()->is('admin/students') ? 'text-blue-500' : ''}}">- Študenti</a>
                            </li>
                            <li>
                                <a href="/admin/applications" class="{{request()->is('admin/applications') ? 'text-blue-500' : ''}}">- Prihlášky</a>
                            </li>
                        </ul>
                </li>
                <li>
                    <a href="/admin/academies/create" class="{{request()->is('admin/academies/create') ? 'text-blue-500' : ''}}">New Academy</a>
                </li>
                <li>
                    <a href="/admin/coursetypes/create" class="{{request()->is('admin/coursetypes/create') ? 'text-blue-500' : ''}}">New Course Type</a>
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