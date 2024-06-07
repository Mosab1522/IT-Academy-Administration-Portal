@props(['name', 'title', 'checked' => false])
<div {{ $attributes->merge(['class' => 'flex items-center mt-6']) }}>
    <input id="{{ $name }}" name="{{ $name }}" type="checkbox"
        class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
        @if ($checked) checked @endif />
    <label for="{{ $name }}" class="ml-2 block text-gray-700 text-sm leading-5.6">{{ $title }}</label>
</div>
