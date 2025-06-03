@extends('base.base-dash-index')
@section('title')
    Data Postingan - Siakad By Internal Developer
@endsection
@section('menu')
    Data Postingan
@endsection
@section('submenu')
    Daftar Postingan
@endsection
@section('submenu0')
    Tambah Postingan
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Postingan
@endsection
@section('content')
    <section class="py-6">
        <div class="w-full">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <h5 class="text-xl font-semibold text-gray-800">@yield('submenu')</h5>
                    <div>
                        <a href="{{ route('web-admin.news.post-create') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-[#0C6E71] hover:bg-[#095456] text-white rounded-md transition-colors duration-200">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left" id="postsTable">
                            <thead class="text-xs uppercase bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-center">#</th>
                                    <th class="px-4 py-3 text-center">Kategori Post</th>
                                    <th class="px-4 py-3 text-center">Judul Post</th>
                                    <th class="px-4 py-3 text-center">Slug Post</th>
                                    <th class="px-4 py-3 text-center">Created At</th>
                                    <th class="px-4 py-3 text-center">Button</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $key => $item)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 text-center">{{ ++$key }}</td>
                                        <td class="px-4 py-3 text-center">{{ $item->category->name }}</td>
                                        <td class="px-4 py-3 text-center">{{ $item->name }}</td>
                                        <td class="px-4 py-3 text-center">{{ $item->slug }}</td>
                                        <td class="px-4 py-3 text-center">{{ $item->created_at->diffForHumans() }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-center items-center">
                                                <a href="{{ route('web-admin.news.post-view', $item->code) }}"
                                                    class="mr-2 px-3 py-1 border border-[#0C6E71] text-[#0C6E71] hover:bg-[#0C6E71] hover:text-white rounded transition-colors duration-200">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                    class="px-3 py-1 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded transition-colors duration-200"
                                                    onclick="openDeleteModal('{{ $item->slug }}', '{{ $item->name }}')">
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
            <div class="text-center">
                <svg class="mx-auto mb-4 text-red-500 w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-5">Konfirmasi Hapus</h3>
                <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus postingan <span id="deleteItemName"
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
            if (document.getElementById('postsTable')) {
                new simpleDatatables.DataTable("#postsTable", {
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

        // Delete Modal Functions
        function openDeleteModal(slug, name) {
            const modal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            const deleteItemName = document.getElementById('deleteItemName');

            deleteForm.action = "{{ route($prefix . 'news.post-destroy', ':slug') }}".replace(':slug', slug);
            deleteItemName.textContent = name;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
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
