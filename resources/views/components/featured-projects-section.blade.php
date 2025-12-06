@props([
    'title' => 'Featured Project',
    'projectName' => 'Premium Residential Complex',
    'location' => 'Bangalore',
    'type' => 'Luxury Residential Development',
    'land' => '5000 sqft',
    'tagline' => 'Modern Living, Timeless Design',
    'description' => 'A contemporary residential complex featuring cutting-edge design and premium amenities.',
    'images' => ['b1.jpeg', 'b2.jpeg', 'b3.jpeg', 'b4.jpeg'],
])

<section class="featured-project-section py-12 lg:py-16 bg-white relative overflow-hidden"
         x-data="{ 
             visible: false,
             currentImage: 0,
             totalImages: {{ count($images) }},
             interval: null,
             carouselStarted: false,
             init() {
                 // Wait a bit before starting carousel to avoid rapid changes
                 setTimeout(() => {
                     if (!this.carouselStarted) {
                         this.startCarousel();
                     }
                 }, 2000);
             },
             startCarousel() {
                 // Clear any existing interval first
                 this.stopCarousel();
                 
                 // Only start if not already started
                 if (!this.carouselStarted) {
                     this.interval = setInterval(() => {
                         this.nextImage();
                     }, 4000);
                     this.carouselStarted = true;
                 }
             },
             stopCarousel() {
                 if (this.interval) {
                     clearInterval(this.interval);
                     this.interval = null;
                 }
             },
             nextImage() {
                 this.currentImage = (this.currentImage + 1) % this.totalImages;
             },
             goToImage(index) {
                 // Stop carousel when user clicks thumbnail
                 this.stopCarousel();
                 this.carouselStarted = false;
                 
                 // Change image
                 this.currentImage = index;
                 
                 // Restart carousel after a delay
                 setTimeout(() => {
                     this.startCarousel();
                 }, 1000);
             }
         }"
         @mouseenter="stopCarousel()"
         @mouseleave="if (carouselStarted) { setTimeout(() => startCarousel(), 500); }"
         x-intersect="visible = true">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 project-bg-pattern"></div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-8 lg:mb-10">
            {{-- Top Decoration --}}
            <div class="project-top-decoration opacity-0 mb-4"
                 :class="{ 'animate-fade-in-down': visible }" 
                 style="animation-delay: 0.2s;">
                <div class="project-decoration-line"></div>
            </div>

            <h2 class="font-tenor text-xl lg:text-2xl uppercase mb-2 tracking-tight project-section-title opacity-0"
                :class="{ 'animate-fade-in-up': visible }" 
                style="animation-delay: 0.3s;">
                {{ $title }}
            </h2>
            
            <div class="w-20 h-0.5 bg-black mx-auto project-divider opacity-0"
                 :class="{ 'animate-fade-in-up': visible }" 
                 style="animation-delay: 0.4s;"></div>
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                {{-- Image Gallery Section --}}
                <div class="lg:col-span-7 opacity-0"
                     :class="{ 'animate-fade-in-up': visible }"
                     style="animation-delay: 0.5s;">
                    {{-- Main Featured Image --}}
                    <div class="project-main-image-wrapper mb-4">
                        <div class="relative overflow-hidden rounded-lg bg-black h-64 lg:h-96 shadow-lg project-main-image-container">
                            @foreach($images as $index => $image)
                                <div 
                                    class="project-main-slide"
                                    x-show="currentImage === {{ $index }}"
                                    x-transition:enter="transition ease-in-out duration-1000"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in-out duration-1000"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                >
                                    <img 
                                        src="{{ asset('images/' . $image) }}" 
                                        alt="{{ $projectName }} - Image {{ $index + 1 }}"
                                        class="w-full h-full object-cover project-main-image"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent project-image-overlay"></div>
                                </div>
                            @endforeach
                            
                            {{-- Decorative Corners --}}
                            <div class="absolute top-0 left-0 w-12 h-12 project-corner-tl">
                                <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-white/30"></div>
                            </div>
                            <div class="absolute top-0 right-0 w-12 h-12 project-corner-tr">
                                <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-white/30"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Thumbnail Grid --}}
                    <div class="grid grid-cols-4 gap-3 project-thumbnail-grid">
                        @foreach($images as $index => $image)
                            <button
                                @click="goToImage({{ $index }})"
                                class="project-thumbnail-wrapper group"
                                :class="{ 'active': currentImage === {{ $index }} }"
                            >
                                <div class="relative overflow-hidden rounded-md bg-black h-16 lg:h-20 project-thumbnail">
                                    <img 
                                        src="{{ asset('images/' . $image) }}" 
                                        alt="Thumbnail {{ $index + 1 }}"
                                        class="w-full h-full object-cover project-thumbnail-image"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors duration-300 project-thumbnail-overlay"></div>
                                    <div class="absolute inset-0 border-2 border-transparent group-hover:border-white/50 transition-colors duration-300 project-thumbnail-border"
                                         :class="{ 'border-white': currentImage === {{ $index }} }"></div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Project Details Section --}}
                <div class="lg:col-span-5 lg:pl-4 opacity-0"
                     :class="{ 'animate-fade-in-up': visible }"
                     style="animation-delay: 0.6s;">
                    <div class="project-details-card">
                        {{-- Location Badge --}}
                        <div class="mb-4">
                            <span class="project-location-badge">{{ $location }}</span>
                        </div>

                        {{-- Project Name --}}
                        <h3 class="font-tenor text-2xl lg:text-3xl uppercase mb-3 tracking-tight project-name">
                            {{ $projectName }}
                        </h3>

                        {{-- Title Accent --}}
                        <div class="w-16 h-0.5 bg-black mb-4 project-title-accent"></div>

                        {{-- Project Type --}}
                        <p class="text-xs uppercase tracking-widest text-gray-400 mb-3 project-type">
                            {{ $type }}
                        </p>

                        {{-- Tagline --}}
                        <p class="text-sm text-gray-600 italic mb-4 project-tagline">
                            {{ $tagline }}
                        </p>

                        {{-- Description --}}
                        @if($description)
                            <p class="text-xs text-gray-500 leading-relaxed mb-6 project-description">
                                {{ $description }}
                            </p>
                        @endif

                        {{-- Project Meta --}}
                        <div class="space-y-3 project-meta">
                            <div class="flex items-center gap-3">
                                <div class="project-meta-icon">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l12 12m0 0V16m0 4h-4m4 0L4 4"/>
                                    </svg>
                                </div>
                                <span class="text-xs text-gray-600">{{ $land }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="project-meta-icon">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <span class="text-xs text-gray-600">{{ $location }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@once
<style>
    /* Featured Project Section Styles */
    .featured-project-section {
        position: relative;
        background: #fafafa;
    }

    /* Background Pattern */
    .project-bg-pattern {
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(0, 0, 0, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
        background-size: 400px 400px;
    }

    /* Top Decoration */
    .project-top-decoration {
        display: flex;
        justify-content: center;
    }

    .project-decoration-line {
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.3), transparent);
    }

    /* Section Title */
    .project-section-title {
        color: #1a1a1a;
        letter-spacing: 0.02em;
    }

    /* Divider */
    .project-divider {
        transition: width 0.4s ease;
    }

    .featured-project-section:hover .project-divider {
        width: 100px;
    }

    /* Main Image Container */
    .project-main-image-container {
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.5s ease;
    }

    .project-main-image-container:hover {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .project-main-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .project-main-image {
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .project-main-image-container:hover .project-main-image {
        transform: scale(1.05);
    }

    .project-image-overlay {
        transition: opacity 0.4s ease;
    }

    .project-main-image-container:hover .project-image-overlay {
        opacity: 0.6;
    }

    /* Corner Decorations */
    .project-corner-tl,
    .project-corner-tr {
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .project-main-image-container:hover .project-corner-tl,
    .project-main-image-container:hover .project-corner-tr {
        opacity: 1;
    }

    /* Thumbnail Grid */
    .project-thumbnail-wrapper {
        position: relative;
        cursor: pointer;
        transition: transform 0.3s ease;
        background: transparent;
        border: none;
        padding: 0;
    }

    .project-thumbnail-wrapper:hover {
        transform: translateY(-2px);
    }

    .project-thumbnail-wrapper.active .project-thumbnail-overlay {
        background: transparent;
    }

    .project-thumbnail {
        transition: all 0.3s ease;
    }

    .project-thumbnail-wrapper:hover .project-thumbnail {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .project-thumbnail-image {
        transition: transform 0.3s ease;
    }

    .project-thumbnail-wrapper:hover .project-thumbnail-image {
        transform: scale(1.1);
    }

    /* Details Card */
    .project-details-card {
        padding: 1.5rem;
        background: transparent;
    }

    /* Location Badge */
    .project-location-badge {
        display: inline-block;
        padding: 0.35rem 1rem;
        background: #1a1a1a;
        color: white;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .project-details-card:hover .project-location-badge {
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Project Name */
    .project-name {
        color: #1a1a1a;
        line-height: 1.2;
    }

    /* Title Accent */
    .project-title-accent {
        transition: width 0.4s ease;
    }

    .project-details-card:hover .project-title-accent {
        width: 80px;
    }

    /* Project Type */
    .project-type {
        transition: color 0.3s ease;
    }

    .project-details-card:hover .project-type {
        color: #6b6b6b;
    }

    /* Tagline */
    .project-tagline {
        transition: color 0.3s ease;
    }

    .project-details-card:hover .project-tagline {
        color: #4a4a4a;
    }

    /* Description */
    .project-description {
        transition: color 0.3s ease;
    }

    /* Meta Icons */
    .project-meta-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0f0f0;
        border-radius: 4px;
        color: #1a1a1a;
        transition: all 0.3s ease;
    }

    .project-details-card:hover .project-meta-icon {
        background: #1a1a1a;
        color: white;
        transform: scale(1.1);
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
        .project-main-image-container {
            height: 300px;
        }

        .project-thumbnail {
            height: 60px;
        }
    }
</style>
@endonce
