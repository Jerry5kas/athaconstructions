<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use Carbon\Carbon;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'title' => 'Excellent Home Construction Experience',
                'review_text' => 'We built our 3BHK home with Atha Construction last year, and the experience was outstanding. They completed the project exactly on time, used premium materials like UltraTech cement and JSW steel as promised. The site engineer was always available, and we received daily updates through their app. No hidden costs, everything was transparent from day one. Our family is extremely happy with the quality.',
                'rating' => 5,
                'client_name' => 'Rajesh Kumar',
                'project_location' => 'Bangalore',
                'project_type' => 'Residential',
                'featured' => true,
                'status' => 'published',
                'published_at' => Carbon::now()->subMonths(2),
            ],
            [
                'title' => 'Reliable Construction with Fixed Pricing',
                'review_text' => 'After comparing multiple contractors, we chose Atha Construction for our villa project in Mysore. Their fixed pricing model gave us peace of mind - no cost escalations during construction. The team was professional, the workmanship excellent, and they even helped us with Vastu compliance. The project was completed 2 weeks ahead of schedule. Highly recommend them to anyone looking for reliable construction.',
                'rating' => 5,
                'client_name' => 'Priya Reddy',
                'project_location' => 'Mysore',
                'project_type' => 'Residential',
                'featured' => true,
                'status' => 'published',
                'published_at' => Carbon::now()->subMonths(3),
            ],
            [
                'title' => 'Transparent and Quality Construction',
                'review_text' => 'Atha Construction built our dream home in Whitefield. What impressed us most was their transparency - they showed us all material bills, provided regular site photos, and kept us informed at every step. The quality of finishing is top-notch, especially the tiling and painting work. They used only branded materials as promised. The project manager was very responsive to all our queries. Worth every rupee spent.',
                'rating' => 5,
                'client_name' => 'Suresh Iyer',
                'project_location' => 'Bangalore',
                'project_type' => 'Residential',
                'featured' => true,
                'status' => 'published',
                'published_at' => Carbon::now()->subMonths(4),
            ],
            [
                'title' => 'Perfect Design and Timely Delivery',
                'review_text' => 'We had a great experience building our 4BHK with Atha Construction. Their design team understood our requirements perfectly and suggested practical modifications. The construction quality is excellent, and they maintained cleanliness at the site throughout. The best part was their commitment to timelines - they delivered exactly when they said they would. The after-sales support has also been good. Very satisfied with their service.',
                'rating' => 5,
                'client_name' => 'Anjali Menon',
                'project_location' => 'Bangalore',
                'project_type' => 'Residential',
                'featured' => true,
                'status' => 'published',
                'published_at' => Carbon::now()->subMonths(1),
            ],
            [
                'title' => 'Excellent Commercial Project Management',
                'review_text' => 'Atha Construction completed our commercial building project in Ballari. Their project management was excellent - they coordinated with all vendors, handled permits efficiently, and ensured quality at every stage. The team was professional, and communication was clear throughout. They completed the project within budget and on time. The building quality is solid, and we\'ve had no issues post-completion. Would definitely work with them again.',
                'rating' => 5,
                'client_name' => 'Vikram Shetty',
                'project_location' => 'Ballari',
                'project_type' => 'Commercial',
                'featured' => true,
                'status' => 'published',
                'published_at' => Carbon::now()->subMonths(5),
            ],
            [
                'title' => 'Fixed Pricing with Premium Quality',
                'review_text' => 'We chose Atha Construction based on a friend\'s recommendation, and we\'re so glad we did. They built our 2BHK home with attention to detail. The site engineer was always present, and we could see the quality of work firsthand. They used premium materials, and the finishing is beautiful. The best part was their fixed pricing - no surprises, no hidden charges. The project was completed on schedule, and we\'re very happy with our new home.',
                'rating' => 5,
                'client_name' => 'Meera Nair',
                'project_location' => 'Bangalore',
                'project_type' => 'Residential',
                'featured' => true,
                'status' => 'published',
                'published_at' => Carbon::now()->subMonths(6),
            ],
            [
                'title' => 'Professional Renovation Service',
                'review_text' => 'Atha Construction delivered exceptional service for our home renovation and extension project. They understood our vision, provided valuable suggestions, and executed everything perfectly. The team was respectful, punctual, and maintained site cleanliness. Quality of work is excellent, especially the electrical and plumbing installations. They completed the project on time and within the agreed budget. Highly professional and trustworthy team.',
                'rating' => 5,
                'client_name' => 'Karthik Rao',
                'project_location' => 'Bangalore',
                'project_type' => 'Renovation',
                'featured' => true,
                'status' => 'published',
                'published_at' => Carbon::now()->subMonths(2),
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}

