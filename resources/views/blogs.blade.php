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
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 lg:mb-12">
                <h2 class="font-tenor text-3xl lg:text-4xl uppercase mb-4">Latest News</h2>
                <p class="text-center text-gray-600">See what the press has to say.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 max-w-7xl mx-auto">
                @foreach($blogPosts as $post)
                    <div class="mb-8 lg:mb-12">
                        <a href="{{ route('blog.detail', $post['slug']) }}" class="block group">
                            <div class="relative overflow-hidden mb-4">
                                <img 
                                    src="{{ asset($post['image']) }}" 
                                    alt="{{ $post['alt'] }}"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300"
                                >
                            </div>
                            <div class="inner-blog-box">
                                <h6 class="text-sm text-gray-600 mb-2">{{ $post['date'] }}</h6>
                                <h4 class="font-tenor text-lg lg:text-xl mb-3 group-hover:text-black transition-colors">
                                    {{ $post['title'] }}
                                </h4>
                                <p class="text-sm lg:text-base text-gray-700 mb-4 line-clamp-3">
                                    {{ strip_tags(substr($post['content'], 0, 200)) }}...
                                </p>
                                <span class="inline-block border border-black px-6 py-2 text-sm uppercase tracking-wide hover:bg-black hover:text-white transition-all duration-300">
                                    Read More
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts>
