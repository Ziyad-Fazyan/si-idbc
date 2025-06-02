<div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-4 border-b">
            <h5 class="text-xl font-semibold text-gray-800">Detail Data Ruangan</h5>
            <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none" x-data
                @click="$dispatch('close-modal', {name: 'show-lokasi'})">
                <i class="fas fa-times"></i>
                <span class="text-2xl">Keluar</span>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 overflow-y-auto flex-grow">
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

        <!-- Modal Footer -->
        <div class="flex justify-end p-4 border-t bg-gray-50 rounded-b-lg">
            <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none" x-data
                @click="$dispatch('close-modal', {name: 'show-lokasi'})">
                <span class="text-2xl">Keluar</span>
                Tutup
            </button>
        </div>
    </div>
</div>
