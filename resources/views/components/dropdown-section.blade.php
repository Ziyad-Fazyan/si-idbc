{{-- Components/dropdown-section.blade.php --}}

@props([
    'title' => null,
])

<div class="py-1">
    @if ($title)
        <div class="px-3 py-2 text-xs font-semibold text-teal-800 bg-teal-50">{{ $title }}</div>
    @endif

    {{ $slot }}
</div>
