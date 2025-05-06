<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $menu . $title }}</title>

    <!-- Favicon -->
    @if(isset($web->school_logo))
    <link rel="shortcut icon" href="{{ asset('storage/images/'. $web->school_logo) }}" type="image/x-icon">
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @yield('custom-css')

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
                            <img src="{{ asset('storage/images/' . $web->school_logo) }}"
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
                                            <img src="{{ asset('storage/images/default/default-profile.jpg') }}"
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
                                                Album Foto
                                            </x-dropdown-link>
                                        </x-dropdown-section>
                                    </x-dropdown>
                                </li>

                                <!-- Fakultas Dropdown -->
                                <li>
                                    <x-dropdown hover="true" width="64">
                                        <x-slot name="trigger">
                                            <button class="px-4 py-3 flex items-center text-sm font-medium hover:bg-teal-50 hover:text-teal-800 transition rounded-md text-gray-700">
                                                <i class="fas fa-graduation-cap mr-2"></i> Fakultas <i class="fas fa-chevron-down ml-1 text-xs"></i>
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
                                    <a href="{{ route('root.home-download') }}"
                                       class="px-4 py-3 flex items-center text-sm font-medium hover:bg-teal-50 hover:text-teal-800 transition rounded-md
                                              {{ request()->routeIs('root.home-download') ? 'text-teal-800 bg-teal-50' : 'text-gray-700' }}">
                                        <i class="fas fa-file-pdf mr-2"></i> Dokumen
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('root.home-advice') }}"
                                       class="px-4 py-3 flex items-center text-sm font-medium hover:bg-teal-50 hover:text-teal-800 transition rounded-md
                                              {{ request()->routeIs('root.home-advice') ? 'text-teal-800 bg-teal-50' : 'text-gray-700' }}">
                                        <i class="fas fa-envelope-open-text mr-2"></i> Saran
                                    </a>
                                </li>

                                <li>
                                    <a href="#"
                                       class="px-4 py-3 flex items-center text-sm font-medium hover:bg-teal-50 hover:text-teal-800 transition rounded-md text-gray-700">
                                        <i class="fas fa-phone mr-2"></i> Kontak
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
                                <x-mobile-dropdown-link href="#">Visi & Misi</x-mobile-dropdown-link>

                                <div class="border-t border-gray-200 my-1"></div>

                                @foreach ($proku as $item)
                                    <x-mobile-dropdown-link href="#">{{ $item->name }}</x-mobile-dropdown-link>
                                @endforeach

                                <div class="border-t border-gray-200 my-1"></div>

                                <x-mobile-dropdown-link href="{{ route('root.gallery-index') }}" icon="images">
                                    Album Foto
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

            <!-- Footer -->
            <footer class="bg-teal-800 text-white py-8">
                <div class="container mx-auto px-4">
                    @include('base.panel.base-panel-footer')
                </div>
            </footer>
        </div>
    </div>

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

    @yield('custom-js')
</body>

</html>
