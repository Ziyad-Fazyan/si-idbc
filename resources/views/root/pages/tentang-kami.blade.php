@extends('base.base-root-index')

@section('title', 'Tentang Kami | IDBC')

@section('custom-css')
    <style>
        /* Keep all your existing CSS styles */
        .gradient-bg {
            background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
        }
    </style>
@endsection

@section('content')
    <!-- Header Section - Matching Kurikulum Style Exactly -->
    <header class="gradient-bg text-white py-16 px-5">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Tentang Kami</h1>
            <p class="text-xl max-w-3xl mx-auto">Membangun generasi unggul yang berlandaskan <span class="font-semibold">adab</span> dan <span class="font-semibold">teknologi</span>.</p>
        </div>
    </header>

    <!-- Rest of your content goes here -->

           
<style>
    @keyframes textShine {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    @keyframes glow-pulse {
        0%, 100% { opacity: 0.08; transform: scale(0.98); }
        50% { opacity: 0.15; transform: scale(1.02); }
    }
    .animate-text-shine {
        background-size: 250% auto;
        animation: textShine 5s ease-in-out infinite;
    }
    .animate-glow-pulse {
        animation: glow-pulse 6s ease-in-out infinite alternate;
    }
</style>

    <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100">
        <!-- Landasan berfikir -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-emerald-700 mb-6 text-center">Landasan Berfikir</h2>
            <div class="bg-emerald-50 text-emerald-800 p-8 rounded-xl shadow-sm">
                <!-- Arabic -->
                <div class="text-center my-10 py-8 space-y-8">
                    <!-- First Line -->
                    <p class="text-3xl md:text-4xl font-[Amiri] leading-[3.5rem] tracking-wide">
                        لَقَدْ اَرْسَلْنَا رُسُلَنَا بِالْبَيِّنٰتِ وَاَنْزَلْنَا مَعَهُمُ الْكِتٰبَ وَالْمِيْزَانَ لِيَقُوْمَ النَّاسُ بِالْقِسْطِۚ
                    </p>
                        
                    <!-- Second Line -->
                    <p class="text-3xl md:text-4xl font-[Amiri] leading-[3.5rem] tracking-wide">
                        وَاَنْزَلْنَا الْحَدِيْدَ فِيْهِ بَأْسٌ شَدِيْدٌ وَّمَنَافِعُ لِلنَّاسِ وَلِيَعْلَمَ اللّٰهُ مَنْ يَّنْصُرُهٗ وَرُسُلَهٗ بِالْغَيْبِۗ
                    </p>
                        
                    <!-- Third Line -->
                    <p class="text-3xl md:text-4xl font-[Amiri] leading-[3.5rem] tracking-wide">
                        اِنَّ اللّٰهَ قَوِيٌّ عَزِيْزٌࣖ ۝٢٥
                    </p>
                </div>
                    
                <!-- Terjemahan -->
                <div class="text-center mb-6 px-4">
                    <p class="text-lg md:text-xl leading-relaxed text-emerald-900">
                        "Sungguh, Kami telah mengutus rasul-rasul Kami dengan membawa bukti-bukti yang nyata dan telah Kami turunkan bersama mereka Al Kitab dan neraca (keadilan) supaya manusia dapat melaksanakan keadilan. Dan Kami ciptakan besi yang padanya terdapat kekuatan yang hebat dan berbagai manfaat bagi manusia (supaya mereka mempergunakan besi itu) dan supaya Allah mengetahui siapa yang menolong (agama)-Nya dan rasul-rasul-Nya padahal Allah tidak dilihatnya. Sesungguhnya Allah Maha Kuat lagi Maha Perkasa."
                    </p>
                </div>
                    
                <!-- Quran Reference -->
                <p class="text-center md:text-lg leading-relaxed text-emerald-700 mt-4">
                    QS. Al-Hadid: 25
                </p>
            </div>
        </div>
            
        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Muqaddimah Section -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-teal-800 mb-6 text-center">Muqaddimah</h2>
            <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                <p class="mb-4">Segala puji bagi Allah Rabb semesta alam, shalawat dan salam berlimpah kepada Rasulullah ﷺ, ahlul bait, sahabat, dan para pengikut setia beliau hingga kiamat. Pendidikan merupakan penentu masa depan seseorang dan peradaban manusia secara umum. Oleh karena itu, pendidikan adalah bidang strategis dalam kehidupan. Kemajuan dan karakter suatu bangsa ditentukan oleh sistem pendidikannya.</p>
                <p class="mb-4">Islam sebagai agama sempurna yang diturunkan kepada manusia di muka bumi ini telah meletakkan konsep pendidikan, dan konsep itu telah terealisasi dalam pengawalan Nabi Utusan-Nya. Lahirnya generasi emas yang dijamin kebaikannya di tiga generasi pertama adalah bukti nyata dari keunggulan sistem pendidikan itu.</p>
                <p class="mb-4">Berlalunya zaman, banyak terjadi degradasi karena secara pelan tapi pasti generasi belakangnya lalai terhadap konsep dan sistem pendidikan itu, akhirnya lahirlah kemunduran yang mengakibatkan kehinaan. Prof. DR. Syed Naquib Al Attas menyampaikan saat konferensi Pendidikan Internasional Pertama di Mekkah tahun 1977, faktor kemunduran yang menjadi problem besar umat adalah karena "loss of adab". Ini inti utama konsep pendidikan Islam yang kini hilang.</p>
                <p>Menyadari hal tersebut, saatnya kini untuk kembali kepada nilai-nilai luhur tersebut, tentunya dengan menyesuaikan dengan perkembangan zaman. Abad 21 yang populer dengan era industri 4.0 saat ini perlu diintegrasikan dengan konsep pendidikan emas tersebut. **PENDIDIKAN BERBASIS ADAB & IT**, mungkin inilah konsep integrasi pendidikan ideal yang saat ini perlu kita mulai. Alhamdulillah, kami telah memulai konsep ini sejak lama. Mudah-mudahan ini bisa menjadi model bagi Lembaga Pendidikan yang lainnya.</p>
            </div>
        </div>

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Latar Belakang Section -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-teal-800 mb-6 text-center">Latar Belakang</h2>
            <p class="text-xl text-gray-700 mb-6 text-center">Beberapa latar belakang dari kehadiran IDBC:</p>
            <ul class="grid md:grid-cols-2 gap-6 list-none p-0">
                <li class="bg-teal-50 p-6 rounded-xl shadow-sm flex items-start space-x-3 border border-teal-100">
                    <span class="text-teal-600 text-2xl font-bold flex-shrink-0">1.</span>
                    <p class="text-gray-700 text-lg">Mahalnya biaya pendidikan karena banyaknya biaya-biaya dan lamanya waktu yang ditempuh, tapi outputnya tetap standar.</p>
                </li>
                <li class="bg-teal-50 p-6 rounded-xl shadow-sm flex items-start space-x-3 border border-teal-100">
                    <span class="text-teal-600 text-2xl font-bold flex-shrink-0">2.</span>
                    <p class="text-gray-700 text-lg">Kemajuan teknologi digital dan tuntutan zaman yang terus berkembang.</p>
                </li>
                <li class="bg-teal-50 p-6 rounded-xl shadow-sm flex items-start space-x-3 border border-teal-100">
                    <span class="text-teal-600 text-2xl font-bold flex-shrink-0">3.</span>
                    <p class="text-gray-700 text-lg">Belum ada model pendidikan yang mengintegrasikan teknologi secara totalitas dalam proses pembelajaran.</p>
                </li>
                <li class="bg-teal-50 p-6 rounded-xl shadow-sm flex items-start space-x-3 border border-teal-100">
                    <span class="text-teal-600 text-2xl font-bold flex-shrink-0">4.</span>
                    <p class="text-gray-700 text-lg">Perlu adanya edukasi tentang teknologi agar teknologi dimanfaatkan secara maksimal sesuai fungsinya untuk kepentingan strategis, positif, dan produktif.</p>
                </li>
            </ul>
        </div>

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Visi & Misi Section -->
        <div class="grid md:grid-cols-2 gap-10 mb-12">
            <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                <h2 class="text-3xl font-bold text-emerald-700 mb-4">Visi</h2>
                <p class="text-gray-800 text-xl leading-relaxed">
                    Kaderisasi da'i techno preneur yang berkarakter islami dan siap menghadapi tantangan global.
                </p>
            </div>
            <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                <h2 class="text-3xl font-bold text-emerald-700 mb-4">Misi</h2>
                <ul class="list-none p-0 space-y-3 text-gray-800 text-lg">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-emerald-600 mr-2 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Menjadi alternatif pendidikan yang efisien sesuai dengan syariat dan tuntutan zaman.
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-emerald-600 mr-2 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Optimalisasi dan integrasi teknologi dalam pendidikan dan dakwah.
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-emerald-600 mr-2 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Menerapkan konsep pendidikan Rabbani sesuai manhaj salaf.
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-emerald-600 mr-2 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Mewujudkan manusia menjadi hamba dan khalifah yang berdaya guna.
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Keunggulan Section -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-teal-800 mb-6 text-center">Keunggulan</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-teal-50 p-6 rounded-xl shadow-sm border border-teal-100 flex items-center space-x-4">
                    <svg class="w-8 h-8 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-gray-700 text-lg font-medium">Berakhlak mulia.</p>
                </div>
                <div class="bg-teal-50 p-6 rounded-xl shadow-sm border border-teal-100 flex items-center space-x-4">
                    <svg class="w-8 h-8 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-gray-700 text-lg font-medium">Berjiwa da’i, jago IT & pintar mengaji.</p>
                </div>
                <div class="bg-teal-50 p-6 rounded-xl shadow-sm border border-teal-100 flex items-center space-x-4">
                    <svg class="w-8 h-8 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-gray-700 text-lg font-medium">Mandiri dan punya bisnis sendiri.</p>
                </div>
                <div class="bg-teal-50 p-6 rounded-xl shadow-sm border border-teal-100 flex items-center space-x-4">
                    <svg class="w-8 h-8 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-gray-700 text-lg font-medium">Pembelajaran singkat, padat, dan efisien.</p>
                </div>
                <div class="bg-teal-50 p-6 rounded-xl shadow-sm border border-teal-100 flex items-center space-x-4">
                    <svg class="w-8 h-8 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-gray-700 text-lg font-medium">Mengembangkan potensi fitrah hingga menjadi expert.</p>
                </div>
                <div class="bg-teal-50 p-6 rounded-xl shadow-sm border border-teal-100 flex items-center space-x-4">
                    <svg class="w-8 h-8 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-gray-700 text-lg font-medium">Garansi kompetensi.</p>
                </div>
            </div>
        </div>

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Sistem Pendidikan -->
        <div>
            <h2 class="text-3xl font-bold text-teal-800 mb-6 text-center">Sistem Pendidikan</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                    <h3 class="text-2xl font-bold text-emerald-700 mb-3 flex items-center">
                        <svg class="w-7 h-7 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Boarding
                    </h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Sistem pendidikan tertua dan paling efektif karena seluruh aktivitas 24 jam bisa terpantau, selalu bersanding dengan guru, dan berinteraksi dengan masyarakat.
                    </p>
                </div>
                <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                    <h3 class="text-2xl font-bold text-emerald-700 mb-3 flex items-center">
                        <svg class="w-7 h-7 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m-1 4h1m8-16v4h2m-2 0h2.5L21 9.5M17 11V7"></path></svg>
                        Building
                    </h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Penempaan karakter setiap saat & termonitor secara langsung perkembangan seluruh aspek yang menjadi objek pendidikan yaitu olah hati, olah pikir, dan olah raga.
                    </p>
                </div>
                <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                    <h3 class="text-2xl font-bold text-emerald-700 mb-3 flex items-center">
                        <svg class="w-7 h-7 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Teaching
                    </h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Pembelajaran klasikal ataupun halaqah dengan materi kurikulum yang telah ditentukan oleh guru atau musyrif.
                    </p>
                </div>
                <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                    <h3 class="text-2xl font-bold text-emerald-700 mb-3 flex items-center">
                        <svg class="w-7 h-7 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-5m-1-9V4a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1h8m-1-9L16 9m4 0l-3 3-3-3m-2 0V9"></path></svg>
                        Coaching
                    </h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Pendampingan intensif setiap anak untuk mengembangkan potensi dan skill agar bisa berkembang maksimal dan bisa menjadi modal menjalani hidup sesuai potensi dan skillnya.
                    </p>
                </div>
                <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100 md:col-span-2">
                    <h3 class="text-2xl font-bold text-emerald-700 mb-3 flex items-center">
                        <svg class="w-7 h-7 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11V7a1 1 0 011-1h10a1 1 0 011 1v10a1 1 0 01-1 1h-2.5m-6.5-6.5l6.5 6.5m0 0H14m2 0v-2.5m-6.5-6.5h-2.5V7m0 2.5l-6.5 6.5"></path></svg>
                        Balancing
                    </h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Mengawal dan mengajarkan keselarasan dan keseimbangan dalam berpikir dan bertindak baik untuk dunianya ataupun akhiratnya, untuk dirinya, keluarganya, dan orang lain.
                    </p>
                </div>
            </div>
        </div>

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Model Pembelajaran -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-teal-800 mb-10 text-center">Model Pembelajaran</h2>
            
            <!-- Diagram Container (Full Width) -->
            <div class="flex justify-center mb-10">
                <div class="bg-gradient-to-r from-emerald-400 to-teal-500 p-2 rounded-xl shadow-lg">
                    <img src="{{ asset('storage/images/diagram/diagram.png') }}" 
                        alt="Model Pembelajaran IDBC" 
                        class="max-h-96 w-auto object-contain rounded-lg bg-white p-6 shadow-inner">
                </div>
            </div>

            <!-- Text Descriptions (Side by Side) -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Description 1 -->
                <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                    <div class="flex items-start">
                        <div class="bg-emerald-100 text-emerald-600 p-3 rounded-lg mr-4">
                            <i class="fas fa-chalkboard-teacher text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-emerald-700 mb-3 flex items-center">Pembelajaran Interaktif</h3>
                            <p class="text-gray-700 leading-relaxed">Sistem belajar dua arah dengan diskusi aktif dan studi kasus nyata yang relevan dengan kebutuhan industri terkini.</p>
                        </div>
                    </div>
                </div>

                <!-- Description 2 -->
                <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                    <div class="flex items-start">
                        <div class="bg-emerald-100 text-emerald-600 p-3 rounded-lg mr-4">
                            <i class="fas fa-laptop-code text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-emerald-700 mb-3 flex items-center">Praktik Langsung</h3>
                            <p class="text-gray-700 leading-relaxed">80% waktu belajar diisi dengan praktik langsung menggunakan tools dan framework yang digunakan di dunia profesional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection