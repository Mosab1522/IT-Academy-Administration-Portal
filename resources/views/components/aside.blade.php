
<aside 
  x-data="{
    activeSection: '{{ request()->is('admin/dashboard') ? 'dashboard' : (request()->is('admin/academies*') || request()->is('admin/coursetypes*') || request()->is('admin/classes*') || request()->is('admin/lessons*') || request()->is('admin/students*') || request()->is('admin/applications*') || request()->is('admin/instructors*') ? 'management' : '') }}',
    activeSectionName: '{{ request()->is('admin/dashboard') ? 'Prehľad' : (request()->is('admin/academies*') || request()->is('admin/coursetypes*') || request()->is('admin/classes*') || request()->is('admin/lessons*') || request()->is('admin/students*') || request()->is('admin/applications*') || request()->is('admin/instructors*') ? 'Spravovanie' : '') }}'
  }" 
  class="w-full flex-shrink-0 bg-gray-800 text-white"
>
    <div class="flex flex-col bg-gray-800 text-white h-screen p-4">
        <nav>
        <div class="flex items-center justify-center -mt-3 p-4 w-full height-breakpoint3">

            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 971.54 483.43"><defs><style>.cls-1{fill:#fff;}</style></defs><path class="cls-1" d="M163.41,197.25V168.08c5.55-1.11,12.68-2.06,20.14-2.85v13c5.86-.95,13-1.59,19.81-2.06V164.28c4.12,0,6.82-.16,10.15-.16,3.64,0,8.08.16,10.93.16v11.89c7,.47,14.11,1.11,20,2.06v-13c6.5.63,13.63,1.58,20.13,2.85v29.17c-9-2.06-29-5.07-51-5.07C192.42,192.18,172.45,195.19,163.41,197.25Zm27,98V206.13a123.94,123.94,0,0,0-27,3.17V314.4c8.09,1,27,4.91,50.1,4.91,23,0,43-4,51-4.91V209.3c-6-1.11-15.06-3.17-27.11-3.17v89.09a149.61,149.61,0,0,1-23.93,2.06A141,141,0,0,1,190.36,295.22Zm92.1-32.82c0-16.17,3.17-39.15,6-52.15a323.56,323.56,0,0,1,50.88-4.12c23.15,0,40.27,3.17,44.23,4.12v22c-4-1.11-21.87-4-40.1-4a213.53,213.53,0,0,0-30.92,1.9,156.05,156.05,0,0,0-3,32.18c0,17,2.06,27.9,3,31.87,5.87,2.06,17,3,30.92,3,18.23,0,36.14-4,40.1-4.92v22a194.29,194.29,0,0,1-44.23,4.91,290.73,290.73,0,0,1-50.88-4.91C285.63,302.35,282.46,279.36,282.46,262.4Zm119.21,55V210.25c8.88-.95,41.06-4.12,66.11-4.12,23.94,0,56,3.17,65,4.12V317.41H505.83V229.27c-5.24,0-17-1-25.05-1v89.09H453.67V228.32c-8.08,0-20,1-25.05,1v88.14Z"/><path class="cls-1" d="M622.66,209.3v5.23h-61V262.4h51.21v5.08H561.62v49.93h-6V209.3Z"/><path class="cls-1" d="M637.56,209.3h31.7c24.1,0,36.3,4.91,36.3,29.64v6.34c0,24.89-12.2,29.81-36.3,29.81H643.58v42.32h-6Zm31.54,60.55c20.77,0,30.28-3.33,30.28-24.57v-6.34c0-21.24-9.51-24.41-30.28-24.41H643.58v55.32Z"/><path class="cls-1" d="M719.35,209.3l41.06,101.45L801.47,209.3h6.66L764.06,317.41h-7.13L712.86,209.3Z"/></svg>

        </div>
        <!-- Navigation Header with Dynamic Main Category Name -->
        <div class="-mt-4 sm:mt-0">
            <div class="flex items-center justify-center -mt-3 p-4 w-full height-breakpoint">
                <span x-text="activeSectionName" class="text-base font-medium"></span>
            </div>
            <div class="grid grid-cols-2  items-center justify-center -mt-3 px-4 pt-4 sm:p-4 w-full">
                <!-- Icons here. Replace `template-icon` with actual icon classes or SVGs -->
                <div class="flex justify-center">
                  <div class="icon-bg p-3 rounded-md">
                    <button @click="activeSection = (activeSection === 'overview' ? null : 'overview'); activeSectionName = 'Prehľad'"
                        :class="{ 'bg-indigo-600 border-indigo-600': activeSection === 'overview' }" class="flex items-center py-2 px-4 rounded-md border hover:bg-gray-700 transition-colors duration-200">
                    <span class="material-icons material-icons-custom">home</span>
                 
                    

                    </button>
                  </div>
                </div>
                <div class="flex justify-center">
                    <div class="icon-bg p-3 rounded-md">
                        <button @click="activeSection = (activeSection === 'management' ? null : 'management'); activeSectionName = 'Spravovanie'"
                        :class="{ 'bg-indigo-600  border-indigo-600': activeSection === 'management' }" class="flex items-center py-2 px-4 rounded-md border hover:bg-gray-700 transition-colors duration-200">
                      <span class="material-icons material-icons-custom">settings</span>
                     
                        </button>
                    </div>
                  </div>
                  <div class="flex justify-center">
                    <div class="icon-bg p-3 rounded-md">
                        <button @click="activeSection = (activeSection === 'management' ? null : 'management'); activeSectionName = 'Spravovanie'"
                        :class="{ 'bg-indigo-600  border-indigo-600': activeSection === 'calendar' }" class="flex items-center py-2 px-4 rounded-md border hover:bg-gray-700 transition-colors duration-200">
                      <span class="material-icons material-icons-custom">calendar_today</span>
                        </button>
                    </div>
                  </div>
                  <div class="flex justify-center">
                    <div class="icon-bg p-3 rounded-md">
                        <button @click="activeSection = (activeSection === 'management' ? null : 'management'); activeSectionName = 'Spravovanie'"
                        :class="{ 'bg-indigo-600  border-indigo-600': activeSection === 'more' }" class="flex items-center py-2 px-4 rounded-md border hover:bg-gray-700 transition-colors duration-200">
                      <span class="material-icons material-icons-custom">calendar_today</span>
                        </button>
                    </div>
                  </div>
                <!-- Repeat for other icons -->
              </div>
            <!-- Main Section Links -->
            {{-- <nav class="flex flex-col space-y-2">
                <button @click="activeSection = (activeSection === 'overview' ? null : 'overview'); activeSectionName = 'Prehľad'"
                        :class="{ 'bg-indigo-600': activeSection === 'overview' }" class="flex items-center py-2 px-4 rounded-md hover:bg-gray-700 transition-colors duration-200">
                    <span class="ml-3 text-sm">Prehľad</span>
                </button>

                <button @click="activeSection = (activeSection === 'management' ? null : 'management'); activeSectionName = 'Spravovanie'"
                        :class="{ 'bg-indigo-600': activeSection === 'management' }" class="flex items-center py-2 px-4 rounded-md hover:bg-gray-700 transition-colors duration-200">
                    <span class="ml-3 text-sm">Spravovanie</span>
                </button>
                <!-- Add more main category links here -->
            </nav> --}}
        </div>

        <!-- Sub-sections displayed based on activeSection -->
        <div class="mt-2 sm:mt-4 height-breakpoint">
            <div x-show="activeSection === 'management'" class="mx-8  lg:mx-2 space-y-0.5 text-base lg:text-sm font-medium" x-transition>
                <a href="/admin/academies"
                class="{{ request()->is('admin/academies', 'admin/academies/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200 ">
                Akadémie</a>
            <a href="/admin/coursetypes"
                class="{{ request()->is('admin/coursetypes', 'admin/coursetypes/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200">
                Typy kurzy</a>
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
            <a href="/admin/instructors"
                class="{{ request()->is('admin/instructors', 'admin/instructors/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} flex items-center sm:py-2 py-1.5 px-3 rounded-md  hover:bg-gray-700 transition-colors duration-200">
                Inštruktori</a>
            </div>
        </div>
        <a href="/" class="text-blue-300 hover:text-blue-400 mb-20 lg:mb-0 fixed bottom-2 left-4">
            <span class="text-sm">Nová prihláška</span>
        </a>
    </div>
