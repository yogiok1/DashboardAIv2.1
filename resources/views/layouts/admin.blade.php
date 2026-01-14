<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('Logo-Tersier-Diktisaintek-Berdampak.png') }}">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @livewireStyles

    <script>
        // Initialize dark mode from localStorage or system preference
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            // Initialize sidebar state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                document.body.classList.add('sidebar-collapsed');
            }
        });
        
        // Initialize Alpine Store for mobile menu
        document.addEventListener('alpine:init', () => {
            Alpine.store('menu', {
                mobileOpen: false,
                toggle() {
                    this.mobileOpen = !this.mobileOpen;
                }
            });
        });
    </script>
    
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-in-out, width 0.3s ease;
        }
        
        [x-cloak] {
            display: none !important;
        }
        
        /* Animated gradient text for AI */
        @keyframes gradient-x {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }
        
        .animate-gradient-x {
            background-size: 200% 200%;
            animation: gradient-x 3s ease infinite;
        }
        
        /* Spotlight hover effect on background */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            background: radial-gradient(circle 400px at var(--mouse-x, 50%) var(--mouse-y, 50%), 
                rgba(253, 159, 49, 0.15), 
                rgba(254, 187, 19, 0.05) 30%,
                transparent 60%);
            opacity: 1;
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            z-index: -1;
        }
        
        body {
            --mouse-x: 50%;
            --mouse-y: 50%;
            position: relative;
        }
    </style>

</head>

<body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-orange-50 to-yellow-50 dark:from-blue-950 dark:via-slate-900 dark:to-slate-950" onmousemove="this.style.setProperty('--mouse-x', event.clientX / window.innerWidth * 100 + '%'); this.style.setProperty('--mouse-y', event.clientY / window.innerHeight * 100 + '%');">
    <div class="flex h-screen backdrop-blur-3xl" x-data="adminApp()">
        <!-- Mobile Overlay -->
        <div x-show="$store.menu.mobileOpen" 
             @click="$store.menu.mobileOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"
             x-cloak>
        </div>
        
        <!-- Sidebar Component -->
        <x-layouts.sidebar />

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            <!-- Header Component -->
            <x-layouts.header :title="$__env->yieldContent('header-title') ?: 'Dashboard'" />

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 pt-20 sm:pt-24 md:pt-28 lg:pt-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function adminApp() {
            return {
                // Dark Mode State
                darkMode: localStorage.theme === 'dark' ||
                    (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),

                // Sidebar State
                sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',

                init() {
                    console.log('Admin App Initialized');
                    console.log('Dark Mode:', this.darkMode);
                    console.log('Sidebar Collapsed:', this.sidebarCollapsed);

                    // Initialize sidebar state
                    this.$nextTick(() => {
                        if (this.sidebarCollapsed) {
                            document.body.classList.add('sidebar-collapsed');
                        } else {
                            document.body.classList.remove('sidebar-collapsed');
                        }
                    });

                    // Watch for system dark mode changes
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                        if (!localStorage.theme) {
                            this.darkMode = e.matches;
                            if (e.matches) {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                        }
                    });
                },

                toggleDarkMode() {
                    console.log('Toggling dark mode');
                    this.darkMode = !this.darkMode;
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                        localStorage.theme = 'dark';
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.theme = 'light';
                    }
                    console.log('Dark Mode after toggle:', this.darkMode);
                },

                toggleSidebar() {
                    console.log('Toggling sidebar');
                    this.sidebarCollapsed = !this.sidebarCollapsed;
                    localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);

                    if (this.sidebarCollapsed) {
                        document.body.classList.add('sidebar-collapsed');
                    } else {
                        document.body.classList.remove('sidebar-collapsed');
                    }
                    console.log('Sidebar Collapsed after toggle:', this.sidebarCollapsed);
                },
                
                toggleMobileMenu() {
                    Alpine.store('menu').toggle();
                }
            }
        }
    </script>

    @stack('scripts')
    @yield('scripts')
    
    @livewireScripts
</body>

</html>
