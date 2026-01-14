@extends('layouts.admin')

@section('title', 'Generate Izin dari Routes')
@section('header-title', 'Generate Izin')

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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Generate Izin</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Suggested Permissions -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-100">Izin yang Disarankan</p>
                            <p class="mt-2 text-3xl font-bold">{{ $stats['suggested_count'] }}</p>
                            <p class="mt-2 text-xs text-blue-100 opacity-90">Dari nama route</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-route"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Existing Permissions -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-emerald-100">Izin yang Ada</p>
                            <p class="mt-2 text-3xl font-bold">{{ $stats['total_permissions'] }}</p>
                            <p class="mt-2 text-xs text-emerald-100 opacity-90">Saat ini di sistem</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-key"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Quick Actions -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-100">Aksi Cepat</p>
                            <p class="mt-2 text-lg font-bold">Auto-Generate</p>
                            <p class="mt-2 text-xs text-purple-100 opacity-90">Dari route aplikasi</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-bolt"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <!-- Header -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Izin yang Dihasilkan</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Pilih izin mana yang akan dibuat dari nama route Anda</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('permissions.create') }}"
                            class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-xl dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <i class="mr-2 fas fa-arrow-left"></i>
                            Pembuatan Manual
                        </a>
                    </div>
                </div>
            </div>

            @if(count($suggestedPermissions) > 0)
            <form action="{{ route('permissions.store-generated') }}" method="POST">
                @csrf

                <div class="p-6">
                    <!-- Bulk Actions -->
                    <div class="flex items-center justify-between p-4 mb-6 border border-gray-200 rounded-xl dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="select-all-permissions" class="w-4 h-4 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
                                <label for="select-all-permissions" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Pilih Semua
                                </label>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                <span id="selected-count">0</span> dari {{ count($suggestedPermissions) }} dipilih
                            </span>
                        </div>

                        <!-- Guard Selection -->
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Guard:</span>
                            <select name="guard_name" required
                                class="px-3 py-2 text-sm text-gray-900 bg-white border border-gray-200 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500">
                                <option value="web">Web Guard</option>
                                <option value="api">API Guard</option>
                            </select>
                        </div>
                    </div>

                    <!-- Permissions Grid -->
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($suggestedPermissions as $permission)
                        <div class="relative">
                            <input type="checkbox" name="permissions[]" value="{{ $permission }}"
                                id="permission_{{ $loop->index }}" class="absolute w-4 h-4 opacity-0 permission-checkbox">
                            <label for="permission_{{ $loop->index }}" class="block cursor-pointer">
                                <div class="p-4 transition-all duration-200 border-2 border-gray-200 rounded-xl dark:border-gray-600 hover:border-primary-300 peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20 hover:shadow-sm permission-card">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex items-center justify-center w-8 h-8 text-gray-600 transition-all duration-200 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-400 permission-icon">
                                                <i class="text-sm fas fa-key"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {{ $permission }}
                                                </p>
                                                <p class="mt-1 text-xs text-gray-500 truncate dark:text-gray-400">
                                                    {{ str_replace('.', ' ∙ ', $permission) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-center w-5 h-5 transition-all duration-200 border-2 border-gray-300 rounded dark:border-gray-500 permission-checkbox">
                                            <i class="text-xs text-white transition-opacity duration-200 opacity-0 fas fa-check permission-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end p-6 space-x-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <a href="{{ route('role-permission.index') }}"
                        class="px-8 py-3 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-xl dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 hover:shadow-sm">
                        Batal
                    </a>
                    <button type="submit" id="generate-button" disabled
                        class="px-8 py-3 text-sm font-medium text-white transition-all duration-200 shadow-lg bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl hover:from-primary-600 hover:to-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="mr-2 fas fa-bolt"></i>
                        Generate Izin yang Dipilih
                    </button>
                </div>
            </form>
            @else
            <div class="p-12 text-center">
                <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                    <i class="text-3xl text-gray-400 fas fa-check-circle"></i>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Tidak Ada Izin Baru yang Ditemukan</h3>
                <p class="mb-6 text-gray-500 dark:text-gray-400">Semua izin yang mungkin dari route Anda sudah ada di sistem.</p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('permissions.create') }}"
                        class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-200 shadow-lg bg-primary-600 hover:bg-primary-700 rounded-xl hover:shadow-xl">
                        <i class="mr-2 fas fa-plus"></i>
                        Buat Izin Manual
                    </a>
                    <a href="{{ route('role-permission.index') }}"
                        class="inline-flex items-center px-6 py-3 font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-xl dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        Kembali ke Kontrol Akses
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all-permissions');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
    const selectedCountElement = document.getElementById('selected-count');
    const generateButton = document.getElementById('generate-button');

    // Update checkbox visual state
    function updateCheckboxState(checkbox) {
        const card = checkbox.closest('.relative').querySelector('.permission-card');
        const icon = card.querySelector('.permission-icon');
        const checkboxVisual = card.querySelector('.permission-checkbox');
        const check = card.querySelector('.permission-check');

        if (checkbox.checked) {
            card.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
            card.classList.remove('border-gray-200', 'dark:border-gray-600');
            checkboxVisual.classList.add('border-primary-500', 'bg-primary-500');
            checkboxVisual.classList.remove('border-gray-300', 'dark:border-gray-500');
            check.classList.remove('opacity-0');
            icon.classList.add('bg-primary-100', 'text-primary-600', 'dark:bg-primary-900', 'dark:text-primary-400');
            icon.classList.remove('bg-gray-100', 'text-gray-600', 'dark:bg-gray-700', 'dark:text-gray-400');
        } else {
            card.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
            card.classList.add('border-gray-200', 'dark:border-gray-600');
            checkboxVisual.classList.remove('border-primary-500', 'bg-primary-500');
            checkboxVisual.classList.add('border-gray-300', 'dark:border-gray-500');
            check.classList.add('opacity-0');
            icon.classList.remove('bg-primary-100', 'text-primary-600', 'dark:bg-primary-900', 'dark:text-primary-400');
            icon.classList.add('bg-gray-100', 'text-gray-600', 'dark:bg-gray-700', 'dark:text-gray-400');
        }
    }

    // Update selected count
    function updateSelectedCount() {
        const selectedCount = document.querySelectorAll('.permission-checkbox:checked').length;
        selectedCountElement.textContent = selectedCount;
        generateButton.disabled = selectedCount === 0;

        // Update select all checkbox state
        selectAllCheckbox.checked = selectedCount === permissionCheckboxes.length;
        selectAllCheckbox.indeterminate = selectedCount > 0 && selectedCount < permissionCheckboxes.length;
    }

    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        permissionCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
            updateCheckboxState(checkbox);
        });
        updateSelectedCount();
    });

    // Individual checkbox functionality
    permissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateCheckboxState(this);
            updateSelectedCount();
        });

        // Initialize state
        updateCheckboxState(checkbox);
    });

    // Initial count update
    updateSelectedCount();
});
</script>
@endpush
