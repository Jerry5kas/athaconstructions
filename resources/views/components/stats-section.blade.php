@props([
    'title' => 'EXPERTISE. PROFESSIONALISM. DEDICATION.',
    'description' => 'The ATHA Construction offers an unparalleled level of service, expertise and discretion to its clients, buyers and sellers alike, across the globe.',
    'stats' => [],
    'backgroundImage' => 'images/blog-2.jpeg',
    'sectionId' => 'next-section'
])

<section class="relative bg-cover bg-center bg-no-repeat {{ $sectionId ? 'id="' . $sectionId . '"' : '' }}"
         style="background-image: url('{{ asset($backgroundImage) }}')">
    <div class="bg-white/90 py-16 lg:py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-4">
                {{ $title }}
            </h2>
            <p class="text-sm max-w-3xl mx-auto mb-12">
                {{ $description }}
            </p>

            <div class="grid grid-cols-3 gap-4 lg:gap-8 max-w-3xl mx-auto">
                @foreach($stats as $stat)
                    @php
                        $numericPart = preg_replace('/[^\d\.]/', '', $stat['number']);
                        $suffixPart = preg_replace('/[\d\.]/', '', $stat['number']);
                        $targetValue = $numericPart !== '' ? (float) $numericPart : 0;
                        
                        // Check if this is the "2M+" stat that needs step animation (0 -> 0.5 -> 1 -> 1.5 -> 2)
                        $isStepCounter = (stripos($stat['number'], '2M') !== false && $targetValue == 2);
                    @endphp
                    <div
                        class="animate-on-scroll opacity-0"
                        @if($isStepCounter)
                            x-data="aboutCounter({ target: @js($targetValue), suffix: @js($suffixPart) })"
                        @else
                            x-data="statCounter({ target: @js($targetValue), suffix: @js($suffixPart) })"
                        @endif
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

