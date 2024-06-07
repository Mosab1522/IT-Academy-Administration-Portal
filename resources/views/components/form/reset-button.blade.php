<button id ="res" type="reset"
    {{ $attributes->merge(['class' => ' hidden flex-none bg-gray-400 text-white text-sm font-bold py-2 px-6 rounded-lg hover:bg-gray-500 transition-colors duration-200']) }}>{{ $slot }}</button>
