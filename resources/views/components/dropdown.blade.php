{{-- Components/dropdown.blade.php --}}

@props([
    'id' => null,
    'align' => 'left',
    'width' => '56',
    'trigger' => '',
    'contentClass' => '',
    'triggerClass' => '',
    'hover' => false,
])

@php
$align = match($align) {
    'left' => 'left-0 origin-top-left',
    'right' => 'right-0 origin-top-right',
    default => 'left-0 origin-top-left',
};

$width = 'w-' . $width;
@endphp

<div class="relative" x-data="{ open: false }" @if($id) id="{{ $id }}" @endif>
    {{-- Trigger --}}
    <div
        @click="open = !open"
        @if($hover) @mouseenter="open = true" @mouseleave="open = false" @endif
        class="{{ $triggerClass }}"
    >
        {{ $trigger }}
    </div>

    {{-- Content --}}
    <div
        x-show="open"
        @click.away="open = false"
        @if($hover) @mouseenter="open = true" @mouseleave="open = false" @endif
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $width }} {{ $align }} rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none {{ $contentClass }}"
    >
        {{ $slot }}
    </div>
</div>
