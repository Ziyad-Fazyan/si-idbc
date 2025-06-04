@extends('base.base-dash-index')
@section('title')
    Manajemen Gedung - Siakad By Internal Developer
@endsection
@section('menu')
    Manajemen Gedung
@endsection
@section('submenu')
    Daftar Gedung
@endsection
@section('submenu0')
    Tambah Gedung Baru
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Gedung
@endsection
@section('content')
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <div class="mb-6 flex justify-end">
            <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-gedung'})"
                class="inline-flex items-center px-3 py-2 bg-[#0C6E71] hover:bg-purple-700 text-white text-sm font-medium rounded-md transition-colors duration-200"
                aria-label="Tambah gedung baru">
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
                                Kode Gedung
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($gedung as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $item->name }}
                                        </span>
                                        <span class="text-xs text-gray-500 mt-1">
                                            <span class="inline-flex items-center">
                                                <i class="fa fa-fw fa-calendar mr-1 text-blue-500"></i>
                                                {{ $item->updated_at->format('d/m/Y') }}
                                            </span>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="px-2 py-1 bg-gray-100 rounded-md">
                                        {{ $item->code }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button type="button" onclick="openModal('modal-edit-{{ $item->code }}')"
                                            class="text-blue-600 hover:text-blue-900 cursor-pointer transition-colors duration-200 p-1 rounded hover:bg-blue-50"
                                            aria-label="Edit gedung {{ $item->name }}">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </button>

                                        <form action="{{ route($prefix . 'inventory.gedung-destroy', $item->code) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200 p-1 rounded hover:bg-red-50"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus gedung ini?')"
                                                aria-label="Hapus gedung {{ $item->name }}">
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

        <!-- Pagination -->
        <div class="px-6 py-4">
            {{ $gedung->links() }}
        </div>
    </div>

    <!-- Create Building Modal -->
    <x-modal name="create-gedung" maxWidth="2xl">
        @include('user.admin.master-inventory.gedung.modal.create')
    </x-modal>

    <!-- Edit Modals -->
    @include('user.admin.master-inventory.gedung.modal.edit')

    @push('scripts')
        <script>
            // Modal functions
            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            }

            // Close modal when clicking outside content
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('modal-overlay')) {
                    const modal = event.target.closest('.modal');
                    if (modal) {
                        closeModal(modal.id);
                    }
                }
            });
        </script>
    @endpush
@endsection
