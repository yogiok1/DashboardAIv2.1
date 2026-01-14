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
            'bg' => 'bg-blue-50',
            'icon' => 'bg-blue-100 text-blue-600',
            'border' => 'border-blue-200',
            'trend' => 'text-blue-600'
        ],
        'green' => [
            'bg' => 'bg-green-50',
            'icon' => 'bg-green-100 text-green-600',
            'border' => 'border-green-200',
            'trend' => 'text-green-600'
        ],
        'purple' => [
            'bg' => 'bg-purple-50',
            'icon' => 'bg-purple-100 text-purple-600',
            'border' => 'border-purple-200',
            'trend' => 'text-purple-600'
        ],
        'orange' => [
            'bg' => 'bg-orange-50',
            'icon' => 'bg-orange-100 text-orange-600',
            'border' => 'border-orange-200',
            'trend' => 'text-orange-600'
        ],
    ][$color];
@endphp

<div class="bg-white rounded-xl shadow-card border {{ $colorClasses['border'] }} p-6 hover:shadow-soft transition-all duration-300 group">
    <div class="flex items-center justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium text-gray-600 mb-1">{{ $title }}</p>
            <p class="text-2xl font-bold text-gray-800">{{ $value }}</p>

            @if($trend !== null)
            <div class="flex items-center mt-2">
                <span class="text-xs font-medium {{ $colorClasses['trend'] }} flex items-center">
                    <i class="fas fa-arrow-up mr-1 text-xs"></i>
                    {{ $trend }}%
                </span>
                <span class="text-xs text-gray-500 ml-1">from last month</span>
            </div>
            @endif
        </div>

        <div class="p-3 {{ $colorClasses['icon'] }} rounded-xl group-hover:scale-110 transition-transform duration-300">
            <i class="{{ $icon }} text-lg"></i>
        </div>
    </div>
</div>
