@php
    /**
     * @var \App\Models\Category|null $category
     */
@endphp

@csrf

<div
    x-data="{
        mediaPreview: null,
        mediaFile: null,
        mediaLoading: false,
        isActive: {{ old('is_active', $category->is_active ?? true) ? 'true' : 'false' }},
        handleMediaSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.mediaFile = file;
                this.mediaLoading = true;
                
                // Check if it's a video or document
                const fileType = file.type;
                const isVideo = fileType.startsWith('video/');
                const isDocument = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
                                   'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                   'text/csv', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'].includes(fileType);
                
                if (isVideo) {
                    // For videos, create object URL for preview
                    this.mediaPreview = URL.createObjectURL(file);
                    this.mediaLoading = false;
                } else if (isDocument) {
                    // For documents, show file icon instead
                    this.mediaPreview = null;
                    this.mediaLoading = false;
                } else {
                    // For images, use FileReader
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.mediaPreview = e.target.result;
                    this.mediaLoading = false;
                };
                reader.readAsDataURL(file);
                }
            }
        },
        clearMedia() {
            // Clean up video object URL to prevent memory leaks
            if (this.mediaPreview && this.mediaFile && this.mediaFile.type.startsWith('video/')) {
                URL.revokeObjectURL(this.mediaPreview);
            }
            this.mediaPreview = null;
            this.mediaFile = null;
            const input = document.getElementById('media_input');
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
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <span>Name <span class="text-red-500">*</span></span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name ?? '') }}"
                    required
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="Category name" />
                @error('name')
                    <p class="mt-1 text-xs text-red-600 flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            {{-- Slug --}}
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    <span>Slug</span>
                </label>
                <input
                    type="text"
                    name="slug"
                    value="{{ old('slug', $category->slug ?? '') }}"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="Auto-generated from name" />
                <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate from name</p>
                @error('slug')
                    <p class="mt-1 text-xs text-red-600 flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            {{-- Sort Order --}}
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                    </svg>
                    <span>Sort Order</span>
                </label>
                <input
                    type="number"
                    name="sort_order"
                    value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                    min="0"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="0" />
                @error('sort_order')
                    <p class="mt-1 text-xs text-red-600 flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            {{-- Context Type (grouping) --}}
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span>Context Type</span>
                </label>
                <input
                    type="text"
                    name="type"
                    value="{{ old('type', $category->type ?? '') }}"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="e.g. hero-banner, testimonial, about-section" />
                @error('type')
                    <p class="mt-1 text-xs text-red-600 flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>
        </div>

        {{-- Description (full width) --}}
        <div class="mt-6">
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                    <span>Description</span>
                </label>
                <textarea
                    name="description"
                    rows="4"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md resize-none"
                    placeholder="Enter category description...">{{ old('description', $category->description ?? '') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-600 flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Media Section --}}
    <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
            <h3 class="text-lg font-semibold text-gray-900 font-tenor">Media</h3>
        </div>
        
        <div class="space-y-3">
            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Category Media</span>
            </label>
            
            <div class="relative">
                {{-- Upload Area (always visible) --}}
                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer transition-all group relative overflow-hidden" :class="mediaLoading ? 'border-blue-300 bg-blue-50 pointer-events-none' : (mediaPreview || mediaFile) ? 'border-emerald-300 bg-emerald-50' : 'border-gray-300 bg-white hover:bg-gray-50 hover:border-gray-400'">
                    {{-- Loading Overlay --}}
                    <div x-show="mediaLoading" x-cloak class="absolute inset-0 flex flex-col items-center justify-center bg-blue-50 bg-opacity-95 z-10">
                        <svg class="animate-spin w-8 h-8 text-blue-600 mb-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <p class="text-sm text-blue-600 font-medium">Processing media...</p>
                    </div>
                    
                    {{-- Upload Content --}}
                    <div class="flex flex-col items-center justify-center pt-5 pb-6" :class="mediaLoading ? 'opacity-0' : ''">
                        <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500">Images, Videos, PDFs, Documents, Spreadsheets, etc. (up to 20MB)</p>
                    </div>
                    <input
                        id="media_input"
                        type="file"
                        name="media"
                        accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx,.csv,.ppt,.pptx,.txt"
                        x-on:change="handleMediaSelect($event)"
                        class="hidden" />
                </label>
            </div>
            
            <div class="space-y-3">
                {{-- Media Type (optional override) --}}
                <div class="space-y-2">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                        </svg>
                        <span>Media Type</span>
                    </label>
                    @php
                        $mediaTypeValue = old('media_type', $category->media_type ?? '');
                    @endphp
                    <select
                        name="media_type"
                        class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md">
                        <option value="">Auto-detect from file</option>
                        <option value="image" {{ $mediaTypeValue === 'image' ? 'selected' : '' }}>Image</option>
                        <option value="svg" {{ $mediaTypeValue === 'svg' ? 'selected' : '' }}>SVG</option>
                        <option value="icon" {{ $mediaTypeValue === 'icon' ? 'selected' : '' }}>Icon</option>
                        <option value="video" {{ $mediaTypeValue === 'video' ? 'selected' : '' }}>Video</option>
                        <option value="pdf" {{ $mediaTypeValue === 'pdf' ? 'selected' : '' }}>PDF Document</option>
                        <option value="document" {{ $mediaTypeValue === 'document' ? 'selected' : '' }}>Word Document</option>
                        <option value="spreadsheet" {{ $mediaTypeValue === 'spreadsheet' ? 'selected' : '' }}>Spreadsheet</option>
                        <option value="presentation" {{ $mediaTypeValue === 'presentation' ? 'selected' : '' }}>Presentation</option>
                        <option value="other" {{ $mediaTypeValue === 'other' ? 'selected' : '' }}>Other File</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Leave as auto-detect in most cases. Use this only if you need to force a specific handling.</p>
                    @error('media_type')
                        <p class="mt-1 text-xs text-red-600 flex items-center space-x-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                {{-- Current Media (if editing) --}}
                @if (!empty($category?->media_path))
                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border-2 border-gray-200">
                        @if($category->media_type === 'video')
                            <div class="relative w-32 h-24 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0">
                                <video
                                    src="{{ $category->media_url }}"
                                    class="w-full h-full object-cover"
                                    controls
                                    preload="metadata">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @elseif(in_array($category->media_type, ['pdf', 'document', 'spreadsheet', 'presentation', 'other']))
                            <div class="relative w-24 h-24 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @else
                        <div class="relative w-24 h-24 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0">
                            @if ($category->media_type === 'svg')
                                <img
                                    src="{{ $category->media_url }}"
                                    alt="Current media"
                                    class="object-contain w-full h-full p-2" />
                            @else
                                <img
                                    src="{{ $category->media_url }}"
                                    alt="Current media"
                                    class="object-cover w-full h-full" />
                            @endif
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-1">
                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-gray-700 bg-gray-200 rounded-md">Current</span>
                                @if($category->media_type)
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-blue-700 bg-blue-100 rounded-md capitalize">{{ $category->media_type }}</span>
                                @endif
                            </div>
                            <p class="text-sm font-medium text-gray-900 truncate">{{ basename($category->media_path) }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">Existing media file</p>
                            <a href="{{ $category->media_url }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 mt-1 inline-block">View/Download</a>
                        </div>
                    </div>
                @endif

                {{-- New Media Preview --}}
                <div x-show="mediaFile" x-cloak class="flex items-center gap-3 p-4 bg-emerald-50 rounded-xl border-2 border-emerald-300">
                    <template x-if="mediaPreview && mediaFile.type.startsWith('video/')">
                        <div class="relative w-32 h-24 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0">
                            <video
                                :src="mediaPreview"
                                class="w-full h-full object-cover"
                                controls
                                preload="metadata">
                                Your browser does not support the video tag.
                            </video>
                            <div class="absolute top-1 right-1">
                                <span class="inline-flex items-center px-1.5 py-0.5 text-[10px] font-semibold text-white bg-emerald-500 rounded">New</span>
                            </div>
                        </div>
                    </template>
                    <template x-if="mediaPreview && !mediaFile.type.startsWith('video/') && !['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'].includes(mediaFile.type)">
                    <div class="relative w-24 h-24 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0">
                        <img
                            :src="mediaPreview"
                            alt="Selected media preview"
                            class="object-cover w-full h-full" />
                        <div class="absolute top-1 right-1">
                            <span class="inline-flex items-center px-1.5 py-0.5 text-[10px] font-semibold text-white bg-emerald-500 rounded">New</span>
                        </div>
                    </div>
                    </template>
                    <template x-if="!mediaPreview || ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'].includes(mediaFile.type)">
                        <div class="relative w-24 h-24 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <div class="absolute top-1 right-1">
                                <span class="inline-flex items-center px-1.5 py-0.5 text-[10px] font-semibold text-white bg-emerald-500 rounded">New</span>
                            </div>
                        </div>
                    </template>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-emerald-700 bg-emerald-200 rounded-md">Selected</span>
                            <button
                                type="button"
                                @click="clearMedia()"
                                class="text-gray-400 hover:text-red-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm font-medium text-gray-900 truncate" x-text="mediaFile ? mediaFile.name : ''"></p>
                        <p class="text-xs text-emerald-600 mt-0.5" x-text="mediaFile ? (mediaFile.size > 1024 * 1024 ? (mediaFile.size / (1024 * 1024)).toFixed(2) + ' MB' : (mediaFile.size / 1024).toFixed(2) + ' KB') : ''"></p>
                        <p class="text-xs text-gray-500 mt-0.5" x-text="mediaFile ? mediaFile.type : ''"></p>
                    </div>
                </div>
            </div>
            
            @error('media')
                <p class="mt-1 text-xs text-red-600 flex items-center space-x-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $message }}</span>
                </p>
            @enderror
        </div>
    </div>

    {{-- Settings Section --}}
    <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
            <h3 class="text-lg font-semibold text-gray-900 font-tenor">Settings</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Active Checkbox --}}
            <label class="flex items-center space-x-3 p-4 bg-white rounded-xl border-2 cursor-pointer transition-all hover:border-gray-300 hover:shadow-md active:scale-95 group" :class="isActive ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200'">
                <div class="relative flex-shrink-0">
                    <input
                        id="is_active"
                        name="is_active"
                        type="checkbox"
                        value="1"
                        @if(old('is_active', $category->is_active ?? true)) checked @endif
                        x-model="isActive"
                        class="sr-only" />
                    <div class="w-5 h-5 rounded border-2 transition-all duration-200 flex items-center justify-center" :class="isActive ? 'bg-emerald-500 border-emerald-500' : 'bg-white border-gray-300 group-hover:border-gray-400'">
                        <svg x-show="isActive" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100" class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900">Active</p>
                    <p class="text-xs text-gray-500 mt-0.5">Show this category</p>
                </div>
            </label>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
        <a
            href="{{ route('admin.categories.index') }}"
            class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-all shadow-sm hover:shadow-md">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Cancel
        </a>
        <button
            type="submit"
            class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-gray-900 to-gray-800 rounded-xl hover:from-gray-800 hover:to-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ $submitLabel ?? 'Save' }}
        </button>
    </div>
</div>

