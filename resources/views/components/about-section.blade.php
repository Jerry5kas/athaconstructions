@props([
    'subtitle' => 'ATHA Construction',
    'title' => 'Crafting Dreams, Building Legacies',
    'paragraphs' => [],
    'image' => 'images/ATHA-CONSTRUCTIONS.jpg',
    'images' => [], // Array of images for carousel: [['src' => 'path', 'alt' => 'alt text', 'title' => 'title']]
    'imageAlt' => 'Best Construction Companies in Bangalore',
    'imageTitle' => 'Best Construction Companies in Bangalore',
    'buttonText' => 'KNOW MORE',
    'buttonLink' => null,
    'imagePosition' => 'right', // 'left' or 'right'
    'sectionClass' => 'about-section',
    'showCounter' => false,
    'counterValue' => 2,
    'counterSuffix' => 'M+',
    'counterLabel' => 'Sq.Ft Developed',
    'carouselInterval' => 4000 // Auto-transition interval in milliseconds
])

@php
    // Prepare images array - use images prop if provided, otherwise fallback to single image
    $carouselImages = !empty($images) ? $images : [['src' => $image, 'alt' => $imageAlt, 'title' => $imageTitle]];
@endphp

<section class="py-12 lg:py-16 {{ $sectionClass }} relative overflow-hidden about-section-enhanced"
         x-data="{ 
             visible: false,
             currentSlide: 0,
             totalSlides: {{ count($carouselImages) }},
             interval: null,
             init() {
                 if (this.totalSlides > 1) {
                     this.startCarousel();
                 }
             },
             startCarousel() {
                 this.interval = setInterval(() => {
                     this.nextSlide();
                 }, {{ $carouselInterval }});
             },
             stopCarousel() {
                 if (this.interval) {
                     clearInterval(this.interval);
                     this.interval = null;
                 }
             },
             nextSlide() {
                 this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
             },
             goToSlide(index) {
                 this.currentSlide = index;
                 this.stopCarousel();
                 this.startCarousel();
             }
         }"
         @mouseenter="stopCarousel()"
         @mouseleave="if (totalSlides > 1) startCarousel()"
         x-intersect="visible = true">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 about-bg-pattern"></div>
    
    {{-- Decorative Elements --}}
    <div class="absolute top-0 {{ $imagePosition === 'right' ? 'right-0' : 'left-0' }} w-64 h-64 about-decorative-circle"></div>
    <div class="absolute bottom-0 {{ $imagePosition === 'right' ? 'left-0' : 'right-0' }} w-48 h-48 about-decorative-circle"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-center">
            {{-- Content Section --}}
            <div class="lg:col-span-7 {{ $imagePosition === 'right' ? 'lg:pr-8' : 'lg:pl-8 lg:order-2' }}">
                {{-- Subtitle Badge --}}
                @if($subtitle)
                    <div class="about-subtitle-wrapper opacity-0 mb-4"
                         :class="{ 'animate-fade-in-up': visible }" 
                         style="animation-delay: 0.2s;">
                        <span class="about-subtitle-badge">
                            {{ $subtitle }}
                        </span>
                    </div>
                @endif

                {{-- Title with Accent --}}
                @if($title)
                    <div class="about-title-wrapper opacity-0 mb-6"
                         :class="{ 'animate-fade-in-up': visible }" 
                         style="animation-delay: 0.3s;">
                        <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-3 about-title">
                            {{ $title }}
                        </h2>
                        <div class="about-title-accent"></div>
                    </div>
                @endif

                {{-- Paragraphs with Premium Icons --}}
                @if(!empty($paragraphs))
                    <div class="space-y-3 mb-6">
                        @foreach($paragraphs as $index => $paragraph)
                            <div class="about-paragraph-wrapper opacity-0"
                                 :class="{ 'animate-fade-in-up': visible }" 
                                 style="animation-delay: {{ 0.4 + ($index * 0.1) }}s;">
                                <div class="about-list-item">
                                    <div class="about-list-icon">
                                        @if($index % 4 === 0)
                                            {{-- Premium Quality Icon --}}
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @elseif($index % 4 === 1)
                                            {{-- Innovation Icon --}}
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M2 17L12 22L22 17" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M2 12L12 17L22 12" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @elseif($index % 4 === 2)
                                            {{-- Excellence Icon --}}
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.7088 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M22 4L12 14.01L9 11.01" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @else
                                            {{-- Trust Icon --}}
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 12L11 15L16 10" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <p class="text-xs lg:text-sm leading-relaxed about-paragraph">
                                    {{ $paragraph }}
                                </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Counter with Enhanced Design --}}
                @if($showCounter)
                    <div 
                        class="about-counter-wrapper opacity-0 mb-6"
                        :class="{ 'animate-fade-in-up': visible }"
                        style="animation-delay: {{ 0.4 + (count($paragraphs) * 0.1) + 0.2 }}s;"
                        x-data="aboutCounter({ target: @js($counterValue), suffix: @js($counterSuffix) })"
                        x-intersect.once="start()"
                    >
                        <div class="about-counter-box">
                            <div class="flex items-baseline gap-2">
                                <span class="font-tenor text-3xl lg:text-4xl font-bold about-counter-value" x-text="displayValue">0{{ $counterSuffix }}</span>
                                <span class="text-xs lg:text-sm text-gray-600 about-counter-label">{{ $counterLabel }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Enhanced Button --}}
                @if($buttonText && $buttonLink)
                    <div class="about-button-wrapper opacity-0"
                         :class="{ 'animate-fade-in-up': visible }"
                         style="animation-delay: {{ 0.4 + (count($paragraphs) * 0.1) + ($showCounter ? 0.3 : 0.2) }}s;">
                        <a href="{{ $buttonLink }}" class="about-button group">
                            <span class="about-button-text">{{ $buttonText }}</span>
                            <svg class="about-button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

            {{-- Enhanced Image Carousel Section --}}
            <div class="lg:col-span-5 {{ $imagePosition === 'left' ? 'lg:order-1' : '' }}">
                <div class="about-image-wrapper opacity-0"
                     :class="{ 'animate-fade-in-up': visible }" 
                     style="animation-delay: 0.5s;">
                    <div class="about-image-frame">
                        <div class="about-carousel-container">
                            @foreach($carouselImages as $index => $img)
                                <div 
                                    class="about-carousel-slide"
                                    x-show="currentSlide === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-700"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-700"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                >
                                    <img 
                                        src="{{ asset($img['src']) }}" 
                                        alt="{{ $img['alt'] ?? $imageAlt }}" 
                                        title="{{ $img['title'] ?? $imageTitle }}"
                            class="about-image"
                                        loading="lazy"
                        >
                                </div>
                            @endforeach
                        </div>
                        {{-- Decorative Corner Elements --}}
                        <div class="about-image-corner about-corner-tl"></div>
                        <div class="about-image-corner about-corner-tr"></div>
                        <div class="about-image-corner about-corner-bl"></div>
                        <div class="about-image-corner about-corner-br"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@once
