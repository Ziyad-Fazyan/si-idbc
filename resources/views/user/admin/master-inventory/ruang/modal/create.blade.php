<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h5 class="text-lg font-semibold text-gray-800">@yield('submenu0')</h5>
        <button type="button" x-data @click="$dispatch('close-modal', {name: 'create-ruang'})"
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
    <form action="{{ route($prefix . 'inventory.ruang-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <!-- Gedung Field -->
            <div>
                <label for="gedung_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Gedung<span class="text-red-500">*</span>
                </label>
                <select name="gedung_id" id="gedung_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                    <option value="" selected>Pilih Gedung</option>
                    @foreach ($gedung as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('gedung_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type Ruang Field -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                    Type Ruang<span class="text-red-500">*</span>
                </label>
                <select name="type" id="type"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                    <option value="" selected>Pilih Type Ruang</option>
                    <option value="0">Ruang Kelas</option>
                    <option value="1">Ruang Laboratorium</option>
                    <option value="2">Ruang Kerja</option>
                    <option value="3">Ruang Pribadi</option>
                    <option value="4">Fasilitas Umum</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Floor Field -->
            <div>
                <label for="floor" class="block text-sm font-medium text-gray-700 mb-1">
                    Lokasi Lantai Gedung<span class="text-red-500">*</span>
                </label>
                <input type="number" name="floor" id="floor"
                    placeholder="Ada dilantai berapa ruangan ini?..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                @error('floor')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Ruangan<span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name"
                    placeholder="Inputkan nama ruangan..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Code Field -->
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                    Kode Ruangan (5 Huruf Bebas)<span class="text-red-500">*</span>
                </label>
                <input type="text" name="code" id="code"
                    placeholder="Inputkan kode ruangan..."
                    maxlength="5"
                    onkeydown="return /[a-zA-Z0-9]/i.test(event.key)"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71] uppercase">
                @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" x-data @click="$dispatch('close-modal', {name: 'create-ruang'})"
                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71]">
                Tutup
            </button>
            <button type="submit"
                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#0C6E71] hover:bg-[#0a5a5d] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71]">
                <i class="fa-solid fa-paper-plane mr-1"></i> Simpan
            </button>
        </div>
    </form>
</div>
