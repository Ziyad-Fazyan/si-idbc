<div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center bg-gray-50 px-6 py-4 border-b">
        <h5 class="text-lg font-semibold text-gray-800">Tambah Data Ruangan</h5>
        <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" @click="$dispatch('close-modal', {name: 'create-lokasi'})">
            <span class="text-2xl">&times;</span>
        </button>
    </div>

    <!-- Info Box -->
    <div class="bg-yellow-50 px-6 py-3 flex items-start">
        <i class="text-yellow-500 fa-solid fa-circle-info mt-1 mr-2"></i>
        <p class="text-sm text-gray-600">
            Kolom yang memiliki tanda <span class="text-red-500">*</span> wajib diisi.
        </p>
    </div>

    <!-- Form -->
    <form action="{{ route($prefix . 'inventory.lokasi-store') }}" method="POST" class="px-6 py-4">
        @csrf

        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nama Ruangan <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Masukan nama..">
            @error('name', 'store')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                Deskripsi Ruangan <span class="text-gray-500 text-xs">(opsional)</span>
            </label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Masukan deskripsi (opsional)..">{{ old('description') }}</textarea>
            @error('description', 'store')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <button type="button" @click="$dispatch('close-modal', {name: 'create-lokasi'})" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Tutup
            </button>
            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Tambah
            </button>
        </div>
    </form>
</div>
