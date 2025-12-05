# 🏗️ Properties Module - Implementation Plan

## 📋 Overview

This document outlines the complete implementation plan for the **Properties Module** for Atha Construction website. The module will showcase ongoing and completed construction projects with specifications, images, floor plans, and amenities.

**Framework:** Laravel 12  
**Database:** MySQL  
**Image Storage:** ImageKit (CDN)  
**Frontend:** Blade Templates + Tailwind CSS + Alpine.js

---

## ✅ Required Tables (6 Core Tables)

Based on `Final_properies.md`, we will implement **ONLY the required tables**:

1. ✅ `properties` - Main property/project information
2. ✅ `property_locations` - Location data (one-to-one relationship)
3. ✅ `property_units` - BHK types and floor plans (one-to-many)
4. ✅ `amenities` - Global amenities master table
5. ✅ `property_amenities` - Pivot table (many-to-many)
6. ✅ `property_gallery` - Image gallery (one-to-many)
7. ✅ `property_specifications` - Technical specifications (one-to-many)

**Note:** Optional tables (construction updates, documents, nearby) are **NOT included** in this plan.

---

## 🗄️ Database Schema

### 1. Properties Table

**Migration:** `YYYY_MM_DD_HHMMSS_create_properties_table.php`

```php
Schema::create('properties', function (Blueprint $table) {
    $table->id();
    $table->string('title')->index();
    $table->string('slug')->unique()->index();
    $table->enum('project_type', ['apartment', 'villa', 'plot', 'commercial'])->index();
    $table->enum('status', ['upcoming', 'ongoing', 'completed'])->default('upcoming')->index();
    $table->string('rera_number')->nullable();
    $table->text('short_description')->nullable();
    $table->longText('description')->nullable();
    $table->date('launch_date')->nullable();
    $table->date('possession_date')->nullable();
    $table->string('total_land_area')->nullable(); // e.g., "3 Acres 20 Guntas"
    $table->integer('total_units')->nullable();
    $table->integer('floors')->nullable();
    $table->string('featured_image')->nullable(); // ImageKit URL
    $table->string('featured_image_file_id')->nullable(); // ImageKit file ID
    $table->string('brochure_url')->nullable(); // PDF link
    $table->string('video_url')->nullable(); // Walkthrough video
    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();
    $table->timestamps();
    
    // Composite indexes for common queries
    $table->index(['status', 'project_type']);
    $table->index(['status', 'created_at']);
});
```

### 2. Property Locations Table

**Migration:** `YYYY_MM_DD_HHMMSS_create_property_locations_table.php`

```php
Schema::create('property_locations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->text('address');
    $table->string('city')->index();
    $table->string('locality')->nullable();
    $table->string('landmark')->nullable();
    $table->string('latitude')->nullable();
    $table->string('longitude')->nullable();
    $table->string('pincode')->nullable();
    $table->timestamps();
    
    $table->unique('property_id'); // One location per property
});
```

### 3. Property Units Table

**Migration:** `YYYY_MM_DD_HHMMSS_create_property_units_table.php`

```php
Schema::create('property_units', function (Blueprint $table) {
    $table->id();
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->integer('bhk')->index(); // 1, 2, 3, 4
    $table->float('carpet_area')->nullable();
    $table->float('builtup_area')->nullable();
    $table->float('super_builtup_area')->nullable();
    $table->string('floor_plan_image')->nullable(); // ImageKit URL
    $table->string('floor_plan_image_file_id')->nullable(); // ImageKit file ID
    $table->timestamps();
    
    $table->index(['property_id', 'bhk']);
});
```

### 4. Amenities Table

**Migration:** `YYYY_MM_DD_HHMMSS_create_amenities_table.php`

```php
Schema::create('amenities', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique();
    $table->string('icon')->nullable(); // Icon class or image path
    $table->integer('sort_order')->default(0)->index();
    $table->boolean('is_active')->default(true)->index();
    $table->timestamps();
    
    $table->index(['is_active', 'sort_order']);
});
```

### 5. Property Amenities Pivot Table

**Migration:** `YYYY_MM_DD_HHMMSS_create_property_amenities_table.php`

```php
Schema::create('property_amenities', function (Blueprint $table) {
    $table->id();
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->foreignId('amenity_id')->constrained()->onDelete('cascade');
    $table->timestamps();
    
    $table->unique(['property_id', 'amenity_id']); // Prevent duplicates
    $table->index('property_id');
    $table->index('amenity_id');
});
```

### 6. Property Gallery Table

**Migration:** `YYYY_MM_DD_HHMMSS_create_property_gallery_table.php`

```php
Schema::create('property_gallery', function (Blueprint $table) {
    $table->id();
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->enum('type', ['interior', 'exterior', 'amenities', 'floorplan', 'masterplan'])->index();
    $table->string('image_url'); // ImageKit URL
    $table->string('image_file_id')->nullable(); // ImageKit file ID
    $table->integer('sort_order')->default(0)->index();
    $table->timestamps();
    
    $table->index(['property_id', 'type']);
    $table->index(['property_id', 'sort_order']);
});
```

