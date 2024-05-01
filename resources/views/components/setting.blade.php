@props(['heading', 'etitle',])
<x-flash />
<div class="flex h-screen bg-gray-100 overflow-hidden">
    <button
        class="menu-toggle bg-gray-800 opacity-80 rounded-md shadow fixed bottom-4 left-4 z-50 lg:hidden sm focus:outline-none focus:ring focus:border-blue-300"
        >
        <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    <div class="content-overlay fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>
    <div
        class="sidebar bg-gray-800 text-white w-2/3 sm:w-1/3 lg:w-48 fixed inset-y-0 left-0 transform -translate-x-full z-30 transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0">
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
                    <div class="bg-white p-8 rounded-lg shadow mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $etitle ?? '' }}</h3>

                        {{ $slot }}
                    </div>
                </div>



            </main>
    </section>

</div>
<div id="deleteConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden justify-center items-center"
    style="display: none;">
    <!-- Modal -->
    <div class="bg-white p-6 rounded-lg shadow  max-w-sm">
        <h2 class="text-lg font-semibold text-gray-900">Potvrdiť vymazanie</h2>
        <p class="text-gray-700">Ste si istý že chcete vymazať <span id="itemToDeleteName"></span></p>
        <div class="flex justify-end space-x-4 mt-4">
            <button id="closeButton"
                class="px-4 py-2 bg-gray-300 text-gray-900 rounded-md hover:bg-gray-400 ">Zrušiť</button>
            <button id="confirmButton" onclick="confirmDeletion()"
                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 disabled:bg-gray-500"  disabled>Vymazať</button>

        </div>
    </div>
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
    overlay.addEventListener('click', closeMenu);

    function closeMenu() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    }

    // Function to adjust sidebar based on screen width
    function adjustMenuVisibility() {
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.add('hidden'); // Or possibly remove 'hidden' based on desired behavior
        } else {
            closeMenu();
        }
    }

    // Initial adjustment
    adjustMenuVisibility();

    // Debounce function to limit the rate at which a function is executed
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    // Adjust sidebar visibility based on screen resize with debounce
    window.addEventListener('resize', debounce(adjustMenuVisibility, 250));
});


// Function to open the modal and start a countdown
function confirmDelete(itemName, url) {
    const modal = document.getElementById('deleteConfirmModal');
    const itemToDeleteName = document.getElementById('itemToDeleteName');
    const confirmButton = document.getElementById('confirmButton');
    const closeButton = document.getElementById('closeButton'); // Assuming a close button is defined in your modal
    const deleteForm = document.getElementById('deleteForm');

    // Update modal content and show it
    itemToDeleteName.textContent = itemName;
    modal.style.display = 'flex';  // Show the modal
    confirmButton.disabled = true; // Disable the confirm button initially
    confirmButton.textContent = `Vymazať (${10}s)`; // Initial button text with countdown start

    // Initialize the countdown
    let timeLeft = 10;  // 10 seconds countdown
    const countdown = setInterval(() => {
        timeLeft--;
        confirmButton.textContent = `Vymazať (${timeLeft}s)`;
        if (timeLeft <= 0) {
            clearInterval(countdown);
            confirmButton.disabled = false;
            confirmButton.textContent = 'Vymazať';
        }
    }, 1000);

    // Function to clear the modal and reset
    function closeModal() {
        clearInterval(countdown);
        modal.style.display = 'none';
    }

    // Close modal when the close button is clicked
    closeButton.addEventListener('click', closeModal, { once: true });

    // Stop the countdown and submit the form
    confirmButton.onclick = function () {
        clearInterval(countdown);
        deleteForm.action = url;  // Set the action URL dynamically
        deleteForm.submit();      // Submit the form
    };

    // Event listener for clicking outside the modal to close
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    }, { once: true });
}


document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('body'); // Adjust if there's a more specific container

    // Delegate mouse events
    container.addEventListener('mouseenter', handleMouseEnter, true);
    container.addEventListener('mouseleave', handleMouseLeave, true);

    // Delegate touch events
    container.addEventListener('touchend', handleTouchEnd, true);

    // Delegate click outside to hide tooltip
    container.addEventListener('click', handleClickOutside, true);

    function handleMouseEnter(e) {
        if (e.target.classList.contains('info')) {
            showTooltip(e.target);
        }
    }

    function handleMouseLeave(e) {
        if (e.target.classList.contains('info')) {
            hideTooltip(e.target);
        }
    }

    function handleTouchEnd(e) {
        if (e.target.classList.contains('info')) {
            toggleTooltip(e.target);
            e.preventDefault(); // Prevent mouse events
            e.stopPropagation(); // Stop the event from bubbling
        }
    }

    function handleClickOutside(e) {
        document.querySelectorAll('.info').forEach(infoIcon => {
            const tooltip = infoIcon.nextElementSibling;
            if (!infoIcon.contains(e.target) && !tooltip.contains(e.target)) {
                hideTooltip(infoIcon);
            }
        });
    }

    function showTooltip(infoIcon) {
        const tooltip = infoIcon.nextElementSibling;
        tooltip.style.display = 'block';
        infoIcon.dataset.isTooltipVisible = 'true';
    }

    function hideTooltip(infoIcon) {
        const tooltip = infoIcon.nextElementSibling;
        tooltip.style.display = 'none';
        infoIcon.dataset.isTooltipVisible = 'false';
    }

    function toggleTooltip(infoIcon) {
        if (infoIcon.dataset.isTooltipVisible === 'true') {
            hideTooltip(infoIcon);
        } else {
            showTooltip(infoIcon);
        }
    }
});


// Attach the actual deletion function



</script>