@props([
    'package',
])

<div class="package-card">
    <div class="package-card-image">
        <img 
            src="{{ $package->image_path ? asset($package->image_path) : asset('images/packages/default.png') }}" 
            alt="{{ $package->name }}"
            loading="lazy"
        />
    </div>
    <div class="package-card-content">
        <h3 class="package-card-name">{{ $package->name }}</h3>
        <p class="package-card-price">{{ $package->price_per_sqft_formatted }}</p>
    </div>
</div>

@once
<style>
    .packages-cards-grid .package-card {
        display: flex;
        flex-direction: row;
        align-items: center;
        background: #ffffff;
        padding: 0;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        transition: all 0.2s ease;
        cursor: pointer;
        overflow: hidden;
    }

    .packages-cards-grid .package-card:hover {
        border-color: rgba(0, 0, 0, 0.2);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .packages-cards-grid .package-card-image {
        flex: 0 0 180px;
        height: 130px;
        overflow: hidden;
        background: #f5f5f5;
    }

    .packages-cards-grid .package-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: bottom center; /* keep bottom of image visible */
        display: block;
        transition: transform 0.4s ease-out;
    }

    /* Hover zoom effect */
    .packages-cards-grid .package-card:hover .package-card-image img {
        transform: scale(1.08);
    }

    .packages-cards-grid .package-card-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 0.5rem 0.75rem 0.5rem 1rem; /* gap between image and text */
        gap: 0.125rem;
        text-align: center;
    }

    .packages-cards-grid .package-card-name {
        font-family: 'Tenor Sans', serif;
        font-size: 0.625rem;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #374151;
        margin: 0;
        line-height: 1.2;
    }

    .packages-cards-grid .package-card-price {
        font-family: 'Montserrat', sans-serif;
        font-size: 0.6875rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    @media (min-width: 640px) {
        .packages-cards-grid .package-card-image {
            flex-basis: 220px;
            height: 150px;
        }
        .packages-cards-grid .package-card-content {
            padding: 0.5rem 0.875rem 0.5rem 1.1rem;
        }
        .packages-cards-grid .package-card-name {
            font-size: 0.6875rem;
        }
        .packages-cards-grid .package-card-price {
            font-size: 0.75rem;
        }
    }

    @media (min-width: 1024px) {
        .packages-cards-grid .package-card-image {
            flex-basis: 250px;
            height: 180px;
        }
        .packages-cards-grid .package-card-content {
            padding: 0.5rem 1rem 0.5rem 1.25rem;
        }
        .packages-cards-grid .package-card-name {
            font-size: 0.6875rem;
        }
        .packages-cards-grid .package-card-price {
            font-size: 0.75rem;
        }
    }

    @media (min-width: 1280px) {
        .packages-cards-grid .package-card-image {
            flex-basis: 280px;
            height: 200px;
        }
        .packages-cards-grid .package-card-content {
            padding: 0.75rem 1.25rem 0.75rem 1.5rem;
        }
        .packages-cards-grid .package-card-name {
            font-size: 0.75rem;
        }
        .packages-cards-grid .package-card-price {
            font-size: 0.8125rem;
        }
    }

    @media (max-width: 639px) {
        .packages-cards-grid .package-card-image {
            flex-basis: 150px;
            height: 110px;
        }
        .packages-cards-grid .package-card-content {
            padding: 0.5rem 0.75rem 0.5rem 0.75rem;
        }
        .packages-cards-grid .package-card-name {
            font-size: 0.5625rem;
        }
        .packages-cards-grid .package-card-price {
            font-size: 0.625rem;
        }
    }
</style>
@endonce

