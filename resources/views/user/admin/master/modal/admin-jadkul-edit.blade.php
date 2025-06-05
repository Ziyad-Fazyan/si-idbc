@foreach ($jadkul as $item)
<div id="updateJadkul{{ $item->code }}"
    class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <form action="{{ route($prefix . 'master.jadkul-update', $item->code) }}" method="POST"
            enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                <h4 class="text-lg font-semibold text-gray-800">Edit Jadwal Perkuliahan -
                    {{ $item->matkul->name }}</h4>
                <div class="flex space-x-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                    <button type="button"
                        class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                        onclick="closeModal('updateJadkul{{ $item->code }}')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="makul_id" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                        <select name="makul_id" id="makul_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                            readonly>
                            <option value="" selected>Pilih Mata Kuliah</option>
                            @foreach ($matkul as $item_m)
                                @php
                                    $dosen1_name = $item_m->dosen1 ? $item_m->dosen1->dsn_name : null;
                                    $dosen2_name = $item_m->dosen2 ? $item_m->dosen2->dsn_name : null;
                                    $dosen3_name = $item_m->dosen3 ? $item_m->dosen3->dsn_name : null;
                                @endphp
                                <option value="{{ $item_m->id }}"
                                    {{ $item->makul_id == $item_m->id ? 'selected' : '' }}
                                    data-dosen1="{{ $item_m->dosen_1 }}" data-dosen2="{{ $item_m->dosen_2 }}"
                                    data-dosen3="{{ $item_m->dosen_3 }}" data-dosen1-name="{{ $dosen1_name }}"
                                    data-dosen2-name="{{ $dosen2_name }}" data-dosen3-name="{{ $dosen3_name }}">
                                    {{ $item_m->name }}</option>
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
                            <option value="0" {{ $item->raw_days_id == 0 ? 'selected' : '' }}>Hari Minggu
                            </option>
                            <option value="1" {{ $item->raw_days_id == 1 ? 'selected' : '' }}>Hari Senin
                            </option>
                            <option value="2" {{ $item->raw_days_id == 2 ? 'selected' : '' }}>Hari Selasa
                            </option>
                            <option value="3" {{ $item->raw_days_id == 3 ? 'selected' : '' }}>Hari Rabu
                            </option>
                            <option value="4" {{ $item->raw_days_id == 4 ? 'selected' : '' }}>Hari Kamis
                            </option>
                            <option value="5" {{ $item->raw_days_id == 5 ? 'selected' : '' }}>Hari Jum'at
                            </option>
                            <option value="6" {{ $item->raw_days_id == 6 ? 'selected' : '' }}>Hari Sabtu
                            </option>
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
                            value="{{ $item->date }}">
                        @error('date')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="start" class="block text-sm font-medium text-gray-700">Waktu Mulai
                            Perkuliahan</label>
                        <input type="time" name="start" id="start"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                            value="{{ $item->start }}">
                        @error('start')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="ended" class="block text-sm font-medium text-gray-700">Waktu Selesai
                            Perkuliahan</label>
                        <input type="time" name="ended" id="ended"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                            value="{{ $item->ended }}">
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
                        <select name="kelas_id" id="kelas_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
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
                        <select name="dosen_id" id="dosen_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                            <option value="" selected>Pilih Dosen</option>
                            <option value="{{ $item->matkul->dosen_1 == null ? '' : $item->matkul->dosen_1 }}"
                                {{ $item->matkul->dosen_1 == $item->dosen_id ? 'selected' : '' }}
                                {{ $item->matkul->dosen_1 == null ? 'disabled' : '' }}>
                                {{ $item->matkul->dosen_1 == null ? 'Tidak Tersedia' : $item->matkul->dosen1->dsn_name }}
                            </option>
                            <option value="{{ $item->matkul->dosen_2 == null ? '' : $item->matkul->dosen_2 }}"
                                {{ $item->matkul->dosen_2 == $item->dosen_id ? 'selected' : '' }}
                                {{ $item->matkul->dosen_2 == null ? 'disabled' : '' }}>
                                {{ $item->matkul->dosen_2 == null ? 'Tidak Tersedia' : $item->matkul->dosen2->dsn_name }}
                            </option>
                            <option value="{{ $item->matkul->dosen_3 == null ? '' : $item->matkul->dosen_3 }}"
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
        </form>
    </div>
</div>
@endforeach
