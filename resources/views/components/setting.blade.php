@props(['heading', 'etitle', 'pick' => false])
<x-flash />

@php
    $inst = 'instructor_id=' . auth()->user()->user_id;
    if (auth()->user()->can('admin')) {
        $inst = '';
    }
@endphp

<div class="flex h-screen bg-gray-100 overflow-hidden">
    <button
        class="menu-toggle bg-gray-800 opacity-80 rounded-md shadow fixed bottom-4 left-4 z-50 lg:hidden sm focus:outline-none focus:ring focus:border-blue-300">
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
        @php
            $count = 0;
            if (auth()->user()->can('admin')) {
                $instructors = App\Models\Instructor::all();
                foreach ($instructors as $i) {
                    if ($i->notifications->count() > 0) {
                        foreach ($i->notifications as $notification) {
                            if ($notification->data['admin'] == false) {
                                $count++;
                            }
                        }
                    }
                }
            } else {
                $i = App\Models\Instructor::find(auth()->user()->user_id);
                foreach ($i->unreadNotifications as $notification) {
                    $count++;
                }
            }

        @endphp

        <header class="bg-gray-800 text-white shadow py-6 px-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold flex-1">{{ $heading }}</h1>
            <div x-data="{ open: false }" class="relative mr-6">
                <button id="notificationButton" @click="open = !open" class="focus:outline-none">
                    <span class="material-icons text-white text-3xl material-icons-header">notifications</span>
                    @if ($count > 0)
                        <span id="notification-count"
                            class="absolute top-0 right-0 inline-flex items-center justify-center p-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ session('notifications_accessed') ? '0' : $count }}</span>
                    @endif
                </button>
                @if ($count > 0)
                    <div x-show="open" x-cloak @click.away="open = false"
                        class="origin-top-right max-h-80 overflow-y-auto absolute right-0 mt-2 w-64 sm:w-80 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50">
                        <div class="py-2">
                            @if (auth()->user()->can('admin'))
                                @foreach ($instructors as $i)
                                    @forelse($i->notifications as $notification)
                                        @if ($notification->data['admin'] == false)
                                            <a href="#"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                {{ $notification->data['message'] ?? 'You have a notification' }}
                                                {{ $notification->data['minimum'] ? 'Touto prihláškou sa naplnil počet študentov na otvorenie triedy.' : '' }}
                                            </a>
                                        @endif
                                    @empty
                                    @endforelse
                                @endforeach
                            @else
                                @forelse($i->unreadNotifications as $notification)
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ $notification->data['message'] ?? 'You have a notification' }}
                                        {{ $notification->data['minimum'] ? 'Touto prihláškou sa naplnil počet študentov na otvorenie triedy.' : '' }}
                                    </a>
                                @empty
                                @endforelse
                            @endif
                        </div>
                    </div>
            </div>
            @endif
            @if (auth()->user()->can('admin'))
            @else
                <a href="/admin/instructors/{{ auth()->user()->user_id }}" class="focus:outline-none relative ml-4">
                    <span class="material-icons text-white text-3xl material-icons-header">account_circle</span>
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <a href="{{ route('logout') }}" class="focus:outline-none relative ml-4"
                    onclick="event.preventDefault();
                this.closest('form').submit();">
                    <span class="material-icons text-white text-3xl material-icons-header">exit_to_app</span>
                </a>

            </form>
        </header>

        <div class="middle-content flex-1 overflow-auto">

            <main class="p-6 lg:p-12">

                {{ $create ?? '' }}

                <div class="flex flex-col">
                    <div class="bg-white p-4 sm:p-8 rounded-lg shadow mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $etitle ?? '' }}</h3>
                        {{ $slot }}
                    </div>
                </div>

            </main>
    </section>

</div>
<div id="deleteConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden justify-center items-center"
    style="display: none;">
    <div class="bg-white p-6 rounded-lg shadow  max-w-sm relative mx-4 my-8">
        <button type="button" onclick="this.closest('.fixed').style.display='none';"
            class="absolute top-0 right-0 mt-3 mr-3 text-gray-800 hover:text-gray-600">
            <span class="material-icons">close</span>
        </button>
        <h2 class="text-lg font-semibold text-gray-900">Potvrdiť vymazanie</h2>
        <p class="text-gray-700">Ste si istý že chcete vymazať <span id="itemToDeleteName"></span></p>
        <div class="flex justify-end space-x-4 mt-4">
            <button id="closeButton"
                class="flex-none bg-gray-400 text-white text-sm font-medium py-2 px-6 rounded-md hover:bg-gray-500 transition-colors duration-200">Zrušiť</button>
            <button id="confirmButton" onclick="confirmDeletion()"
                class="px-4 py-2 bg-red-600 text-white rounded-md  text-sm font-medium hover:bg-red-700 disabled:bg-gray-500 md:w-auto w-full sm:w-auto"
                disabled>Vymazať</button>
        </div>
    </div>
