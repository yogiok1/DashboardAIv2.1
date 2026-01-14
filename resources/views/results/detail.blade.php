@extends('layouts.admin')

@section('title', 'Proposal Details - ' . $group->group_name)
@section('header-title', 'Detail Proposal')

@section('content')
    <div class="space-y-6">
        <!-- Back Button & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('results.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                <i class="mr-2 fas fa-arrow-left"></i>
                Kembali
            </a>
            <nav class="flex" aria-label="Breadcrumb">
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
                            <a href="{{ route('results.index') }}"
                                class="text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                                Results
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $group->group_name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Group Information Card -->
        <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Group Information</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="text-center">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-3 bg-blue-100 rounded-xl dark:bg-blue-900/30">
                            <i class="text-xl text-blue-600 fas fa-folder dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">Group Name</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 break-words px-2">{{ $group->group_name }}</p>
                    </div>

                    <div class="text-center">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-3 bg-green-100 rounded-xl dark:bg-green-900/30">
                            <i class="text-xl text-green-600 fas fa-file-pdf dark:text-green-400"></i>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">Total Proposals</h3>
                        <p class="text-xl sm:text-2xl font-bold text-green-600 dark:text-green-400">{{ $group->proposals->count() }}</p>
                    </div>

                    <div class="text-center">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-3 bg-purple-100 rounded-xl dark:bg-purple-900/30">
                            <i class="text-xl text-purple-600 fas fa-project-diagram dark:text-purple-400"></i>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">Scheme</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 break-words px-2">{{ $group->scheme }}</p>
                    </div>

                    <div class="text-center">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-3 bg-orange-100 rounded-xl dark:bg-orange-900/30">
                            <i class="text-xl text-orange-600 fas fa-calendar dark:text-orange-400"></i>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">Uploaded</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $group->uploaded_at?->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proposals List Card -->
        <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Proposals List</h2>
                    <div class="flex items-center mt-2 space-x-3 sm:mt-0">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $group->proposals->count() }} proposals
                        </span>
                        <div class="relative">
                            <select class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option>All Status</option>
                                <option>Pending</option>
                                <option>Reviewed</option>
                                <option>Accepted</option>
                                <option>Rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-hashtag"></i>
                                    <span>ID Proposal</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-layer-group"></i>
                                    <span>ID Group</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-file"></i>
                                    <span>Proposal File</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-user-check"></i>
                                    <span>Evaluator</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Status</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Administration - AI Score</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Substansi - AI Score</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-brain"></i>
                                    <span>ML Result</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-cog"></i>
                                    <span>Actions</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse($group->proposals as $p)
                            @php
                                $fileExtension = pathinfo($p->filename, PATHINFO_EXTENSION);

                                // Evaluation status: sudah dinilai jika ada JSON dan ada nilai (admin ATAU substansi)
                                $isEvaluated = $p->evaluation_id !== null && 
                                               $p->json_result !== null && 
                                               ($p->admin_score !== null || $p->substansi_score !== null);
                                
                                $status = $isEvaluated ? 'sudah_dinilai_ai' : 'belum_dinilai';
                                
                                $statusConfig = [
                                    'belum_dinilai' => ['class' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300', 'icon' => 'fa-clock', 'text' => 'Belum Dinilai'],
                                    'sudah_dinilai_ai' => ['class' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300', 'icon' => 'fa-check-circle', 'text' => 'Sudah Dinilai'],
                                ];
                                $config = $statusConfig[$status];
                            @endphp
                            <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-mono font-semibold bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                        #{{ $p->id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-mono font-semibold bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                                        #{{ $p->proposal_group_id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-red-100 rounded-lg dark:bg-red-900/30">
                                            <i class="text-red-600 fas fa-file-pdf dark:text-red-400"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-medium text-gray-900 truncate dark:text-white" title="{{ $p->filename }}">
                                                {{ Str::limit($p->filename, 40) }}
                                            </div>
                                            <div class="flex items-center mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                <i class="mr-1 fas fa-code"></i>
                                                {{ strtoupper($fileExtension) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $p->evaluator_username ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['class'] }}">
                                        <i class="mr-1 fas {{ $config['icon'] }}"></i>
                                        {{ $config['text'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $adminScore = $p->admin_score ?? '-';
                                        $adminStatus = $p->admin_status ?? 'PENDING';
                                        $adminBadgeConfig = [
                                            'LOLOS' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                            'TIDAK LOLOS' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                            'PENDING' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                                        ];
                                        $adminBadge = $adminBadgeConfig[$adminStatus] ?? $adminBadgeConfig['PENDING'];
                                    @endphp
                                    <div class="flex flex-col items-start">
                                        <span class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $adminScore }}</span>
                                        <span class="inline-flex items-center px-2 py-0.5 mt-1 rounded text-xs font-medium {{ $adminBadge }}">
                                            {{ $adminStatus }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                        {{ $p->substansi_score ? number_format($p->substansi_score, 1) : '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $mlResult = $p->ml_result ?? 'PENDING';
                                        $mlResultLower = strtolower($mlResult);
                                        
                                        // Determine badge style based on content
                                        if (str_contains($mlResultLower, 'lolos') && !str_contains($mlResultLower, 'tidak')) {
                                            $mlBadge = 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300';
                                            $mlResultDisplay = 'Lolos';
                                        } elseif (str_contains($mlResultLower, 'tidak') && str_contains($mlResultLower, 'lolos')) {
                                            $mlBadge = 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300';
                                            $mlResultDisplay = 'Tidak Lolos';
                                        } else {
                                            $mlBadge = 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                            $mlResultDisplay = 'Pending';
                                        }
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $mlBadge }}">
                                        {{ $mlResultDisplay }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <button onclick='openDetailModal(@json($p))'
                                            class="inline-flex items-center p-2 text-blue-600 transition-all duration-200 rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:bg-blue-900/30"
                                            title="View Details">
                                            <i class="w-4 h-4 fas fa-eye"></i>
                                        </button>
                                        <a href="{{ Storage::url($p->path) }}" target="_blank"
                                            class="inline-flex items-center p-2 text-green-600 transition-all duration-200 rounded-lg bg-green-50 hover:bg-green-100 dark:bg-green-900/20 dark:text-green-300 dark:hover:bg-green-900/30"
                                            title="View PDF">
                                            <i class="w-4 h-4 fas fa-file-pdf"></i>
                                        </a>
                                        <a href="{{ Storage::url($p->path) }}" download
                                            class="inline-flex items-center p-2 text-orange-600 transition-all duration-200 rounded-lg bg-orange-50 hover:bg-orange-100 dark:bg-orange-900/20 dark:text-orange-300 dark:hover:bg-orange-900/30"
                                            title="Download PDF">
                                            <i class="w-4 h-4 fas fa-download"></i>
                                        </a>
                                        <button onclick='viewJson(@json($p))'
                                            class="inline-flex items-center p-2 text-indigo-600 transition-all duration-200 rounded-lg bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-900/20 dark:text-indigo-300 dark:hover:bg-indigo-900/30"
                                            title="Lihat JSON">
                                            <i class="w-4 h-4 fas fa-code"></i>
                                        </button>
                                        <button
                                            class="inline-flex items-center p-2 text-purple-600 transition-all duration-200 rounded-lg bg-purple-50 hover:bg-purple-100 dark:bg-purple-900/20 dark:text-purple-300 dark:hover:bg-purple-900/30"
                                            title="Evaluate Proposal">
                                            <i class="w-4 h-4 fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                            <i class="text-2xl text-gray-400 fas fa-file-pdf"></i>
                                        </div>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No Proposals Found</h3>
                                        <p class="text-gray-500 dark:text-gray-400">This group doesn't contain any proposal files.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Summary Section -->
            @if($group->proposals->isNotEmpty())
            <div class="p-6 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $group->proposals->count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Files</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                            {{ number_format($group->proposals->sum('size') / 1024 / 1024, 2) }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Size (MB)</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                            {{ number_format($group->proposals->avg('size') / 1024, 2) }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Avg Size (KB)</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                            {{ $group->uploaded_at?->format('M d, Y') }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Upload Date</div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('results.index') }}"
                class="px-6 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors duration-200">
                <i class="mr-2 fas fa-arrow-left"></i>
                Back to Results
            </a>
            <button onclick="exportToCSV()"
                class="px-6 py-2.5 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm transition-colors duration-200 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <i class="mr-2 fas fa-file-csv"></i>
                Export CSV
            </button>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to table rows
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
            row.classList.add('animate-fade-in');
        });

        // Add hover effects to action buttons
        const actionButtons = document.querySelectorAll('a, button');
        actionButtons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
                this.style.transition = 'all 0.2s ease-in-out';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Status filter functionality
        const statusFilter = document.querySelector('select');
        statusFilter.addEventListener('change', function() {
            const status = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                if (status === 'all status') {
                    row.style.display = '';
                } else {
                    const statusCell = row.querySelector('td:nth-child(4) span');
                    if (statusCell && statusCell.textContent.toLowerCase().includes(status)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });
    });

    // Modal Functions
    function openDetailModal(proposal) {
        document.getElementById('detailModal').classList.remove('hidden');
        document.getElementById('modalFilename').textContent = proposal.filename;
        
        // Parse json_result
        let evaluationData = null;
        if (proposal.json_result) {
            try {
                evaluationData = typeof proposal.json_result === 'string' 
                    ? JSON.parse(proposal.json_result) 
                    : proposal.json_result;
            } catch(e) {
                console.error('Error parsing json_result:', e);
            }
        }
        
        // Generate description
        const descriptionContainer = document.getElementById('descriptionContent');
        descriptionContainer.innerHTML = generateDescription(proposal, evaluationData);
        
        // Display Evaluation Info
        const evalInfoContainer = document.getElementById('evaluationInfo');
        evalInfoContainer.innerHTML = formatEvaluationInfo(proposal, evaluationData);
        
        // Display Administrasi Items
        const administrasiContainer = document.getElementById('administrasiContent');
        if (evaluationData && evaluationData.details && evaluationData.details.administrasi) {
            administrasiContainer.innerHTML = formatAdministrasiItems(evaluationData.details.administrasi);
        } else {
            administrasiContainer.innerHTML = '<p class="text-gray-500 dark:text-gray-400 italic text-center py-8">Tidak ada data administrasi</p>';
        }
        
        // Display Substansi Items
        const substansiContainer = document.getElementById('substansiContent');
        if (evaluationData && evaluationData.details && evaluationData.details.substansi) {
            substansiContainer.innerHTML = formatSubstansiItems(evaluationData.details.substansi);
        } else {
            substansiContainer.innerHTML = '<p class="text-gray-500 dark:text-gray-400 italic text-center py-8">Tidak ada data substansi</p>';
        }
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    function formatEvaluationInfo(proposal, evaluationData) {
        const evalId = proposal.evaluation_id || '-';
        const evaluator = proposal.evaluator_username || '-';
        const startTime = proposal.evaluation_start_time || '-';
        const processingTime = proposal.processing_time || '-';
        const mlResult = proposal.ml_result || 'PENDING';
        
        const mlBadgeConfig = {
            'LOLOS': 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
            'TIDAK_LOLOS': 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
            'PENDING': 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
        };
        const mlBadge = mlBadgeConfig[mlResult] || mlBadgeConfig['PENDING'];
        
        // Display format
        const mlResultDisplay = mlResult === 'LOLOS' ? 'Lolos' : mlResult === 'TIDAK_LOLOS' ? 'Tidak Lolos' : 'Pending';
        
        return `
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-3">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-1">Evaluation ID</p>
                    <p class="text-sm font-mono text-gray-800 dark:text-gray-200">${evalId}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-3">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-1">Evaluator</p>
                    <p class="text-sm text-gray-800 dark:text-gray-200">${evaluator}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-3">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-1">Start Time</p>
                    <p class="text-sm text-gray-800 dark:text-gray-200">${startTime}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-3">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-1">Processing Time</p>
                    <p class="text-sm text-gray-800 dark:text-gray-200">${processingTime}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-3">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-1">Admin Score</p>
                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400">${proposal.admin_score || '-'}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-3">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-1">ML Result</p>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium ${mlBadge}">
                        ${mlResultDisplay}
                    </span>
                </div>
            </div>
        `;
    }

    function formatAdministrasiItems(administrasi) {
        if (!administrasi.items || !Array.isArray(administrasi.items)) {
            return '<p class="text-gray-500 dark:text-gray-400 italic text-center py-8">Tidak ada item administrasi</p>';
        }
        
        let html = '<div class="space-y-3">';
        
        administrasi.items.forEach((item, index) => {
            html += `
                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-start justify-between">
                        <h5 class="font-semibold text-sm text-gray-800 dark:text-gray-200">
                            ${index + 1}. ${item.indicator || 'No indicator'}
                        </h5>
                        <span class="ml-2 px-2.5 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 rounded-full text-xs font-bold whitespace-nowrap">
                            ${item.score || 0}
                        </span>
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        return html;
    }

    function formatSubstansiItems(substansi) {
        if (!substansi.items || !Array.isArray(substansi.items)) {
            return '<p class="text-gray-500 dark:text-gray-400 italic text-center py-8">Tidak ada item substansi</p>';
        }
        
        const maxItemScore = substansi.max_item_score || 10;
        let html = '<div class="space-y-3">';
        
        substansi.items.forEach((item, index) => {
            let scoreBadgeClass = '';
            const score = parseFloat(item.score) || 0;
            const percentage = (score / maxItemScore) * 100;
            
            if (percentage >= 80) {
                scoreBadgeClass = 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 border-green-500';
            } else if (percentage >= 60) {
                scoreBadgeClass = 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border-blue-500';
            } else {
                scoreBadgeClass = 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300 border-orange-500';
            }
            
            html += `
                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border-l-4 ${scoreBadgeClass}">
                    <div class="flex items-start justify-between mb-2">
                        <h5 class="font-semibold text-sm text-gray-800 dark:text-gray-200 flex-1">
                            ${index + 1}. ${item.indicator || 'No indicator'}
                        </h5>
                        <span class="ml-3 px-2.5 py-1 ${scoreBadgeClass} rounded-full text-xs font-bold whitespace-nowrap">
                            ${score}/${maxItemScore}
                        </span>
                    </div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">${item.reason || 'Tidak ada keterangan'}</p>
                </div>
            `;
        });
        
        // Add summary as paragraph
        if (substansi.summary && typeof substansi.summary === 'string') {
            html += `
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-lg p-4 shadow-md border border-purple-200 dark:border-purple-700">
                    <h5 class="font-bold text-sm mb-2 text-purple-900 dark:text-purple-200 flex items-center">
                        <i class="fas fa-chart-line mr-2"></i>Ringkasan Substansi
                    </h5>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">${substansi.summary}</p>
                </div>
            `;
        }
        
        // Add Final Summary from substansi_summary field
        if (substansi.final_summary || substansi.summary?.final_summary) {
            const finalSummary = substansi.final_summary || substansi.summary?.final_summary || '';
            html += `
                <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/30 dark:to-indigo-800/30 rounded-lg p-4 shadow-md border border-indigo-200 dark:border-indigo-700 mt-4">
                    <h5 class="font-bold text-sm mb-3 text-indigo-900 dark:text-indigo-200 flex items-center">
                        <i class="fas fa-clipboard-check mr-2"></i>Ringkasan Akhir Penilaian
                    </h5>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">${finalSummary}</p>
                </div>
            `;
        }
        
        html += '</div>';
        return html;
    }

    function generateDescription(proposal, evaluationData) {
        const substansiScore = parseFloat(proposal.substansi_score) || 0;
        const substansiMaxScore = proposal.substansi_max_score || 100;
        const adminScore = proposal.admin_score || '-';
        const adminStatus = proposal.admin_status || 'PENDING';
        const mlResult = proposal.ml_result || 'PENDING';
        
        // Calculate admin items count for denominator
        let adminMaxScore = 6; // default
        if (evaluationData && evaluationData.details && evaluationData.details.administrasi && evaluationData.details.administrasi.items) {
            adminMaxScore = evaluationData.details.administrasi.items.length;
        }
        
        const statusBadge = adminStatus === 'LOLOS' 
            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' 
            : adminStatus === 'TIDAK_LOLOS'
            ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'
            : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
        
        const mlBadge = mlResult === 'LOLOS'
            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'
            : mlResult === 'TIDAK_LOLOS'
            ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'
            : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
        
        const mlResultDisplay = mlResult === 'LOLOS' ? 'Lolos' : mlResult === 'TIDAK_LOLOS' ? 'Tidak Lolos' : 'Pending';
        
        return `
            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                Proposal ini telah melalui proses Penilaian otomatis dengan skor substansi 
                <span class="font-bold px-2 py-0.5 rounded bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">${substansiScore.toFixed(2)}/${substansiMaxScore}</span>
                dan skor administrasi <span class="font-bold px-2 py-0.5 rounded bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">${adminScore}/${adminMaxScore}</span>.
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed mt-2">
                Status administrasi: <span class="font-semibold px-2 py-0.5 rounded ${statusBadge}">${adminStatus}</span>.
                Hasil klasifikasi ML: <span class="font-semibold px-2 py-0.5 rounded ${mlBadge}">${mlResultDisplay}</span>.
            </p>
        `;
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('detailModal');
        if (event.target === modal) {
            closeDetailModal();
        }
        
        const jsonModal = document.getElementById('jsonModal');
        if (event.target === jsonModal) {
            closeJsonModal();
        }
    });
    
    // JSON Modal Functions
    function viewJson(proposal) {
        const modal = document.getElementById('jsonModal');
        const jsonContent = document.getElementById('jsonContent');
        const proposalTitle = document.getElementById('jsonProposalTitle');
        
        proposalTitle.textContent = proposal.filename;
        
        // Cek manual_json terlebih dahulu, baru json_result
        const jsonSource = proposal.manual_json || proposal.json_result;
        
        if (jsonSource) {
            try {
                const jsonData = typeof jsonSource === 'string' 
                    ? JSON.parse(jsonSource) 
                    : jsonSource;
                jsonContent.textContent = JSON.stringify(jsonData, null, 2);
            } catch(e) {
                jsonContent.textContent = 'Error parsing JSON: ' + e.message;
            }
        } else {
            jsonContent.textContent = '{\n  "message": "Belum ada data JSON untuk proposal ini"\n}';
        }
        
        modal.classList.remove('hidden');
    }
    
    function closeJsonModal() {
        document.getElementById('jsonModal').classList.add('hidden');
    }
    
    function copyJson() {
        const jsonContent = document.getElementById('jsonContent');
        navigator.clipboard.writeText(jsonContent.textContent).then(() => {
            // Show success feedback
            const copyBtn = event.currentTarget;
            const originalHtml = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Tersalin!';
            copyBtn.classList.add('bg-green-600');
            copyBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
            
            setTimeout(() => {
                copyBtn.innerHTML = originalHtml;
                copyBtn.classList.remove('bg-green-600');
                copyBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
            }, 2000);
        });
    }
    
    // Export to CSV Function
    function exportToCSV() {
        const proposals = @json($group->proposals);
        
        // Define CSV headers
        const headers = ['No', 'Filename', 'Scheme', 'Type', 'Status Admin', 'Score Substansi', 'ML Result', 'Size (KB)', 'Uploaded At'];
        
        // Convert proposals to CSV rows
        const rows = proposals.map((proposal, index) => {
            // Parse JSON result
            let adminStatus = 'Pending';
            let substansiScore = 0;
            let mlResult = 'Pending';
            
            if (proposal.json_result) {
                try {
                    const jsonData = typeof proposal.json_result === 'string' 
                        ? JSON.parse(proposal.json_result) 
                        : proposal.json_result;
                    
                    if (jsonData.details) {
                        adminStatus = jsonData.details.administrasi?.status || 'Pending';
                        substansiScore = jsonData.details.substansi?.score?.toFixed(2) || 0;
                    }
                    
                    if (jsonData.ml_result) {
                        const mlLower = jsonData.ml_result.toLowerCase();
                        if (mlLower.includes('lolos') && !mlLower.includes('tidak')) {
                            mlResult = 'Lolos';
                        } else if (mlLower.includes('tidak') && mlLower.includes('lolos')) {
                            mlResult = 'Tidak Lolos';
                        }
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            }
            
            return [
                index + 1,
                `"${proposal.filename.replace(/"/g, '""')}"`, // Escape quotes
                `"${proposal.scheme || ''}"`,
                `"${proposal.type || ''}"`,
                adminStatus,
                substansiScore,
                mlResult,
                (proposal.size / 1024).toFixed(2),
                proposal.created_at || ''
            ];
        });
        
        // Combine headers and rows
        const csvContent = [
            headers.join(','),
            ...rows.map(row => row.join(','))
        ].join('\n');
        
        // Create blob and download
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        
        link.setAttribute('href', url);
        link.setAttribute('download', `proposals_{{ $group->group_name }}_${new Date().toISOString().split('T')[0]}.csv`);
        link.style.visibility = 'hidden';
        
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>

<!-- JSON Modal -->
<div id="jsonModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 dark:bg-opacity-70 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 dark:from-indigo-700 dark:to-indigo-800 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-white/20 rounded-lg">
                            <i class="fas fa-code text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Data JSON Proposal</h3>
                            <p id="jsonProposalTitle" class="text-sm text-indigo-100 mt-0.5"></p>
                        </div>
                    </div>
                    <button onclick="closeJsonModal()" 
                        class="text-white/80 hover:text-white transition-all hover:rotate-90 duration-300 p-2 hover:bg-white/10 rounded-lg">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6 bg-gray-50 dark:bg-gray-900 overflow-y-auto flex-1">
                <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                    <pre id="jsonContent" class="text-sm text-green-400 font-mono whitespace-pre-wrap"></pre>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 px-6 py-4">
                <div class="flex justify-between">
                    <button onclick="copyJson()" 
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-200 flex items-center space-x-2">
                        <i class="fas fa-copy"></i>
                        <span>Salin JSON</span>
                    </button>
                    <button onclick="closeJsonModal()" 
                        class="px-6 py-2.5 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-200 flex items-center space-x-2">
                        <i class="fas fa-times-circle"></i>
                        <span>Tutup</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Assessment Modal -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 backdrop-blur-sm">
    <div class="relative top-8 mx-auto p-6 w-11/12 max-w-7xl mb-8">
        <!-- Modal Container -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-800 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-white/20 rounded-lg">
                            <i class="fas fa-clipboard-list text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Detail Penilaian Proposal</h3>
                            <p id="modalFilename" class="text-sm text-blue-100 mt-0.5"></p>
                        </div>
                    </div>
                    <button onclick="closeDetailModal()" 
                        class="text-white/80 hover:text-white transition-all hover:rotate-90 duration-300 p-2 hover:bg-white/10 rounded-lg">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body - 3 Columns -->
            <div class="p-6 bg-gray-50 dark:bg-gray-900">
                <!-- Description Box -->
                <div class="mb-5">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-5 shadow-lg border border-gray-200 dark:border-gray-700">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                    <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-lg"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-bold mb-2 text-gray-900 dark:text-white">
                                    Deskripsi Penilaian
                                </h4>
                                <div id="descriptionContent" class="text-gray-700 dark:text-gray-300">
                                    <!-- Description will be inserted here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Evaluation Info -->
                <div class="mb-5">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-5 shadow-lg border border-gray-200 dark:border-gray-700">
                        <h4 class="text-base font-bold mb-3 text-gray-900 dark:text-white flex items-center">
                            <i class="fas fa-cogs mr-2 text-indigo-600 dark:text-indigo-400"></i>
                            Informasi Penilaian
                        </h4>
                        <div id="evaluationInfo">
                            <!-- Evaluation info will be inserted here -->
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                    <!-- Column 1: Administrasi -->
                    <div class="lg:col-span-1">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl p-1 shadow-lg h-full">
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 h-full flex flex-col">
                                <h4 class="text-base font-bold mb-4 text-gray-900 dark:text-white flex items-center">
                                    <i class="fas fa-file-alt mr-2 text-blue-600 dark:text-blue-400"></i>
                                    Penilaian Administrasi
                                </h4>
                                <div id="administrasiContent" class="flex-1 max-h-[calc(100vh-280px)] overflow-y-auto custom-scrollbar pr-2">
                                    <!-- Administrasi items will be inserted here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Substansi -->
                    <div class="lg:col-span-1">
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl p-1 shadow-lg h-full">
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 h-full flex flex-col">
                                <h4 class="text-base font-bold mb-4 text-gray-900 dark:text-white flex items-center">
                                    <i class="fas fa-clipboard-check mr-2 text-purple-600 dark:text-purple-400"></i>
                                    Penilaian Substansi
                                </h4>
                                <div id="substansiContent" class="flex-1 max-h-[calc(100vh-280px)] overflow-y-auto custom-scrollbar pr-2">
                                    <!-- Substansi items will be inserted here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 px-6 py-4">
                <div class="flex justify-end">
                    <button onclick="closeDetailModal()" 
                        class="px-6 py-2.5 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-200 flex items-center space-x-2">
                        <i class="fas fa-times-circle"></i>
                        <span>Tutup</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out forwards;
        opacity: 0;
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

    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.3);
    }

    .dark .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
    }

    .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>
@endpush
