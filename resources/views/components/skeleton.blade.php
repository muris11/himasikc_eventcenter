@props([
    'type' => 'text', // text, title, avatar, image, card, table
    'lines' => 3,
    'width' => 'full', // full, 1/2, 1/3, 1/4, 2/3, 3/4
])

@php
    $widthClasses = [
        'full' => 'w-full',
        '1/2' => 'w-1/2',
        '1/3' => 'w-1/3',
        '1/4' => 'w-1/4',
        '2/3' => 'w-2/3',
        '3/4' => 'w-3/4',
    ][$width];
@endphp

<div class="animate-pulse {{ $attributes->get('class') }}">
    @if($type === 'text')
        @for($i = 0; $i < $lines; $i++)
            <div class="h-4 bg-gray-200 rounded {{ $widthClasses }} mb-2 {{ $i === $lines - 1 ? 'w-2/3' : '' }}"></div>
        @endfor
    @elseif($type === 'title')
        <div class="h-8 bg-gray-200 rounded {{ $widthClasses }} mb-4"></div>
    @elseif($type === 'avatar')
        <div class="h-12 w-12 bg-gray-200 rounded-full"></div>
    @elseif($type === 'image')
        <div class="h-48 bg-gray-200 rounded-lg {{ $widthClasses }}"></div>
    @elseif($type === 'card')
        <div class="border border-gray-200 rounded-3xl p-6 {{ $widthClasses }}">
            <div class="h-6 bg-gray-200 rounded w-3/4 mb-4"></div>
            <div class="space-y-3">
                <div class="h-4 bg-gray-200 rounded"></div>
                <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                <div class="h-4 bg-gray-200 rounded w-4/6"></div>
            </div>
        </div>
    @elseif($type === 'table')
        <div class="space-y-3">
            <div class="h-12 bg-gray-200 rounded"></div>
            @for($i = 0; $i < $lines; $i++)
                <div class="h-16 bg-gray-200 rounded"></div>
            @endfor
        </div>
    @else
        {{ $slot }}
    @endif
</div>
