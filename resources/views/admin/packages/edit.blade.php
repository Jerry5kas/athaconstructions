@extends('layouts.admin')

@section('title', 'Edit Package')
@section('page-title', 'Edit Package')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-lg">
            <div class="mb-0 rounded-t-2xl border-b border-gray-100 bg-white p-6 pb-6">
                <h6 class="mb-1 text-lg tracking-wide uppercase font-tenor text-gray-900">Edit Package</h6>
                <p class="mb-0 text-sm text-slate-500">Update package details.</p>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.packages._form', [
                        'package' => $package,
                        'submitLabel' => 'Update Package',
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

