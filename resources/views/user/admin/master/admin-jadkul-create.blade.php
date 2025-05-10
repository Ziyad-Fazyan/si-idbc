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
                            <a href="{{ route($prefix . 'master.jadkul-index') }}" class="inline-flex items-center justify-center px-3 py-2 border border-yellow-500 text-yellow-500 rounded-md hover:bg-yellow-500 hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="space-y-2">
                                <label for="makul_id" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                                <select name="makul_id" id="makul_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
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
                                <label for="pert_id" class="block text-sm font-medium text-gray-700">Pertemuan</label>
                                <select name="pert_id" id="pert_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Pertemuan</option>
                                    <option value="1">Pertemuan 1</option>
                                    <option value="2">Pertemuan 2</option>
                                    <option value="3">Pertemuan 3</option>
                                    <option value="4">Pertemuan 4</option>
                                    <option value="5">Pertemuan 5</option>
                                    <option value="6">Pertemuan 6</option>
                                    <option value="7">Pertemuan 7</option>
                                    <option value="8">Pertemuan 8</option>
                                    <option value="9">Pertemuan 9</option>
                                    <option value="10">Pertemuan 10</option>
                                    <option value="11">Pertemuan 11</option>
                                    <option value="12">Pertemuan 12</option>
                                    <option value="13">Pertemuan 13</option>
                                    <option value="14">Pertemuan 14</option>
                                    <option value="15">Pertemuan 15</option>
                                    <option value="16">Pertemuan 16</option>
                                </select>
                                @error('pert_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="meth_id" class="block text-sm font-medium text-gray-700">Metode Perkuliahan</label>
                                <select name="meth_id" id="meth_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Metode Perkuliahan</option>
                                    <option value="0">Tatap Muka</option>
                                    <option value="1">Teleconference</option>
                                </select>
                                @error('meth_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="bsks" class="block text-sm font-medium text-gray-700">Beban SKS Hari Ini</label>
                                <input type="number" min="1" max="8" name="bsks" id="bsks"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]" placeholder="Inputkan jumlah beban sks...">
                                @error('bsks')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        <div class="space-y-2">
                            <label for="days_id" class="block text-sm font-medium text-gray-700">Hari</label>
                            <select name="days_id" id="days_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
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
                            <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Perkuliahan</label>
                            <input type="date" name="date" id="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                placeholder="Pilih tanggal perkuliahan...">
                            @error('date')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="start" class="block text-sm font-medium text-gray-700">Waktu Mulai Perkuliahan</label>
                            <input type="time" name="start" id="start" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                placeholder="Pilih jam mulai perkuliahan...">
                            @error('start')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="ended" class="block text-sm font-medium text-gray-700">Waktu Selesai Perkuliahan</label>
                            <input type="time" name="ended" id="ended" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                placeholder="Pilih jam selesai perkuliahan...">
                            @error('ended')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="ruang_id" class="block text-sm font-medium text-gray-700">Ruangan</label>
                            <select name="ruang_id" id="ruang_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
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
                            <select name="kelas_id" id="kelas_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
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
                            <select name="dosen_id" id="dosen_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                <option value="" selected>Pilih Dosen</option>
                            </select>
                            @error('dosen_id')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
            </form>
        </div>

        <div class="w-full mt-6">
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h5 class="text-lg font-semibold text-gray-800">@yield('submenu0')</h5>
                    <div>
                        <a href="{{ route($prefix . 'master.jadkul-create') }}" class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="table1">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelas</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mata Kuliah</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen Pengajar</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Metode Perkuliahan</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Perkuliahan</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Perkuliahan</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($jadkul as $key => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Number">{{ ++$key }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Program Studi">{{ $item->kelas->pstudi->fakultas->name }} <br>
                                        {{ $item->kelas->pstudi->name }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Nama Kelas">{{ $item->kelas->code }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Mata Kuliah">{{ $item->matkul->name }} <br>
                                        {{ $item->pert_id . ' - ' . $item->bsks . ' SKS' }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Nama Dosen">{{ $item->dosen->dsn_name }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Metode">{{ $item->meth_id }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Tanggal Kuliah">{{ $item->days_id }} <br> - <br>
                                        {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500" data-label="Waktu Perkuliahan">{{ $item->start }} <br> - <br>
                                        {{ $item->ended }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500 flex justify-center items-center space-x-2">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#updateJadkul{{ $item->code }}"
                                            class="inline-flex items-center justify-center px-2 py-1 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a href="{{ route($prefix.'master.jadkul-view', $item->code) }}" class="inline-flex items-center justify-center px-2 py-1 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-500 hover:text-white transition-colors duration-300"><i class="fa-solid fa-eye"></i></a> --}}
                                        <form id="delete-form-{{ $item->code }}"
                                            action="{{ route($prefix . 'master.jadkul-destroy', $item->code) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="inline-flex items-center justify-center px-2 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
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
    <div class="mt-4">

        <!--Extra Large Modal -->
        @foreach ($jadkul as $item)
            <form action="{{ route($prefix . 'master.jadkul-update', $item->code) }}" method="POST"
                enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="modal fade text-left w-100" id="updateJadkul{{ $item->code }}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                        <div class="modal-content">
                            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-800" id="myModalLabel16">Edit Jadwal Perkuliahan -
                                    {{ $item->matkul->name . ' ' . $item->pert_id }}</h4>
                                <div class="flex space-x-2">
                                    <button type="submit" class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                    <button type="button" class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                                    <div class="space-y-2">
                                        <label for="matkul_ide" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                                        <select name="makul_id" id="matkul_ide" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71] bg-gray-100" disabled>
                                            <option value="" selected>Pilih Mata Kuliah</option>
                                            @foreach ($matkul as $item_m)
                                                @php
                                                    $dosen1_name = $item_m->dosen1 ? $item_m->dosen1->dsn_name : null;
                                                    $dosen2_name = $item_m->dosen2 ? $item_m->dosen2->dsn_name : null;
                                                    $dosen3_name = $item_m->dosen3 ? $item_m->dosen3->dsn_name : null;
                                                @endphp
                                                <option value="{{ $item_m->id }}"
                                                    {{ $item->makul_id == $item_m->id ? 'selected' : '' }}
                                                    data-dosen1="{{ $item_m->dosen_1 }}"
                                                    data-dosen2="{{ $item_m->dosen_2 }}"
                                                    data-dosen3="{{ $item_m->dosen_3 }}"
                                                    data-dosen1-name="{{ $dosen1_name }}"
                                                    data-dosen2-name="{{ $dosen2_name }}"
                                                    data-dosen3-name="{{ $dosen3_name }}">{{ $item_m->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('makul_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="pert_id" class="block text-sm font-medium text-gray-700">Pertemuan</label>
                                        <select name="pert_id" id="pert_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                            <option value="" selected>Pilih Pertemuan</option>
                                            <option value="1" {{ $item->raw_pert_id == 1 ? 'selected' : '' }}>
                                                Pertemuan 1</option>
                                            <option value="2" {{ $item->raw_pert_id == 2 ? 'selected' : '' }}>
                                                Pertemuan 2</option>
                                            <option value="3" {{ $item->raw_pert_id == 3 ? 'selected' : '' }}>
                                                Pertemuan 3</option>
                                            <option value="4" {{ $item->raw_pert_id == 4 ? 'selected' : '' }}>
                                                Pertemuan 4</option>
                                            <option value="5" {{ $item->raw_pert_id == 5 ? 'selected' : '' }}>
                                                Pertemuan 5</option>
                                            <option value="6" {{ $item->raw_pert_id == 6 ? 'selected' : '' }}>
                                                Pertemuan 6</option>
                                            <option value="7" {{ $item->raw_pert_id == 7 ? 'selected' : '' }}>
                                                Pertemuan 7</option>
                                            <option value="8" {{ $item->raw_pert_id == 8 ? 'selected' : '' }}>
                                                Pertemuan 8</option>
                                            <option value="9" {{ $item->raw_pert_id == 9 ? 'selected' : '' }}>
                                                Pertemuan 9</option>
                                            <option value="10" {{ $item->raw_pert_id == 10 ? 'selected' : '' }}>
                                                Pertemuan 10</option>
                                            <option value="11" {{ $item->raw_pert_id == 11 ? 'selected' : '' }}>
                                                Pertemuan 11</option>
                                            <option value="12" {{ $item->raw_pert_id == 12 ? 'selected' : '' }}>
                                                Pertemuan 12</option>
                                            <option value="13" {{ $item->raw_pert_id == 13 ? 'selected' : '' }}>
                                                Pertemuan 13</option>
                                            <option value="14" {{ $item->raw_pert_id == 14 ? 'selected' : '' }}>
                                                Pertemuan 14</option>
                                            <option value="15" {{ $item->raw_pert_id == 15 ? 'selected' : '' }}>
                                                Pertemuan 15</option>
                                            <option value="16" {{ $item->raw_pert_id == 16 ? 'selected' : '' }}>
                                                Pertemuan 16</option>
                                        </select>
                                        @error('pert_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="meth_id" class="block text-sm font-medium text-gray-700">Metode Perkuliahan</label>
                                        <select name="meth_id" id="meth_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                            <option value="" selected>Pilih Metode Perkuliahan</option>
                                            <option value="0" {{ $item->raw_meth_id == 0 ? 'selected' : '' }}>Tatap
                                                Muka</option>
                                            <option value="1" {{ $item->raw_meth_id == 1 ? 'selected' : '' }}>
                                                Teleconference</option>
                                        </select>
                                        @error('meth_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="bsks" class="block text-sm font-medium text-gray-700">Bebas SKS Hari Ini</label>
                                        <input type="number" min="1" max="8" name="bsks"
                                            id="bsks" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]" value="{{ $item->bsks }}">
                                        @error('bsks')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="days_id" class="block text-sm font-medium text-gray-700">Hari</label>
                                        <select name="days_id" id="days_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                            <option value="" selected>Pilih Hari</option>
                                            <option value="0" {{ $item->raw_days_id == 0 ? 'selected' : '' }}>Hari
                                                Minggu</option>
                                            <option value="1" {{ $item->raw_days_id == 1 ? 'selected' : '' }}>Hari
                                                Senin</option>
                                            <option value="2" {{ $item->raw_days_id == 2 ? 'selected' : '' }}>Hari
                                                Selasa</option>
                                            <option value="3" {{ $item->raw_days_id == 3 ? 'selected' : '' }}>Hari
                                                Rabu</option>
                                            <option value="4" {{ $item->raw_days_id == 4 ? 'selected' : '' }}>Hari
                                                Kamis</option>
                                            <option value="5" {{ $item->raw_days_id == 5 ? 'selected' : '' }}>Hari
                                                Jum'at</option>
                                            <option value="6" {{ $item->raw_days_id == 6 ? 'selected' : '' }}>Hari
                                                Sabtu</option>
                                        </select>
                                        @error('days_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Perkuliahan</label>
                                        <input type="date" name="date" id="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            value="{{ $item->date }}">
                                        @error('date')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="start" class="block text-sm font-medium text-gray-700">Waktu Mulai Perkuliahan</label>
                                        <input type="time" name="start" id="start" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            value="{{ $item->start }}">
                                        @error('start')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="ended" class="block text-sm font-medium text-gray-700">Waktu Selesai Perkuliahan</label>
                                        <input type="time" name="ended" id="ended" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            value="{{ $item->ended }}">
                                        @error('ended')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="ruang_id" class="block text-sm font-medium text-gray-700">Ruangan</label>
                                        <select name="ruang_id" id="ruang_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                            <option value="" selected>Pilih Ruangan</option>
                                            @foreach ($ruang as $item_r)
                                                <option value="{{ $item_r->id }}"
                                                    {{ $item->ruang_id == $item_r->id ? 'selected' : '' }}>
                                                    {{ $item_r->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('ruang_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                                        <select name="kelas_id" id="kelas_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                            <option value="" selected>Pilih Kelas</option>
                                            @foreach ($kelas as $item_k)
                                                <option value="{{ $item_k->id }}"
                                                    {{ $item->kelas_id == $item_k->id ? 'selected' : '' }}>
                                                    {{ $item_k->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="space-y-2">
                                        <label for="dosen_id" class="block text-sm font-medium text-gray-700">Dosen</label>
                                        <select name="dosen_id" id="dosen_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                            <option value="" selected>Pilih Dosen</option>
                                            <option
                                                value="{{ $item->matkul->dosen_1 == null ? '' : $item->matkul->dosen_1 }}"
                                                {{ $item->matkul->dosen_1 == $item->dosen_id ? 'selected' : '' }}
                                                {{ $item->matkul->dosen_1 == null ? 'disabled' : '' }}>
                                                {{ $item->matkul->dosen_1 == null ? 'Tidak Tersedia' : $item->matkul->dosen1->dsn_name }}
                                            </option>
                                            <option
                                                value="{{ $item->matkul->dosen_2 == null ? '' : $item->matkul->dosen_2 }}"
                                                {{ $item->matkul->dosen_2 == $item->dosen_id ? 'selected' : '' }}
                                                {{ $item->matkul->dosen_2 == null ? 'disabled' : '' }}>
                                                {{ $item->matkul->dosen_2 == null ? 'Tidak Tersedia' : $item->matkul->dosen2->dsn_name }}
                                            </option>
                                            <option
                                                value="{{ $item->matkul->dosen_3 == null ? '' : $item->matkul->dosen_3 }}"
                                                {{ $item->matkul->dosen_3 == $item->dosen_id ? 'selected' : '' }}
                                                {{ $item->matkul->dosen_3 == null ? 'disabled' : '' }}>
                                                {{ $item->matkul->dosen_3 == null ? 'Tidak Tersedia' : $item->matkul->dosen3->dsn_name }}
                                            </option>
                                        </select>
                                        @error('dosen_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endforeach
    </div>
@endsection
@section('custom-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Event saat mata kuliah dipilih
            $('#makul_id').on('change', function() {
                var mataKuliahId = $(this).val();
                var selectedOption = $(this).find('option:selected');
                var dosen1Id = selectedOption.attr('data-dosen1');
                var dosen2Id = selectedOption.attr('data-dosen2');
                var dosen3Id = selectedOption.attr('data-dosen3');

                // Mengambil nama dosen berdasarkan ID
                var dosen1Name = selectedOption.attr('data-dosen1-name');
                var dosen2Name = selectedOption.attr('data-dosen2-name');
                var dosen3Name = selectedOption.attr('data-dosen3-name');

                // Menetapkan nama dosen sebagai teks opsi
                $('#dosen_id').empty(); // Kosongkan opsi dosen sebelum menambahkan yang baru
                $('#dosen_id').append('<option value="" selected>Pilih Dosen</option>');

                if (dosen1Id && dosen1Name) {
                    $('#dosen_id').append('<option value="' + dosen1Id + '">' + dosen1Name + '</option>');
                }
                if (dosen2Id && dosen2Name) {
                    $('#dosen_id').append('<option value="' + dosen2Id + '">' + dosen2Name + '</option>');
                }
                if (dosen3Id && dosen3Name) {
                    $('#dosen_id').append('<option value="' + dosen3Id + '">' + dosen3Name + '</option>');
                }
            });
        });
    </script>
@endsection
@section('custom-css')
    <style>
        @media screen and (max-width: 640px) {
            #table1 thead {
                display: none;
            }
            
            #table1 tbody tr {
                display: block;
                margin-bottom: 1rem;
                border-bottom: 2px solid #e5e7eb;
            }
            
            #table1 tbody td {
                display: block;
                text-align: right;
                padding: 0.5rem 1rem;
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
            }
        }
    </style>
@endsection
