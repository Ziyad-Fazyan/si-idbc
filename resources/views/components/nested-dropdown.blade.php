{{-- Components/nested-dropdown.blade.php --}}

@props([
    'id' => null,
    'align' => 'right',
    'width' => '64',
    'trigger' => '',
    'contentClass' => '',
    'triggerClass' => 'w-full flex justify-between items-center px-4 py-2 text-sm text-gray-700 hover:bg-teal-50',
    'hover' => true,
])

@php
    $align = match ($align) {
        'left' => 'left-full top-0 ml-1 origin-top-left',
        'right' => 'right-full top-0 mr-1 origin-top-right',
        default => 'left-full top-0 ml-1 origin-top-left',
    };

    $width = 'w-' . $width;
@endphp

<div class="relative submenu-group" x-data="{ open: false }"
    @if ($id) id="{{ $id }}" @endif>
    {{-- Trigger --}}
    <div @click="open = !open"
        @if ($hover) @mouseenter="open = true" @mouseleave="open = false" @endif
        class="{{ $triggerClass }}">
        {{ $trigger }}
    </div>

    {{-- Content --}}
    <div x-show="open" @if ($hover) @mouseenter="open = true" @mouseleave="open = false" @endif
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute z-20 {{ $width }} {{ $align }} rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none {{ $contentClass }}">
        {{ $slot }}
    </div>
</div>
