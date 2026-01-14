@extends('layouts.admin')

@section('title', 'Pusat Masukan Data')
@section('header-title', 'Masukan Data')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <!-- Breadcrumb -->
            <nav class="flex justify-end mb-3" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                            <i class="mr-2 fas fa-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Masukan Data</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Main Input Cards -->
        <div class="flex justify-center">
        <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Input Rubrik & Template Card -->
            <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 shadow-soft dark:bg-gray-800/80 rounded-2xl dark:border-gray-700/50 flex flex-col">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex-shrink-0">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-semibold text-gray-800 dark:text-white">Masukkan Rubrik & Template</h2>
                    </div>
                </div>

                <div class="p-4 flex-1 flex flex-col">
                    <div
                        class="flex items-center justify-center p-6 mb-4 min-h-[140px] bg-gradient-to-br from-secondary-50 to-secondary-100 rounded-xl dark:from-secondary-900/20 dark:to-secondary-800/20">
                        <div class="text-center">
                            <div
                                class="flex items-center justify-center w-14 h-14 mx-auto mb-3 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                                <i class="text-2xl text-secondary-600 fas fa-clipboard-list dark:text-secondary-400"></i>
                            </div>
                            <h3 class="mb-3 text-base font-bold text-gray-900 dark:text-white">Manajemen Rubrik & Template</h3>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 mt-auto">
                        <a href="{{ route('rubrics.index') }}"
                            class="group relative inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-secondary-600 focus:ring-4 focus:ring-secondary-300 font-medium rounded-lg transition-all duration-200 shadow-sm hover:scale-105 overflow-hidden"
                            onmousemove="this.style.setProperty('--mouse-x-btn', event.offsetX + 'px'); this.style.setProperty('--mouse-y-btn', event.offsetY + 'px');">
                            <span class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(circle 100px at var(--mouse-x-btn, 50%) var(--mouse-y-btn, 50%), rgba(255, 255, 255, 0.15), transparent 70%);"></span>
                            <i class="fas fa-arrow-right relative z-10"></i>
                            <span class="relative z-10">Mulai Memasukkan Data</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Input Group Proposal Card -->
            <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 shadow-soft dark:bg-gray-800/80 rounded-2xl dark:border-gray-700/50 flex flex-col">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex-shrink-0">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-semibold text-gray-800 dark:text-white">Masukkan Grup Proposal</h2>
                    </div>
                </div>

                <div class="p-4 flex-1 flex flex-col">
                    <div
                        class="flex items-center justify-center p-6 mb-4 min-h-[140px] bg-gradient-to-br from-primary-50 to-primary-100 rounded-xl dark:from-primary-900/20 dark:to-primary-800/20">
                        <div class="text-center">
                            <div
                                class="flex items-center justify-center w-14 h-14 mx-auto mb-3 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                                <i class="text-2xl text-primary-600 fas fa-folder-open dark:text-primary-400"></i>
                            </div>
                            <h3 class="mb-1 text-base font-bold text-gray-900 dark:text-white">Manajemen Proposal</h3>
                        </div>
                    </div>

                    <form id="proposalForm" class="mt-auto">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('proposal-groups.index') }}"
                                class="group relative inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-primary-600 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg transition-all duration-200 shadow-sm hover:scale-105 overflow-hidden"
                                onmousemove="this.style.setProperty('--mouse-x-btn', event.offsetX + 'px'); this.style.setProperty('--mouse-y-btn', event.offsetY + 'px');">
                                <span class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(circle 100px at var(--mouse-x-btn, 50%) var(--mouse-y-btn, 50%), rgba(255, 255, 255, 0.15), transparent 70%);"></span>
                                <i class="fas fa-arrow-right relative z-10"></i>
                                <span class="relative z-10">Mulai Memasukkan Data</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Input Lainnya (Opsional) Card -->
            <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 shadow-soft dark:bg-gray-800/80 rounded-2xl dark:border-gray-700/50 flex flex-col">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex-shrink-0">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-semibold text-gray-800 dark:text-white">Masukkan Lainnya (Opsional)</h2>
                    </div>
                </div>

                <div class="p-4 flex-1 flex flex-col">
                    <div
                        class="flex items-center justify-center p-6 mb-4 min-h-[140px] bg-gradient-to-br from-accent-50 to-accent-100 rounded-xl dark:from-accent-900/20 dark:to-accent-800/20">
                        <div class="text-center">
                            <div
                                class="flex items-center justify-center w-14 h-14 mx-auto mb-3 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                                <i class="text-2xl text-accent-600 fas fa-book dark:text-accent-400"></i>
                            </div>
                            <h3 class="mb-1 text-base font-bold text-gray-900 dark:text-white">Pengetahuan Lain</h3>
                        </div>
                    </div>

                    <form id="extraForm" class="mt-auto">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('external-sources.index') }}"
                                class="group relative inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-accent-600 focus:ring-4 focus:ring-accent-300 font-medium rounded-lg transition-all duration-200 shadow-sm hover:scale-105 overflow-hidden"
                                onmousemove="this.style.setProperty('--mouse-x-btn', event.offsetX + 'px'); this.style.setProperty('--mouse-y-btn', event.offsetY + 'px');">
                                <span class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: radial-gradient(circle 100px at var(--mouse-x-btn, 50%) var(--mouse-y-btn, 50%), rgba(255, 255, 255, 0.15), transparent 70%);"></span>
                                <i class="fas fa-arrow-right relative z-10"></i>
                                <span class="relative z-10">Mulai Memasukkan Data</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Penjelasan Fitur -->
        <div class="mt-10 rounded-2xl border border-gray-200/50 bg-white/80 backdrop-blur-sm p-6 dark:border-gray-700/50 dark:bg-gray-800/80">

        <h4 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">
            Penjelasan Fitur
        </h4>

        <div class="space-y-6">

            <!-- Item 1 - Rubrik & Template -->
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center w-12 aspect-square flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                    <i class="fas fa-clipboard-list text-xl text-secondary-600 dark:text-secondary-400"></i>
                </div>

                <div>
                    <h5 class="text-base font-semibold text-gray-900 dark:text-white">
                        Manajemen Rubrik & Template
                    </h5>
                    <p class="mt-1 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                        Halaman ini digunakan untuk mengunggah rubrik dan template proposal. Rubrik berisi poin-poin penilaian yang akan digunakan oleh model AI untuk menilai proposal secara objektif dan konsisten. Template proposal berfungsi sebagai acuan indikator penilaian.
                    </p>
                </div>
            </div>

            <!-- Item 2 - Proposal -->
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center w-12 aspect-square flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                    <i class="fas fa-folder-open text-xl text-primary-600 dark:text-primary-400"></i>
                </div>

                <div>
                    <h5 class="text-base font-semibold text-gray-900 dark:text-white">
                        Manajemen Grup Proposal
                    </h5>
                    <p class="mt-1 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                        Halaman ini digunakan untuk mengunggah folder berisi kumpulan proposal dalam format PDF. Proposal yang diunggah dapat berupa data pelatihan untuk melatih model AI atau proposal baru yang akan dinilai. Sistem akan mengelompokkan proposal berdasarkan skema Penilaian dan tahun yang dipilih.
                    </p>
                </div>
            </div>

            <!-- Item 3 - Pengetahuan Lain -->
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center w-12 aspect-square flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                    <i class="fas fa-book text-xl text-accent-600 dark:text-accent-400"></i>
                </div>

                <div>
                    <h5 class="text-base font-semibold text-gray-900 dark:text-white">
                        Pengetahuan Lain (Opsional)
                    </h5>
                    <p class="mt-1 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                        Bagian ini bersifat opsional dan digunakan untuk mengunggah buku referensi atau sumber pengetahuan eksternal dalam format PDF. Dokumen-dokumen ini akan dijadikan sebagai bahan pembelajaran tambahan bagi model AI untuk meningkatkan pemahaman konteks dan kualitas penilaian proposal.
                    </p>
                </div>
            </div>

        </div>
        </div>



        {{-- <!-- Quick Actions -->
        <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Quick Actions</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <a href="{{ route('proposal-groups.index') }}"
                    class="flex flex-col items-center p-6 transition-all duration-200 rounded-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 group">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-4 bg-blue-100 rounded-2xl dark:bg-blue-900/30">
                        <i class="text-2xl text-blue-600 fas fa-file-upload dark:text-blue-400"></i>
                    </div>
                    <h4 class="mb-2 font-semibold text-gray-900 dark:text-white">Batch Upload</h4>
                    <p class="text-sm text-center text-gray-600 dark:text-gray-300">Upload multiple proposals at once</p>
                    <i class="mt-3 text-gray-400 transition-transform duration-200 fas fa-arrow-right group-hover:translate-x-1"></i>
                </a>
                
                <a href="{{ route('rubrics.index') }}"
                    class="flex flex-col items-center p-6 transition-all duration-200 rounded-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 group">
                    <div
                    class="flex items-center justify-center w-16 h-16 mb-4 bg-orange-100 rounded-2xl dark:bg-orange-900/30">
                    <i class="text-2xl text-orange-600 fas fa-book-open dark:text-orange-400"></i>
                    </div>
                    <h4 class="mb-2 font-semibold text-gray-900 dark:text-white">Rubric Library</h4>
                    <p class="text-sm text-center text-gray-600 dark:text-gray-300">Browse existing rubric templates</p>
                    <i class="mt-3 text-gray-400 transition-transform duration-200 fas fa-arrow-right group-hover:translate-x-1"></i>
                </a>
            
                <a href="{{ route('external-sources.index') }}"
                    class="flex flex-col items-center p-6 transition-all duration-200 rounded-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 group">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-4 bg-purple-100 rounded-2xl dark:bg-purple-900/30">
                        <i class="text-2xl text-purple-600 fas fa-book dark:text-purple-400"></i>
                    </div>
                    <h4 class="mb-2 font-semibold text-gray-900 dark:text-white">Pengetahuan Lain (Buku)</h4>
                    <p class="text-sm text-center text-gray-600 dark:text-gray-300">Upload buku PDF untuk AI training</p>
                    <i class="mt-3 text-gray-400 transition-transform duration-200 fas fa-arrow-right group-hover:translate-x-1"></i>
                </a>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')

@endpush
