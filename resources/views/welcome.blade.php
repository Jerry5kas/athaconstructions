<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']">
    <x-hero :seo="$seo" :heroSection="$heroSection ?? null"/>

    {{-- Stats Section --}}
    <x-stats-section
        :title="'EXPERTISE. PROFESSIONALISM. DEDICATION.'"
        :description="'The ATHA Construction offers an unparalleled level of service, expertise and discretion to its clients, buyers and sellers alike, across the globe.'"
        :stats="$stats"
        backgroundImage="images/blog-2.jpeg"
        sectionId="next-section"
    />

    {{-- About Section --}}
    <x-about-section
        :subtitle="'ATHA Construction'"
        :title="'Crafting Dreams, Building Legacies'"
        :paragraphs="[
            'Founded in 2016, Atha Construction has established itself as a trusted name in construction across Karnataka. Specializing in both residential and commercial projects, we are committed to transforming ideas into reality with precision, innovation, and sustainable practices.',
            'Our approach combines cutting-edge design, advanced technology, and eco-conscious solutions to create spaces that inspire and endure. From cozy homes to modern office spaces, every project is tailored to exceed client expectations while delivering unmatched value and quality.',
            'At Atha Construction, we believe construction is more than building structures—it\'s about creating environments that foster growth, comfort, and community. Our collaborative process ensures transparency and trust, from concept to completion. With a strong presence in Bengaluru, Mysuru, Ballari, and beyond, we take pride in building lasting partnerships rooted in integrity and excellence. As we continue to grow, our mission remains steadfast: delivering exceptional construction services that stand the test of time.'
        ]"
        image="images/ATHA-CONSTRUCTIONS.jpg"
        imageAlt="Best Construction Companies in Bangalore"
        imageTitle="Best Construction Companies in Bangalore"
        :buttonText="'KNOW MORE'"
        :buttonLink="route('about')"
        imagePosition="right"
        :showCounter="false"

    />

    {{-- Services Section --}}
    <x-services-section
        title="OUR SERVICES"
        :description="'We deliver comprehensive construction solutions tailored to your vision. Our expert team brings quality, innovation, and reliability to every project.'"
        :services="$services"
        ctaText="VIEW ALL SERVICES"
        :ctaLink="route('services')"
        :showCta="true"
    />

    {{-- What Makes Us Stand Out Section --}}
    <x-comparison-section
        title="What makes us stand out?"
        :athaAdvantages="$athaAdvantages"
        :otherContractors="$otherContractors"
    />

    {{-- Featured Projects Section --}}
            @php
                $projects = [
                    [
                        'image' => 'mysoore-proj.png',
                        'location' => 'Bangalore',
                        'type' => '4BHK Luxury Home',
                        'land' => '3200 sqft',
                        'tagline' => 'Smart Living, Premium Design',
                    ],
                    [
                        'image' => 'mysoore-proj.png',
                        'location' => 'Mysore',
                        'type' => '3BHK Villa',
                        'land' => '2400 sqft',
                        'tagline' => 'Heritage Meets Modernity',
                    ],
                    [
                        'image' => 'mysoore-proj.png',
                        'location' => 'Ballari',
                        'type' => 'Commercial Complex',
                        'land' => '5000 sqft',
                        'tagline' => 'Business Excellence',
                    ],
                ];
            @endphp
    <x-featured-projects-section
        title="Featured Projects"
        :projects="$projects"
    />

    {{-- How It Works Section --}}
    <x-how-it-works :steps="$howItWorks" />


    @once
        <style>
            /* Featured Projects - Interlocking Stagger Pattern */
            @media (min-width: 1024px) {
                .featured-projects-container {
                    height: auto;
                    position: relative;
                    padding-bottom: 600px; /* Ensure space for absolutely positioned cards */
                }

                .featured-project-item {
                    position: absolute;
                    left: 0;
                    right: 0;
                    width: 100%;
                }

                /* Card 1: Left side, starts at top: 0 */
                .featured-project-item[data-index="0"] {
                    top: 0;
                }

                /* Card 2: Right side, starts at half card height + gap (112px + 48px = 160px) */
                .featured-project-item[data-index="1"] {
                    top: 200px;
                }

                /* Card 3: Left side, starts at full card height + gap (224px + 48px = 272px) */
                .featured-project-item[data-index="2"] {
                    top: 360px;
                }
            }

            /* Mobile: Keep normal flow */
            @media (max-width: 1023px) {
                .featured-project-item {
                    position: relative !important;
                    margin-bottom: 2rem;
                }
            }
        </style>
    @endonce

</x-layouts>
