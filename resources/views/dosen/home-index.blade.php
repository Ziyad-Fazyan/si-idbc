@extends('base.base-dash-index')
@section('title')
    Dashboard Dosen - SIAKAD PT
@endsection
@section('menu')
    Beranda
@endsection
@section('submenu')
    Dashboard Dosen
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Ringkasan aktivitas mengajar dan informasi terkini
@endsection
@push('styles')
    <style>
        .dashboard-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 4px solid;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card:hover::before {
            opacity: 1;
        }

        .card-jadwal {
            border-left-color: #0C6E71;
            background: linear-gradient(135deg, #ffffff 0%, #f8fffe 100%);
        }

        .card-jadwal:hover {
            border-left-color: #FF6B35;
        }

        .card-feedback {
            border-left-color: #4E9F3D;
            background: linear-gradient(135deg, #ffffff 0%, #f8fff8 100%);
        }

        .card-feedback:hover {
            border-left-color: #FF6B35;
        }

        .card-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transition: all 0.3s ease;
            transform: translate(-50%, -50%);
        }

        .group:hover .card-icon::before {
            width: 100%;
            height: 100%;
        }

        .welcome-banner {
            background: linear-gradient(135deg, #0C6E71 0%, #4E9F3D 100%);
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(30px, -30px) rotate(120deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(240deg);
            }
        }

        .avatar-gradient {
            background: linear-gradient(135deg, #0C6E71 0%, #FF6B35 100%);
            position: relative;
        }

        .avatar-gradient::before {
            content: '';
            position: absolute;
            inset: 2px;
            background: #0C6E71;
            border-radius: inherit;
        }

        .avatar-gradient span {
            position: relative;
            z-index: 1;
        }

        .announcement-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 3px solid transparent;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .announcement-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, #0C6E71 0%, transparent 100%);
            transition: width 0.3s ease;
        }

        .announcement-item:hover {
            border-left-color: #0C6E71;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            transform: translateX(5px);
            box-shadow: 0 8px 25px rgba(12, 110, 113, 0.1);
        }

        .announcement-item:hover::before {
            width: 4px;
        }

        .schedule-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
        }

        .schedule-card:hover {
            border-color: #0C6E71;
            background: linear-gradient(135deg, #f8fffe 0%, #ffffff 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(12, 110, 113, 0.15);
        }

        .status-badge {
            position: relative;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .satisfaction-chart-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }

        .satisfaction-chart-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 0%, rgba(12, 110, 113, 0.05) 50%, transparent 100%);
        }

        .section-header {
            background: linear-gradient(135deg, #0C6E71 0%, #4E9F3D 100%);
            position: relative;
            overflow: hidden;
        }

        .section-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .modal-content {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .modal-overlay {
            backdrop-filter: blur(8px);
            background: rgba(0, 0, 0, 0.5);
        }

        @media (max-width: 768px) {
            .card-content {
                flex-direction: column;
                text-align: center;
            }

            .card-icon {
                margin-bottom: 1rem;
            }

            .chart-container {
                width: 100% !important;
            }

            .dashboard-card:hover {
                transform: translateY(-4px);
            }
        }

        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse-ring {
            0% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(34, 197, 94, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #0C6E71 0%, #4E9F3D 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .scroll-smooth {
            scroll-behavior: smooth;
        }

        /* Enhanced loading states */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
@endpush
@section('content')
    <section class="container mx-auto p-2 md:p-4">
        <!-- Welcome Banner -->
        <div class="welcome-banner rounded-2xl shadow-lg overflow-hidden mb-8 relative">
            <div class="p-8 flex flex-col md:flex-row items-center relative z-10">
                <div class="text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow-md">
                        Selamat Datang, {{ Auth::guard('dosen')->user()->name }}
                    </h1>
                    <p class="text-white/90 text-lg">
                        @php
                            $hour = date('G');
                            if ($hour >= 5 && $hour < 11) {
                                echo 'Selamat pagi';
                            } elseif ($hour >= 11 && $hour < 15) {
                                echo 'Selamat siang';
                            } elseif ($hour >= 15 && $hour < 18) {
                                echo 'Selamat sore';
                            } else {
                                echo 'Selamat malam';
                            }
                        @endphp
                        , semoga hari Anda menyenangkan dan produktif!
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column - Cards and Chart -->
            <div class="w-full lg:w-3/4 space-y-8">
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Jadwal Mengajar Card -->
                    <a href="{{ route('dosen.akademik.jadwal-index') }}" class="group">
                        <div class="dashboard-card card-jadwal rounded-2xl shadow-md overflow-hidden h-full">
                            <div class="p-6 flex items-center card-content">
                                <div
                                    class="card-icon w-16 h-16 flex items-center justify-center rounded-2xl bg-[#0C6E71] text-white group-hover:bg-[#FF6B35] shadow-lg">
                                    <i class="fa-solid fa-calendar-days text-2xl"></i>
                                </div>
                                <div class="ml-6 flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-1">Jadwal Mengajar</h3>
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-600 text-sm font-medium">Total kelas yang diajar</p>
                                        <span class="text-3xl font-bold gradient-text">
                                            {{ \App\Models\JadwalKuliah::where('dosen_id', Auth::guard('dosen')->user()->id)->count() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Feedback Card -->
                    <a href="{{ route('dosen.akademik.jadwal-index') }}" class="group">
                        <div class="dashboard-card card-feedback rounded-2xl shadow-md overflow-hidden h-full">
                            <div class="p-6 flex items-center card-content">
                                <div
                                    class="card-icon w-16 h-16 flex items-center justify-center rounded-2xl bg-[#4E9F3D] text-white group-hover:bg-[#FF6B35] shadow-lg">
                                    <i class="fa-solid fa-star text-2xl"></i>
                                </div>
                                <div class="ml-6 flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-1">Feedback Mahasiswa</h3>
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-600 text-sm font-medium">Total feedback diterima</p>
                                        <span class="text-3xl font-bold gradient-text">{{ $feedback->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Today's Schedule -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="section-header px-6 py-4 flex items-center justify-between">
                        <h3 class="text-white font-bold text-lg">
                            <i class="fas fa-calendar-day mr-3"></i> Jadwal Hari Ini
                        </h3>
                        <span class="text-white bg-[#FF6B35] px-4 py-2 rounded-full text-sm font-semibold shadow-md">
                            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                        </span>
                    </div>
                    <div class="p-6">
                        @php
                            $todaySchedules = \App\Models\JadwalKuliah::where(
                                'dosen_id',
                                Auth::guard('dosen')->user()->id,
                            )
                                ->where('days_id', strtolower(\Carbon\Carbon::now()->translatedFormat('l')))
                                ->with('matakuliah', 'kelas')
                                ->orderBy('start')
                                ->get();
                        @endphp

                        @if ($todaySchedules->count() > 0)
                            <div class="space-y-4">
                                @foreach ($todaySchedules as $schedule)
                                    <div class="schedule-card rounded-xl p-5">
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-800 text-lg mb-2">
                                                    {{ $schedule->matakuliah->name }}</h4>
                                                <div class="space-y-1 text-gray-600">
                                                    <p class="flex items-center text-sm">
                                                        <i class="fas fa-users w-4 mr-2"></i>
                                                        <span class="font-medium">Kelas:</span> {{ $schedule->kelas->name }}
                                                    </p>
                                                    <p class="flex items-center text-sm">
                                                        <i class="fas fa-door-open w-4 mr-2"></i>
                                                        <span class="font-medium">Ruang:</span> {{ $schedule->ruang }}
                                                    </p>
                                                    <p class="flex items-center text-sm">
                                                        <i class="fas fa-clock w-4 mr-2"></i>
                                                        <span class="font-medium">Waktu:</span>
                                                        {{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }} -
                                                        {{ \Carbon\Carbon::parse($schedule->jam_selesai)->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-4 md:mt-0 md:ml-6">
                                                <span
                                                    class="status-badge inline-block px-4 py-2 rounded-full text-sm font-semibold shadow-sm
                                                        @if (\Carbon\Carbon::parse($schedule->jam_selesai)->lt(now())) bg-gray-100 text-gray-700
                                                        @elseif(\Carbon\Carbon::parse($schedule->jam_mulai)->lte(now()) && \Carbon\Carbon::parse($schedule->jam_selesai)->gt(now()))
                                                            bg-green-100 text-green-800 pulse-ring
                                                        @else
                                                            bg-blue-100 text-blue-800 @endif">
                                                    @if (\Carbon\Carbon::parse($schedule->jam_selesai)->lt(now()))
                                                        <i class="fas fa-check-circle mr-1"></i> Selesai
                                                    @elseif(\Carbon\Carbon::parse($schedule->jam_mulai)->lte(now()) && \Carbon\Carbon::parse($schedule->jam_selesai)->gt(now()))
                                                        <i class="fas fa-play-circle mr-1"></i> Berlangsung
                                                    @else
                                                        <i class="fas fa-clock mr-1"></i> Akan Datang
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div
                                    class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-calendar-check text-4xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-500 text-lg font-medium">Tidak ada jadwal mengajar hari ini</p>
                                <p class="text-gray-400 text-sm mt-2">Nikmati waktu luang Anda!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Satisfaction Chart -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="section-header px-6 py-4">
                        <h3 class="text-white font-bold text-lg">
                            <i class="fas fa-chart-pie mr-3"></i> Statistik Kepuasan Mengajar
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="satisfaction-chart-container p-6 relative">
                            <div id="grafikChart" class="h-80 relative z-10"></div>
                        </div>
                        <div class="mt-4 p-4 bg-gray-50 rounded-xl">
                            <p class="text-center text-sm text-gray-600 font-medium">
                                <i class="fas fa-info-circle mr-2"></i>
                                Data berdasarkan feedback mahasiswa dari seluruh kelas yang Anda ajar
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Announcements -->
            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-6">
                    <div class="section-header px-6 py-4 flex items-center">
                        <i class="fas fa-bullhorn text-white mr-3"></i>
                        <h3 class="text-white font-bold text-lg">Pengumuman Terkini</h3>
                    </div>
                    <div class="p-6">
                        @forelse ($notify as $item)
                            <div class="announcement-item p-4 mb-4 cursor-pointer"
                                onclick="openModal('modal-{{ $item->code }}')">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#0C6E71] to-[#4E9F3D] flex items-center justify-center text-white shadow-md">
                                            <i class="fas fa-{{ $item->icon ?? 'info-circle' }} text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <p class="text-xs text-gray-500 mb-1 font-medium">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y - H:i') }}
                                        </p>
                                        <p class="text-sm font-semibold text-gray-800 line-clamp-2 leading-relaxed">
                                            {{ $item->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div
                                    class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-bell-slash text-3xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Tidak ada pengumuman saat ini</p>
                            </div>
                        @endforelse

                        @if ($notify->count() > 0)
                            <div class="mt-6 text-center">
                                <a href="{{ route('dosen.notifikasi-index') }}"
                                    class="inline-flex items-center text-sm text-[#0C6E71] hover:text-[#FF6B35] font-semibold transition-colors group">
                                    Lihat Semua Pengumuman
                                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Modals -->
        @foreach ($notify as $item)
            <div id="modal-{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-y-auto"
                aria-labelledby="modal-title-{{ $item->code }}" aria-modal="true" role="dialog">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Background overlay -->
                    <div class="modal-overlay fixed inset-0 transition-opacity" aria-hidden="true"
                        onclick="closeModal('modal-{{ $item->code }}')"></div>

                    <!-- Modal panel -->
                    <div
                        class="modal-content inline-block align-middle rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="section-header px-6 py-4 flex justify-between items-center">
                            <h3 class="text-xl leading-6 font-bold text-white" id="modal-title-{{ $item->code }}">
                                <i class="fas fa-{{ $item->icon ?? 'info-circle' }} mr-3"></i> {{ $item->name }}
                            </h3>
                            <button type="button"
                                class="text-white hover:text-[#FF6B35] focus:outline-none transition-colors p-2 rounded-lg hover:bg-white/10"
                                onclick="closeModal('modal-{{ $item->code }}')">
                                <i class="fas fa-times text-lg"></i>
                            </button>
                        </div>
                        <div class="bg-white px-6 pt-6 pb-4">
                            <div class="flex items-center text-sm text-gray-500 mb-4 p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-clock mr-2"></i>
                                <span
                                    class="font-medium">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y - H:i') }}</span>
                            </div>
                            <div class="prose max-w-none text-gray-700 leading-relaxed">
                                {!! $item->desc !!}
                            </div>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 flex justify-end">
                            <button type="button"
                                class="inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-3 bg-gradient-to-r from-[#0C6E71] to-[#4E9F3D] text-base font-semibold text-white hover:from-[#0a5c5e] hover:to-[#3e8231] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71] transition-all duration-200 transform hover:scale-105"
                                onclick="closeModal('modal-{{ $item->code }}')">
                                <i class="fas fa-check mr-2"></i> Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <script>
        // Enhanced modal handling with smooth animations
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            // Add smooth entrance animation
            setTimeout(() => {
                modal.querySelector('.modal-content').style.transform = 'scale(1)';
                modal.querySelector('.modal-overlay').style.opacity = '1';
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.querySelector('.modal-content').style.transform = 'scale(0.95)';
            modal.querySelector('.modal-overlay').style.opacity = '0';

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 200);
        }

        // Enhanced modal interactions
        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('[aria-modal="true"]');

            modals.forEach(modal => {
                // Initialize modal styles
                const content = modal.querySelector('.modal-content');
                const overlay = modal.querySelector('.modal-overlay');

                content.style.transform = 'scale(0.95)';
                content.style.transition = 'transform 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
                overlay.style.transition = 'opacity 0.2s ease';

                // Close on outside click
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeModal(this.id);
                    }
                });

                // Close on Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                        closeModal(modal.id);
                    }
                });
            });

            // Add smooth scrolling to all internal links
            document.documentElement.classList.add('scroll-smooth');
        });
    </script>
@endsection
@push('scripts')
    <script>
        var ajaxRunning = false;

        $(document).ready(function() {
            // Enhanced AJAX function with better error handling
            function fetchData() {
                if (ajaxRunning) return;
                ajaxRunning = true;

                // Show loading state
                $('#grafikChart').html(
                    '<div class="flex items-center justify-center h-full"><div class="loading-shimmer w-32 h-32 rounded-full"></div></div>'
                    );

                $.ajax({
                    url: '{{ route('dosen.services.ajax.graphic.kepuasan-mengajar-dosen') }}',
                    method: 'GET',
                    timeout: 10000,
                    success: function(response) {
                        var options = {
                            chart: {
                                type: 'donut',
                                height: '100%',
                                fontFamily: 'Inter, system-ui, sans-serif',
                                animations: {
                                    enabled: true,
                                    easing: 'easeinout',
                                    speed: 1200,
                                    animateGradually: {
                                        enabled: true,
                                        delay: 200
                                    },
                                    dynamicAnimation: {
                                        enabled: true,
                                        speed: 400
                                    }
                                },
                                dropShadow: {
                                    enabled: true,
                                    top: 3,
                                    left: 3,
                                    blur: 5,
                                    opacity: 0.1
                                }
                            },
                            series: [response.tidakpuas, response.cukuppuas, response.sangatpuas],
                            labels: ['Tidak Puas', 'Cukup Puas', 'Sangat Puas'],
                            colors: ['#EF4444', '#F59E0B', '#10B981'],
                            legend: {
                                position: 'bottom',
                                horizontalAlign: 'center',
                                fontSize: '14px',
                                fontWeight: 600,
                                labels: {
                                    colors: '#374151'
                                },
                                markers: {
                                    width: 12,
                                    height: 12,
                                    radius: 6
                                },
                                itemMargin: {
                                    horizontal: 15,
                                    vertical: 8
                                }
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        size: '70%',
                                        labels: {
                                            show: true,
                                            total: {
                                                show: true,
                                                showAlways: true,
                                                label: 'Total Feedback',
                                                fontSize: '16px',
                                                fontWeight: 'bold',
                                                color: '#1F2937',
                                                formatter: function(w) {
                                                    return w.globals.seriesTotals.reduce((a,
                                                        b) => {
                                                            return a + b
                                                        }, 0)
                                                }
                                            },
                                            value: {
                                                fontSize: '24px',
                                                fontWeight: 'bold',
                                                color: '#0C6E71',
                                                formatter: function(value) {
                                                    return value
                                                }
                                            }
                                        }
                                    },
                                    expandOnClick: true
                                }
                            },
                            states: {
                                hover: {
                                    filter: {
                                        type: 'lighten',
                                        value: 0.1
                                    }
                                },
                                active: {
                                    allowMultipleDataPointsSelection: false,
                                    filter: {
                                        type: 'darken',
                                        value: 0.1
                                    }
                                }
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 280
                                    },
                                    legend: {
                                        position: 'bottom',
                                        fontSize: '12px'
                                    }
                                }
                            }],
                            tooltip: {
                                enabled: true,
                                theme: 'light',
                                style: {
                                    fontSize: '14px',
                                    fontFamily: 'Inter, system-ui, sans-serif'
                                },
                                y: {
                                    formatter: function(value, {
                                        seriesIndex,
                                        w
                                    }) {
                                        const total = w.globals.seriesTotals.reduce((a, b) =>
                                            a + b, 0);
                                        const percentage = ((value / total) * 100).toFixed(1);
                                        return value + " feedback (" + percentage + "%)";
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                formatter: function(val, opts) {
                                    return Math.round(val) + "%";
                                },
                                style: {
                                    fontSize: '12px',
                                    fontWeight: 'bold',
                                    colors: ['#fff']
                                },
                                dropShadow: {
                                    enabled: true,
                                    top: 1,
                                    left: 1,
                                    blur: 1,
                                    opacity: 0.8
                                }
                            },
                            stroke: {
                                width: 2,
                                colors: ['#fff']
                            }
                        };

                        // Clear loading state
                        $('#grafikChart').empty();

                        var chart = new ApexCharts(document.querySelector('#grafikChart'), options);
                        chart.render();

                        // Add success animation
                        setTimeout(() => {
                            $('#grafikChart').addClass('animate-fadeIn');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading chart:', error);
                        $('#grafikChart').html(`
                            <div class="flex flex-col items-center justify-center h-full text-gray-500">
                                <i class="fas fa-exclamation-triangle text-4xl mb-4 text-yellow-500"></i>
                                <p class="text-lg font-medium mb-2">Gagal memuat data</p>
                                <p class="text-sm">Silakan refresh halaman</p>
                                <button onclick="location.reload()" class="mt-4 px-4 py-2 bg-[#0C6E71] text-white rounded-lg hover:bg-[#0a5c5e] transition-colors">
                                    <i class="fas fa-refresh mr-2"></i>Refresh
                                </button>
                            </div>
                        `);
                    },
                    complete: function() {
                        ajaxRunning = false;
                    }
                });
            }

            // Initialize chart with delay for better UX
            setTimeout(fetchData, 300);
        });
    </script>
@endpush
