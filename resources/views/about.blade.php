<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    @php
        $stats = [
            ['number' => '8+', 'label' => 'Years of Experience'],
            ['number' => '2M+', 'label' => 'Sq.Ft Developed'],
            ['number' => '500+', 'label' => 'Completed Projects'],
        ];

        $missionVision = [
            [
                'title' => 'Our Mission',
                'icon' => 'images/about/mission.svg',
                'bg' => 'images/mission.jpg',
                'description' => [
                    'Craft spaces that reflect the unique needs and aspirations of our clients while building relationships founded on trust and collaboration.',
                    'We are committed to delivering exceptional construction services that exceed expectations, providing lasting value and quality in every project.',
                ],
            ],
            [
                'title' => 'Our Vision',
                'icon' => 'images/about/vision.svg',
                'bg' => 'images/vision.jpg',
                'description' => [
                    'To be the most trusted and innovative construction partner, shaping inspiring spaces that stand as a testament to quality, collaboration, and enduring value.',
                    'We envision communities where thoughtful design and meticulous execution create environments that enrich lives for generations.',
                ],
            ],
        ];

        $usps = [
            'Transparency, No Hidden Charges',
            'Uncompromising Premium Quality<br/>Crafted with top tier material and exceptional Workmanship.',
            'Punctual Project Completion',
            'All in One Elite Services',
            'Exclusive In- House Expertise',
            'Fixed Pricing , Unified Team',
            'Use only Branded Material',
            'Camera at Site and Allocated Site Engineers',
        ];

        $founders = [
            [
                'name' => 'Arun A R',
                'title' => 'MD & CEO',
                'image' => 'images/founders/ceo.jpg',
                'bio' => 'With over a decade of diverse experience in real estate development and property management, Arun A R brings visionary leadership and a deep understanding of the construction industry. His expertise lies in crafting innovative strategies and ensuring the seamless execution of projects. Under his guidance, the company has consistently delivered value-driven, high-quality developments, setting benchmarks for excellence and trust in the industry. His commitment to integrity and forward-thinking approaches continues to inspire the team and drive the company\'s growth.',
            ],
            [
                'name' => 'Lavanya G V',
                'title' => 'COO',
                'image' => 'images/founders/coo.jpg',
                'bio' => 'Lavanya G V combines technical expertise with artistic vision to create exceptional spaces that reflect innovation and functionality. With a keen focus on client satisfaction and operational efficiency, she ensures every project aligns with the company\'s commitment to quality and excellence. Her ability to seamlessly blend creativity with practical solutions has been instrumental in driving the success of numerous developments. Passionate about sustainability and design, she plays a pivotal role in shaping spaces that inspire and resonate with both clients and communities.',
            ],
            [
                'name' => 'Vijaykumar N',
                'title' => 'VP',
                'image' => 'images/founders/vp.jpg',
                'bio' => 'Brings decades of experience and a track record of involvement in global iconic projects. With meticulous attention to detail and a strategic mindset honed over 40 years of experience, he has consistently guided projects to successful completion. His involvement in shaping iconic structures like the Burj Khalifa and Dubai Mall exemplifies his unwavering commitment to excellence and his skill in managing complex, large-scale endeavors with finesse.',
            ],
        ];
    @endphp

    {{-- Page Banner --}}
    <x-page-banner
        pageTitle="About Atha Construction"
        contentTitle="Built on Experience, Driven by Vision"
        description="What began as a personal mission to simplify construction has evolved into a commitment to transform every square foot with integrity, innovation, and craftsmanship."
        backgroundImage="images/about/about-banner.png"
        alt="house construction in bangalore"
        title="house construction in bangalore"
    />

    {{-- Stats --}}
    <x-stats-section
        :title="'EXPERTISE. PROFESSIONALISM. DEDICATION.'"
        :description="'The ATHA Construction offers an unparalleled level of service, expertise and discretion to its clients, buyers and sellers alike, across the globe.'"
        :stats="$stats"
        backgroundImage="images/blog-2.jpeg"
        sectionId="next-section"
    />

    {{-- Story --}}
    <x-story-section
        year="2016"
        heading="Built on Experience, Driven by Vision"
        image="images/about/about.jpg"
        imageAlt="Villa Construction Company In Ballari"
        imageTitle="Villa Construction Company In Ballari"
    />

    {{-- Philosophy --}}
    <x-philosophy-section />

    {{-- Mission & Vision --}}
    <x-mission-vision-section :blocks="$missionVision" />

    @once
    <style>
        /* Philosophy Section Styles */
        .philosophy-section {
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.01) 50%, transparent 100%);
            position: relative;
        }

        /* Grid Pattern Background */
        .philosophy-grid-pattern {
            background-image: 
                linear-gradient(to right, black 1px, transparent 1px),
                linear-gradient(to bottom, black 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* Visual Container */
        .philosophy-visual-container {
            position: relative;
            height: auto;
            min-height: 0;
        }

        .philosophy-visual-frame {
            position: relative;
            width: 100%;
            height: auto;
            min-height: 0;
            border: 2px solid black;
            background: transparent;
            padding: 0;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            overflow: hidden;
        }

        .philosophy-visual-frame:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }

        .philosophy-visual-inner {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .philosophy-pattern-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            opacity: 0.1;
        }

        .philosophy-pattern-overlay svg {
            width: 100%;
            height: 100%;
        }

        .philosophy-central-symbol {
            position: relative;
            z-index: 1;
            color: black;
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: philosophyPulse 3s ease-in-out infinite;
        }

        @keyframes philosophyPulse {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.05); }
        }

        .philosophy-central-symbol svg {
            width: 100%;
            height: 100%;
        }

        /* Corner Decorations */
        .philosophy-corner-decoration {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 2px solid black;
        }

        .philosophy-corner-tl {
            top: -2px;
            left: -2px;
            border-right: none;
            border-bottom: none;
        }

        .philosophy-corner-tr {
            top: -2px;
            right: -2px;
            border-left: none;
            border-bottom: none;
        }

        .philosophy-corner-bl {
            bottom: -2px;
            left: -2px;
            border-right: none;
            border-top: none;
        }

        .philosophy-corner-br {
            bottom: -2px;
            right: -2px;
            border-left: none;
            border-top: none;
        }

        /* Content Wrapper */
        .philosophy-content-wrapper {
            padding: 2rem 0;
        }

        .philosophy-main-quote {
            position: relative;
            padding-left: 2rem;
            border-left: 3px solid black;
        }

        .philosophy-supporting-text {
            padding-left: 2rem;
        }

        /* Philosophy Pillars */
        .philosophy-pillars {
            margin-top: 2rem;
        }

        .philosophy-pillar {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            padding: 1.5rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .philosophy-pillar:hover {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.2);
            transform: translateY(-3px);
        }

        .philosophy-pillar-icon {
            width: 32px;
            height: 32px;
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
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #1a1a1a;
        }

        /* Responsive Adjustments */
        @media (max-width: 1023px) {
            .philosophy-visual-frame {
                min-height: 0;
                padding: 0;
            }

            .philosophy-central-symbol {
                width: 80px;
                height: 80px;
            }

            .philosophy-main-quote {
                padding-left: 1rem;
                font-size: 1.5rem;
            }

            .philosophy-supporting-text {
                padding-left: 1rem;
            }
        }

        /* Mission & Vision Section Styles */
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
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 3rem 2rem;
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
        }

        .mission-vision-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        .mission-vision-card-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .mission-vision-icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
        }

        .mission-vision-card:hover .mission-vision-icon-wrapper {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
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

        .mission-vision-corner {
            position: absolute;
            top: 0;
            right: 0;
            width: 60px;
            height: 60px;
            border-top: 2px solid rgba(255, 255, 255, 0.2);
            border-right: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
        }

        .mission-vision-card:hover .mission-vision-corner {
            border-color: rgba(255, 255, 255, 0.4);
            width: 80px;
            height: 80px;
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
        @media (max-width: 767px) {
            .philosophy-quote-container {
                padding: 2rem 1rem;
            }

            .philosophy-quote-mark {
                width: 80px;
                height: 80px;
                top: -1rem;
                left: 0;
            }

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

    {{-- USPs --}}
    <section class="py-16 lg:py-24 relative usps-section" x-data="{ visible: false }" x-intersect="visible = true">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                {{-- Section Header --}}
                <div class="text-center mb-12 lg:mb-16">
                    <p class="text-xs lg:text-sm tracking-[0.25em] uppercase text-gray-500 mb-3 animate-on-scroll opacity-0" style="animation-delay: 0.05s;">
                        Why homeowners choose Atha
                    </p>
                    <h2 class="font-tenor text-3xl lg:text-4xl uppercase mb-3 animate-on-scroll opacity-0" style="animation-delay: 0.1s;">
                    Our USP's
                </h2>
                    <div class="w-24 h-0.5 bg-black mx-auto animate-on-scroll opacity-0 usps-title-underline" style="animation-delay: 0.2s;"></div>
                </div>

                <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center usp-grid-container">
                    {{-- USP Cards List --}}
                    <div class="space-y-3 lg:space-y-3.5">
                        @foreach($usps as $index => $usp)
                            <div class="usp-card opacity-0" 
                                 :class="{ 'animate-fade-in-left': visible }" 
                                 style="animation-delay: {{ 0.3 + ($index * 0.1) }}s;">
                                <div class="usp-card-content">
                                    <div class="flex items-center gap-3">
                                        {{-- Professional Bullet Icon --}}
                                        <div class="flex-shrink-0 usp-icon-wrapper">
                                            <div class="usp-bullet">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" opacity="0.2"/>
                                                    <rect x="8" y="8" width="8" height="8" rx="1" fill="currentColor"/>
                                                </svg>
                                            </div>
            </div>
                                        {{-- USP Text --}}
                                        <p class="text-[11px] lg:text-xs font-medium text-gray-900 leading-relaxed flex-1">
                            {!! $usp !!}
                        </p>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>

                    {{-- Simple Smooth Slider - Landscape --}}
                    <div class="relative usp-slider-container" x-data="{ 
                        currentSlide: 0, 
                        slides: [
                    '{{ asset('images/about/USP1.jpg') }}',
                    '{{ asset('images/about/USP2.jpg') }}',
                    '{{ asset('images/about/USP3.jpg') }}'
                        ],
                        autoplay: null,
                        init() {
                            this.startAutoplay();
                        },
                        startAutoplay() {
                            this.autoplay = setInterval(() => {
                                this.nextSlide();
                            }, 4000);
                        },
                        stopAutoplay() {
                            if (this.autoplay) {
                                clearInterval(this.autoplay);
                            }
                        },
                        nextSlide() {
                            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                        },
                        prevSlide() {
                            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                        }
                    }" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()">
                        <div class="usp-slider-wrapper animate-on-scroll opacity-0" style="animation-delay: 0.5s;">
                            <div class="relative overflow-hidden usp-slider-frame">
                            <template x-for="(slide, index) in slides" :key="index">
                                <div 
                                    x-show="currentSlide === index"
                                        x-transition:enter="transition ease-out duration-500"
                                        x-transition:enter-start="opacity-0 transform translate-x-8"
                                        x-transition:enter-end="opacity-100 transform translate-x-0"
                                    x-transition:leave="transition ease-in duration-300"
                                        x-transition:leave-start="opacity-100 transform translate-x-0"
                                        x-transition:leave-end="opacity-0 transform -translate-x-8"
                                        class="absolute inset-0 usp-slide"
                                >
                                    <img 
                                        :src="slide" 
                                        :alt="'USP ' + (index + 1)"
                                            class="usp-slide-image"
                                    >
                                </div>
                            </template>
                        
                                {{-- Simple Arrow Navigation --}}
                        <button 
                                    @click="prevSlide()"
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 usp-arrow-btn"
                            aria-label="Previous"
                        >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                        </button>
                        <button 
                                    @click="nextSlide()"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 usp-arrow-btn"
                            aria-label="Next"
                        >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                        </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @once
    <style>
        /* USPs Section Styles */
        .usps-section {
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.015) 50%, transparent 100%);
            position: relative;
            overflow: hidden;
        }

        .usps-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(to right, rgba(0,0,0,0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0,0,0,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            opacity: 0.5;
            pointer-events: none;
        }

        .usps-title-underline {
            background: linear-gradient(90deg, transparent, #000000, transparent);
        }

        /* USP Card Styles */
        .usp-card {
            background: #ffffff;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .usp-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(to bottom, #111111, transparent);
            opacity: 0.2;
            transition: opacity 0.3s ease;
        }

        .usp-card:hover {
            background: #f9f9f9;
            transform: translateX(6px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            border-color: rgba(0, 0, 0, 0.12);
        }

        .usp-card:hover::before {
            opacity: 0.6;
        }

        .usp-card-content {
            padding: 0.875rem 1rem;
        }

        /* USP Icon Styles */
        .usp-icon-wrapper {
            flex-shrink: 0;
        }

        .usp-bullet {
            width: 16px;
            height: 16px;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .usp-card:hover .usp-bullet {
            color: #4b5563;
            transform: scale(1.1);
        }

        .usp-bullet svg {
            width: 100%;
            height: 100%;
        }

        /* Simple Smooth Slider Styles */
        .usp-slider-container {
            position: relative;
        }

        .usp-slider-wrapper {
            position: relative;
        }

        .usp-slider-frame {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            overflow: hidden;
            width: 100%;
            aspect-ratio: 16 / 9;
            max-height: 380px;
            position: relative;
        }

        .usp-slider-frame:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
        }

        .usp-slide {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .usp-slide-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Simple Arrow Buttons - No Background */
        .usp-arrow-btn {
            color: white;
            background: transparent;
            border: none;
            padding: 0;
            cursor: pointer;
            transition: opacity 0.3s ease;
            z-index: 10;
        }

        .usp-arrow-btn:hover {
            opacity: 0.7;
        }

        .usp-arrow-btn svg {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        /* Grid Container - Ensure Equal Heights */
        .usp-grid-container > div {
            display: flex;
            flex-direction: column;
        }

        .usp-grid-container > div:first-child {
            justify-content: center;
        }

        .usp-grid-container > div:last-child {
            justify-content: center;
        }

        @media (max-width: 1023px) {
            .usp-slider-frame {
                max-height: 280px;
            }

            .usp-arrow-btn svg {
                width: 20px;
                height: 20px;
            }
        }

        /* Simple Navigation Dots */

        /* Animation */
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

    {{-- Founders --}}
    <section class="py-16 lg:py-24 relative founders-section overflow-hidden" x-data="{ visible: false }" x-intersect="visible = true">
        {{-- Animated Background Pattern --}}
        <div class="absolute inset-0 pointer-events-none founders-bg-pattern"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-7xl mx-auto">
                {{-- Section Header --}}
                <div class="text-center mb-16 lg:mb-20">
                    <div class="inline-block relative">
                        <h2 class="font-tenor text-4xl lg:text-5xl uppercase mb-4 animate-on-scroll opacity-0 relative z-10" style="animation-delay: 0.1s;">
                    OUR FOUNDERS
                </h2>
                        <div class="absolute -bottom-2 left-0 right-0 h-3 founder-title-underline"></div>
                    </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($founders as $index => $founder)
                        @php
                            $bgShades = ['bg-gray-50', 'bg-gray-100', 'bg-gray-50'];
                            $bgShade = $bgShades[$index % 3];
                        @endphp
                        <div class="founder-card-flip opacity-0" 
                             :class="{ 'animate-fade-in-up': visible }" 
                             style="animation-delay: {{ 0.3 + ($index * 0.2) }}s;">
                            {{-- Card Container with 3D Flip --}}
                            <div class="founder-card-inner-flip">
                                {{-- Front Face --}}
                                <div class="founder-card-face founder-card-front {{ $bgShade }} flex flex-col">
                                    {{-- Image Section - Full Width with Overlay --}}
                                    <div class="founder-image-section flex-1 relative overflow-hidden">
                                        <img 
                                            src="{{ asset($founder['image']) }}" 
                                            alt="{{ $founder['name'] }}"
                                            class="founder-image-creative w-full h-full object-cover"
                                        >
                                        {{-- Gradient Overlay --}}
                                        <div class="founder-image-overlay"></div>
                                        {{-- Corner Accent --}}
                                        <div class="founder-corner-accent founder-corner-top-left"></div>
                                        <div class="founder-corner-accent founder-corner-top-right"></div>
                                    </div>

                                    {{-- Content Section - Bottom --}}
                                    <div class="founder-content-creative">
                                        {{-- Title Badge --}}
                                        <div class="founder-title-badge mb-3">
                                            <span class="text-[9px] lg:text-[10px] uppercase tracking-[0.2em] font-bold">
                                                {{ $founder['title'] }}
                                            </span>
                                        </div>

                                        {{-- Name --}}
                                        <h4 class="font-tenor text-xl lg:text-2xl uppercase founder-name tracking-wide">
                                            {{ $founder['name'] }}
                                        </h4>
                                        
                                        {{-- Elegant Line --}}
                                        <div class="founder-elegant-line mt-3"></div>
                                    </div>
                                </div>

                                {{-- Back Face --}}
                                <div class="founder-card-face founder-card-back {{ $bgShade }}">
                                    {{-- Content Section --}}
                                    <div class="founder-content-creative h-full flex flex-col">
                                        {{-- Header with Badge and Name --}}
                                        <div class="mb-6">
                                            {{-- Title Badge --}}
                                            <div class="founder-title-badge mb-3">
                                                <span class="text-[9px] lg:text-[10px] uppercase tracking-[0.2em] font-bold">
                                                    {{ $founder['title'] }}
                                                </span>
                                            </div>

                                            {{-- Name --}}
                                            <h4 class="font-tenor text-xl lg:text-2xl uppercase mb-3 founder-name tracking-wide">
                                                {{ $founder['name'] }}
                                            </h4>

                                            {{-- Elegant Divider --}}
                                            <div class="founder-elegant-line"></div>
                                        </div>

                                        {{-- Bio --}}
                                        <div class="founder-bio-container flex-1">
                                            <p class="text-xs lg:text-sm text-gray-700 leading-relaxed founder-bio">
                                                {{ $founder['bio'] }}
                                            </p>
                                        </div>
                                        
                                        {{-- Bottom Accent Line --}}
                                        <div class="founder-bottom-elegant-line mt-6"></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>

    @once
    <style>
        /* Founders Section Styles */
        .founders-section {
            background: #FAFAFA;
            position: relative;
        }

        /* Animated Background Pattern */
        .founders-bg-pattern {
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(0,0,0,0.02) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(0,0,0,0.02) 0%, transparent 50%);
            background-size: 400px 400px;
            animation: patternMove 20s ease-in-out infinite;
        }

        @keyframes patternMove {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, 20px); }
        }

        /* Title Underline */
        .founder-title-underline {
            background: linear-gradient(90deg, transparent 0%, #000 50%, transparent 100%);
            opacity: 0.3;
        }

        /* Founder Card Flip Container */
        .founder-card-flip {
            position: relative;
            height: 550px;
            perspective: 1200px;
        }

        /* Card Inner with 3D Transform */
        .founder-card-inner-flip {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
        }

        .founder-card-flip:hover .founder-card-inner-flip {
            transform: rotateY(180deg);
        }

        /* Card Face (Front and Back) */
        .founder-card-face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.6s ease;
        }

        .founder-card-flip:hover .founder-card-face {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        /* Front Face */
        .founder-card-front {
            transform: rotateY(0deg);
            padding: 0;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Back Face */
        .founder-card-back {
            transform: rotateY(180deg);
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Image Section - Front Face */
        .founder-card-front .founder-image-section {
            position: relative;
            width: 100%;
            height: calc(100% - 130px);
            overflow: hidden;
        }

        .founder-card-front .founder-image-creative {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .founder-card-flip:hover .founder-card-front .founder-image-creative {
            transform: scale(1.05);
        }

        /* Image Overlay */
        .founder-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
            pointer-events: none;
            transition: opacity 0.6s ease;
        }

        .founder-card-flip:hover .founder-image-overlay {
            opacity: 0.8;
        }

        /* Corner Accents */
        .founder-corner-accent {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 1px solid rgba(0, 0, 0, 0.15);
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.6s ease;
        }

        .founder-corner-top-left {
            top: 20px;
            left: 20px;
            border-right: none;
            border-bottom: none;
        }

        .founder-corner-top-right {
            top: 20px;
            right: 20px;
            border-left: none;
            border-bottom: none;
        }

        .founder-card-flip:hover .founder-corner-accent {
            opacity: 1;
        }

        /* Content Section - Front Face */
        .founder-card-front .founder-content-creative {
            padding: 2rem 2rem 2.5rem;
            flex-shrink: 0;
            background: inherit;
        }

        /* Content Section - Back Face */
        .founder-card-back .founder-content-creative {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }

        /* Title Badge - Premium Style */
        .founder-title-badge {
            display: inline-block;
            background: #000;
            color: white;
            padding: 0.5rem 1.2rem;
            align-self: flex-start;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .founder-title-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .founder-card-flip:hover .founder-title-badge::before {
            left: 100%;
        }

        /* Name - Premium Typography */
        .founder-name {
            color: #000;
            line-height: 1.3;
            font-weight: 400;
            letter-spacing: 0.05em;
        }

        /* Elegant Line */
        .founder-elegant-line {
            width: 50px;
            height: 1px;
            background: #000;
            position: relative;
            overflow: hidden;
        }

        .founder-elegant-line::after {
            content: '';
            position: absolute;
            top: 0;
            left: -50px;
            width: 50px;
            height: 100%;
            background: linear-gradient(90deg, transparent, #000, transparent);
            transition: left 0.8s ease;
        }

        .founder-card-flip:hover .founder-elegant-line::after {
            left: 50px;
        }

        /* Bottom Elegant Line */
        .founder-bottom-elegant-line {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.2), transparent);
            position: relative;
        }

        /* Bio Container */
        .founder-bio-container {
            position: relative;
        }

        .founder-bio {
            color: #4a4a4a;
            line-height: 1.8;
            font-weight: 300;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        /* Premium Hover Effects */
        .founder-card-flip {
            transition: transform 0.3s ease;
        }

        .founder-card-flip:hover {
            transform: translateY(-8px);
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .founder-card-flip {
                height: 480px;
            }

            .founder-card-back {
                padding: 2rem 1.5rem;
            }

            .founder-card-front .founder-content-creative {
                padding: 1.5rem 1.5rem 2rem;
            }

            .founder-corner-accent {
                width: 30px;
                height: 30px;
            }

            .founder-corner-top-left {
                top: 15px;
                left: 15px;
            }

            .founder-corner-top-right {
                top: 15px;
                right: 15px;
            }
        }
    </style>
    @endonce
</x-layouts>

