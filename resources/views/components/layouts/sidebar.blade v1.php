<aside
    class="fixed inset-y-0 left-0 z-40 bg-white border-r border-gray-200 shadow-sm sidebar-transition lg:static lg:inset-0"
    :class="sidebarCollapsed ? 'w-20' : 'w-64'" x-data="sidebarState()">

    <!-- Logo -->
    <div class="p-4 border-b border-gray-100 flex items-center justify-between">
        <div class="flex items-center space-x-3 min-w-0">
            <div
                class="w-8 h-8 bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-rocket text-white text-sm"></i>
            </div>
            <div class="min-w-0 flex-1 nav-text" x-show="!sidebarCollapsed" x-transition>
                <h1 class="text-xl font-bold text-gray-800 truncate">TailAdmin</h1>
                <p class="text-xs text-gray-500 truncate">Admin Dashboard</p>
            </div>
        </div>

        <!-- Collapse Button -->
        <button @click="toggleSidebar()"
            class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200 has-tooltip"
            :class="{ 'lg:flex': !sidebarCollapsed, 'lg:hidden': sidebarCollapsed }" x-show="!sidebarCollapsed"
            x-transition>
            <i class="fas fa-chevron-left text-sm"></i>
            <div class="tooltip">Collapse Sidebar</div>
        </button>

        <!-- Expand Button -->
        <button @click="toggleSidebar()"
            class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200 has-tooltip"
            :class="{ 'lg:flex': sidebarCollapsed, 'lg:hidden': !sidebarCollapsed }" x-show="sidebarCollapsed"
            x-transition>
            <i class="fas fa-chevron-right text-sm"></i>
            <div class="tooltip">Expand Sidebar</div>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="mt-6 px-3">
        <div class="space-y-1.5">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip"
                :class="{ 'bg-primary-50 text-primary-700': request()->routeIs('dashboard') }">
                <div class="p-1.5 rounded-lg transition-colors"
                    :class="request()->routeIs('dashboard') ?
                                                'bg-primary-100' :
                                                'bg-gray-100 group-hover:bg-gray-200'">
                    <i class="fas fa-chart-pie text-sm w-5"
                        :class="request()->routeIs('dashboard') ?
                                                      'text-primary-600' :
                                                      'text-gray-500 group-hover:text-gray-700'"></i>
                </div>
                <span class="ml-3 font-medium nav-text truncate">Dashboard</span>
                <div class="tooltip">Dashboard</div>
            </a>

            <!-- Users Dropdown -->
            <div class="sidebar-dropdown" x-data="{ open: {{ request()->routeIs('users*') ? 'true' : 'false' }} }">
                <button @click="if (sidebarCollapsed) { open = !open } else { open = !open }"
                    class="flex items-center justify-between w-full px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip"
                    :class="{ 'bg-gray-50': open && !sidebarCollapsed }">
                    <div class="flex items-center min-w-0">
                        <div
                            class="p-1.5 rounded-lg bg-blue-50 group-hover:bg-blue-100 transition-colors">
                            <i class="fas fa-users text-blue-600 text-sm w-5"></i>
                        </div>
                        <span class="ml-3 font-medium nav-text truncate" x-show="!sidebarCollapsed"
                            x-transition>Users</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200 group-hover:text-gray-600 nav-text"
                        :class="{ 'rotate-180': open && !sidebarCollapsed }" x-show="!sidebarCollapsed"
                        x-transition></i>
                </button>

                <div class="tooltip">Users</div>

                <!-- Dropdown Content untuk expanded sidebar -->
                <div x-show="open && !sidebarCollapsed" x-collapse
                    class="mt-1 space-y-1 ml-4 border-l border-gray-100 pl-4">

                    <a href="{{ route('users.index') }}"
                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 group
              {{ request()->routeIs('users.index')
                  ? 'bg-primary-100 text-primary-700'
                  : 'text-gray-600 hover:bg-gray-50' }}">
                        <div
                            class="p-1 rounded-lg transition-colors mr-2
                    {{ request()->routeIs('users.index')
                        ? 'bg-primary-200'
                        : 'bg-gray-50 group-hover:bg-gray-100' }}">
                            <i
                                class="fas fa-list text-xs w-4
                      {{ request()->routeIs('users.index')
                          ? 'text-primary-600'
                          : 'text-gray-500' }}"></i>
                        </div>
                        <span>All Users</span>
                    </a>

                    <a href="{{ route('users.create') }}"
                        class="flex items-center px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group"
                        :class="{ 'bg-primary-100 text-primary-700': request()->routeIs('users.create') }">
                        <div class="p-1 rounded-lg transition-colors mr-2"
                            :class="request()->routeIs('users.create') ?
                                                                'bg-primary-200' :
                                                                'bg-gray-50 group-hover:bg-gray-100'">
                            <i class="fas fa-user-plus text-xs w-4"
                                :class="request()->routeIs('users.create') ?
                                                                      'text-primary-600' :
                                                                      'text-gray-500'"></i>
                        </div>
                        <span>Add User</span>
                    </a>
                </div>

                <!-- Dropdown Content untuk collapsed sidebar -->
                <div x-show="open && sidebarCollapsed" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="sidebar-dropdown-content" @click.outside="open = false">

                    <a href="{{ route('users.index') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg transition-colors duration-200"
                        :class="{ 'bg-primary-50 text-primary-700': request()->routeIs('users.index') }"
                        @click="open = false">
                        <i class="fas fa-list mr-3 w-4 text-center"
                            :class="request()->routeIs('users.index') ?
                                                              'text-primary-600' :
                                                              'text-gray-500'"></i>
                        All Users
                    </a>

                    <a href="{{ route('users.create') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg transition-colors duration-200"
                        :class="{ 'bg-primary-50 text-primary-700': request()->routeIs('users.create') }"
                        @click="open = false">
                        <i class="fas fa-user-plus mr-3 w-4 text-center"
                            :class="request()->routeIs('users.create') ?
                                                              'text-primary-600' :
                                                              'text-gray-500'"></i>
                        Add User
                    </a>
                </div>
            </div>

            <!-- Products Dropdown (gunakan pola yang sama seperti Users) -->
            <div class="sidebar-dropdown" x-data="{ open: {{ request()->routeIs('products*') ? 'true' : 'false' }} }">
                <button @click="if (sidebarCollapsed) { open = !open } else { open = !open }"
                    class="flex items-center justify-between w-full px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip"
                    :class="{ 'bg-gray-50': open && !sidebarCollapsed }">
                    <div class="flex items-center min-w-0">
                        <div
                            class="p-1.5 rounded-lg bg-green-50 group-hover:bg-green-100 transition-colors">
                            <i class="fas fa-box text-green-600 text-sm w-5"></i>
                        </div>
                        <span class="ml-3 font-medium nav-text truncate" x-show="!sidebarCollapsed"
                            x-transition>Products</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200 group-hover:text-gray-600 nav-text"
                        :class="{ 'rotate-180': open && !sidebarCollapsed }" x-show="!sidebarCollapsed"
                        x-transition></i>
                </button>

                <div class="tooltip">Products</div>

                <!-- Expanded dropdown -->
                <div x-show="open && !sidebarCollapsed" x-collapse
                    class="mt-1 space-y-1 ml-4 border-l border-gray-100 pl-4">
                    <a href="{{ route('products.index') }}"
                        class="flex items-center px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group"
                        :class="{ 'bg-primary-100 text-primary-700': request()->routeIs('products.index') }">
                        <div class="p-1 rounded-lg transition-colors mr-2"
                            :class="request()->routeIs('products.index') ?
                                                                'bg-primary-200' :
                                                                'bg-gray-50 group-hover:bg-gray-100'">
                            <i class="fas fa-list text-xs w-4"
                                :class="request()->routeIs('products.index') ?
                                                                      'text-primary-600' :
                                                                      'text-gray-500'"></i>
                        </div>
                        <span>All Products</span>
                    </a>

                    <a href="{{ route('products.create') }}"
                        class="flex items-center px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group"
                        :class="{ 'bg-primary-100 text-primary-700': request()->routeIs('products.create') }">
                        <div class="p-1 rounded-lg transition-colors mr-2"
                            :class="request()->routeIs('products.create') ?
                                                                'bg-primary-200' :
                                                                'bg-gray-50 group-hover:bg-gray-100'">
                            <i class="fas fa-plus-circle text-xs w-4"
                                :class="request()->routeIs('products.create') ?
                                                                      'text-primary-600' :
                                                                      'text-gray-500'"></i>
                        </div>
                        <span>Add Product</span>
                    </a>
                </div>

                <!-- Collapsed dropdown -->
                <div x-show="open && sidebarCollapsed" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="sidebar-dropdown-content" @click.outside="open = false">

                    <a href="{{ route('products.index') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg transition-colors duration-200"
                        :class="{ 'bg-primary-50 text-primary-700': request()->routeIs('products.index') }"
                        @click="open = false">
                        <i class="fas fa-list mr-3 w-4 text-center"
                            :class="request()->routeIs('products.index') ?
                                                              'text-primary-600' :
                                                              'text-gray-500'"></i>
                        All Products
                    </a>

                    <a href="{{ route('products.create') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg transition-colors duration-200"
                        :class="{ 'bg-primary-50 text-primary-700': request()->routeIs('products.create') }"
                        @click="open = false">
                        <i class="fas fa-plus-circle mr-3 w-4 text-center"
                            :class="request()->routeIs('products.create') ?
                                                              'text-primary-600' :
                                                              'text-gray-500'"></i>
                        Add Product
                    </a>
                </div>
            </div>

            <!-- Settings -->
            <a href="{{ route('settings') }}"
                class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip"
                :class="{ 'bg-primary-50 text-primary-700': request()->routeIs('settings*') }">
                <div class="p-1.5 rounded-lg transition-colors"
                    :class="request()->routeIs('settings*') ?
                                                'bg-primary-100' :
                                                'bg-gray-100 group-hover:bg-gray-200'">
                    <i class="fas fa-cog text-sm w-5"
                        :class="request()->routeIs('settings*') ?
                                                      'text-primary-600' :
                                                      'text-gray-500 group-hover:text-gray-700'"></i>
                </div>
                <span class="ml-3 font-medium nav-text truncate">Settings</span>
                <div class="tooltip">Settings</div>
            </a>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    {{-- <div
        class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100 bg-white">
        <div class="flex items-center space-x-3" :class="{ 'justify-center': sidebarCollapsed }">
            <div
                class="w-8 h-8 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-white text-sm font-semibold">A</span>
            </div>
            <div class="min-w-0 flex-1 nav-text" x-show="!sidebarCollapsed" x-transition>
                <p class="text-sm font-medium text-gray-800 truncate">Admin User</p>
                <p class="text-xs text-gray-500 truncate">admin@tailadmin.com</p>
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
