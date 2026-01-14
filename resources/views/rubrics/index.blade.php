@extends('layouts.admin')

@section('title', 'Rubrik & Template Proposal')
@section('header-title', 'Rubrik & Template Proposal')

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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Rubrik & Template</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Two Column Layout for Forms -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- RUBRIK FORM -->
            <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 shadow-soft dark:bg-gray-800/80 rounded-2xl dark:border-gray-700/50">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <h2 class="text-base font-semibold text-gray-800 dark:text-white">Unggah Rubrik Baru</h2>
                            <button type="button" class="group relative">
                                <i class="text-gray-400 transition-colors fas fa-question-circle hover:text-primary-500 dark:text-gray-500 dark:hover:text-primary-400"></i>
                                <div class="absolute invisible w-64 p-3 text-xs text-white transition-opacity bg-gray-900 rounded-lg opacity-0 bottom-full left-1/2 -translate-x-1/2 mb-2 group-hover:visible group-hover:opacity-100 z-50">
                                    Anda harus upload poin skema dalam bentuk docx
                                    <div class="absolute w-2 h-2 bg-gray-900 transform rotate-45 left-1/2 -translate-x-1/2 -bottom-1"></div>
                                </div>
                            </button>
                        </div>
                        <a href="{{ asset('storage/Template Rubrik atau Skema.docx') }}" download
                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-primary-600 transition-all duration-200 bg-primary-50 rounded-lg hover:bg-primary-100 dark:bg-primary-900/20 dark:text-primary-300 dark:hover:bg-primary-900/30">
                            <i class="mr-1.5 fas fa-download"></i>
                            Download Template
                        </a>
                    </div>
                </div>

                <div class="p-4">
                    @if (session('success'))
                        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
                            <div class="flex items-center">
                                <i class="mr-2 text-green-500 fas fa-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('rubrics.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-4">
                            <!-- Rubric Name -->
                            <div>
                                <label for="rubric_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Rubrik/Skema <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="rubric_name" name="rubric_name" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Contoh: Rubrik Penilaian Final 2026"
                                    value="{{ old('rubric_name') }}">
                                @error('rubric_name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- File Upload Administrasi -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    File Rubrik Administrasi (.docx) <span class="text-red-500">*</span>
                                </label>
                                <input type="file" id="rubric_file" name="rubric_file" required accept=".docx"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white file:mr-4 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-primary-900/20 dark:file:text-primary-300">
                                @error('rubric_file')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- File Upload Substansi -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    File Rubrik Substansi (.docx) <span class="text-red-500">*</span>
                                </label>
                                <input type="file" id="rubric_file_2" name="rubric_file_2" required accept=".docx"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white file:mr-4 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-primary-900/20 dark:file:text-primary-300">
                                @error('rubric_file_2')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-upload"></i>
                                Unggah Rubrik
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TEMPLATE FORM -->
            <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 shadow-soft dark:bg-gray-800/80 rounded-2xl dark:border-gray-700/50">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center space-x-2">
                        <h2 class="text-base font-semibold text-gray-800 dark:text-white">Unggah Template Proposal</h2>
                        <button type="button" class="group relative">
                            <i class="text-gray-400 transition-colors fas fa-question-circle hover:text-primary-500 dark:text-gray-500 dark:hover:text-primary-400"></i>
                            <div class="absolute invisible w-64 p-3 text-xs text-white transition-opacity bg-gray-900 rounded-lg opacity-0 bottom-full left-1/2 -translate-x-1/2 mb-2 group-hover:visible group-hover:opacity-100 z-50">
                                Anda harus upload poin skema dalam bentuk docx
                                <div class="absolute w-2 h-2 bg-gray-900 transform rotate-45 left-1/2 -translate-x-1/2 -bottom-1"></div>
                            </div>
                        </button>
                    </div>
                </div>

                <div class="p-4">
                    @if ($errors->any())
                        <div class="p-4 mb-6 text-red-800 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900/30 dark:text-red-400 dark:border-red-800">
                            <ul class="ml-4 list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('extras.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-4">
                            <!-- Extra Name -->
                            <div>
                                <label for="extra_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Template <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="extra_name" name="extra_name" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Masukkan nama template" value="{{ old('extra_name') }}">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Contoh: "Template Proposal 2025"
                                </p>
                            </div>

                            <!-- File Upload -->
                            <div>
                                <label for="file_path" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    File Template (.docx) <span class="text-red-500">*</span>
                                </label>
                                <input type="file" id="file_path" name="file_path" required accept=".docx"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white file:mr-4 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 dark:file:bg-green-900/20 dark:file:text-green-300">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Hanya file DOCX. Ukuran maksimal: 10MB
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-upload"></i>
                                Unggah Template
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Rubrics List Card -->
        <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 shadow-soft dark:bg-gray-800/80 rounded-2xl dark:border-gray-700/50">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white">Daftar Rubrik</h2>
                    <div class="flex items-center mt-2 space-x-2 sm:mt-0">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Total: {{ $rubrics->count() }} rubrik
                        </span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Nama Rubrik/Skema
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Berkas
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Tanggal Unggah
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($rubrics as $r)
                            <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <i class="mr-3 fas fa-file-word text-blue-500"></i>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $r->rubric_name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <div class="text-xs text-gray-600 dark:text-gray-400">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 mr-1">Administrasi</span>
                                            {{ basename($r->file_path) }}
                                        </div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300 mr-1">Substansi</span>
                                            {{ basename($r->file_path_2) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <i class="mr-2 text-gray-400 fas fa-clock"></i>
                                        {{ $r->created_at->format('d M Y H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ asset('storage/' . $r->file_path) }}" download
                                            class="inline-flex items-center px-3 py-1.5 text-sm text-blue-600 transition-all duration-200 bg-blue-50 rounded-lg hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:bg-blue-900/30"
                                            title="Download Administrasi">
                                            <i class="mr-1.5 fas fa-download"></i>
                                            Admin
                                        </a>
                                        <a href="{{ asset('storage/' . $r->file_path_2) }}" download
                                            class="inline-flex items-center px-3 py-1.5 text-sm text-purple-600 transition-all duration-200 bg-purple-50 rounded-lg hover:bg-purple-100 dark:bg-purple-900/20 dark:text-purple-300 dark:hover:bg-purple-900/30"
                                            title="Download Substansi">
                                            <i class="mr-1.5 fas fa-download"></i>
                                            Subs
                                        </a>
                                        <form action="{{ route('rubrics.destroy', $r->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rubrik ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 text-sm text-red-600 transition-all duration-200 bg-red-50 rounded-lg hover:bg-red-100 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/30"
                                                title="Hapus Rubrik">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                            <i class="text-2xl text-gray-400 fas fa-file-alt"></i>
                                        </div>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Tidak Ada Rubrik</h3>
                                        <p class="mb-4 text-gray-500 dark:text-gray-400">Unggah rubrik pertama Anda untuk memulai.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Templates List Card -->
        <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 shadow-soft dark:bg-gray-800/80 rounded-2xl dark:border-gray-700/50">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white">Daftar Template Proposal</h2>
                    <span class="mt-2 text-sm text-gray-500 sm:mt-0 dark:text-gray-400">
                        Total: {{ $extras->count() }} template
                    </span>
                </div>
            </div>

            <div class="p-6">
                <div class="space-y-3">
                    @forelse ($extras as $extra)
                        <div class="flex items-center justify-between p-4 transition-all duration-200 border border-gray-200 rounded-lg hover:shadow-md dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <div class="flex items-center flex-1 min-w-0 space-x-4">
                                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/30">
                                    <i class="text-xl fas fa-file-word text-green-600 dark:text-green-400"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-semibold text-gray-900 truncate dark:text-white">
                                        {{ $extra->extra_name }}
                                    </h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        <i class="mr-1 fas fa-calendar"></i>
                                        {{ $extra->created_at->format('M d, Y H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center ml-4 space-x-2">
                                <a href="{{ Storage::url($extra->file_path) }}" target="_blank"
                                    class="inline-flex items-center p-2 text-green-600 transition-all duration-200 rounded-lg bg-green-50 hover:bg-green-100 dark:bg-green-900/20 dark:text-green-300 dark:hover:bg-green-900/30"
                                    title="Download File">
                                    <i class="fas fa-download"></i>
                                </a>
                                <form action="{{ route('extras.destroy', $extra->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus template ini?')">
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
                                <i class="text-2xl text-gray-400 fas fa-folder-open"></i>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Tidak Ada Template</h3>
                            <p class="text-gray-500 dark:text-gray-400">Unggah template proposal pertama Anda untuk memulai.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Simplified script - no complex file selection handling needed
    console.log('Rubrik & Template page loaded');
</script>
@endpush
