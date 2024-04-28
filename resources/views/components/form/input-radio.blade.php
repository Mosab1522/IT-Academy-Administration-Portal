@props(['name', 'value', 'for','required' => false])

<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <input 
        id="{{ $for }}" 
        type="radio" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        class="w-6 h-6 lg:w-4 lg:h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 disabled:text-gray-500" @if($required)
        required
    
    @endif
        {{ old($name) == $value ? 'checked' : '' }}
        {{ $attributes->get('disabled') ? 'disabled' : '' }}
        {{ $attributes->get('checked') ? 'checked' : '' }}
    >
    <label for="{{ $for }}" class="ml-2 block text-sm leading-5.6 text-gray-700">
        {{ $slot }}
    </label>
</div>