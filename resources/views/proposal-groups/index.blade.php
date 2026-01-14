@extends('layouts.admin')

@section('title', 'Unggah Folder Proposal')
@section('header-title', 'Unggah Folder Proposal')

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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Unggah Folder Proposal</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Upload Form Card -->
        <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center space-x-2">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Unggah Folder Proposal Baru</h2>
                    <button type="button" class="group relative">
                        <i class="text-gray-400 transition-colors fas fa-question-circle hover:text-primary-500 dark:text-gray-500 dark:hover:text-primary-400"></i>
                        <div class="absolute invisible w-64 p-3 text-xs text-white transition-opacity bg-gray-900 rounded-lg opacity-0 bottom-full left-1/2 -translate-x-1/2 mb-2 group-hover:visible group-hover:opacity-100 z-50">
                            Anda harus mengupload dalam bentuk folder berisi pdf
                            <div class="absolute w-2 h-2 bg-gray-900 transform rotate-45 left-1/2 -translate-x-1/2 -bottom-1"></div>
                        </div>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <form action="{{ route('proposal-groups.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Scheme (from Rubrics) -->
                        <div>
                            <label for="scheme" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <span class="inline-flex items-center space-x-2">
                                    <span>Jenis Skema (Rubrik) <span class="text-red-500">*</span></span>
                                    <button type="button" class="group relative">
                                        <i class="text-gray-400 transition-colors fas fa-question-circle hover:text-primary-500 dark:text-gray-500 dark:hover:text-primary-400"></i>
                                        <div class="absolute invisible w-64 p-3 text-xs text-white transition-opacity bg-gray-900 rounded-lg opacity-0 bottom-full left-1/2 -translate-x-1/2 mb-2 group-hover:visible group-hover:opacity-100 z-50">
                                            Pilih skema yang akan dijalankan
                                            <div class="absolute w-2 h-2 bg-gray-900 transform rotate-45 left-1/2 -translate-x-1/2 -bottom-1"></div>
                                        </div>
                                    </button>
                                </span>
                            </label>
                            <select id="scheme" name="scheme" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Pilih skema rubrik</option>
                                @foreach($rubrics as $rubric)
                                    <option value="{{ $rubric->rubric_name }}">{{ $rubric->rubric_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipe Grup -->
                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <span class="inline-flex items-center space-x-2">
                                    <span>Tipe Grup <span class="text-red-500">*</span></span>
                                    <button type="button" class="group relative">
                                        <i class="text-gray-400 transition-colors fas fa-question-circle hover:text-primary-500 dark:text-gray-500 dark:hover:text-primary-400"></i>
                                        <div class="absolute invisible w-80 p-3 text-xs text-white transition-opacity bg-gray-900 rounded-lg opacity-0 bottom-full left-1/2 -translate-x-1/2 mb-2 group-hover:visible group-hover:opacity-100 z-50">
                                            - Data saat ini (current): data proposal yang dinilai.
                                            </br> - Data riwayat (historis): data proposal yang akan digunakan sebagai latihan model
                                            <div class="absolute w-2 h-2 bg-gray-900 transform rotate-45 left-1/2 -translate-x-1/2 -bottom-1"></div>
                                        </div>
                                    </button>
                                </span>
                            </label>
                            <select id="type" name="type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="current">Saat Ini</option>
                                <option value="history">Riwayat</option>
                            </select>
                        </div>

                        <!-- File Upload -->
                        <div class="md:col-span-2">
                            <label for="files" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Pilih Folder Proposal <span class="text-red-500">*</span>
                            </label>

                            <!-- File Upload Area -->
                            <div class="relative">
                                <input id="files" name="files[]" type="file" multiple directory webkitdirectory class="hidden"
                                    onchange="updateFileSelection(this)"/>

                                <label for="files" id="fileUploadLabel"
                                    class="flex flex-col items-center justify-center w-full h-32 transition-all duration-200 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="uploadPlaceholder">
                                        <i class="mb-3 text-2xl text-gray-500 fas fa-folder-open dark:text-gray-400"></i>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Klik untuk mengunggah folder</span> atau seret dan lepas
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Hanya file PDF</p>
                                    </div>
                                    <div class="hidden" id="fileSelectionInfo">
                                        <div class="flex items-center justify-center mb-2 text-green-600 dark:text-green-400">
                                            <i class="mr-2 text-xl fas fa-check-circle"></i>
                                            <span class="text-lg font-semibold">Folder Dipilih</span>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-sm text-gray-600 dark:text-gray-300" id="fileCountText"></p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400" id="folderNameText"></p>
                                        </div>
                                    </div>
                                </label>

                                <!-- Clear Selection Button -->
                                <button type="button" id="clearSelection" class="absolute hidden p-1 text-gray-400 top-2 right-2 hover:text-gray-600 dark:hover:text-gray-300" onclick="clearFileSelection()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <!-- Validation Error -->
                            <div id="fileError" class="hidden mt-2 text-sm text-red-600 dark:text-red-400">
                                <i class="mr-1 fas fa-exclamation-circle"></i>
                                Harap pilih folder yang berisi file PDF
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" id="submitButton"
                            class="px-6 py-2.5 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm transition-colors duration-200 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="mr-2 fas fa-upload"></i>
                            Unggah Grup Proposal
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
                <div class="flex items-center">
                    <i class="mr-2 text-green-500 fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Proposal Groups Table -->
        <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Grup Proposal</h2>
                    <div class="flex items-center mt-2 space-x-2 sm:mt-0">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Total: {{ $groups->count() }} grup
                        </span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Nama Grup
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Tipe
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Skema
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Total File
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Diunggah Pada
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach ($groups as $g)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center">
                                        <i class="mr-3 text-gray-400 fas fa-folder"></i>
                                        {{ $g->group_name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full
                                        {{ $g->type === 'current' ? 'text-green-800 bg-green-100 dark:bg-green-900 dark:text-green-300' : 'text-blue-800 bg-blue-100 dark:bg-blue-900 dark:text-blue-300' }}">
                                        {{ ucfirst($g->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                    {{ $g->scheme }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                        <i class="mr-1 fas fa-file-pdf"></i>
                                        {{ $g->total_files }} file
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                    {{ $g->uploaded_at?->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <a href="{{ route('proposal-groups.show', $g->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300 bg-primary-50 hover:bg-primary-100 dark:bg-primary-900/20 dark:hover:bg-primary-900/30 rounded-lg transition-colors duration-200">
                                        <i class="mr-1.5 fas fa-eye"></i>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($groups->isEmpty())
                    <div class="p-8 text-center">
                        <i class="mx-auto mb-4 text-4xl text-gray-400 fas fa-folder-open"></i>
                        <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Tidak ada grup proposal ditemukan</h3>
                        <p class="text-gray-500 dark:text-gray-400">Mulai dengan mengunggah grup proposal pertama Anda.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function updateFileSelection(input) {
        const uploadLabel = document.getElementById('fileUploadLabel');
        const placeholder = document.getElementById('uploadPlaceholder');
        const fileInfo = document.getElementById('fileSelectionInfo');
        const fileCountText = document.getElementById('fileCountText');
        const folderNameText = document.getElementById('folderNameText');
        const clearButton = document.getElementById('clearSelection');
        const fileError = document.getElementById('fileError');
        const submitButton = document.getElementById('submitButton');

        if (input.files.length > 0) {
            // Get folder name from the first file's path
            const firstFile = input.files[0];
            const folderPath = firstFile.webkitRelativePath;
            const folderName = folderPath.split('/')[0];

            // Count PDF files
            const pdfFiles = Array.from(input.files).filter(file =>
                file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf')
            );

            const totalFiles = input.files.length;
            const pdfCount = pdfFiles.length;

            // Update UI
            placeholder.classList.add('hidden');
            fileInfo.classList.remove('hidden');
            clearButton.classList.remove('hidden');
            uploadLabel.classList.remove('border-gray-300', 'dark:border-gray-600');
            uploadLabel.classList.add('border-green-500', 'dark:border-green-400', 'bg-green-50', 'dark:bg-green-900/20');

            fileCountText.textContent = `${pdfCount} PDF files found (${totalFiles} total files)`;
            folderNameText.textContent = `Folder: ${folderName}`;

            // Enable submit button
            submitButton.disabled = false;

            // Hide error if shown
            fileError.classList.add('hidden');

        } else {
            clearFileSelection();
        }
    }

    function clearFileSelection() {
        const input = document.querySelector('input[type="file"]');
        const uploadLabel = document.getElementById('fileUploadLabel');
        const placeholder = document.getElementById('uploadPlaceholder');
        const fileInfo = document.getElementById('fileSelectionInfo');
        const clearButton = document.getElementById('clearSelection');
        const submitButton = document.getElementById('submitButton');

        // Reset file input
        input.value = '';

        // Reset UI
        placeholder.classList.remove('hidden');
        fileInfo.classList.add('hidden');
        clearButton.classList.add('hidden');
        uploadLabel.classList.remove('border-green-500', 'dark:border-green-400', 'bg-green-50', 'dark:bg-green-900/20');
        uploadLabel.classList.add('border-gray-300', 'dark:border-gray-600');

        // Disable submit button
        submitButton.disabled = true;
    }

    // Form validation
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        const fileInput = document.querySelector('input[type="file"]');
        const fileError = document.getElementById('fileError');

        if (fileInput.files.length === 0) {
            e.preventDefault();
            fileError.classList.remove('hidden');
            fileInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    // Drag and drop functionality
    const fileUploadLabel = document.getElementById('fileUploadLabel');
    const fileInput = document.getElementById('files');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileUploadLabel.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        fileUploadLabel.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileUploadLabel.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        fileUploadLabel.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
    }

    function unhighlight() {
        fileUploadLabel.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
    }

    fileUploadLabel.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        updateFileSelection(fileInput);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize submit button as disabled
        document.getElementById('submitButton').disabled = true;

        // Flash messages
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#10b981',
                background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
            });
        @endif
    });
</script>
@endpush
