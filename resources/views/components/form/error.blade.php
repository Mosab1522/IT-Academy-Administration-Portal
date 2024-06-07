@props(['name', 'errorBag'])
@error($name, $errorBag)
    <span class="text-red-500 text-xs">{{ $message }}</span>
@enderror
