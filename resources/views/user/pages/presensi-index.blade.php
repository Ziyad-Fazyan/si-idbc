@extends('base.base-dash-index')
@section('title')
    Absensi Harian - Siakad By Internal Developer
@endsection
@section('menu')
    Absensi Harian
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
            .card-body-flex {
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .icon {
                margin: 10px 0;
            }

            .text-putih {
                margin-left: 0 !important;
                margin-top: 10px;
                margin-bottom: 10px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="p-4">
        <div class="flex flex-col space-y-4">
            <div class="w-full">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Card Hadir -->
                    <a href="{{ route($prefix . 'presensi.absen-harian') }}"
                        class="group transform transition-all duration-300 hover:-translate-y-1">
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
                                <i
                                    class="fas fa-arrow-right mr-1 transform group-hover:translate-x-1 transition-transform"></i>
                                Lihat detail
                            </div>
                        </div>
                    </a>

                    <!-- Card Izin & Cuti -->
                    <a href="{{ route($prefix . 'presensi.absen-harian') }}"
                        class="group transform transition-all duration-300 hover:-translate-y-1">
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
                                <i
                                    class="fas fa-arrow-right mr-1 transform group-hover:translate-x-1 transition-transform"></i>
                                Lihat detail
                            </div>
                        </div>
                    </a>

                    <!-- Card Terlambat -->
                    <a href="{{ route($prefix . 'presensi.absen-harian') }}"
                        class="group transform transition-all duration-300 hover:-translate-y-1">
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
                                <i
                                    class="fas fa-arrow-right mr-1 transform group-hover:translate-x-1 transition-transform"></i>
                                Lihat detail
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

            <div class="w-full">
                <div class="bg-white rounded-lg shadow-md mb-4">
                    <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-gray-800">Absensi Harian</h4>
                    </div>
                    <div class="p-4">
                        <form action="{{ route($prefix . 'home-presensi-input-absen') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="hidden">
                                    <label for="absen_user_id" class="block text-sm font-medium text-gray-700 mb-1">ID
                                        User</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        name="absen_user_id" id="absen_user_id" value="{{ Auth::user()->id }}">
                                </div>
                                <div>
                                    <label for="absen_user_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        User</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        name="absen_user_name" id="absen_user_name" value="{{ Auth::user()->name }}"
                                        readonly>
                                </div>
                                <div>
                                    <label for="absen_type" class="block text-sm font-medium text-gray-700 mb-1">Pilih Jenis
                                        Absen</label>
                                    <select name="absen_type" id="absen_type"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                        <optgroup label="Absen Harian">
                                            <option value="" selected>Pilih Jenis Absen</option>
                                            <option value="0">Absen Regular ( 08.00 - 16.00 )</option>
                                            <option value="1">Absen Lembur ( 16.00 - 21.00 )</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div>
                                    <label for="absen_date" class="block text-sm font-medium text-gray-700 mb-1">Pilih
                                        Tanggal</label>
                                    <input type="date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        name="absen_date" id="absen_date"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('absen_date')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="absen_time_in" class="block text-sm font-medium text-gray-700 mb-1">Jam
                                        Masuk</label>
                                    <input type="time"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        name="absen_time_in" id="absen_time_in"
                                        value="{{ \Carbon\Carbon::now()->format('H:i:s') }}">
                                    @error('absen_time_in')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="absen_time_out" class="block text-sm font-medium text-gray-700 mb-1">Jam
                                        Keluar</label>
                                    <input type="time"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        name="absen_time_out" id="absen_time_out" placeholder="Jam Pulang">
                                    @error('absen_time_out')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="absen_proof" class="block text-sm font-medium text-gray-700 mb-2">Bukti
                                        Kehadiran</label>
                                    <div class="mt-1 flex items-center">
                                        <label for="absen_proof" class="cursor-pointer">
                                            <div
                                                class="relative border-2 border-dashed border-gray-300 rounded-lg px-6 py-8 text-center hover:border-[#0C6E71] transition-colors duration-200">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                        fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                        <path
                                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    <span class="mt-2 block text-sm font-medium text-gray-700">
                                                        Upload bukti kehadiran
                                                    </span>
                                                    <span class="mt-1 block text-xs text-gray-500">
                                                        PNG, JPG, PDF (max. 5MB)
                                                    </span>
                                                </div>
                                                <input type="file" name="absen_proof" id="absen_proof"
                                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                                    accept=".png,.jpg,.jpeg,.pdf">
                                            </div>
                                        </label>
                                    </div>
                                    <div id="file-name" class="mt-1 text-sm text-gray-600"></div>
                                    @error('absen_proof')
                                        <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex justify-end items-center md:col-span-2">
                                    <button type="submit"
                                        class="bg-[#0C6E71] hover:bg-[#0a5c5f] text-white px-4 py-2 rounded-md transition-colors duration-200 flex items-center">
                                        <i class="fa-solid fa-paper-plane mr-2"></i> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-gray-800">Data Riwayat Absen</h4>
                    </div>
                    <div class="p-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        #</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fullname</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Masuk</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Keluar</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Durasi Kerja</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Button</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($absen as $key => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            {{ ++$key }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            {{ $item->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            {{ $item->absen_date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            {{ $item->absen_time_in }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            {{ $item->absen_time_out == null ? '-' : $item->absen_time_out }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            {{ $item->getDurasiKerja() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            {{ $item->absen_type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            <div class="flex justify-center space-x-2">
                                                @if ($item->raw_absen_approve == 0)
                                                    @if ($item->absen_time_out == null)
                                                        <a href="{{ route($prefix . 'presensi.absen-harian-view', $item->absen_code) }}"
                                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm transition-colors duration-200">
                                                            Absen Keluar
                                                        </a>
                                                    @elseif ($item->absen_time_out)
                                                        <a href="{{ route($prefix . 'presensi.absen-harian-view', $item->absen_code) }}"
                                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm transition-colors duration-200">
                                                            Lihat Absen
                                                        </a>
                                                    @endif
                                                @elseif ($item->raw_absen_approve == 1)
                                                    <span
                                                        class="bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Pending</span>
                                                @elseif ($item->raw_absen_approve == 2)
                                                    <span
                                                        class="bg-green-600 text-white px-3 py-1 rounded-md text-sm">Approved</span>
                                                @elseif ($item->raw_absen_approve == 3)
                                                    <span
                                                        class="bg-red-600 text-white px-3 py-1 rounded-md text-sm">Rejected</span>
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
    </section>
@endsection

@push('scripts')
    <script>
        // Inisialisasi datepicker dengan tanggal hari ini
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('absen_date').value = today;
        });
        document.getElementById('absen_proof').addEventListener('change', function(e) {
            const fileName = document.getElementById('file-name');
            if (this.files.length > 0) {
                fileName.textContent = 'File terpilih: ' + this.files[0].name;
            } else {
                fileName.textContent = '';
            }
        });
    </script>
@endpush
