@props([
    'title' => 'EXPERTISE. PROFESSIONALISM. DEDICATION.',
    'description' => 'The ATHA Construction offers an unparalleled level of service, expertise and discretion to its clients, buyers and sellers alike, across the globe.',
    'stats' => [],
    'backgroundImage' => 'images/blog-2.jpeg',
    'sectionId' => 'next-section'
])

<section class="stats-section-enhanced relative bg-cover bg-center bg-no-repeat overflow-hidden {{ $sectionId ? 'id="' . $sectionId . '"' : '' }}"
         style="background-image: url('{{ asset($backgroundImage) }}')"
         x-data="{ visible: false }"
         x-intersect="visible = true">
    
    {{-- Background Overlay with Gradient --}}
    <div class="absolute inset-0 stats-overlay"></div>
    
    {{-- Animated Background Pattern --}}
    <div class="absolute inset-0 stats-bg-pattern"></div>

    <div class="relative z-10 py-16 lg:py-24">
        <div class="container mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-12 lg:mb-16">
                {{-- Top Decoration --}}
                <div class="stats-top-decoration opacity-0 mb-6"
                     :class="{ 'animate-fade-in-down': visible }" 
                     style="animation-delay: 0.2s;">
                    <div class="stats-decoration-line"></div>
                </div>

                {{-- Title --}}
                <h2 class="font-tenor text-3xl lg:text-5xl uppercase mb-6 stats-title opacity-0"
                    :class="{ 'animate-fade-in-up': visible }" 
                    style="animation-delay: 0.3s;">
                    {{ $title }}
                </h2>

                {{-- Description --}}
                <p class="text-sm lg:text-base max-w-3xl mx-auto leading-relaxed stats-description opacity-0"
                   :class="{ 'animate-fade-in-up': visible }" 
                   style="animation-delay: 0.4s;">
                    {{ $description }}
                </p>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 max-w-5xl mx-auto">
                @foreach($stats as $index => $stat)
                    @php
                        $numericPart = preg_replace('/[^\d\.]/', '', $stat['number']);
                        $suffixPart = preg_replace('/[\d\.]/', '', $stat['number']);
                        $targetValue = $numericPart !== '' ? (float) $numericPart : 0;
                        
                        // Check if this is the "2M+" stat that needs step animation (0 -> 0.5 -> 1 -> 1.5 -> 2)
                        $isStepCounter = (stripos($stat['number'], '2M') !== false && $targetValue == 2);
                    @endphp
                    <div class="stats-card-wrapper opacity-0"
                         :class="{ 'animate-fade-in-up': visible }" 
                         style="animation-delay: {{ 0.5 + ($index * 0.15) }}s;">
                        <div class="stats-card group">
                            {{-- Decorative Top Element --}}
                            <!-- <div class="stats-card-top-decoration"></div> -->
                            
                            {{-- Stat Number --}}
                            <div class="stats-number-wrapper"
                                 @if($isStepCounter)
                                     x-data="aboutCounter({ target: @js($targetValue), suffix: @js($suffixPart) })"
                                 @else
                                     x-data="statCounter({ target: @js($targetValue), suffix: @js($suffixPart) })"
                                 @endif
                                 x-intersect.once="start()">
                                <p class="font-tenor text-4xl lg:text-5xl font-bold stats-number" x-text="displayValue">
                                    {{ $stat['number'] }}
                                </p>
                            </div>

                            {{-- Divider --}}
                            <div class="stats-divider"></div>

                            {{-- Stat Label --}}
                            <p class="text-xs lg:text-sm font-medium stats-label">{{ $stat['label'] }}</p>

                            {{-- Decorative Bottom Element --}}
                            <!-- <div class="stats-card-bottom-decoration"></div> -->
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Bottom Decoration --}}
            <!-- <div class="stats-bottom-decoration opacity-0 mt-12"
                 :class="{ 'animate-fade-in-up': visible }" 
                 style="animation-delay: {{ 0.5 + (count($stats) * 0.15) + 0.2 }}s;">
                <div class="stats-decoration-dots">
                    <div class="stats-dot"></div>
                    <div class="stats-dot"></div>
                    <div class="stats-dot"></div>
                </div>
            </div> -->
        </div>
    </div>
