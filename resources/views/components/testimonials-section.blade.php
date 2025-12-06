@props([
    'title' => 'What Our Clients Say',
    'testimonials' => [],
])

@php
    // Default placeholder testimonials if none provided
    $defaultTestimonials = [
        [
            'comment' => 'We built our 3BHK home with Atha Construction last year, and the experience was outstanding. They completed the project exactly on time, used premium materials like UltraTech cement and JSW steel as promised. The site engineer was always available, and we received daily updates through their app. No hidden costs, everything was transparent from day one. Our family is extremely happy with the quality.',
            'name' => 'Rajesh Kumar',
            'location' => 'Bangalore',
        ],
        [
            'comment' => 'After comparing multiple contractors, we chose Atha Construction for our villa project in Mysore. Their fixed pricing model gave us peace of mind - no cost escalations during construction. The team was professional, the workmanship excellent, and they even helped us with Vastu compliance. The project was completed 2 weeks ahead of schedule. Highly recommend them to anyone looking for reliable construction.',
            'name' => 'Priya Reddy',
            'location' => 'Mysore',
        ],
        [
            'comment' => 'Atha Construction built our dream home in Whitefield. What impressed us most was their transparency - they showed us all material bills, provided regular site photos, and kept us informed at every step. The quality of finishing is top-notch, especially the tiling and painting work. They used only branded materials as promised. The project manager was very responsive to all our queries. Worth every rupee spent.',
            'name' => 'Suresh Iyer',
            'location' => 'Bangalore',
        ],
        [
            'comment' => 'We had a great experience building our 4BHK with Atha Construction. Their design team understood our requirements perfectly and suggested practical modifications. The construction quality is excellent, and they maintained cleanliness at the site throughout. The best part was their commitment to timelines - they delivered exactly when they said they would. The after-sales support has also been good. Very satisfied with their service.',
            'name' => 'Anjali Menon',
            'location' => 'Bangalore',
        ],
        [
            'comment' => 'Atha Construction completed our commercial building project in Ballari. Their project management was excellent - they coordinated with all vendors, handled permits efficiently, and ensured quality at every stage. The team was professional, and communication was clear throughout. They completed the project within budget and on time. The building quality is solid, and we\'ve had no issues post-completion. Would definitely work with them again.',
            'name' => 'Vikram Shetty',
            'location' => 'Ballari',
        ],
        [
            'comment' => 'We chose Atha Construction based on a friend\'s recommendation, and we\'re so glad we did. They built our 2BHK home with attention to detail. The site engineer was always present, and we could see the quality of work firsthand. They used premium materials, and the finishing is beautiful. The best part was their fixed pricing - no surprises, no hidden charges. The project was completed on schedule, and we\'re very happy with our new home.',
            'name' => 'Meera Nair',
            'location' => 'Bangalore',
        ],
        [
            'comment' => 'Atha Construction delivered exceptional service for our home renovation and extension project. They understood our vision, provided valuable suggestions, and executed everything perfectly. The team was respectful, punctual, and maintained site cleanliness. Quality of work is excellent, especially the electrical and plumbing installations. They completed the project on time and within the agreed budget. Highly professional and trustworthy team.',
            'name' => 'Karthik Rao',
            'location' => 'Bangalore',
        ],
    ];
    
    $displayTestimonials = !empty($testimonials) ? $testimonials : $defaultTestimonials;
@endphp

