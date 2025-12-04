<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Package;
use App\Models\Contact;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Services are treated as \"projects\" in the current admin UI
        $projectsTotal = Service::count();

        // Packages from database (active + total)
        $packagesTotal      = Package::count();
        $packagesActive     = Package::where('is_active', true)->count();

        // Leads from contacts table
        $today      = now()->toDateString();
        $startMonth = now()->startOfMonth();
        $endMonth   = now()->endOfMonth();

        $leadsToday      = Contact::whereDate('created_at', $today)->count();
        $leadsThisMonth  = Contact::whereBetween('created_at', [$startMonth, $endMonth])->count();
        $leadsTotal      = Contact::count();

        // Blog stats (for potential future cards / analytics)
        $blogsTotal      = Blog::count();
        $blogsPublished  = Blog::published()->count();
        $blogsTotalViews = Blog::sum('views');

        $stats = [
            // Projects / services
            'projects_total'       => $projectsTotal,
            'projects_delta_label' => $projectsTotal > 0
                ? $projectsTotal . ' services in system'
                : 'No services yet',

            // Packages
            'packages_total'       => $packagesTotal,
            'packages_delta_label' => $packagesActive . ' active packages',

            // Leads
            'leads_today'          => $leadsToday,
            'leads_delta_label'    => $leadsThisMonth . ' this month • ' . $leadsTotal . ' total',

            // Revenue card repurposed as high-level leads metric for now
            'revenue_month'        => $leadsThisMonth > 0
                ? $leadsThisMonth . ' leads'
                : 'No leads yet',
            'revenue_delta_label'  => $leadsToday > 0
                ? $leadsToday . ' today'
                : 'Awaiting new leads',

            // Extra blog metrics (not yet surfaced in UI, but available if needed)
            'blogs_total'          => $blogsTotal,
            'blogs_published'      => $blogsPublished,
            'blogs_total_views'    => $blogsTotalViews,
        ];

        return view('admin.dashboard', [
            'pageTitle' => 'Dashboard',
            'stats'     => $stats,
        ]);
    }
}

