@php
    $conditionalAttributes = [];
    if ($attributes->get('disabled')) {
        $conditionalAttributes['disabled'] = 'disabled';
    }
@endphp

@props(['name', 'title', 'errorBag' => 'default', 'required' => false])
<x-form.label name="{{ $name }}" title="{{ $title }}" required="{{ $required }}" />
<select name="{{ $name }}" id="{{ $name }}"
    {{ $attributes->merge(['class' => 'mt-1 flex-1 block  w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-gray-100 disabled:text-gray-500 bg-white text-sm leading-5.6', 'data-nextcombo' => ''])->merge($conditionalAttributes) }}
    @if ($required) required @endif>
    {{ $slot }}
</select>
<x-form.error name="{{ $name }}" errorBag={{ $errorBag }} />
