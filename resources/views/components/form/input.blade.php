@props(['name'])
<x-form.field>
    <x-form.label name="{{$name}}"/>
    <input class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" name="{{$name}}" id="{{$name}}"  {{$attributes(['value' => old($name)])}}>
    <x-form.error name="{{$name}}"/>
</x-form.field>