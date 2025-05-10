@extends('base.base-dash-index')
@section('title')
    Data Master Kelas - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Kelas
@endsection
@section('submenu')
    Daftar Data Kelas
@endsection
@section('submenu0')
    Tambah Data Kelas
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Kelas
@endsection
@section('content')
    <section class="w-full p-4">
        <div class="w-full">
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                    <button type="button" class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300" 
                        onclick="openModal('tambahKelas')">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="table1">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelas</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Wali Dosen</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($kelas as $key => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-center text-sm text-gray-500">{{ ++$key }}</td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->proku->name . ' - ' . $item->name }}</td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->pstudi->name . ' - ' . $item->taka->semester }}</td>
                                        @php $mhs = \App\Models\Mahasiswa::where('class_id', $item->id)->count(); @endphp
                                        <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $mhs . ' / ' . $item->capacity . ' Mahasiswa' }}</td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->dosen->dsn_name }}</td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-500">
                                            <div class="flex justify-center items-center space-x-2">
                                                <button type="button" class="inline-flex items-center justify-center p-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                                                    onclick="openModal('updateKelas{{ $item->code }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="{{ route($prefix . 'master.kelas-mahasiswa-view', $item->code) }}"
                                                    class="inline-flex items-center justify-center p-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                                    <i class="fa-solid fa-users"></i>
                                                </a>
                                                <form id="delete-form-{{ $item->code }}"
                                                    action="{{ route($prefix . 'master.kelas-destroy', $item->code) }}"
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
        </div>
    </section>

    <!-- Modal Tambah Kelas -->
    <div id="tambahKelas" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <form action="{{ route($prefix . 'master.kelas-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                    <h4 class="text-lg font-semibold text-gray-800">Tambah Kelas</h4>
                    <div class="flex space-x-2">
                        <button type="submit" class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        <button type="button" class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                            onclick="closeModal('tambahKelas')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]" 
                                name="name" id="name" placeholder="Inputkan nama Kelas...">
                            @error('name')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="code" class="block text-sm font-medium text-gray-700">Kode Kelas</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]" 
                                name="code" id="code" placeholder="Inputkan kode Kelas..." maxlength="32">
                            @error('code')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas Kelas</label>
                            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]" 
                                name="capacity" id="capacity" placeholder="Inputkan kapasitas Kelas..." max="35" maxlength="2">
                            @error('capacity')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="taka_id" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                            <select name="taka_id" id="taka_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                <option value="" selected>Pilih Tahun Akademik</option>
                                @foreach ($taka as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name . ' - ' . $item->semester }}</option>
                                @endforeach
                            </select>
                            @error('taka_id')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="pstudi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                            <select name="pstudi_id" id="pstudi_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                <option value="" selected>Pilih Program Studi</option>
                                @foreach ($pstudi as $studi)
                                    <option value="{{ $studi->id }}">{{ $studi->name }}</option>
                                @endforeach
                            </select>
                            @error('pstudi_id')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="proku_id" class="block text-sm font-medium text-gray-700">Program Kuliah</label>
                            <select name="proku_id" id="proku_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                <option value="" selected>Pilih Program Kuliah</option>
                                @foreach ($proku as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('proku_id')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="dosen_id" class="block text-sm font-medium text-gray-700">Wali Dosen</label>
                            <select name="dosen_id" id="dosen_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                <option value="" selected>Pilih Wali Dosen</option>
                                @foreach ($dosen as $item)
                                    <option value="{{ $item->id }}">{{ $item->dsn_name }}</option>
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
    </div>

    <!-- Modal Edit Kelas -->
    @foreach ($kelas as $item)
        <div id="updateKelas{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <form action="{{ route($prefix . 'master.kelas-update', $item->code) }}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                        <h4 class="text-lg font-semibold text-gray-800">Edit Kelas - {{ $item->name }}</h4>
                        <div class="flex space-x-2">
                            <button type="submit" class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="button" class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                                onclick="closeModal('updateKelas{{ $item->code }}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]" 
                                    name="name" id="name" placeholder="Inputkan nama Kelas..." value="{{ $item->name }}">
                                @error('name')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="code" class="block text-sm font-medium text-gray-700">Kode Kelas</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]" 
                                    name="code" id="code" placeholder="Inputkan kode Kelas..." value="{{ $item->code }}" maxlength="32">
                                @error('code')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas Kelas</label>
                                <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]" 
                                    name="capacity" id="capacity" placeholder="Inputkan kapasitas Kelas..." value="{{ $item->capacity }}" max="35" maxlength="2">
                                @error('capacity')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="taka_id" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                                <select name="taka_id" id="taka_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Tahun Akademik</option>
                                    @foreach ($taka as $tk)
                                        <option value="{{ $tk->id }}" {{ $item->taka_id == $tk->id ? 'selected' : '' }}>
                                            {{ $tk->name . ' - ' . $tk->semester }}</option>
                                    @endforeach
                                </select>
                                @error('taka_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="pstudi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                                <select name="pstudi_id" id="pstudi_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Program Studi</option>
                                    @foreach ($pstudi as $studi)
                                        <option value="{{ $studi->id }}" {{ $item->pstudi_id == $studi->id ? 'selected' : '' }}>
                                            {{ $studi->name }}</option>
                                    @endforeach
                                </select>
                                @error('pstudi_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="proku_id" class="block text-sm font-medium text-gray-700">Program Kuliah</label>
                                <select name="proku_id" id="proku_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Program Kuliah</option>
                                    @foreach ($proku as $pk)
                                        <option value="{{ $pk->id }}" {{ $item->proku_id == $pk->id ? 'selected' : '' }}>
                                            {{ $pk->name }}</option>
                                    @endforeach
                                </select>
                                @error('proku_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="dosen_id" class="block text-sm font-medium text-gray-700">Wali Dosen</label>
                                <select name="dosen_id" id="dosen_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Wali Dosen</option>
                                    @foreach ($dosen as $dsn)
                                        <option value="{{ $dsn->id }}" {{ $item->dosen_id == $dsn->id ? 'selected' : '' }}>
                                            {{ $dsn->dsn_name }}</option>
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
            const modals = document.querySelectorAll('[id^="updateKelas"], #tambahKelas');
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
