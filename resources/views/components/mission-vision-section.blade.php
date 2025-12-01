@props([
    'title' => 'MISSION & VISION',
    'subtitle' => 'Purpose & direction that shapes every project',
    'blocks' => [],
])

@php
    // Each block: ['title' => '', 'icon' => '', 'description' => [], 'bg' => '']
@endphp

<section class="py-16 lg:py-20 bg-black text-white mission-vision-section" 
         x-data="{ visible: false }" 
         x-intersect="visible = true">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            {{-- Section Title --}}
            <div class="text-center mb-12 lg:mb-16">
                @if($subtitle)
                    <p class="mission-vision-subtitle text-xs lg:text-sm tracking-[0.2em] uppercase text-gray-400 mb-3 animate-on-scroll opacity-0" style="animation-delay: 0.05s;">
                        {{ $subtitle }}
                    </p>
                @endif
                <h2 class="font-tenor text-2xl lg:3xl lg:text-3xl uppercase mb-3 animate-on-scroll opacity-0" style="animation-delay: 0.1s;">
                    {{ $title }}
                </h2>
                <div class="mission-vision-title-underline animate-on-scroll opacity-0 mx-auto" style="animation-delay: 0.15s;"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 lg:gap-12">
                @foreach($blocks as $index => $block)
                    @php
                        $bgImage = $block['bg'] ?? null;
                    @endphp
                    <div class="mission-vision-card-wrapper opacity-0"
                         :class="{ 'animate-fade-in-up': visible }"
                         style="animation-delay: {{ 0.2 + ($index * 0.2) }}s;">
                        <div class="mission-vision-card">
                            @if($bgImage)
                                <div class="mission-vision-bg" style="background-image: url('{{ asset($bgImage) }}');"></div>
                                <div class="mission-vision-bg-overlay"></div>
                            @endif

                            {{-- Card Header --}}
                            <div class="mission-vision-card-header">
                                <!-- <div class="mission-vision-label-wrapper">
                                    <span class="mission-vision-label">0{{ $index + 1 }}</span>
                                </div> -->
                                <div class="mission-vision-icon-wrapper">
                                    @if(!empty($block['icon']))
                                        <img src="{{ asset($block['icon']) }}" alt="{{ $block['title'] }}" class="mission-vision-icon">
                                    @endif
                                </div>
                                <h3 class="font-tenor text-xl lg:text-2xl uppercase mt-6 mb-3">
                                    {{ strtoupper($block['title'] ?? '') }}
                                </h3>
                                <div class="w-16 h-0.5 bg-white mx-auto"></div>
                            </div>

                            {{-- Card Content --}}
                            <div class="mission-vision-card-content">
                                <div class="space-y-3 lg:space-y-4 text-sm lg:text-base leading-relaxed text-gray-200">
                                    @foreach(($block['description'] ?? []) as $paragraph)
                                        <p>{{ $paragraph }}</p>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Decorative Corner --}}
                            <div class="mission-vision-corner"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@once
<style>
    .mission-vision-section {
        position: relative;
        overflow: hidden;
    }

    .mission-vision-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, white, transparent);
        opacity: 0.2;
    }

    .mission-vision-card {
        position: relative;
        background: rgba(15, 15, 15, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.12);
        padding: 3rem 2rem;
        transition: all 0.4s ease;
        backdrop-filter: blur(10px);
        overflow: hidden;
    }

    .mission-vision-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, rgba(255,255,255,0.5), rgba(255,255,255,0));
        opacity: 0.4;
        z-index: 2;
    }

    .mission-vision-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0.18;
        filter: grayscale(40%);
        transform: scale(1.05);
        z-index: 0;
    }

    .mission-vision-bg-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.6));
        z-index: 1;
    }

    .mission-vision-card > * {
        position: relative;
        z-index: 2;
    }

    .mission-vision-card:hover {
        background: rgba(20, 20, 20, 0.95);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-5px);
        box-shadow: 0 24px 80px rgba(0, 0, 0, 0.65);
    }

    .mission-vision-card-header {
        text-align: center;
        margin-bottom: 1.75rem;
        position: relative;
    }

    .mission-vision-label-wrapper {
        position: absolute;
        top: -1.5rem;
        left: 50%;
        transform: translateX(-50%);
    }

    .mission-vision-label {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.15rem 0.85rem;
        border-radius: 999px;
        border: 1px solid rgba(255,255,255,0.3);
        font-size: 0.625rem;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.8);
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(6px);
    }

    .mission-vision-icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.04);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s ease;
    }

    .mission-vision-card:hover .mission-vision-icon-wrapper {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.35);
        transform: scale(1.08);
    }

    .mission-vision-icon {
        width: 40px;
        height: 40px;
        object-fit: contain;
        filter: brightness(0) invert(1);
    }

    .mission-vision-card-content {
        text-align: center;
    }
    .mission-vision-subtitle {
        letter-spacing: 0.22em;
    }

    .mission-vision-title-underline {
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, transparent, white, transparent);
    }

    .mission-vision-corner {
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;
        height: 60px;
        border-top: 2px solid rgba(255, 255, 255, 0.18);
        border-right: 2px solid rgba(255, 255, 255, 0.18);
        z-index: 2;
        transition: all 0.4s ease;
    }

    .mission-vision-card:hover .mission-vision-corner {
        border-color: rgba(255, 255, 255, 0.4);
        width: 80px;
        height: 80px;
    }

    /* Animations */
    @keyframes mv-fadeInUp {
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
        animation: mv-fadeInUp 0.8s ease-out forwards;
    }

    /* Responsive Adjustments */
    @media (max-width: 767px) {
        .mission-vision-card {
            padding: 2rem 1.5rem;
        }

        .mission-vision-icon-wrapper {
            width: 60px;
            height: 60px;
        }

        .mission-vision-icon {
            width: 30px;
            height: 30px;
        }
    }
</style>
@endonce


