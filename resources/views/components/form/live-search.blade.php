<div class="flex justify-between">
    <!-- Left side with input fields -->
    <div class="w-1/2 space-y-6">
        <div>
            <input type="hidden" name="student_id" id="student_id">
            <x-form.input name="name" type="text" title="Meno" placeholder="Meno"/>
        </div>
        <div>
            <x-form.input name="lastname" type="text" title="Priezvisko" placeholder="Priezvisko"/>
        </div>
        <div>
            <x-form.input name="email" type="email" title="Email" placeholder="Email"/>
        </div>
    </div>

    <!-- Right side with the table -->
    <div class="ml-8 w-1/2 overflow-x-auto -mt-1">
        <div class="mb-2">
            <h2 class="uppercase font-bold text-sm text-gray-700">Návrhy</h2>
        </div>
        <div class="relative rounded-lg shadow  align-middle ">
            <table class="w-full text-sm text-left text-gray-800 dark:text-gray-800 ">
                <thead class="text-xs uppercase bg-gray-200">
                
                    <tr>
                        <th class="py-3 px-6 text-left">Meno</th>
                        <th class="pr-16 text-left">Priezvisko</th>
                        <th class="pr-20 text-left">Email</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider lg:px-6 lg:py-3">Doplňujúce informácie</th>
                    </tr>
                </thead>
            </table>
            <div class="max-h-40 ">
                <table class="w-full text-sm text-left text-gray-800 dark:text-gray-800 ">
                    <tbody id="search-results" class="bg-white divide-y divide-gray-200">
                        <!-- JavaScript generated rows will go here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>