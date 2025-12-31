@props([
    'label' => null,
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'error' => null,
    'hint' => null,
    'icon' => null,
    'disabled' => false,
])

@php
    $inputClasses = 'block w-full px-4 py-3 text-sm text-text-main bg-surface border rounded-xl transition-all duration-200 placeholder:text-text-muted/50 focus:outline-none focus:ring-2 focus:ring-offset-0 disabled:bg-surface-secondary disabled:cursor-not-allowed';
    
    if ($error) {
        $inputClasses .= ' border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500/20';
    } else {
        $inputClasses .= ' border-border focus:border-primary focus:ring-primary/20';
    }
    
    if ($icon) {
        $inputClasses .= ' pl-11';
    }
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-bold text-text-main mb-2">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <span class="text-text-muted">
                    {!! $icon !!}
                </span>
            </div>
        @endif
        
        @if($type === 'textarea')
            <textarea 
                name="{{ $name }}" 
                id="{{ $name }}"
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                rows="4"
                {{ $attributes->merge(['class' => $inputClasses]) }}
            >{{ $slot }}</textarea>
        @else
            <input 
                type="{{ $type }}" 
                name="{{ $name }}" 
                id="{{ $name }}"
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $attributes->merge(['class' => $inputClasses]) }}
            />
        @endif
    </div>
    
    @if($error)
        <p class="mt-2 text-sm text-red-600 flex items-center gap-1.5 font-medium">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            {{ $error }}
        </p>
    @elseif($hint)
        <p class="mt-2 text-sm text-text-muted">{{ $hint }}</p>
    @endif
</div>
