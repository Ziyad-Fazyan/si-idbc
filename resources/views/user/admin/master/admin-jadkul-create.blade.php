@extends('base.base-dash-index')
@section('title')
    Data Master Jadwal Kuliah - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Jadwal Kuliah
@endsection
@section('submenu')
    Tambah Data Jadwal Kuliah
@endsection
@section('submenu0')
    Data Terakhir yang dibuat
@endsection
@section('urlmenu')
    {{ route($prefix . 'master.jadkul-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Jadwal Kuliah
@endsection
@section('content')
    <section class="w-full p-4">
        <div class="w-full">
            <form action="{{ route($prefix . 'master.jadkul-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                        <div class="flex space-x-2">
                            <a href="{{ route($prefix . 'master.jadkul-index') }}"
                                class="inline-flex items-center justify-center px-3 py-2 border border-yellow-500 text-yellow-500 rounded-md hover:bg-yellow-500 hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="space-y-2">
                                <label for="makul_id" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                                <select name="makul_id" id="makul_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Mata Kuliah</option>
                                    @foreach ($matkul as $item_m)
                                        @php
                                            $dosen1_name = $item_m->dosen1 ? $item_m->dosen1->dsn_name : null;
                                            $dosen2_name = $item_m->dosen2 ? $item_m->dosen2->dsn_name : null;
                                            $dosen3_name = $item_m->dosen3 ? $item_m->dosen3->dsn_name : null;
                                        @endphp
                                        <option value="{{ $item_m->id }}" data-dosen1="{{ $item_m->dosen_1 }}"
                                            data-dosen2="{{ $item_m->dosen_2 }}" data-dosen3="{{ $item_m->dosen_3 }}"
                                            data-dosen1-name="{{ $dosen1_name }}" data-dosen2-name="{{ $dosen2_name }}"
                                            data-dosen3-name="{{ $dosen3_name }}">{{ $item_m->name }}</option>
                                    @endforeach
                                </select>
                                @error('makul_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="days_id" class="block text-sm font-medium text-gray-700">Hari</label>
                                <select name="days_id" id="days_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Hari</option>
                                    <option value="0">Hari Minggu</option>
                                    <option value="1">Hari Senin</option>
                                    <option value="2">Hari Selasa</option>
                                    <option value="3">Hari Rabu</option>
                                    <option value="4">Hari Kamis</option>
                                    <option value="5">Hari Jum'at</option>
                                    <option value="6">Hari Sabtu</option>
                                </select>
                                @error('days_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal
                                    Perkuliahan</label>
                                <input type="date" name="date" id="date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    placeholder="Pilih tanggal perkuliahan...">
                                @error('date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="start" class="block text-sm font-medium text-gray-700">Waktu Mulai
                                    Perkuliahan</label>
                                <input type="time" name="start" id="start"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    placeholder="Pilih jam mulai perkuliahan...">
                                @error('start')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="ended" class="block text-sm font-medium text-gray-700">Waktu Selesai
                                    Perkuliahan</label>
                                <input type="time" name="ended" id="ended"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    placeholder="Pilih jam selesai perkuliahan...">
                                @error('ended')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="ruang_id" class="block text-sm font-medium text-gray-700">Ruangan</label>
                                <select name="ruang_id" id="ruang_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Ruangan</option>
                                    @foreach ($ruang as $item_r)
                                        <option value="{{ $item_r->id }}">{{ $item_r->name }}</option>
                                    @endforeach
                                </select>
                                @error('ruang_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                                <select name="kelas_id" id="kelas_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Kelas</option>
                                    @foreach ($kelas as $item_k)
                                        <option value="{{ $item_k->id }}">{{ $item_k->name }}</option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="dosen_id" class="block text-sm font-medium text-gray-700">Dosen</label>
                                <select name="dosen_id" id="dosen_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Dosen</option>
                                    @foreach ($dosen as $item_d)
                                        <option value="{{ $item_d->id }}">{{ $item_d->dsn_name }}</option>
                                    @endforeach
                                </select>
                                @error('dosen_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
            </form>
        </div>

        <!-- Tabel Data Jadwal Kuliah -->
        <div class="w-full mt-4">
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">

                <!-- Tabel Content -->
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="table1">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Program Studi</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Kelas</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Mata Kuliah</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dosen Pengajar</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Perkuliahan</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Waktu Perkuliahan</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($jadkul as $key => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Number">
                                        {{ ++$key }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Program Studi">
                                        {{ $item->kelas->pstudi->fakultas->name }} <br>
                                        {{ $item->kelas->pstudi->name }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Nama Kelas">
                                        {{ $item->kelas->code }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Mata Kuliah">
                                        {{ $item->matkul->name }} <br>
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Nama Dosen">
                                        {{ $item->dosen->dsn_name }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Tanggal Kuliah">
                                        {{ $item->days_id }} <br>
                                        {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500"
                                        data-label="Waktu Perkuliahan">
                                        {{ $item->start }} - {{ $item->ended }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center text-sm text-gray-500 flex justify-center items-center space-x-2">
                                        <button type="button"
                                            class="inline-flex items-center justify-center p-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                                            onclick="openModal('updateJadkul{{ $item->code }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        {{-- <a href="{{ route($prefix.'master.jadkul-view', $item->code) }}" class="inline-flex items-center justify-center px-2 py-1 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-500 hover:text-white transition-colors duration-300"><i class="fa-solid fa-eye"></i></a> --}}
                                        <form id="delete-form-{{ $item->code }}"
                                            action="{{ route($prefix . 'master.jadkul-destroy', $item->code) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="inline-flex items-center justify-center px-2 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                data-original-title="Delete"
                                                data-url="{{ route($prefix . 'master.jadkul-destroy', $item->code) }}"
                                                data-name="{{ $item->name }}"
                                                onclick="deleteData('{{ $item->code }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Edit Jadwal Kuliah -->
    @include('user.admin.master.modal.admin-jadkul-edit')

    @push('scripts')
        <script>
            // Modal functions
            function openModal(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            // Delete confirmation
            function deleteData(id) {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    document.getElementById('delete-form-' + id).submit();
                }
            }

            // Close modal when clicking outside
            document.addEventListener('click', function(event) {
                const modals = document.querySelectorAll('[id^="updateJadkul"]');
                modals.forEach(function(modal) {
                    if (event.target === modal) {
                        modal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            });
        </script>
    @endpush

    @push('styles')
        <style>
            @media screen and (max-width: 640px) {
                #table1 thead {
                    display: none;
                }

                #table1 tbody tr {
                    display: block;
                    margin-bottom: 1rem;
                    border-bottom: 2px solid #e5e7eb;
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                    border-radius: 0.375rem;
                }

                #table1 tbody td {
                    display: block;
                    text-align: right;
                    padding: 0.75rem 1rem;
                    border-bottom: 1px solid #e5e7eb;
                }

                #table1 tbody td::before {
                    content: attr(data-label);
                    float: left;
                    font-weight: 600;
                    text-transform: uppercase;
                    font-size: 0.75rem;
                }

                #table1 tbody td:last-child {
                    border-bottom: 0;
                    display: flex;
                    justify-content: flex-end;
                    padding: 0.75rem 1rem;
                }
            }
        </style>
    @endpush
@endsection
