<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share FAQs globally with all views
        View::share('faqs', [
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
        ]);
    }
}
