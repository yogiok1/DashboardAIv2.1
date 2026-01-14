@extends('layouts.admin')

@section('title', 'Group Details - ' . $group->group_name)
@section('header-title', 'Detail Grup Proposal')

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
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Main Group Info -->
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Group Information</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Group Name -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Group Name
                                </label>
                                <div class="flex items-center p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                    <i class="mr-3 text-gray-400 fas fa-folder"></i>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $group->group_name }}</span>
                                </div>
                            </div>

                            <!-- Group Type -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Type
                                </label>
                                <div class="p-3">
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                        {{ $group->type === 'current' ? 'text-green-800 bg-green-100 dark:bg-green-900 dark:text-green-300' : 'text-blue-800 bg-blue-100 dark:bg-blue-900 dark:text-blue-300' }}">
                                        <i class="mr-1.5 fas {{ $group->type === 'current' ? 'fa-bolt' : 'fa-history' }}"></i>
                                        {{ ucfirst($group->type) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Scheme -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Scheme
                                </label>
                                <div class="flex items-center p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                    <i class="mr-3 text-gray-400 fas fa-project-diagram"></i>
                                    <span class="text-gray-900 dark:text-white">{{ $group->scheme }}</span>
                                </div>
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Status
                                </label>
                                <div class="p-3">
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                        {{ $group->status === 'completed' ? 'text-emerald-800 bg-emerald-100 dark:bg-emerald-900 dark:text-emerald-300' : 'text-yellow-800 bg-yellow-100 dark:bg-yellow-900 dark:text-yellow-300' }}">
                                        <i class="mr-1.5 fas {{ $group->status === 'completed' ? 'fa-check-circle' : 'fa-sync-alt' }}"></i>
                                        {{ ucfirst($group->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Total Files -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Total Files
                                </label>
                                <div class="flex items-center p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                    <i class="mr-3 text-gray-400 fas fa-file-pdf"></i>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $group->total_files }} files</span>
                                </div>
                            </div>

                            <!-- Uploaded At -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Uploaded At
                                </label>
                                <div class="flex items-center p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                    <i class="mr-3 text-gray-400 fas fa-calendar"></i>
                                    <span class="text-gray-900 dark:text-white">{{ $group->uploaded_at?->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div>
                <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Quick Actions</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('results.index') }}"
                                class="flex items-center w-full px-4 py-3 text-sm font-medium text-gray-700 transition-all duration-200 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                <i class="mr-3 text-gray-500 fas fa-arrow-left"></i>
                                Back to Results
                            </a>

                            <button
                                class="flex items-center w-full px-4 py-3 text-sm font-medium text-blue-700 transition-all duration-200 rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:bg-blue-900/30">
                                <i class="mr-3 text-blue-500 fas fa-download"></i>
                                Export Group Data
                            </button>

                            <button
                                class="flex items-center w-full px-4 py-3 text-sm font-medium text-red-700 transition-all duration-200 rounded-lg bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/30">
                                <i class="mr-3 text-red-500 fas fa-trash"></i>
                                Delete Group
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="mt-6 bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Statistics</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Size</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ number_format($proposals->sum('size') / 1024 / 1024, 2) }} MB
                                    </span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div class="h-2 bg-blue-600 rounded-full" style="width: 75%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Average File Size</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ number_format($proposals->avg('size') / 1024, 2) }} KB
                                    </span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div class="h-2 bg-green-600 rounded-full" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proposal Files Table -->
        <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Proposal Files</h2>
                    <div class="flex items-center mt-2 space-x-2 sm:mt-0">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Showing {{ $proposals->count() }} files
                        </span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-file"></i>
                                    <span>Proposal</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-user"></i>
                                    <span>Proposer</span>
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
                                    <i class="fas fa-robot"></i>
                                    <span>AI Score</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-brain"></i>
                                    <span>ML Score</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-comment-alt"></i>
                                    <span>AI Notes</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Reviewer Score</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-comment"></i>
                                    <span>Reviewer Notes</span>
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
                        @foreach ($proposals as $p)
                            <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <i class="mr-3 text-red-500 fas fa-file-pdf"></i>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $p->filename }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $p->path }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $p->user->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = $p->evaluation_status ?? 'belum_dinilai';
                                        $statusConfig = [
                                            'belum_dinilai' => ['class' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300', 'icon' => 'fa-clock', 'text' => 'Belum Dinilai'],
                                            'sudah_dinilai_ai' => ['class' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300', 'icon' => 'fa-robot', 'text' => 'Sudah Dinilai AI'],
                                            'sudah_dinilai_reviewer' => ['class' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300', 'icon' => 'fa-check-circle', 'text' => 'Sudah Dinilai Reviewer']
                                        ];
                                        $config = $statusConfig[$status] ?? $statusConfig['belum_dinilai'];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['class'] }}">
                                        <i class="mr-1 fas {{ $config['icon'] }}"></i>
                                        {{ $config['text'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $p->ai_score ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $p->ml_score ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $p->ai_notes ? Str::limit($p->ai_notes, 50) : '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $p->reviewer_score ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $p->reviewer_notes ? Str::limit($p->reviewer_notes, 50) : '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ Storage::url($p->path) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1.5 text-sm text-blue-600 transition-all duration-200 bg-blue-50 rounded-lg hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:bg-blue-900/30"
                                            title="View PDF">
                                            <i class="mr-1.5 fas fa-eye"></i>
                                            View
                                        </a>
                                        <a href="{{ Storage::url($p->path) }}" download
                                            class="inline-flex items-center px-3 py-1.5 text-sm text-green-600 transition-all duration-200 bg-green-50 rounded-lg hover:bg-green-100 dark:bg-green-900/20 dark:text-green-300 dark:hover:bg-green-900/30"
                                            title="Download PDF">
                                            <i class="mr-1.5 fas fa-download"></i>
                                            Download
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($proposals->isEmpty())
                    <div class="p-8 text-center">
                        <i class="mx-auto mb-4 text-4xl text-gray-400 fas fa-file-pdf"></i>
                        <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">No proposal files found</h3>
                        <p class="text-gray-500 dark:text-gray-400">This group doesn't contain any proposal files.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add confirmation for delete action
            const deleteButton = document.querySelector('button:contains("Delete Group")');
            if (deleteButton) {
                deleteButton.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Delete Group?',
                        text: 'Are you sure you want to delete this group and all its files? This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                        color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Add delete logic here
                            Swal.fire(
                                'Deleted!',
                                'The group has been deleted successfully.',
                                'success'
                            );
                        }
                    });
                });
            }
        });
    </script>
@endpush
