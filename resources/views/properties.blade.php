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
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-5">
                            @foreach($properties as $property)
                                <article class="group bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100">
                                    <a href="{{ route('properties.show', $property->slug) }}" class="block">
                                        {{-- Image Container --}}
                                        <div class="relative overflow-hidden bg-gray-100">
                                            @if($property->featured_image)
                                                <img 
                                                    src="{{ $property->featured_image_url }}" 
                                                    alt="{{ $property->title }}"
                                                    class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500"
                                                >
                                            @else
                                                <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            
                                            {{-- Gradient Overlay on Hover --}}
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                            
                                            {{-- Badges --}}
                                            <div class="absolute top-2 left-2 right-2 flex items-start justify-between gap-2">
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-white/95 backdrop-blur-sm text-gray-900 capitalize shadow-sm">
                                                    {{ $property->project_type }}
                                                </span>
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full shadow-sm
                                                    @if($property->status === 'upcoming') bg-yellow-500/95 backdrop-blur-sm text-white
                                                    @elseif($property->status === 'ongoing') bg-emerald-500/95 backdrop-blur-sm text-white
                                                    @else bg-gray-600/95 backdrop-blur-sm text-white
                                                    @endif">
                                                    {{ ucfirst($property->status) }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        {{-- Content Section --}}
                                        <div class="p-4">
                                            {{-- Title --}}
                                            <h3 class="font-tenor text-base lg:text-lg mb-2 text-gray-900 group-hover:text-gray-700 transition-colors line-clamp-1">
                                                {{ $property->title }}
                                            </h3>
                                            
                                            {{-- Location --}}
                                            @if($property->location)
                                                <div class="flex items-center gap-1.5 mb-3 text-gray-600">
                                                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-xs font-medium truncate">{{ $property->location->city }}</p>
                                                        @if($property->location->locality)
                                                            <p class="text-[10px] text-gray-500 truncate">{{ $property->location->locality }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            {{-- Property Details Grid --}}
                                            <div class="grid grid-cols-2 gap-2 mb-3 pb-3 border-b border-gray-100">
                                                @if($property->total_land_area)
                                                    <div class="flex items-start gap-1.5">
                                                        <svg class="w-3.5 h-3.5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                                        </svg>
                                                        <div>
                                                            <p class="text-[10px] text-gray-500">Land Area</p>
                                                            <p class="text-xs font-semibold text-gray-900">{{ $property->total_land_area }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if($property->units->count() > 0)
                                                    <div class="flex items-start gap-1.5">
                                                        <svg class="w-3.5 h-3.5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                        </svg>
                                                        <div>
                                                            <p class="text-[10px] text-gray-500">Available</p>
                                                            <p class="text-xs font-semibold text-gray-900">
                                                                {{ $property->units->pluck('bhk')->unique()->sort()->map(fn($bhk) => $bhk . 'BHK')->join(', ') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if($property->total_units)
                                                    <div class="flex items-start gap-1.5">
                                                        <svg class="w-3.5 h-3.5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                        </svg>
                                                        <div>
                                                            <p class="text-[10px] text-gray-500">Total Units</p>
                                                            <p class="text-xs font-semibold text-gray-900">{{ $property->total_units }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if($property->floors)
                                                    <div class="flex items-start gap-1.5">
                                                        <svg class="w-3.5 h-3.5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                        </svg>
                                                        <div>
                                                            <p class="text-[10px] text-gray-500">Floors</p>
                                                            <p class="text-xs font-semibold text-gray-900">{{ $property->floors }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            {{-- Description --}}
                                            @if($property->short_description)
                                                <p class="text-xs text-gray-600 line-clamp-2 mb-3 leading-relaxed">
                                                    {{ Str::limit($property->short_description, 100) }}
                                                </p>
                                            @endif
                                            
                                            {{-- View Details CTA --}}
                                            <div class="flex items-center justify-between pt-1">
                                                <span class="text-xs font-semibold text-gray-900 group-hover:text-gray-700 transition-colors">
                                                    View Details
                                                </span>
                                                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-900 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </div>
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
                    <div class="bg-white rounded-lg border border-gray-200 p-5 sticky top-4">
                        <h3 class="font-tenor text-lg uppercase mb-4 text-gray-900">Filters</h3>
                        
                        <form method="GET" action="{{ route('properties') }}" class="space-y-4">
                            {{-- Search --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                <input
                                    type="text"
                                    name="search"
                                    value="{{ $search ?? '' }}"
                                    placeholder="Search properties..."
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
                            </div>
                            
                            {{-- Status Filter --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select
                                    name="status"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
                                    <option value="">All Status</option>
                                    <option value="upcoming" {{ $status === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                    <option value="ongoing" {{ $status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            {{-- Type Filter --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Property Type</label>
                                <select
                                    name="type"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
                                    <option value="">All Types</option>
                                    <option value="apartment" {{ $type === 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="villa" {{ $type === 'villa' ? 'selected' : '' }}>Villa</option>
                                    <option value="plot" {{ $type === 'plot' ? 'selected' : '' }}>Plot</option>
                                    <option value="commercial" {{ $type === 'commercial' ? 'selected' : '' }}>Commercial</option>
                                </select>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex flex-col gap-2 pt-2">
                                <button
                                    type="submit"
                                    class="w-full px-4 py-2 text-sm font-semibold text-white bg-gray-900 rounded-lg hover:bg-black transition">
                                    Apply Filters
                                </button>

                                @if($search || $status || $type)
                                    <a
                                        href="{{ route('properties') }}"
                                        class="w-full px-4 py-2 text-sm font-semibold text-center text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
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