</aside>

<aside class="w-48 flex-shrink-0 bg-gray-800 text-white">
    <div class="flex flex-col bg-gray-800 text-white h-screen p-4 justify-between">
        <!-- Navigation Header -->
        <div>
            <div class="flex justify-between items-center p-4 mb-6">

                <span class="text-base">UCM akadémia</span>

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
                    x-data="{ open: {{ request()->is('admin/academies') || request()->is('admin/academies/*') || request()->is('admin/coursetypes') || request()->is('admin/coursetypes/*') || request()->is('admin/classes') || request()->is('admin/classes/*') || request()->is('admin/lessons') || request()->is('admin/lessons/*') || request()->is('admin/students') || request()->is('admin/students/*') || request()->is('admin/applications') || request()->is('admin/applications/*') || request()->is('admin/instructors') || request()->is('admin/instructors/*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="flex rounded-md items-center justify-between py-2 px-4 w-full text-left {{ request()->is('admin/academies') || request()->is('admin/academies/*') || request()->is('admin/coursetypes') || request()->is('admin/coursetypes/*') || request()->is('admin/classes') || request()->is('admin/classes/*') || request()->is('admin/lessons') || request()->is('admin/lessons/*') || request()->is('admin/students') || request()->is('admin/students/*') || request()->is('admin/applications') || request()->is('admin/applications/*') || request()->is('admin/instructors') || request()->is('admin/instructors/*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }} rounded">
                        <span class="flex items-center">
                            <span class="ml-3 text-sm">Spravovanie</span>
                            <svg x-show="!open" class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M7 10l5 5 5-5H7z" />
                            </svg>
                            <svg x-show="open" class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M7 10l5-5 5 5H7z" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="open" class="ml-6 space-y-2 mt-2" x-cloak>
                        <!-- Sub-menu items -->
                        <a href="/admin/academies"
                            class="{{ request()->is('admin/academies', 'admin/academies/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                            Akadémie</a>
                        <a href="/admin/coursetypes"
                            class="{{ request()->is('admin/coursetypes', 'admin/coursetypes/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                            Typy kurzy</a>
                        <a href="/admin/classes"
                            class="{{ request()->is('admin/classes', 'admin/classes/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                            Triedy</a>
                        <a href="/admin/lessons"
                            class="{{ request()->is('admin/lessons', 'admin/lessons/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                            Hodiny</a>
                        <a href="/admin/students"
                            class="{{ request()->is('admin/students', 'admin/students/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                            Študenti</a>
                        <a href="/admin/applications"
                            class="{{ request()->is('admin/applications', 'admin/applications/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                            Prihlášky</a>
                        <a href="/admin/instructors"
                            class="{{ request()->is('admin/instructors', 'admin/instructors/*') ? 'text-indigo-300' : 'hover:text-gray-300' }} text-sm ml-3 block">-
                            Inštruktori</a>
                        <!-- Add other sub-menu items here -->
                    </div>
                </div>
        </div>
       
        </nav>
    </div>
</aside>
