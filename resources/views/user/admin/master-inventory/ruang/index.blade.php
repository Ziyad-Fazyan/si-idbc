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
    <section>
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="mb-6 flex justify-end">
                <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-ruang'})"
                    class="inline-flex items-center px-4 py-2 bg-[#0C6E71] hover:bg-purple-700 text-white text-sm font-medium rounded-md transition-colors duration-200"
                    aria-label="Tambah ruang baru">
                    <i class="fas fa-fw fa-plus mr-2"></i>
                    Tambah Data
                </button>
            </div>

            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Gedung
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Ruangan
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kode Ruangan
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($ruang as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->name . ' - Lantai ' . $item->floor }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->type . ' - ' . $item->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 py-1 bg-gray-100 rounded-md">
                                            {{ $item->code }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <button onclick="openModal('modal-{{ $item->code }}')"
                                                class="text-blue-600 hover:text-blue-900 cursor-pointer transition-colors duration-200 p-1 rounded hover:bg-blue-50"
                                                aria-label="Edit ruang {{ $item->name }}">
                                                <i class="fas fa-fw fa-edit"></i>
                                            </button>

                                            <form action="{{ route($prefix . 'inventory.ruang-destroy', $item->code) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200 p-1 rounded hover:bg-red-50"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus ruang ini?')"
                                                    aria-label="Hapus ruang {{ $item->name }}">
                                                    <i class="fas fa-fw fa-trash-alt"></i>
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

    <x-modal name="create-ruang" title="Tambah Data Ruang">
        @include('user.admin.master-inventory.ruang.modal.create')
    </x-modal>

    @include('user.admin.master-inventory.ruang.modal.edit')
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
