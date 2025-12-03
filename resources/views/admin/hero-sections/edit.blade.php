@extends('layouts.admin')

@section('title', 'Edit Hero Section')
@section('page-title', 'Edit Hero Section')

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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 font-tenor">Edit Home Hero</h1>
                <p class="text-sm text-gray-500 mt-0.5">Update the content and media for the home hero section</p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.hero-sections.update', $heroSection) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
            @method('PUT')
            @include('admin.hero-sections._form', [
                'heroSection' => $heroSection,
                'submitLabel' => 'Update Hero',
            ])
        </form>
    </div>
</div>
@endsection
