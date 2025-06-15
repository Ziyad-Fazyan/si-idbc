@extends('base.base-root-index')

@section('title', 'IDBC (Tailwind CSS)')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .hero-overlay {
            background: linear-gradient(90deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.7) 100%);
        }
        .section-title {
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #0e9f6e, #3f83f8);
            border-radius: 2px;
        }
        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-scale:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .competence-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .competence-card:hover {
            transform: scale(1.03);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>

    <!-- Hero Slider -->
    <section class="relative h-screen overflow-hidden mt-0 lg:mt-0 custom-hero-slider">
        <button onclick="prevSlide()" class="custom-slider-prev absolute left-4 top-1/2 -translate-y-1/2 z-30 p-3 rounded-full bg-white bg-opacity-30 hover:bg-opacity-50 transition-all duration-300 text-white text-2xl">
            &#10094; </button>
        <button onclick="nextSlide()" class="custom-slider-next absolute right-4 top-1/2 -translate-y-1/2 z-30 p-3 rounded-full bg-white bg-opacity-30 hover:bg-opacity-50 transition-all duration-300 text-white text-2xl">
            &#10095; </button>

        <!-- untuk mengubah gambar -->
            <div class="absolute inset-0 w-full h-full flex flex-col justify-center items-center p-5 bg-cover bg-center transition-all duration-800 ease-in-out transform translate-x-full opacity-0 custom-hero-slide custom-hero-slide-1"
            style="background-image: url('{{ asset('storage/images/gallery/album-c.png') }}');">
            <!-- mulai dari url -->
             
            <div class="absolute inset-0 hero-overlay z-10"></div>
            <div class="relative z-20 max-w-4xl p-8 bg-white bg-opacity-90 rounded-xl shadow-xl text-center backdrop-blur-sm">
                <h1 class="text-4xl lg:text-5xl font-bold mb-5 leading-tight text-gray-800">Selamat Datang di IDBC</h1>
                <p class="text-lg lg:text-xl text-gray-600 mb-8 leading-relaxed">Mencetak generasi pemimpin masa depan melalui pendidikan berkualitas dan pengembangan karakter berbasis teknologi</p>
                <a href="#pendaftaran" class="inline-block bg-gradient-to-r from-emerald-600 to-teal-500 text-white px-8 py-3 rounded-full text-lg font-semibold shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">Daftar Sekarang</a>
            </div>
        </div>

        <!-- untuk mengubah gambar -->
        <div class="absolute inset-0 w-full h-full flex flex-col justify-center items-center p-5 bg-cover bg-center transition-all duration-800 ease-in-out transform translate-x-full opacity-0 custom-hero-slide custom-hero-slide-2"
            style="background-image: url('{{ asset('storage/images/gallery/album-a.png') }}');">
           <!-- mulai dari url -->

            <div class="absolute inset-0 hero-overlay z-10"></div>
            <div class="relative z-20 max-w-4xl p-8 bg-white bg-opacity-90 rounded-xl shadow-xl text-center backdrop-blur-sm">
                <h1 class="text-4xl lg:text-5xl font-bold mb-5 leading-tight text-gray-800">Pendidikan Berbasis Teknologi</h1>
                <p class="text-lg lg:text-xl text-gray-600 mb-8 leading-relaxed">Kurikulum inovatif yang dirancang untuk memenuhi tantangan global dengan fasilitas pendidikan terbaik</p>
                <a href="#fakultas" class="inline-block bg-gradient-to-r from-emerald-600 to-teal-500 text-white px-8 py-3 rounded-full text-lg font-semibold shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">Lihat Program Studi</a>
            </div>
        </div>

        <!-- untuk mengubah gambar -->
        <div class="absolute inset-0 w-full h-full flex flex-col justify-center items-center p-5 bg-cover bg-center transition-all duration-800 ease-in-out transform translate-x-full opacity-0 custom-hero-slide custom-hero-slide-3"
            style="background-image: url('{{ asset('storage/images/gallery/album-b .png') }}');">
            <!-- mulai dari url -->

            <div class="absolute inset-0 hero-overlay z-10"></div>
            <div class="relative z-20 max-w-4xl p-8 bg-white bg-opacity-90 rounded-xl shadow-xl text-center backdrop-blur-sm">
                <h1 class="text-4xl lg:text-5xl font-bold mb-5 leading-tight text-gray-800">Kampus Modern & Nyaman</h1>
                <p class="text-lg lg:text-xl text-gray-600 mb-8 leading-relaxed">Lingkungan kampus yang asri dilengkapi fasilitas modern untuk pengembangan diri</p>
                <a href="#fasilitas" class="inline-block bg-gradient-to-r from-emerald-600 to-teal-500 text-white px-8 py-3 rounded-full text-lg font-semibold shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">Lihat Fasilitas</a>
            </div>
        </div>

        <div class="custom-slider-nav absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-2 z-30">
            <div class="custom-slider-dot w-3 h-3 bg-white bg-opacity-70 rounded-full cursor-pointer transition-all duration-300 hover:bg-white"></div>
            <div class="custom-slider-dot w-3 h-3 bg-white bg-opacity-70 rounded-full cursor-pointer transition-all duration-300"></div>
            <div class="custom-slider-dot w-3 h-3 bg-white bg-opacity-70 rounded-full cursor-pointer transition-all duration-300"></div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('.custom-hero-slide');
            const dots = document.querySelectorAll('.custom-slider-dot');
            let currentSlide = 0;
            let slideInterval;

            window.showSlide = function(index) {
                slides.forEach((slide, i) => {
                    if (i === index) {
                        slide.classList.add('active');
                        slide.classList.remove('translate-x-full');
                        slide.classList.remove('-translate-x-full');
                        slide.classList.add('opacity-100');
                    } else if (i < index) {
                        slide.classList.remove('active');
                        slide.classList.add('-translate-x-full');
                        slide.classList.remove('translate-x-full');
                        slide.classList.remove('opacity-100');
                    } else {
                        slide.classList.remove('active');
                        slide.classList.add('translate-x-full');
                        slide.classList.remove('-translate-x-full');
                        slide.classList.remove('opacity-100');
                    }
                });

                dots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.add('active');
                        dot.classList.add('bg-white');
                        dot.classList.add('scale-125');
                    } else {
                        dot.classList.remove('active');
                        dot.classList.remove('bg-white');
                        dot.classList.remove('scale-125');
                    }
                });
            }

            window.nextSlide = function() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
                resetSlider();
            }

            window.prevSlide = function() {
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(currentSlide);
                resetSlider();
            }

            function startSlider() {
                slideInterval = setInterval(nextSlide, 5000);
            }

            function resetSlider() {
                clearInterval(slideInterval);
                startSlider();
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                    resetSlider();
                });
            });

            showSlide(currentSlide);
            startSlider();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('.custom-hero-slide');
            const dots = document.querySelectorAll('.custom-slider-dot');
            let currentSlide = 0;
            let slideInterval;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    if (i === index) {
                        slide.classList.add('active');
                        slide.classList.remove('translate-x-full');
                        slide.classList.remove('-translate-x-full');
                        slide.classList.add('opacity-100');
                    } else if (i < index) {
                        slide.classList.remove('active');
                        slide.classList.add('-translate-x-full');
                        slide.classList.remove('translate-x-full');
                        slide.classList.remove('opacity-100');
                    } else {
                        slide.classList.remove('active');
                        slide.classList.add('translate-x-full');
                        slide.classList.remove('-translate-x-full');
                        slide.classList.remove('opacity-100');
                    }
                });

                dots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.add('active');
                        dot.classList.add('bg-white');
                        dot.classList.add('scale-125');
                    } else {
                        dot.classList.remove('active');
                        dot.classList.remove('bg-white');
                        dot.classList.remove('scale-125');
                    }
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            function startSlider() {
                slideInterval = setInterval(nextSlide, 5000);
            }

            function resetSlider() {
                clearInterval(slideInterval);
                startSlider();
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                    resetSlider();
                });
            });

            showSlide(currentSlide);
            startSlider();
        });
    </script>
    
    <!-- Sambutan Founder -->
    <section id="sambutan-rektor" class="py-20 px-5 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="p-8 lg:p-12">
                    <div class="mb-6">
                        <h2 class="text-4xl font-bold text-teal-800 mb-16">Selamat Datang di IDBC</h2>
                    </div>
                    
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-600 mb-4">
                            Assalamualaikum Warahmatullahi Wabarakatuh.
                        </p>
                        <p class="text-gray-600 mb-4">
                            Di semua negara maju, hal yang paling menonjol adalah tentang kemajuan literasi, kedisiplinan, dan penghargaan terhadap profesi. Selain tentu saja kemajuan dalam hal informasi dan teknologi.
                        </p>
                        <p class="text-gray-600 mb-4">
                            Dan yang lebih penting, bahwa yang mendasari semua kemajuan itu adalah faktor pendidikan. Sistem pendidikan, kurikulum, metode dan perhatian dari pemerintah, saling terkait dan tidak bisa dipisahkan.
                        </p>
                        <p class="text-gray-600 mb-4">
                            Indonesia, dalam pendidikan dan literasi sangat ketinggalan jauh dari negara-negara maju. Sehingga kepedulian kita terhadap percepatan pendidikan melalui sarana prasarana IT dan digital, sangat diperlukan.
                        </p>
                        <p class="text-gray-600">
                            Kampung IT Solo, sejak tahun 2014 sudah merintis dan memikirkan akan hal ini. Dan sampai tahun 2024 ini, Kampung IT Solo sudah banyak mewarnai dunia pendidikan dan dakwah baik di dalam maupun di luar negeri, melalui berbagai produk-produknya.
                        </p>
                    </div>
                    
                    <div class="mt-8">
                        <p class="text-lg font-bold text-gray-800">USTADZ JUNAEDY ALFAN</p>
                        <p class="text-emerald-600 font-medium">Founder IDBC</p>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-400 opacity-10 z-0"></div>
                    <div class="relative h-full flex items-center justify-center p-8 lg:p-12">
                        <div class="text-center">
                            <div class="inline-block rounded-full p-1 bg-gradient-to-r from-emerald-500 to-teal-400">
                                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                     alt="Founder IDBC" 
                                     class="rounded-full w-64 h-64 object-cover border-4 border-white shadow-xl">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- VISI & MISI -->
   <section id="visi-misi" class="py-16 px-5 bg-slate-50">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold text-teal-800 mb-16">Visi & Misi IDBC</h2>
        <div class="mb-20">
            <h3 class="text-3xl font-bold text-teal-700">Visi</h3>
            <div class="w-24 h-1 bg-teal-600 mx-auto mt-3 mb-6"></div>
            <p class="max-w-3xl mx-auto text-gray-700 text-xl font-medium">
                Melahirkan Kader Da'i Teknopreneur (Programer & Entrepreneur)
            </p>
        </div>

        <div>
            <h3 class="text-3xl font-bold text-teal-700">Misi</h3>
            <div class="w-24 h-1 bg-teal-600 mx-auto mt-3 mb-10"></div>
            
            <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="bg-white rounded-xl shadow-lg p-6 text-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-xl bg-teal-100">
                        <i class="fas fa-graduation-cap text-4xl text-teal-700"></i>
                    </div>
                    <h4 class="text-base font-semibold text-gray-800 leading-relaxed">
                        Menjadi alternatif pendidikan yang efisien sesuai dengan syariat dan tuntutan zaman
                    </h4>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 text-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-xl bg-teal-100">
                        <i class="fas fa-network-wired text-4xl text-teal-700"></i>
                    </div>
                    <h4 class="text-base font-semibold text-gray-800 leading-relaxed">
                        Optimalisasi & integrasi teknologi dalam pendidikan dan dakwah.
                    </h4>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 text-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-xl bg-teal-100">
                        <i class="fas fa-mosque text-4xl text-teal-700"></i>
                    </div>
                    <h4 class="text-base font-semibold text-gray-800 leading-relaxed">
                        Menerapkan konsep pendidikan robbany sesuai dengan manhaj salaf.
                    </h4>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 text-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-xl bg-teal-100">
                        <i class="fas fa-hands-helping text-4xl text-teal-700"></i>
                    </div>
                    <h4 class="text-base font-semibold text-gray-800 leading-relaxed">
                        Mewujudkan manusia menjadi hamba dan khalifah.
                    </h4>
                </div>

            </div>
        </div>

    </div>
