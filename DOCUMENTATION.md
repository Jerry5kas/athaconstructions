# Atha Construction - Project Documentation

## 📋 Project Overview

**Atha Construction** is a professional construction company website built for a leading residential and commercial construction firm based in Bangalore, Karnataka, India. Founded in 2016, Atha Construction specializes in turnkey construction services, delivering quality projects across Karnataka including Bengaluru, Mysuru, and Ballari.

### Company Highlights
- **8+ Years** of Industry Experience
- **2M+ Sq.Ft** Developed
- **500+** Completed Projects

---

## 🛠️ Technology Stack

### Backend
| Technology | Version | Purpose |
|------------|---------|---------|
| PHP | ^8.2 | Server-side runtime |
| Laravel | ^12.0 | Web application framework |
| Laravel Tinker | ^2.10.1 | REPL for Laravel |

### Frontend
| Technology | Version | Purpose |
|------------|---------|---------|
| Tailwind CSS | ^4.1.17 | Utility-first CSS framework |
| Vite | ^7.0.7 | Build tool and dev server |
| Alpine.js | Latest | Lightweight JavaScript framework |
| Bootstrap | 5.3.3 | UI components (legacy pages) |

### Development Tools
| Tool | Version | Purpose |
|------|---------|---------|
| Laravel Pint | ^1.24 | Code style fixer |
| Laravel Sail | ^1.41 | Docker development environment |
| PHPUnit | ^11.5.3 | Testing framework |
| Faker | ^1.23 | Test data generation |

---

## 📁 Project Structure

```
athaconstructions/
├── app/                          # Application core
│   ├── Http/Controllers/         # HTTP controllers
│   ├── Models/                   # Eloquent models
│   │   └── User.php
│   ├── Providers/                # Service providers
│   │   └── AppServiceProvider.php
│   └── View/                     # View components
│
├── backup/                       # Legacy PHP website (original)
│   ├── assetes/                  # Legacy assets
│   │   ├── images/               # Image assets
│   │   ├── img/                  # Additional images
│   │   └── styles/               # CSS styles
│   ├── index.php                 # Home page
│   ├── about.php                 # About page
│   ├── services.php              # Services page
│   ├── packages.php              # Packages/pricing page
│   ├── properties.php            # Properties listing
│   ├── contact.php               # Contact form
│   ├── careers.php               # Career opportunities
│   ├── blogs.php                 # Blog listing
│   ├── blog_detail.php           # Individual blog posts
│   ├── gallery.php               # Project gallery
│   ├── cost-estimation.php       # Cost calculator
│   ├── header.php                # Common header
│   ├── footer.php                # Common footer
│   └── functions.php             # Utility functions
│
├── bootstrap/                    # Laravel bootstrap files
│   ├── app.php
│   ├── cache/
│   └── providers.php
│
├── config/                       # Configuration files
│   ├── app.php                   # Application config
│   ├── auth.php                  # Authentication config
│   ├── cache.php                 # Cache config
│   ├── database.php              # Database config
│   ├── filesystems.php           # File storage config
│   ├── logging.php               # Logging config
│   ├── mail.php                  # Email config
│   ├── queue.php                 # Queue config
│   ├── services.php              # Third-party services
│   └── session.php               # Session config
│
├── database/                     # Database files
│   ├── factories/                # Model factories
│   ├── migrations/               # Database migrations
│   └── seeders/                  # Database seeders
│
├── public/                       # Publicly accessible files
│   ├── build/                    # Compiled assets
│   │   ├── assets/
│   │   └── manifest.json
│   ├── favicon.ico
│   ├── index.php                 # Application entry point
│   └── robots.txt
│
├── resources/                    # Frontend resources
│   ├── css/
│   │   └── app.css               # Main CSS (Tailwind)
│   ├── js/
│   │   ├── app.js                # Main JavaScript
│   │   └── bootstrap.js          # JS bootstrap
│   └── views/                    # Blade templates
│       ├── components/
│       │   ├── header.blade.php  # Header component
│       │   └── layouts.blade.php # Main layout
│       ├── about.php
│       └── welcome.blade.php     # Home page
│
├── routes/                       # Route definitions
│   ├── console.php               # Console routes
│   └── web.php                   # Web routes
│
├── storage/                      # Storage directory
│   ├── app/                      # Application storage
│   ├── framework/                # Framework cache
│   └── logs/                     # Application logs
│
├── tests/                        # Test files
│   ├── Feature/                  # Feature tests
│   ├── Unit/                     # Unit tests
│   └── TestCase.php
│
├── vendor/                       # Composer dependencies
├── node_modules/                 # NPM dependencies
├── composer.json                 # PHP dependencies
├── package.json                  # Node dependencies
├── vite.config.js                # Vite configuration
├── phpunit.xml                   # PHPUnit configuration
└── artisan                       # Laravel CLI tool
```

---

## 🌐 Website Pages & Features

### Main Pages

| Page | Route | Description |
|------|-------|-------------|
| **Home** | `/` | Landing page with hero section, services overview, project showcase, and company stats |
| **About** | `/about` | Company history, philosophy, mission/vision, USPs, and founder profiles |
| **Services** | `/services` | Detailed service offerings |
| **Packages** | `/packages` | Construction packages with pricing (Budget & Luxury) |
| **Properties** | `/properties` | Property listings and project portfolio |
| **Gallery** | `/gallery` | Visual showcase of completed projects |
| **Blogs** | `/blogs` | Company blog and industry insights |
| **Careers** | `/careers` | Job opportunities and career information |
| **Contact** | `/contact` | Contact form and company locations |
| **Cost Estimation** | `/cost-estimation` | Construction cost calculator |

