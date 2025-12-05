@props([
    'title' => 'What makes us stand out?',
    'athaAdvantages' => [],
    'otherContractors' => [],
])

<section class="comparison-section py-12 lg:py-16 bg-white relative overflow-hidden"
         x-data="{ visible: false }"
         x-intersect="visible = true">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 comparison-bg-pattern"></div>
    
    {{-- Decorative Vertical Dashed Line --}}
    <div class="absolute inset-0 pointer-events-none comparison-dashed-line">
        <svg class="w-full h-full" viewBox="0 0 1200 800" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M600 0 L600 800" stroke="currentColor" stroke-width="1" stroke-dasharray="20 10"/>
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-8 lg:mb-10">
            {{-- Top Decoration --}}
            <div class="comparison-top-decoration opacity-0 mb-6"
                 :class="{ 'animate-fade-in-down': visible }" 
                 style="animation-delay: 0.2s;">
                <div class="comparison-decoration-line"></div>
            </div>

            <h2 class="font-tenor text-2xl lg:text-4xl uppercase mb-3 tracking-tight comparison-title opacity-0"
                :class="{ 'animate-fade-in-up': visible }" 
                style="animation-delay: 0.3s;">
                <span class="hidden md:inline">{{ $title }}</span>
                <span class="md:hidden">{{ str_replace('?', '<br>?', $title) }}</span>
            </h2>
            
            <div class="w-24 h-0.5 bg-black mx-auto comparison-divider opacity-0"
                 :class="{ 'animate-fade-in-up': visible }" 
                 style="animation-delay: 0.4s;"></div>
        </div>

        <div class="max-w-7xl mx-auto">
            {{-- Desktop: Asymmetric Split Design --}}
            <div class="hidden lg:block relative">
                {{-- Center Icon on Vertical Dashed Line --}}
                <div class="absolute left-1/2 top-0 bottom-0 w-px transform -translate-x-1/2 z-0 comparison-center-line">
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center comparison-center-icon">
                        <svg class="w-10 h-10 text-black" fill="none" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                            <path d="M32 8 L56 20 L56 44 L32 56 L8 44 L8 20 Z" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M32 20 L44 26 L44 38 L32 44 L20 38 L20 26 Z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        </svg>
                    </div>
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-px h-1/2 bg-gradient-to-b from-transparent via-gray-200 to-gray-200"></div>
                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-px h-1/2 bg-gradient-to-b from-gray-200 via-gray-200 to-transparent"></div>
                </div>

                <div class="grid grid-cols-12 gap-4 items-start">
                    {{-- ATHA CONSTRUCTION Side --}}
                    <div class="col-span-5 pr-8">
                        <div class="sticky top-24">
                            {{-- Header with SVG --}}
                            <div class="mb-6 comparison-header-left opacity-0"
                                 :class="{ 'animate-fade-in-left': visible }" 
                                 style="animation-delay: 0.5s;">
                                <div class="flex items-center gap-3 mb-4">
                                    <svg class="w-6 h-6 text-black flex-shrink-0" fill="none" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="4" y="8" width="24" height="18" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                                        <path d="M8 14 L16 20 L24 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle cx="10" cy="6" r="1.5" fill="currentColor"/>
                                        <circle cx="16" cy="6" r="1.5" fill="currentColor"/>
                                        <circle cx="22" cy="6" r="1.5" fill="currentColor"/>
                                    </svg>
                                    <h3 class="font-tenor text-2xl lg:text-3xl uppercase tracking-tight">ATHA<br>CONSTRUCTION</h3>
                                </div>
                                <div class="w-32 h-1 bg-black comparison-header-line"></div>
                            </div>
                            
                            {{-- Items with Custom SVGs --}}
                            <div class="space-y-3">
                                @foreach($athaAdvantages as $index => $advantage)
                                    <div class="comparison-item-left opacity-0"
                                         :class="{ 'animate-fade-in-left': visible }"
                                         style="animation-delay: {{ 0.6 + ($index * 0.1) }}s">
                                        <div class="comparison-item-card comparison-item-card-left group">
                                            <div class="flex items-center gap-4">
                                                <div class="flex-shrink-0">
                                                    <div class="comparison-icon-box comparison-icon-box-left">
                                                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-sm text-gray-900 leading-relaxed comparison-item-text">{{ $advantage }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Spacer Column --}}
                    <div class="col-span-2"></div>

                    {{-- OTHER CONTRACTORS Side --}}
                    <div class="col-span-5 pl-8">
                        <div class="sticky top-24">
                            {{-- Header with SVG --}}
                            <div class="mb-6 comparison-header-right opacity-0"
                                 :class="{ 'animate-fade-in-right': visible }" 
                                 style="animation-delay: 0.5s;">
                                <div class="flex items-center gap-3 mb-4 justify-end">
                                    <h3 class="font-tenor text-2xl lg:text-3xl uppercase tracking-tight text-gray-300 text-right">OTHER<br>CONTRACTORS</h3>
                                    <svg class="w-6 h-6 text-gray-300 flex-shrink-0" fill="none" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="4" y="8" width="24" height="18" rx="2" stroke="currentColor" stroke-width="1.5" fill="none" stroke-dasharray="4 4"/>
                                        <path d="M8 14 L16 20 L24 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="2 2"/>
                                    </svg>
                                </div>
                                <div class="w-32 h-1 bg-gray-300 ml-auto comparison-header-line"></div>
                            </div>
                            
                            {{-- Items with Custom SVGs --}}
                            <div class="space-y-3">
                                @foreach($otherContractors as $index => $disadvantage)
                                    <div class="comparison-item-right opacity-0"
                                         :class="{ 'animate-fade-in-right': visible }"
                                         style="animation-delay: {{ 0.6 + ($index * 0.1) }}s">
                                        <div class="comparison-item-card comparison-item-card-right group">
                                            <div class="flex items-center gap-4">
                                                <div class="flex-1 text-right">
                                                    <p class="text-sm text-gray-400 leading-relaxed line-through comparison-item-text">{{ $disadvantage }}</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="comparison-icon-box comparison-icon-box-right">
                                                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mobile: Stacked Design --}}
            <div class="lg:hidden space-y-12">
                {{-- ATHA CONSTRUCTION --}}
                <div>
                    <div class="mb-6 comparison-header-left opacity-0"
                         :class="{ 'animate-fade-in-left': visible }" 
                         style="animation-delay: 0.5s;">
                        <div class="flex items-center gap-3 mb-4">
                            <svg class="w-5 h-5 text-black" fill="none" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <rect x="4" y="8" width="24" height="18" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                                <path d="M8 14 L16 20 L24 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <h3 class="font-tenor text-xl uppercase tracking-tight">ATHA CONSTRUCTION</h3>
                        </div>
                        <div class="w-20 h-0.5 bg-black"></div>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach($athaAdvantages as $index => $advantage)
                            <div class="comparison-item-left opacity-0"
                                 :class="{ 'animate-fade-in-left': visible }"
                                 style="animation-delay: {{ 0.6 + ($index * 0.1) }}s">
                                <div class="comparison-item-card comparison-item-card-left">
                                    <div class="flex items-center gap-4">
                                        <div class="flex-shrink-0">
                                            <div class="comparison-icon-box comparison-icon-box-left">
                                                <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-900 leading-relaxed flex-1">{{ $advantage }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Divider with SVG --}}
                <div class="relative py-4">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-full h-px bg-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <div class="flex items-center justify-center">
                            <svg class="w-10 h-10 text-black" fill="none" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                <path d="M32 8 L56 20 L56 44 L32 56 L8 44 L8 20 Z" stroke="currentColor" stroke-width="2" fill="none"/>
                                <path d="M32 20 L44 26 L44 38 L32 44 L20 38 L20 26 Z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- OTHER CONTRACTORS --}}
                <div>
                    <div class="mb-6 comparison-header-right opacity-0"
                         :class="{ 'animate-fade-in-right': visible }" 
                         style="animation-delay: 0.5s;">
                        <div class="flex items-center gap-3 mb-4 justify-end">
                            <h3 class="font-tenor text-xl uppercase tracking-tight text-gray-300 text-right">OTHER CONTRACTORS</h3>
                            <svg class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <rect x="4" y="8" width="24" height="18" rx="2" stroke="currentColor" stroke-width="1.5" fill="none" stroke-dasharray="4 4"/>
                            </svg>
                        </div>
                        <div class="w-20 h-0.5 bg-gray-300 ml-auto"></div>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach($otherContractors as $index => $disadvantage)
                            <div class="comparison-item-right opacity-0"
                                 :class="{ 'animate-fade-in-right': visible }"
                                 style="animation-delay: {{ 0.6 + ($index * 0.1) }}s">
                                <div class="comparison-item-card comparison-item-card-right">
                                    <div class="flex items-center gap-4">
                                        <p class="text-xs text-gray-400 leading-relaxed flex-1 text-right line-through">{{ $disadvantage }}</p>
                                        <div class="flex-shrink-0">
                                            <div class="comparison-icon-box comparison-icon-box-right">
                                                <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@once
