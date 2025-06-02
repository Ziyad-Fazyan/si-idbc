<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900">Edit Perolehan</h2>
    <div id="loading-edit" class="hidden py-4">
        <div class="flex justify-center items-center">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
        </div>
    </div>
    <form id="edit-form" method="POST" class="mt-4">
        @csrf
        @method('PATCH')
        <div id="content-edit">
            <div class="mb-4">
                <label for="edit-name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="edit-name" name="name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="edit-description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="edit-description" name="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" @click="$dispatch('close-modal', {name: 'edit-perolehan'})"
                    class="mr-2 inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Batal
                </button>
                <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>