### 7. Property Specifications Table

**Migration:** `YYYY_MM_DD_HHMMSS_create_property_specifications_table.php`

```php
Schema::create('property_specifications', function (Blueprint $table) {
    $table->id();
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->string('section'); // e.g., "Flooring", "Doors & Windows"
    $table->longText('description');
    $table->integer('sort_order')->default(0)->index();
    $table->timestamps();
    
    $table->index(['property_id', 'sort_order']);
});
```

---

## 📦 Models Structure

### Model: Property

**File:** `app/Models/Property.php`

**Relationships:**
- `hasOne(PropertyLocation::class)` - Location
- `hasMany(PropertyUnit::class)` - Units/BHK types
- `belongsToMany(Amenity::class, 'property_amenities')` - Amenities
- `hasMany(PropertyGallery::class)` - Gallery images
- `hasMany(PropertySpecification::class)` - Specifications

**Features:**
- Auto-generate slug from title
- ImageKit image URL accessor (like `Service` model)
- Scopes: `upcoming()`, `ongoing()`, `completed()`, `byType($type)`
- SEO meta fields support

### Model: PropertyLocation

**File:** `app/Models/PropertyLocation.php`

**Relationships:**
- `belongsTo(Property::class)`

### Model: PropertyUnit

**File:** `app/Models/PropertyUnit.php`

**Relationships:**
- `belongsTo(Property::class)`

**Features:**
- ImageKit image URL accessor for floor plan

### Model: Amenity

**File:** `app/Models/Amenity.php`

**Relationships:**
- `belongsToMany(Property::class, 'property_amenities')`

**Features:**
- Scopes: `active()`, `ordered()`

### Model: PropertyGallery

**File:** `app/Models/PropertyGallery.php`

**Relationships:**
- `belongsTo(Property::class)`

**Features:**
- ImageKit image URL accessor
- Scopes: `byType($type)`, `ordered()`

### Model: PropertySpecification

**File:** `app/Models/PropertySpecification.php`

**Relationships:**
- `belongsTo(Property::class)`

**Features:**
- Scope: `ordered()`

---

## 🎛️ Admin Controllers

### Controller: PropertyController

**File:** `app/Http/Controllers/Admin/PropertyController.php`

**Methods:**
- `index()` - List all properties with filters (status, type)
- `create()` - Show create form
- `store()` - Store new property with all related data
- `edit($id)` - Show edit form with all related data
- `update($id)` - Update property and related data
- `destroy($id)` - Delete property (cascade deletes related records)

**Features:**
- ImageKit integration for featured image and gallery
- Handle location, units, amenities, gallery, specifications in one form
- Validation for all fields
- Slug auto-generation

### Controller: AmenityController

**File:** `app/Http/Controllers/Admin/AmenityController.php`

**Methods:**
- Standard CRUD operations
- Manage global amenities list

---

## 🎨 Admin Views

### Views Structure

```
resources/views/admin/properties/
├── index.blade.php          # List all properties
├── create.blade.php         # Create new property
├── edit.blade.php           # Edit property
└── _form.blade.php          # Shared form partial

resources/views/admin/amenities/
├── index.blade.php          # List all amenities
├── create.blade.php         # Create amenity
├── edit.blade.php           # Edit amenity
└── _form.blade.php          # Shared form partial
```

**Form Features:**
- Tabs or sections for: Basic Info, Location, Units, Amenities, Gallery, Specifications
- ImageKit upload integration (reuse existing upload component)
- Dynamic form fields for units (add/remove BHK types)
- Multi-select for amenities
- Image upload for gallery with type selection
- Dynamic sections for specifications

---

## 🌐 Frontend Routes

### Web Routes (`routes/web.php`)

```php
// Properties listing page
Route::get('/properties', [HomeController::class, 'properties'])->name('properties');

// Individual property detail page
Route::get('/properties/{slug}', [HomeController::class, 'propertyDetail'])->name('properties.show');
```

### Admin Routes (`routes/admin.php`)

```php
// Properties management
Route::resource('properties', PropertyController::class)->names('properties');

// Amenities management
Route::resource('amenities', AmenityController::class)->names('amenities');
```

---

## 🎨 Frontend Views

### Properties Listing Page

**File:** `resources/views/properties.blade.php`

**Features:**
- Filter by: Status (upcoming/ongoing/completed), Type (apartment/villa/plot/commercial)
- Grid/List view toggle
- Property cards showing:
  - Featured image
  - Title
  - Project type & status badge
  - Short description
  - Location (city)
  - Available BHK types
  - Key amenities (first 3-4)
  - "View Details" button
- Pagination

### Property Detail Page

**File:** `resources/views/property-detail.blade.php`