<style>
    /* Comparison Section Styles */
    .comparison-section {
        position: relative;
        background: #fafafa;
    }

    /* Background Pattern */
    .comparison-bg-pattern {
        background-image: 
            radial-gradient(circle at 15% 25%, rgba(0, 0, 0, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 85% 75%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
        background-size: 400px 400px;
    }

    /* Dashed Line */
    .comparison-dashed-line {
        opacity: 0.05;
    }

    /* Top Decoration */
    .comparison-top-decoration {
        display: flex;
        justify-content: center;
    }

    .comparison-decoration-line {
        width: 100px;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.3), transparent);
    }

    /* Title */
    .comparison-title {
        color: #1a1a1a;
        letter-spacing: 0.02em;
    }

    /* Divider */
    .comparison-divider {
        transition: width 0.4s ease;
    }

    .comparison-section:hover .comparison-divider {
        width: 120px;
    }

    /* Center Line & Icon */
    .comparison-center-line {
        background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.1) 50%, transparent 100%);
    }

    .comparison-center-icon {
        background: white;
        border-radius: 50%;
        padding: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Header */
    .comparison-header-line {
        transition: width 0.4s ease;
    }

    .comparison-header-left:hover .comparison-header-line,
    .comparison-header-right:hover .comparison-header-line {
        width: 140px;
    }

    /* Item Cards */
    .comparison-item-card {
        padding: 1rem;
        border-radius: 10px;
        transition: all 0.4s ease;
        background: white;
        border: 1px solid #e8e8e8;
    }

    .comparison-item-card-left {
        border-left: 3px solid #1a1a1a;
    }

    .comparison-item-card-right {
        border-right: 3px solid #d0d0d0;
    }

    .comparison-item-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transform: translateX(4px);
    }

    .comparison-item-card-right:hover {
        transform: translateX(-4px);
    }

    /* Icon Boxes */
    .comparison-icon-box {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .comparison-icon-box-left {
        background: #1a1a1a;
    }

    .comparison-icon-box-right {
        background: #d0d0d0;
    }

    .comparison-item-card:hover .comparison-icon-box {
        transform: scale(1.1) rotate(5deg);
    }

    .comparison-item-card-left:hover .comparison-icon-box-left {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    /* Item Text */
    .comparison-item-text {
        transition: color 0.3s ease;
    }

    .comparison-item-card-left:hover .comparison-item-text {
        color: #1a1a1a;
        font-weight: 500;
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

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-fade-in-down {
        animation: fadeInDown 0.8s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-fade-in-left {
        animation: fadeInLeft 0.8s ease-out forwards;
    }

    .animate-fade-in-right {
        animation: fadeInRight 0.8s ease-out forwards;
    }

    /* Responsive */
    @media (max-width: 1023px) {
        .comparison-icon-box {
            width: 24px;
            height: 24px;
        }
    }
</style>
@endonce

