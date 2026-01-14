<!DOCTYPE html>
<html>
<head>
    <title>Proposal Groups</title>
    @vite('resources/css/app.css')
</head>

<body class="p-6 bg-gray-100">

    <div class="max-w-4xl p-6 mx-auto bg-white rounded shadow">

        <h1 class="mb-4 text-xl font-semibold">Proposal Groups</h1>

        <table class="w-full mt-3 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Group Name</th>
                    <th class="p-2 border">Type</th>
                    <th class="p-2 border">Scheme</th>
                    <th class="p-2 border">Total Files</th>
                    <th class="p-2 border">Uploaded At</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($groups as $g)
                    <tr>
                        <td class="p-2 border">{{ $g->group_name }}</td>
                        <td class="p-2 border">{{ ucfirst($g->type) }}</td>
                        <td class="p-2 border">{{ $g->scheme }}</td>
                        <td class="p-2 border">{{ $g->total_files }}</td>
                        <td class="p-2 border">{{ $g->uploaded_at?->format('d M Y H:i') }}</td>
                        <td class="p-2 border">{{ $g->status }}</td>

                        <td class="p-2 border">
                            <a href="{{ route('proposal-groups.show', $g->id) }}" class="text-blue-600">
                                View Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</body>
</html>
