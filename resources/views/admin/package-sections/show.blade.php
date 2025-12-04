@extends('layouts.admin')

@section('title', 'Manage Features: ' . $section->name)
@section('page-title', 'Manage Features: ' . $section->name)

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
                    <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">{{ $section->name }}</h6>
                    <p class="mb-0 text-sm text-slate-500">Manage features for all packages in this section.</p>
                </div>
                <a href="{{ route('admin.package-sections.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Back to Sections</a>
            </div>

            <div class="flex-auto p-6">
                <form action="{{ route('admin.package-features.store-or-update', $section->id) }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        @foreach($packages as $package)
                            @php
                                $feature = $section->featuresForPackage($package->id);
                            @endphp
                            <div class="border border-gray-200 rounded-xl p-6">
                                <label class="block text-sm font-semibold text-gray-900 mb-3">
                                    {{ $package->name }} ({{ $package->price_formatted }}/sqft)
                                </label>
                                <textarea
                                    name="features[{{ $loop->index }}][content]"
                                    rows="8"
                                    class="js-feature-textarea w-full rounded-xl border border-gray-300 px-4 py-3 text-sm"
                                    placeholder="Enter features for {{ $package->name }}. Each line becomes a bullet point.">{{ old("features.{$loop->index}.content", $feature?->content) }}</textarea>
                                <div class="mt-2 text-xs text-gray-700 js-feature-preview"></div>
                                <input type="hidden" name="features[{{ $loop->index }}][package_id]" value="{{ $package->id }}">
                                <p class="mt-2 text-xs text-gray-500">Press Enter to start a new bullet. Each line will be treated as a separate feature.</p>
                            </div>
                        @endforeach
                        
                        <div class="flex gap-3 pt-4 border-t">
                            <a href="{{ route('admin.package-sections.index') }}" class="px-6 py-3 border border-gray-300 rounded-xl">Cancel</a>
                            <button type="submit" class="px-6 py-3 bg-gray-900 text-white rounded-xl">Save Features</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const BULLET = '● ';

        function normalizeBullets(text) {
            return text
                .split(/\r?\n/)
                .map(line => {
                    const trimmed = line.trim();
                    if (!trimmed) return '';
                    if (trimmed.startsWith(BULLET.trim())) {
                        return BULLET + trimmed.replace(/^●\s*/, '');
                    }
                    return BULLET + trimmed;
                })
                .join('\n');
        }

        document.querySelectorAll('.js-feature-textarea').forEach(textarea => {
            const preview = textarea.parentElement.querySelector('.js-feature-preview');

            const updatePreview = () => {
                if (!preview) return;
                const lines = textarea.value.split(/\r?\n/)
                    .map(line => line.replace(/^●\s*/, '').trim())
                    .filter(line => line.length > 0);

                if (!lines.length) {
                    preview.innerHTML = '<span class="text-gray-400">Preview will appear here as you type...</span>';
                    return;
                }

                preview.innerHTML = '<ul class="list-disc list-inside space-y-1">' +
                    lines.map(line => `<li>${line}</li>`).join('') +
                    '</ul>';
            };

            // Normalize existing content on load only
            if (textarea.value.trim() !== '') {
                textarea.value = normalizeBullets(textarea.value);
            }
            updatePreview();

            textarea.addEventListener('keydown', (event) => {
                const { selectionStart, selectionEnd, value } = textarea;
                const lineStart = value.lastIndexOf('\n', selectionStart - 1) + 1;
                const lineEnd = value.indexOf('\n', selectionStart);
                const currentLine = value.slice(lineStart, lineEnd === -1 ? value.length : lineEnd);
                const isAtLineStart = selectionStart === lineStart;

                // Handle Enter key - add new bullet line
                if (event.key === 'Enter') {
                    event.preventDefault();

                    const before = value.slice(0, selectionStart);
                    const after = value.slice(selectionEnd);

                    // Check if current line has bullet, if not add it
                    const needsBullet = !currentLine.trim().startsWith(BULLET.trim());
                    const insert = needsBullet 
                        ? '\n' + BULLET 
                        : '\n' + BULLET;
                    
                    const newValue = before + insert + after;
                    const newCursor = selectionStart + insert.length;

                    textarea.value = newValue;
                    textarea.setSelectionRange(newCursor, newCursor);
                    updatePreview();
                    return;
                }

                // Handle Backspace at start of line - remove bullet
                if (event.key === 'Backspace' && isAtLineStart && currentLine.trim().startsWith(BULLET.trim())) {
                    event.preventDefault();
                    
                    const before = value.slice(0, lineStart);
                    const after = value.slice(lineStart + BULLET.length);
                    const newValue = before + after;
                    const newCursor = lineStart;

                    textarea.value = newValue;
                    textarea.setSelectionRange(newCursor, newCursor);
                    updatePreview();
                    return;
                }
            });

            // Only update preview on input, don't normalize (allows normal typing)
            textarea.addEventListener('input', () => {
                updatePreview();
            });

            // Normalize on paste (but allow normal typing)
            textarea.addEventListener('paste', (event) => {
                setTimeout(() => {
                    textarea.value = normalizeBullets(textarea.value);
                    updatePreview();
                }, 0);
            });
        });
    });
</script>
@endpush

