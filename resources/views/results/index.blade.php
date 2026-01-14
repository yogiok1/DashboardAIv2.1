@extends('layouts.admin')

@section('title', 'Hasil Proposal')
@section('header-title', 'Hasil Proposal')

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
                    <li>
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <a href="{{ route('proposal-groups.index') }}"
                                class="text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                                Kelompok Proposal
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Rekap Hasil</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Filter Cards -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 xl:grid-cols-4">
            <!-- Administratif Card -->
            <a href="{{ $filter == 'administrasi' ? route('results.index') : route('results.index', ['filter' => 'administrasi']) }}" 
                class="block transition-all duration-200 bg-white border-2 {{ $filter == 'administrasi' ? 'border-blue-500 shadow-lg' : 'border-gray-200 hover:border-blue-300' }} dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-xl dark:bg-blue-900/30">
                            <i class="text-2xl text-blue-600 fas fa-file-alt dark:text-blue-400"></i>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                            {{ $counts['administrasi'] }} kelompok
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Administratif</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Hasil penilaian persyaratan administratif dan kelengkapan dokumen proposal.</p>
                </div>
            </a>

            <!-- Substantif Card -->
            <a href="{{ $filter == 'substansi' ? route('results.index') : route('results.index', ['filter' => 'substansi']) }}" 
                class="block transition-all duration-200 bg-white border-2 {{ $filter == 'substansi' ? 'border-orange-500 shadow-lg' : 'border-gray-200 hover:border-orange-300' }} dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-orange-100 rounded-xl dark:bg-orange-900/30">
                            <i class="text-2xl text-orange-600 fas fa-clipboard-check dark:text-orange-400"></i>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium text-orange-800 bg-orange-100 rounded-full dark:bg-orange-900/30 dark:text-orange-300">
                            {{ $counts['substansi'] }} kelompok
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Substantif</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Hasil penilaian kualitas konten dan substansi isi proposal penelitian.</p>
                </div>
            </a>

            <!-- All processes Card -->
            <a href="{{ $filter == 'gabungan_naive' ? route('results.index') : route('results.index', ['filter' => 'gabungan_naive']) }}" 
                class="block transition-all duration-200 bg-white border-2 {{ $filter == 'gabungan_naive' ? 'border-purple-500 shadow-lg' : 'border-gray-200 hover:border-purple-300' }} dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-xl dark:bg-purple-900/30">
                            <i class="text-2xl text-purple-600 fas fa-layer-group dark:text-purple-400"></i>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded-full dark:bg-purple-900/30 dark:text-purple-300">
                            {{ $counts['gabungan_naive'] }} kelompok
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Semua Proses</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Hasil penilaian gabungan administratif dan substantif secara bersamaan tanpa melakukan filter proposal (keseluruhan proposal).</p>
                </div>
            </a>

            <!-- All processes selected Card -->
            <a href="{{ $filter == 'gabungan_selected' ? route('results.index') : route('results.index', ['filter' => 'gabungan_selected']) }}" 
                class="block transition-all duration-200 bg-white border-2 {{ $filter == 'gabungan_selected' ? 'border-green-500 shadow-lg' : 'border-gray-200 hover:border-green-300' }} dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-xl dark:bg-green-900/30">
                            <i class="text-2xl text-green-600 fas fa-filter dark:text-green-400"></i>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">
                            {{ $counts['all_process_selected'] ?? 0 }} kelompok
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Semua Proses Terseleksi</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Hasil penilaian gabungan administratif dan substantif dengan melakukan filter proposal (hanya proposal yang lolos seleksi administrasi).</p>
                </div>
            </a>
        </div>

        <!-- Results List Card -->
        <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white">
                        Proposal yang Dinilai
                        @if($filter !== 'all')
                            @php
                                $filterLabels = [
                                    'administrasi' => 'Administratif',
                                    'substansi' => 'Substantif',
                                    'gabungan_naive' => 'Semua Proses',
                                    'gabungan_selected' => 'Semua Proses Terseleksi',
                                ];
                                $filterDisplay = $filterLabels[$filter] ?? ucwords(str_replace('_', ' ', $filter));
                            @endphp
                            <span class="ml-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                                ({{ $filterDisplay }})
                            </span>
                        @endif
                    </h2>
                    <div class="flex items-center mt-2 space-x-2 sm:mt-0">
                        @if($filter !== 'all')
                            <a href="{{ route('results.index') }}" 
                                class="px-3 py-1 text-sm text-gray-600 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                <i class="mr-1 fas fa-times"></i>Hapus Filter
                            </a>
                        @endif
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $groups->count() }} kelompok
                        </span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Tanggal Dinilai
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Kelompok
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Total Proposal
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Dinilai
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Progress
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Ringkasan Hasil
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Waktu Komputasi
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Evaluator
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Status
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Cek Status
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse($groups as $g)
                            @php
                                $allProposals = $g->proposals;
                                $totalProposals = $allProposals->count();
                                
                                // Count evaluated proposals (yang sudah terima JSON dan ada nilainya)
                                // Cek admin_score ATAU substansi_score (support kedua jenis Penilaian)
                                $evaluatedProposals = $allProposals->filter(function($p) {
                                    return $p->evaluation_id !== null && 
                                           $p->json_result !== null && 
                                           ($p->admin_score !== null || $p->substansi_score !== null);
                                });
                                
                                $evaluatedCount = $evaluatedProposals->count();
                                
                                // Count evaluation results from evaluated proposals
                                // Support multiple formats: 'LOLOS', 'Lolos', 'TIDAK_LOLOS', 'TIDAK LOLOS', 'Tidak Lolos'
                                $lolosCount = $evaluatedProposals->filter(function($p) {
                                    $mlResult = strtolower($p->ml_result ?? '');
                                    return str_contains($mlResult, 'lolos') && !str_contains($mlResult, 'tidak');
                                })->count();
                                
                                $tidakLolosCount = $evaluatedProposals->filter(function($p) {
                                    $mlResult = strtolower($p->ml_result ?? '');
                                    return str_contains($mlResult, 'tidak') && str_contains($mlResult, 'lolos');
                                })->count();
                                
                                // Calculate completion rate
                                $completionRate = $totalProposals > 0 ? ($evaluatedCount / $totalProposals) * 100 : 0;
                                
                                // Get latest evaluation date - gunakan evaluation_start_time
                                $latestEvaluation = $evaluatedProposals->max('evaluation_start_time');
                                
                                // Calculate computation times
                                $totalComputationSeconds = 0;
                                foreach ($evaluatedProposals as $ep) {
                                    if ($ep->processing_time) {
                                        // Parse processing_time, support formats:
                                        // "17 menit 27.26 detik" or "1m 23s" or "1.23s"
                                        $timeStr = $ep->processing_time;
                                        
                                        // Format: "17 menit 27.26 detik"
                                        if (preg_match('/(\d+)\s*menit\s*(\d+\.?\d*)\s*detik/', $timeStr, $matches)) {
                                            $totalComputationSeconds += ($matches[1] * 60) + floatval($matches[2]);
                                        }
                                        // Format: "1m 23s" or "1m 23.45s"
                                        elseif (preg_match('/(\d+)m\s*(\d+\.?\d*)s/', $timeStr, $matches)) {
                                            $totalComputationSeconds += ($matches[1] * 60) + floatval($matches[2]);
                                        }
                                        // Format: "1.23s"
                                        elseif (preg_match('/(\d+\.?\d*)\s*detik/', $timeStr, $matches)) {
                                            $totalComputationSeconds += floatval($matches[1]);
                                        }
                                        elseif (preg_match('/(\d+\.?\d*)s/', $timeStr, $matches)) {
                                            $totalComputationSeconds += floatval($matches[1]);
                                        }
                                    }
                                }
                                $avgComputationTime = $evaluatedCount > 0 ? $totalComputationSeconds / $evaluatedCount : 0;
                            @endphp
                            <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    @if($latestEvaluation)
                                        <div class="flex items-center space-y-1">
                                            <div class="flex items-center text-sm text-gray-900 dark:text-gray-100">
                                                <i class="mr-2 text-green-500 fas fa-calendar-check"></i>
                                                <div>
                                                    <div class="font-medium">{{ \Carbon\Carbon::parse($latestEvaluation)->format('d M Y') }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($latestEvaluation)->format('H:i') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <i class="mr-3 text-purple-500 fas fa-folder"></i>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $g->group_name }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $g->group_code }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                        {{ $totalProposals }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($evaluatedCount > 0)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 whitespace-nowrap">
                                                <i class="mr-1 fas fa-check-circle"></i>
                                                {{ $evaluatedCount }} / {{ $totalProposals }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 whitespace-nowrap">
                                                <i class="mr-1 fas fa-clock"></i>
                                                0 / {{ $totalProposals }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">                                    <div class="space-y-2">
                                        <!-- Progress Bar -->
                                        <div class="flex items-center space-x-2">
                                            <div class="flex-1 bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                                                <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full transition-all duration-500" 
                                                     style="width: {{ $completionRate }}%"></div>
                                            </div>
                                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 w-12">{{ number_format($completionRate, 0) }}%</span>
                                        </div>
                                        <!-- Progress Text -->
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $evaluatedCount }} dari {{ $totalProposals }} selesai
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">                                    @if($evaluatedCount > 0)
                                        <div class="flex items-center space-x-3">
                                            <div class="flex items-center px-3 py-1 rounded-lg bg-green-50 dark:bg-green-900/20">
                                                <i class="mr-2 text-green-600 fas fa-check-circle dark:text-green-400"></i>
                                                <span class="text-sm font-semibold text-green-800 dark:text-green-300">
                                                    {{ $lolosCount }}
                                                </span>
                                            </div>
                                            <div class="flex items-center px-3 py-1 rounded-lg bg-red-50 dark:bg-red-900/20">
                                                <i class="mr-2 text-red-600 fas fa-times-circle dark:text-red-400"></i>
                                                <span class="text-sm font-semibold text-red-800 dark:text-red-300">
                                                    {{ $tidakLolosCount }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            <i class="mr-1 fas fa-minus-circle"></i>
                                            Belum Ada Penilaian
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($evaluatedCount > 0)
                                        <div class="space-y-1">
                                            <div class="flex items-center text-sm text-gray-900 dark:text-gray-100">
                                                <i class="mr-2 text-blue-500 fas fa-clock"></i>
                                                <span class="font-semibold">Total:</span>
                                                <span class="ml-1">
                                                    @if($totalComputationSeconds >= 60)
                                                        {{ floor($totalComputationSeconds / 60) }}m {{ number_format(fmod($totalComputationSeconds, 60), 1) }}s
                                                    @else
                                                        {{ number_format($totalComputationSeconds, 1) }}s
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                <i class="mr-2 text-purple-500 fas fa-tachometer-alt"></i>
                                                <span class="font-medium">Rata-rata:</span>
                                                <span class="ml-1">
                                                    @if($avgComputationTime >= 60)
                                                        {{ floor($avgComputationTime / 60) }}m {{ number_format(fmod($avgComputationTime, 60), 1) }}s
                                                    @else
                                                        {{ number_format($avgComputationTime, 1) }}s
                                                    @endif
                                                </span>
                                                <span class="ml-1 text-gray-400">/proposal</span>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        // Ambil evaluator dari proposal yang sudah diPenilaian
                                        $evaluators = $evaluatedProposals->pluck('evaluator_username')->filter()->unique();
                                    @endphp
                                    @if($evaluators->isNotEmpty())
                                        <div class="flex flex-col space-y-1">
                                            @foreach($evaluators as $evaluator)
                                                <div class="flex items-center text-sm">
                                                    <div class="flex items-center justify-center w-8 h-8 mr-2 text-xs font-semibold text-white bg-purple-600 rounded-full dark:bg-purple-500">
                                                        {{ strtoupper(substr($evaluator, 0, 2)) }}
                                                    </div>
                                                    <span class="font-medium text-gray-900 dark:text-white">{{ $evaluator }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($completionRate >= 100)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                            <i class="mr-1 fas fa-check"></i>
                                            Selesai Dinilai
                                        </span>
                                    @elseif($completionRate > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                            <i class="mr-1 fas fa-spinner"></i>
                                            {{ number_format($completionRate, 0) }}% Dinilai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                            <i class="mr-1 fas fa-times"></i>
                                            Belum Dinilai
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <button onclick="checkGroupStatus({{ $g->id }}, '{{ $g->group_name }}')"
                                        class="inline-flex items-center px-3 py-1.5 text-sm text-blue-600 transition-all duration-200 bg-blue-50 rounded-lg hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:bg-blue-900/30"
                                        title="Cek Status Grup">
                                        <i class="mr-1.5 fas fa-sync-alt"></i>
                                        Cek Status
                                    </button>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('results.detail', $g->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 text-sm text-primary-600 transition-all duration-200 bg-primary-50 rounded-lg hover:bg-primary-100 dark:bg-primary-900/20 dark:text-primary-300 dark:hover:bg-primary-900/30"
                                            title="Lihat Detail">
                                            <i class="mr-1.5 fas fa-eye"></i>
                                            Lihat Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                            <i class="text-2xl text-gray-400 fas fa-folder-open"></i>
                                        </div>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Tidak Ada Kelompok Proposal</h3>
                                        <p class="mb-4 text-gray-500 dark:text-gray-400">Belum ada kelompok proposal yang diunggah.</p>
                                        <a href="{{ route('proposal-groups.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700">
                                            <i class="mr-2 fas fa-upload"></i>
                                            Unggah Proposal
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Function to check group status via API
    async function checkGroupStatus(groupId, groupName) {
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        
        // Show loading state
        button.disabled = true;
        button.innerHTML = '<i class="mr-1.5 fas fa-spinner fa-spin"></i>Checking...';
        
        try {
            const response = await fetch(`/api/proposal-groups/${groupId}/status`);
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || 'Failed to fetch status');
            }
            
            // Show modal with status information
            showStatusModal(groupName, data);
            
        } catch (error) {
            alert('Gagal mengecek status: ' + error.message);
            console.error('Error checking group status:', error);
        } finally {
            // Reset button
            button.disabled = false;
            button.innerHTML = originalHTML;
        }
    }
    
    // Function to show status modal
    function showStatusModal(groupName, data) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50';
        
        const statusInfo = data.group ? `
            <div class="space-y-3">
                <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <div class="text-sm font-medium text-blue-900 dark:text-blue-300">Informasi Grup</div>
                    <div class="mt-2 text-xs text-blue-800 dark:text-blue-400">
                        <div><strong>ID:</strong> ${data.group.id}</div>
                        <div><strong>Nama:</strong> ${data.group.group_name}</div>
                        <div><strong>Tipe:</strong> ${data.group.assessment_type || 'N/A'}</div>
                        <div><strong>Total Proposal:</strong> ${data.total_proposals || 0}</div>
                    </div>
                </div>
                
                <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <div class="text-sm font-medium text-green-900 dark:text-green-300">Status Penilaian</div>
                    <div class="mt-2 text-xs text-green-800 dark:text-green-400">
                        <div><strong>Selesai Dinilai:</strong> ${data.evaluated_count || 0} dari ${data.total_proposals || 0}</div>
                        <div><strong>Progress:</strong> ${data.completion_rate ? data.completion_rate.toFixed(1) : 0}%</div>
                        ${data.lolos_count !== undefined ? `<div><strong>Lolos:</strong> ${data.lolos_count}</div>` : ''}
                        ${data.tidak_lolos_count !== undefined ? `<div><strong>Tidak Lolos:</strong> ${data.tidak_lolos_count}</div>` : ''}
                    </div>
                </div>
                
                <details class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <summary class="text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">
                        <i class="mr-2 fas fa-code"></i>Data Lengkap (JSON)
                    </summary>
                    <pre class="mt-2 p-2 overflow-x-auto text-xs text-green-400 bg-gray-900 rounded">${JSON.stringify(data, null, 2)}</pre>
                </details>
            </div>
        ` : `
            <div class="p-4 text-sm text-gray-600 dark:text-gray-400">
                <pre class="overflow-x-auto">${JSON.stringify(data, null, 2)}</pre>
            </div>
        `;
        
        modal.innerHTML = `
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            <i class="mr-2 fas fa-info-circle text-blue-500"></i>
                            Status: ${groupName}
                        </h3>
                        <button onclick="this.closest('.fixed').remove()" 
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    ${statusInfo}
                </div>
                <div class="p-6 border-t border-gray-200 dark:border-gray-700 flex justify-end">
                    <button onclick="this.closest('.fixed').remove()" 
                        class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700">
                        Tutup
                    </button>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Close on backdrop click
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.remove();
            }
        });
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to table rows
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.1}s`;
            row.classList.add('animate-fade-in');
        });

        // Add hover effects to action buttons
        const actionButtons = document.querySelectorAll('a, button');
        actionButtons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush
