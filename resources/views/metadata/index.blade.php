@extends('layouts.admin')

@section('title', 'Research Metadata')
@section('header-title', 'Metadata Penelitian')

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
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Research Metadata</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Input Form Card -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Add New Metadata</h2>
                </div>

                <div class="p-6">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div
                            class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
                            <div class="flex items-center">
                                <i class="mr-2 text-green-500 fas fa-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('metadata.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-4">
                            <!-- Title -->
                            <div>
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="title" name="title" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Enter research title" value="{{ old('title') }}">
                            </div>

                            <!-- Category & Field of Study -->
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label for="category"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Category
                                    </label>
                                    <input type="text" id="category" name="category"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Research category" value="{{ old('category') }}">
                                </div>

                                <div>
                                    <label for="field_of_study"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Field of Study
                                    </label>
                                    <input type="text" id="field_of_study" name="field_of_study"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Field of study" value="{{ old('field_of_study') }}">
                                </div>
                            </div>

                            <!-- Researcher Name & Study Program -->
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label for="researcher_name"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Researcher Name
                                    </label>
                                    <input type="text" id="researcher_name" name="researcher_name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Researcher name" value="{{ old('researcher_name') }}">
                                </div>

                                <div>
                                    <label for="study_program"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Study Program
                                    </label>
                                    <input type="text" id="study_program" name="study_program"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Study program" value="{{ old('study_program') }}">
                                </div>
                            </div>

                            <!-- Year & Semester -->
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label for="year"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Year
                                    </label>
                                    <input type="number" id="year" name="year"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                        placeholder="2024" value="{{ old('year') }}">
                                </div>

                                <div>
                                    <label for="semester"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Semester
                                    </label>
                                    <input type="text" id="semester" name="semester"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                        placeholder="e.g. Odd, Even" value="{{ old('semester') }}">
                                </div>
                            </div>

                            <!-- Output Type & Status -->
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label for="output_type"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Output Type
                                    </label>
                                    <input type="text" id="output_type" name="output_type"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                                        placeholder="article, proceeding, prototype" value="{{ old('output_type') }}">
                                </div>

                                <div>
                                    <label for="status"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Status
                                    </label>
                                    <select id="status" name="status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="draft">Draft</option>
                                        <option value="reviewed">Reviewed</option>
                                        <option value="published">Published</option>
                                    </select>
                                </div>
                            </div>

                            <!-- File Upload -->
                            <div>
                                <label for="file_paths"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Metadata Files
                                </label>
                                <input type="file" id="file_paths" name="file_paths[]" multiple
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-primary-900/20 dark:file:text-primary-300">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">You can select multiple files</p>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="px-6 py-2.5 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm transition-colors duration-200 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <i class="mr-2 fas fa-save"></i>
                                Save Metadata
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Metadata Table Card -->
            <div class="bg-white border border-gray-200 shadow-sm dark:bg-gray-800 rounded-2xl dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Metadata List</h2>
                        <div class="flex items-center mt-2 space-x-2 sm:mt-0">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Total: {{ $metadata->count() }} records
                            </span>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Title
                                </th>
                                <th
                                    class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Category
                                </th>
                                <th
                                    class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Year
                                </th>
                                <th
                                    class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Researcher
                                </th>
                                <th
                                    class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Files
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse ($metadata as $item)
                                <tr class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3">
                                        <div class="max-w-xs">
                                            <div class="text-sm font-medium text-gray-900 truncate dark:text-white"
                                                title="{{ $item->title }}">
                                                {{ $item->title }}
                                            </div>
                                            @if ($item->output_type)
                                                <span
                                                    class="inline-block px-2 py-1 mt-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                                                    {{ $item->output_type }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-300">
                                        {{ $item->category ?: '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-300">
                                        @if ($item->year)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                {{ $item->year }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-300">
                                        <div class="max-w-xs">
                                            <div class="font-medium text-gray-900 dark:text-white">
                                                {{ $item->researcher_name ?: '-' }}
                                            </div>
                                            @if ($item->study_program)
                                                <div class="text-xs text-gray-400 dark:text-gray-500">
                                                    {{ $item->study_program }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @php
                                            // pastikan file_paths selalu array
                                            $files = is_array($item->file_paths)
                                                ? $item->file_paths
                                                : json_decode($item->file_paths, true);
                                        @endphp

                                        @if ($files && count($files) > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach (array_slice($files, 0, 2) as $file)
                                                    <a href="{{ Storage::url($file) }}" target="_blank"
                                                        class="inline-flex items-center px-2 py-1 text-xs text-blue-600 transition-all duration-200 rounded bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:bg-blue-900/30"
                                                        title="{{ basename($file) }}">
                                                        <i class="mr-1 fas fa-external-link-alt"></i>
                                                        File {{ $loop->iteration }}
                                                    </a>
                                                @endforeach

                                                @if (count($files) > 2)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 text-xs text-gray-600 bg-gray-100 rounded dark:bg-gray-700 dark:text-gray-400">
                                                        +{{ count($files) - 2 }} more
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl dark:bg-gray-700">
                                                <i class="text-2xl text-gray-400 fas fa-database"></i>
                                            </div>
                                            <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">No
                                                Metadata Found</h3>
                                            <p class="text-gray-500 dark:text-gray-400">No research metadata records
                                                available.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
