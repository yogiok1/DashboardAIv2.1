@extends('layouts.admin')

@section('title', 'Buat Peran Baru')
@section('header-title', 'Buat Peran Baru')

@section('content')
    <div class="space-y-8">
        <!-- Back Button & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('role-permission.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                <i class="mr-2 fas fa-arrow-left"></i>
                Kembali
            </a>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                            <i class="mr-2 fas fa-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <a href="{{ route('role-permission.index') }}"
                                class="text-sm font-medium text-gray-500 transition-colors duration-200 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white">
                                Kontrol Akses
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Buat Peran</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Total Roles Preview -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-100">Total Peran</p>
                            <p class="mt-2 text-3xl font-bold">{{ $stats['total_roles'] ?? 0 }}</p>
                            <p class="mt-2 text-xs text-blue-100 opacity-90">Currently in system</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-user-shield"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Total Permissions Preview -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-emerald-100">Available Permissions</p>
                            <p class="mt-2 text-3xl font-bold">{{ $stats['total_permissions'] ?? 0 }}</p>
                            <p class="mt-2 text-xs text-emerald-100 opacity-90">Permissions to assign</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-key"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Quick Guide -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-100">Quick Guide</p>
                            <p class="mt-2 text-lg font-bold">Best Practices</p>
                            <p class="mt-2 text-xs text-purple-100 opacity-90">Use descriptive role names</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-lightbulb"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <!-- Form Header -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Role Information</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Define the role details and assign permissions</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-300">
                            <i class="mr-1 fas fa-plus"></i>
                            New Role
                        </span>
                    </div>
                </div>
            </div>

            <form action="{{ route('roles.store') }}" method="POST" id="roleForm">
                @csrf

                <!-- Progress Steps -->
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-center space-x-8">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 text-white rounded-full bg-primary-600">
                                <i class="text-sm fas fa-info-circle"></i>
                            </div>
                            <span class="text-sm font-medium text-primary-600 dark:text-primary-400">Basic Info</span>
                        </div>
                        <div class="w-12 h-0.5 bg-gray-200 dark:bg-gray-600"></div>
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 text-gray-500 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-400">
                                <i class="text-sm fas fa-shield-alt"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Permissions</span>
                        </div>
                        <div class="w-12 h-0.5 bg-gray-200 dark:bg-gray-600"></div>
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 text-gray-500 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-400">
                                <i class="text-sm fas fa-check-circle"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Review</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-8">
                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 text-blue-600 bg-blue-100 rounded-lg dark:bg-blue-900/30 dark:text-blue-400">
                                <i class="text-sm fas fa-info-circle"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Basic Information</h3>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Role Name Field -->
                            <div class="md:col-span-2">
                                <label for="name" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    <span class="flex items-center space-x-2">
                                        <span>Role Name</span>
                                        <span class="text-red-500">*</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="text-gray-400 fas fa-user-shield"></i>
                                    </div>
                                    <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 @error('name') border-red-500 @enderror"
                                        placeholder="Enter role name (e.g., content-manager)">
                                </div>
                                @error('name')
                                    <p class="flex items-center mt-2 space-x-1 text-sm text-red-600 dark:text-red-400">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    Use lowercase with hyphens (e.g., content-manager, report-viewer)
                                </p>
                            </div>

                            <!-- Guard Name Field -->
                            <div class="md:col-span-2">
                                <label for="guard_name" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    <span class="flex items-center space-x-2">
                                        <span>Guard Name</span>
                                        <span class="text-red-500">*</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="text-gray-400 fas fa-shield-alt"></i>
                                    </div>
                                    <select id="guard_name" name="guard_name" required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200 @error('guard_name') border-red-500 @enderror">
                                        <option value="">Select Guard</option>
                                        <option value="web" {{ old('guard_name', 'web') == 'web' ? 'selected' : '' }}>Web Guard</option>
                                        <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>API Guard</option>
                                    </select>
                                </div>
                                @error('guard_name')
                                    <p class="flex items-center mt-2 space-x-1 text-sm text-red-600 dark:text-red-400">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    Typically "web" for web applications, "api" for API authentication
                                </p>
                            </div>

                            <!-- Description Field -->
                            <div class="md:col-span-2">
                                <label for="description" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Description
                                </label>
                                <div class="relative">
                                    <div class="absolute pointer-events-none top-3 left-3">
                                        <i class="text-gray-400 fas fa-file-alt"></i>
                                    </div>
                                    <textarea id="description" name="description" rows="3"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 @error('description') border-red-500 @enderror"
                                        placeholder="Describe the purpose and scope of this role...">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <p class="flex items-center mt-2 space-x-1 text-sm text-red-600 dark:text-red-400">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Permissions Assignment Section -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-6">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-8 h-8 text-purple-600 bg-purple-100 rounded-lg dark:bg-purple-900/30 dark:text-purple-400">
                                    <i class="text-sm fas fa-key"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Permission Assignment</h3>
                            </div>

                            <!-- Permission Search and Filter -->
                            <div class="flex flex-col gap-4 p-4 border border-gray-200 rounded-xl dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="relative flex-1 max-w-md">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="text-gray-400 fas fa-search"></i>
                                            </div>
                                            <input type="text" id="permission-search" placeholder="Search permissions..."
                                                class="w-full py-2 pl-10 pr-4 text-gray-900 transition-all duration-200 bg-white border border-gray-200 shadow-sm dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                        </div>
                                        <button type="button" id="select-all" class="px-4 py-2 text-sm font-medium text-white transition-all duration-200 bg-primary-600 rounded-xl hover:bg-primary-700">
                                            Select All
                                        </button>
                                        <button type="button" id="deselect-all" class="px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-xl dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            Deselect All
                                        </button>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        <span id="selected-count">0</span> of {{ $permissions->count() }} selected
                                    </div>
                                </div>
                            </div>

                            <!-- Permissions Grid -->
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3" id="permissions-container">
                                @foreach($permissions as $permission)
                                    <div class="relative permission-item">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}"
                                            class="absolute w-4 h-4 opacity-0"
                                            {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                        <label for="permission_{{ $permission->id }}" class="block cursor-pointer">
                                            <div class="p-4 transition-all duration-200 border-2 border-gray-200 rounded-xl dark:border-gray-600 hover:border-primary-300 peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20 hover:shadow-sm" id="permissionCard{{ $permission->id }}">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="flex items-center justify-center w-8 h-8 text-gray-600 transition-all duration-200 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-400" id="permissionIcon{{ $permission->id }}">
                                                            <i class="text-sm fas fa-key"></i>
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white" data-searchable>{{ $permission->name }}</p>
                                                            <p class="mt-1 text-xs text-gray-500 truncate dark:text-gray-400">
                                                                {{ $permission->guard_name }} guard
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center justify-center w-5 h-5 transition-all duration-200 border-2 border-gray-300 rounded dark:border-gray-500" id="permissionCheckbox{{ $permission->id }}">
                                                        <i class="text-xs text-white transition-opacity duration-200 opacity-0 fas fa-check" id="permissionCheck{{ $permission->id }}"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @error('permissions')
                                <p class="flex items-center space-x-1 text-sm text-red-600 dark:text-red-400">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror

                            @if($permissions->isEmpty())
                                <div class="py-8 text-center">
                                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                        <i class="text-2xl text-gray-400 fas fa-key"></i>
                                    </div>
                                    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No Permissions Available</h3>
                                    <p class="mb-4 text-gray-500 dark:text-gray-400">You need to create permissions first before assigning them to roles.</p>
                                    <a href="{{ route('permissions.create') }}"
                                        class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-200 shadow-lg bg-emerald-600 hover:bg-emerald-700 rounded-xl hover:shadow-xl">
                                        <i class="mr-2 fas fa-plus"></i>
                                        Create Permissions
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end p-6 space-x-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <a href="{{ route('role-permission.index') }}"
                        class="px-8 py-3 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-xl dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 hover:shadow-sm">
                        <i class="mr-2 fas fa-arrow-left"></i>
                        Back to Roles
                    </a>
                    <button type="submit"
                        class="px-8 py-3 text-sm font-medium text-white transition-all duration-200 shadow-lg bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl hover:from-primary-600 hover:to-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 hover:shadow-xl">
                        <i class="mr-2 fas fa-save"></i>
                        Create Role
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced checkbox functionality untuk permissions
    const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
    const selectedCountElement = document.getElementById('selected-count');
    const selectAllButton = document.getElementById('select-all');
    const deselectAllButton = document.getElementById('deselect-all');
    const permissionSearch = document.getElementById('permission-search');

    function updateSelectedCount() {
        const selectedCount = document.querySelectorAll('input[name="permissions[]"]:checked').length;
        selectedCountElement.textContent = selectedCount;
    }

    function updateCheckboxState(checkbox) {
        const permissionId = checkbox.id.replace('permission_', '');
        const permissionCard = document.getElementById('permissionCard' + permissionId);
        const permissionCheckbox = document.getElementById('permissionCheckbox' + permissionId);
        const permissionCheck = document.getElementById('permissionCheck' + permissionId);
        const permissionIcon = document.getElementById('permissionIcon' + permissionId);

        if (checkbox.checked) {
            permissionCard.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
            permissionCard.classList.remove('border-gray-200', 'dark:border-gray-600');
            permissionCheckbox.classList.add('border-primary-500', 'bg-primary-500');
            permissionCheckbox.classList.remove('border-gray-300', 'dark:border-gray-500');
            permissionCheck.classList.remove('opacity-0');
            permissionIcon.classList.add('bg-primary-100', 'text-primary-600', 'dark:bg-primary-900', 'dark:text-primary-400');
            permissionIcon.classList.remove('bg-gray-100', 'text-gray-600', 'dark:bg-gray-700', 'dark:text-gray-400');
        } else {
            permissionCard.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
            permissionCard.classList.add('border-gray-200', 'dark:border-gray-600');
            permissionCheckbox.classList.remove('border-primary-500', 'bg-primary-500');
            permissionCheckbox.classList.add('border-gray-300', 'dark:border-gray-500');
            permissionCheck.classList.add('opacity-0');
            permissionIcon.classList.remove('bg-primary-100', 'text-primary-600', 'dark:bg-primary-900', 'dark:text-primary-400');
            permissionIcon.classList.add('bg-gray-100', 'text-gray-600', 'dark:bg-gray-700', 'dark:text-gray-400');
        }
    }

    // Initialize checkbox states
    permissionCheckboxes.forEach(checkbox => {
        updateCheckboxState(checkbox);
        checkbox.addEventListener('change', function() {
            updateCheckboxState(this);
            updateSelectedCount();
        });
    });

    // Initial count update
    updateSelectedCount();

    // Select All functionality
    selectAllButton.addEventListener('click', function() {
        permissionCheckboxes.forEach(checkbox => {
            checkbox.checked = true;
            updateCheckboxState(checkbox);
        });
        updateSelectedCount();
    });

    // Deselect All functionality
    deselectAllButton.addEventListener('click', function() {
        permissionCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
            updateCheckboxState(checkbox);
        });
        updateSelectedCount();
    });

    // Permission search functionality
    permissionSearch.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const permissionItems = document.querySelectorAll('.permission-item');

        permissionItems.forEach(item => {
            const permissionName = item.querySelector('[data-searchable]').textContent.toLowerCase();
            const shouldShow = permissionName.includes(searchTerm);

            if (shouldShow) {
                item.style.display = 'block';
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                }, 50);
            } else {
                item.style.opacity = '0';
                item.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    item.style.display = 'none';
                }, 200);
            }
        });
    });

    // Add transition styles for search animation
    const permissionItems = document.querySelectorAll('.permission-item');
    permissionItems.forEach(item => {
        item.style.transition = 'all 0.3s ease-in-out';
    });

    // SweetAlert untuk konfirmasi pembuatan role
    const roleForm = document.getElementById('roleForm');

    roleForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const roleName = document.getElementById('name').value;
        const guardName = document.getElementById('guard_name').value;
        const description = document.getElementById('description').value;
        const selectedPermissions = document.querySelectorAll('input[name="permissions[]"]:checked');

        Swal.fire({
            title: 'Create New Role',
            html: `
                <div class="text-left">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full dark:bg-blue-900/30">
                        <i class="text-xl text-blue-600 fas fa-user-shield dark:text-blue-400"></i>
                    </div>
                    <h3 class="mb-3 text-lg font-semibold text-center text-gray-900 dark:text-white">Confirm Role Creation</h3>

                    <div class="p-4 mb-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Role Name:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${roleName}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Guard:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${guardName}</span>
                            </div>
                            ${description ? `
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Description:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${description}</span>
                            </div>
                            ` : ''}
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Permissions:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${selectedPermissions.length} selected</span>
                            </div>
                        </div>
                    </div>

                    ${selectedPermissions.length > 0 ? `
                    <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                        <p class="text-sm font-medium text-blue-700 dark:text-blue-300">
                            <i class="mr-2 fas fa-info-circle"></i>
                            This role will be created with ${selectedPermissions.length} permission(s).
                        </p>
                    </div>
                    ` : `
                    <div class="p-3 rounded-lg bg-yellow-50 dark:bg-yellow-900/20">
                        <p class="text-sm font-medium text-yellow-700 dark:text-yellow-300">
                            <i class="mr-2 fas fa-exclamation-triangle"></i>
                            This role will be created without any permissions.
                        </p>
                    </div>
                    `}
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Create Role',
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
            reverseButtons: false,
            width: '500px'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                const submitBtn = roleForm.querySelector('button[type="submit"]');
                const originalHTML = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i>Creating...';
                submitBtn.disabled = true;

                // Submit form
                roleForm.submit();
            }
        });
    });

    // Real-time validation untuk role name
    const roleNameInput = document.getElementById('name');
    roleNameInput.addEventListener('input', function() {
        const value = this.value;
        if (value && !/^[a-z-]+$/.test(value)) {
            this.classList.add('border-yellow-500');
        } else {
            this.classList.remove('border-yellow-500');
        }
    });
});
</script>

<style>
.permission-item {
    transition: all 0.3s ease-in-out;
}

/* Custom animations for enhanced UX */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in {
    animation: fadeIn 0.3s ease-out;
}

/* Smooth transitions for all interactive elements */
.transition-all {
    transition: all 0.2s ease-in-out;
}

/* Custom scrollbar for dark mode */
.dark ::-webkit-scrollbar {
    width: 6px;
}

.dark ::-webkit-scrollbar-track {
    background: #374151;
}

.dark ::-webkit-scrollbar-thumb {
    background: #6B7280;
    border-radius: 3px;
}

.dark ::-webkit-scrollbar-thumb:hover {
    background: #9CA3AF;
}
</style>
@endpush
