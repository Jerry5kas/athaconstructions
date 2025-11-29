@props(['steps'])

@php
    $totalSteps = count($steps);
    
    // Map step titles to icon components
    $iconMap = [
        'Initial Consultation' => 'components.icons.initial-consultation',
        'Design & Planning' => 'components.icons.design-planning',
        'Material Selection' => 'components.icons.material-selection',
        'Execution' => 'components.icons.execution',
        'Final inspections, approvals' => 'components.icons.final-inspection-approval',
        'Handover' => 'components.icons.handover',
    ];
    
    // Map step titles to GIF files (for mobile)
    $gifMap = [
        'Initial Consultation' => 'initial-consultation.gif',
        'Design & Planning' => 'design-planning.gif',
        'Material Selection' => 'material-selection.gif',
        'Execution' => 'execution.gif',
        'Final inspections, approvals' => 'final-inspection-approval.gif',
        'Handover' => 'handover.gif',
    ];
    
    function getIconComponent($title, $iconMap) {
        return $iconMap[$title] ?? null;
    }
    
    function getGifPath($title, $gifMap) {
        $gifName = $gifMap[$title] ?? null;
        if ($gifName && file_exists(public_path('images/how it works/' . $gifName))) {
            return asset('images/how it works/' . $gifName);
        }
        return null;
    }
@endphp

