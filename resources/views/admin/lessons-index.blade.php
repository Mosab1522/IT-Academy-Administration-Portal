
<x-layout />
<x-setting heading="Hodiny" etitle="Existujúce hodiny">
    <x-slot:create>
        <div class="flex flex-col">
            <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie hodiny</h3>
                <form action="/admin/lessons/create" method="post">
                    @csrf
                    <x-form.required class="-mt-3"/>
                    {{--
                    <x-form.label name="Zapísať všetkých ktorý majú prihlášku na kurz?" />
                    <input type="checkbox" name="students"> --}}
                    <x-form.field>
                        <x-form.input name="title" type="text" title="Názov hodiny" placeholder="Názov hodiny" required="true"/>
                    </x-form.field>
                
                    <x-form.field>
                        @php
                        if(auth()->user()->can('admin'))
                                {
                        $classes = \App\Models\CourseClass::with(['coursetype'])->get();
                                }else{
                                    $authInstructorId = auth()->user()->user_id;
                                     $classes = \App\Models\CourseClass::with(['coursetype'])->whereHas('instructor', function ($query) use ($authInstructorId) {
                $query->where('id', $authInstructorId);
            })->get();
                                }
                       
                        @endphp
                        <div>

                            {{-- <input name="coursetype_id" value="{{$coursetype->id}}" hidden /> --}}


                            <!-- parent -->
                            <x-form.select name="class_id" title="Triedy" required="true">
                                <option style="color: gray;" value="" disabled selected hidden>Triedy</option>
                                {{-- @php
                                $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                ->get();
                                @endphp --}}
                                {{-- @php
                                $assignedInstructors = $coursetype->instructors->pluck('id')->toArray();
                                @endphp --}}
                                @foreach ($classes as $class)
                                @if($class->ended == false)
                                

                                <option value="{{ $class->id }}" data-id="{{ $class->id }}" data-option="-1"
                                    {{old('instructor_id')==$class->id ? 'selected' :
                                    ''}}> {{
                                    ucwords($class->name)}} - {{
                                    ucwords($class->coursetype->name)}}  {{$class->coursetype->type=='0'? 'študentský' : 'inštruktorský'}} </option>
                                @endif
                                @endforeach
                                {{-- <option value="" disabled selected hidden>Akadémia</option>
                                <option value="1" data-id="1" data-option="-1">Cisco</option>
                                <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                            </x-form.select>
                        </div>
                    </x-form.field>
                    <x-form.field>
                        <div class="flex">
                            <x-form.label name="datetime-local" title="Dátum a trvanie hodiny" required="true"/>

                        </div>
                        <div class="flex">
                            <div class="w-1/2 mr-2">
                            <input type="datetime-local" name="lesson_date" value="{{ old('lesson_date')}}"
                                class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <x-form.error name="lesson_date" errorBag="default"/>
                            </div>
                            <div class="w-1/2 ml-2">
                            <input type="time" name="duration"
                                class="mt-1 flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required
                                step="60" value="{{ old('duration', '00:45') }}">
                                <x-form.error name="duration" errorBag="default"/>
                            </div>
                        </div>

                    </x-form.field>
                    <x-form.input-check name="email" title="Poslať oznámenie o hodine študentom emailom" :checked="old('email')"/>
                    <div id="emailDiv" class="mt-6 {{old('email') ? '' :'hidden'}}" >
                        <x-form.select name="lessonType" title="Forma hodiny">
                            <option value="0" disabled selected hidden>Vyberte formu hodiny</option> 
                            <option {{old('lessonType')=='1' ? 'selected' :''}} value="1">Online</option> 
                            <option {{old('lessonType')=='2' ? 'selected' :''}} value="2">Prezenčne</option>
                        </x-form.select>
                        <div id="onsiteDiv" class="{{old('onsite') ? '' : 'hidden'}} mt-6"><x-form.input name="onsite" type="text" title="Miestnosť" placeholder="Uveďte miestnosť vyučovania" /></div>
                        <div id="onlineDiv" class="{{old('online') ? '' : 'hidden'}} mt-6">
                        <x-form.input name="online" type="text" title="Link" placeholder="Uveďte link na hodinu"/>
                        </div>
                    </div>

                    <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
                        Odoslať
                    </x-form.button>
                </form>
            </div>
        </div>
    </x-slot:create>

    <x-form.search action="{{ route('admin.lessons.index') }}" text="Filtrovať a zoradiť">
            @csrf
            @if(request()->filled('search'))
            <input type="hidden" name="search" value="{{request()->input('search')}}" />
            @endif
            <x-form.search-select name="orderBy" title="Zoradiť podľa">
                <option value="lesson_date" {{request()->input('orderBy')=='lesson_date' ? 'selected' : ''}}>Dátumu
                    hodiny</option>
                <option value="created_at" {{request()->input('orderBy')=='created_at' ? 'selected' : ''}}>Dátumu
                    vytvorenia</option>
                <option value="updated_at" {{request()->input('orderBy')=='updated_at' ? 'selected' : ''}}>Dátumu
                    poslednej úpravy</option>
            </x-form.search-select>
            <x-form.search-select name="orderDirection" title="Smer zoradenia">
                <option value="asc" {{request()->input('orderDirection')=='asc' ? 'selected' : ''}}>Vzostupne
                </option>
                <option value="desc" {{request()->input('orderDirection')=='asc' ? '' : 'selected'}}>Zostupne
                </option>
                </option>
            </x-form.search-select>

            <x-form.search-select name="class_id" title="Trieda">
              

                <option value="" data-option="-1">Všetky</option>

                @foreach ($classes as $class)
                <option value="{{ $class->id }}" data-id="{{ $class->id }}" data-option="-1" {{request()->
                    input('class_id')==$class->id ? 'selected' : ''}}>{{
                    ucwords($class->name) }}</option>
                @endforeach
            </x-form.search-select>



            <x-slot:search>
            @csrf
            @if(request()->filled('orderBy'))
            <input type="hidden" name="orderBy" value="{{request()->input('orderBy')}}" />
            <input type="hidden" name="orderDirection" value="{{request()->input('orderDirection')}}" />
            @endif
            @if(request()->filled('class_id'))
            <input type="hidden" name="class_id" value="{{request()->input('class_id')}}" />

            @endif
        </x-slot:search>
    </x-form.search>




    <div class="flex-auto mt-6">

        <!-- Iterate over classes -->
        @foreach ($lessons->groupBy('class.name') as $className => $lessonsInClass)
        @php
        // Assuming you can access the first lesson to get the class ID
        $firstLesson = $lessonsInClass->first();
        $classId = $firstLesson->class->id;
        @endphp
        <div class=" mb-6">
           
                <h3 class="-mb-4 leading-6  text-gray-700">Hodiny triedy - 
                    <a href="/admin/lessons/{{ $classId }}" class="hover:underline underline-offset-2 hover:text-gray-900">
                        {{ $className }}
                    </a>
                </h3>


                <x-single-table>
                    <x-slot:head>
                                <th scope="col" class="py-3 px-6">
                                    Názov hodiny
                                </th>
                                @admin
                                <th scope="col" class="py-3 px-6">
                                    Inštruktor
                                </th>
                                @endadmin
                                <th scope="col" class="py-3 px-6">
                                    Dátum a trvanie
                                </th>
                                <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">
                                    Akcie
                                </th>
                            </x-slot:head>
                            <!-- Iterate over lessons in this class -->
                            @foreach ($lessonsInClass as $lesson)
                            <tr class="bg-white border-b dark:bg-white dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-50">
                                <td class="py-4 px-6">
                                    <x-table.td url="lessons/{{ $lesson->id }}">
                                    {{ $lesson->title }}
                                    </x-table.td>
                                </td>
                                @admin
                                <td class="py-4 px-6">
                                    <x-table.td url="instructors/{{ $lesson->instructor->id }}">
                                    {{ $lesson->instructor->name }} {{ $lesson->instructor->lastname }}
                                    </x-table.td>
                                </td>
                                @endadmin
                                <td class="py-4 px-6">
                                    {{ $lesson->lesson_date }} - {{ $lesson->duration }} minút
                                </td>
                                <x-table.td-last url="lessons/{{ $lesson->id }}" edit=1 itemName="hodinu {{$lesson->title}}? Spolu s tým sa vymažú záznamy o absolvovaní tejto hodiny." />
                               
                            </tr>
                            @endforeach
                        </x-single-table>
        </div>
            @endforeach

        </div>


</x-setting>

<script>
    document.getElementById('email').addEventListener('change', function() {
    var emailDiv = document.getElementById('emailDiv');
    if (this.checked) {
        emailDiv.style.display = 'block';
       // document.getElementById('sendername').disabled=false;
    } else {
        emailDiv.style.display = 'none';
       // document.getElementById('sendername').disabled=true;
    }
});

document.getElementById('lessonType').addEventListener('change', function() {
    // Hide all sections initially
    document.getElementById('onsiteDiv').style.display = 'none';
    document.getElementById('onlineDiv').style.display = 'none';
   

    // Show the relevant section based on the selected value
    switch (this.value) {
        case '1': // Študent / Študenti
            document.getElementById('onlineDiv').style.display = 'block';
            break;
        case '2': // Inštruktor / Inštruktori
            document.getElementById('onsiteDiv').style.display = 'block';
            break;
        
          
    }
});
</script>