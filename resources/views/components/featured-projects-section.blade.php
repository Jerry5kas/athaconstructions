@props([
    'title' => 'Featured Projects',
    'projects' => [],
])

<section class="featured-projects-section py-16 lg:py-24 bg-white relative overflow-hidden"
         x-data="{ visible: false }"
         x-intersect="visible = true">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 projects-bg-pattern"></div>
    
    {{-- Decorative Vertical Dashed Line --}}
    <div class="hidden lg:block absolute inset-0 pointer-events-none projects-dashed-line">
        <svg class="w-full h-full" viewBox="0 0 1200 800" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M600 0 L600 800" stroke="currentColor" stroke-width="1" stroke-dasharray="20 10"/>
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-12 lg:mb-16">
            {{-- Top Decoration --}}
            <div class="projects-top-decoration opacity-0 mb-6"
                 :class="{ 'animate-fade-in-down': visible }" 
                 style="animation-delay: 0.2s;">
                <div class="projects-decoration-line"></div>
            </div>

            <h2 class="font-tenor text-3xl lg:text-4xl uppercase mb-4 tracking-tight projects-title opacity-0"
                :class="{ 'animate-fade-in-up': visible }" 
                style="animation-delay: 0.3s;">
                {{ $title }}
            </h2>
            
            <div class="w-20 h-0.5 bg-black mx-auto projects-divider opacity-0"
                 :class="{ 'animate-fade-in-up': visible }" 
                 style="animation-delay: 0.4s;"></div>
        </div>

        <div class="max-w-6xl mx-auto relative featured-projects-container">
            @foreach($projects as $index => $project)
                @php
                    $isEven = ($index % 2 == 0);
                    $isLeft = $isEven;
                @endphp
                <div 
                    class="project-staggered-card featured-project-item"
                    x-data="{ visible: false }" 
                    x-intersect="visible = true"
                    data-index="{{ $index }}"
                    style="--card-index: {{ $index }};"
                >
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-center">
                        @if($isLeft)
                            {{-- Left Side: Image Card --}}
                            <div class="lg:col-span-4 lg:pr-2 opacity-0"
                                 :class="{ 'animate-fade-in-left': visible }"
                                 style="animation-delay: {{ 0.5 + ($index * 0.15) }}s;">
                                <div class="project-image-card group">
                                    <div class="relative overflow-hidden rounded-lg bg-black h-48 lg:h-56 shadow-lg transform transition-all duration-500 hover:scale-105 project-image-wrapper">
                                        <img 
                                            src="{{ asset('images/' . $project['image']) }}" 
                                            alt="{{ $project['location'] }} - {{ $project['type'] }}"
                                            class="w-full h-full object-cover opacity-85 group-hover:opacity-100 transition-opacity duration-500 project-image"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent project-image-overlay"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-4 project-image-content">
                                            <p class="text-white text-xs uppercase tracking-wider font-semibold">{{ $project['location'] }}</p>
                                        </div>
                                        {{-- Decorative Corner --}}
                                        <div class="absolute top-0 right-0 w-16 h-16 project-corner-decoration">
                                            <div class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-white/30"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Right Side: Content --}}
                            <div class="lg:col-span-8 lg:pl-2 opacity-0"
                                 :class="{ 'animate-fade-in-right': visible }"
                                 style="animation-delay: {{ 0.5 + ($index * 0.15) + 0.1 }}s;">
                                <div class="project-content-card">
                                    <div class="space-y-2">
                                        <div>
                                            <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">{{ $project['location'] }}</p>
                                            <h3 class="font-tenor text-xl lg:text-2xl uppercase mb-2 tracking-tight project-title">{{ $project['type'] }}</h3>
                                            <div class="w-12 h-0.5 bg-black mb-2 project-title-accent"></div>
                                        </div>
                                        <p class="text-sm text-gray-600 italic mb-2 project-tagline">{{ $project['tagline'] }}</p>
                                        <div class="flex items-center gap-2 text-xs text-gray-500 project-meta">
                                            <div class="w-1.5 h-1.5 bg-gray-400 rounded-full"></div>
                                            <span>{{ $project['land'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Right Side: Image Card --}}
                            <div class="lg:col-span-4 lg:pl-2 lg:order-2 opacity-0"
                                 :class="{ 'animate-fade-in-right': visible }"
                                 style="animation-delay: {{ 0.5 + ($index * 0.15) }}s;">
                                <div class="project-image-card group">
                                    <div class="relative overflow-hidden rounded-lg bg-black h-48 lg:h-56 shadow-lg transform transition-all duration-500 hover:scale-105 project-image-wrapper">
                                        <img 
                                            src="{{ asset('images/' . $project['image']) }}" 
                                            alt="{{ $project['location'] }} - {{ $project['type'] }}"
                                            class="w-full h-full object-cover opacity-85 group-hover:opacity-100 transition-opacity duration-500 project-image"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent project-image-overlay"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-4 project-image-content">
                                            <p class="text-white text-xs uppercase tracking-wider font-semibold">{{ $project['location'] }}</p>
                                        </div>
                                        {{-- Decorative Corner --}}
                                        <div class="absolute top-0 left-0 w-16 h-16 project-corner-decoration">
                                            <div class="absolute top-0 left-0 w-8 h-8 border-t-2 border-l-2 border-white/30"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Left Side: Content --}}
                            <div class="lg:col-span-8 lg:pr-2 lg:order-1 text-right opacity-0"
                                 :class="{ 'animate-fade-in-left': visible }"
                                 style="animation-delay: {{ 0.5 + ($index * 0.15) + 0.1 }}s;">
                                <div class="project-content-card">
                                    <div class="space-y-2">
                                        <div>
                                            <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">{{ $project['location'] }}</p>
                                            <h3 class="font-tenor text-xl lg:text-2xl uppercase mb-2 tracking-tight project-title">{{ $project['type'] }}</h3>
                                            <div class="w-12 h-0.5 bg-black ml-auto mb-2 project-title-accent"></div>
                                        </div>
                                        <p class="text-sm text-gray-600 italic mb-2 project-tagline">{{ $project['tagline'] }}</p>
                                        <div class="flex items-center gap-2 text-xs text-gray-500 justify-end project-meta">
                                            <span>{{ $project['land'] }}</span>
                                            <div class="w-1.5 h-1.5 bg-gray-400 rounded-full"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@once
