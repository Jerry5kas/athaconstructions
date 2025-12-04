@extends('layouts.admin')

@section('title', 'Testimonial Media')
@section('page-title', 'Testimonial Media')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        @if (session('status'))
            <div class="mb-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md">
            <div class="flex items-center justify-between mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-6">
                <div>
                    <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Testimonial Media</h6>
                    <p class="mb-0 text-sm text-slate-500">Manage images and videos attached to testimonials.</p>
                </div>
                <a
                    href="{{ route('admin.testimonial-media.create') }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-wide text-white uppercase bg-gray-900 rounded-lg shadow-sm hover:bg-black hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-1 transition">
                    + Add Media
                </a>
            </div>

            <div class="flex-auto px-0 pt-6 pb-2">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-slate-700">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Testimonial
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Type
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    URL
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Order
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($media as $item)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="text-slate-900 font-medium">
                                            {{ $item->testimonial->client_name ?? '—' }}
                                        </div>
                                        <div class="text-xs text-slate-500">
                                            {{ $item->testimonial->project_name ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-semibold tracking-wide uppercase rounded-full
                                            {{ $item->media_type === 'image' ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'bg-purple-50 text-purple-700 border border-purple-100' }}">
                                            {{ ucfirst($item->media_type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 max-w-md">
                                        <a href="{{ $item->media_url }}" target="_blank" class="text-xs text-indigo-600 hover:underline break-all">
                                            {{ $item->media_url }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-center text-xs text-slate-600">
                                        {{ $item->sort_order }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a
                                                href="{{ route('admin.testimonial-media.edit', $item) }}"
                                                class="inline-flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:scale-110 transition"
                                                title="Edit media">
                                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"w-3.5 h-3.5\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                                    <path d=\"M12 20h9\" />
                                                    <path d=\"M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z\" />
                                                </svg>
                                                <span class=\"sr-only\">Edit</span>
                                            </a>
                                            <form
                                                method=\"POST\"
                                                action=\"{{ route('admin.testimonial-media.destroy', $item) }}\"
                                                class=\"inline\"
                                                onsubmit=\"return confirm('Are you sure you want to delete this media item?');\">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type=\"submit\"
                                                    class=\"inline-flex items-center justify-center text-slate-400 hover:text-red-600 hover:scale-110 transition\"
                                                    title=\"Delete media\">
                                                    <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"w-3.5 h-3.5\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                                        <polyline points=\"3 6 5 6 21 6\" />
                                                        <path d=\"M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2\" />
                                                    </svg>
                                                    <span class=\"sr-only\">Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan=\"5\" class=\"p-4 text-center text-sm text-slate-500\">
                                        No media items yet. Click \"Add Media\" to attach images or videos to testimonials.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class=\"mt-4\">
                        {{ $media->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


