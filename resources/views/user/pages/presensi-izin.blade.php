@extends('base.base-dash-index')
@section('title')
    Absensi Izin, Sakit dan Cuti - Siakad By Internal Developer
@endsection
@section('menu')
    Absensi Izin, Sakit dan Cuti
@endsection
@section('submenu')
    Lihat
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat data absensi harian
@endsection
@section('custom-css')
    <style>
        @media (max-width: 768px) {
            .mobile-card {
                @apply flex-col justify-center items-center;
            }

            .mobile-icon {
                @apply my-2.5;
            }

            .mobile-text {
                @apply ml-0 mt-2.5 mb-2.5;
            }
        }
    </style>
@endsection
@section('content')
    <section class="py-4">
        <div class="w-full">
            <div class="w-full">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Card Hadir -->
                    <a href="{{ route($prefix . 'presensi.absen-harian') }}" class="group transform transition-all duration-300 hover:-translate-y-1">
                        <div class="bg-gradient-to-br from-[#0C6E71] to-[#0a5c5f] rounded-xl shadow-lg overflow-hidden">
                            <div class="p-6 flex items-center space-x-4">
                                <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                    <i class="fa-solid fa-user-check text-2xl text-white"></i>
                                </div>
                                <div>
                                    <p class="text-white text-opacity-80 text-sm">Hadir</p>
                                    <p class="text-white text-2xl font-bold">{{ $hadir->count() }}</p>
                                </div>
                            </div>
                            <div class="px-6 py-2 bg-black bg-opacity-10 text-white text-xs">
                                <i class="fas fa-arrow-right mr-1 transform group-hover:translate-x-1 transition-transform"></i> Lihat detail
                            </div>
                        </div>
                    </a>

                    <!-- Card Izin & Cuti -->
                    <a href="{{ route($prefix . 'presensi.absen-harian') }}" class="group transform transition-all duration-300 hover:-translate-y-1">
                        <div class="bg-gradient-to-br from-[#FF6B35] to-[#e05a2b] rounded-xl shadow-lg overflow-hidden">
                            <div class="p-6 flex items-center space-x-4">
                                <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                    <i class="fa-solid fa-file-signature text-2xl text-white"></i>
                                </div>
                                <div>
                                    <p class="text-white text-opacity-80 text-sm">Izin & Cuti</p>
                                    <p class="text-white text-2xl font-bold">{{ $izin->count() }}</p>
                                </div>
                            </div>
                            <div class="px-6 py-2 bg-black bg-opacity-10 text-white text-xs">
                                <i class="fas fa-arrow-right mr-1 transform group-hover:translate-x-1 transition-transform"></i> Lihat detail
                            </div>
                        </div>
                    </a>

                    <!-- Card Terlambat -->
                    <a href="{{ route($prefix . 'presensi.absen-harian') }}" class="group transform transition-all duration-300 hover:-translate-y-1">
                        <div class="bg-gradient-to-br from-[#FFC107] to-[#e0a800] rounded-xl shadow-lg overflow-hidden">
                            <div class="p-6 flex items-center space-x-4">
                                <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                    <i class="fa-solid fa-clock text-2xl text-white"></i>
                                </div>
                                <div>
                                    <p class="text-white text-opacity-80 text-sm">Terlambat</p>
                                    <p class="text-white text-2xl font-bold">{{ $terlambat->count() }}</p>
                                </div>
                            </div>
                            <div class="px-6 py-2 bg-black bg-opacity-10 text-white text-xs">
                                <i class="fas fa-arrow-right mr-1 transform group-hover:translate-x-1 transition-transform"></i> Lihat detail
                            </div>
                        </div>
                    </a>

                    <!-- Card Total Absensi -->
                    <div class="group transform transition-all duration-300 hover:-translate-y-1">
                        <div class="bg-gradient-to-br from-[#6c757d] to-[#5a6268] rounded-xl shadow-lg overflow-hidden">
                            <div class="p-6 flex items-center space-x-4">
                                <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                    <i class="fa-solid fa-chart-pie text-2xl text-white"></i>
                                </div>
                                <div>
                                    <p class="text-white text-opacity-80 text-sm">Total Absensi</p>
                                    <p class="text-white text-2xl font-bold">
                                        {{ $hadir->count() + $izin->count() + $terlambat->count() }}
                                    </p>
                                </div>
                            </div>
                            <div class="px-6 py-2 bg-black bg-opacity-10 text-white text-xs">
                                <i class="fas fa-chart-line mr-1"></i> Statistik lengkap
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6">
                <div class="bg-white rounded-lg shadow-sm mb-6">
                    <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
                        <h4 class="text-lg font-semibold text-gray-800">Absensi Harian</h4>
                    </div>
                    <div class="p-6">
                        <form action="{{ route($prefix . 'home-presensi-input-izin') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="hidden">
                                    <label for="absen_user_id" class="block text-sm font-medium text-gray-700 mb-1">ID User</label>
                                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                           name="absen_user_id" id="absen_user_id" value="{{ Auth::user()->id }}">
                                </div>

                                <div>
                                    <label for="absen_user_name" class="block text-sm font-medium text-gray-700 mb-1">ID User</label>
                                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                           name="absen_user_name" id="absen_user_name" value="{{ Auth::user()->name }}" disabled>
                                </div>

                                <div>
                                    <label for="absen_type" class="block text-sm font-medium text-gray-700 mb-1">Pilih Jenis Absen</label>
                                    <select name="absen_type" id="absen_type" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]">
                                        <option value="" selected>Pilih Jenis Izin</option>
                                        <optgroup label="Bisa diajukan pada hari H">
                                            <option value="2">Absen Sakit</option>
                                            <option value="3">Keperluan Berobat</option>
                                            <option value="4">Izin Masuk Telat</option>
                                            <option value="5">Izin Pulang Lebih Awal</option>
                                        </optgroup>
                                        <optgroup label="Diajukan minimal H-1">
                                            <option value="6">Keperluan Pribadi</option>
                                            <option value="7">Cuti Tahunan</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div>
                                    <label for="absen_date" class="block text-sm font-medium text-gray-700 mb-1">Pilih Tanggal</label>
                                    <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                           name="absen_date" id="absen_date" placeholder="Pilih Tanggal...">
                                    @error('absen_date')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="absen_proof" class="block text-sm font-medium text-gray-700 mb-2">Bukti Kehadiran</label>
                                    <div class="mt-1 flex items-center">
                                        <label for="absen_proof" class="cursor-pointer">
                                            <div class="relative border-2 border-dashed border-gray-300 rounded-lg px-6 py-8 text-center hover:border-[#0C6E71] transition-colors duration-200">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <span class="mt-2 block text-sm font-medium text-gray-700">
                                                        Bukti Sakit, Izin dan Sakit
                                                    </span>
                                                    <span class="mt-1 block text-xs text-gray-500">
                                                        PNG, JPG, PDF (max. 5MB)
                                                    </span>
                                                </div>
                                                <input type="file" name="absen_proof" id="absen_proof" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".png,.jpg,.jpeg,.pdf">
                                            </div>
                                        </label>
                                    </div>
                                    <div id="file-name" class="mt-1 text-sm text-gray-600"></div>
                                    @error('absen_proof')
                                        <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="absen_desc" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Absen</label>
                                    <textarea name="absen_desc" id="dark" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                              cols="10" rows="5" placeholder="Keterangan tambahan"></textarea>
                                    @error('absen_desc')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="lg:col-span-2 flex justify-end">
                                    <button type="submit" class="px-4 py-2 bg-[#0C6E71] text-white rounded-md hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:ring-opacity-50 transition-colors">
                                        <i class="fa-solid fa-paper-plane mr-1.5"></i> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm mb-6">
                    <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
                        <h4 class="text-lg font-semibold text-gray-800">Data Riwayat Absen</h4>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="table1">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Fullname</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Masuk</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Keluar</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi Kerja</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($absen as $key => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ ++$key }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ $item->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ $item->absen_date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ $item->absen_time_in }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            {{ $item->absen_time_out == null ? '-' : $item->absen_time_out }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ $item->getDurasiKerja() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ $item->absen_type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center">
                                                @if ($item->raw_absen_approve == 0)
                                                    @if ($item->absen_time_out == null)
                                                        <a href="{{ route($prefix . 'presensi.absen-harian-view', $item->absen_code) }}"
                                                           class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm transition-colors">
                                                           Absen Keluar
                                                        </a>
                                                    @elseif ($item->absen_time_out)
                                                        <a href="{{ route($prefix . 'presensi.absen-harian-view', $item->absen_code) }}"
                                                           class="bg-[#0C6E71] hover:bg-opacity-90 text-white px-4 py-2 rounded-md text-sm transition-colors">
                                                           Lihat Absen
                                                        </a>
                                                    @endif
                                                @elseif ($item->raw_absen_approve == 1)
                                                    <span class="bg-yellow-500 text-white px-4 py-2 rounded-md text-sm">Pending</span>
                                                @elseif ($item->raw_absen_approve == 2)
                                                    <span class="bg-[#0C6E71] text-white px-4 py-2 rounded-md text-sm">Approved</span>
                                                @elseif ($item->raw_absen_approve == 3)
                                                    <span class="bg-red-500 text-white px-4 py-2 rounded-md text-sm">Rejected</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card Hadir -->
                <a href="{{ route($prefix . 'presensi.absen-harian') }}" class="group transform transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-[#0C6E71] to-[#0a5c5f] rounded-xl shadow-lg overflow-hidden">
                        <div class="p-6 flex items-center space-x-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                <i class="fa-solid fa-user-check text-2xl text-white"></i>
                            </div>
                            <div>
                                <p class="text-white text-opacity-80 text-sm">Hadir</p>
                                <p class="text-white text-2xl font-bold">{{ $hadir->count() }}</p>
                            </div>
                        </div>
                        <div class="px-6 py-2 bg-black bg-opacity-10 text-white text-xs">
                            <i class="fas fa-arrow-right mr-1 transform group-hover:translate-x-1 transition-transform"></i> Lihat detail
                        </div>
                    </div>
                </a>

                <!-- Card Izin & Cuti -->
                <a href="{{ route($prefix . 'presensi.absen-harian') }}" class="group transform transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-[#FF6B35] to-[#e05a2b] rounded-xl shadow-lg overflow-hidden">
                        <div class="p-6 flex items-center space-x-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                <i class="fa-solid fa-file-signature text-2xl text-white"></i>
                            </div>
                            <div>
                                <p class="text-white text-opacity-80 text-sm">Izin & Cuti</p>
                                <p class="text-white text-2xl font-bold">{{ $izin->count() }}</p>
                            </div>
                        </div>
                        <div class="px-6 py-2 bg-black bg-opacity-10 text-white text-xs">
                            <i class="fas fa-arrow-right mr-1 transform group-hover:translate-x-1 transition-transform"></i> Lihat detail
                        </div>
                    </div>
                </a>

                <!-- Card Terlambat -->
                <a href="{{ route($prefix . 'presensi.absen-harian') }}" class="group transform transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-[#FFC107] to-[#e0a800] rounded-xl shadow-lg overflow-hidden">
                        <div class="p-6 flex items-center space-x-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                <i class="fa-solid fa-clock text-2xl text-white"></i>
                            </div>
                            <div>
                                <p class="text-white text-opacity-80 text-sm">Terlambat</p>
                                <p class="text-white text-2xl font-bold">{{ $terlambat->count() }}</p>
                            </div>
                        </div>
                        <div class="px-6 py-2 bg-black bg-opacity-10 text-white text-xs">
                            <i class="fas fa-arrow-right mr-1 transform group-hover:translate-x-1 transition-transform"></i> Lihat detail
                        </div>
                    </div>
                </a>

                <!-- Card Total Absensi -->
                <div class="group transform transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-[#6c757d] to-[#5a6268] rounded-xl shadow-lg overflow-hidden">
                        <div class="p-6 flex items-center space-x-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                <i class="fa-solid fa-chart-pie text-2xl text-white"></i>
                            </div>
                            <div>
                                <p class="text-white text-opacity-80 text-sm">Total Absensi</p>
                                <p class="text-white text-2xl font-bold">
                                    {{ $hadir->count() + $izin->count() + $terlambat->count() }}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 py-2 bg-black bg-opacity-10 text-white text-xs">
                            <i class="fas fa-chart-line mr-1"></i> Statistik lengkap
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal untuk melihat detail absen -->
    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Detail Absensi</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <div class="p-6" id="modalContent">
                <!-- Konten modal akan diisi melalui JavaScript -->
            </div>
            <div class="border-t border-gray-200 px-6 py-4 flex justify-end">
                <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors" onclick="closeModal()">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi DataTable jika sudah ada sebelumnya
        if (typeof $.fn.DataTable !== 'undefined') {
            $('#table1').DataTable({
                responsive: true
            });
        }

        // Tambahkan event listener untuk tombol "Lihat Absen"
        const viewButtons = document.querySelectorAll('a.bg-\\[\\#0C6E71\\]');
        viewButtons.forEach(button => {
            if (button.textContent.trim() === 'Lihat Absen') {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('href');

                    // Simulasi mengambil data dan memunculkan modal
                    // Dalam implementasi nyata, Anda bisa menggunakan fetch untuk mengambil data
                    fetch(url)
                        .then(response => response.json())
                        .catch(error => {
                            // Jika fetch error, gunakan data placeholder untuk demo
                            return {
                                code: this.closest('tr').querySelector('td:nth-child(1)').textContent,
                                name: this.closest('tr').querySelector('td:nth-child(2)').textContent,
                                date: this.closest('tr').querySelector('td:nth-child(3)').textContent,
                                time_in: this.closest('tr').querySelector('td:nth-child(4)').textContent,
                                time_out: this.closest('tr').querySelector('td:nth-child(5)').textContent,
                                duration: this.closest('tr').querySelector('td:nth-child(6)').textContent,
                                status: this.closest('tr').querySelector('td:nth-child(7)').textContent
                            };
                        })
                        .then(data => {
                            document.getElementById('modalContent').innerHTML = `
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Nama</p>
                                        <p class="text-base">${data.name || this.closest('tr').querySelector('td:nth-child(2)').textContent}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Tanggal</p>
                                        <p class="text-base">${data.date || this.closest('tr').querySelector('td:nth-child(3)').textContent}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Jam Masuk</p>
                                        <p class="text-base">${data.time_in || this.closest('tr').querySelector('td:nth-child(4)').textContent}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Jam Keluar</p>
                                        <p class="text-base">${data.time_out || this.closest('tr').querySelector('td:nth-child(5)').textContent}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Durasi Kerja</p>
                                        <p class="text-base">${data.duration || this.closest('tr').querySelector('td:nth-child(6)').textContent}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Status</p>
                                        <p class="text-base">${data.status || this.closest('tr').querySelector('td:nth-child(7)').textContent}</p>
                                    </div>
                                </div>
                            `;
                            openModal();
                        });
                });
            }
        });
    });

    document.getElementById('absen_proof').addEventListener('change', function(e) {
            const fileName = document.getElementById('file-name');
            if (this.files.length > 0) {
                fileName.textContent = 'File terpilih: ' + this.files[0].name;
            } else {
                fileName.textContent = '';
            }
        });

    function openModal() {
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>
@endsection
