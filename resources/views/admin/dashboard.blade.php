@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- row 1 -->
<div class="flex flex-wrap -mx-3">
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-center justify-between p-5 md:p-6">
                <div class="space-y-1">
                    <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-semibold tracking-[0.18em] uppercase rounded-full border border-slate-200 text-slate-500 bg-slate-50">
                                Projects
                            </span>
                    <p class="mb-0 text-sm font-semibold text-slate-800">Total Projects</p>
                    <div class="flex items-baseline gap-2">
                        <p class="mb-0 text-xl font-bold text-slate-900">
                            {{ $stats['projects_total'] ?? 24 }}
                        </p>
                        <span class="text-xs font-semibold text-lime-500">
                            {{ $stats['projects_delta_label'] ?? '+3 new' }}
                        </span>
                    </div>
                        </div>
                <div class="shrink-0">
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-slate-900 to-slate-800 text-white shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 7h18" />
                            <path d="M5 7V5h4v2" />
                            <path d="M10 7v12" />
                            <path d="M14 7v5" />
                            <path d="M19 7v8" />
                            <path d="M7 12h3" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-center justify-between p-5 md:p-6">
                <div class="space-y-1">
                    <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-semibold tracking-[0.18em] uppercase rounded-full border border-slate-200 text-slate-500 bg-slate-50">
                                Packages
                            </span>
                    <p class="mb-0 text-sm font-semibold text-slate-800">Active Packages</p>
                    <div class="flex items-baseline gap-2">
                        <p class="mb-0 text-xl font-bold text-slate-900">
                            {{ $stats['packages_total'] ?? 6 }}
                        </p>
                        <span class="text-xs font-semibold text-lime-500">
                            {{ $stats['packages_delta_label'] ?? '+1 updated' }}
                        </span>
                    </div>
                        </div>
                <div class="shrink-0">
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-slate-900 to-slate-800 text-white shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="7" height="7" rx="1" />
                            <rect x="14" y="4" width="7" height="7" rx="1" />
                            <rect x="3" y="13" width="7" height="7" rx="1" />
                            <rect x="14" y="13" width="7" height="7" rx="1" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card3 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-center justify-between p-5 md:p-6">
                <div class="space-y-1">
                    <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-semibold tracking-[0.18em] uppercase rounded-full border border-slate-200 text-slate-500 bg-slate-50">
                                Leads
                            </span>
                    <p class="mb-0 text-sm font-semibold text-slate-800">New Leads</p>
                    <div class="flex items-baseline gap-2">
                        <p class="mb-0 text-xl font-bold text-slate-900">
                            {{ $stats['leads_today'] ?? 58 }}
                        </p>
                        <span class="text-xs font-semibold text-lime-500">
                            {{ $stats['leads_delta_label'] ?? '+8 today' }}
                        </span>
                    </div>
                        </div>
                <div class="shrink-0">
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-slate-900 to-slate-800 text-white shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="3" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card4 -->
    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-center justify-between p-5 md:p-6">
                <div class="space-y-1">
                    <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-semibold tracking-[0.18em] uppercase rounded-full border border-slate-200 text-slate-500 bg-slate-50">
                                Revenue
                            </span>
                    <p class="mb-0 text-sm font-semibold text-slate-800">Monthly Revenue</p>
                    <div class="flex items-baseline gap-2">
                        <p class="mb-0 text-xl font-bold text-slate-900">
                            {{ $stats['revenue_month'] ?? '₹ 25.4L' }}
                        </p>
                        <span class="text-xs font-semibold text-lime-500">
                            {{ $stats['revenue_delta_label'] ?? '+12%' }}
                        </span>
                    </div>
                        </div>
                <div class="shrink-0">
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-slate-900 to-slate-800 text-white shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 8c-1.1 0-2-.67-2-1.5S10.9 5 12 5s2 .67 2 1.5S13.1 8 12 8Zm0 0v8" />
                            <path d="M8 14.5C8 15.88 9.79 17 12 17s4-1.12 4-2.5S14.21 12 12 12s-4 1.12-4 2.5Z" />
                            <circle cx="12" cy="12" r="9" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

