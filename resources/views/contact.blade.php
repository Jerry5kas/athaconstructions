<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        pageTitle="Contact Atha Construction"
        contentTitle="Let's Build Something Together"
        description="Reach out to discuss your dream home, renovation, or a simple question—our team is here to guide you at every step."
        backgroundImage="images/contact-us.jpg"
        alt="Best Construction Companies in Bangalore"
        title="Best Construction Companies in Bangalore"
    />

    {{-- Contact Information Section with Map --}}
    <section class="contact-info-section py-12 lg:py-16 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-7xl mx-auto">
                {{-- Section Header --}}
                <div class="text-center mb-8 lg:mb-12">
                    <h2 class="font-tenor text-3xl lg:text-4xl uppercase mb-3">Get In Touch</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        We're here to help you bring your construction dreams to life. Reach out through any of these channels.
                    </p>
                </div>

                <div 
                    x-data="{
                        selectedLocation: 'bangalore',
                        locations: {
                            bangalore: {
                                name: 'Bangalore',
                                address: 'No.81/37, Ground Floor, The Hulkul, Lavelle Road, Bengaluru - 560001',
                                mapUrl: 'https://maps.app.goo.gl/G8Ezuo2a8pbknSkk8',
                                query: 'The+Hulkul,+Lavelle+Road,+Bengaluru+560001'
                            },
                            ballari: {
                                name: 'Ballari',
                                address: 'First Floor, PVR Plaza, No 7, 3rd Cross Rd, Nehru Colony, Sidiginamola, Ballari, Karnataka 583103',
                                mapUrl: 'https://maps.app.goo.gl/MdQ2gi2iPGKXQNn28',
                                query: 'PVR+Plaza,+Ballari,+Karnataka+583103'
                            },
                            mysore: {
                                name: 'Mysore',
                                address: 'VIJAY ARCADE, # 1714 Sarvodaya Road E&F Block Ramkrishna Nagar (Kuvempu Nagar), Mysore 570009',
                                mapUrl: '#',
                                query: 'VIJAY+ARCADE,+Sarvodaya+Road,+Mysore+570009'
                            }
                        },
                        get currentLocation() {
                            return this.locations[this.selectedLocation];
                        },
                        get mapSrc() {
                            const loc = this.currentLocation;
                            // Use place search in embed URL (works without API key)
                            const query = loc.query.replace(/\+/g, ' ');
                            return `https://www.google.com/maps?q=${encodeURIComponent(query)}&output=embed&zoom=15`;
                        },
                        selectLocation(location) {
                            this.selectedLocation = location;
                        }
                    }"
                    class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                    
                    {{-- Left: Contact Poster Image with Overlay --}}
                    <div class="lg:col-span-5 relative h-[500px] lg:h-auto">
                        {{-- Background Image --}}
                        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/Contact us poster.png') }}');"></div>
                        {{-- Black Overlay --}}
                        <div class="absolute inset-0 bg-black/50"></div>
                        {{-- Phone & Email Content --}}
                        <div class="relative z-10 h-full flex flex-col justify-end items-center p-6 lg:p-8 pb-8 lg:pb-12">
                            {{-- Elegant Container --}}
                            <div class="bg-black/30 backdrop-blur-sm p-6 lg:p-8 w-full max-w-sm text-white border border-white/20">
                                {{-- Phone --}}
                                <div class="mb-6 text-center">
                                    <div class="flex items-center justify-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm flex items-center justify-center flex-shrink-0 border border-white/30">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="font-tenor text-lg lg:text-xl uppercase text-white">Phone</h3>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="tel:+918049776616" class="block text-white text-sm lg:text-base hover:text-white/80 transition-colors">
                                            +91 8049776616
                                        </a>
                                        <a href="tel:+919606956044" class="block text-white text-sm lg:text-base hover:text-white/80 transition-colors">
                                            +91 9606956044
                                        </a>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="text-center">
                                    <div class="flex items-center justify-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm flex items-center justify-center flex-shrink-0 border border-white/30">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="font-tenor text-lg lg:text-xl uppercase text-white">Email</h3>
                                    </div>
                                    <div>
                                        <a href="mailto:info@athaconstruction.in" class="block text-white text-sm lg:text-base hover:text-white/80 transition-colors">
                                            info@athaconstruction.in
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Map with Location Switcher --}}
                    <div class="lg:col-span-7">
                        <div class="bg-gray-50 p-6 lg:p-8">
                            {{-- Location Selector --}}
                            <div class="flex flex-wrap items-center gap-2 mb-6">
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Select Location:</span>
                                <button
                                    @click="selectLocation('bangalore')"
                                    :class="selectedLocation === 'bangalore' ? 'bg-black text-white' : 'bg-white border border-gray-300 text-gray-700 hover:border-black'"
                                    class="px-4 py-2 text-xs font-semibold uppercase tracking-wide transition-colors">
                                    Bangalore
                                </button>
                                <button
                                    @click="selectLocation('ballari')"
                                    :class="selectedLocation === 'ballari' ? 'bg-black text-white' : 'bg-white border border-gray-300 text-gray-700 hover:border-black'"
                                    class="px-4 py-2 text-xs font-semibold uppercase tracking-wide transition-colors">
                                    Ballari
                                </button>
                                <button
                                    @click="selectLocation('mysore')"
                                    :class="selectedLocation === 'mysore' ? 'bg-black text-white' : 'bg-white border border-gray-300 text-gray-700 hover:border-black'"
                                    class="px-4 py-2 text-xs font-semibold uppercase tracking-wide transition-colors">
                                    Mysore
                                </button>
                            </div>

                            {{-- Selected Location Address --}}
                            <div class="mb-6">
                                <div class="flex items-start gap-2 mb-2">
                                    <svg class="w-4 h-4 text-gray-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900 mb-1" x-text="currentLocation.name"></p>
                                        <p class="text-sm text-gray-600 leading-relaxed" x-text="currentLocation.address"></p>
                                        <a 
                                            :href="currentLocation.mapUrl" 
                                            target="_blank"
                                            class="inline-flex items-center gap-1 mt-2 text-xs text-gray-900 hover:text-black transition-colors font-medium">
                                            <span>Open in Google Maps</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Map Container --}}
                            <div class="w-full h-96 lg:h-[500px] bg-gray-200 overflow-hidden">
                                <iframe
                                    :src="mapSrc"
                                    width="100%"
                                    height="100%"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="w-full h-full">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Form Section --}}
    <section class="contact-form-section py-16 lg:py-24 bg-gray-50" 
             x-data="{ 
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
            }"
             x-intersect="visible = true">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                    {{-- Left: Form --}}
                    <div class="lg:col-span-7">
                        <div class="contact-form-wrapper">
                            <div class="contact-form-header mb-8">
                                <h2 class="font-tenor text-3xl lg:text-4xl uppercase mb-3">Send Us a Message</h2>
                                <p class="text-gray-600">
                                    Fill out the form below and we'll get back to you as soon as possible.
                                </p>
                            </div>

                            {{-- Success/Error Messages --}}
                            <div 
                                x-show="formMessage === 'success'"
                                x-cloak
                                x-transition
                                class="contact-form-message contact-form-message-success mb-6"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Thank you! We will contact you soon.</span>
                            </div>
                            <div 
                                x-show="formMessage === 'error'"
                                x-cloak
                                x-transition
                                class="contact-form-message contact-form-message-error mb-6"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span>Something went wrong. Please check your inputs and try again.</span>
                            </div>

                            <form 
                                @submit.prevent="submitForm($event)"
                                class="contact-form"
                            >
                                {{-- Name and Phone Row --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="contact-form-group">
                                        <label class="contact-form-label">Your Name</label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            placeholder="Enter your name" 
                                            required
                                            :class="formErrors.name ? 'contact-form-input-error' : ''"
                                            class="contact-form-input"
                                        >
                                        <p x-show="formErrors.name" x-cloak class="contact-form-error" x-text="formErrors.name?.[0]"></p>
                                    </div>
                                    <div class="contact-form-group">
                                        <label class="contact-form-label">Phone Number</label>
                                        <input 
                                            type="tel" 
                                            name="phone" 
                                            placeholder="Enter phone number" 
                                            required
                                            maxlength="10"
                                            pattern="[0-9]{10}"
                                            :class="formErrors.phone ? 'contact-form-input-error' : ''"
                                            class="contact-form-input"
                                        >
                                        <p x-show="formErrors.phone" x-cloak class="contact-form-error" x-text="formErrors.phone?.[0]"></p>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="contact-form-group">
                                    <label class="contact-form-label">Email Address</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        placeholder="Enter your email"
                                        :class="formErrors.email ? 'contact-form-input-error' : ''"
                                        class="contact-form-input"
                                    >
                                    <p x-show="formErrors.email" x-cloak class="contact-form-error" x-text="formErrors.email?.[0]"></p>
                                </div>

                                {{-- Construction Type --}}
                                <div class="contact-form-group">
                                    <label class="contact-form-label">What kind of construction are you looking for?</label>
                                    <div class="contact-form-select-wrapper">
                                        <select 
                                            name="type" 
                                            id="type"
                                            required
                                            :class="formErrors.type ? 'contact-form-input-error' : ''"
                                            class="contact-form-select"
                                        >
                                            <option value="">Select construction type</option>
                                            <option value="residential">Residential</option>
                                            <option value="commercial">Commercial</option>
                                        </select>
                                        <svg class="contact-form-select-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                    <p x-show="formErrors.type" x-cloak class="contact-form-error" x-text="formErrors.type?.[0]"></p>
                                </div>

                                {{-- Plot Size --}}
                                <div class="contact-form-group">
                                    <label class="contact-form-label">Plot Size</label>
                                    <input 
                                        type="text" 
                                        name="plotsize" 
                                        placeholder="Enter plot size (e.g., 1200 sq.ft)" 
                                        required
                                        :class="formErrors.plotsize ? 'contact-form-input-error' : ''"
                                        class="contact-form-input"
                                    >
                                    <p x-show="formErrors.plotsize" x-cloak class="contact-form-error" x-text="formErrors.plotsize?.[0]"></p>
                                </div>

                                {{-- Message --}}
                                <div class="contact-form-group">
                                    <label class="contact-form-label">Message (Optional)</label>
                                    <textarea 
                                        name="message" 
                                        rows="4"
                                        placeholder="Tell us about your project requirements..."
                                        :class="formErrors.message ? 'contact-form-input-error' : ''"
                                        class="contact-form-input contact-form-textarea"
                                    ></textarea>
                                    <p x-show="formErrors.message" x-cloak class="contact-form-error" x-text="formErrors.message?.[0]"></p>
                                </div>

                                {{-- Submit Button --}}
                                <div class="contact-form-submit">
                                    <button 
                                        type="submit" 
                                        :disabled="formSubmitting"
                                        class="contact-form-button"
                                    >
                                        <span x-show="!formSubmitting">Send Message</span>
                                        <span x-show="formSubmitting" class="flex items-center gap-2">
                                            <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Sending...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Right: Additional Info --}}
                    <div class="lg:col-span-5">
                        <div class="contact-sidebar">
                            <div class="contact-sidebar-card">
                                <div class="contact-sidebar-icon">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="contact-sidebar-title">Response Time</h3>
                                <p class="contact-sidebar-text">
                                    We typically respond within 24 hours during business days.
                                </p>
                            </div>

                            <div class="contact-sidebar-card">
                                <div class="contact-sidebar-icon">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <h3 class="contact-sidebar-title">Free Consultation</h3>
                                <p class="contact-sidebar-text">
                                    Get expert advice on your construction project at no cost.
                                </p>
                            </div>

                            <div class="contact-sidebar-card">
                                <div class="contact-sidebar-icon">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="contact-sidebar-title">Expert Team</h3>
                                <p class="contact-sidebar-text">
                                    Our experienced professionals are ready to assist you.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @once
    <style>
        /* Contact Info Section */
        .contact-info-section {
            position: relative;
        }

        .contact-info-card {
            background: white;
            padding: 2rem;
            transition: all 0.3s ease;
            text-align: center;
        }

        .contact-info-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .contact-info-card-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            transition: all 0.3s ease;
        }

        .contact-info-card-icon-phone {
            background: #000000;
            color: white;
        }

        .contact-info-card-icon-email {
            background: #000000;
            color: white;
        }

        .contact-info-card-icon-location {
            background: #000000;
            color: white;
        }

        .contact-info-card:hover .contact-info-card-icon {
            transform: scale(1.05);
        }

        .contact-info-card-title {
            font-family: 'Tenor Sans', serif;
            font-size: 1.25rem;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .contact-info-card-content {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .contact-info-link {
            color: #4b5563;
            text-decoration: none;
            font-size: 0.9375rem;
            transition: color 0.3s ease;
            display: block;
        }

        .contact-info-link:hover {
            color: #1a1a1a;
        }

        .contact-info-text {
            color: #4b5563;
            font-size: 0.9375rem;
            line-height: 1.6;
        }

        /* Contact Form Section */
        .contact-form-section {
            position: relative;
        }

        .contact-form-wrapper {
            background: white;
            padding: 2.5rem;
        }

        .contact-form-header h2 {
            color: #1a1a1a;
            letter-spacing: 0.03em;
        }

        .contact-form-message {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
        }

        .contact-form-message-success {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .contact-form-message-error {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .contact-form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .contact-form-label {
            font-size: 0.8125rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #374151;
        }

        .contact-form-input {
            width: 100%;
            padding: 0.875rem 0;
            background: transparent;
            border: none;
            border-bottom: 2px solid #e5e7eb;
            color: #1a1a1a;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .contact-form-input::placeholder {
            color: #9ca3af;
        }

        .contact-form-input:focus {
            border-bottom-color: #1a1a1a;
        }

        .contact-form-input-error {
            border-bottom-color: #dc2626;
        }

        .contact-form-textarea {
            resize: vertical;
            min-height: 100px;
            border: 2px solid #e5e7eb;
            padding: 0.875rem;
            background: #f9fafb;
            transition: all 0.3s ease;
        }

        .contact-form-textarea:focus {
            border-color: #1a1a1a;
            background: white;
        }

        .contact-form-textarea.contact-form-input-error {
            border-color: #dc2626;
        }

        .contact-form-select-wrapper {
            position: relative;
        }

        .contact-form-select {
            width: 100%;
            padding: 0.875rem 2.5rem 0.875rem 0;
            background: transparent;
            border: none;
            border-bottom: 2px solid #e5e7eb;
            color: #1a1a1a;
            font-size: 0.9375rem;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
            transition: all 0.3s ease;
            outline: none;
        }

        .contact-form-select:focus {
            border-bottom-color: #1a1a1a;
        }

        .contact-form-select-error {
            border-bottom-color: #dc2626;
        }

        .contact-form-select-arrow {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #6b7280;
            pointer-events: none;
            transition: transform 0.3s ease;
        }

        .contact-form-select:focus + .contact-form-select-arrow,
        .contact-form-select-wrapper:hover .contact-form-select-arrow {
            transform: translateY(-50%) rotate(180deg);
        }

        .contact-form-error {
            color: #dc2626;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .contact-form-submit {
            margin-top: 0.5rem;
        }

        .contact-form-button {
            width: 100%;
            padding: 1rem 2rem;
            background: #1a1a1a;
            color: white;
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.875rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .contact-form-button:hover:not(:disabled) {
            background: #000000;
        }

        .contact-form-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Contact Sidebar */
        .contact-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            position: sticky;
            top: 6rem;
        }

        .contact-sidebar-card {
            background: white;
            padding: 1.75rem;
            transition: all 0.3s ease;
        }

        .contact-sidebar-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .contact-sidebar-icon {
            width: 48px;
            height: 48px;
            background: #000000;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .contact-sidebar-title {
            font-family: 'Tenor Sans', serif;
            font-size: 1.125rem;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .contact-sidebar-text {
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.6;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        /* Responsive */
        @media (max-width: 1023px) {
            .contact-sidebar {
                position: static;
                margin-top: 2rem;
            }

            .contact-form-wrapper {
                padding: 2rem;
            }
        }

        @media (max-width: 639px) {
            .contact-info-card {
                padding: 1.5rem;
            }

            .contact-form-wrapper {
                padding: 1.5rem;
            }

            .contact-sidebar-card {
                padding: 1.5rem;
            }
        }
    </style>
    @endonce
</x-layouts>
