@extends('layouts.admin')

@section('title', 'Amenities')
@section('page-title', 'Amenities')

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
                    <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Amenities</h6>
                    <p class="mb-0 text-sm text-slate-500">Manage global amenities that can be assigned to properties.</p>
                </div>
                <a
                    href="{{ route('admin.amenities.create') }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-wide text-white uppercase bg-gray-900 rounded-lg shadow-sm hover:bg-black hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-1 transition">
                    + Add Amenity
                </a>
            </div>

            <div class="flex-auto px-0 pt-6 pb-2">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-sm text-slate-700">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Icon
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Order
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold tracking-[0.18em] uppercase text-slate-600 font-tenor">
                                    Status
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
                            @forelse ($amenities as $amenity)
                                <tr class="transition hover:bg-slate-50/80">
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="flex flex-col px-2 py-1">
                                            <h6 class="mb-0 text-sm leading-normal font-semibold">
                                                {{ $amenity->name }}
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        <div class="px-2">
                                            @if ($amenity->icon)
                                                <span class="text-sm text-slate-600">{{ $amenity->icon }}</span>
                                            @else
                                                <span class="text-xs text-slate-400">—</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent whitespace-nowrap">
                                        <span class="text-xs font-semibold leading-tight">
                                            {{ $amenity->sort_order }}
                                        </span>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap">
                                        @if ($amenity->is_active)
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-emerald-700 bg-emerald-50 rounded-full ring-1 ring-emerald-100">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-slate-600 bg-slate-100 rounded-full ring-1 ring-slate-200">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent whitespace-nowrap">
                                        <span class="text-xs font-semibold leading-tight">
                                            {{ $amenity->updated_at?->format('d M Y, H:i') }}
                                        </span>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent whitespace-nowrap text-center">
                                        <div class="inline-flex items-center justify-center gap-2">
                                            <a
                                                href="{{ route('admin.amenities.edit', $amenity) }}"
                                                class="inline-flex items-center justify-center text-slate-400 hover:text-gray-900 hover:scale-110 transition"
                                                title="Edit amenity">
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
                                                action="{{ route('admin.amenities.destroy', $amenity) }}"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this amenity?');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center text-slate-400 hover:text-red-600 hover:scale-110 transition"
                                                    title="Delete amenity">
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
                                        No amenities found. Click "Add Amenity" to create one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $amenities->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

