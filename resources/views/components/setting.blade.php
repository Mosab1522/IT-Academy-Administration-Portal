@props(['heading', 'etitle',])

<div class="flex h-screen bg-gray-100 overflow-hidden">
    <button class="menu-toggle bg-gray-800 opacity-80 rounded-md shadow fixed bottom-4 left-4 z-50 lg:hidden sm focus:outline-none focus:ring focus:border-blue-300" onclick="toggleMenu()">
        <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    <div class="content-overlay fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>
    <div class="sidebar bg-gray-800 text-white w-48 fixed inset-y-0 left-0 transform -translate-x-full z-30 transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 lg:block">
        <x-aside />
    </div>
    <section class="main-content flex-1 overflow-auto">
        <header class="bg-gray-800 text-white shadow py-6 px-4">
            <h1 class="text-xl font-semibold">{{ $heading }}</h1>
        </header>
        <div class="middle-content flex-1 overflow-auto">

            <main class="p-4 lg:p-12">
                
                        {{ $create ?? '' }}
                    
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
                <div class="flex flex-col">
                    <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $etitle ?? '' }}</h3>

                        {{ $slot }}
                    </div>
                </div>



            </main>
        </section>

</div>

<script>


// Inside your <script> tag to handle the responsive sidebar
    document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.content-overlay');
    const toggleButton = document.querySelector('.menu-toggle');

    // Function to toggle sidebar visibility
    function toggleMenu() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    // Attach click event to toggle button
    toggleButton.addEventListener('click', toggleMenu);

    // Hide sidebar when overlay is clicked
    overlay.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    // Check to initially hide the sidebar on smaller screens
    if (window.innerWidth < 1024) {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    }

    // Adjust sidebar visibility based on screen resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            // Ensure the sidebar is visible on larger screens
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        } else {
            // Hide sidebar on smaller screens
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    });
});

// Listen to scroll events on middle-content
document.querySelector('.middle-content').addEventListener('scroll', function() {
    this.classList.add('scrolling');
    clearTimeout(window.removeScrollTimeout);
    window.removeScrollTimeout = setTimeout(() => {
        this.classList.remove('scrolling');
    }, 1000);
});



</script>