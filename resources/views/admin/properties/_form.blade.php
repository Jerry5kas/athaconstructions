@php
    /**
     * @var \App\Models\Property|null $property
     * @var \Illuminate\Database\Eloquent\Collection $amenities
     */
    $oldUnits = old('units', $property ? $property->units->map(function($unit) {
        return [
            'id' => $unit->id,
            'bhk' => $unit->bhk,
            'carpet_area' => $unit->carpet_area,
            'builtup_area' => $unit->builtup_area,
            'super_builtup_area' => $unit->super_builtup_area,
        ];
    })->toArray() : []);
    $oldGallery = old('gallery', $property ? $property->gallery->map(function($item) {
        return [
            'id' => $item->id,
            'type' => $item->type,
        ];
    })->toArray() : []);
    $oldSpecs = old('specifications', $property ? $property->specifications->map(function($spec) {
        return [
            'id' => $spec->id,
            'section' => $spec->section,
            'description' => $spec->description,
        ];
    })->toArray() : []);
@endphp

@csrf

<div
    x-data="{
        activeTab: 'basic',
        imagePreview: null,
        imageFile: null,
        imageLoading: false,
        units: @js($oldUnits),
        gallery: @js($oldGallery),
        specifications: @js($oldSpecs),
        
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
            const input = document.getElementById('featured_image_input');
            if (input) input.value = '';
        },
        addUnit() {
            this.units.push({ bhk: 2, carpet_area: '', builtup_area: '', super_builtup_area: '' });
        },
        removeUnit(index) {
            this.units.splice(index, 1);
        },
        addGalleryItem() {
            this.gallery.push({ type: 'interior' });
        },
        removeGalleryItem(index) {
            this.gallery.splice(index, 1);
        },
        addSpecification() {
            this.specifications.push({ section: '', description: '' });
        },
        removeSpecification(index) {
            this.specifications.splice(index, 1);
        }
    }"
    class="space-y-6">
    
    {{-- Tabs Navigation --}}
    <div class="border-b border-gray-200">
        <nav class="flex space-x-8" aria-label="Tabs">
            <button
                type="button"
                @click="activeTab = 'basic'"
                :class="activeTab === 'basic' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Basic Info
            </button>
            <button
                type="button"
                @click="activeTab = 'location'"
                :class="activeTab === 'location' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Location
            </button>
            <button
                type="button"
                @click="activeTab = 'units'"
                :class="activeTab === 'units' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Units
            </button>
            <button
                type="button"
                @click="activeTab = 'amenities'"
                :class="activeTab === 'amenities' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Amenities
            </button>
            <button
                type="button"
                @click="activeTab = 'gallery'"
                :class="activeTab === 'gallery' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Gallery
            </button>
            <button
                type="button"
                @click="activeTab = 'specs'"
                :class="activeTab === 'specs' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Specifications
            </button>
        </nav>
    </div>

    {{-- Tab Content --}}
    <div class="space-y-6">
        {{-- Basic Info Tab --}}
        <div x-show="activeTab === 'basic'" x-cloak class="space-y-6">
            <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
                <div class="flex items-center space-x-2 mb-6">
                    <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
                    <h3 class="text-lg font-semibold text-gray-900 font-tenor">Basic Information</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Title <span class="text-red-500">*</span></span>
                        </label>
                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $property->title ?? '') }}"
                            required
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                            placeholder="Property title" />
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
                            value="{{ old('slug', $property->slug ?? '') }}"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                            placeholder="Auto-generated from title" />
                        <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate</p>
                        @error('slug')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Project Type <span class="text-red-500">*</span></span>
                        </label>
                        <select
                            name="project_type"
                            required
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md">
                            <option value="">Select type</option>
                            <option value="apartment" {{ old('project_type', $property->project_type ?? '') === 'apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="villa" {{ old('project_type', $property->project_type ?? '') === 'villa' ? 'selected' : '' }}>Villa</option>
                            <option value="plot" {{ old('project_type', $property->project_type ?? '') === 'plot' ? 'selected' : '' }}>Plot</option>
                            <option value="commercial" {{ old('project_type', $property->project_type ?? '') === 'commercial' ? 'selected' : '' }}>Commercial</option>
                        </select>
                        @error('project_type')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Status <span class="text-red-500">*</span></span>
                        </label>
                        <select
                            name="status"
                            required
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md">
                            <option value="upcoming" {{ old('status', $property->status ?? 'upcoming') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="ongoing" {{ old('status', $property->status ?? '') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status', $property->status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>RERA Number</span>
                        </label>
                        <input
                            type="text"
                            name="rera_number"
                            value="{{ old('rera_number', $property->rera_number ?? '') }}"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                            placeholder="RERA registration number" />
                        @error('rera_number')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Total Land Area</span>
                        </label>
                        <input
                            type="text"
                            name="total_land_area"
                            value="{{ old('total_land_area', $property->total_land_area ?? '') }}"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                            placeholder="e.g., 3 Acres 20 Guntas" />
                        @error('total_land_area')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Total Units</span>
                        </label>
                        <input
                            type="number"
                            name="total_units"
                            value="{{ old('total_units', $property->total_units ?? '') }}"
                            min="0"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                            placeholder="Total number of units" />
                        @error('total_units')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Floors</span>
                        </label>
                        <input
                            type="number"
                            name="floors"
                            value="{{ old('floors', $property->floors ?? '') }}"
                            min="0"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                            placeholder="Number of floors" />
                        @error('floors')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Launch Date</span>
                        </label>
                        <input
                            type="date"
                            name="launch_date"
                            value="{{ old('launch_date', $property?->launch_date?->format('Y-m-d') ?? '') }}"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md" />
                        @error('launch_date')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Possession Date</span>
                        </label>
                        <input
                            type="date"
                            name="possession_date"
                            value="{{ old('possession_date', $property?->possession_date?->format('Y-m-d') ?? '') }}"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md" />
                        @error('possession_date')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 space-y-2">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <span>Short Description</span>
                    </label>
                    <textarea
                        name="short_description"
                        rows="3"
                        class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md resize-none"
                        placeholder="Brief summary...">{{ old('short_description', $property->short_description ?? '') }}</textarea>
                    @error('short_description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 space-y-2">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <span>Description</span>
                    </label>
                    <textarea
                        name="description"
                        rows="6"
                        class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md resize-none"
                        placeholder="Full property description...">{{ old('description', $property->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
                <div class="flex items-center space-x-2 mb-6">
                    <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
                    <h3 class="text-lg font-semibold text-gray-900 font-tenor">Featured Image</h3>
                </div>
                
                <div class="space-y-3">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <span>Property Featured Image</span>
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
                                id="featured_image_input"
                                type="file"
                                name="featured_image"
                                accept="image/png,image/jpeg,image/jpg,image/gif,image/webp"
                                x-on:change="handleImageSelect($event)"
                                class="hidden" />
                        </label>
                    </div>
                    
                    @if ($property && !empty($property->featured_image))
                        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border-2 border-gray-200">
                            <div class="relative w-32 h-32 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0">
                                <img
                                    src="{{ $property->featured_image_url }}"
                                    alt="Current featured image"
                                    class="object-cover w-full h-full" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-gray-700 bg-gray-200 rounded-md">Current</span>
                                <p class="text-sm font-medium text-gray-900 truncate mt-1">Existing featured image</p>
                            </div>
                        </div>
                    @endif

                    <div x-show="imagePreview && imageFile" x-cloak class="flex items-center gap-3 p-4 bg-emerald-50 rounded-xl border-2 border-emerald-300">
                        <div class="relative w-32 h-32 overflow-hidden rounded-lg shadow-md bg-slate-100 flex-shrink-0">
                            <img :src="imagePreview" alt="Selected image preview" class="object-cover w-full h-full" />
                            <div class="absolute top-1 right-1">
                                <span class="inline-flex items-center px-1.5 py-0.5 text-[10px] font-semibold text-white bg-emerald-500 rounded">New</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-emerald-700 bg-emerald-200 rounded-md">Selected</span>
                            <button type="button" @click="clearImage()" class="mt-2 text-gray-400 hover:text-red-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEO & Media --}}
            <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
                <div class="flex items-center space-x-2 mb-6">
                    <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
                    <h3 class="text-lg font-semibold text-gray-900 font-tenor">SEO & Media</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Meta Title</span>
                        </label>
                        <input
                            type="text"
                            name="meta_title"
                            value="{{ old('meta_title', $property->meta_title ?? '') }}"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                            placeholder="SEO meta title" />
                        @error('meta_title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Brochure URL</span>
                        </label>
                        <input
                            type="url"
                            name="brochure_url"
                            value="{{ old('brochure_url', $property->brochure_url ?? '') }}"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                            placeholder="PDF brochure link" />
                        @error('brochure_url')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Meta Description</span>
                        </label>
                        <textarea
                            name="meta_description"
                            rows="2"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md resize-none"
                            placeholder="SEO meta description...">{{ old('meta_description', $property->meta_description ?? '') }}</textarea>
                        @error('meta_description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                            <span>Video URL</span>
                        </label>
                        <input
                            type="url"
                            name="video_url"
                            value="{{ old('video_url', $property->video_url ?? '') }}"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                            placeholder="Walkthrough video URL" />
                        @error('video_url')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Location Tab --}}
        <div x-show="activeTab === 'location'" x-cloak class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
            <div class="flex items-center space-x-2 mb-6">
                <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
                <h3 class="text-lg font-semibold text-gray-900 font-tenor">Location Information</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 md:col-span-2">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <span>Address <span class="text-red-500">*</span></span>
                    </label>
                    <textarea
                        name="address"
                        rows="2"
                        required
                        class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md resize-none"
                        placeholder="Full address...">{{ old('address', $property?->location?->address ?? '') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <span>City <span class="text-red-500">*</span></span>
                    </label>
                    <input
                        type="text"
                        name="city"
                        value="{{ old('city', $property?->location?->city ?? '') }}"
                        required
                        class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                        placeholder="City name" />
                    @error('city')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <span>Locality</span>
                    </label>
                    <input
                        type="text"
                        name="locality"
                        value="{{ old('locality', $property?->location?->locality ?? '') }}"
                        class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                        placeholder="Locality/Area" />
                    @error('locality')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <span>Landmark</span>
                    </label>
                    <input
                        type="text"
                        name="landmark"
                        value="{{ old('landmark', $property?->location?->landmark ?? '') }}"
                        class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                        placeholder="Nearby landmark" />
                    @error('landmark')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <span>Pincode</span>
                    </label>
                    <input
                        type="text"
                        name="pincode"
                        value="{{ old('pincode', $property?->location?->pincode ?? '') }}"
                        class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                        placeholder="Pincode" />
                    @error('pincode')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <span>Latitude</span>
                    </label>
                    <input
                        type="text"
                        name="latitude"
                        value="{{ old('latitude', $property?->location?->latitude ?? '') }}"
                        class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                        placeholder="GPS latitude" />
                    @error('latitude')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <span>Longitude</span>
                    </label>
                    <input
                        type="text"
                        name="longitude"
                        value="{{ old('longitude', $property?->location?->longitude ?? '') }}"
                        class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                        placeholder="GPS longitude" />
                    @error('longitude')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Units Tab --}}
        <div x-show="activeTab === 'units'" x-cloak class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-2">
                    <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
                    <h3 class="text-lg font-semibold text-gray-900 font-tenor">Property Units (BHK Types)</h3>
                </div>
                <button
                    type="button"
                    @click="addUnit()"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold text-white bg-gray-900 rounded-lg hover:bg-black transition">
                    + Add Unit
                </button>
            </div>
            
            <template x-for="(unit, index) in units" :key="index">
                <div class="mb-4 p-4 bg-white rounded-xl border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-sm font-semibold text-gray-900">Unit <span x-text="index + 1"></span></h4>
                        <button
                            type="button"
                            @click="removeUnit(index)"
                            class="text-red-600 hover:text-red-700 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="hidden" :name="`units[${index}][id]`" :value="unit.id || ''" />
                        
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-700">BHK <span class="text-red-500">*</span></label>
                            <input
                                type="number"
                                :name="`units[${index}][bhk]`"
                                x-model="unit.bhk"
                                min="1"
                                max="10"
                                required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                                placeholder="1, 2, 3, 4..." />
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-700">Carpet Area (sq.ft)</label>
                            <input
                                type="number"
                                step="0.01"
                                :name="`units[${index}][carpet_area]`"
                                x-model="unit.carpet_area"
                                min="0"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                                placeholder="Carpet area" />
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-700">Built-up Area (sq.ft)</label>
                            <input
                                type="number"
                                step="0.01"
                                :name="`units[${index}][builtup_area]`"
                                x-model="unit.builtup_area"
                                min="0"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                                placeholder="Built-up area" />
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-700">Super Built-up Area (sq.ft)</label>
                            <input
                                type="number"
                                step="0.01"
                                :name="`units[${index}][super_builtup_area]`"
                                x-model="unit.super_builtup_area"
                                min="0"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                                placeholder="Super built-up area" />
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-xs font-semibold text-gray-700">Floor Plan Image</label>
                            <input
                                type="file"
                                :name="`units[${index}][floor_plan_image]`"
                                accept="image/png,image/jpeg,image/jpg,image/gif,image/webp"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent" />
                            @if($property)
                                <template x-if="unit.id && unit.floor_plan_image">
                                    <p class="mt-1 text-xs text-gray-500">Existing floor plan image will be replaced if new one is uploaded</p>
                                </template>
                            @endif
                        </div>
                    </div>
                </div>
            </template>

            <div x-show="units.length === 0" class="text-center py-8 text-sm text-gray-500">
                No units added yet. Click "Add Unit" to add BHK types.
            </div>
        </div>

        {{-- Amenities Tab --}}
        <div x-show="activeTab === 'amenities'" x-cloak class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
            <div class="flex items-center space-x-2 mb-6">
                <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
                <h3 class="text-lg font-semibold text-gray-900 font-tenor">Amenities</h3>
            </div>
            
            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Select Amenities</span>
                </label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-96 overflow-y-auto p-4 bg-white rounded-xl border border-gray-200">
                    @foreach($amenities as $amenity)
                        <label class="flex items-center space-x-2 p-3 rounded-lg border-2 cursor-pointer transition-all hover:border-gray-300 hover:shadow-md {{ in_array($amenity->id, old('amenities', $property ? $property->amenities->pluck('id')->toArray() : [])) ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 bg-white' }}">
                            <input
                                type="checkbox"
                                name="amenities[]"
                                value="{{ $amenity->id }}"
                                {{ in_array($amenity->id, old('amenities', $property ? $property->amenities->pluck('id')->toArray() : [])) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                            <span class="text-sm font-medium text-gray-900">{{ $amenity->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('amenities.*')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Gallery Tab --}}
        <div x-show="activeTab === 'gallery'" x-cloak class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-2">
                    <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
                    <h3 class="text-lg font-semibold text-gray-900 font-tenor">Gallery Images</h3>
                </div>
                <button
                    type="button"
                    @click="addGalleryItem()"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold text-white bg-gray-900 rounded-lg hover:bg-black transition">
                    + Add Image
                </button>
            </div>
            
            <template x-for="(item, index) in gallery" :key="index">
                <div class="mb-4 p-4 bg-white rounded-xl border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-sm font-semibold text-gray-900">Image <span x-text="index + 1"></span></h4>
                        <button
                            type="button"
                            @click="removeGalleryItem(index)"
                            class="text-red-600 hover:text-red-700 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="hidden" :name="`gallery[${index}][id]`" :value="item.id || ''" />
                        
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-700">Image Type <span class="text-red-500">*</span></label>
                            <select
                                :name="`gallery[${index}][type]`"
                                x-model="item.type"
                                required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                                <option value="interior">Interior</option>
                                <option value="exterior">Exterior</option>
                                <option value="amenities">Amenities</option>
                                <option value="floorplan">Floor Plan</option>
                                <option value="masterplan">Master Plan</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-700">Image <span class="text-red-500">*</span></label>
                            <input
                                type="file"
                                :name="`gallery[${index}][image]`"
                                accept="image/png,image/jpeg,image/jpg,image/gif,image/webp"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent" />
                            @if($property && isset($item['id']))
                                <p class="mt-1 text-xs text-gray-500">Leave empty to keep existing image</p>
                            @endif
                        </div>
                    </div>
                </div>
            </template>

            <div x-show="gallery.length === 0" class="text-center py-8 text-sm text-gray-500">
                No gallery images added yet. Click "Add Image" to add images.
            </div>
        </div>

        {{-- Specifications Tab --}}
        <div x-show="activeTab === 'specs'" x-cloak class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-2">
                    <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
                    <h3 class="text-lg font-semibold text-gray-900 font-tenor">Specifications</h3>
                </div>
                <button
                    type="button"
                    @click="addSpecification()"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold text-white bg-gray-900 rounded-lg hover:bg-black transition">
                    + Add Specification
                </button>
            </div>
            
            <template x-for="(spec, index) in specifications" :key="index">
                <div class="mb-4 p-4 bg-white rounded-xl border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-sm font-semibold text-gray-900">Specification <span x-text="index + 1"></span></h4>
                        <button
                            type="button"
                            @click="removeSpecification(index)"
                            class="text-red-600 hover:text-red-700 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="space-y-4">
                        <input type="hidden" :name="`specifications[${index}][id]`" :value="spec.id || ''" />
                        
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-700">Section <span class="text-red-500">*</span></label>
                            <input
                                type="text"
                                :name="`specifications[${index}][section]`"
                                x-model="spec.section"
                                required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                                placeholder="e.g., Flooring, Doors & Windows" />
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-700">Description <span class="text-red-500">*</span></label>
                            <textarea
                                :name="`specifications[${index}][description]`"
                                x-model="spec.description"
                                rows="4"
                                required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent resize-none"
                                placeholder="Specification details..."></textarea>
                        </div>
                    </div>
                </div>
            </template>

            <div x-show="specifications.length === 0" class="text-center py-8 text-sm text-gray-500">
                No specifications added yet. Click "Add Specification" to add one.
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
        <a
            href="{{ route('admin.properties.index') }}"
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

