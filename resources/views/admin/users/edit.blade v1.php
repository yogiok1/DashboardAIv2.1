@extends('layouts.admin')

@section('title', 'Edit User')

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
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Edit User</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit User</h1>
                <p class="mt-1 text-gray-600 dark:text-gray-400">Update user account information</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <i class="mr-2 fas fa-arrow-left"></i>
                    Back to Users
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 rounded-xl shadow-card dark:border-gray-700">
            <form action="{{ route('users.update', $user->id) }}" method="POST" id="userForm">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Personal Information -->
                    <div class="md:col-span-2">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Personal Information</h3>
                    </div>

                    <div class="md:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Full Name *
                        </label>
                        <input type="text" id="name" name="name" required value="{{ old('name', $user->name) }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200 @error('name') border-red-500 @enderror"
                            placeholder="Enter full name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email Address *
                        </label>
                        <input type="email" id="email" name="email" required
                            value="{{ old('email', $user->email) }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200 @error('email') border-red-500 @enderror"
                            placeholder="Enter email address">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Account Information -->
                    <div class="mt-6 md:col-span-2">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Account Information</h3>
                    </div>

                    <!-- Password Options -->
                    <div class="md:col-span-2">
                        <label class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Password Options
                        </label>
                        <div class="space-y-3">
                            <!-- Option 1: Keep Current Password -->
                            <div class="flex items-center">
                                <input type="radio" id="keep_password" name="password_option" value="keep" checked
                                    class="border-gray-300 text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
                                <label for="keep_password" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    Keep current password
                                </label>
                            </div>

                            <!-- Option 2: Set Custom Password -->
                            <div class="flex items-center">
                                <input type="radio" id="custom_password" name="password_option" value="custom"
                                    class="border-gray-300 text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
                                <label for="custom_password" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    Set new password
                                </label>
                            </div>

                            <!-- Custom Password Fields -->
                            <div id="customPasswordFields" class="hidden ml-6 space-y-4">
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        New Password *
                                    </label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password"
                                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200 @error('password') border-red-500 @enderror"
                                            placeholder="Enter new password">
                                        <button type="button"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password">
                                            <i
                                                class="text-gray-400 cursor-pointer fas fa-eye dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Confirm New Password *
                                    </label>
                                    <div class="relative">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="w-full px-3 py-2 text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"
                                            placeholder="Confirm new password">
                                        <button type="button"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password">
                                            <i
                                                class="text-gray-400 cursor-pointer fas fa-eye dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Option 3: Generate Random Password -->
                            <div class="flex items-center">
                                <input type="radio" id="random_password" name="password_option" value="random"
                                    class="border-gray-300 text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
                                <label for="random_password" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    Generate random password
                                </label>
                            </div>

                            <!-- Generated Password Display -->
                            <div id="generatedPasswordField" class="hidden ml-6">
                                <div
                                    class="p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Generated Password:
                                            </p>
                                            <p id="generatedPassword"
                                                class="mt-1 font-mono text-sm text-gray-600 dark:text-gray-400">
                                                <!-- Generated password will appear here -->
                                            </p>
                                        </div>
                                        <button type="button" id="copyPassword"
                                            class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                        This password will be automatically set for the user. You can copy it to share with
                                        the user.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status *
                        </label>
                        <select id="status" name="status" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200 @error('status') border-red-500 @enderror">
                            <option value="">Select Status</option>
                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>
                                Inactive</option>
                            <option value="suspended" {{ old('status', $user->status) == 'suspended' ? 'selected' : '' }}>
                                Suspended</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role Assignment (Spatie) -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Assign Roles
                        </label>
                        <div class="space-y-2">
                            @foreach ($roles as $role)
                                <label class="flex items-center">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                        class="border-gray-300 rounded dark:border-gray-600 text-primary-600 focus:ring-primary-500 dark:bg-gray-700"
                                        {{ in_array($role->name, old('roles', $user->getRoleNames()->toArray())) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('roles')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end pt-6 mt-8 space-x-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('users.index') }}"
                        class="px-6 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white transition-colors duration-200 rounded-lg bg-primary-600 hover:bg-primary-700">
                        Update User
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
            const keepPasswordRadio = document.getElementById('keep_password');
            const customPasswordRadio = document.getElementById('custom_password');
            const randomPasswordRadio = document.getElementById('random_password');
            const customPasswordFields = document.getElementById('customPasswordFields');
            const generatedPasswordField = document.getElementById('generatedPasswordField');
            const generatedPasswordElement = document.getElementById('generatedPassword');
            const copyPasswordButton = document.getElementById('copyPassword');
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');

            function togglePasswordFields() {
                if (keepPasswordRadio.checked) {
                    customPasswordFields.classList.add('hidden');
                    generatedPasswordField.classList.add('hidden');
                    passwordInput.required = false;
                    passwordConfirmationInput.required = false;
                    passwordInput.value = '';
                    passwordConfirmationInput.value = '';
                } else if (customPasswordRadio.checked) {
                    customPasswordFields.classList.remove('hidden');
                    generatedPasswordField.classList.add('hidden');
                    passwordInput.required = true;
                    passwordConfirmationInput.required = true;
                } else {
                    customPasswordFields.classList.add('hidden');
                    generatedPasswordField.classList.remove('hidden');
                    passwordInput.required = false;
                    passwordConfirmationInput.required = false;

                    // Generate random password
                    const randomPassword = generateRandomPassword();
                    generatedPasswordElement.textContent = randomPassword;

                    // Set the generated password to the hidden fields
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
            keepPasswordRadio.addEventListener('change', togglePasswordFields);
            customPasswordRadio.addEventListener('change', togglePasswordFields);
            randomPasswordRadio.addEventListener('change', togglePasswordFields);

            // Initialize on page load
            togglePasswordFields();
        });
    </script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ... script password toggle yang sudah ada ...

    // SweetAlert untuk konfirmasi update user - FIXED FOR PUT METHOD
    const userForm = document.getElementById('userForm');

    userForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const userName = document.getElementById('name').value;
        const userEmail = document.getElementById('email').value;
        const userStatus = document.getElementById('status').value;
        const passwordOption = document.querySelector('input[name="password_option"]:checked').value;

        // Get selected roles
        const selectedRoles = [];
        document.querySelectorAll('input[name="roles[]"]:checked').forEach(checkbox => {
            selectedRoles.push(checkbox.nextElementSibling.textContent.trim());
        });

        Swal.fire({
            title: 'Update User',
            html: `
                <div class="text-left">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full dark:bg-blue-900/30">
                        <i class="text-xl text-blue-600 fas fa-user-edit dark:text-blue-400"></i>
                    </div>
                    <h3 class="mb-3 text-lg font-semibold text-center text-gray-900 dark:text-white">Confirm User Update</h3>

                    <div class="p-4 mb-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Name:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${userName}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Email:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${userEmail}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Status:</span>
                                <span class="text-sm font-medium text-gray-900 capitalize dark:text-white">${userStatus}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Password:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${passwordOption === 'keep' ? 'Keep Current' : passwordOption === 'custom' ? 'Set New' : 'Generate Random'}</span>
                            </div>
                            ${selectedRoles.length > 0 ? `
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Roles:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${selectedRoles.join(', ')}</span>
                            </div>
                            ` : ''}
                        </div>
                    </div>

                    <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                        <p class="text-sm font-medium text-blue-700 dark:text-blue-300">
                            <i class="mr-2 fas fa-info-circle"></i>
                            Please review all changes before updating the user.
                        </p>
                    </div>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Update User',
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
                const submitBtn = userForm.querySelector('button[type="submit"]');
                const originalHTML = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i>Updating...';
                submitBtn.disabled = true;

                // Create hidden method field for PUT if not exists
                let methodField = userForm.querySelector('input[name="_method"]');
                if (!methodField) {
                    methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PUT';
                    userForm.appendChild(methodField);
                }

                // Create hidden token field if not exists
                let tokenField = userForm.querySelector('input[name="_token"]');
                if (!tokenField) {
                    tokenField = document.createElement('input');
                    tokenField.type = 'hidden';
                    tokenField.name = '_token';
                    tokenField.value = '{{ csrf_token() }}';
                    userForm.appendChild(tokenField);
                }

                // Submit form
                userForm.submit();
            }
        });
    });

    // SweetAlert untuk flash messages
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
@endpush
