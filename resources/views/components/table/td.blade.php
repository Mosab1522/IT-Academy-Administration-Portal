@props(['url'])
<span class="inline lg:hidden">{{ $slot }}</span>
<a class=" hidden lg:inline hover:underline underline-offset-2" href="/admin/{{ $url }}">
    {{ $slot }}</a>
