@extends('base.base-dash-index')
@section('menu')
    Pengumuman
@endsection
@section('submenu')
    Daftar Pengumuman
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Pengumuman
@endsection
@section('content')
    <section class="flex flex-col md:flex-row gap-4">
        <div class="w-full md:w-1/3">
            <div class="bg-white rounded-lg shadow-md">
                <form action="{{ route($prefix . 'system.notify-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                        <h4 class="text-lg font-medium">Tambah @yield('menu')</h4>
                        <button type="submit"
                            class="bg-[#0C6E71] hover:bg-[#095254] text-white px-3 py-2 rounded-md transition duration-300">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                    <div class="p-6">

                        <div class="mb-4">
                            <label for="absen_type" class="block text-sm font-medium text-gray-700 mb-1">Target
                                Notifikasi</label>
                            <select name="absen_type" id="absen_type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                <optgroup label="Absen Harian">
                                    <option value="" selected>Pilih Target Notifikasi</option>
                                    <option value="0">Semua Orang</option>
                                    <option value="1">Khusus Staff / Pegawai</option>
                                    <option value="2">Khusus Dosen</option>
                                    <option value="3">Khusus Mahasiswa</option>
                                </optgroup>
                            </select>
                            @error('send_to')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Judul
                                Notifikasi</label>
                            <input type="text" name="name" id="name"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50"
                                placeholder="Inputkan judul notifikasi...">
                            @error('name')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Kategori
                                Notifikasi</label>
                            <input type="text" name="type" id="type"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50"
                                placeholder="Inputkan kategori notifikasi...">
                            @error('type')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Pesan
                                Notifikasi</label>
                            <textarea name="desc" id="dark"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50"
                                cols="30" rows="10" placeholder="Inputkan pesan notifikasi"></textarea>
                            @error('desc')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full md:w-2/3">
            <div class="bg-white rounded-lg shadow-md">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-medium">@yield('menu')</h4>
                </div>
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="notifyTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul Notifikasi</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Author</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($notify as $key => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center whitespace-nowrap">{{ ++$key }}</td>
                                    <td class="px-4 py-3 text-center">{{ $item->name }}</td>
                                    <td class="px-4 py-3 text-center">{{ $item->type }}</td>
                                    <td class="px-4 py-3 text-center">{{ $item->author->name }}</td>
                                    <td class="px-4 py-3 flex justify-center items-center space-x-2">
                                        <button type="button"
                                            class="px-2 py-1 border border-[#0C6E71] text-[#0C6E71] hover:bg-[#0C6E71] hover:text-white rounded-md transition duration-300"
                                            onclick="openEditModal('{{ $item->code }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form id="delete-form-{{ $item->code }}"
                                            action="{{ route($prefix . 'system.notify-destroy', $item->code) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="px-2 py-1 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition duration-300"
                                                onclick="deleteData('{{ $item->code }}', '{{ $item->name }}')">
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

    <!-- Modal containers -->
    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden items-center justify-center">
        @foreach ($notify as $item)
            <div id="editModal-{{ $item->code }}" class="hidden">
                <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full mx-4">
                    <form action="{{ route($prefix . 'system.notify-update', $item->code) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                            <h4 class="text-lg font-semibold">Edit Notifikasi - {{ $item->name }}</h4>
                            <div class="flex space-x-2">
                                <button type="submit"
                                    class="px-2 py-1 border border-[#0C6E71] text-[#0C6E71] hover:bg-[#0C6E71] hover:text-white rounded-md transition duration-300">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                                <button type="button"
                                    class="px-2 py-1 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition duration-300"
                                    onclick="closeEditModal('{{ $item->code }}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="mb-4">
                                <label for="edit-name-{{ $item->code }}"
                                    class="block text-sm font-medium text-gray-700 mb-1">Judul Notifikasi</label>
                                <input type="text"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50"
                                    name="name" id="edit-name-{{ $item->code }}"
                                    placeholder="Inputkan nama fakultas..." value="{{ $item->name }}">
                                @error('name')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="edit-type-{{ $item->code }}"
                                    class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <input type="text"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50"
                                    name="type" id="edit-type-{{ $item->code }}"
                                    placeholder="Inputkan kode fakultas..." value="{{ $item->type }}">
                                @error('type')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="edit-desc-{{ $item->code }}"
                                    class="block text-sm font-medium text-gray-700 mb-1">Pesan Notifikasi</label>
                                <textarea name="desc" id="edit-desc-{{ $item->code }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50"
                                    cols="30" rows="10" placeholder="Inputkan pesan notifikasi">{!! $item->desc !!}</textarea>
                                @error('desc')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize datatable jika diperlukan
            if (document.getElementById('notifyTable')) {
                // Inisialisasi datatable jika menggunakan library
            }
        });

        function openEditModal(code) {
            document.getElementById('modalOverlay').classList.remove('hidden');
            document.getElementById('modalOverlay').classList.add('flex');
            document.getElementById('editModal-' + code).classList.remove('hidden');
            document.getElementById('editModal-' + code).classList.add('block');
        }

        function closeEditModal(code) {
            document.getElementById('modalOverlay').classList.add('hidden');
            document.getElementById('modalOverlay').classList.remove('flex');
            document.getElementById('editModal-' + code).classList.add('hidden');
            document.getElementById('editModal-' + code).classList.remove('block');
        }

        function deleteData(code, name) {
            if (confirm('Apakah Anda yakin ingin menghapus notifikasi "' + name + '"?')) {
                document.getElementById('delete-form-' + code).submit();
            }
        }

        // Tutup modal jika klik di luar modal
        document.getElementById('modalOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                const modals = document.querySelectorAll('[id^="editModal-"]');
                modals.forEach(modal => {
                    modal.classList.add('hidden');
                    modal.classList.remove('block');
                });
                this.classList.add('hidden');
                this.classList.remove('flex');
            }
        });
    </script>
@endpush
