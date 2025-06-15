<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $menu . $title }}</title>

    <!-- Favicon -->
    @if(isset($web->school_logo))
    <link rel="shortcut icon" href="{{ asset('storage/images/website/site-logo.png') }}" type="image/x-icon">
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @yield('custom-css')

   <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    document.documentElement.classList.add('js');
</script>

</head>

<body class="font-poppins bg-gray-50 text-gray-800 antialiased">
    <div id="app">
        <div id="main" class="min-h-screen flex flex-col">
            <!-- Header -->
            <header class="sticky top-0 z-50 shadow-md bg-white">
                <!-- Top Bar -->
                <div class="bg-teal-800 text-white py-2 px-4">
                    <div class="container mx-auto flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            @if(isset($web->school_logo))
                            <img src="{{ asset('storage/images/website/site-logo.png') }}" 
                                alt="Logo {{ $web->school_name }}" 
                                class="h-10 w-auto">
                            @endif
                            <a href="{{ route('root.home-index') }}"
                               class="text-xl font-bold text-white hover:text-teal-200 transition">
                                {{ $web->school_name ?? 'Nama Sekolah' }}
                            </a>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- User Dropdown -->
                            <x-dropdown align="right" width="56">
                                <x-slot name="trigger">
                                    <button class="flex items-center space-x-2 focus:outline-none">
                                        @if (Auth::guard('dosen')->check())
                                            <img src="{{ asset('storage/images/' . Auth::guard('dosen')->user()->dsn_image) }}"
                                                 alt="Avatar Dosen"
                                                 class="w-8 h-8 rounded-full object-cover">
                                            <span class="hidden md:inline-block">
                                                {{ Auth::guard('dosen')->user()->dsn_name }}
                                            </span>
                                        @elseif(Auth::guard('mahasiswa')->check())
                                            <img src="{{ asset('storage/images/' . Auth::guard('mahasiswa')->user()->mhs_image) }}"
                                                 alt="Avatar Mahasiswa"
                                                 class="w-8 h-8 rounded-full object-cover">
                                            <span class="hidden md:inline-block">
                                                {{ Auth::guard('mahasiswa')->user()->mhs_name }}
                                            </span>
                                        @elseif(Auth::check())
                                            <img src="{{ asset('storage/images/' . Auth::user()->image) }}"
                                                 alt="Avatar Admin"
                                                 class="w-8 h-8 rounded-full object-cover">
                                            <span class="hidden md:inline-block">
                                                {{ Auth::user()->name }}
                                            </span>
                                        @else
                                            <img src="{{ asset('storage/images/default/default-profile.png') }}"
                                                 alt="Avatar Guest"
                                                 class="w-8 h-8 rounded-full object-cover">
                                            <span class="hidden md:inline-block">
                                                Silakan Login
                                            </span>
                                        @endif
                                        <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                                           :class="{'rotate-180': open}"></i>
                                    </button>
                                </x-slot>

                                <x-dropdown-section>
                                    @if (Auth::guard('dosen')->check())
                                        <x-dropdown-link href="{{ route('dosen.home-profile') }}" icon="user-circle">
                                            Akun Saya
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{ route('dosen.auth-signout-post') }}" icon="sign-out-alt">
                                            Logout
                                        </x-dropdown-link>
                                    @elseif(Auth::guard('mahasiswa')->check())
                                        <x-dropdown-link href="{{ route('mahasiswa.home-profile') }}" icon="user-circle">
                                            Akun Saya
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{ route('mahasiswa.auth-signout-post') }}" icon="sign-out-alt">
                                            Logout
                                        </x-dropdown-link>
                                    @elseif(Auth::check())
                                        <x-dropdown-link href="{{ route($prefix . 'home-profile') }}" icon="user-circle">
                                            Akun Saya
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{ route($prefix . 'auth-signout-post') }}" icon="sign-out-alt">
                                            Logout
                                        </x-dropdown-link>
                                    @else
                                        <x-dropdown-link href="{{ route('mahasiswa.auth-signin-page') }}" icon="sign-in-alt">
                                            Login Mahasiswa
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{ route('dosen.auth-signin-page') }}" icon="sign-in-alt">
                                            Login Dosen
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{ route('admin.auth-signin-page') }}" icon="sign-in-alt">
                                            Login Admin
                                        </x-dropdown-link>
                                    @endif
                                </x-dropdown-section>
                            </x-dropdown>

                            <!-- Mobile Menu Button -->
                            <button id="mobile-menu-button"
                                    class="md:hidden text-white focus:outline-none">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Main Navigation -->
                <nav class="bg-white shadow-sm">
                    <div class="container mx-auto px-4">
                        <div class="hidden md:flex justify-center">
                            <ul class="flex space-x-1">
                                <li>
                                    <a href="{{ route('root.home-index') }}"
                                       class="px-4 py-3 flex items-center text-sm font-medium hover:bg-teal-50 hover:text-teal-800 transition rounded-md
                                              {{ request()->routeIs('root.home-index') ? 'text-teal-800 bg-teal-50' : 'text-gray-700' }}">
                                        <i class="fas fa-home mr-2"></i> Beranda
                                    </a>
                                </li>

                                <!-- Tentang Kami Dropdown -->
                                <li>
                                    <x-dropdown hover="true">
                                        <x-slot name="trigger">
                                            <button class="px-4 py-3 flex items-center text-sm font-medium hover:bg-teal-50 hover:text-teal-800 transition rounded-md
                                                     {{ request()->routeIs('root.gallery-index') ? 'text-teal-800 bg-teal-50' : 'text-gray-700' }}">
                                                <i class="fas fa-globe mr-2"></i> Tentang Kami <i class="fas fa-chevron-down ml-1 text-xs"></i>
                                            </button>
                                        </x-slot>

                                        <x-dropdown-section title="Profil Sekolah">
                                            <x-dropdown-link href="#">Sejarah</x-dropdown-link>
                                            <x-dropdown-link href="#">Struktur Organisasi</x-dropdown-link>
                                            <x-dropdown-link href="#">Visi & Misi</x-dropdown-link>
                                        </x-dropdown-section>

                                        <div class="border-t border-gray-200 my-1"></div>

                                        <x-dropdown-section title="Program Kuliah">
                                            @foreach ($proku as $item)
                                                <x-dropdown-link href="#">{{ $item->name }}</x-dropdown-link>
                                            @endforeach
                                        </x-dropdown-section>

                                        <div class="border-t border-gray-200 my-1"></div>

                                        <x-dropdown-section>
                                            <x-dropdown-link href="{{ route('root.gallery-index') }}" icon="images">
                                                Kegiatan IDBC
                                            </x-dropdown-link>
                                        </x-dropdown-section>
                                    </x-dropdown>
                                </li>

                                <!-- Kurikulum Dropdown -->
                                <li>
                                    <x-dropdown hover="true" width="64">
                                        <x-slot name="trigger">
                                            <button class="px-4 py-3 flex items-center text-sm font-medium hover:bg-teal-50 hover:text-teal-800 transition rounded-md text-gray-700">
                                                <i class="fas fa-graduation-cap mr-2"></i> Kurikulum <i class="fas fa-chevron-down ml-1 text-xs"></i>
                                            </button>
                                        </x-slot>

                                        <x-dropdown-section>
                                            @foreach ($fakultas as $faku)
                                                <x-nested-dropdown hover="true" width="64">
                                                    <x-slot name="trigger">
                                                        <span>{{ $faku->name }}</span>
                                                        <i class="fas fa-chevron-right text-xs"></i>
                                                    </x-slot>

                                                    <x-dropdown-section>
                                                        @php
                                                            $pstudi = \App\Models\ProgramStudi::where('faku_id', $faku->id)->get();
                                                        @endphp
                                                        @foreach ($pstudi as $item)
                                                            <x-dropdown-link href="{{ route('root.home-prodi', $item->slug) }}">
                                                                {{ $item->level . ' - ' . $item->name }}
                                                            </x-dropdown-link>
                                                        @endforeach
                                                    </x-dropdown-section>
                                                </x-nested-dropdown>
                                            @endforeach
                                        </x-dropdown-section>
                                    </x-dropdown>
                                </li>

                                <!-- Kompetensi Dropdown -->
                                <li>
                                    <x-dropdown hover="true" width="64">
                                        <x-slot name="trigger">
                                            <button class="px-4 py-3 flex items-center text-sm font-medium hover:bg-teal-50 hover:text-teal-800 transition rounded-md text-gray-700">
                                                <i class="fas fa-graduation-cap mr-2"></i> Kompetensi <i class="fas fa-chevron-down ml-1 text-xs"></i>
                                            </button>
                                        </x-slot>

                                        <x-dropdown-section>
                                            @foreach ($fakultas as $faku)
                                                <x-nested-dropdown hover="true" width="64">
                                                    <x-slot name="trigger">
                                                        <span>{{ $faku->name }}</span>
                                                        <i class="fas fa-chevron-right text-xs"></i>
                                                    </x-slot>

                                                    <x-dropdown-section>
                                                        @php
                                                            $pstudi = \App\Models\ProgramStudi::where('faku_id', $faku->id)->get();
                                                        @endphp
                                                        @foreach ($pstudi as $item)
                                                            <x-dropdown-link href="{{ route('root.home-prodi', $item->slug) }}">
                                                                {{ $item->level . ' - ' . $item->name }}
                                                            </x-dropdown-link>
                                                        @endforeach
                                                    </x-dropdown-section>
                                                </x-nested-dropdown>
                                            @endforeach
                                        </x-dropdown-section>
                                    </x-dropdown>
                                </li>

                                <li>
                                    <a href="{{ route('root.home-advice') }}"
                                       class="px-4 py-3 flex items-center text-sm font-medium hover:bg-teal-50 hover:text-teal-800 transition rounded-md
                                              {{ request()->routeIs('root.home-advice') ? 'text-teal-800 bg-teal-50' : 'text-gray-700' }}">
                                        <i class="fas fa-envelope-open-text mr-2"></i> Pendaftaran
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Mobile Menu -->
                    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
                        <div class="px-2 pt-2 pb-3 space-y-1">
                            <a href="{{ route('root.home-index') }}"
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-teal-50 hover:text-teal-800">
                                <i class="fas fa-home mr-2"></i> Beranda
                            </a>

                            <!-- Mobile Tentang Kami -->
                            <x-mobile-dropdown label="Tentang Kami" icon="globe">
                                <x-mobile-dropdown-link href="#">Sejarah</x-mobile-dropdown-link>
                                <x-mobile-dropdown-link href="#">Struktur Organisasi</x-mobile-dropdown-link>
                                <x-dropdown-link href="{{ route('visi-misi') }}">Visi & Misi</x-dropdown-link>

                                <div class="border-t border-gray-200 my-1"></div>

                                @foreach ($proku as $item)
                                    <x-mobile-dropdown-link href="#">{{ $item->name }}</x-mobile-dropdown-link>
                                @endforeach

                                <div class="border-t border-gray-200 my-1"></div>

                                <x-mobile-dropdown-link href="{{ route('root.gallery-index') }}" icon="images">
                                    Kegiatan IDBC
                                </x-mobile-dropdown-link>
                            </x-mobile-dropdown>

                            <!-- Mobile Fakultas -->
                            <x-mobile-dropdown label="Fakultas" icon="graduation-cap">
                                @foreach ($fakultas as $faku)
                                    <x-mobile-dropdown label="{{ $faku->name }}">
                                        @php
                                            $pstudi = \App\Models\ProgramStudi::where('faku_id', $faku->id)->get();
                                        @endphp
                                        @foreach ($pstudi as $item)
                                            <x-mobile-dropdown-link href="{{ route('root.home-prodi', $item->slug) }}">
                                                {{ $item->level . ' - ' . $item->name }}
                                            </x-mobile-dropdown-link>
                                        @endforeach
                                    </x-mobile-dropdown>
                                @endforeach
                            </x-mobile-dropdown>

                            <a href="{{ route('root.home-download') }}"
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-teal-50 hover:text-teal-800">
                               <i class="fas fa-file-pdf mr-2"></i> Dokumen
                            </a>

                            <a href="{{ route('root.home-advice') }}"
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-teal-50 hover:text-teal-800">
                               <i class="fas fa-envelope-open-text mr-2"></i> Saran
                            </a>

                            <a href="#"
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-teal-50 hover:text-teal-800">
                               <i class="fas fa-phone mr-2"></i> Kontak
                            </a>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Main Content -->
            <main class="flex-grow">
                <div class="container mx-auto px-4 py-6">
                    @include('sweetalert::alert')

                    @yield('content')
                </div>
            </main>
           <footer class="bg-teal-800 text-white py-10 mt-10">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 justify-items-start md:justify-items-center">
        <div class="flex flex-col items-start space-y-2">
            @if(isset($web->school_logo))
                <img src="{{ asset('storage/images/website/site-logo.png') }}" alt="Logo {{ $web->school_name }}" class="h-12 mb-2">
            @endif
            <span class="font-bold text-lg">{{ $web->school_name ?? 'IDBC' }}</span>
            <div class="flex space-x-4 mt-2">
                <a href="https://www.facebook.com/share/19USmPhp8t/" target="_blank" class="hover:text-teal-300">
                    <i class="fab fa-facebook fa-lg"></i>
                </a>
                <a href="https://www.instagram.com/idbc_official?igsh=MmJqbWZlb3l3b2U3" target="_blank" class="hover:text-teal-300">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
                <a href="https://www.youtube.com/@idbctv9935/videos" target="_blank" class="hover:text-teal-300">
                    <i class="fab fa-youtube fa-lg"></i>
                </a>
            </div>
        </div>

        <div class="mt-6 md:mt-0">
            <h4 class="font-semibold mb-3">Alamat</h4>
            <p>{{ $web->school_address ?? 'Jl. Semen Romo Cemani Gg. Melon No.5, Ngruki, Cemani, Kec. Grogol, Kabupaten Sukoharjo, Jawa Tengah 57552' }}</p>
            <p class="mt-2">Telp: {{ $web->school_phone ?? '-' }}</p>
            <p>Email: {{ $web->school_email ?? '-' }}</p>
        </div>

        <div class="mt-6 md:mt-0">
            <h4 class="font-semibold mb-3">Service</h4>
            <ul class="space-y-1">
                <li><a href="#" class="hover:text-teal-300">Akademik</a></li>
                <li><a href="#" class="hover:text-teal-300">Keuangan</a></li>
                <li><a href="#" class="hover:text-teal-300">Kemahasiswaan</a></li>
                <li><a href="#" class="hover:text-teal-300">Perpustakaan</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold mb-3">Company</h4>
            <ul class="space-y-1">
                <li><a href="#tentang" class="hover:text-teal-300">Tentang Kami</a></li>
                <li><a href="#prodi" class="hover:text-teal-300">Program Studi</a></li>
                <li><a href="#fasilitas" class="hover:text-teal-300">Fasilitas</a></li>
                <li><a href="#kontak" class="hover:text-teal-300">Kontak</a></li>
            </ul>
            <div class="mt-4 text-xs text-teal-200">Development: DKK</div>
        </div>
    </div>

    <div class="container mx-auto px-4 mt-8 text-center text-teal-200 text-xs">
        {{ \Carbon\Carbon::now()->translatedFormat('F Y') }} © {{ $web->school_apps }} - {{ $web->school_name }}
    </div>
