@extends('layouts.admin')

@section('title', 'Student Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex justify-end mb-3" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-500 transition-colors duration-200 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white">
                        <i class="mr-2 fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Student Dashboard</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Student Profile Header -->
        <div class="p-6 text-white shadow-lg bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="flex items-center justify-center w-20 h-20 border-2 rounded-full bg-white/20 backdrop-blur-sm border-white/30">
                            <i class="text-2xl fas fa-graduation-cap"></i>
                        </div>
                        <div class="absolute flex items-center justify-center w-6 h-6 bg-green-500 border-2 border-white rounded-full -bottom-1 -right-1">
                            <i class="text-xs fas fa-star"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Mahasiswa Berprestasi</h1>
                        <p class="text-blue-100">Semester 6 • Teknik Informatika</p>
                        <div class="flex items-center mt-1 space-x-2">
                            <div class="flex items-center space-x-1">
                                <i class="text-yellow-300 fas fa-university"></i>
                                <span class="text-sm">IPK 3.85</span>
                            </div>
                            <span class="text-blue-200">•</span>
                            <div class="flex items-center space-x-1">
                                <i class="text-yellow-400 fas fa-award"></i>
                                <span class="text-sm">15 Sertifikat</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">142</div>
                    <div class="text-blue-100">Total SKS</div>
                </div>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- IPK -->
            <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">IPK</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">3.85</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-lg dark:bg-green-900/30">
                        <i class="text-xl text-green-600 fas fa-chart-line dark:text-green-400"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-sm font-medium text-green-600 dark:text-green-400">
                        <i class="mr-1 fas fa-arrow-up"></i>0.12
                    </span>
                    <span class="ml-1 text-sm text-gray-500 dark:text-gray-400">from last semester</span>
                </div>
            </div>

            <!-- SKS Completed -->
            <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">SKS</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">142/144</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                        <i class="text-xl text-blue-600 fas fa-book dark:text-blue-400"></i>
                    </div>
                </div>
                <div class="w-full h-2 mt-3 bg-gray-200 rounded-full dark:bg-gray-700">
                    <div class="h-2 bg-blue-600 rounded-full" style="width: 98%"></div>
                </div>
            </div>

            <!-- Attendance Rate -->
            <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Kehadiran</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">94%</p>
                    </div>
                    <div class="p-3 bg-orange-100 rounded-lg dark:bg-orange-900/30">
                        <i class="text-xl text-orange-600 fas fa-user-check dark:text-orange-400"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-sm font-medium text-green-600 dark:text-green-400">
                        <i class="mr-1 fas fa-trending-up"></i>3%
                    </span>
                    <span class="ml-1 text-sm text-gray-500 dark:text-gray-400">improvement</span>
                </div>
            </div>

            <!-- Assignment Completion -->
            <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tugas</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">45/48</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-lg dark:bg-purple-900/30">
                        <i class="text-xl text-purple-600 fas fa-tasks dark:text-purple-400"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-sm font-medium text-green-600 dark:text-green-400">
                        <i class="mr-1 fas fa-check-circle"></i>93%
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Left Column - Skills & Academic Progress -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Academic Skills Progress -->
                <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Skills Akademik</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Tingkat Kemahiran</span>
                    </div>

                    <div class="space-y-4">
                        @foreach([
                            ['name' => 'Pemrograman', 'level' => 85, 'icon' => 'fas fa-code', 'color' => 'blue'],
                            ['name' => 'Algoritma', 'level' => 78, 'icon' => 'fas fa-project-diagram', 'color' => 'purple'],
                            ['name' => 'Basis Data', 'level' => 82, 'icon' => 'fas fa-database', 'color' => 'green'],
                            ['name' => 'Jaringan Komputer', 'level' => 75, 'icon' => 'fas fa-network-wired', 'color' => 'orange'],
                            ['name' => 'Kecerdasan Buatan', 'level' => 68, 'icon' => 'fas fa-robot', 'color' => 'red'],
                            ['name' => 'Matematika Diskrit', 'level' => 80, 'icon' => 'fas fa-calculator', 'color' => 'yellow'],
                        ] as $skill)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-{{ $skill['color'] }}-100 dark:bg-{{ $skill['color'] }}-900/30 rounded-lg flex items-center justify-center">
                                    <i class="{{ $skill['icon'] }} text-{{ $skill['color'] }}-600 dark:text-{{ $skill['color'] }}-400"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $skill['name'] }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Level {{ $skill['level'] }}/100</p>
                                </div>
                            </div>
                            <div class="w-24 h-2 bg-gray-200 rounded-full dark:bg-gray-700">
                                <div class="bg-{{ $skill['color'] }}-600 h-2 rounded-full" style="width: {{ $skill['level'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Academic Activity -->
                <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Aktivitas Terkini</h3>
                        <a href="#" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="space-y-4">
                        @foreach([
                            ['action' => 'Tugas Selesai', 'title' => 'Pemrograman Web - Project Final', 'points' => 'A', 'time' => '2 jam lalu', 'icon' => 'fas fa-check-circle', 'color' => 'green'],
                            ['action' => 'Kuis', 'title' => 'Algoritma & Struktur Data', 'points' => '85%', 'time' => '1 hari lalu', 'icon' => 'fas fa-pencil-alt', 'color' => 'blue'],
                            ['action' => 'Presentasi', 'title' => 'Sistem Basis Data', 'points' => 'A-', 'time' => '2 hari lalu', 'icon' => 'fas fa-chalkboard-teacher', 'color' => 'purple'],
                            ['action' => 'Praktikum', 'title' => 'Jaringan Komputer Lab', 'points' => 'Selesai', 'time' => '3 hari lalu', 'icon' => 'fas fa-flask', 'color' => 'orange'],
                            ['action' => 'Partisipasi', 'title' => 'Diskusi Kelas AI', 'points' => '+5', 'time' => '1 minggu lalu', 'icon' => 'fas fa-comments', 'color' => 'red'],
                        ] as $activity)
                        <div class="flex items-center p-3 space-x-4 transition-colors duration-200 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div class="w-10 h-10 bg-{{ $activity['color'] }}-100 dark:bg-{{ $activity['color'] }}-900/30 rounded-lg flex items-center justify-center">
                                <i class="{{ $activity['icon'] }} text-{{ $activity['color'] }}-600 dark:text-{{ $activity['color'] }}-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-white">{{ $activity['action'] }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $activity['title'] }}</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm font-medium text-green-600 dark:text-green-400">{{ $activity['points'] }}</span>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column - Achievements & Resources -->
            <div class="space-y-6">
                <!-- Academic Achievements -->
                <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pencapaian Akademik</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">12/18</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        @foreach([
                            ['title' => 'Dean List', 'icon' => 'fas fa-award', 'progress' => 100, 'locked' => false],
                            ['title' => 'Asisten Lab', 'icon' => 'fas fa-user-graduate', 'progress' => 100, 'locked' => false],
                            ['title' => 'Research Paper', 'icon' => 'fas fa-file-alt', 'progress' => 75, 'locked' => false],
                            ['title' => 'Juara Lomba', 'icon' => 'fas fa-trophy', 'progress' => 60, 'locked' => false],
                            ['title' => 'Publikasi Jurnal', 'icon' => 'fas fa-book', 'progress' => 30, 'locked' => false],
                            ['title' => 'Cum Laude', 'icon' => 'fas fa-medal', 'progress' => 85, 'locked' => false],
                        ] as $achievement)
                        <div class="text-center p-3 rounded-lg border border-gray-200 dark:border-gray-600 {{ $achievement['locked'] ? 'bg-gray-50 dark:bg-gray-700 opacity-60' : 'bg-white dark:bg-gray-800' }}">
                            <div class="w-12 h-12 mx-auto mb-2 {{ $achievement['locked'] ? 'bg-gray-200 dark:bg-gray-600 text-gray-400' : 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400' }} rounded-full flex items-center justify-center">
                                <i class="{{ $achievement['icon'] }}"></i>
                            </div>
                            <p class="mb-1 text-sm font-medium text-gray-900 dark:text-white">{{ $achievement['title'] }}</p>
                            @if($achievement['locked'])
                                <p class="text-xs text-gray-500 dark:text-gray-400">Terkunci</p>
                            @else
                                <div class="w-full h-1 bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div class="h-1 bg-yellow-500 rounded-full" style="width: {{ $achievement['progress'] }}%"></div>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Study Resources -->
                <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Sumber Belajar</h3>

                    <div class="grid grid-cols-2 gap-3">
                        @foreach([
                            ['name' => 'E-Book', 'count' => 24, 'icon' => 'fas fa-book', 'color' => 'blue'],
                            ['name' => 'Slide PPT', 'count' => 18, 'icon' => 'fas fa-file-powerpoint', 'color' => 'orange'],
                            ['name' => 'Video Tutorial', 'count' => 35, 'icon' => 'fas fa-video', 'color' => 'red'],
                            ['name' => 'Latihan Soal', 'count' => 42, 'icon' => 'fas fa-edit', 'color' => 'green'],
                            ['name' => 'Research Paper', 'count' => 15, 'icon' => 'fas fa-file-alt', 'color' => 'purple'],
                            ['name' => 'Code Example', 'count' => 28, 'icon' => 'fas fa-code', 'color' => 'yellow'],
                        ] as $resource)
                        <div class="p-3 text-center border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <div class="w-10 h-10 mx-auto mb-2 bg-{{ $resource['color'] }}-100 dark:bg-{{ $resource['color'] }}-900/30 rounded-lg flex items-center justify-center">
                                <i class="{{ $resource['icon'] }} text-{{ $resource['color'] }}-600 dark:text-{{ $resource['color'] }}-400"></i>
                            </div>
                            <p class="mb-1 text-xs font-medium text-gray-900 dark:text-white">{{ $resource['name'] }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $resource['count'] }} files</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Upcoming Deadlines -->
                <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Deadline Mendatang</h3>

                    <div class="space-y-3">
                        @foreach([
                            ['title' => 'Tugas Akhir PW', 'time' => '2 hari lagi', 'priority' => 'Tinggi', 'icon' => 'fas fa-exclamation-triangle'],
                            ['title' => 'UTS Algoritma', 'time' => '5 hari lagi', 'priority' => 'Sedang', 'icon' => 'fas fa-clipboard-list'],
                            ['title' => 'Laporan Praktikum', 'time' => '1 minggu lagi', 'priority' => 'Rendah', 'icon' => 'fas fa-file-signature'],
                        ] as $deadline)
                        @php
                            $priorityColor = [
                                'Tinggi' => 'red',
                                'Sedang' => 'orange',
                                'Rendah' => 'green'
                            ][$deadline['priority']];
                        @endphp
                        <div class="flex items-center space-x-3 p-3 bg-{{ $priorityColor }}-50 dark:bg-{{ $priorityColor }}-900/20 rounded-lg border border-{{ $priorityColor }}-200 dark:border-{{ $priorityColor }}-800">
                            <div class="w-8 h-8 bg-{{ $priorityColor }}-100 dark:bg-{{ $priorityColor }}-800 rounded-full flex items-center justify-center">
                                <i class="{{ $deadline['icon'] }} text-{{ $priorityColor }}-600 dark:text-{{ $priorityColor }}-400 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $deadline['title'] }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $deadline['time'] }}</p>
                            </div>
                            <span class="text-xs font-medium text-{{ $priorityColor }}-600 dark:text-{{ $priorityColor }}-400">{{ $deadline['priority'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Soft Skills Development -->
        <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
            <h3 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">Pengembangan Soft Skills</h3>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach([
                    ['skill' => 'Public Speaking', 'level' => 70, 'icon' => 'fas fa-microphone', 'color' => 'purple'],
                    ['skill' => 'Teamwork', 'level' => 85, 'icon' => 'fas fa-users', 'color' => 'green'],
                    ['skill' => 'Leadership', 'level' => 65, 'icon' => 'fas fa-flag', 'color' => 'blue'],
                    ['skill' => 'Time Management', 'level' => 80, 'icon' => 'fas fa-clock', 'color' => 'orange'],
                ] as $softSkill)
                <div class="p-4 text-center border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <div class="w-12 h-12 mx-auto mb-3 bg-{{ $softSkill['color'] }}-100 dark:bg-{{ $softSkill['color'] }}-900/30 rounded-full flex items-center justify-center">
                        <i class="{{ $softSkill['icon'] }} text-{{ $softSkill['color'] }}-600 dark:text-{{ $softSkill['color'] }}-400"></i>
                    </div>
                    <h4 class="mb-2 font-medium text-gray-900 dark:text-white">{{ $softSkill['skill'] }}</h4>
                    <div class="w-full h-2 mb-2 bg-gray-200 rounded-full dark:bg-gray-600">
                        <div class="bg-{{ $softSkill['color'] }}-600 h-2 rounded-full" style="width: {{ $softSkill['level'] }}%"></div>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Level {{ $softSkill['level'] }}/100</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
            <h3 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">Aksi Cepat</h3>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                <a href="#" class="flex flex-col items-center justify-center p-4 text-white transition-all duration-300 transform bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl hover:from-blue-600 hover:to-purple-600 hover:scale-105">
                    <i class="mb-2 text-2xl fas fa-book-open"></i>
                    <span class="text-sm font-medium">E-Learning</span>
                </a>

                <a href="#" class="flex flex-col items-center justify-center p-4 text-white transition-all duration-300 transform bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl hover:from-green-600 hover:to-emerald-600 hover:scale-105">
                    <i class="mb-2 text-2xl fas fa-tasks"></i>
                    <span class="text-sm font-medium">Tugas</span>
                </a>

                <a href="#" class="flex flex-col items-center justify-center p-4 text-white transition-all duration-300 transform bg-gradient-to-r from-orange-500 to-red-500 rounded-xl hover:from-orange-600 hover:to-red-600 hover:scale-105">
                    <i class="mb-2 text-2xl fas fa-calendar-alt"></i>
                    <span class="text-sm font-medium">Jadwal</span>
                </a>

                <a href="#" class="flex flex-col items-center justify-center p-4 text-white transition-all duration-300 transform bg-gradient-to-r from-gray-600 to-gray-700 rounded-xl hover:from-gray-700 hover:to-gray-800 hover:scale-105">
                    <i class="mb-2 text-2xl fas fa-chart-bar"></i>
                    <span class="text-sm font-medium">Nilai</span>
                </a>
            </div>
        </div>
    </div>
@endsection
