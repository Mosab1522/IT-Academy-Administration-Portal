<x-layout />
<x-setting heading="{{$instructor->name}}">
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">

            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-auto max-w-full px-3">
                        <div
                            class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                            <img src="{{asset('storage/' . $instructor->photo)}}" alt="profile_image" style="
                            width: 150px; 
                            height: 150px; 
                            object-fit: cover;
                            object-position: 25% 25%;"
                                class=" shadow-2xl rounded-xl" />
                        </div>
                    </div>
                    <div class="flex-none w-auto max-w-full px-3 my-auto">
                        <div class="h-full">
                            <h5 class="text-lg font-semibold mb-1 ">{{$instructor->name}} {{$instructor->lastname}}</h5>
                            <p class="mb-0 font-semibold leading-normal dark:opacity-60 text-sm">Inštruktor</p>
                        </div>
                    </div>
                    
                </div>
                <hr class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                <div class="flex-auto p-6">
                    <p class="leading-normal uppercase  dark:opacity-60 text-sm">User Information</p>
                    <div class="flex flex-wrap -mx-3">
                      
                      <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                          <label for="first name" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">First name</label>
                          <input type="text" name="first name" value="{{$instructor->name}}" class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                      </div>
                      <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                          <label for="last name" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Last name</label>
                          <input type="text" name="last name" value="{{$instructor->lastname}}" class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                      </div>
                      <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                          <label for="username" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Username</label>
                          <input type="text" name="username" value="{{$instructor->login->nickname}}" class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                      </div>
                      <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                          <label for="email" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Email address</label>
                          <input type="email" name="email" value="{{$instructor->email}}" class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                      </div>
                      <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                          <label for="username" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Sekemail</label>
                          <input type="text" name="username" value="{{$instructor->sekemail}}" class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                      </div>
                      <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                          <label for="email" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Telephone</label>
                          <input type="email" name="email" value="{{$instructor->telephone}}" class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                      </div>
                    </div>
                    <hr class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                    
                    <p class="leading-normal uppercase  dark:opacity-60 text-sm">Contact Information</p>
                    <div class="flex flex-wrap -mx-3">
                      
                      <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
    
                        <div class="mb-4">
                          <label for="city" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Ulica a číslo</label>
                          <input type="text" name="city" value="{{$instructor->ulicacislo}}" class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                      </div>
                      <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                        <div class="mb-4">
                          <label for="country" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">Mesto/obec</label>
                          <input type="text" name="country" value="{{$instructor->mestoobec}}" class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                      </div>
                      <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                        <div class="mb-4">
                          <label for="postal code" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 /80">PSČ</label>
                          <input type="text" name="postal code" value="{{$instructor->psc}}" class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                      </div>
                    </div>
                  
                  </div>
                </div>
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="text-sm">
                            <tr>
                                <td class="px-6 py-1">Názov typu kurzu</td>
                                <td class="px-6 py-2">Počet prihlášok</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($instructor->coursetypes as $coursetype)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="/admin/coursetypes/{{ $coursetype->id }}"
                                                title="Ukázať podrobnosti">
                                                {{$coursetype->name }}
                                                {{$coursetype->academyname }}
                                            </a>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $coursetype->applications->count()}}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/admin/coursetype/{{ $coursetype->id }}/edit"
                                        class="text-blue-500 hover:text-blue-600">Edit</a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form method="POST" action="/admin/posts/{{ $coursetype->id }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-xs text-gray-400">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-setting>