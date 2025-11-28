<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $seo = [
            'title' => 'Best Construction Company In Bangalore | Atha Construction',
            'description' => 'Explore Atha Construction, the best construction company in Bangalore. Expert builders delivering quality, innovation, and excellence in every project. Visit us',
            'keywords' => 'Construction Companies In Bangalore, Best Construction Company In Bangalore, residential construction companies in bangalore',
            'h1' => 'Construction Company In Bangalore Crafting Dreams, Building Legacies',
        ];

        $stats = [
            ['number' => '8+', 'label' => 'Years of Experience'],
            ['number' => '2M+', 'label' => 'Sq.Ft Developed'],
            ['number' => '500+', 'label' => 'Completed Projects'],
        ];

        $services = [
            [
                'icon' => 'p1.png',
                'title' => 'Turnkey Construction',
                'description' => 'Comprehensive construction services from start to finish, ensuring hassle-free project delivery. From site preparation to final handover, we promise smooth execution with attention to detail, quality, and timelines, making your dream home a seamless reality.',
            ],
            [
                'icon' => 'p2.png',
                'title' => 'Architecture & Design',
                'description' => 'Crafting exclusive designs with precision, including 2D, 3D, and GFC plans. Our designs blend your vision, Vastu principles, and functionality to create spaces that are both aesthetically pleasing and perfectly suited to your needs.',
            ],
            [
                'icon' => 'p3.png',
                'title' => 'Project Management',
                'description' => 'Expert project management services ensure timely approvals, meticulous quality control, and efficient timelines. We handle every detail with professionalism, so you can enjoy a stress-free construction experience with seamless coordination and superior results.',
            ],
            [
                'icon' => 'p4.png',
                'title' => 'Interior Design & Finishing',
                'description' => 'Transform your home with elegant interiors, including modular kitchens, custom wardrobes, and optimized layouts. Our tailored designs combine functionality with style to make every corner of your space both beautiful and practical.',
            ],
            [
                'icon' => 'p5.png',
                'title' => 'Premium Materials and Craftsmanship',
                'description' => 'We use trusted brands like UltraTech Cement, JSW Steel, and Asian Paints to guarantee lasting quality. Our commitment to superior materials and expert craftsmanship ensures a durable and elegant finish for every project.',
            ],
            [
                'icon' => 'p6.png',
                'title' => 'Extra Features',
                'description' => 'Elevate your home with seismic-resistant structures, future expansion readiness, and luxurious interiors on request. Our thoughtful additions prioritize safety, flexibility, and elegance, ensuring your home is prepared for tomorrow\'s needs.',
            ],
            [
                'icon' => 'p7.png',
                'title' => 'Home Automation',
                'description' => 'Incorporate cutting-edge smart systems and IoT integration into your home. Experience modern living with advanced automation, enabling seamless control of lighting, security, and appliances for unmatched convenience and efficiency.',
            ],
            [
                'icon' => 'p8.png',
                'title' => 'Amenities',
                'description' => 'Personalize your property with custom amenities like high-speed Wi-Fi, landscaped gardens, and recreational spaces. We design features that enhance your lifestyle, creating a perfect balance of comfort, functionality, and leisure.',
            ],
        ];

        $athaAdvantages = [
            'Top Quality Assurance with QASCON',
            'Regular Project Updates',
            'Zero Cost Overruns',
            'Price Locking for Stability',
            'Guaranteed On-Time Delivery',
        ];

        $otherContractors = [
            'No Money Safety & High Financial Risk',
            'Inadequate Quality Control',
            'No proper update, Frequent Site Visits Required',
            'Escalating Costs',
            'No Assurance of Timely Delivery',
        ];

        $howItWorks = [
            [
                'step' => 'A',
                'title' => 'Initial Consultation',
                'description' => 'Site survey, client requirement assessment, and project scoping.',
                'image' => 'a.jpg',
            ],
            [
                'step' => 'B',
                'title' => 'Design & Planning',
                'description' => 'Development of floor plans, elevations, and interior design concepts with client feedback incorporated.',
                'image' => 'b.jpg',
            ],
            [
                'step' => 'C',
                'title' => 'Material Selection',
                'description' => 'Option to choose from curated lookbooks or visit showrooms with architect guidance.',
                'image' => 'c.jpg',
            ],
            [
                'step' => 'D',
                'title' => 'Execution',
                'description' => 'Detailed construction process including foundation, waterproofing, MEP (Mechanical, Electrical, Plumbing), and anti-termite treatment.',
                'image' => 'd.jpg',
            ],
            [
                'step' => 'E',
                'title' => 'Final inspections, approvals',
                'description' => 'Check all the inspection checklist and get approval from site engineers as well as client.',
                'image' => 'e.jpg',
            ],
            [
                'step' => 'F',
                'title' => 'Handover',
                'description' => 'Client walkthroughs for a smooth transition to occupancy.',
                'image' => 'f.jpg',
            ],
        ];

        $faqs = [
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
            [
                'question' => 'Can I make changes to the project once construction has started?',
                'answer' => 'Yes, but changes may impact the timeline and cost. We\'ll discuss any adjustments and ensure you\'re informed before proceeding.',
            ],
            [
                'question' => 'Do you handle all permits and approvals?',
                'answer' => 'Yes, we handle all necessary permits and approvals to ensure your project complies with local building codes and regulations.',
            ],
            [
                'question' => 'How do you ensure the quality of your work?',
                'answer' => 'We use premium materials, hire skilled professionals, and adhere to strict quality control measures throughout the project.',
            ],
        ];

        return view('welcome', compact(
            'seo',
            'stats',
            'services',
            'athaAdvantages',
            'otherContractors',
            'howItWorks',
            'faqs'
        ));
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        $seo = [
            'title' => 'About Us | Atha Construction - Best Builders in Bangalore',
            'description' => 'Learn about Atha Construction, a trusted construction company in Bangalore with 8+ years of experience building quality residential and commercial projects.',
            'keywords' => 'about atha construction, construction company bangalore, best builders bangalore',
        ];

        return view('about', compact('seo'));
    }

    /**
     * Display the packages page.
     */
    public function packages()
    {
        $seo = [
            'title' => 'Construction Packages | Atha Construction Bangalore',
            'description' => 'Explore our construction packages for residential and commercial projects. Affordable and transparent pricing with quality assurance.',
            'keywords' => 'construction packages bangalore, home construction cost, building packages',
        ];

        return view('packages', compact('seo'));
    }

    /**
     * Display the properties page.
     */
    public function properties()
    {
        $seo = [
            'title' => 'Our Properties | Atha Construction Projects',
            'description' => 'View our completed and ongoing construction projects in Bangalore, Mysore, and Ballari.',
            'keywords' => 'construction projects bangalore, completed projects, property showcase',
        ];

        return view('properties', compact('seo'));
    }

    /**
     * Display the careers page.
     */
    public function careers()
    {
        $seo = [
            'title' => 'Careers | Join Atha Construction Team',
            'description' => 'Join our team of construction experts. Explore career opportunities at Atha Construction.',
            'keywords' => 'construction jobs bangalore, careers in construction, atha construction jobs',
        ];

        return view('careers', compact('seo'));
    }

    /**
     * Display the blogs listing page.
     */
    public function blogs()
    {
        $seo = [
            'title' => 'Construction Blog | Atha Construction Insights',
            'description' => 'Read our latest articles on construction trends, home building tips, and industry insights.',
            'keywords' => 'construction blog, building tips, home construction guide',
        ];

        return view('blogs', compact('seo'));
    }

    /**
     * Display the gallery page.
     */
    public function gallery()
    {
        $seo = [
            'title' => 'Project Gallery | Atha Construction Portfolio',
            'description' => 'Browse our project gallery showcasing completed residential and commercial constructions.',
            'keywords' => 'construction gallery, project photos, building portfolio',
        ];

        return view('gallery', compact('seo'));
    }

    /**
     * Display the services page.
     */
    public function services()
    {
        $seo = [
            'title' => 'Our Services | Atha Construction Bangalore',
            'description' => 'Comprehensive construction services including turnkey construction, architecture, interior design, and project management.',
            'keywords' => 'construction services bangalore, home construction services, building services',
        ];

        return view('services', compact('seo'));
    }

    /**
     * Display the cost estimation page.
     */
    public function costEstimation()
    {
        $seo = [
            'title' => 'Cost Estimation | Atha Construction Calculator',
            'description' => 'Get a free construction cost estimate for your project. Transparent pricing with no hidden costs.',
            'keywords' => 'construction cost calculator, building cost estimate, home construction cost',
        ];

        return view('cost-estimation', compact('seo'));
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        $seo = [
            'title' => 'Contact Us | Atha Construction Bangalore',
            'description' => 'Get in touch with Atha Construction for your construction needs. Visit our offices in Bangalore, Mysore, or Ballari.',
            'keywords' => 'contact atha construction, construction company contact, builders contact bangalore',
        ];

        return view('contact', compact('seo'));
    }

    /**
     * Handle contact form submission.
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'type' => 'nullable|string|max:50',
            'plotsize' => 'nullable|string|max:50',
            'message' => 'nullable|string|max:1000',
        ]);

        // TODO: Save to database and send email notification
        // Contact::create($validated);
        // Mail::to('info@athaconstruction.in')->send(new ContactFormMail($validated));

        return response()->json(['status' => 'OK', 'message' => 'Thank you! We will contact you soon.']);
    }
}

