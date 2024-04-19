@props(['name', 'title'])

<div class="flex items-center space-x-4">
    <!-- Image Placeholder or Icon -->
    <div class="flex items-center space-x-4">
        <div class="flex-shrink-0">
            <div class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center">
                <img class=" text-white" src="{{ asset('storage/photos/basic.jpg') }}" alt="fotka">
            </div>
        </div>

        <!-- Text Description -->
        <div class="flex-grow">
            <h5 class="text-lg font-semibold text-gray-900">{{$name}}</h5>
            <p class="text-sm text-gray-500">{{$title}}</p>
        </div>
    </div>
</div>