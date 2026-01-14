@extends('layouts.admin')

@section('title', 'Settings')
@section('header-title', 'Pengaturan')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <!-- Breadcrumb -->
            <nav class="flex justify-end mb-3" aria-label="Breadcrumb">
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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Settings</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Settings Grid -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- General Settings -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30">
                            <i class="text-blue-600 fas fa-cog dark:text-blue-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">General Settings</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Application configuration</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <form class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Application Name
                            </label>
                            <input type="text" value="Diktisaintek Berdampak" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Application URL
                            </label>
                            <input type="text" value="{{ config('app.url') }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500">
                        </div>
                        <button type="submit" 
                            class="px-4 py-2 text-white rounded-lg bg-gradient-to-r from-yellow-500 via-blue-500 to-orange-500 hover:shadow-lg">
                            <i class="mr-2 fas fa-save"></i>Save Changes
                        </button>
                    </form>
                </div>
            </div>

            <!-- AI Model Settings -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                            <i class="text-purple-600 fas fa-robot dark:text-purple-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">AI Model Settings</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Configure AI service endpoint</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <form class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                AI Model Endpoint
                            </label>
                            <input type="text" value="{{ config('services.ai_model.endpoint', env('AI_MODEL_ENDPOINT')) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                ML Substitution
                            </label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500">
                                <option value="true" selected>Enabled (Default)</option>
                                <option value="false">Disabled</option>
                            </select>
                        </div>
                        <button type="submit" 
                            class="px-4 py-2 text-white rounded-lg bg-gradient-to-r from-purple-600 to-blue-600 hover:shadow-lg">
                            <i class="mr-2 fas fa-save"></i>Save Changes
                        </button>
                    </form>
                </div>
            </div>

            <!-- System Information -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30">
                            <i class="text-green-600 fas fa-info-circle dark:text-green-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">System Information</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Application details</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Laravel Version</dt>
                            <dd class="text-sm font-semibold text-gray-900 dark:text-white">{{ app()->version() }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">PHP Version</dt>
                            <dd class="text-sm font-semibold text-gray-900 dark:text-white">{{ PHP_VERSION }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Environment</dt>
                            <dd class="text-sm font-semibold text-gray-900 dark:text-white">{{ config('app.env') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Debug Mode</dt>
                            <dd class="text-sm font-semibold text-gray-900 dark:text-white">
                                @if(config('app.debug'))
                                    <span class="px-2 py-1 text-xs text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900/30 dark:text-yellow-300">Enabled</span>
                                @else
                                    <span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">Disabled</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Cache Management -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-orange-100 dark:bg-orange-900/30">
                            <i class="text-orange-600 fas fa-database dark:text-orange-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Cache Management</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Clear application cache</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <button type="button" 
                            class="flex items-center justify-between w-full px-4 py-2 text-gray-700 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">
                            <span><i class="mr-2 fas fa-trash"></i>Clear Application Cache</span>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <button type="button" 
                            class="flex items-center justify-between w-full px-4 py-2 text-gray-700 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">
                            <span><i class="mr-2 fas fa-route"></i>Clear Route Cache</span>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <button type="button" 
                            class="flex items-center justify-between w-full px-4 py-2 text-gray-700 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">
                            <span><i class="mr-2 fas fa-eye"></i>Clear View Cache</span>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <button type="button" 
                            class="flex items-center justify-between w-full px-4 py-2 text-gray-700 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">
                            <span><i class="mr-2 fas fa-cog"></i>Clear Config Cache</span>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
