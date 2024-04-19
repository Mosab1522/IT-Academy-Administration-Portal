@props(['name', 'value', 'for'])
<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <input id="{{$for}}" type="radio" name="{{$name}}" value="{{$value}}" {{ (old($name) == $value) ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
    <label for="{{$for}}" class="ml-2 block text-base text-gray-700">
        {{$slot}}
    </label>
</div>