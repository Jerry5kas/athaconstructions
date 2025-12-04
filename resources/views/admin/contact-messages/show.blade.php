@extends('layouts.admin')

@section('title', 'View Contact Message')
@section('page-title', 'View Contact Message')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md">
            <div class="flex items-center justify-between mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-6">
                <div>
                    <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">
                        {{ $contact->name }}
                    </h6>
                    <p class="mb-0 text-sm text-slate-500">
                        Received on {{ $contact->created_at?->format('d M Y, H:i') }}
                    </p>
                </div>
                <a 
                    href="{{ route('admin.contact-messages.index') }}" 
                    class="text-sm text-slate-600 hover:text-slate-900 transition">
                    ← Back to Messages
                </a>
            </div>

            <div class="flex-auto p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-slate-500 mb-2 font-semibold">Name</p>
                        <p class="text-slate-900 font-medium">{{ $contact->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-slate-500 mb-2 font-semibold">Phone</p>
                        <p class="text-slate-900 font-medium">{{ $contact->phone }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-slate-500 mb-2 font-semibold">Email</p>
                        <p class="text-slate-900">{{ $contact->email ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-slate-500 mb-2 font-semibold">Project Type</p>
                        <p class="text-slate-900">
                            @if($contact->type)
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $contact->type === 'residential' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ ucfirst($contact->type) }}
                                </span>
                            @else
                                —
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-slate-500 mb-2 font-semibold">Plot Size</p>
                        <p class="text-slate-900">{{ $contact->plotsize ?? '—' }}</p>
                    </div>
                </div>

                @if($contact->message)
                <div class="pt-6 border-t border-slate-200 mb-6">
                    <p class="text-xs uppercase tracking-wider text-slate-500 mb-3 font-semibold">Message</p>
                    <div class="bg-slate-50 rounded-lg p-4">
                        <p class="text-slate-900 whitespace-pre-line leading-relaxed">{{ $contact->message }}</p>
                    </div>
                </div>
                @endif

                <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                    <a 
                        href="{{ route('admin.contact-messages.index') }}" 
                        class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition">
                        Back to List
                    </a>
                    <form 
                        action="{{ route('admin.contact-messages.destroy', $contact) }}" 
                        method="POST"
                        class="inline"
                        onsubmit="return confirm('Are you sure you want to delete this message? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-red-600 rounded-lg hover:bg-red-700 transition">
                            Delete Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
