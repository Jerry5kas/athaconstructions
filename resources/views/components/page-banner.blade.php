@props([
    'pageTitle' => '',
    'contentTitle' => '',
    'description' => '',
    'backgroundImage' => '',
    'backgroundVideo' => '',
    'alt' => '',
    'title' => '',
])

@php
    // Map route names to pagetype values
    $routeToPageType = [
        'home' => 'home',
        'about' => 'about',
        'services' => 'services',
        'properties' => 'properties',
        'blogs' => 'blogs',
        'blog.detail' => 'blogs',
        'contact' => 'contact',
        'cost-estimation' => 'cost-estimation',
        'careers' => 'careers',
        'gallery' => 'gallery',
        'packages' => 'packages',
        'packages.show' => 'packages',
    ];
    
    // Get current route name and map to pagetype
    $currentRoute = request()->route()?->getName() ?? '';
    $pageType = $routeToPageType[$currentRoute] ?? ($currentRoute ?: 'home');
    
    // Fetch active hero section for this page type
    $heroSection = \App\Models\HeroSection::where('pagetype', $pageType)
        ->where('is_active', true)
        ->where(function($query) {
            $query->where('use_image', true)
                  ->orWhere('use_video', true);
        })
        ->orderBy('created_at', 'desc')
        ->first();
    
    // Use HeroSection data if available, otherwise use props
    $displayPageTitle = $heroSection?->page_title ?? $pageTitle;
    $displayTitle = $heroSection?->title ?? $contentTitle;
    $displayDescription = $heroSection?->description ?? $description;
    
    // Determine media to display - Priority: HeroSection > Props
    $useVideo = false;
    $useImage = false;
    $imageUrl = null;
    $videoUrl = null;
    
    if ($heroSection) {
        // Use HeroSection media if available
        if ($heroSection->use_video && $heroSection->video_url) {
            $useVideo = true;
            $videoUrl = $heroSection->video_url;
        } elseif ($heroSection->use_image && $heroSection->image_url) {
            $useImage = true;
            $imageUrl = $heroSection->image_url;
        }
    }
    
    // Fallback to props if HeroSection doesn't have media
    if (!$useVideo && !$useImage) {
        if ($backgroundVideo) {
            $useVideo = true;
            $videoUrl = asset($backgroundVideo);
        } elseif ($backgroundImage) {
            $useImage = true;
            $imageUrl = asset($backgroundImage);
        }
    }
    
    $displayAlt = $alt ?: $displayTitle;
    $displayTitleAttr = $title ?: $displayTitle;
@endphp

<section class="relative min-h-[70vh] lg:h-screen flex items-center overflow-hidden">
    @if($useVideo && $videoUrl)
        {{-- Show video if use_video is enabled and video URL exists --}}
        <div class="absolute inset-0 w-full h-full">
            <video 
                autoplay 
                muted 
                loop 
                playsinline 
                class="absolute inset-0 w-full h-full object-cover"
                @ended="$event.target.currentTime = 0; $event.target.play()"
            >
                <source src="{{ $videoUrl }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    @elseif($useImage && $imageUrl)
        {{-- Show image if use_image is enabled and image URL exists --}}
        <img 
            src="{{ $imageUrl }}" 
            alt="{{ $displayAlt }}" 
            title="{{ $displayTitleAttr }}"
            class="absolute inset-0 w-full h-full object-cover"
        >
    @elseif($backgroundVideo)
        {{-- Fallback to prop video --}}
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
        {{-- Fallback to prop image --}}
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
            @if($displayPageTitle)
                <p class="page-banner-label">
                    {{ $displayPageTitle }}
                </p>
            @endif
            
            @if($displayTitle)
                <h1 class="page-banner-title">
                    {{ $displayTitle }}
                </h1>
            @endif
            
            @if($displayDescription)
                <p class="page-banner-description">
                    {{ $displayDescription }}
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

