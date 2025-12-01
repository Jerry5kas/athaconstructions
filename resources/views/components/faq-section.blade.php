@props([
    'title' => 'Frequently Asked Questions',
    'faqs' => [],
])

@php
    // Use FAQs from global view share (AppServiceProvider) or prop, otherwise use defaults
    $globalFaqs = isset($faqs) ? $faqs : [];
    $propFaqs = $faqs ?? [];
    
    // Default FAQs if none provided
    $defaultFaqs = [
        [
            'question' => 'What services does your construction company provide?',
            'answer' => 'We offer a wide range of services, including residential and commercial construction, remodeling, renovations, project management, and custom design-build services.',
        ],
        [
            'question' => 'Do you intervene client in selection of Materials?',
            'answer' => 'Yes, we do.',
        ],
        [
            'question' => 'Are you licensed and insured?',
            'answer' => 'Yes, we are fully licensed, bonded, and insured to ensure compliance with local regulations and to provide peace of mind to our clients.',
        ],
        [
            'question' => 'How long has your company been in business?',
            'answer' => 'Our company has been serving the community for 6 years, delivering high-quality construction projects tailored to our clients\' needs.',
        ],
        [
            'question' => 'Do you provide free project estimates?',
            'answer' => 'Yes, we provide free and detailed project estimates to help you understand the scope and budget of your project.',
        ],
        [
            'question' => 'What areas do you serve?',
            'answer' => 'We serve Bangalore. If you\'re unsure whether we cover your area, feel free to contact us.',
        ],
        [
            'question' => 'How long does it take to complete a construction project?',
            'answer' => 'Project timelines vary based on the size, scope, and complexity of the project. Once we understand your requirements, we\'ll provide a realistic timeline.',
        ],
        [
            'question' => 'What is the process for starting a construction project?',
            'answer' => 'Our process involves an initial consultation, site evaluation, design and planning, cost estimation, contract agreement, and project execution. We\'ll guide you every step of the way.',
        ],
    ];
    
    // Priority: prop FAQs > global FAQs > defaults
    $faqsToUse = !empty($propFaqs) ? $propFaqs : (!empty($globalFaqs) ? $globalFaqs : $defaultFaqs);
@endphp

<section class="faq-section py-16 lg:py-24 bg-white relative overflow-hidden" 
         x-data="{ openFaq: null, visible: false }"
         x-intersect="visible = true">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 faq-bg-pattern"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-12 lg:mb-16">
            <h2 class="font-tenor text-3xl lg:text-4xl uppercase mb-4 faq-title opacity-0"
                :class="{ 'animate-fade-in-up': visible }" 
                style="animation-delay: 0.2s;">
                {{ $title }}
            </h2>
            <div class="w-24 h-0.5 bg-black mx-auto faq-divider opacity-0"
                 :class="{ 'animate-fade-in-up': visible }" 
                 style="animation-delay: 0.3s;"></div>
        </div>

        {{-- FAQ Items --}}
        <div class="max-w-3xl mx-auto">
            @foreach($faqsToUse as $index => $faq)
                <div class="faq-item mb-4 opacity-0"
                     :class="{ 'animate-fade-in-up': visible }" 
                     style="animation-delay: {{ 0.4 + ($index * 0.1) }}s;">
                    <div class="faq-question-wrapper">
                        <button
                            @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
                            class="faq-question-button group"
                            :class="{ 'faq-question-button-active': openFaq === {{ $index }} }"
                        >
                            <span class="faq-question-text">{{ $faq['question'] }}</span>
                            <span class="faq-icon-wrapper">
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     :class="{ 'faq-icon-rotated': openFaq === {{ $index }} }">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div
                        x-show="openFaq === {{ $index }}"
                        x-collapse
                        class="faq-answer-wrapper"
                    >
                        <div class="faq-answer">
                            <p>{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@once
<style>
    /* FAQ Section Styles */
    .faq-section {
        position: relative;
    }

    /* Background Pattern */
    .faq-bg-pattern {
        background-image: 
            radial-gradient(circle at 10% 20%, rgba(0, 0, 0, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 90% 80%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
        background-size: 400px 400px;
    }

    /* Title */
    .faq-title {
        color: #1a1a1a;
        letter-spacing: 0.05em;
    }

    /* Divider */
    .faq-divider {
        transition: width 0.6s ease;
    }

    .faq-section:hover .faq-divider {
        width: 120px;
    }

    /* FAQ Item */
    .faq-item {
        border-bottom: 1px solid #e5e5e5;
        transition: all 0.3s ease;
    }

    .faq-item:last-child {
        border-bottom: none;
    }

    /* Question Wrapper */
    .faq-question-wrapper {
        position: relative;
    }

    /* Question Button */
    .faq-question-button {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.25rem 1.5rem;
        background: #f8f8f8;
        border: 1px solid #e5e5e5;
        text-align: left;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .faq-question-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.05), transparent);
        transition: left 0.5s ease;
    }

    .faq-question-button:hover::before {
        left: 100%;
    }

    .faq-question-button:hover {
        background: #f0f0f0;
        border-color: #d0d0d0;
        transform: translateX(4px);
    }

    .faq-question-button-active {
        background: #1a1a1a;
        border-color: #1a1a1a;
        color: white;
    }

    .faq-question-button-active:hover {
        background: #2a2a2a;
        border-color: #2a2a2a;
        transform: translateX(0);
    }

    /* Question Text */
    .faq-question-text {
        font-size: 0.9375rem;
        font-weight: 600;
        line-height: 1.5;
        color: #1a1a1a;
        flex: 1;
        padding-right: 1rem;
        transition: color 0.3s ease;
    }

    .faq-question-button-active .faq-question-text {
        color: white;
    }

    /* Icon Wrapper */
    .faq-icon-wrapper {
        flex-shrink: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .faq-question-button-active .faq-icon-wrapper {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Icon */
    .faq-icon {
        width: 18px;
        height: 18px;
        color: #1a1a1a;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .faq-question-button-active .faq-icon {
        color: white;
        transform: rotate(45deg);
    }

    .faq-icon-rotated {
        transform: rotate(45deg);
    }

    /* Answer Wrapper */
    .faq-answer-wrapper {
        overflow: hidden;
    }

    /* Answer */
    .faq-answer {
        padding: 1.5rem;
        background: #fafafa;
        border-left: 3px solid #1a1a1a;
        margin-top: 0;
    }

    .faq-answer p {
        font-size: 0.9375rem;
        line-height: 1.7;
        color: #4a4a4a;
        margin: 0;
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

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    /* Responsive Adjustments */
    @media (max-width: 767px) {
        .faq-question-button {
            padding: 1rem 1.25rem;
        }

        .faq-question-text {
            font-size: 0.875rem;
        }

        .faq-answer {
            padding: 1.25rem;
        }

        .faq-answer p {
            font-size: 0.875rem;
        }
    }
</style>
@endonce

