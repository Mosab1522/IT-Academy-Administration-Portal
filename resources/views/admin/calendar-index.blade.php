<x-flash />
<x-layout />
<x-setting heading="Úvod" etitle="Všetky prihlášky akadémie">
   
    {{-- <div class="flex flex-col">
        <div class="flex">

            <form class="flex-1" action="{{ route('admin.dashboard.index') }}" method="GET"> --}}
                <x-slot:create>
                    <x-form.search action="/lessons/all" text="Filtrovať" id="filterForm">
                      
                        <x-form.search-select name="academy_id" title="Akadémia" class=" combo-a4" data-nextcombo=".combo-b4">
                            @php
                            $academy = \App\Models\Academy::with(['coursetypes','applications'])
                            ->get();
                            $coursetype = \App\Models\CourseType::with(['academy','applications'])->get();
                            @endphp
                                            
                                            <option value="" data-option="-1" selected>Všetky</option>
                            @foreach (\App\Models\Academy::with(['coursetypes','applications'])
                            ->get() as $academ)
                            <option value="{{ $academ->id }}" data-id="{{ $academ->id }}" data-option="-1" {{--
                                {{old('academy_id')==$academ->id ? 'selected' : ''}} --}}
                                >{{
                                ucwords($academ->name)}}</option>
                            @endforeach
                    </x-form.search-select>
                
                    <x-form.search-select name="coursetype_id" title="Kurz" class=" combo-b4" disabled>
                        <option value=""  data-id="-1">Všetky</option>

                        @foreach (\App\Models\Academy::with(['coursetypes','applications']) as $academ)
                    <option value="" data-option="{{$academ->id}}" {{request()->input('coursetype_id')==null
                        ? 'selected' : ''}}>Všetky</option>
                    @endforeach

                    @foreach (\App\Models\CourseType::with(['academy','applications'])->get() as $type)
                    <option value="{{ $type->id }}" data-id="{{ $type->id }}"
                        data-option="{{ $type->academy_id }}" {{-- {{old('coursetype_id')==$type->id ?
                        'selected' : ''}} --}}
                        >{{
                        ucwords($type->name) }}</option>
                    @endforeach
                    </x-form.search-select>
                
                    <x-form.search-select name="class_id" title="Trieda">
                        @php
                        $classes = \App\Models\CourseClass::with('coursetype.academy')->get();
                        @endphp
                        <option value="">Všetky</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ request()->input('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                        
                    </x-form.search-select>
                
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
        events: "{{ url('/lessons/all') }}",
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
    const newEventsUrl = `{{ url('/lessons/all') }}?${queryParams}`;

    // Update the calendar's events source
    window.myCalendar.removeAllEventSources(); // Remove the current event sources
    window.myCalendar.addEventSource(newEventsUrl); // Add the new source with updated filters
    window.myCalendar.refetchEvents(); // Optionally refetch events
});



</script>