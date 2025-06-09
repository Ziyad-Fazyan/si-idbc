<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900 mb-4">Export Data Barang</h2>

    <form action="{{ route('web-admin.services.convert.export-student') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="extension" class="block text-sm font-medium text-gray-700 mb-2">
                Pilih ekstensi yang diinginkan<span class="text-red-500">*</span>
            </label>
            <select name="extension" id="extension"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                required>
                <option value="">Pilih ekstensi..</option>
                <option value="xlsx">XLSX (.xlsx)</option>
                <option value="xls">XLS (.xls)</option>
                <option value="csv">CSV (.csv)</option>
                <option value="html">HTML (.html)</option>
            </select>
            @error('extension', 'update')
                <div class="text-sm text-red-600 mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="flex justify-end space-x-3 mt-6">
            <button type="button" x-data @click="$dispatch('close-modal', {name: 'export-student'})"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition-colors duration-200">
                Batal
            </button>
            <button type="submit"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                <i class="fas fa-fw fa-download mr-1"></i> Export
            </button>
        </div>
    </form>
</div>
