<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Placeholder example stats – replace with your real models/queries when available
        $stats = [
            'projects_total'        => 24,
            'projects_delta_label'  => '+3 new',
            'packages_total'        => 6,
            'packages_delta_label'  => '+1 updated',
            'leads_today'           => 58,
            'leads_delta_label'     => '+8 today',
            'revenue_month'         => '₹ 25.4L',
            'revenue_delta_label'   => '+12%',
        ];

        return view('admin.dashboard', [
            'pageTitle' => 'Dashboard',
            'stats'     => $stats,
        ]);
    }
}

