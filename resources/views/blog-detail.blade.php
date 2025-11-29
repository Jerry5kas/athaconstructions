<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Blog Detail Section --}}
    <section class="py-8 lg:py-12">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-12 gap-8">
                {{-- Main Content --}}
                <div class="lg:col-span-9">
                    <div class="max-w-4xl">
                        <div class="mb-6">
                            <img 
                                src="{{ asset($post['image']) }}" 
                                alt="{{ $post['title'] }}" 
                                class="w-full h-auto object-cover rounded-lg"
                                style="max-height: 650px;"
                            >
                        </div>
                        <div class="mb-4">
                            <h1 class="font-tenor text-2xl lg:text-3xl text-black mb-2">
                                {{ $post['h1'] }}
                            </h1>
                        </div>
                        <div class="prose prose-lg max-w-none text-black">
                            {!! $post['content'] !!}
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-3">
                    <div class="border border-gray-300 p-4 lg:p-6 rounded-lg">
                        <h4 class="font-tenor text-lg lg:text-xl uppercase mb-6">Latest Posts</h4>
                        
                        <div class="space-y-6">
                            @foreach($recentPosts as $recentPost)
                                <div class="mb-6">
                                    <a href="{{ route('blog.detail', $recentPost['slug']) }}" class="block group">
                                        <div class="mb-3">
                                            <img 
                                                src="{{ asset($recentPost['image']) }}" 
                                                alt="{{ $recentPost['title'] }}" 
                                                class="w-full h-40 object-cover rounded group-hover:opacity-90 transition-opacity"
                                            >
                                        </div>
                                        <div>
                                            <h5 class="font-tenor text-base lg:text-lg mb-2 group-hover:text-black transition-colors">
                                                {{ $recentPost['title'] }}
                                            </h5>
                                            <span class="text-sm text-gray-600">
                                                <i class="far fa-clock mr-1"></i>
                                                {{ date('M j, Y', strtotime($recentPost['date'])) }}
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
</x-layouts>

