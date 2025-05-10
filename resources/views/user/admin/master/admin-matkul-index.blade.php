@extends('base.base-dash-index')
@section('title')
    Data Master Mata Kuliah - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Mata Kuliah
@endsection
@section('submenu')
    Data Master Mata Kuliah
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Mata Kuliah
@endsection
@section('content')
    <section class="w-full p-4">
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                <div>
                    <a href="{{ route($prefix . 'master.matkul-create') }}"
                        class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
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
                                    Nama Kurikulum</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Mata Kuliah</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kode Mata Kuliah</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dosen Pengampu</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Syarat Mata Kuliah</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($matkul as $key => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ ++$key }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">
                                        {{ $item->pstudi->fakultas->name . ' - ' . $item->pstudi->name }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->kuri->name }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->name }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">
                                        {{ $item->kuri->code . ' - ' . $item->taka->code . ' - ' . $item->code }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">
                                        {{ $item->dosen1->dsn_name }}<br>{{ $item->dosen_2 == null ? '-' : $item->dosen2->dsn_name }}<br>{{ $item->dosen_3 == null ? '-' : $item->dosen3->dsn_name }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">
                                        {{ $item->requ_id == null ? '-' : $item->requ->name }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">
                                        <div class="flex justify-center items-center space-x-2">
                                            <button type="button"
                                                class="inline-flex items-center justify-center p-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                                                onclick="openModal('updateMatkul{{ $item->code }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form id="delete-form-{{ $item->code }}"
                                                action="{{ route($prefix . 'master.matkul-destroy', $item->code) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="inline-flex items-center justify-center p-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                                                    onclick="deleteData('{{ $item->code }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Edit Mata Kuliah -->
    @foreach ($matkul as $item)
        <div id="updateMatkul{{ $item->code }}"
            class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <form action="{{ route($prefix . 'master.matkul-update', $item->code) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                        <h4 class="text-lg font-semibold text-gray-800">Edit Mata Kuliah - {{ $item->name }}</h4>
                        <div class="flex space-x-2">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="button"
                                class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                                onclick="closeModal('updateMatkul{{ $item->code }}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Mata
                                    Kuliah</label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    value="{{ $item->name }}">
                                @error('name')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="code" class="block text-sm font-medium text-gray-700">Kode Mata
                                    Kuliah</label>
                                <input type="text" name="code" id="code"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    value="{{ $item->code }}">
                                @error('code')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="requ_id" class="block text-sm font-medium text-gray-700">Persyaratan Mata
                                    Kuliah</label>
                                <select name="requ_id" id="requ_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Persyaratan Mata Kuliah</option>
                                    @foreach ($matkul as $item_r)
                                        <option value="{{ $item_r->id }}"
                                            {{ $item->requ_id == $item_r->id ? 'selected' : '' }}>
                                            {{ $item_r->name }}</option>
                                    @endforeach
                                </select>
                                @error('requ_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="bsks" class="block text-sm font-medium text-gray-700">Bebas SKS Mata
                                    Kuliah</label>
                                <input type="number" min="10" max="40" name="bsks" id="bsks"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    value="{{ $item->bsks }}">
                                @error('bsks')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="kuri_id" class="block text-sm font-medium text-gray-700">Kurikulum</label>
                                <select name="kuri_id" id="kuri_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Kurikulum</option>
                                    @foreach ($kuri as $item_k)
                                        <option value="{{ $item_k->id }}"
                                            {{ $item->kuri_id == $item_k->id ? 'selected' : '' }}>
                                            {{ $item_k->name }}</option>
                                    @endforeach
                                </select>
                                @error('kuri_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="taka_id" class="block text-sm font-medium text-gray-700">Tahun
                                    Akademik</label>
                                <select name="taka_id" id="taka_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Tahun Akademik</option>
                                    @foreach ($taka as $item_t)
                                        <option value="{{ $item_t->id }}"
                                            {{ $item->taka_id == $item_t->id ? 'selected' : '' }}>
                                            {{ $item_t->name . ' - ' . $item_t->semester }}</option>
                                    @endforeach
                                </select>
                                @error('taka_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="pstudi_id" class="block text-sm font-medium text-gray-700">Program
                                    Studi</label>
                                <select name="pstudi_id" id="pstudi_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Program Studi</option>
                                    @foreach ($pstudi as $item_p)
                                        <option value="{{ $item_p->id }}"
                                            {{ $item->pstudi_id == $item_p->id ? 'selected' : '' }}>
                                            {{ $item_p->name }}</option>
                                    @endforeach
                                </select>
                                @error('pstudi_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="dosen_1" class="block text-sm font-medium text-gray-700">Dosen
                                    Pengampu</label>
                                <select name="dosen_1" id="dosen_1"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Dosen Pengampu</option>
                                    @foreach ($dosen as $item_d)
                                        <option value="{{ $item_d->id }}"
                                            {{ $item->dosen_1 == $item_d->id ? 'selected' : '' }}>
                                            {{ $item_d->dsn_name }}</option>
                                    @endforeach
                                </select>
                                @error('dosen_1')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="dosen_2" class="block text-sm font-medium text-gray-700">Dosen Pengampu
                                    2</label>
                                <select name="dosen_2" id="dosen_2"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Dosen Pengampu 2</option>
                                    @foreach ($dosen as $item_d)
                                        <option value="{{ $item_d->id }}"
                                            {{ $item->dosen_2 == $item_d->id ? 'selected' : '' }}>
                                            {{ $item_d->dsn_name }}</option>
                                    @endforeach
                                </select>
                                @error('dosen_2')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="dosen_3" class="block text-sm font-medium text-gray-700">Dosen Pengampu
                                    3</label>
                                <select name="dosen_3" id="dosen_3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Dosen Pengampu 3</option>
                                    @foreach ($dosen as $item_d)
                                        <option value="{{ $item_d->id }}"
                                            {{ $item->dosen_3 == $item_d->id ? 'selected' : '' }}>
                                            {{ $item_d->dsn_name }}</option>
                                    @endforeach
                                </select>
                                @error('dosen_3')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

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
                const modals = document.querySelectorAll('[id^="updateMatkul"]');
                modals.forEach(function(modal) {
                    if (event.target === modal) {
                        modal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            });
        </script>
    @endpush
@endsection
