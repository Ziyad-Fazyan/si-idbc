<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir Perkuliahan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-50 p-4">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header with Logo and University Info -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.84L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Universitas Contoh</h1>
                        <p class="text-blue-100">Jl. Contoh No. 123, Kota Contoh</p>
                        <div class="flex space-x-4 text-sm text-blue-100 mt-1">
                            <span>Telp: (0123) 456789</span>
                            <span>|</span>
                            <span>www.contoh.ac.id</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Title -->
        <div class="bg-gray-100 px-6 py-4 border-b">
            <h2 class="text-xl font-semibold text-gray-800 text-center">
                Data Kehadiran Mahasiswa
            </h2>
            <div class="text-center text-gray-600 mt-2">
                <p class="font-medium">{{ $kelas->pstudi->fakultas->name }}</p>
                <p>Program Studi {{ $kelas->pstudi->name }}</p>
                <p class="text-sm">{{ $kelas->taka->name . ' - ' . $kelas->taka->semester }}</p>
            </div>
        </div>

        <!-- Class Information -->
        <div class="px-6 py-4 bg-gray-50 border-b">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex">
                    <span class="font-medium text-gray-700 w-24">Nama Kelas</span>
                    <span class="text-gray-600">: {{ $kelas->name }}</span>
                </div>
                <div class="flex">
                    <span class="font-medium text-gray-700 w-24">Wali Dosen</span>
                    <span class="text-gray-600">: {{ $kelas->dosen->dsn_name }}</span>
                </div>
            </div>
        </div>

        <!-- Attendance Table -->
        <div class="px-6 py-4">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kehadiran</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Presentasi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($mahasiswa as $key => $item)
                            @php
                                $dateNow = \Carbon\Carbon::now()->format('m-d-Y');
                                $timeNow = \Carbon\Carbon::now()->format('H:i:s');
                                $jadkul = \App\Models\JadwalKuliah::where('kelas_id', $kelas->id)->get();
                                $absen = \App\Models\AbsensiMahasiswa::where('author_id', $item->id)->get();
                                $percentage = $jadkul->count() > 0 ? ($absen->count() / $jadkul->count()) * 100 : 0;
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center font-medium">{{ ++$key }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center">{{ $item->mhs_nim }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $item->mhs_name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->mhs_gend == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                        {{ $item->mhs_gend == null ? '-' : $item->mhs_gend }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center">
                                    <span class="font-medium">{{ $absen->count() }}</span> / {{ $jadkul->count() }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-center">
                                    <div class="flex items-center justify-center">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-16 bg-gray-200 rounded-full h-2">
                                                <div class="h-2 rounded-full {{ $percentage >= 75 ? 'bg-green-500' : ($percentage >= 50 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                                     style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <span class="text-sm font-medium {{ $percentage >= 75 ? 'text-green-600' : ($percentage >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                                {{ number_format($percentage, 1) }}%
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-lg font-medium">Tidak ada data mahasiswa</p>
                                        <p class="text-sm">Belum ada data kehadiran mahasiswa pada kelas ini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Signatures -->
        <div class="px-6 py-6 bg-gray-50 border-t">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-16">Cirebon, {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                    <div class="border-t-2 border-gray-300 pt-2">
                        <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-600">{{ Auth::user()->type }}</p>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-16">Mengetahui,</p>
                    <div class="border-t-2 border-gray-300 pt-2">
                        <p class="font-semibold text-gray-800">{{ $kelas->dosen->dsn_name }}</p>
                        <p class="text-sm text-gray-600">Wali Dosen</p>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-16">Mengesahkan,</p>
                    <div class="border-t-2 border-gray-300 pt-2">
                        <p class="font-semibold text-gray-800">{{ $kelas->pstudi->head->dsn_name }}</p>
                        <p class="text-sm text-gray-600">Kepala Program Studi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Print Button (hidden when printing) -->
        <div class="px-6 py-4 bg-white border-t no-print">
            <div class="flex justify-center">
                <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-200 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Cetak Laporan</span>
                </button>
            </div>
        </div>
    </div>
</body>
</html>
