@extends('layouts.admin')

@section('title', 'Proses Penilaian')
@section('header-title', 'Proses Penilaian')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 dark:hover:text-white flex items-center">
                    <i class="fas fa-home mr-1"></i> Dashboard
                </a>
                <span class="mx-2">/</span>
                <span class="font-semibold text-gray-900 dark:text-white">Penilaian dengan AI</span>
            </nav>
        </div>

        <!-- Main Testing Cards -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
            <!-- Administrative Test Card -->
            <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-soft flex flex-col h-full transition hover:shadow-lg">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-base font-bold text-gray-800 dark:text-white">Administratif</h2>
                    {{-- <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">Admin Only</span> --}}
                </div>
                <div class="flex-1 flex flex-col p-4">
                    <div class="flex items-center justify-center p-4 mb-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl dark:from-blue-900/20 dark:to-indigo-900/20">
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center w-16 h-16 mb-3 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
                                <i class="text-2xl text-blue-600 fas fa-file-alt dark:text-blue-400"></i>
                            </div>
                            <h3 class="mb-1 text-base font-bold text-gray-900 dark:text-white">Administratif</h3>
                        </div>
                    </div>
                    <div class="flex justify-end mt-auto">
                        <a href="{{ route('tools.test', ['type' => 'administrasi']) }}" class="group relative inline-flex items-center gap-2 px-5 py-2.5 text-white bg-blue-600 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm transition-all duration-200 shadow-md hover:scale-105 overflow-hidden" aria-label="Start Administrative Test"
                           onmousemove="this.style.setProperty('--mouse-x-btn', event.offsetX + 'px'); this.style.setProperty('--mouse-y-btn', event.offsetY + 'px');">
                            <span class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(circle 100px at var(--mouse-x-btn, 50%) var(--mouse-y-btn, 50%), rgba(255, 255, 255, 0.15), transparent 70%);"></span>
                            <i class="fas fa-play-circle relative z-10"></i>
                            <span class="relative z-10">Mulai Penilaian</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Substantif Test Card -->
            <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-soft flex flex-col h-full transition hover:shadow-lg">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="font-bold text-gray-800 dark:text-white">Substantif</h2>
                    {{-- <span class="px-2.5 py-0.5 text-xs font-semibold text-secondary-800 bg-secondary-100 rounded-full dark:bg-secondary-900/30 dark:text-secondary-300">Content Only</span> --}}
                </div>
                <div class="flex-1 flex flex-col p-4">
                    <div class="flex items-center justify-center p-4 mb-4 bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl dark:from-orange-900/20 dark:to-amber-900/20">
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center w-16 h-16 mb-3 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
                                <i class="text-2xl text-orange-600 fas fa-clipboard-check dark:text-orange-400"></i>
                            </div>
                            <h3 class="mb-1 text-base font-bold text-gray-900 dark:text-white">Substantif</h3>
                        </div>
                    </div>
                    <div class="flex justify-end mt-auto">
                        <a href="{{ route('tools.test', ['type' => 'substansi']) }}" class="group relative inline-flex items-center gap-2 px-5 py-2.5 text-white bg-orange-600 focus:ring-4 focus:ring-orange-300 font-semibold rounded-lg text-sm transition-all duration-200 shadow-md hover:scale-105 overflow-hidden" aria-label="Start Substantive Test"
                           onmousemove="this.style.setProperty('--mouse-x-btn', event.offsetX + 'px'); this.style.setProperty('--mouse-y-btn', event.offsetY + 'px');">
                            <span class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(circle 100px at var(--mouse-x-btn, 50%) var(--mouse-y-btn, 50%), rgba(255, 255, 255, 0.15), transparent 70%);"></span>
                            <i class="fas fa-play-circle relative z-10"></i>
                            <span class="relative z-10">Mulai Penilaian</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- All processes Test Card -->
            <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-soft flex flex-col h-full transition hover:shadow-lg">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="font-bold text-gray-800 dark:text-white">Proses Semua</h2>
                    {{-- <span class="px-2.5 py-0.5 text-xs font-semibold text-purple-800 bg-purple-100 rounded-full dark:bg-purple-900/30 dark:text-purple-300">Gabungan</span> --}}
                </div>
                <div class="flex-1 flex flex-col p-4">
                    <div class="flex items-center justify-center p-4 mb-4 bg-gradient-to-br from-purple-50 to-violet-50 rounded-xl dark:from-purple-900/20 dark:to-violet-900/20">
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center w-16 h-16 mb-3 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
                                <i class="text-2xl text-purple-600 fas fa-layer-group dark:text-purple-400"></i>
                            </div>
                            <h3 class="mb-1 text-base font-bold text-gray-900 dark:text-white">Proses Semua</h3>
                        </div>
                    </div>
                    <div class="flex justify-end mt-auto">
                        <a href="{{ route('tools.test', ['type' => 'gabungan_naive']) }}" class="group relative inline-flex items-center gap-2 px-5 py-2.5 text-white bg-purple-600 focus:ring-4 focus:ring-purple-300 font-semibold rounded-lg text-sm transition-all duration-200 shadow-md hover:scale-105 overflow-hidden" aria-label="Start All processes Test"
                           onmousemove="this.style.setProperty('--mouse-x-btn', event.offsetX + 'px'); this.style.setProperty('--mouse-y-btn', event.offsetY + 'px');">
                            <span class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(circle 100px at var(--mouse-x-btn, 50%) var(--mouse-y-btn, 50%), rgba(255, 255, 255, 0.15), transparent 70%);"></span>
                            <i class="fas fa-play-circle relative z-10"></i>
                            <span class="relative z-10">Mulai Penilaian</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- All processes selected Test Card -->
            <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-soft flex flex-col h-full transition hover:shadow-lg">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="font-bold text-gray-800 dark:text-white">Proses Semua dengan Filter</h2>
                    {{-- <span class="px-2.5 py-0.5 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">Filtered</span> --}}
                </div>
                <div class="flex-1 flex flex-col p-4">
                    <div class="flex items-center justify-center p-4 mb-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl dark:from-green-900/20 dark:to-emerald-900/20">
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center w-16 h-16 mb-3 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
                                <i class="text-2xl text-green-600 fas fa-filter dark:text-green-400"></i>
                            </div>
                            <h3 class="mb-1 text-base font-bold text-gray-900 dark:text-white">Proses Semua dengan Filter</h3>
                        </div>
                    </div>
                    <div class="flex justify-end mt-auto">
                        <a href="{{ route('tools.test', ['type' => 'gabungan_selected']) }}" class="group relative inline-flex items-center gap-2 px-5 py-2.5 text-white bg-green-600 focus:ring-4 focus:ring-green-300 font-semibold rounded-lg text-sm transition-all duration-200 shadow-md hover:scale-105 overflow-hidden" aria-label="Start All processes selected Test"
                           onmousemove="this.style.setProperty('--mouse-x-btn', event.offsetX + 'px'); this.style.setProperty('--mouse-y-btn', event.offsetY + 'px');">
                            <span class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(circle 100px at var(--mouse-x-btn, 50%) var(--mouse-y-btn, 50%), rgba(255, 255, 255, 0.15), transparent 70%);"></span>
                            <i class="fas fa-play-circle relative z-10"></i>
                            <span class="relative z-10">Mulai Penilaian</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Penjelasan Fitur -->
        <div class="mt-10 rounded-2xl border border-gray-200/50 bg-white/80 backdrop-blur-sm p-4 dark:border-gray-700/50 dark:bg-gray-800/80 shadow-soft">
            <h4 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">
                Penjelasan Fitur
            </h4>

            <div class="space-y-6">
                <!-- Item Administratif -->
                <div class="flex items-start gap-4">
                    <div class="flex items-center justify-center w-12 aspect-square flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                        <i class="fas fa-file-alt text-xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                        <h5 class="text-base font-semibold text-gray-900 dark:text-white">
                            Administratif
                        </h5>
                        <p class="mt-1 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            Menilai persyaratan administratif dan kelengkapan dokumen proposal.
                        </p>
                    </div>
                </div>

                <!-- Item Substantif -->
                <div class="flex items-start gap-4">
                    <div class="flex items-center justify-center w-12 aspect-square flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                        <i class="fas fa-clipboard-check text-xl text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <div>
                        <h5 class="text-base font-semibold text-gray-900 dark:text-white">
                            Substantif
                        </h5>
                        <p class="mt-1 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            Menilai kualitas konten dan substansi isi proposal penelitian.
                        </p>
                    </div>
                </div>

                <!-- Item Proses Semua -->
                <div class="flex items-start gap-4">
                    <div class="flex items-center justify-center w-12 aspect-square flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                        <i class="fas fa-layer-group text-xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div>
                        <h5 class="text-base font-semibold text-gray-900 dark:text-white">
                            Proses Semua
                        </h5>
                        <p class="mt-1 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            Penilaian gabungan administratif dan substantif secara bersamaan tanpa melakukan filter proposal (keseluruhan proposal).
                        </p>
                    </div>
                </div>

                <!-- Item Semua Proses dengan Filter -->
                <div class="flex items-start gap-4">
                    <div class="flex items-center justify-center w-12 aspect-square flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                        <i class="fas fa-filter text-xl text-green-600 dark:text-green-400"></i>
                    </div>
                    <div>
                        <h5 class="text-base font-semibold text-gray-900 dark:text-white">
                            Proses Semua dengan Filter
                        </h5>
                        <p class="mt-1 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            Penilaian gabungan administratif dan substantif dengan melakukan filter proposal (hanya proposal yang lolos seleksi administrasi).
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
