<!DOCTYPE html>
<html>

<head>
    <title>Upload Proposals</title>
    @vite('resources/css/app.css')
</head>

<body class="p-6 bg-gray-100">

    <div class="max-w-3xl p-6 mx-auto bg-white rounded shadow">

        <h1 class="mb-4 text-xl font-semibold">Upload Banyak Proposal PDF</h1>

        {{-- FORM UPLOAD --}}
        <form action="{{ route('proposals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="block mb-2">Nama Kelompok:</label>
            <input type="text" name="group_name" required class="w-full p-2 mb-4 border">

            <label>Group Type</label>
            <select name="type" required class="p-2 border">
                <option value="current">Current</option>
                <option value="history">History</option>
            </select>

            <label>Scheme</label>
            <input type="text" name="scheme" class="w-full p-2 border" required>

            <label class="block mb-2">Pilih Folder Proposal:</label>
            <input type="file" name="files[]" multiple directory webkitdirectory class="w-full p-2 mb-4 border">

            <button class="px-4 py-2 text-white bg-blue-600 rounded">
                Upload Proposal Kelompok
            </button>
        </form>

        @if (session('success'))
            <div class="p-2 mt-4 text-green-900 bg-green-200 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABEL FILE --}}
        <div class="mt-6">
            <h2 class="text-lg font-semibold">Daftar Proposal</h2>

            <a href="{{ route('proposal-groups.index') }}" class="text-blue-600 underline">
                Lihat Daftar Proposal Groups
            </a>
        </div>

    </div>

</body>

</html>
