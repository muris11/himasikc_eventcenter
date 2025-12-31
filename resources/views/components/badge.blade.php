@props([
    'variant' => 'default', // default, success, warning, error, info, primary
    'size' => 'md', // sm, md, lg
    'dot' => false,
])

@php
    $sizeClasses = [
        'sm' => 'px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider',
        'md' => 'px-2.5 py-1 text-xs font-bold',
        'lg' => 'px-3 py-1.5 text-sm font-bold',
    ][$size];
    
    $variantClasses = [
        'default' => 'bg-surface-secondary text-text-muted ring-border',
        'success' => 'bg-green-50 text-green-700 ring-green-200',
        'warning' => 'bg-yellow-50 text-yellow-700 ring-yellow-200',
        'error' => 'bg-red-50 text-red-700 ring-red-200',
        'info' => 'bg-blue-50 text-blue-700 ring-blue-200',
        'primary' => 'bg-primary-50 text-primary-700 ring-primary-200',
    ][$variant];
    
    $dotColorClasses = [
        'default' => 'bg-text-muted',
        'success' => 'bg-green-500',
        'warning' => 'bg-yellow-500',
        'error' => 'bg-red-500',
        'info' => 'bg-blue-500',
        'primary' => 'bg-primary-500',
    ][$variant];
    
    $classes = "inline-flex items-center gap-1.5 rounded-full ring-1 ring-inset $sizeClasses $variantClasses " . ($attributes->get('class') ?? '');
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColorClasses }}"></span>
    @endif
    {{ $slot }}
</span>
