@props([
    'package',
])

@php
    $slug = is_object($package) ? $package->slug : ($package['slug'] ?? '');
    $name = is_object($package) ? $package->name : ($package['name'] ?? 'Package');
    $imagePath = is_object($package) ? ($package->image_path ?? null) : ($package['image_path'] ?? null);
    $priceFormatted = is_object($package) ? ($package->price_per_sqft_formatted ?? '') : ($package['price_per_sqft_formatted'] ?? ($package['pricePerSqft'] ?? ''));
@endphp

<a href="{{ $slug ? route('packages.show', $slug) : '#' }}" class="package-card-link">
    <div class="package-card">
        <div class="package-card-image">
            <img 
                src="{{ $imagePath ? asset($imagePath) : asset('images/packages/default.png') }}" 
                alt="{{ $name }}"
                loading="lazy"
            />
            <div class="package-card-overlay"></div>
            <div class="package-card-badge">
                <span class="package-card-badge-text">Starting at</span>
            </div>
        </div>
        <div class="package-card-content">
            <h3 class="package-card-name">{{ $name }}</h3>
            <div class="package-card-price-wrapper">
                <span class="package-card-price">{{ $priceFormatted }}</span>
                <span class="package-card-price-unit">/sq.ft</span>
            </div>
            <div class="package-card-cta">
                <span>View Details</span>
                <svg class="package-card-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </div>
    </div>
</a>

@once
<style>
    .package-card-link {
        display: block;
        text-decoration: none;
        color: inherit;
        height: 100%;
    }

    .packages-cards-grid .package-card {
        display: flex;
        flex-direction: column;
        background: #ffffff;
        transition: all 0.3s ease;
        cursor: pointer;
        overflow: hidden;
        height: 100%;
    }

    .packages-cards-grid .package-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .packages-cards-grid .package-card-image {
        position: relative;
        width: 100%;
        height: 180px;
        overflow: hidden;
        background: linear-gradient(135deg, #f5f5f5 0%, #e5e5e5 100%);
    }

    .packages-cards-grid .package-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .packages-cards-grid .package-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(0, 0, 0, 0) 0%,
            rgba(0, 0, 0, 0.3) 100%
        );
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .packages-cards-grid .package-card:hover .package-card-overlay {
        opacity: 1;
    }

    .packages-cards-grid .package-card:hover .package-card-image img {
        transform: scale(1.1);
    }

    .packages-cards-grid .package-card-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 0.375rem 0.75rem;
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur-md;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .packages-cards-grid .package-card-badge-text {
        font-family: 'Montserrat', sans-serif;
        font-size: 0.625rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #ffffff;
    }

    .packages-cards-grid .package-card-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 1.25rem;
        gap: 0.75rem;
        background: #f9fafb;
    }

    .packages-cards-grid .package-card-name {
        font-family: 'Tenor Sans', serif;
        font-size: 1rem;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #1a1a1a;
        margin: 0;
        line-height: 1.3;
    }

    .packages-cards-grid .package-card-price-wrapper {
        display: flex;
        align-items: baseline;
        gap: 0.25rem;
        margin-top: auto;
    }

    .packages-cards-grid .package-card-price {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1;
    }

    .packages-cards-grid .package-card-price-unit {
        font-family: 'Montserrat', sans-serif;
        font-size: 0.75rem;
        font-weight: 500;
        color: #6b7280;
    }

    .packages-cards-grid .package-card-cta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        font-family: 'Montserrat', sans-serif;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #1a1a1a;
        transition: color 0.3s ease;
    }

    .packages-cards-grid .package-card:hover .package-card-cta {
        color: #000000;
    }

    .packages-cards-grid .package-card-arrow {
        width: 14px;
        height: 14px;
        transition: transform 0.3s ease;
    }

    .packages-cards-grid .package-card:hover .package-card-arrow {
        transform: translateX(4px);
    }

    /* Mobile (up to 639px) */
    @media (max-width: 639px) {
        .packages-cards-grid .package-card-image {
            height: 160px;
        }

        .packages-cards-grid .package-card-content {
            padding: 1rem;
            gap: 0.625rem;
        }

        .packages-cards-grid .package-card-name {
            font-size: 0.875rem;
        }

        .packages-cards-grid .package-card-price {
            font-size: 1.25rem;
        }

        .packages-cards-grid .package-card-price-unit {
            font-size: 0.6875rem;
        }

        .packages-cards-grid .package-card-cta {
            font-size: 0.6875rem;
            padding-top: 0.625rem;
        }

        .packages-cards-grid .package-card-badge {
            top: 8px;
            right: 8px;
            padding: 0.25rem 0.625rem;
        }

        .packages-cards-grid .package-card-badge-text {
            font-size: 0.5625rem;
        }
    }

    /* Tablet (640px to 1023px) */
    @media (min-width: 640px) and (max-width: 1023px) {
        .packages-cards-grid .package-card-image {
            height: 200px;
        }

        .packages-cards-grid .package-card-content {
            padding: 1.5rem;
            gap: 0.875rem;
        }

        .packages-cards-grid .package-card-name {
            font-size: 1.125rem;
        }

        .packages-cards-grid .package-card-price {
            font-size: 1.625rem;
        }
    }

    /* Desktop (1024px and up) */
    @media (min-width: 1024px) {
        .packages-cards-grid .package-card-image {
            height: 220px;
        }

        .packages-cards-grid .package-card-content {
            padding: 1.5rem;
            gap: 1rem;
        }

        .packages-cards-grid .package-card-name {
            font-size: 1.125rem;
        }

        .packages-cards-grid .package-card-price {
            font-size: 1.75rem;
        }

        .packages-cards-grid .package-card-price-unit {
            font-size: 0.8125rem;
        }
    }

    /* Large Desktop (1280px and up) */
    @media (min-width: 1280px) {
        .packages-cards-grid .package-card-image {
            height: 240px;
        }

        .packages-cards-grid .package-card-content {
            padding: 1.75rem;
        }

        .packages-cards-grid .package-card-name {
            font-size: 1.25rem;
        }

        .packages-cards-grid .package-card-price {
            font-size: 2rem;
        }
    }
</style>
@endonce


