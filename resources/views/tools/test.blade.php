@extends('layouts.admin')

@section('title', 'AI Model Test - ' . ucfirst($assessmentType))
@section('header-title', 'Tes ' . $assessmentTypeLabel)

@section('content')
    <!-- Notification Container -->
    <div id="notificationContainer" class="fixed z-50 max-w-full top-20 right-6 w-96"></div>

    <div class="space-y-6">
        <!-- Back Button & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('tools') }}"
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
                    <li>
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <a href="{{ route('tools') }}"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                                Proses Penilaian
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $assessmentTypeLabel }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- AI Model Testing Card -->
        <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Penilaian {{ $assessmentTypeLabel }}</h2>
                    <span class="px-3 py-1 text-xs font-medium {{ $badgeClass }} rounded-full">
                        {{ $assessmentTypeLabel }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                <div class="flex flex-col items-center justify-between p-8 mb-6 md:flex-row {{ $gradientClass }} rounded-xl">
                    <div class="mb-6 text-center md:text-left md:w-1/2 md:mb-0">
                        <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-white shadow-lg md:mx-0 rounded-2xl dark:bg-gray-700">
                            <i class="text-3xl {{ $iconClass }} fas {{ $icon }}"></i>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Proses Penilaian Secara Real-Time</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-justify">
                            {{ $assessmentDescription }}
                        </p>
                    </div>

                    <div class="md:w-1/2 md:pl-8">
                        <div class="p-6 bg-white shadow-md rounded-xl dark:bg-gray-700">
                            <h4 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">Jalankan Proses Penilaian</h4>

                            <form id="aiTestForm" method="POST" onsubmit="return false;">
                                @csrf
                                <input type="hidden" id="assessment_type" name="assessment_type" value="{{ $assessmentType }}">
                                
                                <!-- Instrument Selection (Rubric) -->
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="mr-2 fas fa-file-alt"></i>Instrumen / Rubrik <span class="text-red-500">*</span>
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

                                <!-- Template Proposal (Required) -->
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="mr-2 fas fa-file-word"></i>Template Proposal <span class="text-red-500">*</span>
                                    </label>
                                    <select id="extra_id" name="extra_id"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                        required>
                                        <option value="">-- Pilih Template Proposal --</option>
                                        @foreach ($extras as $extra)
                                            <option value="{{ $extra->id }}">
                                                {{ $extra->extra_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        Pilih template proposal yang akan digunakan untuk penilaian
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="mr-2 fas fa-folder"></i>Grup Proposal <span class="text-red-500">*</span>
                                    </label>
                                    <select id="proposal_group" name="proposal_group"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                        onchange="loadProposalsFromGroup(this.value)"
                                        required>
                                        <option value="">-- Pilih Grup Proposal --</option>
                                        @foreach ($groups as $g)
                                            <option value="{{ $g->id }}" data-scheme="{{ $g->scheme }}"
                                                data-uploaded-at="{{ $g->uploaded_at }}">
                                                {{ $g->display_name ?? $g->group_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($groups->isEmpty())
                                        <p class="mt-2 text-sm text-yellow-600 dark:text-yellow-400">
                                            <i class="mr-1 fas fa-exclamation-triangle"></i>
                                            Tidak ada grup proposal dengan tipe "current". Silakan upload proposal terlebih dahulu.
                                        </p>
                                    @else
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                            <i class="mr-1 fas fa-info-circle"></i>
                                            {{ $groups->count() }} grup tersedia
                                        </p>
                                    @endif
                                    <div id="proposalLoadStatus" class="mt-2 text-sm"></div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-2">
                                    <button type="submit" id="testModelBtn"
                                        class="flex-1 px-4 py-2.5 text-white {{ $buttonClass }} font-medium rounded-lg text-sm">
                                        <i class="mr-2 fas fa-play-circle"></i>
                                        Mulai Penilaian
                                    </button>
                                    <a href="{{ route('tools') }}"
                                        class="px-4 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm transition-all duration-200 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
                                        <i class="mr-2 fas fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Results Display -->
                <div id="testResults" class="hidden p-6 mt-6 bg-gray-50 rounded-xl dark:bg-gray-700/50">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">
                            <i class="mr-2 fas fa-chart-line"></i>Hasil Tes
                        </h4>
                        <button id="closeResultsBtn" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div id="resultsContent"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
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
                    const extraId = document.getElementById('extra_id').value;
                    const assessmentType = document.getElementById('assessment_type').value;
                    
                    // Get rubric details
                    const rubricSelect = document.getElementById('rubric_id');
                    const selectedRubric = rubricSelect.options[rubricSelect.selectedIndex];
                    const rubricName = selectedRubric.getAttribute('data-rubric-name');
                    const filePath = selectedRubric.getAttribute('data-file-path');
                    const filePath2 = selectedRubric.getAttribute('data-file-path-2');

                    // Validate
                    if (!rubricId || !proposalGroupId || !extraId) {
                        showNotification('Harap isi semua field yang wajib (Rubrik, Grup Proposal, Template Proposal)', 'error');
                        testBtn.disabled = false;
                        testBtn.innerHTML = originalText;
                        return;
                    }

                    // Build payload
                    const payload = {
                        proposal_group: parseInt(proposalGroupId),
                        rubric_id: parseInt(rubricId),
                        extra_id: extraId,
                        assessment_type: assessmentType // ✅ Tambahan key assessment_type
                    };

                    // Build preview payload lengkap untuk debugging (sebelum dikirim)
                    if (window.selectedProposals && window.selectedGroup) {
                        const baseUrl = "http://72.61.215.182";
                        
                        // Build instrument object
                        const instrument = {};
                        if (filePath) {
                            instrument.administrasi = `${baseUrl}/storage/${filePath}`;
                        }
                        if (filePath2) {
                            instrument.substansi = `${baseUrl}/storage/${filePath2}`;
                        }
                        
                        // Build extra_path (sekarang wajib)
                        let extraPathPreview = `${baseUrl}/storage/extras/[file_akan_diambil_dari_database]`;
                        if (extraId) {
                            const extraSelect = document.getElementById('extra_id');
                            const selectedExtra = extraSelect.options[extraSelect.selectedIndex];
                            if (selectedExtra) {
                                extraPathPreview = `${baseUrl}/storage/extras/${selectedExtra.text}`;
                            }
                        }
                        
                        const previewPayload = {
                            username: "{{ Auth::check() ? Auth::user()->name : 'guest' }}",
                            scheme: rubricName,
                            year: window.selectedGroup.uploaded_at ? new Date(window.selectedGroup.uploaded_at).getFullYear() : new Date().getFullYear(),
                            assessment_type: assessmentType,
                            ml_sub: true,
                            instrument: instrument,
                            extra_path: extraPathPreview,
                            proposal_group: window.selectedGroup.id,
                            proposals: window.selectedProposals.map(p => ({
                                id_proposal: p.id,
                                filename: p.filename,
                                filepath: `${baseUrl}/storage/${p.path}`,
                                status: p.assessment_status || 0
                            }))
                        };
                        
                        // LOG: Preview payload LENGKAP yang akan dikirim
                        console.log('\n%c╔═══════════════════════════════════════════════════════════════╗', 'color: #3b82f6; font-weight: bold');
                        console.log('%c║      📤 PREVIEW PAYLOAD LENGKAP (yang akan dikirim)         ║', 'color: #3b82f6; font-weight: bold');
                        console.log('%c╚═══════════════════════════════════════════════════════════════╝', 'color: #3b82f6; font-weight: bold');
                        console.log('\n%c📊 Payload Summary:', 'color: #10b981; font-weight: bold; font-size: 12px');
                        console.log('%c├─ Username: ' + previewPayload.username, 'color: #3b82f6');
                        console.log('%c├─ Scheme: ' + previewPayload.scheme, 'color: #3b82f6');
                        console.log('%c├─ Year: ' + previewPayload.year, 'color: #3b82f6');
                        console.log('%c├─ Assessment Type: ' + previewPayload.assessment_type, 'color: #8b5cf6; font-weight: bold');
                        console.log('%c├─ ML Sub: ' + previewPayload.ml_sub, 'color: #10b981; font-weight: bold');
                        console.log('%c├─ Proposal Group ID: ' + previewPayload.proposal_group, 'color: #3b82f6');
                        console.log('%c├─ Extra Path: ' + previewPayload.extra_path, 'color: #3b82f6');
                        console.log('%c└─ Total Proposals: ' + previewPayload.proposals.length, 'color: #3b82f6');
                        
                        console.log('\n%c📋 FULL JSON PAYLOAD (Preview - akan di-build ulang oleh server):', 'color: #f59e0b; font-weight: bold; font-size: 13px; background: #78350f; padding: 4px 8px; border-radius: 4px');
                        console.log('%c┌' + '─'.repeat(63) + '┐', 'color: #f59e0b');
                        console.log(JSON.stringify(previewPayload, null, 2));
                        console.log('%c└' + '─'.repeat(63) + '┘', 'color: #f59e0b');
                        console.log('%c' + '─'.repeat(65), 'color: #6b7280');
                    } else {
                        console.log('\n%c⚠️  Pilih Proposal Group dulu untuk melihat preview lengkap', 'color: #f59e0b; font-weight: bold');
                    }

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

                        // LOG: Response dari server dalam format JSON yang rapi
                        console.log('\n%c╔═══════════════════════════════════════════════════════════════╗', 'color: #10b981; font-weight: bold');
                        console.log('%c║      ✅ PAYLOAD AKTUAL YANG DIKIRIM KE AI SERVICE            ║', 'color: #10b981; font-weight: bold');
                        console.log('%c╚═══════════════════════════════════════════════════════════════╝', 'color: #10b981; font-weight: bold');
                        
                        if (data.sent_payload) {
                            console.log('\n%c🚀 PAYLOAD SUMMARY:', 'color: #f59e0b; font-weight: bold; font-size: 13px');
                            console.log('%c├─ Assessment Type: ' + data.sent_payload.assessment_type, 'color: #8b5cf6; font-weight: bold');
                            console.log('%c├─ ML Sub: ' + data.sent_payload.ml_sub, 'color: #10b981; font-weight: bold');
                            console.log('%c├─ Username: ' + data.sent_payload.username, 'color: #3b82f6');
                            console.log('%c├─ Scheme: ' + data.sent_payload.scheme, 'color: #3b82f6');
                            console.log('%c├─ Year: ' + data.sent_payload.year, 'color: #3b82f6');
                            console.log('%c├─ Proposal Group ID: ' + data.sent_payload.proposal_group, 'color: #3b82f6');
                            console.log('%c├─ Extra Path: ' + data.sent_payload.extra_path, 'color: #3b82f6');
                            console.log('%c└─ Total Proposals: ' + (data.sent_payload.proposals?.length || 0), 'color: #3b82f6');
                            
                            console.log('\n%c📄 INSTRUMENT:', 'color: #f59e0b; font-weight: bold');
                            if (data.sent_payload.instrument) {
                                console.log(JSON.stringify(data.sent_payload.instrument, null, 2));
                            } else {
                                console.log('%cNo instrument data', 'color: #6b7280');
                            }
                            
                            if (data.sent_payload.proposals && data.sent_payload.proposals.length > 0) {
                                console.log('\n%c📑 PROPOSALS LIST:', 'color: #f59e0b; font-weight: bold');
                                console.log(JSON.stringify(data.sent_payload.proposals, null, 2));
                            }
                            
                            console.log('\n%c📋 FULL JSON PAYLOAD (Copy untuk testing API):', 'color: #10b981; font-weight: bold; font-size: 14px; background: #065f46; padding: 4px 8px; border-radius: 4px');
                            console.log('%c┌' + '─'.repeat(63) + '┐', 'color: #10b981');
                            console.log(JSON.stringify(data.sent_payload, null, 2));
                            console.log('%c└' + '─'.repeat(63) + '┘', 'color: #10b981');
                            
                            console.log('\n%c💡 API INFO:', 'color: #06b6d4; font-weight: bold');
                            console.log('%c├─ Endpoint: ' + (data.ai_endpoint || 'Not specified'), 'color: #06b6d4');
                            console.log('%c├─ Method: POST', 'color: #06b6d4');
                            console.log('%c├─ Content-Type: application/json', 'color: #06b6d4');
                            console.log('%c└─ Timestamp: ' + data.timestamp, 'color: #06b6d4');
                            
                            if (data.ai_response) {
                                console.log('\n%c🤖 AI SERVICE RESPONSE:', 'color: #8b5cf6; font-weight: bold; font-size: 13px');
                                console.log(JSON.stringify(data.ai_response, null, 2));
                            }
                        } else {
                            console.log('\n%c⚠️  No sent_payload in response', 'color: #f59e0b; font-weight: bold');
                            console.log(JSON.stringify(data, null, 2));
                        }
                        
                        console.log('\n%c' + '═'.repeat(65), 'color: #10b981; font-weight: bold');

                        // Show success notification
                        showNotification('Request sent successfully to AI service!', 'success');

                        // Get full payload from response
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
                                        <strong>Assessment Type:</strong> ${fullPayload.assessment_type || 'N/A'}<br>
                                        Processing ${fullPayload.proposals ? fullPayload.proposals.length : 0} proposal(s) using <strong>${fullPayload.scheme}</strong> scheme for year <strong>${fullPayload.year}</strong>.
                                        ${fullPayload.instrument ? `<br>Instrument: ${fullPayload.instrument.administrasi ? 'Administrasi ✓' : ''} ${fullPayload.instrument.substansi ? 'Substansi ✓' : ''}` : ''}
                                    </div>
                                </div>

                                <details class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
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

                                <div class="flex justify-center mt-4">
                                    <a href="/proposal-results" 
                                        class="inline-flex items-center px-6 py-3 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm transition-colors duration-200 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        <i class="mr-2 fas fa-chart-bar"></i>
                                        Lihat Hasil Penilaian
                                    </a>
                                </div>
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
