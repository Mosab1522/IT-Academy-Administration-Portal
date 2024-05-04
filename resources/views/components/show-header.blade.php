@props(['name', 'title', 'path', 'src'])

<div class="items-center space-x-4 ">
    <!-- Image and Form Section -->
 
        @if($path ?? null)
        <form id="form" action="/admin/{{$path}}" method="post" enctype="multipart/form-data" class="w-full block relative">
            @csrf
            @method('Patch')
            <div class="h-20 w-20 rounded-lg bg-gray-300 overflow-hidden">
                <img class="shadow-xl rounded-lg w-full h-full object-cover" src="{{$src ?? ''}}" alt="profile_image">
                <label for="photo-upload" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white opacity-0 hover:opacity-100 rounded-lg cursor-pointer">
                    <span class="text-center text-sm">Zmeniť fotku</span>
                </label>
                <input type="file" id="photo-upload" name="photo" class="hidden" onchange="handleFileUpload(event)">
            </div>
            <div class="mt-1 space-y-2">
                <button id="photobutton" type="submit" class="hidden text-xs py-1 px-4 border border-transparent shadow-sm rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-200">
                    Zmeniť
                </button>
                <button id="photobutton-c" type="reset" class="hidden bg-gray-400 text-white text-xs py-1 px-6 rounded-md hover:bg-gray-500 transition-colors duration-200">
                    Zrušiť
                </button>
            </div>
        </form>
        @endif
 </div>  
    <!-- Text Description -->
    <div class="ml-2 sm:ml-4 my-auto">
        <h5 class="text-lg font-semibold text-gray-900 -mt-1">{{$name}}</h5>
        <p class="text-sm text-gray-500">{{$title}}</p>
    </div>


{{-- <form id="form" action="/admin/instructors/{{ $instructor->id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('Patch')
    <!-- Other input fields -->

    <div class="relative inline-flex items-center justify-center">
        <img src="{{ asset('storage/' . $instructor->photo) }}" alt="profile_image" class="shadow-2xl rounded-xl"
            data-default-src="{{ asset('storage/' . $instructor->photo) }}"
            style="width: 150px; height: 150px; object-fit: cover; object-position: 25% 25%;" />

        <label for="photo-upload"
            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white opacity-0 hover:opacity-100"
            style="background-color: rgba(0,0,0,0.5)">Change Photo</label>
        <input type="file" id="photo-upload" name="photo" style="display: none;" onchange="handleFileUpload(event)">
    </div>

    <!-- Other form elements -->

    <div class="flex">
        <button id="photobutton" type="submit"
            class="hidden w-full bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Update</button>
    </div>
    <div class="flex">
        <button id="photobutton-c" type="reset"
            class="hidden w-full flex-none bg-gray-400 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500">Reset</button>
    </div>
</form> --}}