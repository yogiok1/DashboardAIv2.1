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

<h2>Input Result untuk Group: {{ $group->group_name }}</h2>

<form action="{{ route('results.store') }}" method="POST">
    @csrf

    <input type="hidden" name="proposal_group_id" value="{{ $group->id }}">

    <label>Total Proposal</label>
    <input type="number" name="total_proposals" value="{{ $total }}" readonly><br>

    <label>Diterima</label>
    <input type="number" name="accepted_count" value="{{ $accepted }}" readonly><br>

    <label>Ditolak</label>
    <input type="number" name="rejected_count" value="{{ $rejected }}" readonly><br>

    <label>Pending</label>
    <input type="number" name="pending_count" value="{{ $pending }}" readonly><br>

    <label>Catatan</label>
    <textarea name="notes"></textarea><br>

    <button type="submit">Simpan</button>
</form>

@endsection
