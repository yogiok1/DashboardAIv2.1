@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('header-title', 'Manajemen Pengguna')

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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Manajemen Pengguna</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Premium Stats Cards dengan Growth/Decline Indicators -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
            <!-- Total Users Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-100">Total Users</p>
                            <p class="mt-2 text-3xl font-bold">{{ number_format($stats['total_users']) }}</p>
                            <div class="flex items-center mt-2">
                                @php
                                    $isPositive = $stats['total_growth'] >= 0;
                                @endphp
                                <span
                                    class="inline-flex items-center text-xs font-medium {{ $isPositive ? 'text-emerald-200' : 'text-red-200' }}">
                                    <i class="fas {{ $isPositive ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                                    {{ abs($stats['total_growth']) }}%
                                </span>
                                <span class="ml-2 text-xs text-purple-100">from last month</span>
                            </div>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Active Users Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-emerald-100">Active Users</p>
                            <p class="mt-2 text-3xl font-bold">{{ number_format($stats['active_users']) }}</p>
                            <div class="flex items-center mt-2">
                                @php
                                    $isPositive = $stats['active_growth'] >= 0;
                                @endphp
                                <span
                                    class="inline-flex items-center text-xs font-medium {{ $isPositive ? 'text-emerald-200' : 'text-red-200' }}">
                                    <i class="fas {{ $isPositive ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                                    {{ abs($stats['active_growth']) }}%
                                </span>
                                <span class="ml-2 text-xs text-emerald-100">from last week</span>
                            </div>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-user-check"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- New This Month Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-100">New This Month</p>
                            <p class="mt-2 text-3xl font-bold">{{ number_format($stats['new_this_month']) }}</p>
                            <div class="flex items-center mt-2">
                                @php
                                    $isPositive = $stats['monthly_growth'] >= 0;
                                @endphp
                                <span
                                    class="inline-flex items-center text-xs font-medium {{ $isPositive ? 'text-emerald-200' : 'text-red-200' }}">
                                    <i class="fas {{ $isPositive ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                                    {{ abs($stats['monthly_growth']) }}%
                                </span>
                                <span class="ml-2 text-xs text-blue-100">from last month</span>
                            </div>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-user-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- User Engagement Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-orange-100">Engagement Rate</p>
                            <p class="mt-2 text-3xl font-bold">{{ $stats['engagement_rate'] }}%</p>
                            <div class="flex items-center mt-2">
                                @php
                                    $isPositive = $stats['engagement_growth'] >= 0;
                                @endphp
                                <span
                                    class="inline-flex items-center text-xs font-medium {{ $isPositive ? 'text-emerald-200' : 'text-red-200' }}">
                                    <i class="fas {{ $isPositive ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                                    {{ abs($stats['engagement_growth']) }}%
                                </span>
                                <span class="ml-2 text-xs text-orange-100">from last month</span>
                            </div>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="flex mt-4 space-x-2">
                        <a href="{{ route('users.create') }}"
                            class="flex-1 py-2 text-xs font-medium text-center transition-all duration-200 rounded-lg bg-white/20 hover:bg-white/30 backdrop-blur-sm">
                            New User
                        </a>
                        <button
                            class="flex-1 py-2 text-xs font-medium text-center transition-all duration-200 rounded-lg bg-white/20 hover:bg-white/30 backdrop-blur-sm">
                            Export
                        </button>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div
            class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <!-- Table Header dengan Search & Filters -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <form method="GET" action="{{ route('users.index') }}">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="text-gray-400 fas fa-search"></i>
                                </div>
                                <input type="text" name="search" placeholder="Search users..."
                                    value="{{ request('search') }}"
                                    class="pl-10 pr-4 py-2.5 w-80 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200">
                            </div>

                            <select name="role"
                                class="px-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200">
                                <option value="all" {{ request('role') == 'all' ? 'selected' : '' }}>All Roles</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ request('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="status"
                                class="px-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status
                                </option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                                <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>
                                    Suspended</option>
                            </select>

                            <select name="per_page"
                                class="px-3 py-2.5 pr-5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                                onchange="this.form.submit()">
                                <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5 per page
                                </option>
                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per page
                                </option>
                                <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25 per page
                                </option>
                                <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 per page
                                </option>
                                <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100 per
                                    page</option>
                            </select>
                        </div>

                        <div class="flex items-center space-x-3">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                                <i class="mr-2 fas fa-filter"></i>
                                Apply
                            </button>

                            @if (request()->hasAny(['search', 'role', 'status', 'per_page']))
                                <a href="{{ route('users.index') }}"
                                    class="inline-flex items-center px-4 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-xl transition-all duration-200">
                                    <i class="mr-2 fas fa-times"></i>
                                    Clear
                                </a>
                            @endif

                            <a href="{{ route('users.create') }}"
                                class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                                <i class="mr-2 fas fa-plus"></i>
                                Add User
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                            <!-- User Column dengan Sort -->
                            <th class="px-6 py-4 text-left">
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'name',
                                    'direction' => request('sort') == 'name' && request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}"
                                    class="flex items-center space-x-2 transition-colors duration-200 group">
                                    <span
                                        class="text-xs font-semibold tracking-wider text-gray-600 uppercase dark:text-gray-400">User</span>
                                    <div class="flex flex-col">
                                        @if (request('sort') == 'name')
                                            @if (request('direction') == 'asc')
                                                <i class="text-xs fas fa-sort-up text-primary-600"></i>
                                            @else
                                                <i class="text-xs fas fa-sort-down text-primary-600"></i>
                                            @endif
                                        @else
                                            <i
                                                class="text-xs text-gray-400 fas fa-sort group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                        @endif
                                    </div>
                                </a>
                            </th>

                            <!-- Role Column dengan Sort -->
                            <th class="px-6 py-4 text-left">
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'role',
                                    'direction' => request('sort') == 'role' && request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}"
                                    class="flex items-center space-x-2 transition-colors duration-200 group">
                                    <span
                                        class="text-xs font-semibold tracking-wider text-gray-600 uppercase dark:text-gray-400">Role</span>
                                    <div class="flex flex-col">
                                        @if (request('sort') == 'role')
                                            @if (request('direction') == 'asc')
                                                <i class="text-xs fas fa-sort-up text-primary-600"></i>
                                            @else
                                                <i class="text-xs fas fa-sort-down text-primary-600"></i>
                                            @endif
                                        @else
                                            <i
                                                class="text-xs text-gray-400 fas fa-sort group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                        @endif
                                    </div>
                                </a>
                            </th>

                            <!-- Status Column dengan Sort -->
                            <th class="px-6 py-4 text-left">
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'status',
                                    'direction' => request('sort') == 'status' && request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}"
                                    class="flex items-center space-x-2 transition-colors duration-200 group">
                                    <span
                                        class="text-xs font-semibold tracking-wider text-gray-600 uppercase dark:text-gray-400">Status</span>
                                    <div class="flex flex-col">
                                        @if (request('sort') == 'status')
                                            @if (request('direction') == 'asc')
                                                <i class="text-xs fas fa-sort-up text-primary-600"></i>
                                            @else
                                                <i class="text-xs fas fa-sort-down text-primary-600"></i>
                                            @endif
                                        @else
                                            <i
                                                class="text-xs text-gray-400 fas fa-sort group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                        @endif
                                    </div>
                                </a>
                            </th>

                            <!-- Permissions Column -->
                            <th class="px-6 py-4 text-left">
                                <span
                                    class="text-xs font-semibold tracking-wider text-gray-600 uppercase dark:text-gray-400">Permissions</span>
                            </th>

                            <!-- Last Active Column dengan Sort -->
                            <th class="px-6 py-4 text-left">
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'created_at',
                                    'direction' => request('sort') == 'created_at' && request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}"
                                    class="flex items-center space-x-2 transition-colors duration-200 group">
                                    <span
                                        class="text-xs font-semibold tracking-wider text-gray-600 uppercase dark:text-gray-400">Joined
                                        Date</span>
                                    <div class="flex flex-col">
                                        @if (request('sort') == 'created_at')
                                            @if (request('direction') == 'asc')
                                                <i class="text-xs fas fa-sort-up text-primary-600"></i>
                                            @else
                                                <i class="text-xs fas fa-sort-down text-primary-600"></i>
                                            @endif
                                        @else
                                            <i
                                                class="text-xs text-gray-400 fas fa-sort group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                        @endif
                                    </div>
                                </a>
                            </th>

                            <!-- Actions -->
                            <th class="px-6 py-4 text-right">
                                <span
                                    class="text-xs font-semibold tracking-wider text-gray-600 uppercase dark:text-gray-400">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($users as $user)
                            <tr class="transition-all duration-200 group hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <!-- User Info -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        @php
                                            $avatarColors = [
                                                'admin' => 'from-blue-500 to-blue-600',
                                                'moderator' => 'from-green-500 to-green-600',
                                                'user' => 'from-purple-500 to-purple-600',
                                            ];
                                            $primaryRole = $user->getRoleNames()->first() ?? 'user';
                                            $color = $avatarColors[$primaryRole] ?? 'from-gray-500 to-gray-600';
                                            $avatarInitials = strtoupper(substr($user->name, 0, 2));
                                        @endphp
                                        <div
                                            class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $color }} flex items-center justify-center shadow-lg flex-shrink-0">
                                            <span class="text-sm font-bold text-white">{{ $avatarInitials }}</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 truncate dark:text-white">
                                                {{ $user->name }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{ $user->email }}
                                            </p>
                                            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                                Joined {{ $user->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Role -->
                                <td class="px-6 py-4">
                                    @php
                                        $roleConfig = [
                                            'admin' => [
                                                'class' =>
                                                    'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                'icon' => 'fa-shield-alt',
                                            ],
                                            'moderator' => [
                                                'class' =>
                                                    'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                'icon' => 'fa-user-shield',
                                            ],
                                            'user' => [
                                                'class' =>
                                                    'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                                'icon' => 'fa-user',
                                            ],
                                        ];
                                        $primaryRole = $user->getRoleNames()->first() ?? 'user';
                                        $roleKey = strtolower($primaryRole);
                                        $config = $roleConfig[$roleKey] ?? $roleConfig['user'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $config['class'] }}">
                                        <i class="fas {{ $config['icon'] }} mr-1.5"></i>
                                        {{ $primaryRole }}
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @php
                                        $statusConfig = [
                                            'active' => [
                                                'class' =>
                                                    'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300',
                                                'icon' => 'fa-check-circle',
                                            ],
                                            'inactive' => [
                                                'class' =>
                                                    'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300',
                                                'icon' => 'fa-times-circle',
                                            ],
                                            'suspended' => [
                                                'class' =>
                                                    'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                'icon' => 'fa-ban',
                                            ],
                                        ];
                                        $status = $statusConfig[$user->status] ?? $statusConfig['inactive'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $status['class'] }}">
                                        <i class="fas {{ $status['icon'] }} mr-1.5"></i>
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>

                                <!-- Permissions -->
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap max-w-xs gap-1">
                                        @foreach ($user->getDirectPermissions()->take(2) as $permission)
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg text-emerald-800 bg-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-300">
                                                <i class="mr-1 text-xs fas fa-key"></i>
                                                {{ \Illuminate\Support\Str::limit($permission->name, 12) }}
                                            </span>
                                        @endforeach
                                        @if ($user->getAllPermissions()->count() > 2)
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-400">
                                                +{{ $user->getAllPermissions()->count() - 2 }} more
                                            </span>
                                        @endif
                                        @if ($user->getAllPermissions()->count() === 0)
                                            <span class="text-xs italic text-gray-500 dark:text-gray-400">No
                                                permissions</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Joined Date -->
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $user->created_at->format('h:i A') }}
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('users.show', $user->id) }}"
                                            class="p-2 text-gray-400 transition-all duration-200 rounded-lg hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20"
                                            title="View Details">
                                            <i class="w-4 h-4 fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="p-2 text-gray-400 transition-all duration-200 rounded-lg hover:text-green-600 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20"
                                            title="Edit User">
                                            <i class="w-4 h-4 fas fa-edit"></i>
                                        </a>
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-400 transition-all duration-200 rounded-lg hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 delete-user-btn"
                                                    title="Delete User" data-user-name="{{ $user->name }}"
                                                    data-user-email="{{ $user->email }}">
                                                    <i class="w-4 h-4 fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="p-2 text-gray-300 cursor-not-allowed"
                                                title="Cannot delete your own account">
                                                <i class="w-4 h-4 fas fa-trash"></i>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                            <i class="text-2xl text-gray-400 fas fa-users"></i>
                                        </div>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No Users
                                            Found</h3>
                                        <p class="mb-4 text-gray-500 dark:text-gray-400">No users match your current
                                            filters</p>
                                        <a href="{{ route('users.create') }}"
                                            class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-200 shadow-lg bg-primary-600 hover:bg-primary-700 rounded-xl hover:shadow-xl">
                                            <i class="mr-2 fas fa-plus"></i>
                                            Create New User
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            Showing
                            <span class="font-semibold">{{ $users->firstItem() ?? 0 }}</span>
                            to
                            <span class="font-semibold">{{ $users->lastItem() ?? 0 }}</span>
                            of
                            <span class="font-semibold">{{ $users->total() }}</span>
                            results

                            <!-- Current Sort Info -->
                            @if (request('sort'))
                                <span class="px-2 py-1 ml-4 text-xs bg-gray-100 rounded dark:bg-gray-700">
                                    Sorted by: {{ ucfirst(str_replace('_', ' ', request('sort'))) }}
                                    ({{ request('direction') == 'asc' ? 'Ascending' : 'Descending' }})
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($users->onFirstPage())
                                <span
                                    class="px-3 py-2 text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:border-gray-600">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $users->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @php
                                $current = $users->currentPage();
                                $last = $users->lastPage();
                                $start = max(1, $current - 2);
                                $end = min($last, $current + 2);
                            @endphp

                            @if ($start > 1)
                                <a href="{{ $users->url(1) }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    1
                                </a>
                                @if ($start > 2)
                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $users->currentPage())
                                    <span
                                        class="px-3 py-2 font-semibold text-white border rounded-lg bg-primary-600 border-primary-600">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $users->url($page) }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                        class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor

                            @if ($end < $last)
                                @if ($end < $last - 1)
                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                @endif
                                <a href="{{ $users->url($last) }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    {{ $last }}
                                </a>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span
                                    class="px-3 py-2 text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:border-gray-600">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SweetAlert untuk delete user
            document.querySelectorAll('.delete-user-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = this.closest('form');
                    const userName = this.getAttribute('data-user-name');
                    const userEmail = this.getAttribute('data-user-email');

                    Swal.fire({
                        title: 'Delete User',
                        html: `
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full dark:bg-red-900/30">
                            <i class="text-xl text-red-600 fas fa-exclamation-triangle dark:text-red-400"></i>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Are you sure?</h3>
                        <p class="mb-4 text-gray-600 dark:text-gray-400">
                            You are about to delete the user:
                        </p>
                        <div class="p-3 mb-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                            <p class="font-medium text-gray-900 dark:text-white">${userName}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">${userEmail}</p>
                        </div>
                        <p class="text-sm font-medium text-red-600 dark:text-red-400">
                            This action cannot be undone!
                        </p>
                    </div>
                `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete user',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        background: document.documentElement.classList.contains('dark') ?
                            '#1f2937' : '#ffffff',
                        color: document.documentElement.classList.contains('dark') ?
                            '#ffffff' : '#1f2937',
                        customClass: {
                            confirmButton: 'px-6 py-2.5 font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors duration-200 mr-2',
                            cancelButton: 'px-6 py-2.5 font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 ml-2',
                            actions: '!gap-3 !mt-6'
                        },
                        buttonsStyling: false,
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

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
