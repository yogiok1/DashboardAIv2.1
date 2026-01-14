@extends('layouts.admin')

@section('title', 'Aggregation Settings')
@section('header-title', 'Pengaturan Agregasi')

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
                            <a href=""
                                class="text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                                AI Configuration
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Aggregation Settings</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
                <div class="flex items-center">
                    <i class="mr-2 text-green-500 fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Input Form Card -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Add Aggregation Settings</h2>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('aggregate.store') }}" method="POST" id="aggregationForm">
                            @csrf

                            <div class="space-y-4">
                                <!-- Machine Learning Weight -->
                                <div>
                                    <label for="ml_weight" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Machine Learning Weight (%)
                                    </label>
                                    <div class="relative">
                                        <input type="number" id="ml_weight" name="ml_weight"
                                            class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                            placeholder="e.g., 60"
                                            min="0" max="100" required>
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="text-gray-400 fas fa-microchip"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- AI Genera Weight -->
                                <div>
                                    <label for="ai_genera_weight" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        AI Genera Weight (%)
                                    </label>
                                    <div class="relative">
                                        <input type="number" id="ai_genera_weight" name="ai_genera_weight"
                                            class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                            placeholder="e.g., 40"
                                            min="0" max="100" required>
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="text-gray-400 fas fa-robot"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Percentage Display -->
                                <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Total Weight:</span>
                                        <span id="totalPercentage" class="text-sm font-bold text-gray-900 dark:text-white">0%</span>
                                    </div>
                                    <div class="w-full h-2 mt-2 bg-gray-200 rounded-full dark:bg-gray-600">
                                        <div id="totalBar" class="h-2 transition-all duration-300 rounded-full bg-gradient-to-r from-blue-500 to-purple-500" style="width: 0%"></div>
                                    </div>
                                    <div id="percentageWarning" class="hidden mt-2 text-xs text-red-600 dark:text-red-400">
                                        <i class="mr-1 fas fa-exclamation-triangle"></i>
                                        Total must equal 100%
                                    </div>
                                </div>

                                <!-- Status Toggle -->
                                <div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="status" name="status" value="1"
                                            class="w-4 h-4 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="status" class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Use this composition
                                        </label>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        Activate this weight configuration for the system
                                    </p>
                                </div>
                            </div>

                            <div class="flex justify-end mt-6">
                                <button type="submit" id="submitButton"
                                    class="px-6 py-2.5 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm transition-colors duration-200 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class="mr-2 fas fa-save"></i>
                                    Save Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Settings List & Current Status -->
            <div class="lg:col-span-2">
                <!-- Current Active Settings -->
                @php
                    $activeSetting = $data->where('status', true)->first();
                @endphp

                @if($activeSetting)
                <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Current Active Settings</h2>
                            <span class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">
                                Active
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Machine Learning Card -->
                            <div class="p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl dark:from-blue-900/20 dark:to-indigo-900/20">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                            <i class="text-blue-600 fas fa-microchip dark:text-blue-400"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900 dark:text-white">Machine Learning</h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">Weight Percentage</p>
                                        </div>
                                    </div>
                                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $activeSetting->ml_weight }}%</span>
                                </div>
                                <div class="w-full h-2 bg-blue-200 rounded-full dark:bg-blue-700">
                                    <div class="h-2 bg-blue-500 rounded-full" style="width: {{ $activeSetting->ml_weight }}%"></div>
                                </div>
                            </div>

                            <!-- AI Genera Card -->
                            <div class="p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl dark:from-purple-900/20 dark:to-pink-900/20">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-purple-100 rounded-lg dark:bg-purple-900/30">
                                            <i class="text-purple-600 fas fa-robot dark:text-purple-400"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900 dark:text-white">AI Genera</h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">Weight Percentage</p>
                                        </div>
                                    </div>
                                    <span class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $activeSetting->ai_genera_weight }}%</span>
                                </div>
                                <div class="w-full h-2 bg-purple-200 rounded-full dark:bg-purple-700">
                                    <div class="h-2 bg-purple-500 rounded-full" style="width: {{ $activeSetting->ai_genera_weight }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                            <i class="mr-2 fas fa-info-circle"></i>
                            Active since {{ $activeSetting->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Current Status</h2>
                    </div>
                    <div class="p-6 text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-2xl dark:bg-yellow-900/20">
                            <i class="text-2xl text-yellow-600 fas fa-exclamation-triangle dark:text-yellow-400"></i>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No Active Settings</h3>
                        <p class="text-gray-500 dark:text-gray-400">No aggregation settings are currently active.</p>
                    </div>
                </div>
                @endif

                <!-- Settings List -->
                <div class="mt-6 bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Aggregation Settings List</h2>
                            <div class="flex items-center mt-2 space-x-2 sm:mt-0">
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    Total: {{ $data->count() }} records
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                        ML Weight
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                        AI Genera Weight
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                        Total
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                        Created
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @forelse($data as $row)
                                    <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $row->id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <span class="inline-block w-3 h-3 mr-2 bg-blue-500 rounded-full"></span>
                                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $row->ml_weight }}%
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <span class="inline-block w-3 h-3 mr-2 bg-purple-500 rounded-full"></span>
                                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $row->ai_genera_weight }}%
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                {{ $row->ml_weight + $row->ai_genera_weight }}%
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($row->status)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                    <i class="mr-1 fas fa-check"></i>
                                                    Active
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    <i class="mr-1 fas fa-times"></i>
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                            <div class="flex items-center">
                                                <i class="mr-2 text-gray-400 fas fa-clock"></i>
                                                {{ $row->created_at->format('M d, Y') }}
                                            </div>
                                            <div class="text-xs text-gray-400 dark:text-gray-500">
                                                {{ $row->created_at->format('H:i') }}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                                    <i class="text-2xl text-gray-400 fas fa-sliders-h"></i>
                                                </div>
                                                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No Settings Found</h3>
                                                <p class="text-gray-500 dark:text-gray-400">No aggregation settings available yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mlInput = document.getElementById('ml_weight');
        const aiInput = document.getElementById('ai_genera_weight');
        const totalDisplay = document.getElementById('totalPercentage');
        const totalBar = document.getElementById('totalBar');
        const percentageWarning = document.getElementById('percentageWarning');
        const submitButton = document.getElementById('submitButton');
        const form = document.getElementById('aggregationForm');

        function calculateTotal() {
            const mlValue = parseInt(mlInput.value) || 0;
            const aiValue = parseInt(aiInput.value) || 0;
            const total = mlValue + aiValue;

            totalDisplay.textContent = total + '%';
            totalBar.style.width = total + '%';

            // Update bar color based on total
            if (total === 100) {
                totalBar.className = 'h-2 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full transition-all duration-300';
                percentageWarning.classList.add('hidden');
                submitButton.disabled = false;
            } else if (total > 100) {
                totalBar.className = 'h-2 bg-gradient-to-r from-red-500 to-pink-500 rounded-full transition-all duration-300';
                percentageWarning.classList.remove('hidden');
                submitButton.disabled = true;
            } else {
                totalBar.className = 'h-2 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full transition-all duration-300';
                percentageWarning.classList.add('hidden');
                submitButton.disabled = false;
            }
        }

        mlInput.addEventListener('input', calculateTotal);
        aiInput.addEventListener('input', calculateTotal);

        // Auto-calculate on page load
        calculateTotal();

        // Form submission validation
        form.addEventListener('submit', function(e) {
            const mlValue = parseInt(mlInput.value) || 0;
            const aiValue = parseInt(aiInput.value) || 0;
            const total = mlValue + aiValue;

            if (total !== 100) {
                e.preventDefault();
                Swal.fire({
                    title: 'Invalid Total',
                    text: 'The sum of Machine Learning and AI Genera must equal 100%.',
                    icon: 'error',
                    confirmButtonColor: '#ef4444',
                    background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                    color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
                });
            }
        });

        // Add animation to cards
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'all 0.2s ease-in-out';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endpush
