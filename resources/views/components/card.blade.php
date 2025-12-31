@props([
    'padding' => true,
    'hover' => false,
    'shadow' => 'sm', // none, sm, md, lg, xl
])

@php
    $baseClasses = 'bg-surface rounded-2xl border border-border overflow-hidden';
    
    $paddingClass = $padding ? 'p-6 sm:p-8' : '';
    
    $hoverClass = $hover ? 'transition-all duration-300 hover:shadow-lg hover:border-primary/30 hover:-translate-y-1 cursor-pointer' : '';
    
    $shadowClasses = [
        'none' => '',
        'sm' => 'shadow-sm',
        'md' => 'shadow-md',
        'lg' => 'shadow-lg',
        'xl' => 'shadow-xl',
    ][$shadow];
    
    $classes = trim("$baseClasses $paddingClass $hoverClass $shadowClasses " . ($attributes->get('class') ?? ''));
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    @if(isset($header))
        <div class="px-6 sm:px-8 py-4 sm:py-5 border-b border-border bg-surface-secondary/30">
            {{ $header }}
        </div>
    @endif
    
    <div class="{{ $padding ? 'p-6 sm:p-8' : '' }}">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
        <div class="px-6 sm:px-8 py-4 sm:py-5 border-t border-border bg-surface-secondary/30">
            {{ $footer }}
        </div>
    @endif
</div>