<style>
    /* Featured Projects Section Styles */
    .featured-projects-section {
        position: relative;
        background: #fafafa;
    }

    /* Background Pattern */
    .projects-bg-pattern {
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(0, 0, 0, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
        background-size: 400px 400px;
    }

    /* Dashed Line */
    .projects-dashed-line {
        opacity: 0.05;
    }

    /* Top Decoration */
    .projects-top-decoration {
        display: flex;
        justify-content: center;
    }

    .projects-decoration-line {
        width: 100px;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.3), transparent);
    }

    /* Title */
    .projects-title {
        color: #1a1a1a;
        letter-spacing: 0.02em;
    }

    /* Divider */
    .projects-divider {
        transition: width 0.4s ease;
    }

    .featured-projects-section:hover .projects-divider {
        width: 120px;
    }

    /* Projects Container */
    .featured-projects-container {
        height: auto;
        position: relative;
        padding-bottom: 600px;
    }

    /* Project Card */
    .featured-project-item {
        position: absolute;
        left: 0;
        right: 0;
        width: 100%;
        margin-bottom: 3rem;
    }

    .featured-project-item[data-index="0"] {
        top: 0;
    }

    .featured-project-item[data-index="1"] {
        top: 200px;
    }

    .featured-project-item[data-index="2"] {
        top: 360px;
    }

    /* Image Card */
    .project-image-card {
        position: relative;
    }

    .project-image-wrapper {
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .project-image-wrapper:hover {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .project-image {
        transition: transform 0.6s ease;
    }

    .project-image-wrapper:hover .project-image {
        transform: scale(1.05);
    }

    .project-image-overlay {
        transition: opacity 0.4s ease;
    }

    .project-image-wrapper:hover .project-image-overlay {
        opacity: 0.8;
    }

    /* Corner Decoration */
    .project-corner-decoration {
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .project-image-wrapper:hover .project-corner-decoration {
        opacity: 1;
    }

    /* Content Card */
    .project-content-card {
        padding: 1.5rem;
        background: transparent;
        border-radius: 12px;
        border: none;
        transition: all 0.4s ease;
    }

    .project-content-card:hover {
        box-shadow: none;
        border-color: transparent;
    }

    /* Title */
    .project-title {
        color: #1a1a1a;
        transition: color 0.3s ease;
    }

    .project-content-card:hover .project-title {
        color: #000;
    }

    /* Title Accent */
    .project-title-accent {
        transition: width 0.4s ease;
    }

    .project-content-card:hover .project-title-accent {
        width: 60px;
    }

    /* Tagline */
    .project-tagline {
        transition: color 0.3s ease;
    }

    .project-content-card:hover .project-tagline {
        color: #4a4a4a;
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

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-fade-in-down {
        animation: fadeInDown 0.8s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-fade-in-left {
        animation: fadeInLeft 0.8s ease-out forwards;
    }

    .animate-fade-in-right {
        animation: fadeInRight 0.8s ease-out forwards;
    }

    /* Responsive */
    @media (max-width: 1023px) {
        .featured-projects-section {
            padding-bottom: 3rem;
        }

        .featured-project-item {
            position: relative !important;
            top: auto !important;
            margin-bottom: 2rem;
        }

        .featured-projects-container {
            position: static;
            height: auto;
            padding-bottom: 0;
        }
    }
</style>
@endonce

