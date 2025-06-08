@extends('base.base-dash-index')
@section('title')
    Daftar Mahasiswa Kelas {{ $kelas->name }} - Siakad By Internal Developer
@endsection
@section('menu')
    Data Kelas
@endsection
@section('submenu')
    Daftar Mahasiswa Kelas {{ $kelas->name }}
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat data Mahasiswa pada kelas {{ $kelas->name }}
@endsection

@section('content')
    <section class="p-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h5 class="flex justify-between items-center text-lg font-semibold">
                    @yield('submenu')
                    <div class="flex gap-2">
                        <a href="{{ route($prefix . 'master.kelas-index') }}"
                            class="inline-flex items-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-backward"></i>
                        </a>
                        <a href="{{ route($prefix . 'master.kelas-management', $kelas->code) }}"
                            class="inline-flex items-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-user-plus"></i>
                        </a>
                        <form action="{{ route($prefix . 'master.kelas-mahasiswa-cetak', $kelas->code) }}" method="post"
                            class="inline">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-file-pdf"></i>
                            </button>
                        </form>
                    </div>
                </h5>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nomor NIM</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Mahasiswa</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Gender</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kehadiran</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Presentase Kehadiran</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($mahasiswa as $key => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-900 text-center">{{ ++$key }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900 text-center">{{ $item->mhs_nim }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900 text-center">{{ $item->mhs_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900 text-center">
                                    {{ $item->mhs_gend == null ? '-' : $item->mhs_gend }}</td>
                                @php
                                    $dateNow = \Carbon\Carbon::now()->format('m-d-Y');
                                    $timeNow = \Carbon\Carbon::now()->format('H:i:s');

                                    $jadkul = \App\Models\JadwalKuliah::where('kelas_id', $kelas->id)->get();
                                    $absen = \App\Models\AbsensiMahasiswa::where('author_id', $item->id)->get();
                                @endphp
                                <td class="px-4 py-3 text-sm text-gray-900 text-center">{{ $absen->count() }} /
                                    {{ $jadkul->count() }} Perkuliahan</td>
                                <td class="px-4 py-3 text-sm text-gray-900 text-center">
                                    {{ $jadkul->count() > 0 ? number_format(($absen->count() / $jadkul->count()) * 100, 1) : 0 }} %</td>
                                <td class="px-4 py-3 text-sm text-center">
                                    <button type="button" onclick="openModal('editMahasiswa{{ $item->code }}')"
                                        class="inline-flex items-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Section -->
    @foreach ($mahasiswa as $item)
        <div id="editMahasiswa{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">Edit Data Mahasiswa - {{ $item->mhs_name }}
                                </h3>
                                <div class="flex gap-2">
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                    <button type="button" onclick="closeModal('editMahasiswa{{ $item->code }}')"
                                        class="inline-flex items-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <!-- Modal content here -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
