@props(['title' => null, 'subtitle' => null, 'class' => ''])

<div class="relative flex flex-col min-w-0 break-words bg-white border border-gray-100 rounded-2xl shadow-md {{ $class }}">
    @if($title || $subtitle)
    <div class="p-6 pb-0">
        @if($title)
        <h6 class="mb-0 font-bold">{{ $title }}</h6>
        @endif
        @if($subtitle)
        <p class="mb-0 leading-normal text-sm">{{ $subtitle }}</p>
        @endif
    </div>
    @endif
    <div class="flex-auto p-6">
        {{ $slot }}
    </div>
</div>

