<aside
    class="fixed inset-y-0 left-0 z-50 bg-white border-r border-gray-200 shadow-sm sidebar-transition dark:bg-gray-800 dark:border-gray-700 transform lg:static lg:inset-0"
    x-data="sidebar()" 
    :class="[collapsed ? 'w-20' : 'w-64', $store.menu.mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0']" 
    id="main-sidebar"
    style="height: 100vh; overflow: visible;">

    <!-- Logo -->
    <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-700" :class="collapsed ? 'p-2' : 'p-4'">
        <div class="flex items-center min-w-0 flex-1">
            <!-- Logo Collapsed - Small icon only -->
            <div class="flex items-center justify-center w-full py-2" x-show="collapsed" x-transition>
                <img src="{{ asset('images/branding/logo-diktisaintek.svg') }}" alt="Logo Diktisaintek" class="h-10 w-16 object-contain">
            </div>
            <!-- Logo Expanded - Full logo with text -->
            <div class="flex items-center w-full pr-2" x-show="!collapsed" x-transition>
                <img src="{{ asset('images/branding/logo-diktisaintek-full.png') }}" alt="Diktisaintek Berdampak" class="h-10 max-w-full object-contain">
            </div>
        </div>

        <div class="flex items-center flex-shrink-0 ml-2">
            <!-- Close button for mobile -->
            <button @click="$store.menu.mobileOpen = false"
                class="lg:hidden p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200 dark:hover:text-gray-300 dark:hover:bg-gray-700">
                <i class="text-sm fas fa-times"></i>
            </button>
            
            <!-- Collapse Button - Desktop only -->
            <button @click="toggle()"
                class="hidden lg:block p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200 has-tooltip dark:hover:text-gray-300 dark:hover:bg-gray-700"
                x-show="!collapsed" x-transition>
                <i class="text-sm fas fa-chevron-left"></i>
                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Collapse Sidebar</div>
            </button>

            <!-- Expand Button - Desktop only -->
            <button @click="toggle()"
                class="hidden lg:block p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200 has-tooltip dark:hover:text-gray-300 dark:hover:bg-gray-700"
                x-show="collapsed" x-transition>
                <i class="text-sm fas fa-chevron-right"></i>
                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Expand Sidebar</div>
            </button>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="px-3 mt-6" style="padding-bottom: 100px; overflow: visible;">
        <div class="space-y-1.5">
            <!-- Halaman Utama -->
            <a href="{{ route('dashboard') }}"
                @click="if(window.innerWidth < 1024) { $store.menu.mobileOpen = false }"
                class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip dark:text-gray-300 dark:hover:bg-gray-700
                {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}">
                <div
                    class="p-1.5 rounded-lg transition-colors
                    {{ request()->routeIs('dashboard') ? 'bg-primary-100 dark:bg-primary-800' : 'bg-gray-100 group-hover:bg-gray-200 dark:bg-gray-700 dark:group-hover:bg-gray-600' }}">
                    <i
                        class="w-5 text-sm fas fa-home
                        {{ request()->routeIs('dashboard') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300' }}"></i>
                </div>
                <span class="ml-3 font-medium truncate" x-show="!collapsed" x-transition>Halaman Utama</span>
                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Halaman Utama</div>
            </a>

            <!-- PENILAIAN PROPOSAL DROPDOWN -->
            <div class="relative" style="overflow: visible;">
                <button @click="togglePenilaianProposal()"
                    class="flex items-center justify-between w-full px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip dark:text-gray-300 dark:hover:bg-gray-700"
                    :class="{ 'bg-gray-50 dark:bg-gray-700': penilaianProposalOpen && !collapsed }">
                    <div class="flex items-center min-w-0">
                        <div
                            class="p-1.5 rounded-lg bg-gradient-to-r from-purple-50 to-blue-50 group-hover:from-purple-100 group-hover:to-blue-100 transition-colors dark:from-purple-900/30 dark:to-blue-900/30 dark:group-hover:from-purple-900/50 dark:group-hover:to-blue-900/50">
                            <i class="w-5 text-sm text-transparent bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text dark:from-purple-400 dark:to-blue-400 fas fa-clipboard-check"></i>
                        </div>
                        <span class="ml-3 font-medium truncate" x-show="!collapsed" x-transition>Penilaian Proposal</span>
                    </div>
                    <i class="text-xs text-gray-400 transition-transform duration-200 fas fa-chevron-down group-hover:text-gray-600 dark:text-gray-500 dark:group-hover:text-gray-400"
                        :class="{ 'rotate-180': penilaianProposalOpen && !collapsed }" x-show="!collapsed" x-transition></i>
                </button>

                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Penilaian Proposal</div>

                <!-- Expanded dropdown content -->
                <div x-show="penilaianProposalOpen && !collapsed"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="pl-4 mt-1 ml-4 space-y-1 border-l border-gray-100 dark:border-gray-600">

                    <!-- Input Data -->
                    <a href="{{ route('inputData') }}"
                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 group
                        {{ request()->routeIs('inputData')
                            ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300'
                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <div
                            class="p-1 rounded-lg transition-colors mr-2
                            {{ request()->routeIs('inputData')
                                ? 'bg-primary-200 dark:bg-primary-800'
                                : 'bg-gray-50 group-hover:bg-gray-100 dark:bg-gray-600 dark:group-hover:bg-gray-500' }}">
                            <i
                                class="fas fa-database text-xs w-4
                                {{ request()->routeIs('inputData')
                                    ? 'text-primary-600 dark:text-primary-400'
                                    : 'text-gray-500 dark:text-gray-400' }}"></i>
                        </div>
                        <span>Masukan Data</span>
                    </a>

                    <!-- Config/Tools -->
                    <a href="{{ route('tools') }}"
                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 group
                        {{ request()->routeIs('tools')
                            ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300'
                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <div
                            class="p-1 rounded-lg transition-colors mr-2
                            {{ request()->routeIs('tools')
                                ? 'bg-primary-200 dark:bg-primary-800'
                                : 'bg-gray-50 group-hover:bg-gray-100 dark:bg-gray-600 dark:group-hover:bg-gray-500' }}">
                            <i
                                class="fas fa-sliders-h text-xs w-4
                                {{ request()->routeIs('tools')
                                    ? 'text-primary-600 dark:text-primary-400'
                                    : 'text-gray-500 dark:text-gray-400' }}"></i>
                        </div>
                        <span>Proses Penilaian</span>
                    </a>

                    <!-- Result -->
                    <a href="{{ route('results.index') }}"
                        class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 group
                        {{ request()->routeIs('results.index')
                            ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300'
                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <div
                            class="p-1 rounded-lg transition-colors mr-2
                            {{ request()->routeIs('results.index')
                                ? 'bg-primary-200 dark:bg-primary-800'
                                : 'bg-gray-50 group-hover:bg-gray-100 dark:bg-gray-600 dark:group-hover:bg-gray-500' }}">
                            <i
                                class="fas fa-chart-bar text-xs w-4
                                {{ request()->routeIs('results.index')
                                    ? 'text-primary-600 dark:text-primary-400'
                                    : 'text-gray-500 dark:text-gray-400' }}"></i>
                        </div>
                        <span>Lihat Hasil</span>
                    </a>
                </div>

                <!-- Collapsed dropdown - Z-INDEX TINGGI -->
                <div x-show="penilaianProposalOpen && collapsed"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute left-full top-0 ml-2 z-[100] w-48 bg-white rounded-lg shadow-xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700"
                     style="overflow: visible;"
                     @click.outside="penilaianProposalOpen = false">

                    <!-- Input Data -->
                    <a href="{{ route('inputData') }}"
                        class="flex items-center px-4 py-3 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded-t-lg
                        {{ request()->routeIs('inputData') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}"
                        @click="penilaianProposalOpen = false">
                        <i class="w-4 mr-3 text-center fas fa-database
                            {{ request()->routeIs('inputData') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        Masukan Data
                    </a>

                    <!-- Config/Tools -->
                    <a href="{{ route('tools') }}"
                        class="flex items-center px-4 py-3 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700
                        {{ request()->routeIs('tools') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}"
                        @click="penilaianProposalOpen = false">
                        <i class="w-4 mr-3 text-center fas fa-sliders-h
                            {{ request()->routeIs('tools') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        Proses Penilaian
                    </a>

                    <!-- Result -->
                    <a href="{{ route('results.index') }}"
                        class="flex items-center px-4 py-3 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded-b-lg
                        {{ request()->routeIs('results.index') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}"
                        @click="penilaianProposalOpen = false">
                        <i class="w-4 mr-3 text-center fas fa-chart-bar
                            {{ request()->routeIs('results.index') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        Lihat Hasil
                    </a>
                </div>
            </div>

            <!-- Pengaturan Dropdown -->
            <div class="relative" style="overflow: visible;">
                <button @click="togglePengaturan()"
                    class="flex items-center justify-between w-full px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip dark:text-gray-300 dark:hover:bg-gray-700"
                    :class="{ 'bg-gray-50 dark:bg-gray-700': pengaturanOpen && !collapsed }">
                    <div class="flex items-center min-w-0">
                        <div
                            class="p-1.5 rounded-lg bg-gray-50 group-hover:bg-gray-100 transition-colors dark:bg-gray-700 dark:group-hover:bg-gray-600">
                            <i class="w-5 text-sm text-gray-600 fas fa-cog dark:text-gray-400"></i>
                        </div>
                        <span class="ml-3 font-medium truncate" x-show="!collapsed" x-transition>Pengaturan</span>
                    </div>
                    <i class="text-xs text-gray-400 transition-transform duration-200 fas fa-chevron-down group-hover:text-gray-600 dark:text-gray-500 dark:group-hover:text-gray-400"
                        :class="{ 'rotate-180': pengaturanOpen && !collapsed }" x-show="!collapsed" x-transition></i>
                </button>

                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Pengaturan</div>

                <!-- Expanded dropdown -->
                <div x-show="pengaturanOpen && !collapsed"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="pl-4 mt-1 ml-4 space-y-1 border-l border-gray-100 dark:border-gray-600">

                    <!-- Pengaturan Umum -->
                    <a href="{{ route('settings') }}"
                        class="flex items-center px-3 py-2 text-sm text-gray-600 transition-all duration-200 rounded-lg hover:bg-gray-50 group dark:text-gray-300 dark:hover:bg-gray-700
                        {{ request()->routeIs('settings') ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}">
                        <div class="p-1 mr-2 transition-colors rounded-lg
                            {{ request()->routeIs('settings') ? 'bg-primary-200 dark:bg-primary-800' : 'bg-gray-50 group-hover:bg-gray-100 dark:bg-gray-600 dark:group-hover:bg-gray-500' }}">
                            <i class="w-4 text-xs fas fa-sliders-h
                                {{ request()->routeIs('settings') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        </div>
                        <span>Pengaturan Umum</span>
                    </a>

                    <!-- Manajemen Pengguna -->
                    <a href="{{ route('users.index') }}"
                        class="flex items-center px-3 py-2 text-sm text-gray-600 transition-all duration-200 rounded-lg hover:bg-gray-50 group dark:text-gray-300 dark:hover:bg-gray-700
                        {{ request()->routeIs('users.*') ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}">
                        <div class="p-1 mr-2 transition-colors rounded-lg
                            {{ request()->routeIs('users.*') ? 'bg-primary-200 dark:bg-primary-800' : 'bg-gray-50 group-hover:bg-gray-100 dark:bg-gray-600 dark:group-hover:bg-gray-500' }}">
                            <i class="w-4 text-xs fas fa-users
                                {{ request()->routeIs('users.*') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        </div>
                        <span>Pengguna</span>
                    </a>

                    <!-- Peran & Izin -->
                    <a href="{{ route('role-permission.index') }}"
                        class="flex items-center px-3 py-2 text-sm text-gray-600 transition-all duration-200 rounded-lg hover:bg-gray-50 group dark:text-gray-300 dark:hover:bg-gray-700
                        {{ request()->routeIs('roles.*') || request()->routeIs('permissions.*') || request()->routeIs('role-permission.*') ? 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}">
                        <div class="p-1 mr-2 transition-colors rounded-lg
                            {{ request()->routeIs('roles.*') || request()->routeIs('permissions.*') || request()->routeIs('role-permission.*') ? 'bg-primary-200 dark:bg-primary-800' : 'bg-gray-50 group-hover:bg-gray-100 dark:bg-gray-600 dark:group-hover:bg-gray-500' }}">
                            <i class="w-4 text-xs fas fa-user-shield
                                {{ request()->routeIs('roles.*') || request()->routeIs('permissions.*') || request()->routeIs('role-permission.*') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        </div>
                        <span>Peran & Izin</span>
                    </a>
                </div>

                <!-- Collapsed dropdown untuk Pengaturan -->
                <div x-show="pengaturanOpen && collapsed"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute left-full top-0 ml-2 z-[100] w-56 bg-white rounded-lg shadow-xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700"
                     style="overflow: visible;"
                     @click.outside="pengaturanOpen = false">

                    <!-- Pengaturan Umum -->
                    <a href="{{ route('settings') }}"
                        class="flex items-center px-4 py-3 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded-t-lg
                        {{ request()->routeIs('settings') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}"
                        @click="pengaturanOpen = false">
                        <i class="w-4 mr-3 text-center fas fa-sliders-h
                            {{ request()->routeIs('settings') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        Pengaturan Umum
                    </a>

                    <!-- Manajemen Pengguna -->
                    <a href="{{ route('users.index') }}"
                        class="flex items-center px-4 py-3 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700
                        {{ request()->routeIs('users.*') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}"
                        @click="pengaturanOpen = false">
                        <i class="w-4 mr-3 text-center fas fa-users
                            {{ request()->routeIs('users.*') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        Pengguna
                    </a>

                    <!-- Peran & Izin -->
                    <a href="{{ route('role-permission.index') }}"
                        class="flex items-center px-4 py-3 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded-b-lg
                        {{ request()->routeIs('roles.*') || request()->routeIs('permissions.*') || request()->routeIs('role-permission.*') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}"
                        @click="pengaturanOpen = false">
                        <i class="w-4 mr-3 text-center fas fa-user-shield
                            {{ request()->routeIs('roles.*') || request()->routeIs('permissions.*') || request()->routeIs('role-permission.*') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        Peran & Izin
                    </a>
                </div>
            </div>

            <!-- Chatbot -->
            <a href="{{ route('chatbot') }}"
                @click="if(window.innerWidth < 1024) { $store.menu.mobileOpen = false }"
                class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip dark:text-gray-300 dark:hover:bg-gray-700
                {{ request()->routeIs('chatbot') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}">
                <div
                    class="p-1.5 rounded-lg transition-colors
                    {{ request()->routeIs('chatbot') ? 'bg-primary-100 dark:bg-primary-800' : 'bg-gradient-to-br from-blue-50 to-purple-50 group-hover:from-blue-100 group-hover:to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 dark:group-hover:from-blue-900/50 dark:group-hover:to-purple-900/50' }}">
                    <i
                        class="w-5 text-sm fas fa-robot
                        {{ request()->routeIs('chatbot') ? 'text-primary-600 dark:text-primary-400' : 'text-blue-600 group-hover:text-purple-600 dark:text-blue-400 dark:group-hover:text-purple-400' }}"></i>
                </div>
                <span class="ml-3 font-medium truncate" x-show="!collapsed" x-transition>Chatbot</span>
                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Chatbot</div>
            </a>

            <!-- Help / User Guide -->
            <a href="{{ route('help') }}"
                @click="if(window.innerWidth < 1024) { $store.menu.mobileOpen = false }"
                class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200 group has-tooltip dark:text-gray-300 dark:hover:bg-gray-700
                {{ request()->routeIs('help') ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' : '' }}">
                <div
                    class="p-1.5 rounded-lg transition-colors
                    {{ request()->routeIs('help') ? 'bg-primary-100 dark:bg-primary-800' : 'bg-green-50 group-hover:bg-green-100 dark:bg-green-900/30 dark:group-hover:bg-green-900/50' }}">
                    <i
                        class="w-5 text-sm fas fa-question-circle
                        {{ request()->routeIs('help') ? 'text-primary-600 dark:text-primary-400' : 'text-green-600 group-hover:text-green-700 dark:text-green-400 dark:group-hover:text-green-300' }}"></i>
                </div>
                <span class="ml-3 font-medium truncate" x-show="!collapsed" x-transition>Help</span>
                <div class="tooltip dark:bg-gray-700 dark:text-gray-300">Help / User Guide</div>
            </a>
        </div>
    </nav>
</aside>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebar', () => ({
            // Inisialisasi state dari localStorage
            collapsed: localStorage.getItem('sidebarCollapsed') === 'true',

            // Inisialisasi semua dropdown state dari route saat ini
            penilaianProposalOpen: {{ request()->routeIs('inputData', 'tools', 'results.index') ? 'true' : 'false' }},
            pengaturanOpen: {{ request()->routeIs('users*', 'roles.*', 'permissions.*', 'role-permission.*', 'settings*') ? 'true' : 'false' }},

            init() {
                console.log('Sidebar initialized');

                // Listen for global toggle events
                window.addEventListener('toggle-sidebar', () => {
                    this.toggle();
                });

                // Close dropdowns when clicking outside
                document.addEventListener('click', (e) => {
                    const sidebar = document.getElementById('main-sidebar');
                    if (sidebar && !sidebar.contains(e.target)) {
                        console.log('Closing all dropdowns - clicked outside');
                        this.closeAll();
                    }
                });
            },

            toggle() {
                this.collapsed = !this.collapsed;
                localStorage.setItem('sidebarCollapsed', this.collapsed);
                console.log('Sidebar toggled, collapsed:', this.collapsed);

                // Auto-close dropdowns when toggling sidebar
                this.closeAll();
            },

            togglePenilaianProposal() {
                console.log('togglePenilaianProposal called, current state:', this.penilaianProposalOpen);

                if (this.collapsed) {
                    this.penilaianProposalOpen = !this.penilaianProposalOpen;
                    if (this.penilaianProposalOpen) {
                        this.pengaturanOpen = false;
                    }
                } else {
                    this.penilaianProposalOpen = !this.penilaianProposalOpen;
                    if (this.penilaianProposalOpen) {
                        this.pengaturanOpen = false;
                    }
                }
            },

            togglePengaturan() {
                console.log('togglePengaturan called, current state:', this.pengaturanOpen);

                if (this.collapsed) {
                    this.pengaturanOpen = !this.pengaturanOpen;
                    if (this.pengaturanOpen) {
                        this.penilaianProposalOpen = false;
                    }
                } else {
                    this.pengaturanOpen = !this.pengaturanOpen;
                    if (this.pengaturanOpen) {
                        this.penilaianProposalOpen = false;
                    }
                }
            },

            closeAll() {
                console.log('closeAll called');
                this.penilaianProposalOpen = false;
                this.pengaturanOpen = false;
            }
        }));
    });
</script>

<!-- Debug script untuk memeriksa event handling -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded');

        // Check Alpine.js initialization
        if (typeof Alpine === 'undefined') {
            console.error('Alpine.js is not loaded!');
        } else {
            console.log('Alpine.js is loaded');
        }
    });
</script>
