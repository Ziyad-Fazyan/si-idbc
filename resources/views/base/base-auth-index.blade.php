<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/favicon.png">
    <title>{{ $title }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0C6E71',
                        secondary: '#FF6B35',
                        accent: '#F4F4F4',
                        'primary-light': '#0E7A7E',
                        'primary-dark': '#0A5B5E',
                        'secondary-light': '#FF7A47',
                        'secondary-dark': '#E5602F'
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    @stack('styles')

</head>

<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100 font-inter min-h-screen">
    <!-- Modern Top Navigation Bar -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo / Brand -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center group">
                        <div class="w-10 h-10 bg-[#0C6E71] rounded-lg flex items-center justify-center shadow">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h1 class="text-lg font-semibold text-gray-900">{{ $web->school_name }}</h1>
                            <p class="text-xs text-gray-500">Education Portal</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('admin.auth-signin-page') }}"
                       class="px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200
                              {{ Request::is('admin*') ? 'bg-[#0C6E71] text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Admin
                    </a>

                    <a href="{{ route('mahasiswa.auth-signin-page') }}"
                       class="px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200
                              {{ Request::is('mahasiswa*') ? 'bg-[#0C6E71] text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Siswa
                    </a>

                    <a href="{{ route('dosen.auth-signin-page') }}"
                       class="px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200
                              {{ Request::is('dosen*') ? 'bg-[#0C6E71] text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Guru
                    </a>

                    <a href="/"
                       class="ml-4 px-4 py-2 rounded-md text-sm font-medium bg-[#FF6B35] text-white hover:bg-[#caa16e] transition-colors duration-200">
                        Beranda
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <button type="button" class="md:hidden p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none"
                        id="menuBtn" aria-label="Toggle menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden transition-all duration-300 ease-out max-h-0 overflow-hidden" id="mobileMenu">
                <div class="pt-2 pb-4 space-y-1 border-t border-gray-200 mt-2">
                    <a href="{{ route('admin.auth-signin-page') }}"
                       class="block px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ Request::is('admin*') ? 'bg-gray-100 text-[#0C6E71]' : 'text-gray-700 hover:bg-gray-100' }}">
                        Portal Admin
                    </a>

                    <a href="{{ route('mahasiswa.auth-signin-page') }}"
                       class="block px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ Request::is('mahasiswa*') ? 'bg-gray-100 text-[#0C6E71]' : 'text-gray-700 hover:bg-gray-100' }}">
                        Portal Siswa
                    </a>

                    <a href="{{ route('dosen.auth-signin-page') }}"
                       class="block px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200
                              {{ Request::is('dosen*') ? 'bg-gray-100 text-[#0C6E71]' : 'text-gray-700 hover:bg-gray-100' }}">
                        Portal Guru
                    </a>

                    <a href="/"
                       class="block px-4 py-2 mt-2 text-sm font-medium rounded-md bg-gray-100 text-[#0C6E71]">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </header>

    <script>
    // Simple mobile menu toggle
    document.getElementById('menuBtn').addEventListener('click', function() {
        const menu = document.getElementById('mobileMenu');
        const isOpen = menu.classList.contains('max-h-0');

        if (isOpen) {
            menu.classList.remove('max-h-0');
            menu.classList.add('max-h-screen', 'py-2');
        } else {
            menu.classList.add('max-h-0');
            menu.classList.remove('max-h-screen', 'py-2');
        }
    });
    </script>



    <!-- Main Content -->
    <main class="flex-1 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-600">
                    © 2024 {{ $web->school_name }}. All rights reserved.
                </p>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <span class="text-xs text-gray-500">Powered by</span>
                    <div class="flex items-center space-x-1">
                        <div class="w-4 h-4 bg-gradient-to-br from-primary to-secondary rounded"></div>
                        <span class="text-sm font-medium text-gray-700">EduPortal</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
        /* Navigation Styles */
        .nav-item {
            @apply flex items-center space-x-2 px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-primary hover:bg-primary/5 transition-all duration-200;
        }

        .nav-active {
            @apply text-primary bg-primary/10 shadow-sm;
        }

        .btn-home {
            @apply flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-primary to-primary-light text-white rounded-lg text-sm font-medium hover:shadow-lg hover:from-primary-light hover:to-primary transition-all duration-200 transform hover:scale-105;
        }

        /* Mobile Navigation */
        .mobile-nav-item {
            @apply flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-600 hover:text-primary hover:bg-primary/5 transition-all duration-200;
        }

        .mobile-nav-active {
            @apply text-primary bg-primary/10;
        }

        .mobile-btn-home {
            @apply flex items-center space-x-3 px-4 py-3 bg-gradient-to-r from-primary to-primary-light text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200;
        }

        /* Mobile Menu Lines Animation */
        .menu-line {
            @apply block w-6 h-0.5 bg-current transition-all duration-300 ease-out;
        }

        .menu-line-1 {
            transform: translateY(-4px);
        }

        .menu-line-3 {
            transform: translateY(4px);
        }

        .menu-active .menu-line-1 {
            transform: translateY(0) rotate(45deg);
        }

        .menu-active .menu-line-2 {
            opacity: 0;
        }

        .menu-active .menu-line-3 {
            transform: translateY(0) rotate(-45deg);
        }

        /* Show mobile menu */
        .mobile-menu-open {
            max-height: 300px !important;
        }
    </style>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle with animation
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        menuBtn.addEventListener('click', function() {
            const isOpen = mobileMenu.classList.contains('mobile-menu-open');

            if (isOpen) {
                mobileMenu.classList.remove('mobile-menu-open');
                menuBtn.classList.remove('menu-active');
            } else {
                mobileMenu.classList.add('mobile-menu-open');
                menuBtn.classList.add('menu-active');
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('mobile-menu-open');
                menuBtn.classList.remove('menu-active');
            }
        });

        // Smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>

    @stack('scripts')

</body>

</html>
