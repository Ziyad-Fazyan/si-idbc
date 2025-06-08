@extends('base.base-dash-index')
@section('title')
    Data Master Program Kuliah - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Program Kuliah
@endsection
@section('submenu')
    Daftar Data Program Kuliah
@endsection
@section('submenu0')
    Tambah Data Program Kuliah
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Program Kuliah
@endsection
@section('content')
    <section class="w-full p-4">
        {{-- Container utama untuk seluruh konten --}}
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            {{-- Header Panel dengan judul dan tombol aksi --}}
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                <div>
                    {{-- Tombol Tambah Data Program Kuliah, menggunakan x-data dan open-modal dari Alpine.js --}}
                    <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-proku'})"
                        class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                        aria-label="Tambah data program kuliah baru"> {{-- Perbaiki aria-label --}}
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>

            {{-- Isi Tabel Daftar Program Kuliah --}}
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
                                    Program Kuliah</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Program Studi</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Periode Pendaftaran</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($proku as $key => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ ++$key }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->name }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">
                                        {{ $item->pstudi->name }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($item->wave_start)->locale('id')->isoFormat('LL') . ' - ' . \Carbon\Carbon::parse($item->wave_ended)->locale('id')->isoFormat('LL') }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">
                                        <div class="flex justify-center items-center space-x-2">
                                            <button type="button"
                                                class="inline-flex items-center justify-center p-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                                                onclick="openModal('updateProku{{ $item->code }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form id="delete-form-{{ $item->code }}"
                                                action="{{ route($prefix . 'master.proku-destroy', $item->code) }}"
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

    @include('user.admin.master.modal.proku-edit')

    <x-modal name="create-proku">
        @include('user.admin.master.modal.proku-create')
    </x-modal>
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
        function deleteData(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('[id^="updateProku"]');
            modals.forEach(function(modal) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
    </script>
@endpush
