 @extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
    <div class="space-y-6">
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
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Users Management</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Users Management</h1>
                <p class="mt-1 text-gray-600 dark:text-gray-400">Manage your application users and their permissions</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center px-4 py-2 font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700">
                    <i class="mr-2 fas fa-user-plus"></i>
                    Add New User
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
            <!-- Stats cards code tetap sama -->
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($stats['total_users']) }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                        <i class="text-xl text-blue-600 fas fa-users dark:text-blue-400"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-sm font-medium text-green-600 dark:text-green-400">
                        <i class="mr-1 fas fa-arrow-up"></i>12.5%
                    </span>
                    <span class="ml-1 text-sm text-gray-500 dark:text-gray-400">from last month</span>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Users</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($stats['active_users']) }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-lg dark:bg-green-900/30">
                        <i class="text-xl text-green-600 fas fa-user-check dark:text-green-400"></i>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">New This Month</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($stats['new_this_month']) }}</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-lg dark:bg-purple-900/30">
                        <i class="text-xl text-purple-600 fas fa-user-plus dark:text-purple-400"></i>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Admins</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['admins']) }}
                        </p>
                    </div>
                    <div class="p-3 bg-orange-100 rounded-lg dark:bg-orange-900/30">
                        <i class="text-xl text-orange-600 fas fa-shield-alt dark:text-orange-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
            <form method="GET" action="{{ route('users.index') }}">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <!-- Search -->
                    <div class="relative flex-1 max-w-md">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="text-gray-400 fas fa-search"></i>
                        </div>
                        <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}"
                            class="w-full py-2 pl-10 pr-4 text-gray-900 placeholder-gray-500 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:text-white dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:placeholder-gray-400">
                    </div>

                    <!-- Filters -->
                    <div class="flex items-center space-x-4">
                        <select name="role"
                            class="px-3 py-2 pr-5 text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:text-white dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="all" {{ request('role') == 'all' ? 'selected' : '' }}>All Roles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="moderator" {{ request('role') == 'moderator' ? 'selected' : '' }}>Moderator
                            </option>
                        </select>

                        <select name="status"
                            class="px-3 py-2 pr-5 text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:text-white dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended
                            </option>
                        </select>

                        <!-- Per Page Selector -->
                        <select name="per_page"
                            class="px-3 py-2 pr-5 text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:text-white dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            onchange="this.form.submit()">
                            <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5 per page</option>
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per page
                            </option>
                            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25 per page
                            </option>
                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 per page
                            </option>
                            <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100 per page
                            </option>
                        </select>

                        <button type="submit"
                            class="px-4 py-2 font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700">
                            <i class="mr-2 fas fa-filter"></i>
                            Apply
                        </button>

                        @if (request()->hasAny(['search', 'role', 'status', 'per_page']))
                            <a href="{{ route('users.index') }}"
                                class="px-4 py-2 font-medium text-white transition-colors duration-200 bg-gray-500 rounded-lg hover:bg-gray-600">
                                <i class="mr-2 fas fa-times"></i>
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div
            class="overflow-hidden bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        All Users ({{ $users->total() }})
                    </h3>
                    <div class="flex items-center space-x-2">
                        <button
                            class="inline-flex items-center px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                            <i class="mr-2 fas fa-download"></i>
                            Export
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50 dark:bg-gray-700/50 dark:border-gray-600">
                            <!-- User Column dengan Sort -->
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'name',
                                    'direction' => request('sort') == 'name' && request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}"
                                    class="flex items-center space-x-1 transition-colors duration-200 group hover:text-gray-700 dark:hover:text-gray-300">
                                    <span>User</span>
                                    <div class="flex flex-col">
                                        @if (request('sort') == 'name')
                                            @if (request('direction') == 'asc')
                                                <i class="fas fa-sort-up text-primary-600"></i>
                                            @else
                                                <i class="fas fa-sort-down text-primary-600"></i>
                                            @endif
                                        @else
                                            <i class="text-gray-400 fas fa-sort group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                        @endif
                                    </div>
                                </a>
                            </th>

                            <!-- Role Column dengan Sort -->
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'role',
                                    'direction' => request('sort') == 'role' && request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}"
                                    class="flex items-center space-x-1 transition-colors duration-200 group hover:text-gray-700 dark:hover:text-gray-300">
                                    <span>Role</span>
                                    <div class="flex flex-col">
                                        @if (request('sort') == 'role')
                                            @if (request('direction') == 'asc')
                                                <i class="fas fa-sort-up text-primary-600"></i>
                                            @else
                                                <i class="fas fa-sort-down text-primary-600"></i>
                                            @endif
                                        @else
                                            <i class="text-gray-400 fas fa-sort group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                        @endif
                                    </div>
                                </a>
                            </th>

                            <!-- Status Column dengan Sort -->
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'status',
                                    'direction' => request('sort') == 'status' && request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}"
                                    class="flex items-center space-x-1 transition-colors duration-200 group hover:text-gray-700 dark:hover:text-gray-300">
                                    <span>Status</span>
                                    <div class="flex flex-col">
                                        @if (request('sort') == 'status')
                                            @if (request('direction') == 'asc')
                                                <i class="fas fa-sort-up text-primary-600"></i>
                                            @else
                                                <i class="fas fa-sort-down text-primary-600"></i>
                                            @endif
                                        @else
                                            <i class="text-gray-400 fas fa-sort group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                        @endif
                                    </div>
                                </a>
                            </th>

                            <!-- Joined Date Column dengan Sort -->
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'created_at',
                                    'direction' => request('sort') == 'created_at' && request('direction') == 'asc' ? 'desc' : 'asc',
                                ]) }}"
                                    class="flex items-center space-x-1 transition-colors duration-200 group hover:text-gray-700 dark:hover:text-gray-300">
                                    <span>Joined Date</span>
                                    <div class="flex flex-col">
                                        @if (request('sort') == 'created_at')
                                            @if (request('direction') == 'asc')
                                                <i class="fas fa-sort-up text-primary-600"></i>
                                            @else
                                                <i class="fas fa-sort-down text-primary-600"></i>
                                            @endif
                                        @else
                                            <i class="text-gray-400 fas fa-sort group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                        @endif
                                    </div>
                                </a>
                            </th>

                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-gray-400">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($users as $user)
                            <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @php
                                            $avatarColors = [
                                                'admin' => 'from-primary-500 to-primary-600',
                                                'moderator' => 'from-green-500 to-green-600',
                                                'user' => 'from-orange-500 to-orange-600',
                                            ];
                                            $color = $avatarColors[$user->role] ?? 'from-gray-500 to-gray-600';
                                            $avatarInitials = strtoupper(substr($user->name, 0, 2));
                                        @endphp
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r {{ $color }} rounded-full flex items-center justify-center flex-shrink-0">
                                            <span class="text-sm font-semibold text-white">{{ $avatarInitials }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $user->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $roleConfig = [
                                            'admin' => [
                                                'class' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                'icon' => 'fa-shield-alt',
                                            ],
                                            'moderator' => [
                                                'class' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                                'icon' => 'fa-user-shield',
                                            ],
                                            'user' => [
                                                'class' => 'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300',
                                                'icon' => 'fa-user',
                                            ],
                                            'writer' => [
                                                'class' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                'icon' => 'fa-pen',
                                            ],
                                            'editor' => [
                                                'class' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300',
                                                'icon' => 'fa-edit',
                                            ],
                                        ];

                                        $primaryRole = $user->getRoleNames()->first();
                                        $roleKey = strtolower($primaryRole);
                                        $config = $roleConfig[$roleKey] ?? $roleConfig['user'];
                                    @endphp

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['class'] }}">
                                        <i class="fas {{ $config['icon'] }} mr-1"></i>
                                        {{ $primaryRole }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusConfig = [
                                            'active' => [
                                                'class' =>
                                                    'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                'icon' => 'fa-check-circle',
                                            ],
                                            'pending' => [
                                                'class' =>
                                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                                'icon' => 'fa-exclamation-triangle',
                                            ],
                                            'suspended' => [
                                                'class' =>
                                                    'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                'icon' => 'fa-ban',
                                            ],
                                            'inactive' => [
                                                'class' =>
                                                    'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300',
                                                'icon' => 'fa-times-circle',
                                            ],
                                        ];
                                        $status = $statusConfig[$user->status] ?? $statusConfig['inactive'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status['class'] }}">
                                        <i class="fas {{ $status['icon'] }} mr-1"></i>
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="p-1 text-blue-600 transition-colors duration-200 rounded hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                            title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('users.show', $user->id) }}"
                                            class="p-1 text-green-600 transition-colors duration-200 rounded hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                            title="View User">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" id="delete-form-{{ $user->id }}">
        @csrf
        @method('DELETE')
        <button type="button"
            class="p-1 text-red-600 transition-colors duration-200 rounded hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 delete-btn"
            title="Delete User"
            data-user-id="{{ $user->id }}"
            data-user-name="{{ $user->name }}"
            data-user-email="{{ $user->email }}">
            <i class="fas fa-trash"></i>
        </button>
    </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer dengan Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-4 text-sm text-gray-700 sm:mb-0 dark:text-gray-300">
                        Showing
                        <span class="font-medium">{{ $users->firstItem() ?? 0 }}</span>
                        to
                        <span class="font-medium">{{ $users->lastItem() ?? 0 }}</span>
                        of
                        <span class="font-medium">{{ $users->total() }}</span>
                        results

                        <!-- Current Sort Info -->
                        @if (request('sort'))
                            <span class="px-2 py-1 ml-4 text-xs bg-gray-100 rounded dark:bg-gray-700">
                                Sorted by: {{ ucfirst(str_replace('_', ' ', request('sort'))) }}
                                ({{ request('direction') == 'asc' ? 'Ascending' : 'Descending' }})
                            </span>
                        @endif
                    </div>

                    <!-- Custom Pagination -->
                    @if ($users->hasPages())
                        <div class="flex items-center space-x-1">
                            {{-- Previous Page Link --}}
                            @if ($users->onFirstPage())
                                <span
                                    class="px-3 py-1 text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:border-gray-600">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $users->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                    class="px-3 py-1 text-gray-500 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @php
                                // Custom pagination logic untuk menampilkan maksimal 7 halaman
                                $current = $users->currentPage();
                                $last = $users->lastPage();
                                $start = max(1, $current - 3);
                                $end = min($last, $current + 3);
                            @endphp

                            @if ($start > 1)
                                <a href="{{ $users->url(1) }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                    class="px-3 py-1 text-gray-500 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    1
                                </a>
                                @if ($start > 2)
                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $users->currentPage())
                                    <span
                                        class="px-3 py-1 font-medium text-white border rounded-lg bg-primary-600 border-primary-600">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $users->url($page) }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                        class="px-3 py-1 text-gray-500 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor

                            @if ($end < $last)
                                @if ($end < $last - 1)
                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                @endif
                                <a href="{{ $users->url($last) }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                    class="px-3 py-1 text-gray-500 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    {{ $last }}
                                </a>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                    class="px-3 py-1 text-gray-500 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span
                                    class="px-3 py-1 text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:border-gray-600">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // SweetAlert untuk konfirmasi delete - FIXED VERSION
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            const userEmail = this.getAttribute('data-user-email');
            const form = document.getElementById(`delete-form-${userId}`);

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
                background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
                customClass: {
                    confirmButton: 'px-6 py-2.5 font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors duration-200 mr-2',
                    cancelButton: 'px-6 py-2.5 font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 ml-2',
                    actions: '!gap-3 !mt-6'
                },
                buttonsStyling: false,
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    const originalHTML = button.innerHTML;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    button.disabled = true;

                    // Submit form
                    form.submit();
                }
                // Jika cancel, tidak perlu melakukan apa-apa (otomatis tutup)
            });
        });
    });

    // SweetAlert untuk flash messages dari controller
    @if(session('success'))
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonColor: '#10b981',
        background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
        color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
        customClass: {
            confirmButton: 'px-6 py-2.5 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200'
        },
        buttonsStyling: false
    });
    @endif

    @if(session('error'))
    Swal.fire({
        title: 'Error!',
        text: '{{ session('error') }}',
        icon: 'error',
        confirmButtonColor: '#ef4444',
        background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
        color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
        customClass: {
            confirmButton: 'px-6 py-2.5 font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors duration-200'
        },
        buttonsStyling: false
    });
    @endif
});
</script>
@endsection
