<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Statistik Support -->
        <div class="mb-4">
            <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                        <i class="fa-solid fa-ticket-alt"></i>
                    </span>
                    <span class="text-[#0C6E71] text-sm text-right">
                        0<br>
                        Total Tiket
                    </span>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                        <i class="fa-solid fa-clock"></i>
                    </span>
                    <span class="text-[#0C6E71] text-sm text-right">
                        0<br>
                        Tiket Pending
                    </span>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                        <i class="fa-solid fa-check-circle"></i>
                    </span>
                    <span class="text-[#0C6E71] text-sm text-right">
                        0<br>
                        Tiket Selesai
                    </span>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <span class="text-[#0C6E71] text-sm text-right">
                        {{ \App\Models\Mahasiswa::count() }}<br>
                        Total Pengguna
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Informasi -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Grafik Tiket -->
        <div class="card bg-white rounded-lg shadow-md overflow-hidden">
            <div class="card-header bg-[#0C6E71] text-white p-4">
                <h3 class="text-lg font-semibold">Grafik Tiket Bulanan</h3>
            </div>
            <div class="card-body p-4">
                <div class="h-64 flex items-center justify-center">
                    <p class="text-gray-500">Data grafik tiket akan ditampilkan di sini</p>
                </div>
            </div>
        </div>

        <!-- Tiket Terbaru -->
        <div class="card bg-white rounded-lg shadow-md overflow-hidden">
            <div class="card-header bg-[#0C6E71] text-white p-4">
                <h3 class="text-lg font-semibold">Tiket Terbaru</h3>
            </div>
            <div class="card-body p-4">
                <div class="space-y-4">
                    <p class="text-gray-500 text-center py-8">Belum ada tiket terbaru</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Tiket Pending -->
    <div class="card bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="card-header bg-[#0C6E71] text-white p-4">
            <h3 class="text-lg font-semibold">Tiket Pending</h3>
        </div>
        <div class="card-body p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID Tiket</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Subjek</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pengguna</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Prioritas</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-4 px-4 border-b border-gray-200 text-sm text-center" colspan="6">Belum ada tiket pending</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>