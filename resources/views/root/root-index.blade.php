@extends('base.base-root-index')

@section('title', 'IDBC (Tailwind CSS)')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .hero-overlay {
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.7) 100%);
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
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            will-change: transform, opacity;
            transform-style: preserve-3d;
            backface-visibility: hidden;
        }

        .competence-card {
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            will-change: transform, opacity;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            will-change: transform, opacity;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        section {
            will-change: transform, opacity;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Animation classes */
        .animate-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .animate-in.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Scroll direction detection */
        body {
            --scroll-direction: 0;
        }
    </style>

    <!-- Hero Slider -->
    <section class="relative h-screen overflow-hidden mt-0 lg:mt-0 custom-hero-slider">
        <button onclick="prevSlide()"
            class="custom-slider-prev absolute left-4 top-1/2 -translate-y-1/2 z-30 p-3 rounded-full bg-white bg-opacity-30 hover:bg-opacity-50 transition-all duration-300 text-white text-2xl hover:scale-110">
            &#10094; </button>
        <button onclick="nextSlide()"
            class="custom-slider-next absolute right-4 top-1/2 -translate-y-1/2 z-30 p-3 rounded-full bg-white bg-opacity-30 hover:bg-opacity-50 transition-all duration-300 text-white text-2xl hover:scale-110">
            &#10095; </button>

        <!-- Slide 1 -->
        @if (isset($landingContent['hero_slider']))
            @foreach ($landingContent['hero_slider']->additional_content as $slide)
                <div class="absolute inset-0 w-full h-full flex flex-col justify-center items-center p-5 bg-cover bg-center transition-all duration-800 ease-in-out transform translate-x-full opacity-0 custom-hero-slide custom-hero-slide-1"
                    style="background-image: url('{{ asset($slide['image']) }}');">
                    <div class="absolute inset-0 hero-overlay z-10"></div>
                    <div
                        class="relative z-20 max-w-4xl p-8 bg-white bg-opacity-90 rounded-xl shadow-xl text-center backdrop-blur-sm animate-in">
                        <h1 class="text-4xl lg:text-5xl font-bold mb-5 leading-tight text-gray-800">{{ $slide['title'] }}
                        </h1>
                        <p class="text-lg lg:text-xl text-gray-600 mb-8 leading-relaxed">{{ $slide['subtitle'] }}</p>
                        <a href="{{ $slide['button_link'] }}"
                            class="inline-block bg-gradient-to-r from-emerald-600 to-teal-500 text-white px-8 py-3 rounded-full text-lg font-semibold shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">{{ $slide['button_text'] }}</a>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="custom-slider-nav absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-2 z-30">
            @if (isset($landingContent['hero_slider']))
                @foreach ($landingContent['hero_slider']->additional_content as $index => $slide)
                    <div class="w-3 h-3 rounded-full bg-white bg-opacity-50 cursor-pointer custom-slider-dot {{ $index === 0 ? 'bg-opacity-100' : '' }}"
                        onclick="currentSlide({{ $index }})">
                    </div>
                @endforeach
            @endif
        </div>

        <div class="custom-slider-nav absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-2 z-30">
            <div
                class="custom-slider-dot w-3 h-3 bg-white bg-opacity-70 rounded-full cursor-pointer transition-all duration-300 hover:bg-white hover:scale-125">
            </div>
            <div
                class="custom-slider-dot w-3 h-3 bg-white bg-opacity-70 rounded-full cursor-pointer transition-all duration-300 hover:bg-white hover:scale-125">
            </div>
            <div
                class="custom-slider-dot w-3 h-3 bg-white bg-opacity-70 rounded-full cursor-pointer transition-all duration-300 hover:bg-white hover:scale-125">
            </div>
        </div>
    </section>

    <script>
        // Track scroll direction
        let lastScrollPosition = window.pageYOffset;
        document.addEventListener('scroll', function() {
            const currentScrollPosition = window.pageYOffset;
            document.body.style.setProperty('--scroll-direction', currentScrollPosition > lastScrollPosition ? 1 : -
                1);
            lastScrollPosition = currentScrollPosition;
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Hero Slider Logic
            const slides = document.querySelectorAll('.custom-hero-slide');
            const dots = document.querySelectorAll('.custom-slider-dot');
            let currentSlide = 0;
            let slideInterval;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    if (i === index) {
                        slide.style.transform = 'translateX(0)';
                        slide.style.opacity = '1';
                        slide.style.zIndex = '10';
                        slide.style.transition =
                            'transform 1s cubic-bezier(0.25, 0.1, 0.25, 1), opacity 1s ease';

                        // Animate content
                        const content = slide.querySelector('div');
                        if (content) {
                            content.style.transition = 'all 0.8s ease 0.3s';
                            content.style.opacity = '0';
                            content.style.transform = 'translateY(20px)';

                            // Trigger reflow to restart animation
                            void content.offsetWidth;

                            content.style.opacity = '1';
                            content.style.transform = 'translateY(0)';
                        }
                    } else {
                        slide.style.transform = i < index ? 'translateX(-100%)' : 'translateX(100%)';
                        slide.style.opacity = '0';
                        slide.style.zIndex = '0';
                        slide.style.transition =
                            'transform 1s cubic-bezier(0.25, 0.1, 0.25, 1), opacity 1s ease';
                    }
                });

                dots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.add('active', 'bg-white', 'scale-125');
                        dot.style.transform = 'scale(1.5)';
                        dot.style.backgroundColor = 'white';
                    } else {
                        dot.classList.remove('active', 'bg-white', 'scale-125');
                        dot.style.transform = 'scale(1)';
                        dot.style.backgroundColor = 'rgba(255, 255, 255, 0.7)';
                    }
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
                resetSlider();
            }

            function prevSlide() {
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

            document.querySelector('.custom-slider-prev').addEventListener('click', prevSlide);
            document.querySelector('.custom-slider-next').addEventListener('click', nextSlide);

            // Enhanced Section Animations with direction awareness
            const animatedElements = document.querySelectorAll(
                'section, .competence-card, .hover-scale, .video-container, .grid > div');

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Get scroll direction from CSS variable
                        const scrollDirection = parseInt(getComputedStyle(document.body)
                            .getPropertyValue('--scroll-direction'));

                        // Different animations based on element type and scroll direction
                        if (entry.target.classList.contains('competence-card')) {
                            entry.target.style.transform = 'scale(1)';
                            entry.target.style.opacity = '1';
                            entry.target.style.transition =
                                'all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                        } else if (entry.target.classList.contains('hover-scale')) {
                            entry.target.style.transform = 'translateY(0)';
                            entry.target.style.opacity = '1';
                            entry.target.style.transition =
                                'transform 0.6s ease, opacity 0.6s ease, box-shadow 0.3s ease';
                        } else if (entry.target.classList.contains('video-container')) {
                            entry.target.style.transform = 'scale(1)';
                            entry.target.style.opacity = '1';
                            entry.target.style.transition =
                                'transform 0.8s ease, opacity 0.8s ease';
                        } else {
                            // Direction-aware animation for sections
                            const translateY = scrollDirection > 0 ? '30px' : '-30px';
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                            entry.target.style.transition =
                                'opacity 0.8s ease, transform 0.8s ease';

                            // Animate child elements with staggered delays
                            const children = entry.target.querySelectorAll(
                                'h2, h3, p, img, a, div');
                            children.forEach((child, index) => {
                                child.style.opacity = '0';
                                child.style.transform = `translateY(${translateY})`;
                                child.style.transition = 'all 0.6s ease ' + (index * 0.1) +
                                    's';

                                // Trigger reflow to restart animation
                                void child.offsetWidth;

                                child.style.opacity = '1';
                                child.style.transform = 'translateY(0)';
                            });
                        }
                    } else {
                        // Reset animation when element leaves viewport
                        const scrollDirection = parseInt(getComputedStyle(document.body)
                            .getPropertyValue('--scroll-direction'));
                        const translateY = scrollDirection > 0 ? '30px' : '-30px';

                        if (!entry.target.classList.contains('custom-hero-slide')) {
                            entry.target.style.opacity = '0';

                            if (entry.target.classList.contains('competence-card')) {
                                entry.target.style.transform = 'scale(0.95)';
                            } else if (entry.target.classList.contains('hover-scale')) {
                                entry.target.style.transform = `translateY(${translateY})`;
                            } else if (entry.target.classList.contains('video-container')) {
                                entry.target.style.transform = 'scale(0.98)';
                            } else {
                                entry.target.style.transform = `translateY(${translateY})`;
                            }
                        }
                    }
                });
            }, observerOptions);

            animatedElements.forEach(element => {
                // Set initial state for animation
                if (!element.classList.contains('custom-hero-slide')) {
                    element.style.opacity = '0';

                    if (element.classList.contains('competence-card')) {
                        element.style.transform = 'scale(0.95)';
                    } else if (element.classList.contains('hover-scale')) {
                        element.style.transform = 'translateY(30px)';
                    } else if (element.classList.contains('video-container')) {
                        element.style.transform = 'scale(0.98)';
                    } else {
                        element.style.transform = 'translateY(30px)';
                    }

                    observer.observe(element);
                }
            });

            // Hover effects for cards
            const cards = document.querySelectorAll('.hover-scale');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-10px)';
                    card.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.25)';
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                    card.style.boxShadow =
                        '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
                });
            });

            // Button hover effects
            const buttons = document.querySelectorAll('a, button');
            buttons.forEach(button => {
                if (!button.classList.contains('custom-slider-prev') &&
                    !button.classList.contains('custom-slider-next') &&
                    !button.classList.contains('custom-slider-dot')) {

                    button.addEventListener('mouseenter', () => {
                        button.style.transform = 'scale(1.05)';
                    });

                    button.addEventListener('mouseleave', () => {
                        button.style.transform = 'scale(1)';
                    });
                }
            });

            // Image hover zoom effects
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                if (img.parentElement.classList.contains('group') ||
                    img.parentElement.classList.contains('hover-scale')) {

                    img.addEventListener('mouseenter', () => {
                        img.style.transform = 'scale(1.1)';
                        img.style.transition = 'transform 0.5s ease';
                    });

                    img.addEventListener('mouseleave', () => {
                        img.style.transform = 'scale(1)';
                    });
                }
            });
        });
    </script>

    <!-- Sambutan Founder -->
    <section id="sambutan-rektor" class="py-16 px-4 sm:px-6 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6"> <!-- Reduced gap -->
                @if (isset($landingContent['founder']))
                    <!-- Teks Sambutan -->
                    <div class="p-6 lg:p-10"> <!-- Reduced padding -->
                        <div class="mb-5"> <!-- Reduced margin -->
                            <h2 class="text-3xl lg:text-4xl font-bold text-teal-800 mb-12">Selamat Datang di IDBC</h2>
                        </div>

                        <div class="prose prose-lg max-w-none">
                            <p class="text-gray-600 mb-3"> <!-- Reduced margin -->
                                Assalamualaikum Warahmatullahi Wabarakatuh.
                            </p>
                            @if (isset($landingContent['founder']->additional_content['quote']) &&
                                    is_array($landingContent['founder']->additional_content['quote']))
                                @foreach ($landingContent['founder']->additional_content['quote'] as $quote)
                                    <p class="text-gray-600 mb-4">
                                        {{ $quote }}
                                    </p>
                                @endforeach
                            @endif
                        </div>

                        <div class="mt-6"> <!-- Reduced margin -->
                            <p class="text-lg font-bold text-gray-800">
                                {{ $landingContent['founder']->additional_content['name'] ?? '' }}</p>
                            <p class="text-emerald-600 font-medium">
                                {{ $landingContent['founder']->additional_content['position'] ?? '' }}</p>
                        </div>
                    </div>

                    <!-- Foto Founder -->
                    <div
                        class="relative flex items-center justify-center p-6 lg:p-8 bg-gradient-to-br from-emerald-50 to-teal-50">
                        <div class="relative w-full max-w-sm">
                            <!-- Main Photo Container with Double Border Effect -->
                            <div class="relative group">
                                <!-- Outer Glow Effect -->
                                <div
                                    class="absolute inset-0 rounded-lg bg-gradient-to-br from-emerald-400 to-teal-500 opacity-20 blur-sm group-hover:opacity-30 transition-opacity duration-300">
                                </div>

                                <!-- Inner White Border -->
                                <div class="absolute inset-0 rounded-lg border-4 border-white/80"></div>

                                <!-- Main Photo with Shadow -->
                                <div
                                    class="relative overflow-hidden rounded-lg shadow-lg transform transition duration-300 group-hover:scale-[1.02]">
                                    <img src="{{ asset($landingContent['founder']->image_path) }}"
                                        alt="{{ $landingContent['founder']->additional_content['name'] }}"
                                        class="w-full h-auto aspect-[3/4] object-cover object-top">

                                    <!-- Signature Badge -->
                                    <div
                                        class="absolute bottom-4 right-4 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-md shadow-sm border border-gray-100">
                                        <p class="font-semibold text-teal-800 text-xs leading-tight">
                                            {{ $landingContent['founder']->additional_content['name'] }}</p>
                                        <p class="text-[0.65rem] text-emerald-600 mt-0.5">
                                            {{ $landingContent['founder']->additional_content['position'] }}</p>
                                    </div>
                                </div>

                                <!-- Decorative Corner Elements -->
                                <div
                                    class="absolute top-0 left-0 w-16 h-16 border-t-4 border-l-4 border-emerald-400 opacity-50 rounded-tl-lg">
                                </div>
                                <div
                                    class="absolute bottom-0 right-0 w-16 h-16 border-b-4 border-r-4 border-teal-400 opacity-50 rounded-br-lg">
                                </div>
                            </div>

                            <!-- Background Decorative Elements -->
                            <div class="absolute -z-10 -top-4 -right-4 w-24 h-24 bg-emerald-100 rounded-full opacity-30">
                            </div>
                            <div class="absolute -z-10 -bottom-4 -left-4 w-20 h-20 bg-teal-100 rounded-full opacity-30">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- VISI & MISI -->
    <section id="visi-misi" class="py-16 px-5 bg-slate-50">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-teal-800 mb-16">Visi & Misi IDBC</h2>
            <div class="mb-20">
                <h3 class="text-3xl font-bold text-teal-700">{{ $landingContent['vision']->title }}</h3>
                <div class="w-24 h-1 bg-teal-600 mx-auto mt-3 mb-6"></div>
                <p class="max-w-3xl mx-auto text-gray-700 text-xl font-medium">
                    {{ $landingContent['vision']->content }}
                </p>
            </div>

            <div>
                <h3 class="text-3xl font-bold text-teal-700">{{ $landingContent['mission']->title }}</h3>
                <div class="w-24 h-1 bg-teal-600 mx-auto mt-3 mb-10"></div>

                <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($landingContent['mission']->additional_content['points'] as $point)
                        <div
                            class="bg-white rounded-xl shadow-lg p-6 text-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                            <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-xl bg-teal-100">
                                {!! $point['image'] !!}
                            </div>
                            <h4 class="text-base font-semibold text-gray-800 leading-relaxed">
                                {{ $point['Misi'] }}
                            </h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <!-- Fasilitas Kampus -->
    @if (isset($landingContent['facility']))
        <section id="fasilitas" class="py-20 px-5 bg-gradient-to-br from-gray-50 to-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-teal-800 mb-16">{{ $landingContent['facility']->title }}</h2>
                    <p class="max-w-3xl mx-auto mt-6 text-lg text-gray-600">
                        {{ $landingContent['facility']->content }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($landingContent['facility']->additional_content['points'] as $point)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-scale">
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset($point['image']) }}" alt="{{ $point['name'] }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                            <div class="p-6">
                                <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center mb-4">
                                    {!! $point['icon'] !!}
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $point['name'] }}</h3>
                                <p class="text-gray-600">{{ $point['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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

                        <h4 class="text-lg font-bold text-amber-700 mb-3">II. Make Business (merancang & membangun
                            perusahaan)</h4>
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
                        <p class="text-gray-600 mb-4">Acara wisuda dengan tema "Menjadi Teknopreneur Berkarakter" diikuti
                            oleh 120 lulusan terbaik</p>
                        <a href="#"
                            class="text-emerald-600 font-semibold hover:text-emerald-700 inline-flex items-center transition-all duration-300 hover:translate-x-1">
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
                        <p class="text-gray-600 mb-4">Diskusi tentang peluang bisnis syariah di era digital dengan praktisi
                            ekonomi Islam terkemuka</p>
                        <a href="#"
                            class="text-emerald-600 font-semibold hover:text-emerald-700 inline-flex items-center transition-all duration-300 hover:translate-x-1">
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
                        <p class="text-gray-600 mb-4">Mahasiswa IDBC belajar langsung praktik bisnis syariah di perusahaan
                            keuangan terkemuka</p>
                        <a href="#"
                            class="text-emerald-600 font-semibold hover:text-emerald-700 inline-flex items-center transition-all duration-300 hover:translate-x-1">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#"
                    class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-full font-semibold shadow-md transition-all duration-300 hover:scale-105">
                    Lihat Semua Berita
                    <i class="fas fa-arrow-right ml-2 transition-all duration-300 group-hover:translate-x-1"></i>
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
                        <iframe src="https://www.youtube.com/embed/LHMNqM3-RMk?autoplay=1&mute=1&rel=0&playsinline=1"
                            allow="autoplay; encrypted-media" allowfullscreen title="Proses Pembelajaran di IDBC">
                        </iframe>
                    </div>
                    <h3 class="text-xl font-bold mt-6 text-gray-800">Virtual Tour Kampus IDBC</h3>
                    <p class="text-gray-600 mt-2">Jelajahi fasilitas kampus IDBC secara virtual</p>
                </div>

                <div>
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/N0NIzGJrtpE?autoplay=1&mute=1&rel=0&playsinline=1"
                            allow="autoplay; encrypted-media" allowfullscreen title="Judul Video">
                        </iframe>
                    </div>
                    <h3 class="text-xl font-bold mt-6 text-gray-800">Proses Pembelajaran di IDBC</h3>
                    <p class="text-gray-600 mt-2">Metode pembelajaran yang inovatif dan efektif</p>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="https://www.youtube.com/@idbctv9935/videos" target="_blank"
                    class="inline-flex items-center text-emerald-600 font-semibold hover:text-emerald-700 transition-all duration-300 hover:translate-x-1">
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
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-all duration-300">
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
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-all duration-300">
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
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-all duration-300">
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
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <div>
                            <h3 class="text-white font-bold text-lg">Diskusi Kelompok</h3>
                            <p class="text-emerald-200 text-sm">Kolaborasi dalam pembelajaran</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#"
                    class="inline-flex items-center bg-white border border-emerald-600 text-emerald-600 hover:bg-emerald-50 px-6 py-3 rounded-full font-semibold shadow-sm transition-all duration-300 hover:scale-105">
                    Lihat Galeri Lengkap
                    <i class="fas fa-images ml-2 transition-all duration-300 group-hover:translate-x-1"></i>
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
            <div
                class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('storage/images/support/alwustho.png') }}" alt="Alwustho Land Technologies"
                    class="max-h-32 object-contain mb-4">
            </div>
            <div
                class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('storage/images/support/aflaha.png') }}" alt="Aflaha Hijab Expert Syar'i"
                    class="max-h-32 object-contain mb-4">
            </div>
            <div
                class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('storage/images/support/kampungit.png') }}" alt="Kampung IT Solo"
                    class="max-h-32 object-contain mb-4">
            </div>
        </div>
    </section>
@endsection
