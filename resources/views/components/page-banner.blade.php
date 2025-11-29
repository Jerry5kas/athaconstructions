@props([
    'pageTitle' => '',
    'contentTitle' => '',
    'description' => '',
    'backgroundImage' => '',
    'alt' => '',
    'title' => '',
])

<section class="relative min-h-[70vh] flex items-center overflow-hidden">
    <img 
        src="{{ asset($backgroundImage) }}" 
        alt="{{ $alt }}" 
        title="{{ $title }}"
        class="absolute inset-0 w-full h-full object-cover"
    >
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-4xl">
            @if($pageTitle)
                <p class="tracking-[0.4em] text-sm uppercase text-white mb-4">
                    {{ $pageTitle }}
                </p>
            @endif
            
            @if($contentTitle)
                <h1 class="font-tenor text-3xl md:text-5xl lg:text-6xl leading-tight text-white mb-6">
                    {{ $contentTitle }}
                </h1>
            @endif
            
            @if($description)
                <p class="max-w-2xl text-sm md:text-base text-white/80 leading-relaxed">
                    {{ $description }}
                </p>
            @endif
        </div>
    </div>
</section>

