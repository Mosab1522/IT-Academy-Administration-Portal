@php
$sessionKeys = ['success_c', 'success_cc', 'success_u', 'success_uu', 'success_d', 'success_dd', 'success_email','success_end'];
@endphp

@foreach($sessionKeys as $key)
    @if(session()->has($key))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-indigo-500 text-white py-2 px-4 rounded-md shadow-lg text-sm z-50">
        <p>{{ session($key) }}</p>
    </div>
    @endif
@endforeach