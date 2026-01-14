@extends('layouts.admin')

@section('title', 'Role & Permission Management')

@section('content')
    <div class="space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex justify-end mb-3" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-500 transition-colors duration-200 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white">
                        <i class="mr-2 fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Role & Permission Management</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Role & Permission Management</h1>
                <p class="mt-1 text-gray-600 dark:text-gray-400">Manage roles and permissions for user access control</p>
            </div>
            <div class="flex mt-4 space-x-3 sm:mt-0">
                <a href="{{ route('roles.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700">
                    <i class="mr-2 fas fa-plus"></i>
                    Add Role
                </a>
                <a href="{{ route('permissions.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-green-600 border border-transparent rounded-lg hover:bg-green-700">
                    <i class="mr-2 fas fa-key"></i>
                    Add Permission
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Roles</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_roles'] }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                        <i class="text-xl text-blue-600 fas fa-user-shield dark:text-blue-400"></i>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Permissions</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_permissions'] }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-lg dark:bg-green-900/30">
                        <i class="text-xl text-green-600 fas fa-key dark:text-green-400"></i>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">System Users</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-lg dark:bg-purple-900/30">
                        <i class="text-xl text-purple-600 fas fa-users dark:text-purple-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex -mb-px space-x-8">
                <button id="roles-tab" class="px-1 py-4 text-sm font-medium transition-colors duration-200 border-b-2 tab-button border-primary-500 text-primary-600 dark:text-primary-400">
                    <i class="mr-2 fas fa-user-shield"></i>
                    Roles ({{ count($roles) }})
                </button>
                <button id="permissions-tab" class="px-1 py-4 text-sm font-medium text-gray-500 transition-colors duration-200 border-b-2 border-transparent tab-button hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300">
                    <i class="mr-2 fas fa-key"></i>
                    Permissions ({{ count($permissions) }})
                </button>
            </nav>
        </div>

        <!-- Roles Tab Content -->
        <div id="roles-content" class="tab-content">
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">System Roles</h3>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="text-gray-400 fas fa-search"></i>
                            </div>
                            <input type="text" id="role-search" placeholder="Search roles..."
                                class="py-2 pl-10 pr-4 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden border border-gray-200 rounded-lg dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Role Name
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Permissions
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Users
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Created
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-gray-400">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($roles as $role)
                                <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                                <i class="text-sm text-blue-600 fas fa-user-shield dark:text-blue-400"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $role->name }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $role->guard_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($role->permissions->take(3) as $permission)
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">
                                                    <i class="mr-1 text-xs fas fa-key"></i>
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                            @if($role->permissions->count() > 3)
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-400">
                                                    +{{ $role->permissions->count() - 3 }} more
                                                </span>
                                            @endif
                                            @if($role->permissions->count() === 0)
                                                <span class="text-xs text-gray-500 dark:text-gray-400">No permissions</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                                            <i class="mr-1 fas fa-users"></i>
                                            {{ $role->users_count }} users
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $role->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('roles.show', $role->id) }}"
                                                class="p-1 text-blue-600 transition-colors duration-200 rounded hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                                title="View Role">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('roles.edit', $role->id) }}"
                                                class="p-1 text-green-600 transition-colors duration-200 rounded hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                                title="Edit Role">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if(!in_array($role->name, ['super-admin', 'admin']))
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-1 text-red-600 transition-colors duration-200 rounded hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 delete-role-btn"
                                                        title="Delete Role"
                                                        data-role-name="{{ $role->name }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="p-1 text-gray-400 cursor-not-allowed" title="Cannot delete system role">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <i class="mb-3 text-4xl text-gray-400 fas fa-user-shield"></i>
                                            <p class="text-lg font-medium text-gray-900 dark:text-white">No roles found</p>
                                            <p class="text-gray-500 dark:text-gray-400">Get started by creating your first role</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Permissions Tab Content -->
        <div id="permissions-content" class="hidden tab-content">
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-card dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">System Permissions</h3>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="text-gray-400 fas fa-search"></i>
                            </div>
                            <input type="text" id="permission-search" placeholder="Search permissions..."
                                class="py-2 pl-10 pr-4 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden border border-gray-200 rounded-lg dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Permission Name
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Guard
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Roles
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Created
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase dark:text-gray-400">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($permissions as $permission)
                                <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-green-100 rounded-lg dark:bg-green-900/30">
                                                <i class="text-sm text-green-600 fas fa-key dark:text-green-400"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $permission->name }}
                                                </div>
                                                <div class="text-sm text-gray-500 capitalize dark:text-gray-400">
                                                    {{ str_replace(['-', '_'], ' ', $permission->name) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300">
                                            {{ $permission->guard_name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($permission->roles->take(3) as $role)
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                                                    <i class="mr-1 text-xs fas fa-user-shield"></i>
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                            @if($permission->roles->count() > 3)
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-400">
                                                    +{{ $permission->roles->count() - 3 }} more
                                                </span>
                                            @endif
                                            @if($permission->roles->count() === 0)
                                                <span class="text-xs text-gray-500 dark:text-gray-400">No roles</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $permission->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('permissions.edit', $permission->id) }}"
                                                class="p-1 text-green-600 transition-colors duration-200 rounded hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                                title="Edit Permission">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if(!$permission->roles->count())
                                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-1 text-red-600 transition-colors duration-200 rounded hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 delete-permission-btn"
                                                        title="Delete Permission"
                                                        data-permission-name="{{ $permission->name }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="p-1 text-gray-400 cursor-not-allowed" title="Cannot delete - assigned to roles">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <i class="mb-3 text-4xl text-gray-400 fas fa-key"></i>
                                            <p class="text-lg font-medium text-gray-900 dark:text-white">No permissions found</p>
                                            <p class="text-gray-500 dark:text-gray-400">Get started by creating your first permission</p>
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const rolesTab = document.getElementById('roles-tab');
    const permissionsTab = document.getElementById('permissions-tab');
    const rolesContent = document.getElementById('roles-content');
    const permissionsContent = document.getElementById('permissions-content');

    function switchTab(tab) {
        // Reset all tabs
        [rolesTab, permissionsTab].forEach(t => {
            t.classList.remove('border-primary-500', 'text-primary-600', 'dark:text-primary-400');
            t.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
        });

        // Hide all content
        [rolesContent, permissionsContent].forEach(c => c.classList.add('hidden'));

        // Activate selected tab
        if (tab === 'roles') {
            rolesTab.classList.add('border-primary-500', 'text-primary-600', 'dark:text-primary-400');
            rolesTab.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
            rolesContent.classList.remove('hidden');
        } else {
            permissionsTab.classList.add('border-primary-500', 'text-primary-600', 'dark:text-primary-400');
            permissionsTab.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
            permissionsContent.classList.remove('hidden');
        }
    }

    rolesTab.addEventListener('click', () => switchTab('roles'));
    permissionsTab.addEventListener('click', () => switchTab('permissions'));

    // SweetAlert untuk konfirmasi delete role
    document.querySelectorAll('.delete-role-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const form = this.closest('form');
            const roleName = this.getAttribute('data-role-name');

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
                            <p class="font-medium text-gray-900 dark:text-white">${roleName}</p>
                        </div>
                        <p class="text-sm font-medium text-red-600 dark:text-red-400">
                            This will remove this role from all users and cannot be undone!
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
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // SweetAlert untuk konfirmasi delete permission
    document.querySelectorAll('.delete-permission-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const form = this.closest('form');
            const permissionName = this.getAttribute('data-permission-name');

            Swal.fire({
                title: 'Delete Permission',
                html: `
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full dark:bg-red-900/30">
                            <i class="text-xl text-red-600 fas fa-exclamation-triangle dark:text-red-400"></i>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Are you sure?</h3>
                        <p class="mb-4 text-gray-600 dark:text-gray-400">
                            You are about to delete the permission:
                        </p>
                        <div class="p-3 mb-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                            <p class="font-medium text-gray-900 dark:text-white">${permissionName}</p>
                        </div>
                        <p class="text-sm font-medium text-red-600 dark:text-red-400">
                            This action cannot be undone!
                        </p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete permission',
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
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Search functionality
    const roleSearch = document.getElementById('role-search');
    const permissionSearch = document.getElementById('permission-search');

    if (roleSearch) {
        roleSearch.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#roles-content tbody tr');

            rows.forEach(row => {
                const roleName = row.querySelector('td:first-child .text-sm.font-medium').textContent.toLowerCase();
                row.style.display = roleName.includes(searchTerm) ? '' : 'none';
            });
        });
    }

    if (permissionSearch) {
        permissionSearch.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#permissions-content tbody tr');

            rows.forEach(row => {
                const permissionName = row.querySelector('td:first-child .text-sm.font-medium').textContent.toLowerCase();
                row.style.display = permissionName.includes(searchTerm) ? '' : 'none';
            });
        });
    }

    // Flash messages
    @if(session('success'))
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonColor: '#10b981',
        background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
        color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
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
    });
    @endif
});
</script>
@endpush
