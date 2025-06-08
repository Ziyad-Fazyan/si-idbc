{{-- resources/views/components/simple-modal.blade.php --}}
@props([
    'name' => 'default-modal',
    'show' => false,
    'maxWidth' => 'md',
    'closable' => true,
    'persistent' => false,
    'backdrop' => 'blur',
])

@php
    // Konfigurasi ukuran
    $maxWidthClasses = [
        'xs' => 'max-w-xs',
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
        'full' => 'max-w-full',
    ];

    // Konfigurasi backdrop
    $backdropClasses = [
        'blur' => 'backdrop-blur-sm bg-gray-900/50',
        'dark' => 'bg-gray-900/75',
        'light' => 'bg-gray-500/75',
        'none' => 'bg-transparent',
    ];

    $maxWidthClass = $maxWidthClasses[$maxWidth] ?? $maxWidthClasses['md'];
    $backdropClass = $backdropClasses[$backdrop] ?? $backdropClasses['blur'];
@endphp

<div x-data="{
    show: @js($show),
    name: '{{ $name }}',
    persistent: @js($persistent),

    close() {
        if (!this.persistent) {
            this.show = false;
            $dispatch('modal-closed', { name: this.name });
        }
    },

    open() {
        this.show = true;
        $dispatch('modal-opened', { name: this.name });
    }
}" x-on:open-modal.window="$event.detail.name === name && open()"
    x-on:close-modal.window="$event.detail.name === name && close()"
    x-on:toggle-modal.window="$event.detail.name === name && (show ? close() : open())"
    @if ($closable) x-on:keydown.escape.window="show && close()" @endif x-cloak x-show="show"
    class="fixed inset-0 z-50" style="display: {{ $show ? 'block' : 'none' }};">
    {{-- Backdrop --}}
    <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 {{ $backdropClass }}" @if ($closable && !$persistent) x-on:click="close()" @endif></div>

    {{-- Modal Container - Fixed positioning with max height and scrolling --}}
    <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="relative w-full {{ $maxWidthClass }}" x-on:click.stop>
                {{-- Content Area with max-height and scrolling --}}
                <div class="bg-white rounded-lg shadow-xl max-h-[calc(100vh-2rem)] overflow-y-auto">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
