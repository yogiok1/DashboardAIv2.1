@extends('layouts.admin')

@section('title', 'AI Models Management')
@section('header-title', 'AI Models')

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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">AI Models</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Add Model Form Card -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 shadow-lg dark:bg-gray-800/10 rounded-2xl dark:border-gray-700/20">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">Add New AI Model</h2>
            </div>

            <div class="p-4">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
                        <div class="flex items-center">
                            <i class="mr-2 text-green-500 fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('modelai.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Model Name -->
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Model Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                placeholder="e.g. Advanced Recommendation v2.1"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provider -->
                        <div>
                            <label for="provider" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Provider <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="provider" name="provider" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                placeholder="e.g. OpenAI / Anthropic / Google"
                                value="{{ old('provider') }}">
                            @error('provider')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Model Code -->
                        <div>
                            <label for="model_code" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Model Code <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="model_code" name="model_code" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                placeholder="e.g. gpt-4o-mini, claude-3-sonnet"
                                value="{{ old('model_code') }}">
                            @error('model_code')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="is_active" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status
                            </label>
                            <select id="is_active" name="is_active"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="1" {{ old('is_active', 1) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Description
                            </label>
                            <textarea id="description" name="description" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                placeholder="Describe the model's capabilities and use cases...">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-4 space-x-2">
                        <button type="reset"
                            class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors duration-200">
                            <i class="mr-2 fas fa-redo"></i>
                            Reset
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg transition-colors duration-200 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <i class="mr-2 fas fa-save"></i>
                            Save Model
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- AI Models List Card -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 shadow-lg dark:bg-gray-800/10 rounded-2xl dark:border-gray-700/20">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white">AI Models List</h2>
                    <div class="flex items-center mt-2 space-x-2 sm:mt-0">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Total: {{ $models->count() }} models
                        </span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Model Name
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Provider
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Model Code
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Status
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($models as $model)
                            <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-purple-100 rounded-xl dark:bg-purple-900/30">
                                            <i class="text-purple-600 fas fa-brain dark:text-purple-400"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $model->name }}
                                            </div>
                                            @if($model->description)
                                                <div class="max-w-xs text-xs text-gray-500 truncate dark:text-gray-400">
                                                    {{ Str::limit($model->description, 50) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    <span class="inline-flex items-center">
                                        @php
                                            $providerIcons = [
                                                'OpenAI' => 'fas fa-robot text-blue-500',
                                                'Anthropic' => 'fas fa-users text-purple-500',
                                                'Google' => 'fab fa-google text-red-500',
                                                'Meta' => 'fab fa-facebook text-blue-600',
                                                'Microsoft' => 'fab fa-microsoft text-blue-700',
                                            ];
                                            $providerIcon = $providerIcons[$model->provider] ?? 'fas fa-server text-gray-500';
                                        @endphp
                                        <i class="mr-2 {{ $providerIcon }}"></i>
                                        {{ $model->provider }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <code class="px-2 py-1 font-mono text-xs bg-gray-100 rounded dark:bg-gray-700 dark:text-gray-300">
                                        {{ $model->model_code }}
                                    </code>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $model->is_active
                                            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'
                                            : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }}">
                                        <i class="mr-1 fas fa-circle" style="font-size: 6px;"></i>
                                        {{ $model->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="#"
                                            class="inline-flex items-center px-3 py-1.5 text-sm text-blue-600 transition-all duration-200 bg-blue-50 rounded-lg hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:bg-blue-900/30"
                                            title="Edit Model">
                                            <i class="mr-1.5 fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <form action="#" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this model?')"
                                                class="inline-flex items-center px-3 py-1.5 text-sm text-red-600 transition-all duration-200 bg-red-50 rounded-lg hover:bg-red-100 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/30"
                                                title="Delete Model">
                                                <i class="mr-1.5 fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                            <i class="text-2xl text-gray-400 fas fa-robot"></i>
                                        </div>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No AI Models Found</h3>
                                        <p class="mb-4 text-gray-500 dark:text-gray-400">Get started by adding your first AI model.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-focus on first input
        const firstInput = document.querySelector('input[type="text"]');
        if (firstInput) {
            firstInput.focus();
        }

        // Form reset handler
        const resetButton = document.querySelector('button[type="reset"]');
        if (resetButton) {
            resetButton.addEventListener('click', function() {
                setTimeout(() => {
                    firstInput.focus();
                }, 100);
            });
        }

        // Add hover effects for table rows
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
                this.style.transition = 'transform 0.2s ease-in-out';
            });

            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endpush
