{{-- Components/mobile-dropdown-link.blade.php --}}

@props(['href' => '#', 'icon' => null])

<a {{ $attributes->merge(['class' => 'block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-teal-50']) }}
    href="{{ $href }}">
    @if ($icon)
        <i class="fas fa-{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</a>