<style>
    /* About Section Enhanced Styles */
    .about-section-enhanced {
        background: #fafafa;
        position: relative;
    }

    /* Background Pattern */
    .about-bg-pattern {
        background-image: 
            radial-gradient(circle at 15% 25%, rgba(0, 0, 0, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 85% 75%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
        background-size: 400px 400px;
    }

    /* Decorative Circles */
    .about-decorative-circle {
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 50%;
        opacity: 0.5;
    }

    /* Subtitle Badge */
    .about-subtitle-wrapper {
        display: inline-block;
    }

    .about-subtitle-badge {
        display: inline-block;
        padding: 0.4rem 1.25rem;
        background: #1a1a1a;
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .about-section-enhanced:hover .about-subtitle-badge {
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Title */
    .about-title-wrapper {
        position: relative;
    }

    .about-title {
        color: #1a1a1a;
        letter-spacing: 0.03em;
        line-height: 1.2;
    }

    .about-title-accent {
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, #1a1a1a, transparent);
        margin-top: 0.5rem;
        transition: width 0.4s ease;
    }

    .about-section-enhanced:hover .about-title-accent {
        width: 90px;
    }

    /* List Items with Icons */
    .about-paragraph-wrapper {
        position: relative;
    }

    .about-list-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        transition: all 0.3s ease;
    }

    .about-list-item:hover {
        transform: translateX(4px);
    }

    .about-list-icon {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        color: #1a1a1a;
        margin-top: 0.125rem;
        transition: all 0.3s ease;
    }

    .about-list-item:hover .about-list-icon {
        color: #000;
        transform: scale(1.1);
    }

    .about-list-icon svg {
        width: 100%;
        height: 100%;
    }

    .about-paragraph {
        color: #4a4a4a;
        flex: 1;
    }

    /* Counter Box */
    .about-counter-wrapper {
        display: inline-block;
    }

    .about-counter-box {
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, #f8f8f8 0%, #f0f0f0 100%);
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
    }

    .about-section-enhanced:hover .about-counter-box {
        border-color: #1a1a1a;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .about-counter-value {
        color: #1a1a1a;
    }

    .about-counter-label {
        color: #6b6b6b;
    }

    /* Button */
    .about-button {
        position: relative;
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
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: transparent;
    }

    .about-button::before {
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

    .about-button:hover::before {
        left: 0;
    }

    .about-button-text {
        position: relative;
        z-index: 1;
        transition: color 0.4s ease;
    }

    .about-button-icon {
        width: 1.25rem;
        height: 1.25rem;
        position: relative;
        z-index: 1;
        transition: transform 0.4s ease, color 0.4s ease;
    }

    .about-button:hover {
        border-color: #1a1a1a;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .about-button:hover .about-button-text {
        color: white;
    }

    .about-button:hover .about-button-icon {
        transform: translateX(4px);
        color: white;
    }

    /* Image Wrapper */
    .about-image-wrapper {
        position: relative;
    }

    .about-image-frame {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        transition: all 0.5s ease;
        background: white;
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 500px;
    }

    .about-section-enhanced:hover .about-image-frame {
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
        transform: translateY(-4px);
    }

    /* Carousel Container */
    .about-carousel-container {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .about-carousel-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .about-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .about-section-enhanced:hover .about-image {
        transform: scale(1.05);
    }

    /* Image Corner Decorations */
    .about-image-corner {
        position: absolute;
        width: 40px;
        height: 40px;
        border: 2px solid #1a1a1a;
        z-index: 1;
        transition: all 0.4s ease;
        opacity: 0.3;
    }

    .about-corner-tl {
        top: -2px;
        left: -2px;
        border-right: none;
        border-bottom: none;
        border-radius: 16px 0 0 0;
    }

    .about-corner-tr {
        top: -2px;
        right: -2px;
        border-left: none;
        border-bottom: none;
        border-radius: 0 16px 0 0;
    }

    .about-corner-bl {
        bottom: -2px;
        left: -2px;
        border-right: none;
        border-top: none;
        border-radius: 0 0 0 16px;
    }

    .about-corner-br {
        bottom: -2px;
        right: -2px;
        border-left: none;
        border-top: none;
        border-radius: 0 0 16px 0;
    }

    .about-section-enhanced:hover .about-image-corner {
        width: 50px;
        height: 50px;
        opacity: 0.6;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    /* Responsive Adjustments */
    @media (max-width: 1023px) {
        .about-image-frame {
            height: 400px;
        }

        .about-image-corner {
            width: 30px;
            height: 30px;
        }

        .about-section-enhanced:hover .about-image-corner {
            width: 35px;
            height: 35px;
        }
    }

    @media (max-width: 767px) {
        .about-image-frame {
            height: 350px;
        }

        .about-list-icon {
            width: 18px;
            height: 18px;
        }
    }
</style>
@endonce

