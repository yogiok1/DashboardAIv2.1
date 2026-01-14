 @props(['title' => 'Dashboard'])

<header
    class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-card">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center space-x-4">
            <!-- Sidebar Toggle Button -->
            <button @click="toggleSidebar()"
                class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors duration-200">
                <i class="fas fa-bars text-lg"></i>
            </button>

            <!-- Page Title -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $title }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Selamat datang, Admin</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <!-- Dark Mode Toggle -->
            <button @click="toggleDarkMode()"
                class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors duration-200"
                :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                <i class="fas fa-sun text-yellow-500" x-show="!darkMode"></i>
                <i class="fas fa-moon text-blue-400" x-show="darkMode" style="display: none;"></i>
            </button>

            <!-- Search Bar -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" placeholder="Cari..."
                    class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white w-64 transition-colors duration-200 placeholder-gray-500 dark:placeholder-gray-400">
            </div>

            <!-- User Profile dengan Avatar -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center space-x-3 focus:outline-none p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                    <!-- Avatar -->
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-semibold text-sm">AU</span>
                    </div>

                    <!-- User Info - Hidden on small screens, visible on medium+ -->
                    <div class="text-left hidden md:block">
                        <p class="text-sm font-medium text-gray-800 dark:text-white">Admin User</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Administrator</p>
                    </div>

                    <!-- Chevron Icon -->
                    <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200 hidden md:block"
                        :class="{ 'rotate-180': open }"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-cloak
                    class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-soft border border-gray-200 dark:border-gray-700 py-2 z-50"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95">
                    <!-- Profile Section -->
                    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-semibold text-sm">AU</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800 dark:text-white truncate">Admin User</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">admin@example.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <a href="#"
                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-user mr-3 w-4 text-center text-gray-500 dark:text-gray-400"></i>
                        <span>Profil Saya</span>
                    </a>

                    <a href="#"
                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-cog mr-3 w-4 text-center text-gray-500 dark:text-gray-400"></i>
                        <span>Pengaturan</span>
                    </a>

                    <a href="#"
                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-bell mr-3 w-4 text-center text-gray-500 dark:text-gray-400"></i>
                        <span>Notifikasi</span>
                        <span
                            class="ml-auto px-2 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-800 dark:text-primary-300 text-xs rounded-full">3</span>
                    </a>

                    <div class="border-t my-1 dark:border-gray-700"></div>

                    <!-- Help & Support -->
                    <a href="#"
                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-question-circle mr-3 w-4 text-center text-gray-500 dark:text-gray-400"></i>
                        <span>Bantuan</span>
                    </a>

                    <div class="border-t my-1 dark:border-gray-700"></div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full text-left px-4 py-2.5 text-sm text-danger-600 dark:text-danger-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt mr-3 w-4 text-center"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
