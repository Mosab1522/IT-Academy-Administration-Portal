<x-flash />
<x-layout />
<x-setting heading="Vytvoriť študenta">
    <form action="/admin/students/create" method="post" enctype="multipart/form-data">
        @csrf
        <h3 class="block mt-2 mb-3 uppercase font-bold text-sm text-gray-700">Povinný údaj</h3>
        <x-form.input name="email" type="email"/>
        <h3 class="block mt-6 mb-3 uppercase font-bold text-sm text-gray-700">Voliteľné údaje</h3>
        <div class="items-center mt-4">
            <x-form.label name="je:" />

            <input class="mr-0.5" type="radio" id="student" name="status" value="student">
            <label for="student">Študent</label>

            <input class="ml-2 mr-0.5" type="radio" id="nestudent" name="status" value="nestudent">
            <label for="nestudent">Neštudent</label>
            
            <input class="ml-2 mr-0.5" type="radio" id="neviem" name="status" value=NULL>
            <label for="nestudent">Neviem</label>

        </div>

        <div class="flex pb-1">
            <div class="h-20 mt-3" id="ucm" style="display: none;">
                <x-form.label name="univerzita:" />
                <div class=" flex">
                    <div>

                        <input type="radio" id="ucmka" name="skola" value="ucm">
                        <label for="option1">UCM</label><br>
                        <div class="mt-1">
                            <input  type="radio" id="inam" name="skola" value="ina">
                            <label for="option2">Iná</label><br>
                        </div>
                        
                    </div>

                    <div id="ina" style="display: none"><input
                            class=" border border-gray-200 mt-6 ml-2 p-2 w-80 rounded h-7" name="ina" id="nu"
                            required disabled></div>
                </div>
            </div>

            <div class="ml-4 mt-3" id="ucmkari" style="display: none;">

                <x-form.label name="studium:" />
             
                <input type="radio" id="option3" name="studium" value="interne">
                <label for="option1">Interné</label><br>
                   <div class="mt-1">
                <input type="radio" id="option4" name="studium" value="externe">
                <label for="option2">Externé</label><br></div>
            </div>




            <div class=" flex ml-4 mt-3" id="ucmkari2" style="display: none;">
                <x-form.label name="program:" />
                <div>
                    <input type="radio" id="option5" name="program" value="apin">
                    <label for="option1">Aplikovaná informatika</label><br>
                    <div class="mt-1">
                    <input type="radio" id="option6" name="program" value="iny">
                    <label for="option2">Iný</label><br>
                    </div>
                </div> 
            </div>
                <div class="mt-16 -ml-32" id="iny" style="display: none"><input
                        class=" border border-gray-200 ml-2 p-2 w-80 rounded h-7" name="iny" id="ny" required
                        disabled></div>


        </div>

        <x-form.input name="name" />
        <x-form.input name="lastname" />
        {{-- <x-form.input name="email" type="email"/> --}}
        <x-form.input name="sekemail" type="email"/>
        <x-form.input name="ulicacislo" />
        <x-form.input name="mestoobec" />
        <x-form.input name="psc" />


        <x-form.button>
            Odoslať
        </x-form.button>
    </form>
</x-setting>

