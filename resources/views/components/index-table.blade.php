<div class="my-2 sm:-mx-6 lg:-mx-8">
    <div class="py-6 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-800 dark:text-gray-800">
                    <thead class="text-xs uppercase bg-gray-200">
                        <tr>
                           {{$head}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{{$slot}}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>