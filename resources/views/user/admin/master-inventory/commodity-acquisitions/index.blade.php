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
    <div class="container mx-auto p-4">
        <!-- Header dan Tombol Tambah -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Perolehan</h1>
            <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-perolehan'})"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors"
                aria-label="Tambah data perolehan baru">
                <i class="fas fa-fw fa-plus mr-2"></i>
                Tambah Data
            </button>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($commodityAcquisitions as $commodityAcquisition)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $commodityAcquisition->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ Str::limit($commodityAcquisition->description, 55, '...') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button type="button" data-action="show-detail"
                                            data-id="{{ $commodityAcquisition->id }}"
                                            class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50 transition-colors"
                                            aria-label="Lihat detail perolehan {{ $commodityAcquisition->name }}">
                                            <i class="fas fa-fw fa-search"></i>
                                            <span class="sr-only md:not-sr-only">Detail</span>
                                        </button>
                                        <button type="button" data-action="edit-perolehan"
                                            data-id="{{ $commodityAcquisition->id }}"
                                            class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50 transition-colors"
                                            aria-label="Edit perolehan {{ $commodityAcquisition->name }}">
                                            <i class="fas fa-fw fa-edit"></i>
                                            <span class="sr-only md:not-sr-only">Edit</span>
                                        </button>
                                        <form
                                            action="{{ route($prefix . 'inventory.perolehan-destroy', $commodityAcquisition->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50 transition-colors"
                                                aria-label="Hapus perolehan {{ $commodityAcquisition->name }}"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-fw fa-trash-alt"></i>
                                                <span class="sr-only md:not-sr-only">Hapus</span>
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

    <x-modal name="create-perolehan">
        @include('user.admin.master-inventory.commodity-acquisitions.modal.create')
    </x-modal>

    <x-modal name="show-perolehan">
        @include('user.admin.master-inventory.commodity-acquisitions.modal.show')
    </x-modal>

    <x-modal name="edit-perolehan">
        @include('user.admin.master-inventory.commodity-acquisitions.modal.edit')
    </x-modal>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Cache DOM elements
                const elements = {
                    showName: document.getElementById('show-name'),
                    showDescription: document.getElementById('show-description'),
                    editName: document.getElementById('edit-name'),
                    editDescription: document.getElementById('edit-description'),
                    editForm: document.getElementById('edit-form'),
                    loadingShow: document.getElementById('loading-show'),
                    contentShow: document.getElementById('content-show'),
                    loadingEdit: document.getElementById('loading-edit'),
                    contentEdit: document.getElementById('content-edit')
                };

                // Utility functions
                async function fetchPerolehanData(id) {
                    const response = await fetch(
                        `{{ route($prefix . 'inventory.perolehan-show', ['id' => ':id']) }}`.replace(':id', id));
                    if (!response.ok) throw new Error(`HTTP ${response.status}`);
                    return await response.json();
                }

                function openModal(modalName) {
                    window.dispatchEvent(new CustomEvent('open-modal', {
                        detail: {
                            name: modalName
                        }
                    }));
                }

                function showLoading(modalType) {
                    if (modalType === 'show') {
                        elements.loadingShow.classList.remove('hidden');
                        elements.contentShow.classList.add('hidden');
                    } else {
                        elements.loadingEdit.classList.remove('hidden');
                        elements.contentEdit.classList.add('hidden');
                    }
                }

                function hideLoading(modalType) {
                    if (modalType === 'show') {
                        elements.loadingShow.classList.add('hidden');
                        elements.contentShow.classList.remove('hidden');
                    } else {
                        elements.loadingEdit.classList.add('hidden');
                        elements.contentEdit.classList.remove('hidden');
                    }
                }

                async function handleShowDetail(id) {
                    try {
                        showLoading('show');
                        openModal('show-perolehan');

                        const data = await fetchPerolehanData(id);
                        elements.showName.textContent = data.name;
                        elements.showDescription.textContent = data.description || 'Tidak ada deskripsi';

                        hideLoading('show');
                    } catch (error) {
                        console.error('Error showing detail:', error);
                        hideLoading('show');
                        alert('Gagal mengambil detail data');
                    }
                }

                async function handleEditPerolehan(id) {
                    try {
                        showLoading('edit');
                        openModal('edit-perolehan');

                        const data = await fetchPerolehanData(id);
                        elements.editName.value = data.name;
                        elements.editDescription.value = data.description || '';
                        elements.editForm.action =
                            `{{ route($prefix . 'inventory.perolehan-update', ['code' => ':id']) }}`.replace(':id',
                                id);

                        hideLoading('edit');
                    } catch (error) {
                        console.error('Error loading edit data:', error);
                        hideLoading('edit');
                        alert('Gagal mengambil data untuk edit');
                    }
                }

                // Event delegation
                document.addEventListener('click', async function(e) {
                    const button = e.target.closest('[data-action]');
                    if (!button) return;

                    const action = button.getAttribute('data-action');
                    const id = button.getAttribute('data-id');

                    switch (action) {
                        case 'show-detail':
                            await handleShowDetail(id);
                            break;
                        case 'edit-perolehan':
                            await handleEditPerolehan(id);
                            break;
                    }
                });
            });
        </script>
    @endpush
@endsection
