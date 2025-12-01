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

    {{-- Packages Comparison Section --}}
    <x-packages-comparison-section
        :packages="$packages"
        :comparison-groups="$comparisonGroups"
    />

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
</x-layouts>
