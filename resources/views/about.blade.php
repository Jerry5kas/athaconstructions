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
                            $bgColors = ['#F5F0E8', '#F0E8F5' , '#E8F4F5'];
                            $accentColors = ['#D4C4B0', '#D4C4D8' , '#B8D4D8'];
                            $bgColor = $bgColors[$index % 3];
                            $accentColor = $accentColors[$index % 3];
                        @endphp
                        <div class="founder-card-creative opacity-0" 
                             :class="{ 'animate-fade-in-up': visible }" 
                             style="animation-delay: {{ 0.3 + ($index * 0.2) }}s; --founder-bg: {{ $bgColor }}; --founder-accent: {{ $accentColor }};">
                            {{-- Card Container --}}
                            <div class="founder-card-inner">
                                {{-- Image Section with Creative Shape --}}
                                <div class="founder-image-section">
                                    <div class="founder-image-shape">
                        <img 
                            src="{{ asset($founder['image']) }}" 
                            alt="{{ $founder['name'] }}"
                                            class="founder-image-creative"
                                        >
                                    </div>
                                </div>

                                {{-- Content Section --}}
                                <div class="founder-content-creative">
                                    {{-- Title Badge --}}
                                    <div class="founder-title-badge">
                                        <span class="text-[10px] lg:text-xs uppercase tracking-widest font-semibold">
                                            {{ $founder['title'] }}
                                        </span>
                                    </div>

                                    {{-- Name --}}
                                    <h4 class="font-tenor text-2xl lg:text-3xl uppercase mb-4 founder-name">
                                        {{ $founder['name'] }}
                                    </h4>

                                    {{-- Decorative Line --}}
                                    <div class="founder-divider"></div>

                                    {{-- Bio --}}
                                    <p class="text-xs lg:text-sm text-gray-700 leading-relaxed text-justify founder-bio pb-5">
                            {{ $founder['bio'] }}
                        </p>

                                    {{-- Bottom Accent --}}
                                    <div class="founder-bottom-accent"></div>
                                </div>

                                {{-- Decorative Elements --}}
                                <div class="founder-decorative-dot founder-dot-1"></div>
                                <div class="founder-decorative-dot founder-dot-2"></div>
                                <div class="founder-decorative-line founder-line-1"></div>
                                <div class="founder-decorative-line founder-line-2"></div>
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
            background: linear-gradient(90deg, transparent 0%, var(--founder-accent, #D4C4B0) 50%, transparent 100%);
            opacity: 0.6;
        }

        /* Founder Card Creative */
        .founder-card-creative {
            position: relative;
            height: 100%;
        }

        .founder-card-inner {
            position: relative;
            background: var(--founder-bg, #F5F0E8);
            border-radius: 24px;
            padding: 2rem 1.5rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .founder-card-creative:hover .founder-card-inner {
            transform: translateY(-12px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            border-color: rgba(0, 0, 0, 0.1);
        }

        /* Image Section */
        .founder-image-section {
            position: relative;
            margin-bottom: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
        }

        .founder-image-shape {
            position: relative;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
        }

        .founder-card-creative:hover .founder-image-shape {
            transform: scale(1.08);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        }

        .founder-image-creative {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }

        .founder-card-creative:hover .founder-image-creative {
            transform: scale(1.1);
        }

        /* Content Section */
        .founder-content-creative {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }

        /* Title Badge */
        .founder-title-badge {
            display: inline-block;
            background: var(--founder-accent, #D4C4B0);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            margin-bottom: 1rem;
            align-self: flex-start;
            transition: all 0.3s ease;
        }

        .founder-card-creative:hover .founder-title-badge {
            transform: translateX(5px);
        }

        /* Name */
        .founder-name {
            color: #1a1a1a;
            line-height: 1.2;
            margin-bottom: 1rem;
            transition: color 0.3s ease;
        }

        .founder-card-creative:hover .founder-name {
            color: #000;
        }

        /* Divider */
        .founder-divider {
            width: 60px;
            height: 3px;
            background: var(--founder-accent, #D4C4B0);
            margin-bottom: 1.5rem;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .founder-card-creative:hover .founder-divider {
            width: 80px;
        }

        /* Bio */
        .founder-bio {
            flex: 1;
            color: #4a4a4a;
        }

        /* Bottom Accent */
        .founder-bottom-accent {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--founder-accent, #D4C4B0) 0%, transparent 100%);
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }

        .founder-card-creative:hover .founder-bottom-accent {
            opacity: 1;
        }

        /* Decorative Elements */
        .founder-decorative-dot {
            position: absolute;
            width: 8px;
            height: 8px;
            background: var(--founder-accent, #D4C4B0);
            border-radius: 50%;
            opacity: 0.3;
            transition: all 0.4s ease;
        }

        .founder-dot-1 {
            top: 20px;
            left: 20px;
        }

        .founder-dot-2 {
            bottom: 20px;
            right: 20px;
        }

        .founder-card-creative:hover .founder-decorative-dot {
            opacity: 0.6;
            transform: scale(1.5);
        }

        .founder-decorative-line {
            position: absolute;
            background: var(--founder-accent, #D4C4B0);
            opacity: 0.15;
            transition: all 0.4s ease;
        }

        .founder-line-1 {
            top: 50%;
            left: 0;
            width: 40px;
            height: 1px;
            transform: rotate(-45deg);
            transform-origin: left center;
        }

        .founder-line-2 {
            bottom: 30px;
            right: 0;
            width: 30px;
            height: 1px;
            transform: rotate(45deg);
            transform-origin: right center;
        }

        .founder-card-creative:hover .founder-decorative-line {
            opacity: 0.3;
            width: 60px;
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

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .founder-image-shape {
                width: 160px;
                height: 160px;
            }

            .founder-card-inner {
                padding: 1.5rem 1rem;
            }
        }
    </style>
    @endonce
</x-layouts>

