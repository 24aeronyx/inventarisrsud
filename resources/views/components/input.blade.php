@props(['type' => 'text', 'placeholder' => '', 'icon' => null, 'name', 'id' => null])

<div class="relative">
    @if($icon)
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <iconify-icon icon="{{ $icon }}" width="20" height="20" class="text-[#FFFFFF]"></iconify-icon>
        </div>
    @endif
    
    <input 
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full bg-[#262626] border border-[#262626] rounded-lg px-4 py-3 text-[#FFFFFF] placeholder-[#A1A1A1] focus:outline-none focus:ring-2 focus:ring-[#FFFFFF] focus:border-transparent transition-all duration-200' . ($icon ? ' pl-12' : '')]) }}
    />
</div>
@error($name)
    <span class="text-red-500 text-sm">{{ $message }}</span>
@enderror
