@extends('layouts.admin')

@section('title', 'Edit Package Section')
@section('page-title', 'Edit Package Section')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-lg">
            <div class="mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-6">
                <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Edit Package Section</h6>
                <p class="mb-0 text-sm text-slate-500">Update section details.</p>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('admin.package-sections.update', $section) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $section->name) }}" required class="w-full rounded-xl border border-gray-300 px-4 py-3">
                            @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Slug</label>
                            <input type="text" name="slug" value="{{ old('slug', $section->slug) }}" class="w-full rounded-xl border border-gray-300 px-4 py-3">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order) }}" min="0" class="w-full rounded-xl border border-gray-300 px-4 py-3">
                        </div>
                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $section->is_active) ? 'checked' : '' }} class="rounded">
                                <span class="text-sm font-semibold text-gray-700">Active</span>
                            </label>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('admin.package-sections.index') }}" class="px-6 py-3 border border-gray-300 rounded-xl">Cancel</a>
                            <button type="submit" class="px-6 py-3 bg-gray-900 text-white rounded-xl">Update Section</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

