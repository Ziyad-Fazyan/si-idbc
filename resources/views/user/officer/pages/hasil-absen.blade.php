<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pengenalan Wajah</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        
        .similarity-high {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .similarity-medium {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .similarity-low {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .status-verified {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .status-pending {
            background-color: #fef9c3;
            color: #854d0e;
        }
        
        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .btn-primary {
            background-color: #0C6E71;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #0A5C5E;
            transform: translateY(-1px);
        }
        
        .btn-secondary {
            background-color: #f1f5f9;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background-color: #e2e8f0;
            transform: translateY(-1px);
        }
        
        .face-match-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(12, 110, 113, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(12, 110, 113, 0); }
            100% { box-shadow: 0 0 0 0 rgba(12, 110, 113, 0); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <section class="w-full">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <!-- Header with icon and title -->
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-[#0C6E71] to-[#0891b2]">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-white/10 text-white mr-4">
                            <i class="fas fa-user-check text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Hasil Pengenalan Wajah</h1>
                            <p class="text-white/90">Detail hasil verifikasi kehadiran menggunakan pengenalan wajah</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    @if(session('face_results'))
                        @php 
                            $results = session('face_results');
                            $jadwal = session('jadwal_hari_ini'); 
                        @endphp
                        
                        @if(count($results) > 0)
                            @foreach($results as $result)
                                <div class="bg-gradient-to-br from-gray-50 to-white p-6 rounded-xl mb-6 shadow-sm border border-gray-200 face-match-animation">
                                    <!-- Student and Recognition Result Row -->
                                    <div class="flex flex-col lg:flex-row gap-6 mb-6">
                                        <!-- Student Data Card -->
                                        <div class="w-full lg:w-1/2">
                                            <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200 h-full">
                                                <div class="flex items-center mb-4">
                                                    <div class="p-2 rounded-lg bg-[#0C6E71] text-white mr-3">
                                                        <i class="fas fa-user-graduate"></i>
                                                    </div>
                                                    <h3 class="text-xl font-semibold text-gray-800">Data Mahasiswa</h3>
                                                </div>
                                                
                                                @if(isset($result['mahasiswa_data']))
                                                    <div class="space-y-3">
                                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                            <span class="text-gray-600 flex items-center">
                                                                <i class="fas fa-id-card mr-2 text-sm opacity-70"></i>
                                                                NIM:
                                                            </span>
                                                            <span class="font-medium text-gray-800">{{ $result['mahasiswa_data']['nim'] }}</span>
                                                        </div>
                                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                            <span class="text-gray-600 flex items-center">
                                                                <i class="fas fa-user mr-2 text-sm opacity-70"></i>
                                                                Nama:
                                                            </span>
                                                            <span class="font-medium text-gray-800">{{ $result['mahasiswa_data']['name'] }}</span>
                                                        </div>
                                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                            <span class="text-gray-600 flex items-center">
                                                                <i class="fas fa-users mr-2 text-sm opacity-70"></i>
                                                                Kelas:
                                                            </span>
                                                            <span class="font-medium text-gray-800">{{ $result['mahasiswa_data']['kelas'] }}</span>
                                                        </div>
                                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                            <span class="text-gray-600 flex items-center">
                                                                <i class="fas fa-graduation-cap mr-2 text-sm opacity-70"></i>
                                                                Program Studi:
                                                            </span>
                                                            <span class="font-medium text-gray-800">{{ $result['mahasiswa_data']['program_studi'] }}</span>
                                                        </div>
                                                        <div class="flex justify-between items-center py-2">
                                                            <span class="text-gray-600 flex items-center">
                                                                <i class="fas fa-info-circle mr-2 text-sm opacity-70"></i>
                                                                Status:
                                                            </span>
                                                            <span class="font-medium text-gray-800">{{ $result['mahasiswa_data']['status'] }}</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="text-center py-8">
                                                        <i class="fas fa-user-slash text-4xl text-gray-300 mb-3"></i>
                                                        <p class="text-gray-500">Data mahasiswa tidak tersedia</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Recognition Result Card -->
                                        <div class="w-full lg:w-1/2">
                                            <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200 h-full">
                                                <div class="flex items-center mb-4">
                                                    <div class="p-2 rounded-lg bg-[#0C6E71] text-white mr-3">
                                                        <i class="fas fa-fingerprint"></i>
                                                    </div>
                                                    <h3 class="text-xl font-semibold text-gray-800">Hasil Pengenalan</h3>
                                                </div>
                                                
                                                <div class="space-y-3">
                                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                        <span class="text-gray-600 flex items-center">
                                                            <i class="fas fa-percentage mr-2 text-sm opacity-70"></i>
                                                            Tingkat Kemiripan:
                                                        </span>
                                                        @php
                                                            $similarityClass = 'similarity-high';
                                                            if ($result['similarity'] < 80) {
                                                                $similarityClass = 'similarity-medium';
                                                            }
                                                            if ($result['similarity'] < 60) {
                                                                $similarityClass = 'similarity-low';
                                                            }
                                                        @endphp
                                                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $similarityClass }}">
                                                            {{ number_format($result['similarity'], 2) }}%
                                                        </span>
                                                    </div>
                                                    <div class="flex justify-between items-center py-2">
                                                        <span class="text-gray-600 flex items-center">
                                                            <i class="fas fa-check-circle mr-2 text-sm opacity-70"></i>
                                                            Status Verifikasi:
                                                        </span>
                                                        @php
                                                            $statusClass = 'status-verified';
                                                            if (strpos($result['status'], 'Tidak') !== false) {
                                                                $statusClass = 'status-rejected';
                                                            } elseif (strpos($result['status'], 'Sedang') !== false) {
                                                                $statusClass = 'status-pending';
                                                            }
                                                        @endphp
                                                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                                                            {!! $result['status'] !!}
                                                        </span>
                                                    </div>
                                                    <div class="mt-4">
                                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                            <div class="bg-[#0C6E71] h-2.5 rounded-full" 
                                                                 style="width: {{ $result['similarity'] }}%"></div>
                                                        </div>
                                                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                                                            <span>0%</span>
                                                            <span>50%</span>
                                                            <span>100%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Today's Schedule -->
                                    @if($jadwal)
                                        <div class="mb-6">
                                            <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
                                                <div class="flex items-center mb-4">
                                                    <div class="p-2 rounded-lg bg-[#0C6E71] text-white mr-3">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                    <h3 class="text-xl font-semibold text-gray-800">Jadwal Kuliah Hari Ini</h3>
                                                </div>
                                                
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                                        <div class="p-2 rounded-lg bg-gray-200 text-gray-700 mr-3">
                                                            <i class="fas fa-book"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm text-gray-500">Mata Kuliah</p>
                                                            <p class="font-medium">{{ $jadwal->matkul->name }}</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                                        <div class="p-2 rounded-lg bg-gray-200 text-gray-700 mr-3">
                                                            <i class="fas fa-chalkboard-teacher"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm text-gray-500">Dosen</p>
                                                            <p class="font-medium">{{ $jadwal->dosen->dsn_name }}</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                                        <div class="p-2 rounded-lg bg-gray-200 text-gray-700 mr-3">
                                                            <i class="fas fa-door-open"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm text-gray-500">Ruang</p>
                                                            <p class="font-medium">{{ $jadwal->ruang->name }}</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                                        <div class="p-2 rounded-lg bg-gray-200 text-gray-700 mr-3">
                                                            <i class="fas fa-clock"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm text-gray-500">Waktu</p>
                                                            <p class="font-medium">{{ $jadwal->start }} - {{ $jadwal->ended }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mt-4 flex items-center p-3 bg-gray-50 rounded-lg">
                                                    <div class="p-2 rounded-lg bg-gray-200 text-gray-700 mr-3">
                                                        <i class="fas fa-list-ol"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm text-gray-500">Pertemuan</p>
                                                        <p class="font-medium">{{ $jadwal->pert_id }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Attendance Form -->
                                        @if(isset($result['mahasiswa_data']) && $result['similarity'] >= 80)
                                            <div class="mb-6">
                                                <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
                                                    <div class="flex items-center mb-4">
                                                        <div class="p-2 rounded-lg bg-[#0C6E71] text-white mr-3">
                                                            <i class="fas fa-clipboard-check"></i>
                                                        </div>
                                                        <h3 class="text-xl font-semibold text-gray-800">Form Absensi</h3>
                                                    </div>
                                                    
                                                    <form action="{{ route('mahasiswa.home-jadkul-absen-store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="author_id" value="{{ $result['mahasiswa_data']['id'] }}">
                                                        <input type="hidden" name="jadkul_code" value="{{ $jadwal->code }}">
                                                        <input type="hidden" name="absen_date" value="{{ now()->format('Y-m-d') }}">
                                                        <input type="hidden" name="absen_time" value="{{ now()->format('H:i:s') }}">
                                                        
                                                        <div class="mb-4">
                                                            <label for="absen_type" class="block text-sm font-medium text-gray-700 mb-2">
                                                                <i class="fas fa-tasks mr-1"></i> Pilih Jenis Absen:
                                                            </label>
                                                            <select name="absen_type" id="absen_type" required 
                                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                                                <option value="H">Hadir</option>
                                                                <option value="S">Sakit</option>
                                                                <option value="I">Izin</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <button type="submit" class="w-full px-6 py-3 btn-primary text-white rounded-lg font-medium">
                                                            <i class="fas fa-check-circle mr-2"></i>Absen Sekarang
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            <div class="mb-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200 flex items-start">
                                                <div class="p-2 rounded-lg bg-yellow-100 text-yellow-700 mr-3">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-medium text-yellow-800">Perhatian</h4>
                                                    <p class="text-yellow-700 text-sm">
                                                        Absensi tidak tersedia karena pengenalan wajah tidak mencapai tingkat kemiripan yang cukup atau data mahasiswa tidak ditemukan.
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="mb-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200 flex items-start">
                                            <div class="p-2 rounded-lg bg-yellow-100 text-yellow-700 mr-3">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-yellow-800">Tidak Ada Jadwal</h4>
                                                <p class="text-yellow-700 text-sm">
                                                    Tidak ada jadwal kuliah untuk hari ini.
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="bg-gray-50 p-8 rounded-lg text-center">
                                <div class="mx-auto w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-user-times text-3xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-700 mb-2">Tidak ada hasil pengenalan wajah</h3>
                                <p class="text-gray-500">Sistem tidak dapat menemukan kecocokan wajah yang memadai.</p>
                            </div>
                        @endif
                        
                        <div class="mt-6 text-center">
                            <a href="" class="inline-flex items-center px-6 py-2 btn-secondary text-gray-700 rounded-lg font-medium">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    @else
                        <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200 flex flex-col items-center text-center">
                            <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-exclamation-circle text-2xl text-yellow-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-yellow-800 mb-2">Data Tidak Ditemukan</h3>
                            <p class="text-yellow-700 mb-4">
                                Tidak ada hasil pengenalan wajah. Silakan upload foto terlebih dahulu.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="" class="px-6 py-2 btn-primary text-white rounded-lg font-medium">
                                    <i class="fas fa-camera mr-2"></i>Upload Foto
                                </a>
                                <a href="" class="px-6 py-2 btn-secondary text-gray-700 rounded-lg font-medium">
                                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</body>
</html>