<section class="testimonials-section py-12 lg:py-16 bg-black relative overflow-hidden"
         x-data="{ 
             visible: false,
             currentSlide: 0,
             totalSlides: {{ count($displayTestimonials) }},
             interval: null,
             carouselStarted: false,
             init() {
                 // Wait before starting carousel
                 setTimeout(() => {
                     if (!this.carouselStarted) {
                         this.startCarousel();
                     }
                 }, 2000);
             },
             startCarousel() {
                 this.stopCarousel();
                 if (!this.carouselStarted) {
                     this.interval = setInterval(() => {
                         this.nextSlide();
                     }, 5000);
                     this.carouselStarted = true;
                 }
             },
             stopCarousel() {
                 if (this.interval) {
                     clearInterval(this.interval);
                     this.interval = null;
                 }
             },
             nextSlide() {
                 this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
             },
             prevSlide() {
                 this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
             },
             goToSlide(index) {
                 this.stopCarousel();
                 this.carouselStarted = false;
                 this.currentSlide = index;
                 setTimeout(() => {
                     this.startCarousel();
                 }, 1000);
             }
         }"
         @mouseenter="stopCarousel()"
         @mouseleave="if (carouselStarted) { setTimeout(() => startCarousel(), 500); }"
         x-intersect="visible = true">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 testimonials-bg-pattern"></div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-8 lg:mb-10">
            {{-- Top Decoration --}}
            <div class="testimonials-top-decoration opacity-0 mb-4"
                 :class="{ 'animate-fade-in-down': visible }" 
                 style="animation-delay: 0.2s;">
                <div class="testimonials-decoration-line"></div>
            </div>

            <h2 class="font-tenor text-xl lg:text-2xl uppercase mb-2 tracking-tight testimonials-section-title opacity-0"
                :class="{ 'animate-fade-in-up': visible }" 
                style="animation-delay: 0.3s;">
                {{ $title }}
            </h2>
            
            <div class="w-20 h-0.5 bg-white mx-auto testimonials-divider opacity-0"
                 :class="{ 'animate-fade-in-up': visible }" 
                 style="animation-delay: 0.4s;"></div>
        </div>

        {{-- Testimonials Slider --}}
        <div class="max-w-4xl mx-auto">
            {{-- Slider Container --}}
            <div class="relative testimonials-slider-wrapper">
                <div class="testimonials-slider-container overflow-hidden">
                    <div class="testimonials-slider-track flex transition-transform duration-700 ease-in-out"
                         :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
                        @foreach($displayTestimonials as $index => $testimonial)
                            <div class="testimonials-slide flex-shrink-0 w-full px-4">
                                <div class="testimonial-card opacity-0"
                                     :class="{ 'animate-fade-in-up': visible }"
                                     style="animation-delay: {{ 0.5 + ($index * 0.1) }}s;">
                                    {{-- Quote Icon --}}
                                    <div class="testimonial-quote-icon">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                    </div>

                                    {{-- Comment --}}
                                    <blockquote class="testimonial-comment">
                                        {{ $testimonial['comment'] ?? $testimonial->comment ?? '' }}
                                    </blockquote>

                                    {{-- Author Info --}}
                                    <div class="testimonial-author">
                                        <div class="testimonial-author-avatar">
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-white font-semibold text-lg">
                                                {{ strtoupper(substr(($testimonial['name'] ?? $testimonial->name ?? 'A'), 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="testimonial-author-info">
                                            <div class="testimonial-author-name">
                                                {{ $testimonial['name'] ?? $testimonial->name ?? 'Anonymous' }}
                                            </div>
                                            <div class="testimonial-author-location">
                                                {{ $testimonial['location'] ?? $testimonial->location ?? 'Bangalore' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Navigation Arrows --}}
                <button 
                    @click="prevSlide()"
                    class="testimonials-nav-btn testimonials-nav-prev"
                    aria-label="Previous testimonial"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button 
                    @click="nextSlide()"
                    class="testimonials-nav-btn testimonials-nav-next"
                    aria-label="Next testimonial"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            {{-- Dots Indicator --}}
            <div class="flex justify-center items-center gap-2 mt-6 testimonials-dots">
                @foreach($displayTestimonials as $index => $testimonial)
                    <button
                        @click="goToSlide({{ $index }})"
                        class="testimonial-dot"
                        :class="{ 'active': currentSlide === {{ $index }} }"
                        aria-label="Go to testimonial {{ $index + 1 }}"
                    ></button>
                @endforeach
            </div>
        </div>
    </div>
</section>

@once
<style>
    /* Testimonials Section Styles */
    .testimonials-section {
        position: relative;
        background: #000000;
    }

    /* Background Pattern */
    .testimonials-bg-pattern {
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.02) 0%, transparent 50%);
        background-size: 400px 400px;
    }

    /* Top Decoration */
    .testimonials-top-decoration {
        display: flex;
        justify-content: center;
    }

    .testimonials-decoration-line {
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }

    /* Section Title */
    .testimonials-section-title {
        color: #ffffff;
        letter-spacing: 0.02em;
    }

    /* Divider */
    .testimonials-divider {
        transition: width 0.4s ease;
    }

    .testimonials-section:hover .testimonials-divider {
        width: 100px;
    }

    /* Slider Wrapper */
    .testimonials-slider-wrapper {
        position: relative;
    }

    .testimonials-slider-container {
        position: relative;
    }

    .testimonials-slider-track {
        display: flex;
        will-change: transform;
    }

    .testimonials-slide {
        min-width: 100%;
    }

    /* Testimonial Card */
    .testimonial-card {
        background: #1a1a1a;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.4s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .testimonial-card:hover {
        box-shadow: 0 8px 24px rgba(255, 255, 255, 0.1);
        transform: translateY(-4px);
        border-color: rgba(255, 255, 255, 0.2);
    }

    /* Quote Icon */
    .testimonial-quote-icon {
        color: #ffffff;
        margin-bottom: 1.5rem;
        opacity: 0.3;
    }

    /* Comment */
    .testimonial-comment {
        font-size: 0.9rem;
        line-height: 1.7;
        color: #e0e0e0;
        margin-bottom: 2rem;
        font-style: italic;
    }

    /* Author */
    .testimonial-author {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .testimonial-author-avatar {
        flex-shrink: 0;
    }

    .testimonial-author-info {
        text-align: left;
    }

    .testimonial-author-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.25rem;
    }

    .testimonial-author-location {
        font-size: 0.75rem;
        color: #b0b0b0;
    }

    /* Navigation Buttons */
    .testimonials-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #1a1a1a;
        border: 2px solid #ffffff;
        color: #ffffff;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .testimonials-nav-btn:hover {
        background: #ffffff;
        color: #000000;
        transform: translateY(-50%) scale(1.1);
    }

    .testimonials-nav-prev {
        left: -20px;
    }

    .testimonials-nav-next {
        right: -20px;
    }

    /* Dots Indicator */
    .testimonials-dots {
        display: flex;
    }

    .testimonial-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }

    .testimonial-dot:hover {
        background: rgba(255, 255, 255, 0.5);
        transform: scale(1.2);
    }

    .testimonial-dot.active {
        background: #ffffff;
        width: 24px;
        border-radius: 5px;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

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

    .animate-fade-in-down {
        animation: fadeInDown 0.6s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    /* Responsive */
    @media (max-width: 1023px) {
        .testimonials-nav-prev {
            left: 10px;
        }

        .testimonials-nav-next {
            right: 10px;
        }

        .testimonials-nav-btn {
            width: 36px;
            height: 36px;
        }

        .testimonial-card {
            padding: 1.5rem 1.25rem;
        }

        .testimonial-comment {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 767px) {
        .testimonials-nav-prev {
            left: 5px;
        }

        .testimonials-nav-next {
            right: 5px;
        }

        .testimonials-nav-btn {
            width: 32px;
            height: 32px;
        }

        .testimonials-nav-btn svg {
            width: 16px;
            height: 16px;
        }

        .testimonial-card {
            padding: 1.25rem 1rem;
        }
    }
</style>
@endonce

