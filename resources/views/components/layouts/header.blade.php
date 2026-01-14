@props(['title' => 'Dashboard'])

<header class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 shadow-card fixed top-0 left-0 right-0 z-30 lg:relative w-full">
    <div class="flex items-center justify-between px-3 py-2 sm:px-6 sm:py-4">
        <div class="flex items-center space-x-4">
            <!-- Mobile Menu Toggle (Hamburger) - Only visible on mobile -->
            <button @click="toggleMobileMenu()" class="lg:hidden p-2 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            

            <!-- Page Title -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{!! $title !!}</h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Selamat datang, Admin</p>
            </div>
        </div>

        <div class="flex items-center space-x-1 sm:space-x-4">
            <!-- Dark Mode Toggle -->
            <button @click="toggleDarkMode()"
                class="p-2 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                <i class="text-yellow-500 fas fa-sun" x-show="!darkMode"></i>
                <i class="text-blue-400 fas fa-moon" x-show="darkMode" style="display: none;"></i>
            </button>

            <!-- Search Bar - Hidden on mobile -->
            <div class="relative hidden md:block">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="text-gray-400 fas fa-search"></i>
                </div>
                <input type="text" placeholder="Cari..."
                    class="w-64 py-2 pl-10 pr-4 text-gray-900 placeholder-gray-500 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
            </div>

            <!-- User Profile dengan Avatar -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center p-1 sm:p-2 space-x-2 sm:space-x-3 transition-colors duration-200 rounded-lg focus:outline-none hover:bg-gray-100 dark:hover:bg-gray-700">
                    <!-- Avatar -->
                    @if (Auth::check() && Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" class="w-8 h-8 sm:w-10 sm:h-10 border rounded-full"
                            alt="User Avatar">
                    @else
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-r from-primary-500 to-primary-600">
                            <span class="text-xs sm:text-sm font-semibold text-white">{{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : 'AU' }}</span>
                        </div>
                    @endif

                    <!-- User Info - Hidden on small screens, visible on medium+ -->
                    <div class="hidden text-left md:block">
                        @if (Auth::check() && Auth::user()->name)
                            <p class="text-sm font-medium text-gray-800 dark:text-white"> {{ ucfirst(Auth::user()->name) }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"> {{ ucfirst(Auth::user()->getRoleNames()->first() ?? 'User') }}</p>
                        @else
                            <p class="text-sm font-medium text-gray-800 dark:text-white">Guest User</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Guest</p>
                        @endif
                    </div>

                    <!-- Chevron Icon -->
                    <i class="hidden text-xs text-gray-400 transition-transform duration-200 fas fa-chevron-down md:block"
                        :class="{ 'rotate-180': open }"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-cloak
                    class="absolute right-0 z-50 w-56 py-2 mt-2 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 shadow-soft dark:border-gray-700"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95">
                    <!-- Profile Section -->
                    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center space-x-3">
                            @if (Auth::check() && Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" class="w-10 h-10 border rounded-full"
                                    alt="User Avatar">
                            @else
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-r from-primary-500 to-primary-600">
                                    <span class="text-sm font-semibold text-white">AU</span>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                @if (Auth::check() && Auth::user()->name)
                                    <p class="text-sm font-medium text-gray-800 truncate dark:text-white">
                                        {{ ucfirst(Auth::user()->name) }}</p>
                                    <p class="text-xs text-gray-500 truncate dark:text-gray-400">
                                        {{ Auth::user()->email }}</p>
                                @else
                                    <p class="text-sm font-medium text-gray-800 truncate dark:text-white">Anonym</p>
                                    <p class="text-xs text-gray-500 truncate dark:text-gray-400">Anonym@example.com</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <a href="{{ route('profile.show') }}"
                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <i class="w-4 mr-3 text-center text-gray-500 fas fa-user dark:text-gray-400"></i>
                        <span>Profile Saya</span>
                    </a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full text-left px-4 py-2.5 text-sm text-danger-600 dark:text-danger-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <i class="w-4 mr-3 text-center fas fa-sign-out-alt"></i>
                            <span>Logout Akun</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
