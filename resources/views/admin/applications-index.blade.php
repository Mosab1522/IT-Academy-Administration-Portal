<x-layout />
<x-setting heading="Prihlášky">
    <div class="flex flex-col">
        <form action="{{ route('admin.applications.index') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="sort_by">Zoradiť podľa:</label>
                <select name="sort_by" id="sort_by" class="form-control">
                    <option value="latest" {{ request()->get('sort_by') == 'latest' ? 'selected' : '' }}>Najnovšie
                    </option>
                    <option value="oldest" {{ request()->get('sort_by') == 'oldest' ? 'selected' : '' }}>Najstaršie
                    </option>
                    <option value="most_applicants" {{ request('sort_by') == 'most_applicants' ? 'selected' : '' }}>Most applicants</option>
                    <option value="less_applicants" {{ request('sort_by') == 'less_applicants' ? 'selected' : '' }}>Less applicants</option>
                </select>
            </div>
            <x-form.button type="submit">Zmeniť zoradenie</x-form.button>
        </form>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full
            sm:px-6 lg:px-8">

                @foreach ($types as $id => $name)
                @php
                $format = 'Y-m-d H:i:s';
                $input = $lastApplications[$id];
                // $date = strtotime($input);
                $result = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $input)->diffForHumans();
                @endphp
                <div class="text-sm w-full flex mt-2 mb-2">
                    <p class="flex-none w-48">Kurz: {{ $name }}</p>
                    <p class="flex-1">Posledná prihláška vytvorená: {{$result}}</p>
                    @foreach ($applications[$name] as $academy => $apps) <p class="flex-none">Akadémia: {{$academy}}</p>
                </div>
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">


                    <table class="min-w-full divide-y divide-gray-200" style="table-layout: fixed;">
    <colgroup>
        <col style=" width: 30%;">
        <col style="width: 45%;">
        <col style="width: 12.5%;">
        <col style="width: 12.5%;">
    </colgroup>
    @foreach ($apps as $application)
    <tbody class="bg-white divide-y divide-gray-200" style="height: 3rem;">
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                        <a href="/admin/academies/{{ $application->id }}">
                            {{$application->student->name }}
                            {{$application->student->lastname}}
                        </a>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                        {{$application->student->email}}
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="/admin/academies/{{ $application->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium ">
                <form method="POST" action="/admin/academies/{{ $application->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-xs text-gray-400" style="vertical-align: middle;">Delete</button>
                </form>
            </td>
        </tr>
    </tbody>
    @endforeach
</table>

                </div>@endforeach
                @endforeach
            </div>
        </div>
    </div>

</x-setting>