</div>

<div id="emailModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden justify-center items-center ">

    <div class="bg-white p-6 rounded-md shadow max-w-md mx-4 my-8 relative">
        <button type="button" onclick="this.closest('.fixed').style.display='none';"
            class="absolute top-0 right-0 mt-3 mr-3 text-gray-800 hover:text-gray-600">
            <span class="material-icons">close</span>
        </button>
        <h2 class="text-lg font-semibold text-gray-900 mb-1.5">Odoslať Email</h2>

        <form id="emailForm" method="POST" action="{{ route('admin.dashboard.send') }}">
            @csrf
            @if ($pick)
                <div class="py-2 mb-3">
                    <x-form.select name="who" title="Príjemcovia">
                        <option value="0" disabled selected hidden>Vyberte príjemcov </option>
                        <option value="1">Všetci aktuálny študenti </option>
                        <option value="2">Všetci prihlásený študenti </option>
                    </x-form.select>
                </div>
            @else
                <div class="py-2 pl-4 mb-3 bg-gray-100 rounded-md">
                    <h3 class="text-base font-medium mb-2">Prijímateľia</h3>
                    <span id="recipientText"></span>
                </div>
            @endif
            <div class="flex items-center -mt-4">
                <x-form.input-check name="sender" title="Uviesť odosielateľa?" />
                <div class="relative mt-6 ml-2 flex items-center">
                    <span class="material-icons info text-gray-500 hover:text-gray-700 cursor-pointer">info</span>
                    <div class="absolute hidden w-48 px-4 py-2 text-sm leading-tight text-white bg-gray-800 rounded-lg shadow-lg -left-12 top-6 z-10"
                        style="min-width: 150px;">
                        Ak nezaškrtnete túto možnosť, ako odosielateľ bude uvedená UCM akadémia.
                    </div>
                </div>
            </div>

            <div id="senderName" class="mt-2" style="display: none;">
                <x-form.input type="text" name="sendername" value="{{ old('sendername') }}" title="Odosielateľ"
                    required="true" disabled placeholder="Odosielateľ" />
            </div>
            <input type="hidden" name="recipient" id="emailRecipient" value="">

            <x-form.field>

                <x-form.label name="emailText" title="Text emailu" />
                <textarea
                    class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm resize-none overflow-y-auto"
                    name="emailText" id="emailText" placeholder="Napíšte text emailu..." rows="10" cols="50">{{ old('emailText') }}</textarea>
                <x-form.error name="emailText" errorBag="default" />

            </x-form.field>

            <div class="flex justify-end space-x-4 mt-4">
                <button type="button"
                    class="flex-none bg-gray-400 text-white text-sm font-medium py-2 px-6 rounded-md hover:bg-gray-500 transition-colors duration-200 "
                    onclick="closeEmailModal()">Zrušiť</button>
                <x-form.button class="ml-6 md:w-auto w-full sm:w-auto">
                    Odoslať
                </x-form.button>
            </div>
        </form>
    </div>
