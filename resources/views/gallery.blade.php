<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        contentTitle="GALLERY"
        backgroundImage="images/properties2/banner2.png"
        alt="residential construction companies in bangalore"
        title="residential construction companies in bangalore"
    />

    {{-- Firebase Script Loader --}}
    <script type="module">
        // Make Firebase functions available globally for Alpine.js
        window.firebaseInitialized = false;
        window.firebaseDb = null;
        
        async function initializeFirebase() {
            if (window.firebaseInitialized) return window.firebaseDb;
            
            try {
                const { initializeApp } = await import('https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js');
                const { getFirestore, collection, onSnapshot } = await import('https://www.gstatic.com/firebasejs/9.6.1/firebase-firestore.js');
                
                const firebaseConfig = @json($firebaseConfig);
                const app = initializeApp(firebaseConfig);
                const db = getFirestore(app);
                
                window.firebaseInitialized = true;
                window.firebaseDb = { db, collection, onSnapshot };
                return window.firebaseDb;
            } catch (error) {
                console.error('Firebase initialization error:', error);
                return null;
            }
        }
        
        // Initialize Firebase on page load
        initializeFirebase();
    </script>

    {{-- Gallery Section --}}
    <section class="py-12 lg:py-16 text-center" id="next-section" 
        x-data="{
            images: [],
            loading: true,
            selectedImage: null,
            lightboxOpen: false,
            init() {
                this.loadImages();
            },
            async loadImages() {
                // Wait for Firebase to initialize
                let attempts = 0;
                while (!window.firebaseInitialized && attempts < 10) {
                    await new Promise(resolve => setTimeout(resolve, 100));
                    attempts++;
                }
                
                if (!window.firebaseDb) {
                    console.error('Firebase not available');
                    this.loading = false;
                    return;
                }
                
                try {
                    const { db, collection, onSnapshot } = window.firebaseDb;
                    const dbRef = collection(db, 'Images');

                    // Listen for real-time updates
                    onSnapshot(dbRef, (querySnapshot) => {
                        this.images = [];
                        querySnapshot.forEach((doc) => {
                            this.images.push(doc.data());
                        });
                        this.loading = false;
                    });
                } catch (error) {
                    console.error('Error loading images:', error);
                    this.loading = false;
                }
            },
            openLightbox(image) {
                this.selectedImage = image;
                this.lightboxOpen = true;
                document.body.style.overflow = 'hidden';
            },
            closeLightbox() {
                this.lightboxOpen = false;
                this.selectedImage = null;
                document.body.style.overflow = '';
            },
            nextImage() {
                if (!this.selectedImage) return;
                const currentIndex = this.images.findIndex(img => img.img_url === this.selectedImage.img_url);
                const nextIndex = (currentIndex + 1) % this.images.length;
                this.selectedImage = this.images[nextIndex];
            },
            previousImage() {
                if (!this.selectedImage) return;
                const currentIndex = this.images.findIndex(img => img.img_url === this.selectedImage.img_url);
                const prevIndex = (currentIndex - 1 + this.images.length) % this.images.length;
                this.selectedImage = this.images[prevIndex];
            }
        }"
        @keydown.escape.window="closeLightbox()"
        @keydown.arrow-right.window="nextImage()"
        @keydown.arrow-left.window="previousImage()"
    >
        <div class="container mx-auto px-4">
            <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-8 lg:mb-12">Gallery</h2>

            {{-- Loading State --}}
            <div x-show="loading" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-black"></div>
                <p class="mt-4 text-sm text-gray-600">Loading gallery...</p>
            </div>

            {{-- Gallery Grid --}}
            <div 
                x-show="!loading && images.length > 0"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 max-w-7xl mx-auto"
            >
                <template x-for="(image, index) in images" :key="index">
                    <div class="relative group cursor-pointer overflow-hidden rounded-lg" @click="openLightbox(image)">
                        <div class="relative overflow-hidden aspect-square">
                            <img 
                                :src="image.img_url || '/images/placeholder.jpg'" 
                                :alt="image.title || 'Gallery Image'"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                loading="lazy"
                            >
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Empty State --}}
            <div x-show="!loading && images.length === 0" class="text-center py-12">
                <p class="text-gray-600">No images available at the moment.</p>
            </div>
        </div>

        {{-- Lightbox Modal --}}
        <div 
            x-show="lightboxOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/95 p-4"
            @click.self="closeLightbox()"
        >
            {{-- Close Button --}}
            <button 
                @click="closeLightbox()"
                class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10"
                aria-label="Close lightbox"
            >
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            {{-- Previous Button --}}
            <button 
                @click="previousImage()"
                x-show="images.length > 1"
                class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 transition-colors z-10"
                aria-label="Previous image"
            >
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            {{-- Next Button --}}
            <button 
                @click="nextImage()"
                x-show="images.length > 1"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 transition-colors z-10"
                aria-label="Next image"
            >
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            {{-- Image Display --}}
            <div 
                x-show="selectedImage"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="max-w-6xl max-h-[90vh] w-full"
            >
                <img 
                    :src="selectedImage?.img_url" 
                    :alt="selectedImage?.title || 'Gallery Image'"
                    class="max-w-full max-h-[90vh] mx-auto object-contain rounded-lg"
                    @click.stop
                >
            </div>
        </div>
    </section>
</x-layouts>
