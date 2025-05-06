<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/favicon.png">
    <title>{{ $title }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Custom styles that can't be done with standard Tailwind */
        .gradient-bg {
            background: linear-gradient(135deg, #15803d 0%, #16a34a 100%);
        }

        .nav-link {
            transition: all 0.3s ease;
            color: #4b5563;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
        }

        .nav-link:hover {
            color: #16a34a;
            background-color: #f0fdf4;
        }

        .nav-link.active {
            color: #16a34a;
            background-color: #f0fdf4;
            font-weight: 600;
        }

        .btn {
            transition: all 0.3s ease-in-out;
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: white;
            border: 2px solid transparent;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.2);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #16a34a;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #15803d;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative gradient-bg text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-green-900 opacity-60"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-green-900"></div>
        </div>

        <!-- Sticky Top Navigation Bar -->
        <div class="fixed top-0 left-0 right-0 z-50">
            <div class="container mx-auto px-4 py-4">
                <div class="w-full">
                    <!-- Navbar -->
                    <nav class="backdrop-blur-md bg-white/80 rounded-lg shadow-lg py-3 px-6 mx-4 transition-all duration-300">
                        <div class="container mx-auto">
                            <div class="flex justify-between items-center">
                                <!-- Logo / Brand -->
                                <a class="font-bold text-xl text-gray-800 hover:text-green-600 flex items-center"
                                    href="/">
                                    <svg class="h-8 w-8 mr-2 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                                    </svg>
                                    <span>{{ $web->school_name }}</span>
                                </a>

                                <!-- Mobile menu button -->
                                <div class="md:hidden">
                                    <button type="button"
                                        class="block text-gray-700 hover:text-green-600 focus:outline-none"
                                        id="menuBtn" aria-label="Toggle menu">
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Desktop Navigation -->
                                <div class="hidden md:flex md:items-center md:justify-between md:flex-1 md:ml-10">
                                    <div class="flex space-x-1">
                                        <a class="nav-link {{ Request::is('admin*') ? 'active' : '' }}" href="{{ route('admin.auth-signin-page') }}">
                                            <i class="fas fa-user-shield mr-1"></i> Admin
                                        </a>
                                        <a class="nav-link {{ Request::is('mahasiswa*') ? 'active' : '' }}" href="{{ route('mahasiswa.auth-signin-page') }}">
                                            <i class="fas fa-user-graduate mr-1"></i> Siswa
                                        </a>
                                        <a class="nav-link {{ Request::is('dosen*') ? 'active' : '' }}" href="{{ route('dosen.auth-signin-page') }}">
                                            <i class="fas fa-chalkboard-teacher mr-1"></i> Guru
                                        </a>
                                    </div>
                                    <div class="hidden md:block">
                                        <a href="/" class="btn btn-primary">
                                            <i class="fas fa-home mr-1"></i> Home
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile menu, show/hide based on menu state -->
                            <div class="hidden md:hidden mt-4 border-t border-gray-200 pt-4" id="mobileMenu">
                                <div class="flex flex-col space-y-2">
                                    <a class="nav-link {{ Request::is('admin*') ? 'active' : '' }}" href="{{ route('admin.auth-signin-page') }}">
                                        <i class="fas fa-user-shield mr-2"></i> Portal Admin
                                    </a>
                                    <a class="nav-link {{ Request::is('mahasiswa*') ? 'active' : '' }}" href="{{ route('mahasiswa.auth-signin-page') }}">
                                        <i class="fas fa-user-graduate mr-2"></i> Portal Siswa
                                    </a>
                                    <a class="nav-link {{ Request::is('dosen*') ? 'active' : '' }}" href="{{ route('dosen.auth-signin-page') }}">
                                        <i class="fas fa-chalkboard-teacher mr-2"></i> Portal Guru
                                    </a>
                                    <div class="mt-4">
                                        <a href="/" class="btn btn-primary block text-center">
                                            <i class="fas fa-home mr-1"></i> Home Page
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
        </div>

        <div class="relative container mx-auto px-4 py-32 sm:py-40">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Selamat Datang di Portal Sekolah</h1>
                <p class="text-lg md:text-xl text-indigo-100 max-w-2xl mx-auto mb-8">
                    Akses informasi akademik, jadwal kuliah, dan layanan kampus dalam satu platform terintegrasi
                </p>
            </div>
        </div>

        <!-- Wave separator -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="text-gray-50 w-full h-auto">
                <path fill="currentColor" fill-opacity="1"
                    d="M0,64L80,80C160,96,320,128,480,122.7C640,117,800,75,960,64C1120,53,1280,75,1360,85.3L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
                </path>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <main class="min-h-screen mt-8 pb-8">
        <div class="container mx-auto px-4">
            <!-- Content Area -->
            <div class="bg-white rounded-xl shadow-md p-6 md:p-6">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-12 bg-gradient-to-br from-green-800 to-green-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-5"></div>
        <div class="container mx-auto px-4 relative">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-center md:text-left flex items-center space-x-4">
                    <svg class="h-10 w-10 text-white transform hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                    <span class="font-bold text-xl hover:text-green-300 transition-colors duration-300">{{ $web->school_name }}</span>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="#" class="text-gray-300 hover:text-white hover:underline transform hover:-translate-y-1 transition-all duration-300 text-sm md:text-base">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-300 hover:text-white hover:underline transform hover:-translate-y-1 transition-all duration-300 text-sm md:text-base">Syarat & Ketentuan</a>
                    <a href="#" class="text-gray-300 hover:text-white hover:underline transform hover:-translate-y-1 transition-all duration-300 text-sm md:text-base">Peta Situs</a>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-sm text-gray-300 hover:text-white transition-colors duration-300">© {{ date('Y') }} {{ $web->school_name }}. Hak Cipta Dilindungi.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        document.getElementById('menuBtn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });

        // Scroll handling for navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 10) {
                navbar.classList.add('bg-white/90');
                navbar.classList.add('shadow-xl');
                navbar.classList.remove('bg-white/80');
                navbar.classList.remove('shadow-lg');
            } else {
                navbar.classList.add('bg-white/80');
                navbar.classList.add('shadow-lg');
                navbar.classList.remove('bg-white/90');
                navbar.classList.remove('shadow-xl');
            }
        });
    </script>
</body>

</html>