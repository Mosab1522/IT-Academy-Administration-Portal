<x-layout />
<x-setting heading="{{$application->name}}">
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
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
                            
                                       
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="/admin/application/{{ $application->id }}" title="Ukázať podrobnosti">
                                                {{$application->academy->name }}
                                                {{$application->coursetype->name }}
                                            </a>
                                        </div>
                                       
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="/admin/application/{{ $application->id }}" title="Ukázať podrobnosti">
                                                {{$application->student->name }}
                                                {{$application->student->lastname }}
                                            </a>
                                        </div>
                                       
                                    </div>
                                </td>

                                 <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$application->days}}
                                        </div>
                                    </div>
                                </td> 
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$application->time}}
                                        </div>
                                    </div>
                                </td> 

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-xs font-light text-gray-900">vytvorená
                                            {{ $application->created_at->diffForHumans()}}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/admin/application/{{ $application->id }}/edit"
                                        class="text-blue-500 hover:text-blue-600">Edit</a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form method="POST" action="/admin/posts/{{ $application->id }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-xs text-gray-400">Delete</button>
                                    </form>
                                </td>
                            </tr>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-setting>