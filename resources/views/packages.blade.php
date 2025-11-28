<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <section class="relative h-64 md:h-80 bg-black">
        <div class="container mx-auto px-4 h-full flex items-center justify-center">
            <h1 class="font-tenor text-3xl md:text-4xl text-white uppercase">Our Packages</h1>
        </div>
    </section>

    {{-- Packages Content --}}
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-6">Coming Soon</h2>
                <p class="text-gray-600">This page is under construction. Please check back later.</p>
            </div>
        </div>
    </section>
</x-layouts>

