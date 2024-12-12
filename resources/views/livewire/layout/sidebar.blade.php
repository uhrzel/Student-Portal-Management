<div>
    @vite(['resources/css/sidebar.css'])
    <nav id="sidebar" class="h-screen w-60 p-1 px-4 bg-white border-r border-gray-200 sticky top-0 self-start transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap group-[.close]:w-[60px] group-[.close]:p-1">
        <ul>
            <li class="flex justify-end mb-4">
                <span class="font-semibold p-3 rounded-lg text-gray-900 ">{{ config('app.name') }}</span>
                <button onclick=toggleSidebar() id="toggle-btn" class="ml-auto p-4 rounded-lg hover:bg-gray-100  cursor-pointer transition-transform duration-150 ease">
                    <x-icons.chevron-double-left-icon />
                </button>
            </li>
            <li class="active">
                <a wire:navigate href="{{ route('dashboard') }}"
                    class="rounded-lg p-2 flex items-center gap-4 text-blue-600 hover:bg-gray-100 no-underline {{ request()->routeIs('dashboard') ? 'bg-gray-200' : '' }}">
                    <x-icons.rectangle-group-icon />
                    <span class="text-gray-900">Home</span>
                </a>
            </li>

            @if(auth()->user()->hasRole('dean'))
            <!-- Class Schedules -->
            <li>
                <button onclick=toggleSubMenu(this) class=" dropdown-btn w-full text-left rounded-lg p-2 flex items-center gap-4 text-gray-900 hover:bg-gray-100  cursor-pointer bg-transparent border-0">
                    <x-icons.building-library-icon />
                    <span class="text-gray-700 text-xs">Classes</span>
                    <x-icons.arrow-down-icon />
                </button>
                <ul class="sub-menu bg-gray-50 rounded-md  transition-[grid-template-rows] duration-300 ease-in-out group-[.show]:grid-rows-[1fr] grid-rows-[0fr]">
                    <div class="overflow-hidden">
                        <!-- Buildings -->
                        <li class="active">
                            <a wire:navigate href="{{ route('admin.buildings') }}"
                                class="rounded-lg p-2 flex items-center gap-4 text-blue-600 hover:bg-gray-100 no-underline {{ request()->routeIs('admin.buildings') ? 'bg-gray-200' : '' }}">
                                <x-icons.building-office-icon />
                                <span class="text-gray-900">Buildings</span>
                                <p class="hidden md:block bg-blue-500 text-white px-2 py-1 rounded-md text-xs">{{ $buildingsCount }}</p>
                            </a>
                        </li>


                        <!-- Assets -->
                        <li class="active">
                            <a wire:navigate href="{{ route('admin.departments') }}"
                                class="rounded-lg p-2 flex items-center gap-4 text-blue-600 hover:bg-gray-100 no-underline {{ request()->routeIs('admin.departments') ? 'bg-gray-200' : '' }}">
                                <x-icons.archive-box-icon />
                                <span class="text-gray-900">Departments</span>
                                <p class="hidden md:block bg-blue-500 text-white px-2 py-1 rounded-md text-xs">{{ $departmentsCount }}</p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->hasRole('dean'))
                        <!-- Rooms -->
                        <li class="active">
                            <a wire:navigate href="{{ route('admin.rooms') }}"
                                class="rounded-lg p-2 flex items-center gap-4 text-blue-600 hover:bg-gray-100 no-underline {{ request()->routeIs('admin.rooms') ? 'bg-gray-200' : '' }}">
                                <x-icons.building-library-icon />
                                <span class="text-gray-900">Rooms</span>
                                <p class="hidden md:block bg-blue-500 text-white px-2 py-1 rounded-md text-xs">{{ $roomsCount }}</p>
                            </a>
                        </li>


                        <!-- Subjects -->
                        <li class="active">
                            <a wire:navigate href="{{ route('admin.subjects') }}"
                                class="rounded-lg p-2 flex items-center gap-4 text-blue-600 hover:bg-gray-100 no-underline {{ request()->routeIs('admin.subjects') ? 'bg-gray-200' : '' }}">
                                <x-icons.book-open-icon />
                                <span class="text-gray-900">Subjects</span>
                                <p class="hidden md:block bg-blue-500 text-white px-2 py-1 rounded-md text-xs">{{ $subjectsCount }}</p>
                            </a>
                        </li>


                        <!-- Sections -->
                        <li class="active">
                            <a wire:navigate href="{{ route('admin.sections') }}"
                                class="rounded-lg p-2 flex items-center gap-4 text-blue-600 hover:bg-gray-100 no-underline {{ request()->routeIs('admin.sections') ? 'bg-gray-200' : '' }}">
                                <x-icons.tag-icon />
                                <span class="text-gray-900">Sections</span>
                                <p class="hidden md:block bg-blue-500 text-white px-2 py-1 rounded-md text-xs">{{ $sectionsCount }}</p>
                            </a>
                        </li>
                        @endif
                    </div>
                </ul>
            </li>


            @if(auth()->user()->hasRole('dean'))
            <!-- Evaluations -->
            <li>
                <button onclick=toggleSubMenu(this) class=" dropdown-btn w-full text-left rounded-lg p-2 flex items-center gap-4 text-gray-900 hover:bg-gray-100  cursor-pointer bg-transparent border-0">
                    <x-icons.newspaper-icon />
                    <span class="text-gray-700 text-xs">Evaluations</span>
                    <x-icons.arrow-down-icon />
                </button>
                <ul class="sub-menu bg-gray-50 rounded-md  transition-[grid-template-rows] duration-300 ease-in-out group-[.show]:grid-rows-[1fr] grid-rows-[0fr]">
                    <div class="overflow-hidden">
                        <li>
                            <a wire:navigate href="{{ route('admin.evaluations') }}"
                                class="rounded-lg p-2 flex items-center gap-4 text-gray-900 hover:bg-gray-100 no-underline {{ request()->routeIs('admin.evaluations') ? 'bg-gray-200' : '' }}">
                                <x-icons.tag-icon />
                                <span class="text-gray-900">Evaluations</span>
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('student-responses.index') }}"
                                class="rounded-lg p-2 flex items-center gap-4 text-gray-900 hover:bg-gray-100 no-underline {{ request()->routeIs('student-responses.index') ? 'bg-gray-200' : '' }}">
                                <x-icons.user-group-icon />
                                <span class="text-gray-900">Responses</span>
                            </a>
                        </li>
                        <li class="active">
                            <a wire:navigate href="{{ route('admin.notifications.create') }}"
                                class="rounded-lg p-2 flex items-center gap-4 text-blue-600 hover:bg-gray-100 no-underline {{ request()->routeIs('admin.notifications.create') ? 'bg-gray-200' : '' }}">
                                <x-icons.bell-alert-icon />
                                <span class="text-gray-900">Announcements</span>
                            </a>
                        </li>
                    </div>
                </ul>
            </li>
            @endif

            @if(auth()->user()->hasRole('admin'))
            <!-- Settings -->
            <li>
                <button onclick=toggleSubMenu(this) class=" dropdown-btn w-full text-left rounded-lg p-2 flex items-center gap-4 text-gray-900 hover:bg-gray-100  cursor-pointer bg-transparent border-0">
                    <x-icons.cog-8-tooth-icon />
                    <span class="text-gray-700 text-xs">Settings</span>
                    <x-icons.arrow-down-icon />
                </button>
                <ul class="sub-menu bg-gray-50 rounded-md  transition-[grid-template-rows] duration-300 ease-in-out group-[.show]:grid-rows-[1fr] grid-rows-[0fr]">
                    <div class="overflow-hidden">
                        <li>
                            <a wire:navigate href="{{ route('admin.users') }}"
                                class="rounded-lg p-2 flex items-center gap-4 text-gray-900 hover:bg-gray-100 no-underline {{ request()->routeIs('admin.users') ? 'bg-gray-200' : '' }}">
                                <x-icons.fingerprint-icon />
                                <span class="text-gray-900">Users</span>
                                <p class="hidden md:block bg-blue-500 text-white px-2 py-1 rounded-md text-xs">{{ $usersCount }}</p>
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.roles') }}" class="rounded-lg p-2 flex items-center gap-4 text-gray-900 hover:bg-gray-100  no-underline {{ request()->routeIs('admin.roles') ? 'bg-gray-200' : '' }}">
                                <x-icons.key-icon />
                                <span class="text-gray-900">Roles</span>
                                <p class="hidden md:block bg-blue-500 text-white px-2 py-1 rounded-md text-xs">10</p>
                            </a>
                        </li>
                    </div>
                </ul>
            </li>
            @endif
        </ul>
    </nav>

    <script>
        const toggleButton = document.getElementById('toggle-btn')
        const sidebar = document.getElementById('sidebar')

        function toggleSidebar() {
            sidebar.classList.toggle('close')
            toggleButton.classList.toggle('rotate')

            closeAllSubMenus()
        }

        function toggleSubMenu(button) {

            if (!button.nextElementSibling.classList.contains('show')) {
                closeAllSubMenus()
            }

            button.nextElementSibling.classList.toggle('show')
            button.classList.toggle('rotate')

            if (sidebar.classList.contains('close')) {
                sidebar.classList.toggle('close')
                toggleButton.classList.toggle('rotate')
            }
        }

        function closeAllSubMenus() {
            Array.from(sidebar.getElementsByClassName('show')).forEach(ul => {
                ul.classList.remove('show')
                ul.previousElementSibling.classList.remove('rotate')
            })
        }
    </script>
</div>