<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - {{ config('app.name', 'Laravel') }}</title>

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
    <div class="min-h-screen flex">
        <!-- Left Column - Form -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <!-- Logo -->
                <div class="flex justify-center">
                    <div class="bg-primary-600 p-3 rounded-full">
                        <i class="fas fa-envelope-open-text text-white text-2xl"></i>
                    </div>
                </div>

                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Verify your email
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Thanks for signing up! Before getting started, please verify your email address.
                </p>

                <!-- Verification Info -->
                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400 mt-0.5"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                We've sent a verification link to <strong>{{ Auth::user()->email }}</strong>.
                                Please check your email and click the link to verify your account.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Resend Verification -->
                <div class="mt-8 text-center space-y-4">
                    <form action="{{ route('verification.send') }}" method="POST">
                        @csrf
                        <p class="text-sm text-gray-600">
                            Didn't receive the email?
                        </p>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-primary-600 bg-primary-100 hover:bg-primary-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <i class="fas fa-redo mr-2"></i>
                            Resend Verification Email
                        </button>
                    </form>

                    @if (session('status') == 'verification-link-sent')
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                <p class="text-sm text-green-700">
                                    A new verification link has been sent to your email address.
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="pt-4">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column - Illustration -->
        <div class="hidden lg:block relative flex-1 gradient-bg">
            <div class="absolute inset-0 flex items-center justify-center p-12">
                <div class="max-w-md text-center text-white">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 card-shadow">
                        <i class="fas fa-mail-bulk text-6xl mb-6 text-white/90"></i>
                        <h3 class="text-2xl font-bold mb-4">Check Your Inbox</h3>
                        <p class="text-white/80 leading-relaxed">
                            We've sent a verification email to your address. Please check both your inbox and spam folder.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle form submission loading state
            const forms = document.querySelectorAll('form');

            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const button = this.querySelector('button[type="submit"]');
                    if (button && button.textContent.includes('Resend')) {
                        button.disabled = true;
                        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sending...';
                    }
                });
            });
        });
    </script>
</body>
</html>
