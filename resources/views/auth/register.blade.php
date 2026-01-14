<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ config('app.name', 'Laravel') }}</title>

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
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="h-full bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Left Column - Form -->
        <div class="flex flex-col justify-center flex-1 px-4 py-12 sm:px-6 lg:px-20 xl:px-24">
            <div class="w-full max-w-sm mx-auto lg:w-96">
                <!-- Logo -->
                <div class="flex justify-center">
                    <div class="p-3 rounded-full bg-primary-600">
                        <i class="text-2xl text-white fas fa-user-plus"></i>
                    </div>
                </div>

                <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900">
                    Create your account
                </h2>
                <p class="mt-2 text-sm text-center text-gray-600">
                    Or
                    <a href="{{ route('login') }}" class="font-medium transition-colors duration-200 text-primary-600 hover:text-primary-500">
                        sign in to your existing account
                    </a>
                </p>

                <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block mb-1 text-sm font-medium text-gray-700">
                                Full Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="text-gray-400 fas fa-user"></i>
                                </div>
                                <input id="name" name="name" type="text" autocomplete="name" required
                                    value="{{ old('name') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white text-gray-900 placeholder-gray-500 transition-colors duration-200 @error('name') border-red-500 @enderror"
                                    placeholder="Enter your full name">
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="text-gray-400 fas fa-envelope"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    value="{{ old('email') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white text-gray-900 placeholder-gray-500 transition-colors duration-200 @error('email') border-red-500 @enderror"
                                    placeholder="Enter your email">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="text-gray-400 fas fa-lock"></i>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="new-password" required
                                    class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white text-gray-900 placeholder-gray-500 transition-colors duration-200 @error('password') border-red-500 @enderror"
                                    placeholder="Create a password">
                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password">
                                    <i class="text-gray-400 cursor-pointer fas fa-eye hover:text-gray-600"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-700">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="text-gray-400 fas fa-lock"></i>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                                    class="block w-full py-3 pl-10 pr-10 text-gray-900 placeholder-gray-500 transition-colors duration-200 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Confirm your password">
                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password">
                                    <i class="text-gray-400 cursor-pointer fas fa-eye hover:text-gray-600"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required
                            class="w-4 h-4 border-gray-300 rounded text-primary-600 focus:ring-primary-500">
                        <label for="terms" class="block ml-2 text-sm text-gray-700">
                            I agree to the
                            <a href="#" class="transition-colors duration-200 text-primary-600 hover:text-primary-500">
                                Terms and Conditions
                            </a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="relative flex justify-center w-full px-4 py-3 text-sm font-medium text-white transition-colors duration-200 border border-transparent rounded-lg group bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-user-plus text-primary-300 group-hover:text-primary-400"></i>
                            </span>
                            Create Account
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 text-gray-500 bg-white">Or continue with</span>
                        </div>
                    </div>

                    <!-- Social Login -->
                    <div class="grid grid-cols-1 gap-3">
                        <a href="{{ route('google.login') }}"
                            class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                            <i class="mr-3 text-red-500 fab fa-google"></i>
                            Sign up with Google
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column - Illustration -->
        <div class="relative flex-1 hidden lg:block gradient-bg">
            <div class="absolute inset-0 flex items-center justify-center p-12">
                <div class="max-w-md text-center text-white">
                    <div class="p-8 bg-white/10 backdrop-blur-sm rounded-2xl card-shadow">
                        <i class="mb-6 text-6xl fas fa-rocket text-white/90"></i>
                        <h3 class="mb-4 text-2xl font-bold">Join Our Community</h3>
                        <p class="leading-relaxed text-white/80">
                            Start your journey with us today. Create an account and unlock all the amazing features we have to offer.
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
                        button.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i> Creating Account...';
                    }
                });
            });
        });
    </script>
</body>
</html>
