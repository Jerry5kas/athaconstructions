@props([
    'backgroundTitle' => 'PHILOSOPHY',
    'title' => 'OUR PHILOSOPHY',
    'mainQuote' => 'Construction is more than building structures.',
    'supportingText' => 'Our philosophy is to create meaningful spaces that nurture growth, feel effortlessly comfortable, and are built on uncompromising trust.',
    'images' => [
        'images/logo mockup 1.png',
        'images/logo mockup 2.png',
        'images/logo mockup 3.png',
        'images/logo mockup 4.png',
        'images/logo mockup 5.png',
        'images/logo mockup 6.png',
    ],
    'carouselInterval' => 4000, // Auto-transition interval in milliseconds
    'pillars' => [
        ['label' => 'Growth', 'icon' => 'growth'],
        ['label' => 'Comfort', 'icon' => 'comfort'],
        ['label' => 'Trust', 'icon' => 'trust'],
    ],
])

<section class="py-12 lg:py-16 relative philosophy-section overflow-hidden" 
         x-data="{ 
             visible: false,
             currentSlide: 0,
             totalSlides: {{ count($images) }},
             interval: null,
             carouselStarted: false,
             init() {
                 setTimeout(() => {
                     if (this.totalSlides > 1) {
                         this.startCarousel();
                         this.carouselStarted = true;
                     }
                 }, 2000);
             },
             startCarousel() {
                 this.stopCarousel();
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
             }
         }"
         @mouseenter="stopCarousel()"
         @mouseleave="if (carouselStarted && totalSlides > 1) { setTimeout(() => startCarousel(), 500); }"
         x-intersect="visible = true">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 philosophy-grid-pattern opacity-[0.02]"></div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto">
            {{-- Compact Section Header --}}
            <div class="text-center mb-10 lg:mb-12">
                <div class="inline-block mb-3">
                    <span class="font-tenor text-3xl lg:text-5xl text-black/5 font-bold tracking-tight">
                        {{ $backgroundTitle }}
                    </span>
                </div>
                <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-3 animate-on-scroll opacity-0 relative inline-block" style="animation-delay: 0.1s;">
                    {{ $title }}
                    <span class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-16 h-0.5 bg-black"></span>
                </h2>
            </div>

            {{-- Main Philosophy Content - Compact Split Design --}}
            <div class="grid lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
                {{-- Left Side: Visual Element with Auto-Transitioning Carousel --}}
                <div class="lg:col-span-5 order-2 lg:order-1 flex">
                    <div class="philosophy-visual-container animate-on-scroll opacity-0 w-full" style="animation-delay: 0.3s;">
                        {{-- Compact Frame Design --}}
                        <div class="philosophy-visual-frame h-full">
                            {{-- Carousel Container --}}
                            <div class="philosophy-carousel-container relative w-full h-full overflow-hidden">
                                @foreach($images as $index => $imagePath)
                                    <div 
                                        x-show="currentSlide === {{ $index }}"
                                        x-transition:enter="transition ease-out duration-1000"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-1000"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        class="absolute inset-0"
                                        style="{{ $index === 0 ? '' : 'display: none;' }}"
                                    >
                                        <img 
                                            src="{{ asset($imagePath) }}" 
                                            alt="Atha Construction Philosophy - Image {{ $index + 1 }}" 
                                            class="philosophy-image"
                                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                        >
                                    </div>
                                @endforeach
                            </div>
                            <!-- <div class="philosophy-image-overlay"></div> -->
                            <!-- <div class="philosophy-logo-wrapper">
                                <img 
                                    src="{{ asset('images/Atha Logo - High Quality-White.png') }}" 
                                    alt="Atha Construction" 
                                    class="philosophy-logo"
                                >
                            </div> -->
                        </div>
                    </div>
                </div>

                {{-- Right Side: Philosophy Text --}}
                <div class="lg:col-span-7 order-1 lg:order-2 flex">
                    <div class="philosophy-content-wrapper w-full flex flex-col justify-center">
                        {{-- Main Quote --}}
                        <div class="philosophy-main-quote animate-on-scroll opacity-0" style="animation-delay: 0.4s;">
                            <p class="text-xl lg:text-2xl leading-relaxed font-light text-gray-900 mb-3">
                                {{ $mainQuote }}
                            </p>
                        </div>

                        {{-- Supporting Text --}}
                        <div class="philosophy-supporting-text animate-on-scroll opacity-0" style="animation-delay: 0.5s;">
                            <p class="text-sm lg:text-base leading-relaxed text-gray-700 mb-5">
                                {{ $supportingText }}
                            </p>
                        </div>

                        {{-- Philosophy Pillars --}}
                        <div class="philosophy-pillars mt-4 animate-on-scroll opacity-0" style="animation-delay: 0.6s;">
                            <div class="grid grid-cols-3 gap-3 lg:gap-4">
                                @foreach($pillars as $pillar)
                                    <div class="philosophy-pillar">
                                        <div class="philosophy-pillar-icon">
                                            @if($pillar['icon'] === 'growth')
                                                {{-- Growth: upward bars / arrow --}}
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M4 20V14" />
                                                    <path d="M10 20V10" />
                                                    <path d="M16 20V6" />
                                                    <path d="M3 9L8 4L12 8L20 2" />
                                                    <path d="M18 2H20V4" />
                                                </svg>
                                            @elseif($pillar['icon'] === 'comfort')
                                                {{-- Comfort: home/sofa outline --}}
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M4 11V7.5C4 6.12 5.12 5 6.5 5H9.5C10.88 5 12 6.12 12 7.5V11" />
                                                    <path d="M12 11V7.5C12 6.12 13.12 5 14.5 5H17.5C18.88 5 20 6.12 20 7.5V11" />
                                                    <path d="M3 11H21V17C21 18.1 20.1 19 19 19H5C3.9 19 3 18.1 3 17V11Z" />
                                                    <path d="M7 15H9" />
                                                    <path d="M15 15H17" />
                                                </svg>
                                            @elseif($pillar['icon'] === 'trust')
                                                {{-- Trust: shield with check --}}
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M12 2L5 5V11C5 15.55 8.06 19.74 12 21C15.94 19.74 19 15.55 19 11V5L12 2Z" />
                                                    <path d="M9 12L11 14L15 10" />
                                                </svg>
                                            @endif
                                        </div>
                                        <span class="philosophy-pillar-text">{{ $pillar['label'] }}</span>
                                    </div>
                                @endforeach
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
    .philosophy-visual-container {
        display: flex;
        flex-direction: column;
    }

    .philosophy-visual-frame {
        display: flex;
        flex-direction: column;
        flex: 1;
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .philosophy-visual-frame:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .philosophy-carousel-container {
        position: relative;
        width: 100%;
        height: 100%;
        flex: 1;
        min-height: 0;
    }

    .philosophy-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.6s ease;
    }

    .philosophy-visual-frame:hover .philosophy-image {
        transform: scale(1.02);
    }

    .philosophy-image-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 40%, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
        pointer-events: none;
        z-index: 1;
    }

    .philosophy-logo-wrapper {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        z-index: 2;
        pointer-events: none;
    }

    .philosophy-logo {
        width: 70%;
        max-width: 320px;
        height: auto;
        filter: drop-shadow(0 6px 18px rgba(0,0,0,0.7));
    }

    /* Compact Content Styles */
    .philosophy-content-wrapper {
        padding: 0;
    }

    .philosophy-main-quote {
        position: relative;
        padding-left: 1.5rem;
        border-left: 2px solid rgba(0, 0, 0, 0.1);
    }

    .philosophy-supporting-text {
        padding-left: 1.5rem;
    }

    .philosophy-pillar {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 0.75rem;
        border: 1px solid rgba(0, 0, 0, 0.08);
        background: rgba(0, 0, 0, 0.01);
        transition: all 0.3s ease;
        border-radius: 4px;
    }

    .philosophy-pillar:hover {
        background: rgba(0, 0, 0, 0.03);
        border-color: rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .philosophy-pillar-icon {
        width: 28px;
        height: 28px;
        color: black;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .philosophy-pillar-icon svg {
        width: 100%;
        height: 100%;
    }

    .philosophy-pillar-text {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #1a1a1a;
    }

    @media (max-width: 1023px) {
        .philosophy-main-quote {
            padding-left: 1rem;
            font-size: 1.25rem;
        }

        .philosophy-supporting-text {
            padding-left: 1rem;
        }

        .philosophy-pillar {
            padding: 0.75rem 0.5rem;
        }

        .philosophy-pillar-icon {
            width: 24px;
            height: 24px;
        }

        .philosophy-pillar-text {
            font-size: 0.65rem;
        }
    }
</style>
@endonce