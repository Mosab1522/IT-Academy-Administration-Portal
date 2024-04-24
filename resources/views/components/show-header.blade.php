@props(['name', 'title', 'path', 'src'])

<div class="flex items-center space-x-4">
    <!-- Image Placeholder or Icon -->
    <div class="flex items-center space-x-4">
        @if($path ?? null)
        <form id="form" action="/admin/{{$path ?? ''}}"  method="post" enctype="multipart/form-data" class="m-0">
            @csrf
            @method('Patch')
            <div class="flex-shrink-0">
                <div class="h-20 w-20 rounded-lg bg-gray-300 overflow-hidden relative">
                    <img class="shadow-xl rounded-lg w-full h-full object-cover" data-default-src="{{$src ?? ''}}" src="{{$src ?? ''}}" alt="profile_image">
                    <label for="photo-upload" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white opacity-0 hover:opacity-100 rounded-lg cursor-pointer">
                        <span class="text-center text-sm">Zmeniť fotku</span>
                    </label>
                    <input type="file" id="photo-upload" name="photo" class="hidden" onchange="handleFileUpload(event)">
                </div>
            </div>

            <div class="flex flex-col space-y-2 mt-1">
                <button id="photobutton" type="submit" class="hidden  text-xs justify-center py-1 border border-transparent shadow-sm rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-200">
                    Zmeniť
                </button>
                <button id="photobutton-c" type="reset" class="hidden  flex-none bg-gray-400 text-white text-xs uppercase py-1 px-6 rounded-md hover:bg-gray-500 transition-colors duration-200">
                    Zrušiť
                </button>
            </div>
        </form>
        @endif

        <!-- Text Description -->
        <div class="flex-grow">
            <h5 class="text-lg font-semibold text-gray-900">{{$name}}</h5>
            <p class="text-sm text-gray-500">{{$title}}</p>
        </div>
    </div>
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