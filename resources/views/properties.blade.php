<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        pageTitle="Explore Properties"
        contentTitle="Handpicked Homes & Developments"
        description="Discover thoughtfully planned properties that combine architecture, comfort, and long-term value."
        backgroundVideo="videos/Properties page video.mp4"
        alt="residential construction companies in bangalore"
        title="residential construction companies in bangalore"
    />

    {{-- Properties Listing Section --}}
    <section class="py-8 lg:py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
                {{-- Main Content Area --}}
                <div class="flex-1">
                    {{-- Properties Grid --}}
                    @if($properties->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-5">
                            @foreach($properties as $property)
                                <article class="group bg-white transition-all duration-300 overflow-hidden">
                                    <a href="{{ route('properties.show', $property->slug) }}" class="block">
                                        {{-- Image Container --}}
                                        <div class="relative overflow-hidden bg-gray-100">
                                            <img 
                                                src="{{ $property->featured_image ? $property->featured_image_url : asset('images/logo mockup 5.png') }}" 
                                                alt="{{ $property->title }}"
                                                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                                            >
                                            
                                            {{-- Gradient Overlay on Hover --}}
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                            
                                            {{-- Type Badge --}}
                                            <div class="absolute top-3 right-3">
                                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-md bg-black/30 backdrop-blur-md text-white capitalize border border-white/20 shadow-lg">
                                                    {{ $property->project_type }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        {{-- Content Section --}}
                                        <div class="bg-gray-50 px-1.5 py-4">
                                            {{-- Title --}}
                                            <h3 class="font-tenor text-base lg:text-lg mb-3 text-gray-900 group-hover:text-gray-700 transition-colors line-clamp-1">
                                                {{ $property->title }}
                                            </h3>
                                            
                                            {{-- Location --}}
                                            @if($property->location)
                                                <div class="flex items-start gap-2 mb-3">
                                                    <div class="flex-shrink-0 mt-0.5">
                                                        <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-semibold text-gray-900 truncate leading-tight">{{ $property->location->city }}</p>
                                                        @if($property->location->locality)
                                                            <p class="text-xs text-gray-600 truncate leading-tight mt-0.5">{{ $property->location->locality }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            {{-- Description --}}
                                            @if($property->short_description)
                                                <p class="text-xs text-gray-600 line-clamp-2 leading-relaxed">
                                                    {{ Str::limit($property->short_description, 100) }}
                                                </p>
                                            @endif
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-6">
                            {{ $properties->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-600 text-lg mb-4">No properties found.</p>
                            @if($search || $status || $type)
                                <a
                                    href="{{ route('properties') }}"
                                    class="inline-block px-6 py-2 text-sm font-semibold text-white bg-gray-900 rounded-lg hover:bg-black transition">
                                    View All Properties
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Filters Sidebar --}}
                <aside class="lg:w-80 flex-shrink-0">
                    <div class="bg-gray-50 p-5 sticky top-4">
                        <h3 class="font-tenor text-base uppercase mb-5 text-gray-900 tracking-wide">Filters</h3>
                        
                        <form method="GET" action="{{ route('properties') }}" class="space-y-5">
                            {{-- Search --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-900 uppercase tracking-wide mb-2">Search</label>
                                <input
                                    type="text"
                                    name="search"
                                    value="{{ $search ?? '' }}"
                                    placeholder="Search properties..."
                                    class="w-full px-3 py-2.5 text-sm bg-white border border-gray-300 focus:outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900 transition-colors">
                            </div>
                            
                            {{-- Status Filter --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-900 uppercase tracking-wide mb-2">Status</label>
                                <select
                                    name="status"
                                    class="w-full px-3 py-2.5 text-sm bg-white border border-gray-300 focus:outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900 transition-colors">
                                    <option value="">All Status</option>
                                    <option value="upcoming" {{ $status === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                    <option value="ongoing" {{ $status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            {{-- Type Filter --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-900 uppercase tracking-wide mb-2">Property Type</label>
                                <select
                                    name="type"
                                    class="w-full px-3 py-2.5 text-sm bg-white border border-gray-300 focus:outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900 transition-colors">
                                    <option value="">All Types</option>
                                    <option value="apartment" {{ $type === 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="villa" {{ $type === 'villa' ? 'selected' : '' }}>Villa</option>
                                    <option value="plot" {{ $type === 'plot' ? 'selected' : '' }}>Plot</option>
                                    <option value="commercial" {{ $type === 'commercial' ? 'selected' : '' }}>Commercial</option>
                                </select>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex flex-col gap-2.5 pt-1">
                                <button
                                    type="submit"
                                    class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-gray-900 hover:bg-black transition-colors">
                                    Apply Filters
                                </button>

                                @if($search || $status || $type)
                                    <a
                                        href="{{ route('properties') }}"
                                        class="w-full px-4 py-2.5 text-sm font-semibold text-center text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 transition-colors">
                                        Clear All
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <x-how-it-works :steps="$howItWorks" />
</x-layouts>
