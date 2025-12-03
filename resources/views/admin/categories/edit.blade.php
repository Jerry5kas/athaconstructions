@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-lg">
            <div class="mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-6">
                <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Edit Category</h6>
                <p class="mb-0 text-sm text-slate-500">Update the category information and media.</p>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @include('admin.categories._form', [
                        'category' => $category,
                        'submitLabel' => 'Update Category',
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