</section>

    
    <!-- Fasilitas Kampus -->
    <section id="fasilitas" class="py-20 px-5 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-teal-800 mb-16">Sarana Pendukung Pendidikan IDBC</h2>
                <p class="max-w-3xl mx-auto mt-6 text-lg text-gray-600">
                    Fasilitas modern untuk mendukung proses belajar, praktik, dan pengembangan diri para santri
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" 
                             alt="Free Wifi Hotspot" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center mb-4">
                            <i class="fas fa-wifi text-xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Free Wifi Hotspot</h3>
                        <p class="text-gray-600">Akses internet nirkabel 24 jam di seluruh area kampus untuk menunjang kebutuhan belajar dan riset</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" 
                             alt="Asrama & Tempat Belajar" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center mb-4">
                            <i class="fas fa-bed text-xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Asrama & Tempat Belajar</h3>
                        <p class="text-gray-600">Lingkungan asrama yang nyaman dan kondusif, terintegrasi dengan ruang belajar bersama</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" 
                             alt="Lab. Bisnis Entrepreneur" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center mb-4">
                            <i class="fas fa-store text-xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Lab. Bisnis Entrepreneur</h3>
                        <p class="text-gray-600">Tempat praktik dan pengembangan jiwa kewirausahaan serta ide-ide bisnis inovatif</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1497636577773-f1231844b336?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" 
                             alt="Bookless Library System" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center mb-4">
                            <i class="fas fa-tablet-alt text-xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Bookless Library System</h3>
                        <p class="text-gray-600">Sistem perpustakaan modern dengan akses ke ribuan koleksi buku dan jurnal digital</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1550439062-609e1531270e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" 
                             alt="Laboratorium Digital Smart Lab" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center mb-4">
                            <i class="fas fa-laptop-code text-xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Laboratorium Digital Smart Lab</h3>
                        <p class="text-gray-600">Lab komputer dengan perangkat terkini untuk mendukung pembelajaran pemrograman dan teknologi</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" 
                             alt="Lab. Bisnis Fashion" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center mb-4">
                            <i class="fas fa-tshirt text-xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Lab. Bisnis Fashion</h3>
                        <p class="text-gray-600">Fasilitas untuk mengembangkan kreativitas, desain, dan keterampilan dalam bisnis fashion</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Triple Kompetensi -->
    <section id="prestasi" class="py-20 px-5 bg-gradient-to-br from-teal-50 to-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-teal-800 mb-16">Triple Kompetensi IDBC</h2>
                <p class="max-w-3xl mx-auto mt-6 text-lg text-gray-600">
                    Kompetensi unggulan yang dikembangkan di IDBC untuk mencetak generasi pemimpin masa depan
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="competence-card bg-white rounded-2xl shadow-lg overflow-hidden border border-emerald-100">
                    <div class="bg-gradient-to-r from-emerald-600 to-teal-500 py-8 text-center">
                        <div class="text-white text-5xl mb-4"><i class="fas fa-user-tie"></i></div>
                        <h3 class="text-3xl font-bold text-white">DA'I</h3>
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-emerald-700 mb-3">Memiliki:</h4>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Adab Islam yang Paripurna</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Worldview keislaman yang lurus</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Tahfidz & Tahsin Quran Kualitas Sanad</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Skill Jurnalistik yang baik</span>
                            </li>
                        </ul>
                        
                        <h4 class="text-lg font-bold text-emerald-700 mb-3">Menguasai:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Ilmu-ilmu Fardhu Ain</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Literasi dan Eksplorasi Digital</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Public Speaking yang baik</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="competence-card bg-white rounded-2xl shadow-lg overflow-hidden border border-blue-100">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-500 py-8 text-center">
                        <div class="text-white text-5xl mb-4"><i class="fas fa-laptop-code"></i></div>
                        <h3 class="text-3xl font-bold text-white">TECHNO</h3>
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-blue-700 mb-3">Menguasai:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Teknik Jaringan Komputer</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Instalasi Hardware & Software serta Troubleshooting</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Desain Grafis</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Multimedia dan Animasi</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Web Programming</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Mobile Apps</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="competence-card bg-white rounded-2xl shadow-lg overflow-hidden border border-amber-100">
                    <div class="bg-gradient-to-r from-amber-600 to-yellow-500 py-8 text-center">
                        <div class="text-white text-5xl mb-4"><i class="fas fa-briefcase"></i></div>
                        <h3 class="text-3xl font-bold text-white">PRENEUR</h3>
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-amber-700 mb-3">I. Make Money (memiliki real income)</h4>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Mindset Entrepreneur</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Memahami Konsep Bisnis Online</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Menguasai Tool Digital Marketing</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Memiliki usaha dan income minimal Rp 1 juta/bln</span>
                            </li>
                        </ul>
                        
                        <h4 class="text-lg font-bold text-amber-700 mb-3">II. Make Business (merancang & membangun perusahaan)</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Mampu membuat Business Model</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Menguasai 4 Pilar Bisnis</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Memahami Fiqih Muamalah Klasik & Kontemporer</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Berita IDBC -->
    <section class="py-20 px-5 bg-gradient-to-br from-teal-50 to-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-teal-800 mb-16">Berita IDBC</h2>
                <p class="max-w-3xl mx-auto mt-6 text-lg text-gray-600">
                    Informasi terbaru seputar kegiatan dan prestasi IDBC
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                    <div class="h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" 
                             alt="Wisuda IDBC" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <span class="text-sm font-medium text-emerald-600">Acara Akademik</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-3 mb-3">Wisuda Angkatan ke-5 IDBC</h3>
                        <p class="text-gray-600 mb-4">Acara wisuda dengan tema "Menjadi Teknopreneur Berkarakter" diikuti oleh 120 lulusan terbaik</p>
                        <a href="#" class="text-emerald-600 font-semibold hover:text-emerald-700 inline-flex items-center">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                    <div class="h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1471&q=80" 
                             alt="Seminar Ekonomi Islam" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <span class="text-sm font-medium text-emerald-600">Kegiatan Kampus</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-3 mb-3">Seminar Ekonomi Islam</h3>
                        <p class="text-gray-600 mb-4">Diskusi tentang peluang bisnis syariah di era digital dengan praktisi ekonomi Islam terkemuka</p>
                        <a href="#" class="text-emerald-600 font-semibold hover:text-emerald-700 inline-flex items-center">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                    <div class="h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1541178735493-479c1a27ed24?ixlib=rb-4.0.3&auto=format&fit=crop&w=1471&q=80" 
                             alt="Kunjungan Industri" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <span class="text-sm font-medium text-emerald-600">Kegiatan Mahasiswa</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-3 mb-3">Kunjungan Industri Keuangan Syariah</h3>
                        <p class="text-gray-600 mb-4">Mahasiswa IDBC belajar langsung praktik bisnis syariah di perusahaan keuangan terkemuka</p>
                        <a href="#" class="text-emerald-600 font-semibold hover:text-emerald-700 inline-flex items-center">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-full font-semibold shadow-md transition-all duration-300">
                    Lihat Semua Berita
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- YouTube Video Section -->
    <section class="py-20 px-5 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-teal-800 mb-16">Kanal Youtube IDBC</h2>
                <p class="max-w-3xl mx-auto mt-6 text-lg text-gray-600">
                    Dokumentasi kegiatan dan informasi terbaru dari IDBC
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div>
                    <div class="video-container">
                        <iframe
                            src="https://www.youtube.com/embed/LHMNqM3-RMk?autoplay=1&mute=1&rel=0&playsinline=1"
                            allow="autoplay; encrypted-media"
                            allowfullscreen
                            title="Proses Pembelajaran di IDBC">
                        </iframe>
                    </div>
                    <h3 class="text-xl font-bold mt-6 text-gray-800">Virtual Tour Kampus IDBC</h3>
                    <p class="text-gray-600 mt-2">Jelajahi fasilitas kampus IDBC secara virtual</p>
                </div>

                <div>
                    <div class="video-container">
                        <iframe
                            src="https://www.youtube.com/embed/N0NIzGJrtpE?autoplay=1&mute=1&rel=0&playsinline=1"
                            allow="autoplay; encrypted-media"
                            allowfullscreen
                            title="Judul Video">
                        </iframe>
                    </div>
                    <h3 class="text-xl font-bold mt-6 text-gray-800">Proses Pembelajaran di IDBC</h3>
                    <p class="text-gray-600 mt-2">Metode pembelajaran yang inovatif dan efektif</p>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="https://www.youtube.com/@idbctv9935/videos" target="_blank" class="inline-flex items-center text-emerald-600 font-semibold hover:text-emerald-700">
                    <span>Lihat Lebih Banyak Video</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Aktifitas Kampus -->
    <section class="py-20 px-5 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-teal-800 mb-16">Aktifitas IDBC</h2>
                <p class="max-w-3xl mx-auto mt-6 text-lg text-gray-600">
                    Dokumentasi kegiatan di lingkungan IDBC
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="relative group overflow-hidden rounded-2xl h-64">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" 
                         alt="Kegiatan Belajar" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div>
                            <h3 class="text-white font-bold text-lg">Kegiatan Belajar</h3>
                            <p class="text-emerald-200 text-sm">Sesi pembelajaran interaktif</p>
                        </div>
                    </div>
                </div>
                
                <div class="relative group overflow-hidden rounded-2xl h-64">
                    <img src="https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&auto=format&fit=crop&w=1986&q=80" 
                         alt="Laboratorium Komputer" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div>
                            <h3 class="text-white font-bold text-lg">Laboratorium Komputer</h3>
                            <p class="text-emerald-200 text-sm">Fasilitas pembelajaran teknologi</p>
                        </div>
                    </div>
                </div>
                
                <div class="relative group overflow-hidden rounded-2xl h-64">
                    <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" 
                         alt="Perpustakaan Digital" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div>
                            <h3 class="text-white font-bold text-lg">Perpustakaan Digital</h3>
                            <p class="text-emerald-200 text-sm">Akses literasi tanpa batas</p>
                        </div>
                    </div>
                </div>
                
                <div class="relative group overflow-hidden rounded-2xl h-64">
                    <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" 
                         alt="Diskusi Kelompok" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div>
                            <h3 class="text-white font-bold text-lg">Diskusi Kelompok</h3>
                            <p class="text-emerald-200 text-sm">Kolaborasi dalam pembelajaran</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center bg-white border border-emerald-600 text-emerald-600 hover:bg-emerald-50 px-6 py-3 rounded-full font-semibold shadow-sm transition-all duration-300">
                    Lihat Galeri Lengkap
                    <i class="fas fa-images ml-2"></i>
                </a>
            </div>
        </div>
    </section>
    
    <!-- SUPPORT PARTNER -->
    <section id="support-partner" class="py-16 px-5 bg-gray-100">
    <div class="text-center mb-12 relative">
        <h2 class="text-4xl font-bold text-teal-800 mb-16">Support Partner IDBC</h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-screen-xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center justify-center">
            <img src="{{ asset('storage/images/support/alwustho.png') }}" 
                alt="Alwustho Land Technologies" 
                class="max-h-32 object-contain mb-4">
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center justify-center">
            <img src="{{ asset('storage/images/support/aflaha.png') }}" 
                alt="Aflaha Hijab Expert Syar'i" 
                class="max-h-32 object-contain mb-4">
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center justify-center">
            <img src="{{ asset('storage/images/support/kampungit.png') }}" 
                alt="Kampung IT Solo" 
                class="max-h-32 object-contain mb-4">
        </div>
    </div>
</section>
@endsection