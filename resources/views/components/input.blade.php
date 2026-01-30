@props(['type' => 'text', 'placeholder' => '', 'icon' => null, 'name', 'id' => null])

<div class="relative">
    @if($icon)
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <iconify-icon icon="{{ $icon }}" width="20" height="20" class="text-gray-500 "></iconify-icon>
        </div>
    @endif
    
    <input 
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full bg-slate-100 text-slate-800 rounded-lg px-4 py-3 placeholder-gray-500 focus:ring-slate-800 transition-all duration-200' . ($icon ? ' pl-12' : '')]) }}
    />
</div>
@error($name)
    <span class="text-red-500 text-sm">{{ $message }}</span>
@enderror
