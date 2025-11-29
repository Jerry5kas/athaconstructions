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
                'title' => 'OUR MISSION',
                'icon' => 'images/about/mission.svg',
                'description' => [
                    'Craft spaces that reflect the unique needs and aspirations of our clients while building relationships founded on trust and collaboration.',
                    'To deliver exceptional construction services that exceed expectations, providing value and lasting quality in every project.',
                ],
            ],
            [
                'title' => 'OUR VISION',
                'icon' => 'images/about/vision.svg',
                'description' => [
                    'To be the most trusted and innovative construction partner, shaping inspiring spaces that stand as a testament to quality, collaboration, and enduring value. We envision a future where every project fosters strong relationships and enriches the lives of our clients and communities.',
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
                'image' => 'images/img/1.jpg',
                'bio' => 'With over a decade of diverse experience in real estate development and property management, Arun A R brings visionary leadership and a deep understanding of the construction industry. His expertise lies in crafting innovative strategies and ensuring the seamless execution of projects. Under his guidance, the company has consistently delivered value-driven, high-quality developments, setting benchmarks for excellence and trust in the industry. His commitment to integrity and forward-thinking approaches continues to inspire the team and drive the company\'s growth.',
            ],
            [
                'name' => 'Lavanya G V',
                'title' => 'COO',
                'image' => 'images/img/2.jpg',
                'bio' => 'Lavanya G V combines technical expertise with artistic vision to create exceptional spaces that reflect innovation and functionality. With a keen focus on client satisfaction and operational efficiency, she ensures every project aligns with the company\'s commitment to quality and excellence. Her ability to seamlessly blend creativity with practical solutions has been instrumental in driving the success of numerous developments. Passionate about sustainability and design, she plays a pivotal role in shaping spaces that inspire and resonate with both clients and communities.',
            ],
            [
                'name' => 'Vijaykumar N',
                'title' => 'VP',
                'image' => 'images/img/3.jpg',
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
    <section class="relative bg-cover bg-center bg-no-repeat py-16 lg:py-20" id="next-section" style="background-image: url('{{ asset('images/blog-2.jpeg') }}')">
        <div class="bg-white/90 py-16 lg:py-20">
            <div class="container mx-auto px-4 text-center">
                <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-4">
                    EXPERTISE. PROFESSIONALISM. DEDICATION.
                </h2>
                <p class="text-sm max-w-3xl mx-auto mb-12">
                    The ATHA Construction offers an unparalleled level of service, expertise and discretion to its clients, buyers and
                    sellers alike, across the globe.
                </p>

                <div class="grid grid-cols-3 gap-4 lg:gap-8 max-w-3xl mx-auto">
                    @foreach($stats as $stat)
                        @php
                            $numericPart = preg_replace('/[^\d\.]/', '', $stat['number']);
                            $suffixPart = preg_replace('/[\d\.]/', '', $stat['number']);
                            $targetValue = $numericPart !== '' ? (float) $numericPart : 0;
                        @endphp
                        <div 
                            class="animate-on-scroll opacity-0"
                            x-data="statCounter({ target: @js($targetValue), suffix: @js($suffixPart) })"
                            x-intersect.once="start()"
                        >
                            <p class="font-tenor text-2xl lg:text-4xl font-medium mb-2" x-text="displayValue">
                                {{ $stat['number'] }}
                            </p>
                            <p class="text-xs lg:text-sm">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Story --}}
    <section class="py-12 lg:py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-4">
                    <img 
                        src="{{ asset('images/about/about.jpg') }}" 
                        alt="Villa Construction Company In Ballari"
                        title="Villa Construction Company In Ballari"
                        class="w-full"
                    >
                </div>
                <div class="lg:col-span-7 lg:pl-8">
                    <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-4">
                        Atha Construction: Built on Experience, Driven by Vision
                    </h2>
                    <div class="space-y-4 text-sm leading-relaxed text-justify">
                        <p>
                            Eight years ago, Atha Construction emerged from Mr. Arun's determination to resolve the challenges he faced in his own construction projects. Frustrated by delays, mismanagement, and cost overruns, he envisioned a company that would offer a seamless, transparent, and hassle-free experience, moving beyond the limitations of individual contractors.
                        </p>
                        <p>
                            What began as a personal mission grew into a commitment to revolutionize the construction industry. Atha Construction redefined excellence by integrating advanced technology, sustainable practices, and a client-first approach to create inspiring spaces and foster community.
                        </p>
                        <p>
                            Today, Atha Construction is a trusted name in the industry, founded on innovation and reliability. Mr. Arun's vision has transformed countless dreams into reality, establishing a legacy built on trust and exceptional value.
                        </p>
                    </div>
                </div>
            </div>
            <hr class="mt-12 border-gray-300">
        </div>
    </section>

    {{-- Philosophy --}}
    <section class="py-8 lg:py-12">
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase text-center mb-6">
                OUR PHILOSOPHY
            </h2>
            <div class="text-center max-w-4xl mx-auto">
                <p class="text-base lg:text-lg italic">
                    <i class="fas fa-quote-left text-gray-400"></i>
                    <span class="px-4">We believe construction is more than building structures; it's about creating meaningful spaces <br class="hidden lg:block"> that foster growth, comfort, and trust.</span>
                    <i class="fas fa-quote-right text-gray-400"></i>
                </p>
            </div>
        </div>
    </section>

    {{-- Mission & Vision --}}
    <section class="py-12 lg:py-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-6 lg:gap-8">
                @foreach($missionVision as $block)
                    <div class="flex flex-col items-center text-center">
                        <img src="{{ asset($block['icon']) }}" alt="{{ $block['title'] }}" class="w-20 h-20 object-contain mb-4">
                        <h5 class="font-tenor text-lg uppercase mb-4">{{ strtoupper($block['title']) }}</h5>
                        <div class="space-y-3 text-sm text-gray-700">
                            @foreach($block['description'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- USPs --}}
    <section class="py-12 lg:py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="font-tenor text-2xl lg:text-3xl uppercase">
                    Our USP's
                </h2>
            </div>
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                <div class="space-y-4">
                    @foreach($usps as $usp)
                        <p class="text-base lg:text-lg font-medium">
                            {!! $usp !!}
                        </p>
                    @endforeach
                </div>
                <div class="relative" x-data="{ currentSlide: 0, slides: [
                    '{{ asset('images/about/USP1.jpg') }}',
                    '{{ asset('images/about/USP2.jpg') }}',
                    '{{ asset('images/about/USP3.jpg') }}'
                ] }">
                    {{-- Carousel --}}
                    <div class="relative overflow-hidden rounded-lg">
                        <div class="relative h-64 lg:h-96">
                            <template x-for="(slide, index) in slides" :key="index">
                                <div 
                                    x-show="currentSlide === index"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="absolute inset-0"
                                >
                                    <img 
                                        :src="slide" 
                                        :alt="'USP ' + (index + 1)"
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                            </template>
                        </div>
                        
                        {{-- Carousel Controls --}}
                        <button 
                            @click="currentSlide = (currentSlide - 1 + slides.length) % slides.length"
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition-colors"
                            aria-label="Previous"
                        >
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button 
                            @click="currentSlide = (currentSlide + 1) % slides.length"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition-colors"
                            aria-label="Next"
                        >
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        
                        {{-- Indicators --}}
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                            <template x-for="(slide, index) in slides" :key="index">
                                <button
                                    @click="currentSlide = index"
                                    :class="currentSlide === index ? 'bg-white' : 'bg-white/50'"
                                    class="w-2 h-2 rounded-full transition-colors"
                                    :aria-label="'Go to slide ' + (index + 1)"
                                ></button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Founders --}}
    <section class="py-12 lg:py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-6">
                    OUR FOUNDERS
                </h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                @foreach($founders as $founder)
                    <div class="text-center px-4">
                        <img 
                            src="{{ asset($founder['image']) }}" 
                            alt="{{ $founder['name'] }}"
                            class="w-full max-w-xs mx-auto mb-4"
                        >
                        <h4 class="font-tenor text-lg lg:text-xl mb-2">{{ $founder['name'] }} ({{ $founder['title'] }})</h4>
                        <p class="text-sm text-gray-700 text-justify leading-relaxed">
                            {{ $founder['bio'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts>

