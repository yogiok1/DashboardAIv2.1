@extends('layouts.admin')

@section('title', 'Add New User')

@section('content')
    <div class="space-y-6">
        <!-- Page Header dengan Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New User</h1>
                <p class="mt-1 text-gray-600 dark:text-gray-400">Create a new user account</p>
            </div>
            <!-- Breadcrumb -->
            <nav class="flex justify-end" aria-label="Breadcrumb">
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
                                Users
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Add New User</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Form Card -->
        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
            <form action="{{ route('users.store') }}" method="POST" id="userForm">
                @csrf
                <div class="p-6 space-y-6">
                    <!-- Personal Information Section -->
                    <div>
                        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Personal Information</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Full Name *
                                </label>
                                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 @error('name') border-red-500 @enderror"
                                    placeholder="Enter full name">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Email Address *
                                </label>
                                <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 @error('email') border-red-500 @enderror"
                                    placeholder="Enter email address">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Account Information Section -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Account Information</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Password Options -->
                            <div class="md:col-span-2">
                                <label class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Password Options
                                </label>
                                <div class="space-y-4">
                                    <!-- Option 1: Set Custom Password -->
                                    <div class="flex items-center">
                                        <input type="radio" id="custom_password" name="password_option" value="custom" checked
                                            class="w-4 h-4 border-gray-300 text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
                                        <label for="custom_password" class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Set custom password
                                        </label>
                                    </div>

                                    <!-- Custom Password Fields -->
                                    <div id="customPasswordFields" class="space-y-4 ml-7">
                                        <div>
                                            <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Password *
                                            </label>
                                            <div class="relative">
                                                <input type="password" id="password" name="password"
                                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 @error('password') border-red-500 @enderror"
                                                    placeholder="Enter password">
                                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4 toggle-password">
                                                    <i class="text-gray-400 cursor-pointer fas fa-eye dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Confirm Password *
                                            </label>
                                            <div class="relative">
                                                <input type="password" id="password_confirmation" name="password_confirmation"
                                                    class="w-full px-4 py-3 text-gray-900 transition-colors duration-200 bg-white border border-gray-200 rounded-xl dark:border-gray-600 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"
                                                    placeholder="Confirm password">
                                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4 toggle-password">
                                                    <i class="text-gray-400 cursor-pointer fas fa-eye dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Option 2: Generate Random Password -->
                                    <div class="flex items-center">
                                        <input type="radio" id="random_password" name="password_option" value="random"
                                            class="w-4 h-4 border-gray-300 text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
                                        <label for="random_password" class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Generate random password
                                        </label>
                                    </div>

                                    <!-- Generated Password Display -->
                                    <div id="generatedPasswordField" class="hidden ml-7">
                                        <div class="p-4 border border-gray-200 rounded-xl bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                        Generated Password:
                                                    </p>
                                                    <p id="generatedPassword" class="mt-1 font-mono text-sm text-gray-600 dark:text-gray-400">
                                                        <!-- Generated password will appear here -->
                                                    </p>
                                                </div>
                                                <button type="button" id="copyPassword" class="transition-colors duration-200 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                                This password will be automatically set for the user. You can copy it to share with the user.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="md:col-span-2">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Status *
                                </label>
                                <select id="status" name="status" required
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200 @error('status') border-red-500 @enderror">
                                    <option value="">Select Status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Role Assignment -->
                            <div class="md:col-span-2">
                                <label class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Assign Roles
                                </label>
                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                                    @foreach($roles as $role)
                                        <label class="flex items-center p-3 transition-colors duration-200 border border-gray-200 rounded-xl dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                                class="w-4 h-4 border-gray-300 rounded dark:border-gray-600 text-primary-600 focus:ring-primary-500 dark:bg-gray-700"
                                                {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}>
                                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $role->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('roles')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end p-6 space-x-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <a href="{{ route('users.index') }}"
                        class="px-6 py-3 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-xl dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-3 text-sm font-medium text-white transition-colors duration-200 border border-transparent bg-primary-600 rounded-xl hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        Create User
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

    // Password options toggle
    const customPasswordRadio = document.getElementById('custom_password');
    const randomPasswordRadio = document.getElementById('random_password');
    const customPasswordFields = document.getElementById('customPasswordFields');
    const generatedPasswordField = document.getElementById('generatedPasswordField');
    const generatedPasswordElement = document.getElementById('generatedPassword');
    const copyPasswordButton = document.getElementById('copyPassword');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');

    function togglePasswordFields() {
        if (customPasswordRadio.checked) {
            customPasswordFields.style.display = 'block';
            generatedPasswordField.classList.add('hidden');
            passwordInput.required = true;
            passwordConfirmationInput.required = true;
        } else {
            customPasswordFields.style.display = 'none';
            generatedPasswordField.classList.remove('hidden');
            passwordInput.required = false;
            passwordConfirmationInput.required = false;

            // Generate random password
            const randomPassword = generateRandomPassword();
            generatedPasswordElement.textContent = randomPassword;

            // Set the generated password to a hidden field or modify form submission
            passwordInput.value = randomPassword;
            passwordConfirmationInput.value = randomPassword;
        }
    }

    function generateRandomPassword() {
        const length = 12;
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
        let password = "";
        for (let i = 0; i < length; i++) {
            password += charset.charAt(Math.floor(Math.random() * charset.length));
        }
        return password;
    }

    // Copy password to clipboard
    copyPasswordButton.addEventListener('click', function() {
        const password = generatedPasswordElement.textContent;
        navigator.clipboard.writeText(password).then(() => {
            // Show copied feedback
            const originalIcon = this.innerHTML;
            this.innerHTML = '<i class="text-green-500 fas fa-check"></i>';
            setTimeout(() => {
                this.innerHTML = originalIcon;
            }, 2000);
        });
    });

    // Event listeners for radio buttons
    customPasswordRadio.addEventListener('change', togglePasswordFields);
    randomPasswordRadio.addEventListener('change', togglePasswordFields);

    // Initialize on page load
    togglePasswordFields();

    // Form submission handling
    document.getElementById('userForm').addEventListener('submit', function(e) {
        if (randomPasswordRadio.checked) {
            // Password fields are already set with generated password
            // No need for additional processing
        }
    });
});
</script>
@endpush
