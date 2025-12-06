@php
    use Illuminate\Support\Str;

    $categoryParam = $activeCategory ?? null;
@endphp

<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        pageTitle="Insights & Blogs"
        contentTitle="Ideas, Guides, and Perspectives"
        description="Stay informed with insights on home construction, design trends, and practical tips from the Atha Construction team."
        backgroundImage="images/blog-header-image.jpg"
        alt="Building Contractors in Bangalore"
        title="Building Contractors in Bangalore"
    />

    {{-- Blogs Section --}}
    <section class="py-12 lg:py-16" id="next-section">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-8 lg:mb-10">
                <div class="text-left max-w-xl">
                    <h2 class="font-tenor text-3xl lg:text-4xl uppercase mb-3">Insights & Updates</h2>
                    <p class="text-gray-600">
                        Explore expert guides, project case studies, and practical construction tips curated by the Atha team.
                    </p>
                </div>

                {{-- Search --}}
                <form method="GET" action="{{ route('blogs') }}" class="w-full lg:w-80 flex items-center gap-2">
                    @if($categoryParam)
                        <input type="hidden" name="category" value="{{ $categoryParam }}">
                    @endif
                    <div class="relative flex-1">
                        <input
                            type="text"
                            name="q"
                            value="{{ $search ?? '' }}"
                            placeholder="Search blogs by title or topic..."
                            class="w-full border border-gray-300 bg-white pl-10 pr-10 py-2.5 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 transition-colors" />
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 110-15 7.5 7.5 0 010 15z" />
                            </svg>
                        </span>
                        @if(!empty($search))
                            <button
                                type="button"
                                onclick="this.form.q.value=''; this.form.submit();"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-700 text-xs">
                                ✕
                            </button>
                        @endif
                    </div>
                    <button
                        type="submit"
                        class="hidden lg:inline-flex items-center px-4 py-2 text-xs font-semibold uppercase tracking-[0.16em] bg-black text-white hover:bg-gray-800 transition-colors">
                        Search
                    </button>
                </form>
            </div>

            {{-- Category filter bar --}}
            <div class="mb-8 flex flex-wrap items-center gap-2 lg:gap-3">
                @php
                    $baseUrl = route('blogs');
                @endphp
                <a
                    href="{{ $baseUrl }}"
                    class="inline-flex items-center px-3.5 py-1.5 border text-xs font-semibold tracking-wide uppercase transition-colors
                        {{ $categoryParam ? 'border-gray-300 text-gray-600 hover:border-black hover:text-black' : 'border-black bg-black text-white' }}">
                    All
                </a>
                @foreach($categories ?? [] as $category)
                    @php
                        $isActive = $categoryParam === $category->slug;
                    @endphp
                    <a
                        href="{{ $baseUrl . '?category=' . urlencode($category->slug) }}"
                        class="inline-flex items-center px-3.5 py-1.5 border text-xs font-semibold tracking-wide uppercase transition-colors
                            {{ $isActive ? 'border-black bg-black text-white' : 'border-gray-300 text-gray-600 hover:border-black hover:text-black' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            
            {{-- Blog cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @forelse($blogs as $blog)
                    @php
                        $contentPreview = $blog->excerpt ?: Str::limit(strip_tags($blog->content ?? ''), 180);
                        $wordCount = str_word_count(strip_tags($blog->content ?? ''));
                        $readMinutes = max(1, (int) ceil($wordCount / 200));
                    @endphp
                    <article class="mb-6 lg:mb-10 bg-white hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col">
                        <div class="relative overflow-hidden">
                            <img 
                                src="{{ $blog->cover_image_url ?? asset('images/blog-1.png') }}" 
                                alt="{{ $blog->title }}"
                                class="w-full h-64 lg:h-80 object-cover"
                            >
                            @if($blog->category)
                                <span class="absolute bottom-3 left-3 inline-flex items-center px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide bg-black/30 backdrop-blur-md border border-white/20 text-white">
                                    {{ $blog->category->name }}
                                </span>
                            @endif
                        </div>
                        <div class="bg-gray-50 px-5 pt-4 pb-5 flex flex-col">
                            <div class="flex items-center justify-between text-[11px] uppercase tracking-wide text-gray-500 mb-2">
                                <span>
                                    {{ $blog->published_at?->format('d M Y') ?? $blog->created_at?->format('d M Y') }}
                                    @if($blog->author)
                                        • {{ $blog->author }}
                                    @endif
                                </span>
                                <span class="text-gray-500">{{ $readMinutes }} min read</span>
                            </div>
                            <h3 class="font-tenor text-lg lg:text-xl mb-2.5 line-clamp-2">
                                {{ $blog->title }}
                            </h3>
                            <p class="text-sm lg:text-[15px] text-gray-700 mb-3 line-clamp-3">
                                {{ $contentPreview }}
                            </p>

                            @if($blog->tags && $blog->tags->isNotEmpty())
                                <div class="flex flex-wrap gap-1.5 mb-3">
                                    @foreach($blog->tags->take(3) as $tag)
                                        <span class="inline-flex items-center px-2 py-0.5 bg-gray-100 text-[11px] font-medium text-gray-700">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                    @if($blog->tags->count() > 3)
                                        <span class="text-[11px] text-gray-400">+{{ $blog->tags->count() - 3 }} more</span>
                                    @endif
                                </div>
                            @endif

                            <a href="{{ route('blog.detail', $blog->slug) }}" class="inline-flex items-center w-max border border-black px-5 py-2 text-xs font-semibold uppercase tracking-[0.18em] hover:bg-black hover:text-white transition-colors duration-300">
                                Read More
                                <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center text-sm text-slate-500">
                        No blog posts found.
                    </div>
                @endforelse
            </div>

            <div class="mt-8 flex flex-col items-center gap-3">
                {{ $blogs->onEachSide(1)->links() }}
                @if($blogs->total() > 0)
                    <p class="text-xs text-gray-500">
                        Showing
                        <span class="font-semibold">{{ $blogs->firstItem() }}–{{ $blogs->lastItem() }}</span>
                        of
                        <span class="font-semibold">{{ $blogs->total() }}</span>
                        articles
                        @if(!empty($search))
                            for “{{ $search }}”
                        @endif
                    </p>
                @endif
            </div>
        </div>
    </section>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-layouts>