### Key Features

#### 🏗️ Services Offered
1. **Turnkey Construction** - End-to-end project delivery
2. **Architecture & Design** - 2D, 3D, and GFC plans with Vastu compliance
3. **Project Management** - Approvals, quality control, timeline management
4. **Interior Design & Finishing** - Modular kitchens, wardrobes, layouts
5. **Premium Materials** - UltraTech Cement, JSW Steel, Asian Paints
6. **Extra Features** - Seismic-resistant structures, future expansion ready
7. **Home Automation** - Smart systems and IoT integration
8. **Amenities** - Custom features like Wi-Fi, gardens, recreational spaces

#### 📊 Interactive Elements
- **Hero Section** - Full-width banner with scroll animations
- **Process Wizard** - Step-by-step construction process visualization
- **Comparison Section** - "What makes us stand out" comparison chart
- **Testimonials Carousel** - Customer reviews slider (Owl Carousel)
- **FAQ Accordion** - Frequently asked questions
- **Package Popups** - Modal windows for package details
- **Contact Forms** - Lead capture forms with validation
- **Progress Bar** - Scroll progress indicator in header

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL/SQLite (optional, for database features)

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd athaconstructions
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup** (optional)
   ```bash
   php artisan migrate
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

### Development

Run the development server with hot-reloading:

```bash
# Using composer script (runs server, queue, and vite concurrently)
composer dev

# Or run individually:
php artisan serve        # Laravel server
npm run dev              # Vite dev server
```

### Production Build

```bash
npm run build
```

---

## 📍 Company Information

### Office Locations

**Bangalore (Headquarters)**
- Address: No.81/37, Ground Floor, The Hulkul, Lavelle Road, Bengaluru - 560001
- [Google Maps](https://maps.app.goo.gl/G8Ezuo2a8pbknSkk8)

**Ballari**
- Address: First Floor, PVR Plaza, No 7, 3rd Cross Rd, Nehru Colony, Sidiginamola, Ballari - 583103
- [Google Maps](https://maps.app.goo.gl/MdQ2gi2iPGKXQNn28)

**Mysore**
- Address: VIJAY ARCADE, #1714 Sarvodaya Road E&F Block, Ramkrishna Nagar (Kuvempu Nagar), Mysore - 570009

### Contact Information
- **Phone**: +91 8049776616, +91 9606956044
- **Email**: info@athaconstruction.in
- **Website**: https://athaconstruction.in

### Social Media
- [Facebook](https://www.facebook.com/profile.php?id=61569376468425)
- [Instagram](https://www.instagram.com/atha_construction/)
- [LinkedIn](https://www.linkedin.com/company/athaconstruction.in/)

---

## 👥 Leadership Team

| Name | Position | Description |
|------|----------|-------------|
| **Arun A R** | MD & CEO | Visionary leader with 10+ years in real estate development |
| **Lavanya G V** | COO | Technical expertise with artistic vision, focuses on client satisfaction |
| **Vijaykumar N** | VP | 40+ years experience, involved in global projects including Burj Khalifa |

---

## 🔧 Configuration

### Routes Configuration (`routes/web.php`)

```php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});
```

### Blade Components

**Main Layout** (`resources/views/components/layouts.blade.php`)
- Includes Tailwind CSS via Vite
- Bootstrap Icons CDN
- Alpine.js for interactivity
- Slot-based content injection

**Header Component** (`resources/views/components/header.blade.php`)
- Navigation menu
- Responsive mobile menu

---

## 📦 Package Scripts

### Composer Scripts
```json
{
  "setup": "Full project setup (install, env, migrate, build)",
  "dev": "Run development servers concurrently",
  "test": "Run PHPUnit tests"
}
```

### NPM Scripts
```json
{
  "dev": "Start Vite development server",
  "build": "Build production assets"
}
```

---

## 🔍 SEO Configuration

The website includes comprehensive SEO setup:

- **Meta tags** - Title, description, keywords per page
- **Canonical URLs** - Dynamic canonical link generation
- **Schema.org markup** - Organization, WebSite, HomeAndConstructionBusiness
- **Robots.txt** - Search engine directives
- **Sitemap.xml** - XML sitemap for crawlers
- **Google Analytics** - GA4 integration (G-GNYXP1XF3S)
- **Google Tag Manager** - GTM integration (GTM-NJ9ZQFZG)

---

## 📱 Responsive Design

The website is fully responsive with breakpoints:
- **Desktop**: Full layout with all features
- **Tablet**: Adjusted grid layouts
- **Mobile**: Hamburger navigation, stacked content

Uses Bootstrap 5 grid system for legacy pages and Tailwind CSS for new Laravel views.

---

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Or using PHPUnit directly
./vendor/bin/phpunit
```

---

## 📄 License

This project is proprietary software developed for Atha Construction.

---

## 📝 Notes

### Migration Status
The project is currently undergoing migration from a traditional PHP website (preserved in `/backup`) to a modern Laravel framework. The new Laravel version uses:
- Blade components for reusable UI
- Tailwind CSS for styling
- Vite for asset bundling
- Alpine.js for interactivity

### Legacy Backup
The original PHP website is preserved in the `/backup` directory for reference during the migration process. This includes all original pages, assets, and functionality.

---

*Documentation last updated: November 2025*

