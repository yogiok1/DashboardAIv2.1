<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef9e7',
                            100: '#fef0c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        },
                        secondary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #f59e0b 0%, #3b82f6 50%, #60a5fa 100%);
        }

        .card-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="h-full bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Left Column - Form -->
        <div class="flex flex-col justify-center flex-1 px-4 sm:px-6 lg:px-20 xl:px-24">
            <div class="w-full max-w-sm mx-auto lg:w-96 -mt-32">
                <!-- Logo Diktisaintek Berdampak -->
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/branding/logo-diktisaintek.svg') }}" alt="Logo Diktisaintek Berdampak" class="w-24 h-24">
                </div>

                <h2 class="mt-4 text-2xl font-bold text-center text-gray-900">
                    Masuk ke Akun Anda
                </h2>
                <p class="mt-2 text-sm text-center text-gray-600">
                    Sistem Penilaian Proposal Hibah
                </p>

                <form class="mt-6 space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">
                                Alamat Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="text-gray-400 fas fa-envelope"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    value="{{ old('email') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white text-gray-900 placeholder-gray-500 transition-colors duration-200 @error('email') border-red-500 @enderror"
                                    placeholder="Masukkan email Anda">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Kata Sandi
                                </label>
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="font-medium transition-colors duration-200 text-primary-600 hover:text-primary-500">
                                        Lupa kata sandi?
                                    </a>
                                </div>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="text-gray-400 fas fa-lock"></i>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                    class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white text-gray-900 placeholder-gray-500 transition-colors duration-200 @error('password') border-red-500 @enderror"
                                    placeholder="Masukkan kata sandi Anda">
                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password">
                                    <i class="text-gray-400 cursor-pointer fas fa-eye hover:text-gray-600"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 border-gray-300 rounded text-primary-600 focus:ring-primary-500">
                            <label for="remember" class="block ml-2 text-sm text-gray-700">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="relative flex justify-center w-full px-4 py-3 text-sm font-medium text-white transition-all duration-200 border border-transparent rounded-lg shadow-lg group bg-gradient-to-r from-yellow-500 via-blue-500 to-orange-500 hover:shadow-xl hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="text-white fas fa-sign-in-alt group-hover:scale-110 transition-transform"></i>
                            </span>
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column - Illustration -->
        <div class="relative flex-1 hidden lg:block gradient-bg">
            <div class="absolute inset-0 flex items-center justify-center p-12">
                <div class="max-w-md text-center text-white">
                    <div class="p-8 bg-white/10 backdrop-blur-sm rounded-2xl card-shadow">
                        <img src="{{ asset('images/branding/logo-diktisaintek.svg') }}" alt="Logo Diktisaintek Berdampak" class="w-40 h-40 mx-auto mb-6 brightness-0 invert">
                        <p class="leading-relaxed text-white/90">
                            Aplikasi Augmented Analytics untuk seleksi proposal menggunakan Generative-AI
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
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

            // Handle form submission loading state
            const forms = document.querySelectorAll('form');

            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const button = this.querySelector('button[type="submit"]');
                    if (button) {
                        button.disabled = true;
                        button.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i> Signing In...';
                    }
                });
            });
        });
    </script>
</body>
</html>
