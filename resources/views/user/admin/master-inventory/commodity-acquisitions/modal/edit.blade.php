<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 border-b pb-3">
        <h5 class="text-lg font-semibold text-gray-800">Edit Data Perolehan</h5>
        <button type="button" x-data @click="$dispatch('close-modal', {name: 'edit-perolehan'})"
            class="text-gray-500 hover:text-gray-700 transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Form -->
    <form id="edit-form" method="POST">
        @csrf
        @method('patch')
        <div class="space-y-4">
            <!-- Name Field -->
            <div>
                <label for="edit-name" class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Perolehan<span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="edit-name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Masukan nama.." value="{{ $commodityAcquisition->name }}" required>
            </div>

            <!-- Description Field -->
            <div>
                <label for="edit-description" class="block text-sm font-medium text-gray-700 mb-1">
                    Deskripsi Perolehan <span class="text-gray-500">(opsional)</span>
                </label>
                <textarea id="edit-description" name="description" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Masukan deskripsi (opsional).."  value="{{ $commodityAcquisition->description }}"></textarea>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" x-data @click="$dispatch('close-modal', {name: 'edit-perolehan'})"
                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Batal
            </button>
            <button type="submit"
                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
