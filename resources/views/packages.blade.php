<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <!-- <x-page-banner
        pageTitle="Our Construction Packages"
        contentTitle="Solid Presence, Built to Last"
        description="Thoughtfully crafted home construction packages that balance quality, transparency, and value—so you can build with confidence."
        backgroundImage="images/properties/banner.png"
        alt="Home Construction In Bangalore"
        title="Home Construction In Bangalore"
    /> -->

    {{-- Packages Tab Container --}}
    <div x-data="{ activeTab: 'cards' }">
        {{-- Packages Banner Section --}}
        <section class="packages-banner-section">
            <div class="packages-banner-wrapper">
                <div class="packages-banner-overlay"></div>
                <div class="packages-banner-content">
        <div class="container mx-auto px-4 lg:px-8">
                        <div class="packages-section-header max-w-5xl mx-auto text-center">
                            <p class="packages-section-label text-xs lg:text-sm tracking-[0.3em] uppercase text-white/90 mb-4">
                    Construction Packages
                </p>
                            <h2 class="packages-section-title font-tenor text-3xl lg:text-4xl xl:text-5xl uppercase mb-4 lg:mb-6 text-white leading-tight">
                    Choose Your Construction Package
                </h2>
                            <p class="packages-section-description max-w-3xl mx-auto text-sm lg:text-base text-white/95 leading-relaxed">
                    Explore our thoughtfully crafted construction packages, each designed to meet different needs and budgets.
                </p>
                        </div>
                    </div>
            </div>

                {{-- Tabs Navigation at Bottom of Banner --}}
                <div class="packages-tabs-wrapper-banner">
                    <div class="container mx-auto px-4 lg:px-8">
                <div class="packages-tabs-container">
                    <button 
                        @click="activeTab = 'cards'"
                        :class="activeTab === 'cards' ? 'packages-tab-active' : 'packages-tab-inactive'"
                        class="packages-tab"
                        aria-label="View packages as cards"
                    >
                        <span class="packages-tab-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <rect x="3" y="3" width="7" height="7" stroke-width="1.5"/>
                                <rect x="14" y="3" width="7" height="7" stroke-width="1.5"/>
                                <rect x="3" y="14" width="7" height="7" stroke-width="1.5"/>
                                <rect x="14" y="14" width="7" height="7" stroke-width="1.5"/>
                            </svg>
                        </span>
                        <span class="packages-tab-text">Packages</span>
                    </button>
                    <button 
                        @click="activeTab = 'comparison'"
                        :class="activeTab === 'comparison' ? 'packages-tab-active' : 'packages-tab-inactive'"
                        class="packages-tab"
                        aria-label="View packages comparison"
                    >
                        <span class="packages-tab-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M3 3h18v18H3z" stroke-width="1.5"/>
                                <path d="M3 9h18M9 3v18" stroke-width="1.5"/>
                            </svg>
                        </span>
                        <span class="packages-tab-text">Comparison</span>
                    </button>
                </div>
            </div>
                </div>
            </div>
        </section>

        {{-- Packages Section with Tabs --}}
        <section class="packages-section py-16 lg:py-24">
            <div class="container mx-auto px-4 lg:px-8">

            {{-- Cards View --}}
            <div 
                x-show="activeTab === 'cards'" 
                x-cloak
                x-transition:enter="transition ease-out duration-300" 
                x-transition:enter-start="opacity-0" 
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div class="packages-cards-grid py-16">
                    @foreach($packages as $package)
                        <x-package-card :package="$package" />
                    @endforeach
                </div>
            </div>

            {{-- Comparison View --}}
                <div 
                    x-show="activeTab === 'comparison'" 
                    x-cloak
                    x-transition:enter="transition ease-out duration-300" 
                    x-transition:enter-start="opacity-0" 
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                >
                <x-packages-comparison-section
                    :packages="$packages"
                    :comparison-groups="$comparisonGroups"
                />
            </div>
        </div>
    </section>
    </div>

    {{-- Customize Package Section --}}
    <section class="py-12 lg:py-16 bg-gray-50" x-data="{ 
        customizeModalOpen: false,
        openCustomizeModal() {
            this.customizeModalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeCustomizeModal() {
            this.customizeModalOpen = false;
            document.body.style.overflow = '';
        }
    }">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm lg:text-base mb-6">
                Need a custom package? We can tailor a solution to fit your specific needs and budget.
            </p>
            <button 
                @click="openCustomizeModal()"
                class="px-8 py-3 border-2 border-black text-black text-sm uppercase tracking-wide hover:bg-black hover:text-white transition-all duration-300"
            >
                Customize Your Package
            </button>
        </div>

        {{-- Customize Package Modal --}}
        <div
            x-show="customizeModalOpen"
            x-cloak
            @click.self="closeCustomizeModal()"
            @keydown.escape.window="closeCustomizeModal()"
            class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div
                @click.stop
                class="enquiry-modal bg-white rounded-lg shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
            >
                {{-- Modal Header --}}
                <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between z-10">
                    <div>
                        <h3 class="font-tenor text-2xl uppercase tracking-tight">Customize Your Package</h3>
                        <p class="text-xs text-gray-500 mt-1">Share your requirements and we’ll tailor a package for you.</p>
                    </div>
                    <button
                        @click="closeCustomizeModal()"
                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors"
                        aria-label="Close"
                    >
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                {{-- Modal Body - Reusable Contact Form --}}
                <div class="p-6 lg:p-8">
                    <x-contact-enquiry
                        variant="modal"
                        :messageSource="'Customize package enquiry'"
                        :onSuccess="'closeCustomizeModal();'"
                    />
                </div>
            </div>
        </div>
    </section>

    @once
    <style>
        /* Alpine.js x-cloak */
        [x-cloak] {
            display: none !important;
        }

        /* Packages Banner Section */
        .packages-banner-section {
            position: relative;
            width: 100%;
            overflow: visible;
        }

        .packages-banner-wrapper {
            position: relative;
            width: 100%;
            background-image: url('{{ asset("images/banner.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 4rem;
        }

        .packages-banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.60) 100%);
            z-index: 1;
        }

        .packages-banner-content {
            position: relative;
            z-index: 2;
            width: 100%;
            padding: 5rem 0 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .packages-tabs-wrapper-banner {
            position: absolute;
            bottom: -2.5rem;
            left: 0;
            right: 0;
            z-index: 10;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .packages-tabs-wrapper-banner .container {
            display: flex;
            justify-content: center;
        }

        /* Packages Section */
        .packages-section {
            position: relative;
            background: #ffffff;
            padding-top: 4rem;
        }

        /* Packages Cards Grid */
        .packages-cards-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        @media (min-width: 640px) {
            .packages-cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 5rem;
            }
        }

        @media (min-width: 1024px) {
            .packages-cards-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 5rem;
            }
        }

        @media (min-width: 1280px) {
            .packages-cards-grid {
                gap: 5rem;
            }
        }

        /* Section Header */
        .packages-section-header {
            animation: fadeInUp 0.6s ease-out;
            position: relative;
            z-index: 2;
        }

        .packages-section-label {
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            letter-spacing: 0.3em;
        }

        .packages-section-title {
            font-family: 'Tenor Sans', serif;
            font-weight: 400;
            letter-spacing: 0.05em;
        }

        .packages-section-description {
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
        }

        /* Responsive Banner */
        @media (max-width: 768px) {
            .packages-banner-wrapper {
                min-height: 300px;
            }

            .packages-banner-content {
                padding: 3rem 0;
            }
        }

        @media (max-width: 640px) {
            .packages-banner-wrapper {
                min-height: 250px;
            }

            .packages-banner-content {
                padding: 2.5rem 0;
            }
        }

        /* Tabs Wrapper */
        .packages-tabs-wrapper {
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .packages-tabs-wrapper-banner {
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .packages-tabs-container {
            display: inline-flex;
            gap: 0.5rem;
            justify-content: center;
            padding: 0.25rem;
            background: #ffffff;
            border-radius: 8px;
            margin: 0 auto;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .packages-tab {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.75rem 1.5rem;
            background: transparent;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8125rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #6b7280;
        }

        .packages-tabs-wrapper-banner .packages-tab {
            color: #6b7280;
        }

        .packages-tab:hover {
            color: #000000;
            background: rgba(0, 0, 0, 0.03);
        }

        .packages-tabs-wrapper-banner .packages-tab:hover {
            color: #000000;
            background: rgba(0, 0, 0, 0.03);
        }

        .packages-tab-icon {
            width: 16px;
            height: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .packages-tab:hover .packages-tab-icon {
            transform: scale(1.1);
        }

        .packages-tab-icon svg {
            width: 100%;
            height: 100%;
            stroke-width: 1.5;
        }

        .packages-tab-active {
            color: #000000;
            background: #f3f4f6;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .packages-tabs-wrapper-banner .packages-tab-active {
            color: #000000;
            background: #f3f4f6;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .packages-tab-active .packages-tab-icon svg {
            stroke: #000000;
        }

        .packages-tabs-wrapper-banner .packages-tab-active .packages-tab-icon svg {
            stroke: #000000;
        }

        .packages-tab-inactive {
            color: #6b7280;
        }

        .packages-tabs-wrapper-banner .packages-tab-inactive {
            color: #6b7280;
        }

        .packages-tab-inactive .packages-tab-icon svg {
            stroke: #6b7280;
        }

        .packages-tabs-wrapper-banner .packages-tab-inactive .packages-tab-icon svg {
            stroke: #6b7280;
        }

        .packages-tab-inactive:hover {
            color: #000000;
        }

        .packages-tabs-wrapper-banner .packages-tab-inactive:hover {
            color: #000000;
        }

        .packages-tab-inactive:hover .packages-tab-icon svg {
            stroke: #000000;
        }

        .packages-tabs-wrapper-banner .packages-tab-inactive:hover .packages-tab-icon svg {
            stroke: #000000;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (min-width: 640px) {
            .packages-tabs-container {
                gap: 0.75rem;
            }

            .packages-tab {
                padding: 0.875rem 1.75rem;
                font-size: 0.875rem;
            }

            .packages-tab-icon {
                width: 18px;
                height: 18px;
            }
        }

        @media (max-width: 639px) {
            .packages-section {
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            .packages-section-header {
                margin-bottom: 2rem;
            }

            .packages-tabs-wrapper {
                margin-bottom: 2rem;
            }

            .packages-tabs-container {
                gap: 0.5rem;
                padding: 0.25rem;
            }

            .packages-tab {
                padding: 0.625rem 1.25rem;
                font-size: 0.75rem;
                gap: 0.5rem;
            }

            .packages-tab-icon {
                width: 14px;
                height: 14px;
            }
        }
    </style>
    @endonce
</x-layouts>
