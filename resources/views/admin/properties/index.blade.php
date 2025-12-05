@extends('layouts.admin')

@section('title', 'Properties')
@section('page-title', 'Properties')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        @if (session('status'))
            <div class="mb-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md">
            <div class="flex items-center justify-between mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-6">
                <div>
                    <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Properties</h6>
                    <p class="mb-0 text-sm text-slate-500">Manage your construction projects and properties.</p>
                </div>
                <a
                    href="{{ route('admin.properties.create') }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-wide text-white uppercase bg-gray-900 rounded-lg shadow-sm hover:bg-black hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-1 transition">
                    + Add Property
                </a>
            </div>

            {{-- Filters --}}
            <div class="px-6 pt-4 pb-2 border-b border-gray-100">
                <form method="GET" action="{{ route('admin.properties.index') }}" class="flex flex-wrap gap-3">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search properties..."
                        class="px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
                    
                    <select
                        name="status"
                        class="px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <option value="">All Status</option>
                        <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>

                    <select
                        name="type"
                        class="px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <option value="">All Types</option>
                        <option value="apartment" {{ request('type') === 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="villa" {{ request('type') === 'villa' ? 'selected' : '' }}>Villa</option>
                        <option value="plot" {{ request('type') === 'plot' ? 'selected' : '' }}>Plot</option>
                        <option value="commercial" {{ request('type') === 'commercial' ? 'selected' : '' }}>Commercial</option>
                    </select>

                    <button
                        type="submit"
                        class="px-4 py-2 text-sm font-semibold text-white bg-gray-900 rounded-lg hover:bg-black transition">
                        Filter
                    </button>

                    @if(request('search') || request('status') || request('type'))
                        <a
                            href="{{ route('admin.properties.index') }}"
                            class="px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="flex-auto px-0 pt-6 pb-2">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-slate-700">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Image
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Title
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Type / Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Location
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Updated
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($properties as $property)
                                <tr class="transition hover:bg-slate-50/80">
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="flex items-center px-2">
                                            @if ($property->featured_image)
                                                <div class="relative w-20 h-20 overflow-hidden rounded-lg shadow-sm bg-slate-100 flex-shrink-0">
                                                    <img
                                                        src="{{ $property->featured_image_url }}"
                                                        alt="{{ $property->title }}"
                                                        class="object-cover w-full h-full" />
                                                </div>
                                            @else
                                                <div class="flex items-center justify-center w-20 h-20 rounded-lg border border-dashed border-slate-200 text-slate-300 text-xs">
                                                    No Image
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="flex flex-col px-2 py-1">
                                            <h6 class="mb-0 text-sm leading-normal font-semibold">
                                                {{ $property->title }}
                                            </h6>
                                            @if ($property->slug)
                                                <p class="mb-0 text-xs text-slate-400">
                                                    {{ $property->slug }}
                                                </p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="flex flex-col gap-1 px-2">
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-blue-700 bg-blue-50 rounded-full ring-1 ring-blue-100 capitalize">
                                                {{ $property->project_type }}
                                            </span>
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight rounded-full ring-1 capitalize
                                                @if($property->status === 'upcoming') text-yellow-700 bg-yellow-50 ring-yellow-100
                                                @elseif($property->status === 'ongoing') text-emerald-700 bg-emerald-50 ring-emerald-100
                                                @else text-slate-600 bg-slate-100 ring-slate-200
                                                @endif">
                                                {{ $property->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent">
                                        <div class="px-2 max-w-xs">
                                            @if ($property->location)
                                                <p class="text-xs text-slate-600 font-medium">
                                                    {{ $property->location->city }}
                                                </p>
                                                <p class="text-xs text-slate-400 line-clamp-1">
                                                    {{ Str::limit($property->location->address, 40) }}
                                                </p>
                                            @else
                                                <span class="text-xs text-slate-400">—</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent whitespace-nowrap">
                                        <span class="text-xs font-semibold leading-tight">
                                            {{ $property->updated_at?->format('d M Y, H:i') }}
                                        </span>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap text-center">
                                        <div class="inline-flex items-center justify-center gap-2">
                                            <a
                                                href="{{ route('admin.properties.edit', $property) }}"
                                                class="inline-flex items-center justify-center text-slate-400 hover:text-gray-900 hover:scale-110 transition"
                                                title="Edit property">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-3.5 h-3.5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 20h9" />
                                                    <path
                                                        d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                                                </svg>
                                                <span class="sr-only">Edit</span>
                                            </a>
                                            <form
                                                method="POST"
                                                action="{{ route('admin.properties.destroy', $property) }}"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this property? This will delete all related data (location, units, gallery, specifications).');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center text-slate-400 hover:text-red-600 hover:scale-110 transition"
                                                    title="Delete property">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="w-3.5 h-3.5"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6" />
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    </svg>
                                                    <span class="sr-only">Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-4 text-center text-sm text-slate-500">
                                        No properties found. Click "Add Property" to create one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $properties->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

