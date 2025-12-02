@extends('layouts.admin')

@section('title', 'Edit Hero Section')
@section('page-title', 'Edit Hero Section')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md">
            <div class="mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-0">
                <h6 class="mb-0">Edit Home Hero</h6>
                <p class="mb-0 text-sm text-slate-500">Update the content and media for the home hero section.</p>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('admin.hero-sections.update', $heroSection) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @include('admin.hero-sections._form', [
                        'heroSection' => $heroSection,
                        'submitLabel' => 'Update Hero',
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
