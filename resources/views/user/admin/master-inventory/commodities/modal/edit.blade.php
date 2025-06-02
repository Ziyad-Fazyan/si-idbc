<div id="edit_commodity" class="space-y-6">
    <!-- Loading State -->
    <div id="loading-edit" class="hidden text-center py-8">
        <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-purple-500">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Memuat data...
        </div>
    </div>

    <!-- Content -->
    <div id="content-edit">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
            <!-- Header -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h5 class="text-lg font-semibold text-gray-800">Ubah Data Barang</h5>
                <button type="button" x-data @click="$dispatch('close-modal', {name: 'edit-barang'})"
                    class="text-gray-500 hover:text-gray-700 transition-colors p-1 rounded hover:bg-gray-100"
                    aria-label="Tutup modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="p-6">
                <form method="POST" action="#" class="space-y-6" id="edit-form">
                    @csrf
                    @method('PATCH')

                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="edit_item_code" class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Barang <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="item_code"
                                   id="edit_item_code"
                                   placeholder="Masukan kode barang.."
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   required>
                        </div>
                        <div>
                            <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Barang <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   id="edit_name"
                                   placeholder="Masukan nama barang.."
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                        <div>
                            <label for="edit_commodity_location_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi Barang <span class="text-red-500">*</span>
                            </label>
                            <select name="commodity_location_id"
                                    id="edit_commodity_location_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    required>
                                <option value="">Pilih Lokasi...</option>
                                @foreach ($commodityLocations as $commodityLocation)
                                    <option value="{{ $commodityLocation->id }}">{{ $commodityLocation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Material & Brand -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="edit_material" class="block text-sm font-medium text-gray-700 mb-2">
                                Bahan
                            </label>
                            <input type="text"
                                   name="material"
                                   id="edit_material"
                                   placeholder="Masukan bahan barang.."
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="edit_brand" class="block text-sm font-medium text-gray-700 mb-2">
                                Merek
                            </label>
                            <input type="text"
                                   name="brand"
                                   id="edit_brand"
                                   placeholder="Masukan merek barang.."
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Year, Acquisition, Condition -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="edit_year_of_purchase" class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun Pembelian
                            </label>
                            <input type="number"
                                   name="year_of_purchase"
                                   id="edit_year_of_purchase"
                                   placeholder="2024"
                                   min="1900"
                                   max="2100"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="edit_commodity_acquisition_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Asal Perolehan <span class="text-red-500">*</span>
                            </label>
                            <select name="commodity_acquisition_id"
                                    id="edit_commodity_acquisition_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    required>
                                <option value="">Pilih Asal Perolehan...</option>
                                @foreach ($commodityAcquisitions as $commodityAcquisition)
                                    <option value="{{ $commodityAcquisition->id }}">{{ $commodityAcquisition->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="edit_condition" class="block text-sm font-medium text-gray-700 mb-2">
                                Kondisi <span class="text-red-500">*</span>
                            </label>
                            <select name="condition"
                                    id="edit_condition"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    required>
                                <option value="">Pilih Kondisi...</option>
                                <option value="1">Baik</option>
                                <option value="2">Kurang Baik</option>
                                <option value="3">Rusak Berat</option>
                            </select>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Quantity & Pricing -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="edit_quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                Kuantitas <span class="text-red-500">*</span>
                            </label>
                            <input type="number"
                                   name="quantity"
                                   id="edit_quantity"
                                   placeholder="1"
                                   min="1"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   required>
                        </div>
                        <div>
                            <label for="edit_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga Total
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">Rp</span>
                                </div>
                                <input type="number"
                                       name="price"
                                       id="edit_price"
                                       placeholder="0"
                                       min="0"
                                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                        <div>
                            <label for="edit_price_per_item" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga Satuan
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">Rp</span>
                                </div>
                                <input type="number"
                                       name="price_per_item"
                                       id="edit_price_per_item"
                                       placeholder="0"
                                       min="0"
                                       class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Note -->
                    <div>
                        <label for="edit_note" class="block text-sm font-medium text-gray-700 mb-2">
                            Keterangan
                        </label>
                        <textarea name="note"
                                  id="edit_note"
                                  rows="4"
                                  placeholder="Masukan keterangan (opsional).."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-vertical"></textarea>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <button type="button"
                                x-data
                                @click="$dispatch('close-modal', {name: 'edit-barang'})"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-md shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
