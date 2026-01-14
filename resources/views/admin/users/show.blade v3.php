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
                        <div
                            class="flex items-center justify-center w-20 h-20 border-2 rounded-full bg-white/20 backdrop-blur-sm border-white/30">
                            <i class="text-2xl fas fa-graduation-cap"></i>
                        </div>
                        <div
                            class="absolute flex items-center justify-center w-6 h-6 bg-green-500 border-2 border-white rounded-full -bottom-1 -right-1">
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
                            <span class="text-blue-200">•</span>
                            <div class="flex items-center space-x-1">
                                <i class="text-green-300 fas fa-user-check"></i>
                                <span class="text-sm">Aktif</span>
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

        <!-- Student Status Badges -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            <!-- Status Aktif -->
            <div class="p-4 bg-white border border-green-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-green-800">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-full dark:bg-green-900/30">
                        <i class="text-green-600 fas fa-user-check dark:text-green-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Status</p>
                        <p class="text-lg font-bold text-green-600 dark:text-green-400">Aktif</p>
                    </div>
                </div>
            </div>

            <!-- Asisten Lab -->
            <div class="p-4 bg-white border border-blue-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-blue-800">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full dark:bg-blue-900/30">
                        <i class="text-blue-600 fas fa-flask dark:text-blue-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Asisten Lab</p>
                        <p class="text-lg font-bold text-blue-600 dark:text-blue-400">Aktif</p>
                    </div>
                </div>
            </div>

            <!-- Pelanggaran -->
            <div class="p-4 bg-white border border-red-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-red-800">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-red-100 rounded-full dark:bg-red-900/30">
                        <i class="text-red-600 fas fa-exclamation-triangle dark:text-red-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pelanggaran</p>
                        <p class="text-lg font-bold text-red-600 dark:text-red-400">0</p>
                    </div>
                </div>
            </div>

            <!-- Prestasi Lomba -->
            <div
                class="p-4 bg-white border border-yellow-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-yellow-800">
                <div class="flex items-center space-x-3">
                    <div
                        class="flex items-center justify-center w-10 h-10 bg-yellow-100 rounded-full dark:bg-yellow-900/30">
                        <i class="text-yellow-600 fas fa-trophy dark:text-yellow-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Lomba</p>
                        <p class="text-lg font-bold text-yellow-600 dark:text-yellow-400">5x</p>
                    </div>
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
                <div
                    class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Skills Akademik & Bahasa</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Tingkat Kemahiran</span>
                    </div>

                    <div class="space-y-4">
                        @foreach ([['name' => 'Pemrograman', 'level' => 85, 'icon' => 'fas fa-code', 'color' => 'blue'], ['name' => 'Desain Grafis', 'level' => 72, 'icon' => 'fas fa-palette', 'color' => 'pink'], ['name' => 'Bahasa Inggris', 'level' => 78, 'icon' => 'fas fa-language', 'color' => 'green'], ['name' => 'Public Speaking', 'level' => 70, 'icon' => 'fas fa-microphone', 'color' => 'purple'], ['name' => 'Algoritma', 'level' => 78, 'icon' => 'fas fa-project-diagram', 'color' => 'indigo'], ['name' => 'Basis Data', 'level' => 82, 'icon' => 'fas fa-database', 'color' => 'orange'], ['name' => 'UI/UX Design', 'level' => 68, 'icon' => 'fas fa-object-group', 'color' => 'red'], ['name' => 'Writing Skills', 'level' => 75, 'icon' => 'fas fa-edit', 'color' => 'teal']] as $skill)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-10 h-10 bg-{{ $skill['color'] }}-100 dark:bg-{{ $skill['color'] }}-900/30 rounded-lg flex items-center justify-center">
                                        <i
                                            class="{{ $skill['icon'] }} text-{{ $skill['color'] }}-600 dark:text-{{ $skill['color'] }}-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $skill['name'] }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Level {{ $skill['level'] }}/100
                                        </p>
                                    </div>
                                </div>
                                <div class="w-24 h-2 bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div class="bg-{{ $skill['color'] }}-600 h-2 rounded-full"
                                        style="width: {{ $skill['level'] }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Riwayat Lomba & Kompetisi -->
                <div
                    class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Riwayat Lomba & Kompetisi</h3>
                        <a href="#"
                            class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="space-y-4">
                        @foreach ([['competition' => 'Hackathon Nasional 2024', 'position' => 'Juara 1', 'category' => 'Programming', 'date' => 'Jan 2024', 'icon' => 'fas fa-trophy', 'color' => 'yellow'], ['competition' => 'UI/UX Design Competition', 'position' => 'Juara 2', 'category' => 'Design', 'date' => 'Mar 2024', 'icon' => 'fas fa-medal', 'color' => 'gray'], ['competition' => 'English Debate Contest', 'position' => 'Finalis', 'category' => 'Public Speaking', 'date' => 'Feb 2024', 'icon' => 'fas fa-microphone', 'color' => 'blue'], ['competition' => 'Data Science Challenge', 'position' => 'Juara 3', 'category' => 'Analytics', 'date' => 'Des 2023', 'icon' => 'fas fa-chart-bar', 'color' => 'green'], ['competition' => 'Web Design Competition', 'position' => 'Peserta', 'category' => 'Web Development', 'date' => 'Nov 2023', 'icon' => 'fas fa-laptop-code', 'color' => 'purple']] as $competition)
                            <div
                                class="flex items-center p-3 space-x-4 transition-colors duration-200 border border-gray-100 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-600">
                                <div
                                    class="w-12 h-12 bg-{{ $competition['color'] }}-100 dark:bg-{{ $competition['color'] }}-900/30 rounded-lg flex items-center justify-center">
                                    <i
                                        class="{{ $competition['icon'] }} text-{{ $competition['color'] }}-600 dark:text-{{ $competition['color'] }}-400"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $competition['competition'] }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $competition['category'] }}</p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-medium bg-{{ $competition['color'] }}-100 dark:bg-{{ $competition['color'] }}-900/30 text-{{ $competition['color'] }}-800 dark:text-{{ $competition['color'] }}-300 rounded-full">
                                        {{ $competition['position'] }}
                                    </span>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $competition['date'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column - Achievements & Additional Info -->
            <div class="space-y-6">
                <!-- Academic Achievements -->
                <div
                    class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pencapaian Akademik</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">12/18</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        @foreach ([['title' => 'Dean List', 'icon' => 'fas fa-award', 'progress' => 100, 'locked' => false], ['title' => 'Asisten Lab', 'icon' => 'fas fa-user-graduate', 'progress' => 100, 'locked' => false], ['title' => 'Research Paper', 'icon' => 'fas fa-file-alt', 'progress' => 75, 'locked' => false], ['title' => 'Juara Lomba', 'icon' => 'fas fa-trophy', 'progress' => 100, 'locked' => false], ['title' => 'Publikasi Jurnal', 'icon' => 'fas fa-book', 'progress' => 30, 'locked' => false], ['title' => 'Cum Laude', 'icon' => 'fas fa-medal', 'progress' => 85, 'locked' => false]] as $achievement)
                            <div
                                class="text-center p-3 rounded-lg border border-gray-200 dark:border-gray-600 {{ $achievement['locked'] ? 'bg-gray-50 dark:bg-gray-700 opacity-60' : 'bg-white dark:bg-gray-800' }}">
                                <div
                                    class="w-12 h-12 mx-auto mb-2 {{ $achievement['locked'] ? 'bg-gray-200 dark:bg-gray-600 text-gray-400' : 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400' }} rounded-full flex items-center justify-center">
                                    <i class="{{ $achievement['icon'] }}"></i>
                                </div>
                                <p class="mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $achievement['title'] }}</p>
                                @if ($achievement['locked'])
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Terkunci</p>
                                @else
                                    <div class="w-full h-1 bg-gray-200 rounded-full dark:bg-gray-700">
                                        <div class="h-1 bg-yellow-500 rounded-full"
                                            style="width: {{ $achievement['progress'] }}%"></div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Detail Asisten Lab -->
                <div
                    class="p-6 bg-white border border-blue-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-blue-800">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Asisten Lab</h3>
                        <span
                            class="px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                            Aktif
                        </span>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Lab Komputer</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Pemrograman</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Semester</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">3 & 4</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Mata Kuliah</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Struktur Data, OOP</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Rating</span>
                            <div class="flex items-center space-x-1">
                                <i class="text-sm text-yellow-400 fas fa-star"></i>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">4.8/5.0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Pelanggaran -->
                <div
                    class="p-6 bg-white border border-green-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-green-800">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Riwayat Pelanggaran</h3>
                        <span
                            class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">
                            Bersih
                        </span>
                    </div>

                    <div class="py-4 text-center">
                        <div
                            class="flex items-center justify-center w-16 h-16 mx-auto mb-3 bg-green-100 rounded-full dark:bg-green-900/30">
                            <i class="text-xl text-green-600 fas fa-check dark:text-green-400"></i>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Tidak ada pelanggaran</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mahasiswa patuh aturan</p>
                    </div>

                    <div
                        class="p-3 mt-4 border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800">
                        <div class="flex items-center space-x-2">
                            <i class="text-blue-500 fas fa-info-circle dark:text-blue-400"></i>
                            <p class="text-sm text-blue-700 dark:text-blue-300">
                                Status aktif dan memenuhi semua kewajiban akademik
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bahasa & Desain Skills -->
                <div
                    class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Skills Khusus</h3>

                    <div class="space-y-4">
                        <!-- Bahasa Inggris -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">Bahasa Inggris</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">TOEFL: 550</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full dark:bg-gray-700">
                                <div class="h-2 bg-green-600 rounded-full" style="width: 78%"></div>
                            </div>
                            <div class="flex justify-between mt-1 text-xs text-gray-500 dark:text-gray-400">
                                <span>Basic</span>
                                <span>Intermediate</span>
                                <span>Advanced</span>
                            </div>
                        </div>

                        <!-- Desain Grafis -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">Desain Grafis</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Tools: Figma, Photoshop</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full dark:bg-gray-700">
                                <div class="h-2 bg-pink-600 rounded-full" style="width: 72%"></div>
                            </div>
                        </div>

                        <!-- Public Speaking -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">Public Speaking</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Debate, Presentation</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full dark:bg-gray-700">
                                <div class="h-2 bg-purple-600 rounded-full" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
            <h3 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">Aksi Cepat</h3>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                <a href="#"
                    class="flex flex-col items-center justify-center p-4 text-white transition-all duration-300 transform bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl hover:from-blue-600 hover:to-purple-600 hover:scale-105">
                    <i class="mb-2 text-2xl fas fa-book-open"></i>
                    <span class="text-sm font-medium">E-Learning</span>
                </a>

                <a href="#"
                    class="flex flex-col items-center justify-center p-4 text-white transition-all duration-300 transform bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl hover:from-green-600 hover:to-emerald-600 hover:scale-105">
                    <i class="mb-2 text-2xl fas fa-tasks"></i>
                    <span class="text-sm font-medium">Tugas</span>
                </a>

                <a href="#"
                    class="flex flex-col items-center justify-center p-4 text-white transition-all duration-300 transform bg-gradient-to-r from-orange-500 to-red-500 rounded-xl hover:from-orange-600 hover:to-red-600 hover:scale-105">
                    <i class="mb-2 text-2xl fas fa-calendar-alt"></i>
                    <span class="text-sm font-medium">Jadwal</span>
                </a>

                <a href="#"
                    class="flex flex-col items-center justify-center p-4 text-white transition-all duration-300 transform bg-gradient-to-r from-gray-600 to-gray-700 rounded-xl hover:from-gray-700 hover:to-gray-800 hover:scale-105">
                    <i class="mb-2 text-2xl fas fa-chart-bar"></i>
                    <span class="text-sm font-medium">Nilai</span>
                </a>
            </div>
        </div>
    </div>
@endsection
