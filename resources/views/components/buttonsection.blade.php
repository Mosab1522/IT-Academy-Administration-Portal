<div
class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-full md:flex-none lg:w-6/12" 
>
    <div class="relative">
        <ul 
        {{ $attributes->merge(['class' => 'flex justify-center items-center bg-gray-300 rounded-xl py-0.5 px-0.5'  ])}}
        role="tablist"
            nav-pills>
            {{$slot}}
        </ul>
    </div>
</div>