@props(['heading', 'ctitle','etitle',])

<div class="flex h-screen bg-gray-100">

    <!-- Navigation Sidebar -->
    <x-aside/>

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