</footer>

    <!-- Alpine JS for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Mobile menu toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function(e) {
                e.preventDefault();
                mobileMenu.classList.toggle('hidden');

                // Toggle icon between bars and times
                const icon = mobileMenuButton.querySelector('i');
                if (mobileMenu.classList.contains('hidden')) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                } else {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                }
            });
        });
    </script>

    <!-- Floating WhatsApp Button -->
<!-- Floating Buttons Container -->
<div class="fixed bottom-3 right-8 z-50 flex gap-4">
    <!-- Register Button -->
    <a href="{{ route('root.home-advice') }}" title="Pendaftaran Mahasiswa Baru"
        class="bg-blue-500 hover:bg-blue-600 rounded-full p-4 shadow-lg transition-transform transform hover:scale-110 flex items-center justify-center" style="width: 200px; height: 50px;">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 576 512" fill="currentColor">
            <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
        </svg>
        <span class="text-white ml-2">Pendaftaran</span>
    </a>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/6281314533067" target="_blank" title="Chat via WhatsApp"
        class="bg-green-500 hover:bg-green-600 rounded-full p-4 shadow-lg transition-transform transform hover:scale-110 flex items-center justify-center" style="width: 200px; height: 50px;">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 448 512" fill="currentColor">
            <path d="M380.9 97.1C339 55.1 283.3 32 224.2 32 103.5 32 .1 135.5.1 256.1c0 45.2 11.9 89.1 34.4 127.8L0 480l100.5-32.9c36.5 20 77.5 30.8 120 30.8h.1c120.7 0 224.1-103.5 224.1-224.1 0-59.1-23.1-114.8-65.1-156.7zM224.2 438c-36.6 0-72.4-10-103.6-28.9l-7.4-4.4-59.6 19.5 19.8-58.1-4.8-7.5C51.1 327 39.9 292.5 39.9 256.1 39.9 152.2 120.3 71.8 224.2 71.8c51.4 0 99.7 20 136 56.3 36.3 36.3 56.3 84.6 56.3 136 0 103.9-80.4 174.3-192.3 174.3zm101.8-138.3c-5.6-2.8-33.3-16.4-38.5-18.3-5.2-1.9-9-2.8-12.8 2.8s-14.7 18.3-18 22.1c-3.3 3.8-6.6 4.2-12.2 1.4-33.3-16.6-55.2-29.6-77.3-66.8-5.8-10 5.8-9.3 16.6-30.9 1.8-3.8.9-7-0.5-9.7s-12.8-30.9-17.5-42.3c-4.6-11.1-9.3-9.6-12.8-9.8-3.3-0.2-7.1-0.2-10.9-0.2s-10 1.4-15.2 7c-5.2 5.6-19.9 19.4-19.9 47.3s20.4 54.9 23.2 58.7c2.8 3.8 39.9 61 96.7 85.5 13.5 5.8 24 9.3 32.2 11.8 13.5 4.3 25.8 3.7 35.6 2.3 10.8-1.6 33.3-13.6 38-26.8 4.7-13.2 4.7-24.5 3.3-26.8-1.4-2.3-5.2-3.7-10.8-6.5z"/>
        </svg>
        <span class="text-white ml-2">WhatsApp</span>
    </a>
</div>

    @yie ld('custom-js')
</body>

</html>