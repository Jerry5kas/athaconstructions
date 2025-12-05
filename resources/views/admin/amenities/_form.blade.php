@php
    /**
     * @var \App\Models\Amenity|null $amenity
     */
@endphp

@csrf

<div
    x-data="{
        isActive: {{ old('is_active', $amenity->is_active ?? true) ? 'true' : 'false' }}
    }"
    class="space-y-8">
    
    <div class="form-section bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-1 h-6 bg-gradient-to-b from-gray-900 to-gray-700 rounded-full"></div>
            <h3 class="text-lg font-semibold text-gray-900 font-tenor">Amenity Information</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2 md:col-span-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Name <span class="text-red-500">*</span></span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $amenity->name ?? '') }}"
                    required
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="Amenity name (e.g., Swimming Pool, Gym)" />
                @error('name')
                    <p class="mt-1 text-xs text-red-600 flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Icon</span>
                </label>
                <input
                    type="text"
                    name="icon"
                    value="{{ old('icon', $amenity->icon ?? '') }}"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm hover:shadow-md"
                    placeholder="Icon class or image path" />
                <p class="mt-1 text-xs text-gray-500">Optional: Icon class name or image path</p>
                @error('icon')
                    <p class="mt-1 text-xs text-red-600 flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                    <span>Sort Order</span>
                </label>
                <input
                    type="number"
                    name="sort_order"
                    value="{{ old('sort_order', $amenity->sort_order ?? 0) }}"
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
                        @if(old('is_active', $amenity->is_active ?? true)) checked @endif
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
                    <p class="text-xs text-gray-500 mt-0.5">Show this amenity</p>
                </div>
            </label>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
        <a
            href="{{ route('admin.amenities.index') }}"
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

