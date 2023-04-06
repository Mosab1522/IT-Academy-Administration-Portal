@props(['heading'])
<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{$heading}}
    </h1>
    <div class="flex">
         <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4"><a href="/">Links</a></h4>
            <ul>
                <li>
                    <a href="/admin/academy" class="{{request()->is('admin/academy') ? 'text-blue-500' : ''}}">Dashboard</a>
                        <ul class="ml-4 text-sm">
                            <li>
                                <a href="/admin/academy" class="{{request()->is('admin/academy') ? 'text-blue-500' : ''}}">- Akadémie</a>
                            </li>
                            <li>
                                <a href="/admin/students" class="{{request()->is('admin/students') ? 'text-blue-500' : ''}}">- Študenti</a>
                            </li>
                        </ul>
                </li>
                <li>
                    <a href="/admin/academy/create" class="{{request()->is('admin/academy/create') ? 'text-blue-500' : ''}}">New Academy</a>
                </li>
                <li>
                    <a href="/admin/coursetype/create" class="{{request()->is('admin/coursetype/create') ? 'text-blue-500' : ''}}">New Course Type</a>
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