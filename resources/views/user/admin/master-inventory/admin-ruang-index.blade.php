@extends('base.base-dash-index')
@section('title')
    Data Master Ruang - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Ruang
@endsection
@section('submenu')
    Daftar Data Ruang
@endsection
@section('submenu0')
    Tambah Data Ruang
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Ruang
@endsection
@section('content')
    <section class="flex flex-col md:flex-row gap-4 p-4">

        <div class="w-full md:w-1/3">
            <form action="{{ route($prefix . 'inventory.ruang-store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-lg shadow-md overflow-hidden">
                @csrf
                <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                    <h5 class="text-lg font-semibold text-gray-800">@yield('submenu0')</h5>
                    <button type="submit"
                        class="bg-[#0C6E71] hover:bg-[#0a5a5d] text-white px-4 py-2 rounded-md transition duration-200">
                        <i class="fa-solid fa-paper-plane mr-1"></i> Simpan
                    </button>
                </div>
                <div class="p-4 space-y-4">
                    <div class="space-y-1">
                        <label for="gedu_id" class="block text-sm font-medium text-gray-700">Gedung</label>
                        <select name="gedu_id" id="gedu_id"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                            <option value="" selected>Pilih Gedung</option>
                            @foreach ($gedung as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('gedu_id')
                            <small class="text-red-500 text-sm">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="type" class="block text-sm font-medium text-gray-700">Type Ruang</label>
                        <select name="type" id="type"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                            <option value="" selected>Pilih Type Ruang</option>
                            <option value="0">Ruang Kelas</option>
                            <option value="1">Ruang Laboratorium</option>
                            <option value="2">Ruang Kerja</option>
                            <option value="3">Ruang Pribadi</option>
                            <option value="4">Fasilitas Umum</option>
                        </select>
                        @error('type')
                            <small class="text-red-500 text-sm">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="floor" class="block text-sm font-medium text-gray-700">Lokasi Lantai Gedung</label>
                        <input type="number"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                            name="floor" id="floor" placeholder="Ada dilantai berapa ruangan ini?...">
                        @error('floor')
                            <small class="text-red-500 text-sm">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                        <input type="text"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                            name="name" id="name" placeholder="Inputkan nama ruangan...">
                        @error('name')
                            <small class="text-red-500 text-sm">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="code" class="block text-sm font-medium text-gray-700">Kode Ruangan (5 Huruf
                            Bebas)</label>
                        <input type="text"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent uppercase"
                            name="code" id="code" placeholder="Inputkan kode ruangan..." maxlength="5"
                            onkeydown="return /[a-zA-Z0-9]/i.test(event.key)">
                        @error('code')
                            <small class="text-red-500 text-sm">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="w-full md:w-2/3">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="border-b border-gray-200 p-4">
                    <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                </div>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Gedung</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Ruangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kode Ruangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Button</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($ruang as $key => $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ++$key }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->gedung->name . ' - Lantai ' . $item->floor }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->type . ' - ' . $item->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex space-x-2">
                                        <button onclick="openModal('modal-{{ $item->code }}')"
                                            class="bg-[#0C6E71] hover:bg-[#0a5a5d] text-white px-3 py-1 rounded-md transition duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form id="delete-form-{{ $item->code }}"
                                            action="{{ route($prefix . 'inventory.ruang-destroy', $item->code) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="bg-[#FF6B35] hover:bg-[#e05a2b] text-white px-3 py-1 rounded-md transition duration-200"
                                                onclick="confirmDelete('{{ $item->code }}', '{{ $item->name }}')">
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

    <!-- Modals for Edit -->
    @foreach ($ruang as $item)
        <div id="modal-{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true"
                    onclick="closeModal('modal-{{ $item->code }}')">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route($prefix . 'inventory.ruang-update', $item->code) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="flex justify-between items-center border-b border-gray-200 pb-3">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Ruang - {{ $item->name }}
                                </h3>
                                <div class="flex space-x-2">
                                    <button type="submit"
                                        class="bg-[#0C6E71] hover:bg-[#0a5a5d] text-white px-3 py-1 rounded-md transition duration-200">
                                        <i class="fas fa-paper-plane mr-1"></i> Simpan
                                    </button>
                                    <button type="button" onclick="closeModal('modal-{{ $item->code }}')"
                                        class="bg-[#FF6B35] hover:bg-[#e05a2b] text-white px-3 py-1 rounded-md transition duration-200">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4 space-y-4">
                                <div class="space-y-1">
                                    <label for="gedu_id" class="block text-sm font-medium text-gray-700">Gedung</label>
                                    <select name="gedu_id" id="gedu_id"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                        <option value="" selected>Pilih Gedung</option>
                                        @foreach ($gedung as $gd)
                                            <option value="{{ $gd->id }}"
                                                {{ $item->gedu_id == $gd->id ? 'selected' : '' }}>{{ $gd->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gedu_id')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="space-y-1">
                                    <label for="type" class="block text-sm font-medium text-gray-700">Type
                                        Ruang</label>
                                    <select name="type" id="type"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                        <option value="" selected>Pilih Type Ruang</option>
                                        <option value="0" {{ $item->raw_type == 0 ? 'selected' : '' }}>Ruang Kelas
                                        </option>
                                        <option value="1" {{ $item->raw_type == 1 ? 'selected' : '' }}>Ruang
                                            Laboratorium</option>
                                        <option value="2" {{ $item->raw_type == 2 ? 'selected' : '' }}>Ruang Kerja
                                        </option>
                                        <option value="3" {{ $item->raw_type == 3 ? 'selected' : '' }}>Ruang Pribadi
                                        </option>
                                        <option value="4" {{ $item->raw_type == 4 ? 'selected' : '' }}>Fasilitas Umum
                                        </option>
                                    </select>
                                    @error('type')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="space-y-1">
                                    <label for="floor" class="block text-sm font-medium text-gray-700">Lokasi Lantai
                                        Gedung</label>
                                    <input type="number"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        name="floor" id="floor" value="{{ $item->floor }}"
                                        placeholder="Ada dilantai berapa ruangan ini?...">
                                    @error('floor')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="space-y-1">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama
                                        Ruangan</label>
                                    <input type="text"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        name="name" id="name" value="{{ $item->name }}"
                                        placeholder="Inputkan nama ruangan...">
                                    @error('name')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="space-y-1">
                                    <label for="code" class="block text-sm font-medium text-gray-700">Kode Ruangan (5
                                        Huruf Bebas)</label>
                                    <input type="text"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent uppercase"
                                        name="code" id="code" value="{{ $item->code }}"
                                        placeholder="Inputkan kode ruangan..." maxlength="5"
                                        onkeydown="return /[a-zA-Z0-9]/i.test(event.key)">
                                    @error('code')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

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
        function confirmDelete(code, name) {
            if (confirm(`Apakah Anda yakin ingin menghapus ruang ${name}?`)) {
                document.getElementById(`delete-form-${code}`).submit();
            }
        }
    </script>
@endpush
