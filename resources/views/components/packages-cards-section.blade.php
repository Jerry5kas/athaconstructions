@props([
    'packages' => [],
])

<section class="packages-cards-section">
    <div class="container mx-auto px-4">
        {{-- Packages Grid --}}
        <div class="packages-cards-grid">
            @foreach($packages as $package)
                <div class="package-card">
                    <div class="package-card-image">
                        <img 
                            src="{{ asset($package['image'] ?? 'images/mysoore-proj.png') }}" 
                            alt="{{ $package['name'] ?? 'Package' }}"
                            loading="lazy"
                        />
                    </div>
                    <div class="package-card-content">
                        <h3 class="package-card-name">{{ $package['name'] ?? 'Package' }}</h3>
                        <p class="package-card-price">{{ $package['pricePerSqft'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@once
<style>
    .packages-cards-section {
        position: relative;
    }

    .packages-cards-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        max-width: 1000px;
        margin: 0 auto;
    }

    .package-card {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        background: transparent;
        padding: 0;
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 4px;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: visible;
    }

    .package-card:hover {
        background: #f9f9f9;
    }

    .package-card-image {
        flex-shrink: 0;
        width: 120px;
        height: 90px;
        border-radius: 4px;
        overflow: hidden;
        background: transparent;
        position: relative;
        transition: all 0.3s ease;
    }

    .package-card:hover .package-card-image {
        background: #ffffff;
    }

    .package-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .package-card:hover .package-card-image img {
        transform: scale(1.05);
    }

    .package-card-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        min-width: 0;
    }

    .package-card-name {
        font-family: 'Tenor Sans', serif;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #6b7280;
        margin: 0;
        line-height: 1.3;
    }

    .package-card-price {
        font-family: 'Tenor Sans', serif;
        font-size: 1rem;
        font-weight: 700;
        color: #4b5563;
        margin: 0;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    /* Tablet View */
    @media (min-width: 640px) {
        .packages-cards-grid {
            gap: 1.75rem;
        }

        .package-card {
            padding: 0;
            gap: 2rem;
        }


        .package-card-image {
            width: 140px;
            height: 105px;
        }

        .package-card-name {
            font-size: 0.9375rem;
        }

        .package-card-price {
            font-size: 1.125rem;
        }
    }

    /* Desktop View */
    @media (min-width: 1024px) {
        .packages-cards-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            max-width: 1400px;
        }

        .package-card {
            flex-direction: row;
            padding: 0;
            gap: 1.25rem;
            align-items: center;
        }


        .package-card-image {
            width: 120px;
            height: 90px;
        }

        .package-card-name {
            font-size: 0.875rem;
        }

        .package-card-price {
            font-size: 1rem;
        }
    }

    /* Large Desktop View */
    @media (min-width: 1280px) {
        .packages-cards-grid {
            gap: 2rem;
        }

        .package-card {
            padding: 0;
        }


        .package-card-image {
            width: 140px;
            height: 105px;
        }
    }

    /* Mobile adjustments */
    @media (max-width: 639px) {
        .package-card {
            padding: 0;
            gap: 1.25rem;
        }

        .package-card-image {
            width: 100px;
            height: 75px;
        }

        .package-card-name {
            font-size: 0.8125rem;
        }

        .package-card-price {
            font-size: 0.9375rem;
        }
    }
</style>
@endonce
