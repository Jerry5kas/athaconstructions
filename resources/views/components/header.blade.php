<header 
    x-data="{ open: false }"
    class="w-full border-b border-gray-200 bg-white"
>
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="/" class="flex flex-col items-center">
                <img src="/images/logo.png" alt="ATHA Logo" class="h-12">
                <span class="text-[10px] tracking-widest text-gray-600 -mt-2">
                    CONSTRUCTION
                </span>
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden lg:flex items-center space-x-10">
                <a href="/" class="nav-link">HOME</a>
                <a href="/about" class="nav-link">ABOUT</a>
                <a href="/packages" class="nav-link">PACKAGES</a>
                <a href="/properties" class="nav-link">PROPERTIES</a>
                <a href="/careers" class="nav-link">CAREERS</a>
                <a href="/blogs" class="nav-link">BLOGS</a>
                <a href="/gallery" class="nav-link">GALLERY</a>
                <a href="/services" class="nav-link">SERVICES</a>
                <a href="/contact" class="nav-link">CONTACT US</a>
            </nav>

            <!-- Mobile Button -->
            <button 
                class="lg:hidden text-gray-700 text-3xl"
                @click="open = !open"
            >
                <i class="bi" :class="open ? 'bi-x' : 'bi-list'"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div 
        x-show="open" 
        x-transition 
        class="lg:hidden border-t bg-white"
    >
        <nav class="flex flex-col space-y-3 p-4 text-center">
            <a href="/" class="mobile-link">HOME</a>
            <a href="/about" class="mobile-link">ABOUT</a>
            <a href="/packages" class="mobile-link">PACKAGES</a>
            <a href="/properties" class="mobile-link">PROPERTIES</a>
            <a href="/careers" class="mobile-link">CAREERS</a>
            <a href="/blogs" class="mobile-link">BLOGS</a>
            <a href="/gallery" class="mobile-link">GALLERY</a>
            <a href="/services" class="mobile-link">SERVICES</a>
            <a href="/contact" class="mobile-link">CONTACT US</a>
        </nav>
    </div>
</header>
