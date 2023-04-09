<x-layout />
<x-setting heading="Prihlášky">
    <div class="flex flex-col">
        <form method="get" action="{{ route('admin.applications.index') }}">
            @csrf
            <div class="flex">
                <div class="">
                    <x-form.label name="Zoradiť podľa" />
                    <select class="form-control" id="orderBy" name="orderBy">
                        <option value="created_at" {{request()->input('orderBy')=='created_at' ? 'selected' :
                            ''}}>Dátumu vytvorenia</option>
                        <option value="updated_at" {{request()->input('orderBy')=='updated_at' ? 'selected' :
                            ''}}>Dátumu poslednej úpravy</option>
                    </select>
                </div>
                <div class="px-6">
                    <x-form.label name="Smer zoradenia" /> <select class="form-control" id="orderDirection"
                        name="orderDirection">
                        <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Od najstaršej
                        </option>
                        <option value="desc" {{request()->input('orderDirection')=='desc' ? 'selected' : ''}}>Od najnovšej
                        </option>
                    </select>
                </div>
                {{-- <div class="form-group">

                    <select class="form-control" id="filterBy" name="filterBy[]" multiple>
                        <option value="academy_id|1">Akadémia 1</option>
                        <option value="academy_id|2">Akadémia 2</option>
                        <option value="coursetype_id|1">Typ kurzu 1</option>
                        <option value="coursetype_id|2">Typ kurzu 2</option>
                    </select>
                </div> --}}

                <div>

                    <x-form.label name="Filtrovať podľa" />

                    <div class="flex">
                        <div>
                            <select name="academy_id" class="combo-a" data-nextcombo=".combo-b">
                                <option value="" disabled selected hidden>Akadémia</option>
                                @php
                                $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                ->get();
                                $coursetype = \App\Models\CourseType::with(['academy','applications'])->get();
                                @endphp
                                 
                                 <option value="" data-option="-1">Všetky</option>
                                 
                                @foreach ($academy as $academ)
                                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1"
                                    {{request()->input('academy_id')==$academ->id ? 'selected' : ''}}>{{
                                    ucwords($academ->name) }}</option>
                                @endforeach
                            </select>

                            <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled>
                                <option value="" disabled selected hidden>Typ kurzu</option>
                               
                                @foreach ($academy as $academ)
                                <option value="" data-option="{{$academ->id}}"  {{request()->input('coursetype_id')==null ? 'selected' : ''}}>Všetky</option>
                                @endforeach
                                @foreach ($coursetype as $type)
                                <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                    data-option="{{ $type->academy_id }}"  {{request()->input('coursetype_id')==$type->id ? 'selected' : ''}}>{{ ucwords($type->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <x-form.button type="submit">Filtrovať a zoradiť</x-form.button>
        </form>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full
            sm:px-6 lg:px-8">

                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200" style="td:first-child {
                        width: 50%;
                      }">

                        <thead class="text-sm">
                            <tr>
                                <td class="px-6 py-1 whitespace-nowrap">Meno a priezvisko</td>
                                <td class="px-6 py-2">Email</td>
                                <td class="px-6 py-2">Akadémia</td>
                                <td class="px-6 py-2">Kurz</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>@foreach ($applications as $application)
                        <tbody class="bg-white divide-y divide-gray-200" style="height: 3rem;">

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="/admin/academies/{{ $application->id }}">
                                                {{ $application->student->name }}
                                                {{ $application->student->lastname }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $application->student->email }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $application->academy->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $application->coursetype->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/admin/academies/{{ $application->id }}/edit"
                                        class="text-blue-500 hover:text-blue-600">Edit</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium ">
                                    <form method="POST" action="/admin/academies/{{ $application->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-xs text-gray-400"
                                            style="vertical-align: middle;">Delete</button>
                                    </form>
                                </td>
                            </tr>

                        </tbody> @endforeach

                        {{-- <tr>
                            <td>{{ $application->id }}</td>
                            <td>{{ $application->student->name }} {{ $application->student->lastname }}</td>
                            <td>{{ $application->student->email }}</td>
                            <td>{{ $application->academy->name }}</td>
                            <td>{{ $application->coursetype->name }}</td>
                            <td>{{ $application->created_at->diffForHumans() }}</td>
                            <td>{{ $application->updated_at->diffForHumans() }}</td>
                        </tr> --}}


                    </table>
                </div>
            </div>
        </div>
    </div>
</x-setting>