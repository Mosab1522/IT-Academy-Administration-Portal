
<x-layout />
@php
$text= "Váš kalendár";
$basequeryParams='instructor_id='.auth()->user()->user_id;
if(auth()->user()->can('admin'))
{
    $text= "Kalendár akadémie";
    $basequeryParams="";
}
@endphp
<x-setting heading="Kalendár" etitle="{{$text}}">
   
    {{-- <div class="flex flex-col">
        <div class="flex">

            <form class="flex-1" action="{{ route('admin.dashboard.index') }}" method="GET"> --}}
                <x-slot:create>
                    <x-form.search action="/lessons/all" text="Filtrovať" id="filterForm">
                      
                        <x-form.search-select name="academy_id" title="Akadémia" class=" combo-a4" data-nextcombo=".combo-b4">
                                
                            <!-- parent -->
                            {{-- <select name="academy_id" class="combo-a" data-nextcombo=".combo-b"> --}}
                                @php
                                if(auth()->user()->can('admin'))
                                {
                                $academy = \App\Models\Academy::all();
                                $coursetypes = \App\Models\CourseType::all();
                                }else{
                                    $authInstructorId = auth()->user()->user_id;
                                $academy = \App\Models\Academy::whereHas('coursetypes.instructors', function ($query) use ($authInstructorId) {
        $query->where('instructors.id', $authInstructorId);
    })->with([
        'coursetypes' => function ($query) use ($authInstructorId) {
            $query->whereHas('instructors', function ($q) use ($authInstructorId) {
                $q->where('instructors.id', $authInstructorId);
            });
        }
    ])->get();
                                $coursetypes = \App\Models\CourseType::whereHas('instructors', function ($query) use ($authInstructorId) {
        $query->where('instructors.id', $authInstructorId);
    })->get();
                                }
                                
                                @endphp
                                
                                <option value="" data-option="-1" selected>Všetky</option>
                                {{-- @php
                                $academy = \App\Models\Academy::with(['coursetypes','applications'])
                                ->get();
                                @endphp --}}
                                @foreach ($academy as $academ)
                                <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{--
                                    {{old('academy_id')==$academ->id ? 'selected' : ''}} --}}
                                    >{{
                                    ucwords($academ->name)}}</option>
                                @endforeach
                                {{-- <option value="" disabled selected hidden>Akadémia</option>
                                <option value="1" data-id="1" data-option="-1">Cisco</option>
                                <option value="2" data-id="2" data-option="-1">Adobe</option> --}}
                            </x-form.search-select>
                        
                            <x-form.search-select name="coursetype_id" title="Kurz" class="combo-b4" disabled>
                                <option value=""  data-id="-1">Všetky</option>
                
                                @foreach ($academy as $academ)
                            <option value="" data-option="{{$academ->id}}" {{request()->input('coursetype_id')==null
                                ? 'selected' : ''}}>Všetky</option>
                            @endforeach
                            <!-- child -->
                            {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" data-nextcombo=".combo-c"
                                disabled>
                                <option value="" disabled selected hidden>Typ kurzu</option>
                                <option value="1" data-id="1" data-option="1">Lahky</option>
                                <option value="2" data-id="2" data-option="1">Stredny</option>
                                <option value="3" data-id="3" data-option="2">Photoshop</option>
                                <option value="4" data-id="4" data-option="2">Illustrator</option>
                            </select> --}}
                            {{-- <select name="coursetype_id" id="coursetype_id" class="combo-b" disabled> --}}
                                
                                {{-- @php
                                $academy = \App\Models\CourseType::all();
                                @endphp --}}
                                @foreach ($coursetypes as $type)
                                <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                                    data-option="{{ $type->academy_id }}" {{-- {{old('coursetype_id')==$type->id ?
                                    'selected' : ''}} --}}
                                    >{{
                                    ucwords($type->name) }}</option>
                                @endforeach
                            </x-form.search-select>
                
                    <x-form.search-select name="class_id" title="Trieda">
                        @php
                          if(auth()->user()->can('admin'))
                                {
                        $classes = \App\Models\CourseClass::all();
                                }
                                else {
                                      $classes = \App\Models\CourseClass::whereHas('instructor', function ($query) use ($authInstructorId) {
                $query->where('id', $authInstructorId);
            })->get();
                                }
                      
                        @endphp
                        <option value="">Všetky</option>
                        @foreach ($classes as $class)
                    
                            <option value="{{ $class->id }}" {{ request()->input('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                           
                        @endforeach
                        
                    </x-form.search-select>
                    @if(auth()->user()->can('admin'))
                    <x-form.search-select name="instructor_id" title="Inštruktor">
                        @php
                        $instructors = \App\Models\Instructor::all();
                        @endphp
                        <option value="">Všetci</option>
                        @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ request()->input('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                {{ $instructor->name }}
                            </option>
                        @endforeach
                    </x-form.search-select>
                    @else
                    <input type="hidden" name="instructor_id" value="{{ auth()->user()->user_id }}" required/>
                    @endif
                    </x-form.search>

</x-slot:create>





<div id='calendar'></div>



</x-setting>
<script>

document.addEventListener('DOMContentLoaded', function() {
    const localeButtonText = {
        'en-US': {
            today: 'Today',
            year: 'Year',
            month: 'Month',
            week: 'Week',
            day: 'Day',
            list: 'List'
        },
        'sk': {
            today: 'Dnes',
            year: 'Rok',
            month: 'Mesiac',
            week: 'Týždeň',
            day: 'Deň',
            list: 'Zoznam'
        },
    };

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'sk',
        buttonText: localeButtonText['sk'],
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        slotDuration: '00:30:00',
        slotLabelInterval: '01:00',
        slotMinTime: '07:00:00',
        slotMaxTime: '20:00:00',
        scrollTime: '00:00:00',
        firstDay: 1,
        height: 'auto',  // Adjust height based on the events
        contentHeight: '200',
        slotLabelFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        views: {
        listWeek: { // or any other specific view you want to customize
            noEventsText: "Žiadne hodiny na zobrazenie"
        }
    },
        events: `{{ url('/lessons/all') }}?{{$basequeryParams}}`,
      
        /*events: "{{ url('/lessons/all') }}",*/
        windowResize: function(view) {
            if (window.innerWidth < 576) {
                calendar.changeView('listWeek');
            } else if (window.innerWidth < 768) {
                calendar.changeView('timeGridWeek');
            } else {
                calendar.changeView('dayGridMonth');
            }
        }
    });
    calendar.render();

    
    
    // Set titles for accessibility and internationalization
    const prevButton = calendarEl.querySelector('.fc-prev-button');
    const nextButton = calendarEl.querySelector('.fc-next-button');
    const todayButton = calendarEl.querySelector('.fc-today-button');

    if (prevButton) prevButton.title = 'Predchádzajúci';
    if (nextButton) nextButton.title = 'Ďalší';
    if (todayButton) todayButton.title = 'Dnes';

    // Initial check to set up the correct view on load based on current window size
    if (window.innerWidth < 576) {
        calendar.changeView('listWeek');
    } else if (window.innerWidth < 768) {
        calendar.changeView('timeGridWeek');
    } else {
        calendar.changeView('dayGridMonth');
    }
    
    window.myCalendar = calendar;
});

document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.currentTarget;
    const queryParams = new URLSearchParams(new FormData(form)).toString();
    console.log(queryParams);
    const newEventsUrl = `{{ url('/lessons/all') }}?${queryParams}`;

    // Update the calendar's events source
    window.myCalendar.removeAllEventSources(); // Remove the current event sources
    window.myCalendar.addEventSource(newEventsUrl); // Add the new source with updated filters
    window.myCalendar.refetchEvents(); // Optionally refetch events
});



</script>