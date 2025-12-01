<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        pageTitle="Contact Atha Construction"
        contentTitle="Let’s Build Something Together"
        description="Reach out to discuss your dream home, renovation, or a simple question—our team is here to guide you at every step."
        backgroundImage="images/contact-us.jpg"
        alt="Best Construction Companies in Bangalore"
        title="Best Construction Companies in Bangalore"
    />

    {{-- Contact Form Section --}}
    <section class="py-12 lg:py-16 bg-black text-white text-center" id="next-section" x-data="{ 
        formSubmitting: false, 
        formMessage: '',
        formErrors: {},
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
                        this.formMessage = '';
                    }, 5000);
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
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-8">
                Contact Us
            </h2>

            {{-- Success/Error Messages --}}
            <div 
                x-show="formMessage === 'success'"
                x-cloak
                x-transition
                class="mb-6 p-4 bg-green-600/20 border border-green-500 text-green-300 text-sm rounded max-w-2xl mx-auto"
            >
                Thank you! We will contact you soon.
            </div>
            <div 
                x-show="formMessage === 'error'"
                x-cloak
                x-transition
                class="mb-6 p-4 bg-red-600/20 border border-red-500 text-red-300 text-sm rounded max-w-2xl mx-auto"
            >
                Something went wrong. Please check your inputs and try again.
            </div>

            <div class="max-w-2xl mx-auto pt-4">
                <form 
                    @submit.prevent="submitForm($event)"
                    class="space-y-4"
                >
                    {{-- Name and Phone Row --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <input 
                                type="text" 
                                name="name" 
                                placeholder="Enter Your Name" 
                                required
                                :class="formErrors.name ? 'border-red-500' : 'border-white/20'"
                                class="w-full px-0 py-3 bg-transparent border-b text-white placeholder-white/60 focus:outline-none focus:border-white transition-colors"
                            >
                            <p x-show="formErrors.name" x-cloak class="text-red-400 text-xs mt-1 text-left" x-text="formErrors.name?.[0]"></p>
                        </div>
                        <div>
                            <input 
                                type="tel" 
                                name="phone" 
                                placeholder="Phone No." 
                                required
                                maxlength="10"
                                pattern="[0-9]{10}"
                                :class="formErrors.phone ? 'border-red-500' : 'border-white/20'"
                                class="w-full px-0 py-3 bg-transparent border-b text-white placeholder-white/60 focus:outline-none focus:border-white transition-colors"
                            >
                            <p x-show="formErrors.phone" x-cloak class="text-red-400 text-xs mt-1 text-left" x-text="formErrors.phone?.[0]"></p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="Enter email"
                            :class="formErrors.email ? 'border-red-500' : 'border-white/20'"
                            class="w-full px-0 py-3 bg-transparent border-b text-white placeholder-white/60 focus:outline-none focus:border-white transition-colors"
                        >
                        <p x-show="formErrors.email" x-cloak class="text-red-400 text-xs mt-1 text-left" x-text="formErrors.email?.[0]"></p>
                    </div>

                    {{-- Construction Type --}}
                    <div class="pt-3 text-left">
                        <label for="type" class="block text-sm uppercase tracking-wider mb-2">
                            What kind of construction are you looking for ?
                        </label>
                        <select 
                            name="type" 
                            id="type"
                            required
                            :class="formErrors.type ? 'border-red-500' : 'border-white/20'"
                            class="w-full px-0 py-2 bg-transparent border-b text-white focus:outline-none focus:border-white transition-colors"
                        >
                            <option value="" class="text-gray-900">Select construction type</option>
                            <option value="residential" class="text-gray-900">Residential</option>
                            <option value="commercial" class="text-gray-900">Commercial</option>
                        </select>
                        <p x-show="formErrors.type" x-cloak class="text-red-400 text-xs mt-1" x-text="formErrors.type?.[0]"></p>
                    </div>

                    {{-- Plot Size --}}
                    <div>
                        <input 
                            type="text" 
                            name="plotsize" 
                            placeholder="Plot size ?" 
                            required
                            :class="formErrors.plotsize ? 'border-red-500' : 'border-white/20'"
                            class="w-full px-0 py-3 bg-transparent border-b text-white placeholder-white/60 focus:outline-none focus:border-white transition-colors"
                        >
                        <p x-show="formErrors.plotsize" x-cloak class="text-red-400 text-xs mt-1 text-left" x-text="formErrors.plotsize?.[0]"></p>
                    </div>

                    {{-- Submit Button --}}
                    <div>
                        <button 
                            type="submit" 
                            :disabled="formSubmitting"
                            class="px-8 py-3 bg-white text-black font-semibold uppercase tracking-wide hover:bg-gray-200 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span x-show="!formSubmitting">Submit</span>
                            <span x-show="formSubmitting">Submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layouts>
