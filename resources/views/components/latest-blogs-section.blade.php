@props([
    'title' => 'Latest Insights',
    'blogs' => [],
])

@php
    use Illuminate\Support\Str;
@endphp

<section class="latest-blogs-section py-12 lg:py-16 bg-white relative overflow-hidden"
         x-data="{ visible: false }"
         x-intersect="visible = true">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 blogs-bg-pattern"></div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-8 lg:mb-10">
            {{-- Top Decoration --}}
            <div class="blogs-top-decoration opacity-0 mb-4"
                 :class="{ 'animate-fade-in-down': visible }" 
                 style="animation-delay: 0.2s;">
                <div class="blogs-decoration-line"></div>
            </div>

            <h2 class="font-tenor text-xl lg:text-2xl uppercase mb-2 tracking-tight blogs-section-title opacity-0"
                :class="{ 'animate-fade-in-up': visible }" 
                style="animation-delay: 0.3s;">
                {{ $title }}
            </h2>
            
            <div class="w-20 h-0.5 bg-black mx-auto blogs-divider opacity-0"
                 :class="{ 'animate-fade-in-up': visible }" 
                 style="animation-delay: 0.4s;"></div>
        </div>

        {{-- Blog Cards Grid --}}
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-6">
                @forelse($blogs as $index => $blog)
                    @php
                        $contentPreview = $blog->excerpt ?? Str::limit(strip_tags($blog->content ?? ''), 120);
                        $wordCount = str_word_count(strip_tags($blog->content ?? ''));
                        $readMinutes = max(1, (int) ceil($wordCount / 200));
                        $publishedDate = $blog->published_at ?? $blog->created_at;
                    @endphp
                    <article class="blog-card-wrapper opacity-0"
                             :class="{ 'animate-fade-in-up': visible }"
                             style="animation-delay: {{ 0.5 + ($index * 0.1) }}s;">
                        <a href="{{ route('blog.detail', $blog->slug) }}" class="blog-card group block">
                            {{-- Image --}}
                            <div class="blog-image-wrapper mb-4">
                                <div class="relative overflow-hidden bg-black h-48 lg:h-52 shadow-md">
                                    @if($blog->cover_image)
                                        <img 
                                            src="{{ $blog->cover_image_url }}" 
                                            alt="{{ $blog->title }}"
                                            class="w-full h-full object-cover blog-image"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent blog-image-overlay"></div>
                                    
                                    {{-- Category Badge --}}
                                    @if($blog->category)
                                        <div class="absolute top-3 left-3">
                                            <span class="blog-category-badge">{{ $blog->category->name }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="blog-content px-2 p-2">
                                {{-- Date & Read Time --}}
                                <div class="flex items-center gap-3 text-xs text-gray-400 mb-3 blog-meta">
                                    @if($publishedDate)
                                        <span>{{ $publishedDate->format('M d, Y') }}</span>
                                    @endif
                                    <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                                    <span>{{ $readMinutes }} min read</span>
                                </div>

                                {{-- Title --}}
                                <h3 class="font-tenor text-lg lg:text-xl uppercase mb-2 tracking-tight blog-title line-clamp-2">
                                    {{ $blog->title }}
                                </h3>

                                {{-- Title Accent --}}
                                <div class="w-12 h-0.5 bg-black mb-3 blog-title-accent"></div>

                                {{-- Excerpt --}}
                                <p class="text-xs text-gray-600 leading-relaxed mb-4 blog-excerpt line-clamp-2">
                                    {{ $contentPreview }}
                                </p>

                                {{-- Read More --}}
                                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-black blog-read-more">
                                    <span>Read More</span>
                                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-400 text-sm">No blogs available at the moment.</p>
                    </div>
                @endforelse
            </div>

            {{-- View All Link --}}
            @if(count($blogs) > 0)
                <div class="text-center mt-8 lg:mt-10 opacity-0"
                     :class="{ 'animate-fade-in-up': visible }"
                     style="animation-delay: {{ 0.5 + (count($blogs) * 0.1) + 0.2 }}s;">
                    <a href="{{ route('blogs') }}" class="blog-view-all-link">
                        <span>View All Blogs</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>

@once
<style>
    /* Latest Blogs Section Styles */
    .latest-blogs-section {
        position: relative;
        background: #fafafa;
    }

    /* Background Pattern */
    .blogs-bg-pattern {
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(0, 0, 0, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
        background-size: 400px 400px;
    }

    /* Top Decoration */
    .blogs-top-decoration {
        display: flex;
        justify-content: center;
    }

    .blogs-decoration-line {
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.3), transparent);
    }

    /* Section Title */
    .blogs-section-title {
        color: #1a1a1a;
        letter-spacing: 0.02em;
    }

    /* Divider */
    .blogs-divider {
        transition: width 0.4s ease;
    }

    .latest-blogs-section:hover .blogs-divider {
        width: 100px;
    }

    /* Blog Card */
    .blog-card {
        transition: all 0.4s ease;
        text-decoration: none;
        display: block;
        height: 100%;
    }

    .blog-card:hover {
        transform: translateY(-4px);
    }

    /* Image Wrapper */
    .blog-image-wrapper {
        position: relative;
    }

    .blog-image {
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .blog-card:hover .blog-image {
        transform: scale(1.05);
    }

    .blog-image-overlay {
        transition: opacity 0.4s ease;
    }

    .blog-card:hover .blog-image-overlay {
        opacity: 0.7;
    }

    /* Category Badge */
    .blog-category-badge {
        display: inline-block;
        padding: 0.3rem 0.75rem;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-radius: 12px;
        backdrop-filter: blur(4px);
    }

    /* Blog Content */
    .blog-content {
        padding: 0;
    }

    /* Title */
    .blog-title {
        color: #1a1a1a;
        transition: color 0.3s ease;
        line-height: 1.3;
    }

    .blog-card:hover .blog-title {
        color: #000;
    }

    /* Title Accent */
    .blog-title-accent {
        transition: width 0.4s ease;
    }

    .blog-card:hover .blog-title-accent {
        width: 60px;
    }

    /* Excerpt */
    .blog-excerpt {
        transition: color 0.3s ease;
    }

    .blog-card:hover .blog-excerpt {
        color: #4a4a4a;
    }

    /* Read More */
    .blog-read-more {
        transition: all 0.3s ease;
    }

    .blog-card:hover .blog-read-more {
        color: #000;
    }

    /* View All Link */
    .blog-view-all-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 2rem;
        border: 2px solid #1a1a1a;
        color: #1a1a1a;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .blog-view-all-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: #1a1a1a;
        transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 0;
    }

    .blog-view-all-link:hover::before {
        left: 0;
    }

    .blog-view-all-link span,
    .blog-view-all-link svg {
        position: relative;
        z-index: 1;
        transition: color 0.4s ease;
    }

    .blog-view-all-link:hover span,
    .blog-view-all-link:hover svg {
        color: white;
    }

    /* Line Clamp Utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-down {
        animation: fadeInDown 0.6s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    /* Responsive */
    @media (max-width: 1023px) {
        .blog-image-wrapper {
            height: 200px;
        }

        .blog-image-wrapper .bg-black {
            height: 200px;
        }
    }
</style>
@endonce

