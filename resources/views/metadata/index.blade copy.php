<!DOCTYPE html>
<html>
<head>
    <title>Research Metadata</title>
    @vite('resources/css/app.css')
</head>

<body class="p-6 bg-gray-100">

    <div class="grid max-w-6xl grid-cols-1 gap-6 mx-auto md:grid-cols-2">

        {{-- Input Form --}}
        <div class="p-5 bg-white rounded shadow">
            <h2 class="mb-4 text-xl font-semibold">Add Metadata</h2>

            @if (session('success'))
                <div class="p-2 mb-3 text-green-800 bg-green-200 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('metadata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label class="font-medium">Title</label>
                    <input type="text" name="title" class="w-full p-2 border rounded" required>
                </div>

                {{-- Category --}}
                <div class="mb-3">
                    <label class="font-medium">Category</label>
                    <input type="text" name="category" class="w-full p-2 border rounded">
                </div>

                {{-- Field of Study --}}
                <div class="mb-3">
                    <label class="font-medium">Field of Study</label>
                    <input type="text" name="field_of_study" class="w-full p-2 border rounded">
                </div>

                {{-- Researcher Name --}}
                <div class="mb-3">
                    <label class="font-medium">Researcher Name</label>
                    <input type="text" name="researcher_name" class="w-full p-2 border rounded">
                </div>

                {{-- Study Program --}}
                <div class="mb-3">
                    <label class="font-medium">Study Program</label>
                    <input type="text" name="study_program" class="w-full p-2 border rounded">
                </div>

                {{-- Year --}}
                <div class="mb-3">
                    <label class="font-medium">Year</label>
                    <input type="number" name="year" class="w-full p-2 border rounded">
                </div>

                {{-- Semester --}}
                <div class="mb-3">
                    <label class="font-medium">Semester</label>
                    <input type="text" name="semester" class="w-full p-2 border rounded">
                </div>

                {{-- Output Type --}}
                <div class="mb-3">
                    <label class="font-medium">Output Type</label>
                    <input type="text" name="output_type" class="w-full p-2 border rounded" placeholder="article, proceeding, prototype">
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="font-medium">Status</label>
                    <select name="status" class="w-full p-2 border rounded">
                        <option value="draft">Draft</option>
                        <option value="reviewed">Reviewed</option>
                        <option value="published">Published</option>
                    </select>
                </div>

                {{-- Files --}}
                <div class="mb-3">
                    <label class="font-medium">Metadata Files</label>
                    <input type="file" name="file_paths[]" multiple class="w-full p-2 border rounded">
                </div>

                <button class="w-full px-4 py-2 text-white bg-blue-600 rounded">
                    Save Metadata
                </button>
            </form>
        </div>

        {{-- Metadata Table --}}
        <div class="p-5 overflow-auto bg-white rounded shadow">
            <h2 class="mb-4 text-xl font-semibold">Metadata List</h2>

            <table class="w-full text-sm border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">Title</th>
                        <th class="p-2 border">Category</th>
                        <th class="p-2 border">Year</th>
                        <th class="p-2 border">Researcher</th>
                        <th class="p-2 border">Files</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($metadata as $item)
                        <tr>
                            <td class="p-2 border">{{ $item->title }}</td>
                            <td class="p-2 border">{{ $item->category }}</td>
                            <td class="p-2 border">{{ $item->year }}</td>
                            <td class="p-2 border">{{ $item->researcher_name }}</td>

                            <td class="p-2 border">
                                @if ($item->file_paths)
                                    <ul>
                                        @foreach ($item->file_paths as $file)
                                            <li>
                                                <a href="{{ Storage::url($file) }}" target="_blank" class="text-blue-600">
                                                    View File
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

</body>
</html>
