@extends('base.base-dash-index')

@section('title')
    Data Master Perolehan - Siakad By Internal Developer
@endsection

@section('menu')
    Data Master Perolehan
@endsection

@section('submenu')
    Daftar Data Perolehan
@endsection

@section('submenu0')
    Tambah Data Perolehan
@endsection

@section('urlmenu')
    #
@endsection

@section('subdesc')
    Halaman untuk mengelola Data Perolehan
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <div class="mb-6 flex justify-end">
            <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-perolehan'})"
                class="inline-flex items-center px-4 py-2 bg-[#0C6E71] hover:bg-purple-700 text-white text-sm font-medium rounded-md transition-colors duration-200"
                aria-label="Tambah data perolehan baru">
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
                                Nama Perolehan
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($commodityAcquisitions as $commodityAcquisition)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $commodityAcquisition->name }}
                                        </span>
                                        <span class="text-xs text-gray-500 mt-1">
                                            <span class="inline-flex items-center">
                                                <i class="fa fa-fw fa-calendar mr-1 text-blue-500"></i>
                                                {{ $commodityAcquisition->created_at->format('d/m/Y') }}
                                            </span>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ Str::limit($commodityAcquisition->description ?? 'Tidak ada deskripsi', 55, '...') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button type="button" x-data
                                            @click="showDetail({{ $commodityAcquisition->id }})"
                                            class="text-blue-600 hover:text-blue-900 cursor-pointer transition-colors duration-200 p-1 rounded hover:bg-blue-50"
                                            aria-label="Lihat detail perolehan {{ $commodityAcquisition->name }}">
                                            <i class="fas fa-fw fa-search"></i>
                                        </button>

                                        <button type="button" x-data
                                            @click="editPerolehan({{ $commodityAcquisition->id }})"
                                            class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50 transition-colors"
                                            aria-label="Edit perolehan {{ $commodityAcquisition->name }}">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </button>

                                        <form
                                            action="{{ route($prefix . 'inventory.perolehan-destroy', $commodityAcquisition) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200 p-1 rounded hover:bg-red-50"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus perolehan ini?')"
                                                aria-label="Hapus perolehan {{ $commodityAcquisition->name }}">
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

    <x-modal name="create-perolehan" maxWidth="2xl">
        @include('user.admin.master-inventory.commodity-acquisitions.modal.create')
    </x-modal>

    <x-modal name="show-perolehan" maxWidth="4xl" :scrollable="true">
        @include('user.admin.master-inventory.commodity-acquisitions.modal.show')
    </x-modal>

    <x-modal name="edit-perolehan" maxWidth="4xl" :scrollable="true">
        @include('user.admin.master-inventory.commodity-acquisitions.modal.edit')
    </x-modal>

    @push('scripts')
        <script>
            // Global functions untuk Alpine.js
            window.showDetail = async function(id) {
                try {
                    // Buka modal dengan loading state
                    openModal('show-perolehan');
                    showLoadingState('show');

                    const response = await fetch(`{{ route($prefix . 'inventory.perolehan-show', ['id' => ':id']) }}`
                        .replace(':id', id));
                    if (!response.ok) throw new Error('Network response was not ok');
                    const data = await response.json();

                    // Update modal content
                    document.getElementById('show_name').textContent = data.name || '-';
                    document.getElementById('show_description').textContent = data.description || 'Tidak ada deskripsi';
                    document.getElementById('show_created_at').textContent = data.created_at ? new Date(data.created_at)
                        .toLocaleDateString('id-ID') : '-';

                    hideLoadingState('show');
                } catch (error) {
                    console.error('Error:', error);
                    hideLoadingState('show');
                    showError('Terjadi kesalahan saat mengambil data');
                }
            };

            window.editPerolehan = async function(id) {
                try {
                    // Buka modal dengan loading state
                    openModal('edit-perolehan');
                    showLoadingState('edit');

                    const response = await fetch(`{{ route($prefix . 'inventory.perolehan-show', ['id' => ':id']) }}`
                        .replace(':id', id));
                    if (!response.ok) throw new Error('Network response was not ok');
                    const data = await response.json();

                    // Update form fields
                    document.getElementById('edit_name').value = data.name || '';
                    document.getElementById('edit_description').value = data.description || '';

                    // Update form action
                    const form = document.querySelector('#edit_perolehan form');
                    if (form) {
                        form.action = `{{ route($prefix . 'inventory.perolehan-update', ['code' => ':id']) }}`.replace(
                            ':id', id);
                    }

                    hideLoadingState('edit');
                } catch (error) {
                    console.error('Error:', error);
                    hideLoadingState('edit');
                    showError('Terjadi kesalahan saat mengambil data');
                }
            };

            // Helper functions
            function openModal(modalName) {
                // Trigger Alpine.js modal
                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: {
                        name: modalName
                    }
                }));
            }

            function showLoadingState(modalType) {
                const loadingElement = document.getElementById(`loading-${modalType}`);
                const contentElement = document.getElementById(`content-${modalType}`);

                if (loadingElement) {
                    loadingElement.classList.remove('hidden');
                }
                if (contentElement) {
                    contentElement.classList.add('hidden');
                }
            }

            function hideLoadingState(modalType) {
                const loadingElement = document.getElementById(`loading-${modalType}`);
                const contentElement = document.getElementById(`content-${modalType}`);

                if (loadingElement) {
                    loadingElement.classList.add('hidden');
                }
                if (contentElement) {
                    contentElement.classList.remove('hidden');
                }
            }

            function showError(message) {
                // Bisa diganti dengan library notifikasi yang lebih baik
                alert(message);
            }

            // Initialize when DOM is loaded
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Commodity acquisition management system initialized');
            });
        </script>
    @endpush
@endsection
