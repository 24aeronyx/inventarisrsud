@props(['type' => 'button', 'variant' => 'primary', 'icon' => null, 'iconPosition' => 'left'])

@php
    $baseClasses = 'inline-flex items-center justify-center px-6 py-3 font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    
    $variantClasses = [
        'primary' => 'bg-slate-800 text-white font-medium cursor-pointer',
        'secondary' => 'bg-[#262626] text-[#FFFFFF] hover:bg-[#121212] focus:ring-[#A1A1A1] border border-[#A1A1A1]',
    ];
    
    $classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']);
@endphp

<button 
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    @if($icon && $iconPosition === 'left')
        <iconify-icon icon="{{ $icon }}" width="20" height="20" class="{{ $slot->isEmpty() ? '' : 'mr-2' }}"></iconify-icon>
    @endif
    
    {{ $slot }}
    
    @if($icon && $iconPosition === 'right')
        <iconify-icon icon="{{ $icon }}" class="w-5 h-5 {{ $slot->isEmpty() ? '' : 'ml-2' }}"></iconify-icon>
    @endif
</button>
