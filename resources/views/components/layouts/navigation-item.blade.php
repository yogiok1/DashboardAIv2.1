@props([
    'href' => '#',
    'icon' => 'fas fa-circle',
    'active' => false,
    'subitem' => false
])

<a
    href="{{ $href }}"
    @class([
        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 font-medium group relative',
        'bg-primary-50 text-primary-700 border-r-2 border-primary-500' => $active && !$subitem,
        'text-gray-700 hover:bg-gray-50 hover:text-gray-900' => !$active && !$subitem,
        'bg-primary-100 text-primary-700' => $active && $subitem,
        'text-gray-600 hover:bg-gray-50 hover:text-gray-800' => !$active && $subitem,
        'pl-9 text-sm' => $subitem,
        'pl-3' => !$subitem
    ])
>
    <!-- Icon Container -->
    <div @class([
        'p-1.5 rounded-lg transition-colors',
        'bg-primary-100' => $active && !$subitem,
        'bg-gray-100 group-hover:bg-gray-200' => !$active && !$subitem,
        'bg-primary-200' => $active && $subitem,
        'bg-gray-50 group-hover:bg-gray-100' => !$active && $subitem,
    ])>
        <i @class([
            $icon,
            'text-primary-600' => $active,
            'text-gray-500 group-hover:text-gray-700' => !$active,
            'text-sm w-4' => $subitem,
            'text-sm w-5' => !$subitem
        ])></i>
    </div>

    <span class="ml-3">{{ $slot }}</span>

    <!-- Active Indicator -->
    @if($active && !$subitem)
    <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
        <div class="w-1.5 h-1.5 bg-primary-500 rounded-full"></div>
    </div>
    @endif
</a>