**Sections:**
1. **Hero Section** - Featured image/video, title, status badge, location
2. **Overview** - Short description, key stats (land area, units, floors)
3. **Gallery** - Filterable by type (interior/exterior/amenities/floorplan/masterplan)
4. **Available Units** - BHK types with floor plans
5. **Amenities** - Grid of amenities with icons
6. **Specifications** - Organized by section
7. **Location Map** - Google Maps integration (if lat/lng available)
8. **Brochure Download** - PDF link if available
9. **Video Walkthrough** - Embedded video if available
10. **Contact CTA** - Enquiry form or contact button

---

## 🔄 Integration with Existing Features

### 1. ImageKit Service

**Reuse:** `app/Services/ImageKitService.php`

- Use for featured images, gallery images, floor plans
- Store both URL and file_id (like existing models)

### 2. Admin Layout

**Reuse:** `resources/views/components/admin/sidebar.blade.php`

- Add "Properties" menu item
- Add "Amenities" submenu under Properties

### 3. HomeController

**Update:** `app/Http/Controllers/HomeController.php`

- Update `properties()` method to fetch from database
- Add `propertyDetail($slug)` method

### 4. Dashboard Stats

**Update:** `app/Http/Controllers/Admin/DashboardController.php`

- Add property counts by status
- Add total properties count

---

## 📝 Implementation Steps

### Phase 1: Database Setup
1. ✅ Create 7 migration files
2. ✅ Run migrations
3. ✅ Create model files with relationships
4. ✅ Add model accessors and scopes

### Phase 2: Admin Backend
5. ✅ Create `PropertyController` with CRUD
6. ✅ Create `AmenityController` with CRUD
7. ✅ Create admin views (index, create, edit)
8. ✅ Integrate ImageKit upload
9. ✅ Add routes to `admin.php`

### Phase 3: Frontend
10. ✅ Update `HomeController` methods
11. ✅ Create properties listing page
12. ✅ Create property detail page
13. ✅ Add routes to `web.php`
14. ✅ Style with Tailwind CSS

### Phase 4: Testing & Polish
15. ✅ Test admin CRUD operations
16. ✅ Test frontend display
17. ✅ Test image uploads
18. ✅ Test relationships and cascades
19. ✅ SEO optimization
20. ✅ Responsive design check

---

## 🎯 Key Patterns to Follow

### 1. Model Pattern (Like `Service` model)
- Auto-generate slugs
- ImageKit URL accessors
- Scopes for filtering
- Indexed columns for performance

### 2. Controller Pattern (Like `ServiceController`)
- ImageKit service injection
- Validation
- Pagination (15 items per page)
- Flash messages

### 3. Migration Pattern
- Timestamp format: `YYYY_MM_DD_HHMMSS`
- Foreign keys with cascade delete
- Indexes for performance
- Composite indexes for common queries

### 4. View Pattern
- Reuse admin layout components
- Tailwind CSS for styling
- Alpine.js for interactivity
- ImageKit upload component

---

## 📊 Database Relationships Summary

```
Property (1) ──→ (1) PropertyLocation
Property (1) ──→ (N) PropertyUnit
Property (1) ──→ (N) PropertyGallery
Property (1) ──→ (N) PropertySpecification
Property (N) ──→ (N) Amenity (via property_amenities)
```

---

## 🔐 Validation Rules

### Property Store/Update
- `title`: required, string, max:255
- `slug`: nullable, unique, max:255
- `project_type`: required, in:apartment,villa,plot,commercial
- `status`: required, in:upcoming,ongoing,completed
- `short_description`: nullable, text
- `description`: nullable, longText
- `featured_image`: nullable, image, max:5120 (5MB)
- `brochure_url`: nullable, url
- `video_url`: nullable, url

### PropertyLocation
- `address`: required, text
- `city`: required, string, max:100
- `pincode`: nullable, string, max:10

### PropertyUnit
- `bhk`: required, integer, min:1, max:10
- `carpet_area`: nullable, numeric, min:0
- `builtup_area`: nullable, numeric, min:0
- `super_builtup_area`: nullable, numeric, min:0

### Amenity
- `name`: required, string, max:255, unique

---

## 🚀 Next Steps

After reviewing this plan:

1. **Approve the plan** - Review and confirm the approach
2. **Generate migrations** - Create all 7 migration files
3. **Generate models** - Create all model files with relationships
4. **Generate controllers** - Create admin controllers
5. **Generate views** - Create admin and frontend views
6. **Test implementation** - Run tests and verify functionality

---

## 📌 Notes

- **No optional tables** - Only implementing required 7 tables
- **ImageKit integration** - Following existing pattern from Service model
- **SEO support** - Meta title and description fields included
- **Cascade deletes** - All related records deleted when property is deleted
- **Performance** - Indexes added for common query patterns
- **Compatibility** - Follows existing codebase patterns and conventions

---

*Plan created: December 2025*  
*Status: Ready for Implementation*

