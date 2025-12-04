@extends('layouts.admin')

@section('title', 'Add Testimonial Media')
@section('page-title', 'Add Testimonial Media')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-lg">
            <div class="mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-6">
                <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Add Media</h6>
                <p class="mb-0 text-sm text-slate-500">Attach an image or video URL to a testimonial.</p>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('admin.testimonial-media.store') }}" method="POST">
                    @include('admin.testimonial-media._form', [
                        'media' => new \App\Models\TestimonialMedia(),
                        'submitLabel' => 'Create Media',
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


