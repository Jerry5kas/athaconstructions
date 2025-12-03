@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    @keyframes pulse-glow {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
    .card-float {
        animation: float 6s ease-in-out infinite;
    }
    .card-float-delay-1 {
        animation-delay: 0.5s;
    }
    .card-float-delay-2 {
        animation-delay: 1s;
    }
    .card-float-delay-3 {
        animation-delay: 1.5s;
    }
    .icon-pulse {
        animation: pulse-glow 2s ease-in-out infinite;
    }
</style>
@endpush

@section('content')
<!-- Dashboard Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mb-8">
    
    <!-- Card 1: Projects -->
    <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
        <!-- Decorative gradient overlay -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-50 to-transparent rounded-bl-full opacity-50 group-hover:opacity-75 transition-opacity"></div>
        
        <!-- Content -->
        <div class="relative p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-semibold tracking-wider uppercase rounded-lg bg-blue-50 text-blue-700 border border-blue-100">
                            Projects
                        </span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 mb-1">Total Projects</h3>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-3xl font-bold text-gray-900 font-tenor">
                            {{ $stats['projects_total'] ?? 24 }}
                        </p>
                    </div>
                    <div class="flex items-center gap-1.5 mt-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <span class="text-xs font-semibold text-emerald-600">
                            {{ $stats['projects_delta_label'] ?? '+3 new' }}
                        </span>
                    </div>
                </div>
                
                <!-- Icon -->
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl blur-md opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Progress indicator -->
            <div class="mt-4 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full" style="width: 75%"></div>
            </div>
        </div>
    </div>

    <!-- Card 2: Packages -->
    <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
        <!-- Decorative gradient overlay -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-50 to-transparent rounded-bl-full opacity-50 group-hover:opacity-75 transition-opacity"></div>
        
        <!-- Content -->
        <div class="relative p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-semibold tracking-wider uppercase rounded-lg bg-purple-50 text-purple-700 border border-purple-100">
                            Packages
                        </span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 mb-1">Active Packages</h3>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-3xl font-bold text-gray-900 font-tenor">
                            {{ $stats['packages_total'] ?? 6 }}
                        </p>
                    </div>
                    <div class="flex items-center gap-1.5 mt-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <span class="text-xs font-semibold text-emerald-600">
                            {{ $stats['packages_delta_label'] ?? '+1 updated' }}
                        </span>
                    </div>
                </div>
                
                <!-- Icon -->
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl blur-md opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative bg-gradient-to-br from-purple-500 to-purple-600 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Progress indicator -->
            <div class="mt-4 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-purple-500 to-purple-600 rounded-full" style="width: 60%"></div>
            </div>
        </div>
    </div>

    <!-- Card 3: Leads -->
    <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
        <!-- Decorative gradient overlay -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-50 to-transparent rounded-bl-full opacity-50 group-hover:opacity-75 transition-opacity"></div>
        
        <!-- Content -->
        <div class="relative p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-semibold tracking-wider uppercase rounded-lg bg-amber-50 text-amber-700 border border-amber-100">
                            Leads
                        </span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 mb-1">New Leads</h3>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-3xl font-bold text-gray-900 font-tenor">
                            {{ $stats['leads_today'] ?? 58 }}
                        </p>
                    </div>
                    <div class="flex items-center gap-1.5 mt-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <span class="text-xs font-semibold text-emerald-600">
                            {{ $stats['leads_delta_label'] ?? '+8 today' }}
                        </span>
                    </div>
                </div>
                
                <!-- Icon -->
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl blur-md opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative bg-gradient-to-br from-amber-500 to-amber-600 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Progress indicator -->
            <div class="mt-4 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-amber-500 to-amber-600 rounded-full" style="width: 85%"></div>
            </div>
        </div>
    </div>

    <!-- Card 4: Revenue -->
    <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
        <!-- Decorative gradient overlay -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-50 to-transparent rounded-bl-full opacity-50 group-hover:opacity-75 transition-opacity"></div>
        
        <!-- Content -->
        <div class="relative p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-semibold tracking-wider uppercase rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-100">
                            Revenue
                        </span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 mb-1">Monthly Revenue</h3>
                    <div class="flex items-baseline gap-2 mt-2">
                        <p class="text-3xl font-bold text-gray-900 font-tenor">
                            {{ $stats['revenue_month'] ?? '₹ 25.4L' }}
                        </p>
                    </div>
                    <div class="flex items-center gap-1.5 mt-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <span class="text-xs font-semibold text-emerald-600">
                            {{ $stats['revenue_delta_label'] ?? '+12%' }}
                        </span>
                    </div>
                </div>
                
                <!-- Icon -->
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl blur-md opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative bg-gradient-to-br from-emerald-500 to-emerald-600 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Progress indicator -->
            <div class="mt-4 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full" style="width: 92%"></div>
            </div>
        </div>
    </div>
</div>

@endsection

