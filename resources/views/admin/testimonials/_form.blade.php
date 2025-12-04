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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div>
            <label class="block text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 mb-2">
                Title
            </label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $testimonial->title ?? '') }}"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                required
            >
        </div>

        <div>
            <label class="block text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 mb-2">
                Review Text
            </label>
            <textarea
                name="review_text"
                rows="6"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                required>{{ old('review_text', $testimonial->review_text ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 mb-2">
                    Rating (1–5)
                </label>
                <input
                    type="number"
                    name="rating"
                    min="1"
                    max="5"
                    value="{{ old('rating', $testimonial->rating ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                >
            </div>
            <div>
                <label class="block text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 mb-2">
                    Status
                </label>
                <select
                    name="status"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                    required
                >
                    @php
                        $status = old('status', $testimonial->status ?? 'published');
                    @endphp
                    <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $status === 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 mb-2">
                    Published At
                </label>
                <input
                    type="datetime-local"
                    name="published_at"
                    value="{{ old('published_at', isset($testimonial->published_at) ? $testimonial->published_at->format('Y-m-d\TH:i') : '') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                >
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div>
            <label class="block text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 mb-2">
                Slug (optional)
            </label>
            <input
                type="text"
                name="slug"
                value="{{ old('slug', $testimonial->slug ?? '') }}"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                placeholder="auto-generated from title if empty"
            >
        </div>

        <div class="border border-slate-200 rounded-2xl p-4 space-y-4">
            <p class="text-xs font-semibold tracking-[0.18em] uppercase text-slate-500">Client Info</p>
            <div>
                <label class="block text-[11px] font-medium text-slate-600 mb-1">
                    Client Name
                </label>
                <input
                    type="text"
                    name="client_name"
                    value="{{ old('client_name', $testimonial->client_name ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                    required
                >
            </div>
            <div>
                <label class="block text-[11px] font-medium text-slate-600 mb-1">
                    Client Role
                </label>
                <input
                    type="text"
                    name="client_role"
                    value="{{ old('client_role', $testimonial->client_role ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                    placeholder="e.g. Homeowner"
                >
            </div>
            <div>
                <label class="block text-[11px] font-medium text-slate-600 mb-1">
                    Client Company
                </label>
                <input
                    type="text"
                    name="client_company"
                    value="{{ old('client_company', $testimonial->client_company ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                >
            </div>
            <div>
                <label class="block text-[11px] font-medium text-slate-600 mb-1">
                    Client Avatar URL
                </label>
                <input
                    type="text"
                    name="client_avatar"
                    value="{{ old('client_avatar', $testimonial->client_avatar ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                    placeholder="Image URL or ImageKit URL"
                >
            </div>
        </div>

        <div class="border border-slate-200 rounded-2xl p-4 space-y-4">
            <p class="text-xs font-semibold tracking-[0.18em] uppercase text-slate-500">Project Info</p>
            <div>
                <label class="block text-[11px] font-medium text-slate-600 mb-1">
                    Project Name
                </label>
                <input
                    type="text"
                    name="project_name"
                    value="{{ old('project_name', $testimonial->project_name ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                >
            </div>
            <div>
                <label class="block text-[11px] font-medium text-slate-600 mb-1">
                    Project Location
                </label>
                <input
                    type="text"
                    name="project_location"
                    value="{{ old('project_location', $testimonial->project_location ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                    placeholder="e.g. Bangalore, Mysore"
                >
            </div>
            <div>
                <label class="block text-[11px] font-medium text-slate-600 mb-1">
                    Project Type
                </label>
                <input
                    type="text"
                    name="project_type"
                    value="{{ old('project_type', $testimonial->project_type ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                    placeholder="e.g. Villa Construction, Renovation"
                >
            </div>
            <div class="flex items-center gap-3 pt-2">
                <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                    <input
                        type="checkbox"
                        name="featured"
                        value="1"
                        class="rounded border-gray-300 text-gray-900 focus:ring-gray-900"
                        {{ old('featured', $testimonial->featured ?? false) ? 'checked' : '' }}
                    >
                    <span>Mark as featured</span>
                </label>
            </div>
        </div>
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-3 border-t border-slate-200 pt-4">
    <a
        href="{{ route('admin.testimonials.index') }}"
        class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition">
        Cancel
    </a>
    <button
        type="submit"
        class="px-6 py-2.5 text-sm font-semibold tracking-wide text-white uppercase bg-gray-900 rounded-lg shadow-sm hover:bg-black hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-1 transition">
        {{ $submitLabel ?? 'Save Testimonial' }}
    </button>
</div>