{{-- Desktop Version --}}
<section class="py-16 lg:py-24 hidden md:block">
    <div 
        x-data="{ 
            activeStep: 0,
            autoPlay: true,
            init() {
                if (this.autoPlay) {
                    this.interval = setInterval(() => {
                        this.activeStep = (this.activeStep + 1) % {{ $totalSteps }};
                    }, 4000);
                }
                this.$watch('activeStep', () => {
                    if (this.autoPlay) {
                        clearInterval(this.interval);
                        this.interval = setInterval(() => {
                            this.activeStep = (this.activeStep + 1) % {{ $totalSteps }};
                        }, 4000);
                    }
                });
            },
            goToStep(index) {
                this.activeStep = index;
            }
        }"
        class="container mx-auto px-4"
    >
        <h2 class="font-tenor text-2xl lg:text-3xl uppercase text-center mb-16">How it works</h2>

        {{-- Steps Navigation with Hexagon Badges - End to End Flow --}}
        <div class="max-w-6xl mx-auto mb-16">
            <div class="relative px-8">
                {{-- Progress Line Background - From First to Last Hexagon Center --}}
                <div 
                    class="absolute top-8 h-0.5 bg-gray-200"
                    style="left: 32px; right: 32px;"
                ></div>
                
                {{-- Animated Progress Line - From First to Last Hexagon Center --}}
                <div 
                    class="absolute top-8 h-0.5 bg-black transition-all duration-700 ease-out"
                    :style="{
                        left: '32px',
                        width: `calc((100% - 64px) * (activeStep / {{ $totalSteps - 1 }}))`
                    }"
                ></div>

                {{-- Hexagon Badges Container - Perfect Alignment --}}
                <div class="flex justify-between items-start relative">
                    @foreach($steps as $index => $step)
                        <button
                            @click="goToStep({{ $index }})"
                            class="relative z-10 flex flex-col items-center cursor-pointer transition-all duration-300"
                            :class="{ 
                                'scale-110': activeStep === {{ $index }},
                                'scale-100': activeStep !== {{ $index }}
                            }"
                        >
                            {{-- Hexagon Badge --}}
                            <div class="relative mb-4">
                                <svg 
                                    class="w-16 h-16 transition-all duration-300"
                                    viewBox="0 0 100 100"
                                    style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));"
                                >
                                    <polygon 
                                        points="50,5 90,25 90,75 50,95 10,75 10,25"
                                        :fill="activeStep >= {{ $index }} ? '#000000' : '#ffffff'"
                                        :stroke="activeStep >= {{ $index }} ? '#000000' : '#d1d5db'"
                                        stroke-width="2"
                                        class="transition-all duration-300"
                                    />
                                </svg>
                                <span 
                                    class="absolute inset-0 flex items-center justify-center text-2xl font-bold transition-all duration-300"
                                    :class="activeStep >= {{ $index }} ? 'text-white' : 'text-gray-400'"
                                >
                                    {{ $step['step'] }}
                                </span>
                            </div>
                            
                            {{-- Step Title --}}
                            <span 
                                class="text-xs lg:text-sm font-medium text-center px-2 transition-all duration-300 whitespace-nowrap"
                                :class="activeStep >= {{ $index }} ? 'text-black' : 'text-gray-400'"
                            >
                                {{ $step['title'] }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Step Content with Clean Edges --}}
        <div class="max-w-5xl mx-auto">
            <div class="relative min-h-[500px]">
                @foreach($steps as $index => $step)
                    <div
                        x-show="activeStep === {{ $index }}"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 transform translate-y-8"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform translate-y-8"
                        class="absolute inset-0"
                    >
                        <div class="grid md:grid-cols-2 gap-8 items-center">
                            {{-- Step SVG Icon with Animation --}}
                            <div class="relative flex items-center justify-center">
                                <div 
                                    class="w-full max-w-md transition-all duration-700"
                                    :class="activeStep === {{ $index }} ? 'scale-100 opacity-100' : 'scale-95 opacity-70'"
                                >
                                    @php
                                        $iconComponent = getIconComponent($step['title'], $iconMap);
                                    @endphp
                                    @if($iconComponent && view()->exists($iconComponent))
                                        <div 
                                            class="how-it-works-icon"
                                            x-data="{ isActive: activeStep === {{ $index }} }"
                                            x-effect="isActive = activeStep === {{ $index }}; $nextTick(() => { const svg = $el.querySelector('svg'); if (svg) { if (isActive) { svg.classList.add('animated'); } else { svg.classList.remove('animated'); } } })"
                                        >
                                            @include($iconComponent)
                                        </div>
                                    @else
                                        {{-- Fallback to image if icon not found --}}
                                        <div class="aspect-[4/3] bg-gray-100">
                                            <img
                                                src="{{ asset('images/' . $step['image']) }}"
                                                alt="{{ $step['title'] }}"
                                                class="w-full h-full object-cover"
                                            >
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Step Description --}}
                            <div class="space-y-4">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="text-4xl font-bold text-black/10">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <h3 class="font-tenor text-2xl lg:text-3xl uppercase text-black">
                                        {{ $step['title'] }}
                                    </h3>
                                </div>
                                <p class="text-base lg:text-lg text-gray-700 leading-relaxed">
                                    {{ $step['description'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Mobile Version - Simple Slider --}}
<section class="py-6 md:hidden">
    <div class="container mx-auto px-4">
        <h2 class="font-tenor text-lg uppercase text-center mb-4">How it works</h2>

        {{-- Mobile Slider Container - Fixed Height Container --}}
        <div 
            x-data="{ 
                currentSlide: 0,
                totalSlides: {{ $totalSteps }},
                touchStartX: 0,
                touchEndX: 0,
                init() {
                    this.autoPlay = setInterval(() => {
                        this.nextSlide();
                    }, 4000);
                },
                nextSlide() {
                    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                },
                prevSlide() {
                    this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                },
                goToSlide(index) {
                    this.currentSlide = index;
                },
                handleTouchStart(e) {
                    this.touchStartX = e.touches[0].clientX;
                },
                handleTouchMove(e) {
                    this.touchEndX = e.touches[0].clientX;
                },
                handleTouchEnd() {
                    if (!this.touchStartX || !this.touchEndX) return;
                    const diff = this.touchStartX - this.touchEndX;
                    if (Math.abs(diff) > 50) {
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                    this.touchStartX = 0;
                    this.touchEndX = 0;
                }
            }"
            class="mobile-slider-wrapper"
        >
            <div 
                class="relative overflow-hidden mb-4"
                @touchstart="handleTouchStart($event)"
                @touchmove="handleTouchMove($event)"
                @touchend="handleTouchEnd()"
            >
                <div 
                    class="flex transition-transform duration-500 ease-out"
                    :style="`transform: translateX(-${currentSlide * 100}%)`"
                >
                    @foreach($steps as $index => $step)
                        <div class="min-w-full flex-shrink-0 px-2">
                            <div class="flex flex-col items-center text-center h-full">
                                {{-- Mobile Hexagon Badge --}}
                                <div class="mb-3 flex-shrink-0">
                                    <div class="relative">
                                        <svg 
                                            class="w-10 h-10"
                                            viewBox="0 0 100 100"
                                        >
                                            <polygon 
                                                points="50,5 90,25 90,75 50,95 10,75 10,25"
                                                fill="#000000"
                                                stroke="#000000"
                                                stroke-width="2"
                                            />
                                        </svg>
                                        <span class="absolute inset-0 flex items-center justify-center text-lg font-bold text-white">
                                            {{ $step['step'] }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Mobile GIF/Image Icon - Use GIF if available, fallback to image --}}
                                <div class="mb-3 flex-shrink-0 w-full flex items-center justify-center" style="height: 180px;">
                                    @php
                                        $gifPath = getGifPath($step['title'], $gifMap);
                                    @endphp
                                    @if($gifPath)
                                        <img
                                            src="{{ $gifPath }}"
                                            alt="{{ $step['title'] }}"
                                            class="w-full h-full max-w-[200px] object-contain"
                                        >
                                    @else
                                        <img
                                            src="{{ asset('images/' . $step['image']) }}"
                                            alt="{{ $step['title'] }}"
                                            class="w-full h-full max-w-[200px] object-contain"
                                        >
                                    @endif
                                </div>

                                {{-- Mobile Content --}}
                                <div class="w-full flex-shrink-0">
                                    <h3 class="font-tenor text-xs uppercase mb-1.5 text-black">
                                        {{ $step['title'] }}
                                    </h3>
                                    <p class="text-[10px] text-gray-600 leading-relaxed">
                                        {{ $step['description'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Mobile Navigation Dots --}}
            <div class="flex justify-center gap-1.5">
                @foreach($steps as $index => $step)
                    <button
                        @click="goToSlide({{ $index }})"
                        class="h-1 rounded-full transition-all duration-300"
                        :class="currentSlide === {{ $index }} ? 'bg-black w-5' : 'bg-gray-300 w-1'"
                    ></button>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
    /* Desktop SVG Icon Styling */
    .how-it-works-icon {
        width: 100%;
        height: auto;
    }
    
    .how-it-works-icon svg {
        width: 100%;
        height: auto;
        max-width: 400px;
        max-height: 400px;
    }
    
    /* Desktop SVG Icon Animation Control */
    .how-it-works-icon svg:not(.animated) .animable {
        opacity: 0;
    }
    
    .how-it-works-icon svg.animated .animable {
        opacity: 1;
    }
    
    /* Smooth scale animation for desktop icon container */
    .how-it-works-icon {
        transition: transform 0.7s ease-out, opacity 0.7s ease-out;
    }
    
    /* Clean edges and smooth transitions for desktop */
    section.hidden.md\:block [x-show] {
        will-change: transform, opacity;
    }
    
    /* Prevent text selection on hexagon buttons */
    section.hidden.md\:block button {
        user-select: none;
    }
    
    /* ===== MOBILE STYLES ===== */
    @media (max-width: 767px) {
        /* Mobile Slider Wrapper - Simple Container */
        .mobile-slider-wrapper {
            display: flex;
            flex-direction: column;
        }
        
        /* Prevent text selection on mobile buttons */
        section.md\:hidden button {
            user-select: none;
        }
        
        /* Ensure slider items fit properly */
        .mobile-slider-wrapper .min-w-full {
            display: flex;
        }
    }
</style>
