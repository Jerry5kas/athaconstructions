<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Blog Detail Section --}}
    <section class="py-8 lg:py-12">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid lg:grid-cols-12 gap-6">
                {{-- Main Content --}}
                <div class="lg:col-span-9">
                    <div class="max-w-4xl">
                        <div class="mb-6">
                            <img 
                                src="{{ $blog->cover_image_url ?? asset('images/blog-1.png') }}" 
                                alt="{{ $blog->title }}" 
                                class="w-full h-auto object-cover"
                                style="max-height: 650px;"
                            >
                        </div>
                        @php
                            $wordCount = str_word_count(strip_tags($blog->content ?? ''));
                            $readMinutes = max(1, (int) ceil($wordCount / 200));
                        @endphp
                        <div class="mb-4">
                            <h1 class="blog-title font-tenor text-2xl lg:text-3xl text-black mb-3">
                                {{ $blog->title }}
                            </h1>
                            <div class="flex flex-wrap items-center gap-2 text-xs text-gray-500 mt-1">
                                @if($blog->published_at)
                                    <span>{{ $blog->published_at->format('d M Y') }}</span>
                                @endif
                                @if($blog->author)
                                    <span>• By {{ $blog->author }}</span>
                                @endif
                                <span>• {{ $readMinutes }} min read</span>
                            </div>

                            <div class="mt-3 flex flex-wrap items-center gap-2">
                                @if($blog->category)
                                    <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide bg-black text-white">
                                        {{ $blog->category->name }}
                                    </span>
                                @endif

                                @if($blog->tags && $blog->tags->isNotEmpty())
                                    @foreach($blog->tags as $tag)
                                        <span class="inline-flex items-center px-2 py-0.5 bg-gray-100 text-[11px] font-medium text-gray-700">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>

                            @if($blog->excerpt)
                                <p class="mt-4 text-base text-gray-700 leading-relaxed">
                                    {{ $blog->excerpt }}
                                </p>
                            @endif
                        </div>
                        <div class="blog-content max-w-none text-black">
                            {!! $blog->content !!}
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-3">
                    <div class="bg-gray-50 p-4 lg:p-6">
                        <h4 class="font-tenor text-lg lg:text-xl uppercase mb-6">Latest Posts</h4>
                        
                        <div class="space-y-6">
                            @foreach($recentBlogs as $recent)
                                <div class="mb-6">
                                    <a href="{{ route('blog.detail', $recent->slug) }}" class="block group">
                                        <div class="mb-3">
                                            <img 
                                                src="{{ $recent->cover_image_url ?? asset('images/blog-1.png') }}" 
                                                alt="{{ $recent->title }}" 
                                                class="w-full h-40 object-cover group-hover:opacity-90 transition-opacity"
                                            >
                                        </div>
                                        <div>
                                            <h5 class="font-tenor text-base lg:text-lg mb-2 group-hover:text-black transition-colors">
                                                {{ $recent->title }}
                                            </h5>
                                            <span class="text-sm text-gray-600">
                                                <i class="far fa-clock mr-1"></i>
                                                {{ ($recent->published_at ?? $recent->created_at)->format('M j, Y') }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .blog-title {
            font-weight: 500;
            letter-spacing: 0.01em;
        }

        .blog-content {
            font-family: "Montserrat", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 0.98rem;
            line-height: 1.9;
        }

        .blog-content p {
            margin-bottom: 0.95rem;
        }

        .blog-content h1,
        .blog-content h2,
        .blog-content h3,
        .blog-content h4 {
            font-family: "Tenor Sans", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            letter-spacing: 0.03em;
        }

        .blog-content h2 {
            font-size: 1.5rem;
            font-weight: 500;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .blog-content h3 {
            font-size: 1.25rem;
            font-weight: 500;
            margin-top: 1.6rem;
            margin-bottom: 0.9rem;
        }

        .blog-content h4 {
            font-size: 1.05rem;
            font-weight: 500;
            margin-top: 1.3rem;
            margin-bottom: 0.7rem;
        }

        .blog-content ul,
        .blog-content ol {
            margin: 0.9rem 0 0.9rem 1.5rem;
        }

        .blog-content ul {
            list-style-type: disc;
        }

        .blog-content ol {
            list-style-type: decimal;
        }

        .blog-content li {
            margin-bottom: 0.4rem;
        }

        .blog-content a {
            color: #0f766e;
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .blog-content strong {
            font-weight: 600;
        }

        .blog-content em {
            font-style: italic;
        }
    </style>
</x-layouts>

