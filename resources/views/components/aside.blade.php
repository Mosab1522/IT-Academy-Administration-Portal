<aside x-data="{
    activeSection: '{{ request()->is('admin/dashboard') || request()->is('admin/calendar') || request()->is('admin/email') ? 'overview' : (request()->is('admin/academies*') || request()->is('admin/coursetypes*') || request()->is('admin/classes*') || request()->is('admin/lessons*') || request()->is('admin/students*') || request()->is('admin/applications*') || request()->is('admin/instructors*') ? 'management' : (request()->is('admin/history/certificates', 'admin/history/classes') ? 'history' : '')) }}',
    activeSectionName: '{{ request()->is('admin/dashboard') || request()->is('admin/calendar') || request()->is('admin/email') ? 'Prehľad' : (request()->is('admin/academies*') || request()->is('admin/coursetypes*') || request()->is('admin/classes*') || request()->is('admin/lessons*') || request()->is('admin/students*') || request()->is('admin/applications*') || request()->is('admin/instructors*') ? 'Spravovanie' : (request()->is('admin/history/certificates', 'admin/history/classes') ? 'História' : '')) }}'
}" class="w-full flex-shrink-0 bg-gray-800 text-white">
    <div class="flex flex-col bg-gray-800 text-white h-screen p-4">
        <nav>
            <div class="flex items-center justify-center -mt-3 p-4 w-full height-breakpoint3">

                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 971.54 483.43">
                    <defs>
                        <style>
                            .cls-1 {
                                fill: #fff;
                            }
                        </style>
                    </defs>
                    <path class="cls-1"
                        d="M163.41,197.25V168.08c5.55-1.11,12.68-2.06,20.14-2.85v13c5.86-.95,13-1.59,19.81-2.06V164.28c4.12,0,6.82-.16,10.15-.16,3.64,0,8.08.16,10.93.16v11.89c7,.47,14.11,1.11,20,2.06v-13c6.5.63,13.63,1.58,20.13,2.85v29.17c-9-2.06-29-5.07-51-5.07C192.42,192.18,172.45,195.19,163.41,197.25Zm27,98V206.13a123.94,123.94,0,0,0-27,3.17V314.4c8.09,1,27,4.91,50.1,4.91,23,0,43-4,51-4.91V209.3c-6-1.11-15.06-3.17-27.11-3.17v89.09a149.61,149.61,0,0,1-23.93,2.06A141,141,0,0,1,190.36,295.22Zm92.1-32.82c0-16.17,3.17-39.15,6-52.15a323.56,323.56,0,0,1,50.88-4.12c23.15,0,40.27,3.17,44.23,4.12v22c-4-1.11-21.87-4-40.1-4a213.53,213.53,0,0,0-30.92,1.9,156.05,156.05,0,0,0-3,32.18c0,17,2.06,27.9,3,31.87,5.87,2.06,17,3,30.92,3,18.23,0,36.14-4,40.1-4.92v22a194.29,194.29,0,0,1-44.23,4.91,290.73,290.73,0,0,1-50.88-4.91C285.63,302.35,282.46,279.36,282.46,262.4Zm119.21,55V210.25c8.88-.95,41.06-4.12,66.11-4.12,23.94,0,56,3.17,65,4.12V317.41H505.83V229.27c-5.24,0-17-1-25.05-1v89.09H453.67V228.32c-8.08,0-20,1-25.05,1v88.14Z" />
                    <path class="cls-1" d="M622.66,209.3v5.23h-61V262.4h51.21v5.08H561.62v49.93h-6V209.3Z" />
                    <path class="cls-1"
                        d="M637.56,209.3h31.7c24.1,0,36.3,4.91,36.3,29.64v6.34c0,24.89-12.2,29.81-36.3,29.81H643.58v42.32h-6Zm31.54,60.55c20.77,0,30.28-3.33,30.28-24.57v-6.34c0-21.24-9.51-24.41-30.28-24.41H643.58v55.32Z" />
                    <path class="cls-1"
                        d="M719.35,209.3l41.06,101.45L801.47,209.3h6.66L764.06,317.41h-7.13L712.86,209.3Z" />
                </svg>

            </div>
            <div class="-mt-4 sm:mt-0">
                <div class="flex items-center justify-center -mt-3 p-4 w-full height-breakpoint">
                    <span id="sectionName" class="text-lg lg:text-base font-medium">
                        <span
                            class="{{ request()->is('admin/dashboard') || request()->is('admin/calendar') || request()->is('admin/email') ? '' : 'hidden' }}"
                            id="overviewName">
                            Prehľad
                        </span>
                        <span
                            class="{{ request()->is('admin/academies', 'admin/academies/*') || request()->is('admin/coursetypes', 'admin/coursetypes/*') || request()->is('admin/classes', 'admin/classes/*') || request()->is('admin/lessons', 'admin/lessons/*') || request()->is('admin/students', 'admin/students/*') || request()->is('admin/applications', 'admin/applications/*') || request()->is('admin/instructors', 'admin/instructors/*') ? '' : 'hidden' }}"
                            id="managementName">
                            Spravovanie
                        </span>
                        <span
                            class="{{ request()->is('admin/history/certificates', 'admin/history/classes') ? '' : 'hidden' }}"
                            id="historyName">
                            História
                        </span>

                    </span>
                </div>
                <div class="grid grid-cols-2  items-center justify-center -mt-3 px-4 pt-4 sm:p-4 w-full">

                    <div class="flex justify-center">
                        <div class="icon-bg p-3 rounded-md">
                            <button id="overviewButton"
                                class="toggle-btn flex items-center py-2 px-4 rounded-md border lg:border-0  transition-colors duration-200   {{ request()->is('admin/dashboard') || request()->is('admin/calendar') || request()->is('admin/email') ? 'bg-indigo-600  border-indigo-600' : 'hover:bg-gray-700' }}">
                                <span class="material-icons material-icons-custom">home</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="icon-bg p-3 rounded-md">
                            <button id="managementButton"
                                class="toggle-btn flex items-center py-2 px-4 rounded-md border lg:border-0 transition-colors duration-200 {{ request()->is('admin/academies', 'admin/academies/*') || request()->is('admin/coursetypes', 'admin/coursetypes/*') || request()->is('admin/classes', 'admin/classes/*') || request()->is('admin/lessons', 'admin/lessons/*') || request()->is('admin/students', 'admin/students/*') || request()->is('admin/applications', 'admin/applications/*') || request()->is('admin/instructors', 'admin/instructors/*') ? 'bg-indigo-600  border-indigo-600' : 'hover:bg-gray-700' }}">
                                <span class="material-icons material-icons-custom">settings</span>

                            </button>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="icon-bg p-3 rounded-md">
                            <button id="historyButton"
                                class="toggle-btn flex items-center py-2 px-4 rounded-md border lg:border-0 transition-colors duration-200 {{ request()->is('admin/history/certificates', 'admin/history/classes') ? 'bg-indigo-600  border-indigo-600' : 'hover:bg-gray-700' }}">
                                <span class="material-icons material-icons-custom">history</span>

                            </button>
                        </div>
                    </div>

                </div>

            </div>

            <div class="mt-2 sm:mt-4 height-breakpoint">
                <div id="overviewSection"
                    class="mx-8  lg:mx-2 space-y-0.5 text-base lg:text-sm font-medium {{ request()->is('admin/dashboard') || request()->is('admin/calendar') || request()->is('admin/email') ? '' : 'hidden' }}">

                    <a href="/admin/dashboard"
                        class="{{ request()->is('admin/dashboard') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200 ">
                        Úvod</a>
                    <a href="/admin/calendar"
                        class="{{ request()->is('admin/calendar') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200 ">
                        Kalendár</a>
                    <a href="/admin/email"
                        class="{{ request()->is('admin/email') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200 ">
                        Poslať email</a>
                </div>
                <div id="managementSection"
                    class="mx-8  lg:mx-2 space-y-0.5 text-base lg:text-sm font-medium {{ request()->is('admin/academies', 'admin/academies/*') || request()->is('admin/coursetypes', 'admin/coursetypes/*') || request()->is('admin/classes', 'admin/classes/*') || request()->is('admin/lessons', 'admin/lessons/*') || request()->is('admin/students', 'admin/students/*') || request()->is('admin/applications', 'admin/applications/*') || request()->is('admin/instructors', 'admin/instructors/*') ? '' : 'hidden' }}">
                    @admin
                        <a href="/admin/academies"
                            class="{{ request()->is('admin/academies', 'admin/academies/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200 ">
                            Akadémie</a>
                    @endadmin
                    <a href="/admin/coursetypes"
                        class="{{ request()->is('admin/coursetypes', 'admin/coursetypes/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200">
                        Kurzy</a>
                    <a href="/admin/classes"
                        class="{{ request()->is('admin/classes', 'admin/classes/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200">
                        Triedy</a>
                    <a href="/admin/lessons"
                        class="{{ request()->is('admin/lessons', 'admin/lessons/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200">
                        Hodiny</a>
                    <a href="/admin/students"
                        class="{{ request()->is('admin/students', 'admin/students/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200">
                        Študenti</a>
                    <a href="/admin/applications"
                        class="{{ request()->is('admin/applications', 'admin/applications/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200">
                        Prihlášky</a>
                    @admin
                        <a href="/admin/instructors"
                            class="{{ request()->is('admin/instructors', 'admin/instructors/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200">
                            Inštruktori</a>
                    @endadmin
                </div>
            </div>
            <div id="historySection"
                class="mx-8  lg:mx-2 space-y-0.5 text-base lg:text-sm font-medium {{ request()->is('admin/history/certificates') || request()->is('admin/history/classes') ? '' : 'hidden' }}">

                <a href="/admin/history/certificates"
                    class="{{ request()->is('admin/history/certificates') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200 ">
                    Udelené certifikáty</a>
                <a href="/admin/history/classes"
                    class="{{ request()->is('admin/history/classes') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200 ">
                    Ukončené triedy</a>

            </div>
            <a href="/" class="text-blue-300 hover:text-blue-400 mb-20 lg:mb-0 fixed bottom-2 left-4">
                <span class="text-sm">Nová prihláška</span>
            </a>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var overviewButton = document.getElementById('overviewButton');
        var managementButton = document.getElementById('managementButton');
        var historyButton = document.getElementById('historyButton');
        var overviewSection = document.getElementById('overviewSection');
        var managementSection = document.getElementById('managementSection');
        var historySection = document.getElementById('historySection');
        var overviewName = document.getElementById('overviewName');
        var managementName = document.getElementById('managementName');
        var historyName = document.getElementById('historyName');
        var buttons = document.querySelectorAll('.toggle-btn');

        function hideSection(section) {
            section.classList.remove('visible');
            section.classList.add('hidden');
        }

        function showSection(section) {
            section.classList.remove('hidden');
            setTimeout(() => {
                section.classList.add('visible');
            }, 10);
        }

        function toggleSection(sectionName) {
            hideSection(overviewSection);
            hideSection(managementSection);
            hideSection(historySection);
            hideName();
            if (sectionName === 'overview') {
                showSection(overviewSection);
                overviewName.classList.remove('hidden');
            } else if (sectionName === 'management') {
                showSection(managementSection);
                managementName.classList.remove('hidden');
            } else if (sectionName === 'history') {
                showSection(historySection);
                historyName.classList.remove('hidden');
            }
        }

        function hideName() {
            overviewName.classList.add('hidden');
            managementName.classList.add('hidden');
            historyName.classList.add('hidden');
        }

        function activateButton(button) {
            buttons.forEach(function(btn) {
                btn.classList.remove('bg-indigo-600', 'border-indigo-600');
                btn.classList.add('hover:bg-gray-700');
            });
            button.classList.add('bg-indigo-600', 'border-indigo-600');
            button.classList.remove('hover:bg-gray-700');
        }

        overviewButton.addEventListener('click', function() {
            activateButton(overviewButton);
            toggleSection('overview');
        });

        managementButton.addEventListener('click', function() {
            activateButton(managementButton);
            toggleSection('management');
        });

        historyButton.addEventListener('click', function() {
            activateButton(historyButton);
            toggleSection('history');
        });
    });
</script>
