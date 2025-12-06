<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Hero Section with Video Play --}}
    <section 
        x-data="{
            showVideo: false,
            videoIframe: null,
            init() {
                this.$watch('showVideo', (value) => {
                    if (value) {
                        // Try to detect video end (for YouTube/Vimeo)
                        this.setupVideoEndDetection();
                    }
                });
            },
            setupVideoEndDetection() {
                // This will be handled by the close button for now
                // Video end detection in iframe requires postMessage API
            },
            closeVideo() {
                this.showVideo = false;
                this.videoIframe = null;
            }
        }"
        class="relative overflow-hidden bg-gray-900 h-screen flex items-center">
        
        {{-- Background Image with Fade Transition --}}
        <div 
            x-show="!showVideo"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0">
            @if($property->featured_image)
                <img 
                    src="{{ $property->featured_image_url }}" 
                    alt="{{ $property->title }}"
                    class="w-full h-full object-cover opacity-30"
                >
            @endif
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/70"></div>
        </div>
        
        {{-- Video Player with Fade Transition --}}
        @if($property->video_url)
            <div 
                x-show="showVideo"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 w-full h-full z-20">
                <iframe
                    x-ref="videoFrame"
                    class="w-full h-full"
                    :src="showVideo ? '{{ $property->video_url }}?autoplay=1' : ''"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
                
                {{-- Close Video Button --}}
                <button
                    @click="closeVideo()"
                    class="absolute top-6 right-6 z-30 inline-flex items-center justify-center w-12 h-12 lg:w-14 lg:h-14 bg-black/40 backdrop-blur-md border border-white/20 hover:bg-black/60 hover:border-white/40 transition-all duration-300 group">
                    <svg class="w-6 h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        {{-- Content (Title, Location, Play Button) - Hidden when video plays --}}
        <div 
            x-show="!showVideo"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="container mx-auto px-4 lg:px-8 relative z-10">
            <div class="max-w-5xl mx-auto text-center text-white">
                <h1 class="font-tenor text-3xl lg:text-5xl xl:text-6xl uppercase mb-4 leading-tight">
                    {{ $property->title }}
                </h1>
                @if($property->location)
                    <div class="flex items-center justify-center gap-2 text-base lg:text-lg text-white/90 mb-8">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $property->location->city }}</span>
                        @if($property->location->locality)
                            <span class="text-white/70">•</span>
                            <span class="text-white/80">{{ $property->location->locality }}</span>
                        @endif
                    </div>
                @endif
                
                {{-- Video Play Button --}}
                @if($property->video_url)
                    <button
                        @click="showVideo = true"
                        class="inline-flex items-center gap-2 px-4 py-2 lg:px-5 lg:py-2.5 bg-black/30 backdrop-blur-md border border-white/20 text-white hover:bg-black/40 hover:border-white/30 transition-all duration-300 font-semibold text-sm lg:text-base">
                        <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        <span>Play</span>
                    </button>
                @endif
            </div>
        </div>
    </section>

    {{-- Compact Overview Section --}}
    <section class="pt-8 lg:pt-12 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-7xl mx-auto">
                {{-- Compact Stats Card with Black Background --}}
                <div class="bg-black p-6 lg:p-8 mb-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                        @if($property->total_land_area)
                            <div class="text-center group">
                                <div class="inline-flex items-center justify-center w-12 h-12 lg:w-14 lg:h-14 bg-white/10 mb-3 group-hover:bg-white/15 transition-colors">
                                    <svg class="w-6 h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                    </svg>
                                </div>
                                <p class="text-2xl lg:text-3xl font-bold text-white mb-1.5">{{ $property->total_land_area }}</p>
                                <p class="text-xs text-white/70 uppercase tracking-wider font-medium">Land Area</p>
                            </div>
                        @endif
                        @if($property->total_units)
                            <div class="text-center group">
                                <div class="inline-flex items-center justify-center w-12 h-12 lg:w-14 lg:h-14 bg-white/10 mb-3 group-hover:bg-white/15 transition-colors">
                                    <svg class="w-6 h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <p class="text-2xl lg:text-3xl font-bold text-white mb-1.5">{{ $property->total_units }}</p>
                                <p class="text-xs text-white/70 uppercase tracking-wider font-medium">Total Units</p>
                            </div>
                        @endif
                        @if($property->floors)
                            <div class="text-center group">
                                <div class="inline-flex items-center justify-center w-12 h-12 lg:w-14 lg:h-14 bg-white/10 mb-3 group-hover:bg-white/15 transition-colors">
                                    <svg class="w-6 h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <p class="text-2xl lg:text-3xl font-bold text-white mb-1.5">{{ $property->floors }}</p>
                                <p class="text-xs text-white/70 uppercase tracking-wider font-medium">Floors</p>
                            </div>
                        @endif
                        @if($property->units->count() > 0)
                            <div class="text-center group">
                                <div class="inline-flex items-center justify-center w-12 h-12 lg:w-14 lg:h-14 bg-white/10 mb-3 group-hover:bg-white/15 transition-colors">
                                    <svg class="w-6 h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <p class="text-2xl lg:text-3xl font-bold text-white mb-1.5">
                                    {{ $property->units->pluck('bhk')->unique()->sort()->map(fn($bhk) => $bhk . 'BHK')->join(', ') }}
                                </p>
                                <p class="text-xs text-white/70 uppercase tracking-wider font-medium">Available</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Dates & RERA - Minimal Text with Icons --}}
                <div class="space-y-0 mb-6 text-sm">
                    @if($property->launch_date)
                        <div class="flex items-center justify-between py-3 border-b border-gray-200">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-600">Launch Date</span>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $property->launch_date->format('d M Y') }}</span>
                        </div>
                    @endif
                    @if($property->possession_date)
                        <div class="flex items-center justify-between py-3 border-b border-gray-200">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-gray-600">Possession Date</span>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $property->possession_date->format('d M Y') }}</span>
                        </div>
                    @endif
                    @if($property->rera_number)
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <span class="text-gray-600">RERA Registration</span>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $property->rera_number }}</span>
                        </div>
                    @endif
                </div>

                {{-- Short Description - Prominent Summary --}}
                @if($property->short_description)
                    <div class="mb-6">
                        <div class="bg-gray-50 p-5 border-l-4 border-gray-900">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-gray-900 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div class="flex-1">
                                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Overview</h3>
                                    <p class="text-base text-gray-900 leading-relaxed font-medium">
                                        {{ $property->short_description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Full Description - Detailed Information --}}
                @if($property->description)
                    <div class="mb-6">
                        <div class="bg-white p-5">
                            <div class="flex items-start gap-3 mb-3">
                                <svg class="w-5 h-5 text-gray-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Detailed Description</h3>
                            </div>
                            <div class="text-sm text-gray-700 leading-relaxed space-y-2 ml-8">
                                {!! nl2br(e($property->description)) !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Units, Amenities & Specifications - 3 Column Grid --}}
    @if($property->units->count() > 0 || $property->amenities->count() > 0 || $property->specifications->count() > 0)
        <section class="py-10 lg:py-14 bg-gray-50">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                        {{-- Column 1: Available Units --}}
                        @if($property->units->count() > 0)
                            <div class="bg-white overflow-hidden">
                                <div class="bg-black px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-white/10 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                            </svg>
                                        </div>
                                        <h2 class="font-tenor text-lg lg:text-xl uppercase text-white">Available Units</h2>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-4">
                                        @foreach($property->units->sortBy('bhk') as $unit)
                                            <div class="bg-gray-50 p-4 mb-4 last:mb-0">
                                                <div class="flex items-center gap-2 mb-3 pb-2 border-b border-gray-200">
                                                    <div class="w-8 h-8 bg-gray-900 flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                        </svg>
                                                    </div>
                                                    <h3 class="text-base font-bold text-gray-900">{{ $unit->bhk }} BHK</h3>
                                                </div>
                                                <div class="space-y-2">
                                                    @if($unit->carpet_area)
                                                        <div class="flex items-center justify-between p-2 bg-white">
                                                            <div class="flex items-center gap-2">
                                                                <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                                                </svg>
                                                                <span class="text-xs text-gray-600">Carpet</span>
                                                            </div>
                                                            <span class="text-xs font-semibold text-gray-900">{{ number_format($unit->carpet_area, 0) }} sq.ft</span>
                                                        </div>
                                                    @endif
                                                    @if($unit->builtup_area)
                                                        <div class="flex items-center justify-between p-2 bg-white">
                                                            <div class="flex items-center gap-2">
                                                                <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                                                </svg>
                                                                <span class="text-xs text-gray-600">Built-up</span>
                                                            </div>
                                                            <span class="text-xs font-semibold text-gray-900">{{ number_format($unit->builtup_area, 0) }} sq.ft</span>
                                                        </div>
                                                    @endif
                                                    @if($unit->super_builtup_area)
                                                        <div class="flex items-center justify-between p-2 bg-white">
                                                            <div class="flex items-center gap-2">
                                                                <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                                                </svg>
                                                                <span class="text-xs text-gray-600">Super Built-up</span>
                                                            </div>
                                                            <span class="text-xs font-semibold text-gray-900">{{ number_format($unit->super_builtup_area, 0) }} sq.ft</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                @if($unit->floor_plan_image)
                                                    <a href="{{ $unit->floor_plan_image_url }}" target="_blank" class="mt-3 inline-flex items-center gap-2 w-full justify-center px-3 py-2 bg-gray-900 text-white text-xs font-semibold hover:bg-black transition">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                        <span>View Floor Plan</span>
                                                    </a>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Column 2: Amenities --}}
                        @if($property->amenities->count() > 0)
                            <div class="bg-white overflow-hidden">
                                <div class="bg-black px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-white/10 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                            </svg>
                                        </div>
                                        <h2 class="font-tenor text-lg lg:text-xl uppercase text-white">Amenities</h2>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-1 gap-2.5">
                                        @foreach($property->amenities as $amenity)
                                            <div class="flex items-center gap-3 p-2.5 bg-gray-50 mb-2.5 last:mb-0 hover:bg-gray-100 transition group">
                                                <div class="w-8 h-8 bg-white flex items-center justify-center">
                                                    @if($amenity->icon_url)
                                                        <img src="{{ $amenity->icon_url }}" alt="{{ $amenity->name }}" class="w-5 h-5 object-contain">
                                                    @else
                                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    @endif
                                                </div>
                                                <span class="text-sm font-medium text-gray-900 flex-1">{{ $amenity->name }}</span>
                                                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Column 3: Specifications --}}
                        @if($property->specifications->count() > 0)
                            <div class="bg-white overflow-hidden">
                                <div class="bg-black px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-white/10 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <h2 class="font-tenor text-lg lg:text-xl uppercase text-white">Specifications</h2>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-4">
                                        @foreach($property->specifications as $spec)
                                            <div class="bg-gray-50 p-4 mb-4 last:mb-0">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <div class="w-6 h-6 bg-gray-900 flex items-center justify-center flex-shrink-0">
                                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                        </svg>
                                                    </div>
                                                    <h3 class="text-sm font-bold text-gray-900">{{ $spec->section }}</h3>
                                                </div>
                                                <p class="text-xs text-gray-700 leading-relaxed ml-8">
                                                    {{ Str::limit(strip_tags($spec->description), 150) }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif


    {{-- Gallery Section - Auto Slider --}}
    @if($property->gallery->count() > 0)
        <section class="py-10 lg:py-14 bg-black">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-8 text-center text-white">Gallery</h2>
                    
                    <div 
                        x-data="{
                            currentIndex: 0,
                            itemsPerView: 4,
                            totalImages: {{ $property->gallery->count() }},
                            autoSlideInterval: null,
                            isDragging: false,
                            startX: 0,
                            currentX: 0,
                            dragOffset: 0,
                            init() {
                                this.updateItemsPerView();
                                window.addEventListener('resize', () => this.updateItemsPerView());
                                this.startAutoSlide();
                            },
                            updateItemsPerView() {
                                if (window.innerWidth >= 1024) {
                                    this.itemsPerView = 4;
                                } else if (window.innerWidth >= 768) {
                                    this.itemsPerView = 3;
                                } else {
                                    this.itemsPerView = 2;
                                }
                            },
                            startAutoSlide() {
                                this.stopAutoSlide();
                                this.autoSlideInterval = setInterval(() => {
                                    this.next();
                                }, 3000);
                            },
                            stopAutoSlide() {
                                if (this.autoSlideInterval) {
                                    clearInterval(this.autoSlideInterval);
                                    this.autoSlideInterval = null;
                                }
                            },
                            next() {
                                const maxIndex = Math.max(0, this.totalImages - this.itemsPerView);
                                if (this.currentIndex >= maxIndex) {
                                    this.currentIndex = 0;
                                } else {
                                    this.currentIndex++;
                                }
                            },
                            previous() {
                                const maxIndex = Math.max(0, this.totalImages - this.itemsPerView);
                                if (this.currentIndex <= 0) {
                                    this.currentIndex = maxIndex;
                                } else {
                                    this.currentIndex--;
                                }
                            },
                            goToSlide(pageIndex) {
                                const maxIndex = Math.max(0, this.totalImages - this.itemsPerView);
                                this.currentIndex = Math.min(pageIndex, maxIndex);
                                this.stopAutoSlide();
                                this.startAutoSlide();
                            },
                            get totalPages() {
                                return Math.ceil(this.totalImages / this.itemsPerView);
                            },
                            handleMouseDown(event) {
                                this.isDragging = true;
                                this.startX = event.clientX || event.touches[0].clientX;
                                this.stopAutoSlide();
                            },
                            handleMouseMove(event) {
                                if (!this.isDragging) return;
                                this.currentX = event.clientX || event.touches[0].clientX;
                                this.dragOffset = this.currentX - this.startX;
                            },
                            handleMouseUp() {
                                if (!this.isDragging) return;
                                const threshold = 50; // Minimum drag distance to trigger slide change
                                
                                if (Math.abs(this.dragOffset) > threshold) {
                                    if (this.dragOffset > 0) {
                                        this.previous();
                                    } else {
                                        this.next();
                                    }
                                }
                                
                                this.isDragging = false;
                                this.dragOffset = 0;
                                this.startAutoSlide();
                            },
                            get transformValue() {
                                const baseTransform = this.currentIndex * (100 / this.itemsPerView);
                                const dragTransform = this.isDragging ? (this.dragOffset / window.innerWidth) * 100 : 0;
                                return `translateX(-${baseTransform + dragTransform}%)`;
                            },
                            get activeIndicatorIndex() {
                                return Math.floor(this.currentIndex);
                            },
                            isIndicatorActive(index) {
                                const page = Math.floor(index / this.itemsPerView);
                                return page === this.activeIndicatorIndex;
                            }
                        }"
                        class="relative">
                        
                        {{-- Slider Container with Drag Support --}}
                        <div 
                            class="relative overflow-hidden cursor-grab active:cursor-grabbing"
                            @mousedown="handleMouseDown($event)"
                            @mousemove="handleMouseMove($event)"
                            @mouseup="handleMouseUp()"
                            @mouseleave="handleMouseUp()"
                            @touchstart="handleMouseDown($event)"
                            @touchmove="handleMouseMove($event)"
                            @touchend="handleMouseUp()">
                            <div 
                                class="flex transition-transform duration-700 ease-in-out" 
                                :style="`transform: ${transformValue};`"
                                :class="{ 'transition-none': isDragging }">
                                @foreach($property->gallery as $image)
                                    <div 
                                        class="flex-shrink-0 px-2" 
                                        :style="`width: ${100 / itemsPerView}%`">
                                        <div 
                                            class="relative group overflow-hidden bg-gray-900 cursor-pointer aspect-square select-none"
                                            @click="!isDragging && window.open('{{ $image->optimized_image_url }}', '_blank')">
                                            <img 
                                                src="{{ $image->optimized_image_url }}" 
                                                alt="{{ ucfirst($image->type) }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 pointer-events-none"
                                                loading="lazy"
                                                draggable="false"
                                            >
                                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                                            <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                                <p class="text-white text-xs font-semibold text-center uppercase tracking-wide">{{ ucfirst($image->type) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Indicator Dots --}}
                        <div class="mt-6 flex items-center justify-center gap-2">
                            <template x-for="(page, index) in totalPages" :key="index">
                                <button
                                    @click="goToSlide(index)"
                                    :class="currentIndex === index ? 'bg-white w-8' : 'bg-white/40 w-2'"
                                    class="h-2 transition-all duration-300 hover:bg-white/60 cursor-pointer"
                                    :aria-label="`Go to slide ${index + 1}`">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


   

    

    {{-- Contact CTA Section --}}
    <section class="py-8 lg:py-12 bg-gray-900 text-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-3">Interested in this Property?</h2>
                <p class="text-sm text-white/90 mb-6">Get in touch with us for more information and schedule a site visit.</p>
                {{-- Download Brochure Button --}}
    @if($property->brochure_url)
        
                    <a 
                        href="{{ $property->brochure_url }}" 
                        target="_blank"
                        class="inline-flex items-center px-6 py-3 bg-white text-black hover:bg-gray-100 transition text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download Brochure
                    </a>
                
    @endif
            </div>
        </div>
    </section>

</x-layouts>
