{{-- Components/mobile-dropdown.blade.php --}}

@props([
    'id' => null,
    'label' => '',
    'icon' => null,
])

<div x-data="{ open: false }" class="relative" @if($id) id="{{ $id }}" @endif>
    <button @click="open = !open"
            class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-teal-50 hover:text-teal-800">
        <span>
            @if($icon)
                <i class="fas fa-{{ $icon }} mr-2"></i>
            @endif
            {{ $label }}
        </span>
        <i class="fas fa-chevron-down text-xs transition-transform duration-200"
           :class="{'rotate-180': open}"></i>
    </button>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="pl-4 mt-1 space-y-1">
        {{ $slot }}
    </div>
</div>
