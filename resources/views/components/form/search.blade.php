@props(['action', 'text', 'id'])
<div class="bg-white p-6 rounded-lg shadow mb-4 lg:flex lg:items-end lg:justify-between gap-6">
    <form method="GET" id="{{ $id ?? '' }}" action="{{ $action }}" class="flex flex-col sm:flex-row gap-2">
        {{ $slot }}
        <div class="flex-shrink-0">
            <x-form.button class="md:mt-6 mt-2 sm:mt-6 w-full">{{ $text }}</x-form.button>
        </div>
    </form>
    @if ($search ?? null)
        <form method="GET" action="{{ $action }}" class="flex flex-col  sm:flex-row gap-2 lg:mt-0 mt-2 ">
            {{ $search }}
            <div class="flex-grow">
                <x-form.input name="search" type="text" title="Vyhľadávanie" placeholder="Vyhľadávanie"
                    class="mt-2" />
            </div>
            <div class="flex-shrink-0">
                <x-form.button class="md:mt-7 mt-2 sm:mt-7 w-full">Hľadať</x-form.button>
            </div>
        </form>
    @endif
</div>
