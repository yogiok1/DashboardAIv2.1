@extends('layouts.admin')

@section('title', 'Pengetahuan Lain (Buku)')
@section('header-title', 'Pengetahuan Lain (Buku)')

@section('content')
    <div class="space-y-6">
        <!-- Back Button & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('inputData') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                <i class="mr-2 fas fa-arrow-left"></i>
                Kembali
            </a>
            <nav class="flex mb-3" aria-label="Breadcrumb">
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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Pengetahuan Lain</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Upload Form Card -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center space-x-2">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Unggah Buku (PDF)</h2>
                        <button type="button" class="group relative">
                            <i class="text-gray-400 transition-colors fas fa-question-circle hover:text-primary-500 dark:text-gray-500 dark:hover:text-primary-400"></i>
                            <div class="absolute invisible w-64 p-3 text-xs text-white transition-opacity bg-gray-900 rounded-lg opacity-0 bottom-full left-1/2 -translate-x-1/2 mb-2 group-hover:visible group-hover:opacity-100 z-50">
                                Anda harus upload file pdf buku untuk dipelajari oleh model AI
                                <div class="absolute w-2 h-2 bg-gray-900 transform rotate-45 left-1/2 -translate-x-1/2 -bottom-1"></div>
                            </div>
                        </button>
                    </div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Unggah buku dalam format PDF untuk dijadikan sumber pembelajaran AI</p>
                </div>

                <div class="p-6">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div
                            class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
                            <div class="flex items-center">
                                <i class="mr-2 text-green-500 fas fa-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="p-4 mb-6 text-red-800 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900/30 dark:text-red-400 dark:border-red-800">
                            <ul class="ml-4 list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('external-sources.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-4">
                            <!-- File Upload -->
                            <div>
                                <label for="file_path"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    File Buku (PDF) <span class="text-red-500">*</span>
                                </label>
                                <input type="file" id="file_path" name="file_path" required accept=".pdf"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-primary-900/20 dark:file:text-primary-300">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Hanya file PDF. Ukuran maksimal: 50MB. Nama file akan otomatis menjadi nama buku.
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="px-6 py-2.5 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm transition-colors duration-200 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <i class="mr-2 fas fa-upload"></i>
                                Unggah Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sources List Card -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Buku yang Terunggah</h2>
                        <span class="mt-2 text-sm text-gray-500 sm:mt-0 dark:text-gray-400">
                            Total: {{ $sources->count() }} buku
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-3">
                        @forelse ($sources as $source)
                            <div class="flex items-center justify-between p-4 transition-all duration-200 border border-gray-200 rounded-lg hover:shadow-md dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <div class="flex items-center flex-1 min-w-0 space-x-4">
                                    <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-lg bg-red-100 dark:bg-red-900/30">
                                        <i class="text-xl fas fa-file-pdf text-red-600 dark:text-red-400"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-semibold text-gray-900 truncate dark:text-white">
                                            {{ $source->source_name }}
                                        </h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            <i class="mr-1 fas fa-calendar"></i>
                                            {{ $source->created_at->format('M d, Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center ml-4 space-x-2">
                                    <a href="{{ Storage::url($source->file_path) }}" target="_blank"
                                        class="inline-flex items-center p-2 text-blue-600 transition-all duration-200 rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:bg-blue-900/30"
                                        title="Download File">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <form action="{{ route('external-sources.destroy', $source->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center p-2 text-red-600 transition-all duration-200 rounded-lg bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/30"
                                            title="Delete File">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center py-12">
                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                    <i class="text-2xl text-gray-400 fas fa-book"></i>
                                </div>
                                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Tidak Ada Buku</h3>
                                <p class="text-gray-500 dark:text-gray-400">Unggah buku pertama Anda untuk memulai.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
