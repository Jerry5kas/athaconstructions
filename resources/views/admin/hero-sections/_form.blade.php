@php
    /**
     * @var \App\Models\HeroSection|null $heroSection
     */
@endphp

@csrf
<div
    x-data="{
        imagePreview: null,
        videoPreview: null,
        useImage: {{ old('use_image', $heroSection->use_image ?? true) ? 'true' : 'false' }},
        useVideo: {{ old('use_video', $heroSection->use_video ?? false) ? 'true' : 'false' }},
    }"
    x-init="
        $watch('useVideo', value => { if (value) useImage = false });
        $watch('useImage', value => { if (value) useVideo = false });
    "
    class="flex flex-wrap -mx-3">
    <div class="w-full px-3 mb-4 md:w-6/12">
        <label class="mb-2 text-xs font-bold text-slate-700">Title</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $heroSection->title ?? '') }}"
            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
            placeholder="Hero headline" />
        @error('title')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full px-3 mb-4 md:w-6/12">
        <label class="mb-2 text-xs font-bold text-slate-700">Subtitle</label>
        <input
            type="text"
            name="subtitle"
            value="{{ old('subtitle', $heroSection->subtitle ?? '') }}"
            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
            placeholder="Short supporting line" />
        @error('subtitle')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full px-3 mb-4 md:w-6/12">
        <label class="mb-2 text-xs font-bold text-slate-700">Primary Button Text</label>
        <input
            type="text"
            name="primary_button_text"
            value="{{ old('primary_button_text', $heroSection->primary_button_text ?? '') }}"
            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
            placeholder="e.g., Quick Enquiry" />
        @error('primary_button_text')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full px-3 mb-4 md:w-6/12">
        <label class="mb-2 text-xs font-bold text-slate-700">Primary Button Link</label>
        <input
            type="text"
            name="primary_button_link"
            value="{{ old('primary_button_link', $heroSection->primary_button_link ?? '') }}"
            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
            placeholder="#enquiry-modal" />
        @error('primary_button_link')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full px-3 mb-4 md:w-6/12">
        <label class="mb-2 text-xs font-bold text-slate-700">Hero Image</label>
        <input
            type="file"
            name="image"
            accept="image/*"
            x-on:change="if ($event.target.files[0]) { imagePreview = URL.createObjectURL($event.target.files[0]); }"
            class="block w-full text-sm text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-gray-900 file:px-4 file:py-2 file:text-xs file:font-semibold file:uppercase file:tracking-wide file:text-white hover:file:bg-black" />
        <div class="mt-2 space-y-2">
            @if (!empty($heroSection?->image_path))
                <div class="flex items-center gap-3">
                    <div class="relative w-24 h-16 overflow-hidden rounded-xl shadow-sm bg-slate-100">
                        <img
                            src="{{ asset('storage/' . $heroSection->image_path) }}"
                            alt="Current hero image"
                            class="object-cover w-full h-full" />
                    </div>
                    <p class="text-xs text-slate-500">
                        Current image
                    </p>
                </div>
            @endif

            <template x-if="imagePreview">
                <div class="flex items-center gap-3">
                    <div class="relative w-24 h-16 overflow-hidden rounded-xl shadow-sm bg-slate-100">
                        <img
                            :src="imagePreview"
                            alt="Selected hero image preview"
                            class="object-cover w-full h-full" />
                    </div>
                    <p class="text-xs text-slate-500">
                        New image preview
                    </p>
                </div>
            </template>
        </div>
        @error('image')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full px-3 mb-4 md:w-6/12">
        <label class="mb-2 text-xs font-bold text-slate-700">Hero Video</label>
        <input
            type="file"
            name="video"
            accept="video/mp4,video/webm,video/ogg"
            x-on:change="if ($event.target.files[0]) { videoPreview = URL.createObjectURL($event.target.files[0]); }"
            class="block w-full text-sm text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-gray-900 file:px-4 file:py-2 file:text-xs file:font-semibold file:uppercase file:tracking-wide file:text-white hover:file:bg-black" />
        <div class="mt-2 space-y-2">
            @if (!empty($heroSection?->video_path))
                <p class="text-xs text-slate-500">
                    Current video: <span class="underline">{{ $heroSection->video_path }}</span>
                </p>
            @endif

            <template x-if="videoPreview">
                <div class="space-y-1">
                    <p class="text-xs text-slate-500">New video preview</p>
                    <video
                        class="w-full max-w-sm rounded-xl shadow-sm"
                        controls
                        autoplay
                        muted
                        playsinline
                        :src="videoPreview">
                    </video>
                </div>
            </template>
        </div>
        @error('video')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full px-3 mb-4 md:w-4/12">
        <label class="mb-2 text-xs font-bold text-slate-700">Use Image</label>
        <div class="min-h-6 mb-0.5 block">
            <input
                id="use_image"
                name="use_image"
                type="checkbox"
                value="1"
                x-model="useImage"
                class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900" />
            <label for="use_image" class="mb-0 ml-2 text-sm text-slate-700 cursor-pointer select-none">
                Show image as hero background
            </label>
        </div>
    </div>

    <div class="w-full px-3 mb-4 md:w-4/12">
        <label class="mb-2 text-xs font-bold text-slate-700">Use Video</label>
        <div class="min-h-6 mb-0.5 block">
            <input
                id="use_video"
                name="use_video"
                type="checkbox"
                value="1"
                x-model="useVideo"
                class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900" />
            <label for="use_video" class="mb-0 ml-2 text-sm text-slate-700 cursor-pointer select-none">
                Use video background instead of image
            </label>
        </div>
    </div>

    <div class="w-full px-3 mb-4 md:w-4/12">
        <label class="mb-2 text-xs font-bold text-slate-700">Active</label>
        <div class="min-h-6 mb-0.5 block">
            <input
                id="is_active"
                name="is_active"
                type="checkbox"
                value="1"
                {{ old('is_active', $heroSection->is_active ?? true) ? 'checked' : '' }}
                class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900" />
            <label for="is_active" class="mb-0 ml-2 text-sm text-slate-700 cursor-pointer select-none">
                Show this hero on the home page
            </label>
        </div>
    </div>
</div>

<div class="flex justify-end mt-6">
    <a
        href="{{ route('admin.hero-sections.index') }}"
        class="inline-flex items-center px-4 py-2 mr-3 text-xs font-semibold uppercase tracking-wide text-slate-700 border border-slate-300 rounded-lg hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-1">
        Cancel
    </a>
    <button
        type="submit"
        class="inline-flex items-center px-4 py-2 mb-0 text-xs font-semibold uppercase tracking-wide text-white bg-gray-900 rounded-lg shadow-sm hover:bg-black focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-1">
        {{ $submitLabel ?? 'Save' }}
    </button>
</div>
