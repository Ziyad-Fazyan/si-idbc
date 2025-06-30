@extends('base.base-root-index')

@section('title', 'Kompetensi Desain | IDBC')

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
        
        .curriculum-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
        }
        
        .curriculum-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .curriculum-icon {
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
        
        .goal-item {
            display: flex;
            align-items: flex-start;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .goal-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .goal-icon {
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
        
        .goal-content {
            flex-grow: 1;
        }
        
        @media (max-width: 768px) {
            .goal-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .goal-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }

        /* Additional styles for design section */
        .design-header {
            background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
        }
        .design-card {
            transition: all 0.3s ease;
        }
        .design-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Icon styles */
        .icon-container {
            background: #f0fdfa;
            color: #059669;
        }
        
        .feature-icon {
            background: #f0fdfa;
            color: #059669;
        }
    </style>
@endsection

@section('content')
    <!-- Header Section -->
    <header class="gradient-bg text-white py-16 px-5">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Kompetensi Desain Multimedia</h1>
            <p class="text-xl max-w-3xl mx-auto">Membentuk kreator visual yang kompeten dengan integritas keislaman</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <section class="py-16 px-5 bg-gradient-to-r from-teal-50 to-emerald-50">
        <div class="max-w-6xl mx-auto">
            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header with Icon -->
                <div class="design-header p-6 flex items-center">
                    <div class="bg-white/20 p-4 rounded-full mr-4">
                        <i class="fas fa-palette text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Desain Multimedia Profesional</h3>
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
                                    Kami berkomitmen membentuk desainer multimedia yang tidak hanya unggul dalam kemampuan teknis dan kreativitas visual, tetapi juga memiliki karakter Islami yang kuat dan jiwa kewirausahaan yang visioner. Dengan perpaduan nilai-nilai spiritual, keterampilan profesional, dan mindset bisnis, lulusan kami siap menjadi inovator yang mampu bersaing di industri kreatif berbasis nilai.
                                </p>
                                <div class="bg-teal-50 border-l-4 border-teal-500 p-4 rounded-r-lg">
                                    <p class="text-gray-800 italic">
                                        "Karya yang baik bermula dari niat tulus, bermakna, dan disertai tanggung jawab yang jelas."
                                    </p>
                                </div>
                            </div>

                            <!-- Learning Method -->
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 design-card">
                                <div class="flex items-start mb-4">
                                    <div class="feature-icon p-3 rounded-lg mr-4">
                                        <i class="fas fa-laptop-code"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-teal-800 text-lg mb-2">Metode Pembelajaran</h4>
                                        <p class="text-gray-700">
                                            80% praktik langsung, 10% teori, dan 10% mentoring karakter melalui proyek nyata.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <h4 class="text-xl font-bold text-teal-800 mb-4">Materi Inti</h4>
                            
                            <div class="space-y-4">
                                <div class="flex items-start bg-gray-50 hover:bg-white p-4 rounded-lg transition-all duration-300 design-card group">
                                    <div class="icon-container p-2 rounded-lg mr-4 group-hover:bg-teal-100 transition-all">
                                        <i class="fas fa-print"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-800">Digital Printing & Publishing</h5>
                                        <p class="text-gray-600 text-sm">Mempelajari cara mencetak desain menggunakan teknik dan kualitas yang sesuai dengan kebutuhan profesional, seperti sablon, offset, atau digital printing.</p>
                                    </div>
                                </div>

                                <div class="flex items-start bg-gray-50 hover:bg-white p-4 rounded-lg transition-all duration-300 design-card group">
                                    <div class="icon-container p-2 rounded-lg mr-4 group-hover:bg-teal-100 transition-all">
                                        <i class="fas fa-paint-brush"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-800">Desain Grafis & UI/UX</h5>
                                        <p class="text-gray-600 text-sm">Merancang tampilan aplikasi atau website agar menarik secara visual, mudah digunakan, dan memudahkan penggunaan UX.</p>
                                    </div>
                                </div>

                                <div class="flex items-start bg-gray-50 hover:bg-white p-4 rounded-lg transition-all duration-300 design-card group">
                                    <div class="icon-container p-2 rounded-lg mr-4 group-hover:bg-teal-100 transition-all">
                                        <i class="fas fa-film"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-800">Animasi & Video Editing</h5>
                                        <p class="text-gray-600 text-sm">Membuat animasi grafis bergerak dengan teknik yang terstruktur dan hasil berkualitas tinggi.</p>
                                    </div>
                                </div>

                                <div class="flex items-start bg-gray-50 hover:bg-white p-4 rounded-lg transition-all duration-300 design-card group">
                                    <div class="icon-container p-2 rounded-lg mr-4 group-hover:bg-teal-100 transition-all">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-800">Fotografi Digital</h5>
                                        <p class="text-gray-600 text-sm">Mempelajari cara mengambil foto untuk keperluan bisnis seperti iklan, katalog produk, atau branding agar hasilnya menarik dan menjual.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Benefit Highlights -->
                    <div class="mt-10">
                        <h4 class="text-xl font-bold text-teal-800 mb-6 text-center">Keunggulan Program</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white border border-gray-200 rounded-xl p-6 text-center design-card">
                                <div class="icon-container w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-award text-2xl"></i>
                                </div>
                                <h5 class="font-bold text-gray-800 mb-2">Sertifikasi Pelatihan</h5>
                                <p class="text-gray-600 text-sm">Sebagai bukti nyata telah menyelesaikan pelatihan</p>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-xl p-6 text-center design-card">
                                <div class="icon-container w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-briefcase text-2xl"></i>
                                </div>
                                <h5 class="font-bold text-gray-800 mb-2">Portofolio Nyata</h5>
                                <p class="text-gray-600 text-sm">Karya siap untuk profesional</p>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-xl p-6 text-center design-card">
                                <div class="icon-container w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-user-tie text-2xl"></i>
                                </div>
                                <h5 class="font-bold text-gray-800 mb-2">Mentor Berpengalaman</h5>
                                <p class="text-gray-600 text-sm">Praktisi industri kreatif</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="mt-12 text-center bg-gray-50 rounded-xl p-8">
                        <h4 class="text-2xl font-bold text-teal-800 mb-4">Siap Menjadi Desainer Profesional?</h4>
                        <p class="text-gray-700 mb-6 max-w-2xl mx-auto">
                            Bergabunglah dengan program kami dan raih kompetensi desain multimedia dengan nilai-nilai islami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection