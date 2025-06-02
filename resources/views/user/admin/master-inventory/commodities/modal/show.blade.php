<div class="space-y-6">
    <!-- Loading State -->
    <div id="loading-show" class="hidden text-center py-8">
        <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-blue-500">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Memuat data...
        </div>
    </div>

    <!-- Content -->
    <div id="content-show">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
            <!-- Header -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h5 class="text-lg font-semibold text-gray-800">Detail Data Barang</h5>
                <button type="button" x-data @click="$dispatch('close-modal', {name: 'show-barang'})"
                    class="text-gray-500 hover:text-gray-700 transition-colors p-1 rounded hover:bg-gray-100"
                    aria-label="Tutup modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Basic Info Column -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h6 class="text-sm font-semibold text-gray-700 mb-4 uppercase tracking-wide">Informasi Dasar</h6>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Kode Barang</label>
                                    <p id="show_item_code" class="text-gray-900 font-medium bg-white px-3 py-2 rounded border">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Barang</label>
                                    <p id="show_name" class="text-gray-900 bg-white px-3 py-2 rounded border">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Lokasi Barang</label>
                                    <p id="show_location" class="text-gray-900 bg-white px-3 py-2 rounded border">-</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h6 class="text-sm font-semibold text-gray-700 mb-4 uppercase tracking-wide">Detail Barang</h6>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Bahan</label>
                                    <p id="show_material" class="text-gray-900 bg-white px-3 py-2 rounded border">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Merk</label>
                                    <p id="show_brand" class="text-gray-900 bg-white px-3 py-2 rounded border">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Tahun Pembelian</label>
                                    <p id="show_year" class="text-gray-900 bg-white px-3 py-2 rounded border">-</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info Column -->
                    <div class="space-y-6">
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h6 class="text-sm font-semibold text-gray-700 mb-4 uppercase tracking-wide">Status & Kondisi</h6>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Asal Perolehan</label>
                                    <p id="show_acquisition" class="text-gray-900 bg-white px-3 py-2 rounded border">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Kondisi</label>
                                    <div class="bg-white px-3 py-2 rounded border">
                                        <p id="show_condition" class="font-medium">-</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Kuantitas</label>
                                    <p id="show_quantity" class="text-gray-900 font-medium bg-white px-3 py-2 rounded border">-</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h6 class="text-sm font-semibold text-gray-700 mb-4 uppercase tracking-wide">Informasi Harga</h6>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Harga Total</label>
                                    <p id="show_price" class="text-gray-900 font-semibold text-lg bg-white px-3 py-2 rounded border text-green-600">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Harga Satuan</label>
                                    <p id="show_price_per_item" class="text-gray-900 font-medium bg-white px-3 py-2 rounded border text-green-600">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes Section (if exists) -->
                <div class="mt-8 bg-gray-50 p-4 rounded-lg">
                    <h6 class="text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wide">Keterangan</h6>
                    <div id="show_note_section" class="hidden">
                        <p id="show_note" class="text-gray-900 bg-white px-3 py-2 rounded border italic">-</p>
                    </div>
                    <div id="show_no_note" class="text-gray-500 italic text-sm">
                        Tidak ada keterangan tambahan
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <button type="button"
                            x-data
                            @click="$dispatch('close-modal', {name: 'show-barang'})"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
