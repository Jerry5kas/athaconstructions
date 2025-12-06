@props([
    'title' => 'WORK WITH US',
    'description' => 'Our goal is to offer an unparalleled level of service to our highly respected clients. Whether you are looking to buy or sell your home, we guarantee that our expertise, professionalism and dedication will guide you toward meeting your unique real estate needs.',
    'buttonText' => 'CONTACT US',
    'backgroundImage' => 'images/Careers.png',
    'backgroundImageAlt' => 'Work with us',
    'backgroundImageTitle' => 'Work with us',
])

<section class="work-with-us-section relative min-h-[400px] lg:min-h-[500px] flex items-center overflow-hidden"
         x-data="{ enquiryModalOpen: false, visible: false }"
         x-intersect="visible = true"
         @enquiry-success.window="setTimeout(() => enquiryModalOpen = false, 2000)">
    
    {{-- Background Image --}}
    <img
        src="{{ asset($backgroundImage) }}"
        alt="{{ $backgroundImageAlt }}"
        title="{{ $backgroundImageTitle }}"
        class="absolute inset-0 w-full h-full object-cover work-with-us-bg-image"
    >
    
    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 work-with-us-overlay"></div>
    
    {{-- Animated Background Pattern --}}
    <div class="absolute inset-0 work-with-us-pattern"></div>
    
    {{-- Content Container --}}
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="work-with-us-panel max-w-4xl mx-auto text-center">
            {{-- Decorative Top Element --}}
            <div class="work-with-us-top-decoration opacity-0" 
                 :class="{ 'animate-fade-in-down': visible }" 
                 style="animation-delay: 0.2s;">
                <div class="work-with-us-decoration-line"></div>
            </div>

            {{-- Title --}}
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-4 text-white work-with-us-title opacity-0"
                :class="{ 'animate-fade-in-up': visible }" 
                style="animation-delay: 0.3s;">
                {{ $title }}
            </h2>

            {{-- Description --}}
            <p class="text-xs lg:text-sm max-w-2xl mx-auto mb-8 text-white/85 leading-relaxed work-with-us-description opacity-0"
               :class="{ 'animate-fade-in-up': visible }" 
               style="animation-delay: 0.4s;">
                {{ $description }}
            </p>

            {{-- Button --}}
            <div class="work-with-us-button-wrapper opacity-0"
                 :class="{ 'animate-fade-in-up': visible }" 
                 style="animation-delay: 0.5s;">
                <button
                    @click="enquiryModalOpen = true"
                    class="work-with-us-button group"
                >
                    <span class="work-with-us-button-text">{{ $buttonText }}</span>
                    <svg class="work-with-us-button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>

            {{-- Decorative Bottom Elements --}}
            <div class="work-with-us-bottom-decoration opacity-0 mt-8"
                 :class="{ 'animate-fade-in-up': visible }" 
                 style="animation-delay: 0.6s;">
                <div class="work-with-us-decoration-dot"></div>
                <div class="work-with-us-decoration-dot"></div>
                <div class="work-with-us-decoration-dot"></div>
            </div>
        </div>
    </div>

    {{-- Enquiry Form Modal --}}
    <div
        x-show="enquiryModalOpen"
        x-cloak
        @click.self="enquiryModalOpen = false"
        @keydown.escape.window="enquiryModalOpen = false"
        class="fixed inset-0 z-[150] flex items-center justify-center p-1 bg-black/80 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
             <div
                 @click.stop
                 class="enquiry-modal bg-white rounded-lg shadow-2xl w-full max-w-5xl overflow-y-visible"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
        >
           
            {{-- Modal Body - Form --}}
            <div class="p-1">
                <x-contact-enquiry
                    variant="modal"
                    :onSuccess="'enquiryModalOpen = false; setTimeout(() => enquiryModalOpen = false, 2000);'"
                />
            </div>
        </div>
    </div>
</section>

