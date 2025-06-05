<!-- Form Add Building -->
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h5 class="text-lg font-semibold text-gray-800">Tambah Data Gedung</h5>
        <button type="button" x-data @click="$dispatch('close-modal', {name: 'create-gedung'})"
                class="text-gray-500 hover:text-gray-700 transition-colors">
            <i class="fas fa-fw fa-times mr-1"></i>
        </button>
    </div>

    <!-- Info Box -->
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
        <div class="flex items-start">
            <i class="text-yellow-500 fa-solid fa-circle-info mt-1 mr-2"></i>
            <p class="text-sm text-gray-700">
                Kolom yang memiliki tanda <span class="text-red-500 font-medium">*</span> <span class="text-red-500">wajib diisi.</span>
            </p>
        </div>
    </div>

    <hr class="mb-4">

    <!-- Form -->
    <form action="{{ route($prefix . 'inventory.gedung-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Gedung<span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Masukan nama gedung..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Code Field -->
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                    Kode Gedung (3 Huruf Kapital)<span class="text-red-500">*</span>
                </label>
                <input type="text" name="code" id="code" value="{{ old('code') }}"
                    placeholder="Masukan kode gedung..." maxlength="3" uppercase
                    onkeydown="return /[a-zA-Z]/i.test(event.key)"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" x-data @click="$dispatch('close-modal', {name: 'create-gedung'})"
                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Tutup
            </button>
            <button type="submit"
                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Tambah
            </button>
        </div>
    </form>
</div>
