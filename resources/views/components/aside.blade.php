<aside class="w-48 flex-shrink-0 bg-gray-800 text-white">
    <div class="flex flex-col bg-gray-800 text-white h-screen p-4">
        <!-- Navigation Header -->
        <div class="flex justify-between items-center mb-6">
            <a href="/" class="text-blue-300 hover:text-blue-400">
                <span class="text-sm">Nová prihláška</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex flex-col space-y-2">
            <a href="/admin/dashboard"
                class="{{ request()->is('admin/dashboard') ? 'bg-indigo-600' : 'hover:bg-gray-700' }} flex items-center py-2 px-4 rounded-md">
                <span class="ml-3 text-sm">Prehľad</span>
            </a>

            <!-- More navigation links here... -->

            <!-- Management Dropdown -->
            <div
                x-data="{ open: {{ request()->routeIs('admin.academies.*', 'admin.coursetypes.*', 'admin.students.*', 'admin.applications.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="flex rounded-md items-center justify-between py-2 px-4 w-full text-left {{ request()->routeIs('admin.academies.*', 'admin.coursetypes.*', 'admin.students.*', 'admin.applications.*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }} rounded">
                    <span class="flex items-center">
                        <span class="ml-3 text-sm">Spravovanie</span>
                    </span>
                </button>
                <div x-show="open" class="ml-6 space-y-2 mt-2" x-cloak>
                    <!-- Sub-menu items -->
                    <a href="/admin/academies"
                        class="{{ request()->is('admin/academies') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                        Akadémie</a>
                    <a href="/admin/coursetypes"
                        class="{{ request()->is('admin/coursetypes') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                        Typy kurzy</a>
                        <a href="/admin/classes"
                        class="{{ request()->is('admin/classes') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                        Triedy</a>
                        <a href="/admin/lessons"
                        class="{{ request()->is('admin/lessons') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                      Hodiny</a>
                      <a href="/admin/students"
                      class="{{ request()->is('admin/students') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                    Študenti</a>
                    <a href="/admin/instructors"
                      class="{{ request()->is('admin/instructors') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                    Inštruktori</a>
                    <!-- Add other sub-menu items here -->
                </div>
            </div>
        </nav>
    </div>
</aside>