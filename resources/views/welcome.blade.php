<x-layouts
    :title="$seo['title']"
    :description="$seo['description']"
    :keywords="$seo['keywords']">
    <x-hero :seo="$seo"/>

    {{-- Stats Section --}}
    <section class="relative bg-cover bg-center bg-no-repeat" id="next-section"
             style="background-image: url('{{ asset('images/blog-2.jpeg') }}')">
        <div class="bg-white/90 py-16 lg:py-20">
            <div class="container mx-auto px-4 text-center">
                <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-4">
                    EXPERTISE. PROFESSIONALISM. DEDICATION.
                </h2>
                <p class="text-sm max-w-3xl mx-auto mb-12">
                    The ATHA Construction offers an unparalleled level of service, expertise and discretion to its
                    clients, buyers and
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

    {{-- About Section --}}
    <section class="py-16 lg:py-24 about-section">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <div class="lg:col-span-7 lg:pr-12">
                    <p class="text-sm uppercase mb-2 animate-on-scroll opacity-0" style="animation-delay: 0s;">ATHA
                        Construction</p>
                    <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-6 animate-on-scroll opacity-0"
                        style="animation-delay: 0.1s;">
                        Crafting Dreams, Building Legacies
                    </h2>

                    <div class="space-y-4 text-sm leading-relaxed text-justify">
                        <p class="animate-on-scroll opacity-0" style="animation-delay: 0.2s;">
                            Founded in 2016, Atha Construction has established itself as a trusted name in construction
                            across Karnataka. Specializing in both residential and commercial projects, we are committed
                            to transforming ideas into reality with precision, innovation, and sustainable practices.
                        </p>
                        <p class="animate-on-scroll opacity-0" style="animation-delay: 0.3s;">
                            Our approach combines cutting-edge design, advanced technology, and eco-conscious solutions
                            to create spaces that inspire and endure. From cozy homes to modern office spaces, every
                            project is tailored to exceed client expectations while delivering unmatched value and
                            quality.
                        </p>
                        <p class="animate-on-scroll opacity-0" style="animation-delay: 0.4s;">
                            At Atha Construction, we believe construction is more than building structures—it's about
                            creating environments that foster growth, comfort, and community. Our collaborative process
                            ensures transparency and trust, from concept to completion.
                            With a strong presence in Bengaluru, Mysuru, Ballari, and beyond, we take pride in building
                            lasting partnerships rooted in integrity and excellence. As we continue to grow, our mission
                            remains steadfast: delivering exceptional construction services that stand the test of time.
                        </p>
                    </div>

                    <a href="{{ route('about') }}"
                       class="inline-block mt-8 px-8 py-3 border border-black text-sm uppercase tracking-wide hover:bg-black hover:text-white transition-all duration-300 transform hover:scale-105 animate-on-scroll opacity-0"
                       style="animation-delay: 0.5s;">
                        KNOW MORE
                    </a>
                </div>
                <div class="lg:col-span-5">
                    <img
                        src="{{ asset('images/ATHA-CONSTRUCTIONS.jpg') }}"
                        alt="Best Construction Companies in Bangalore"
                        title="Best Construction Companies in Bangalore"
                        class="w-full rounded-lg shadow-lg animate-on-scroll opacity-0 hover:shadow-xl transition-shadow duration-300"
                        style="animation-delay: 0.3s;"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    <section class="py-8 lg:py-12 bg-black text-white min-h-screen flex flex-col justify-center">
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase text-center mb-4 animate-on-scroll opacity-0">OUR
                SERVICES</h2>
            <p class="text-sm lg:text-base text-gray-300 text-center max-w-3xl mx-auto mb-6 lg:mb-8 animate-on-scroll opacity-0"
               style="animation-delay: 0.1s;">
                From concept to completion, we deliver comprehensive construction solutions tailored to your vision.
                Whether you're building your dream home or expanding your business, our expert team brings quality,
                innovation, and reliability to every project.
            </p>

            {{-- Services Slider Component --}}
            <div class="mb-6 lg:mb-8">
                <x-services-slider :services="$services"/>
            </div>

            {{-- CTA Button --}}
            <div class="text-center animate-on-scroll opacity-0">
                <a
                    href="{{ route('services') }}"
                    class="inline-block px-6 py-2 lg:px-8 lg:py-3 border-2 border-white text-white text-xs lg:text-sm uppercase tracking-wide hover:bg-white hover:text-black transition-all duration-300 transform hover:scale-105"
                >
                    VIEW ALL SERVICES
                </a>
            </div>
        </div>
    </section>

    {{-- What Makes Us Stand Out Section --}}
    <section class="py-12 lg:py-16 bg-white relative overflow-hidden h-auto" x-data="{ visible: false }"
             x-intersect="visible = true">
        {{-- Background Decorative SVG - Vertical Dashed Line Only --}}
        <div class="absolute inset-0 pointer-events-none opacity-5">
            <svg class="w-full h-full" viewBox="0 0 1200 800" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M600 0 L600 800" stroke="currentColor" stroke-width="1" stroke-dasharray="20 10"/>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-8 lg:mb-12">
                <h2 class="font-tenor text-3xl lg:text-6xl uppercase mb-4 tracking-tight animate-on-scroll opacity-0"
                    style="animation-delay: 0.1s;">
                    <span class="hidden md:inline">What makes us stand out?</span>
                    <span class="md:hidden">What makes us<br>stand out?</span>
                </h2>
                <div class="w-24 h-0.5 bg-black mx-auto animate-on-scroll opacity-0"
                     style="animation-delay: 0.2s;"></div>
            </div>

            <div class="max-w-7xl mx-auto">
                {{-- Desktop: Asymmetric Split Design --}}
                <div class="hidden lg:block relative">
                    {{-- Center Icon on Vertical Dashed Line --}}
                    <div class="absolute left-1/2 top-0 bottom-0 w-px transform -translate-x-1/2 z-0">
                        <div
                            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                            <svg class="w-12 h-12 text-black" fill="none" viewBox="0 0 64 64"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M32 8 L56 20 L56 44 L32 56 L8 44 L8 20 Z" stroke="currentColor"
                                      stroke-width="2" fill="none"/>
                                <path d="M32 20 L44 26 L44 38 L32 44 L20 38 L20 26 Z" stroke="currentColor"
                                      stroke-width="1.5" fill="none"/>
                            </svg>
                        </div>
                        <div
                            class="absolute top-0 left-1/2 transform -translate-x-1/2 w-px h-1/2 bg-gradient-to-b from-transparent via-gray-200 to-gray-200"></div>
                        <div
                            class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-px h-1/2 bg-gradient-to-b from-gray-200 via-gray-200 to-transparent"></div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 items-start">
                        {{-- ATHA CONSTRUCTION Side --}}
                        <div class="col-span-5 pr-10">
                            <div class="sticky top-32">
                                {{-- Header with SVG --}}
                                <div class="mb-10 animate-on-scroll opacity-0" style="animation-delay: 0.15s;">
                                    <div class="flex items-center gap-4 mb-6">
                                        <svg class="w-8 h-8 text-black flex-shrink-0" fill="none" viewBox="0 0 32 32"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <rect x="4" y="8" width="24" height="18" rx="2" stroke="currentColor"
                                                  stroke-width="2" fill="none"/>
                                            <path d="M8 14 L16 20 L24 14" stroke="currentColor" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="10" cy="6" r="1.5" fill="currentColor"/>
                                            <circle cx="16" cy="6" r="1.5" fill="currentColor"/>
                                            <circle cx="22" cy="6" r="1.5" fill="currentColor"/>
                                        </svg>
                                        <h3 class="font-tenor text-3xl lg:text-4xl uppercase tracking-tight">ATHA<br>CONSTRUCTION
                                        </h3>
                                    </div>
                                    <div class="w-32 h-1 bg-black"></div>
                                </div>

                                {{-- Items with Custom SVGs --}}
                                <div class="space-y-5">
                                    @foreach($athaAdvantages as $index => $advantage)
                                        <div class="comparison-item-left opacity-0"
                                             :class="{ 'animate-fade-in-left': visible }"
                                             :style="{ animationDelay: '{{ $index * 0.1 }}s' }">
                                            <div class="flex items-start gap-6 group">
                                                <div class="flex-shrink-0 mt-1">
                                                    <div
                                                        class="w-12 h-12 bg-black rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md">
                                                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5 13l4 4L19 7" stroke="currentColor"
                                                                  stroke-width="3" stroke-linecap="round"
                                                                  stroke-linejoin="round"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="flex-1 pt-1">
                                                    <p class="text-base text-gray-900 leading-relaxed group-hover:text-black transition-colors">
                                                        {{ $advantage }}
                                                    </p>
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
                        <div class="col-span-5 pl-10">
                            <div class="sticky top-32">
                                {{-- Header with SVG --}}
                                <div class="mb-10 animate-on-scroll opacity-0" style="animation-delay: 0.25s;">
                                    <div class="flex items-center gap-4 mb-6 justify-end">
                                        <h3 class="font-tenor text-3xl lg:text-4xl uppercase tracking-tight text-gray-300 text-right">
                                            OTHER<br>CONTRACTORS</h3>
                                        <svg class="w-8 h-8 text-gray-300 flex-shrink-0" fill="none" viewBox="0 0 32 32"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <rect x="4" y="8" width="24" height="18" rx="2" stroke="currentColor"
                                                  stroke-width="1.5" fill="none" stroke-dasharray="4 4"/>
                                            <path d="M8 14 L16 20 L24 14" stroke="currentColor" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-dasharray="2 2"/>
                                        </svg>
                                    </div>
                                    <div class="w-32 h-1 bg-gray-300 ml-auto"></div>
                                </div>

                                {{-- Items with Custom SVGs --}}
                                <div class="space-y-5">
                                    @foreach($otherContractors as $index => $disadvantage)
                                        <div class="comparison-item-right opacity-0"
                                             :class="{ 'animate-fade-in-right': visible }"
                                             :style="{ animationDelay: '{{ $index * 0.1 }}s' }">
                                            <div class="flex items-start gap-6 group">
                                                <div class="flex-1 pt-1 text-right">
                                                    <p class="text-base text-gray-400 leading-relaxed line-through">
                                                        {{ $disadvantage }}
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0 mt-1">
                                                    <div
                                                        class="w-12 h-12 bg-gray-300 rounded-lg flex items-center justify-center opacity-50">
                                                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 18L18 6M6 6l12 12" stroke="currentColor"
                                                                  stroke-width="3" stroke-linecap="round"
                                                                  stroke-linejoin="round"/>
                                                        </svg>
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
                <div class="lg:hidden space-y-20">
                    {{-- ATHA CONSTRUCTION --}}
                    <div>
                        <div class="mb-10 animate-on-scroll opacity-0">
                            <div class="flex items-center gap-3 mb-6">
                                <svg class="w-6 h-6 text-black" fill="none" viewBox="0 0 32 32"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="4" y="8" width="24" height="18" rx="2" stroke="currentColor"
                                          stroke-width="2" fill="none"/>
                                    <path d="M8 14 L16 20 L24 14" stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <h3 class="font-tenor text-2xl uppercase tracking-tight">ATHA CONSTRUCTION</h3>
                            </div>
                            <div class="w-24 h-0.5 bg-black"></div>
                        </div>

                        <div class="space-y-6">
                            @foreach($athaAdvantages as $index => $advantage)
                                <div class="comparison-item-left opacity-0"
                                     :class="{ 'animate-fade-in-left': visible }"
                                     :style="{ animationDelay: '{{ $index * 0.1 }}s' }">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="3"
                                                          stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-900 leading-relaxed flex-1 pt-2">
                                            {{ $advantage }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Divider with SVG --}}
                    <div class="relative py-6">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-full h-px bg-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <div class="flex items-center justify-center">
                                <svg class="w-12 h-12 text-black" fill="none" viewBox="0 0 64 64"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M32 8 L56 20 L56 44 L32 56 L8 44 L8 20 Z" stroke="currentColor"
                                          stroke-width="2" fill="none"/>
                                    <path d="M32 20 L44 26 L44 38 L32 44 L20 38 L20 26 Z" stroke="currentColor"
                                          stroke-width="1.5" fill="none"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- OTHER CONTRACTORS --}}
                    <div>
                        <div class="mb-10 animate-on-scroll opacity-0" style="animation-delay: 0.2s;">
                            <div class="flex items-center gap-3 mb-6 justify-end">
                                <h3 class="font-tenor text-2xl uppercase tracking-tight text-gray-300 text-right">OTHER
                                    CONTRACTORS</h3>
                                <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 32 32"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="4" y="8" width="24" height="18" rx="2" stroke="currentColor"
                                          stroke-width="1.5" fill="none" stroke-dasharray="4 4"/>
                                </svg>
                            </div>
                            <div class="w-24 h-0.5 bg-gray-300 ml-auto"></div>
                        </div>

                        <div class="space-y-6">
                            @foreach($otherContractors as $index => $disadvantage)
                                <div class="comparison-item-right opacity-0"
                                     :class="{ 'animate-fade-in-right': visible }"
                                     :style="{ animationDelay: '{{ $index * 0.1 }}s' }">
                                    <div class="flex items-start gap-4">
                                        <p class="text-xs text-gray-400 leading-relaxed flex-1 pt-2 text-right line-through">
                                            {{ $disadvantage }}
                                        </p>
                                        <div class="flex-shrink-0 mt-1">
                                            <div
                                                class="w-10 h-10 bg-gray-300 rounded-lg flex items-center justify-center opacity-50">
                                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 18L18 6M6 6l12 12" stroke="currentColor"
                                                          stroke-width="3" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
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

    {{-- Featured Projects Section - Staggered Leaf Structure --}}
    <section class=" pb-8 lg:pt-8 lg:pb-12 bg-white relative overflow-hidden">
        {{-- Decorative Vertical Dashed Line (continuation) --}}
        <div class="hidden lg:block absolute inset-0 pointer-events-none opacity-5">
            <svg class="w-full h-full" viewBox="0 0 1200 800" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M600 0 L600 800" stroke="currentColor" stroke-width="1" stroke-dasharray="20 10"/>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-8 lg:mb-10">
                               <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-3 tracking-tight animate-on-scroll opacity-0">
                    Featured Projects</h2>
                <div class="w-20 h-0.5 bg-black mx-auto animate-on-scroll opacity-0"
                     style="animation-delay: 0.1s;"></div>
            </div>

            @php
                $projects = [
                    [
                        'image' => 'mysoore-proj.png',
                        'location' => 'Bangalore',
                        'type' => '4BHK Luxury Home',
                        'land' => '3200 sqft',
                        'tagline' => 'Smart Living, Premium Design',
                    ],
                    [
                        'image' => 'mysoore-proj.png',
                        'location' => 'Mysore',
                        'type' => '3BHK Villa',
                        'land' => '2400 sqft',
                        'tagline' => 'Heritage Meets Modernity',
                    ],
                    [
                        'image' => 'mysoore-proj.png',
                        'location' => 'Ballari',
                        'type' => 'Commercial Complex',
                        'land' => '5000 sqft',
                        'tagline' => 'Business Excellence',
                    ],
                ];
            @endphp

            <div class="max-w-6xl mx-auto relative featured-projects-container">
                @foreach($projects as $index => $project)
                    @php
                        $isEven = ($index % 2 == 0);
                        $isLeft = $isEven;
                        // Calculate top position: 0, card-height/2, card-height, etc.
                        // Card height is approximately 224px (h-56 = 14rem = 224px)
                        $cardHeight = 224; // h-56 in pixels
                        $topPosition = $index * ($cardHeight / 2);
                    @endphp
                    <div
                        class="project-staggered-card featured-project-item"
                        x-data="{ visible: false }"
                        x-intersect="visible = true"
                        data-index="{{ $index }}"
                        style="--card-index: {{ $index }};"
                    >
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-center">
                            @if($isLeft)
                                {{-- Left Side: Small Image Card --}}
                                <div class="lg:col-span-4 lg:pr-2 animate-on-scroll opacity-0"
                                     :class="{ 'animate-fade-in-left': visible }"
                                     style="animation-delay: {{ $index * 0.15 }}s;">
                                    <div class="project-compact-card group">
                                        <div
                                            class="relative overflow-hidden rounded-lg bg-black h-48 lg:h-56 shadow-md transform transition-all duration-300 hover:scale-105">
                                            <img
                                                src="{{ asset('images/' . $project['image']) }}"
                                                alt="{{ $project['location'] }} - {{ $project['type'] }}"
                                                class="w-full h-full object-cover opacity-85 group-hover:opacity-100 transition-opacity duration-300"
                                            >
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                            <div class="absolute bottom-2 left-2 right-2">
                                                <p class="text-white text-xs uppercase tracking-wider font-semibold">{{ $project['location'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Right Side: Minimal Content --}}
                                <div class="lg:col-span-8 lg:pl-2 animate-on-scroll opacity-0"
                                     :class="{ 'animate-fade-in-right': visible }"
                                     style="animation-delay: {{ ($index * 0.15) + 0.1 }}s;">
                                    <div class="space-y-1.5">
                                        <div>
                                            <p class="text-xs uppercase tracking-widest text-gray-400 mb-0.5">{{ $project['location'] }}</p>
                                            <h3 class="font-tenor text-lg lg:text-xl uppercase mb-1 tracking-tight">{{ $project['type'] }}</h3>
                                            <div class="w-10 h-0.5 bg-black mb-1.5"></div>
                                        </div>
                                        <p class="text-xs text-gray-600 italic mb-1">{{ $project['tagline'] }}</p>
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                            <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                                            <span>{{ $project['land'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Right Side: Small Image Card --}}
                                <div class="lg:col-span-4 lg:pl-2 lg:order-2 animate-on-scroll opacity-0"
                                     :class="{ 'animate-fade-in-right': visible }"
                                     style="animation-delay: {{ $index * 0.15 }}s;">
                                    <div class="project-compact-card group">
                                        <div
                                            class="relative overflow-hidden rounded-lg bg-black h-48 lg:h-56 shadow-md transform transition-all duration-300 hover:scale-105">
                                            <img
                                                src="{{ asset('images/' . $project['image']) }}"
                                                alt="{{ $project['location'] }} - {{ $project['type'] }}"
                                                class="w-full h-full object-cover opacity-85 group-hover:opacity-100 transition-opacity duration-300"
                                            >
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                            <div class="absolute bottom-2 left-2 right-2">
                                                <p class="text-white text-xs uppercase tracking-wider font-semibold">{{ $project['location'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Left Side: Minimal Content --}}
                                <div class="lg:col-span-8 lg:pr-2 lg:order-1 text-right animate-on-scroll opacity-0"
                                     :class="{ 'animate-fade-in-left': visible }"
                                     style="animation-delay: {{ ($index * 0.15) + 0.1 }}s;">
                                    <div class="space-y-1.5">
                                        <div>
                                            <p class="text-xs uppercase tracking-widest text-gray-400 mb-0.5">{{ $project['location'] }}</p>
                                            <h3 class="font-tenor text-lg lg:text-xl uppercase mb-1 tracking-tight">{{ $project['type'] }}</h3>
                                            <div class="w-10 h-0.5 bg-black ml-auto mb-1.5"></div>
                                        </div>
                                        <p class="text-xs text-gray-600 italic mb-1">{{ $project['tagline'] }}</p>
                                        <div class="flex items-center gap-2 text-xs text-gray-500 justify-end">
                                            <span>{{ $project['land'] }}</span>
                                            <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <x-how-it-works :steps="$howItWorks" />

    {{-- Work With Us Section --}}
    <section class="relative min-h-[400px] flex items-center"
             x-data="{ enquiryModalOpen: false }"
             @enquiry-success.window="setTimeout(() => enquiryModalOpen = false, 2000)">
        <img
            src="{{ asset('images/Careers.png') }}"
            alt="best house construction companies in bangalore"
            title="best house construction companies in bangalore"
            class="hidden md:block absolute inset-0 w-full h-full object-cover"
        >
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="container mx-auto px-4 relative z-10 text-center text-white py-16">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-6">WORK WITH US</h2>
            <p class="text-sm max-w-2xl mx-auto mb-8">
                Our goal is to offer an unparalleled level of service to our highly respected clients. Whether you are
                looking to buy or sell your home,
                we guarantee that our expertise, professionalism and dedication will guide you toward meeting your
                unique real estate needs.
            </p>
            <button
                @click="enquiryModalOpen = true"
                class="inline-block px-8 py-3 border border-white text-white text-sm uppercase tracking-wide hover:bg-white hover:text-black transition-all duration-300"
            >
                CONTACT US
            </button>
        </div>

        {{-- Enquiry Form Modal/Lightbox --}}
        <div
            x-show="enquiryModalOpen"
            x-cloak
            @click.self="enquiryModalOpen = false"
            @keydown.escape.window="enquiryModalOpen = false"
            class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div
                @click.stop
                class="enquiry-modal bg-white rounded-lg shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
            >
                {{-- Modal Header --}}
                <div
                    class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between z-10">
                    <div>
                        <h3 class="font-tenor text-2xl uppercase tracking-tight">Get In Touch</h3>
                        <p class="text-xs text-gray-500 mt-1">We'll get back to you soon</p>
                    </div>
                    <button
                        @click="enquiryModalOpen = false"
                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors"
                        aria-label="Close"
                    >
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                {{-- Modal Body - Form --}}
                <div class="p-6 lg:p-8">
                    <x-contact-enquiry 
                        variant="modal"
                        :onSuccess="'enquiryModalOpen = false; setTimeout(() => enquiryModalOpen = false, 2000);'"
                    />
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase text-center mb-12">Frequently Asked Questions</h2>

            <div class="max-w-3xl mx-auto" x-data="{ openFaq: 0 }">
                @foreach($faqs as $index => $faq)
                    <div class="border-b border-gray-200">
                        <button
                            @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center justify-between py-4 text-left bg-black text-white px-4 mb-1"
                        >
                            <span class="text-sm font-medium pr-4">{{ $faq['question'] }}</span>
                            <span class="flex-shrink-0">
                                <i class="fas" :class="openFaq === {{ $index }} ? 'fa-minus' : 'fa-plus'"></i>
                            </span>
                        </button>
                        <div
                            x-show="openFaq === {{ $index }}"
                            x-collapse
                            class="px-4 pb-4"
                        >
                            <p class="text-sm text-gray-600 pt-2">{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @once
        <style>
            /* Featured Projects - Interlocking Stagger Pattern */
            @media (min-width: 1024px) {
                .featured-projects-container {
                    height: auto;
                    position: relative;
                    padding-bottom: 600px; /* Ensure space for absolutely positioned cards */
                }

                .featured-project-item {
                    position: absolute;
                    left: 0;
                    right: 0;
                    width: 100%;
                }

                /* Card 1: Left side, starts at top: 0 */
                .featured-project-item[data-index="0"] {
                    top: 0;
                }

                /* Card 2: Right side, starts at half card height + gap (112px + 48px = 160px) */
                .featured-project-item[data-index="1"] {
                    top: 200px;
                }

                /* Card 3: Left side, starts at full card height + gap (224px + 48px = 272px) */
                .featured-project-item[data-index="2"] {
                    top: 360px;
                }
            }

            /* Mobile: Keep normal flow */
            @media (max-width: 1023px) {
                .featured-project-item {
                    position: relative !important;
                    margin-bottom: 2rem;
                }
            }
        </style>
    @endonce

</x-layouts>
