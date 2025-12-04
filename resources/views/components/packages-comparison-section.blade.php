@props([
    'packages' => [],
    'comparisonGroups' => [],
])

<section 
    class="packages-comparison-section" 
    id="next-section"
    x-data="{
        expandedSections: {},
        toggleSection(sectionName) {
            this.expandedSections[sectionName] = !this.expandedSections[sectionName];
        },
        isSectionExpanded(sectionName) {
            return this.expandedSections[sectionName] || false;
        }
    }">
    <div class="container mx-auto px-4 py-12">
        <div class="packages-grid">
            @foreach($packages as $packageIndex => $package)
                @php
                    /** @var \App\Models\Package $package */
                    $packageId = 'pkg-' . $packageIndex;
                @endphp
                <div class="package-card">
                    {{-- Package Header --}}
                    <div class="package-card-header">
                        <div class="package-header-content">
                            <div class="package-name">{{ $package->name }}</div>
                            <div class="package-price">{{ $package->price_per_sqft_formatted }}</div>
                        </div>
                    </div>

                    {{-- Package Sections --}}
                    <div class="package-sections">
                        @foreach($comparisonGroups ?? [] as $sectionName => $sectionData)
                            @php
                                // controller builds $comparisonGroups[sectionName][price_per_sqft] = [ ['title' => ..., 'value' => content] ]
                                $priceKey = (string) $package->price_per_sqft;
                                $features = $sectionData[$priceKey] ?? null;
                                $content = $features[0]['value'] ?? null;
                                $sectionKey = md5($sectionName);
                            @endphp
                            <div class="package-section-item">
                                {{-- Section Header with Expand Button --}}
                                <button
                                    @click="toggleSection('{{ $sectionKey }}')"
                                    class="package-section-header"
                                    :class="{ 'is-expanded': isSectionExpanded('{{ $sectionKey }}') }"
                                    type="button">
                                    <span class="section-name">{{ $sectionName }}</span>
                                    <div class="section-expand-icon">
                                        <svg 
                                            x-show="!isSectionExpanded('{{ $sectionKey }}')" 
                                            class="icon-plus" 
                                            fill="none" 
                                            stroke="currentColor" 
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        <svg 
                                            x-show="isSectionExpanded('{{ $sectionKey }}')" 
                                            x-cloak 
                                            class="icon-minus" 
                                            fill="none" 
                                            stroke="currentColor" 
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </div>
                                </button>

                                {{-- Expanded Content --}}
                                <div 
                                    x-show="isSectionExpanded('{{ $sectionKey }}')"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 max-h-0 overflow-hidden"
                                    x-transition:enter-end="opacity-100 max-h-[2000px] overflow-visible"
                                    x-transition:leave="transition ease-in duration-250"
                                    x-transition:leave-start="opacity-100 max-h-[2000px] overflow-visible"
                                    x-transition:leave-end="opacity-0 max-h-0 overflow-hidden"
                                    x-cloak
                                    class="package-section-content">
                                    @if($content)
                                        <ul class="feature-list">
                                            @foreach(explode("\n", $content) as $line)
                                                @php $line = trim($line); @endphp
                                                @if(!empty($line))
                                                    <li class="feature-item">{{ $line }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="feature-empty">Not included</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@once
<style>
    .packages-comparison-section {
        background: #ffffff;
        padding: 2rem 0;
    }

    .packages-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .package-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
    }

    .package-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .package-card-header {
        background: linear-gradient(135deg, #111111 0%, #2d2d2d 100%);
        color: #ffffff;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .package-header-content {
        text-align: center;
        width: 100%;
    }

    .package-name {
        font-family: 'Tenor Sans', serif;
        font-size: 1.125rem;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
    }

    .package-price {
        font-size: 0.8125rem;
        opacity: 0.9;
        font-weight: 500;
    }

    .package-sections {
        padding: 0;
        display: flex;
        flex-direction: column;
        flex: 1;
        width: 100%;
        min-height: 0;
    }

    .package-section-item {
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        width: 100%;
    }

    .package-section-item:last-child {
        border-bottom: none;
    }

    .package-section-header {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        text-align: left;
    }

    .package-section-header:hover {
        background: rgba(0, 0, 0, 0.02);
    }

    .package-section-header.is-expanded {
        background: rgba(0, 0, 0, 0.03);
    }

    .section-name {
        font-size: 0.75rem;
        font-weight: 600;
        color: #111827;
        letter-spacing: 0.02em;
        flex: 1;
    }

    .section-expand-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(37, 99, 235, 0.1);
        color: #2563eb;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        flex-shrink: 0;
    }

    .package-section-header:hover .section-expand-icon {
        background: rgba(37, 99, 235, 0.15);
        transform: scale(1.05);
    }

    .package-section-header.is-expanded .section-expand-icon {
        background: #2563eb;
        color: #ffffff;
        transform: rotate(0deg);
    }

    .section-expand-icon svg {
        width: 14px;
        height: 14px;
        stroke-width: 2.5;
    }

    .package-section-content {
        padding: 0 1.25rem 1rem 1.25rem;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .feature-item {
        font-size: 0.6875rem;
        line-height: 1.5;
        color: #4b5563;
        padding: 0.25rem 0;
        transition: color 0.2s ease;
    }

    .feature-item:hover {
        color: #111827;
    }

    .feature-empty {
        font-size: 0.6875rem;
        color: #9ca3af;
        font-style: italic;
        padding: 0.5rem 0;
        text-align: center;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .packages-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .packages-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .package-card-header {
            padding: 1.25rem;
        }

        .package-name {
            font-size: 1rem;
        }

        .package-price {
            font-size: 0.75rem;
        }

        .package-section-header {
            padding: 0.875rem 1rem;
        }

        .section-name {
            font-size: 0.6875rem;
        }

        .package-section-content {
            padding: 0 1rem 0.875rem 1rem;
        }
    }

    @media (max-width: 640px) {
        .packages-comparison-section {
            padding: 1.5rem 0;
        }

        .packages-grid {
            gap: 1.25rem;
        }
    }
</style>
@endonce
