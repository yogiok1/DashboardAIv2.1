 @extends('layouts.admin')

@section('title', 'Manajemen Peran & Izin')
@section('header-title', 'Manajemen Hak Akses')

@section('content')
    <div class="space-y-8">
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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Kontrol Akses</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Premium Stats Cards -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
            <!-- Total Roles Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-100">Total Roles</p>
                            <p class="mt-2 text-3xl font-bold">{{ $stats['total_roles'] }}</p>
                            <p class="mt-2 text-xs text-blue-100 opacity-90">Manage access levels</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-user-shield"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Total Permissions Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-emerald-100">Total Permissions</p>
                            <p class="mt-2 text-3xl font-bold">{{ $stats['total_permissions'] }}</p>
                            <p class="mt-2 text-xs text-emerald-100 opacity-90">Fine-grained control</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-key"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- System Users Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-100">System Users</p>
                            <p class="mt-2 text-3xl font-bold">{{ $stats['total_users'] }}</p>
                            <p class="mt-2 text-xs text-purple-100 opacity-90">Active accounts</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Quick Actions Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-orange-100">Quick Actions</p>
                            <p class="mt-2 text-lg font-bold">Manage Access</p>
                            <p class="mt-2 text-xs text-orange-100 opacity-90">Create new roles & permissions</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-bolt"></i>
                        </div>
                    </div>
                    <div class="flex mt-4 space-x-2">
                        <a href="{{ route('roles.create') }}"
                            class="flex-1 py-2 text-xs font-medium text-center transition-all duration-200 rounded-lg bg-white/20 hover:bg-white/30 backdrop-blur-sm">
                            New Role
                        </a>
                        <a href="{{ route('permissions.create') }}"
                            class="flex-1 py-2 text-xs font-medium text-center transition-all duration-200 rounded-lg bg-white/20 hover:bg-white/30 backdrop-blur-sm">
                            New Permission
                        </a>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>
        </div>

        <!-- Enhanced Tab Navigation -->
        <div
            class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <div class="border-b border-gray-100 dark:border-gray-700">
                <nav class="flex -mb-px">
                    <a href="{{ request()->fullUrlWithQuery(['tab' => 'roles']) }}"
                        class="flex items-center px-6 py-4 text-sm font-semibold border-b-2 {{ request('tab', 'roles') === 'roles' ? 'border-primary-500 text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                        <div
                            class="flex items-center justify-center w-8 h-8 mr-3 rounded-lg {{ request('tab', 'roles') === 'roles' ? 'bg-primary-100 dark:bg-primary-800' : 'bg-gray-100 dark:bg-gray-700' }}">
                            <i
                                class="text-sm {{ request('tab', 'roles') === 'roles' ? 'fas fa-user-shield text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        </div>
                        <div class="text-left">
                            <div>Roles Management</div>
                            <div
                                class="mt-1 text-xs font-normal {{ request('tab', 'roles') === 'roles' ? 'text-primary-500 dark:text-primary-300' : 'text-gray-500 dark:text-gray-400' }}">
                                {{ $roles->total() }} system roles</div>
                        </div>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['tab' => 'permissions']) }}"
                        class="flex items-center px-6 py-4 text-sm font-semibold border-b-2 {{ request('tab') === 'permissions' ? 'border-primary-500 text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                        <div
                            class="flex items-center justify-center w-8 h-8 mr-3 rounded-lg {{ request('tab') === 'permissions' ? 'bg-primary-100 dark:bg-primary-800' : 'bg-gray-100 dark:bg-gray-700' }}">
                            <i
                                class="text-sm {{ request('tab') === 'permissions' ? 'fas fa-key text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                        </div>
                        <div class="text-left">
                            <div>Permissions</div>
                            <div
                                class="mt-1 text-xs font-normal {{ request('tab') === 'permissions' ? 'text-primary-500 dark:text-primary-300' : 'text-gray-500 dark:text-gray-400' }}">
                                {{ $permissions->total() }} permissions</div>
                        </div>
                    </a>
                </nav>
            </div>

            <!-- Roles Tab Content -->
            <div class="p-6 {{ request('tab', 'roles') === 'roles' ? '' : 'hidden' }}">
                <!-- Enhanced Search and Filters -->
                <div class="flex flex-col gap-4 mb-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-center space-x-4">
                        <form method="GET" action="{{ route('role-permission.index') }}" class="flex items-center space-x-4">
                            <input type="hidden" name="tab" value="roles">

                            <!-- Search Input -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="text-gray-400 fas fa-search"></i>
                                </div>
                                <input type="text" name="role_search" placeholder="Search roles..."
                                    value="{{ request('role_search') }}"
                                    class="pl-10 pr-4 py-2.5 w-64 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            </div>

                            <!-- Role Type Filter -->
                            <select name="role_type"
                                class="px-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="all" {{ request('role_type') == 'all' ? 'selected' : '' }}>All Types
                                </option>
                                <option value="system" {{ request('role_type') == 'system' ? 'selected' : '' }}>System
                                    Roles</option>
                                <option value="custom" {{ request('role_type') == 'custom' ? 'selected' : '' }}>Custom
                                    Roles</option>
                            </select>

                            <!-- Sort Options -->
                            <select name="role_sort"
                                class="px-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="name" {{ request('role_sort', 'name') == 'name' ? 'selected' : '' }}>Sort
                                    by Name</option>
                                <option value="guard_name" {{ request('role_sort') == 'guard_name' ? 'selected' : '' }}>
                                    Sort by Guard</option>
                                <option value="created_at" {{ request('role_sort') == 'created_at' ? 'selected' : '' }}>
                                    Sort by Date</option>
                            </select>

                            <select name="role_direction"
                                class="px-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="asc" {{ request('role_direction', 'asc') == 'asc' ? 'selected' : '' }}>
                                    Ascending</option>
                                <option value="desc" {{ request('role_direction') == 'desc' ? 'selected' : '' }}>
                                    Descending</option>
                            </select>

                            <!-- Items Per Page -->
                            <select name="role_per_page"
                                class="px-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="6" {{ request('role_per_page', 6) == 6 ? 'selected' : '' }}>6 per page
                                </option>
                                <option value="9" {{ request('role_per_page', 6) == 9 ? 'selected' : '' }}>9 per page
                                </option>
                                <option value="12" {{ request('role_per_page', 6) == 12 ? 'selected' : '' }}>12 per page
                                </option>
                                <option value="18" {{ request('role_per_page', 6) == 18 ? 'selected' : '' }}>18 per page
                                </option>
                                <option value="24" {{ request('role_per_page', 6) == 24 ? 'selected' : '' }}>24 per page
                                </option>
                            </select>

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-xl transition-all duration-200">
                                <i class="mr-2 fas fa-filter"></i>
                                Apply
                            </button>

                            @if (request()->hasAny(['role_search', 'role_type', 'role_sort', 'role_direction', 'role_per_page']))
                                <a href="{{ route('role-permission.index') }}?tab=roles"
                                    class="inline-flex items-center px-4 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-xl transition-all duration-200">
                                    <i class="mr-2 fas fa-times"></i>
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>
                    <a href="{{ route('roles.create') }}"
                        class="inline-flex items-center px-4 py-3 font-medium text-white bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl hover:from-primary-600 hover:to-primary-700">
                        <i class="mr-2 fas fa-plus"></i>
                        Create New Role
                    </a>
                </div>

                <!-- Enhanced Bulk Actions untuk Roles -->
                <div id="roles-bulk-section" class="hidden mb-6">
                    <div
                        class="p-6 border border-blue-200 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 dark:border-blue-800 rounded-2xl backdrop-blur-sm">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 bg-white border border-blue-200 shadow-sm rounded-xl dark:bg-blue-800 dark:border-blue-700">
                                        <i class="text-xl text-blue-600 fas fa-layer-group dark:text-blue-300"></i>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-blue-900 dark:text-blue-100">
                                            <span id="roles-selected-count">0</span> roles selected
                                        </p>
                                        <p class="text-sm text-blue-700 dark:text-blue-300">Bulk actions available for
                                            selected items</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <button type="button" id="roles-cancel-selection"
                                    class="px-6 py-3 text-sm font-medium text-blue-700 transition-all duration-200 bg-white border border-blue-300 shadow-sm rounded-xl hover:bg-blue-50 dark:bg-blue-800 dark:text-blue-200 dark:border-blue-600 dark:hover:bg-blue-700 hover:shadow-md">
                                    <i class="mr-2 fas fa-times"></i>
                                    Cancel Selection
                                </button>

                                <button type="button" id="roles-bulk-delete-btn"
                                    class="flex items-center px-6 py-3 text-sm font-medium text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-red-500 to-red-600 rounded-xl hover:from-red-600 hover:to-red-700 hover:shadow-xl hover:scale-105 group">
                                    <i class="mr-2 fas fa-trash"></i>
                                    Delete Selected
                                    <span id="roles-delete-count"
                                        class="px-2 py-1 ml-2 text-xs rounded-lg bg-white/20">0</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Roles Grid -->
                <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                    @forelse($roles as $index => $role)
                        <div
                            class="relative p-6 transition-all duration-300 bg-white border border-gray-200 cursor-pointer group dark:bg-gray-800 dark:border-gray-700 rounded-2xl hover:shadow-xl hover:border-primary-200 dark:hover:border-primary-800 selectable-card"
                            data-index="{{ $index }}" data-type="role" data-id="{{ $role->id }}">
                            <!-- Premium Checkbox -->
                            <div class="absolute top-4 left-4">
                                <label class="custom-checkbox">
                                    <input type="checkbox" name="role_ids[]" value="{{ $role->id }}"
                                        class="role-checkbox bulk-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <div class="flex items-start justify-between mb-4 ml-8">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 shadow-lg rounded-xl bg-gradient-to-br from-blue-500 to-blue-600">
                                        <i class="text-lg text-white fas fa-user-shield"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $role->name }}
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $role->guard_name }} guard
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                                        {{ $role->users_count }} users
                                    </span>
                                    @if (in_array($role->name, ['super-admin', 'admin']))
                                        <span
                                            class="px-2 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded-full dark:bg-purple-900/30 dark:text-purple-300">
                                            System
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Permissions Preview -->
                            <div class="mb-4">
                                <p class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Permissions
                                    ({{ $role->permissions_count }})</p>
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($role->permissions->take(4) as $permission)
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-lg text-emerald-800 bg-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-300">
                                            <i class="mr-1 text-xs fas fa-key"></i>
                                            {{ \Illuminate\Support\Str::limit($permission->name, 15) }}
                                        </span>
                                    @endforeach
                                    @if ($role->permissions_count > 4)
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-400">
                                            +{{ $role->permissions_count - 4 }} more
                                        </span>
                                    @endif
                                    @if ($role->permissions_count === 0)
                                        <span class="text-xs italic text-gray-500 dark:text-gray-400">No permissions
                                            assigned</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div
                                class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    Created {{ $role->created_at->diffForHumans() }}
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('roles.show', $role->id) }}"
                                        class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20"
                                        title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('roles.edit', $role->id) }}"
                                        class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-green-600 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20"
                                        title="Edit Role">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if (!in_array($role->name, ['super-admin', 'admin']))
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 delete-role-btn"
                                                title="Delete Role" data-role-name="{{ $role->name }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="p-2 text-gray-300 cursor-not-allowed"
                                            title="System role - cannot be deleted">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2">
                            <div class="py-12 text-center">
                                <div
                                    class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                    <i class="text-3xl text-gray-400 fas fa-user-shield"></i>
                                </div>
                                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No Roles Found</h3>
                                <p class="mb-6 text-gray-500 dark:text-gray-400">Get started by creating your first role
                                </p>
                                <a href="{{ route('roles.create') }}"
                                    class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-200 shadow-lg bg-primary-600 hover:bg-primary-700 rounded-xl hover:shadow-xl">
                                    <i class="mr-2 fas fa-plus"></i>
                                    Create Your First Role
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Roles Pagination -->
                @if($roles->hasPages())
                <div class="pt-6 mt-8 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            Showing
                            <span class="font-semibold">{{ $roles->firstItem() ?? 0 }}</span>
                            to
                            <span class="font-semibold">{{ $roles->lastItem() ?? 0 }}</span>
                            of
                            <span class="font-semibold">{{ $roles->total() }}</span>
                            results
                        </div>

                        <div class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($roles->onFirstPage())
                                <span
                                    class="px-3 py-2 text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:border-gray-600">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $roles->previousPageUrl() }}&{{ http_build_query(request()->except(['roles_page', 'page'])) }}"
                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @php
                                $current = $roles->currentPage();
                                $last = $roles->lastPage();
                                $start = max(1, $current - 2);
                                $end = min($last, $current + 2);
                            @endphp

                            @if ($start > 1)
                                <a href="{{ $roles->url(1) }}&{{ http_build_query(request()->except(['roles_page', 'page'])) }}"
                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    1
                                </a>
                                @if ($start > 2)
                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $roles->currentPage())
                                    <span
                                        class="px-3 py-2 font-semibold text-white border rounded-lg bg-primary-600 border-primary-600">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $roles->url($page) }}&{{ http_build_query(request()->except(['roles_page', 'page'])) }}"
                                        class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor

                            @if ($end < $last)
                                @if ($end < $last - 1)
                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                @endif
                                <a href="{{ $roles->url($last) }}&{{ http_build_query(request()->except(['roles_page', 'page'])) }}"
                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    {{ $last }}
                                </a>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($roles->hasMorePages())
                                <a href="{{ $roles->nextPageUrl() }}&{{ http_build_query(request()->except(['roles_page', 'page'])) }}"
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

            <!-- Permissions Tab Content -->
            <div class="p-6 {{ request('tab') === 'permissions' ? '' : 'hidden' }}">
                <!-- Enhanced Search and Filters -->
                <div class="flex flex-col gap-4 mb-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-center space-x-4">
                        <form method="GET" action="{{ route('role-permission.index') }}" class="flex items-center space-x-4">
                            <input type="hidden" name="tab" value="permissions">

                            <!-- Search Input -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="text-gray-400 fas fa-search"></i>
                                </div>
                                <input type="text" name="permission_search" placeholder="Search permissions..."
                                    value="{{ request('permission_search') }}"
                                    class="pl-10 pr-4 py-2.5 w-64 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            </div>

                            <!-- Assignment Filter -->
                            <select name="permission_assignment"
                                class="px-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="all" {{ request('permission_assignment') == 'all' ? 'selected' : '' }}>All
                                    Assignments</option>
                                <option value="assigned" {{ request('permission_assignment') == 'assigned' ? 'selected' : '' }}>
                                    Assigned</option>
                                <option value="unassigned" {{ request('permission_assignment') == 'unassigned' ? 'selected' : '' }}>
                                    Unassigned</option>
                            </select>

                            <!-- Sort Options -->
                            <select name="permission_sort"
                                class="px-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="name" {{ request('permission_sort', 'name') == 'name' ? 'selected' : '' }}>
                                    Sort by Name</option>
                                <option value="guard_name" {{ request('permission_sort') == 'guard_name' ? 'selected' : '' }}>
                                    Sort by Guard</option>
                                <option value="created_at" {{ request('permission_sort') == 'created_at' ? 'selected' : '' }}>
                                    Sort by Date</option>
                            </select>

                            <select name="permission_direction"
                                class="px-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="asc" {{ request('permission_direction', 'asc') == 'asc' ? 'selected' : '' }}>
                                    Ascending</option>
                                <option value="desc" {{ request('permission_direction') == 'desc' ? 'selected' : '' }}>
                                    Descending</option>
                            </select>

                            <!-- Items Per Page -->
                            <select name="permission_per_page"
                                class="px-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="9" {{ request('permission_per_page', 9) == 9 ? 'selected' : '' }}>9 per page
                                </option>
                                <option value="12" {{ request('permission_per_page', 9) == 12 ? 'selected' : '' }}>12 per page
                                </option>
                                <option value="18" {{ request('permission_per_page', 9) == 18 ? 'selected' : '' }}>18 per page
                                </option>
                                <option value="24" {{ request('permission_per_page', 9) == 24 ? 'selected' : '' }}>24 per page
                                </option>
                                <option value="36" {{ request('permission_per_page', 9) == 36 ? 'selected' : '' }}>36 per page
                                </option>
                            </select>

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl transition-all duration-200">
                                <i class="mr-2 fas fa-filter"></i>
                                Apply
                            </button>

                            @if (request()->hasAny(['permission_search', 'permission_assignment', 'permission_sort', 'permission_direction', 'permission_per_page']))
                                <a href="{{ route('role-permission.index') }}?tab=permissions"
                                    class="inline-flex items-center px-4 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-xl transition-all duration-200">
                                    <i class="mr-2 fas fa-times"></i>
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>
                    <a href="{{ route('permissions.create') }}"
                        class="inline-flex items-center px-4 py-3 font-medium text-white bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl hover:from-emerald-600 hover:to-emerald-700">
                        <i class="mr-2 fas fa-key"></i>
                        Create New Permission
                    </a>
                </div>

                <!-- Enhanced Bulk Actions untuk Permissions -->
                <div id="permissions-bulk-section" class="hidden mb-6">
                    <div
                        class="p-6 border border-emerald-200 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-800/20 dark:border-emerald-800 rounded-2xl backdrop-blur-sm">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 bg-white border shadow-sm border-emerald-200 rounded-xl dark:bg-emerald-800 dark:border-emerald-700">
                                        <i class="text-xl text-emerald-600 fas fa-layer-group dark:text-emerald-300"></i>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-emerald-900 dark:text-emerald-100">
                                            <span id="permissions-selected-count">0</span> permissions selected
                                        </p>
                                        <p class="text-sm text-emerald-700 dark:text-emerald-300">Bulk actions available
                                            for selected items</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <button type="button" id="permissions-cancel-selection"
                                    class="px-6 py-3 text-sm font-medium transition-all duration-200 bg-white border shadow-sm rounded-xl text-emerald-700 border-emerald-300 hover:bg-emerald-50 dark:bg-emerald-800 dark:text-emerald-200 dark:border-emerald-600 dark:hover:bg-emerald-700 hover:shadow-md">
                                    <i class="mr-2 fas fa-times"></i>
                                    Cancel Selection
                                </button>

                                <button type="button" id="permissions-bulk-delete-btn"
                                    class="flex items-center px-6 py-3 text-sm font-medium text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-red-500 to-red-600 rounded-xl hover:from-red-600 hover:to-red-700 hover:shadow-xl hover:scale-105 group">
                                    <i class="mr-2 fas fa-trash"></i>
                                    Delete Selected
                                    <span id="permissions-delete-count"
                                        class="px-2 py-1 ml-2 text-xs rounded-lg bg-white/20">0</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Permissions Grid -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @forelse($permissions as $index => $permission)
                        <div
                            class="relative p-6 transition-all duration-300 bg-white border border-gray-200 cursor-pointer group dark:bg-gray-800 dark:border-gray-700 rounded-2xl hover:shadow-xl hover:border-emerald-200 dark:hover:border-emerald-800 selectable-card"
                            data-index="{{ $index }}" data-type="permission" data-id="{{ $permission->id }}">
                            <!-- Premium Checkbox -->
                            <div class="absolute top-4 left-4">
                                <label class="custom-checkbox">
                                    <input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}"
                                        class="permission-checkbox bulk-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <div class="flex items-start justify-between mb-4 ml-8">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 shadow-lg rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600">
                                        <i class="text-lg text-white fas fa-key"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $permission->name }}</h3>
                                        <p class="text-sm text-gray-500 capitalize dark:text-gray-400">
                                            {{ str_replace(['-', '_'], ' ', $permission->name) }}
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="px-2 py-1 text-xs font-medium text-orange-800 bg-orange-100 rounded-full dark:bg-orange-900/30 dark:text-orange-300">
                                    {{ $permission->guard_name }}
                                </span>
                            </div>

                            <!-- Roles Assignment -->
                            <div class="mb-4">
                                <p class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Assigned to
                                    ({{ $permission->roles_count }})</p>
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($permission->roles->take(3) as $role)
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-lg dark:bg-blue-900/30 dark:text-blue-300">
                                            <i class="mr-1 text-xs fas fa-user-shield"></i>
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                    @if ($permission->roles_count > 3)
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-400">
                                            +{{ $permission->roles_count - 3 }} more
                                        </span>
                                    @endif
                                    @if ($permission->roles_count === 0)
                                        <span class="text-xs italic text-gray-500 dark:text-gray-400">Not assigned to any
                                            role</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div
                                class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    Created {{ $permission->created_at->diffForHumans() }}
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                        class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-green-600 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20"
                                        title="Edit Permission">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if (!$permission->roles_count)
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-400 transition-colors duration-200 rounded-lg hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 delete-permission-btn"
                                                title="Delete Permission"
                                                data-permission-name="{{ $permission->name }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="p-2 text-gray-300 cursor-not-allowed"
                                            title="Cannot delete - assigned to roles">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3">
                            <div class="py-12 text-center">
                                <div
                                    class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                    <i class="text-3xl text-gray-400 fas fa-key"></i>
                                </div>
                                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No Permissions Found
                                </h3>
                                <p class="mb-6 text-gray-500 dark:text-gray-400">Create permissions to control access to
                                    features</p>
                                <a href="{{ route('permissions.create') }}"
                                    class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-200 shadow-lg bg-emerald-600 hover:bg-emerald-700 rounded-xl hover:shadow-xl">
                                    <i class="mr-2 fas fa-plus"></i>
                                    Create Your First Permission
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Permissions Pagination -->
                @if($permissions->hasPages())
                <div class="pt-6 mt-8 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            Showing
                            <span class="font-semibold">{{ $permissions->firstItem() ?? 0 }}</span>
                            to
                            <span class="font-semibold">{{ $permissions->lastItem() ?? 0 }}</span>
                            of
                            <span class="font-semibold">{{ $permissions->total() }}</span>
                            results
                        </div>

                        <div class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($permissions->onFirstPage())
                                <span
                                    class="px-3 py-2 text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:border-gray-600">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $permissions->previousPageUrl() }}&{{ http_build_query(request()->except(['permissions_page', 'page'])) }}"
                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @php
                                $current = $permissions->currentPage();
                                $last = $permissions->lastPage();
                                $start = max(1, $current - 2);
                                $end = min($last, $current + 2);
                            @endphp

                            @if ($start > 1)
                                <a href="{{ $permissions->url(1) }}&{{ http_build_query(request()->except(['permissions_page', 'page'])) }}"
                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    1
                                </a>
                                @if ($start > 2)
                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $permissions->currentPage())
                                    <span
                                        class="px-3 py-2 font-semibold text-white border rounded-lg bg-emerald-600 border-emerald-600">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $permissions->url($page) }}&{{ http_build_query(request()->except(['permissions_page', 'page'])) }}"
                                        class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor

                            @if ($end < $last)
                                @if ($end < $last - 1)
                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                @endif
                                <a href="{{ $permissions->url($last) }}&{{ http_build_query(request()->except(['permissions_page', 'page'])) }}"
                                    class="px-3 py-2 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    {{ $last }}
                                </a>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($permissions->hasMorePages())
                                <a href="{{ $permissions->nextPageUrl() }}&{{ http_build_query(request()->except(['permissions_page', 'page'])) }}"
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
    </div>

    <!-- Hidden Form untuk Bulk Delete -->
    <form id="bulk-delete-roles-form" method="POST" action="{{ route('roles.bulk-delete') }}" class="hidden">
        @csrf
        <div id="roles-hidden-inputs"></div>
    </form>

    <form id="bulk-delete-permissions-form" method="POST" action="{{ route('permissions.bulk-delete') }}" class="hidden">
        @csrf
        <div id="permissions-hidden-inputs"></div>
    </form>