@once
<style>
    /* Work With Us Section Styles */
    .work-with-us-section {
        position: relative;
    }

    /* Background Image */
    .work-with-us-bg-image {
        transition: transform 0.8s ease;
    }

    .work-with-us-section:hover .work-with-us-bg-image {
        transform: scale(1.05);
    }

    /* Gradient Overlay */
    .work-with-us-overlay {
        background: linear-gradient(
            135deg,
            rgba(0, 0, 0, 0.45) 0%,
            rgba(0, 0, 0, 0.28) 40%,
            rgba(0, 0, 0, 0.6) 100%
        );
    }

    /* Animated Pattern */
    .work-with-us-pattern {
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        background-size: 300px 300px;
        animation: patternFloat 15s ease-in-out infinite;
        opacity: 0.6;
    }

    @keyframes patternFloat {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(30px, 30px); }
    }

    /* Top Decoration */
    .work-with-us-top-decoration {
        margin-bottom: 1.5rem;
    }

    .work-with-us-decoration-line {
        width: 60px;
        height: 1.5px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
        margin: 0 auto;
    }

    /* Title */
    .work-with-us-title {
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        letter-spacing: 0.05em;
    }

    /* Description */
    .work-with-us-description {
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    /* Button Wrapper */
    .work-with-us-button-wrapper {
        display: inline-block;
    }

    /* Button */
    .work-with-us-button {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 2rem;
        background: transparent;
        border: 1.5px solid white;
        color: white;
        font-size: 0.8125rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 2px;
    }

    .work-with-us-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: white;
        transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 0;
    }

    .work-with-us-button:hover::before {
        left: 0;
    }

    .work-with-us-button-text {
        position: relative;
        z-index: 1;
        transition: color 0.4s ease;
    }

    .work-with-us-button-icon {
        width: 1.125rem;
        height: 1.125rem;
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .work-with-us-button:hover {
        border-color: white;
        box-shadow: 0 8px 30px rgba(255, 255, 255, 0.15);
        transform: translateY(-1px);
    }

    .work-with-us-button:hover .work-with-us-button-text {
        color: black;
    }

    .work-with-us-button:hover .work-with-us-button-icon {
        transform: translateX(3px);
        color: black;
    }

    /* Bottom Decoration */
    .work-with-us-bottom-decoration {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        align-items: center;
    }

    .work-with-us-decoration-dot {
        width: 6px;
        height: 6px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        animation: dotPulse 2s ease-in-out infinite;
    }

    .work-with-us-decoration-dot:nth-child(1) {
        animation-delay: 0s;
    }

    .work-with-us-decoration-dot:nth-child(2) {
        animation-delay: 0.3s;
    }

    .work-with-us-decoration-dot:nth-child(3) {
        animation-delay: 0.6s;
    }

    @keyframes dotPulse {
        0%, 100% {
            opacity: 0.5;
            transform: scale(1);
        }
        50% {
            opacity: 1;
            transform: scale(1.2);
        }
    }

    /* Panel */
    .work-with-us-panel {
        position: relative;
        padding: 2rem 2rem;
        border-radius: 12px;
        background: radial-gradient(circle at 10% 0%, rgba(255,255,255,0.05), transparent 55%),
                    radial-gradient(circle at 90% 100%, rgba(255,255,255,0.03), transparent 60%),
                    rgba(0,0,0,0.5);
        border: 1px solid rgba(255,255,255,0.2);
        box-shadow: 0 12px 40px rgba(0,0,0,0.5);
        backdrop-filter: blur(12px);
        transition: all 0.3s ease;
    }

    .work-with-us-panel:hover {
        box-shadow: 0 16px 50px rgba(0,0,0,0.6);
        border-color: rgba(255,255,255,0.25);
    }

    .work-with-us-panel::before {
        content: '';
        position: absolute;
        inset: 1rem;
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,0.06);
        pointer-events: none;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

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

    .animate-fade-in-down {
        animation: fadeInDown 0.8s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    /* Responsive Adjustments */
    @media (max-width: 767px) {
        .work-with-us-panel {
            padding: 1.5rem 1.5rem;
        }

        .work-with-us-title {
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }

        .work-with-us-description {
            margin-bottom: 1.5rem;
        }

        .work-with-us-button {
            padding: 0.625rem 1.75rem;
            font-size: 0.75rem;
        }

        .work-with-us-button-icon {
            width: 1rem;
            height: 1rem;
        }

        .work-with-us-top-decoration {
            margin-bottom: 1rem;
        }

        .work-with-us-bottom-decoration {
            margin-top: 1.5rem;
        }

        .work-with-us-decoration-line {
            width: 50px;
        }
    }
</style>
@endonce

