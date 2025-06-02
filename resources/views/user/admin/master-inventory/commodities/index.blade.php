@extends('base.base-dash-index')
@section('title')
    Data Master Barang - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Barang
@endsection
@section('submenu')
    Daftar Data Barang
@endsection
@section('submenu0')
    Tambah Data Barang
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Barang
@endsection
@section('content')
    <!-- Statistics Cards -->
    @include('user.admin.master-inventory.commodities.partials.statistics-cards')

    <!-- Filter -->

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <!-- Action Buttons -->
            <div class="mb-6">
                <div class="flex flex-wrap gap-3">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200"
                        aria-label="Import data dari Excel">
                        <i class="fas fa-fw fa-upload mr-2"></i>
                        Import Excel
                    </button>

                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors duration-200"
                        aria-label="Export data barang">
                        <i class="fas fa-fw fa-download mr-2"></i>
                        Export
                    </button>

                    <button type="button" x-data @click="$dispatch('open-modal', {name: 'create-barang'})"
                        class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-md transition-colors duration-200"
                        aria-label="Tambah data barang baru">
                        <i class="fas fa-fw fa-plus mr-2"></i>
                        Tambah Data
                    </button>

                    <form action="{{ route($prefix . 'inventory.barang-print') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition-colors duration-200"
                            aria-label="Print semua data barang">
                            <i class="fas fa-fw fa-print mr-2"></i>
                            Print
                        </button>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kode Barang</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Barang</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bahan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Merk</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tahun Pembelian</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kondisi</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($commodities as $commodity)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <th scope="row"
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $loop->iteration }}</th>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $commodity->item_code }}
                                            </span>
                                            <span class="text-xs text-gray-500 mt-1">
                                                <span class="inline-flex items-center">
                                                    <i class="fa fa-fw far fa-face-laugh mr-1 text-blue-500"></i>
                                                    {{ $commodity->commodity_acquisition->name }}
                                                </span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ Str::limit($commodity->name, 55, '...') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $commodity->material }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $commodity->brand }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $commodity->year_of_purchase }}</td>
                                    @if ($commodity->condition === 1)
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-fw fa-check-circle mr-1"></i>
                                                Baik
                                            </span>
                                        </td>
                                    @elseif($commodity->condition === 2)
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fa fa-fw fa-exclamation-circle mr-1"></i>
                                                Kurang Baik
                                            </span>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fa fa-fw fa-times-circle mr-1"></i>
                                                Rusak Berat
                                            </span>
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <button type="button"
                                                x-data
                                                @click="showDetail({{ $commodity->id }})"
                                                class="text-blue-600 hover:text-blue-900 cursor-pointer transition-colors duration-200 p-1 rounded hover:bg-blue-50"
                                                aria-label="Lihat detail barang {{ $commodity->name }}">
                                                <i class="fas fa-fw fa-search"></i>
                                            </button>

                                            <button type="button"
                                                x-data
                                                @click="editBarang({{ $commodity->id }})"
                                                class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50 transition-colors"
                                                aria-label="Edit barang {{ $commodity->name }}">
                                                <i class="fas fa-fw fa-edit"></i>
                                            </button>

                                            <form
                                                action="{{ route($prefix . 'inventory.barang-print-individual', $commodity->id) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit"
                                                    class="text-gray-600 hover:text-gray-900 transition-colors duration-200 p-1 rounded hover:bg-gray-50"
                                                    aria-label="Print barang {{ $commodity->name }}">
                                                    <i class="fas fa-fw fa-print"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route($prefix . 'inventory.barang-destroy', $commodity) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200 p-1 rounded hover:bg-red-50"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"
                                                    aria-label="Hapus barang {{ $commodity->name }}">
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
    </div>

    <x-modal name="create-barang" maxWidth="2xl">
        @include('user.admin.master-inventory.commodities.modal.create')
    </x-modal>

    <x-modal name="show-barang" maxWidth="4xl" :scrollable="true">
        @include('user.admin.master-inventory.commodities.modal.show')
    </x-modal>

    <x-modal name="edit-barang" maxWidth="4xl" :scrollable="true">
        @include('user.admin.master-inventory.commodities.modal.edit')
    </x-modal>

    @push('scripts')
        <script>
            // Global functions untuk Alpine.js
            window.showDetail = async function(id) {
                try {
                    // Buka modal dengan loading state
                    openModal('show-barang');
                    showLoadingState('show');

                    const response = await fetch(`{{ route($prefix . 'inventory.barang-show', ['id' => ':id']) }}`.replace(':id', id));
                    if (!response.ok) throw new Error('Network response was not ok');
                    const data = await response.json();

                    // Update modal content
                    document.getElementById('show_item_code').textContent = data.item_code || '-';
                    document.getElementById('show_name').textContent = data.name || '-';
                    document.getElementById('show_location').textContent = data.commodity_location?.name || '-';
                    document.getElementById('show_material').textContent = data.material || '-';
                    document.getElementById('show_brand').textContent = data.brand || '-';
                    document.getElementById('show_year').textContent = data.year_of_purchase || '-';
                    document.getElementById('show_quantity').textContent = data.quantity || '0';
                    document.getElementById('show_acquisition').textContent = data.commodity_acquisition?.name || '-';

                    // Set condition text and style
                    const conditionElement = document.getElementById('show_condition');
                    if (data.condition === 1) {
                        conditionElement.textContent = 'Baik';
                        conditionElement.className = 'text-green-600 font-medium';
                    } else if (data.condition === 2) {
                        conditionElement.textContent = 'Kurang Baik';
                        conditionElement.className = 'text-yellow-600 font-medium';
                    } else {
                        conditionElement.textContent = 'Rusak Berat';
                        conditionElement.className = 'text-red-600 font-medium';
                    }

                    // Format currency
                    const formatCurrency = (amount) => {
                        return new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(amount || 0);
                    };

                    document.getElementById('show_price').textContent = formatCurrency(data.price);
                    document.getElementById('show_price_per_item').textContent = formatCurrency(data.price_per_item);

                    hideLoadingState('show');
                } catch (error) {
                    console.error('Error:', error);
                    hideLoadingState('show');
                    showError('Terjadi kesalahan saat mengambil data');
                }
            };

            window.editBarang = async function(id) {
                try {
                    // Buka modal dengan loading state
                    openModal('edit-barang');
                    showLoadingState('edit');

                    const response = await fetch(`{{ route($prefix . 'inventory.barang-show', ['id' => ':id']) }}`.replace(':id', id));
                    if (!response.ok) throw new Error('Network response was not ok');
                    const data = await response.json();

                    // Update form fields
                    document.getElementById('edit_item_code').value = data.item_code || '';
                    document.getElementById('edit_name').value = data.name || '';
                    document.getElementById('edit_material').value = data.material || '';
                    document.getElementById('edit_brand').value = data.brand || '';
                    document.getElementById('edit_year_of_purchase').value = data.year_of_purchase || '';
                    document.getElementById('edit_quantity').value = data.quantity || '';
                    document.getElementById('edit_price').value = data.price || '';
                    document.getElementById('edit_price_per_item').value = data.price_per_item || '';
                    document.getElementById('edit_note').value = data.note || '';

                    // Update select fields
                    document.getElementById('edit_commodity_location_id').value = data.commodity_location_id || '';
                    document.getElementById('edit_commodity_acquisition_id').value = data.commodity_acquisition_id || '';
                    document.getElementById('edit_condition').value = data.condition || '';

                    // Update form action
                    const form = document.querySelector('#edit_commodity form');
                    if (form) {
                        form.action = `{{ route($prefix . 'inventory.barang-update', ['code' => ':id']) }}`.replace(':id', id);
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
                    detail: { name: modalName }
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
                console.log('Inventory management system initialized');
            });
        </script>
    @endpush
@endsection
