<div class="space-y-6">
    <div class="flex items-center justify-between p-6 border-b border-gray-200">
        <h5 class="text-xl font-semibold text-gray-900">Tambah Data Barang</h5>
        <button type="button" x-data @click="$dispatch('close-modal', {name: 'create-barang'})"
            class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
            <span class="text-2xl">&times;</span>
        </button>
    </div>

    <div class="p-6">
        <div class="flex items-start space-x-3 mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
            <p class="text-sm text-blue-800">
                Kolom yang memiliki tanda merah <span class="text-red-600 font-medium">wajib diisi.</span>
            </p>
        </div>

        <form action="{{ route($prefix . 'inventory.barang-store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Basic Information Section -->
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label for="item_code" class="block text-sm font-medium text-gray-700">
                            Kode Barang<span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="item_code" id="item_code" value="{{ old('item_code') }}"
                            placeholder="Masukan kode barang..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('item_code', 'store')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nama Barang<span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            placeholder="Masukan nama barang..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('name', 'store')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="ruang_id" class="block text-sm font-medium text-gray-700">
                            Lokasi Barang<span class="text-red-500">*</span>
                        </label>
                        <select name="ruang_id" id="ruang_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="" selected>Pilih..</option>
                            @foreach ($ruangs as $ruang)
                                <option value="{{ $ruang->id }}" @selected(old('ruang_id') == $ruang->id)>
                                    {{ $ruang->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ruang_id')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">

            <!-- Material & Brand Section -->
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="material" class="block text-sm font-medium text-gray-700">
                            Bahan<span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="material" id="material" value="{{ old('material') }}"
                            placeholder="Masukan bahan barang..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('material', 'store')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="brand" class="block text-sm font-medium text-gray-700">
                            Merek<span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="brand" id="brand" value="{{ old('brand') }}"
                            placeholder="Masukan merek barang..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('brand', 'store')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Purchase Details Section -->
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label for="year_of_purchase" class="block text-sm font-medium text-gray-700">
                            Tahun Pembelian<span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="year_of_purchase" id="year_of_purchase"
                            value="{{ old('year_of_purchase') }}" placeholder="Masukan tahun pembelian barang..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('year_of_purchase', 'store')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="commodity_acquisition_id" class="block text-sm font-medium text-gray-700">
                            Asal Perolehan
                        </label>
                        <select name="commodity_acquisition_id" id="commodity_acquisition_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="" selected>Pilih..</option>
                            @foreach ($commodityAcquisitions as $commodityAcquisition)
                                <option value="{{ $commodityAcquisition->id }}" @selected(old('commodity_acquisition_id') == $commodityAcquisition->id)>
                                    {{ $commodityAcquisition->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('commodity_acquisition_id', 'store')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="condition" class="block text-sm font-medium text-gray-700">
                            Kondisi<span class="text-red-500">*</span>
                        </label>
                        <select name="condition" id="condition"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="" selected>Pilih..</option>
                            <option value="1" @selected(old('condition') == 1)>Baik</option>
                            <option value="2" @selected(old('condition') == 2)>Kurang Baik</option>
                            <option value="3" @selected(old('condition') == 3)>Rusak Berat</option>
                        </select>
                        @error('condition', 'store')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">

            <!-- Quantity & Price Section -->
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">
                            Kuantitas<span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"
                            placeholder="Masukan kuantitas barang..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('quantity', 'store')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="price" class="block text-sm font-medium text-gray-700">
                            Harga<span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">Rp.</span>
                            </div>
                            <input type="number" name="price" id="price" value="{{ old('price') }}"
                                placeholder="Masukan harga barang..."
                                class="w-full pl-12 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        </div>
                        @error('price', 'store')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="price_per_item" class="block text-sm font-medium text-gray-700">
                            Harga Satuan<span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">Rp.</span>
                            </div>
                            <input type="number" name="price_per_item" id="price_per_item"
                                value="{{ old('price_per_item') }}" placeholder="Masukan harga satuan barang..."
                                class="w-full pl-12 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        </div>
                        @error('price_per_item', 'store')
                            <div class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Notes Section -->
                <div class="space-y-2">
                    <label for="note" class="block text-sm font-medium text-gray-700">
                        Keterangan <span class="text-gray-500 font-normal">(opsional)</span>
                    </label>
                    <textarea name="note" id="note" rows="4" placeholder="Masukan keterangan (opsional)..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-vertical">{{ old('note') }}</textarea>
                    @error('note', 'store')
                        <div class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                <button type="button" x-data @click="$dispatch('close-modal', {name: 'create-barang'})"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Tutup
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
