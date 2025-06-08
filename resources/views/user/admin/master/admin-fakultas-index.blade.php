@extends('base.base-dash-index')
@section('title')
    Data Master Fakultas - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Fakultas
@endsection
@section('submenu')
    Daftar Data Fakultas
@endsection
@section('submenu0')
    Tambah Data Fakultas
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Fakultas
@endsection
@section('content')
    <section class="w-full p-4">
        {{-- Container utama untuk seluruh konten --}}
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            {{-- Header Panel dengan judul dan tombol aksi --}}
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                <div>
                    {{-- Tombol Tambah Data Fakultas, menggunakan x-data dan open-modal dari Alpine.js --}}
                    <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-fakultas'})"
                        class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                        aria-label="Tambah data fakultas baru">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
            {{-- Isi Tabel Daftar Fakultas --}}
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
                                    Nama Fakultas</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kode Fakultas</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kepala Fakultas</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($fakultas as $key => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ ++$key }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->name }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->code }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">
                                        {{ $item->head->dsn_name }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">
                                        <div class="flex justify-center items-center space-x-2">
                                            {{-- Tombol Edit --}}
                                            <button type="button"
                                                class="inline-flex items-center justify-center p-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                                                onclick="openModal('updateFakultas{{ $item->code }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            {{-- Form Tombol Hapus --}}
                                            <form id="delete-form-{{ $item->code }}"
                                                action="{{ route($prefix . 'master.fakultas-destroy', $item->code) }}"
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

    @include('user.admin.master.modal.fakultas-edit')

    <x-modal name="create-fakultas">
        @include('user.admin.master.modal.fakultas-create')
    </x-modal>

    @push('scripts')
        <script>
            // Fungsi untuk membuka modal. Menghapus kelas 'hidden' dan menambahkan 'overflow-hidden' ke body.
            function openModal(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            // Fungsi untuk menutup modal. Menambahkan kembali kelas 'hidden' dan menghapus 'overflow-hidden' dari body.
            function closeModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            // Fungsi konfirmasi penghapusan data. Akan menjalankan form DELETE jika dikonfirmasi.
            function deleteData(id) {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    document.getElementById('delete-form-' + id).submit();
                }
            }

            // Menutup modal saat mengklik di luar area modal.
            document.addEventListener('click', function(event) {
                // Mendapatkan semua modal yang memiliki ID yang diawali dengan "updateFakultas"
                const modals = document.querySelectorAll('[id^="updateFakultas"]');
                modals.forEach(function(modal) {
                    // Jika target klik adalah modal itu sendiri (yaitu, di luar konten modal tetapi di dalam area modal overlay)
                    if (event.target === modal) {
                        modal.classList.add('hidden'); // Sembunyikan modal
                        document.body.classList.remove('overflow-hidden'); // Kembalikan scroll body
                    }
                });
            });
        </script>
    @endpush
@endsection
