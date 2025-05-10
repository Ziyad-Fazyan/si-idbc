@extends('base.base-dash-index')
@section('title')
    Data Kategori Berita - Siakad By Internal Developer
@endsection
@section('menu')
    Data Kategori Berita
@endsection
@section('submenu')
    Daftar Kategori Berita
@endsection
@section('submenu0')
    Tambah Kategori Berita
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Kategori Berita
@endsection
@section('content')
    <section class="py-6">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Form tambah kategori -->
            <div class="w-full lg:w-1/3">
                <form action="{{ route($prefix . 'news.category-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                            <h5 class="text-lg font-semibold text-gray-800">@yield('submenu0')</h5>
                            <button type="submit"
                                class="inline-flex items-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] hover:bg-[#0C6E71] hover:text-white rounded transition-colors duration-200">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <div class="p-6">
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Kategori</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    name="name" id="name" placeholder="Inputkan nama kategori berita...">
                                @error('name')
                                    <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                                    Kategori Berita</label>
                                <textarea name="desc" id="desc"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    placeholder="Inputkan Deskripsi Kategori Berita" rows="4"></textarea>
                                @error('desc')
                                    <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel kategori -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="categoryTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        #</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Kategori</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kode</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Slug</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deskripsi</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Button</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($category as $key => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-center text-sm">{{ ++$key }}</td>
                                        <td class="px-4 py-3 text-center text-sm">{{ $item->name }}</td>
                                        <td class="px-4 py-3 text-center text-sm">{{ $item->code }}</td>
                                        <td class="px-4 py-3 text-center text-sm">{{ $item->slug }}</td>
                                        <td class="px-4 py-3 text-center text-sm">{{ $item->desc }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex justify-center items-center">
                                                <button type="button" onclick="openEditModal('{{ $item->code }}')"
                                                    class="mr-2 px-3 py-1 border border-[#0C6E71] text-[#0C6E71] hover:bg-[#0C6E71] hover:text-white rounded transition-colors duration-200">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button"
                                                    onclick="openDeleteModal('{{ $item->code }}', '{{ $item->name }}')"
                                                    class="px-3 py-1 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded transition-colors duration-200">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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

    <!-- Edit Modals -->
    @foreach ($category as $item)
        <div id="editModal{{ $item->code }}"
            class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4 overflow-hidden">
                <form action="{{ route($prefix . 'news.category-update', $item->code) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf

                    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800">Edit {{ $item->name }}</h4>
                        <div class="flex space-x-2">
                            <button type="submit"
                                class="px-3 py-1 border border-[#0C6E71] text-[#0C6E71] hover:bg-[#0C6E71] hover:text-white rounded transition-colors duration-200">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="button" onclick="closeEditModal('{{ $item->code }}')"
                                class="px-3 py-1 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded transition-colors duration-200">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="mb-4">
                            <label for="edit_name{{ $item->code }}"
                                class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                            <input type="text"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                name="name" id="edit_name{{ $item->code }}" value="{{ $item->name }}"
                                placeholder="Inputkan nama kategori berita...">
                            @error('name')
                                <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="edit_desc{{ $item->code }}"
                                class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kategori Berita</label>
                            <textarea name="desc" id="edit_desc{{ $item->code }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                placeholder="Inputkan Deskripsi Kategori Berita" rows="4">{{ $item->desc }}</textarea>
                            @error('desc')
                                <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full mx-4">
            <div class="text-center">
                <svg class="mx-auto mb-4 text-red-500 w-12 h-12" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-5">Konfirmasi Hapus</h3>
                <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus kategori <span id="deleteItemName"
                        class="font-semibold"></span>?</p>
                <div class="flex justify-center space-x-4">
                    <button type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors duration-200"
                        onclick="closeDeleteModal()">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors duration-200">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable with Tailwind styling
            if (document.getElementById('categoryTable')) {
                new simpleDatatables.DataTable("#categoryTable", {
                    searchable: true,
                    fixedHeight: true,
                    perPage: 10,
                    labels: {
                        placeholder: "Cari...",
                        perPage: "{select} entri per halaman",
                        noRows: "Tidak ada data untuk ditampilkan",
                        info: "Menampilkan {start} sampai {end} dari {rows} entri",
                    }
                });
            }
        });

        // Edit Modal Functions
        function openEditModal(code) {
            const modal = document.getElementById('editModal' + code);
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeEditModal(code) {
            const modal = document.getElementById('editModal' + code);
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        // Delete Modal Functions
        function openDeleteModal(code, name) {
            const modal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            const deleteItemName = document.getElementById('deleteItemName');

            deleteForm.action = "{{ route($prefix . 'news.category-destroy', '') }}/" + code;
            deleteItemName.textContent = name;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            const editModals = document.querySelectorAll('[id^="editModal"]');
            editModals.forEach(function(modal) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });

            const deleteModal = document.getElementById('deleteModal');
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Custom Styling for DataTables */
        .dataTables_wrapper .dataTables_length select {
            @apply px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71];
        }

        .dataTables_wrapper .dataTables_filter input {
            @apply px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71];
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-[#0C6E71] text-white border-[#0C6E71];
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
            @apply bg-gray-100 text-[#0C6E71] border-gray-200;
        }
    </style>
@endpush
