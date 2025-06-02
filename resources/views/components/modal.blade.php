{{-- resources/views/components/flexible-modal.blade.php --}}
@props([
    'name' => 'default-modal',
    'show' => false,
    'maxWidth' => 'md',
    'closable' => true,
    'backdrop' => 'blur',
    'position' => 'center',
    'animation' => 'scale',
    'persistent' => false,
    'scrollable' => false,
    'fullscreen' => false,
    'mobile' => 'responsive'
])

@php
// Konfigurasi ukuran
$maxWidthClasses = [
    'xs' => 'sm:max-w-xs',
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '3xl' => 'sm:max-w-3xl',
    '4xl' => 'sm:max-w-4xl',
    '5xl' => 'sm:max-w-5xl',
    '6xl' => 'sm:max-w-6xl',
    '7xl' => 'sm:max-w-7xl',
    'full' => 'sm:max-w-full'
];

// Konfigurasi backdrop
$backdropClasses = [
    'blur' => 'backdrop-blur-sm bg-gray-900/50',
    'dark' => 'bg-gray-900/75',
    'light' => 'bg-gray-500/75',
    'none' => 'bg-transparent'
];

// Konfigurasi posisi
$positionClasses = [
    'center' => 'items-center justify-center',
    'top' => 'items-start justify-center pt-16',
    'bottom' => 'items-end justify-center pb-16'
];

// Konfigurasi animasi
$animations = [
    'scale' => [
        'enter' => 'opacity-0 scale-95',
        'enter-end' => 'opacity-100 scale-100',
        'leave' => 'opacity-100 scale-100',
        'leave-end' => 'opacity-0 scale-95'
    ],
    'slide-down' => [
        'enter' => 'opacity-0 -translate-y-10',
        'enter-end' => 'opacity-100 translate-y-0',
        'leave' => 'opacity-100 translate-y-0',
        'leave-end' => 'opacity-0 -translate-y-10'
    ],
    'slide-up' => [
        'enter' => 'opacity-0 translate-y-10',
        'enter-end' => 'opacity-100 translate-y-0',
        'leave' => 'opacity-100 translate-y-0',
        'leave-end' => 'opacity-0 translate-y-10'
    ],
    'fade' => [
        'enter' => 'opacity-0',
        'enter-end' => 'opacity-100',
        'leave' => 'opacity-100',
        'leave-end' => 'opacity-0'
    ]
];

$maxWidthClass = $maxWidthClasses[$maxWidth] ?? $maxWidthClasses['md'];
$backdropClass = $backdropClasses[$backdrop] ?? $backdropClasses['blur'];
$positionClass = $positionClasses[$position] ?? $positionClasses['center'];
$animationConfig = $animations[$animation] ?? $animations['scale'];

// Mobile responsiveness
$mobileClasses = [
    'responsive' => 'mx-4 sm:mx-auto',
    'fullwidth' => 'mx-0 sm:mx-auto w-full sm:w-auto',
    'adaptive' => 'mx-2 sm:mx-auto'
];
$mobileClass = $mobileClasses[$mobile] ?? $mobileClasses['responsive'];
@endphp

<div
    x-data="{
        show: @js($show),
        name: '{{ $name }}',
        persistent: @js($persistent),

        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                .filter(el => ! el.hasAttribute('disabled'))
        },

        firstFocusable() {
            return this.focusables()[0]
        },

        lastFocusable() {
            return this.focusables().slice(-1)[0]
        },

        nextFocusable() {
            return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable()
        },

        prevFocusable() {
            return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable()
        },

        nextFocusableIndex() {
            return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1)
        },

        prevFocusableIndex() {
            return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1
        },

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
    }"

    x-init="
        $watch('show', value => {
            if (value) {
                document.body.classList.add('overflow-hidden');
                {{ $attributes->has('autofocus') ? '$nextTick(() => firstFocusable()?.focus());' : '' }}
            } else {
                document.body.classList.remove('overflow-hidden');
            }
        });
    "

    x-on:open-modal.window="$event.detail.name === name && open()"
    x-on:close-modal.window="$event.detail.name === name && close()"
    x-on:toggle-modal.window="$event.detail.name === name && (show ? close() : open())"

    @if($closable)
        x-on:keydown.escape.window="show && close()"
        x-on:keydown.tab.prevent="show && ($event.shiftKey ? prevFocusable()?.focus() : nextFocusable()?.focus())"
        x-on:keydown.shift.tab.prevent="show && prevFocusable()?.focus()"
    @endif

    x-cloak
    x-show="show"
    class="fixed inset-0 z-50 {{ $scrollable ? 'overflow-y-auto' : '' }} {{ $fullscreen ? 'p-0' : 'p-4' }}"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    {{-- Backdrop --}}
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 {{ $backdropClass }}"
        @if($closable && !$persistent)
            x-on:click="close()"
        @endif
    ></div>

    {{-- Modal Container --}}
    <div class="relative min-h-screen flex {{ $positionClass }}">
        <div
            x-show="show"
            x-trap.inert.noscroll="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="{{ $animationConfig['enter'] }}"
            x-transition:enter-end="{{ $animationConfig['enter-end'] }}"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="{{ $animationConfig['leave'] }}"
            x-transition:leave-end="{{ $animationConfig['leave-end'] }}"
            class="
                relative w-full {{ $maxWidthClass }} {{ $mobileClass }}
                @if($fullscreen)
                    h-full
                @else
                    {{ $scrollable ? 'max-h-[90vh] overflow-y-auto' : '' }}
                @endif
                bg-white
                {{ $fullscreen ? '' : 'rounded-lg shadow-xl' }}
                transform transition-all
            "
            x-on:click.stop
        >
            {{-- Header Slot --}}
            @if(isset($header))
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    {{ $header }}
                </div>
            @endif

            {{-- Main Content --}}
            <div class="{{ isset($header) || isset($footer) ? '' : 'p-6' }}">
                {{ $slot }}
            </div>

            {{-- Footer Slot --}}
            @if(isset($footer))
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                    {{ $footer }}
                </div>
            @endif

            {{-- Close Button (jika closable dan tidak persistent) --}}
            @if($closable && !$persistent && !isset($header))
                <button
                    x-on:click="close()"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-full p-1"
                    aria-label="Close modal"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            @endif
        </div>
    </div>
</div>
