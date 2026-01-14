@extends('layouts.admin')

@section('title', 'Chatbot AI')
@section('header-title', 'Chatbot AI')

@section('content')
    <div class="container mx-auto">
        @livewire('chatbot-interface')
    </div>
@endsection
