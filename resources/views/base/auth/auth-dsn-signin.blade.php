@extends('base.base-auth-index')
@section('content')
    <section class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4 py-8">
        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">

            <!-- Left side - Illustration/Info -->
            <div class="hidden lg:flex flex-col justify-center space-y-8">
                <div class="text-center lg:text-left">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-secondary to-secondary-light rounded-2xl shadow-xl mb-6">
                        <i class="fas fa-chalkboard-teacher text-3xl text-white"></i>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                        Portal <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-secondary to-primary">Guru</span>
                    </h1>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Akses dashboard pengajar untuk mengelola kelas, materi pembelajaran, dan evaluasi siswa dengan mudah
                        dan efisien.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 shadow-sm">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-secondary/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book-open text-secondary"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Materi Ajar</p>
                                <p class="text-sm text-gray-600">Kelola pembelajaran</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 shadow-sm">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-clipboard-check text-primary"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Evaluasi</p>
                                <p class="text-sm text-gray-600">Penilaian siswa</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 shadow-sm">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users-class text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Kelas</p>
                                <p class="text-sm text-gray-600">Manajemen kelas</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 shadow-sm">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Jadwal</p>
                                <p class="text-sm text-gray-600">Pengaturan waktu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Login Form -->
            <div class="w-full max-w-md mx-auto lg:mx-0">
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/20 p-8">
                    <!-- Logo & Header -->
                    <div class="text-center mb-8">
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <img src="{{ asset('storage/images/' . $web->school_logo) }}" alt="School Logo"
                                    class="max-h-16 object-contain">
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Login Guru</h2>
                        <p class="text-gray-600">Masuk ke dashboard pengajar</p>
                    </div>

                    <!-- Alert component -->
                    @include('sweetalert::alert')

                    <!-- Login Form -->
                    <form action="{{ route('dosen.auth-signin-post') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- NIDN/Email/Phone Field -->
                        <div class="mb-4">
                            <label for="login" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-id-card text-gray-500 mr-2"></i>
                                NIDN / Email / Telepon
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="login" id="login"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-secondary focus:border-secondary sm:text-sm"
                                    placeholder="Masukkan NIDN, email atau nomor telepon" autocomplete="username">
                            </div>
                            @error('login')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-lock text-gray-500 mr-2"></i>
                                Password
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="password" name="password" id="password"
                                    class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-secondary focus:border-secondary sm:text-sm"
                                    placeholder="••••••••" autocomplete="current-password">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    id="togglePassword">
                                    <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="rememberMe" name="remember"
                                    class="h-4 w-4 text-secondary focus:ring-secondary border-gray-300 rounded">
                                <label for="rememberMe" class="ml-2 block text-sm text-gray-700 font-medium">
                                    Ingat saya
                                </label>
                            </div>
                            <a href="{{ route('dosen.auth-forgot-page') }}"
                                class="text-sm text-secondary hover:text-secondary-light font-medium transition-colors">
                                Lupa password?
                            </a>
                        </div>

                        <!-- Turnstile Widget -->
                        <div class="mt-4">
                            <x-turnstile-widget theme="auto" language="id" />
                            @error('cf-turnstile-response')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span>Masuk ke Dashboard</span>
                        </button>
                    </form>

                    <!-- Footer Links -->
                    <div class="mt-8 text-center space-y-3">
                        <div class="flex items-center">
                            <div class="flex-1 h-px bg-gray-200"></div>
                            <span class="px-4 text-sm text-gray-500">atau</span>
                            <div class="flex-1 h-px bg-gray-200"></div>
                        </div>

                        <a href="{{ route('root.home-index') }}"
                            class="inline-flex items-center text-sm text-gray-600 hover:text-secondary transition-colors font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="mt-6 text-center">
                    <div class="inline-flex items-center px-4 py-2 bg-orange-50 border border-orange-200 rounded-lg">
                        <svg class="w-4 h-4 mr-2 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-orange-700 font-medium">Dilindungi Cloudflare Turnstile</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            /* Form Styles - Teacher Specific */
            .form-group {
                @apply space-y-2;
            }

            .form-label {
                @apply flex items-center text-sm font-semibold text-gray-700;
            }

            .form-input-container {
                @apply relative;
            }

            .form-input-icon {
                @apply absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none;
            }

            .teacher-input {
                @apply w-full pl-10 pr-4 py-3 bg-white/80 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition-all duration-200 backdrop-blur-sm;
            }

            .teacher-input:focus {
                @apply bg-white shadow-lg;
            }

            .form-error {
                @apply text-sm text-red-600 font-medium flex items-center;
            }

            .form-error::before {
                content: "⚠";
                @apply mr-1;
            }

            .teacher-checkbox {
                @apply w-4 h-4 text-secondary bg-white border-2 border-gray-300 rounded focus:ring-secondary/20 focus:ring-2 transition-all duration-200;
            }

            .btn-teacher {
                @apply w-full bg-gradient-to-r from-secondary to-secondary-light hover:from-secondary-light hover:to-secondary text-white font-semibold py-3 px-6 rounded-xl focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:ring-offset-2 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02];
            }

            .teacher-turnstile {
                @apply bg-orange-50/80 rounded-xl p-4 border border-orange-200;
            }

            /* Responsive adjustments */
            @media (max-width: 1024px) {
                .teacher-input {
                    @apply py-3.5;
                }
            }

            /* Teacher-specific accent colors */
            .text-teacher-primary {
                color: #FF6B35;
            }

            .bg-teacher-primary {
                background-color: #FF6B35;
            }

            /* Additional teacher-themed elements */
            .teacher-badge {
                @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-secondary/10 text-secondary;
            }
        </style>

        <style>
            @keyframes fade-in-up {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in-up {
                animation: fade-in-up 0.6s ease-out forwards;
            }
        </style>
    @endpush

    <script>
        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle icon
            this.innerHTML = type === 'password' ?
                `<svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                   </svg>` :
                `<svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                   </svg>`;
        });

        // Form validation enhancement
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = `
                <div class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Memproses...</span>
                </div>
            `;
            button.disabled = true;
        });

        // Add subtle animation to feature cards
        const featureCards = document.querySelectorAll('.lg\\:grid > div');
        featureCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate-fade-in-up');
        });
    </script>
@endsection
