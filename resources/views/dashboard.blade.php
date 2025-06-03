<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPENDEKAR - Sistem Pendidikan Kader</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        :root {
            --primary: #2563eb;
            --primary-light: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary: #0f172a;
            --accent: #1e40af;
            --accent-light: #3b82f6;
            --success: #0ea5e9;
            --warning: #0284c7;
            --danger: #0369a1;
            --light: #f0f9ff;
            --glass: rgba(59, 130, 246, 0.1);
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 30%, #1d4ed8 70%, #2563eb 100%);
            height: 100vh;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .floating-orbs {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            opacity: 0.15;
            animation: float 25s infinite ease-in-out;
        }

        .orb:nth-child(1) {
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, #2563eb, #3b82f6);
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .orb:nth-child(2) {
            width: 150px;
            height: 150px;
            background: linear-gradient(45deg, #1d4ed8, #2563eb);
            bottom: -75px;
            left: -75px;
            animation-delay: -10s;
        }

        .orb:nth-child(3) {
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #0ea5e9, #3b82f6);
            top: 40%;
            left: 45%;
            animation-delay: -15s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(20px, -20px) rotate(120deg);
            }

            66% {
                transform: translate(-15px, 15px) rotate(240deg);
            }
        }

        .glass-card {
            background: rgba(59, 130, 246, 0.08);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(59, 130, 246, 0.2);
            box-shadow: 0 8px 32px rgba(37, 99, 235, 0.15);
        }

        /* Header specific glass-card improvements */
        header .glass-card {
            background: rgba(59, 130, 246, 0.18);
            border: 1.5px solid rgba(59, 130, 246, 0.4);
            box-shadow: 0 12px 40px rgba(37, 99, 235, 0.3);
        }

        .glow-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glow-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 48px rgba(37, 99, 235, 0.25), 0 0 20px rgba(59, 130, 246, 0.3);
            border-color: rgba(59, 130, 246, 0.4);
        }

        .neon-text {
            color: #f8fafc;
            text-shadow: 0 0 15px rgba(59, 130, 246, 0.4);
        }

        /* Add subtle text shadow for better contrast in header */
        .header-section .neon-text {
            text-shadow:
                0 0 8px rgba(59, 130, 246, 0.7),
                0 0 15px rgba(59, 130, 246, 0.9),
                0 0 20px rgba(37, 99, 235, 0.8);
        }

        .gradient-border {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.4), rgba(59, 130, 246, 0.4));
            padding: 1px;
        }

        .animated-counter {
            animation: countUp 0.6s ease-out;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pulse-dot {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(14, 165, 233, 0.6);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(14, 165, 233, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(14, 165, 233, 0);
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 1rem;
            gap: 1rem;
        }

        .header-section {
            flex-shrink: 0;
            height: auto;
        }

        .main-content {
            flex: 1;
            min-height: 0;
        }

        .title-backdrop {
            background: rgba(59, 130, 246, 0.15);
            backdrop-filter: blur(16px);
            border-radius: 16px;
            padding: 1.5rem 2.5rem;
            border: 1px solid rgba(59, 130, 246, 0.25);
            margin: 0 1rem;
            box-shadow: 0 8px 32px rgba(37, 99, 235, 0.15);
        }

        /* Make title-backdrop more opaque for better separation */
        .header-section .title-backdrop {
            background: rgba(59, 130, 246, 0.28);
            border: 1.5px solid rgba(59, 130, 246, 0.45);
            box-shadow: 0 12px 40px rgba(37, 99, 235, 0.3);
        }

        .bright-card {
            background: rgba(248, 250, 252, 0.98);
            color: #0f172a;
            border: 1px solid rgba(59, 130, 246, 0.15);
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.08);
        }

        .dark-card {
            background: rgba(15, 23, 42, 0.8);
            color: #f8fafc;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .accent-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 50%, #60a5fa 100%);
        }

        .success-gradient {
            background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        }

        .warning-gradient {
            background: linear-gradient(135deg, #0284c7 0%, #0ea5e9 100%);
        }

        .subtle-border {
            border: 1px solid rgba(59, 130, 246, 0.15);
        }

        .text-muted {
            color: #64748b;
        }

        .bg-subtle {
            background: rgba(239, 246, 255, 0.8);
        }

        .bg-subtle-dark {
            background: rgba(37, 99, 235, 0.08);
        }

        .blue-accent {
            color: #2563eb;
        }

        .blue-bg {
            background: rgba(37, 99, 235, 0.1);
        }

        .blue-border {
            border-color: rgba(37, 99, 235, 0.2);
        }

        .header-grid {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            align-items: center;
            width: 100%;
        }

        .center-title {
            justify-self: center;
        }

        .right-clock {
            justify-self: end;
        }
    </style>
</head>

<body>
    <!-- Floating Background Orbs -->
    <div class="floating-orbs">
        <div class="orb"></div>
        <div class="orb"></div>
        <div class="orb"></div>
    </div>

    <div class="relative z-10 main-container">
        <!-- Header -->
        <header class="header-section text-white">
            <div class="header-grid">
                <!-- Left: Date -->
                <div class="glass-card rounded-xl px-4 py-3 glow-hover" style="width: fit-content">
                    <div class="text-xs text-blue-200">
                        <i class="fas fa-calendar-alt mr-1"></i>Today
                    </div>
                    <div class="text-lg font-semibold" id="current-date">Rabu, 15 Februari 2023</div>
                </div>

                <!-- Center: Title -->
                <div class="center-title">
                    <button onclick="openFullscreen()">
                        <div class="title-backdrop">
                            <h1 class="text-4xl font-extrabold mb-1 neon-text">
                                <span class="text-white">SI-</span><span class="text-blue-300">IDBC</span>
                            </h1>
                            <p class="text-sm font-medium tracking-wider text-blue-100">Sistem Informasi IDBC</p>
                            <div
                                class="w-24 h-0.5 bg-gradient-to-r from-blue-300 to-blue-400 mx-auto mt-2 rounded-full opacity-80">
                            </div>
                        </div>
                    </button>
                </div>

                <!-- Right: Clock -->
                <div class="right-clock">
                    <div class="glass-card rounded-xl px-4 py-3 glow-hover">
                        <div class="text-xs text-blue-200 text-right">
                            <i class="fas fa-clock mr-1"></i>Live Time
                        </div>
                        <div class="text-lg font-semibold text-right" id="live-clock">09:42:20</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Dashboard Grid -->
        <main class="main-content grid grid-cols-12 gap-4 h-full">
            <!-- Left Panel -->
            <section class="col-span-3 flex flex-col h-full">
                <!-- Attendance Card -->
                <div class="glass-card rounded-xl overflow-hidden glow-hover h-full">
                    <div class="bright-card rounded-xl p-4 h-full flex flex-col">
                        <!-- Header Section -->
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-3 accent-gradient">
                                <i class="fas fa-user-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-sm text-slate-800">ATTENDANCE</h3>
                                <p class="text-muted text-xs">Real-time Status</p>
                            </div>
                        </div>

                        <!-- Filter Form -->
                        <form action="{{ route('dashboard') }}" method="GET" class="mb-4 w-full">
                            <div class="flex flex-row items-center gap-2 flex-wrap w-full">
                                <!-- Dropdown Kelas -->
                                <div class="bg-subtle rounded-md px-2 py-1 subtle-border flex-grow min-w-[120px]">
                                    <select name="kelas_id"
                                        class="w-full bg-transparent text-sm border-0 focus:outline-none focus:ring-1 focus:ring-blue-300">
                                        <option value="">All Classes</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id }}"
                                                {{ $kelasId == $k->id ? 'selected' : '' }}>
                                                {{ $k->kelas_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Dropdown Gender -->
                                <div class="bg-subtle rounded-md px-2 py-1 subtle-border">
                                    <select name="gender"
                                        class="w-20 bg-transparent text-sm border-0 focus:outline-none focus:ring-1 focus:ring-blue-300">
                                        <option value="">All</option>
                                        <option value="L" {{ $gender == 'L' ? 'selected' : '' }}>Male</option>
                                        <option value="P" {{ $gender == 'P' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>

                                <!-- Filter Button -->
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs transition-all shadow-sm flex items-center gap-1">
                                    <i class="fas fa-filter"></i>
                                    <span>Filter</span>
                                </button>
                            </div>
                        </form>

                        <!-- Attendance List -->
                        <div class="flex-1 overflow-y-auto pr-1 mb-3">
                            <h4
                                class="text-sm font-semibold text-slate-800 mb-2 sticky top-0 bg-white/80 backdrop-blur-sm z-10 py-1">
                                Today's Attendance</h4>
                            @forelse($detailAbsensi as $absen)
                                <div
                                    class="flex items-center p-2 bg-subtle rounded-lg subtle-border mb-2 hover:bg-slate-50 transition-colors">
                                    <div class="relative shrink-0">
                                        @if ($absen['image'])
                                            <img src="{{ asset('storage/images/' . $absen['image']) }}"
                                                alt="{{ $absen['nama'] }}"
                                                class="w-10 h-10 rounded-full object-cover border border-slate-200">
                                        @else
                                            <div
                                                class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center border border-slate-200">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div
                                            class="absolute -bottom-1 -right-1 w-3 h-3 rounded-full border border-white 
                            {{ $absen['status'] == 'H' ? 'bg-green-500' : ($absen['status'] == 'S' ? 'bg-yellow-500' : 'bg-blue-500') }}">
                                        </div>
                                    </div>
                                    <div class="ml-3 flex-1 min-w-0">
                                        <div class="flex justify-between items-center gap-2">
                                            <div class="text-sm font-medium text-slate-700 truncate">
                                                {{ $absen['nama'] }}</div>
                                            <div class="text-xs text-slate-500 whitespace-nowrap">{{ $absen['waktu'] }}
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center gap-2 mt-1">
                                            <div class="text-xs text-slate-500 truncate">
                                                {{ $absen['nim'] }} •
                                                {{ $absen['gender'] == 'L' ? 'Male' : 'Female' }}
                                            </div>
                                            <div
                                                class="text-xs px-2 py-0.5 rounded-full whitespace-nowrap
                                {{ $absen['status'] == 'H'
                                    ? 'bg-green-100 text-green-700'
                                    : ($absen['status'] == 'S'
                                        ? 'bg-yellow-100 text-yellow-700'
                                        : 'bg-blue-100 text-blue-700') }}">
                                                {{ $absen['status'] == 'H' ? 'Present' : ($absen['status'] == 'S' ? 'Sick' : 'Permit') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 text-slate-400 text-sm bg-slate-50 rounded-lg">
                                    <i class="fas fa-calendar-xmark mb-2 text-lg"></i>
                                    <p>No attendance data today</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Summary Stats (Moved to Bottom) -->
                        <div class="mt-auto pt-3 border-t border-slate-100">
                            <div class="grid grid-cols-4 gap-2">
                                <!-- Total Students -->
                                <div class="text-center p-2 bg-blue-50 rounded-lg">
                                    <div class="text-xl font-bold text-blue-600">{{ $totalMahasiswa }}</div>
                                    <div class="text-xs text-slate-500 mt-1">Total</div>
                                </div>

                                <!-- Present -->
                                <div class="text-center p-2 bg-green-50 rounded-lg">
                                    <div class="text-xl font-bold text-green-600">{{ $hadir }}</div>
                                    <div class="text-xs text-slate-500 mt-1">Present</div>
                                </div>

                                <!-- Sick -->
                                <div class="text-center p-2 bg-yellow-50 rounded-lg">
                                    <div class="text-xl font-bold text-yellow-600">{{ $tidakHadir }}</div>
                                    <div class="text-xs text-slate-500 mt-1">Sick</div>
                                </div>

                                <!-- Not Present -->
                                <div class="text-center p-2 bg-red-50 rounded-lg">
                                    <div class="text-xl font-bold text-red-600">{{ $belumAbsen }}</div>
                                    <div class="text-xs text-slate-500 mt-1">Absent</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Center Panel -->
            <section class="col-span-6 flex flex-col gap-4 h-full">
                <!-- Main Video/Content Area -->
                <div class="glass-card rounded-xl overflow-hidden glow-hover h-full">
                    <div class="accent-gradient rounded-xl h-full flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-blue-700/20"></div>

                        <div class="relative z-10 text-center text-white">
                            <div
                                class="w-16 h-16 rounded-xl flex items-center justify-center mb-4 mx-auto cursor-pointer transition-all hover:scale-105 bg-white/20 backdrop-blur-sm">
                                <i class="fas fa-play text-2xl text-white ml-1"></i>
                            </div>

                            @if ($featuredCourse)
                                <h2 class="text-3xl font-bold mb-2">
                                    {{ $featuredCourse->matkul->makul_name ?? 'TIDAK ADA JADWAL' }}</h2>
                                <p class="text-base opacity-90 mb-3">
                                    {{ $featuredCourse->dosen->dosen_name ?? 'Tidak ada dosen' }}</p>
                                <div class="flex justify-center space-x-2">
                                    <span
                                        class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium backdrop-blur-sm">
                                        {{ $featuredCourse->start_time ?? '00:00' }} -
                                        {{ $featuredCourse->end_time ?? '00:00' }}
                                    </span>
                                    <span
                                        class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium backdrop-blur-sm">
                                        {{ $featuredCourse->kelas->kelas_name ?? 'Tidak ada kelas' }}
                                    </span>
                                </div>
                            @else
                                <h2 class="text-3xl font-bold mb-2">TIDAK ADA JADWAL</h2>
                                <p class="text-base opacity-90 mb-3">Tidak ada jadwal kuliah hari ini</p>
                                <div class="flex justify-center space-x-2">
                                    <span
                                        class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium backdrop-blur-sm">
                                        Libur
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Performance Stats -->
                    <div class="glass-card rounded-xl glow-hover">
                        <div class="bright-card rounded-xl p-4 h-full">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-chart-line text-lg text-sky-600 mr-2"></i>
                                <h3 class="font-semibold text-sm text-slate-800">PERFORMANCE STATS</h3>
                            </div>

                            <div class="space-y-3">
                                @forelse($kelasPerformance as $index => $performance)
                                    <!-- Class {{ $index + 1 }} -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            @php
                                                $colors = [
                                                    'blue',
                                                    'green',
                                                    'yellow',
                                                    'purple',
                                                    'red',
                                                    'indigo',
                                                    'pink',
                                                ];
                                                $colorIndex = $index % count($colors);
                                                $color = $colors[$colorIndex];
                                                $initial = substr($performance['kelas_name'] ?? 'X', 0, 1);
                                            @endphp
                                            <div
                                                class="w-8 h-8 rounded-full bg-{{ $color }}-100 flex items-center justify-center">
                                                <span
                                                    class="text-{{ $color }}-600 text-xs font-semibold">{{ $initial }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium">
                                                    {{ $performance['kelas_name'] ?? 'Tidak Diketahui' }}
                                                </div>
                                                <div class="text-xs text-muted">
                                                    {{ number_format($performance['attendance_rate'], 1) }}% Attendance
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $gradeColors = [
                                                'A' => 'text-green-500',
                                                'B' => 'text-blue-500',
                                                'C' => 'text-yellow-500',
                                                'D' => 'text-orange-500',
                                                'E' => 'text-red-500',
                                            ];
                                            $gradeColor = $gradeColors[$performance['grade']] ?? 'text-gray-500';
                                        @endphp
                                        <div class="{{ $gradeColor }} font-semibold text-sm">
                                            {{ $performance['grade'] }}</div>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <div class="text-gray-500 text-sm">Tidak ada data performa kelas</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Schedule -->
                    <div class="glass-card rounded-xl glow-hover">
                        <div class="bright-card rounded-xl p-4 h-full">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-calendar-check text-lg text-sky-600 mr-2"></i>
                                <h3 class="font-semibold text-sm text-slate-800">TODAY'S SCHEDULE</h3>
                            </div>

                            <div class="space-y-3">
                                <div class="relative w-full max-w-xl mx-auto overflow-hidden">
                                    <div id="slider" class="flex transition-transform duration-500 ease-in-out">
                                        @forelse($jadwalHariIni as $index => $jadwal)
                                            <!-- Slide {{ $index + 1 }} -->
                                            <div class="min-w-full px-4">
                                                <div class="bg-blue-50 rounded-lg p-3 border-l-4 border-blue-400">
                                                    <div class="text-blue-600 font-semibold text-sm mb-1">
                                                        {{ $jadwal->matkul->makul_name ?? 'Tidak ada mata kuliah' }}
                                                    </div>
                                                    <div class="text-muted text-xs mb-1">
                                                        {{ $jadwal->dosen->dosen_name ?? 'Tidak ada dosen' }}</div>
                                                    <div class="text-muted text-xs">{{ $jadwal->start ?? '00:00' }} -
                                                        {{ $jadwal->ended ?? '00:00' }}</div>
                                                    @php
                                                        $now = \Carbon\Carbon::now();
                                                        $startTime = \Carbon\Carbon::createFromFormat(
                                                            'H:i:s',
                                                            $jadwal->start,
                                                        );
                                                        $endTime = \Carbon\Carbon::createFromFormat(
                                                            'H:i:s',
                                                            $jadwal->ended,
                                                        );
                                                        $isActive = $now->between($startTime, $endTime);
                                                        $isNext = $now->lt($startTime);
                                                    @endphp
                                                    <div
                                                        class="inline-block px-2 py-1 {{ $isActive ? 'bg-blue-500' : ($isNext ? 'bg-slate-500' : 'bg-gray-500') }} text-white text-xs rounded-full mt-1">
                                                        {{ $isActive ? 'ACTIVE' : ($isNext ? 'NEXT' : 'DONE') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <!-- No Schedule Slide -->
                                            <div class="min-w-full px-4">
                                                <div class="bg-gray-50 rounded-lg p-3 border-l-4 border-gray-400">
                                                    <div class="text-gray-600 font-semibold text-sm mb-1">Tidak Ada
                                                        Jadwal</div>
                                                    <div class="text-muted text-xs mb-1">Tidak ada jadwal kuliah hari
                                                        ini</div>
                                                    <div class="text-muted text-xs">--:-- - --:--</div>
                                                    <div
                                                        class="inline-block px-2 py-1 bg-gray-500 text-white text-xs rounded-full mt-1">
                                                        LIBUR
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Right Panel -->
            <section class="col-span-3 flex flex-col gap-4 h-full">
                <!-- Student of the Week -->
                <div class="glass-card rounded-xl glow-hover">
                    <div class="bright-card rounded-xl p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-crown text-xl text-blue-500 mb-2"></i>
                            <h3 class="font-semibold text-sm text-slate-800">STUDENT OF THE WEEK</h3>
                        </div>

                        <div class="relative mb-3">
                            <div class="w-14 h-14 mx-auto rounded-xl overflow-hidden accent-gradient">
                                <div class="w-full h-full flex items-center justify-center text-white text-lg">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                            </div>
                        </div>

                        <h4 class="font-semibold text-base text-slate-800 mb-1">Ahmad Rizki</h4>
                        <p class="text-muted text-xs mb-3">Multimedia Student</p>

                        <div class="bg-subtle rounded-xl p-3 subtle-border">
                            <div class="text-2xl font-bold blue-accent">98.5</div>
                            <div class="text-muted text-xs">Average Score</div>
                        </div>
                    </div>
                </div>

                <!-- Live Activity -->
                <div class="glass-card rounded-xl glow-hover flex-1">
                    <div class="bright-card rounded-xl p-4 h-full flex flex-col">
                        <div class="flex items-center mb-3">
                            <div class="w-3 h-3 bg-sky-500 rounded-full mr-2 pulse-dot"></div>
                            <h3 class="font-semibold text-sm text-slate-800">LIVE ACTIVITY</h3>
                        </div>

                        <div class="flex-1 flex flex-col justify-between">
                            <div class="text-center mb-3">
                                <div class="text-xl font-semibold blue-accent mb-1">09:32 - 09:45</div>
                                <p class="text-muted text-xs">Current Session</p>
                            </div>

                            <div class="bg-sky-50 rounded-xl p-3 mb-3 border border-sky-200">
                                <div class="text-slate-700 font-medium text-sm mb-1">🎓 Pengajaran - Khusuf</div>
                                <div class="text-muted text-xs">Active Session</div>
                            </div>

                            <div class="space-y-2">
                                <div
                                    class="flex justify-between items-center p-2 bg-blue-50 rounded-lg border border-blue-200">
                                    <span class="text-slate-700 text-xs">☕ Break</span>
                                    <span class="text-muted text-xs">09:46 - 11:14</span>
                                </div>
                                <div
                                    class="flex justify-between items-center p-2 bg-indigo-50 rounded-lg border border-indigo-200">
                                    <span class="text-slate-700 text-xs">🌅 Morning Class</span>
                                    <span class="text-muted text-xs">11:15 - 11:35</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        function openFullscreen() {
            const elem = document.documentElement;
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        }

        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            const dateString = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            document.getElementById('live-clock').textContent = timeString;
            document.getElementById('current-date').textContent = dateString;
        }

        updateClock();
        setInterval(updateClock, 1000);

        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.glass-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('slide-in');
                }, index * 80);
            });

            setInterval(() => {
                const counters = document.querySelectorAll('.animated-counter');
                counters.forEach(counter => {
                    const current = parseInt(counter.textContent);
                    const variation = Math.floor(Math.random() * 3) - 1;
                    const newValue = Math.max(35, Math.min(45, current + variation));

                    if (newValue !== current) {
                        counter.style.transform = 'scale(1.05)';
                        setTimeout(() => {
                            counter.textContent = newValue;
                            counter.style.transform = 'scale(1)';
                        }, 150);
                    }
                });
            }, 15000);

            const hoverElements = document.querySelectorAll('.glow-hover');
            hoverElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.005)';
                });

                element.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });

        const slider = document.getElementById('slider');
        const slideCount = slider.children.length;
        let index = 0;

        setInterval(() => {
            index = (index + 1) % slideCount;
            slider.style.transform = `translateX(-${index * 100}%)`;
        }, 4000);

        const gradeSlider = document.getElementById('gradeSlider');
        const gradeSlideCount = gradeSlider.children.length;
        let gradeIndex = 0;

        setInterval(() => {
            gradeIndex = (gradeIndex + 1) % gradeSlideCount;
            gradeSlider.style.transform = `translateX(-${gradeIndex * 100}%)`;
        }, 4000);
    </script>
</body>

</html>
