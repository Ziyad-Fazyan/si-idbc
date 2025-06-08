<form action="{{ route($prefix . 'master.fakultas-store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="border-b border-gray-200 p-4 flex justify-between items-center">
        <h4 class="text-lg font-semibold text-gray-800">Tambah Fakultas</h4>
        <div class="flex space-x-2">
            <button type="submit"
                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
            <button type="button"
                class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                x-data @click="$dispatch('close-modal', {name: 'create-fakultas'})">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="p-4 space-y-4">
        <div class="space-y-2">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Fakultas</label>
            <input type="text"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                name="name" id="name" placeholder="Inputkan nama fakultas...">
            @error('name')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="space-y-2">
            <label for="code" class="block text-sm font-medium text-gray-700">Kode Fakultas ( 3
                Huruf Kapital )</label>
            <input type="text"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                name="code" id="code" placeholder="Inputkan kode fakultas..." maxlength="3" uppercase
                onkeydown="return /[a-zA-Z]/i.test(event.key)">
            @error('code')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="space-y-2">
            <label for="head_id" class="block text-sm font-medium text-gray-700">Kepala
                Fakultas</label>
            <select name="head_id" id="head_id"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                <option value="" selected>Pilih Kepala Fakultas</option>
                @foreach ($dosen as $item)
                    <option value="{{ $item->id }}">{{ $item->dsn_name }}</option>
                @endforeach
            </select>
            @error('head_id')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
    </div>
</form>
