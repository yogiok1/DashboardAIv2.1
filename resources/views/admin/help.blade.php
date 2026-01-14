@extends('layouts.admin')

@section('title', 'Help - User Guide')
@section('header-title', 'Panduan Pengguna')

@section('content')
    <div class="space-y-8">

        <!-- PDF Viewer Container -->
        <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-soft overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                        <i class="fas fa-file-pdf text-red-600 mr-2"></i>
                        Guideline Book.pdf
                    </h2>
                    <a href="{{ asset('Guideline Book.pdf') }}" 
                       download="Guideline Book.pdf"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg text-sm transition-all duration-200">
                        <i class="fas fa-download"></i>
                        <span>Download PDF</span>
                    </a>
                </div>

                <!-- PDF Embed/Object -->
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden" style="min-height: 800px;">
                    <object 
                        data="{{ asset('Guideline Book.pdf') }}" 
                        type="application/pdf" 
                        width="100%" 
                        height="800px"
                        class="w-full">
                        <div class="flex flex-col items-center justify-center p-8 bg-gray-50 dark:bg-gray-900" style="min-height: 800px;">
                            <i class="fas fa-file-pdf text-6xl text-gray-400 dark:text-gray-600 mb-4"></i>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                Browser Anda tidak mendukung tampilan PDF secara langsung.
                            </p>
                            <a href="{{ asset('Guideline Book.pdf') }}" 
                               download="Guideline Book.pdf"
                               class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all duration-200">
                                <i class="fas fa-download"></i>
                                <span>Download PDF untuk melihat</span>
                            </a>
                        </div>
                    </object>
                </div>

                <!-- Alternative: iframe fallback -->
                <noscript>
                    <iframe 
                        src="{{ asset('Guideline Book.pdf') }}" 
                        width="100%" 
                        height="800px" 
                        class="border border-gray-200 dark:border-gray-700 rounded-lg mt-4">
                    </iframe>
                </noscript>
            </div>
        </div>
    </div>
@endsection
