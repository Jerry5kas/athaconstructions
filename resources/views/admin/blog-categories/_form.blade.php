@php
    /** @var \App\Models\BlogCategory|null $category */
@endphp

@csrf

<div class="space-y-8">
    {{-- Content Section --}}
    <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
            <h3 class="text-lg font-semibold text-gray-900 font-tenor">Content</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Name <span class="text-red-500">*</span></span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name ?? '') }}"
                    required
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="Blog category name" />
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Slug</span>
                </label>
                <input
                    type="text"
                    name="slug"
                    value="{{ old('slug', $category->slug ?? '') }}"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="Auto-generated from name if left empty" />
                <p class="mt-1 text-xs text-gray-500">Use lowercase letters, numbers, and hyphens only.</p>
                @error('slug')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Description --}}
        <div class="mt-6 space-y-2">
            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                <span>Description</span>
            </label>
            <textarea
                name="description"
                rows="4"
                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md resize-none"
                placeholder="Short description for this blog category (optional)">{{ old('description', $category->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
        <a
            href="{{ route('admin.blog-categories.index') }}"
            class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-all shadow-sm hover:shadow-md">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Cancel
        </a>
        <button
            type="submit"
            class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-gray-900 to-gray-800 rounded-xl hover:from-gray-800 hover:to-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ $submitLabel ?? 'Save' }}
        </button>
    </div>
</div>


