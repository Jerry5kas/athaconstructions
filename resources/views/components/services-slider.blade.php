@props(['services' => []])

<div 
    x-data="{
        currentSlide: 0,
        itemsPerView: 3,
        totalItems: {{ count($services) }},
        init() {
            this.updateItemsPerView();
            window.addEventListener('resize', () => this.updateItemsPerView());
        },
        updateItemsPerView() {
            this.itemsPerView = window.innerWidth >= 1024 ? 3 : 1;
        },
        get totalSlides() {
            return Math.ceil(this.totalItems / this.itemsPerView);
        },
        get currentSlideStartIndex() {
            return this.currentSlide * this.itemsPerView;
        },
        get currentSlideEndIndex() {
            return Math.min(this.currentSlideStartIndex + this.itemsPerView, this.totalItems);
        },
        get itemsInCurrentSlide() {
            return this.currentSlideEndIndex - this.currentSlideStartIndex;
        },
        get shouldCenter() {
            return this.itemsInCurrentSlide < this.itemsPerView && this.itemsPerView > 1;
        },
        next() {
            if (this.currentSlide < this.totalSlides - 1) {
                this.currentSlide++;
            } else {
                this.currentSlide = 0;
            }
        },
        prev() {
            if (this.currentSlide > 0) {
                this.currentSlide--;
            } else {
                this.currentSlide = this.totalSlides - 1;
            }
        },
        goToSlide(slideIndex) {
            this.currentSlide = slideIndex;
        }
    }"
    class="services-slider relative"
>
    {{-- Slider Container --}}
    <div class="relative overflow-hidden w-full">
        <div 
            class="services-slider-track flex gap-4 transition-all duration-700 ease-out"
            :class="shouldCenter ? 'justify-center' : ''"
        >
            @foreach($services as $index => $service)
                <div 
                    x-show="({{ $index }} >= currentSlideStartIndex) && ({{ $index }} < currentSlideEndIndex)"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="services-slide flex-shrink-0"
                    :style="`width: ${100 / itemsPerView}%`"
                >
                    <div class="service-card-item h-full px-2 lg:px-3">
                        <div class="service-card-inner rounded-2xl border-0 hover:bg-white/5 transition-all duration-300 hover:shadow-lg hover:shadow-white/20 flex flex-col w-full text-center h-full p-6">
                            <div class="flex flex-col items-center justify-center mb-4">
                                <img 
                                    src="{{ asset('images/our-ser/' . $service['icon']) }}" 
                                    alt="{{ $service['title'] }}"
                                    class="w-14 h-14 lg:w-16 lg:h-16 mb-4 transition-transform duration-300 hover:scale-110"
                                >
                                <h3 class="font-tenor text-lg lg:text-xl uppercase font-medium">{{ $service['title'] }}</h3>
                            </div>
                            <p class="text-xs lg:text-sm text-gray-300 leading-relaxed flex-1">{{ $service['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Navigation Arrows --}}
    <div class="flex items-center justify-center gap-4 mt-8">
        <button 
            @click="prev()"
            class="services-nav-btn w-12 h-12 flex items-center justify-center border-2 border-white rounded-full hover:bg-white hover:text-black transition-all duration-300"
            aria-label="Previous services"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        {{-- Dots Indicator --}}
        <div class="flex items-center gap-2">
            <template x-for="index in Array.from({length: totalSlides}, (_, i) => i)" :key="index">
                <button
                    @click="goToSlide(index)"
                    class="services-dot w-2 h-2 rounded-full transition-all duration-300"
                    :class="currentSlide === index ? 'bg-white w-8' : 'bg-white/40 hover:bg-white/60'"
                    :aria-label="`Go to slide ${index + 1}`"
                ></button>
            </template>
        </div>

        <button 
            @click="next()"
            class="services-nav-btn w-12 h-12 flex items-center justify-center border-2 border-white rounded-full hover:bg-white hover:text-black transition-all duration-300"
            aria-label="Next services"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
</div>

@once
<style>
    .services-slider {
        width: 100%;
    }

    .services-slider-track {
        display: flex;
        flex-wrap: nowrap;
        width: 100%;
    }

    .services-slide {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .service-card-item {
        min-height: 280px;
    }

    .service-card-inner {
        border: none !important;
    }

    @media (max-width: 1023px) {
        .service-card-item {
            min-height: 240px;
        }
    }
</style>
@endonce
