<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-sm transition-all duration-300">
    <!-- Loading Indicator -->
    <div id="loading-edit" class="hidden py-8">
        <div class="flex justify-center items-center">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-blue-500"></div>
        </div>
    </div>

    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h5 class="text-lg font-semibold text-gray-800">Edit Data Perolehan</h5>
        <button type="button" x-data @click="$dispatch('close-modal', {name: 'edit-perolehan'})"
            class="text-gray-500 hover:text-gray-700 transition-colors">
            <i class="fas fa-fw fa-times mr-1"></i>
        </button>
    </div>

    <!-- Info Box -->
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
        <div class="flex items-start">
            <i class="text-yellow-500 fa-solid fa-circle-info mt-1 mr-2"></i>
            <p class="text-sm text-gray-700">
                Kolom yang memiliki tanda <span class="text-red-500 font-medium">*</span> <span
                    class="text-red-500">wajib diisi.</span>
            </p>
        </div>
    </div>

    <!-- Form Section -->
    <div id="content-edit">
        <form id="edit-form" method="POST" class="space-y-5">
            @csrf
            @method('PATCH')

            <div class="space-y-4">
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Perolehan<span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit_name" name="name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Masukkan nama perolehan...">
                    @error('name', 'update')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi Perolehan <span class="text-gray-500">(opsional)</span>
                    </label>
                    <textarea id="edit_description" name="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Masukkan deskripsi perolehan..."></textarea>
                    @error('description', 'update')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" @click="$dispatch('close-modal', {name: 'edit-perolehan'})"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Batal
                </button>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
