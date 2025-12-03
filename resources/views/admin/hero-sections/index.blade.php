@extends('layouts.admin')

@section('title', 'Hero Section')
@section('page-title', 'Hero Section')

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
                    <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Home Hero Section</h6>
                    <p class="mb-0 text-sm text-slate-500">Manage the main hero banner for the home page.</p>
                </div>
                <a
                    href="{{ route('admin.hero-sections.create') }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-wide text-white uppercase bg-gray-900 rounded-lg shadow-sm hover:bg-black hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-1 transition">
                    + Add Hero
                </a>
            </div>

            <div class="flex-auto px-0 pt-6 pb-2">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-slate-700">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Title
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Media Type
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
                            @forelse ($heroSections as $hero)
                                <tr class="transition hover:bg-slate-50/80">
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="flex flex-col px-2 py-1">
                                            <h6 class="mb-0 text-sm leading-normal">
                                                {{ $hero->title ?: 'Untitled Hero' }}
                                            </h6>
                                            @if ($hero->subtitle)
                                                <p class="mb-0 text-xs text-slate-400">
                                                    {{ Str::limit($hero->subtitle, 60) }}
                                                </p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="flex items-center gap-3 px-2">
                                            @if ($hero->use_image && $hero->image_path)
                                                {{-- Image thumbnail --}}
                            <div class="relative w-28 h-16 overflow-hidden rounded-xl shadow-sm bg-slate-100">
                                                    <img
                                                        src="{{ asset('storage/' . $hero->image_path) }}"
                                                        alt="Hero image preview"
                                                        class="object-cover w-full h-full" />
                                                </div>
                                            @elseif ($hero->use_video && $hero->video_path)
                                                {{-- Video thumbnail-style preview --}}
                            <button
                                                    type="button"
                                                    class="group relative w-28 h-16 overflow-hidden rounded-xl shadow-sm bg-gradient-to-tr from-gray-900 via-slate-900 to-slate-700 cursor-pointer focus:outline-none js-hero-video-trigger"
                                                    data-video-src="{{ asset('storage/' . $hero->video_path) }}"
                                                    aria-label="Preview hero video">
                                                    {{-- subtle overlay --}}
                                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/10 opacity-80 group-hover:opacity-100 transition-opacity"></div>

                                                    {{-- play icon --}}
                                                    <div
                                                        class="relative flex items-center justify-center w-full h-full transition-transform duration-200 group-hover:scale-105">
                                                        <div
                                                            class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-slate-800 shadow-sm group-hover:shadow-md">
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="w-4 h-4 ml-0.5"
                                                                viewBox="0 0 24 24"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <polygon points="5 3 19 12 5 21 5 3" />
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    {{-- bottom label --}}
                                                    <div class="absolute inset-x-0 bottom-0 px-2 pb-1">
                                                        <span class="block text-[10px] font-semibold tracking-wide text-white/90">
                                                            Hero video
                                                        </span>
                                                    </div>
                                                </button>
                                            @else
                                                <div
                                                    class="flex items-center justify-center w-9 h-9 rounded-lg border border-dashed border-slate-200 text-slate-300 text-xs">
                                                    —
                                                </div>
                                            @endif

                                            <!-- <div class="flex flex-col">
                                                @if ($hero->use_video && $hero->video_path)
                                                    <span class="inline-flex items-center px-2 py-0.5 mb-0.5 text-[10px] font-semibold leading-tight uppercase tracking-wide text-white rounded-full bg-slate-800">
                                                        Video
                                                    </span>
                                                    <span class="text-xxs text-slate-400">
                                                        Plays as hero background
                                                    </span>
                                                @elseif ($hero->use_image && $hero->image_path)
                                                    <span class="inline-flex items-center px-2 py-0.5 mb-0.5 text-[10px] font-semibold leading-tight uppercase tracking-wide text-slate-800 rounded-full bg-slate-100">
                                                        Image
                                                    </span>
                                                    <span class="text-xxs text-slate-400">
                                                        Static hero banner image
                                                    </span>
                                                @else
                                                    <span class="text-xs text-slate-400">
                                                        Not configured
                                                    </span>
                                                @endif
                                            </div> -->
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        @if ($hero->is_active)
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
                                            {{ $hero->updated_at?->format('d M Y, H:i') }}
                                        </span>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap text-center">
                                        <div class="inline-flex items-center justify-center">
                                            <a
                                                href="{{ route('admin.hero-sections.edit', $hero) }}"
                                                class="inline-flex items-center justify-center text-slate-400 hover:text-gray-900 hover:scale-110 transition"
                                                title="Edit hero">
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
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-sm text-slate-500">
                                        No hero records found. Click “Add Hero” to create one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $heroSections->links() }}
                    </div>
                </div>

                {{-- Video preview modal --}}
            <div
                    id="hero-video-modal"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 hidden">
                    <div
                        class="relative w-full max-w-4xl mx-4 bg-white rounded-2xl shadow-2xl">
                        <button
                            type="button"
                            class="absolute top-3 right-3 inline-flex items-center justify-center w-8 h-8 rounded-full bg-white text-slate-700 shadow-sm hover:bg-gray-50 js-hero-video-close"
                            title="Close preview">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </button>

                        <div class="p-4 pb-5">
                            <div class="mb-3">
                                <h6 class="mb-1 text-sm font-semibold text-slate-800">
                                    Hero Video Preview
                                </h6>
                                <p class="text-xs text-slate-500">
                                    This is how the background video will appear in the hero section.
                                </p>
                            </div>
                            <div class="overflow-hidden rounded-xl bg-black/5">
                                <div class="relative w-full pb-[56.25%]">
                                    <video
                                        id="hero-video-player"
                                        class="absolute inset-0 w-full h-full rounded-xl"
                                        controls
                                        muted
                                        playsinline>
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('hero-video-modal');
        const player = document.getElementById('hero-video-player');
        if (!modal || !player) return;

        function openModal(src) {
            player.src = src;
            modal.classList.remove('hidden');
            // start playing once the source is set
            player.play().catch(() => {});
        }

        function closeModal() {
            modal.classList.add('hidden');
            player.pause();
            player.currentTime = 0;
            player.removeAttribute('src');
        }

        document.querySelectorAll('.js-hero-video-trigger').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const src = this.getAttribute('data-video-src');
                if (src) {
                    openModal(src);
                }
            });
        });

        modal.querySelectorAll('.js-hero-video-close').forEach(function (btn) {
            btn.addEventListener('click', closeModal);
        });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    });
</script>
@endpush
