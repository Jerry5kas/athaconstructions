Perfect — here is your **FINAL, CLEAN, MINIMAL & PRODUCTION-READY** schema and module plan for the Atha Constructions "Projects / Properties" system.

This is exactly sized for:

* Showcasing ongoing & completed projects
* Providing specs, images, floor plans
* Keeping things simple for the admin
* Still keeping high professionalism

No unnecessary complexity.
No heavy modules.
Just **6 essential tables + 3 optional tables**.

---

# ✅ **FINAL PROPERTY MODULE — SCHEMA + PLAN**

# -----------------------------------------------------

# 🧱 **1. PROPERTIES (Main Table) — REQUIRED**

# -----------------------------------------------------

Holds the main information about each project.

### **Table: properties**

| Field             | Type               | Description                           |
| ----------------- | ------------------ | ------------------------------------- |
| id                | BIGINT             | PK                                    |
| title             | STRING             | Project Name                          |
| slug              | STRING             | SEO URL                               |
| project_type      | ENUM               | apartment / villa / plot / commercial |
| status            | ENUM               | upcoming / ongoing / completed        |
| rera_number       | STRING (nullable)  | Optional here                         |
| short_description | TEXT               | Summary paragraph                     |
| description       | LONGTEXT           | Full project details                  |
| launch_date       | DATE (nullable)    | If applicable                         |
| possession_date   | DATE (nullable)    | Completion estimate                   |
| total_land_area   | STRING             | Ex: “3 Acres 20 Guntas”               |
| total_units       | INTEGER (nullable) | Optional                              |
| floors            | INTEGER (nullable) |                                       |
| featured_image    | STRING             | Banner                                |
| brochure_url      | STRING (nullable)  | PDF Link                              |
| video_url         | STRING (nullable)  | Walkthrough                           |
| meta_title        | STRING (nullable)  | SEO                                   |
| meta_description  | TEXT (nullable)    | SEO                                   |
| created_at        | timestamp          |                                       |
| updated_at        | timestamp          |                                       |

---

# -----------------------------------------------------

# 📍 **2. PROPERTY LOCATION — REQUIRED**

# -----------------------------------------------------

Simple location data.

### **Table: property_locations**

| Field       | Type              |
| ----------- | ----------------- |
| id          | BIGINT            |
| property_id | BIGINT            |
| address     | TEXT              |
| city        | STRING            |
| locality    | STRING            |
| landmark    | STRING (nullable) |
| latitude    | STRING (nullable) |
| longitude   | STRING (nullable) |
| pincode     | STRING            |

---

# -----------------------------------------------------

# 🏘️ **3. PROPERTY UNITS (BHK Types) — REQUIRED**

# -----------------------------------------------------

Minimal version (no prices).
Used only to show available configurations.

### **Table: property_units**

| Field              | Type              |               |
| ------------------ | ----------------- | ------------- |
| id                 | BIGINT            |               |
| property_id        | BIGINT            |               |
| bhk                | INTEGER           | 1 / 2 / 3 / 4 |
| carpet_area        | FLOAT (nullable)  |               |
| builtup_area       | FLOAT (nullable)  |               |
| super_builtup_area | FLOAT (nullable)  |               |
| floor_plan_image   | STRING (nullable) |               |

---

# -----------------------------------------------------

# 🧱 **4. AMENITIES — REQUIRED**

# -----------------------------------------------------

### **Table: amenities**

Global amenities for all projects.

| id | name |

Examples: Gym, Swimming Pool, Security, Power Backup.

### **Table: property_amenities**

| property_id | amenity_id |

---

# -----------------------------------------------------

# 📸 **5. GALLERY — REQUIRED**

# -----------------------------------------------------

### **Table: property_gallery**

| Field       | Type                                                       |
| ----------- | ---------------------------------------------------------- |
| id          | BIGINT                                                     |
| property_id | BIGINT                                                     |
| type        | ENUM(interior, exterior, amenities, floorplan, masterplan) |
| image_url   | STRING                                                     |

---

# -----------------------------------------------------

# 🧾 **6. SPECIFICATIONS — REQUIRED**

# -----------------------------------------------------

### **Table: property_specifications**

| Field       | Type     |                                    |
| ----------- | -------- | ---------------------------------- |
| id          | BIGINT   |                                    |
| property_id | BIGINT   |                                    |
| section     | STRING   | Example: Flooring, Doors & Windows |
| description | LONGTEXT |                                    |

---

# -----------------------------------------------------

# 🟡 OPTIONAL TABLES (Add ONLY if needed)

# -----------------------------------------------------

These 3 are **not required**, but useful if you want more depth.

---

## **7. Construction Updates (Optional)**

### **Table: property_construction_updates**

| Field       | Type    |
| ----------- | ------- |
| id          | BIGINT  |
| property_id | BIGINT  |
| month       | INTEGER |
| year        | INTEGER |
| status_text | TEXT    |
| image_url   | STRING  |

Use only for ongoing projects.

---

## **8. Documents / Approvals (Optional)**

### **Table: property_documents**

| Field       | Type                         |
| ----------- | ---------------------------- |
| id          | BIGINT                       |
| property_id | BIGINT                       |
| title       | STRING                       |
| file_url    | STRING                       |
| doc_type    | STRING (ex: RERA, EC, Khata) |

---

## **9. Nearby / Connectivity (Optional)**

### **Table: property_nearby**

| Field       | Type   |                                  |
| ----------- | ------ | -------------------------------- |
| id          | BIGINT |                                  |
| property_id | BIGINT |                                  |
| type        | STRING | school / hospital / mall / metro |
| name        | STRING |                                  |
| distance    | STRING |                                  |
| time        | STRING |                                  |

---

# 🎉 FINAL SUMMARY

## **ONLY 6 TABLES ARE REQUIRED**

For Atha Construction’s portfolio site:

### ✔ properties

### ✔ property_locations

### ✔ property_units

### ✔ amenities

### ✔ property_amenities

### ✔ property_gallery

### ✔ property_specifications

That is **lean, clean, efficient, and very professional**.

## Optional Add-ons (only if future needs demand):

* Construction Updates
* Documents
* Nearby Connectivity

This structure is **perfect for corporate construction companies**.

---

# 📌 If you'd like next:

### 👉 Generate Laravel Migrations

### 👉 Generate ER Diagram

### 👉 Generate Admin CRUD Pages

### 👉 Generate Frontend Page Layout (Hero → Gallery → Specs → Floorplans)

Just tell me what to generate next.
