@csrf

@if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-6">
    <div>
        <label class="block text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 mb-2">
            Testimonial
        </label>
        <select
            name="testimonial_id"
            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
            required
        >
            <option value="">Select testimonial</option>
            @foreach($testimonials as $t)
                <option
                    value="{{ $t->id }}"
                    @selected(old('testimonial_id', $media->testimonial_id ?? null) == $t->id)
                >
                    {{ $t->client_name }} — {{ $t->project_name ?? 'Project' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 mb-2">
                Media Type
            </label>
            @php
                $type = old('media_type', $media->media_type ?? 'image');
            @endphp
            <select
                name="media_type"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                required
            >
                <option value="image" {{ $type === 'image' ? 'selected' : '' }}>Image</option>
                <option value="video" {{ $type === 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 mb-2">
                Media URL
            </label>
            <input
                type="text"
                name="media_url"
                value="{{ old('media_url', $media->media_url ?? '') }}"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                placeholder="ImageKit URL, YouTube/Vimeo URL, etc."
                required
            >
        </div>
    </div>

    <div>
        <label class="block text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 mb-2">
            Sort Order
        </label>
        <input
            type="number"
            name="sort_order"
            value="{{ old('sort_order', $media->sort_order ?? 0) }}"
            class="w-full max-w-xs rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
            min="0"
        >
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-3 border-t border-slate-200 pt-4">
    <a
        href="{{ route('admin.testimonial-media.index') }}"
        class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition">
        Cancel
    </a>
    <button
        type="submit"
        class="px-6 py-2.5 text-sm font-semibold tracking-wide text-white uppercase bg-gray-900 rounded-lg shadow-sm hover:bg-black hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-1 transition">
        {{ $submitLabel ?? 'Save Media' }}
    </button>
</div>


