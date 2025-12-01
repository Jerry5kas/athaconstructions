@props([
    'year' => '2016',
    'heading' => 'Built on Experience, Driven by Vision',
    'image' => 'images/about/about.jpg',
    'imageAlt' => 'Villa Construction Company In Ballari',
    'imageTitle' => 'Villa Construction Company In Ballari',
    'timelineItems' => [],
])

@php
    $defaultTimeline = [
        [
            'label' => 'The Beginning',
            'text' => "Eight years ago, Atha Construction emerged from Mr. Arun's determination to resolve the challenges he faced in his own construction projects. Frustrated by delays, mismanagement, and cost overruns, he envisioned a company that would offer a seamless, transparent, and hassle-free experience, moving beyond the limitations of individual contractors.",
        ],
        [
            'label' => 'The Evolution',
            'text' => 'What began as a personal mission grew into a commitment to revolutionize the construction industry. Atha Construction redefined excellence by integrating advanced technology, sustainable practices, and a client-first approach to create inspiring spaces and foster community.',
        ],
        [
            'label' => 'Today',
            'text' => 'Today, Atha Construction is a trusted name in the industry, founded on innovation and reliability. Mr. Arun\'s vision has transformed countless dreams into reality, establishing a legacy built on trust and exceptional value.',
        ],
    ];

    $items = !empty($timelineItems) ? $timelineItems : $defaultTimeline;
@endphp

<section class="py-16 lg:py-24 relative overflow-hidden story-section" 
         x-data="{ visible: false }" 
         x-intersect="visible = true">
    {{-- Decorative Background Elements --}}
    <div class="absolute inset-0 pointer-events-none opacity-5">
        <div class="absolute top-0 left-0 w-96 h-96 border-2 border-black rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 border-2 border-black rounded-full translate-x-1/2 translate-y-1/2"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-12 lg:mb-16">
            <div class="inline-block mb-4">
                <span class="font-tenor text-6xl lg:text-8xl text-black/10 font-bold">{{ $year }}</span>
            </div>
            <h2 class="font-tenor text-2xl lg:text-4xl uppercase mb-4 animate-on-scroll opacity-0" style="animation-delay: 0.1s;">
                {{ $heading }}
            </h2>
            <div class="w-24 h-0.5 bg-black mx-auto animate-on-scroll opacity-0" style="animation-delay: 0.2s;"></div>
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                {{-- Image Section with Creative Frame --}}
                <div class="lg:col-span-5 relative">
                    <div class="story-image-container animate-on-scroll opacity-0" style="animation-delay: 0.3s;">
                        <div class="story-image-frame">
                            <img 
                                src="{{ asset($image) }}" 
                                alt="{{ $imageAlt }}"
                                title="{{ $imageTitle }}"
                                class="story-image"
                            >
                        </div>
                        {{-- Decorative Corner Elements --}}
                        <div class="absolute -top-4 -left-4 w-16 h-16 border-t-2 border-l-2 border-black opacity-20"></div>
                        <div class="absolute -bottom-4 -right-4 w-16 h-16 border-b-2 border-r-2 border-black opacity-20"></div>
                    </div>
                </div>

                {{-- Content Section with Timeline Style --}}
                <div class="lg:col-span-7 relative">
                    {{-- Timeline Line (Desktop) --}}
                    <div class="hidden lg:block absolute left-0 top-0 bottom-0 w-px bg-black/10"></div>
                    
                    <div class="space-y-8 lg:pl-8">
                        @foreach($items as $index => $item)
                            <div class="story-timeline-item opacity-0" 
                                 :class="{ 'animate-fade-in-left': visible }" 
                                 style="animation-delay: {{ 0.4 + ($index * 0.2) }}s;">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="w-3 h-3 bg-black rounded-full border-4 border-white shadow-lg"></div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="mb-2">
                                            <span class="text-xs uppercase tracking-widest text-gray-500 font-semibold">
                                                {{ $item['label'] }}
                                            </span>
                                        </div>
                                        <p class="text-sm leading-relaxed text-justify">
                                            {{ $item['text'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Separator with Creative Design --}}
        <div class="mt-16 lg:mt-20 flex items-center justify-center gap-4">
            <div class="flex-1 h-px bg-gray-300"></div>
            <div class="w-2 h-2 bg-black rounded-full"></div>
            <div class="flex-1 h-px bg-gray-300"></div>
        </div>
    </div>
</section>

@once
<style>
    /* Story Section Styles */
    .story-section {
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.01) 50%, transparent 100%);
    }

    /* Image Container with Creative Frame */
    .story-image-container {
        position: relative;
        padding: 1rem;
        background: white;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .story-image-frame {
        position: relative;
        overflow: hidden;
        border: 2px solid black;
        background: black;
    }

    .story-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.6s ease;
        min-height: 400px;
    }

    .story-image-container:hover .story-image {
        transform: scale(1.05);
    }

    /* Timeline Items */
    .story-timeline-item {
        position: relative;
        transition: all 0.6s ease;
    }

    .story-timeline-item:hover {
        transform: translateX(8px);
    }

    /* Responsive Adjustments */
    @media (max-width: 1023px) {
        .story-image {
            min-height: 300px;
        }
        
        .story-timeline-item {
            padding-left: 0;
        }
    }

    /* Animation for timeline items */
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-fade-in-left {
        animation: fadeInLeft 0.6s ease-out forwards;
    }
</style>
@endonce


