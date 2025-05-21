@extends('base.base-dash-index')
@section('title')
    Data Master Tahun Akademik - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Tahun Akademik
@endsection
@section('submenu')
    Daftar Data Tahun Akademik
@endsection
@section('submenu0')
    Tambah Data Tahun Akademik
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Tahun Akademik
@endsection
@section('content')
    <section class="w-full p-4">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Form Tambah Tahun Akademik -->
            <div class="w-full lg:w-1/3">
                <form action="{{ route($prefix . 'master.taka-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                            <h5 class="text-lg font-semibold text-gray-800">@yield('submenu0')</h5>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <div class="p-4 space-y-4">
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Tahun
                                    Akademik</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    name="name" id="name" placeholder="Inputkan nama tahun akademik...">
                                @error('name')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="code" class="block text-sm font-medium text-gray-700">Kode Fakultas ( 6
                                    Angka )</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    name="code" id="code" placeholder="Inputkan kode tahun akademik..."
                                    maxlength="6" uppercase onkeydown="return /[a-zA-Z0-9]/i.test(event.key)">
                                @error('code')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="semester" class="block text-sm font-medium text-gray-700">Semester
                                    Perkuliahan</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    name="semester" id="semester" placeholder="Inputkan kode tahun akademik...">
                                @error('semester')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="year_start" class="block text-sm font-medium text-gray-700">Pilih Tahun
                                    Masuk</label>
                                <input type="number"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    name="year_start" id="year_start" min="2000" max="2100" maxlength="4"
                                    value="{{ \Carbon\Carbon::now()->format('Y') }}" placeholder="Inputkan tahun masuk...">
                                @error('year_start')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Daftar Tahun Akademik -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="p-4 border-b border-gray-200">
                        <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
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
                                            Nama Tahun Akademik</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kode Tahun Akademik</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Semester Perkuliahan</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($taka as $key => $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">{{ ++$key }}</td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->name }}</td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->code }}</td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->semester }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">
                                                @if ($item->is_active === 0)
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Tidak
                                                        Aktif</span>
                                                @elseif($item->is_active === 1)
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Aktif</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">
                                                <div class="flex justify-center items-center space-x-2">
                                                    <button type="button"
                                                        class="inline-flex items-center justify-center p-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                                                        onclick="openModal('updateTaka{{ $item->code }}')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $item->code }}"
                                                        action="{{ route($prefix . 'master.taka-destroy', $item->code) }}"
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

    <!-- Modal Edit Tahun Akademik -->
    @foreach ($taka as $item)
        <div id="updateTaka{{ $item->code }}"
            class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
                <form action="{{ route($prefix . 'master.taka-update', $item->code) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                        <h4 class="text-lg font-semibold text-gray-800">Edit Tahun Akademik - {{ $item->name }}</h4>
                        <div class="flex space-x-2">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="button"
                                class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                                onclick="closeModal('updateTaka{{ $item->code }}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Tahun
                                Akademik</label>
                            <input type="text"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                name="name" id="name" placeholder="Inputkan nama tahun akademik..."
                                value="{{ $item->name }}">
                            @error('name')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="code" class="block text-sm font-medium text-gray-700">Kode Fakultas ( 6 Angka
                                )</label>
                            <input type="text"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                name="code" id="code" placeholder="Inputkan kode tahun akademik..."
                                maxlength="6" uppercase onkeydown="return /[a-zA-Z0-9]/i.test(event.key)"
                                value="{{ $item->code }}">
                            @error('code')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="semester" class="block text-sm font-medium text-gray-700">Semester
                                Perkuliahan</label>
                            <input type="number"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                name="semester" id="semester" placeholder="Inputkan semester perkuliahan..."
                                value="{{ $item->raw_semester }}" min="1" max="20">
                            @error('semester')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="year_start" class="block text-sm font-medium text-gray-700">Pilih Tahun
                                Masuk</label>
                            <input type="number"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                name="year_start" id="year_start" min="2000" max="2100" maxlength="4"
                                value="{{ $item->year_start }}" placeholder="Inputkan tahun masuk...">
                            @error('year_start')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="is_active" class="block text-sm font-medium text-gray-700">Status Tahun
                                Akademik</label>
                            <select name="is_active" id="is_active"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                <option value="0" {{ $item->is_active === 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="1" {{ $item->is_active === 1 ? 'selected' : '' }}>Aktif</option>
                            </select>
                            @error('is_active')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
@section('custom-js')
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
            const modals = document.querySelectorAll('[id^="updateTaka"]');
            modals.forEach(function(modal) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
    </script>
@endsection
