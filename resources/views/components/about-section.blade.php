@props([
    'subtitle' => 'ATHA Construction',
    'title' => 'Crafting Dreams, Building Legacies',
    'paragraphs' => [],
    'image' => 'images/ATHA-CONSTRUCTIONS.jpg',
    'imageAlt' => 'Best Construction Companies in Bangalore',
    'imageTitle' => 'Best Construction Companies in Bangalore',
    'buttonText' => 'KNOW MORE',
    'buttonLink' => null,
    'imagePosition' => 'right', // 'left' or 'right'
    'sectionClass' => 'about-section',
    'showCounter' => false,
    'counterValue' => 2,
    'counterSuffix' => 'M+',
    'counterLabel' => 'Sq.Ft Developed'
])

<section class="py-16 lg:py-24 {{ $sectionClass }} relative overflow-hidden about-section-enhanced"
         x-data="{ visible: false }"
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
                    <div class="about-title-wrapper opacity-0 mb-8"
                         :class="{ 'animate-fade-in-up': visible }" 
                         style="animation-delay: 0.3s;">
                        <h2 class="font-tenor text-3xl lg:text-5xl uppercase mb-4 about-title">
                            {{ $title }}
                        </h2>
                        <div class="about-title-accent"></div>
                    </div>
                @endif

                {{-- Paragraphs with Enhanced Styling --}}
                @if(!empty($paragraphs))
                    <div class="space-y-5 mb-8">
                        @foreach($paragraphs as $index => $paragraph)
                            <div class="about-paragraph-wrapper opacity-0"
                                 :class="{ 'animate-fade-in-up': visible }" 
                                 style="animation-delay: {{ 0.4 + ($index * 0.15) }}s;">
                                <p class="text-sm lg:text-base leading-relaxed text-justify about-paragraph">
                                    {{ $paragraph }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Counter with Enhanced Design --}}
                @if($showCounter)
                    <div 
                        class="about-counter-wrapper opacity-0 mb-8"
                        :class="{ 'animate-fade-in-up': visible }"
                        style="animation-delay: {{ 0.4 + (count($paragraphs) * 0.15) + 0.2 }}s;"
                        x-data="aboutCounter({ target: @js($counterValue), suffix: @js($counterSuffix) })"
                        x-intersect.once="start()"
                    >
                        <div class="about-counter-box">
                            <div class="flex items-baseline gap-3">
                                <span class="font-tenor text-4xl lg:text-5xl font-bold about-counter-value" x-text="displayValue">0{{ $counterSuffix }}</span>
                                <span class="text-sm lg:text-base text-gray-600 about-counter-label">{{ $counterLabel }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Enhanced Button --}}
                @if($buttonText && $buttonLink)
                    <div class="about-button-wrapper opacity-0"
                         :class="{ 'animate-fade-in-up': visible }"
                         style="animation-delay: {{ 0.4 + (count($paragraphs) * 0.15) + ($showCounter ? 0.5 : 0.3) }}s;">
                        <a href="{{ $buttonLink }}" class="about-button group">
                            <span class="about-button-text">{{ $buttonText }}</span>
                            <svg class="about-button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

            {{-- Enhanced Image Section --}}
            <div class="lg:col-span-5 {{ $imagePosition === 'left' ? 'lg:order-1' : '' }}">
                <div class="about-image-wrapper opacity-0"
                     :class="{ 'animate-fade-in-up': visible }" 
                     style="animation-delay: 0.5s;">
                    <div class="about-image-frame">
                        <img 
                            src="{{ asset($image) }}" 
                            alt="{{ $imageAlt }}" 
                            title="{{ $imageTitle }}"
                            class="about-image"
                        >
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
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #1a1a1a, transparent);
        margin-top: 0.75rem;
        transition: width 0.4s ease;
    }

    .about-section-enhanced:hover .about-title-accent {
        width: 120px;
    }

    /* Paragraphs */
    .about-paragraph-wrapper {
        position: relative;
    }

    .about-paragraph-wrapper::before {
        display: none;
    }

    .about-paragraph {
        color: #4a4a4a;
    }

    /* Counter Box */
    .about-counter-wrapper {
        display: inline-block;
    }

    .about-counter-box {
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, #f8f8f8 0%, #f0f0f0 100%);
        border: 2px solid #e0e0e0;
        border-radius: 12px;
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
        gap: 0.75rem;
        padding: 1rem 2.5rem;
        border: 2px solid #1a1a1a;
        color: #1a1a1a;
        font-size: 0.875rem;
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
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        transition: all 0.5s ease;
        background: white;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .about-section-enhanced:hover .about-image-frame {
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
        transform: translateY(-4px);
    }

    .about-image {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.6s ease;
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
        .about-image-corner {
            width: 30px;
            height: 30px;
        }

        .about-section-enhanced:hover .about-image-corner {
            width: 35px;
            height: 35px;
        }
    }
</style>
@endonce

