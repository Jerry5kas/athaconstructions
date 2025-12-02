@props([
    'pageTitle' => '',
    'contentTitle' => '',
    'description' => '',
    'backgroundImage' => '',
    'backgroundVideo' => '',
    'alt' => '',
    'title' => '',
])

<section class="relative min-h-[70vh] lg:h-screen flex items-center overflow-hidden">
    @if($backgroundVideo)
        <div class="absolute inset-0 w-full h-full">
            <video 
                autoplay 
                muted 
                loop 
                playsinline 
                class="absolute inset-0 w-full h-full object-cover"
                @ended="$event.target.currentTime = 0; $event.target.play()"
            >
                <source src="{{ asset($backgroundVideo) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    @elseif($backgroundImage)
        <img 
            src="{{ asset($backgroundImage) }}" 
            alt="{{ $alt }}" 
            title="{{ $title }}"
            class="absolute inset-0 w-full h-full object-cover"
        >
    @endif
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="absolute inset-0 flex items-center justify-center z-10">
        <div class="page-banner-content text-center px-4 lg:px-8 max-w-4xl mx-auto">
            @if($pageTitle)
                <p class="page-banner-label">
                    {{ $pageTitle }}
                </p>
            @endif
            
            @if($contentTitle)
                <h1 class="page-banner-title">
                    {{ $contentTitle }}
                </h1>
            @endif
            
            @if($description)
                <p class="page-banner-description">
                    {{ $description }}
                </p>
            @endif
        </div>
    </div>
</section>

@once
<style>
    .page-banner-label {
        font-size: clamp(14px, 1.5vw, 16px);
        font-weight: 400;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.82);
        margin-bottom: 14px;
    }

    .page-banner-title {
        font-size: clamp(28px, 4vw, 42px);
        font-weight: 600;
        letter-spacing: 0.32em;
        text-transform: uppercase;
        color: #ffffff;
        margin-bottom: 14px;
    }

    .page-banner-description {
        font-size: clamp(14px, 1.5vw, 16px);
        font-weight: 400;
        letter-spacing: 0.05em;
        color: rgba(255, 255, 255, 0.82);
        max-width: 42rem;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }
</style>
@endonce

