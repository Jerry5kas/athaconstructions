@props([
    'packages' => [],
])

<section class="py-12 lg:py-16 text-center packages-section" id="next-section">
    <div class="container mx-auto px-4">
        {{-- Section Header --}}
        <div class="max-w-4xl mx-auto mb-10 lg:mb-14">
            <p class="text-xs lg:text-sm tracking-[0.3em] uppercase text-gray-500 mb-3">
                CONSTRUCTION PACKAGES
            </p>
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-3">
                Choose the Right Package for Your Home
            </h2>
            <p class="max-w-3xl mx-auto text-sm lg:text-base text-gray-700">
                Every package is engineered for a different stage of your home-building journey—balancing material quality, engineering support, and finishing levels so you can build with clarity.
            </p>
        </div>

        {{-- Packages Grid --}}
        <div class="packages-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 max-w-7xl mx-auto mb-8">
            @foreach($packages as $index => $package)
                <a 
                    href="{{ route('packages.show', $package['slug']) }}"
                    class="block h-full"
                >
                    <div class="package-card cursor-pointer group relative overflow-hidden rounded-2xl">
                        <div class="package-card-media relative">
                            <img 
                                src="{{ asset($package['image']) }}" 
                                alt="{{ $package['name'] }}"
                                class="w-full h-full object-cover"
                            >
                            <div class="package-card-media-overlay"></div>
                            <div class="package-card-tag">
                                <span class="package-card-tag-label">Starting at</span>
                                <span class="package-card-tag-price">{{ $package['pricePerSqft'] }}</span>
                            </div>
                        </div>

                        <div class="package-card-content">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="font-tenor text-lg lg:text-xl uppercase text-gray-900">
                                    {{ $package['name'] }}
                                </h3>
                                <div class="package-pill">
                                    <span class="package-pill-dot"></span>
                                    <span class="package-pill-text">Sq.ft based</span>
                                </div>
                            </div>
                            <p class="package-card-sub text-xs lg:text-sm text-gray-600 mb-4">
                                Ideal for homeowners looking for a {{ $package['name'] }} balance of materials, finishes, and on-site support.
                            </p>

                            <div class="flex items-center justify-between text-[11px] text-gray-700">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-black text-white">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path d="M4 20V7l8-4 8 4v13H4Z" stroke-width="1.5" stroke-linejoin="round"/>
                                            <path d="M9 14h6v6H9v-6Z" stroke-width="1.5" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span>Structure + Finish</span>
                                </div>
                                <span class="inline-flex items-center gap-1 package-card-cta">
                                    View details
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M9 5l7 7-7 7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

@once
<style>
    .packages-section {
        position: relative;
    }

    .packages-grid {
        position: relative;
    }

    .packages-grid::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(to right, rgba(0,0,0,0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(0,0,0,0.03) 1px, transparent 1px);
        background-size: 32px 32px;
        opacity: 0.4;
        pointer-events: none;
    }

    .package-card {
        background: #ffffff;
        box-shadow: 0 18px 60px rgba(0,0,0,0.16);
        border: 1px solid rgba(0,0,0,0.08);
        overflow: hidden;
        transition: transform 0.45s cubic-bezier(0.22, 0.61, 0.36, 1),
                    box-shadow 0.45s cubic-bezier(0.22, 0.61, 0.36, 1),
                    border-color 0.45s ease;
    }

    .package-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 26px 80px rgba(0,0,0,0.22);
        border-color: rgba(0,0,0,0.18);
    }

    .package-card-media {
        position: relative;
        height: 170px;
        overflow: hidden;
    }

    .package-card-media img {
        transform: scale(1.03);
        transition: transform 0.6s ease;
    }

    .package-card:hover .package-card-media img {
        transform: scale(1.08);
    }

    .package-card-media-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            140deg,
            rgba(0,0,0,0.55) 0%,
            rgba(0,0,0,0.35) 45%,
            rgba(0,0,0,0.1) 100%
        );
    }

    .package-card-tag {
        position: absolute;
        left: 1rem;
        bottom: 1rem;
        padding: 0.45rem 0.9rem;
        border-radius: 999px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.55);
        color: #ffffff;
        display: inline-flex;
        flex-direction: column;
        gap: 0.1rem;
        font-size: 0.7rem;
    }

    .package-card-tag-label {
        text-transform: uppercase;
        letter-spacing: 0.16em;
        opacity: 0.8;
    }

    .package-card-tag-price {
        font-size: 0.95rem;
        font-weight: 600;
    }

    .package-card-content {
        padding: 1.15rem 1.25rem 1.1rem;
        position: relative;
    }

    .package-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        border: 1px solid rgba(0,0,0,0.12);
        background: linear-gradient(135deg, #f5f5f5, #ffffff);
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
    }

    .package-pill-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #000;
    }

    .package-card-sub {
        padding-left: 0.15rem;
    }

    .package-card-cta {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.16em;
    }

    .package-card-cta svg {
        transition: transform 0.25s ease;
    }

    .package-card:hover .package-card-cta svg {
        transform: translateX(2px);
    }
</style>
@endonce


