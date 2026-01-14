 @extends('layouts.admin')

@section('title', 'Buat Izin Baru')
@section('header-title', 'Buat Izin Baru')

@section('content')
    <div class="space-y-6">
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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Buat Izin</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Total Permissions Preview -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-100">Total Izin</p>
                            <p class="mt-2 text-3xl font-bold">{{ $stats['total_permissions'] }}</p>
                            <p class="mt-2 text-xs text-blue-100 opacity-90">Currently in system</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-key"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Available Modules -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-emerald-100">Available Modules</p>
                            <p class="mt-2 text-3xl font-bold">{{ count($modules) }}</p>
                            <p class="mt-2 text-xs text-emerald-100 opacity-90">Functional modules</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-cubes"></i>
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
                            <p class="mt-2 text-xs text-purple-100 opacity-90">Use module.action format</p>
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
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Permission Creation</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Choose between single permission or bulk creation mode</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-300">
                            <i class="mr-1 fas fa-plus"></i>
                            New Permission
                        </span>
                    </div>
                </div>
            </div>

            <!-- Mode Selection Tabs -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex space-x-1">
                    <button type="button" id="bulk-mode-tab" class="flex-1 px-4 py-3 text-sm font-medium text-center transition-all duration-200 border-b-2 rounded-t-lg border-primary-500 text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20">
                        <i class="mr-2 fas fa-layer-group"></i>
                        Bulk Creation
                    </button>
                    <button type="button" id="single-mode-tab" class="flex-1 px-4 py-3 text-sm font-medium text-center text-gray-500 transition-all duration-200 border-b-2 border-transparent rounded-t-lg dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        <i class="mr-2 fas fa-key"></i>
                        Single Permission
                    </button>
                </div>
            </div>

            <!-- Error Display -->
            @if($errors->any())
            <div class="p-4 mx-6 mt-6 border border-red-200 bg-red-50 rounded-xl dark:bg-red-900/20 dark:border-red-800">
                <h4 class="mb-2 font-semibold text-red-800 dark:text-red-200">Please fix the following errors:</h4>
                <ul class="text-red-600 list-disc list-inside dark:text-red-300">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Bulk Creation Mode (Default) -->
            <div id="bulk-mode-content" class="p-6 space-y-6">
                <form action="{{ route('permissions.store') }}" method="POST" id="bulkPermissionForm">
                    @csrf

                    <!-- Module Selection -->
                    <div>
                        <label for="module" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <span class="flex items-center space-x-2">
                                <span>Module Name</span>
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="text-gray-400 fas fa-cube"></i>
                            </div>
                            <input type="text" id="module" name="module" list="module-suggestions" value="{{ old('module') }}"
                                class="w-full py-3 pl-10 pr-4 text-gray-900 transition-all duration-200 bg-white border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Enter module name (e.g., user, product, report)" required>
                            <datalist id="module-suggestions">
                                @foreach($modules as $module)
                                    <option value="{{ $module }}">
                                @endforeach
                            </datalist>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            The module represents a functional area of your application
                        </p>
                    </div>

                    <!-- Actions Selection -->
                    <div>
                        <label class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <span class="flex items-center space-x-2">
                                <span>Actions</span>
                                <span class="text-red-500">*</span>
                            </span>
                        </label>

                        <!-- Common Actions Quick Select -->
                        <div class="p-4 mb-4 border border-gray-200 rounded-xl dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50">
                            <p class="mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">Quick Select Common Actions:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($commonActions as $action)
                                    <button type="button" class="px-3 py-2 text-xs font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg action-quick-select dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                            data-action="{{ $action }}">
                                        <i class="mr-1 fas fa-plus"></i>
                                        {{ $action }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Custom Actions Input -->
                        <div class="space-y-3">
                            <div id="actions-container">
                                <!-- Dynamic action inputs will be added here -->
                                <div class="flex items-center space-x-3 action-input-group">
                                    <div class="relative flex-1">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="text-gray-400 fas fa-bolt"></i>
                                        </div>
                                        <input type="text" name="actions[]"
                                            class="w-full py-3 pl-10 pr-4 text-gray-900 transition-all duration-200 bg-white border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white action-input"
                                            placeholder="Enter action name (e.g., create, view, delete)" required>
                                    </div>
                                    <button type="button" class="p-3 text-gray-400 transition-all duration-200 remove-action rounded-xl hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="button" id="add-action" class="flex items-center px-4 py-2 text-sm font-medium transition-all duration-200 text-primary-600 bg-primary-50 rounded-xl dark:bg-primary-900/20 dark:text-primary-400 hover:bg-primary-100 dark:hover:bg-primary-900/30">
                                <i class="mr-2 fas fa-plus"></i>
                                Add Another Action
                            </button>
                        </div>
                    </div>

                    <!-- Guard Name -->
                    <div>
                        <label for="bulk_guard_name" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <span class="flex items-center space-x-2">
                                <span>Guard Name</span>
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="text-gray-400 fas fa-shield-alt"></i>
                            </div>
                            <select id="bulk_guard_name" name="guard_name" required
                                class="w-full py-3 pl-10 pr-4 text-gray-900 transition-colors duration-200 bg-white border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                <option value="web" {{ old('guard_name', 'web') == 'web' ? 'selected' : '' }}>Web Guard</option>
                                <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>API Guard</option>
                            </select>
                        </div>
                    </div>

                    <!-- Preview -->
                    <div id="preview-section" class="hidden p-4 border border-gray-200 rounded-xl dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50">
                        <h4 class="mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">Preview Permissions:</h4>
                        <div id="permission-preview" class="space-y-2">
                            <!-- Preview will be generated here -->
                        </div>
                    </div>
                </form>
            </div>

            <!-- Single Permission Mode (Hidden by Default) -->
            <div id="single-mode-content" class="hidden p-6 space-y-6">
                <form action="{{ route('permissions.store') }}" method="POST" id="singlePermissionForm">
                    @csrf
                    <input type="hidden" name="single_mode" value="true">

                    <!-- Single Permission Name -->
                    <div>
                        <label for="single_name" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <span class="flex items-center space-x-2">
                                <span>Permission Name</span>
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="text-gray-400 fas fa-key"></i>
                            </div>
                            <input type="text" id="single_name" name="name" value="{{ old('name') }}"
                                class="w-full py-3 pl-10 pr-4 text-gray-900 transition-all duration-200 bg-white border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Enter permission name (e.g., user.create, product.view)" required>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            Use module.action format for better organization
                        </p>
                    </div>

                    <!-- Guard Name for Single Mode -->
                    <div>
                        <label for="single_guard_name" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <span class="flex items-center space-x-2">
                                <span>Guard Name</span>
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="text-gray-400 fas fa-shield-alt"></i>
                            </div>
                            <select id="single_guard_name" name="guard_name" required
                                class="w-full py-3 pl-10 pr-4 text-gray-900 transition-colors duration-200 bg-white border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                <option value="web" {{ old('guard_name', 'web') == 'web' ? 'selected' : '' }}>Web Guard</option>
                                <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>API Guard</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end p-6 space-x-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                <a href="{{ route('role-permission.index') }}"
                    class="px-8 py-3 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-xl dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 hover:shadow-sm">
                    <i class="mr-2 fas fa-arrow-left"></i>
                    Kembali ke Kontrol Akses
                </a>

                <!-- Tombol untuk bulk mode -->
                <button type="button" id="bulk-submit" class="px-8 py-3 text-sm font-medium text-white transition-all duration-200 shadow-lg bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl hover:from-primary-600 hover:to-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 hover:shadow-xl">
                    <i class="mr-2 fas fa-save"></i>
                    Create Permissions
                </button>

                <!-- Tombol untuk single mode (hidden) -->
                <button type="button" id="single-submit" class="hidden px-8 py-3 text-sm font-medium text-white transition-all duration-200 shadow-lg bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl hover:from-primary-600 hover:to-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 hover:shadow-xl">
                    <i class="mr-2 fas fa-save"></i>
                    Create Permission
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bulkModeTab = document.getElementById('bulk-mode-tab');
    const singleModeTab = document.getElementById('single-mode-tab');
    const bulkModeContent = document.getElementById('bulk-mode-content');
    const singleModeContent = document.getElementById('single-mode-content');
    const bulkSubmit = document.getElementById('bulk-submit');
    const singleSubmit = document.getElementById('single-submit');
    const bulkPermissionForm = document.getElementById('bulkPermissionForm');
    const singlePermissionForm = document.getElementById('singlePermissionForm');
    const moduleInput = document.getElementById('module');
    const actionsContainer = document.getElementById('actions-container');
    const addActionButton = document.getElementById('add-action');
    const previewSection = document.getElementById('preview-section');
    const permissionPreview = document.getElementById('permission-preview');

    // Tab Switching
    function switchToBulkMode() {
        bulkModeTab.classList.add('border-primary-500', 'text-primary-600', 'dark:text-primary-400', 'bg-primary-50', 'dark:bg-primary-900/20');
        bulkModeTab.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
        singleModeTab.classList.remove('border-primary-500', 'text-primary-600', 'dark:text-primary-400', 'bg-primary-50', 'dark:bg-primary-900/20');
        singleModeTab.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');

        bulkModeContent.classList.remove('hidden');
        singleModeContent.classList.add('hidden');

        bulkSubmit.classList.remove('hidden');
        singleSubmit.classList.add('hidden');

        updatePreview();
    }

    function switchToSingleMode() {
        singleModeTab.classList.add('border-primary-500', 'text-primary-600', 'dark:text-primary-400', 'bg-primary-50', 'dark:bg-primary-900/20');
        singleModeTab.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
        bulkModeTab.classList.remove('border-primary-500', 'text-primary-600', 'dark:text-primary-400', 'bg-primary-50', 'dark:bg-primary-900/20');
        bulkModeTab.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');

        singleModeContent.classList.remove('hidden');
        bulkModeContent.classList.add('hidden');

        singleSubmit.classList.remove('hidden');
        bulkSubmit.classList.add('hidden');

        previewSection.classList.add('hidden');
    }

    bulkModeTab.addEventListener('click', switchToBulkMode);
    singleModeTab.addEventListener('click', switchToSingleMode);

    // Dynamic Action Inputs
    function addActionInput(value = '') {
        const actionGroup = document.createElement('div');
        actionGroup.className = 'action-input-group flex items-center space-x-3';
        actionGroup.innerHTML = `
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="text-gray-400 fas fa-bolt"></i>
                </div>
                <input type="text" name="actions[]" value="${value}"
                    class="w-full py-3 pl-10 pr-4 text-gray-900 transition-all duration-200 bg-white border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white action-input"
                    placeholder="Enter action name (e.g., create, view, delete)" required>
            </div>
            <button type="button" class="p-3 text-gray-400 transition-all duration-200 remove-action rounded-xl hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                <i class="fas fa-times"></i>
            </button>
        `;

        actionsContainer.appendChild(actionGroup);

        // Add event listener to new input for preview
        const newInput = actionGroup.querySelector('.action-input');
        newInput.addEventListener('input', updatePreview);

        // Add remove functionality
        const removeButton = actionGroup.querySelector('.remove-action');
        removeButton.addEventListener('click', function() {
            actionGroup.remove();
            updatePreview();
        });

        updatePreview();
    }

    // Quick select common actions
    document.querySelectorAll('.action-quick-select').forEach(button => {
        button.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            addActionInput(action);
        });
    });

    // Add action button
    addActionButton.addEventListener('click', function() {
        addActionInput();
    });

    // Remove action functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-action')) {
            e.target.closest('.action-input-group').remove();
            updatePreview();
        }
    });

    // Preview generation
    function updatePreview() {
        const module = moduleInput.value.trim();
        const actionInputs = document.querySelectorAll('input[name="actions[]"]');
        const actions = Array.from(actionInputs)
            .map(input => input.value.trim())
            .filter(action => action.length > 0);

        if (module && actions.length > 0) {
            permissionPreview.innerHTML = '';
            actions.forEach(action => {
                const permissionName = `${module}.${action}`;
                const previewItem = document.createElement('div');
                previewItem.className = 'flex items-center justify-between p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg';
                previewItem.innerHTML = `
                    <span class="text-sm font-medium text-gray-900 dark:text-white">${permissionName}</span>
                    <span class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">New</span>
                `;
                permissionPreview.appendChild(previewItem);
            });
            previewSection.classList.remove('hidden');
        } else {
            previewSection.classList.add('hidden');
        }
    }

    // Event listeners for preview
    moduleInput.addEventListener('input', updatePreview);

    // Initialize with existing action inputs
    document.querySelectorAll('input[name="actions[]"]').forEach(input => {
        input.addEventListener('input', updatePreview);
    });

    // Bulk Permission Confirmation
    bulkSubmit.addEventListener('click', function(e) {
        e.preventDefault();

        const module = moduleInput.value.trim();
        const actionInputs = document.querySelectorAll('input[name="actions[]"]');
        const validActions = Array.from(actionInputs)
            .map(input => input.value.trim())
            .filter(action => action.length > 0);
        const guardName = document.getElementById('bulk_guard_name').value;

        // Remove empty action inputs
        actionInputs.forEach(input => {
            if (input.value.trim() === '') {
                input.remove();
            }
        });

        if (!module) {
            Swal.fire({
                title: 'Module Required',
                text: 'Please enter a module name.',
                icon: 'warning',
                confirmButtonColor: '#3b82f6',
            });
            moduleInput.focus();
            return;
        }

        if (validActions.length === 0) {
            Swal.fire({
                title: 'Actions Required',
                text: 'Please add at least one action.',
                icon: 'warning',
                confirmButtonColor: '#3b82f6',
            });
            return;
        }

        // Prepare permissions list for confirmation
        const permissionsList = validActions.map(action =>
            `<div class="flex justify-between py-1 border-b border-gray-100 dark:border-gray-700">
                <span class="text-sm text-gray-600 dark:text-gray-400">${module}.${action}</span>
                <span class="text-xs font-medium text-green-600 dark:text-green-400">New</span>
            </div>`
        ).join('');

        Swal.fire({
            title: 'Create Permissions',
            html: `
                <div class="text-left">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full dark:bg-blue-900/30">
                        <i class="text-xl text-blue-600 fas fa-key dark:text-blue-400"></i>
                    </div>
                    <h3 class="mb-3 text-lg font-semibold text-center text-gray-900 dark:text-white">Confirm Permission Creation</h3>

                    <div class="p-4 mb-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Module:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${module}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Guard:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${guardName}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Permissions:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${validActions.length}</span>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-y-auto max-h-40">
                        <h4 class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Permissions to be created:</h4>
                        <div class="space-y-1">
                            ${permissionsList}
                        </div>
                    </div>

                    <div class="p-3 mt-4 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                        <p class="text-sm font-medium text-blue-700 dark:text-blue-300">
                            <i class="mr-2 fas fa-info-circle"></i>
                            This will create ${validActions.length} new permission(s) in the system.
                        </p>
                    </div>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Create Permissions',
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
                const originalHTML = bulkSubmit.innerHTML;
                bulkSubmit.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i>Creating...';
                bulkSubmit.disabled = true;

                // Submit form
                bulkPermissionForm.submit();
            }
        });
    });

    // Single Permission Confirmation
    singleSubmit.addEventListener('click', function(e) {
        e.preventDefault();

        const permissionName = document.getElementById('single_name').value.trim();
        const guardName = document.getElementById('single_guard_name').value;

        if (!permissionName) {
            Swal.fire({
                title: 'Permission Name Required',
                text: 'Please enter a permission name.',
                icon: 'warning',
                confirmButtonColor: '#3b82f6',
            });
            document.getElementById('single_name').focus();
            return;
        }

        Swal.fire({
            title: 'Create Permission',
            html: `
                <div class="text-left">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full dark:bg-blue-900/30">
                        <i class="text-xl text-blue-600 fas fa-key dark:text-blue-400"></i>
                    </div>
                    <h3 class="mb-3 text-lg font-semibold text-center text-gray-900 dark:text-white">Confirm Permission Creation</h3>

                    <div class="p-4 mb-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Permission Name:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${permissionName}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Guard:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${guardName}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                        <p class="text-sm font-medium text-blue-700 dark:text-blue-300">
                            <i class="mr-2 fas fa-info-circle"></i>
                            This permission will be added to the system and can be assigned to roles.
                        </p>
                    </div>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Create Permission',
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
                const originalHTML = singleSubmit.innerHTML;
                singleSubmit.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i>Creating...';
                singleSubmit.disabled = true;

                // Submit form
                singlePermissionForm.submit();
            }
        });
    });

    // Initial preview update
    updatePreview();
});
</script>

<style>
.action-input-group {
    transition: all 0.3s ease-in-out;
}

.action-input-group:focus-within {
    transform: translateY(-2px);
}
</style>
@endpush
