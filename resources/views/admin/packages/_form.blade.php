@php
    /**
     * @var \App\Models\Package|null $package
     */
@endphp

@csrf

<div
    x-data="{
        imagePreview: null,
        imageFile: null,
        imageLoading: false,
        isActive: {{ old('is_active', $package->is_active ?? true) ? 'true' : 'false' }},
        handleImageSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.imageFile = file;
                this.imageLoading = true;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                    this.imageLoading = false;
                };
                reader.readAsDataURL(file);
            }
        },
        clearImage() {
            this.imagePreview = null;
            this.imageFile = null;
            const input = document.getElementById('image_input');
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
                    <span>Package Name <span class="text-red-500">*</span></span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $package->name ?? '') }}"
                    required
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="e.g., Basic Package" />
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
                    value="{{ old('slug', $package->slug ?? '') }}"
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

            {{-- Price Per Sqft --}}
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Price Per Sqft (₹) <span class="text-red-500">*</span></span>
                </label>
                <input
                    type="number"
                    name="price_per_sqft"
                    value="{{ old('price_per_sqft', $package->price_per_sqft ?? '') }}"
                    required
                    min="0"
                    step="1"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="e.g., 1849" />
                @error('price_per_sqft')
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
                    value="{{ old('sort_order', $package->sort_order ?? 0) }}"
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
        </div>
    </div>

    {{-- Image Section --}}
    <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
            <h3 class="text-lg font-semibold text-gray-900 font-tenor">Image</h3>
        </div>
        
        <div class="space-y-3">
            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Package Image</span>
            </label>
            
            <div class="relative">
                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer transition-all group relative overflow-hidden" :class="imageLoading ? 'border-blue-300 bg-blue-50 pointer-events-none' : (imagePreview || imageFile) ? 'border-emerald-300 bg-emerald-50' : 'border-gray-300 bg-white hover:bg-gray-50 hover:border-gray-400'">
                    <div x-show="imageLoading" x-cloak class="absolute inset-0 flex flex-col items-center justify-center bg-blue-50 bg-opacity-95 z-10">
                        <svg class="animate-spin w-8 h-8 text-blue-600 mb-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <p class="text-sm text-blue-600 font-medium">Processing image...</p>
                    </div>
                    
                    <div class="flex flex-col items-center justify-center pt-5 pb-6" :class="imageLoading ? 'opacity-0' : ''">
                        <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP up to 5MB</p>
                    </div>
                    <input
                        id="image_input"
                        type="file"
                        name="image"
                        accept="image/png,image/jpeg,image/jpg,image/gif,image/webp"
                        x-on:change="handleImageSelect($event)"
                        class="hidden" />
                </label>
            </div>
            
            <div class="space-y-3">
                @if (!empty($package?->image_path))
                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border-2 border-gray-200">
                        <div class="relative w-32 h-32 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0">
                            <img
                                src="{{ $package->image_path }}"
                                alt="Current package image"
                                class="object-cover w-full h-full" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-1">
                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-gray-700 bg-gray-200 rounded-md">Current</span>
                            </div>
                            <p class="text-sm font-medium text-gray-900 truncate">{{ basename($package->image_path) }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">Existing image file</p>
                        </div>
                    </div>
                @endif

                <div x-show="imagePreview && imageFile" x-cloak class="flex items-center gap-3 p-4 bg-emerald-50 rounded-xl border-2 border-emerald-300">
                    <div class="relative w-32 h-32 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0">
                        <img
                            :src="imagePreview"
                            alt="Selected image preview"
                            class="object-cover w-full h-full" />
                        <div class="absolute top-1 right-1">
                            <span class="inline-flex items-center px-1.5 py-0.5 text-[10px] font-semibold text-white bg-emerald-500 rounded">New</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-emerald-700 bg-emerald-200 rounded-md">Selected</span>
                            <button
                                type="button"
                                @click="clearImage()"
                                class="text-gray-400 hover:text-red-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm font-medium text-gray-900 truncate" x-text="imageFile ? imageFile.name : ''"></p>
                        <p class="text-xs text-emerald-600 mt-0.5" x-text="imageFile ? (imageFile.size / 1024).toFixed(2) + ' KB' : ''"></p>
                    </div>
                </div>
            </div>
            
            @error('image')
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
            <label class="flex items-center space-x-3 p-4 bg-white rounded-xl border-2 cursor-pointer transition-all hover:border-gray-300 hover:shadow-md active:scale-95 group" :class="isActive ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200'">
                <div class="relative flex-shrink-0">
                    <input
                        id="is_active"
                        name="is_active"
                        type="checkbox"
                        value="1"
                        @if(old('is_active', $package->is_active ?? true)) checked @endif
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
                    <p class="text-xs text-gray-500 mt-0.5">Show this package</p>
                </div>
            </label>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
        <a
            href="{{ route('admin.packages.index') }}"
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