</section>

@once
<style>
    /* Stats Section Enhanced Styles */
    .stats-section-enhanced {
        position: relative;
    }

    /* Background Overlay */
    .stats-overlay {
        background: linear-gradient(
            135deg,
            rgba(255, 255, 255, 0.95) 0%,
            rgba(255, 255, 255, 0.92) 50%,
            rgba(255, 255, 255, 0.95) 100%
        );
        backdrop-filter: blur(1px);
    }

    /* Background Pattern */
    .stats-bg-pattern {
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(0, 0, 0, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
        background-size: 400px 400px;
        animation: patternFloat 20s ease-in-out infinite;
        opacity: 0.5;
    }

    @keyframes patternFloat {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(30px, 30px); }
    }

    /* Top Decoration */
    .stats-top-decoration {
        display: flex;
        justify-content: center;
    }

    .stats-decoration-line {
        width: 100px;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.3), transparent);
    }

    /* Title */
    .stats-title {
        color: #1a1a1a;
        letter-spacing: 0.05em;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .stats-title::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #1a1a1a, transparent);
        opacity: 0.6;
    }

    /* Description */
    .stats-description {
        color: #4a4a4a;
    }

    /* Stats Card Wrapper */
    .stats-card-wrapper {
        position: relative;
    }

    /* Stats Card */
    .stats-card {
        position: relative;
        background: white;
        border: 2px solid #e8e8e8;
        border-radius: 16px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.02), transparent);
        transition: left 0.6s ease;
    }

    .stats-card:hover::before {
        left: 100%;
    }

    .stats-card:hover {
        border-color: #1a1a1a;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        transform: translateY(-8px);
    }

    /* Card Top Decoration */
    .stats-card-top-decoration {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #1a1a1a, transparent);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .stats-card:hover .stats-card-top-decoration {
        opacity: 0.6;
    }

    /* Number Wrapper */
    .stats-number-wrapper {
        margin-bottom: 1rem;
    }

    /* Number */
    .stats-number {
        color: #1a1a1a;
        line-height: 1.2;
        transition: transform 0.3s ease;
    }

    .stats-card:hover .stats-number {
        transform: scale(1.1);
    }

    /* Divider */
    .stats-divider {
        width: 50px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #1a1a1a, transparent);
        margin: 1rem auto;
        opacity: 0.4;
        transition: all 0.4s ease;
    }

    .stats-card:hover .stats-divider {
        width: 70px;
        opacity: 0.6;
    }

    /* Label */
    .stats-label {
        color: #6b6b6b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: color 0.3s ease;
    }

    .stats-card:hover .stats-label {
        color: #1a1a1a;
    }

    /* Card Bottom Decoration */
    .stats-card-bottom-decoration {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #1a1a1a, transparent);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .stats-card:hover .stats-card-bottom-decoration {
        opacity: 0.4;
    }

    /* Bottom Decoration */
    .stats-bottom-decoration {
        display: flex;
        justify-content: center;
    }

    .stats-decoration-dots {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .stats-dot {
        width: 8px;
        height: 8px;
        background: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        animation: dotPulse 2s ease-in-out infinite;
    }

    .stats-dot:nth-child(1) {
        animation-delay: 0s;
    }

    .stats-dot:nth-child(2) {
        animation-delay: 0.3s;
    }

    .stats-dot:nth-child(3) {
        animation-delay: 0.6s;
    }

    @keyframes dotPulse {
        0%, 100% {
            opacity: 0.3;
            transform: scale(1);
        }
        50% {
            opacity: 0.6;
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
        .stats-card {
            padding: 1.5rem 1rem;
        }

        .stats-number {
            font-size: 2.5rem;
        }

        .stats-title {
            font-size: 2rem;
        }

        .stats-title::after {
            width: 60px;
            bottom: -8px;
        }
    }
</style>
@endonce

