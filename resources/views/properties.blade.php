<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        pageTitle="Explore Properties"
        contentTitle="Handpicked Homes & Developments"
        description="Discover thoughtfully planned properties that combine architecture, comfort, and long-term value."
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

    {{-- Properties Page with Firebase Integration --}}
    <div 
        x-data="{
            selectedProject: null,
            projects: [],
            loading: true,
            init() {
                // Load selected project from localStorage if exists
                const stored = localStorage.getItem('selectedProject');
                if (stored) {
                    try {
                        this.selectedProject = JSON.parse(stored);
                    } catch(e) {
                        console.error('Error parsing stored project:', e);
                    }
                }
                
                // Wait for Firebase to be ready
                this.loadProjects();
            },
            async loadProjects() {
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
                    const dbRef = collection(db, 'Projects');

                    // Listen for real-time updates
                    onSnapshot(dbRef, (querySnapshot) => {
                        this.projects = [];
                        querySnapshot.forEach((doc) => {
                            this.projects.push(doc.data());
                        });
                        this.loading = false;
                    });
                } catch (error) {
                    console.error('Error loading projects:', error);
                    this.loading = false;
                }
            },
            selectProject(project) {
                this.selectedProject = project;
                localStorage.setItem('selectedProject', JSON.stringify(project));
                // Scroll to project details section
                setTimeout(() => {
                    const detailsSection = document.getElementById('project-details');
                    if (detailsSection) {
                        detailsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 100);
            },
            clearSelection() {
                this.selectedProject = null;
                localStorage.removeItem('selectedProject');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }"
    >
        {{-- Projects List Section --}}
        <section class="py-12 lg:py-16 text-center" id="next-section">
            <div class="container mx-auto px-4">
                <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-8 lg:mb-12">
                    ONGOING PROJECTS
                </h2>

                {{-- Loading State --}}
                <div x-show="loading" class="text-center py-12">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-black"></div>
                    <p class="mt-4 text-sm text-gray-600">Loading projects...</p>
                </div>

                {{-- Projects Grid --}}
                <div 
                    x-show="!loading && projects.length > 0"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 max-w-7xl mx-auto"
                >
                    <template x-for="project in projects" :key="project.id || project.title">
                        <div 
                            @click="selectProject(project)"
                            class="cursor-pointer group text-center transition-all duration-300 transform hover:scale-105"
                        >
                            <div class="relative overflow-hidden rounded-lg shadow-lg mb-4">
                                <img 
                                    :src="project.img_url || '/images/placeholder.jpg'" 
                                    :alt="project.title || 'Project Image'"
                                    class="w-full h-64 object-cover group-hover:opacity-90 transition-opacity duration-300"
                                >
                            </div>
                            <h3 class="font-tenor text-lg lg:text-xl mb-2" x-text="project.title || 'Project Title'"></h3>
                            <p class="text-sm text-gray-600 mb-1" x-text="project.locations || ''"></p>
                            <p class="text-sm text-gray-600 mb-1" x-text="project.feets || ''"></p>
                            <p class="text-sm font-semibold" x-text="'Land Parcel : ' + (project.land1 || '')"></p>
                        </div>
                    </template>
                </div>

                {{-- Empty State --}}
                <div x-show="!loading && projects.length === 0" class="text-center py-12">
                    <p class="text-gray-600">No projects available at the moment.</p>
                </div>
            </div>
        </section>

        {{-- Selected Project Details Section --}}
        <section 
            id="project-details"
            x-show="selectedProject !== null"
            x-cloak
            x-transition
            class="py-12 lg:py-16 bg-gray-50"
        >
            <div class="container mx-auto px-4">
                <div class="text-center mb-8">
                    <h2 class="font-tenor text-2xl lg:text-3xl uppercase mb-4">
                        PROJECTS DETAILS
                    </h2>
                    <button 
                        @click="clearSelection()"
                        class="text-sm text-gray-600 hover:text-black underline"
                    >
                        Clear Selection
                    </button>
                </div>

                <template x-if="selectedProject">
                    <div class="max-w-6xl mx-auto">
                        {{-- Project Header Image --}}
                        <div class="mb-8">
                            <img 
                                :src="selectedProject.img_url || '/images/placeholder.jpg'" 
                                :alt="selectedProject.title || 'Project Image'"
                                class="w-full h-auto rounded-lg shadow-lg"
                            >
                        </div>

                        {{-- Project Title and Info --}}
                        <div class="text-center mb-12">
                            <h3 class="font-tenor text-2xl lg:text-3xl uppercase mb-2" x-text="selectedProject.title || ''"></h3>
                            <p class="text-base lg:text-lg font-semibold mb-2" x-text="selectedProject.locations || ''"></p>
                            <p class="text-sm lg:text-base text-gray-600 mb-2" x-text="selectedProject.feets || ''"></p>
                            <p class="text-sm lg:text-base font-semibold mb-8" x-text="'Land Parcel : ' + (selectedProject.land1 || '')"></p>
                        </div>

                        {{-- Project Description and Details --}}
                        <div class="grid lg:grid-cols-12 gap-8 items-start">
                            {{-- Description --}}
                            <div class="lg:col-span-8">
                                <div class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
                                    <h4 class="font-tenor text-xl uppercase mb-4">Description</h4>
                                    <p class="text-sm lg:text-base text-gray-700 leading-relaxed" x-text="selectedProject.des || 'No description available.'"></p>
                                </div>
                            </div>

                            {{-- Property Features --}}
                            <div class="lg:col-span-4">
                                <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0">
                                            <img 
                                                src="{{ asset('images/properties2/bed.png') }}" 
                                                alt="Beds"
                                                class="w-12 h-12 object-contain"
                                            >
                                        </div>
                                        <div>
                                            <p class="text-2xl font-semibold mb-1">4</p>
                                            <p class="text-sm uppercase tracking-wide text-gray-600">BEDS</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0">
                                            <img 
                                                src="{{ asset('images/properties2/bath.png') }}" 
                                                alt="Baths"
                                                class="w-12 h-12 object-contain"
                                            >
                                        </div>
                                        <div>
                                            <p class="text-2xl font-semibold mb-1">5</p>
                                            <p class="text-sm uppercase tracking-wide text-gray-600">BATHS</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0">
                                            <img 
                                                src="{{ asset('images/properties2/area.png') }}" 
                                                alt="Area"
                                                class="w-12 h-12 object-contain"
                                            >
                                        </div>
                                        <div>
                                            <p class="text-base font-semibold mb-1" x-text="selectedProject.land2 || 'N/A'"></p>
                                            <p class="text-sm uppercase tracking-wide text-gray-600">LIVING AREA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </div>
</x-layouts>
