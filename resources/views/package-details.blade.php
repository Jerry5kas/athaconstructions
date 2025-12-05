<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Hero Section with Package Overview --}}
    <section class="package-detail-hero relative overflow-hidden">
        <div class="package-detail-hero-bg"></div>
        <div class="container mx-auto px-4 lg:px-8 relative z-10">
            <div class="max-w-7xl mx-auto py-16 lg:py-24">
                <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    {{-- Left: Package Info --}}
                    <div class="lg:col-span-7">
                        <div class="package-hero-badge mb-4">
                            <span class="package-hero-badge-text">CONSTRUCTION PACKAGE</span>
                        </div>
                        <h1 class="font-tenor text-4xl lg:text-6xl uppercase mb-4 text-white leading-tight">
                                    {{ $package['name'] }}
                                </h1>
                        <p class="text-lg lg:text-xl text-white/90 mb-8 leading-relaxed max-w-2xl">
                            {{ $package['headline'] }}
                        </p>
                        <div class="flex flex-wrap items-center gap-4 mb-8">
                            <div class="package-hero-feature">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Transparent Billing</span>
                            </div>
                            <div class="package-hero-feature">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Quality Materials</span>
                            </div>
                            <div class="package-hero-feature">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Expert Supervision</span>
                            </div>
                            </div>
                        </div>

                    {{-- Right: Price Card --}}
                    <div class="lg:col-span-5">
                        <div class="package-hero-price-card">
                            <div class="package-hero-price-header">
                                <p class="package-hero-price-label">Starting From</p>
                                <div class="package-hero-price-main">
                                    <span class="package-hero-price-value">{{ $package['price'] }}</span>
                                </div>
                                <p class="package-hero-price-unit">{{ $package['pricePerSqft'] }}</p>
                            </div>
                            <div class="package-hero-price-divider"></div>
                            <div class="package-hero-price-features">
                                <div class="package-hero-price-feature-item">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Sq.ft based billing</span>
                                </div>
                                <div class="package-hero-price-feature-item">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Curated materials</span>
                                </div>
                                <div class="package-hero-price-feature-item">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Site supervision</span>
                                </div>
                            </div>
                            <a href="{{ route('contact') }}" class="package-hero-price-button">
                                <span>Enquire Now</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Package Summary Section --}}
    <section class="package-summary-section py-12 lg:py-16 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <h2 class="font-tenor text-3xl lg:text-4xl uppercase mb-4">Package Overview</h2>
                <p class="text-gray-700 text-base lg:text-lg leading-relaxed">
                    {{ $package['summary'] }}
                </p>
            </div>
        </div>
    </section>

    {{-- Specifications Section --}}
    <section class="package-specs-section py-12 lg:py-20 bg-gray-50">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-7xl mx-auto">
                {{-- Section Header --}}
                <div class="text-center mb-12">
                    <h2 class="font-tenor text-3xl lg:text-4xl uppercase mb-4">What's Included</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Comprehensive specifications and materials included in this package
                    </p>
                </div>

                {{-- Specifications Grid --}}
                @php
                    $packageName = strtolower($package['name']);
                    $isBasicPackage = $packageName === 'basic package';
                    
                    if ($isBasicPackage) {
                        // Filter sections for Basic Package
                        $filteredSections = [];
                        $allIncludedItems = [];
                        $notIncludedSection = null;
                        
                        foreach ($package['sections'] as $section) {
                            $title = strtolower($section['title']);
                            
                            if (strpos($title, "what's not included") !== false || strpos($title, "not included") !== false) {
                                $notIncludedSection = $section;
                            } else if (strpos($title, 'terms') === false) {
                                // Combine all other sections into "What's Included"
                                $allIncludedItems = array_merge($allIncludedItems, $section['items']);
                            }
                        }
                        
                        // Create Highlights section
                        $filteredSections[] = [
                            'title' => 'Highlights',
                            'items' => [
                                'Complete design package with 2D & 3D drawings',
                                'Premium grade materials (TMT steel, premium cement)',
                                'Professional project management & site supervision',
                                'Quality finishes for kitchen, bathroom & flooring',
                                'Branded fixtures and fittings',
                                'Transparent sq.ft based billing',
                            ]
                        ];
                        
                        // Create What's Included section
                        if (!empty($allIncludedItems)) {
                            $filteredSections[] = [
                                'title' => "What's Included",
                                'items' => $allIncludedItems
                            ];
                        }
                        
                        // Add What's Not Included
                        if ($notIncludedSection) {
                            $filteredSections[] = $notIncludedSection;
                        }
                        
                        $displaySections = $filteredSections;
                    } else {
                        // For other packages, show all sections but ensure proper ordering
                        $displaySections = [];
                        $highlightsSection = null;
                        $includedSection = null;
                        $notIncludedSection = null;
                        $otherSections = [];
                        
                        foreach ($package['sections'] as $section) {
                            $title = strtolower($section['title']);
                            
                            // Identify section types
                            if (strpos($title, 'highlight') !== false || strpos($title, 'key features') !== false) {
                                $highlightsSection = $section;
                            } else if (strpos($title, "what's included") !== false || strpos($title, "included") !== false) {
                                $includedSection = $section;
                            } else if (strpos($title, "what's not included") !== false || strpos($title, "not included") !== false) {
                                $notIncludedSection = $section;
                            } else {
                                $otherSections[] = $section;
                            }
                        }
                        
                        // Order sections: Highlights first, then Included, then others, then Not Included last
                        if ($highlightsSection) {
                            $displaySections[] = $highlightsSection;
                        }
                        if ($includedSection) {
                            $displaySections[] = $includedSection;
                        }
                        foreach ($otherSections as $section) {
                            $displaySections[] = $section;
                        }
                        if ($notIncludedSection) {
                            $displaySections[] = $notIncludedSection;
                        }
                    }
                @endphp
                
                <div class="grid lg:grid-cols-2 gap-6 lg:gap-8">
                    @foreach($displaySections as $index => $section)
                        @php
                            $sectionTitle = strtolower($section['title']);
                            $isHighlightSection = strpos($sectionTitle, 'highlight') !== false || strpos($sectionTitle, 'key features') !== false;
                            $isNotIncluded = strpos($sectionTitle, "not included") !== false;
                            $spanFullWidth = ($isBasicPackage && $index === 0) || ($isHighlightSection && !$isBasicPackage);
                        @endphp
                        <div class="package-spec-card {{ $spanFullWidth ? 'lg:col-span-2' : '' }}">
                            <div class="package-spec-card-header-static">
                                <div class="flex items-center gap-4">
                                    <div class="package-spec-card-icon {{ $isNotIncluded ? 'package-spec-card-icon-excluded' : '' }}">
                                        @if($isNotIncluded)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <h3 class="font-tenor text-xl lg:text-2xl uppercase">
                                        {{ $section['title'] }}
                                    </h3>
                                </div>
                            </div>
                            <div class="package-spec-card-content">
                                <ul class="space-y-3">
                                    @foreach($section['items'] as $item)
                                        <li class="flex items-start gap-3">
                                            <span class="package-spec-item-bullet {{ $isNotIncluded ? 'package-spec-item-bullet-excluded' : '' }}">
                                                @if($isNotIncluded)
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @endif
                                            </span>
                                            <span class="text-sm lg:text-base text-gray-700 leading-relaxed flex-1 {{ $isNotIncluded ? 'line-through opacity-70' : '' }}">
                                                {{ $item }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="package-cta-section py-16 lg:py-24 bg-black text-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="font-tenor text-3xl lg:text-5xl uppercase mb-6">
                    Ready to Build Your Dream Home?
                </h2>
                <p class="text-lg text-white/80 mb-8 max-w-2xl mx-auto">
                    Need minor customisations? Our team can refine this specification to suit your plot, budget and timelines.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a 
                            href="{{ route('contact') }}"
                        class="package-cta-button-primary"
                    >
                        <span>Enquire About This Package</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    <a 
                        href="{{ route('packages') }}"
                        class="package-cta-button-secondary"
                    >
                        View All Packages
                    </a>
                    </div>
            </div>
        </div>
    </section>

    @once
    <style>
        /* Hero Section */
        .package-detail-hero {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            position: relative;
            min-height: 500px;
        }

        .package-detail-hero-bg {
            position: absolute;
            inset: 0;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
            opacity: 0.6;
        }

        .package-hero-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
        }

        .package-hero-badge-text {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.9);
        }

        .package-hero-feature {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 25px;
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .package-hero-price-card {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .package-hero-price-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .package-hero-price-label {
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 0.5rem;
            display: block;
        }

        .package-hero-price-main {
            margin-bottom: 0.5rem;
        }

        .package-hero-price-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1;
        }

        .package-hero-price-unit {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
        }

        .package-hero-price-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            margin: 1.5rem 0;
        }

        .package-hero-price-features {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .package-hero-price-feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
            color: #374151;
        }

        .package-hero-price-feature-item svg {
            color: #10b981;
            flex-shrink: 0;
        }

        .package-hero-price-button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: #1a1a1a;
            color: white;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .package-hero-price-button:hover {
            background: #000000;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .package-hero-price-button svg {
            transition: transform 0.3s ease;
        }

        .package-hero-price-button:hover svg {
            transform: translateX(4px);
        }

        /* Summary Section */
        .package-summary-section {
            position: relative;
        }

        /* Specifications Section */
        .package-specs-section {
            position: relative;
        }

        .package-spec-card {
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .package-spec-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .package-spec-card-header-static {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem;
            background: transparent;
            text-align: left;
        }

        .package-spec-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .package-spec-card-icon-excluded {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
        }

        .package-spec-card-content {
            padding: 0 1.5rem 1.5rem 1.5rem;
            display: block;
        }

        .package-spec-item-bullet {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981, #059669);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
            margin-top: 0.125rem;
        }

        .package-spec-item-bullet-excluded {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        /* CTA Section */
        .package-cta-section {
            position: relative;
            background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        }

        .package-cta-button-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2.5rem;
            background: white;
            color: #1a1a1a;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .package-cta-button-primary:hover {
            background: #f3f4f6;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
        }

        .package-cta-button-primary svg {
            transition: transform 0.3s ease;
        }

        .package-cta-button-primary:hover svg {
            transform: translateX(4px);
        }

        .package-cta-button-secondary {
            display: inline-flex;
            align-items: center;
            padding: 1rem 2.5rem;
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .package-cta-button-secondary:hover {
            border-color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 1023px) {
            .package-detail-hero {
                min-height: auto;
                padding: 3rem 0;
            }

            .package-hero-price-card {
                margin-top: 2rem;
            }

            .package-spec-card-header {
                padding: 1.25rem;
            }

            .package-spec-card-content {
                padding: 0 1.25rem 1.25rem 1.25rem;
            }
        }

        @media (max-width: 639px) {
            .package-detail-hero {
                padding: 2rem 0;
            }

            .package-hero-price-value {
                font-size: 2rem;
            }

            .package-spec-card-icon {
                width: 36px;
                height: 36px;
            }

            .package-cta-button-primary,
            .package-cta-button-secondary {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    @endonce
</x-layouts>
