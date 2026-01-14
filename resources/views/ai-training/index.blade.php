@extends('layouts.admin')

@section('title', 'AI Training Data')
@section('header-title', 'Data Pelatihan AI')

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
                    <li>
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <a href="{{ route('ai-training.index') }}"
                                class="text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                                AI Training
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Training Data</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
                <div class="flex items-center">
                    <i class="mr-2 text-green-500 fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Input Form Card -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 shadow-lg dark:bg-gray-800/10 rounded-2xl dark:border-gray-700/20">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">Input Training Data</h2>
            </div>

            <div class="p-4">
                <form action="{{ url('/ai-training') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- AI Model Selection -->
                        <div class="lg:col-span-2">
                            <label for="model_ai_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                AI Model <span class="text-red-500">*</span>
                            </label>
                            <select id="model_ai_id" name="model_ai_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">-- Select Model AI --</option>
                                @foreach($models as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->model_code }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- AI Output Section -->
                        <div class="lg:col-span-2">
                            <div class="p-4 bg-blue-50 rounded-xl dark:bg-blue-900/20">
                                <h3 class="flex items-center text-lg font-semibold text-gray-800 dark:text-white">
                                    <i class="mr-2 text-blue-600 fas fa-robot"></i>
                                    AI Output
                                </h3>
                            </div>
                        </div>

                        <!-- AI Scores -->
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:col-span-2">
                            <div>
                                <label for="ai_admin_score" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    AI Admin Score
                                </label>
                                <input type="number" id="ai_admin_score" name="ai_admin_score"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Enter admin score">
                            </div>

                            <div>
                                <label for="ai_substantive_score" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    AI Substantive Score
                                </label>
                                <input type="number" id="ai_substantive_score" name="ai_substantive_score"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Enter substantive score">
                            </div>
                        </div>

                        <!-- AI Recommendation -->
                        <div class="lg:col-span-2">
                            <label for="ai_recommendation" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                AI Recommendation
                            </label>
                            <textarea id="ai_recommendation" name="ai_recommendation" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                placeholder="Enter AI recommendation"></textarea>
                        </div>

                        <!-- User Review Section -->
                        <div class="lg:col-span-2">
                            <div class="p-4 mt-6 bg-green-50 rounded-xl dark:bg-green-900/20">
                                <h3 class="flex items-center text-lg font-semibold text-gray-800 dark:text-white">
                                    <i class="mr-2 text-green-600 fas fa-user-check"></i>
                                    User Review
                                </h3>
                            </div>
                        </div>

                        <!-- User Scores -->
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:col-span-2">
                            <div>
                                <label for="user_admin_score" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    User Admin Score
                                </label>
                                <input type="number" id="user_admin_score" name="user_admin_score"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Enter user admin score">
                            </div>

                            <div>
                                <label for="user_substantive_score" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    User Substantive Score
                                </label>
                                <input type="number" id="user_substantive_score" name="user_substantive_score"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Enter user substantive score">
                            </div>
                        </div>

                        <!-- User Review Notes -->
                        <div class="lg:col-span-2">
                            <label for="user_review" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                User Review Notes
                            </label>
                            <textarea id="user_review" name="user_review" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                placeholder="Enter user review notes"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg transition-colors duration-200 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <i class="mr-2 fas fa-save"></i>
                            Save Training Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Training Data List Card -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 shadow-lg dark:bg-gray-800/10 rounded-2xl dark:border-gray-700/20">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white">Training Data List</h2>
                    <div class="flex items-center mt-2 space-x-2 sm:mt-0">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Total: {{ $trainings->count() }} records
                        </span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                #
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Model
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                AI Scores
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                User Scores
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Trained
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Created
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($trainings as $t)
                            <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <i class="mr-3 text-purple-500 fas fa-cube"></i>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $t->modelAI->name }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $t->modelAI->model_code }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                            <span class="inline-block w-2 h-2 mr-2 bg-blue-500 rounded-full"></span>
                                            Admin: <span class="ml-1 font-medium">{{ $t->ai_admin_score ?? '-' }}</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                            <span class="inline-block w-2 h-2 mr-2 bg-green-500 rounded-full"></span>
                                            Substantive: <span class="ml-1 font-medium">{{ $t->ai_substantive_score ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                            <span class="inline-block w-2 h-2 mr-2 bg-blue-500 rounded-full"></span>
                                            Admin: <span class="ml-1 font-medium">{{ $t->user_admin_score ?? '-' }}</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                            <span class="inline-block w-2 h-2 mr-2 bg-green-500 rounded-full"></span>
                                            Substantive: <span class="ml-1 font-medium">{{ $t->user_substantive_score ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($t->is_trained)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                            <i class="mr-1 fas fa-check"></i>
                                            Trained
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                            <i class="mr-1 fas fa-clock"></i>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <i class="mr-2 text-gray-400 fas fa-clock"></i>
                                        {{ $t->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-400 dark:text-gray-500">
                                        {{ $t->created_at->format('H:i') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                            <i class="text-2xl text-gray-400 fas fa-database"></i>
                                        </div>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No Training Data</h3>
                                        <p class="text-gray-500 dark:text-gray-400">No training data records available yet.</p>
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
        // Add some interactivity
        const formInputs = document.querySelectorAll('input, textarea, select');

        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-primary-200', 'rounded-lg');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-primary-200', 'rounded-lg');
            });
        });

        // Auto-calculate score differences
        const aiAdminScore = document.getElementById('ai_admin_score');
        const aiSubstantiveScore = document.getElementById('ai_substantive_score');
        const userAdminScore = document.getElementById('user_admin_score');
        const userSubstantiveScore = document.getElementById('user_substantive_score');

        function calculateDifferences() {
            // You can add logic here to calculate and display score differences
            // This is useful for training data validation
        }

        [aiAdminScore, aiSubstantiveScore, userAdminScore, userSubstantiveScore].forEach(input => {
            input.addEventListener('input', calculateDifferences);
        });
    });
</script>
@endpush
