@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Back Button & Breadcrumb -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <a href="{{ route('results.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
            <i class="mr-2 fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

<h2>Detail Result: {{ $result->group->group_name }}</h2>

<p><strong>Total Proposal:</strong> {{ $result->total_proposals }}</p>
<p><strong>Diterima:</strong> {{ $result->accepted_count }}</p>
<p><strong>Ditolak:</strong> {{ $result->rejected_count }}</p>
<p><strong>Pending:</strong> {{ $result->pending_count }}</p>

<h3>Daftar Proposal di Group Ini</h3>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Pengusul</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($result->group->proposals as $p)
        <tr>
            <td>{{ $p->proposal_title }}</td>
            <td>{{ $p->submitted_by }}</td>
            <td>{{ ucfirst($p->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p><strong>Catatan:</strong> {{ $result->notes }}</p>
@endsection
