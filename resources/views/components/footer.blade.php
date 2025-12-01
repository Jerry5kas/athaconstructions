{{-- Footer Component --}}
<footer class="bg-black text-white py-12 lg:py-16 atha-footer relative overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        {{-- Footer Logo --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
            <img 
                src="{{ asset('images/footer-logo.png') }}" 
                alt="Atha Construction in Bangalore" 
                title="Atha Construction in Bangalore"
                class="w-24"
            >
            </div>
            <div class="text-xs md:text-sm text-gray-400 max-w-md md:text-right">
                Building trust, creating value across Bengaluru, Mysuru and Ballari through thoughtfully crafted spaces.
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            {{-- Office Locations --}}
            <div class="lg:col-span-1 footer-column">
                {{-- Bangalore Office --}}
                <h3 class="footer-heading">Bangalore</h3>
                <p class="text-sm text-gray-300 flex items-start gap-2 mb-6">
                    <i class="fas fa-map-marker-alt mt-1 flex-shrink-0"></i>
                    <a 
                        href="https://maps.app.goo.gl/G8Ezuo2a8pbknSkk8" 
                        target="_blank" 
                        class="hover:text-white transition-colors"
                    >
                        No.81/37, Ground Floor, The Hulkul, Lavelle Road, Bengaluru - 560001.
                    </a>
                </p>

                {{-- Ballari Office --}}
                <h3 class="footer-heading">Ballari</h3>
                <p class="text-sm text-gray-300 flex items-start gap-2 mb-6">
                    <i class="fas fa-map-marker-alt mt-1 flex-shrink-0"></i>
                    <a 
                        href="https://maps.app.goo.gl/MdQ2gi2iPGKXQNn28" 
                        target="_blank" 
                        class="hover:text-white transition-colors"
                    >
                        First Floor, PVR Plaza, No 7, 3rd Cross Rd, Nehru Colony, Sidiginamola, Ballari, Karnataka 583103.
                    </a>
                </p>

                {{-- Mysore Office --}}
                <h3 class="footer-heading">Mysore</h3>
                <p class="text-sm text-gray-300 flex items-start gap-2">
                    <i class="fas fa-map-marker-alt mt-1 flex-shrink-0"></i>
                    <span>
                        VIJAY ARCADE, # 1714 Sarvodaya Road E&F Block Ramkrishna Nagar (Kuvempu Nagar), Mysore 570009
                    </span>
                </p>
            </div>

            {{-- Quick Links --}}
            <div class="lg:pl-8 footer-column">
                <h3 class="footer-heading mb-4">Quick Links</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="text-sm text-gray-300 hover:text-white transition-colors">
                            HOME
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-sm text-gray-300 hover:text-white transition-colors">
                            ABOUT
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('properties') }}" class="text-sm text-gray-300 hover:text-white transition-colors">
                            PROPERTIES
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('packages') }}" class="text-sm text-gray-300 hover:text-white transition-colors">
                            PACKAGES
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('careers') }}" class="text-sm text-gray-300 hover:text-white transition-colors">
                            CAREERS
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blogs') }}" class="text-sm text-gray-300 hover:text-white transition-colors">
                            BLOGS
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-sm text-gray-300 hover:text-white transition-colors">
                            CONTACT US
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact Information --}}
            <div class="footer-column">
                <h3 class="footer-heading mb-4">Contact Us</h3>
                <div class="space-y-3 text-sm">
                    <p class="text-sm text-gray-300">
                        <a href="mailto:info@athaconstruction.in" class="flex items-center gap-2 hover:text-white transition-colors">
                            <i class="fas fa-envelope"></i>
                            info@athaconstruction.in
                        </a>
                    </p>
                    <p class="text-sm text-gray-300">
                        <a href="tel:+918049776616" class="flex items-center gap-2 hover:text-white transition-colors">
                            <i class="fas fa-phone"></i>
                            +91 8049776616
                        </a>
                    </p>
                    <p class="text-sm text-gray-300">
                        <a href="tel:+919606956044" class="flex items-center gap-2 hover:text-white transition-colors">
                            <i class="fas fa-phone"></i>
                            +91 9606956044
                        </a>
                    </p>
                </div>

                {{-- Social Media Links --}}
                <div class="mt-6 space-y-3">
                    <h4 class="text-sm font-medium mb-3">Follow Us</h4>
                    <div class="flex items-center gap-4">
                        <a 
                            href="https://www.facebook.com/profile.php?id=61569376468425" 
                            target="_blank"
                            aria-label="Facebook"
                            class="w-10 h-10 flex items-center justify-center rounded-full border border-white/30 text-white hover:bg-white hover:text-black transition-all duration-300"
                        >
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a 
                            href="https://www.instagram.com/atha_construction/" 
                            target="_blank"
                            aria-label="Instagram"
                            class="w-10 h-10 flex items-center justify-center rounded-full border border-white/30 text-white hover:bg-white hover:text-black transition-all duration-300"
                        >
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a 
                            href="https://www.linkedin.com/company/athaconstruction.in/" 
                            target="_blank"
                            aria-label="LinkedIn"
                            class="w-10 h-10 flex items-center justify-center rounded-full border border-white/30 text-white hover:bg-white hover:text-black transition-all duration-300"
                        >
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Newsletter / Quick Contact --}}
            <div class="footer-column">
                <h3 class="footer-heading mb-4">Get In Touch</h3>
                <p class="text-sm text-gray-300 mb-4">
                    Subscribe for updates on our latest projects, insights and offers.
                </p>
                <form action="#" method="POST" class="space-y-3">
                    @csrf
                    <input 
                        type="email" 
                        name="email"
                        placeholder="Your Email Address"
                        class="w-full px-0 py-3 bg-transparent border-b border-white/30 text-white text-sm placeholder-gray-400 focus:outline-none focus:border-white transition-colors"
                        required
                    >
                    <button 
                        type="submit" 
                        class="w-full px-4 py-3 border border-white text-white text-sm uppercase tracking-wide hover:bg-white hover:text-black transition-all duration-300"
                    >
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-12 pt-8 border-t border-white/10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-gray-400">
                    © {{ date('Y') }} Atha Construction. All Rights Reserved.
                </p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-xs text-gray-400 hover:text-white transition-colors">
                        Privacy Policy
                    </a>
                    <a href="#" class="text-xs text-gray-400 hover:text-white transition-colors">
                        Terms of Service
                    </a>
                    <a href="#" class="text-xs text-gray-400 hover:text-white transition-colors">
                        Sitemap
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

@once
<style>
    .atha-footer::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 0% 0%, rgba(255,255,255,0.06), transparent 45%),
            radial-gradient(circle at 100% 100%, rgba(255,255,255,0.04), transparent 55%);
        opacity: 0.7;
        pointer-events: none;
    }

    .footer-column {
        position: relative;
    }

    .footer-heading {
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }
</style>
@endonce