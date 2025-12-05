@extends('layouts.admin')

@section('title', 'Common')
@section('page-title', 'Common')

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
                    <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Common</h6>
                    <p class="mb-0 text-sm text-slate-500">Manage shared media (images/videos) and common items.</p>
                </div>
                <a
                    href="{{ route('admin.categories.create') }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-wide text-white uppercase bg-gray-900 rounded-lg shadow-sm hover:bg-black hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-1 transition">
                    + Add Category
                </a>
            </div>

            <div class="flex-auto px-0 pt-6 pb-2">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-slate-700">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Media
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Context Type
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Media Type
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    URL
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Order
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Updated
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($categories as $category)
                                <tr class="transition hover:bg-slate-50/80">
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="flex items-center px-2">
                                            @if ($category->media_path)
                                                @if($category->media_type === 'video')
                                                    <div class="relative w-16 h-16 overflow-hidden rounded-lg shadow-sm bg-slate-100 flex-shrink-0">
                                                        <video
                                                            src="{{ $category->media_url }}"
                                                            class="w-full h-full object-cover"
                                                            preload="metadata"
                                                            muted>
                                                        </video>
                                                        <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M8 5v14l11-7z"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                @elseif(in_array($category->media_type, ['pdf', 'document', 'spreadsheet', 'presentation', 'other']))
                                                    <div class="relative w-16 h-16 overflow-hidden rounded-lg shadow-sm bg-slate-100 flex-shrink-0 flex items-center justify-center">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                @else
                                                <div class="relative w-16 h-16 overflow-hidden rounded-lg shadow-sm bg-slate-100 flex-shrink-0">
                                                    @if ($category->media_type === 'svg')
                                                        <img
                                                            src="{{ $category->media_url }}"
                                                            alt="{{ $category->name }}"
                                                            class="object-contain w-full h-full p-1" />
                                                    @else
                                                        <img
                                                            src="{{ $category->media_url }}"
                                                            alt="{{ $category->name }}"
                                                            class="object-cover w-full h-full" />
                                                    @endif
                                                </div>
                                                @endif
                                            @else
                                                <div class="flex items-center justify-center w-16 h-16 rounded-lg border border-dashed border-slate-200 text-slate-300 text-xs">
                                                    No Media
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="flex flex-col px-2 py-1">
                                            <h6 class="mb-0 text-sm leading-normal font-semibold">
                                                {{ $category->name }}
                                            </h6>
                                            @if ($category->slug)
                                                <p class="mb-0 text-xs text-slate-400">
                                                    {{ $category->slug }}
                                                </p>
                                            @endif
                                        </div>
                                    </td>
                                    {{-- Context Type --}}
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="px-2">
                                            @if ($category->type)
                                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold leading-tight uppercase tracking-wide text-slate-800 rounded-full bg-slate-100">
                                                    {{ $category->type }}
                                                </span>
                                            @else
                                                <span class="text-xs text-slate-400">—</span>
                                            @endif
                                        </div>
                                    </td>
                                    {{-- Media Type --}}
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="px-2">
                                            @if ($category->media_type)
                                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold leading-tight uppercase tracking-wide text-slate-500 rounded-full bg-slate-50">
                                                    {{ $category->media_type }}
                                                </span>
                                            @else
                                                <span class="text-xs text-slate-400">—</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent">
                                        @if ($category->media_path)
                                            <div class="px-2 flex items-center gap-2 max-w-xs">
                                                <a href="{{ $category->media_path }}" target="_blank" class="text-xs text-indigo-600 hover:underline truncate">
                                                    {{ $category->media_path }}
                                                </a>
                                                <button
                                                    type="button"
                                                    class="js-copy-url inline-flex items-center justify-center w-6 h-6 rounded-full border border-slate-200 text-slate-400 hover:text-gray-900 hover:border-gray-400 text-[10px]"
                                                    data-url="{{ $category->media_path }}"
                                                    title="Copy URL">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400 px-2">—</span>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent whitespace-nowrap">
                                        <span class="text-xs font-semibold leading-tight">
                                            {{ $category->sort_order }}
                                        </span>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        @if ($category->is_active)
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-emerald-700 bg-emerald-50 rounded-full ring-1 ring-emerald-100">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-slate-600 bg-slate-100 rounded-full ring-1 ring-slate-200">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent whitespace-nowrap">
                                        <span class="text-xs font-semibold leading-tight">
                                            {{ $category->updated_at?->format('d M Y, H:i') }}
                                        </span>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap text-center">
                                        <div class="inline-flex items-center justify-center gap-2">
                                            <a
                                                href="{{ route('admin.categories.edit', $category) }}"
                                                class="inline-flex items-center justify-center text-slate-400 hover:text-gray-900 hover:scale-110 transition"
                                                title="Edit category">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-3.5 h-3.5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 20h9" />
                                                    <path
                                                        d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                                                </svg>
                                                <span class="sr-only">Edit</span>
                                            </a>
                                            <form
                                                method="POST"
                                                action="{{ route('admin.categories.destroy', $category) }}"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center text-slate-400 hover:text-red-600 hover:scale-110 transition"
                                                    title="Delete category">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="w-3.5 h-3.5"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6" />
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    </svg>
                                                    <span class="sr-only">Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-4 text-center text-sm text-slate-500">
                                        No categories found. Click "Add Category" to create one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.js-copy-url').forEach(button => {
            button.addEventListener('click', async () => {
                const url = button.getAttribute('data-url');
                if (!url) return;

                try {
                    await navigator.clipboard.writeText(url);
                    button.classList.add('bg-emerald-50', 'border-emerald-300', 'text-emerald-700');
                    setTimeout(() => {
                        button.classList.remove('bg-emerald-50', 'border-emerald-300', 'text-emerald-700');
                    }, 1200);
                } catch (e) {
                    console.error('Clipboard copy failed', e);
                }
            });
        });
    });
</script>
@endpush

