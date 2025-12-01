@props([
    'title' => 'Best Construction Company In Bangalore | Atha Construction',
    'description' => 'Explore Atha Construction, the best construction company in Bangalore. Expert builders delivering quality, innovation, and excellence in every project.',
    'keywords' => 'Construction Companies In Bangalore, Best Construction Company In Bangalore, residential construction companies in bangalore',
    'head' => '',
    'scripts' => '',
])

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="JH2zqBNAUIPT9d3-d2tA5CGOFXdkvijiZrb5kJDGVCk" />

    {{-- Dynamic SEO Meta Tags --}}
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    
    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}" />
    
    <meta name="robots" content="index, follow">

    {{-- Google Analytics (GA4) --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GNYXP1XF3S"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-GNYXP1XF3S');
    </script>

    {{-- Google Tag Manager --}}
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NJ9ZQFZG');
    </script>

    {{-- Schema Markup - Organization --}}
    <script type="application/ld+json">
    @php
        echo json_encode([
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => "Atha Construction",
            "alternateName" => "Atha Construction",
            "url" => "https://athaconstruction.in/",
            "logo" => "https://athaconstruction.in/assetes/images/logo.png",
            "contactPoint" => [
                "@type" => "ContactPoint",
                "telephone" => "+91 8049776616",
                "contactType" => "technical support",
                "areaServed" => "IN",
                "availableLanguage" => "en"
            ],
            "sameAs" => [
                "https://www.instagram.com/atha_construction/",
                "https://www.facebook.com/profile.php?id=61569376468425",
                "https://www.linkedin.com/company/athaconstruction.in/"
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    @endphp
    </script>

    {{-- Schema Markup - Website --}}
    <script type="application/ld+json">
    @php
        echo json_encode([
            "@context" => "https://schema.org/",
            "@type" => "WebSite",
            "name" => "Atha Construction",
            "url" => "https://athaconstruction.in/",
            "potentialAction" => [
                "@type" => "SearchAction",
                "target" => "https://athaconstruction.in/services{search_term_string}",
                "query-input" => "required name=search_term_string"
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    @endphp
    </script>

    {{-- Schema Markup - Business --}}
    <script type="application/ld+json">
    @php
        echo json_encode([
            "@context" => "https://schema.org",
            "@type" => "HomeAndConstructionBusiness",
            "name" => "Atha Construction",
            "image" => "https://athaconstruction.in/assetes/images/logo.png",
            "@id" => "",
            "url" => "https://athaconstruction.in/",
            "telephone" => "+91 8049776616",
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => "No.81/37, Ground Floor, The Hulkul, Lavelle Road,",
                "addressLocality" => "bengaluru",
                "postalCode" => "560001",
                "addressCountry" => "IN"
            ],
            "geo" => [
                "@type" => "GeoCoordinates",
                "latitude" => 12.9681327,
                "longitude" => 77.5967302
            ],
            "sameAs" => [
                "https://www.facebook.com/profile.php?id=61569376468425",
                "https://www.instagram.com/atha_construction/",
                "https://www.linkedin.com/company/athaconstruction.in/"
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    @endphp
    </script>

    {{-- Google Fonts - Montserrat & Tenor Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Tenor+Sans&display=swap" rel="stylesheet">
    
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('images/Favicon.png') }}" type="image/x-icon">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    {{-- Tailwind CSS via Vite --}}
    @vite('resources/css/app.css')

    {{-- Custom Styles --}}
    <style>
        /* Base Typography */
        body {
            font-family: "Montserrat", sans-serif;
            font-weight: 400;
            font-style: normal;
            overflow-x: hidden;
        }

        /* Tenor Sans for headings */
        .font-tenor {
            font-family: "Tenor Sans", sans-serif;
        }

        /* Scroll Progress Bar */
        .header-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(to right, #000, #333);
            width: 0%;
            z-index: 101;
            transition: width 0.1s ease;
        }

        /* Navigation underline animation */
        .nav-link-animated {
            position: relative;
        }
        
        .nav-link-animated::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #000;
            transition: width 0.3s ease;
        }
        
        .nav-link-animated:hover::after,
        .nav-link-animated.active::after {
            width: 100%;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom animations */
        @keyframes fadeInLeft {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            0% {
                opacity: 0;
                transform: translateX(20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-left {
            animation: fadeInLeft 0.5s ease-out forwards;
        }

        .animate-fade-in-right {
            animation: fadeInRight 0.5s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }

    </style>

    {{ $head }}
</head>

<body class="bg-white text-black antialiased">
    {{-- Scroll Progress Bar --}}
    <div class="header-progress" id="scrollProgress"></div>

    {{-- Global Header (exclude welcome hero) --}}
    @unless(request()->routeIs('home'))
        <x-header-white />
    @endunless

    {{-- Google Tag Manager (noscript) --}}
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJ9ZQFZG"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer Component --}}
    <x-footer />

    {{-- Alpine.js Plugins --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Alpine.js Core --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Custom Scripts --}}
    <script>
        // Scroll Progress Bar
        (function() {
            const progressBar = document.getElementById('scrollProgress');
            if (!progressBar) return;

            function updateProgress() {
                const scrollY = window.scrollY || window.pageYOffset;
                const windowHeight = window.innerHeight;
                const documentHeight = document.documentElement.scrollHeight;
                const scrollableHeight = documentHeight - windowHeight;

                if (scrollableHeight > 0) {
                    const scrollPercentage = (scrollY / scrollableHeight) * 100;
                    progressBar.style.width = Math.min(scrollPercentage, 100) + '%';
                }
            }

            window.addEventListener('scroll', updateProgress);
            updateProgress();
        })();

        // Intersection Observer for animations
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                root: null,
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
    <script>
        // Reusable Alpine counter for stat blocks
        document.addEventListener('alpine:init', () => {
            Alpine.data('statCounter', ({ target = 0, suffix = '' } = {}) => {
                const finalTarget = Number(target) || 0;

                return {
                    displayValue: `0${suffix}`,
                    started: false,
                    duration: 1500,
                    init() {
                        this.displayValue = `${this.formatValue(0)}${suffix}`;
                    },
                    start() {
                        if (this.started) return;
                        this.started = true;

                        if (finalTarget === 0) {
                            this.displayValue = `${this.formatValue(0)}${suffix}`;
                            return;
                        }

                        const startTime = performance.now();
                        const animate = (now) => {
                            const progress = Math.min((now - startTime) / this.duration, 1);
                            const currentValue = finalTarget * progress;
                            this.displayValue = `${this.formatValue(currentValue)}${suffix}`;

                            if (progress < 1) {
                                requestAnimationFrame(animate);
                            } else {
                                this.displayValue = `${this.formatValue(finalTarget)}${suffix}`;
                            }
                        };

                        requestAnimationFrame(animate);
                    },
                    formatValue(value) {
                        if (!Number.isInteger(finalTarget)) {
                            return value.toFixed(1).replace(/\.0$/, '');
                        }

                        const rounded = Math.round(value);
                        if (finalTarget >= 1000) {
                            return rounded.toLocaleString();
                        }

                        return rounded;
                    },
                };
            });

            // About Section Counter - Steps through 0, 0.5, 1, 1.5, 2
            Alpine.data('aboutCounter', ({ target = 2, suffix = 'M+' } = {}) => {
                const steps = [0, 0.5, 1, 1.5, 2];
                const finalTarget = Number(target) || 2;

                return {
                    displayValue: `0${suffix}`,
                    started: false,
                    currentStep: 0,
                    stepDelay: 300, // Delay between each step in milliseconds
                    init() {
                        this.displayValue = `0${suffix}`;
                    },
                    start() {
                        if (this.started) return;
                        this.started = true;

                        // Filter steps up to the target value
                        const targetSteps = steps.filter(step => step <= finalTarget);
                        
                        if (targetSteps.length === 0) {
                            this.displayValue = `0${suffix}`;
                            return;
                        }

                        // Animate through each step
                        targetSteps.forEach((step, index) => {
                            setTimeout(() => {
                                this.displayValue = `${step}${suffix}`;
                            }, index * this.stepDelay);
                        });
                    },
                };
            });
        });
    </script>

    {{ $scripts }}
</body>

</html>
