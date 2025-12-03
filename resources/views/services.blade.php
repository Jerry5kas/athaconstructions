<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        pageTitle="Our Services"
        contentTitle="Experience the Comfort"
        description="From design to delivery, we manage every detail of your home construction with precision, transparency, and care."
        backgroundImage="images/services-banner.png"
        alt="Home Construction Company in Bangalore"
        title="Home Construction Company in Bangalore"
    />

    {{-- Stats Section --}}
    <x-stats-section
        title="EXPERTISE. PROFESSIONALISM. DEDICATION."
        description="The ATHA Construction offers an unparalleled level of service, expertise and discretion to its clients, buyers and sellers alike, across the globe."
        :stats="$stats"
        backgroundImage="images/blog-2.jpeg"
        sectionId="next-section"
    />

    {{-- Services Content --}}
    <section class="py-12 lg:py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10 lg:mb-14">
                <p class="tracking-[0.25em] text-[11px] lg:text-xs uppercase text-gray-500 mb-2">
                    WHAT WE OFFER
                </p>
                <h2 class="font-tenor text-2xl lg:text-3xl uppercase">
                    OUR CORE SERVICES
                </h2>
                <p class="text-sm lg:text-base max-w-3xl mx-auto mt-4 text-gray-700">
                    Every service is designed to simplify your construction journey – from the first line on paper to final handover of your dream home.
                </p>
            </div>

            <div class="space-y-12 lg:space-y-16">
                @foreach($services as $service)
                    @php
                        $isEven = $loop->iteration % 2 === 0;
                    @endphp
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 items-center">
                        {{-- Image column --}}
                        <div class="{{ $isEven ? 'order-2 lg:order-2' : 'order-1 lg:order-1' }}">
                            <div class="relative overflow-hidden rounded-xl lg:rounded-2xl border border-gray-200 bg-[#0B0D10]">
                                <div class="absolute inset-0 bg-gradient-to-tr from-black/60 via-black/30 to-transparent"></div>
                                <img
                                    src="{{ $service->image_url }}"
                                    alt="{{ $service->title }}"
                                    class="w-full h-64 lg:h-80 object-cover transform transition duration-700 ease-out hover:scale-[1.03]"
                                >
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] tracking-[0.18em] uppercase bg-white/10 text-gray-100 border border-white/15 backdrop-blur">
                                        Service {{ sprintf('%02d', $loop->iteration) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Content column --}}
                        <div class="{{ $isEven ? 'order-1 lg:order-1' : 'order-2 lg:order-2' }} space-y-4 lg:space-y-5">
                            <p class="tracking-[0.25em] text-[11px] lg:text-xs uppercase text-gray-500">
                                {{ $loop->iteration < 10 ? '0' . $loop->iteration : $loop->iteration }} • ATHA SERVICES
                            </p>
                            <h3 class="font-tenor text-xl lg:text-2xl uppercase">
                                {{ $service->title }}
                            </h3>
                            @if($service->description)
                                <p class="text-sm lg:text-base leading-relaxed text-gray-700">
                                    {{ $service->description }}
                                </p>
                            @endif

                            <div class="flex flex-wrap items-center gap-3 pt-2">
                                <div class="flex items-center gap-2 text-xs lg:text-sm text-gray-600">
                                    <span class="inline-block w-6 h-[1px] bg-gray-400"></span>
                                    <span>Curated, end‑to‑end execution</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts>
