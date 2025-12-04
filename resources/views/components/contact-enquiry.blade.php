@props([
    'variant' => 'default', // 'default', 'modal', 'inline', 'hero'
    'showFields' => ['name', 'phone', 'email', 'type', 'plotsize', 'message'], // Fields to display
    'submitText' => 'Submit Enquiry',
    'messageSource' => null, // Custom message source (e.g., 'Quick enquiry from hero form')
    'onSuccess' => null, // Custom success callback (e.g., 'enquiryModalOpen = false')
    'image' => 'images/Contact us poster.png', // Background image for left side
    'showImage' => true, // Show image layout (left image, right form)
])

@php
    $formId = 'contact-enquiry-' . uniqid();
    $countries = [
        ['code' => '+91', 'name' => 'India', 'flag' => '🇮🇳'],
        ['code' => '+1', 'name' => 'USA', 'flag' => '🇺🇸'],
        ['code' => '+44', 'name' => 'UK', 'flag' => '🇬🇧'],
        ['code' => '+971', 'name' => 'UAE', 'flag' => '🇦🇪'],
        ['code' => '+65', 'name' => 'Singapore', 'flag' => '🇸🇬'],
    ];
@endphp

<div 
    x-data="{
        formSubmitting: false,
        formMessage: '',
        formErrors: {},
        selectedCountry: '+91',
        phoneCountryOpen: false,
        submitForm(event) {
            this.formSubmitting = true;
            this.formMessage = '';
            this.formErrors = {};
            
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData);
            // Combine country code with phone
            if (data.phone) {
                data.phone = this.selectedCountry + data.phone;
            }
            
            fetch('{{ route('contact.submit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                if (data.errors) {
                    this.formErrors = data.errors;
                    this.formMessage = 'error';
                } else if (data.status === 'OK' || data.message) {
                    this.formMessage = 'success';
                    event.target.reset();
                    this.formErrors = {};
                    this.selectedCountry = '+91';
                    
                    // Dispatch success event for parent components
                    this.$dispatch('enquiry-success');
                    
                    @if($onSuccess)
                    setTimeout(() => {
                        {!! $onSuccess !!}
                    }, 2000);
                    @endif
                    
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
    class="contact-enquiry-form w-full max-w-7xl mx-auto"
>
    <div class="grid grid-cols-1 lg:grid-cols-12 overflow-hidden contact-enquiry-grid">
        {{-- Left Side: Image with Logo --}}
        @if($showImage)
        <div class="relative hidden lg:block overflow-hidden lg:col-span-5">
            <img 
                src="{{ asset($image) }}" 
                alt="Contact Us"
                class="w-full h-[600px] object-cover"
            >
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-8">
                <img 
                    src="{{ asset('images/Atha Logo - High Quality-White.png') }}" 
                    alt="ATHA Construction"
                    class="h-20 w-auto mb-4"
                >
                <p class="text-white text-sm uppercase tracking-wider font-medium">
                    Building Trust, Creating Value
                </p>
            </div>
        </div>
        @endif

        {{-- Right Side: Form --}}
        <div class="bg-white p-6 lg:p-8 flex flex-col overflow-y-auto lg:col-span-7 contact-enquiry-panel">
            <div class="w-full">
                <form 
                    @submit.prevent="submitForm($event)"
                    id="{{ $formId }}"
                    class="space-y-3 lg:space-y-4"
                >
                    {{-- Success/Error Messages --}}
                    <div 
                        x-show="formMessage === 'success'"
                        x-cloak
                        x-transition
                        class="p-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded"
                    >
                        Thank you! We will contact you soon.
                    </div>
                    <div 
                        x-show="formMessage === 'error'"
                        x-cloak
                        x-transition
                        class="p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded"
                    >
                        <span x-show="Object.keys(formErrors).length === 0">Something went wrong. Please try again.</span>
                        <template x-for="(error, field) in formErrors" :key="field">
                            <div x-text="error[0]"></div>
                        </template>
                    </div>

                    {{-- Form Heading --}}
                   
                    {{-- Name Field --}}
                    @if(in_array('name', $showFields))
                    <div class="coolinput">
                        <label for="{{ $formId }}-name" class="text" :class="formErrors.name ? 'text-red-500' : ''">
                            Your Name *
                        </label>
                        <input
                            type="text"
                            id="{{ $formId }}-name"
                            name="name"
                            required
                            :class="formErrors.name ? 'border-red-500' : 'border-black'"
                            class="input"
                            placeholder="Enter your full name"
                        >
                        <p x-show="formErrors.name" x-cloak class="text-red-500 text-xs mt-1 ml-2" x-text="formErrors.name?.[0]"></p>
                    </div>
                    @endif

                    {{-- Phone Field with Country Code --}}
                    @if(in_array('phone', $showFields))
                    <div>
                        <div class="flex gap-2 items-end">
                            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                                <button
                                    type="button"
                                    @click="open = !open; phoneCountryOpen = !phoneCountryOpen"
                                    class="px-3 py-2.5 border-2 border-black rounded-md bg-gray-100 text-sm font-medium flex items-center gap-2 min-w-[80px] h-[43px]"
                                    :class="formErrors.phone ? 'border-red-500' : ''"
                                >
                                    <span x-text="selectedCountry"></span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div 
                                    x-show="open"
                                    x-cloak
                                    x-transition
                                    class="absolute top-full left-0 mt-1 bg-white border-2 border-black rounded-md shadow-lg z-10 max-h-48 overflow-y-auto min-w-[120px]"
                                >
                                    @foreach($countries as $country)
                                    <button
                                        type="button"
                                        @click="selectedCountry = '{{ $country['code'] }}'; open = false; phoneCountryOpen = false"
                                        class="w-full px-3 py-2 text-left hover:bg-gray-100 flex items-center gap-2 text-sm"
                                        :class="selectedCountry === '{{ $country['code'] }}' ? 'bg-gray-100' : ''"
                                    >
                                        <span>{{ $country['flag'] }}</span>
                                        <span>{{ $country['code'] }}</span>
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                            <div class="coolinput flex-1">
                                <label for="{{ $formId }}-phone" class="text" :class="formErrors.phone ? 'text-red-500' : ''">
                                    Phone Number *
                                </label>
                                <input
                                    type="tel"
                                    id="{{ $formId }}-phone"
                                    name="phone"
                                    required
                                    :class="formErrors.phone ? 'border-red-500' : 'border-black'"
                                    class="input"
                                    placeholder="Enter phone number"
                                >
                            </div>
                        </div>
                        <p x-show="formErrors.phone" x-cloak class="text-red-500 text-xs mt-1 ml-2" x-text="formErrors.phone?.[0]"></p>
                    </div>
                    @endif

                    {{-- Email Field --}}
                    @if(in_array('email', $showFields))
                    <div class="coolinput">
                        <label for="{{ $formId }}-email" class="text" :class="formErrors.email ? 'text-red-500' : ''">
                            Email Address
                        </label>
                        <input
                            type="email"
                            id="{{ $formId }}-email"
                            name="email"
                            :class="formErrors.email ? 'border-red-500' : 'border-black'"
                            class="input"
                            placeholder="Enter your email address"
                        >
                        <p x-show="formErrors.email" x-cloak class="text-red-500 text-xs mt-1 ml-2" x-text="formErrors.email?.[0]"></p>
                    </div>
                    @endif

                    {{-- Construction Type Field --}}
                    @if(in_array('type', $showFields))
                    <div class="coolinput">
                        <label for="{{ $formId }}-type" class="text" :class="formErrors.type ? 'text-red-500' : ''">
                            Construction Type
                        </label>
                        <select
                            id="{{ $formId }}-type"
                            name="type"
                            :class="formErrors.type ? 'border-red-500' : 'border-black'"
                            class="input"
                        >
                            <option value="">Select construction type</option>
                            <option value="residential">Residential</option>
                            <option value="commercial">Commercial</option>
                        </select>
                        <p x-show="formErrors.type" x-cloak class="text-red-500 text-xs mt-1 ml-2" x-text="formErrors.type?.[0]"></p>
                    </div>
                    @endif

                    {{-- Plot Size Field --}}
                    @if(in_array('plotsize', $showFields))
                    <div class="coolinput">
                        <label for="{{ $formId }}-plotsize" class="text" :class="formErrors.plotsize ? 'text-red-500' : ''">
                            Plot Size (Sq.Ft)
                        </label>
                        <input
                            type="text"
                            id="{{ $formId }}-plotsize"
                            name="plotsize"
                            :class="formErrors.plotsize ? 'border-red-500' : 'border-black'"
                            class="input"
                            placeholder="Enter plot size"
                        >
                        <p x-show="formErrors.plotsize" x-cloak class="text-red-500 text-xs mt-1 ml-2" x-text="formErrors.plotsize?.[0]"></p>
                    </div>
                    @endif

                    {{-- Message Field --}}
                    @if(in_array('message', $showFields))
                    <div class="coolinput">
                        <label for="{{ $formId }}-message" class="text" :class="formErrors.message ? 'text-red-500' : ''">
                            Message
                        </label>
                        <textarea
                            id="{{ $formId }}-message"
                            name="message"
                            rows="2"
                            :class="formErrors.message ? 'border-red-500' : 'border-black'"
                            class="input resize-none"
                            placeholder="Tell us about your project requirements..."
                        >@if($messageSource){{ $messageSource }}@endif</textarea>
                        <p x-show="formErrors.message" x-cloak class="text-red-500 text-xs mt-1 ml-2" x-text="formErrors.message?.[0]"></p>
                    </div>
                    @else
                        <input type="hidden" name="message" value="{{ $messageSource ?? 'Contact enquiry form' }}">
                    @endif

                    {{-- Submit Button --}}
                    <div class="pt-2">
                        <button
                            type="submit"
                            :disabled="formSubmitting"
                            class="w-full px-8 py-3 bg-black text-white text-sm uppercase tracking-wide hover:bg-gray-800 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed rounded-md"
                        >
                            <span x-show="!formSubmitting">{{ $submitText }}</span>
                            <span x-show="formSubmitting">Submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@once
<style>
    [x-cloak] { display: none !important; }

    .contact-enquiry-form {
        position: relative;
    }

    .contact-enquiry-grid {
        background:
            radial-gradient(circle at 0% 0%, rgba(0,0,0,0.04), transparent 55%),
            radial-gradient(circle at 100% 100%, rgba(0,0,0,0.04), transparent 55%),
            #f7f7f7;
        border-radius: 18px;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 20px 60px rgba(0,0,0,0.18);
        overflow: hidden;
    }

    .contact-enquiry-panel {
        position: relative;
        background:
            radial-gradient(circle at 0% 0%, rgba(0,0,0,0.03), transparent 55%),
            radial-gradient(circle at 100% 100%, rgba(0,0,0,0.03), transparent 55%),
            #ffffff;
    }

    .contact-enquiry-panel::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 14px 0 0 14px;
        border-left: 3px solid #000;
        opacity: 0.08;
        pointer-events: none;
    }

    .contact-enquiry-panel > .w-full {
        position: relative;
        z-index: 1;
    }

    .coolinput {
        display: flex;
        flex-direction: column;
        width: 100%;
        position: relative;
    }

    .coolinput label.text {
        font-size: 0.75rem;
        color: #555555;
        font-weight: 500;
        position: relative;
        top: 0.5rem;
        margin: 0 0 0 7px;
        padding: 0 3px;
        background: #f8f9fa;
        width: fit-content;
        z-index: 1;
    }

    .coolinput input.input,
    .coolinput select.input,
    .coolinput textarea.input {
        padding: 11px 10px;
        font-size: 0.75rem;
        border: 2px #000000 solid;
        border-radius: 5px;
        background: #f8f9fa;
        width: 100%;
        font-family: inherit;
    }

    .coolinput input.input:focus,
    .coolinput select.input:focus,
    .coolinput textarea.input:focus {
        outline: none;
        background: #fff;
    }

    .coolinput input.input.border-red-500,
    .coolinput select.input.border-red-500,
    .coolinput textarea.input.border-red-500 {
        border-color: #ef4444;
    }

    .coolinput label.text.text-red-500 {
        color: #ef4444;
    }
</style>
@endonce
