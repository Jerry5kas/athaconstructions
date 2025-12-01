@props([
    'packages' => [],
    'comparisonGroups' => [],
])

<section class="py-12 lg:py-16 packages-section" id="next-section">
    <div class="container mx-auto px-4">
        {{-- Section Header --}}
        <div class="max-w-4xl mx-auto mb-10 lg:mb-12 text-center">
            <p class="text-xs lg:text-sm tracking-[0.3em] uppercase text-gray-500 mb-3">
                CONSTRUCTION PACKAGES
            </p>
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-3">
                Compare Packages Side by Side
            </h2>
            <p class="max-w-3xl mx-auto text-sm lg:text-base text-gray-700">
                Review every specification—materials, fittings, finishes and services—aligned across packages so you can choose the right level of detail for your home.
            </p>
        </div>

        @php
            $priceMap = [
                '1849' => $packages[0] ?? null,
                '2025' => $packages[1] ?? null,
                '2399' => $packages[2] ?? null,
                '2799' => $packages[3] ?? null,
                '4400' => $packages[4] ?? null,
            ];
            $priceKeys = ['1849', '2025', '2399', '2799', '4400'];
        @endphp

        <div class="comparison-table-shell">
            <div class="comparison-table-wrapper">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th class="comparison-col-heading text-left align-bottom">
                                <span class="comparison-heading-label">Specification</span>
                            </th>
                            @foreach($priceKeys as $key)
                                @php $pkg = $priceMap[$key] ?? null; @endphp
                                <th class="comparison-col-heading">
                                    @if($pkg)
                                        <div class="comparison-package-pill">
                                            <span class="comparison-package-name">{{ $pkg['name'] }}</span>
                                            <span class="comparison-package-price">{{ $pkg['pricePerSqft'] }}</span>
                                        </div>
                                    @else
                                        <span class="comparison-heading-label">{{ $key }}/sq.ft</span>
                                    @endif
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comparisonGroups ?? [] as $sectionName => $sectionData)
                            {{-- Section header row --}}
                            @php
                                $normalized = strtolower($sectionName);
                            @endphp
                            <tr class="comparison-section-row">
                                <td class="comparison-section-cell" colspan="{{ 1 + count($priceKeys) }}">
                                    <div class="comparison-section-title-wrap">
                                        <span class="comparison-section-icon">
                                            @switch($normalized)
                                                @case('design')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <rect x="3" y="3" width="18" height="14" rx="2" ry="2" stroke-width="1.5"/>
                                                        <path d="M7 17v4l5-2 5 2v-4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    @break
                                                @case('structure')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path d="M4 20V9l8-5 8 5v11H4Z" stroke-width="1.5" stroke-linejoin="round"/>
                                                        <path d="M9 20v-5h6v5" stroke-width="1.5" stroke-linejoin="round"/>
                                                    </svg>
                                                    @break
                                                @case('kitchen & dining')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path d="M5 4v9" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M9 4v9" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M5 9h4" stroke-width="1.5" stroke-linecap="round"/>
                                                        <rect x="13" y="4" width="6" height="9" rx="1.5" stroke-width="1.5"/>
                                                        <path d="M4 20h16" stroke-width="1.5" stroke-linecap="round"/>
                                                    </svg>
                                                    @break
                                                @case('bathroom & plumbing')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path d="M6 10v4a4 4 0 0 0 8 0v-7" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M6 10h11" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M5 6h3" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M18 20H4" stroke-width="1.5" stroke-linecap="round"/>
                                                    </svg>
                                                    @break
                                                @case('flooring')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <rect x="4" y="4" width="7" height="7" stroke-width="1.5"/>
                                                        <rect x="13" y="4" width="7" height="7" stroke-width="1.5"/>
                                                        <rect x="4" y="13" width="7" height="7" stroke-width="1.5"/>
                                                        <rect x="13" y="13" width="7" height="7" stroke-width="1.5"/>
                                                    </svg>
                                                    @break
                                                @case('door window & railing')
                                                @case('door window & railing')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <rect x="5" y="3" width="7" height="18" rx="1.5" stroke-width="1.5"/>
                                                        <rect x="12" y="3" width="7" height="10" rx="1.5" stroke-width="1.5"/>
                                                        <path d="M12 16h7" stroke-width="1.5" stroke-linecap="round"/>
                                                    </svg>
                                                    @break
                                                @case('painting')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <rect x="4" y="4" width="12" height="6" rx="1.5" stroke-width="1.5"/>
                                                        <path d="M10 10v7a2 2 0 0 0 4 0v-3" stroke-width="1.5" stroke-linecap="round"/>
                                                    </svg>
                                                    @break
                                                @case('electrical')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path d="M11 3L6 13h4l-1 8 7-12h-4l1-6Z" stroke-width="1.5" stroke-linejoin="round"/>
                                                    </svg>
                                                    @break
                                                @case(\"what's not included\")
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <circle cx="12" cy="12" r="9" stroke-width="1.5"/>
                                                        <path d="M8 8l8 8" stroke-width="1.5" stroke-linecap="round"/>
                                                    </svg>
                                                    @break
                                                @case('what is included')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <circle cx="12" cy="12" r="9" stroke-width="1.5"/>
                                                        <path d="M8 12.5l2.5 2.5L16 9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    @break
                                                @case('offers')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path d="M5 7h14" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M7 5h10v12a3 3 0 0 1-3 3H10a3 3 0 0 1-3-3V5Z" stroke-width="1.5"/>
                                                        <path d="M10 11h4" stroke-width="1.5" stroke-linecap="round"/>
                                                    </svg>
                                                    @break
                                                @case('terms and conditions')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <rect x="4" y="4" width="16" height="16" rx="2" stroke-width="1.5"/>
                                                        <path d="M8 9h8M8 13h5" stroke-width="1.5" stroke-linecap="round"/>
                                                    </svg>
                                                    @break
                                                @default
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <circle cx="12" cy="12" r="8" stroke-width="1.5"/>
                                                        <path d="M12 8v4" stroke-width="1.5" stroke-linecap="round"/>
                                                        <circle cx="12" cy="15" r="0.6" fill="currentColor"/>
                                                    </svg>
                                            @endswitch
                                        </span>
                                        <span class="comparison-section-title">{{ strtoupper($sectionName) }}</span>
                                    </div>
                                </td>
                            </tr>

                            @php
                                // Build feature rows: title => [priceKey => value]
                                $features = [];
                                foreach ($priceKeys as $key) {
                                    if (!empty($sectionData[$key]) && is_array($sectionData[$key])) {
                                        foreach ($sectionData[$key] as $item) {
                                            if (!isset($item['title'])) continue;
                                            $title = $item['title'];
                                            $features[$title] = $features[$title] ?? [];
                                            $features[$title][$key] = $item['value'] ?? null;
                                        }
                                    }
                                }
                            @endphp

                            @foreach($features as $featureTitle => $values)
                                <tr class="comparison-row">
                                    <td class="comparison-spec-cell">
                                        <span class="comparison-spec-title">{{ $featureTitle }}</span>
                                    </td>
                                    @foreach($priceKeys as $key)
                                        @php $value = $values[$key] ?? null; @endphp
                                        <td class="comparison-value-cell">
                                            @if(!is_null($value))
                                                <div class="comparison-value-inner">
                                                    <span class="comparison-flag comparison-flag-yes">✓</span>
                                                    <span class="comparison-text">{{ $value }}</span>
                                                </div>
                                            @else
                                                <div class="comparison-value-inner comparison-value-empty">
                                                    <span class="comparison-flag comparison-flag-no">✕</span>
                                                    <span class="comparison-na">Not included</span>
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@once
<style>
    .packages-section {
        position: relative;
    }

    .comparison-table-shell {
        position: relative;
    }

    .comparison-table-shell::before {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 24px;
        background: radial-gradient(circle at 0% 0%, rgba(0,0,0,0.04), transparent 55%),
                    radial-gradient(circle at 100% 100%, rgba(0,0,0,0.04), transparent 55%);
        opacity: 0.7;
        pointer-events: none;
    }

    .comparison-table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 18px;
        border: 1px solid rgba(0,0,0,0.06);
        background: #ffffff;
        box-shadow: 0 26px 80px rgba(0,0,0,0.08);
        position: relative;
        z-index: 1;
    }

    .comparison-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 960px;
    }

    .comparison-table thead {
        background: linear-gradient(135deg, #111111, #333333);
        color: #ffffff;
    }

    .comparison-col-heading {
        padding: 1rem 1.25rem;
        border-right: 1px solid rgba(255,255,255,0.08);
        font-weight: 500;
        font-size: 0.75rem;
    }

    .comparison-col-heading:last-child {
        border-right: none;
    }

    .comparison-heading-label {
        text-transform: uppercase;
        letter-spacing: 0.18em;
        font-size: 0.7rem;
        opacity: 0.85;
    }

    .comparison-package-pill {
        display: inline-flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.15rem;
    }

    .comparison-package-name {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
    }

    .comparison-package-price {
        font-size: 0.75rem;
        opacity: 0.9;
    }

    .comparison-row:nth-child(even) {
        background: #fafafa;
    }

    .comparison-row:nth-child(odd) {
        background: #ffffff;
    }

    .comparison-spec-cell {
        padding: 0.9rem 1.1rem;
        border-top: 1px solid rgba(0,0,0,0.04);
        border-right: 1px solid rgba(0,0,0,0.06);
        vertical-align: top;
        width: 180px;
        background: #f9fafb;
    }

    .comparison-spec-title {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: #111827;
    }

    .comparison-value-cell {
        padding: 0.9rem 1.1rem;
        border-top: 1px solid rgba(0,0,0,0.04);
        border-right: 1px solid rgba(0,0,0,0.04);
        vertical-align: top;
        font-size: 0.75rem;
        color: #111827;
    }

    .comparison-value-cell:last-child {
        border-right: none;
    }

    .comparison-na {
        font-size: 0.75rem;
        color: #9ca3af;
    }

    .comparison-value-inner {
        display: flex;
        align-items: flex-start;
        gap: 0.4rem;
    }

    .comparison-flag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        border-radius: 999px;
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    .comparison-flag-yes {
        background: #16a34a;
        color: #ffffff;
    }

    .comparison-flag-no {
        background: #ef4444;
        color: #ffffff;
    }

    .comparison-value-empty {
        align-items: center;
    }

    .comparison-text {
        font-size: 0.75rem;
    }

    .comparison-section-row {
        background: #f3f4f6;
    }

    .comparison-section-cell {
        padding: 0.8rem 1.1rem;
        border-top: 1px solid rgba(0,0,0,0.06);
        border-bottom: 1px solid rgba(0,0,0,0.08);
    }

    .comparison-section-title-wrap {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .comparison-section-icon {
        width: 22px;
        height: 22px;
        border-radius: 999px;
        background: #000000;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .comparison-section-icon svg {
        width: 13px;
        height: 13px;
    }

    .comparison-section-title {
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: #111827;
    }

    @media (max-width: 1023px) {
        .comparison-table-wrapper {
            box-shadow: 0 18px 50px rgba(0,0,0,0.06);
        }
    }
</style>
@endonce


