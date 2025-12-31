@props([
    'align' => 'right', // left, right
    'width' => '48', // width in pixels or 'full'
    'contentClasses' => 'py-1 bg-white',
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'left-0',
        'right' => 'right-0',
        default => 'left-0',
    };

    $widthClass = match ($width) {
        '48' => 'w-48',
        'full' => 'w-full',
        default => 'w-' . $width,
    };
@endphp

<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $widthClass }} rounded-lg shadow-lg {{ $alignmentClasses }} border border-gray-200"
        style="display: none;"
        @click="open = false"
    >
        <div class="rounded-lg ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
