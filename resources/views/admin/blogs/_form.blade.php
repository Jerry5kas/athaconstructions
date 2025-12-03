@php
    /** @var \App\Models\Blog|null $blog */
@endphp

@csrf

<div
    x-data="{
        coverPreview: {{ $blog && $blog->cover_image_url ? 'true' : 'false' }},
        coverUrl: '{{ $blog->cover_image_url ?? '' }}',
        coverFile: null,
        coverLoading: false,
        handleCoverSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.coverFile = file;
                this.coverLoading = true;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.coverUrl = e.target.result;
                    this.coverPreview = true;
                    this.coverLoading = false;
                };
                reader.readAsDataURL(file);
            }
        },
        clearCover() {
            this.coverPreview = false;
            this.coverUrl = '';
            this.coverFile = null;
            const input = document.getElementById('cover_image');
            if (input) input.value = '';
        }
    }"
    class="space-y-8">

    {{-- Content Section --}}
    <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
            <h3 class="text-lg font-semibold text-gray-900 font-tenor">Content</h3>
        </div>

        <div class="space-y-6">
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Title <span class="text-red-500">*</span></span>
                </label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $blog->title ?? '') }}"
                    required
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="Blog title" />
                @error('title')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Slug</span>
                </label>
                <input
                    type="text"
                    name="slug"
                    value="{{ old('slug', $blog->slug ?? '') }}"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="Auto-generated from title if left empty" />
                <p class="mt-1 text-xs text-gray-500">Use lowercase letters, numbers, and hyphens only.</p>
                @error('slug')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Excerpt</span>
                </label>
                <textarea
                    name="excerpt"
                    rows="3"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md resize-none"
                    placeholder="Short introduction for this blog (1–2 sentences)">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                @error('excerpt')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Content</span>
                </label>
                <textarea
                    name="content"
                    rows="8"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="Write your blog content here... (you can enhance this later with a rich text editor)">{{ old('content', $blog->content ?? '') }}</textarea>
                @error('content')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Cover Image Section --}}
    <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
            <h3 class="text-lg font-semibold text-gray-900 font-tenor">Cover Image</h3>
        </div>

        <div class="space-y-3">
            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                <span>Blog Cover Image</span>
            </label>

            <div class="relative">
                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer transition-all group relative overflow-hidden" :class="coverLoading ? 'border-blue-300 bg-blue-50 pointer-events-none' : (coverPreview ? 'border-emerald-300 bg-emerald-50' : 'border-gray-300 bg-white hover:bg-gray-50 hover:border-gray-400')">
                    <div x-show="coverLoading" x-cloak class="absolute inset-0 flex flex-col items-center justify-center bg-blue-50 bg-opacity-95 z-10">
                        <svg class="animate-spin w-8 h-8 text-blue-600 mb-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <p class="text-sm text-blue-600 font-medium">Processing image...</p>
                    </div>

                    <div class="flex flex-col items-center justify-center pt-5 pb-6" :class="coverLoading ? 'opacity-0' : ''">
                        <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500">JPG, PNG, WEBP up to 5MB</p>
                    </div>
                    <input
                        id="cover_image"
                        type="file"
                        name="cover_image"
                        accept="image/png,image/jpeg,image/jpg,image/webp"
                        x-on:change="handleCoverSelect($event)"
                        class="hidden" />
                </label>
            </div>

            <div class="space-y-3">
                {{-- Current / Selected Cover Preview --}}
                <div x-show="coverPreview && coverUrl" x-cloak class="flex items-center gap-3 p-4 bg-emerald-50 rounded-xl border-2 border-emerald-300">
                    <div class="relative w-24 h-20 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0">
                        <img
                            :src="coverUrl"
                            alt="Blog cover preview"
                            class="object-cover w-full h-full" />
                        <div class="absolute top-1 right-1">
                            <span class="inline-flex items-center px-1.5 py-0.5 text-[10px] font-semibold text-white bg-emerald-500 rounded">Cover</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-emerald-700 bg-emerald-200 rounded-md">Selected</span>
                            <button
                                type="button"
                                @click="clearCover()"
                                class="text-gray-400 hover:text-red-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-emerald-600 mt-0.5">This image will appear as the main blog cover.</p>
                    </div>
                </div>
            </div>

            @error('cover_image')
                <p class="mt-1 text-xs text-red-600 flex items-center space-x-1">
                    <span>{{ $message }}</span>
                </p>
            @enderror
        </div>
    </div>

    {{-- SEO Section --}}
    <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
            <h3 class="text-lg font-semibold text-gray-900 font-tenor">SEO</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Meta Title</span>
                </label>
                <input
                    type="text"
                    name="meta_title"
                    value="{{ old('meta_title', $blog->meta_title ?? '') }}"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="SEO title (defaults to blog title if empty)" />
                @error('meta_title')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Keywords</span>
                </label>
                <input
                    type="text"
                    name="keywords"
                    value="{{ old('keywords', $blog->keywords ?? '') }}"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="e.g. construction tips, home design, bangalore" />
                @error('keywords')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 space-y-2">
            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                <span>Meta Description</span>
            </label>
            <textarea
                name="meta_description"
                rows="3"
                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md resize-none"
                placeholder="Short SEO description (150–160 characters)">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
            @error('meta_description')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Settings Section --}}
    <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
            <h3 class="text-lg font-semibold text-gray-900 font-tenor">Settings</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Status</span>
                </label>
                <select
                    name="status"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md">
                    @php
                        $statusValue = old('status', $blog->status ?? 'draft');
                    @endphp
                    <option value="draft" {{ $statusValue === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $statusValue === 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Category</span>
                </label>
                <select
                    name="category_id"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md">
                    <option value="">No category</option>
                    @foreach($categories ?? [] as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ (string) old('category_id', $blog->category_id ?? '') === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Author</span>
                </label>
                <input
                    type="text"
                    name="author"
                    value="{{ old('author', $blog->author ?? '') }}"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="Author name (optional)" />
                @error('author')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Publish Date</span>
                </label>
                <input
                    type="datetime-local"
                    name="published_at"
                    value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md" />
                @error('published_at')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Tags Section --}}
    <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
            <h3 class="text-lg font-semibold text-gray-900 font-tenor">Tags</h3>
        </div>

        <div class="space-y-2">
            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                <span>Tags (comma separated)</span>
            </label>
            <input
                type="text"
                name="tags"
                value="{{ old('tags', $blog->tags?->pluck('name')->implode(', ') ?? '') }}"
                class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                placeholder="e.g. construction, planning, bangalore" />
            <p class="mt-1 text-xs text-gray-500">Enter tags separated by commas. Example: <span class="font-mono">construction, home design, tips</span></p>
            @error('tags')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
        <a
            href="{{ route('admin.blogs.index') }}"
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