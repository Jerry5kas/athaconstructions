@props([
    'backgroundTitle' => 'PHILOSOPHY',
    'title' => 'OUR PHILOSOPHY',
    'mainQuote' => 'Construction is more than building structures.',
    'supportingText' => 'Our philosophy is to create meaningful spaces that nurture growth, feel effortlessly comfortable, and are built on uncompromising trust.',
    'image' => 'images/banner.jpg',
    'imageAlt' => 'Modern skyline representing Atha Construction philosophy',
    'image' => 'images/banner.jpg',
    'imageAlt' => 'Modern skyline representing Atha Construction philosophy',
    'pillars' => [
        ['label' => 'Growth', 'icon' => 'growth'],
        ['label' => 'Comfort', 'icon' => 'comfort'],
        ['label' => 'Trust', 'icon' => 'trust'],
    ],
])

<section class="py-20 lg:py-28 relative philosophy-section overflow-hidden" 
         x-data="{ visible: false }" 
         x-intersect="visible = true">
    {{-- Sophisticated Background Pattern --}}
    <div class="absolute inset-0 pointer-events-none">
        {{-- Grid Pattern --}}
        <div class="absolute inset-0 philosophy-grid-pattern opacity-[0.03]"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-7xl mx-auto">
            {{-- Section Header with Elegant Design --}}
            <div class="text-center mb-16 lg:mb-20">
                <div class="inline-block mb-6">
                    <span class="font-tenor text-5xl lg:text-7xl text-black/5 font-bold tracking-tight">
                        {{ $backgroundTitle }}
                    </span>
                </div>
                <h2 class="font-tenor text-3xl lg:text-4xl uppercase mb-4 animate-on-scroll opacity-0 relative inline-block" style="animation-delay: 0.1s;">
                    {{ $title }}
                    <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-20 h-0.5 bg-black"></span>
                </h2>
            </div>

            {{-- Main Philosophy Content - Split Design --}}
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                {{-- Left Side: Visual Element --}}
                <div class="lg:col-span-5 order-2 lg:order-1">
                    <div class="philosophy-visual-container animate-on-scroll opacity-0" style="animation-delay: 0.3s;">
                        {{-- Elegant Frame Design --}}
                        <div class="philosophy-visual-frame">
                            {{-- Image with dark overlay and centered logo --}}
                            <img 
                                src="{{ asset($image) }}" 
                                alt="{{ $imageAlt }}" 
                                class="philosophy-image"
                            >
                            <div class="philosophy-image-overlay"></div>
                            <div class="philosophy-logo-wrapper">
                                <img 
                                    src="{{ asset('images/Atha Logo - High Quality-White.png') }}" 
                                    alt="Atha Construction" 
                                    class="philosophy-logo"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side: Philosophy Text --}}
                <div class="lg:col-span-7 order-1 lg:order-2">
                    <div class="philosophy-content-wrapper">
                        {{-- Main Quote --}}
                        <div class="philosophy-main-quote animate-on-scroll opacity-0" style="animation-delay: 0.4s;">
                            <p class="text-2xl lg:text-3xl leading-relaxed font-light text-gray-900 mb-4">
                                {{ $mainQuote }}
                            </p>
                        </div>

                        {{-- Supporting Text --}}
                        <div class="philosophy-supporting-text animate-on-scroll opacity-0" style="animation-delay: 0.5s;">
                            <p class="text-base lg:text-lg leading-relaxed text-gray-700 mb-4">
                                {{ $supportingText }}
                            </p>
                        </div>

                        {{-- Philosophy Pillars --}}
                        <div class="philosophy-pillars mt-6 animate-on-scroll opacity-0" style="animation-delay: 0.6s;">
                            <div class="grid grid-cols-3 gap-4 lg:gap-6">
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
    .philosophy-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .philosophy-image-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 40%, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
        pointer-events: none;
    }

    .philosophy-logo-wrapper {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }

    .philosophy-logo {
        width: 70%;
        max-width: 320px;
        height: auto;
        filter: drop-shadow(0 6px 18px rgba(0,0,0,0.7));
    }
</style>
@endonce