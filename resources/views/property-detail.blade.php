<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Enhanced Hero Section with Advanced Video Player --}}
    @php
        // Detect video type and format URL
        $videoUrl = $property->video_url ?? null;
        $isYouTube = $videoUrl && (strpos($videoUrl, 'youtube.com') !== false || strpos($videoUrl, 'youtu.be') !== false);
        $isVimeo = $videoUrl && strpos($videoUrl, 'vimeo.com') !== false;
        $isDirectVideo = $videoUrl && !$isYouTube && !$isVimeo;
        
        // Format YouTube/Vimeo embed URL
        if ($isYouTube) {
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $matches);
            $videoId = $matches[1] ?? null;
            $embedUrl = $videoId ? "https://www.youtube.com/embed/{$videoId}?autoplay=1&rel=0&modestbranding=1&showinfo=0" : null;
        } elseif ($isVimeo) {
            preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $matches);
            $videoId = $matches[1] ?? null;
            $embedUrl = $videoId ? "https://player.vimeo.com/video/{$videoId}?autoplay=1&title=0&byline=0&portrait=0" : null;
        } else {
            $embedUrl = $videoUrl;
        }
    @endphp

    <section 
        x-data="{
            showVideo: false,
            isPlaying: false,
            videoLoaded: false,
            init() {
                // Handle escape key to close video
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && this.showVideo) {
                        this.closeVideo();
                    }
                });
            },
            openVideo() {
                this.showVideo = true;
                this.isPlaying = true;
                // Prevent body scroll when video is open
                document.body.style.overflow = 'hidden';
            },
            closeVideo() {
                this.showVideo = false;
                this.isPlaying = false;
                this.videoLoaded = false;
                // Restore body scroll
                document.body.style.overflow = '';
            },
            onVideoLoad() {
                this.videoLoaded = true;
            }
        }"
        class="property-hero-section relative overflow-hidden bg-black h-screen lg:h-[80vh] flex items-center justify-center">
        
        {{-- Background Image with Parallax Effect --}}
        <div 
            x-show="!showVideo"
            x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 scale-110"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-700"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-110"
            class="property-hero-bg absolute inset-0">
            @if($property->featured_image)
                <img 
                    src="{{ $property->featured_image_url }}" 
                    alt="{{ $property->title }}"
                    class="property-hero-image w-full h-full object-cover"
                    loading="eager"
                >
            @endif
            {{-- Enhanced Gradient Overlay --}}
            <div class="property-hero-overlay absolute inset-0"></div>
            {{-- Animated Background Pattern --}}
            <div class="property-hero-pattern absolute inset-0"></div>
        </div>
        
        {{-- Advanced Video Player Modal --}}
        @if($videoUrl && $embedUrl)
            <div 
                x-show="showVideo"
                x-cloak
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="property-video-modal absolute inset-0 z-50 bg-black/95 backdrop-blur-sm flex items-center justify-center"
                @click.self="closeVideo()"
                @keydown.escape.window="closeVideo()">
                
                {{-- Video Container --}}
                <div 
                    class="property-video-container relative w-full h-full flex items-center justify-center"
                    @click.stop>
                    {{-- Video Wrapper --}}
                    <div class="property-video-wrapper relative w-full h-full flex items-center justify-center" 
                         :class="videoLoaded ? 'opacity-100' : 'opacity-0'"
                         x-transition:enter="transition ease-out duration-500 delay-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        @if($isYouTube || $isVimeo)
                            <iframe
                                x-ref="videoFrame"
                                class="property-video-iframe w-full h-full rounded-lg shadow-2xl"
                                :src="showVideo ? '{{ $embedUrl }}' : ''"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                @load="onVideoLoad()">
                            </iframe>
                        @else
                            <video
                                x-ref="videoElement"
                                class="property-video-iframe w-full h-full rounded-lg shadow-2xl"
                                :src="showVideo ? '{{ $embedUrl }}' : ''"
                                controls
                                autoplay
                                @loadeddata="onVideoLoad()">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                    
                    {{-- Close Button --}}
                    <button
                        @click="closeVideo()"
                        class="property-video-close absolute top-4 right-4 lg:top-8 lg:right-8 z-40 group"
                        aria-label="Close video">
                        <div class="property-video-close-bg"></div>
                        <svg class="property-video-close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    {{-- Loading Indicator --}}
                    <div 
                        x-show="!videoLoaded"
                        class="absolute inset-0 flex items-center justify-center">
                        <div class="property-video-loader">
                            <div class="property-video-loader-ring"></div>
                            <div class="property-video-loader-ring"></div>
                            <div class="property-video-loader-ring"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Hero Content --}}
        <div 
            x-show="!showVideo"
            x-transition:enter="transition ease-out duration-700 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-8"
            class="property-hero-content container mx-auto px-4 lg:px-8 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                {{-- Title with Decorative Elements --}}
                <div class="property-hero-title-wrapper mb-6">
                    <h1 class="font-tenor text-4xl lg:text-6xl xl:text-7xl uppercase mb-6 leading-tight text-white property-hero-title">
                        {{ $property->title }}
                    </h1>
                    <div class="property-hero-title-accent mx-auto"></div>
                </div>
                
                {{-- Location with Icon --}}
                @if($property->location)
                    <div class="property-hero-location flex items-center justify-center gap-3 text-base lg:text-lg text-white/90 mb-10">
                        <div class="property-hero-location-icon">
                            <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="font-medium">{{ $property->location->city }}</span>
                        @if($property->location->locality)
                            <span class="text-white/50">•</span>
                            <span class="text-white/80">{{ $property->location->locality }}</span>
                        @endif
                    </div>
                @endif
                
                {{-- Enhanced Video Play Button --}}
                @if($videoUrl)
                    <button
                        @click="openVideo()"
                        class="property-hero-play-btn group inline-flex items-center gap-3 px-6 py-3 lg:px-8 lg:py-4 bg-white/10 backdrop-blur-md border-2 border-white/30 text-white hover:bg-white/20 hover:border-white/50 transition-all duration-500 font-semibold text-sm lg:text-base uppercase tracking-wider">
                        <div class="property-hero-play-icon">
                            <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                        <span>Watch Video</span>
                    </button>
                @endif
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div 
            x-show="!showVideo"
            class="property-hero-scroll absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    @once
    <style>
        /* Property Hero Section Styles */
        .property-hero-section {
            position: relative;
            min-height: 100vh;
        }

        /* Background Image */
        .property-hero-bg {
            will-change: transform;
        }

        .property-hero-image {
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .property-hero-section:hover .property-hero-image {
            transform: scale(1.05);
        }

        /* Enhanced Gradient Overlay */
        .property-hero-overlay {
            background: linear-gradient(
                180deg,
                rgba(0, 0, 0, 0.4) 0%,
                rgba(0, 0, 0, 0.6) 50%,
                rgba(0, 0, 0, 0.8) 100%
            );
        }

        /* Animated Background Pattern */
        .property-hero-pattern {
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
            background-size: 600px 600px;
            animation: patternMove 20s ease-in-out infinite;
        }

        @keyframes patternMove {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, 30px); }
        }

        /* Hero Content */
        .property-hero-content {
            position: relative;
            z-index: 10;
        }

        /* Title Wrapper */
        .property-hero-title-wrapper {
            position: relative;
        }

        .property-hero-title {
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            letter-spacing: 0.02em;
        }

        .property-hero-title-accent {
            width: 120px;
            height: 3px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
            margin-top: 1rem;
            transition: width 0.5s ease;
        }

        .property-hero-section:hover .property-hero-title-accent {
            width: 180px;
        }

        /* Location */
        .property-hero-location {
            transition: all 0.3s ease;
        }

        .property-hero-location-icon {
            transition: transform 0.3s ease;
        }

        .property-hero-section:hover .property-hero-location-icon {
            transform: scale(1.1);
        }

        /* Enhanced Play Button */
        .property-hero-play-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .property-hero-play-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .property-hero-play-btn:hover::before {
            left: 100%;
        }

        .property-hero-play-icon {
            transition: transform 0.3s ease;
        }

        .property-hero-play-btn:hover .property-hero-play-icon {
            transform: scale(1.2);
        }

        .property-hero-play-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(255, 255, 255, 0.2);
        }

        /* Video Modal */
        .property-video-modal {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .property-video-container {
            position: relative;
            height: 100%;
        }

        .property-video-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .property-video-iframe {
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Close Button */
        .property-video-close {
            position: relative;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .property-video-close:hover {
            transform: rotate(90deg) scale(1.1);
        }

        .property-video-close-bg {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .property-video-close:hover .property-video-close-bg {
            background: rgba(0, 0, 0, 0.8);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .property-video-close-icon {
            position: relative;
            width: 24px;
            height: 24px;
            color: white;
            z-index: 1;
        }

        /* Loading Indicator */
        .property-video-loader {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: center;
        }

        .property-video-loader-ring {
            width: 12px;
            height: 12px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .property-video-loader-ring:nth-child(1) {
            animation-delay: 0s;
        }

        .property-video-loader-ring:nth-child(2) {
            animation-delay: 0.2s;
        }

        .property-video-loader-ring:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Scroll Indicator */
        .property-hero-scroll {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            50% {
                transform: translateX(-50%) translateY(-10px);
            }
        }

        /* Responsive */
        @media (max-width: 1023px) {
            .property-hero-title {
                font-size: 2.5rem;
            }

            .property-video-close {
                width: 40px;
                height: 40px;
            }

            .property-video-close-icon {
                width: 20px;
                height: 20px;
            }
        }

        @media (max-width: 767px) {
            .property-hero-title {
                font-size: 2rem;
            }

            .property-video-container {
                padding: 1rem;
            }
        }
    </style>
    @endonce

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
