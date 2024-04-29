@php
$conditionalAttributes = [];
if ($attributes->get('disabled')) {
    $conditionalAttributes['disabled'] = 'disabled';
}
@endphp

@props([
    'name',
    'title',
    'placeholder',
    'value'=> '' ,// Default empty if not provided
    'errorBag' => 'default', 
    'required' => false
    // Default to the 'default' error bag
])


    <x-form.label name="{{$name}}" title="{{$title}}" required="{{$required}}"/>
    <input {{ $attributes->merge(['class' => 'mt-1 flex-1  block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200  focus:ring-opacity-50 placeholder-gray-500 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6'  ])->merge($conditionalAttributes) }} autocomplete="{{$name}}" name="{{$name}}" id="{{$name}}" @if($required)
    required
@endif @if($name == 'cname')    
@php
$name = 'name';
@endphp
@endif
@if($name == 'cemail')    
@php
$name = 'email';
@endphp
@endif
@if($name == 'csekemail')    
@php
$name = 'sekemail';
@endphp
@endif
value="{{ $errors->$errorBag->any() && !$errors->$errorBag->has($name) ? old($name, $value) : $value }}"   placeholder="{{$placeholder}}"   >
    <x-form.error name="{{$name}}" errorBag={{$errorBag}}/>

  