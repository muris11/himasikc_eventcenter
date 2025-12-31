@props([
    'variant' => 'primary', // primary, secondary, danger, ghost, outline
    'size' => 'md', // sm, md, lg
    'href' => null,
    'type' => 'button',
    'icon' => null,
    'iconPosition' => 'left', // left, right
    'loading' => false,
    'disabled' => false,
    'fullWidth' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold transition-all duration-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed tracking-wide';
    
    // Size variants
    $sizeClasses = [
        'sm' => 'px-3 py-2 text-xs min-h-[36px]',
        'md' => 'px-5 py-2.5 text-sm min-h-[44px]',
        'lg' => 'px-6 py-3.5 text-base min-h-[52px]',
    ][$size];
    
    // Variant styles
    $variantClasses = [
        'primary' => 'bg-primary text-white hover:bg-primary-600 focus:ring-primary/50 shadow-mustard hover:shadow-mustard-lg hover:-translate-y-0.5 active:scale-95',
        'secondary' => 'bg-surface-secondary text-text-main border border-border hover:bg-surface-tertiary hover:border-primary/30 focus:ring-border active:scale-95',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500/50 shadow-lg shadow-red-500/30 hover:-translate-y-0.5 active:scale-95',
        'ghost' => 'bg-transparent text-text-muted hover:text-text-main hover:bg-surface-secondary focus:ring-border active:scale-95',
        'outline' => 'bg-transparent border-2 border-primary text-primary hover:bg-primary-50 focus:ring-primary/50 active:scale-95',
    ][$variant];
    
    $widthClass = $fullWidth ? 'w-full' : '';
    
    $classes = trim("$baseClasses $sizeClasses $variantClasses $widthClass " . ($attributes->get('class') ?? ''));
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($loading)
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        
        @if($icon && $iconPosition === 'left' && !$loading)
            {!! $icon !!}
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right')
            {!! $icon !!}
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes, 'disabled' => $disabled || $loading]) }}>
        @if($loading)
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        
        @if($icon && $iconPosition === 'left' && !$loading)
            {!! $icon !!}
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right')
            {!! $icon !!}
        @endif
    </button>
@endif
