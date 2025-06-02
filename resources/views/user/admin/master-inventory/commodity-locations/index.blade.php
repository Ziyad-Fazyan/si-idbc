@extends('base.base-dash-index')
@section('title')
    Data Master Lokasi - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Lokasi
@endsection
@section('submenu')
    Daftar Data Lokasi
@endsection
@section('submenu0')
    Tambah Data Lokasi
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Lokasi
@endsection
@section('content')
    <div class="flex flex-col space-y-6">
        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-4">
            <button type="button" class="btn btn-primary" aria-label="Import data dari Excel">
                <i class="fas fa-fw fa-upload mr-2"></i>
                Import Excel
            </button>

            <button type="button" class="btn btn-secondary" aria-label="Export data ke Excel">
                <i class="fas fa-fw fa-download mr-2"></i>
                Export
            </button>

            <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-lokasi'})" class="btn btn-success" aria-label="Tambah data lokasi baru">
                <i class="fas fa-fw fa-plus mr-2"></i>
                Tambah Data
            </button>
        </div>

        <!-- Table -->
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
                        @foreach ($commodityLocations as $commodity_location)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $commodity_location->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ Str::limit($commodity_location->description, 55, '...') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button type="button" data-action="show-detail"
                                            data-id="{{ $commodity_location->id }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors"
                                            aria-label="Lihat detail lokasi {{ $commodity_location->name }}">
                                            <i class="fas fa-fw fa-search"></i>
                                        </button>
                                        <button type="button" data-action="edit-lokasi"
                                            data-id="{{ $commodity_location->id }}"
                                            class="text-yellow-600 hover:text-yellow-900 transition-colors"
                                            aria-label="Edit lokasi {{ $commodity_location->name }}">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </button>
                                        <form
                                            action="{{ route($prefix . 'inventory.lokasi-destroy', $commodity_location->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition-colors"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                aria-label="Hapus lokasi {{ $commodity_location->name }}">
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

    <x-modal name="create-lokasi">
        @include('user.admin.master-inventory.commodity-locations.modal.create')
    </x-modal>

    <x-modal name="show-lokasi">
        @include('user.admin.master-inventory.commodity-locations.modal.show')
    </x-modal>

    <x-modal name="edit-lokasi">
        @include('user.admin.master-inventory.commodity-locations.modal.edit')
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
                const response = await fetch(`{{ route($prefix . 'inventory.lokasi-show', ['id' => ':id']) }}`.replace(':id', id));
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
                    openModal('show-lokasi');

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
                    openModal('edit-lokasi');

                    const data = await fetchPerolehanData(id);
                    elements.editName.value = data.name;
                    elements.editDescription.value = data.description || '';
                    elements.editForm.action = `{{ route($prefix . 'inventory.lokasi-update', ['code' => ':id']) }}`.replace(':id', id);

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
                    case 'edit-lokasi':
                        await handleEditPerolehan(id);
                        break;
                }
            });
        });
    </script>
    @endpush
@endsection

