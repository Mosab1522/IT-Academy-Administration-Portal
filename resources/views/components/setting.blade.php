@props(['heading', 'ctitle','etitle',])

<div class="flex h-screen bg-gray-100">

    <!-- Navigation Sidebar -->
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
                    class="{{ request()->is('admin/dashboard') ? 'bg-blue-500' : 'hover:bg-gray-700' }} flex items-center p-2 rounded">
                    <span class="ml-3 text-sm">Prehľad</span>
                </a>

                <!-- More navigation links here... -->

                <!-- Management Dropdown -->
                <div
                    x-data="{ open: {{ request()->routeIs('admin.academies.*', 'admin.coursetypes.*', 'admin.students.*', 'admin.applications.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="flex items-center justify-between p-2 w-full text-left {{ request()->routeIs('admin.academies.*', 'admin.coursetypes.*', 'admin.students.*', 'admin.applications.*') ? 'bg-blue-500' : 'hover:bg-gray-700' }} rounded">
                        <span class="flex items-center">
                            <span class="ml-3 text-sm">Spravovanie</span>
                        </span>
                    </button>
                    <div x-show="open" class="ml-6 space-y-2 mt-2" x-cloak>
                        <!-- Sub-menu items -->
                        <a href="/admin/academies"
                            class="{{ request()->is('admin/academies') ? 'text-blue-300' : 'hover:text-gray-300' }} text-sm ml-3">-
                            Akadémie</a>
                        <!-- Add other sub-menu items here -->
                    </div>
                </div>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <section class="flex-1 overflow-auto">
        <header class="bg-gray-800 text-white shadow py-6 px-4">
            <h1 class="text-xl font-semibold">{{ $heading }}</h1>
        </header>

        
            <section class="flex-1 overflow-auto">

                <main class="p-12">
                    <div class="flex flex-col">
                        <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Vytvorenie {{$ctitle}}</h3>
                            {{ $create }}
                        </div>
                        <!-- The rest of your content -->
                    </div>
                    <!-- Instructor's Notifications -->
                    {{-- @foreach (App\Models\Instructor::all() as $instructor)
                    <div class="bg-white p-4 rounded-lg shadow mb-6">
                        <h3 class="text-lg font-semibold mb-4">{{ $instructor->name }}'s Unread Notifications</h3>
                        <ul>
                            @forelse($instructor->unreadNotifications as $notification)
                            <li class="p-2 border-b border-gray-200">{{ $notification->data['coursetype_id'] }}</li>
                            @empty
                            <li class="p-2 text-gray-500">No notifications</li>
                            @endforelse
                        </ul>
                    </div>
                    @endforeach --}}
                    <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Existujúce {{ $etitle }}</h3>
                        <div class="flex flex-col">
                            {{ $slot }}
                        </div>
                    </div>
                  
                        
                    
                </main>
            </section>

</div>