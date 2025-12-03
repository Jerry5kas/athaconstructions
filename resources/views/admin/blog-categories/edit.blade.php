@extends('layouts.admin')

@section('title', 'Edit Blog Category')
@section('page-title', 'Edit Blog Category')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md">
            <div class="mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-4 flex items-center justify-between">
                <div>
                    <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Edit Blog Category</h6>
                    <p class="mb-0 text-sm text-slate-500">Update the blog category details.</p>
                </div>
            </div>

            <div class="flex-auto px-0 pt-0 pb-6">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.blog-categories.update', $category) }}">
                        @method('PUT')
                        @include('admin.blog-categories._form', ['category' => $category, 'submitLabel' => 'Update Blog Category'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


