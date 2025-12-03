<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\Service;
use App\Models\Blog;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Real-time stats from database / data sources
        $projectsTotal = Service::count(); // Treat active services as "projects" for now

        // Packages count derived from JSON config (z-packages-details/package_details.json)
        $packagesTotal = 0;
        $packageFile   = base_path('z-packages-details/package_details.json');

        if (file_exists($packageFile)) {
            $json = json_decode(file_get_contents($packageFile), true);
            if (is_array($json) && isset($json['Table2'][0]) && is_array($json['Table2'][0])) {
                $firstRow     = $json['Table2'][0];
                $packageKeys  = array_filter(array_keys($firstRow), fn ($key) => $key !== 'section');
                $packagesTotal = count($packageKeys);
            }
        }

        // Blog stats (for future dashboard use or additional cards)
        $blogsTotal       = Blog::count();
        $blogsPublished   = Blog::published()->count();
        $blogsTotalViews  = Blog::sum('views');

        // Leads / revenue are not yet persisted in DB – keep neutral placeholders
        $stats = [
            'projects_total'        => $projectsTotal,
            'projects_delta_label'  => $projectsTotal > 0 ? 'Live from Services' : 'No services yet',

            'packages_total'        => $packagesTotal,
            'packages_delta_label'  => $packagesTotal > 0 ? 'From packages JSON' : 'No packages configured',

            'leads_today'           => 0,
            'leads_delta_label'     => 'Tracking not yet connected',

            'revenue_month'         => '—',
            'revenue_delta_label'   => 'Pending integration',

            // Extra blog metrics (not yet surfaced in UI, but available if needed)
            'blogs_total'           => $blogsTotal,
            'blogs_published'       => $blogsPublished,
            'blogs_total_views'     => $blogsTotalViews,
        ];

        return view('admin.dashboard', [
            'pageTitle' => 'Dashboard',
            'stats'     => $stats,
        ]);
    }
}

