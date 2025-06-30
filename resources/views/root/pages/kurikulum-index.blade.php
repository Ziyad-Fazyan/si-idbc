@extends('base.base-root-index')

@section('title', 'Kurikulum | IDBC')

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
    </style>
@endsection

@section('content')
    <!-- Header Section -->
    <header class="gradient-bg text-white py-16 px-5">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Kurikulum IDBC</h1>
            <p class="text-xl max-w-3xl mx-auto">Struktur kurikulum yang dirancang untuk membentuk kader <span class="font-semibold">Da'i Teknopreneur</span> yang berkarakter dan berkompetensi tinggi.</p>
        </div>
    </header>

    <!-- Kurikulum Overview -->
    <section class="py-16 px-5">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8 relative">
                <div class="feature-badge">
                    <i class="fas fa-star"></i>
                </div>
                <h2 class="text-2xl font-bold text-teal-800 mb-4">Sistem Pembelajaran & Kurikulum di IDBC</h2>
                <p class="text-gray-700 mb-6">
                    Di IDBC (Islamic Digital Boarding College), kami percaya bahwa pendidikan terbaik adalah yang tidak hanya membentuk kecerdasan intelektual, tetapi juga membangun karakter, keterampilan hidup, dan kesiapan menghadapi dunia nyata yang terus berkembang—baik di ranah teknologi, komunikasi, maupun spiritualitas.
                </p>
                <p class="text-gray-700 mb-8">
                    Oleh karena itu, kurikulum yang kami terapkan dirancang secara terpadu, modern, dan aplikatif. Kami menggabungkan ilmu agama, keterampilan digital, dan pengembangan diri dalam satu kesatuan pembelajaran yang seimbang. Seluruh peserta didik akan mendapatkan pengalaman belajar secara praktik langsung, dengan pendekatan proyek nyata (project-based learning) yang membuat mereka tidak hanya tahu, tapi juga bisa dan siap kerja.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                    <!-- Learning Approach Card -->
                    <div class="bg-teal-50 rounded-xl p-6 border border-teal-100">
                        <div class="flex items-center mb-4">
                            <div class="bg-teal-100 text-teal-800 p-3 rounded-lg mr-4">
                                <i class="fas fa-book-open text-xl"></i>
                            </div>
                            <h3 class="font-bold text-teal-800 text-lg">Pendekatan Pembelajaran</h3>
                        </div>
                        <p class="text-gray-700">Gabungan pembelajaran teori, praktik langsung, dan pendekatan berbasis proyek nyata.</p>
                    </div>
                    
                    <!-- Method Card -->
                    <div class="bg-emerald-50 rounded-xl p-6 border border-emerald-100">
                        <div class="flex items-center mb-4">
                            <div class="bg-emerald-100 text-emerald-800 p-3 rounded-lg mr-4">
                                <i class="fas fa-chalkboard-teacher text-xl"></i>
                            </div>
                            <h3 class="font-bold text-emerald-800 text-lg">Metode Pembelajaran</h3>
                        </div>
                        <p class="text-gray-700">Pembinaan karakter melalui mentoring intensif dan kegiatan sosial yang aplikatif.</p>
                    </div>
                    
                    <!-- Goal Card -->
                    <div class="bg-cyan-50 rounded-xl p-6 border border-cyan-100">
                        <div class="flex items-center mb-4">
                            <div class="bg-cyan-100 text-cyan-800 p-3 rounded-lg mr-4">
                                <i class="fas fa-bullseye text-xl"></i>
                            </div>
                            <h3 class="font-bold text-cyan-800 text-lg">Tujuan Pendidikan</h3>
                        </div>
                        <p class="text-gray-700">Mencetak generasi berakhlak mulia, melek digital, dan siap bersaing di era industri 4.0.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Curriculum Structure -->
    <section class="py-16 px-5">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-teal-800 mb-16 section-title">Struktur Kurikulum IDBC</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kurikulum Umum -->
                <div class="curriculum-card bg-white shadow-lg">
                    <div class="p-6 border-b-4 border-teal-500">
                        <div class="curriculum-icon bg-teal-100 text-teal-700 mx-auto">
                            <i class="fas fa-book text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-center text-teal-800 mb-4">Kurikulum Umum</h3>
                        <p class="text-gray-600 text-center mb-6">Pondasi ilmu agama dan keterampilan dasar penting dalam kehidupan dan dunia profesional.</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                <span>Fiqih & Aqidah</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                <span>Adab & Parenting</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                <span>Muhadaroh & Munadaroh</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                <span>Public Speaking & Jurnalistik</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                <span>Entrepreneurship (Digital Marketing, Business Plan, Marketing Plan, Marketplace)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                <span>Microsoft Office</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                <span>Pengambilan Foto & Video</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                <span>Desain Grafis</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                <span>HTML & CSS</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                <span>Hardware & Jaringan</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Desain Multimedia -->
                <div class="curriculum-card bg-white shadow-lg">
                    <div class="p-6 border-b-4 border-emerald-500">
                        <div class="curriculum-icon bg-emerald-100 text-emerald-700 mx-auto">
                            <i class="fas fa-paint-brush text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-center text-emerald-800 mb-4">Desain Multimedia</h3>
                        <p class="text-gray-600 text-center mb-6">Pembelajaran intensif dunia kreatif dan multimedia untuk kebutuhan digital profesional.</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span>Digital Printing & Publishing</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span>Desain Grafis & UI (User Interface)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span>Animasi dengan After Effect</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span>Pengolahan Audio</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span>Pengambilan Gambar Profesional</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mt-1 mr-3"></i>
                                <span>Pembuatan Situs dengan Wordpress</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Programming -->
                <div class="curriculum-card bg-white shadow-lg">
                    <div class="p-6 border-b-4 border-cyan-500">
                        <div class="curriculum-icon bg-cyan-100 text-cyan-700 mx-auto">
                            <i class="fas fa-code text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-center text-cyan-800 mb-4">Programming & Coding</h3>
                        <p class="text-gray-600 text-center mb-6">Kurikulum khusus untuk mempersiapkan peserta menjadi programmer andal.</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-cyan-500 mt-1 mr-3"></i>
                                <span>HTML & CSS</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-cyan-500 mt-1 mr-3"></i>
                                <span>Desain UI (User Interface)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-cyan-500 mt-1 mr-3"></i>
                                <span>Web Programming</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-cyan-500 mt-1 mr-3"></i>
                                <span>Mobile App Development</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-cyan-500 mt-1 mr-3"></i>
                                <span>Pemrograman Berbasis Proyek</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-cyan-500 mt-1 mr-3"></i>
                                <span>Pengembangan Aplikasi Android/iOS</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Educational Goals - PERBAIKAN UTAMA DI SINI -->
    <section class="py-16 px-5 bg-gradient-to-r from-teal-50 to-emerald-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-teal-800 mb-16 section-title">Tujuan Pendidikan IDBC</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Goals List -->
                <div class="space-y-6">
                    <div class="goal-item">
                        <div class="goal-icon bg-teal-100 text-teal-700">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="goal-content">
                            <h3 class="font-bold text-lg text-teal-800 mb-2">Lulusan Berakhlak Mulia</h3>
                            <p class="text-gray-700">Menghasilkan lulusan yang berakhlak mulia dan berwawasan Islam secara komprehensif.</p>
                        </div>
                    </div>
                    
                    <div class="goal-item">
                        <div class="goal-icon bg-emerald-100 text-emerald-700">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="goal-content">
                            <h3 class="font-bold text-lg text-emerald-800 mb-2">Penguasaan Teknologi</h3>
                            <p class="text-gray-700">Menguasai teknologi terkini dan mampu bersaing di era transformasi digital.</p>
                        </div>
                    </div>
                    
                    <div class="goal-item">
                        <div class="goal-icon bg-cyan-100 text-cyan-700">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="goal-content">
                            <h3 class="font-bold text-lg text-cyan-800 mb-2">Jiwa Entrepreneur</h3>
                            <p class="text-gray-700">Memiliki jiwa entrepreneur dan kemandirian ekonomi melalui pengembangan bisnis digital.</p>
                        </div>
                    </div>
                    
                    <div class="goal-item">
                        <div class="goal-icon bg-teal-100 text-teal-700">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="goal-content">
                            <h3 class="font-bold text-lg text-teal-800 mb-2">Kontributor Masyarakat</h3>
                            <p class="text-gray-700">Siap menjadi pemimpin dan kontributor positif di masyarakat sebagai Da'i Teknopreneur.</p>
                        </div>
                    </div>
                    
                    <div class="mt-8 bg-white p-6 rounded-xl shadow-md border-l-4 border-teal-500">
                        <p class="text-gray-700 italic">
                            <i class="fas fa-quote-left text-teal-500 text-xl mr-2"></i>
                            Dengan dukungan pengajar profesional, pendekatan praktis, dan fasilitas yang menunjang, kami berkomitmen mencetak generasi yang berakhlak mulia, melek digital, dan siap bersaing di era industri 4.0 dan seterusnya.
                        </p>
                    </div>
                </div>
                
                <!-- Goals Image -->
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-md">
                        <div class="aspect-w-1 aspect-h-1 bg-gradient-to-br from-teal-100 to-emerald-100 rounded-2xl shadow-xl p-8 flex flex-col items-center justify-center text-center">
                            <div class="mb-6">
                                <i class="fas fa-bullseye text-6xl text-teal-700"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-teal-800 mb-4">Visi Pendidikan IDBC</h3>
                            <p class="text-gray-700 mb-6">
                                Membentuk kader Da'i Teknopreneur yang unggul dalam ilmu agama, teknologi, dan kewirausahaan.
                            </p>
                            <div class="w-24 h-1 bg-gradient-to-r from-teal-500 to-emerald-500 rounded-full mx-auto"></div>
                            
                            <div class="mt-8 grid grid-cols-3 gap-4">
                                <div class="bg-white p-3 rounded-lg shadow-sm">
                                    <i class="fas fa-mosque text-2xl text-teal-600 mb-2"></i>
                                    <p class="text-sm font-medium">Agama</p>
                                </div>
                                <div class="bg-white p-3 rounded-lg shadow-sm">
                                    <i class="fas fa-laptop-code text-2xl text-emerald-600 mb-2"></i>
                                    <p class="text-sm font-medium">Teknologi</p>
                                </div>
                                <div class="bg-white p-3 rounded-lg shadow-sm">
                                    <i class="fas fa-chart-line text-2xl text-cyan-600 mb-2"></i>
                                    <p class="text-sm font-medium">Bisnis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection