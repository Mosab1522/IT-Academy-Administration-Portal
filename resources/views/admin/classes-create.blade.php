@if($classAttributes && $instructors)
<x-layout/>
<x-setting heading="Vytvoriť typ kurzu" etitle="Vyberte inštruktora triede">
  
    <form action="/admin/classes/create" method="post">
        @php
         $coursetype = \App\Models\CourseType::find($classAttributes['coursetype_id']);
    
        @endphp
        @csrf
        @foreach($classAttributes as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <div class="p-6 mb-4 bg-gray-100 rounded-md">
            <h3 class="text-lg font-semibold mb-2">Trieda</h3>
            <p><strong>Názov:</strong> {{ $classAttributes['name'] }}</p>
            <p><strong>Kurz:</strong> {{$coursetype->name}} {{ $classAttributes['type'] == 1 ? '- inštruktorský' : '- študentský' }}</p>
            <p><strong>Dni:</strong> {{ $classAttributes['days']==1 ? 'Týžďeň' : ($classAttributes['days']==2 ? 'Víkend' : 'Nezáleží') }}</p>
            <p><strong>Čas:</strong> {{ $classAttributes['time']==1 ? 'Ranný' : ($classAttributes['time']==2 ? 'Poobedný' : 'Nezáleží') }}</p>
        </div>
      
        <x-form.select name="instructor_id" title="Inštruktor" required="true">
            @foreach($instructors as $instructor)
                <option value="{{ $instructor->id }}">{{ $instructor->name }} {{$instructor->lastname}}</option>
            @endforeach
        </x-form.select>
    
     
       
        <x-form.button class="mt-6 md:w-auto w-full sm:w-auto">
            Odoslať
        </x-form.button>
    </form>

</x-setting>
@else
<script>window.location = "/admin/classes"</script>
@endif