<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        pageTitle="{{ $package['name'] }}"
        contentTitle="{{ $package['headline'] }}"
        description="{{ $package['summary'] }}"
        backgroundImage="{{ $package['image'] }}"
        alt="{{ $package['name'] }}"
        title="{{ $package['name'] }}"
    />

    {{-- Package Detail --}}
    <section class="py-12 lg:py-16" id="next-section">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-[1.2fr,0.9fr] gap-8 lg:gap-12 items-start">
                {{-- Left: Specification Sections --}}
                <div class="space-y-6 lg:space-y-7">
                    @foreach($package['sections'] as $section)
                        <div class="package-spec-block">
                            <div class="flex items-center justify-between mb-3">
                                <h2 class="font-tenor text-lg lg:text-xl uppercase tracking-wide">
                                    {{ $section['title'] }}
                                </h2>
                                <span class="package-spec-pill"></span>
                            </div>
                            <ul class="space-y-2.5">
                                @foreach($section['items'] as $item)
                                    <li class="flex items-start gap-3">
                                        <span class="package-spec-bullet">
                                            <span class="package-spec-inner"></span>
                                        </span>
                                        <span class="text-xs lg:text-sm text-gray-800 leading-relaxed">
                                            {{ $item }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

                {{-- Right: Summary & Price Card --}}
                <aside class="package-summary-wrapper">
                    <div class="package-summary-card">
                        <div class="package-summary-header">
                            <div>
                                <p class="package-summary-kicker">
                                    PACKAGE OVERVIEW
                                </p>
                                <h1 class="font-tenor text-xl lg:text-2xl uppercase mb-1">
                                    {{ $package['name'] }}
                                </h1>
                            </div>
                            <div class="package-summary-badge">
                                <span class="package-summary-badge-inner"></span>
                            </div>
                        </div>

                        <p class="text-xs lg:text-sm text-gray-800 mb-5">
                            {{ $package['summary'] }}
                        </p>

                        <div class="package-summary-price mb-5">
                            <div class="package-summary-price-main">
                                <p class="package-summary-price-label">Base price</p>
                                <p class="package-summary-price-value">
                                    {{ $package['price'] }}
                                </p>
                            </div>
                            <div class="package-summary-price-meta">
                                <span class="package-summary-meta-pill">
                                    {{ $package['pricePerSqft'] }}
                                </span>
                                <span class="package-summary-meta-note">
                                    Sq.ft based billing
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-[11px] lg:text-xs text-gray-800 mb-6">
                            <div class="package-summary-chip">
                                <span class="package-summary-dot"></span>
                                Sq.ft based transparent billing
                            </div>
                            <div class="package-summary-chip">
                                <span class="package-summary-dot"></span>
                                Curated materials & specifications
                            </div>
                            <div class="package-summary-chip">
                                <span class="package-summary-dot"></span>
                                Site supervision & coordination
                            </div>
                            <div class="package-summary-chip">
                                <span class="package-summary-dot"></span>
                                Designed for urban homes
                            </div>
                        </div>

                        <a 
                            href="{{ route('contact') }}"
                            class="package-summary-button"
                        >
                            <span>Enquire about this package</span>
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M9 5l7 7-7 7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>

                        <p class="mt-3 text-[11px] text-gray-500">
                            Need minor customisations? Our team can refine this specification to suit your plot, budget and timelines.
                        </p>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @once
    <style>
        .package-spec-block {
            padding: 1.25rem 1.3rem 1.4rem;
            border-radius: 18px;
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.06);
            box-shadow: 0 18px 60px rgba(0,0,0,0.06);
        }

        .package-spec-pill {
            width: 56px;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, #000000, rgba(0,0,0,0.15));
        }

        .package-spec-bullet {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 1px solid rgba(0,0,0,0.22);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f2f2f2, #ffffff);
            flex-shrink: 0;
        }

        .package-spec-inner {
            width: 8px;
            height: 8px;
            border-radius: 2px;
            background: #000000;
        }

        .package-summary-wrapper {
            position: sticky;
            top: 6.5rem;
        }

        .package-summary-card {
            border-radius: 20px;
            padding: 1.6rem 1.7rem 1.8rem;
            background: radial-gradient(circle at 0% 0%, rgba(0,0,0,0.06), transparent 55%),
                        radial-gradient(circle at 100% 100%, rgba(0,0,0,0.04), transparent 55%),
                        #ffffff;
            border: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 22px 70px rgba(0,0,0,0.10);
        }

        .package-summary-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .package-summary-kicker {
            font-size: 0.7rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #777777;
            margin-bottom: 0.15rem;
        }

        .package-summary-badge {
            width: 42px;
            height: 42px;
            border-radius: 999px;
            border: 1px solid rgba(0,0,0,0.18);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 30% 0%, #ffffff, #f3f3f3);
            position: relative;
            overflow: hidden;
        }

        .package-summary-badge-inner {
            width: 26px;
            height: 26px;
            border-radius: 999px;
            background: radial-gradient(circle at 30% 0%, #000000, #444444);
        }

        .package-summary-price {
            padding: 0.9rem 1rem;
            border-radius: 14px;
            background: linear-gradient(135deg, #f5f5f5, #ffffff);
            border: 1px solid rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.25rem;
        }

        .package-summary-price-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: #777777;
            margin-bottom: 0.15rem;
        }

        .package-summary-price-value {
            font-size: 1.35rem;
            font-weight: 600;
            color: #000000;
        }

        .package-summary-price-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.15rem;
        }

        .package-summary-meta-pill {
            padding: 0.15rem 0.65rem;
            border-radius: 999px;
            border: 1px solid rgba(0,0,0,0.18);
            font-size: 0.68rem;
        }

        .package-summary-meta-note {
            font-size: 0.65rem;
            color: #777777;
        }

        .package-summary-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.6rem;
            border-radius: 999px;
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.08);
        }

        .package-summary-dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: #000000;
        }

        .package-summary-button {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.85rem 1.9rem;
            border-radius: 999px;
            border: 1px solid #000000;
            background: #000000;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-size: 0.7rem;
            transition: background 0.25s ease, color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
        }

        .package-summary-button svg {
            transition: transform 0.25s ease;
        }

        .package-summary-button:hover {
            background: #111111;
            box-shadow: 0 18px 45px rgba(0,0,0,0.35);
            transform: translateY(-1px);
        }

        .package-summary-button:hover svg {
            transform: translateX(2px);
        }

        @media (max-width: 1023px) {
            .package-summary-wrapper {
                position: static;
            }

            .package-summary-card {
                margin-top: 2rem;
            }
        }
    </style>
    @endonce
</x-layouts>