@endsection

@push('styles')
    <style>
        /* Premium Checkbox Styles */
        .custom-checkbox {
            display: block;
            position: relative;
            cursor: pointer;
            user-select: none;
            z-index: 20;
        }

        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: relative;
            height: 22px;
            width: 22px;
            background-color: #fff;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .custom-checkbox:hover input~.checkmark {
            border-color: #3b82f6;
            box-shadow: 0 2px 6px rgba(59, 130, 246, 0.3);
            transform: scale(1.05);
        }

        .custom-checkbox input:checked~.checkmark {
            background-color: #3b82f6;
            border-color: #3b82f6;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.4);
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
            left: 7px;
            top: 3px;
            width: 4px;
            height: 9px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .custom-checkbox input:checked~.checkmark:after {
            display: block;
        }

        .dark .checkmark {
            background-color: #374151;
            border-color: #4b5563;
        }

        .dark .custom-checkbox:hover input~.checkmark {
            border-color: #60a5fa;
        }

        .dark .custom-checkbox input:checked~.checkmark {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        /* Card selection styles */
        .selectable-card {
            transition: all 0.3s ease-in-out;
            position: relative;
            cursor: pointer;
        }

        .selectable-card.selected {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2), 0 8px 16px rgba(0, 0, 0, 0.1) !important;
            transform: translateY(-2px);
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }

        .dark .selectable-card.selected {
            border-color: #60a5fa !important;
            box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.3), 0 8px 16px rgba(0, 0, 0, 0.3) !important;
            background: linear-gradient(135deg, #1e3a8a20 0%, #1e40af20 100%);
        }

        .selectable-card.selected::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
            border-radius: 8px 8px 0 0;
            z-index: 10;
        }

        /* Bulk section animations */
        #roles-bulk-section,
        #permissions-bulk-section {
            transition: all 0.3s ease-in-out;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simple bulk actions
            const rolesBulkSection = document.getElementById('roles-bulk-section');
            const permissionsBulkSection = document.getElementById('permissions-bulk-section');
            const rolesCancelBtn = document.getElementById('roles-cancel-selection');
            const permissionsCancelBtn = document.getElementById('permissions-cancel-selection');
            const rolesHiddenInputs = document.getElementById('roles-hidden-inputs');
            const permissionsHiddenInputs = document.getElementById('permissions-hidden-inputs');
            const rolesBulkDeleteBtn = document.getElementById('roles-bulk-delete-btn');
            const permissionsBulkDeleteBtn = document.getElementById('permissions-bulk-delete-btn');
            const bulkDeleteRolesForm = document.getElementById('bulk-delete-roles-form');
            const bulkDeletePermissionsForm = document.getElementById('bulk-delete-permissions-form');

            // Update bulk actions
            function updateBulkActions(checkboxClass, bulkSection, countElement, deleteCountElement, hiddenContainer, type) {
                const checkboxes = document.querySelectorAll(checkboxClass);
                const checkedBoxes = Array.from(checkboxes).filter(cb => cb.checked);
                const checkedCount = checkedBoxes.length;

                if (checkedCount > 0) {
                    bulkSection.classList.remove('hidden');
                    countElement.textContent = checkedCount;
                    deleteCountElement.textContent = checkedCount;

                    // Update card selection state
                    updateCardSelection(type, checkedBoxes);

                    // Update hidden inputs
                    hiddenContainer.innerHTML = '';
                    checkedBoxes.forEach(checkbox => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = type === 'role' ? 'role_ids[]' : 'permission_ids[]';
                        input.value = checkbox.value;
                        hiddenContainer.appendChild(input);
                    });
                } else {
                    bulkSection.classList.add('hidden');
                    resetCardSelection(type);
                }
            }

            // Update card selection visual
            function updateCardSelection(type, checkedBoxes) {
                const cards = document.querySelectorAll(`.selectable-card[data-type="${type}"]`);
                const checkedIds = checkedBoxes.map(cb => cb.value);

                cards.forEach(card => {
                    const cardId = card.getAttribute('data-id');
                    if (checkedIds.includes(cardId)) {
                        card.classList.add('selected');
                    } else {
                        card.classList.remove('selected');
                    }
                });
            }

            // Reset card selection
            function resetCardSelection(type) {
                const cards = document.querySelectorAll(`.selectable-card[data-type="${type}"]`);
                const checkboxes = document.querySelectorAll(`.${type}-checkbox`);

                cards.forEach(card => {
                    card.classList.remove('selected');
                });

                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }

            // Cancel selection
            function cancelSelection(checkboxClass, bulkSection, type) {
                const checkboxes = document.querySelectorAll(checkboxClass);
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                bulkSection.classList.add('hidden');
                resetCardSelection(type);
            }

            // Card click handler
            function setupCardSelection() {
                document.querySelectorAll('.selectable-card').forEach(card => {
                    card.addEventListener('click', function(e) {
                        if (e.target.tagName === 'A' ||
                            e.target.tagName === 'BUTTON' ||
                            e.target.closest('a') ||
                            e.target.closest('button') ||
                            e.target.classList.contains('custom-checkbox') ||
                            e.target.classList.contains('checkmark')) {
                            return;
                        }

                        const type = this.getAttribute('data-type');
                        const checkbox = this.querySelector(`.${type}-checkbox`);

                        if (checkbox) {
                            checkbox.checked = !checkbox.checked;
                            const event = new Event('change', {
                                bubbles: true
                            });
                            checkbox.dispatchEvent(event);
                        }
                    });
                });
            }

            // Checkbox change events
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('role-checkbox')) {
                    updateBulkActions(
                        '.role-checkbox',
                        rolesBulkSection,
                        document.getElementById('roles-selected-count'),
                        document.getElementById('roles-delete-count'),
                        rolesHiddenInputs,
                        'role'
                    );
                }

                if (e.target.classList.contains('permission-checkbox')) {
                    updateBulkActions(
                        '.permission-checkbox',
                        permissionsBulkSection,
                        document.getElementById('permissions-selected-count'),
                        document.getElementById('permissions-delete-count'),
                        permissionsHiddenInputs,
                        'permission'
                    );
                }
            });

            // Cancel buttons
            if (rolesCancelBtn) {
                rolesCancelBtn.addEventListener('click', () => {
                    cancelSelection('.role-checkbox', rolesBulkSection, 'role');
                });
            }

            if (permissionsCancelBtn) {
                permissionsCancelBtn.addEventListener('click', () => {
                    cancelSelection('.permission-checkbox', permissionsBulkSection, 'permission');
                });
            }

            // Bulk delete confirmation
            function setupBulkDelete(button, form, countElement, type) {
                if (button && form) {
                    button.addEventListener('click', function() {
                        const count = countElement.textContent;
                        const hiddenContainer = form.querySelector('div');

                        if (count === '0' || !hiddenContainer || hiddenContainer.children.length === 0) {
                            Swal.fire({
                                title: 'No Selection',
                                text: `Please select at least one ${type} to delete.`,
                                icon: 'warning',
                                confirmButtonColor: '#3b82f6',
                            });
                            return;
                        }

                        Swal.fire({
                            title: `Delete Selected ${type.charAt(0).toUpperCase() + type.slice(1)}s?`,
                            html: `
                                <div class="text-center">
                                    <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-red-100 rounded-2xl dark:bg-red-900/30">
                                        <i class="text-2xl text-red-600 fas fa-exclamation-triangle dark:text-red-400"></i>
                                    </div>
                                    <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Confirm Bulk Deletion</h3>
                                    <p class="mb-4 text-gray-600 dark:text-gray-400">
                                        You are about to permanently delete <span class="font-bold text-red-600 dark:text-red-400">${count}</span> selected ${type}s.
                                    </p>
                                    <div class="p-4 mb-4 border border-red-200 rounded-xl bg-red-50 dark:bg-red-900/20 dark:border-red-800">
                                        <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                            <i class="mr-2 fas fa-exclamation-circle"></i>
                                            This action cannot be undone${type === 'role' ? ' and will remove these roles from all users!' : '!'}
                                        </p>
                                    </div>
                                </div>
                            `,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: `Yes, Delete ${count} ${type.charAt(0).toUpperCase() + type.slice(1)}s`,
                            cancelButtonText: 'Cancel',
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6b7280',
                            background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                            color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
                            customClass: {
                                confirmButton: 'px-8 py-3 font-semibold text-white bg-red-600 rounded-xl hover:bg-red-700 transition-all duration-200 mr-3 shadow-lg hover:shadow-xl',
                                cancelButton: 'px-8 py-3 font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 ml-3',
                                actions: '!gap-4 !mt-8'
                            },
                            buttonsStyling: false,
                            reverseButtons: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                }
            }

            // Setup bulk delete handlers
            setupBulkDelete(rolesBulkDeleteBtn, bulkDeleteRolesForm, document.getElementById('roles-delete-count'), 'role');
            setupBulkDelete(permissionsBulkDeleteBtn, bulkDeletePermissionsForm, document.getElementById('permissions-delete-count'), 'permission');

            // Initialize card selection
            setupCardSelection();

            // Individual delete confirmation
            document.querySelectorAll('.delete-role-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = this.closest('form');
                    const roleName = this.getAttribute('data-role-name');

                    Swal.fire({
                        title: 'Delete Role',
                        html: `
                            <div class="text-center">
                                <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-red-100 rounded-2xl dark:bg-red-900/30">
                                    <i class="text-2xl text-red-600 fas fa-exclamation-triangle dark:text-red-400"></i>
                                </div>
                                <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Confirm Deletion</h3>
                                <p class="mb-4 text-gray-600 dark:text-gray-400">
                                    You are about to permanently delete the role:
                                </p>
                                <div class="p-4 mb-4 border border-red-200 rounded-xl bg-red-50 dark:bg-red-900/20 dark:border-red-800">
                                    <p class="text-lg font-bold text-red-800 dark:text-red-200">${roleName}</p>
                                </div>
                                <p class="text-sm font-medium text-red-600 dark:text-red-400">
                                    <i class="mr-1 fas fa-exclamation-circle"></i>
                                    This action cannot be undone and will remove this role from all users!
                                </p>
                            </div>
                        `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Delete Role',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                        color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
                        customClass: {
                            confirmButton: 'px-8 py-3 font-semibold text-white bg-red-600 rounded-xl hover:bg-red-700 transition-all duration-200 mr-3 shadow-lg hover:shadow-xl',
                            cancelButton: 'px-8 py-3 font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 ml-3',
                            actions: '!gap-4 !mt-8'
                        },
                        buttonsStyling: false,
                        reverseButtons: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            document.querySelectorAll('.delete-permission-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = this.closest('form');
                    const permissionName = this.getAttribute('data-permission-name');

                    Swal.fire({
                        title: 'Delete Permission',
                        html: `
                            <div class="text-center">
                                <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-red-100 rounded-2xl dark:bg-red-900/30">
                                    <i class="text-2xl text-red-600 fas fa-exclamation-triangle dark:text-red-400"></i>
                                </div>
                                <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Confirm Deletion</h3>
                                <p class="mb-4 text-gray-600 dark:text-gray-400">
                                    You are about to permanently delete the permission:
                                </p>
                                <div class="p-4 mb-4 border border-red-200 rounded-xl bg-red-50 dark:bg-red-900/20 dark:border-red-800">
                                    <p class="text-lg font-bold text-red-800 dark:text-red-200">${permissionName}</p>
                                </div>
                                <p class="text-sm font-medium text-red-600 dark:text-red-400">
                                    <i class="mr-1 fas fa-exclamation-circle"></i>
                                    This action cannot be undone!
                                </p>
                            </div>
                        `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Delete Permission',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                        color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
                        customClass: {
                            confirmButton: 'px-8 py-3 font-semibold text-white bg-red-600 rounded-xl hover:bg-red-700 transition-all duration-200 mr-3 shadow-lg hover:shadow-xl',
                            cancelButton: 'px-8 py-3 font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 ml-3',
                            actions: '!gap-4 !mt-8'
                        },
                        buttonsStyling: false,
                        reverseButtons: false
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
