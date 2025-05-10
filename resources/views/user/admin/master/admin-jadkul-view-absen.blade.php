@extends('base.base-dash-index')
@section('title')
    Data Master Absensi Mahasiswa - Siakad By Internal Developer
@endsection
@section('menu')
    Data Jadwal Kuliah
@endsection
@section('submenu')
    Daftar Absensi {{ $jadkul->matkul->name . ' - ' . $jadkul->pert_id }}
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat Absensi Mahasiswa pada Mata Kuliah {{ $jadkul->matkul->name . ' - ' . $jadkul->pert_id }}
@endsection
@section('content')
    <section class="p-4">
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                <div class="flex space-x-2">
                    <a href="{{ route($prefix . 'master.jadkul-index') }}"
                        class="inline-flex items-center justify-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-backward"></i>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#cetakDataAbsen"
                        class="inline-flex items-center justify-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-file-pdf"></i>
                    </a>
                </div>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">#
                            </th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Nama Mahasiswa</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Nomor NIM</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Nama Kelas</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Status Absen</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Tanggal Absen</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Waktu Absen</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($absen as $key => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-center" data-label="Number">{{ ++$key }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center" data-label="Nama Mahasiswa">
                                    {{ $item->mahasiswa->mhs_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center" data-label="Nomor NIM Mahasiswa">
                                    {{ $item->mahasiswa->mhs_nim }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center" data-label="Nama Kelas">
                                    {{ $item->mahasiswa->kelas->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center" data-label="Status Absen">
                                    {{ $item->absen_type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center" data-label="Tanggal Absen">
                                    {{ \Carbon\Carbon::parse($item->absen_date)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center" data-label="Waktu Absen">
                                    {{ \Carbon\Carbon::parse($item->absen_time)->format('H:i') }} WIB</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#updateAbsen{{ $item->code }}"
                                        class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Edit Absensi -->
    @foreach ($absen as $item)
        <div class="modal fade" id="updateAbsen{{ $item->code }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content rounded-lg shadow-lg">
                    <form action="{{ route($prefix . 'master.jadkul-absen-update', $item->code) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                            <h4 class="text-lg font-semibold text-gray-800">Edit Absensi Perkuliahan -
                                {{ $item->mahasiswa->mhs_name }}</h4>
                            <div class="flex space-x-2">
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                                <button type="button"
                                    class="inline-flex items-center justify-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300"
                                    data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="space-y-4">
                                <div class="w-full">
                                    <img src="{{ asset('storage/images/' . $item->absen_proof) }}"
                                        class="w-full h-auto rounded-lg mb-4" alt="">
                                    <label for="absen_desc" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                                        Absen</label>
                                    <textarea name="absen_desc" id="absen_desc"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        rows="5" placeholder="Inputkan deskripsi absen...">{{ $item->absen_desc == null ? null : $item->absen_desc }}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Cetak Data Absensi -->
    <div class="modal fade" id="cetakDataAbsen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-l">
            <div class="modal-content rounded-lg shadow-lg">
                <form action="{{ route($prefix . 'master.jadkul-absen-cetak', $jadkul->code) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800">Cetak Data Absensi -
                            {{ $jadkul->matkul->name . ' - ' . $jadkul->pert_id }}</h4>
                        <button type="button"
                            class="inline-flex items-center justify-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300"
                            data-bs-dismiss="modal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label for="kode_kelas" class="block text-sm font-medium text-gray-700">Pilih
                                    Kelas</label>
                                <div class="flex items-center space-x-2">
                                    <select name="kode_kelas" id="kode_kelas"
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                        <option value="" selected>Pilih Kelas</option>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit"
                                        class="inline-flex items-center justify-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
