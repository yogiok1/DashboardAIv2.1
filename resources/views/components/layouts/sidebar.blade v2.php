<aside
    class="fixed inset-y-0 left-0 z-40 bg-white border-r border-gray-200 shadow-sm sidebar-transition lg:static lg:inset-0 dark:bg-gray-800 dark:border-gray-700"
    :class="sidebarCollapsed ? 'w-20' : 'w-64'" x-data="sidebarState()">

    <!-- Logo -->
    <div class="flex items-center justify-between p-4 border-b border-gray-100 dark:border-gray-700">
        <div class="flex items-center min-w-0 space-x-3">
            <div
                class="flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-r from-primary-500 to-primary-600">
                <i class="text-sm text-white fas fa-rocket"></i>
            </div>
            <div class="flex-1 min-w-0 nav-text" x-show="!sidebarCollapsed" x-transition>
                <h1 class="text-xl font-bold text-gray-800 truncate dark:text-white">TailAdmin</h1>
                <p class="text-xs text-gray-500 truncate dark:text-gray-400">Admin Dashboard</p>
            </div>
        </div>

        <!-- Collapse Button -->
        <button @click="toggleSidebar()"
            class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200 has-tooltip dark:hover:text-gray-300 dark:hover:bg-gray-700"
            :class="{ 'lg:flex': !sidebarCollapsed, 'lg:hidden': sidebarCollapsed }" x-show="!sidebarCollapsed"
            x-transition>
            <i class="text-sm fas fa-chevron-left"></i>
            <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Collapse Sidebar</div>
        </button>

        <!-- Expand Button -->
        <button @click="toggleSidebar()"
            class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200 has-tooltip dark:hover:text-gray-300 dark:hover:bg-gray-700"
            :class="{ 'lg:flex': sidebarCollapsed, 'lg:hidden': !sidebarCollapsed }" x-show="sidebarCollapsed"
            x-transition>
            <i class="text-sm fas fa-chevron-right"></i>
            <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Expand Sidebar</div>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="px-3 mt-6">
        <div class="space-y-1.5">
            <!-- Dashboard -->

            <a href="{{ route('dashboard') }}"
                class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip dark:text-gray-300 dark:hover:bg-gray-700
        {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}">
                <div
                    class="p-1.5 rounded-lg transition-colors
        {{ request()->routeIs('dashboard') ? 'bg-primary-100 dark:bg-primary-800' : 'bg-gray-100 group-hover:bg-gray-200 dark:bg-gray-700 dark:group-hover:bg-gray-600' }}">
                    <i
                        class="w-5 text-sm fas fa-chart-pie
            {{ request()->routeIs('dashboard') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300' }}"></i>
                </div>
                <span class="ml-3 font-medium truncate nav-text">Dashboard</span>
                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Dashboard</div>
            </a>

            <!-- Users Dropdown -->
            <div class="sidebar-dropdown" x-data="{ open: {{ request()->routeIs('users*') ? 'true' : 'false' }} }">
                <button @click="if (sidebarCollapsed) { open = !open } else { open = !open }"
                    class="flex items-center justify-between w-full px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip dark:text-gray-300 dark:hover:bg-gray-700"
                    :class="{ 'bg-gray-50 dark:bg-gray-700': open && !sidebarCollapsed }">
                    <div class="flex items-center min-w-0">
                        <div
                            class="p-1.5 rounded-lg bg-blue-50 group-hover:bg-blue-100 transition-colors dark:bg-blue-900/30 dark:group-hover:bg-blue-900/50">
                            <i class="w-5 text-sm text-blue-600 fas fa-users dark:text-blue-400"></i>
                        </div>
                        <span class="ml-3 font-medium truncate nav-text" x-show="!sidebarCollapsed"
                            x-transition>Users</span>
                    </div>
                    <i class="text-xs text-gray-400 transition-transform duration-200 fas fa-chevron-down group-hover:text-gray-600 nav-text dark:text-gray-500 dark:group-hover:text-gray-400"
                        :class="{ 'rotate-180': open && !sidebarCollapsed }" x-show="!sidebarCollapsed"
                        x-transition></i>
                </button>

                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Users</div>

                <!-- Dropdown Content untuk expanded sidebar -->
                <div x-show="open && !sidebarCollapsed" x-collapse
                    class="pl-4 mt-1 ml-4 space-y-1 border-l border-gray-100 dark:border-gray-600">

                    <!-- All Users -->
                    <a href="{{ route('users.index') }}"
                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 group
                        {{ request()->routeIs('users.index')
                            ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300'
                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <div
                            class="p-1 rounded-lg transition-colors mr-2
                        {{ request()->routeIs('users.index')
                            ? 'bg-primary-200 dark:bg-primary-800'
                            : 'bg-gray-50 group-hover:bg-gray-100 dark:bg-gray-600 dark:group-hover:bg-gray-500' }}">
                            <i
                                class="fas fa-list text-xs w-4
                            {{ request()->routeIs('users.index')
                                ? 'text-primary-600 dark:text-primary-400'
                                : 'text-gray-500 dark:text-gray-400' }}"></i>
                        </div>
                        <span>All Users</span>
                    </a>

                    <!-- Add User -->
                    <a href="{{ route('users.create') }}"
                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 group
                        {{ request()->routeIs('users.create')
                            ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300'
                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <div
                            class="p-1 rounded-lg transition-colors mr-2
                        {{ request()->routeIs('users.create')
                            ? 'bg-primary-200 dark:bg-primary-800'
                            : 'bg-gray-50 group-hover:bg-gray-100 dark:bg-gray-600 dark:group-hover:bg-gray-500' }}">
                            <i
                                class="fas fa-user-plus text-xs w-4
                            {{ request()->routeIs('users.create')
                                ? 'text-primary-600 dark:text-primary-400'
                                : 'text-gray-500 dark:text-gray-400' }}"></i>
                        </div>
                        <span>Add User</span>
                    </a>
                </div>

                <!-- Dropdown Content untuk collapsed sidebar -->
                <div x-show="open && sidebarCollapsed" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="sidebar-dropdown-content dark:bg-gray-800 dark:border-gray-600"
                    @click.outside="open = false">

                    <a href="{{ route('users.index') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors duration-200 rounded-t-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                        :class="{ 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300': request()->routeIs('users.index') }"
                        @click="open = false">
                        <i class="w-4 mr-3 text-center fas fa-list"
                            :class="request()->routeIs('users.index') ?
                                                                                                                                                                                                                                         'text-primary-600 dark:text-primary-400' :
                                                                                                                                                                                                                                         'text-gray-500 dark:text-gray-400'"></i>
                        All Users
                    </a>

                    <a href="{{ route('users.create') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors duration-200 rounded-b-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                        :class="{ 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300': request()->routeIs('users.create') }"
                        @click="open = false">
                        <i class="w-4 mr-3 text-center fas fa-user-plus"
                            :class="request()->routeIs('users.create') ?
                                                                                                                                                                                                                                         'text-primary-600 dark:text-primary-400' :
                                                                                                                                                                                                                                         'text-gray-500 dark:text-gray-400'"></i>
                        Add User
                    </a>
                </div>
            </div>

            <!-- Products Dropdown (gunakan pola yang sama seperti Users) -->
            <div class="sidebar-dropdown" x-data="{ open: {{ request()->routeIs('products*') ? 'true' : 'false' }} }">
                <button @click="if (sidebarCollapsed) { open = !open } else { open = !open }"
                    class="flex items-center justify-between w-full px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip dark:text-gray-300 dark:hover:bg-gray-700"
                    :class="{ 'bg-gray-50 dark:bg-gray-700': open && !sidebarCollapsed }">
                    <div class="flex items-center min-w-0">
                        <div
                            class="p-1.5 rounded-lg bg-green-50 group-hover:bg-green-100 transition-colors dark:bg-green-900/30 dark:group-hover:bg-green-900/50">
                            <i class="w-5 text-sm text-green-600 fas fa-box dark:text-green-400"></i>
                        </div>
                        <span class="ml-3 font-medium truncate nav-text" x-show="!sidebarCollapsed"
                            x-transition>Products</span>
                    </div>
                    <i class="text-xs text-gray-400 transition-transform duration-200 fas fa-chevron-down group-hover:text-gray-600 nav-text dark:text-gray-500 dark:group-hover:text-gray-400"
                        :class="{ 'rotate-180': open && !sidebarCollapsed }" x-show="!sidebarCollapsed"
                        x-transition></i>
                </button>

                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Products</div>

                <!-- Expanded dropdown -->
                <div x-show="open && !sidebarCollapsed" x-collapse
                    class="pl-4 mt-1 ml-4 space-y-1 border-l border-gray-100 dark:border-gray-600">
                    <a href="{{ route('products.index') }}"
                        class="flex items-center px-3 py-2 text-sm text-gray-600 transition-all duration-200 rounded-lg hover:bg-gray-50 group dark:text-gray-300 dark:hover:bg-gray-700"
                        :class="{ 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300': request()->routeIs('products.index') }">
                        <div class="p-1 mr-2 transition-colors rounded-lg"
                            :class="request()->routeIs('products.index') ?
                                                                                                                                                                                                                                           'bg-primary-200 dark:bg-primary-800' :
                                                                                                                                                                                                                                           'bg-gray-50 group-hover:bg-gray-100 dark:bg-gray-600 dark:group-hover:bg-gray-500'">
                            <i class="w-4 text-xs fas fa-list"
                                :class="request()->routeIs('products.index') ?
                                                                                                                                                                                                                                                                         'text-primary-600 dark:text-primary-400' :
                                                                                                                                                                                                                                                                         'text-gray-500 dark:text-gray-400'"></i>
                        </div>
                        <span>All Products</span>
                    </a>

                    <a href="{{ route('products.create') }}"
                        class="flex items-center px-3 py-2 text-sm text-gray-600 transition-all duration-200 rounded-lg hover:bg-gray-50 group dark:text-gray-300 dark:hover:bg-gray-700"
                        :class="{ 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300': request()->routeIs('products.create') }">
                        <div class="p-1 mr-2 transition-colors rounded-lg"
                            :class="request()->routeIs('products.create') ?
                                                                                                                                                                                                                                           'bg-primary-200 dark:bg-primary-800' :
                                                                                                                                                                                                                                           'bg-gray-50 group-hover:bg-gray-100 dark:bg-gray-600 dark:group-hover:bg-gray-500'">
                            <i class="w-4 text-xs fas fa-plus-circle"
                                :class="request()->routeIs('products.create') ?
                                                                                                                                                                                                                                                                         'text-primary-600 dark:text-primary-400' :
                                                                                                                                                                                                                                                                         'text-gray-500 dark:text-gray-400'"></i>
                        </div>
                        <span>Add Product</span>
                    </a>
                </div>

                <!-- Collapsed dropdown -->
                <div x-show="open && sidebarCollapsed" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="sidebar-dropdown-content dark:bg-gray-800 dark:border-gray-600"
                    @click.outside="open = false">

                    <a href="{{ route('products.index') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors duration-200 rounded-t-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                        :class="{ 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300': request()->routeIs('products.index') }"
                        @click="open = false">
                        <i class="w-4 mr-3 text-center fas fa-list"
                            :class="request()->routeIs('products.index') ?
                                                                                                                                                                                                                                         'text-primary-600 dark:text-primary-400' :
                                                                                                                                                                                                                                         'text-gray-500 dark:text-gray-400'"></i>
                        All Products
                    </a>

                    <a href="{{ route('products.create') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors duration-200 rounded-b-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                        :class="{ 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300': request()->routeIs('products.create') }"
                        @click="open = false">
                        <i class="w-4 mr-3 text-center fas fa-plus-circle"
                            :class="request()->routeIs('products.create') ?
                                                                                                                                                                                                                                         'text-primary-600 dark:text-primary-400' :
                                                                                                                                                                                                                                         'text-gray-500 dark:text-gray-400'"></i>
                        Add Product
                    </a>
                </div>
            </div>

            <!-- Settings -->
            <a href="{{ route('settings') }}"
                class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip dark:text-gray-300 dark:hover:bg-gray-700"
                :class="{ 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300': request()->routeIs('settings*') }">
                <div class="p-1.5 rounded-lg transition-colors"
                    :class="request()->routeIs('settings*') ?
                                                                                                                                                                           'bg-primary-100 dark:bg-primary-800' :
                                                                                                                                                                           'bg-gray-100 group-hover:bg-gray-200 dark:bg-gray-700 dark:group-hover:bg-gray-600'">
                    <i class="w-5 text-sm fas fa-cog"
                        :class="request()->routeIs('settings*') ?
                                                                                                                                                                                                         'text-primary-600 dark:text-primary-400' :
                                                                                                                                                                                                         'text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300'"></i>
                </div>
                <span class="ml-3 font-medium truncate nav-text">Settings</span>
                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Settings</div>
            </a>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    {{-- <div
        class="absolute bottom-0 left-0 right-0 p-4 bg-white border-t border-gray-100 dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center space-x-3" :class="{ 'justify-center': sidebarCollapsed }">
            <div
                class="flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-full bg-gradient-to-r from-primary-500 to-primary-600">
                <span class="text-sm font-semibold text-white">A</span>
            </div>
            <div class="flex-1 min-w-0 nav-text" x-show="!sidebarCollapsed" x-transition>
                <p class="text-sm font-medium text-gray-800 truncate dark:text-white">Admin User</p>
                <p class="text-xs text-gray-500 truncate dark:text-gray-400">admin@tailadmin.com</p>
            </div>
        </div>
    </div> --}}
</aside>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebarState', () => ({
            init() {
                this.$nextTick(() => {
                    const dropdowns = this.$el.querySelectorAll('[x-data]');
                    dropdowns.forEach(dropdown => {
                        const alpineData = Alpine.$data(dropdown);
                        if (alpineData && typeof alpineData.open !== 'undefined') {
                            // Already set via x-data
                        }
                    });
                });
            }
        }));
    });
</script>
