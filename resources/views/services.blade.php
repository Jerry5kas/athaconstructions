<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        contentTitle="Experience the Comfort"
        backgroundImage="images/services-banner.png"
        alt="Home Construction Company in Bangalore"
        title="Home Construction Company in Bangalore"
    />

    {{-- Stats Section --}}
    <section class="py-12 lg:py-16 text-center" id="next-section">
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-4">
                EXPERTISE. PROFESSIONALISM. DEDICATION.
            </h2>
            <p class="text-sm lg:text-base max-w-3xl mx-auto mb-8 lg:mb-12 pt-3">
                The ATHA Construction offers an unparalleled level of service, expertise and discretion to its clients, buyers and
                sellers alike, across the globe.
            </p>

            <div class="grid grid-cols-3 gap-4 lg:gap-8 max-w-3xl mx-auto pt-5">
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
    </section>

    {{-- Services Content --}}
    <section class="py-12 lg:py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 lg:mb-12">
                <h2 class="font-tenor text-2xl lg:text-3xl uppercase">OUR SERVICES</h2>
            </div>

            <div class="space-y-12 lg:space-y-16">
                @foreach($services as $index => $service)
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-center">
                        @if($service['order'] === 'image-right')
                            {{-- Content Left, Image Right --}}
                            <div class="order-2 lg:order-1 space-y-4">
                                <h3 class="font-tenor text-xl lg:text-2xl uppercase pt-4 lg:pt-0">
                                    {{ $service['title'] }}
                                </h3>
                                <p class="text-sm lg:text-base leading-relaxed text-gray-700">
                                    {{ $service['description'] }}
                                </p>
                            </div>
                            <div class="order-1 lg:order-2">
                                <img 
                                    src="{{ asset('images/' . $service['image']) }}" 
                                    alt="{{ $service['title'] }}"
                                    class="w-full h-auto"
                                >
                            </div>
                        @else
                            {{-- Image Left, Content Right --}}
                            <div class="order-1 lg:order-1">
                                <img 
                                    src="{{ asset('images/' . $service['image']) }}" 
                                    alt="{{ $service['title'] }}"
                                    class="w-full h-auto"
                                >
                            </div>
                            <div class="order-2 lg:order-2 space-y-4">
                                <h3 class="font-tenor text-xl lg:text-2xl uppercase pt-4 lg:pt-0">
                                    {{ $service['title'] }}
                                </h3>
                                <p class="text-sm lg:text-base leading-relaxed text-gray-700">
                                    {{ $service['description'] }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts>
