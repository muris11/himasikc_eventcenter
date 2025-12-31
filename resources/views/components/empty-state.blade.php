@props([
    'title' => 'Tidak Ada Data',
    'message' => 'Belum ada data yang tersedia saat ini.',
    'icon' => 'default', // default, search, calendar, document
    'actionLabel' => null,
    'actionWireClick' => null,
    'actionLink' => null,
])

@php
    $icons = [
        'default' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>',
        'search' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>',
        'calendar' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
        'document' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
    ];
    
    $currentIcon = $icons[$icon] ?? $icons['default'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-surface rounded-[2.5rem] border border-border p-12 text-center shadow-sm animate-fade-in-up']) }}>
    <div class="w-20 h-20 bg-surface-secondary rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
        <svg class="w-10 h-10 text-text-muted/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {!! $currentIcon !!}
        </svg>
    </div>
    
    <h3 class="text-xl font-bold text-text-main mb-2 font-heading">{{ $title }}</h3>
    <p class="text-text-muted mb-8 max-w-md mx-auto leading-relaxed">{{ $message }}</p>
    
    @if($actionLabel)
        @if($actionWireClick)
            <button wire:click="{{ $actionWireClick }}" class="btn btn-primary">
                {{ $actionLabel }}
            </button>
        @elseif($actionLink)
            <a href="{{ $actionLink }}" class="btn btn-primary">
                {{ $actionLabel }}
            </a>
        @endif
    @endif
</div>
