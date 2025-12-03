@extends('layouts.admin')

@section('title', 'Create Hero Section')
@section('page-title', 'Create Hero Section')

@push('styles')
<style>
    .form-section {
        transition: all 0.3s ease;
    }
    .form-section:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Header Section --}}
    <div class="mb-6">
        <div class="flex items-center space-x-3 mb-2">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-gray-900 to-gray-700 shadow-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 font-tenor">Add Home Hero</h1>
                <p class="text-sm text-gray-500 mt-0.5">Configure the image/video and content for the home hero section</p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.hero-sections.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
            @include('admin.hero-sections._form', [
                'heroSection' => $heroSection ?? null,
                'submitLabel' => 'Create Hero',
            ])
        </form>
    </div>
</div>
@endsection
