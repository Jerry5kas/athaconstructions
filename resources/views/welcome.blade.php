<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']">
    <x-hero :seo="$seo" />

    {{-- Stats Section --}}
    <section class="relative bg-cover bg-center bg-no-repeat" id="next-section" style="background-image: url('{{ asset('images/blog-2.jpeg') }}')">
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

    {{-- About Section --}}
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <div class="lg:col-span-7 lg:pr-12">
                    <p class="text-sm uppercase mb-2">ATHA Construction</p>
                    <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-6">
                        Crafting Dreams, Building Legacies
                    </h2>

                    <div class="space-y-4 text-sm leading-relaxed text-justify">
                        <p>
                            Founded in 2016, Atha Construction has established itself as a trusted name in construction across Karnataka. Specializing in both residential and commercial projects, we are committed to transforming ideas into reality with precision, innovation, and sustainable practices.
                        </p>
                        <p>
                            Our approach combines cutting-edge design, advanced technology, and eco-conscious solutions to create spaces that inspire and endure. From cozy homes to modern office spaces, every project is tailored to exceed client expectations while delivering unmatched value and quality.
                        </p>
                        <p>
                            At Atha Construction, we believe construction is more than building structures—it's about creating environments that foster growth, comfort, and community. Our collaborative process ensures transparency and trust, from concept to completion.
                            With a strong presence in Bengaluru, Mysuru, Ballari, and beyond, we take pride in building lasting partnerships rooted in integrity and excellence. As we continue to grow, our mission remains steadfast: delivering exceptional construction services that stand the test of time.
                        </p>
                    </div>

                    <a href="{{ route('about') }}" class="inline-block mt-8 px-8 py-3 border border-black text-sm uppercase tracking-wide hover:bg-black hover:text-white transition-all duration-300">
                        KNOW MORE
                    </a>
                </div>
                <div class="lg:col-span-5">
                    <img 
                        src="{{ asset('images/ATHA-CONSTRUCTIONS.jpg') }}" 
                        alt="Best Construction Companies in Bangalore" 
                        title="Best Construction Companies in Bangalore"
                        class="w-full rounded-lg shadow-lg"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    <section class="py-16 lg:py-24 bg-black text-white">
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase text-center mb-12">OUR SERVICES</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($services as $service)
                    <div class="animate-on-scroll opacity-0 border-2 border-white rounded-2xl p-6 text-center hover:bg-white/5 transition-all duration-300">
                        <img 
                            src="{{ asset('images/our-ser/' . $service['icon']) }}" 
                            alt="{{ $service['title'] }}"
                            class="w-12 h-12 mx-auto mb-4"
                        >
                        <h3 class="text-lg font-medium mb-3">{{ $service['title'] }}</h3>
                        <p class="text-sm text-gray-300 leading-relaxed">{{ $service['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- What Makes Us Stand Out Section --}}
    <section class="py-16 lg:py-24" x-data="{ visible: false }" x-intersect="visible = true">
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase text-center mb-12">
                <span class="hidden md:inline">What makes us stand out?</span>
                <span class="md:hidden">What makes us<br>stand out?</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-16 max-w-4xl mx-auto">
                {{-- Atha Construction --}}
                <div>
                    <h3 class="text-lg font-semibold mb-4">ATHA CONSTRUCTION</h3>
                    <div class="space-y-3">
                        @foreach($athaAdvantages as $index => $advantage)
                            <p class="flex items-center gap-3 opacity-0"
                               :class="{ 'animate-fade-in-left': visible }"
                               :style="{ animationDelay: '{{ $index * 0.15 }}s' }">
                                <img src="{{ asset('images/right.png') }}" alt="✓" class="w-6 h-6">
                                <span class="text-sm">{{ $advantage }}</span>
                            </p>
                        @endforeach
                    </div>
                </div>

                {{-- Divider for desktop --}}
                <div class="hidden md:block absolute left-1/2 top-1/2 -translate-y-1/2 w-px h-64 border-l border-dashed border-black -z-10 pointer-events-none"></div>

                {{-- Other Contractors --}}
                <div>
                    <h3 class="text-lg font-semibold mb-4">OTHER CONTRACTORS</h3>
                    <div class="space-y-3">
                        @foreach($otherContractors as $index => $disadvantage)
                            <p class="flex items-center gap-3 opacity-0"
                               :class="{ 'animate-fade-in-right': visible }"
                               :style="{ animationDelay: '{{ $index * 0.15 }}s' }">
                                <img src="{{ asset('images/wrong.png') }}" alt="✗" class="w-6 h-6">
                                <span class="text-sm">{{ $disadvantage }}</span>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Project Section --}}
    <section class="hidden md:block">
        <div class="container mx-auto px-4 text-center">
            <img src="{{ asset('images/mysoore-proj.png') }}" alt="Mysore Villa Project" class="w-full">
            <p class="text-sm font-bold pt-4 mb-0">Mysore</p>
            <p class="text-sm mb-0">3BHK Villa</p>
            <p class="text-sm mb-12"><strong>Land Parcel : 2400 sqft</strong></p>
        </div>
    </section>

    {{-- How It Works Section - Desktop --}}
    <section class="py-16 lg:py-24 hidden md:block" x-data="{ activeStep: 0 }" x-init="setInterval(() => activeStep = (activeStep + 1) % {{ count($howItWorks) }}, 3000)">
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase text-center mb-12">How it works</h2>

            {{-- Steps Navigation --}}
            <div class="max-w-5xl mx-auto mb-8">
                <div class="flex justify-between relative">
                    {{-- Progress Line --}}
                    <div class="absolute top-5 left-0 right-0 h-0.5 bg-gray-200"></div>
                    <div class="absolute top-5 left-0 h-0.5 bg-black transition-all duration-500"
                         :style="{ width: (activeStep / {{ count($howItWorks) - 1 }}) * 100 + '%' }"></div>

                    @foreach($howItWorks as $index => $step)
                        <button 
                            @click="activeStep = {{ $index }}"
                            class="relative z-10 flex flex-col items-center text-center w-32 cursor-pointer transition-all duration-300"
                            :class="{ 'text-black': activeStep >= {{ $index }}, 'text-gray-400': activeStep < {{ $index }} }"
                        >
                            <span 
                                class="w-10 h-10 flex items-center justify-center rounded text-lg mb-3 transition-all duration-300"
                                :class="activeStep >= {{ $index }} ? 'bg-black text-white' : 'bg-white text-black border border-gray-300'"
                            >
                                {{ $step['step'] }}
                            </span>
                            <span class="text-xs">{{ $step['title'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Step Content --}}
            <div class="max-w-3xl mx-auto">
                @foreach($howItWorks as $index => $step)
                    <div 
                        x-show="activeStep === {{ $index }}"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-x-4"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        class="text-center"
                    >
                        <img 
                            src="{{ asset('images/' . $step['image']) }}" 
                            alt="{{ $step['title'] }}"
                            class="w-1/4 mx-auto mb-6"
                        >
                        <p class="bg-black text-white p-5 text-lg">{{ $step['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How It Works Section - Mobile --}}
    <section class="py-12 md:hidden">
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl uppercase text-center mb-8">How it works</h2>

            <div class="space-y-8">
                @foreach($howItWorks as $step)
                    <div class="text-center border-b border-gray-200 pb-8 last:border-0">
                        <img 
                            src="{{ asset('images/' . $step['image']) }}" 
                            alt="{{ $step['title'] }}"
                            class="w-3/4 mx-auto mb-4"
                        >
                        <p class="text-lg font-medium mb-2">
                            <span class="inline-block bg-black text-white px-2 py-1 mr-2">{{ $step['step'] }}</span>
                            {{ $step['title'] }}
                        </p>
                        <p class="text-sm text-gray-600 px-4">{{ $step['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Work With Us Section --}}
    <section class="relative min-h-[400px] flex items-center">
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
                Our goal is to offer an unparalleled level of service to our highly respected clients. Whether you are looking to buy or sell your home,
                we guarantee that our expertise, professionalism and dedication will guide you toward meeting your unique real estate needs.
            </p>
            <a href="{{ route('contact') }}" class="inline-block px-8 py-3 border border-white text-white text-sm uppercase tracking-wide hover:bg-white hover:text-black transition-all duration-300">
                CONTACT US
            </a>
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

</x-layouts>
