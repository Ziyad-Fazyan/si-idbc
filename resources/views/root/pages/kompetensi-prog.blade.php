@extends('base.base-root-index')

@section('title', 'Kompetensi Programmer | IDBC')

@section('custom-css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0fdfa 0%, #ffffff 100%);
        }
        
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2.5rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 70%;
            height: 4px;
            background: linear-gradient(90deg, #0d9488, #059669);
            border-radius: 2px;
        }
        
        .programmer-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .programmer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .programmer-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        .highlight-text {
            position: relative;
            padding: 0 5px;
            z-index: 1;
        }
        
        .highlight-text:after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 40%;
            background-color: rgba(13, 148, 136, 0.2);
            z-index: -1;
            border-radius: 3px;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
        }
        
        .feature-badge {
            position: absolute;
            top: -12px;
            right: -12px;
            background: linear-gradient(135deg, #0d9488, #059669);
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .tech-item {
            display: flex;
            align-items: flex-start;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .tech-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .tech-icon {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 1.5rem;
            background: #f0fdfa;
            color: #059669;
        }
        
        .tech-content {
            flex-grow: 1;
        }
        
        @media (max-width: 768px) {
            .tech-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .tech-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }

        /* Additional styles for programmer section */
        .programmer-header {
            background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
            padding: 5rem 1rem;
        }
        
        .programmer-feature {
            transition: all 0.3s ease;
            border-radius: 12px;
        }
        
        .programmer-feature:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .materi-item {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            margin-bottom: 1rem;
            background: white;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .materi-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .materi-number {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d9488, #059669);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 1.5rem;
            flex-shrink: 0;
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(13, 148, 136, 0.3);
        }
        
        .btn-outline {
            border: 2px solid #0d9488;
            color: #0d9488;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            background: #f0fdfa;
        }
        
        /* Icon colors */
        .feature-icon {
            background: #f0fdfa;
            color: #059669;
        }
        
        .benefit-icon {
            background: #f0fdfa;
            color: #059669;
        }
    </style>
@endsection

@section('content')
    <!-- Header Section -->
    <header class="gradient-bg text-white py-16 px-5">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Kompetensi Programmer</h1>
            <p class="text-xl max-w-3xl mx-auto">Membentuk developer profesional dengan integritas keislaman</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <section class="py-16 px-5 bg-gradient-to-r from-teal-50 to-emerald-50">
        <div class="max-w-6xl mx-auto">
            <!-- Main Card -->
            <div class="programmer-card overflow-hidden">
                <!-- Header with Icon -->
                <div class="gradient-bg p-6 flex items-center">
                    <div class="bg-white/20 p-4 rounded-full mr-4">
                        <i class="fas fa-code text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Programming Profesional</h3>
                        <p class="text-teal-100">Kurikulum berbasis proyek nyata</p>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div>
                            <div class="mb-8">
                                <h4 class="text-xl font-bold text-teal-800 mb-4">Orientasi Pembelajaran</h4>
                                <p class="text-gray-700 mb-4">
                                    Kami berkomitmen mencetak programmer yang tidak hanya mahir dalam aspek teknis, tetapi juga berlandaskan nilai-nilai Islam dan memiliki jiwa kewirausahaan. Dengan bekal integritas, kecakapan digital, serta semangat inovatif, mereka siap mengembangkan solusi digital yang bermanfaat dan berdaya saing
                                </p>
                                <div class="bg-teal-50 border-l-4 border-teal-500 p-4 rounded-r-lg">
                                    <p class="text-gray-800 italic">
                                        "Setiap baris kode bukan sekadar membuat sistem berjalan, tapi mengandung makna dan tanggung jawab yang harus dijaga."
                                    </p>
                                </div>
                            </div>

                            <!-- Learning Method -->
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 programmer-feature">
                                <div class="flex items-start mb-4">
                                    <div class="feature-icon p-3 rounded-lg mr-4">
                                        <i class="fas fa-laptop-code"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-teal-800 text-lg mb-2">Metode Pembelajaran</h4>
                                        <p class="text-gray-700">
                                            80% praktik coding langsung, 15% teori, dan 5% mentoring karakter melalui proyek nyata.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <h4 class="text-xl font-bold text-teal-800 mb-4">Teknologi Inti</h4>
                            
                            <div class="space-y-4">
                                <div class="materi-item">
                                    <div class="materi-number">1</div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 text-lg mb-2">Frontend Development</h3>
                                        <p class="text-gray-600">HTML5, CSS, Responsive Design, UI/UX Principles</p>
                                    </div>
                                </div>
                                
                                <div class="materi-item">
                                    <div class="materi-number">2</div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 text-lg mb-2">Backend Development</h3>
                                        <p class="text-gray-600">PHP, Laravel, Express, Database Design, API Development</p>
                                    </div>
                                </div>
                                
                                <div class="materi-item">
                                    <div class="materi-number">3</div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 text-lg mb-2">Mobile Development</h3>
                                        <p class="text-gray-600">Flutter dan Mobile UI/UX</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Benefit Highlights -->
                    <div class="mt-10">
                        <h4 class="text-xl font-bold text-teal-800 mb-6 text-center">Keunggulan Program</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="programmer-feature bg-white border border-gray-200 rounded-xl p-6 text-center">
                                <div class="benefit-icon w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-award text-2xl"></i>
                                </div>
                                <h5 class="font-bold text-gray-800 mb-2">Sertifikasi Pelatihan</h5>
                                <p class="text-gray-600 text-sm">Sebagai bukti nyata telah menyelesaikan pelatihan</p>
                            </div>

                            <div class="programmer-feature bg-white border border-gray-200 rounded-xl p-6 text-center">
                                <div class="benefit-icon w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-project-diagram text-2xl"></i>
                                </div>
                                <h5 class="font-bold text-gray-800 mb-2">Portofolio Nyata</h5>
                                <p class="text-gray-600 text-sm">Aplikasi siap untuk profesional</p>
                            </div>

                            <div class="programmer-feature bg-white border border-gray-200 rounded-xl p-6 text-center">
                                <div class="benefit-icon w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-user-tie text-2xl"></i>
                                </div>
                                <h5 class="font-bold text-gray-800 mb-2">Mentor Berpengalaman</h5>
                                <p class="text-gray-600 text-sm">Praktisi industri teknologi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Features -->
                    <div class="mt-12">
                        <h4 class="text-xl font-bold text-teal-800 mb-6 text-center">Fitur Tambahan</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="tech-item">
                                <div class="tech-icon">
                                    <i class="fas fa-book-quran"></i>
                                </div>
                                <div class="tech-content">
                                    <h5 class="font-bold text-gray-800 mb-2">Nilai Islami</h5>
                                    <p class="text-gray-600">Integrasi etika islam dalam pengembangan software</p>
                                </div>
                            </div>

                            <div class="tech-item">
                                <div class="tech-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="tech-content">
                                    <h5 class="font-bold text-gray-800 mb-2">Team Project</h5>
                                    <p class="text-gray-600">Pengalaman kerja tim seperti di dunia profesional</p>
                                </div>
                            </div>

                            <div class="tech-item">
                                <div class="tech-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="tech-content">
                                    <h5 class="font-bold text-gray-800 mb-2">Eksplorasi Dunia Industri</h5>
                                    <p class="text-gray-600">Menjelajahi wawasan dunia kerja bersama para pengajar profesional</p>
                                </div>
                            </div>

                            <div class="tech-item">
                                <div class="tech-icon">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div class="tech-content">
                                    <h5 class="font-bold text-gray-800 mb-2">Startup Incubation</h5>
                                    <p class="text-gray-600">Pembinaan untuk mengembangkan startup digital</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="mt-12 text-center bg-gray-50 rounded-xl p-8">
                        <h4 class="text-2xl font-bold text-teal-800 mb-4">Siap Menjadi Programmer Profesional?</h4>
                        <p class="text-gray-700 mb-6 max-w-2xl mx-auto">
                            Bergabunglah dengan program kami dan raih kompetensi programming dengan nilai-nilai islami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection