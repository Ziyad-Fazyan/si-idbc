{{-- Components/dropdown-link.blade.php --}}

@props(['href' => '#', 'icon' => null])

<a {{ $attributes->merge(['class' => 'block px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-800']) }}
    href="{{ $href }}">
    @if ($icon)
        <i class="fas fa-{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</a>
