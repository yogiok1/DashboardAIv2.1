@props([
    'title' => 'Title',
    'value' => '0',
    'icon' => 'fas fa-chart-line',
    'trend' => null,
    'color' => 'blue'
])

@php
    $colorClasses = [
        'blue' => [
            'bg' => 'bg-blue-50 dark:bg-blue-900/30',
            'icon' => 'bg-blue-100 text-blue-600 dark:bg-blue-800 dark:text-blue-400',
            'border' => 'border-blue-200 dark:border-blue-800',
            'trend' => 'text-blue-600 dark:text-blue-400'
        ],
        'green' => [
            'bg' => 'bg-green-50 dark:bg-green-900/30',
            'icon' => 'bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-400',
            'border' => 'border-green-200 dark:border-green-800',
            'trend' => 'text-green-600 dark:text-green-400'
        ],
        'purple' => [
            'bg' => 'bg-purple-50 dark:bg-purple-900/30',
            'icon' => 'bg-purple-100 text-purple-600 dark:bg-purple-800 dark:text-purple-400',
            'border' => 'border-purple-200 dark:border-purple-800',
            'trend' => 'text-purple-600 dark:text-purple-400'
        ],
        'orange' => [
            'bg' => 'bg-orange-50 dark:bg-orange-900/30',
            'icon' => 'bg-orange-100 text-orange-600 dark:bg-orange-800 dark:text-orange-400',
            'border' => 'border-orange-200 dark:border-orange-800',
            'trend' => 'text-orange-600 dark:text-orange-400'
        ],
    ][$color];
@endphp

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-card border {{ $colorClasses['border'] }} p-6 hover:shadow-soft transition-all duration-300 group">
    <div class="flex items-center justify-between">
        <div class="flex-1">
            <p class="mb-1 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $title }}</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $value }}</p>

            @if($trend !== null)
            <div class="flex items-center mt-2">
                <span class="text-xs font-medium {{ $colorClasses['trend'] }} flex items-center">
                    <i class="mr-1 text-xs fas fa-arrow-up"></i>
                    {{ $trend }}%
                </span>
                <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">from last month</span>
            </div>
            @endif
        </div>

        <div class="p-3 {{ $colorClasses['icon'] }} rounded-xl group-hover:scale-110 transition-transform duration-300">
            <i class="{{ $icon }} text-lg"></i>
        </div>
    </div>
</div>
