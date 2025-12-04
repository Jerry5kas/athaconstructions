@extends('layouts.admin')

@section('title', 'Add Testimonial')
@section('page-title', 'Add Testimonial')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-lg">
            <div class="mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-6">
                <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Add Testimonial</h6>
                <p class="mb-0 text-sm text-slate-500">Create a new client testimonial with project details and rating.</p>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('admin.testimonials.store') }}" method="POST">
                    @include('admin.testimonials._form', [
                        'testimonial' => new \App\Models\Testimonial(),
                        'submitLabel' => 'Create Testimonial',
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


