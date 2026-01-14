<!DOCTYPE html>
<html>
<head>
    <title>Group Details</title>
    @vite('resources/css/app.css')
</head>

<body class="p-6 bg-gray-100">

    <div class="max-w-4xl p-6 mx-auto bg-white rounded shadow">

        <h1 class="mb-2 text-xl font-semibold">
            Group: {{ $group->group_name }}
        </h1>

        <p><strong>Type:</strong> {{ $group->type }}</p>
        <p><strong>Scheme:</strong> {{ $group->scheme }}</p>
        <p><strong>Total Files:</strong> {{ $group->total_files }}</p>
        <p><strong>Status:</strong> {{ $group->status }}</p>
        <p><strong>Uploaded At:</strong> {{ $group->uploaded_at?->format('d M Y H:i') }}</p>

        <h2 class="mt-6 text-lg font-semibold">Proposal Files</h2>

        <table class="w-full mt-3 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Filename</th>
                    <th class="p-2 border">Size (KB)</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($proposals as $p)
                    <tr>
                        <td class="p-2 border">{{ $p->filename }}</td>
                        <td class="p-2 border">{{ number_format($p->size / 1024, 2) }}</td>
                        <td class="p-2 border">
                            <a href="{{ Storage::url($p->path) }}" target="_blank" class="text-blue-600">
                                View File
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</body>
</html>
