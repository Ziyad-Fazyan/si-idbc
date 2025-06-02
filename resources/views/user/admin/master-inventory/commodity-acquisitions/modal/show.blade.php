<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 border-b pb-3">
        <h5 class="text-lg font-semibold text-gray-800">Detail Data Perolehan</h5>
        <button type="button" x-data @click="$dispatch('close-modal', {name: 'show-perolehan'})"
            class="text-gray-500 hover:text-gray-700 transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Content -->
    <div class="space-y-4" x-data>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perolehan</label>
            <p id="show-name" class="text-gray-900"></p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Perolehan</label>
            <p id="show-description" class="text-gray-900 whitespace-pre-wrap"></p>
        </div>
    </div>
</div>
