@extends('layouts.admin')

@section('title', 'Edit Blog')
@section('page-title', 'Edit Blog')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md">
            <div class="mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-4 flex items-center justify-between">
                <div>
                    <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Edit Blog</h6>
                    <p class="mb-0 text-sm text-slate-500">Update the blog content and SEO fields.</p>
                </div>
            </div>

            <div class="flex-auto px-0 pt-0 pb-6">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.blogs._form', ['blog' => $blog, 'categories' => $categories, 'submitLabel' => 'Update Blog'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof tinymce !== 'undefined') {
            tinymce.remove();
            tinymce.init({
                selector: 'textarea[name=content]',
                height: 500,
                menubar: false,
                plugins: 'lists link autoresize',
                toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link | removeformat',
                block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3',
                branding: false,
                promotion: false,
                content_style: 'body { font-family: Montserrat, system-ui, -apple-system, BlinkMacSystemFont, sans-serif; font-size:14px; }'
            });
        }
    });
</script>
@endpush

