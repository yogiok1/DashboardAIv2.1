 @extends('layouts.admin')

@section('title', 'Edit Role')
@section('header-title', 'Edit Role')

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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Edit Role</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Total Roles Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-100">Total Roles</p>
                            <p class="mt-2 text-3xl font-bold">{{ $stats['total_roles'] }}</p>
                            <p class="mt-2 text-xs text-blue-100 opacity-90">System roles</p>
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
                            <p class="mt-2 text-xs text-emerald-100 opacity-90">Available permissions</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-key"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Current Role Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-100">Editing Role</p>
                            <p class="mt-2 text-xl font-bold">{{ $role->name }}</p>
                            <p class="mt-2 text-xs text-purple-100 opacity-90">{{ $role->permissions->count() }} permissions assigned</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-edit"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Form Section -->
            <div class="lg:col-span-2">
                <div class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Role Information</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update basic role details and permissions</p>
                    </div>

                    <form id="editRoleForm" method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="p-6 space-y-6">
                            <!-- Role Name -->
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Role Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $role->name) }}"
                                    required
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 @error('name') border-red-500 @enderror"
                                    placeholder="Enter role name (e.g., moderator, editor)">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Guard Name -->
                            <div>
                                <label for="guard_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Guard Name <span class="text-red-500">*</span>
                                </label>
                                <select id="guard_name"
                                    name="guard_name"
                                    required
                                    class="w-full px-4 py-3 text-gray-900 transition-all duration-200 bg-white border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                    <option value="web" {{ old('guard_name', $role->guard_name) == 'web' ? 'selected' : '' }}>Web</option>
                                    <option value="api" {{ old('guard_name', $role->guard_name) == 'api' ? 'selected' : '' }}>API</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Determines which guard this role applies to
                                </p>
                            </div>

                            <!-- Permissions Section -->
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Permissions
                                    </label>
                                    <div class="flex items-center space-x-2">
                                        <button type="button"
                                            id="select-all-permissions"
                                            class="text-xs px-3 py-1.5 bg-primary-100 hover:bg-primary-200 text-primary-700 rounded-lg transition-colors duration-200 dark:bg-primary-900/30 dark:text-primary-300 dark:hover:bg-primary-800/30">
                                            Select All
                                        </button>
                                        <button type="button"
                                            id="deselect-all-permissions"
                                            class="text-xs px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                            Deselect All
                                        </button>
                                    </div>
                                </div>

                                <!-- Permissions Grid -->
                                <div class="grid grid-cols-1 gap-4 p-4 overflow-y-auto border border-gray-200 max-h-96 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700/50">
                                    @php
                                        $groupedPermissions = $permissions->groupBy(function($permission) {
                                            $parts = explode('.', $permission->name);
                                            return $parts[0] ?? 'general';
                                        });
                                    @endphp

                                    @foreach($groupedPermissions as $module => $modulePermissions)
                                        <div class="space-y-3">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-2 h-2 rounded-full bg-primary-500"></div>
                                                <h4 class="text-sm font-semibold text-gray-900 capitalize dark:text-white">
                                                    {{ $module }} ({{ $modulePermissions->count() }})
                                                </h4>
                                            </div>
                                            <div class="grid grid-cols-1 gap-2 ml-4 sm:grid-cols-2">
                                                @foreach($modulePermissions as $permission)
                                                    <label class="flex items-center p-3 space-x-3 transition-colors duration-200 border border-gray-200 rounded-lg cursor-pointer dark:border-gray-600 hover:bg-white dark:hover:bg-gray-600">
                                                        <input type="checkbox"
                                                            name="permissions[]"
                                                            value="{{ $permission->id }}"
                                                            {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}
                                                            class="w-4 h-4 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
                                                        <span class="flex-1 text-sm text-gray-700 dark:text-gray-300">
                                                            {{ $permission->name }}
                                                        </span>
                                                        <span class="px-2 py-1 text-xs text-gray-600 bg-gray-100 rounded-full dark:bg-gray-600 dark:text-gray-400">
                                                            {{ $permission->guard_name }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach

                                    @if($permissions->isEmpty())
                                        <div class="py-8 text-center">
                                            <i class="mb-3 text-3xl text-gray-400 fas fa-key"></i>
                                            <p class="text-gray-500 dark:text-gray-400">No permissions available</p>
                                            <a href="{{ route('permissions.create') }}"
                                                class="inline-flex items-center mt-2 text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400">
                                                <i class="mr-1 fas fa-plus"></i>
                                                Create Permissions
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                @error('permissions')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                    <button type="button"
                                        onclick="window.location.href='{{ route('role-permission.index') }}'"
                                        class="px-6 py-3 text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                        Cancel
                                    </button>
                                    <button type="button"
                                        onclick="confirmUpdate()"
                                        class="px-6 py-3 text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl hover:from-primary-600 hover:to-primary-700 hover:shadow-xl hover:scale-105">
                                        <i class="mr-2 fas fa-save"></i>
                                        Update Role
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Role Summary -->
                <div class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $role->permissions->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Users with this Role</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $role->users_count ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Created</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $role->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Last Updated</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $role->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('roles.create') }}"
                            class="flex items-center p-3 space-x-3 transition-colors duration-200 border border-gray-200 rounded-lg dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 group">
                            <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                <i class="text-blue-600 fas fa-plus dark:text-blue-400"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">
                                Create New Role
                            </span>
                        </a>
                        <a href="{{ route('permissions.create') }}"
                            class="flex items-center p-3 space-x-3 transition-colors duration-200 border border-gray-200 rounded-lg dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 group">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30">
                                <i class="text-emerald-600 fas fa-key dark:text-emerald-400"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">
                                Create Permission
                            </span>
                        </a>
                        @if (!in_array($role->name, ['super-admin', 'admin']))
                            <form id="deleteRoleForm" action="{{ route('roles.destroy', $role->id) }}" method="POST" class="pt-3 border-t border-gray-100 dark:border-gray-700">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    onclick="confirmDelete()"
                                    class="flex items-center w-full p-3 space-x-3 text-left transition-colors duration-200 border border-red-200 rounded-lg dark:border-red-800 hover:bg-red-50 dark:hover:bg-red-900/20 group">
                                    <div class="flex items-center justify-center w-8 h-8 bg-red-100 rounded-lg dark:bg-red-900/30">
                                        <i class="text-red-600 fas fa-trash dark:text-red-400"></i>
                                    </div>
                                    <span class="text-sm font-medium text-red-700 dark:text-red-300 group-hover:text-red-800 dark:group-hover:text-red-200">
                                        Delete Role
                                    </span>
                                </button>
                            </form>
                        @else
                            <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex items-center p-3 space-x-3 border border-gray-200 rounded-lg dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50">
                                    <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-lg dark:bg-gray-600">
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
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all permissions
        document.getElementById('select-all-permissions').addEventListener('click', function() {
            document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
                checkbox.checked = true;
            });
        });

        // Deselect all permissions
        document.getElementById('deselect-all-permissions').addEventListener('click', function() {
            document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
                checkbox.checked = false;
            });
        });

        // Module filter for permissions
        const permissionSearch = document.getElementById('permission-search');
        if (permissionSearch) {
            permissionSearch.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                document.querySelectorAll('[data-module]').forEach(module => {
                    const moduleName = module.getAttribute('data-module').toLowerCase();
                    const permissions = module.querySelectorAll('.permission-item');
                    let visibleCount = 0;

                    permissions.forEach(permission => {
                        const permissionName = permission.querySelector('span').textContent.toLowerCase();
                        const isVisible = permissionName.includes(searchTerm) || moduleName.includes(searchTerm);
                        permission.style.display = isVisible ? 'flex' : 'none';
                        if (isVisible) visibleCount++;
                    });

                    // Show/hide module based on visible permissions
                    module.style.display = visibleCount > 0 ? 'block' : 'none';
                });
            });
        }
    });

    function confirmUpdate() {
        const form = document.getElementById('editRoleForm');
        const formData = new FormData(form);
        const newName = formData.get('name');
        const newGuard = formData.get('guard_name');
        const oldName = '{{ $role->name }}';
        const oldGuard = '{{ $role->guard_name }}';

        // Get selected permissions
        const selectedPermissions = Array.from(document.querySelectorAll('input[name="permissions[]"]:checked'))
            .map(checkbox => checkbox.nextElementSibling.nextElementSibling.textContent.trim());

        // Get old permissions
        const oldPermissions = {!! json_encode($role->permissions->pluck('name')) !!};

        let changes = [];

        // Check role name changes
        if (newName !== oldName) {
            changes.push(`<div class="flex items-center justify-between py-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">Role Name:</span>
                <div class="text-right">
                    <div class="text-sm text-red-600 line-through dark:text-red-400">${oldName}</div>
                    <div class="text-sm font-semibold text-green-600 dark:text-green-400">${newName}</div>
                </div>
            </div>`);
        }

        // Check guard name changes
        if (newGuard !== oldGuard) {
            changes.push(`<div class="flex items-center justify-between py-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">Guard Name:</span>
                <div class="text-right">
                    <div class="text-sm text-red-600 line-through dark:text-red-400">${oldGuard}</div>
                    <div class="text-sm font-semibold text-green-600 dark:text-green-400">${newGuard}</div>
                </div>
            </div>`);
        }

        // Check permission changes
        const addedPermissions = selectedPermissions.filter(perm => !oldPermissions.includes(perm));
        const removedPermissions = oldPermissions.filter(perm => !selectedPermissions.includes(perm));

        if (addedPermissions.length > 0) {
            changes.push(`<div class="py-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">Added Permissions:</span>
                <div class="mt-1 space-y-1">
                    ${addedPermissions.map(perm => `
                        <div class="text-sm font-semibold text-green-600 dark:text-green-400">
                            <i class="mr-1 fas fa-plus-circle"></i>${perm}
                        </div>
                    `).join('')}
                </div>
            </div>`);
        }

        if (removedPermissions.length > 0) {
            changes.push(`<div class="py-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">Removed Permissions:</span>
                <div class="mt-1 space-y-1">
                    ${removedPermissions.map(perm => `
                        <div class="text-sm font-semibold text-red-600 dark:text-red-400">
                            <i class="mr-1 fas fa-minus-circle"></i>${perm}
                        </div>
                    `).join('')}
                </div>
            </div>`);
        }

        if (changes.length === 0) {
            // No changes detected, submit directly
            form.submit();
            return;
        }

        Swal.fire({
            title: 'Update Role',
            html: `
                <div class="text-left">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full dark:bg-blue-900/30">
                        <i class="text-xl text-blue-600 fas fa-edit dark:text-blue-400"></i>
                    </div>
                    <h3 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Confirm Changes</h3>
                    <p class="mb-4 text-gray-600 dark:text-gray-400">
                        You are about to update the role with the following changes:
                    </p>
                    <div class="p-4 mb-4 overflow-y-auto rounded-lg bg-gray-50 dark:bg-gray-700 max-h-60">
                        ${changes.join('')}
                    </div>
                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                        <i class="mr-1 fas fa-info-circle"></i>
                        Please review the changes before proceeding
                    </p>
                </div>
            `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes, Update Role',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
            color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937',
            customClass: {
                confirmButton: 'px-6 py-2.5 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200 mr-2',
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
    }

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
                document.getElementById('deleteRoleForm').submit();
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