</div>
<div id="calendarModal">
    <div class="modal-content shadow-md">
        <button type="button" onclick="closeCalendarModal()"
            class="close-button absolute top-0 right-0 mt-3 mr-3 text-gray-800 hover:text-gray-600"><span
                class="material-icons">close</span></button>
        <h2 class="text-lg font-semibold text-gray-900">Kalendár <span id="textCalendar"></span></h2>

        <div id="calendar" class="overflow-y-auto"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.content-overlay');
        const toggleButton = document.querySelector('.menu-toggle');

        function toggleMenu() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        toggleButton.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', closeMenu);

        function closeMenu() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        function adjustMenuVisibility() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                closeMenu();
            }
        }

        adjustMenuVisibility();

        function debounce(func, wait, immediate) {
            let timeout;
            return function() {
                const context = this,
                    args = arguments;
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
        window.addEventListener('resize', debounce(adjustMenuVisibility, 250));
    });

    function confirmDelete(itemName, url) {
        const modal = document.getElementById('deleteConfirmModal');
        const itemToDeleteName = document.getElementById('itemToDeleteName');
        const confirmButton = document.getElementById('confirmButton');
        const closeButton = document.getElementById('closeButton');
        const deleteForm = document.getElementById('deleteForm');

        itemToDeleteName.textContent = itemName;
        modal.style.display = 'flex';
        confirmButton.disabled = true;
        confirmButton.textContent = `Vymazať (${10}s)`;

        let timeLeft = 10;
        const countdown = setInterval(() => {
            timeLeft--;
            confirmButton.textContent = `Vymazať (${timeLeft}s)`;
            if (timeLeft <= 0) {
                clearInterval(countdown);
                confirmButton.disabled = false;
                confirmButton.textContent = 'Vymazať';
            }
        }, 1000);

        function closeModal() {
            clearInterval(countdown);
            modal.style.display = 'none';
        }

        closeButton.addEventListener('click', closeModal, {
            once: true
        });

        confirmButton.onclick = function() {
            clearInterval(countdown);
            deleteForm.action = url;
            deleteForm.submit();
        };

        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        }, {
            once: true
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('body');
        container.addEventListener('mouseenter', handleMouseEnter, true);
        container.addEventListener('mouseleave', handleMouseLeave, true);

        container.addEventListener('touchend', handleTouchEnd, true);

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
                e.preventDefault();
                e.stopPropagation();
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

    document.getElementById('sender').addEventListener('change', function() {
        var senderNameDiv = document.getElementById('senderName');
        if (this.checked) {
            senderNameDiv.style.display = 'block';
            document.getElementById('sendername').disabled = false;
        } else {
            senderNameDiv.style.display = 'none';
            document.getElementById('sendername').disabled = true;
        }
    });

    function openEmailModal(text, recipientId, type, pick) {

        const recipientValue = `${recipientId}-${type}`;
        document.getElementById('emailRecipient').value = recipientValue;
        if (pick) {
            const recipientSelector = document.getElementById('who');

            function updateOptionTexts(text) {
                recipientSelector.querySelectorAll('option').forEach(option => {
                    option.textContent = option.textContent.split(' - ')[0] + ' ' + text;

                });
            }

            updateOptionTexts(text);
        } else {
            document.getElementById('recipientText').textContent = text;
        }

        document.getElementById('emailModal').style.display = 'flex';
    }

    function closeEmailModal() {
        document.getElementById('emailModal').style.display = 'none';
    }

    document.querySelectorAll('.email-button').forEach(button => {
        button.addEventListener('click', function() {
            const recipientId = this.getAttribute('data-recipient-id');
            const type = this.getAttribute('data-type');
            const text = this.getAttribute('data-text');
            const pick = this.getAttribute('data-pick');
            openEmailModal(text, recipientId, type, pick);
        });
    });

    function showCalendarModal(text, queryParams) {
        const modal = document.getElementById('calendarModal');
        modal.style.display = 'flex';
        document.getElementById('textCalendar').textContent = text;
        setTimeout(() => {
            if (!window.calendarInitialized) {
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
                    height: 'auto',
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
                        listWeek: {
                            noEventsText: "Žiadne hodiny na zobrazenie"
                        }
                    },

                    events: `{{ url('/lessons/all') }}?${queryParams}&{{ $inst }}`,

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
                console.log(queryParams);

                const prevButton = calendarEl.querySelector('.fc-prev-button');
                const nextButton = calendarEl.querySelector('.fc-next-button');
                const todayButton = calendarEl.querySelector('.fc-today-button');

                if (prevButton) prevButton.title = 'Predchádzajúci';
                if (nextButton) nextButton.title = 'Ďalší';
                if (todayButton) todayButton.title = 'Dnes';

                if (window.innerWidth < 576) {
                    calendar.changeView('listWeek');
                } else if (window.innerWidth < 768) {
                    calendar.changeView('timeGridWeek');
                } else {
                    calendar.changeView('dayGridMonth');
                }
                window.myCalendar = calendar;
            }
        }, 10);
    }

    function closeCalendarModal() {
        const modal = document.getElementById('calendarModal');
        modal.style.display = 'none';
    }

    function markNotificationsAccessed() {
        document.querySelector('#notification-count').innerText = "0";
        $.ajax({
            url: "{{ route('notifications.mark-accessed') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(xhr, status, error) {
                console.error("Error marking notifications as accessed:", error);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('notificationButton').addEventListener('click', markNotificationsAccessed);
    });
</script>
