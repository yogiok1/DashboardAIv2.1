@extends('layouts.admin')

@section('title', 'Profile Saya')
@section('header-title', 'Profile Saya')

@section('content')
    <div class="space-y-6">
        <!-- Back Button & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('dashboard') }}"
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
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Profile Saya</span>
                    </div>
                </li>
            </ol>
        </nav>
        </div>

        <!-- Profile Information Card -->
        <div class="overflow-hidden bg-white shadow-card dark:bg-gray-800 rounded-xl">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    <i class="mr-2 fas fa-user"></i>
                    Informasi Profile
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Perbarui informasi profil dan alamat email akun Anda.
                </p>
            </div>

            <form method="POST" action="{{ route('user-profile-information.update') }}" class="p-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                        class="w-full px-4 py-2.5 text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
                        class="w-full px-4 py-2.5 text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white transition-all duration-200 rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800">
                        <i class="mr-2 fas fa-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password Card -->
        <div class="overflow-hidden bg-white shadow-card dark:bg-gray-800 rounded-xl">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    <i class="mr-2 fas fa-key"></i>
                    Ubah Password
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
                </p>
            </div>

            <form method="POST" action="{{ route('user-password.update') }}" class="p-6">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div class="mb-6">
                    <label for="current_password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Password Saat Ini <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full px-4 py-2.5 text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2.5 text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-4 py-2.5 text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white transition-all duration-200 rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800">
                        <i class="mr-2 fas fa-key"></i>
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        @if (session('status'))
            <div class="p-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/20 dark:border-green-800 dark:text-green-400">
                <i class="mr-2 fas fa-check-circle"></i>
                {{ session('status') }}
            </div>
        @endif
    </div>
@endsection
