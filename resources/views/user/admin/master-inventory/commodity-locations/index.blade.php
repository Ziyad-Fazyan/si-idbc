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
            <button type="button" class="btn btn-primary">
                <i class="fas fa-fw fa-upload mr-2"></i>
                Import Excel
            </button>

            <button type="button" class="btn btn-secondary">
                <i class="fas fa-fw fa-download mr-2"></i>
                Export
            </button>

            <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-lokasi'})" class="btn btn-success">
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
                                            class="text-blue-600 hover:text-blue-900 transition-colors">
                                            <i class="fas fa-fw fa-search"></i>
                                        </button>
                                        <button type="button" data-action="show-edit"
                                            data-id="{{ $commodity_location->id }}"
                                            class="text-yellow-600 hover:text-yellow-900 transition-colors">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </button>
                                        <form
                                            action="{{ route($prefix . 'inventory.lokasi-destroy', $commodity_location->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition-colors"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Detail functionality
            const detailButtons = document.querySelectorAll('[data-action="show-detail"]');
            const editButtons = document.querySelectorAll('[data-action="show-edit"]');
            detailButtons.forEach(button => {
                button.addEventListener('click', async function() {
                    const id = this.getAttribute('data-id');
                    try {
                        const response = await fetch(
                            `{{ url('/web-admin/inventory/data-lokasi/') }}/${id}/show`);
                        if (!response.ok) throw new Error('Network response was not ok');
                        const data = await response.json();

                        // Update modal content
                        document.getElementById('show-name').textContent = data.name;
                        document.getElementById('show-description').textContent = data
                            .description || 'Tidak ada deskripsi';

                        // Open modal
                        window.dispatchEvent(new CustomEvent('open-modal', {
                            detail: {
                                name: 'show-lokasi'
                            }
                        }));
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengambil data');
                    }
                });
            });

            // Edit functionality
            editButtons.forEach(button => {
                button.addEventListener('click', async function() {
                    const id = this.getAttribute('data-id');
                    try {
                        const response = await fetch(
                            `{{ url('/web-admin/inventory/data-lokasi/') }}/${id}/show`);
                        if (!response.ok) throw new Error('Network response was not ok');
                        const data = await response.json();

                        // Update modal content
                        document.getElementById('edit-name').value = data.name;
                        document.getElementById('edit-description').value = data.description || '';

                        // Update form action URL
                        document.getElementById('edit-form').action =
                            `{{ url('/web-admin/inventory/data-lokasi/') }}/${id}/update`;

                        // Open modal
                        window.dispatchEvent(new CustomEvent('open-modal', {
                            detail: {
                                name: 'edit-lokasi'
                            }
                        }));
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengambil data');
                    }
                });
            });
        });
    </script>
@endpush
