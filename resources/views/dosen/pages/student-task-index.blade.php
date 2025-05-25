@extends('base.base-dash-index')
@section('title')
    Kelola Tugas - Siakad By Internal Developer
@endsection
@section('menu')
    Kelola Tugas
@endsection
@section('submenu')
    Edit Tugas Kuliah
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat Tugas Kuliah
@endsection
@section('content')
    <section class="py-6">
        <div class="w-full px-4">
            <div class="w-full">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4 border-b">
                        <h5 class="flex justify-between items-center text-lg font-semibold text-gray-800">
                            @yield('menu')
                            <div>
                                <a href="{{ route('dosen.akademik.stask-create') }}"
                                   class="inline-flex items-center justify-center px-3 py-2 rounded-md bg-[#0C6E71] text-white hover:bg-[#095658] transition-all duration-200 ease-in-out">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                        </h5>
                    </div>
                    <div class="p-5">
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white" id="taskTable">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-center">#</th>
                                        <th class="py-3 px-6 text-center">Nama Mata Kuliah</th>
                                        <th class="py-3 px-6 text-center">Nama Kelas</th>
                                        <th class="py-3 px-6 text-center">Judul Tugas</th>
                                        <th class="py-3 px-6 text-center">Batas Akhir</th>
                                        <th class="py-3 px-6 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm">
                                    @foreach ($stask as $key => $item)
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3 px-6 text-center">{{ ++$key }}</td>
                                            <td class="py-3 px-6">
                                                <div class="flex flex-col">
                                                    <span>{{ $item->jadkul->matkul->name }}</span>
                                                    <span class="text-xs text-gray-500">{{ $item->jadkul->pert_id }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-center">{{ $item->jadkul->kelas->name }}</td>
                                            <td class="py-3 px-6">{{ $item->title }}</td>
                                            <td class="py-3 px-6 text-center">
                                                {{ \Carbon\Carbon::parse($item->exp_date)->format('d M Y') . ' - ' . \Carbon\Carbon::parse($item->exp_time)->format('H:i') }}
                                            </td>
                                            <td class="py-3 px-6">
                                                <div class="flex justify-center items-center space-x-2">
                                                    <a href="{{ route('dosen.akademik.stask-view', $item->code) }}"
                                                        class="inline-flex items-center justify-center px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition-all duration-200">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button"
                                                        class="inline-flex items-center justify-center px-2 py-1 bg-[#0C6E71] text-white rounded hover:bg-[#095658] transition-all duration-200 edit-button"
                                                        data-id="{{ $item->code }}"
                                                        data-title="{{ $item->title }}"
                                                        onclick="openEditModal('{{ $item->code }}')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="inline-flex items-center justify-center px-2 py-1 bg-[#FF6B35] text-white rounded hover:bg-[#e55e2e] transition-all duration-200"
                                                        onclick="confirmDelete('{{ $item->code }}', '{{ $item->title }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $item->code }}"
                                                        action="{{ route('dosen.akademik.stask-destroy', $item->code) }}"
                                                        method="POST" class="hidden">
                                                        @csrf
                                                        @method('DELETE')
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
        </div>
    </section>

    <!-- Modal Edit Tugas -->
    <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                Edit Tugas
                            </h3>
                            <div class="mt-2">
                                <form id="editForm" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                                        <input type="text" name="title" id="editTitle"
                                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    </div>
                                    <div>
                                        <label for="exp_date" class="block text-sm font-medium text-gray-700">Tanggal Batas Akhir</label>
                                        <input type="date" name="exp_date" id="editExpDate"
                                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    </div>
                                    <div>
                                        <label for="exp_time" class="block text-sm font-medium text-gray-700">Waktu Batas Akhir</label>
                                        <input type="time" name="exp_time" id="editExpTime"
                                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="submitEditForm()"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#0C6E71] text-base font-medium text-white hover:bg-[#095658] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71] sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button type="button" onclick="closeEditModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Konfirmasi Hapus
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="deleteMessage">
                                    Apakah Anda yakin ingin menghapus tugas ini?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmDeleteButton"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#FF6B35] text-base font-medium text-white hover:bg-[#e55e2e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Hapus
                    </button>
                    <button type="button" onclick="closeDeleteModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DataTable initialization dengan Vanilla JS
            const table = document.getElementById('taskTable');
            if (table) {
                // Tambahkan class untuk styling
                table.classList.add('stripe', 'hover');
            }

            // Jika masih ingin menggunakan DataTables, bisa uncomment code di bawah
            /*
            if ($.fn.DataTable) {
                $('#taskTable').DataTable({
                    responsive: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        zeroRecords: "Tidak ada data yang ditemukan",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        infoEmpty: "Tidak ada data yang tersedia",
                        infoFiltered: "(difilter dari _MAX_ total data)",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        }
                    }
                });
            }
            */
        });

        // Fungsi untuk modal edit
        let currentTaskId = null;

        function openEditModal(taskId) {
            currentTaskId = taskId;
            const modal = document.getElementById('editModal');
            modal.classList.remove('hidden');

            // Di sini idealnya kita mengambil data dari server
            // Untuk demo, kita hanya menggunakan data dari attribute button
            const editButton = document.querySelector(`.edit-button[data-id="${taskId}"]`);
            if (editButton) {
                const title = editButton.getAttribute('data-title');
                document.getElementById('editTitle').value = title;

                // Bisa tambahkan fetch AJAX di sini untuk mendapatkan data lengkap
                // fetch(`/api/tasks/${taskId}`).then(response => response.json()).then(data => {
                //     document.getElementById('editTitle').value = data.title;
                //     document.getElementById('editExpDate').value = data.exp_date;
                //     document.getElementById('editExpTime').value = data.exp_time;
                // });
            }
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
        }

        function submitEditForm() {
            if (!currentTaskId) return;

            const form = document.getElementById('editForm');
            form.action = `/dosen/akademik/stask/${currentTaskId}/update`; // Sesuaikan dengan route Laravel
            form.submit();
        }

        // Fungsi untuk modal konfirmasi hapus
        function confirmDelete(taskId, taskTitle) {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');

            document.getElementById('deleteMessage').textContent = `Apakah Anda yakin ingin menghapus tugas "${taskTitle}"?`;

            const confirmButton = document.getElementById('confirmDeleteButton');
            confirmButton.onclick = function() {
                document.getElementById(`delete-form-${taskId}`).submit();
            };
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }
    </script>
    @endpush
@endsection
