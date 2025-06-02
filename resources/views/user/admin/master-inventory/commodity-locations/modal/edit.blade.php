<div
    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div
        class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] flex flex-col transform transition-all duration-300">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-4 border-b">
            <h5 class="text-xl font-semibold text-gray-800">Ubah Data Ruangan</h5>
            <button type="button"
                class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 rounded-full p-1">
                <span class="text-2xl">&times;</span>
            </button>
        </div>

        <!-- Modal Body -->
        <form method="POST" id="edit-form" class="p-6 overflow-y-auto flex-grow">
            @csrf
            @method('patch')
            <div class="space-y-4">
                <!-- Nama Ruangan Field -->
                <div>
                    <label for="edit-name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Perolehan<span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="edit-name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Masukan nama.." value="{{ $commodity_location->name }}" required>
                </div>

                <!-- Description Field -->
                <div>
                    <label for="edit-description" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi Perolehan <span class="text-gray-500">(opsional)</span>
                    </label>
                    <textarea id="edit-description" name="description" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Masukan deskripsi (opsional).." value="{{ $commodity_location->description }}"></textarea>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-3 pt-6 mt-4 border-t">
                <button type="button" x-data @click="$dispatch('close-modal', {name: 'edit-lokasi'})"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Tutup
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Ubah Data
                </button>
            </div>
        </form>
    </div>
</div>
