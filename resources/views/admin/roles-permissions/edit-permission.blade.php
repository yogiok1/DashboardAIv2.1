 @extends('layouts.admin')

@section('title', 'Edit Permission')
@section('header-title', 'Edit Permission')

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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Edit Permission</span>
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

            <!-- Current Permission Card -->
            <div
                class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-100">Editing Permission</p>
                            <p class="mt-2 text-xl font-bold truncate">{{ $permission->name }}</p>
                            <p class="mt-2 text-xs text-purple-100 opacity-90">{{ $permission->roles_count ?? 0 }} roles assigned</p>
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
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Permission Information</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update permission details</p>
                    </div>

                    <form id="editPermissionForm" method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="p-6 space-y-6">
                            <!-- Permission Name -->
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Permission Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $permission->name) }}"
                                    required
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 @error('name') border-red-500 @enderror"
                                    placeholder="Enter permission name (e.g., users.create, posts.delete)">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Use dot notation for better organization (module.action)
                                </p>
                            </div>

                            <!-- Module Suggestion -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Quick Module Selection
                                </label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($modules as $module)
                                        <button type="button"
                                            onclick="setModule('{{ $module }}')"
                                            class="px-3 py-2 text-xs text-gray-700 transition-colors duration-200 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                            {{ $module }}
                                        </button>
                                    @endforeach
                                </div>
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
                                    <option value="web" {{ old('guard_name', $permission->guard_name) == 'web' ? 'selected' : '' }}>Web</option>
                                    <option value="api" {{ old('guard_name', $permission->guard_name) == 'api' ? 'selected' : '' }}>API</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Determines which guard this permission applies to
                                </p>
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
                                        Update Permission
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Permission Summary -->
                <div class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Permission Summary</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Permission Name</span>
                            <span class="text-sm font-medium text-gray-900 break-all dark:text-white">{{ $permission->name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Guard</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $permission->guard_name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Assigned to Roles</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $permission->roles_count ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Created</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $permission->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Last Updated</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $permission->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('permissions.create') }}"
                            class="flex items-center p-3 space-x-3 transition-colors duration-200 border border-gray-200 rounded-lg dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 group">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30">
                                <i class="text-emerald-600 fas fa-plus dark:text-emerald-400"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">
                                Create New Permission
                            </span>
                        </a>
                        <a href="{{ route('roles.create') }}"
                            class="flex items-center p-3 space-x-3 transition-colors duration-200 border border-gray-200 rounded-lg dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 group">
                            <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                <i class="text-blue-600 fas fa-user-shield dark:text-blue-400"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">
                                Create Role
                            </span>
                        </a>
                        @if (!$permission->roles_count)
                            <form id="deletePermissionForm" action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="pt-3 border-t border-gray-100 dark:border-gray-700">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    onclick="confirmDelete()"
                                    class="flex items-center w-full p-3 space-x-3 text-left transition-colors duration-200 border border-red-200 rounded-lg dark:border-red-800 hover:bg-red-50 dark:hover:bg-red-900/20 group">
                                    <div class="flex items-center justify-center w-8 h-8 bg-red-100 rounded-lg dark:bg-red-900/30">
                                        <i class="text-red-600 fas fa-trash dark:text-red-400"></i>
                                    </div>
                                    <span class="text-sm font-medium text-red-700 dark:text-red-300 group-hover:text-red-800 dark:group-hover:text-red-200">
                                        Delete Permission
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
                                        Cannot Delete - Assigned to Roles
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Permission Format Guide -->
                <div class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Naming Guide</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Recommended Format:</p>
                            <code class="block p-2 text-xs text-gray-800 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-200">
                                module.action
                            </code>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Examples:</p>
                            <ul class="space-y-1 text-xs text-gray-600 dark:text-gray-400">
                                <li>• users.create</li>
                                <li>• posts.update</li>
                                <li>• settings.manage</li>
                                <li>• reports.export</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function setModule(module) {
        const nameInput = document.getElementById('name');
        const currentValue = nameInput.value;

        // If current value already has a dot, replace the module part
        if (currentValue.includes('.')) {
            const parts = currentValue.split('.');
            parts[0] = module;
            nameInput.value = parts.join('.');
        } else {
            // If no dot, just set the module
            nameInput.value = module + '.';
        }

        // Focus on the input after setting module
        nameInput.focus();
    }

    function confirmUpdate() {
        const form = document.getElementById('editPermissionForm');
        const formData = new FormData(form);
        const newName = formData.get('name');
        const newGuard = formData.get('guard_name');
        const oldName = '{{ $permission->name }}';
        const oldGuard = '{{ $permission->guard_name }}';

        let changes = [];

        if (newName !== oldName) {
            changes.push(`<div class="flex items-center justify-between py-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">Permission Name:</span>
                <div class="text-right">
                    <div class="text-sm text-red-600 line-through dark:text-red-400">${oldName}</div>
                    <div class="text-sm font-semibold text-green-600 dark:text-green-400">${newName}</div>
                </div>
            </div>`);
        }

        if (newGuard !== oldGuard) {
            changes.push(`<div class="flex items-center justify-between py-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">Guard Name:</span>
                <div class="text-right">
                    <div class="text-sm text-red-600 line-through dark:text-red-400">${oldGuard}</div>
                    <div class="text-sm font-semibold text-green-600 dark:text-green-400">${newGuard}</div>
                </div>
            </div>`);
        }

        if (changes.length === 0) {
            // No changes detected, submit directly
            form.submit();
            return;
        }

        Swal.fire({
            title: 'Update Permission',
            html: `
                <div class="text-left">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full dark:bg-blue-900/30">
                        <i class="text-xl text-blue-600 fas fa-edit dark:text-blue-400"></i>
                    </div>
                    <h3 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Confirm Changes</h3>
                    <p class="mb-4 text-gray-600 dark:text-gray-400">
                        You are about to update the permission with the following changes:
                    </p>
                    <div class="p-4 mb-4 rounded-lg bg-gray-50 dark:bg-gray-700">
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
            confirmButtonText: 'Yes, Update Permission',
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
                        <p class="font-medium text-gray-900 dark:text-white">{{ $permission->name }}</p>
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
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deletePermissionForm').submit();
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
