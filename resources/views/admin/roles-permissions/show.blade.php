@extends('layouts.admin')

@section('title', 'Role Details - ' . $role->name)
@section('header-title', 'Detail Role')

@section('content')
    <div class="space-y-6">
        <!-- Back Button & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('role-permission.index') }}"
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
                            <a href="{{ route('role-permission.index') }}"
                                class="text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                                Kontrol Akses
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Role Details</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
            <!-- Role Info Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-100">Role Name</p>
                            <p class="mt-2 text-2xl font-bold truncate">{{ $role->name }}</p>
                            <p class="mt-2 text-xs text-purple-100 opacity-90">{{ $role->guard_name }} guard</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-user-shield"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Users Count Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-100">Assigned Users</p>
                            <p class="mt-2 text-3xl font-bold">{{ $users->total() }}</p>
                            <p class="mt-2 text-xs text-blue-100 opacity-90">Users with this role</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Permissions Count Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-emerald-100">Assigned Permissions</p>
                            <p class="mt-2 text-3xl font-bold">{{ $role->permissions_count ?? 0 }}</p>
                            <p class="mt-2 text-xs text-emerald-100 opacity-90">Total permissions</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-key"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Status Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-orange-100">Role Type</p>
                            <p class="mt-2 text-xl font-bold">
                                @if (in_array($role->name, ['super-admin', 'admin']))
                                    System Role
                                @else
                                    Custom Role
                                @endif
                            </p>
                            <p class="mt-2 text-xs text-orange-100 opacity-90">
                                @if (in_array($role->name, ['super-admin', 'admin']))
                                    Protected
                                @else
                                    Editable
                                @endif
                            </p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            @if (in_array($role->name, ['super-admin', 'admin']))
                                <i class="text-2xl fas fa-shield-alt"></i>
                            @else
                                <i class="text-2xl fas fa-edit"></i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Role Information -->
                <div
                    class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Role Information</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Basic details and metadata</p>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Role Name
                                </label>
                                <div
                                    class="p-3 border border-gray-200 bg-gray-50 rounded-xl dark:bg-gray-700/50 dark:border-gray-600">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $role->name }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Guard Name
                                </label>
                                <div
                                    class="p-3 border border-gray-200 bg-gray-50 rounded-xl dark:bg-gray-700/50 dark:border-gray-600">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $role->guard_name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Timestamps -->
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Created At
                                </label>
                                <div
                                    class="p-3 border border-gray-200 bg-gray-50 rounded-xl dark:bg-gray-700/50 dark:border-gray-600">
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        {{ $role->created_at->format('M d, Y') }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $role->created_at->format('h:i A') }} • {{ $role->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Last Updated
                                </label>
                                <div
                                    class="p-3 border border-gray-200 bg-gray-50 rounded-xl dark:bg-gray-700/50 dark:border-gray-600">
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        {{ $role->updated_at->format('M d, Y') }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $role->updated_at->format('h:i A') }} •
                                        {{ $role->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-100 dark:border-gray-700">
                            <div>
                                <a href="{{ route('role-permission.index') }}"
                                    class="inline-flex items-center px-6 py-3 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    <i class="mr-2 fas fa-arrow-left"></i>
                                    Back to List
                                </a>
                            </div>
                            <div class="flex items-center space-x-3">
                                @if (!in_array($role->name, ['super-admin', 'admin']))
                                    <a href="{{ route('roles.edit', $role->id) }}"
                                        class="inline-flex items-center px-6 py-3 text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl hover:from-primary-600 hover:to-primary-700 hover:shadow-xl hover:scale-105">
                                        <i class="mr-2 fas fa-edit"></i>
                                        Edit Role
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div
                    class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('roles.edit', $role->id) }}"
                            class="flex items-center p-3 space-x-3 transition-colors duration-200 border border-gray-200 rounded-lg dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 group">
                            <div
                                class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                <i class="text-blue-600 fas fa-edit dark:text-blue-400"></i>
                            </div>
                            <span
                                class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">
                                Edit Role
                            </span>
                        </a>
                        <a href="{{ route('roles.create') }}"
                            class="flex items-center p-3 space-x-3 transition-colors duration-200 border border-gray-200 rounded-lg dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 group">
                            <div
                                class="flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30">
                                <i class="text-emerald-600 fas fa-plus dark:text-emerald-400"></i>
                            </div>
                            <span
                                class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">
                                Create New Role
                            </span>
                        </a>
                        <a href="{{ route('permissions.create') }}"
                            class="flex items-center p-3 space-x-3 transition-colors duration-200 border border-gray-200 rounded-lg dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 group">
                            <div
                                class="flex items-center justify-center w-8 h-8 bg-purple-100 rounded-lg dark:bg-purple-900/30">
                                <i class="text-purple-600 fas fa-key dark:text-purple-400"></i>
                            </div>
                            <span
                                class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">
                                Create Permission
                            </span>
                        </a>
                        @if (!in_array($role->name, ['super-admin', 'admin']))
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                class="pt-3 border-t border-gray-100 dark:border-gray-700">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete()"
                                    class="flex items-center w-full p-3 space-x-3 text-left transition-colors duration-200 border border-red-200 rounded-lg dark:border-red-800 hover:bg-red-50 dark:hover:bg-red-900/20 group">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 bg-red-100 rounded-lg dark:bg-red-900/30">
                                        <i class="text-red-600 fas fa-trash dark:text-red-400"></i>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-red-700 dark:text-red-300 group-hover:text-red-800 dark:group-hover:text-red-200">
                                        Delete Role
                                    </span>
                                </button>
                            </form>
                        @else
                            <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                                <div
                                    class="flex items-center p-3 space-x-3 border border-gray-200 rounded-lg dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-lg dark:bg-gray-600">
                                        <i class="text-gray-400 fas fa-lock"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                        System Role Protected
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Middle Column -->
            <div class="space-y-6">
                <!-- Assigned Users -->
                <div
                    class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Assigned Users</h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $users->total() }} users assigned to this role
                                </p>
                            </div>
                            <span
                                class="px-3 py-1 text-sm font-medium text-blue-700 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                                {{ $users->total() }} total
                            </span>
                        </div>
                    </div>

                    @if ($users->count() > 0)
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach ($users as $user)
                                    <div
                                        class="flex items-center justify-between p-4 transition-colors duration-200 border border-gray-200 rounded-xl dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex items-center justify-center flex-shrink-0 w-10 h-10 shadow-lg rounded-xl bg-gradient-to-br from-blue-500 to-blue-600">
                                                <span class="text-sm font-bold text-white">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </span>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-gray-900 truncate dark:text-white">
                                                    {{ $user->name }}
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    {{ $user->email }}
                                                </p>
                                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                                    Joined {{ $user->created_at->format('M d, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
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
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status['class'] }}">
                                                <i class="fas {{ $status['icon'] }} mr-1"></i>
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            @if ($users->hasPages())
                                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="text-sm text-gray-700 dark:text-gray-300">
                                            Showing
                                            <span class="font-semibold">{{ $users->firstItem() ?? 0 }}</span>
                                            to
                                            <span class="font-semibold">{{ $users->lastItem() ?? 0 }}</span>
                                            of
                                            <span class="font-semibold">{{ $users->total() }}</span>
                                            users
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            {{-- Previous Page Link --}}
                                            @if ($users->onFirstPage())
                                                <span
                                                    class="px-3 py-2 text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:border-gray-600">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                            @else
                                                <a href="{{ $users->previousPageUrl() }}"
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
                                                <a href="{{ $users->url(1) }}"
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
                                                    <a href="{{ $users->url($page) }}"
                                                        class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                                        {{ $page }}
                                                    </a>
                                                @endif
                                            @endfor

                                            @if ($end < $last)
                                                @if ($end < $last - 1)
                                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                                @endif
                                                <a href="{{ $users->url($last) }}"
                                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                                    {{ $last }}
                                                </a>
                                            @endif

                                            {{-- Next Page Link --}}
                                            @if ($users->hasMorePages())
                                                <a href="{{ $users->nextPageUrl() }}"
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
                    @else
                        <div class="p-12 text-center">
                            <div
                                class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                <i class="text-2xl text-gray-400 fas fa-users"></i>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No Users Assigned</h3>
                            <p class="mb-4 text-gray-500 dark:text-gray-400">No users have been assigned to this role yet.
                            </p>
                            <a href="{{ route('users.index') }}?role={{ $role->name }}"
                                class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-200 shadow-lg bg-primary-600 hover:bg-primary-700 rounded-xl hover:shadow-xl">
                                <i class="mr-2 fas fa-user-plus"></i>
                                Assign Users
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Role Summary -->
                <div
                    class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Role Summary</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Role Name</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $role->name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Guard</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $role->guard_name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Assigned Permissions</span>
                            <span
                                class="text-sm font-medium text-gray-900 dark:text-white">{{ $role->permissions->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Users with this Role</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $users->total() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Role Type</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">
                                @if (in_array($role->name, ['super-admin', 'admin']))
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                                        <i class="mr-1 fas fa-shield-alt"></i>
                                        System
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">
                                        <i class="mr-1 fas fa-user-edit"></i>
                                        Custom
                                    </span>
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Created</span>
                            <span
                                class="text-sm text-gray-500 dark:text-gray-400">{{ $role->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Last Updated</span>
                            <span
                                class="text-sm text-gray-500 dark:text-gray-400">{{ $role->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Assigned Permissions -->
                <div
                    class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Assigned Permissions</h3>
                            <span
                                class="px-3 py-1 text-sm font-medium rounded-full text-emerald-700 bg-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-300">
                                {{ $role->permissions->count() }} total
                            </span>
                        </div>
                    </div>

                    @if ($role->permissions->count() > 0)
                        <div class="p-6">
                            <div class="space-y-4 overflow-y-auto max-h-96">
                                @php
                                    $groupedPermissions = $role->permissions->groupBy(function ($permission) {
                                        $parts = explode('.', $permission->name);
                                        return $parts[0] ?? 'general';
                                    });
                                @endphp

                                @foreach ($groupedPermissions as $module => $modulePermissions)
                                    <div class="space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-2 h-2 rounded-full bg-primary-500"></div>
                                            <h4 class="text-sm font-semibold text-gray-900 capitalize dark:text-white">
                                                {{ $module }} ({{ $modulePermissions->count() }})
                                            </h4>
                                        </div>
                                        <div class="ml-4 space-y-2">
                                            @foreach ($modulePermissions as $permission)
                                                <div
                                                    class="flex items-center p-2 space-x-2 border border-gray-200 rounded-lg dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50">
                                                    <i
                                                        class="text-xs text-emerald-500 fas fa-key dark:text-emerald-400"></i>
                                                    <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                                        {{ $permission->name }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="p-8 text-center">
                            <i class="mb-3 text-2xl text-gray-400 fas fa-key"></i>
                            <p class="text-sm text-gray-500 dark:text-gray-400">No permissions assigned to this role</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Delete Role',
                html: `
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full dark:bg-red-900/30">
                        <i class="text-xl text-red-600 fas fa-exclamation-triangle dark:text-red-400"></i>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Are you sure?</h3>
                    <p class="mb-4 text-gray-600 dark:text-gray-400">
                        You are about to delete the role:
                    </p>
                    <div class="p-3 mb-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                        <p class="font-medium text-gray-900 dark:text-white">{{ $role->name }}</p>
                    </div>
                    <p class="text-sm font-medium text-red-600 dark:text-red-400">
                        This action cannot be undone and will remove this role from all users!
                    </p>
                </div>
            `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete role',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
                customClass: {
                    confirmButton: 'px-6 py-2.5 font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors duration-200 mr-2',
                    cancelButton: 'px-6 py-2.5 font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 ml-2',
                    actions: '!gap-3 !mt-6'
                },
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('form[action="{{ route('roles.destroy', $role->id) }}"]').submit();
                }
            });
        }

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
    </script>
@endpush
