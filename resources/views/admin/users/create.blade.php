 @extends('layouts.admin')

@section('title', 'Tambah pengguna baru')
@section('header-title', 'Tambah Pengguna Baru')

@section('content')
    <div class="space-y-6">
        <!-- Back Button & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('users.index') }}"
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
                            <a href="{{ route('users.index') }}"
                                class="text-sm font-medium text-gray-500 transition-colors duration-200 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white">
                                Manajemen Pengguna
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Tambah Pengguna Baru</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Quick Stats untuk Context -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Total Users Preview -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-100">Total Users</p>
                            <p class="mt-2 text-3xl font-bold">{{ number_format($stats['total_users'] ?? 0) }}</p>
                            <p class="mt-1 text-xs text-purple-100">Currently in system</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- Active Users Preview -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-emerald-100">Active Users</p>
                            <p class="mt-2 text-3xl font-bold">{{ number_format($stats['active_users'] ?? 0) }}</p>
                            <p class="mt-1 text-xs text-emerald-100">Currently active</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-user-check"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute w-20 h-20 rounded-full -right-4 -top-4 bg-white/10"></div>
                <div class="absolute w-16 h-16 rounded-full -right-6 -bottom-6 bg-white/5"></div>
            </div>

            <!-- New This Month Preview -->
            <div class="relative p-6 overflow-hidden text-white transition-all duration-300 shadow-xl group rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:scale-105 hover:shadow-2xl">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-100">New This Month</p>
                            <p class="mt-2 text-3xl font-bold">{{ number_format($stats['new_this_month'] ?? 0) }}</p>
                            <p class="mt-1 text-xs text-blue-100">Monthly growth</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <i class="text-2xl fas fa-user-plus"></i>
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
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">User Information</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Fill in the details to create a new user account</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-300">
                            <i class="mr-1 fas fa-user-plus"></i>
                            New User
                        </span>
                    </div>
                </div>
            </div>

            <form action="{{ route('users.store') }}" method="POST" id="userForm">
                @csrf

                <!-- Progress Steps -->
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-center space-x-8">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 text-white rounded-full bg-primary-600">
                                <i class="text-sm fas fa-user"></i>
                            </div>
                            <span class="text-sm font-medium text-primary-600 dark:text-primary-400">Personal Info</span>
                        </div>
                        <div class="w-12 h-0.5 bg-gray-200 dark:bg-gray-600"></div>
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 text-gray-500 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-400">
                                <i class="text-sm fas fa-lock"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Security</span>
                        </div>
                        <div class="w-12 h-0.5 bg-gray-200 dark:bg-gray-600"></div>
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 text-gray-500 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-400">
                                <i class="text-sm fas fa-shield-alt"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Permissions</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-8">
                    <!-- Personal Information Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 text-blue-600 bg-blue-100 rounded-lg dark:bg-blue-900/30 dark:text-blue-400">
                                <i class="text-sm fas fa-user-circle"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Personal Information</h3>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Name Field -->
                            <div class="md:col-span-2">
                                <label for="name" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    <span class="flex items-center space-x-2">
                                        <span>Full Name</span>
                                        <span class="text-red-500">*</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="text-gray-400 fas fa-user"></i>
                                    </div>
                                    <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 @error('name') border-red-500 @enderror"
                                        placeholder="Enter full name">
                                </div>
                                @error('name')
                                    <p class="flex items-center mt-2 space-x-1 text-sm text-red-600 dark:text-red-400">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="md:col-span-2">
                                <label for="email" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    <span class="flex items-center space-x-2">
                                        <span>Email Address</span>
                                        <span class="text-red-500">*</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="text-gray-400 fas fa-envelope"></i>
                                    </div>
                                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 @error('email') border-red-500 @enderror"
                                        placeholder="Enter email address">
                                </div>
                                @error('email')
                                    <p class="flex items-center mt-2 space-x-1 text-sm text-red-600 dark:text-red-400">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Account Security Section -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-6">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-8 h-8 text-green-600 bg-green-100 rounded-lg dark:bg-green-900/30 dark:text-green-400">
                                    <i class="text-sm fas fa-lock"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Account Security</h3>
                            </div>

                            <!-- Password Options -->
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <!-- Custom Password Option -->
                                    <div class="relative">
                                        <input type="radio" id="custom_password" name="password_option" value="custom" checked
                                            class="absolute w-4 h-4 opacity-0">
                                        <label for="custom_password" class="block cursor-pointer">
                                            <div class="p-4 transition-all duration-200 border-2 border-gray-200 rounded-xl dark:border-gray-600 hover:border-primary-300 peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20" id="customPasswordCard">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex items-center justify-center w-6 h-6 transition-all duration-200 border-2 border-gray-300 rounded-full dark:border-gray-500" id="customPasswordRadio">
                                                        <div class="w-2 h-2 transition-opacity duration-200 rounded-full opacity-0 bg-primary-500" id="customPasswordDot"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900 dark:text-white">Custom Password</p>
                                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Set your own password</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Random Password Option -->
                                    <div class="relative">
                                        <input type="radio" id="random_password" name="password_option" value="random"
                                            class="absolute w-4 h-4 opacity-0">
                                        <label for="random_password" class="block cursor-pointer">
                                            <div class="p-4 transition-all duration-200 border-2 border-gray-200 rounded-xl dark:border-gray-600 hover:border-primary-300 peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20" id="randomPasswordCard">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex items-center justify-center w-6 h-6 transition-all duration-200 border-2 border-gray-300 rounded-full dark:border-gray-500" id="randomPasswordRadio">
                                                        <div class="w-2 h-2 transition-opacity duration-200 rounded-full opacity-0 bg-primary-500" id="randomPasswordDot"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900 dark:text-white">Generate Password</p>
                                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Auto-generate secure password</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Custom Password Fields -->
                                <div id="customPasswordFields" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Password *
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="text-gray-400 fas fa-key"></i>
                                            </div>
                                            <input type="password" id="password" name="password"
                                                class="w-full pl-10 pr-10 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 @error('password') border-red-500 @enderror"
                                                placeholder="Enter password">
                                            <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password">
                                                <i class="text-gray-400 cursor-pointer fas fa-eye dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <p class="flex items-center mt-2 space-x-1 text-sm text-red-600 dark:text-red-400">
                                                <i class="fas fa-exclamation-circle"></i>
                                                <span>{{ $message }}</span>
                                            </p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Confirm Password *
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="text-gray-400 fas fa-key"></i>
                                            </div>
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                class="w-full py-3 pl-10 pr-10 text-gray-900 transition-all duration-200 bg-white border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"
                                                placeholder="Confirm password">
                                            <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password">
                                                <i class="text-gray-400 cursor-pointer fas fa-eye dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Generated Password Display -->
                                <div id="generatedPasswordField" class="hidden">
                                    <div class="p-4 border border-gray-200 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 dark:border-gray-600">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                    Generated Password
                                                </p>
                                                <p id="generatedPassword" class="mt-1 font-mono text-lg font-bold tracking-wider text-gray-900 dark:text-white">
                                                    <!-- Generated password will appear here -->
                                                </p>
                                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                                    This secure password will be automatically set for the user.
                                                </p>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <button type="button" id="copyPassword"
                                                    class="px-4 py-2 text-sm font-medium text-white transition-all duration-200 rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                                    <i class="mr-2 fas fa-copy"></i>
                                                    Copy
                                                </button>
                                                <button type="button" id="regeneratePassword"
                                                    class="p-2 text-gray-400 transition-all duration-200 rounded-lg hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20">
                                                    <i class="fas fa-redo"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Field -->
                            <div>
                                <label for="status" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Account Status *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="text-gray-400 fas fa-circle"></i>
                                    </div>
                                    <select id="status" name="status" required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200 @error('status') border-red-500 @enderror">
                                        <option value="">Select Account Status</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active - User can login</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive - User cannot login</option>
                                        <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended - Temporary restriction</option>
                                    </select>
                                </div>
                                @error('status')
                                    <p class="flex items-center mt-2 space-x-1 text-sm text-red-600 dark:text-red-400">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>{{ $message }}</span>
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Role Assignment Section -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-6">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-8 h-8 text-purple-600 bg-purple-100 rounded-lg dark:bg-purple-900/30 dark:text-purple-400">
                                    <i class="text-sm fas fa-shield-alt"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Role Assignment</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach($roles as $role)
                                    <div class="relative">
                                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}"
                                            class="absolute w-4 h-4 opacity-0"
                                            {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}>
                                        <label for="role_{{ $role->id }}" class="block cursor-pointer">
                                            <div class="p-4 transition-all duration-200 border-2 border-gray-200 rounded-xl dark:border-gray-600 hover:border-primary-300 peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20 hover:shadow-sm" id="roleCard{{ $role->id }}">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="flex items-center justify-center w-8 h-8 text-gray-600 transition-all duration-200 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-400" id="roleIcon{{ $role->id }}">
                                                            <i class="text-sm fas fa-user-tag"></i>
                                                        </div>
                                                        <div>
                                                            <p class="font-medium text-gray-900 dark:text-white">{{ $role->name }}</p>
                                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                                @if($role->name == 'admin')
                                                                    Full system access
                                                                @elseif($role->name == 'moderator')
                                                                    Limited administrative access
                                                                @else
                                                                    Basic user permissions
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center justify-center w-5 h-5 transition-all duration-200 border-2 border-gray-300 rounded dark:border-gray-500" id="roleCheckbox{{ $role->id }}">
                                                        <i class="text-xs text-white transition-opacity duration-200 opacity-0 fas fa-check" id="roleCheck{{ $role->id }}"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('roles')
                                <p class="flex items-center space-x-1 text-sm text-red-600 dark:text-red-400">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end p-6 space-x-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <a href="{{ route('users.index') }}"
                        class="px-8 py-3 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-xl dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 hover:shadow-sm">
                        <i class="mr-2 fas fa-arrow-left"></i>
                        Back to Users
                    </a>
                    <button type="submit"
                        class="px-8 py-3 text-sm font-medium text-white transition-all duration-200 shadow-lg bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl hover:from-primary-600 hover:to-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 hover:shadow-xl">
                        <i class="mr-2 fas fa-user-plus"></i>
                        Create User Account
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggle
    const toggleButtons = document.querySelectorAll('.toggle-password');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Password options toggle dengan enhanced UI
    const customPasswordRadio = document.getElementById('custom_password');
    const randomPasswordRadio = document.getElementById('random_password');
    const customPasswordFields = document.getElementById('customPasswordFields');
    const generatedPasswordField = document.getElementById('generatedPasswordField');
    const generatedPasswordElement = document.getElementById('generatedPassword');
    const copyPasswordButton = document.getElementById('copyPassword');
    const regeneratePasswordButton = document.getElementById('regeneratePassword');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');

    // Elements untuk custom styling radio buttons
    const customPasswordCard = document.getElementById('customPasswordCard');
    const randomPasswordCard = document.getElementById('randomPasswordCard');
    const customPasswordRadioVisual = document.getElementById('customPasswordRadio');
    const randomPasswordRadioVisual = document.getElementById('randomPasswordRadio');
    const customPasswordDot = document.getElementById('customPasswordDot');
    const randomPasswordDot = document.getElementById('randomPasswordDot');

    function updateRadioButtons() {
        if (customPasswordRadio.checked) {
            // Custom password selected
            customPasswordCard.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
            customPasswordCard.classList.remove('border-gray-200', 'dark:border-gray-600');
            customPasswordRadioVisual.classList.add('border-primary-500', 'bg-primary-100', 'dark:bg-primary-900');
            customPasswordDot.classList.remove('opacity-0');

            randomPasswordCard.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
            randomPasswordCard.classList.add('border-gray-200', 'dark:border-gray-600');
            randomPasswordRadioVisual.classList.remove('border-primary-500', 'bg-primary-100', 'dark:bg-primary-900');
            randomPasswordDot.classList.add('opacity-0');
        } else {
            // Random password selected
            randomPasswordCard.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
            randomPasswordCard.classList.remove('border-gray-200', 'dark:border-gray-600');
            randomPasswordRadioVisual.classList.add('border-primary-500', 'bg-primary-100', 'dark:bg-primary-900');
            randomPasswordDot.classList.remove('opacity-0');

            customPasswordCard.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
            customPasswordCard.classList.add('border-gray-200', 'dark:border-gray-600');
            customPasswordRadioVisual.classList.remove('border-primary-500', 'bg-primary-100', 'dark:bg-primary-900');
            customPasswordDot.classList.add('opacity-0');
        }
    }

    function togglePasswordFields() {
        if (customPasswordRadio.checked) {
            customPasswordFields.style.display = 'grid';
            generatedPasswordField.classList.add('hidden');
            passwordInput.required = true;
            passwordConfirmationInput.required = true;

            // Reset generated password fields
            passwordInput.value = '';
            passwordConfirmationInput.value = '';
        } else {
            customPasswordFields.style.display = 'none';
            generatedPasswordField.classList.remove('hidden');
            passwordInput.required = false;
            passwordConfirmationInput.required = false;

            // Generate and set random password
            generateAndSetPassword();
        }
    }

    function generateRandomPassword() {
        const length = 16;
        const lowercase = "abcdefghijklmnopqrstuvwxyz";
        const uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const numbers = "0123456789";
        const symbols = "!@#$%^&*";

        let password = "";

        // Ensure at least one of each type
        password += lowercase.charAt(Math.floor(Math.random() * lowercase.length));
        password += uppercase.charAt(Math.floor(Math.random() * uppercase.length));
        password += numbers.charAt(Math.floor(Math.random() * numbers.length));
        password += symbols.charAt(Math.floor(Math.random() * symbols.length));

        // Fill the rest
        const allChars = lowercase + uppercase + numbers + symbols;
        for (let i = password.length; i < length; i++) {
            password += allChars.charAt(Math.floor(Math.random() * allChars.length));
        }

        // Shuffle the password
        return password.split('').sort(() => Math.random() - 0.5).join('');
    }

    function generateAndSetPassword() {
        const randomPassword = generateRandomPassword();
        generatedPasswordElement.textContent = randomPassword;
        passwordInput.value = randomPassword;
        passwordConfirmationInput.value = randomPassword;
    }

    // Copy password to clipboard dengan feedback yang lebih baik
    copyPasswordButton.addEventListener('click', function() {
        const password = generatedPasswordElement.textContent;
        navigator.clipboard.writeText(password).then(() => {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="mr-2 fas fa-check"></i>Copied!';
            this.classList.remove('bg-primary-600', 'hover:bg-primary-700');
            this.classList.add('bg-green-600', 'hover:bg-green-700');

            setTimeout(() => {
                this.innerHTML = originalText;
                this.classList.remove('bg-green-600', 'hover:bg-green-700');
                this.classList.add('bg-primary-600', 'hover:bg-primary-700');
            }, 2000);
        });
    });

    // Regenerate password
    regeneratePasswordButton.addEventListener('click', generateAndSetPassword);

    // Event listeners for radio buttons
    customPasswordRadio.addEventListener('change', function() {
        updateRadioButtons();
        togglePasswordFields();
    });

    randomPasswordRadio.addEventListener('change', function() {
        updateRadioButtons();
        togglePasswordFields();
    });

    // Initialize radio buttons and password fields
    updateRadioButtons();
    togglePasswordFields();

    // Enhanced checkbox functionality untuk roles
    document.querySelectorAll('input[type="checkbox"][name="roles[]"]').forEach(checkbox => {
        const roleId = checkbox.id.replace('role_', '');
        const roleCard = document.getElementById('roleCard' + roleId);
        const roleCheckbox = document.getElementById('roleCheckbox' + roleId);
        const roleCheck = document.getElementById('roleCheck' + roleId);
        const roleIcon = document.getElementById('roleIcon' + roleId);

        function updateCheckbox() {
            if (checkbox.checked) {
                roleCard.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
                roleCard.classList.remove('border-gray-200', 'dark:border-gray-600');
                roleCheckbox.classList.add('border-primary-500', 'bg-primary-500');
                roleCheckbox.classList.remove('border-gray-300', 'dark:border-gray-500');
                roleCheck.classList.remove('opacity-0');
                roleIcon.classList.add('bg-primary-100', 'text-primary-600', 'dark:bg-primary-900', 'dark:text-primary-400');
                roleIcon.classList.remove('bg-gray-100', 'text-gray-600', 'dark:bg-gray-700', 'dark:text-gray-400');
            } else {
                roleCard.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
                roleCard.classList.add('border-gray-200', 'dark:border-gray-600');
                roleCheckbox.classList.remove('border-primary-500', 'bg-primary-500');
                roleCheckbox.classList.add('border-gray-300', 'dark:border-gray-500');
                roleCheck.classList.add('opacity-0');
                roleIcon.classList.remove('bg-primary-100', 'text-primary-600', 'dark:bg-primary-900', 'dark:text-primary-400');
                roleIcon.classList.add('bg-gray-100', 'text-gray-600', 'dark:bg-gray-700', 'dark:text-gray-400');
            }
        }

        checkbox.addEventListener('change', updateCheckbox);

        // Initialize checkbox state
        updateCheckbox();
    });

    // Enhanced form validation
    document.getElementById('userForm').addEventListener('submit', function(e) {
        // Additional validation can be added here
        console.log('Form submitted with password option:',
            customPasswordRadio.checked ? 'custom' : 'random');
    });
});
</script>

<style>
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
