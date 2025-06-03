<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Statistik Akademik -->
        <div class="mb-4">
            <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <span class="text-[#0C6E71] text-sm text-right">
                        {{ \App\Models\Mahasiswa::count() }}<br>
                        Total Mahasiswa
                    </span>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                    </span>
                    <span class="text-[#0C6E71] text-sm text-right">
                        {{ \App\Models\Dosen::count() }}<br>
                        Total Dosen
                    </span>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                        <i class="fa-solid fa-book"></i>
                    </span>
                    <span class="text-[#0C6E71] text-sm text-right">
                        0<br>
                        Total Mata Kuliah
                    </span>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                        <i class="fa-solid fa-school"></i>
                    </span>
                    <span class="text-[#0C6E71] text-sm text-right">
                        0<br>
                        Total Kelas
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Informasi -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Grafik Nilai -->
        <div class="card bg-white rounded-lg shadow-md overflow-hidden">
            <div class="card-header bg-[#0C6E71] text-white p-4">
                <h3 class="text-lg font-semibold">Grafik Nilai Rata-rata</h3>
            </div>
            <div class="card-body p-4">
                <div class="h-64 flex items-center justify-center">
                    <p class="text-gray-500">Data grafik nilai akan ditampilkan di sini</p>
                </div>
            </div>
        </div>

        <!-- Jadwal Kuliah Hari Ini -->
        <div class="card bg-white rounded-lg shadow-md overflow-hidden">
            <div class="card-header bg-[#0C6E71] text-white p-4">
                <h3 class="text-lg font-semibold">Jadwal Kuliah Hari Ini</h3>
            </div>
            <div class="card-body p-4">
                <div class="space-y-4">
                    <p class="text-gray-500 text-center py-8">Belum ada jadwal kuliah hari ini</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Mata Kuliah Aktif -->
    <div class="card bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="card-header bg-[#0C6E71] text-white p-4">
            <h3 class="text-lg font-semibold">Mata Kuliah Aktif Semester Ini</h3>
        </div>
        <div class="card-body p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kode</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">SKS</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Dosen</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kelas</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-4 px-4 border-b border-gray-200 text-sm text-center" colspan="6">Belum ada data mata kuliah aktif</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>