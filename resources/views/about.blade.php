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
                'description' => [
                    'Craft spaces that reflect the unique needs and aspirations of our clients while building relationships founded on trust and collaboration.',
                    'Deliver exceptional construction services that exceed expectations, providing value and lasting quality in every project.',
                ],
            ],
            [
                'title' => 'Our Vision',
                'icon' => 'images/about/vision.svg',
                'description' => [
                    'To be the most trusted and innovative construction partner, shaping inspiring spaces that stand as a testament to quality, collaboration, and enduring value.',
                    'We envision a future where every project fosters strong relationships and enriches the lives of our clients and communities.',
                ],
            ],
        ];

        $usps = [
            'Transparency, no hidden charges',
            'Uncompromising premium quality with branded materials',
            'Punctual project completion with guaranteed timelines',
            'All-in-one elite services with exclusive in-house expertise',
            'Fixed pricing models and unified project teams',
            'Camera-enabled sites with dedicated site engineers',
            'Future-ready, expansion-friendly structural planning',
        ];

        $founders = [
            [
                'name' => 'Arun A R',
                'title' => 'Managing Director & CEO',
                'image' => 'images/about/founder-arun.jpg',
                'bio' => 'With over a decade of diverse experience in real estate development and property management, Arun delivers vision, strategy, and seamless execution across every project.',
            ],
            [
                'name' => 'Lavanya G V',
                'title' => 'Chief Operating Officer',
                'image' => 'images/about/founder-lavanya.jpg',
                'bio' => 'Lavanya blends technical expertise with design sensibilities. Her focus on client satisfaction and operational excellence keeps every project aligned with our promise of quality.',
            ],
            [
                'name' => 'Vijaykumar N',
                'title' => 'Vice President',
                'image' => 'images/about/founder-vijay.jpg',
                'bio' => 'With 40+ years of global experience (Burj Khalifa, Dubai Mall), Vijaykumar brings meticulous attention to detail and proven leadership across mega projects.',
            ],
        ];
    @endphp

    {{-- Hero Banner --}}
    <section class="relative min-h-[70vh] flex items-center overflow-hidden">
        <img 
            src="{{ asset('images/about/about-banner.png') }}" 
            alt="About Atha Construction" 
            class="absolute inset-0 w-full h-full object-cover"
        >
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/80"></div>
        <div class="container mx-auto px-4 lg:px-8 relative z-10 flex flex-col gap-6 text-white">
            <p class="tracking-[0.4em] text-sm uppercase">About Atha Construction</p>
            <h1 class="font-tenor text-3xl md:text-5xl lg:text-6xl leading-tight max-w-4xl">
                Built on Experience, Driven by Vision
            </h1>
            <p class="max-w-2xl text-sm md:text-base text-white/80">
                What began as a personal mission to simplify construction has evolved into a commitment to transform every square foot with integrity, innovation, and craftsmanship.
            </p>
        </div>
    </section>

    {{-- Stats --}}
    <section class="py-16 lg:py-20 bg-gradient-to-b from-white via-neutral-50 to-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-tenor text-2xl md:text-3xl uppercase">Expertise. Professionalism. Dedication.</h2>
            <p class="max-w-3xl mx-auto mt-4 text-sm md:text-base text-neutral-600">
                Atha Construction offers an unparalleled level of service, expertise and discretion to its clients, buyers and sellers alike, across the globe.
            </p>
            <div class="grid grid-cols-3 gap-6 md:gap-10 max-w-4xl mx-auto mt-12">
                @foreach($stats as $stat)
                    <div class="bg-white shadow-sm rounded-3xl py-8 border border-black/5">
                        <p class="font-tenor text-3xl md:text-4xl">{{ $stat['number'] }}</p>
                        <p class="text-xs md:text-sm uppercase tracking-wide mt-2 text-neutral-500">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Story --}}
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-5">
                    <img 
                        src="{{ asset('images/about/about.jpg') }}" 
                        alt="Villa Construction Company In Ballari"
                        class="w-full rounded-[32px] shadow-2xl"
                    >
                </div>
                <div class="lg:col-span-7 space-y-5">
                    <p class="text-xs tracking-[0.4em] uppercase text-neutral-500">Our Story</p>
                    <h2 class="font-tenor text-3xl uppercase">Atha Construction: Built on Experience, Driven by Vision</h2>
                    <div class="space-y-4 text-sm leading-relaxed text-justify text-neutral-700">
                        <p>
                            Eight years ago, Atha Construction emerged from Mr. Arun’s determination to resolve the challenges he faced in his own construction projects. Frustrated by delays, mismanagement, and cost overruns, he envisioned a company that would offer a seamless, transparent, and hassle-free experience, moving beyond the limitations of individual contractors.
                        </p>
                        <p>
                            What began as a personal mission grew into a commitment to revolutionize the construction industry. Atha Construction redefined excellence by integrating advanced technology, sustainable practices, and a client-first approach to create inspiring spaces and foster community.
                        </p>
                        <p>
                            Today, Atha Construction is a trusted name in the industry, founded on innovation and reliability. Mr. Arun’s vision has transformed countless dreams into reality, establishing a legacy built on trust and exceptional value.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Philosophy --}}
    <section class="py-16 lg:py-24 bg-black text-white">
        <div class="container mx-auto px-4 text-center">
            <p class="text-xs tracking-[0.5em] uppercase mb-4">Our Philosophy</p>
            <h3 class="font-tenor text-2xl md:text-3xl max-w-3xl mx-auto leading-relaxed">
                “We believe construction is more than building structures; it’s about creating meaningful spaces that foster growth, comfort, and trust.”
            </h3>
        </div>
    </section>

    {{-- Mission & Vision --}}
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($missionVision as $block)
                    <article class="border border-black/5 rounded-[32px] p-8 shadow-sm">
                        <div class="flex flex-col items-center text-center space-y-5">
                            <img src="{{ asset($block['icon']) }}" alt="{{ $block['title'] }}" class="w-20 h-20 object-contain">
                            <h4 class="font-tenor text-xl uppercase tracking-[0.3em]">{{ $block['title'] }}</h4>
                        </div>
                        <div class="mt-6 space-y-4 text-sm text-neutral-700 text-center">
                            @foreach($block['description'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- USPs --}}
    <section class="py-16 lg:py-24 bg-neutral-50">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <div class="space-y-5">
                    <p class="text-xs tracking-[0.4em] uppercase text-neutral-500">Our USP’s</p>
                    <h2 class="font-tenor text-3xl uppercase">Why customers trust Atha Construction</h2>
                    <div class="space-y-3">
                        @foreach($usps as $usp)
                            <div class="flex items-start gap-4 bg-white rounded-2xl px-5 py-4 shadow-sm border border-black/5">
                                <span class="w-2 h-2 rounded-full bg-black mt-2"></span>
                                <p class="text-sm text-neutral-700">{{ $usp }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(['usp1.jpg','usp2.jpg','usp3.jpg','usp4.jpg'] as $index => $photo)
                        <img 
                            src="{{ asset('images/about/' . $photo) }}" 
                            alt="Atha Construction USP {{ $index + 1 }}"
                            class="rounded-[24px] w-full h-56 object-cover shadow-lg"
                        >
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Founders --}}
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4 text-center">
            <p class="text-xs tracking-[0.4em] uppercase text-neutral-500 mb-3">Leadership</p>
            <h2 class="font-tenor text-3xl uppercase mb-12">Our Founders</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($founders as $founder)
                    <article class="bg-white border border-black/5 rounded-[32px] p-6 flex flex-col items-center text-center shadow-sm">
                        <img 
                            src="{{ asset($founder['image']) }}" 
                            alt="{{ $founder['name'] }}"
                            class="w-40 h-40 object-cover rounded-full border-4 border-black/5 shadow-lg mb-6"
                        >
                        <h3 class="text-xl font-semibold">{{ $founder['name'] }}</h3>
                        <p class="text-xs uppercase tracking-[0.3em] text-neutral-500 mb-4">{{ $founder['title'] }}</p>
                        <p class="text-sm text-neutral-600 leading-relaxed">{{ $founder['bio'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts>

