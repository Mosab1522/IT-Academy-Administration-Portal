@php
$conditionalAttributes = [];
if ($attributes->get('disabled')) {
    $conditionalAttributes['disabled'] = 'disabled';
}
@endphp

@props(['name', 'title', 'placeholder','value'])
    <x-form.label name="{{$name}}" title="{{$title}}"/>
    <input {{ $attributes->merge(['class' => 'mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6'  ])->merge($conditionalAttributes) }} value="{{$value ?? ''}}"  name="{{$name}}" id="{{$name}}" placeholder="{{$placeholder}}"  {{$attributes(['value' => old($name)])}}>
    <x-form.error name="{{$name}}"/>