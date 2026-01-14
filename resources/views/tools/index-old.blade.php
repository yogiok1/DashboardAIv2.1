@extends('layouts.admin')

@section('title', 'AI Configuration Center')

@section('content')
    <!-- Notification Container -->
    <div id="notificationContainer" class="fixed z-50 max-w-full top-20 right-6 w-96"></div>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Penilaian dengan AI</h1>
                <p class="mt-1 text-gray-600 dark:text-gray-400">Konfigurasikan model AI, pengaturan, dan rekomendasi</p>
            </div>
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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Konfigurasi AI</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- AI Model Testing Card -->
        <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Pengujian & Demonstrasi Model AI</h2>
                    <span
                        class="px-3 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                        Demo Langsung
                    </span>
                </div>
            </div>

            <div class="p-6">
                <div
                    class="flex flex-col items-center justify-between p-8 mb-6 md:flex-row bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl dark:from-blue-900/20 dark:to-indigo-900/20">
                    <div class="mb-6 text-center md:text-left md:w-1/2 md:mb-0">
                        <div
                            class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-white shadow-lg md:mx-0 rounded-2xl dark:bg-gray-700">
                            <i class="text-3xl text-blue-600 fas fa-robot dark:text-blue-400"></i>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Uji Model AI Secara Real-Time</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Hasilkan rekomendasi menggunakan berbagai model AI. Uji parameter dan lihat hasil secara langsung.
                            Sempurna untuk mengPenilaian kinerja model dan penyempurnaan.
                        </p>
                    </div>

                    <div class="md:w-1/2 md:pl-8">
                        <div class="p-6 bg-white shadow-md rounded-xl dark:bg-gray-700">
                            <h4 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">Penilaian dengan AI
                            </h4>

                            <form id="aiTestForm" method="POST" onsubmit="return false;">
                                @csrf
                                <!-- Instrument Selection (Rubric) -->
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="mr-2 fas fa-file-alt"></i>Instrumen / Rubrik
                                    </label>
                                    <select id="rubric_id" name="rubric_id"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                        required>

                                        <option value="">-- Pilih Instrumen --</option>

                                        @foreach ($rubrics as $rubric)
                                            <option value="{{ $rubric->id }}" 
                                                data-rubric-name="{{ $rubric->rubric_name }}"
                                                data-file-path="{{ $rubric->file_path }}"
                                                data-file-path-2="{{ $rubric->file_path_2 }}">
                                                {{ $rubric->rubric_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        Pilih instrumen Penilaian (contoh: Penilaian 2.0)
                                    </p>
                                </div>

                                <!-- Extra Files Selection (Optional) -->
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="mr-2 fas fa-plus-square"></i>File Tambahan (Opsional)
                                    </label>
                                    <select id="extra_id" name="extra_id"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">

                                        <option value="-">- (Tanpa File Tambahan)</option>

                                        @foreach ($extras as $extra)
                                            <option value="{{ $extra->id }}">
                                                {{ $extra->extra_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        Pilihan tambahan: File Penilaian opsional
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="mr-2 fas fa-folder"></i>Proposal Group
                                    </label>
                                    <select id="proposal_group" name="proposal_group"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                        onchange="loadProposalsFromGroup(this.value)"
                                        required>

                                        <option value="">-- Pilih Grup Proposal --</option>

                                        @foreach ($groups as $g)
                                            <option value="{{ $g->id }}" data-scheme="{{ $g->scheme }}"
                                                data-uploaded-at="{{ $g->uploaded_at }}">
                                                {{ $g->group_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @if($groups->isEmpty())
                                        <p class="mt-2 text-sm text-yellow-600 dark:text-yellow-400">
                                            <i class="mr-1 fas fa-exclamation-triangle"></i>
                                            Tidak ada proposal group dengan tipe "current". Silakan upload proposal terlebih dahulu.
                                        </p>
                                    @else
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                            <i class="mr-1 fas fa-info-circle"></i>
                                            {{ $groups->count() }} grup tersedia
                                        </p>
                                    @endif
                                    <div id="proposalLoadStatus" class="mt-2 text-sm"></div>
                                </div>

                                <!-- Hapus dropdown Scheme lama -->
                                {{-- Scheme dropdown sudah tidak diperlukan, scheme diambil dari rubric_name --}}

                                <!-- Proposals Section -->
                                {{-- <div class="mb-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            <i class="mr-2 fas fa-file-pdf"></i>Test Proposals
                                        </label>
                                        <button type="button" onclick="addProposal()"
                                            class="text-xs text-blue-600 hover:text-blue-700 dark:text-blue-400">
                                            <i class="mr-1 fas fa-plus-circle"></i>Add
                                        </button>
                                    </div>

                                    <div id="proposalsList" class="space-y-2">
                                        <!-- Proposals will be added here -->
                                    </div>
                                </div> --}}

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-2">
                                    <button type="submit" id="testModelBtn"
                                        class="flex-1 px-4 py-2.5 text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <i class="mr-2 fas fa-play-circle"></i>
                                        Jalankan Penilaian AI
                                    </button>
                                    <button type="button" id="generateReportBtn"
                                        class="px-4 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm transition-all duration-200 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
                                        <i class="mr-2 fas fa-file-alt"></i>
                                        Laporan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Results Display -->
                <div id="testResults" class="hidden p-6 mt-6 bg-gray-50 rounded-xl dark:bg-gray-700/50">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">
                            <i class="mr-2 fas fa-chart-line"></i>Hasil Penilaian
                        </h4>
                        <button id="closeResultsBtn" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div id="resultsContent"></div>
                </div>
            </div>
        </div>

        <!-- Main Configuration Cards -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- AI Models Card -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Model AI</h2>
                        <span
                            class="px-3 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded-full dark:bg-purple-900/30 dark:text-purple-300">
                            Core
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div
                        class="flex items-center justify-center p-8 mb-6 bg-gradient-to-br from-purple-50 to-blue-50 rounded-xl dark:from-purple-900/20 dark:to-blue-900/20">
                        <div class="text-center">
                            <div
                                class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
                                <i class="text-3xl text-purple-600 fas fa-brain dark:text-purple-400"></i>
                            </div>
                            <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Manajemen Model AI</h3>
                            <p class="text-gray-600 dark:text-gray-300">Konfigurasi dan kelola model AI untuk rekomendasi
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        <a href={{ route('modelai.index') }}
                            class="px-6 py-2.5 text-white bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="mr-2 fas fa-external-link-alt"></i>
                            Kelola Model AI
                        </a>
                    </div>
                </div>
            </div>

            <!-- Training Settings Card -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Pengaturan Pelatihan</h2>
                        <span
                            class="px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">
                            Lanjutan
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div
                        class="flex items-center justify-center p-8 mb-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl dark:from-green-900/20 dark:to-emerald-900/20">
                        <div class="text-center">
                            <div
                                class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
                                <i class="text-3xl text-green-600 fas fa-graduation-cap dark:text-green-400"></i>
                            </div>
                            <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Pelatihan AI</h3>
                            <p class="text-gray-600 dark:text-gray-300">Konfigurasi parameter dan jadwal pelatihan</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        <a href={{ route('ai-training.index') }}
                            class="px-6 py-2.5 text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="mr-2 fas fa-external-link-alt"></i>
                            Konfigurasi Pelatihan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Aggregation Settings Card -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Pengaturan Agregasi</h2>
                        <span
                            class="px-3 py-1 text-xs font-medium text-orange-800 bg-orange-100 rounded-full dark:bg-orange-900/30 dark:text-orange-300">
                            Penilaian
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div
                        class="flex items-center justify-center p-8 mb-6 bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl dark:from-orange-900/20 dark:to-amber-900/20">
                        <div class="text-center">
                            <div
                                class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
                                <i class="text-3xl text-orange-600 fas fa-sliders-h dark:text-orange-400"></i>
                            </div>
                            <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Konfigurasi Penilaian</h3>
                            <p class="text-gray-600 dark:text-gray-300">Aturan penilaian dan agregasi</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        <a href={{ route('aggregate.index') }}
                            class="px-6 py-2.5 text-white bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="mr-2 fas fa-external-link-alt"></i>
                            Konfigurasi Agregasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let proposalCount = 0;

        // Initialize with 2 default proposals
        // document.addEventListener('DOMContentLoaded', function() {
        //     addProposal('proposal_1.pdf', '/storage/test/proposal_1.pdf', 'done');
        //     addProposal('proposal_2.pdf', '/storage/test/proposal_2.pdf', 'failed');

        //     const testModelBtn = document.getElementById('testModelBtn');
        //     const generateReportBtn = document.getElementById('generateReportBtn');
        //     const closeResultsBtn = document.getElementById('closeResultsBtn');
        //     const testResults = document.getElementById('testResults');

        //     // Run Model Test
        //     testModelBtn.addEventListener('click', runModelTest);

        //     // Generate Report
        //     generateReportBtn.addEventListener('click', function() {
        //         alert('Report generation feature coming soon!');
        //     });

        //     // Close Results
        //     closeResultsBtn.addEventListener('click', function() {
        //         testResults.classList.add('hidden');
        //     });
        // });


        function addProposal(filename = '', filepath = '', status = 'done') {
            proposalCount++;
            const proposalsList = document.getElementById('proposalsList');

            if (!filename) filename = `proposal_${proposalCount}.pdf`;
            if (!filepath) filepath = `/storage/test/proposal_${proposalCount}.pdf`;

            const proposalHTML = `
        <div class="p-3 bg-gray-100 rounded-lg proposal-item dark:bg-gray-600">
            <div class="grid items-center grid-cols-12 gap-2 text-xs">
                <input type="text" name="filename[]" value="${filename}" placeholder="Filename"
                    class="col-span-4 px-2 py-1.5 bg-white border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-500 dark:text-white">
                <input type="text" name="filepath[]" value="${filepath}" placeholder="Filepath"
                    class="col-span-5 px-2 py-1.5 bg-white border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-500 dark:text-white">
                <select name="status[]"
                    class="col-span-2 px-2 py-1.5 bg-white border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-500 dark:text-white">
                    <option value="done" ${status === 'done' ? 'selected' : ''}>Done</option>
                    <option value="failed" ${status === 'failed' ? 'selected' : ''}>Failed</option>
                </select>
                <button type="button" onclick="removeProposal(this)"
                    class="col-span-1 p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
            proposalsList.insertAdjacentHTML('beforeend', proposalHTML);
        }

        function removeProposal(button) {
            const proposalItems = document.querySelectorAll('.proposal-item');
            if (proposalItems.length > 1) {
                button.closest('.proposal-item').remove();
            } else {
                alert('At least one proposal is required');
            }
        }

        async function runModelTest() {
            const button = document.getElementById('testModelBtn');
            const originalText = button.innerHTML;

            // Show loading state
            button.disabled = true;
            button.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i>Processing...';

            // Get form data
            const instrumentPath = document.getElementById('instrument_path').value;
            const scheme = document.getElementById('scheme').value;

            const filenames = document.querySelectorAll('input[name="filename[]"]');
            const filepaths = document.querySelectorAll('input[name="filepath[]"]');
            const statuses = document.querySelectorAll('select[name="status[]"]');

            const proposals = [];
            for (let i = 0; i < filenames.length; i++) {
                proposals.push({
                    filename: filenames[i].value,
                    filepath: filepaths[i].value,
                    status: statuses[i].value
                });
            }

            const payload = {
                instrument_path: instrumentPath,
                scheme: scheme,
                proposals: proposals
            };

            try {
                const response = await fetch('/api/model/direct-test', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                // Show results
                displayResults(data, response.ok);

            } catch (error) {
                displayResults({
                    success: false,
                    message: 'Connection error',
                    error: error.message
                }, false);
            } finally {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        }

        function displayResults(data, success) {
            const resultsSection = document.getElementById('testResults');
            const resultsContent = document.getElementById('resultsContent');

            resultsSection.classList.remove('hidden');

            if (success && data.success) {
                const aiResponse = data.ai_response || {};
                resultsContent.innerHTML = `
            <div class="space-y-4">
                <div class="flex items-center p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
                    <i class="mr-3 text-xl fas fa-check-circle"></i>
                    <div>
                        <div class="font-semibold">Test Completed Successfully</div>
                        <div class="text-sm">${data.message}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="p-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                        <div class="text-sm text-gray-600 dark:text-gray-400">AI Score</div>
                        <div class="mt-1 text-2xl font-bold text-blue-600 dark:text-blue-400">
                            ${aiResponse.ai_score || 'N/A'}
                        </div>
                    </div>
                    <div class="p-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                        <div class="text-sm text-gray-600 dark:text-gray-400">ML Score</div>
                        <div class="mt-1 text-2xl font-bold text-green-600 dark:text-green-400">
                            ${aiResponse.ml_score || 'N/A'}
                        </div>
                    </div>
                </div>

                ${aiResponse.notes ? `
                                <div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300">Notes:</div>
                                    <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">${aiResponse.notes}</div>
                                </div>
                            ` : ''}

                <details class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                    <summary class="text-sm font-medium text-gray-700 cursor-pointer dark:text-gray-300">
                        View Raw Response
                    </summary>
                    <pre class="p-3 mt-3 overflow-x-auto text-xs text-green-400 bg-gray-900 rounded-lg">${JSON.stringify(data, null, 2)}</pre>
                </details>
            </div>
        `;
            } else {
                resultsContent.innerHTML = `
            <div class="space-y-4">
                <div class="flex items-center p-4 text-red-800 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900/30 dark:text-red-400 dark:border-red-800">
                    <i class="mr-3 text-xl fas fa-exclamation-circle"></i>
                    <div>
                        <div class="font-semibold">Test Failed</div>
                        <div class="text-sm">${data.message || 'Unknown error'}</div>
                    </div>
                </div>

                ${data.error ? `
                                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300">Error Details:</div>
                                    <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">${data.error}</div>
                                </div>
                            ` : ''}

                <details class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                    <summary class="text-sm font-medium text-gray-700 cursor-pointer dark:text-gray-300">
                        View Raw Response
                    </summary>
                    <pre class="p-3 mt-3 overflow-x-auto text-xs text-red-400 bg-gray-900 rounded-lg">${JSON.stringify(data, null, 2)}</pre>
                </details>
            </div>
        `;
            }

            // Scroll to results
            resultsSection.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }

        // Notification function
        function showNotification(message, type = 'success') {
            const container = document.getElementById('notificationContainer');
            const notification = document.createElement('div');

            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

            notification.className =
                `${bgColor} text-white px-6 py-4 rounded-lg shadow-lg mb-3 flex items-center justify-between animate-slide-in`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${icon} mr-3 text-xl"></i>
                    <span class="font-medium">${message}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            `;

            container.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }

        // Load proposals when group is selected

        // Debug: Log groups data
        console.log('📋 Available Groups:', {{ $groups->count() }});
        @if($groups->count() > 0)
        console.log('Groups list:');
        @foreach($groups as $g)
        console.log('  - ID: {{ $g->id }}, Name: {{ $g->group_name }}, Scheme: {{ $g->scheme }}');
        @endforeach
        @endif
        async function loadProposalsFromGroup(groupId) {
            const statusDiv = document.getElementById('proposalLoadStatus');

            console.log('🔍 loadProposalsFromGroup called with groupId:', groupId);

            if (!groupId) {
                window.selectedProposals = null;
                window.selectedGroup = null;
                statusDiv.innerHTML = '';
                return;
            }

            statusDiv.innerHTML =
                '<span class="text-blue-600"><i class="mr-2 fas fa-spinner fa-spin"></i>Loading proposals...</span>';

            try {
                const url = `/api/proposal-groups/${groupId}/proposals`;
                console.log('📡 Fetching from:', url);
                
                const response = await fetch(url);
                const data = await response.json();

                console.log('📊 API Response:', data);

                if (data.success && data.proposals) {
                    window.selectedProposals = data.proposals;
                    window.selectedGroup = data.group;

                    console.log('✅ Loaded proposals:', data.proposals.length);
                    console.log('📦 Group data:', data.group);

                    // Tidak perlu update scheme dropdown karena scheme sekarang dari rubric

                    statusDiv.innerHTML =
                        `<span class="text-green-600"><i class="mr-2 fas fa-check-circle"></i>Loaded ${data.proposals.length} proposal(s)</span>`;
                } else {
                    console.error('❌ API returned success=false or no proposals');
                    statusDiv.innerHTML =
                        '<span class="text-red-600"><i class="mr-2 fas fa-exclamation-circle"></i>Failed to load proposals</span>';
                    showNotification('Failed to load proposals from group', 'error');
                }
            } catch (error) {
                console.error('❌ Error loading proposals:', error);
                statusDiv.innerHTML =
                    '<span class="text-red-600"><i class="mr-2 fas fa-exclamation-circle"></i>Error loading proposals</span>';
                showNotification('Error loading proposals: ' + error.message, 'error');
            }
        }

        // Handle AI Test Form Submit
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('aiTestForm');
            const testBtn = document.getElementById('testModelBtn');
            const resultsSection = document.getElementById('testResults');
            const resultsContent = document.getElementById('resultsContent');
            const closeResultsBtn = document.getElementById('closeResultsBtn');

            // Close results button
            if (closeResultsBtn) {
                closeResultsBtn.addEventListener('click', function() {
                    resultsSection.classList.add('hidden');
                });
            }

            if (form) {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    // Disable button and show loading
                    const originalText = testBtn.innerHTML;
                    testBtn.disabled = true;
                    testBtn.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i>Sending Request...';

                    // Get form data
                    const rubricId = document.getElementById('rubric_id').value;
                    const proposalGroupId = document.getElementById('proposal_group').value;
                    
                    // Get rubric details
                    const rubricSelect = document.getElementById('rubric_id');
                    const selectedRubric = rubricSelect.options[rubricSelect.selectedIndex];
                    const rubricName = selectedRubric.getAttribute('data-rubric-name');
                    const filePath = selectedRubric.getAttribute('data-file-path');
                    const filePath2 = selectedRubric.getAttribute('data-file-path-2');

                    // Validate
                    if (!rubricId || !proposalGroupId) {
                        showNotification('Please fill all required fields', 'error');
                        testBtn.disabled = false;
                        testBtn.innerHTML = originalText;
                        return;
                    }

                    // Build payload - hanya kirim parameter minimal, controller yang build lengkap
                    const extraId = document.getElementById('extra_id').value;
                    const payload = {
                        proposal_group: parseInt(proposalGroupId),
                        rubric_id: parseInt(rubricId),
                        extra_id: extraId // Add extra_id to payload
                    };

                    // LOG: Data yang akan dikirim ke API Laravel
                    console.log('\n╔═══════════════════════════════════════════════════════════════╗');
                    console.log('║         📤 DATA YANG DIKIRIM KE API LARAVEL                  ║');
                    console.log('╚═══════════════════════════════════════════════════════════════╝\n');
                    console.log('📦 Payload Minimal (dikirim ke Laravel):');
                    console.table(payload);
                    console.log('\n📋 JSON String:');
                    console.log(JSON.stringify(payload, null, 2));
                    
                    // Preview payload lengkap yang akan di-build
                    if (window.selectedProposals && window.selectedGroup) {
                        console.log('\n╔═══════════════════════════════════════════════════════════════╗');
                        console.log('║      🔮 PREVIEW PAYLOAD LENGKAP (yang di-build server)      ║');
                        console.log('╚═══════════════════════════════════════════════════════════════╝\n');
                        
                        const baseUrl = "http://72.61.215.182";
                        
                        // Build instrument object
                        const instrument = {};
                        if (filePath) {
                            instrument.administrasi = `${baseUrl}/storage/${filePath}`;
                        }
                        if (filePath2) {
                            instrument.substansi = `${baseUrl}/storage/${filePath2}`;
                        }
                        
                        // Build extra_path
                        const extraPathPreview = extraId === "-" ? "-" : "http://72.61.215.182/storage/extras/[extra_file].docx";
                        
                        const previewPayload = {
                            username: "{{ Auth::check() ? Auth::user()->name : 'guest' }}",
                            scheme: rubricName, // Dari nama rubric
                            year: window.selectedGroup.uploaded_at ? new Date(window.selectedGroup.uploaded_at).getFullYear() : new Date().getFullYear(),
                            instrument: instrument,
                            extra_path: extraPathPreview,
                            proposal_group: window.selectedGroup.id,
                            proposals: window.selectedProposals.map(p => ({
                                id_proposal: p.id,
                                filename: p.filename,
                                filepath: `${baseUrl}/storage/${p.path}`,
                                status: p.status || 'pending'
                            }))
                        };
                        
                        console.log('📊 Payload Details:');
                        console.log('├─ Username:', previewPayload.username);
                        console.log('├─ Scheme (Rubric Name):', previewPayload.scheme);
                        console.log('├─ Year:', previewPayload.year);
                        console.log('├─ Extra Path:', previewPayload.extra_path);
                        console.log('├─ Proposal Group ID:', previewPayload.proposal_group);
                        console.log('├─ Instrument:');
                        if (instrument.administrasi) {
                            console.log('│  ├─ Administrasi:', instrument.administrasi);
                        }
                        if (instrument.substansi) {
                            console.log('│  └─ Substansi:', instrument.substansi);
                        }
                        console.log('└─ Total Proposals:', previewPayload.proposals.length);
                        
                        console.log('\n📄 Proposals List:');
                        console.table(previewPayload.proposals);
                        
                        console.log('\n📋 FULL JSON PAYLOAD (ready to copy):');
                        console.log('─'.repeat(65));
                        console.log(JSON.stringify(previewPayload, null, 2));
                        console.log('─'.repeat(65));
                    } else {
                        console.log('\n⚠️  Note: Pilih Proposal Group dulu untuk melihat preview lengkap');
                    }
                    
                    console.log('\n' + '═'.repeat(65) + '\n');

                    try {
                        const response = await fetch('/api/evaluation-test', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify(payload)
                        });

                        if (!response.ok) {
                            throw new Error(`Request failed with status ${response.status}`);
                        }

                        const data = await response.json();

                        // LOG: Response dari server dan payload lengkap
                        console.log('\n╔═══════════════════════════════════════════════════════════════╗');
                        console.log('║           ✅ RESPONSE DARI LARAVEL API                       ║');
                        console.log('╚═══════════════════════════════════════════════════════════════╝\n');
                        
                        console.log('📦 Full Response Object:');
                        console.log(data);
                        
                        console.log('\n╔═══════════════════════════════════════════════════════════════╗');
                        console.log('║      🚀 PAYLOAD LENGKAP YANG DIKIRIM KE AI SERVICE           ║');
                        console.log('╚═══════════════════════════════════════════════════════════════╝\n');
                        
                        if (data.sent_payload) {
                            console.log('📊 Payload Summary:');
                            console.log('├─ Username:', data.sent_payload.username);
                            console.log('├─ Scheme (Rubric):', data.sent_payload.scheme);
                            console.log('├─ Year:', data.sent_payload.year);
                            console.log('├─ Proposal Group ID:', data.sent_payload.proposal_group);
                            console.log('├─ Instrument:');
                            if (data.sent_payload.instrument?.administrasi) {
                                console.log('│  ├─ Administrasi:', data.sent_payload.instrument.administrasi);
                            }
                            if (data.sent_payload.instrument?.substansi) {
                                console.log('│  └─ Substansi:', data.sent_payload.instrument.substansi);
                            }
                            console.log('└─ Total Proposals:', data.sent_payload.proposals?.length || 0);
                            
                            if (data.sent_payload.proposals?.length > 0) {
                                console.log('\n📄 Proposals Details:');
                                console.table(data.sent_payload.proposals);
                                
                                console.log('\n📌 First Proposal Detail:');
                                const firstProposal = data.sent_payload.proposals[0];
                                console.log('├─ ID:', firstProposal.id_proposal);
                                console.log('├─ Filename:', firstProposal.filename);
                                console.log('├─ Filepath:', firstProposal.filepath);
                                console.log('└─ Status:', firstProposal.status);
                            }
                            
                            console.log('\n📋 COMPLETE JSON PAYLOAD (Copy this for API testing):');
                            console.log('┌' + '─'.repeat(63) + '┐');
                            console.log(JSON.stringify(data.sent_payload, null, 2));
                            console.log('└' + '─'.repeat(63) + '┘');
                            
                            // Tambahan info untuk testing
                            console.log('\n💡 API Testing Info:');
                            console.log('├─ Method: POST');
                            console.log('├─ Endpoint:', data.ai_endpoint || 'Check .env AI_MODEL_ENDPOINT');
                            console.log('├─ Content-Type: application/json');
                            console.log('├─ Timestamp:', data.timestamp);
                            console.log('└─ Structure: username, scheme (rubric_name), year, instrument{administrasi,substansi}, proposals[]');
                            
                            if (data.ai_response) {
                                console.log('\n🤖 AI Service Response:');
                                console.log(data.ai_response);
                            }
                        }
                        
                        console.log('\n' + '═'.repeat(65) + '\n');

                        // Show success notification
                        showNotification('Request sent successfully to AI service!', 'success');

                        // Ambil payload lengkap dari response (yang sudah di-build di controller)
                        const fullPayload = data.sent_payload || payload;

                        // Show success status
                        resultsSection.classList.remove('hidden');
                        resultsContent.innerHTML = `
                            <div class="space-y-4">
                                <div class="flex items-center p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
                                    <i class="mr-3 text-xl fas fa-check-circle"></i>
                                    <div class="flex-1">
                                        <div class="font-semibold">Request Sent Successfully!</div>
                                        <div class="text-sm">${data.message || 'AI evaluation request has been sent'}</div>
                                    </div>
                                </div>

                                <div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                                    <div class="flex items-center mb-2">
                                        <i class="mr-2 text-blue-600 fas fa-info-circle dark:text-blue-400"></i>
                                        <div class="text-sm font-medium text-blue-900 dark:text-blue-300">Processing Info</div>
                                    </div>
                                    <div class="text-sm text-blue-800 dark:text-blue-400">
                                        Processing ${fullPayload.proposals ? fullPayload.proposals.length : 0} proposal(s) using <strong>${fullPayload.scheme}</strong> scheme for year <strong>${fullPayload.year}</strong>.
                                        ${fullPayload.instrument ? `<br>Instrument: ${fullPayload.instrument.administrasi ? 'Administrasi ✓' : ''} ${fullPayload.instrument.substansi ? 'Substansi ✓' : ''}` : ''}
                                    </div>
                                </div>

                                <details open class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <summary class="text-sm font-medium text-gray-700 cursor-pointer dark:text-gray-300">
                                        <i class="mr-2 fas fa-code"></i>View Sent JSON Payload
                                    </summary>
                                    <pre class="p-3 mt-3 overflow-x-auto text-xs text-green-400 bg-gray-900 rounded-lg">${JSON.stringify(fullPayload, null, 2)}</pre>
                                </details>

                                ${data.ai_response ? `
                                    <details class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                        <summary class="text-sm font-medium text-gray-700 cursor-pointer dark:text-gray-300">
                                            <i class="mr-2 fas fa-server"></i>View API Response
                                        </summary>
                                        <pre class="p-3 mt-3 overflow-x-auto text-xs text-blue-400 bg-gray-900 rounded-lg">${JSON.stringify(data.ai_response, null, 2)}</pre>
                                    </details>
                                    ` : ''}
                            </div>
                        `;

                        // Scroll to results
                        resultsSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest'
                        });

                    } catch (error) {
                        showNotification('Failed to send request: ' + error.message, 'error');

                        resultsSection.classList.remove('hidden');
                        resultsContent.innerHTML = `
                            <div class="space-y-4">
                                <div class="flex items-center p-4 text-red-800 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900/30 dark:text-red-400 dark:border-red-800">
                                    <i class="mr-3 text-xl fas fa-exclamation-circle"></i>
                                    <div>
                                        <div class="font-semibold">Failed to Send Request</div>
                                        <div class="text-sm">${error.message}</div>
                                        <div class="mt-2 text-xs">Check browser console (F12) for details</div>
                                    </div>
                                </div>

                                <details class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <summary class="text-sm font-medium text-gray-700 cursor-pointer dark:text-gray-300">
                                        <i class="mr-2 fas fa-bug"></i>Debug Info
                                    </summary>
                                    <pre class="p-3 mt-3 overflow-x-auto text-xs text-red-400 bg-gray-900 rounded-lg">${error.stack || error.message}</pre>
                                </details>
                            </div>
                        `;
                    } finally {
                        // Re-enable button
                        testBtn.disabled = false;
                        testBtn.innerHTML = originalText;
                    }
                });
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
            transition: opacity 0.3s ease-out;
        }
    </style>
@endpush
