@props([
    'title' => 'OUR SERVICES',
    'description' => 'We deliver comprehensive construction solutions tailored to your vision. Our expert team brings quality, innovation, and reliability to every project.',
    'services' => [],
    'ctaText' => 'VIEW ALL SERVICES',
    'ctaLink' => '#',
    'showCta' => true,
])

<section class="services-section py-16 lg:py-24 bg-black text-white relative overflow-hidden"
         x-data="{ visible: false }"
         x-intersect="visible = true">
    
    {{-- Animated Background Elements --}}
    <div class="absolute inset-0 services-bg-pattern"></div>
    
    {{-- Decorative Grid Overlay --}}
    <div class="absolute inset-0 services-grid-overlay"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-12 lg:mb-16">
            {{-- Top Decoration --}}
            <div class="services-top-decoration opacity-0 mb-6"
                 :class="{ 'animate-fade-in-down': visible }" 
                 style="animation-delay: 0.2s;">
                <div class="services-decoration-line"></div>
            </div>

            {{-- Title --}}
            <h2 class="font-tenor text-3xl lg:text-5xl uppercase mb-6 services-title opacity-0"
                :class="{ 'animate-fade-in-up': visible }" 
                style="animation-delay: 0.3s;">
                {{ $title }}
            </h2>

            {{-- Description --}}
            <p class="text-sm lg:text-base text-gray-300 text-center max-w-3xl mx-auto leading-relaxed services-description opacity-0"
               :class="{ 'animate-fade-in-up': visible }" 
               style="animation-delay: 0.4s;">
                {{ $description }}
            </p>
        </div>

        {{-- Services Slider Component --}}
        <div class="mb-8 lg:mb-12 opacity-0"
             :class="{ 'animate-fade-in-up': visible }" 
             style="animation-delay: 0.5s;">
            <x-services-slider :services="$services"/>
        </div>

        {{-- CTA Button --}}
        @if($showCta)
            <div class="text-center opacity-0"
                 :class="{ 'animate-fade-in-up': visible }" 
                 style="animation-delay: 0.6s;">
                <a 
                    href="{{ $ctaLink }}" 
                    class="services-cta-button group inline-flex items-center gap-3"
                >
                    <span class="services-cta-text">{{ $ctaText }}</span>
                    <svg class="services-cta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        @endif

        {{-- Bottom Decoration --}}
        <!-- <div class="services-bottom-decoration opacity-0 mt-12"
             :class="{ 'animate-fade-in-up': visible }" 
             style="animation-delay: 0.7s;">
            <div class="services-decoration-dots">
                <div class="services-dot"></div>
                <div class="services-dot"></div>
                <div class="services-dot"></div>
            </div>
        </div> -->
    </div>
</section>

@once
<style>
    /* Services Section Styles */
    .services-section {
        position: relative;
        background: linear-gradient(180deg, #000000 0%, #0a0a0a 100%);
    }

    /* Background Pattern */
    .services-bg-pattern {
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
        background-size: 500px 500px;
        animation: patternFloat 20s ease-in-out infinite;
        opacity: 0.6;
    }

    @keyframes patternFloat {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(40px, 40px); }
    }

    /* Grid Overlay */
    .services-grid-overlay {
        background-image: 
            linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        opacity: 0.3;
    }

    /* Top Decoration */
    .services-top-decoration {
        display: flex;
        justify-content: center;
    }

    .services-decoration-line {
        width: 100px;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    }

    /* Title */
    .services-title {
        text-shadow: 0 4px 20px rgba(255, 255, 255, 0.1);
        letter-spacing: 0.05em;
        position: relative;
    }

    .services-title::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, transparent, white, transparent);
        opacity: 0.6;
    }

    /* Description */
    .services-description {
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    /* CTA Button */
    .services-cta-button {
        position: relative;
        padding: 1rem 2.5rem;
        border: 2px solid white;
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        text-decoration: none;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: transparent;
    }

    .services-cta-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: white;
        transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 0;
    }

    .services-cta-button:hover::before {
        left: 0;
    }

    .services-cta-text {
        position: relative;
        z-index: 1;
        transition: color 0.4s ease;
    }

    .services-cta-icon {
        width: 1.25rem;
        height: 1.25rem;
        position: relative;
        z-index: 1;
        transition: transform 0.4s ease, color 0.4s ease;
    }

    .services-cta-button:hover {
        border-color: white;
        box-shadow: 0 10px 40px rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .services-cta-button:hover .services-cta-text {
        color: black;
    }

    .services-cta-button:hover .services-cta-icon {
        transform: translateX(4px);
        color: black;
    }

    /* Bottom Decoration */
    .services-bottom-decoration {
        display: flex;
        justify-content: center;
    }

    .services-decoration-dots {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .services-dot {
        width: 8px;
        height: 8px;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        animation: dotPulse 2s ease-in-out infinite;
    }

    .services-dot:nth-child(1) {
        animation-delay: 0s;
    }

    .services-dot:nth-child(2) {
        animation-delay: 0.3s;
    }

    .services-dot:nth-child(3) {
        animation-delay: 0.6s;
    }

    @keyframes dotPulse {
        0%, 100% {
            opacity: 0.4;
            transform: scale(1);
        }
        50% {
            opacity: 1;
            transform: scale(1.3);
        }
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

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

    .animate-fade-in-down {
        animation: fadeInDown 0.8s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    /* Responsive Adjustments */
    @media (max-width: 767px) {
        .services-section {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .services-title {
            font-size: 2rem;
        }

        .services-title::after {
            width: 40px;
            bottom: -8px;
        }

        .services-cta-button {
            padding: 0.875rem 2rem;
            font-size: 0.8125rem;
        }
    }
</style>
@endonce

