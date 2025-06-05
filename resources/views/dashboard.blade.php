<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPENDEKAR - Sistem Pendidikan Kader</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        /* Floating orbs animation */
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

        .orb {
            animation: float 25s infinite ease-in-out;
        }

        .orb:nth-child(1) {
            animation-delay: 0s;
        }

        .orb:nth-child(2) {
            animation-delay: -10s;
        }

        .orb:nth-child(3) {
            animation-delay: -15s;
        }

        /* Pulse animation for live indicator */
        @keyframes pulse-dot {
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

        .pulse-dot {
            animation: pulse-dot 2s infinite;
        }

        /* Slide in animation */
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

        .slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-blue-600 min-h-screen overflow-hidden">
    <!-- Floating Background Orbs -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div
            class="orb absolute w-48 h-48 rounded-full bg-gradient-to-br from-blue-600 to-blue-500 opacity-15 -top-24 -right-24">
        </div>
        <div
            class="orb absolute w-36 h-36 rounded-full bg-gradient-to-br from-blue-700 to-blue-600 opacity-15 -bottom-18 -left-18">
        </div>
        <div
            class="orb absolute w-24 h-24 rounded-full bg-gradient-to-br from-sky-500 to-blue-500 opacity-15 top-2/5 left-2/5">
        </div>
    </div>

    <div class="relative z-10 flex flex-col h-screen p-4 gap-4">
        <!-- Header -->
        <header class="text-white">
            <div class="grid grid-cols-3 items-center w-full">
                <!-- Left: Date -->
                <div
                    class="bg-blue-500/20 backdrop-blur-md border border-blue-400/30 rounded-xl px-4 py-3 shadow-lg hover:shadow-blue-500/25 hover:-translate-y-0.5 transition-all duration-300 w-fit">
                    <div class="text-xs text-blue-200">
                        <i class="fas fa-calendar-alt mr-1"></i>Today
                    </div>
                    <div class="text-lg font-semibold" id="current-date">Rabu, 15 Februari 2023</div>
                </div>

                <!-- Center: Title -->
                <div class="justify-self-center">
                    <button onclick="openFullscreen()" class="group">
                        <div
                            class="bg-blue-500/30 backdrop-blur-md border border-blue-400/40 rounded-2xl px-10 py-6 shadow-2xl hover:shadow-blue-500/30 transition-all duration-300">
                            <h1 class="text-4xl font-extrabold mb-1 text-white drop-shadow-lg">
                                <span>SI-</span><span class="text-blue-300">IDBC</span>
                            </h1>
                            <p class="text-sm font-medium tracking-wider text-blue-100">Sistem Informasi IDBC</p>
                            <div
                                class="w-24 h-0.5 bg-gradient-to-r from-blue-300 to-blue-400 mx-auto mt-2 rounded-full opacity-80">
                            </div>
                        </div>
                    </button>
                </div>

                <!-- Right: Clock -->
                <div class="justify-self-end">
                    <div
                        class="bg-blue-500/20 backdrop-blur-md border border-blue-400/30 rounded-xl px-4 py-3 shadow-lg hover:shadow-blue-500/25 hover:-translate-y-0.5 transition-all duration-300">
                        <div class="text-xs text-blue-200 text-right">
                            <i class="fas fa-clock mr-1"></i>Live Time
                        </div>
                        <div class="text-lg font-semibold text-right" id="live-clock">09:42:20</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Dashboard Grid -->
        <main class="grid grid-cols-12 gap-4 flex-1 min-h-0">
            <!-- Left Panel -->
            <section class="col-span-3 flex flex-col h-full bg-white rounded-xl">
                <!-- Attendance Card -->
                <div
                    class="bg-blue-500/10 backdrop-blur-md border border-blue-400/20 rounded-xl shadow-lg hover:shadow-blue-500/15 hover:-translate-y-0.5 transition-all duration-300 h-full">
                    <div class="bg-white/98 rounded-xl p-4 h-full flex flex-col text-slate-900 shadow-md">
                        <!-- Header Section -->
                        <div class="flex items-center mb-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-500 flex items-center justify-center mr-3">
                                <i class="fas fa-user-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-sm text-slate-800">ATTENDANCE</h3>
                                <p class="text-slate-500 text-xs">Real-time Status</p>
                            </div>
                        </div>

                        <!-- Filter Form -->
                        <form action="{{ route('dashboard') }}" method="GET" class="mb-4 w-full">
                            <div class="flex flex-row items-center gap-2 flex-wrap w-full">
                                <!-- Dropdown Kelas -->
                                <div
                                    class="bg-blue-50/80 rounded-md px-2 py-1 border border-blue-200/50 flex-grow min-w-[120px]">
                                    <select name="kelas_id"
                                        class="w-full bg-transparent text-sm border-0 focus:outline-none focus:ring-1 focus:ring-blue-300">
                                        <option value="">All Classes</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id }}"
                                                {{ $kelasId == $k->id ? 'selected' : '' }}>
                                                {{ $k->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Dropdown Gender -->
                                <div class="bg-blue-50/80 rounded-md px-2 py-1 border border-blue-200/50">
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
                        <div id ="attendanceContainer" class="flex-1 overflow-y-auto pr-1 mb-3">
                            <h4 class="text-sm font-semibold text-slate-800 mb-2 sticky top-0 z-10 py-1">Today's
                                Attendance</h4>
                            @forelse($detailAbsensi as $absen)
                                <div
                                    class="flex items-center p-2 bg-blue-50/80 rounded-lg border border-blue-200/50 mb-2 hover:bg-slate-50 transition-colors">
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
                                            class="absolute -bottom-1 -right-1 w-3 h-3 rounded-full border border-white {{ $absen['status'] == 'H' ? 'bg-green-500' : ($absen['status'] == 'S' ? 'bg-yellow-500' : 'bg-blue-500') }}">
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
                                                class="text-xs px-2 py-0.5 rounded-full whitespace-nowrap {{ $absen['status'] == 'H' ? 'bg-green-100 text-green-700' : ($absen['status'] == 'S' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700') }}">
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

                        <!-- Summary Stats -->
                        <div class="mt-auto pt-3 border-t border-slate-100">
                            <div id="summaryContainer" class="grid grid-cols-4 gap-2">
                                <div class="text-center p-2 bg-blue-50 rounded-lg">
                                    <div class="text-xl font-bold text-blue-600">{{ $totalMahasiswa }}</div>
                                    <div class="text-xs text-slate-500 mt-1">Total</div>
                                </div>
                                <div class="text-center p-2 bg-green-50 rounded-lg">
                                    <div class="text-xl font-bold text-green-600">{{ $hadir }}</div>
                                    <div class="text-xs text-slate-500 mt-1">Present</div>
                                </div>
                                <div class="text-center p-2 bg-yellow-50 rounded-lg">
                                    <div class="text-xl font-bold text-yellow-600">{{ $tidakHadir }}</div>
                                    <div class="text-xs text-slate-500 mt-1">Sick</div>
                                </div>
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
                <div
                    class="bg-blue-500/10 backdrop-blur-md border border-blue-400/20 rounded-xl shadow-lg hover:shadow-blue-500/15 hover:-translate-y-0.5 transition-all duration-300 h-full">
                    <div id="featuredContainer"
                        class="bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl h-full flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-blue-700/20"></div>

                        <div class="relative z-10 text-center text-white">
                            <div
                                class="w-16 h-16 rounded-xl flex items-center justify-center mb-4 mx-auto cursor-pointer transition-all hover:scale-105 bg-white/20 backdrop-blur-sm">
                                <i class="fas fa-play text-2xl text-white ml-1"></i>
                            </div>

                            @if ($featuredCourse)
                                <h2 class="text-3xl font-bold mb-2">
                                    {{ $featuredCourse->matkul->name ?? 'TIDAK ADA JADWAL' }}</h2>
                                <p class="text-base opacity-90 mb-3">
                                    {{ $featuredCourse->dosen->dsn_name ?? 'Tidak ada dosen' }}</p>
                                <div class="flex justify-center space-x-2">
                                    <span
                                        class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium backdrop-blur-sm">
                                        {{ $featuredCourse->start ?? '00:00' }} -
                                        {{ $featuredCourse->ended ?? '00:00' }}
                                    </span>
                                    <span
                                        class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium backdrop-blur-sm">
                                        {{ $featuredCourse->kelas->name ?? 'Tidak ada kelas' }}
                                    </span>
                                </div>
                            @else
                                <h2 class="text-3xl font-bold mb-2">TIDAK ADA JADWAL</h2>
                                <p class="text-base opacity-90 mb-3">Tidak ada jadwal kuliah hari ini</p>
                                <div class="flex justify-center space-x-2">
                                    <span
                                        class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium backdrop-blur-sm">Libur</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Performance Stats -->
                    <div
                        class="bg-white backdrop-blur-md border border-blue-400/20 rounded-xl shadow-lg hover:shadow-blue-500/15 hover:-translate-y-0.5 transition-all duration-300">
                        <div class="bg-white/98 rounded-xl p-4 h-full text-slate-900 shadow-md">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-chart-line text-lg text-sky-600 mr-2"></i>
                                <h3 class="font-semibold text-sm text-slate-800">PERFORMANCE STATS</h3>
                            </div>

                            <div id="performanceStats" class="space-y-3">
                                @forelse($kelasPerformance as $index => $performance)
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
                                                $initial = substr($performance['name'] ?? 'X', 0, 1);
                                            @endphp
                                            <div
                                                class="w-8 h-8 rounded-full bg-{{ $color }}-100 flex items-center justify-center">
                                                <span
                                                    class="text-{{ $color }}-600 text-xs font-semibold">{{ $initial }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium">
                                                    {{ $performance['name'] ?? 'Tidak Diketahui' }}</div>
                                                <div class="text-xs text-slate-500">
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
                    <div
                        class="bg-white backdrop-blur-md border border-blue-400/20 rounded-xl shadow-lg hover:shadow-blue-500/15 hover:-translate-y-0.5 transition-all duration-300">
                        <div class="bg-white/98 rounded-xl p-4 h-full text-slate-900 shadow-md">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-calendar-check text-lg text-sky-600 mr-2"></i>
                                <h3 class="font-semibold text-sm text-slate-800">TODAY'S SCHEDULE</h3>
                            </div>

                            <div class="space-y-3">
                                <div class="relative w-full max-w-xl mx-auto overflow-hidden">
                                    <div id="slider" class="flex transition-transform duration-500 ease-in-out">
                                        @forelse($jadwalHariIni as $index => $jadwal)
                                            <div class="min-w-full px-4">
                                                <div class="bg-blue-50 rounded-lg p-3 border-l-4 border-blue-400">
                                                    <div class="text-blue-600 font-semibold text-sm mb-1">
                                                        {{ $jadwal->matkul->name ?? 'Tidak ada mata kuliah' }}</div>
                                                    <div class="text-slate-500 text-xs mb-1">
                                                        {{ $jadwal->dosen->dsn_name ?? 'Tidak ada dosen' }}</div>
                                                    <div class="text-slate-500 text-xs">
                                                        {{ $jadwal->start ?? '00:00' }} -
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
                                            <div class="min-w-full px-4">
                                                <div class="bg-gray-50 rounded-lg p-3 border-l-4 border-gray-400">
                                                    <div class="text-gray-600 font-semibold text-sm mb-1">Tidak Ada
                                                        Jadwal</div>
                                                    <div class="text-slate-500 text-xs mb-1">Tidak ada jadwal kuliah
                                                        hari ini</div>
                                                    <div class="text-slate-500 text-xs">--:-- - --:--</div>
                                                    <div
                                                        class="inline-block px-2 py-1 bg-gray-500 text-white text-xs rounded-full mt-1">
                                                        LIBUR</div>
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
                <div
                    class="bg-white backdrop-blur-md border border-blue-400/20 rounded-xl shadow-lg hover:shadow-blue-500/15 hover:-translate-y-0.5 transition-all duration-300">
                    <div id="studentOfWeek" class="bg-white/98 rounded-xl p-4 text-center text-slate-900 shadow-md">
                        <div class="mb-3">
                            <i class="fas fa-crown text-xl text-blue-500 mb-2"></i>
                            <h3 class="font-semibold text-sm text-slate-800">STUDENT OF THE WEEK</h3>
                        </div>

                        @if ($studentOfWeek)
                            <div class="relative mb-3">
                                <div
                                    class="w-14 h-14 mx-auto rounded-xl bg-gradient-to-br from-blue-600 to-blue-500 overflow-hidden">
                                    <div class="w-full h-full flex items-center justify-center text-white text-lg">
                                        <img src="{{ asset('storage/images/' . $studentOfWeek->mhs_image) }}"
                                            alt="Foto {{ $studentOfWeek->mhs_name }}"
                                            class="w-12 h-12 rounded-full object-cover shadow-lg border-2 border-white">
                                    </div>
                                </div>
                            </div>

                            <h4 class="font-semibold text-base text-slate-800 mb-1">{{ $studentOfWeek->mhs_name }}
                            </h4>
                            <p class="text-slate-500 text-xs mb-3">
                                {{ $studentOfWeek->kelas->first()->name ?? 'Mahasiswa' }}</p>

                            <div class="bg-blue-50/80 rounded-xl p-3 border border-blue-200/50">
                                <div class="text-2xl font-bold text-blue-600">{{ $studentOfWeek->attendance_count }}
                                </div>
                                <div class="text-slate-500 text-xs">Kehadiran Minggu Ini</div>
                            </div>
                        @else
                            <h4 class="font-semibold text-base text-slate-800 mb-1">Belum Ada</h4>
                            <p class="text-slate-500 text-xs mb-3">Mahasiswa Terbaik</p>

                            <div class="bg-blue-50/80 rounded-xl p-3 border border-blue-200/50">
                                <div class="text-2xl font-bold text-blue-600">0</div>
                                <div class="text-slate-500 text-xs">Kehadiran Minggu Ini</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Live Activity -->
                <div
                    class="bg-white backdrop-blur-md border border-blue-400/20 rounded-xl shadow-lg hover:shadow-blue-500/15 hover:-translate-y-0.5 transition-all duration-300 flex-1">
                    <div class="bg-white/98 rounded-xl p-4 h-full flex flex-col text-slate-900 shadow-md">
                        <div class="flex items-center mb-3">
                            <div class="w-3 h-3 bg-sky-500 rounded-full mr-2 pulse-dot"></div>
                            <h3 class="font-semibold text-sm text-slate-800">LIVE ACTIVITY</h3>
                        </div>

                        <div id="liveActivity" class="flex-1 flex flex-col justify-between">
                            @if ($activeSession)
                                <div class="text-center mb-3">
                                    <div class="text-xl font-semibold text-blue-600 mb-1">{{ $activeSession->start }}
                                        - {{ $activeSession->ended }}</div>
                                    <p class="text-slate-500 text-xs">Sesi Saat Ini</p>
                                </div>

                                <div class="bg-sky-50 rounded-xl p-3 mb-3 border border-sky-200">
                                    <div class="text-slate-700 font-medium text-sm mb-1">🎓
                                        {{ $activeSession->matkul->name ?? 'Tidak ada mata kuliah' }}</div>
                                    <div class="text-slate-500 text-xs">
                                        {{ $activeSession->dosen->dsn_name ?? 'Tidak ada dosen' }}</div>
                                </div>
                            @else
                                <div class="text-center mb-3">
                                    <div class="text-xl font-semibold text-blue-600 mb-1">--:-- - --:--</div>
                                    <p class="text-slate-500 text-xs">Tidak Ada Sesi Aktif</p>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-3 mb-3 border border-gray-200">
                                    <div class="text-slate-700 font-medium text-sm mb-1">🎓 Tidak Ada Mata Kuliah</div>
                                    <div class="text-slate-500 text-xs">Tidak Ada Dosen</div>
                                </div>
                            @endif

                            <div class="space-y-2">
                                @forelse($upcomingSessions as $index => $session)
                                    <div
                                        class="flex justify-between items-center p-2 {{ $index == 0 ? 'bg-blue-50 border border-blue-200' : 'bg-indigo-50 border border-indigo-200' }} rounded-lg">
                                        <span
                                            class="text-slate-700 text-xs">{{ $session->matkul->name ?? 'Tidak ada mata kuliah' }}</span>
                                        <span class="text-slate-500 text-xs">{{ $session->start }} -
                                            {{ $session->ended }}</span>
                                    </div>
                                @empty
                                    <div
                                        class="flex justify-between items-center p-2 bg-gray-50 rounded-lg border border-gray-200">
                                        <span class="text-slate-700 text-xs">Tidak Ada Jadwal Mendatang</span>
                                        <span class="text-slate-500 text-xs">--:-- - --:--</span>
                                    </div>
                                @endforelse
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

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`; // manual pakai titik dua

            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dateString = now.toLocaleDateString('id-ID', options);

            document.getElementById('live-clock').textContent = timeString;
            document.getElementById('current-date').textContent = dateString;
        }

        // Mulai clock
        updateClock();
        setInterval(updateClock, 1000);

        // Animation effects on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Slide-in animation for cards
            const cards = document.querySelectorAll('.bg-blue-500\\/10');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('slide-in');
                }, index * 80);
            });

            // Auto-slider for schedule
            const slider = document.getElementById('slider');
            if (slider) {
                const slideCount = slider.children.length;
                let index = 0;

                setInterval(() => {
                    index = (index + 1) % slideCount;
                    slider.style.transform = `translateX(-${index * 100}%)`;
                }, 4000);
            }

            // Hover effects
            const hoverElements = document.querySelectorAll('.bg-blue-500\\/10');
            hoverElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });

                element.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
    @include('dashboard-ajax')
</body>

</html>
