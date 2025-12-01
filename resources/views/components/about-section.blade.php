@props([
    'subtitle' => 'ATHA Construction',
    'title' => 'Crafting Dreams, Building Legacies',
    'paragraphs' => [],
    'image' => 'images/ATHA-CONSTRUCTIONS.jpg',
    'imageAlt' => 'Best Construction Companies in Bangalore',
    'imageTitle' => 'Best Construction Companies in Bangalore',
    'buttonText' => 'KNOW MORE',
    'buttonLink' => null,
    'imagePosition' => 'right', // 'left' or 'right'
    'sectionClass' => 'about-section',
    'showCounter' => false,
    'counterValue' => 2,
    'counterSuffix' => 'M+',
    'counterLabel' => 'Sq.Ft Developed'
])

<section class="py-16 lg:py-24 {{ $sectionClass }}">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            {{-- Content Section --}}
            <div class="lg:col-span-7 {{ $imagePosition === 'right' ? 'lg:pr-12' : 'lg:pl-12 lg:order-2' }}">
                @if($subtitle)
                    <p class="text-sm uppercase mb-2 animate-on-scroll opacity-0" style="animation-delay: 0s;">
                        {{ $subtitle }}
                    </p>
                @endif

                @if($title)
                    <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-6 animate-on-scroll opacity-0"
                        style="animation-delay: 0.1s;">
                        {{ $title }}
                    </h2>
                @endif

                @if(!empty($paragraphs))
                    <div class="space-y-4 text-sm leading-relaxed text-justify">
                        @foreach($paragraphs as $index => $paragraph)
                            <p class="animate-on-scroll opacity-0" style="animation-delay: {{ 0.2 + ($index * 0.1) }}s;">
                                {{ $paragraph }}
                            </p>
                        @endforeach
                    </div>
                @endif

                @if($showCounter)
                    <div 
                        class="mt-8 animate-on-scroll opacity-0"
                        style="animation-delay: {{ 0.2 + (count($paragraphs) * 0.1) + 0.2 }}s;"
                        x-data="aboutCounter({ target: @js($counterValue), suffix: @js($counterSuffix) })"
                        x-intersect.once="start()"
                    >
                        <div class="flex items-baseline gap-2">
                            <span class="font-tenor text-3xl lg:text-4xl font-medium" x-text="displayValue">0{{ $counterSuffix }}</span>
                            <span class="text-sm lg:text-base text-gray-600">{{ $counterLabel }}</span>
                        </div>
                    </div>
                @endif

                @if($buttonText && $buttonLink)
                    <a href="{{ $buttonLink }}"
                       class="inline-block mt-8 px-8 py-3 border border-black text-sm uppercase tracking-wide hover:bg-black hover:text-white transition-all duration-300 transform hover:scale-105 animate-on-scroll opacity-0"
                       style="animation-delay: {{ 0.2 + (count($paragraphs) * 0.1) + ($showCounter ? 0.5 : 0.3) }}s;">
                        {{ $buttonText }}
                    </a>
                @endif
            </div>

            {{-- Image Section --}}
            <div class="lg:col-span-5 {{ $imagePosition === 'left' ? 'lg:order-1' : '' }}">
                <img 
                    src="{{ asset($image) }}" 
                    alt="{{ $imageAlt }}" 
                    title="{{ $imageTitle }}"
                    class="w-full rounded-lg shadow-lg animate-on-scroll opacity-0 hover:shadow-xl transition-shadow duration-300" 
                    style="animation-delay: 0.3s;"
                >
            </div>
        </div>
    </div>
</section>

