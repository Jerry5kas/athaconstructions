<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        contentTitle="Solid Presence, Built to Last"
        backgroundImage="images/properties/banner.png"
        alt="Home Construction In Bangalore"
        title="Home Construction In Bangalore"
    />

    {{-- Packages Section --}}
    <section class="py-12 lg:py-16 text-center" id="next-section" x-data="{ 
        openModal: null,
        openPackage(packageId) {
            this.openModal = packageId;
            document.body.style.overflow = 'hidden';
        },
        closeModal() {
            this.openModal = null;
            document.body.style.overflow = '';
        }
    }">
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-4">
                PACKAGES
            </h2>
            
            <p class="max-w-3xl mx-auto text-sm lg:text-base mb-12">
                Quality, Value and Service have been our hallmarks. Our packages follow the same philosophy where care is taken to ensure customization without compromising on quality. Home construction is easy with us. We have it all!
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 max-w-7xl mx-auto mb-8">
                @foreach($packages as $index => $package)
                    <div 
                        @click="openPackage({{ $package['id'] }})"
                        class="cursor-pointer group relative overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                    >
                        <img 
                            src="{{ asset($package['image']) }}" 
                            alt="{{ $package['name'] }}"
                            class="w-full h-auto object-cover"
                        >
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h3 class="font-tenor text-xl lg:text-2xl mb-1">{{ $package['name'] }}</h3>
                            <p class="text-lg lg:text-xl font-semibold">{{ $package['pricePerSqft'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Package Detail Modals --}}
        @foreach($packages as $package)
            <div 
                x-show="openModal === {{ $package['id'] }}"
                x-cloak
                @click.self="closeModal()"
                @keydown.escape.window="closeModal()"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div 
                    @click.stop
                    class="bg-white rounded-lg shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                >
                    {{-- Modal Header --}}
                    <div class="sticky top-0 bg-black text-white px-6 py-4 flex items-center justify-between z-10">
                        <div>
                            <p class="font-tenor text-xl lg:text-2xl uppercase mb-1">{{ $package['name'] }}</p>
                            <p class="text-lg lg:text-xl font-semibold">{{ $package['price'] }}/sqft</p>
                        </div>
                        <button 
                            @click="closeModal()"
                            class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-white/20 transition-colors"
                            aria-label="Close"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="p-6 lg:p-8">
                        <div class="grid md:grid-cols-2 gap-8 items-start">
                            {{-- Features List --}}
                            <div>
                                <h4 class="font-tenor text-lg uppercase mb-4">What's Included</h4>
                                <ul class="space-y-2">
                                    @foreach($package['features'] as $feature)
                                        <li class="flex items-start gap-3">
                                            <svg class="w-5 h-5 text-black mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-sm lg:text-base">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Package Image --}}
                            <div>
                                <img 
                                    src="{{ asset($package['image']) }}" 
                                    alt="{{ $package['name'] }}"
                                    class="w-full rounded-lg shadow-lg"
                                >
                            </div>
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-center">
                        <a 
                            href="{{ route('contact') }}"
                            class="px-8 py-3 bg-black text-white text-sm uppercase tracking-wide hover:bg-gray-800 transition-all duration-300"
                        >
                            Enquire Now
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    {{-- Customize Package Section --}}
    <section class="py-12 lg:py-16 bg-gray-50" x-data="{ 
        customizeModalOpen: false,
        formSubmitting: false,
        formMessage: '',
        formErrors: {},
        openCustomizeModal() {
            this.customizeModalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeCustomizeModal() {
            this.customizeModalOpen = false;
            document.body.style.overflow = '';
        },
        submitForm(event) {
            this.formSubmitting = true;
            this.formMessage = '';
            this.formErrors = {};
            
            const formData = new FormData(event.target);
            
            fetch('{{ route('contact.submit') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    this.formErrors = data.errors;
                    this.formMessage = 'error';
                } else if (data.status === 'OK' || data.message) {
                    this.formMessage = 'success';
                    event.target.reset();
                    this.formErrors = {};
                    setTimeout(() => {
                        this.customizeModalOpen = false;
                        this.formMessage = '';
                    }, 2000);
                } else {
                    this.formMessage = 'error';
                }
            })
            .catch(() => {
                this.formMessage = 'error';
            })
            .finally(() => {
                this.formSubmitting = false;
            });
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
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div 
                @click.stop
                class="bg-white rounded-lg shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
            >
                {{-- Modal Header --}}
                <div class="sticky top-0 bg-black text-white px-6 py-4 flex items-center justify-between z-10">
                    <h3 class="font-tenor text-xl lg:text-2xl uppercase">CUSTOMIZE YOUR PACKAGE</h3>
                    <button 
                        @click="closeCustomizeModal()"
                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-white/20 transition-colors"
                        aria-label="Close"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="p-6 lg:p-8">
                    {{-- Success/Error Messages --}}
                    <div 
                        x-show="formMessage === 'success'"
                        x-cloak
                        x-transition
                        class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded"
                    >
                        Thank you! We will contact you soon.
                    </div>
                    <div 
                        x-show="formMessage === 'error'"
                        x-cloak
                        x-transition
                        class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded"
                    >
                        Something went wrong. Please check your inputs and try again.
                    </div>

                    <form @submit.prevent="submitForm($event)" class="space-y-5">
                        {{-- Name and Phone Row --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <input 
                                    type="text" 
                                    name="name" 
                                    placeholder="Enter Your Name" 
                                    required
                                    :class="formErrors.name ? 'border-red-500' : 'border-gray-300'"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-black transition-colors"
                                >
                                <p x-show="formErrors.name" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.name?.[0]"></p>
                            </div>
                            <div>
                                <input 
                                    type="tel" 
                                    name="phone" 
                                    placeholder="Phone No." 
                                    required
                                    maxlength="10"
                                    pattern="[0-9]{10}"
                                    :class="formErrors.phone ? 'border-red-500' : 'border-gray-300'"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-black transition-colors"
                                >
                                <p x-show="formErrors.phone" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.phone?.[0]"></p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="Enter email"
                                :class="formErrors.email ? 'border-red-500' : 'border-gray-300'"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-black transition-colors"
                            >
                            <p x-show="formErrors.email" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.email?.[0]"></p>
                        </div>

                        {{-- Construction Type --}}
                        <div>
                            <label for="type" class="block text-sm font-medium mb-2">
                                What kind of construction are you looking for ?
                            </label>
                            <select 
                                name="type" 
                                id="type"
                                required
                                :class="formErrors.type ? 'border-red-500' : 'border-gray-300'"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-black transition-colors bg-white"
                            >
                                <option value="">Select construction type</option>
                                <option value="residential">Residential</option>
                                <option value="commercial">Commercial</option>
                            </select>
                            <p x-show="formErrors.type" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.type?.[0]"></p>
                        </div>

                        {{-- Plot Size --}}
                        <div>
                            <input 
                                type="text" 
                                name="plotsize" 
                                placeholder="Plot size ?" 
                                required
                                :class="formErrors.plotsize ? 'border-red-500' : 'border-gray-300'"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-black transition-colors"
                            >
                            <p x-show="formErrors.plotsize" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.plotsize?.[0]"></p>
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-4">
                            <button 
                                type="submit" 
                                :disabled="formSubmitting"
                                class="w-full px-8 py-3 bg-black text-white text-sm uppercase tracking-wide hover:bg-gray-800 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <span x-show="!formSubmitting">Submit</span>
                                <span x-show="formSubmitting">Submitting...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts>
