@extends('layouts.admin')

@section('title', 'Halaman Utama')
@section('header-title', 'Dashboard')

@section('content')
    <div class="space-y-8">

        <!-- Main Description -->
        <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-soft">
            <div class="p-6">
                <div class="flex items-start gap-6 mb-6">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl shadow-lg">
                            <i class="fas fa-robot text-4xl text-white"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                            Tentang Sistem
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Dashboard AI adalah platform inovatif yang dirancang untuk membantu proses penilaian proposal penelitian secara otomatis menggunakan teknologi Artificial Intelligence. Sistem ini memberikan Penilaian yang objektif, konsisten, dan efisien terhadap proposal-proposal yang diajukan.
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">
                        Fitur Utama - Skema Penilaian
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Administratif -->
                        <div class="flex items-start gap-4 p-5 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl hover:shadow-md transition-all">
                            <div class="flex items-center justify-center w-12 h-12 flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                                <i class="fas fa-file-alt text-xl text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white mb-1">Administratif</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Menilai persyaratan administratif dan kelengkapan dokumen proposal</p>
                            </div>
                        </div>
                        
                        <!-- Substantif -->
                        <div class="flex items-start gap-4 p-5 bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 rounded-xl hover:shadow-md transition-all">
                            <div class="flex items-center justify-center w-12 h-12 flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                                <i class="fas fa-clipboard-check text-xl text-orange-600 dark:text-orange-400"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white mb-1">Substantif</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Menilai kualitas konten dan substansi isi proposal penelitian</p>
                            </div>
                        </div>
                        
                        <!-- Proses Semua -->
                        <div class="flex items-start gap-4 p-5 bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 rounded-xl hover:shadow-md transition-all">
                            <div class="flex items-center justify-center w-12 h-12 flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                                <i class="fas fa-layer-group text-xl text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white mb-1">Proses Semua</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Penilaian gabungan administratif dan substantif secara bersamaan tanpa melakukan filter proposal (keseluruhan proposal)</p>
                            </div>
                        </div>
                        
                        <!-- Proses Semua dengan Filter -->
                        <div class="flex items-start gap-4 p-5 bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl hover:shadow-md transition-all">
                            <div class="flex items-center justify-center w-12 h-12 flex-shrink-0 bg-white shadow-md rounded-2xl dark:bg-gray-700">
                                <i class="fas fa-filter text-xl text-green-600 dark:text-green-400"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white mb-1">Proses Semua dengan Filter</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Penilaian gabungan administratif dan substantif dengan melakukan filter proposal (hanya proposal yang lolos seleksi administrasi)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
            <a href="{{ route('inputData') }}" class="group block">
                <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-soft transition-all hover:shadow-lg hover:scale-[1.02]">
                    <div class="p-6">
                        <div class="flex items-center justify-center p-4 mb-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl dark:from-blue-900/20 dark:to-indigo-900/20">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center justify-center w-16 h-16 mb-3 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
                                    <i class="fas fa-database text-2xl text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">Masukan Data</h3>
                            </div>
                        </div>
                        <p class="text-sm text-center text-gray-600 dark:text-gray-400">
                            Upload dan kelola data proposal yang akan dinilai
                        </p>
                    </div>
                </div>
            </a>

            <a href="{{ route('tools') }}" class="group block">
                <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-soft transition-all hover:shadow-lg hover:scale-[1.02]">
                    <div class="p-6">
                        <div class="flex items-center justify-center p-4 mb-4 bg-gradient-to-br from-purple-50 to-violet-50 rounded-xl dark:from-purple-900/20 dark:to-violet-900/20">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center justify-center w-16 h-16 mb-3 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
                                    <i class="fas fa-sliders-h text-2xl text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">Proses Penilaian</h3>
                            </div>
                        </div>
                        <p class="text-sm text-center text-gray-600 dark:text-gray-400">
                            Jalankan proses penilaian terhadap proposal
                        </p>
                    </div>
                </div>
            </a>

            <a href="{{ route('results.index') }}" class="group block">
                <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-soft transition-all hover:shadow-lg hover:scale-[1.02]">
                    <div class="p-6">
                        <div class="flex items-center justify-center p-4 mb-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl dark:from-green-900/20 dark:to-emerald-900/20">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center justify-center w-16 h-16 mb-3 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
                                    <i class="fas fa-chart-bar text-2xl text-green-600 dark:text-green-400"></i>
                                </div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">Hasil Penilaian</h3>
                            </div>
                        </div>
                        <p class="text-sm text-center text-gray-600 dark:text-gray-400">
                            Lihat dan analisis hasil penilaian proposal
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
