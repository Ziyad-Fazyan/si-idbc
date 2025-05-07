@extends('base.base-dash-index')
@section('title')
    Jadwal Mengajar - Siakad By Internal Developer
@endsection
@section('menu')
    Jadwal Mengajar
@endsection
@section('submenu')
    Lihat Data
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat Jadwal Mengajar
@endsection
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Sekolah</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #0C6E71;
            --cta: #FF6B35;
            --bg-light: #F3EFEA;
            --text-main: #2E2E2E;
            --neutral-1: #E4E2DE;
            --neutral-2: #3B3B3B;
        }
        body {
            background-color: var(--bg-light);
            color: var(--text-main);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        .bg-primary { background-color: var(--primary); }
        .bg-cta { background-color: var(--cta); }
        .text-primary { color: var(--primary); }
        .text-cta { color: var(--cta); }
        .border-primary { border-color: var(--primary); }
        .border-cta { border-color: var(--cta); }
        .hover\:bg-primary-dark:hover { background-color: #095759; }
        .hover\:bg-cta-dark:hover { background-color: #E55A29; }
        .btn-primary {
            @apply bg-primary text-white px-4 py-2 rounded-md transition duration-200 hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary;
        }
        .btn-cta {
            @apply bg-cta text-white px-4 py-2 rounded-md transition duration-200 hover:bg-cta-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cta;
        }
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
            .responsive-table {
                min-width: 800px;
            }
            .responsive-card {
                @apply rounded-lg shadow-md mb-4 border-l-4 border-primary bg-white p-4;
            }
            .responsive-card p {
                @apply flex justify-between border-b border-neutral-1 py-2;
            }
            .responsive-card p:last-of-type {
                @apply border-b-0;
            }
            .responsive-card strong {
                @apply text-primary;
            }
        }
        .sidebar-item.active {
            @apply bg-white text-primary border-l-4 border-cta;
        }
        .pagination-item.active {
            @apply bg-primary text-white;
        }
    </style>
</head>
<body>
    <div class="flex flex-col min-h-screen">
        <!-- Mobile Menu Toggle -->
        <div class="lg:hidden bg-primary text-white p-4 flex justify-between items-center sticky top-0 z-50">
            <div class="flex items-center">
                <button id="sidebarToggle" class="mr-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <span class="text-lg font-semibold">SIAKAD</span>
            </div>
            <div class="flex items-center">
                <button class="mr-2">
                    <i class="fas fa-bell text-white"></i>
                </button>
                <button>
                    <i class="fas fa-user-circle text-xl"></i>
                </button>
            </div>
        </div>
        
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside id="sidebar" class="bg-primary w-64 flex-shrink-0 hidden lg:block fixed h-full left-0 z-40 transition-all duration-300 ease-in-out">
                <div class="flex items-center justify-center h-16 bg-primary shadow-md">
                    <span class="text-xl font-bold text-white">SIAKAD</span>
                </div>
                <div class="px-2 py-4">
                    <div class="flex items-center px-4 py-2 mb-6">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mr-3">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div>
                            <h3 class="text-white text-sm font-semibold">Dr. Ahmad Wijaya</h3>
                            <p class="text-neutral-1 text-xs">Dosen</p>
                        </div>
                    </div>
                    
                    <nav>
                        <a href="#" class="sidebar-item active flex items-center px-4 py-3 mb-1 transition duration-200 hover:bg-white hover:text-primary rounded-md">
                            <i class="fas fa-home mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 mb-1 text-neutral-1 transition duration-200 hover:bg-white hover:text-primary rounded-md">
                            <i class="fas fa-calendar-alt mr-3"></i>
                            <span>Jadwal Perkuliahan</span>
                        </a>
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 mb-1 text-neutral-1 transition duration-200 hover:bg-white hover:text-primary rounded-md">
                            <i class="fas fa-calendar-check mr-3"></i>
                            <span>Presensi</span>
                        </a>
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 mb-1 text-neutral-1 transition duration-200 hover:bg-white hover:text-primary rounded-md">
                            <i class="fas fa-book mr-3"></i>
                            <span>Mata Kuliah</span>
                        </a>
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 mb-1 text-neutral-1 transition duration-200 hover:bg-white hover:text-primary rounded-md">
                            <i class="fas fa-star mr-3"></i>
                            <span>Feedback</span>
                        </a>
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 mb-1 text-neutral-1 transition duration-200 hover:bg-white hover:text-primary rounded-md">
                            <i class="fas fa-chart-bar mr-3"></i>
                            <span>Laporan</span>
                        </a>
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 mb-1 text-neutral-1 transition duration-200 hover:bg-white hover:text-primary rounded-md">
                            <i class="fas fa-cog mr-3"></i>
                            <span>Pengaturan</span>
                        </a>
                    </nav>
                </div>
                <div class="absolute bottom-0 w-full p-4">
                    <a href="#" class="flex items-center px-4 py-3 text-neutral-1 hover:text-white transition duration-200">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Keluar</span>
                    </a>
                </div>
            </aside>
            
            <!-- Main Content -->
            <main class="flex-1 lg:ml-64 transition-all duration-300 ease-in-out">
                <!-- Header Desktop -->
                <header class="hidden lg:flex justify-between items-center bg-white shadow-sm px-6 py-4 sticky top-0 z-30">
                    <h1 class="text-xl font-semibold text-primary">Jadwal Perkuliahan</h1>
                    <div class="flex items-center">
                        <div class="relative mr-4">
                            <button class="relative">
                                <i class="fas fa-bell text-neutral-2"></i>
                                <span class="absolute -top-1 -right-1 bg-cta text-white rounded-full w-4 h-4 flex items-center justify-center text-xs">3</span>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <img src="/api/placeholder/36/36" class="w-9 h-9 rounded-full mr-2" alt="Profile">
                            <span class="text-sm font-medium mr-1">Dr. Ahmad Wijaya</span>
                            <i class="fas fa-chevron-down text-xs text-neutral-2"></i>
                        </div>
                    </div>
                </header>
                
                <!-- Content -->
                <div class="p-4 lg:p-6">
                    <!-- Breadcrumb -->
                    <div class="flex items-center text-sm mb-6">
                        <a href="#" class="text-neutral-2 hover:text-primary">Dashboard</a>
                        <i class="fas fa-chevron-right text-xs mx-2 text-neutral-2"></i>
                        <span class="text-primary font-medium">Jadwal Perkuliahan</span>
                    </div>
                    
                    <!-- Page Title and Actions -->
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
                        <div class="mb-4 md:mb-0">
                            <h2 class="text-2xl font-bold text-primary">Jadwal Perkuliahan</h2>
                            <p class="text-neutral-2 text-sm">Semester Genap 2024/2025</p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-neutral-2"></i>
                                <input type="text" placeholder="Cari jadwal..." class="pl-10 pr-4 py-2 border border-neutral-1 rounded-md focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <button class="btn-primary">
                                    <i class="fas fa-filter mr-1"></i> Filter
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filter Tags -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-white px-3 py-1 rounded-full text-sm flex items-center">
                            Semua <i class="fas fa-times ml-2 text-xs cursor-pointer text-neutral-2 hover:text-primary"></i>
                        </span>
                        <span class="bg-white px-3 py-1 rounded-full text-sm flex items-center">
                            Minggu Ini <i class="fas fa-times ml-2 text-xs cursor-pointer text-neutral-2 hover:text-primary"></i>
                        </span>
                    </div>
                    
                    <!-- Desktop Table -->
                    <div class="bg-white rounded-lg shadow-sm mb-6 hidden md:block">
                        <div class="px-6 py-4 border-b border-neutral-1">
                            <h3 class="font-semibold text-primary">Daftar Jadwal Perkuliahan</h3>
                        </div>
                        <div class="p-6 table-responsive">
                            <table class="w-full responsive-table">
                                <thead>
                                    <tr class="bg-neutral-1 text-primary">
                                        <th class="px-4 py-3 text-left text-sm font-medium rounded-l-md">#</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium">Nama Kelas</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium">Nama Mata Kuliah</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium">Dosen Pengajar</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium">Metode</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium">Lokasi</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium">Tanggal</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium">Waktu</th>
                                        <th class="px-4 py-3 text-center text-sm font-medium rounded-r-md">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Row 1 -->
                                    <tr class="border-b border-neutral-1 hover:bg-neutral-1/10">
                                        <td class="px-4 py-4 text-sm">1</td>
                                        <td class="px-4 py-4 text-sm font-medium">TI-3A</td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm font-medium">Database Management</span>
                                            <p class="text-xs text-neutral-2 mt-1">Pertemuan 5 - 3 SKS</p>
                                        </td>
                                        <td class="px-4 py-4 text-sm">Dr. Ahmad Wijaya</td>
                                        <td class="px-4 py-4 text-sm">
                                            <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-full text-xs">Hybrid</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm">Gedung A</span>
                                            <p class="text-xs text-neutral-2">Ruang 303 - Lantai 3</p>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm">Senin</span>
                                            <p class="text-xs text-neutral-2">13 Mei 2025</p>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm">08:00</span>
                                            <p class="text-xs text-neutral-2">-</p>
                                            <span class="text-sm">10:30</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-center space-x-2">
                                                <a href="#" class="p-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                                                    <i class="fas fa-calendar-check"></i>
                                                </a>
                                                <a href="#" class="p-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                                                    <i class="fas fa-star"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Row 2 -->
                                    <tr class="border-b border-neutral-1 hover:bg-neutral-1/10">
                                        <td class="px-4 py-4 text-sm">2</td>
                                        <td class="px-4 py-4 text-sm font-medium">SI-4B</td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm font-medium">Web Development</span>
                                            <p class="text-xs text-neutral-2 mt-1">Pertemuan 6 - 4 SKS</p>
                                        </td>
                                        <td class="px-4 py-4 text-sm">Dr. Ahmad Wijaya</td>
                                        <td class="px-4 py-4 text-sm">
                                            <span class="px-2 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs">Online</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm">Virtual</span>
                                            <p class="text-xs text-neutral-2">Room 2</p>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm">Selasa</span>
                                            <p class="text-xs text-neutral-2">14 Mei 2025</p>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm">13:00</span>
                                            <p class="text-xs text-neutral-2">-</p>
                                            <span class="text-sm">16:30</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-center space-x-2">
                                                <a href="#" class="p-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                                                    <i class="fas fa-calendar-check"></i>
                                                </a>
                                                <a href="#" class="p-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                                                    <i class="fas fa-star"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Row 3 -->
                                    <tr class="hover:bg-neutral-1/10">
                                        <td class="px-4 py-4 text-sm">3</td>
                                        <td class="px-4 py-4 text-sm font-medium">TI-2C</td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm font-medium">Data Structures</span>
                                            <p class="text-xs text-neutral-2 mt-1">Pertemuan 4 - 3 SKS</p>
                                        </td>
                                        <td class="px-4 py-4 text-sm">Dr. Ahmad Wijaya</td>
                                        <td class="px-4 py-4 text-sm">
                                            <span class="px-2 py-1 bg-green-50 text-green-600 rounded-full text-xs">Offline</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm">Gedung B</span>
                                            <p class="text-xs text-neutral-2">Ruang 205 - Lantai 2</p>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm">Rabu</span>
                                            <p class="text-xs text-neutral-2">15 Mei 2025</p>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm">09:30</span>
                                            <p class="text-xs text-neutral-2">-</p>
                                            <span class="text-sm">12:00</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-center space-x-2">
                                                <a href="#" class="p-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                                                    <i class="fas fa-calendar-check"></i>
                                                </a>
                                                <a href="#" class="p-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                                                    <i class="fas fa-star"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="px-6 py-4 border-t border-neutral-1 flex justify-between items-center">
                            <p class="text-sm text-neutral-2">Menampilkan 1-3 dari 10 jadwal</p>
                            <div class="flex">
                                <a href="#" class="px-3 py-1 border border-neutral-1 rounded-l-md hover:bg-neutral-1 transition">
                                    <i class="fas fa-chevron-left text-xs"></i>
                                </a>
                                <a href="#" class="px-3 py-1 border-t border-b border-neutral-1 pagination-item active">1</a>
                                <a href="#" class="px-3 py-1 border-t border-b border-neutral-1 hover:bg-neutral-1 transition">2</a>
                                <a href="#" class="px-3 py-1 border-t border-b border-neutral-1 hover:bg-neutral-1 transition">3</a>
                                <a href="#" class="px-3 py-1 border border-neutral-1 rounded-r-md hover:bg-neutral-1 transition">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Cards -->
                    <div class="md:hidden">
                        <!-- Card 1 -->
                        <div class="responsive-card">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="font-medium">Database Management</h4>
                                    <p class="text-xs text-neutral-2">Pertemuan 5 - 3 SKS</p>
                                </div>
                                <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-full text-xs">Hybrid</span>
                            </div>
                            
                            <p><strong>Kelas:</strong> <span>TI-3A</span></p>
                            <p><strong>Dosen:</strong> <span>Dr. Ahmad Wijaya</span></p>
                            <p><strong>Lokasi:</strong> <span>Gedung A, Ruang 303 - Lantai 3</span></p>
                            <p><strong>Tanggal:</strong> <span>Senin, 13 Mei 2025</span></p>
                            <p><strong>Waktu:</strong> <span>08:00 - 10:30</span></p>
                            
                            <div class="flex justify-end mt-4 space-x-2">
                                <a href="#" class="p-2 bg-green-500 text-white rounded-md">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                                <a href="#" class="p-2 bg-yellow-500 text-white rounded-md">
                                    <i class="fas fa-star"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card 2 -->
                        <div class="responsive-card">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="font-medium">Web Development</h4>
                                    <p class="text-xs text-neutral-2">Pertemuan 6 - 4 SKS</p>
                                </div>
                                <span class="px-2 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs">Online</span>
                            </div>
                            
                            <p><strong>Kelas:</strong> <span>SI-4B</span></p>
                            <p><strong>Dosen:</strong> <span>Dr. Ahmad Wijaya</span></p>
                            <p><strong>Lokasi:</strong> <span>Virtual, Room 2</span></p>
                            <p><strong>Tanggal:</strong> <span>Selasa, 14 Mei 2025</span></p>
                            <p><strong>Waktu:</strong> <span>13:00 - 16:30</span></p>
                            
                            <div class="flex justify-end mt-4 space-x-2">
                                <a href="#" class="p-2 bg-green-500 text-white rounded-md">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                                <a href="#" class="p-2 bg-yellow-500 text-white rounded-md">
                                    <i class="fas fa-star"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card 3 -->
                        <div class="responsive-card">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="font-medium">Data Structures</h4>
                                    <p class="text-xs text-neutral-2">Pertemuan 4 - 3 SKS</p>
                                </div>
                                <span class="px-2 py-1 bg-green-50 text-green-600 rounded-full text-xs">Offline</span>
                            </div>
                            
                            <p><strong>Kelas:</strong> <span>TI-2C</span></p>
                            <p><strong>Dosen:</strong> <span>Dr. Ahmad Wijaya</span></p>
                            <p><strong>Lokasi:</strong> <span>Gedung B, Ruang 205 - Lantai 2</span></p>
                            <p><strong>Tanggal:</strong> <span>Rabu, 15 Mei 2025</span></p>
                            <p><strong>Waktu:</strong> <span>09:30 - 12:00</span></p>
                            
                            <div class="flex justify-end mt-4 space-x-2">
                                <a href="#" class="p-2 bg-green-500 text-white rounded-md">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                                <a href="#" class="p-2 bg-yellow-500 text-white rounded-md">
                                    <i class="fas fa-star"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Pagination -->
                        <div class="flex justify-between items-center my-6">
                            <p class="text-xs text-neutral-2">1-3 dari 10</p>
                            <div class="flex">
                                <a href="#" class="px-3 py-1 border border-neutral-1 rounded-l-md hover:bg-neutral-1 transition">
                                    <i class="fas fa-chevron-left text-xs"></i>
                                </a>
                                <a href="#" class="px-3 py-1 border-t border-b border-neutral-1 pagination-item active">1</a>
                                <a href="#" class="px-3 py-1 border-t border-b border-neutral-1 hover:bg-neutral-1 transition">2</a>
                                <a href="#" class="px-3 py-1 border border-neutral-1 rounded-r-md hover:bg-neutral-1 transition">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <footer class="bg-white mt-auto p-4 text-center text-sm text-neutral-2 border-t border-neutral-1">
                    <p>&copy; 2025 Sistem Informasi Akademik. Hak cipta dilindungi.</p>
                </footer>
            </main>
        </div>
    </div>
    
    <script>
        // Sidebar Toggle for Mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const main = document.querySelector('main');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('fixed');
                sidebar.classList.toggle('z-50');
                
                if (!sidebar.classList.contains('hidden')) {
                    // Add overlay when sidebar is visible on mobile
                    const overlay = document.createElement('div');
                    overlay.id = 'sidebarOverlay';
                    overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden';
                    document.body.appendChild(overlay);
                    
                    overlay.addEventListener('click', function() {
                        sidebar.classList.add('hidden');
                        overlay.remove();
                    });
                } else {
                    // Remove overlay when sidebar is hidden
                    const overlay = document.getElementById('sidebarOverlay');
                    if (overlay) {
                        overlay.remove();
                    }
                }
            });
            
            // Hide sidebar when window resizes to desktop view
            window.addEventListener('resize', function() {
                if (window.innerWidth >=